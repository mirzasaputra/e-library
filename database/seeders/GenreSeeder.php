<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::insert([
            ['name' => 'Romance'],
            ['name' => 'Food Recipes'],
            ['name' => 'Education'],
            ['name' => 'Comic'],
        ]);
    }
}
