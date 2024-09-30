<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthUser extends Controller
{
    public function register(Request $request)
    {
        try{
        $validated=$request->validate(['name'=>'required|string','email'=>'email|required|unique:users','password'=>'required|min:3']);
        User::created($validated);
        return response()->json(['message'=>'Registration Successful'],200);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()],200);
        }
    }
    public function login(Request $request) {}
}
