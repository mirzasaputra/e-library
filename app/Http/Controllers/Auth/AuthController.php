<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Member;

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
                            $redirect = url('/');
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
                    ], 422);
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

    public function register()
    {
        $data = [
            'title' => 'Register'
        ];

        return view('auth.register', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required'
        ]);

        try {
            $member = Member::create($request->only(['name','phone','email','address']));
            $request->merge(['password' => Hash::make($request->password), 'member_id' => $member->id]);
            User::create($request->only(['member_id', 'name', 'phone', 'email', 'username', 'password']))->assignRole('Member');

            return response()->json([
                'message' => 'Data telah ditambahkan',
            ]);

        } catch(Exception $e) {
            return restponse()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

}
