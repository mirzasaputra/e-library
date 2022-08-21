<?php

namespace App\Http\Controllers\API\Genre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Genre;


class GenreController extends Controller
{
    public function index(){
        try {
            $genres = Genre::all();
            return response()->json($genres);
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        try {
            Genre::create($request->only(['name']));
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

    public function find(Genre $genre){
        return response()->json($genre);
    }

    public function update(Request $request, Genre $genre){
        $request->validate([
            'name' => 'required'
        ]);
        try {
            $genre->update($request->only(['name']));
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

    public function destroy(Genre $genre){
        try {
            $genre->delete();
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
