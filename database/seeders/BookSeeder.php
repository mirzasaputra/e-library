<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::insert([
            [
                'name' => 'Resep Makanan Padang',
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab dolore quo iure incidunt eaque ipsa.',
                'picture' => 'books_299382773829_27718283999203.jpg',
                'publication_year' => 2012,
                'author' => 'ANISSA NURHIDAYATI',
                'count_views' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Belajar HTML CSS & PHP Dasar',
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab dolore quo iure incidunt eaque ipsa.',
                'picture' => 'books_2883728377747_8393288827383.jpg',
                'publication_year' => 2017,
                'author' => 'ARISTA PRASETYA ADI',
                'count_views' => 500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Framework Laravel',
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab dolore quo iure incidunt eaque ipsa.',
                'picture' => 'books_8399283928882_38829388819000.jpg',
                'publication_year' => 2015,
                'author' => 'YUDHO YUDHANTO',
                'count_views' => 800,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mengenal Bahasa Pemrograman Go Lang',
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab dolore quo iure incidunt eaque ipsa.',
                'picture' => 'books_938829388823333_82938889230019233.png',
                'publication_year' => 2019,
                'author' => 'NOVAL AGUNG PRAYOGO',
                'count_views' => 600,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
