<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;

class UserController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Users',
            'mods' => 'user'
        ];

        return customView('user.index', $data);
    }

    public function getData()
    {
        return DataTables::of(User::query())->addColumn('role', function($data){
            return ucfirst($data->roles[0]->name);
        })->editColumn('name', function($data){
            return ucfirst($data->name);
        })->make();
    }

}
