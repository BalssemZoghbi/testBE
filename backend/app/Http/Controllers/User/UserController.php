<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\UserResource;
use App\Models\user\User;
use App\Models\user\UserInactive;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    public function show($id)
    {
         $users=User::FindOrFail($id);
        //  $projets=DB::table('projets')->where ('user_id' , $id)->get();
        //  $projets=Projet::find($id,'user_id')->get();
        return response()->json($users);
    }
    public function getup()
    {
        $users=DB::table('users')->where ('type' , 'En Attente')->get();
        return $users;

    }
    public function getuser()
    {
        $users=DB::table('users')
        ->whereIn ('type' ,['admin','employe'])
        ->get();

        return $users;

    }

    public function store(Request $request){
       $user= User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'type' =>$request->type,
            'poste' =>$request->poste,
            'numero' =>$request->numero
        ]);
        // if($user->save){
        return response()->json($user);
    // }
    }

    public function updatestore($id,Request $request){
    $user=User::FindOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'type' =>$request->type,
            'poste' =>$request->poste,
            'numero' =>$request->numero
        ]);
            return response()->json($user);
    }
    public function updateprofile($id,Request $request){
    $user=User::FindOrFail($id);
    $type = $user->getOriginal('type');
        $user->update([
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'type'=>$type,
            'poste' =>$request->poste,
            'numero' =>$request->numero
        ]);
            return response()->json($user);
    }

    public function delete($id){
        $user=User::FindOrFail($id);
        $userr = UserInactive::create(['name' => $user->name, 'email' => $user->email,'type'=>'Bloqué', 'password' => $user->password,'poste' => $user->poste,'numero' => $user->numero,]);

       if($user->delete()) {
        return response()->json($userr);;
       }
       $auth=Auth::user();
       if($auth){
        return response()->json('error');
       }
    }

    //user inactive
    public function indexinactive()
    {
        $users = UserInactive::all();
        return response()->json($users);
    }
    public function showinactive($id)
    {
         $users=UserInactive::FindOrFail($id);
        return response()->json($users);
    }
    public function addinactive(Request $request){
        $user= UserInactive::create([
             'name' => $request->name,
             'email' =>$request->email,
             'password' =>Hash::make($request->password),
             'type' =>$request->type,
             'poste' =>$request->poste,
             'numero' =>$request->numero
         ]);
         return response()->json($user);
     }
     public function updateinactive($id,Request $request){
        $user=UserInactive::FindOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' =>$request->email,
                'password' =>Hash::make($request->password),
                'type' =>$request->type,
                'poste' =>$request->poste,
                'numero' =>$request->numero
            ]);
                return response()->json($user);
        }
        public function deleteinactive($id){
            $user=UserInactive::FindOrFail($id);
           if($user->delete()) {
            return 'User deleted successfully';
           }
        }
}
