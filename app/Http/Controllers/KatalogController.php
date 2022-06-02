<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use Vinkla\Hashids\Facades\Hashids;

class KatalogController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Katalog',
            'genres' => Genre::all(),
        ];

        return view('katalog', $data);
    }

    public function getData($genre)
    {
        if($genre == 'all'){
            $data = Book::all();
        } else {
            $hashids = Hashids::decode($genre)[0];
            $data = Book::where('genre_id', $hashids)->get();
        }

        $data = $data->map(function($data){
            return [
                'hashid' => $data->hashid,
                'picture' => $data->picture,
                'genre' => ucfirst($data->genre->name),
                'name' => substr($data->name, 0, 26) . (strlen($data->name) > 26 ? '...' : ''),
                'description' => substr($data->description, 0, 35) . (strlen($data->description) > 35 ? '...' : ''),
                'count_views' => number_format($data->count_views)
            ];
        });

        return response()->json($data);
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
