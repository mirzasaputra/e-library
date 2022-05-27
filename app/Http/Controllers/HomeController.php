<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => "Home",
            'popularBooks' => Book::orderBy('id', 'asc')->limit(4)->get(),
            'latestBooks' => Book::orderBy('created_at', 'desc')->limit(4)->get(),
        ];

        return view('home', $data);
    }

}
