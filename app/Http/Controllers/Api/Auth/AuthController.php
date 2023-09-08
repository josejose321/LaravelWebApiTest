<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    //

    public function index(Request $request) 
    {
        return response()->json($request->user());
    }
    public function login(Request $request) 
    {
        $request->validate([
            'email'         => 'required|email',
            'password'      => 'required',
        ]);


        if(auth()->attempt($request->only('email','password')))
        {
            $user   = User::where('email',$request->email)->first();
            $token  = $user->createToken('PersonalAccessToken')->plainTextToken;

            return response()->json($token);
        }
        return response()->json(['message'=>'Invalid Credentials'],401);
    }


    public function logout(Request $request) 
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'Successfully logged out']);
    }
}
