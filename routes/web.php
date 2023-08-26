<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::group(['prefix' => 'films'], function () {
    Route::get('/',            [FilmController::class, 'index']) ->name('film.index');
    Route::get('/create',      [FilmController::class, 'create'])->name('film.create');
    Route::post('/',           [FilmController::class, 'store']) ->name('film.store');
    Route::get('/{film}',      [FilmController::class, 'show'])  ->name('film.show');
    Route::get('/{film}/edit', [FilmController::class, 'edit'])  ->name('film.edit');
    Route::patch('/{film}',    [FilmController::class, 'update'])->name('film.update');
    Route::delete('/{film}',   [FilmController::class, 'delete'])->name('film.delete');
});

Route::group(['prefix' => 'genre'], function () {
    Route::get('/',            [GenreController::class, 'index']) ->name('genre.index');
    Route::get('/create',      [GenreController::class, 'create'])->name('genre.create');
    Route::post('/',           [GenreController::class, 'store']) ->name('genre.store');
    Route::get('/{genre}/edit',[GenreController::class, 'edit'])  ->name('genre.edit');
    Route::patch('/{genre}',   [GenreController::class, 'update'])->name('genre.update');
    Route::delete('/{genre}',  [GenreController::class, 'delete'])->name('genre.delete');
});
