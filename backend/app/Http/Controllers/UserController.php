<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Projet;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    public function show($id)
    {
         $users=User::find($id);
        //  $projets=DB::table('projets')->where ('user_id' , $id)->get();
        //  $projets=Projet::find($id,'user_id')->get();
        return response()->json($users);
    }

    public function store(Request $request){
       $user= User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>$request->password
        ]);
        if($user->save){
        return response()->json($user);}
    }

    public function updatestore($id,Request $request){
    $user=User::find($id);
        $user->update([
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>$request->password
        ]);
        return response()->json($user);
    }

    public function delete($id){
        $user=User::find($id);
        $user->delete();
        return response()->json();
    }
}
