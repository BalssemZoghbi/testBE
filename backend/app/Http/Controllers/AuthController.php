<?php

namespace App\Http\Controllers;

use App\Mail\User as MailUser;
use App\Mail\Userdecline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            $token = $user->createToken('my-app-token')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];

             return response($response, 201);
    }
    function logout(Request $request){
       return $request->user()->currentAccessToken()->delete();
    }
    function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirm'=>'required|same:password',
        ]);
        $name = $request->name;
        $email    = $request->email;
        $password = $request->password;
        $user     = User::create(['name' => $name, 'email' => $email,'type'=>'pending', 'password' => Hash::make($password)]);
        return response()->json($user);
    }

    public function accept($id)
    {
       $user=User::FindOrFail($id);
       $user->update([ 'type'=>'employe']);
       Mail::to($user->email)->send(new MailUser($user->email));
        return new JsonResponse(
            [
                'success' => true,
            ],
            200
        );
    }
    public function decline($id)
    {
        $user=User::FindOrFail($id);
        Mail::to($user->email)->send(new Userdecline($user->email));
        // return new JsonResponse(
        //     [
        //         'success mail' => true,
        //     ],
        //     200
        // );
        if($user->delete()) {
            return 'user deleted';
           }
    }
}
