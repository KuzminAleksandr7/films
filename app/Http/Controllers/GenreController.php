<?php

namespace App\Http\Controllers;

use App\Http\Requests\Genre\StoreRequest;
use App\Http\Requests\Genre\UpdateRequest;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genre = Genre::all();

        return view('genre.index', ['genre' => $genre]);
    }

    public function create()
    {
        return view('genre.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $genre = Genre::firstOrCreate($data);

        return redirect()->route('genre.index');
    }

    public function edit(Genre $genre)
    {
        return view('genre.edit', ['genre' => $genre]);
    }

    public function update(UpdateRequest $request, Genre $genre)
    {
        $data = $request->validated();

        $genre->update($data);

        return redirect()->route('genre.index');
    }

    public function delete(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genre.index');
    }

}
