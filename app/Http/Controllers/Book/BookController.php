<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use DataTables;

class BookController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Data Buku',
            'mods' => 'book'
        ];

        return customView('book.index', $data);
    }

    public function getData()
    {
        return DataTables::of(Book::query())->make();
    }

}
