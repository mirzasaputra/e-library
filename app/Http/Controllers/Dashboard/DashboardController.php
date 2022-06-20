<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'books' => Book::all(),
            'transactionToday' => Transaction::whereDate('created_at', date('Y-m-d'))->whereNotIn('status', ['pending']),
            'members' => Member::all(),
            'users' => User::whereHas('roles', function($query){
                $query->whereNotIn('name', ['Developer']);
            })->get(),
        ];

        return customView('dashboard.index', $data);
    }

}
