<?php

namespace App\Http\Controllers\Genre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use DataTables;

class GenreController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Data Genre',
            'mods' => 'genre'
        ];

        return customView('genre.index', $data);
    }

    public function getData()
    {
        return DataTables::of(Genre::query())->make();
    }

    public function store(GenreRequest $request)
    {
        try {
            Genre::create($request->only(['name']));

            return response()->json([
                'message' => 'Data telah ditambahkan'
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }

    public function edit(Genre $genre)
    {
        return $genre;
    }

    public function update(GenreRequest $request, Genre $genre)
    {
        try {
            $genre->update($request->only(['name']));

            return response()->json([
                'message' => 'Data telah diupdate',
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }

    public function destroy(Genre $genre)
    {
        try {
            $genre->delete();

            return response()->json([
                'message' => 'Data telah dihapus'
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }
    
}
