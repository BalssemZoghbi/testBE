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
use App\Models\Donnees\Electrique;

class ProjetController extends Controller
{
    public function getProjets()
    {
        $projets = DB::table('projets')
        ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
        ->select('electriques.*','electriques.id as elec_id', 'projets.*')
        ->get();
        // $projets =Projet::all()->electrique;
        return response()->json($projets);
        //  ProjetResource::collection($projets);
    }

    public function storeProjet(){
        // $user=Auth::user();
        $elec=Electrique::create([
            "colonnes"=>  "3",
            "frequence"=> "60",
            "u1n"=> 3000,
            "u2o"=> 50000,
            "couplagePrimaire"=> "Y",
            "couplageSecondaire"=> "z",
            "indiceHoraire"=> "2",
            "priseSoustractive"=> 5,
            "priseAdditive"=> 5,
            "echelonSousctractive"=> 2.5,
            "echelonAdditive"=>2.5,
            "classeU1"=> 5,
            "classeU2"=>8,
            "puissance"=> 800,
            "couplage"=> "YN",
            "tenueFr1"=> 133,
            "tenueChoc1"=> 456,
            "tenueFr2"=> 235,
            "tenueChoc2"=> 123,
            "PrimaireUligne"=> 253,
            "PrimaireUPhase"=> 2300,
            "PrimaireIligne"=> 1200,
            "PrimaireIPhase"=> 300,
            "secondaireUligne"=> 2300,
            "secondaireUPhase"=> 8900,
            "secondaireIligne"=> 5600,
            "secondaireIPhase"=> 8500,
            "Uz"=> 0,
            "nbrePosition"=> 800

        ]);
        $projet= Projet::create([
             'appareil' => 'Defaut',
             'reference' =>'25/2022',
             'client' =>'STEG',
             'refClient' =>'108',
             'temperatureMax' => 60,
             'attitudeMax' =>5,
             'type' =>'sec',
             'remplissage' => 'integral',
             'installation' =>'interieur&exterieure',
             'montage' =>'sur pieds',
             'echangeurs' =>'ondes',
             'dielectrique' =>'huile minerale inhibée',
             'fonctionnement' =>'abaisseur',
             'refroidissement' =>'onaf',
             'user_id' =>'1',
            // dd(Auth::id()),
            //  'user_id' =>'Auth::id()',
            //  'elaborateur' =>Auth::user()->name,
             'elaborateur' =>'Ali Ben Aouicha',
             'electrique_id' =>$elec->id

         ]);

         if($projet->save()){
             return response()->json($projet);
         }

     }
 public function showProjet($id){
    //  $projet= Projet::FindOrFail($id);
     $projet = DB::table('projets')
        ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
        ->where('projets.id',$id)
        ->select('electriques.*','electriques.id as elec_id', 'projets.*')
        ->get()->first();
     return response()->json($projet);
 }
 public function editProjet($id, Request $request){
    //  $projet= Projet::FindOrFail($id);
     // request()->validate([
     //     'appareil'=>'required',
     //     'reference'=>'required',
     //     'elaborateur'=>'required',
     //     'client'=>'required',
     //     'refClient'=>'required'
     // ]);
     $projet=DB::table('projets')
     ->join('electriques','electriques.id','=','projets.electrique_id')
     ->where('projets.id',$id)
     ->update
    //  $projet->update
     ([
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
        //  'electrique_id' =>$request->electrique_id,

     ]);
    //  $userid=DB::table('users')->id;
    //  $user=DB::table('users')->where ($userid,'user_id')->get();

    //  if($projet->save()){
         return
         new ProjetResource($projet);
        //   [
        //      new ProjetResource($projet),
        //      new UserResource($user),
        //     ];
    //  }
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
