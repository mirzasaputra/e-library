<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DataTables;

class RoleController extends Controller
{
    
    public function index()
    {
        $data = [ 
            'title' => 'Roles',
            'mods'=> 'role'
        ];

        return customView('role.index', $data);
    }

    public function getData()
    {
        return DataTables::of(Role::whereNotIn('name', ['Developer']))->make();
    }

}
