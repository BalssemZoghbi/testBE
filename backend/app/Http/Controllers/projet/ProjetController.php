<?php

namespace App\Http\Controllers\projet;

// use App\Models\Projet;

use Illuminate\Http\Request;
use App\Models\Donnees\Projet;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\VoltspireController;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProjetResource;
use App\Models\Donnees\bobinage\Bobinage;
use App\Models\Donnees\bobinage\BobinageSec;
use App\Models\Donnees\bobinage\DonneBobine;
use App\Models\Donnees\Circuitmagnetique;
use App\Models\Donnees\electrique\Electrique;
use App\Models\Donnees\garantie\Garantie;
use App\Models\Donnees\gradin\Gradin;
use App\Models\Donnees\PccUcc;
use App\Models\Donnees\VoltSpire;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Laravel\Sanctum\PersonalAccessToken;

class ProjetController extends Controller
{
    public function getProjets()
    {
        $tab=[];
        $modele=DB::table('modeles')->get('projets_id');
        foreach ($modele as $valeur){
            array_push($tab, $valeur->projets_id);
        }
        $projet=[];
        $projets = DB::table('projets')->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
        ->join('donne_bobines', 'donne_bobines.id', '=', 'projets.donne_bobines_id')
        ->select('electriques.*', 'electriques.id as elec_id','donne_bobines.*', 'donne_bobines.id as donne_bob_id', 'projets.*')
        ->get();
        for($i=0;$i<count($projets);$i++){
            if(!in_array($projets[$i]->id,$tab)){
                array_push( $projet,$projets[$i]);
            }
        }
        return response()->json($projet);
    }
    public function exportJson($id){
        $projet = Projet::findOrFail($id);
        $electrique = Electrique::findOrFail($id);
        $garantie = Garantie::findOrFail($id);
        $donnesBobines = DonneBobine::findOrFail($id);
        $gradin = Gradin::findOrFail($id);
        $bobineMT = Bobinage::findOrFail($id);
        $bobineBT = BobinageSec::findOrFail($id);
        $pcc = PccUcc::findOrFail($id);
        $cm = Circuitmagnetique::findOrFail($id);
        $volts = VoltSpire::findOrFail($id);
        $table = collect(['projets' => $projet, 'electriques' => $electrique, 'garanties' => $garantie, 'donnee_bobines' => $donnesBobines, 'gradins' => $gradin, 'bobinages' => $bobineMT, 'bobinage_secs' => $bobineBT, 'pcc_uccs' => $pcc, 'circuitmagnetiques' => $cm,'volt_spires'=> $volts]);
        // $current_date_time = Carbon::now();
        $current_date_time = date("20y_m_d");
        $filename =$current_date_time."_". $id.".json";
        // dd($filename);
        $handle = fopen($filename, 'w+');
        fputs($handle, $table->toJson(JSON_PRETTY_PRINT));
        fclose($handle);
        $headers = array('Content-type'=> 'application/json');
        return response()->download($filename,$current_date_time.$id.'.json',$headers);
    }
    public function importJson(Request $request,$id){
        $header = $request->header('Authorization');
        $token = PersonalAccessToken::findToken($header);
        $user = $token->tokenable;
        $filename = $id.".json";
        $json =  file_get_contents(public_path() ."/".$filename);
        $data = json_decode($json);
        $array1 = (array) $data;
       $elec = Electrique::create([
            "colonnes" =>  $array1['electriques']->colonnes,
            "frequence" =>  $array1['electriques']->frequence,
            "u1n" =>  $array1['electriques']-> u1n,
            "u2o" =>  $array1['electriques']-> u2o,
            "couplagePrimaire" =>  $array1['electriques']-> couplagePrimaire,
            "couplageSecondaire" => $array1['electriques']-> couplageSecondaire,
            "indiceHoraire" =>  $array1['electriques']-> indiceHoraire,
            "priseSoustractive" =>  $array1['electriques']-> priseSoustractive,
            "priseAdditive" =>  $array1['electriques']-> priseAdditive,
            "echelonSousctractive" =>  $array1['electriques']-> echelonSousctractive,
            "echelonAdditive" =>  $array1['electriques']-> echelonAdditive,
            "classeU1" =>  $array1['electriques']-> classeU1,
            "classeU2" => $array1['electriques']-> classeU2,
            "puissance" => $array1['electriques']-> puissance,
            "couplage" => $array1['electriques']-> couplage,
            "tenueFr1" => $array1['electriques']-> tenueFr1,
            "tenueChoc1" => $array1['electriques']-> tenueChoc1,
            "tenueFr2" => $array1['electriques']-> tenueFr2,
            "tenueChoc2" => $array1['electriques']-> tenueChoc2,
            "PrimaireUligne" => $array1['electriques']-> PrimaireUligne,
            "PrimaireUPhase" => $array1['electriques']-> PrimaireUPhase,
            "PrimaireIligne" => $array1['electriques']-> PrimaireIligne,
            "PrimaireIPhase" => $array1['electriques']-> PrimaireIPhase,
            "secondaireUligne" => $array1['electriques']-> secondaireUligne,
            "secondaireUPhase" => $array1['electriques']-> secondaireUPhase,
            "secondaireIligne" => $array1['electriques']-> secondaireIligne,
            "secondaireIPhase" => $array1['electriques']-> secondaireIPhase,
            "Uz" => $array1['electriques']-> Uz,
            "nbrePosition" => $array1['electriques']-> nbrePosition,
        ]);
        // dd($elec->id);
        $garantie = Garantie::create([
        "option" => $array1['garanties']-> option,
        'Pog' =>  $array1['garanties']-> Pog,
        'log' => $array1['garanties']-> log,
        'Pccg' => $array1['garanties']-> Pccg,
        'Uccg' => $array1['garanties']-> Uccg,
        'Ptot' => $array1['garanties']-> Ptot,
        'Poglimit' => $array1['garanties']-> Poglimit,
        'loglimit' => $array1['garanties']-> loglimit,
        'Pccglimit' => $array1['garanties']-> Pccglimit,
        'Uccglimit' => $array1['garanties']-> Uccglimit,
        'Ptotlimit' => $array1['garanties']-> Ptotlimit,
        'echauffementHuile' => $array1['garanties']-> echauffementHuile,
        'echauffementEnroulement' => $array1['garanties']-> echauffementEnroulement,
]);
$donnebobines=DonneBobine::create([
            'materiauMT' => $array1['donnee_bobines']-> materiauMT,
            'conducteurMT' => $array1['donnee_bobines']-> conducteurMT,
            'materiauBT' => $array1['donnee_bobines']-> materiauBT,
            'conducteurBT' => $array1['donnee_bobines']-> conducteurBT,
        ]);
        // dd($donnebobines);
        $gradin = Gradin::create([
            "tole" =>  $array1['gradins']-> tole,
            'diamPropose' => $array1['gradins']-> diamPropose,
            'diamNominale' => $array1['gradins']-> diamNominale,
            'pas' => $array1['gradins']-> pas,
            'coeffRemplissage' => $array1['gradins']-> coeffRemplissage,
            'nbrGradin' => $array1['gradins']-> nbrGradin,
            'demiGradin' => $array1['gradins']-> demiGradin,
            'largeur' => $array1['gradins']-> largeur,
            'epaisseur' => $array1['gradins']-> epaisseur,
            'Sbrut' => $array1['gradins']-> Sbrut,
            'Snette' => $array1['gradins']-> Snette,
            'EpaisseurTot' => $array1['gradins']-> EpaisseurTot,
            'largeurMin' => $array1['gradins']-> largeurMin,
            'CMBT' => $array1['gradins']-> CMBT,
        ]);
        // dd($array1['volt_spires']);
        $VoltSpire = VoltSpire::create([
            'Bmaxdesire' => $array1['volt_spires']-> Bmaxdesire,
            'Bmax' => $array1['volt_spires']-> Bmax,
            'Vsp' => $array1['volt_spires']-> Vsp,
            'N2c' => $array1['volt_spires']-> N2c,
            'N1c' => $array1['volt_spires']-> N1c,
            'prise' =>$array1['volt_spires']->  prise,
            'spire' =>$array1['volt_spires']-> spire,
        ]);

        $pccUcc = PccUcc::create([
            'MajourationU' => $array1['pcc_uccs']-> MajourationU,
            'pcc1' => $array1['pcc_uccs']-> pcc1,
            'pcc2' => $array1['pcc_uccs']-> pcc2,
            'pccMaj' => $array1['pcc_uccs']-> pccMaj,
            'Pccg' => $array1['pcc_uccs']-> Pccg,
            'Uccr' => $array1['pcc_uccs']-> Uccr,
            'Ucca' => $array1['pcc_uccs']-> Ucca,
            'Ucc' => $array1['pcc_uccs']-> Ucc,
            'Uccg' => $array1['pcc_uccs']-> Uccg,
        ]);
        $Bobinage = Bobinage::create([
            'materiau' => $array1['bobinages']-> materiau,
            'conducteur' => $array1['bobinages']-> conducteur,
            'etageMT' => $array1['bobinages']-> etageMT,
            'saillieMT' => $array1['bobinages']-> saillieMT,
            'scu1' => $array1['bobinages']-> scu1,
            'j1' => $array1['bobinages']-> j1,
            'hbrin1MT' => $array1['bobinages']-> hbrin1MT,
            'hbrin2MT' => $array1['bobinages']-> hbrin2MT,
            'nbBrin1MT' => $array1['bobinages']-> nbBrin1MT,
            'nbBrin2MT' => $array1['bobinages']-> nbBrin2MT,
            'nbcoucheMT' => $array1['bobinages']-> nbcoucheMT,
            'Hspire' => $array1['bobinages']-> Hspire,
            'HSFS' => $array1['bobinages']-> HSFS,
            'canauxMT' => $array1['bobinages']-> canauxMT,
            'e1ax' => $array1['bobinages']-> e1ax,
            'e1r' => $array1['bobinages']-> e1r,
            'rigiditePapierMT' => $array1['bobinages']-> rigiditePapierMT,
            'ep1PapierMT' => $array1['bobinages']-> ep1PapierMT,
            'nbrPapierMT' => $array1['bobinages']-> nbrPapierMT,
            'EpxMT' => $array1['bobinages']-> EpxMT,
            'typeCanaux' => $array1['bobinages']-> typeCanaux,
            'canauxMT' => $array1['bobinages']-> canauxMT,
            'lgCales' => $array1['bobinages']-> lgCales,
            'canauxEp1Papier' => $array1['bobinages']-> canauxEp1Papier,
            'HFS' => $array1['bobinages']-> HFS,
            'canauxNbrPapier' => $array1['bobinages']-> canauxNbrPapier,
            'collierBT' => $array1['bobinages']-> collierBT,
            'collierBT2' => $array1['bobinages']-> collierBT2,
            'majPoid' => $array1['bobinages']-> majPoid,
            'EpCylindre' => $array1['bobinages']-> EpCylindre,
            'ep1PapierMT' => $array1['bobinages']-> ep1PapierMT,
            'nbrPapierMT' => $array1['bobinages']-> nbrPapierMT,
            'poidMT' => $array1['bobinages']-> poidMT,
            'DintMT' => $array1['bobinages']-> DintMT,
            'BintMT' => $array1['bobinages']-> BintMT,
            'EpyMT' => $array1['bobinages']-> EpyMT,
            'DextMT' => $array1['bobinages']-> DextMT,
            'BextMT' => $array1['bobinages']-> BextMT,
            'spCoucheMT' => $array1['bobinages']-> spCoucheMT,
            'scu1d' => $array1['bobinages']-> scu1d,
            'J1D' => $array1['bobinages']-> J1D,
            'D1d' => $array1['bobinages']-> D1d,
            'filobtenueNue' => $array1['bobinages']-> filobtenueNue,
            'filobtenueIsoler' => $array1['bobinages']-> filobtenueIsoler,
            'choix' => $array1['bobinages']-> choix,
            'brinParallele' => $array1['bobinages']-> brinParallele,
            'SpchB' => $array1['bobinages']-> SpchB,
            'NchB' => $array1['bobinages']-> NchB,
            'SpchA' => $array1['bobinages']-> SpchA,
            'NchA' => $array1['bobinages']-> NchA,
            'HCondMt' => $array1['bobinages']-> HCondMt,
            'DistanceBTMT' => $array1['bobinages']-> DistanceBTMT,
            'HCollier' => $array1['bobinages']-> HCollier,
            'EpfeuillePapier' => $array1['bobinages']-> EpfeuillePapier,
            'EpaiseurPapier' => $array1['bobinages']-> EpaiseurPapier,
            'EpaisseurPapierCanaux' => $array1['bobinages']-> EpaisseurPapierCanaux,

        ]);
        $BobinageSec = BobinageSec::create([
            'materiauSec' =>  $array1['bobinage_secs']-> materiauSec,
            'conducteurSec' =>  $array1['bobinage_secs']-> conducteurSec,
            'etageBT' =>  $array1['bobinage_secs']-> etageBT,
            'saillieBT' =>  $array1['bobinage_secs']-> saillieBT,
            'scu2' =>  $array1['bobinage_secs']-> scu2,
            'j2' =>  $array1['bobinage_secs']-> j2,
            'hbrin1BT' =>  $array1['bobinage_secs']-> hbrin1BT,
            'hbrin2BT' =>  $array1['bobinage_secs']-> hbrin2BT,
            'nbBrin1BT' =>  $array1['bobinage_secs']-> nbBrin1BT,
            'nbBrin2BT' =>  $array1['bobinage_secs']-> nbBrin2BT,
            'nbcoucheBT' =>  $array1['bobinage_secs']-> nbcoucheBT,
            'HbobineBtSec' =>  $array1['bobinage_secs']-> HbobineBtSec,
            'HspireBT' =>  $array1['bobinage_secs']-> HspireBT,
            'HSFSBT' =>  $array1['bobinage_secs']-> HSFSBT,
            'canauxBT' =>  $array1['bobinage_secs']-> canauxBT,
            'e2ax' =>  $array1['bobinage_secs']-> e2ax,
            'e2r' =>  $array1['bobinage_secs']-> e2r,
            'rigiditePapierBT' =>  $array1['bobinage_secs']-> rigiditePapierBT,
            'ep1PapierBT' =>  $array1['bobinage_secs']-> ep1PapierBT,
            'nbrPapierBT' =>  $array1['bobinage_secs']-> nbrPapierBT,
            'ePapBT' =>  $array1['bobinage_secs']-> ePapBT,
            'EpxBT' =>  $array1['bobinage_secs']-> EpxBT,
            'typeCanauxBT' =>  $array1['bobinage_secs']-> typeCanauxBT,
            'lgCalesBT' =>  $array1['bobinage_secs']-> lgCalesBT,
            'canauxEp1PapierBT' =>  $array1['bobinage_secs']-> canauxEp1PapierBT,
            'HFSBT' =>  $array1['bobinage_secs']-> HFSBT,
            'canauxNbrPapierBT' =>  $array1['bobinage_secs']-> canauxNbrPapierBT,
            'CMBTSec' =>  $array1['bobinage_secs']-> CMBTSec,
            'collierBT2Sec' =>  $array1['bobinage_secs']-> collierBT2Sec,
            'majPoidBT' =>  $array1['bobinage_secs']-> majPoidBT,
            'HfeuillardBT' =>  $array1['bobinage_secs']-> HfeuillardBT,
            'epFeuil1BT' =>  $array1['bobinage_secs']-> epFeuil1BT,
            'epFeuil2BT' =>  $array1['bobinage_secs']-> epFeuil2BT,
            'ep2PapierBT' =>  $array1['bobinage_secs']-> ep2PapierBT,
            'nbrPap2BT' =>  $array1['bobinage_secs']-> nbrPap2BT,
            'nbrPap1BT' =>  $array1['bobinage_secs']-> nbrPap1BT,
            'epFeuilPapBT' =>  $array1['bobinage_secs']-> epFeuilPapBT,
            'EpCylindreBT' =>  $array1['bobinage_secs']-> EpCylindreBT,
            'EpbarreBT' =>  $array1['bobinage_secs']-> EpbarreBT,
            'ep1PapierBT' =>  $array1['bobinage_secs']-> ep1PapierBT,
            'nbrPapierBT' =>  $array1['bobinage_secs']-> nbrPapierBT,
            'epFeuillardBT' =>  $array1['bobinage_secs']-> epFeuillardBT,
            'lgCalesBT' =>  $array1['bobinage_secs']-> lgCalesBT,
            'epaisseurBarreBT' =>  $array1['bobinage_secs']-> epaisseurBarreBT,
            'largeurBarreBT' =>  $array1['bobinage_secs']-> largeurBarreBT,
            'poidBT' =>  $array1['bobinage_secs']-> poidBT,
            'SbarreBT' =>  $array1['bobinage_secs']-> SbarreBT,
            'JbarreBT' =>  $array1['bobinage_secs']-> JbarreBT,
            'collierBTSec' =>  $array1['bobinage_secs']-> collierBTSec,
            'DintBT' =>  $array1['bobinage_secs']-> DintBT,
            'BintBT' =>  $array1['bobinage_secs']-> BintBT,
            'EpyBT' =>  $array1['bobinage_secs']-> EpyBT,
            'DextBT' =>  $array1['bobinage_secs']-> DextBT,
            'BextBT' =>  $array1['bobinage_secs']-> BextBT,
            'spCoucheBT' =>  $array1['bobinage_secs']-> spCoucheBT,

        ]);
        $circuitMagnetique = Circuitmagnetique::create([
            'masseFertot' => $array1['circuitmagnetiques']-> masseFertot,
            'Bmax' => $array1['circuitmagnetiques']-> Bmax,
            'pFerspecifique' => $array1['circuitmagnetiques']-> pFerspecifique,
            'Majferprop' => $array1['circuitmagnetiques']-> Majferprop,
            'tole' => $array1['circuitmagnetiques']-> tole,
            'Majfer' => $array1['circuitmagnetiques']-> Majfer,
            'pFer' => $array1['circuitmagnetiques']-> pFer,
            'pFergarantie' => $array1['circuitmagnetiques']-> pFergarantie,
            'Ex' => $array1['circuitmagnetiques']-> Ex,
            'Hc' => $array1['circuitmagnetiques']-> Hc,
            'E1' => $array1['circuitmagnetiques']-> E1,
            'E2' => $array1['circuitmagnetiques']-> E2,
            'E3' => $array1['circuitmagnetiques']-> E3,
            'E4' => $array1['circuitmagnetiques']-> E4,
            'Eh' => $array1['circuitmagnetiques']-> Eh,
            'Ebc' => $array1['circuitmagnetiques']-> Ebc,
            'Longeurcuve' => $array1['circuitmagnetiques']-> Longeurcuve,
            'Largeurcuve' => $array1['circuitmagnetiques']-> Largeurcuve,
            'LCM' => $array1['circuitmagnetiques']-> LCM,
            'masseFerCM' => $array1['circuitmagnetiques']-> masseFerCM,
            'surfaceCM' => $array1['circuitmagnetiques']-> surfaceCM,
            'Hauteurcuve' => $array1['circuitmagnetiques']-> Hauteurcuve,
        ]);

           DB::table('projets')->insert([
            'appareil' =>  $array1['projets']->appareil,
            'reference' => $array1['projets']->reference,
            'client' =>  $array1['projets']->client,
            'refClient' => $array1['projets']->refClient,
            'temperatureMax' => $array1['projets']->temperatureMax,
            'attitudeMax' =>  $array1['projets']->attitudeMax ,
            'type' =>  $array1['projets']->type,
            'remplissage' =>  $array1['projets']->remplissage ,
            'installation' =>  $array1['projets']->installation,
            'montage' =>  $array1['projets']->montage ,
            'echangeurs' =>  $array1['projets']->echangeurs,
            'dielectrique' =>  $array1['projets']->dielectrique,
            'fonctionnement' =>  $array1['projets']->fonctionnement,
            'refroidissement' =>  $array1['projets']->refroidissement,
            'elaborateur' => $user->name,

            'user_id' => $user->id,

            'electrique_id' => $elec->id,
            'garantie_id' => $garantie-> id,
            'bobinage_id' => $Bobinage->id,
            'gradin_id' =>  $gradin->id ,
            'bobinage_secs_id' => $BobinageSec->id,
            'volt_spires_id' =>$VoltSpire->id,
            'pcc_uccs_id' => $pccUcc->id,
            'circuitmagnetiques_id' =>$circuitMagnetique->id ,
            'donne_bobines_id' => $donnebobines->id ,
            // 'user_id' => $array1['projets']->user_id,

            // 'electrique_id' => $array1['projets']->electrique_id,
            // 'garantie_id' => $array1['projets']->garantie_id ,
            // 'bobinage_id' => $array1['projets']->bobinage_id ,
            // 'gradin_id' => $array1['projets']->bobinage_id ,
            // 'bobinage_secs_id' => $array1['projets']->bobinage_secs_id,
            // 'volt_spires_id' => $array1['projets']->volt_spires_id,
            // 'pcc_uccs_id' => $array1['projets']->pcc_uccs_id ,
            // 'circuitmagnetiques_id' => $array1['projets']->circuitmagnetiques_id ,
            // 'donne_bobines_id' => $array1['projets']->donne_bobines_id ,
            ]);

            // $productId = (isset($product['sku']) ? $product['sku'] : null);

            // foreach to import into table products_related
            // foreach ($product['relatedProducts'] as $relatedProducts) {
            //     DB::table('products_related')->insert([
            //         'productId' => $productId,
            //         'sku' => ((isset($relatedProducts['sku']) ? $relatedProducts['sku'] : null))
            //     ]);
            // }
        // }


    }
    // public function importJson($id){
    //     $projet = Projet::findOrFail($id);
    //     $electrique = Electrique::findOrFail($id);
    //     $garantie = Garantie::findOrFail($id);
    //     $donnesBobines = DonneBobine::findOrFail($id);
    //     $gradin = Gradin::findOrFail($id);
    //     $bobineMT = Bobinage::findOrFail($id);
    //     $bobineBT = BobinageSec::findOrFail($id);
    //     $pcc = PccUcc::findOrFail($id);
    //     $cm = Circuitmagnetique::findOrFail($id);
    //     $table = collect(['projets' => $projet, 'electriques' => $electrique, 'garanties' => $garantie, 'donnee_bobines' => $donnesBobines, 'gradins' => $gradin, 'bobinages' => $bobineMT, 'bobinage_secs' => $bobineBT, 'pcc_uccs' => $pcc, 'circuitmagnetiques' => $cm]);
    //     $table = json_decode(file_get_contents(public_path() ."/".$id.".json"), true);
    //     echo "<pre>";
    //     print_r($table);
    // }
    public function addProjet(Request $request)
    {
        $header = $request->header('Authorization');
        $token = PersonalAccessToken::findToken($header);
        $user = $token->tokenable;
        $elec = Electrique::create([
            "colonnes" =>  null,
            "frequence" => null,
            "u1n" => null,
            "u2o" => null,
            "couplagePrimaire" => "",
            "couplageSecondaire" => "",
            "indiceHoraire" => null,
            "priseSoustractive" => null,
            "priseAdditive" => null,
            "echelonSousctractive" => null,
            "echelonAdditive" => null,
            "classeU1" => null,
            "classeU2" => null,
            "puissance" => null,
            "couplage" => null,
            "tenueFr1" => null,
            "tenueChoc1" => null,
            "tenueFr2" => null,
            "tenueChoc2" => null,
            "PrimaireUligne" => null,
            "PrimaireUPhase" => null,
            "PrimaireIligne" => null,
            "PrimaireIPhase" => null,
            "secondaireUligne" => null,
            "secondaireUPhase" => null,
            "secondaireIligne" => null,
            "secondaireIPhase" => null,
            "Uz" => null,
            "nbrePosition" => null

        ]);
        $garantie = Garantie::create([
            "option" =>  '',
            'Pog' => null,
            'log' => null,
            'Pccg' => null,
            'Uccg' => null,
            'Ptot' => null,
            'Poglimit' => null,
            'loglimit' => null,
            'Pccglimit' => null,
            'Uccglimit' => null,
            'Ptotlimit' => null,
            'echauffementHuile' => null,
            'echauffementEnroulement' => null,

        ]);
        // dd($garantie->id);
        $Bobinage = Bobinage::create([
            'materiau' => null,
            'conducteur' => null,
            'etageMT' => null,
            'saillieMT' => null,
            'scu1' => null,
            'j1' => null,
            'hbrin1MT' => null,
            'hbrin2MT' => null,
            'nbBrin1MT' => null,
            'nbBrin2MT' => null,
            'nbcoucheMT' => null,
            'Hspire' => null,
            'HSFS' => null,
            'canauxMT' => null,
            'e1ax' => null,
            'e1r' => null,
            'rigiditePapierMT' => null,
            'ep1PapierMT' => null,
            'nbrPapierMT' => null,
            'EpxMT' => null,
            'typeCanaux' => null,
            'canauxMT' => null,
            'lgCales' => null,
            'canauxEp1Papier' => null,
            'HFS' => null,
            'canauxNbrPapier' => null,
            'collierBT' => null,
            'collierBT2' => null,
            'majPoid' => null,
            'EpCylindre' => null,
            'ep1PapierMT' => null,
            'nbrPapierMT' => null,
            'poidMT' => null,
            'DintMT' => null,
            'BintMT' => null,
            'EpyMT' => null,
            'DextMT' => null,
            'BextMT' => null,
            'spCoucheMT' => null,
            'scu1d' => null,
            'J1D' => null,
            'D1d' => null,
            'filobtenueNue' => null,
            'filobtenueIsoler' => null,
            'choix' => null,
            'brinParallele' => null,
            'SpchB' => null,
            'NchB' => null,
            'SpchA' => null,
            'NchA' => null,
            'HCondMt' => null,
            'DistanceBTMT' => null,
            'HCollier' => null,
            'EpfeuillePapier' => null,
            'EpaiseurPapier' => null,
            'EpaisseurPapierCanaux' => null,

        ]);
        $BobinageSec = BobinageSec::create([
            'materiauSec' => null,
            'conducteurSec' => null,
            'etageBT' => null,
            'saillieBT' => null,
            'scu2' => null,
            'j2' => null,
            'hbrin1BT' => null,
            'hbrin2BT' => null,
            'nbBrin1BT' => null,
            'nbBrin2BT' => null,
            'nbcoucheBT' => null,
            'HbobineBtSec' => null,
            'HspireBT' => null,
            'HSFSBT' => null,
            'canauxBT' => null,
            'e2ax' => null,
            'e2r' => null,
            'rigiditePapierBT' => null,
            'ep1PapierBT' => null,
            'nbrPapierBT' => null,
            'ePapBT' => null,
            'EpxBT' => null,
            'typeCanauxBT' => null,
            'lgCalesBT' => null,
            'canauxEp1PapierBT' => null,
            'HFSBT' => null,
            'canauxNbrPapierBT' => null,
            'CMBTSec' => null,
            'collierBT2Sec' => null,
            'majPoidBT' => null,
            'HfeuillardBT' => null,
            'epFeuil1BT' => null,
            'epFeuil2BT' => null,
            'ep2PapierBT' => null,
            'nbrPap2BT' => null,
            'nbrPap1BT' => null,
            'epFeuilPapBT' => null,
            'EpCylindreBT' => null,
            'EpbarreBT' => null,
            'ep1PapierBT' => null,
            'nbrPapierBT' => null,
            'epFeuillardBT' => null,
            'lgCalesBT' => null,
            'epaisseurBarreBT' => null,
            'largeurBarreBT' => null,
            'poidBT' => null,
            'SbarreBT' => null,
            'JbarreBT' => null,
            'collierBTSec' => null,
            'DintBT' => null,
            'BintBT' => null,
            'EpyBT' => null,
            'DextBT' => null,
            'BextBT' => null,
            'spCoucheBT' => null,

        ]);
        // $BobinageSec=BobinageSec::create([
        //     'materiauSec'=> 'cuivrenull,
        //     'conducteurSec'=> 'meplat guipe'
        // ]);
        $gradin = Gradin::create([
            "tole" =>  null,
            'diamPropose' => null,
            'diamNominale' => null,
            'pas' => null,
            'coeffRemplissage' => null,
            'nbrGradin' => null,
            'demiGradin' => null,
            'largeur' => null,
            'epaisseur' => null,
            'Sbrut' => null,
            'Snette' => null,
            'EpaisseurTot' => null,
            'largeurMin' => null,
            'CMBT' => null,
        ]);
        $VoltSpire = VoltSpire::create([
            'Bmaxdesire' => null,
            'Bmax' => null,
            'Vsp' => null,
            'N2c' => null,
            'N1c' =>  null,
            'prise' => null,
            'spire' => null
        ]);
        $pccUcc = PccUcc::create([
            'MajourationU' => null,
            'pcc1' => null,
            'pcc2' => null,
            'pccMaj' => null,
            'Pccg' => null,
            'Uccr' => null,
            'Ucca' => null,
            'Ucc' => null,
            'Uccg' => null,
        ]);
        $circuitMagnetique = Circuitmagnetique::create([
            'masseFertot' => null,
            'Bmax' => null,
            'pFerspecifique' => null,
            'Majferprop' => null,
            'tole' => 'gg',
            'Majfer' => null,
            'pFer' => null,
            'pFergarantie' => null,
            'Ex' => null,
            'Hc' => null,
            'E1' => null,
            'E2' => null,
            'E3' => null,
            'E4' => null,
            'Eh' => null,
            'Ebc' => null,
            'Longeurcuve' => null,
            'Largeurcuve' => null,
            'LCM' => null,
            'masseFerCM' => null,
            'surfaceCM' => null,
            'Hauteurcuve' => null,
        ]);
        $donnebobines=DonneBobine::create([
            'materiauMT' => null,
            'conducteurMT' => null,
            'materiauBT' => null,
            'conducteurBT' => null,
        ]);
        $projet = Projet::create([
            'appareil' => '',
            'reference' => null,
            'client' => null,
            'refClient' => null,
            'temperatureMax' => null,
            'attitudeMax' => null,
            'type' => null,
            'remplissage' => null,
            'installation' => null,
            'montage' => null,
            'echangeurs' => null,
            'dielectrique' => null,
            'fonctionnement' => null,
            'refroidissement' => null,
            'user_id' => $user->id,
            'elaborateur' => $user->name,
            'electrique_id' => $elec->id,
            'garantie_id' => $garantie->id,
            'bobinage_id' => $Bobinage->id,
            'gradin_id' => $gradin->id,
            'bobinage_secs_id' => $BobinageSec->id,
            'volt_spires_id' => $VoltSpire->id,
            'pcc_uccs_id' => $pccUcc->id,
            'circuitmagnetiques_id' => $circuitMagnetique->id,
            'donne_bobines_id' => $donnebobines->id,

        ]);

        if ($projet->save()) {
            return response()->json($projet);
        }
    }


