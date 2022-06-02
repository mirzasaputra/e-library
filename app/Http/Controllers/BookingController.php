<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Data Booking'
        ];

        return view('booking', $data);
    }

}
