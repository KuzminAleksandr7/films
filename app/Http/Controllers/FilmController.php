<?php

namespace App\Http\Controllers;

use App\Http\Requests\Film\IndexRequest;
use App\Http\Requests\Film\StoreRequest;
use App\Http\Requests\Film\UpdateRequest;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $films = Film::where('is_published', 1)->with('genres')->paginate($perPage, ['*'], 'page', $page);

        return view('film.index', ['films' => $films]);
    }

    public function create()
    {
        $genres = Genre::all();

        return view('film.create', ['genres' => $genres]);
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();

            $genres = $data['genres'];
            $image = $data['image'] ?? null;
            unset($data['genres'], $data['image']);

            if ($image) {
                $name = md5(now() . $data['title']) . '.' . $image->getClientOriginalExtension();
                $data['poster_path'] = Storage::disk('public')->putFileAs('/posters', $image, $name);
                $data['poster_url'] = url('/storage/' . $data['poster_path']);
            }

            $film = Film::create($data);

            $film->genres()->attach($genres);

            DB::commit();

            return redirect()->route('film.index');
        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($data['poster_path']) && Storage::disk('public')->exists($data['poster_path'])) {
                Storage::disk('public')->delete($data['poster_path']);
            }
            Log::error($e);

            return redirect()->back()->with('error', 'Произошла ошибка. Пожалуйста, повторите попытку.');
        }
    }

    public function show(Film $film)
    {
        return view('film.show', ['film' => $film, 'genres' => $film->genres]);
    }

    public function edit(Film $film)
    {
        return view('film.edit', ['film' => $film, 'genres' => $film->genres]);
    }

    public function update(UpdateRequest $request, Film $film)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $genres = $data['genres'];
            $image = $data['image'] ?? null;
            unset($data['genres'], $data['image']);
            $data['published_at'] = $data['is_published'] ? now() : null;

            if ($image) {
                if ($film->poster_path != 'posters/no_poster.png' && Storage::disk('public')->exists($film->poster_path)) {
                    Storage::disk('public')->delete($film->poster_path);
                }
                $name = md5(now() . $data['title']) . '.' . $image->getClientOriginalExtension();
                $data['poster_path'] = Storage::disk('public')->putFileAs('/posters', $image, $name);
                $data['poster_url'] = url('/storage/' . $data['poster_path']);
            }

            $film->update($data);

            $film->genres()->detach();
            $film->genres()->attach($genres);

            DB::commit();

            return view('film.show', ['film' => $film]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return redirect()->back()->with('error', 'Произошла ошибка. Пожалуйста, повторите попытку.');
        }
    }

    public function delete(Film $film)
    {
        if ($film->poster_path != 'posters/no_poster.png' && Storage::disk('public')->exists($film->poster_path)) {
            Storage::disk('public')->delete($film->poster_path);
        }

        $film->delete();

        return redirect()->route('film.index');
    }

}
