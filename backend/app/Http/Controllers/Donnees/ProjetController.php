<?php

namespace App\Http\Controllers\Donnees;

// use App\Models\Projet;

use Illuminate\Http\Request;
use App\Models\Donnees\Projet ;
use App\Models\Donnees\Electrique;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\VoltspireController;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProjetResource;
use App\Models\Donnees\garantie\Garantie;
use App\Models\Bobinage;
use App\Models\Gradin;
use App\Models\VoltSpire;
use App\Models\BobinageSec;
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
        // $elec=new ElectriqueController();
        // $elec->store();
        // dd($elec->id);
        $elec=Electrique::create([
            "colonnes"=>  '3',
            "frequence"=> "50",
            "u1n"=> 30000,
            "u2o"=> 420,
            "couplagePrimaire"=> "D",
            "couplageSecondaire"=> "yn",
            "indiceHoraire"=> "11",
            "priseSoustractive"=> 2,
            "priseAdditive"=> 2,
            "echelonSousctractive"=> 2.5,
            "echelonAdditive"=>2.5,
            "classeU1"=> 36,
            "classeU2"=>1.1,
            "puissance"=> 250,
            "couplage"=> "Dyn11",
            "tenueFr1"=> 70,
            "tenueChoc1"=> 170,
            "tenueFr2"=> 3,
            "tenueChoc2"=> 0,
            "PrimaireUligne"=> 30000,
            "PrimaireUPhase"=> 30000,
            "PrimaireIligne"=> 4.81,
            "PrimaireIPhase"=> 2.78,
            "secondaireUligne"=> 420,
            "secondaireUPhase"=> 242,
            "secondaireIligne"=> 344,
            "secondaireIPhase"=> 344,
            "Uz"=> 0,
            "nbrePosition"=> 5

        ]);
        $garantie=Garantie::create([
            "option"=>  'StandardTri36KV',
            'Pog' => 700,
            'log'=> 3.5,
            'Pccg'=> 3600,
            'Uccg'=> 4,
            'Ptot'=> 4300,
            'Poglimit'=> 805,
            'loglimit'=> 455,
            'Pccglimit'=> 4140,
            'Uccglimit'=> 4.4,
            'Ptotlimit'=> 5423,
            'echauffementHuile'=> 50,
            'echauffementEnroulement'=> 55,
        ]);
        // dd($garantie->id);
        $Bobinage=Bobinage::create([
            'materiau'=> 'cuivre',
            'conducteur'=> 'Rond emaille'

        ]);
        $BobinageSec=BobinageSec::create([
            'materiauSec'=> 'cuivre',
            'conducteurSec'=> 'meplat guipe'
        ]);
        $gradin=Gradin::create([
            "tole"=>  'H95-27',
            'diamPropose' =>160,
            'diamNominale'=> 198,
            'pas'=> "20",
            'coeffRemplissage'=> 0.965,
            'nbrGradin'=> 8,
            'demiGradin'=> 0,
            'largeur'=> [190,170,150,130,110,90,70,50],
            'epaisseur'=> '[55.71355310873648,
                            45.795067214859685,
                            27.73533504763192,
                            20.101282249527685,
                            15.287687397297645,
                            11.730336462335401,
                            8.850128964254793,
                            6.369489792605151]',
            'Sbrut'=> 28819.56287921049,
            'Snette'=> 27666.78036404207,
            'EpaisseurTot'=> 191.58288023724876,
            'largeurMin' => 50
        ]);
        $VoltSpire=VoltSpire::create([
            'Bmaxdesire'=>1.82,
            'Bmax'=> 1.793,
            'Vsp'=> 11.022,
            'N2c'=> 22,
            'N1c'=>  2721.79,
            'prise' => '[
                "Prise+2",
                "Prise+1",
                "Prise+0",
                "Prise-1",
                "Prise-2"
            ]',
            'spire' => '[
                2722,
                2722,
                2722,
                2722,
                2722,
                2722
            ]'
        ]);
        // $volt=new VoltspireController();
        // $volt->updateVoltSpire()
        $projet= Projet::create([
             'appareil' => 'Transfo Triphasé',
             'reference' =>'Pc 25/2022',
             'client' =>'STEG',
             'refClient' =>'AD 2850/2022 du 25/05/2022',
             'temperatureMax' => 50,
             'attitudeMax' =>1000,
             'type' =>'cabine',
             'remplissage' => 'integral',
             'installation' =>'interieure',
             'montage' =>'sur galets',
             'echangeurs' =>'ondes',
             'dielectrique' =>'huile minerale non inhibée',
             'fonctionnement' =>'abaisseur',
             'refroidissement' =>'onan',
             'user_id' =>$user->id,
             'elaborateur' =>$user->name,
             'electrique_id' =>$elec->id,
             'garantie_id' =>$garantie->id,
             'bobinage_id'=>$Bobinage->id,
             'gradin_id'=>$gradin->id,
             'bobinage_secs_id'=>$BobinageSec->id,
             'volt_spires_id'=>$VoltSpire->id,
         ]);

         if($projet->save()){
             return response()->json($projet);
         }

     }
 public function showProjet($id){
    //  $projet= Projet::FindOrFail($id);
        $projet = DB::table('projets')
        ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
        ->join('garanties', 'garanties.id', '=', 'projets.garantie_id')
        ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
        ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
        ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
        ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
        ->where('projets.id',$id)
        ->select('electriques.*','electriques.id as elec_id','garanties.*','garanties.id as garenti_id','bobinages.*','bobinages.id as bobine_id','bobinage_secs.*','bobinage_secs.id as bobinesec_id','gradins.*','gradins.id as gradins_id','volt_Spires.*','volt_Spires.id as volt_id', 'projets.*')
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
