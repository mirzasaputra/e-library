<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    
    public function index()
    {
        try {
            $users = User::all();
            return response()->json($users);
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        try {
            $request->merge(['password' => Hash::make($request->password)]);
            User::create($request->only(['name', 'username', 'email', 'password']));

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

    public function find(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignoreModel($request->user)
            ],
            'username' => [
                'required',
                Rule::unique('users', 'username')->ignoreModel($request->user)
            ],
        ]);

        try {
            $user->update($request->only(['name', 'email', 'username']));

            return response()->json([
                'message' => 'Data berhasil diperbarui'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage(),
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
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
