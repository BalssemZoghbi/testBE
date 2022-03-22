<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    function index(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        // else if(strpos($request->email, '@sacemindustries.com'){
            $token = $user->createToken('my-app-token')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];

             return response($response, 201);
        // }
    }
    function logout(Request $request){
        // dd($request->user());
       return $request->user()->currentAccessToken()->delete();
    }
    function register(Request $request){
        // if(strpos($request->email, '@sacemindustries.com'){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|regex:/(.*)@sacemindustries.com/i|unique:users',
            'password' => 'required',
            'password_confirm'=>'required|same:password',
        ]);
        $name = $request->name;
        $email    = $request->email;
        $password = $request->password;
        $user     = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        // }
        return response()->json($user);
    }
}