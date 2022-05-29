<?php

namespace App\Http\Controllers;
use App\Models\user\User;
use Illuminate\Support\Facades\DB;

class StatisiqueController extends Controller
{
    public function edit()
    {
        $users = DB::table('users')->get();
        $projets = DB::table('projets')->get();

        $userpending=DB::table('users')->where ('type' , 'En Attente')->get();
        $userAdmin=DB::table('users')->where ('type' , 'admin')->get();
        $userEmploye=DB::table('users')->where ('type' , 'employe')->get();
        $userInactive = DB::table('user_inactives')->get();
        $UserChart=[];
        $UserChart[0]=count($userEmploye);
        $UserChart[1]=count($userpending);
        $UserChart[2]=count($userAdmin);
        $UserChart[3]=count($userInactive);

        $usersname=[];
        $useradmin = User::where('type','admin')->get('name');
        $useremploye = User::where('type','employe')->get('name');
        foreach ($useradmin as $valeur){
                array_push($usersname, $valeur->name);
        }
        foreach ($useremploye as $valeur){
                array_push($usersname, $valeur->name);
        }
    $lengthUser=count($usersname);
        $userprojet=[];
        for($i=0;$i<$lengthUser;$i++){
            $projet = DB::table('projets')
            ->join('users', 'users.id', '=', 'projets.user_id')
            ->where('users.name',$usersname[$i])
            ->select('users.*','projets.*')
            ->get();
            $userprojet[$i]=count($projet);
        }
            return response()->json([
                'userCount' => count($users),
                        'projetCount' =>count($projets),
                        'UserChart' =>$UserChart,
                        'UserName' =>$usersname,
                        'UserProjet' =>$userprojet,
            ]
        );
    }
}
