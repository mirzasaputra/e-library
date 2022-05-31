<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
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
        return DataTables::of(User::whereHas('roles', function($q){
            $q->whereNotIn('name', ['Developer']);
        }))->addColumn('role', function($data){
            return ucfirst($data->roles[0]->name);
        })->editColumn('name', function($data){
            return ucfirst($data->name);
        })->make();
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Users',
            'roles' => Role::whereNotIn('name', ['Developer'])->get(),
            'action' => route('admin.users.store'),
        ];

        return customView('user.form', $data);
    }

    public function store(UserRequest $request)
    {
        try {
            $request->merge(['password' => Hash::make($request->password)]);
            User::create($request->only('name', 'email', 'username', 'password'))->assignRole($request->role);

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

    public function Edit(User $user)
    {
        $data = [
            'title' => 'Edit Users',
            'roles' => Role::whereNotIn('name', ['Developer'])->get(),
            'action' => route('admin.users.update', $user->hashid),
            'data' => $user,
        ];

        return customView('user.form', $data);
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $user->update($request->only(['name', 'username', 'email']));
            $user->syncRoles($request->role);

            return response()->json([
                'message' => 'Data telah diupdate'
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

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
