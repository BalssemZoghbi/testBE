<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;
use  App\Http\Requests\RegisterRequest;
use App\Models\User;
use Session;
class AuthController extends Controller
{
     /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try{
     if (Auth::attempt($request->only('email', 'password')))  
        {
            /** @var User $user */ 
            $user=Auth::user();
            $token=$user->createToken('app')->accessToken;

            return response([
                'message'=>'Success',
                'token'=>$token,
                'user'=>$user
            ]);
        }
    }catch(\Exception $exception){
        return response([
            'message'=> $exception->getMessage()
        ],400);
    }
        return response([
            'message'=>'Invalide username/password'
        ],401);
    }
    public function user()
    {
        return Auth::user();

    }
    public function register(RegisterRequest $request)
    {
        try{
            $user=User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password'))
        ]);
        return $user;
   }catch(\Exception $exception){
    return response([
        'message'=> $exception->getMessage()
    ],400);
}
 }
 
 public function logout(){
    if(session::has('loginId')){
      session::pull('loginId');
    return redirect('login');
    }  
}
}
