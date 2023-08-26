<?php

use App\Http\Controllers\API\FilmController;
use App\Http\Controllers\API\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::get('/films',      [FilmController::class, 'index']);
    Route::get('/film/{id}',  [FilmController::class, 'show']);
    Route::get('/genre/{id}', [FilmController::class, 'filmsByGenre']);
    Route::get('/genres',     [GenreController::class, 'index']);
});

