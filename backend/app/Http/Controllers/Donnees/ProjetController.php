<?php

namespace App\Http\Controllers\Donnees;

// use App\Models\Projet;

use Illuminate\Http\Request;
use App\Models\Donnees\Projet ;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProjetResource;

class ProjetController extends Controller
{
    public function getProjets()
    {
        $projets = DB::table('projets')
        ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
        ->get();
        // $projets =Projet::all()->electrique;
        return response()->json($projets);
        //  ProjetResource::collection($projets);
    }

    public function storeProjet(Request $request){
        // $user=Auth::user();
        $projet= Projet::create([
             'appareil' => $request->appareil,
             'reference' =>$request->reference,
             'client' =>$request->client,
             'refClient' =>$request->refClient,
             'temperatureMax' => $request->temperatureMax,
             'attitudeMax' =>$request->attitudeMax,
             'type' =>$request->type,
             'remplissage' => $request->remplissage,
             'installation' =>$request->installation,
             'montage' =>$request->montage,
             'echangeurs' =>$request->echangeurs,
             'dielectrique' =>$request->dielectrique,
             'fonctionnement' =>$request->fonctionnement,
             'refroidissement' =>$request->refroidissement,
             'user_id' =>$request->user_id,
            //  'user_id' =>$user->id,
            //  'elaborateur' =>$user->name,
             'electrique_id' =>$request->electrique_id
         ]);

         if($projet->save()){
             return new ProjetResource($projet);
         }

     }
 public function showProjet($id){
     $projet= Projet::FindOrFail($id);

    //  $projet = DB::table('projets')
    //  ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
    //  ->where('projets.id',$id)
    //  ->get();
     return new ProjetResource($projet);
 }
 public function editProjet($id, Request $request){
     $projet= Projet::FindOrFail($id);
     // request()->validate([
     //     'appareil'=>'required',
     //     'reference'=>'required',
     //     'elaborateur'=>'required',
     //     'client'=>'required',
     //     'refClient'=>'required'
     // ]);
     $projet->update([
         'appareil' => $request->appareil,
         'reference' =>$request->reference,
         'client' =>$request->client,
         'refClient' =>$request->refClient,
         'temperatureMax' => $request->temperatureMax,
         'attitudeMax' =>$request->attitudeMax,
         'type' =>$request->type,
         'remplissage' => $request->remplissage,
         'installation' =>$request->installation,
         'montage' =>$request->montage,
         'echangeurs' =>$request->echangeurs,
         'dielectrique' =>$request->dielectrique,
         'fonctionnement' =>$request->fonctionnement,
         'refroidissement' =>$request->refroidissement,
         'user_id' =>$request->user_id,
         'electrique_id' =>$request->electrique_id,

     ]);
    //  $userid=DB::table('users')->id;
    //  $user=DB::table('users')->where ($userid,'user_id')->get();

     if($projet->save()){
         return
         new ProjetResource($projet);
        //   [
        //      new ProjetResource($projet),
        //      new UserResource($user),
        //     ];
     }
 }
    public function deleteProjet($id){
        $projet= Projet::FindOrFail($id);
        if($projet->delete()){
            return new ProjetResource($projet);
        }
    }
    public function paginateProjets()
    {
        $projets =Projet::paginate(10);
        return ProjetResource::collection($projets);
    }
    public function getsearch($query)
    {
        // $projets =Projet::where('reference',$query)->get();
        $projets =Projet::where('reference','LIKE','%'.$query.'%')->get();
        return ProjetResource::collection($projets);
    }
}
