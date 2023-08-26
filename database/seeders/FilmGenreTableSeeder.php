<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genre_film')->insert([
            ['film_id' => 1, 'genre_id' => 1],
            ['film_id' => 2, 'genre_id' => 1],
            ['film_id' => 3, 'genre_id' => 1],
            ['film_id' => 4, 'genre_id' => 1],
            ['film_id' => 5, 'genre_id' => 1],
            ['film_id' => 6, 'genre_id' => 1],
            ['film_id' => 7, 'genre_id' => 1],
            ['film_id' => 8, 'genre_id' => 1],
            ['film_id' => 9, 'genre_id' => 1],
            ['film_id' => 10, 'genre_id' => 1],
            ['film_id' => 1, 'genre_id' => 2],
            ['film_id' => 2, 'genre_id' => 2],
            ['film_id' => 3, 'genre_id' => 2],
            ['film_id' => 4, 'genre_id' => 2],
            ['film_id' => 5, 'genre_id' => 2],
            ['film_id' => 6, 'genre_id' => 2],
            ['film_id' => 1, 'genre_id' => 3],
            ['film_id' => 2, 'genre_id' => 3],
            ['film_id' => 3, 'genre_id' => 3],
        ]);
    }
}
