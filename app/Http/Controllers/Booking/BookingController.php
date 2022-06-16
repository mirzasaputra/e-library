<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Peminjaman',
            'mods' => 'booking',
        ];

        return customView('booking.index', $data);
    }

}
