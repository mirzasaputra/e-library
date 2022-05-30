<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class KatalogController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Katalog'
        ];

        return view('katalog', $data);
    }

    public function detail(Book $book)
    {
        $data = [
            'title' => $book->name,
            'data' => $book,
            'latestBooks' => Book::orderBy('created_at', 'desc')->limit(4)->get(),
        ];

        return view('detail', $data);
    }

}
