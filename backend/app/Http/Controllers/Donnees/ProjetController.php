<?php

namespace App\Http\Controllers\Donnees;

// use App\Models\Projet;

use Illuminate\Http\Request;
use App\Models\Donnees\Projet ;
use App\Models\Donnees\Electrique;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProjetResource;
use App\Models\Donnees\garantie\Garantie;
use Laravel\Sanctum\PersonalAccessToken;

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

    public function storeProjet(Request $request){
        $header = $request->header('Authorization');
        $token = PersonalAccessToken::findToken($header);
        $user = $token->tokenable;
        $elec=Electrique::create([
            "colonnes"=>  '4',
            "frequence"=> "50",
            "u1n"=> 160000,
            "u2o"=> 400,
            "couplagePrimaire"=> "Y",
            "couplageSecondaire"=> "z",
            "indiceHoraire"=> "1",
            "priseSoustractive"=> 5,
            "priseAdditive"=> 5,
            "echelonSousctractive"=> 2.5,
            "echelonAdditive"=>2.5,
            "classeU1"=> 170,
            "classeU2"=>1.1,
            "puissance"=> 630,
            "couplage"=> "Yz",
            "tenueFr1"=> 275,
            "tenueChoc1"=> 650,
            "tenueFr2"=> 3,
            "tenueChoc2"=> 0,
            "PrimaireUligne"=> 160000,
            "PrimaireUPhase"=> 92376.04307034012,
            "PrimaireIligne"=> 2.2733166849341515,
            "PrimaireIPhase"=> 2.2733166849341515,
            "secondaireUligne"=> 400,
            "secondaireUPhase"=> 230.94010767585033,
            "secondaireIligne"=> 909.3266739736606,
            "secondaireIPhase"=> 909.3266739736606,
            "Uz"=> 266.6666666666667,
            "nbrePosition"=> 11

        ]);
        $garantie=Garantie::create([
            "option"=>  'StandardTri24KV',
            'Pog' => 700,
            'log'=> 700,
            'Pccg'=> 700,
            'Uccg'=> 700,
            'Ptot'=> 700,
            'Poglimit'=> 700,
            'loglimit'=> 700,
            'Pccglimit'=> 700,
            'Uccglimit'=> 700,
            'Ptotlimit'=> 700,
            'echauffementHuile'=> 700,
            'echauffementEnroulement'=> 700,
        ]);
        // dd($garantie->id);
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
             'user_id' =>$user->id,
             'elaborateur' =>$user->name,
             'electrique_id' =>$elec->id,
             'garantie_id' =>$garantie->id
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
