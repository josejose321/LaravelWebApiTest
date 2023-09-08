<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json(User::paginate(10));
    }

    public function store(Request $request) 
    {
        $user = User::create($request->validated());
        return response()->json($user);
    }

    public function show(Request $request,$user) 
    {
        if($user = User::find($user))
        {
            return response()->json($user);
        }
        return response()->json(['message' =>'Not Found']);
    }

    public function update(Request $request,$user) 
    {
        if($user = User::find($user))
        {
            $user->update($request->validated());
            return response()->noContent();
        }

        return response()->json(['message' =>'Not Found']);
    }

    public function destroy(Request $request,$user) 
    {
        if($user = User::find($user))
        {
            $user->delete;
            return response()->noContent();
        }
        
    }
}
