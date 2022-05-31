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
        $table = collect(['projets' => $projet, 'electriques' => $electrique, 'garanties' => $garantie, 'donnee_bobines' => $donnesBobines, 'gradins' => $gradin, 'bobinages' => $bobineMT, 'bobinage_secs' => $bobineBT, 'pcc_uccs' => $pcc, 'circuitmagnetiques' => $cm]);
        $filename = $id.".json";
        $handle = fopen($filename, 'w+');
        fputs($handle, $table->toJson(JSON_PRETTY_PRINT));
        fclose($handle);
        $headers = array('Content-type'=> 'application/json');
        return response()->download($filename, $id.'.json',$headers);
    }

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
