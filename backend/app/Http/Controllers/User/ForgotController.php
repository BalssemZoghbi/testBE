<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\ForgotRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use  App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\Hash;

use App\Mail\Forgot;
use App\Models\user\User;

// use App\Http\Requests\ResetRequest;
class ForgotController extends Controller
{

    public function forgot(ForgotRequest $request)
    {
        $email=$request->input('email');
        if(User::Where('email',$email)->doesntExist()){
            return response([
                'message'=>'User doesnt exist!!'
            ],404);
        }
        $token=Str::random(10);

        try{
        DB::table('password_resets')->insert([
            'email'=>$email,
            'token'=>$token
        ]);


        // Mail::send('emails.forgot',['token'=>$token],function(Message $message)use($email){
        //     $message->to($email);
        //     $message->Subject('Reset your password');
        // });
        Mail::to($email)->send(new Forgot($token));
        // return response([
        //     'message'=>'Email sent successfully'
        // ],200);


        return response([
            'message'=>'Check your email'
        ]);
    }catch(\Exception $exception){
        return response([
            'message'=> $exception->getMessage()
        ],400);
    }
}
        public function reset(ResetRequest $request){
            $token=$request->input('token');
            if(!$passwordResets=DB::table('password_resets')->where('token',$token)->first()){
                return response([
                    'message'=>'Invalid token'
                ],404);
            }

        //     $token=$request->input('token');
        //     if(!$passwordResets=DB::table('password_resets')->where('token',$token)->first()){
        //         return response([
        //             'message'=>'Invalid token'
        //         ],400);
        // }
  /** @var User $user */
        if(!$user=User::where('email',$passwordResets->email)->first()){
            return response([
                'message'=>'User doesnt exist'
            ],400);
        }



        // if(!$user=User::where('email',$passwordResets->email)->first())
        // {
        // return response([
        //     'message'=>'User dosent exist'
        // ],404);
        // }
        $user->password=Hash::make($request->input('password'));
        $user->save();
        return response([
        'message'=>'success'
        ]);
        }

}
