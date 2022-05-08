<?php

namespace App\Http\Controllers\User;

use App\Mail\Userdecline;
use App\Models\user\User;
use App\Models\user\UserInactive;
use Illuminate\Http\Request;
use App\Mail\User as MailUser;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
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
            'email' => 'required|email|unique:users',
            // |regex:/(.*)@sacemindustries.com/i|
            'password' => 'required|min:8',
            'password_confirm'=>'required|same:password',
            'poste' => 'required',
            'numero' => 'required',
            'image' => 'required',
        ]);
        // dd($request->image->getClientOriginalName());
        $name = $request->name;
        $email    = $request->email;
        $password = $request->password;
        $poste = $request->poste;
        $numero = $request->numero;

        // $image = time().'.'.$request->image->extension();
        // dd($image);
        // $request->image->move(public_path('images'),$image);
// dd(var_dump($request->file('image')));
        $image=$request->file('image');

        $fileNameWithExt = $image->getClientOriginalName();
            //just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //just extension
            $extension = $image->getClientOriginalExtension();
            //filename to store
            $filenametoStore = $filename.'_'.time().'.'.$extension;
            //upload
            // return response()->json($request->file('image'));
            // dd($request->file());
             $request->image->storeAs('public/images/',$filenametoStore);
            // Save into database
// dd($request->file());


        // if($request->file()) {
        //     $image = time().'_'.$request->file->getClientOriginalName();
        //     $request->file->move(public_path('images'),$image);
        // }

        $user     = User::create(['name' => $name, 'email' => $email,'type'=>'pending', 'password' => Hash::make($password),'poste' => $poste,'numero' => $numero,'image'=>$filenametoStore]);
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
