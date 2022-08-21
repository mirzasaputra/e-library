<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        try {
            $user = User::where('username', $request->username)->first();

            if(!is_null($user) && Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                $tokenResult = $user->createToken('LibraryAppApi');
                $token = $tokenResult->token;
                $token->save();

                return response()->json([
                    'token' => $tokenResult->accessToken,
                    'id' => $user->hashid,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email
                ]);
            } else {
                return response()->json([
                    'message' => 'Username atau password salah'
                ], 500);
            }
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getProfile()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Berhasil Logout'
        ]);
    }

}
