<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Login',
        ];

        return view('auth.index', $data);
    }

    public function login(Request $request)
    {
        if(\Request::ajax()){
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);
            
            try {
                $user = User::where('username', $request->username);

                if($user->count() > 0){
                    if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
                        $user = $user->first();

                        if($user->roles[0]->name == "Member"){
                            $redirect = url('/dashboard');
                        } else {
                            $redirect = route('admin.dashboard');
                        }

                        return response()->json([
                            'message' => 'Login berhasil',
                            'redirect' => $redirect,
                        ]);
                    } else {
                        return response()->json([
                            'errors' => [
                                'password' => ['Wrong Password']
                            ]
                        ], 422);
                    }
                } else {
                    return response()->json([
                        'errors' => [
                            'username' => ['Username has not registered']
                        ]
                    ]);
                }
            } catch(Exception $e){
                return response()->json([
                    'message' => $e->getMessage(),
                    'trace' => $e->getTrace()
                ], 500);
            }
        } else {
            abort(403);
        }
    }

}
