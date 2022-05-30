<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KatalogController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Katalog'
        ];

        return view('katalog', $data);
    }

}
