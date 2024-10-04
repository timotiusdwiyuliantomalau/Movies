<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'string',
                'email' => 'email:rfc,dns|unique:users',
                'password' => 'confirmed|min:3|alpha_num:ascii',
                'resident_number' => 'integer|unique:users',
            ]);
            User::create($validated);
            return response()->json(['message' => 'Account has been created!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function login(Request $request){
        try{
        $validated=$request->validate([
            'resident_number'=>'integer',
            'email'=>'email:rfc,dns',
            'password'=>'alpha_num:ascii',
        ]);
        if(Auth::attempt($validated)){
            $user=Auth::user();
            return response()->json(['message'=>"Login successfull!",'data'=>$user],200);
        }
        return response()->json(['error'=>'The provided credentials do not match our records.'],400);
    }
    catch(\Exception $e){
        return response()->json(['error'=>$e->getMessage()],400);
    }
}

public function cinema($id){
    $cinema=Cinema::find($id);
    $cinema->time=json_decode($cinema->time);
    return response()->json(['data'=>$cinema],200);
}
}
