<?php

namespace App\Http\Controllers\API\Book;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Book;

class BookController extends Controller
{
    public function index(){
        try {
            $books = Book::all();
            $books = $books->map(function($book){
                return [
                    'name' => $book->name,
                    'publication_year' => $book->publication_year,
                    'author' => $book->author,
                    'hashid' => Hashids::encode($book->id),
                ];
            });
            return response()->json($books);
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        $request->validate([
            'genre_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'publication_year' => 'required|string',
            'author' => 'required|string',
        ]);
        try {
            $request->merge(['picture' => 'default.jpg']);
            Book::create($request->only(['genre_id', 'name', 'description', 'publication_year', 'author', 'picture']));
            return response()->json([
                'message' => 'Data telah ditambahkan'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function find(Book $book){
        return response()->json($book);
    }

    public function update(Request $request, Book $book){
        $request->validate([
            'genre_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'publication_year' => 'required|string',
            'author' => 'required|string'
        ]);
        try {
            $book->update($request->only(['genre_id', 'name', 'description', 'publication_year', 'author']));
            return response()->json([
                'message' => 'Data telah diperbarui'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Book $book){
        try {
            $book->delete();
            return response()->json([
                'message' => 'Data telah dihapus'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
