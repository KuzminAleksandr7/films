<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Film\FilmsByGenreRequest;
use App\Http\Requests\Film\IndexRequest;
use App\Http\Resources\FilmResource;
use App\Models\Film;

class FilmController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $films = Film::where('is_published', 1)->with('genres')->paginate($perPage, ['*'], 'page', $page);

        return FilmResource::collection($films);
    }

    public function filmsByGenre(FilmsByGenreRequest $request, $id)
    {
        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $films = Film::where('is_published', 1)->with(['genres' => function ($query) use ($id) {
            $query->where('genres.id', $id);
        }])->paginate($perPage, ['*'], 'page', $page);

        return FilmResource::collection($films);
    }

    public function show($id)
    {
        return new FilmResource(Film::find($id));
    }

}
