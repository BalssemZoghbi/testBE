<?php

namespace App\Http\Controllers;

use App\Models\Statisique;
use App\Models\user\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisiqueController extends Controller
{
    public function getStatisique()
    {
        $statisique = Statisique::all();
        return response()->json($statisique);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Statisique  $statisique
     * @return \Illuminate\Http\Response
     */
    public function edit(Statisique $statisique)
    {
        $users = DB::table('users')->get();
        $projets = DB::table('projets')->get();

        $userpending=DB::table('users')->where ('type' , 'pending')->get();
        $userAdmin=DB::table('users')->where ('type' , 'admin')->get();
        $userEmploye=DB::table('users')->where ('type' , 'employe')->get();
        $userInactive = DB::table('user_inactives')->get();
        $UserChart=[];
        $UserChart[0]=count($userEmploye);
        $UserChart[1]=count($userpending);
        $UserChart[2]=count($userAdmin);
        $UserChart[3]=count($userInactive);

        // $usersname = DB::table('users')->get('name');
        $usersname=[];
        $useradmin = User::where('type','admin')->get('name');
        $useremploye = User::where('type','employe')->get('name');
        foreach ($useradmin as $valeur){
                array_push($usersname, $valeur->name);
        }
        foreach ($useremploye as $valeur){
                array_push($usersname, $valeur->name);
        }

//         $userprojet=[];
//         for($i=0;$i<count($usersname);$i++){
//             $user=User::where('name',$usersname[$i])->get()->first();

//         $userprojet[$i] = DB::table('projets')->where('user_id',$user->id)->get('id');
//  dd(count($userprojet));
//         }




        // $userProj=0;
        // $projet = DB::table('projets')
        // ->join('users', 'users.id', '=', 'projets.user_id')
        // // ->where('users.name',$usersname)
        // ->select('users.*','projets.*')
        // ->get()->first();
        // for($i=0;$i<count($usersname);$i++){
        //     $projet = DB::table('projets')
        // ->join('users', 'users.id', '=', 'projets.user_id')
        // ->where('users.name',$usersname[$i])
        // ->select('users.*','projets.*')
        // ->get()->first();
        // // if($usersname[$i]==$projet->name){
        // //     $userProj+=1;}
        // //     $UserProjet[$i]=$userProj;
        // }
        // dd($projet);


        $stat= Statisique::create([
            'userCount' => count($users),
            'projetCount' =>count($projets),
            'UserChart' =>$UserChart,
            'UserName' =>$usersname,
            'UserProjet' =>[],
        ]);
        if($stat->save()){
            return response()->json($stat);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Statisique  $statisique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statisique $statisique)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Statisique  $statisique
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statisique $statisique)
    {
        //
    }
}