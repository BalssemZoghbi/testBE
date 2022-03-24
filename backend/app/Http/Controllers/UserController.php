<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
// use App\Models\Projet;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }
    public function show($id)
    {
         $users=User::FindOrFail($id);
        //  $projets=DB::table('projets')->where ('user_id' , $id)->get();
        //  $projets=Projet::find($id,'user_id')->get();
        return UserResource::collection($users);
    }

    public function store(Request $request){
       $user= User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>$request->password,
            'type' =>$request->type
        ]);
        if($user->save){
        return UserResource::collection($user);}
    }

    public function updatestore($id,Request $request){
    $user=User::FindOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>$request->password,
            'type' =>$request->type
        ]);
        if($user->save()){
            return UserResource::collection($user);
        }
    }

    public function delete($id){
        $user=User::FindOrFail($id);
       if($user->delete()) {
        return UserResource::collection($user);
       }
    }
}