    public function showProjet($id)
    {
        //  $projet= Projet::FindOrFail($id);
        $tab=[];
        $modele=DB::table('modeles')->get('projets_id');
        foreach ($modele as $valeur){
            array_push($tab, $valeur->projets_id);
        }
        if(in_array($id, $tab)){
            $projet = DB::table('projets')
            ->join('modeles', 'modeles.projets_id', '=', 'projets.id')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('garanties', 'garanties.id', '=', 'projets.garantie_id')
            ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
            ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
            ->join('pcc_uccs', 'pcc_uccs.id', '=', 'projets.pcc_uccs_id')
            ->join('circuitmagnetiques', 'circuitmagnetiques.id', '=', 'projets.circuitmagnetiques_id')
            ->join('donne_bobines', 'donne_bobines.id', '=', 'projets.donne_bobines_id')
            ->select('electriques.*', 'electriques.id as elec_id', 'circuitmagnetiques.*', 'circuitmagnetiques.id as circuitmagnetiqus_id','donne_bobines.*', 'donne_bobines.id as donne_bob_id', 'garanties.*', 'garanties.id as garenti_id', 'bobinages.*', 'bobinages.id as bobine_id', 'bobinage_secs.*', 'bobinage_secs.id as bobinesec_id', 'gradins.*', 'gradins.id as gradins_id', 'volt_Spires.*', 'volt_Spires.id as volt_id', 'pcc_uccs.*', 'pcc_uccs.id as pucc_id', 'projets.*')
            ->where('projets.id', $id)
            ->get()->first();
        }else{
        $projet = DB::table('projets')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('garanties', 'garanties.id', '=', 'projets.garantie_id')
            ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
            ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
            ->join('pcc_uccs', 'pcc_uccs.id', '=', 'projets.pcc_uccs_id')
            ->join('circuitmagnetiques', 'circuitmagnetiques.id', '=', 'projets.circuitmagnetiques_id')
            ->join('donne_bobines', 'donne_bobines.id', '=', 'projets.donne_bobines_id')
            ->where('projets.id', $id)
            ->select('electriques.*', 'electriques.id as elec_id', 'circuitmagnetiques.*', 'circuitmagnetiques.id as circuitmagnetiqus_id','donne_bobines.*', 'donne_bobines.id as donne_bob_id', 'garanties.*', 'garanties.id as garenti_id', 'bobinages.*', 'bobinages.id as bobine_id', 'bobinage_secs.*', 'bobinage_secs.id as bobinesec_id', 'gradins.*', 'gradins.id as gradins_id', 'volt_Spires.*', 'volt_Spires.id as volt_id', 'pcc_uccs.*', 'pcc_uccs.id as pucc_id', 'projets.*')
            ->get()->first();
        }

        return response()->json($projet);
    }
    public function editProjet($id, Request $request)
    {
        $header = $request->header('Authorization');
        $token = PersonalAccessToken::findToken($header);
        $user = $token->tokenable;
        $projet = DB::table('projets')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('garanties', 'garanties.id', '=', 'projets.garantie_id')
            ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
            ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
            ->join('pcc_uccs', 'pcc_uccs.id', '=', 'projets.pcc_uccs_id')
            ->join('circuitmagnetiques', 'circuitmagnetiques.id', '=', 'projets.circuitmagnetiques_id')
            ->join('donne_bobines', 'donne_bobines.id', '=', 'projets.donne_bobines_id')
            ->where('projets.id', $id)
            ->select('electriques.*', 'electriques.id as elec_id', 'circuitmagnetiques.*', 'circuitmagnetiques.id as circuitmagnetiqus_id','donne_bobines.*', 'donne_bobines.id as donne_bob_id', 'garanties.*', 'garanties.id as garenti_id', 'bobinages.*', 'bobinages.id as bobine_id', 'bobinage_secs.*', 'bobinage_secs.id as bobinesec_id', 'gradins.*', 'gradins.id as gradins_id', 'volt_Spires.*', 'volt_Spires.id as volt_id', 'pcc_uccs.*', 'pcc_uccs.id as pucc_id', 'projets.*')
            ->get()->first();
        $projet1 = Projet::FindOrFail($id);
        $projet1->update([
                'appareil' => $request->appareil,
                'reference' => $request->reference,
                'client' => $request->client,
                'refClient' => $request->refClient,
                'temperatureMax' => $request->temperatureMax,
                'attitudeMax' => $request->attitudeMax,
                'type' => $request->type,
                'remplissage' => $request->remplissage,
                'installation' => $request->installation,
                'montage' => $request->montage,
                'echangeurs' => $request->echangeurs,
                'dielectrique' => $request->dielectrique,
                'fonctionnement' => $request->fonctionnement,
                'refroidissement' => $request->refroidissement,
                'user_id' => $user->id,
                'elaborateur' => $user->name,
                'electrique_id' => $projet->elec_id,
                'garantie_id' => $projet->garenti_id,
                'bobinage_id' => $projet->bobine_id,
                'gradin_id' => $projet->gradins_id,
                'bobinage_secs_id' => $projet->bobinesec_id,
                'volt_spires_id' => $projet->volt_id,
                'pcc_uccs_id' => $projet->pucc_id,
                'circuitmagnetiques_id' => $projet->circuitmagnetiqus_id,
                'donne_bobines_id' => $projet->donne_bob_id,

            ]);
        return new ProjetResource($projet1);
    }

    public function deleteProjet($id)
    {
        $projet = Projet::FindOrFail($id);
        if ($projet->delete()) {
            return new ProjetResource($projet);
        }
    }
}
