<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Film::factory(10)->create();

        $this->call([
            GenresTableSeeder::class,
            FilmGenreTableSeeder::class,
        ]);


    }
}
