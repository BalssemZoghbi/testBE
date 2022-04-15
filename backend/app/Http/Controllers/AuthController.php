<?php

namespace App\Http\Controllers;

use App\Mail\User as MailUser;
use App\Mail\Userdecline;
use App\Models\User;
use App\Models\UserInactive;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    function index(Request $request)
    {

        $user= User::where('email', $request->email)->first();
        // dd($user->type);
        if($user->type!=='pending'){
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

             return response($response, 200);
        }else{
            return response([
                'message' => ['pending.']
            ], 404);
        }

    }
    function logout(Request $request){
       return $request->user()->currentAccessToken()->delete();
    }
    function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|regex:/(.*)@sacemindustries.com/i|unique:users',
            'password' => 'required|min:8',
            'password_confirm'=>'required|same:password',
            'poste' => 'required',
            'numero' => 'required',
        ]);
        $name = $request->name;
        $email    = $request->email;
        $password = $request->password;
        $poste = $request->poste;
        $numero = $request->numero;
        $user     = User::create(['name' => $name, 'email' => $email,'type'=>'pending', 'password' => Hash::make($password),'poste' => $poste,'numero' => $numero,]);
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
        $userr = UserInactive::create(['name' => $user->name, 'email' => $user->email,'type'=>$user->type, 'password' => $user->password,'poste' => $user->poste,'numero' => $user->numero,]);
        if($user->delete()) {
            return $userr;
           }


    }
}
