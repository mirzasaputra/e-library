<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => "Home",
            'popularBooks' => [
                [
                    'id' => 1,
                    'title' => 'Resep Makanan Padang',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab dolore quo iure incidunt eaque ipsa.',
                    'picture' => 'books_299382773829_27718283999203.jpg',
                    'countViews' => 20
                ],
                [
                    'id' => 2,
                    'title' => 'Belajar HTML CSS & PHP Dasar',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab dolore quo iure incidunt eaque ipsa.',
                    'picture' => 'books_2883728377747_8393288827383.jpg',
                    'countViews' => 500
                ],
                [
                    'id' => 3,
                    'title' => 'Framework Laravel',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab dolore quo iure incidunt eaque ipsa.',
                    'picture' => 'books_8399283928882_38829388819000.jpg',
                    'countViews' => 800
                ],
                [
                    'id' => 4,
                    'title' => 'Mengenal Bahasa Pemrograman Go Lang',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab dolore quo iure incidunt eaque ipsa.',
                    'picture' => 'books_938829388823333_82938889230019233.png',
                    'countViews' => 600
                ],
            ],
            'latestBooks' => [
                [
                    'id' => 4,
                    'title' => 'Mengenal Bahasa Pemrograman Go Lang',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab dolore quo iure incidunt eaque ipsa.',
                    'picture' => 'books_938829388823333_82938889230019233.png',
                    'countViews' => 600
                ],
                [
                    'id' => 3,
                    'title' => 'Framework Laravel',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab dolore quo iure incidunt eaque ipsa.',
                    'picture' => 'books_8399283928882_38829388819000.jpg',
                    'countViews' => 800
                ],
                [
                    'id' => 2,
                    'title' => 'Belajar HTML CSS & PHP Dasar',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab dolore quo iure incidunt eaque ipsa.',
                    'picture' => 'books_2883728377747_8393288827383.jpg',
                    'countViews' => 500
                ],
                [
                    'id' => 1,
                    'title' => 'Resep Makanan Padang',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab dolore quo iure incidunt eaque ipsa.',
                    'picture' => 'books_299382773829_27718283999203.jpg',
                    'countViews' => 20
                ],
            ],
        ];

        return view('home', $data);
    }

}
