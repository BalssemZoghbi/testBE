<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use App\Http\Resources\ProjetResource;

class ProjetController extends Controller
{
    public function getProjets()
    {
        $projets =Projet::all();
        return ProjetResource::collection($projets);
    }

    public function storeProjet(Request $request){

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
             'user_id' =>$request->user_id
         ]);

         if($projet->save()){
             return new ProjetResource($projet);
         }

     }
 public function showProjet($id){
     $projet= Projet::FindOrFail($id);
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
