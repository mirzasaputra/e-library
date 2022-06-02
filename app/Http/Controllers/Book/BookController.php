<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Genre;
use DataTables;
use File;
use Vinkla\Hashids\Facades\Hashids;

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
        return DataTables::of(Book::query())->addColumn('genre', function($data){
            return $data->genre->name;
        })->editColumn('description', function($data){
            return substr($data->description, 0, 80) . (strlen($data->description) > 80 ? '...' : '');
        })->make();
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Buku',
            'action' => route('admin.books.store'),
            'genres' => Genre::all(),
        ];

        return customView('book.form', $data);
    }

    public function store(BookRequest $request)
    {
        try {
            if($request->hasFile('file')){
                $path = public_path('storage/images/books');
                $file = $request->file('file');
                $filename = 'books_'. rand(0, 9999999999) .'_'. rand(0, 9999999999) .'.'. $file->getClientOriginalExtension();
                $file->move($path, $filename);
            }
            $request->merge(['picture' => $filename, 'genre_id' => Hashids::decode($request->genre_id)[0]]);

            Book::create($request->only(['genre_id', 'name', 'description', 'publication_year', 'author', 'picture']));

            return response()->json([
                'message' => 'Data telah ditambahkan',
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ], 500);
        }
    }

    public function detail(Book $book)
    {
        $data = [
            'title' => 'Detail Buku',
            'data' => $book,
        ];

        return customView('book.detail', $data);
    }

    public function edit(Book $book)
    {
        $data = [
            'title' => 'Edit Buku',
            'action' => route('admin.books.update', $book->hashid),
            'data' => $book,
            'genres' => Genre::all(),
        ];

        return customView('book.form', $data);
    }

    public function update(BookRequest $request, Book $book)
    {
        try {
            if($request->hasFile('file')){
                $path = public_path('storage/images/books');
                $file = $request->file('file');
                $filename = 'books_'. rand(0, 9999999999) .'_'. rand(0, 9999999999) .'.'. $file->getClientOriginalExtension();
                $file->move($path, $filename);

                if(file_exists(public_path('storage/images/books/'. $book->picture))){
                    File::delete(public_path('storage/images/books/'. $book->picture));
                }
            } else {
                $filename = $book->picture;
            }

            $request->merge(['picture' => $filename, 'genre_id' => Hashids::decode($request->genre_id)[0]]);
            $book->update($request->only(['genre_id', 'name', 'description', 'publication_year', 'author', 'picture']));

            return response()->json([
                'message' => 'Data telah diubah',
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ], 500);
        }
    }

    public function destroy(Book $book)
    {
        try {
            if(file_exists(public_path('storage/images/books/'. $book->picture))){
                File::delete(public_path('storage/images/books/'. $book->picture));
            }
            $book->delete();

            return response()->json([
                'message' => 'Data telah dihapus',
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ], 500);
        }
    }

}
