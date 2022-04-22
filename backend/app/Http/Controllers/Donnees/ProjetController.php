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
use  App\Models\PccUcc;

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

    public function addProjet(Request $request){
        $header = $request->header('Authorization');
        $token = PersonalAccessToken::findToken($header);
        $user = $token->tokenable;
        $elec=Electrique::create([
            "colonnes"=>  $request,
            "frequence"=> $request,
            "u1n"=>$request,
            "u2o"=>$request,
            "couplagePrimaire"=> $request,
            "couplageSecondaire"=> $request,
            "indiceHoraire"=> $request,
            "priseSoustractive"=>$request,
            "priseAdditive"=>$request,
            "echelonSousctractive"=> $request,
            "echelonAdditive"=>$request,
            "classeU1"=>$request,
            "classeU2"=>$request,
            "puissance"=>$request,
            "couplage"=> $request,
            "tenueFr1"=>$request,
            "tenueChoc1"=>$request,
            "tenueFr2"=>$request,
            "tenueChoc2"=>$request,
            "PrimaireUligne"=>$request,
            "PrimaireUPhase"=>$request,
            "PrimaireIligne"=> $request,
            "PrimaireIPhase"=> $request,
            "secondaireUligne"=>$request,
            "secondaireUPhase"=>$request,
            "secondaireIligne"=>$request,
            "secondaireIPhase"=>$request,
            "Uz"=>$request,
            "nbrePosition"=> $request

        ]);
        $garantie=Garantie::create([
            "option"=>  'StandardTri36KV',
            'Pog' =>$request,
            'log'=> $request,
            'Pccg'=>$request,
            'Uccg'=>$request,
            'Ptot'=>$request,
            'Poglimit'=>$request,
            'loglimit'=>$request,
            'Pccglimit'=>$request,
            'Uccglimit'=> $request,
            'Ptotlimit'=>$request,
            'echauffementHuile'=>$request,
            'echauffementEnroulement'=>$request,
        ]);
        // dd($garantie->id);
        $Bobinage=Bobinage::create([
            'materiau'=>$request,
            'conducteur'=> $request,
            'etageMT'=>$request,
            'saillieMT'=>$request,
            'scu1'=>$request,
            'j1'=>$request,
            'hbrin1MT'=>$request,
            'hbrin2MT'=>$request,
            'nbBrin1MT'=>$request,
            'nbBrin2MT'=>$request,
            'nbcoucheMT'=>$request,
            'Hspire'=>$request,
            'HSFS'=>$request,
            'canauxMT'=>$request,
            'e1ax'=>$request,
            'e1r'=>$request,
            'rigiditePapierMT'=>$request,
            'ep1PapierMT'=>$request,
            'nbrPapierMT'=>$request,
            'EpxMT'=>$request,
            'typeCanaux'=>$request,
            'canauxBt'=>$request,
            'lgCales'=>$request,
            'canauxEp1Papier'=>$request,
            'HFS'=>$request,
            'canauxNbrPapier'=>$request,
            'collierBT'=>$request,
            'collierBT2'=>$request,
            'majPoid'=>$request,
            'EpCylindre'=>$request,
            'ep1Papier'=>$request,
            'nbrPapier'=>$request,
            'canauxBt'=>$request,
            'lgCales'=>$request,
            'poidMT'=>$request,
            'collierBT'=>$request,
            'CMBT'=>$request,
            'DintMT'=>$request,
            'BintMT'=>$request,
            'EpyMT'=>$request,
            'DextMT'=>$request,
            'BextMT'=>$request,
            'majPoid'=>$request,
            'sp/coucheMT'=>$request,
            'scu1d'=>$request,
            'J1D'=>$request,
            'D1d'=>$request,
            'filobtenueNue'=>$request,
            'filobtenueIsoler'=>$request,
            'choix'=>$request,
            'brinParallele'=>$request,
            'SpchB'=>$request,
            'NchB'=>$request,
            'SpchA'=>$request,
            'NchA'=>$request,
            'HCondMt'=>$request,
            'DistanceBTMT'=>$request,
            'HCollier'=>$request,
            'EpfeuillePapier'=>$request,
            'EpaiseurPapier'=>$request,
            'EpaisseurPapierCanaux'=>$request,

        ]);
        $BobinageSec=BobinageSec::create([
            'materiauSec'=>$request,
            'conducteurSec'=> $request,
            'etage'=>$request,
            'saillie'=>$request,
            'scu2'=>$request,
            'j2'=>$request,
            'hbrin1'=>$request,
            'hbrin2'=>$request,
            'nbBrin1'=>$request,
            'nbBrin2'=>$request,
            'nbcouche'=>$request,
            'Hspire'=>$request,
            'HSFS'=>$request,
            'canauxBT'=>$request,
            'e2ax'=>$request,
            'e2r'=>$request,
            'rigiditePapier'=>$request,
            'ep1Papier'=>$request,
            'nbrPapier'=>$request,
            'ePap'=>$request,
            'Epx'=>$request,
            'typeCanaux'=>$request,
            'canauxBt'=>$request,
            'lgCales'=>$request,
            'canauxEp1Papier'=>$request,
            'HFS'=>$request,
            'canauxNbrPapier'=>$request,
            'collierBT'=>$request,
            'CMBT'=>$request,
            'collierBT2'=>$request,
            'majPoid'=>$request,
            'Hfeuillard'=>$request,
            'epFeuil1'=>$request,
            'epFeuil2'=>$request,
            'ep2Papier'=>$request,
            'nbrPap2'=>$request,
            'nbrPap1'=>$request,
            'epFeuilPap'=>$request,
            'EpCylindre'=>$request,
            'Epbarre'=>$request,
            'ep1Papier'=>$request,
            'nbrPapier'=>$request,
            'canauxBt'=>$request,
            'epFeuillard'=>$request,
            'lgCales'=>$request,
            'epaisseurBarre'=>$request,
            'largeurBarre'=>$request,
            'poidBT'=>$request,
            'Sbarre'=>$request,
            'Jbarre'=>$request,
            'collierBT'=>$request,
            'CMBT'=>$request,
            'HBOBT'=>$request,
            'Dint'=>$request,
            'Bint'=>$request,
            'Epy'=>$request,
            'DextBT'=>$request,
            'Bext'=>$request,
            'majPoid'=>$request,
            'sp/couche'=>5

        ]);
        // $BobinageSec=BobinageSec::create([
        //     'materiauSec'=> 'cuivre$request,
        //     'conducteurSec'=> 'meplat guipe'
        // ]);
        $gradin=Gradin::create([
            "tole"=>  $request,
            'diamPropose' =>$request,
            'diamNominale'=>$request,
            'pas'=> $request,
            'coeffRemplissage'=> $request,
            'nbrGradin'=>$request,
            'demiGradin'=>$request,
            'largeur'=> $request,
            'epaisseur'=> $request,
            'Sbrut'=>$request,
            'Snette'=> $request,
            'EpaisseurTot'=> $request,
            'largeurMin' => $request
        ]);
        $VoltSpire=VoltSpire::create([
            'Bmaxdesire'=>$request,
            'Bmax'=> $request,
            'Vsp'=> $request,
            'N2c'=>$request,
            'N1c'=>  $request,
            'prise' => $request,
            'spire' => $request
        ]);
        $pccUcc=PccUcc::create([
            'MajourationU'=>$request,
            'pcc1'=>$request,
            'pcc2'=>$request,
            'pccMaj'=>$request,
            'Pccg'=>$request,
            'Uccr'=>$request,
            'Ucca'=>$request,
            'Ucc'=>$request,
            'Uccg'=>$request,
        ]);
        // $volt=new VoltspireController();
        // $volt->updateVoltSpire()
        $projet= Projet::create([
             'appareil' => 'Transfo Triphasé',
             'reference' =>$request,
             'client' =>$request,
             'refClient' =>$request,
             'temperatureMax' => $request,
             'attitudeMax' =>$request,
             'type' =>$request,
             'remplissage' => $request,
             'installation' =>$request,
             'montage' => $request,
             'echangeurs' =>$request,
             'dielectrique' =>$request,
             'fonctionnement' =>$request,
             'refroidissement' =>$request,
             'user_id' =>$user->id,
             'elaborateur' =>$user->name,
             'electrique_id' =>$elec->id,
             'garantie_id' =>$garantie->id,
             'bobinage_id'=>$Bobinage->id,
             'gradin_id'=>$gradin->id,
             'bobinage_secs_id'=>$BobinageSec->id,
             'volt_spires_id'=>$VoltSpire->id,
             'pcc_uccs_id'=>$pccUcc->id,
         ]);

         if($projet->save()){
             return response()->json($projet);
         }

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
            "u2o"=> 400,
            "couplagePrimaire"=> "D",
            "couplageSecondaire"=> "yn",
            "indiceHoraire"=> "11",
            "priseSoustractive"=> 2,
            "priseAdditive"=> 2,
            "echelonSousctractive"=> 2.5,
            "echelonAdditive"=>2.5,
            "classeU1"=> 36,
            "classeU2"=>1.1,
            "puissance"=> 630,
            "couplage"=> "YNyn0",
            "tenueFr1"=> 70,
            "tenueChoc1"=> 170,
            "tenueFr2"=> 3,
            "tenueChoc2"=> 0,
            "PrimaireUligne"=> 30000,
            "PrimaireUPhase"=> 30000,
            "PrimaireIligne"=>  12.12,
            "PrimaireIPhase"=> 7,
            "secondaireUligne"=> 400,
            "secondaireUPhase"=> 231,
            "secondaireIligne"=> 909,
            "secondaireIPhase"=> 909,
            "Uz"=> 0,
            "nbrePosition"=> 5

        ]);
        $garantie=Garantie::create([
            "option"=>  'StandardTri36KV',
            'Pog' => 1600,
            'log'=> 2.9,
            'Pccg'=> 8820,
            'Uccg'=> 4.5,
            'Ptot'=> 10420,
            'Poglimit'=> 1840,
            'loglimit'=> 3.77,
            'Pccglimit'=> 10143,
            'Uccglimit'=> 4.95,
            'Ptotlimit'=> 11462,
            'echauffementHuile'=> 50,
            'echauffementEnroulement'=> 55,
        ]);
        // dd($garantie->id);
        $Bobinage=Bobinage::create([
            'materiau'=>'cuivre',
            'conducteur'=> 'Rond emaille',
            'etageMT'=>null,
            'saillieMT'=>null,
            'scu1'=>4.5,
            'j1'=>4.5,
            'hbrin1MT'=>null,
            'hbrin2MT'=>null,
            'nbBrin1MT'=>null,
            'nbBrin2MT'=>null,
            'nbcoucheMT'=>12,
            'Hspire'=>null,
            'HSFS'=>null,
            'canauxMT'=>3,
            'e1ax'=>null,
            'e1r'=>null,
            'rigiditePapierMT'=>10000,
            'ep1PapierMT'=>null,
            'nbrPapierMT'=>7,
            'EpxMT'=>45.8,
            'typeCanaux'=>'complet',
            'canauxBt'=>null,
            'lgCales'=>3,
            'canauxEp1Papier'=>null,
            'HFS'=>null,
            'canauxNbrPapier'=>null,
            'collierBT'=>null,
            'collierBT2'=>null,
            'majPoid'=>5,
            'EpCylindre'=>1,
            'ep1Papier'=>null,
            'nbrPapier'=>null,
            'poidMT'=>282.16,
            'CMBT'=>null,
            'DintMT'=>286.94,
            'BintMT'=>291.94,
            'EpyMT'=>45.83,
            'DextMT'=>378.62,
            'BextMT'=>383.62,
            'sp/coucheMT'=>null,
            'scu1d'=>3.5,
            'J1D'=>2,
            'D1d'=>2.11,
            'filobtenueNue'=>2.12,
            'filobtenueIsoler'=>2.22,
            'choix'=>'automatique',
            'brinParallele'=>1,
            'SpchB'=>228,
            'NchB'=>4,
            'SpchA'=>227,
            'NchA'=>8,
            'HCondMt'=>506.16,
            'DistanceBTMT'=>15,
            'HCollier'=>-28,
            'EpfeuillePapier'=>0.15,
            'EpaiseurPapier'=>1.05,
            'EpaisseurPapierCanaux'=>0.6,

        ]);
        $BobinageSec=BobinageSec::create([
            'materiauSec'=>'cuivre',
            'conducteurSec'=> 'feuillard',
            'etage'=>null,
            'saillie'=>null,
            'scu2'=>231,
            'j2'=>3.9,
            'hbrin1'=>null,
            'hbrin2'=>null,
            'nbBrin1'=>null,
            'nbBrin2'=>null,
            'nbcouche'=>null,
            'Hspire'=>null,
            'HSFS'=>null,
            'canauxBT'=>22,
            'e2ax'=>null,
            'e2r'=>null,
            'rigiditePapier'=>10000,
            'ep1Papier'=>0.065,
            'nbrPapier'=>1,
            'ePap'=>0.13,
            'Epx'=>22.47,
            'typeCanaux'=>'complet',
            'lgCales'=>3,
            'canauxEp1Papier'=>null,
            'HFS'=>null,
            'canauxNbrPapier'=>null,
            'collierBT'=>15,
            'CMBT'=>4,
            'collierBT2'=>15,
            'majPoid'=>5,
            'Hfeuillard'=>420,
            'epFeuil1'=>0.55,
            'epFeuil2'=>0,
            'ep2Papier'=>0.065,
            'nbrPap2'=>1,
            'nbrPap1'=>1,
            'epFeuilPap'=>0.13,
            'EpCylindre'=>1,
            'Epbarre'=>'5*50',
            'ep1Papier'=>0.065,
            'nbrPapier'=>1,
            'canauxBt'=>3,
            'epFeuillard'=>0.55,
            'epaisseurBarre'=>5,
            'largeurBarre'=>50,
            'poidBT'=>95.9,
            'Sbarre'=>250,
            'Jbarre'=>0.08,
            'collierBT'=>15,
            'HBOBT'=>null,
            'Dint'=>212,
            'Bint'=>212,
            'Epy'=>22.47,
            'DextBT'=>256.94,
            'Bext'=>261.94,
            'majPoid'=>5,
            'HbobineBt'=>450,
            'sp/couche'=>null

        ]);
        // $BobinageSec=BobinageSec::create([
        //     'materiauSec'=> 'cuivre',
        //     'conducteurSec'=> 'meplat guipe'
        // ]);
        $gradin=Gradin::create([
            "tole"=>  'H95-27',
            'diamPropose' =>204,
            'diamNominale'=> 198,
            'pas'=> "20",
            'coeffRemplissage'=> 0.96,
            'nbrGradin'=> 8,
            'demiGradin'=> 1,
            'largeur'=> [190,170,150,130,110,90,70,50],
            'epaisseur'=> [74.26977851050857,38.49546436157502,25.495380589551345,18.95260753372372,14.588980864675335,11.271543768674292,8.540440087579924,3.081728608752556],
            'Sbrut'=> 30468.863427581993,
            'Snette'=> 29250.108890478714,
            'EpaisseurTot'=> 197.77765293379332,
            'largeurMin' => 70
        ]);
        $VoltSpire=VoltSpire::create([
            'Bmaxdesire'=>1.82,
            'Bmax'=> 1.77,
            'Vsp'=> 11.547,
            'N2c'=> 20,
            'N1c'=>  2597.4,
            'prise' => ["Prise+2","Prise+1","Prise+0","Prise-1","Prise-2" ],
            'spire' => [ 2728,2663,2598,2533,2468]
        ]);
        $pccUcc=PccUcc::create([
            'MajourationU'=>6,
            'pcc1'=>1554,
            'pcc2'=>1156,
            'pccMaj'=>2710,
            'Pccg'=>2600,
            'Uccr'=>3.84,
            'Ucca'=>1.69,
            'Ucc'=>4.2,
            'Uccg'=>4,
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
             'pcc_uccs_id'=>$pccUcc->id,
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
        ->join('pcc_uccs', 'pcc_uccs.id', '=', 'projets.pcc_uccs_id')
        ->where('projets.id',$id)
        ->select('electriques.*','electriques.id as elec_id','garanties.*','garanties.id as garenti_id','bobinages.*','bobinages.id as bobine_id','bobinage_secs.*','bobinage_secs.id as bobinesec_id','gradins.*','gradins.id as gradins_id','volt_Spires.*','volt_Spires.id as volt_id','pcc_uccs.*','pcc_uccs.id as pucc_id', 'projets.*')
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
