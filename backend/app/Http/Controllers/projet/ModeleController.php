<?php

namespace App\Http\Controllers\projet;

use App\Http\Controllers\Controller;
use App\Models\Donnees\bobinage\Bobinage;
use App\Models\Donnees\bobinage\BobinageSec;
use App\Models\Donnees\bobinage\DonneBobine;
use App\Models\Donnees\Circuitmagnetique;
use App\Models\Donnees\electrique\Electrique;
use App\Models\Donnees\garantie\Garantie;
use App\Models\Donnees\gradin\Gradin;
use App\Models\Donnees\PccUcc;
use App\Models\Donnees\Projet;
use App\Models\Donnees\VoltSpire;
use App\Models\Modele;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class ModeleController extends Controller
{
    public function index()
    {
        // $modele = DB::table('modeles')->get();
        $modele = DB::table('projets')
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
        ->select()
        ->get();
        return response()->json($modele);
    }
    public function getModele(){
        $tab=[];
        $modele=DB::table('modeles')->get('modele');
        foreach ($modele as $valeur){
            array_push($tab, $valeur->modele);
        }
        return response()->json($tab);
    }
    public function showModele($id)
    {
        $modele = DB::table('projets')
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
            ->select()
            ->get()->first();
        return response()->json($modele);
    }
    public function ProjetDevenirModele($id,Request $request)
    {
         DB::table('projets')
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
            ->select()
            ->get()->first();
            $modelecreate = Modele::create([
                'modele'=>$request->modele,
                'projets_id'=>$id,
            ]);
        return response()->json($modelecreate);
    }
    public function updateModele($id,Request $request)
    {
        $modele = DB::table('modeles')
            ->join('projets', 'projets.id', '=', 'modeles.projets_id')->where('modeles.projets_id', $id)
            ->select('modeles.*', 'modeles.id as modele_id','projets.*')
            ->get()->first();

            $projet1 = Modele::FindOrFail($modele->modele_id);
            $projet1->update([
                'modele'=>$request->modele,
                'projets_id'=>$modele->id,
            ]);
            $modele1 = DB::table('modeles')
            ->join('projets', 'projets.id', '=', 'modeles.projets_id')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('garanties', 'garanties.id', '=', 'projets.garantie_id')
            ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
            ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
            ->join('pcc_uccs', 'pcc_uccs.id', '=', 'projets.pcc_uccs_id')
            ->join('circuitmagnetiques', 'circuitmagnetiques.id', '=', 'projets.circuitmagnetiques_id')
            ->join('donne_bobines', 'donne_bobines.id', '=', 'projets.donne_bobines_id')
            ->select('modeles.*', 'modeles.id as modeles_id', 'electriques.*', 'electriques.id as elec_id','circuitmagnetiques.*', 'circuitmagnetiques.id as circuitmagnetiqus_id','donne_bobines.*', 'donne_bobines.id as donne_bob_id', 'garanties.*', 'garanties.id as garenti_id', 'bobinages.*', 'bobinages.id as bobine_id', 'bobinage_secs.*', 'bobinage_secs.id as bobinesec_id', 'gradins.*', 'gradins.id as gradins_id', 'volt_Spires.*', 'volt_Spires.id as volt_id', 'pcc_uccs.*', 'pcc_uccs.id as pucc_id', 'projets.*')
            ->where('modeles.id', $modele->modele_id)
            ->get()->first();
        return response()->json($modele1);
    }
    public function createModele(Request $request)
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
            'Pccgarantie' => null,
            'Uccr' => null,
            'Ucca' => null,
            'Ucc' => null,
            'Uccgarantie' => null,
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
            'I0' => null,
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

            $modele = Modele::create([
                'modele'=>$request->modele,
                'projets_id'=>$projet->id,
            ]);
        return response()->json($modele);
    }
    public function deleteModele($id)
    {

        $modele = Projet::FindOrFail($id);
        if ($modele->delete()) {
            return response()->json(['success' => 'Modele deleted successfully.']);
        }
    }
    public function ModeleProjetId()
    {
        $tab=[];
        $modele=DB::table('modeles')->get('projets_id');
        foreach ($modele as $valeur){
            array_push($tab, $valeur->projets_id);
        }
        return response()->json($tab);
    }
    public function ProjetModele($id,Request $request)
    {
        $modele = DB::table('projets')
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
        ->select()
        ->get()->first();
        $header = $request->header('Authorization');
        $token = PersonalAccessToken::findToken($header);
        $user = $token->tokenable;
        $elec = Electrique::create([
            "colonnes" =>  $modele->colonnes,
            "frequence" => $modele->frequence,
            "u1n" => $modele->u1n,
            "u2o" => $modele->u2o,
            "couplagePrimaire" => $modele->couplagePrimaire,
            "couplageSecondaire" => $modele->couplageSecondaire,
            "indiceHoraire" => $modele->indiceHoraire,
            "priseSoustractive" => $modele->priseSoustractive,
            "priseAdditive" => $modele->priseAdditive,
            "echelonSousctractive" => $modele->echelonSousctractive,
            "echelonAdditive" => $modele->echelonAdditive,
            "classeU1" => $modele->classeU1,
            "classeU2" => $modele->classeU2,
            "puissance" => $modele->puissance,
            "couplage" => $modele->couplage,
            "tenueFr1" => $modele->tenueFr1,
            "tenueChoc1" => $modele->tenueChoc1,
            "tenueFr2" => $modele->tenueFr2,
            "tenueChoc2" => $modele->tenueChoc2,
            "PrimaireUligne" => $modele->PrimaireUligne,
            "PrimaireUPhase" => $modele->PrimaireUPhase,
            "PrimaireIligne" => $modele->PrimaireIligne,
            "PrimaireIPhase" => $modele->PrimaireIPhase,
            "secondaireUligne" => $modele->secondaireUligne,
            "secondaireUPhase" => $modele->secondaireUPhase,
            "secondaireIligne" => $modele->secondaireIligne,
            "secondaireIPhase" => $modele->secondaireIPhase,
            "Uz" => $modele->Uz,
            "nbrePosition" => $modele->nbrePosition

        ]);
        $garantie = Garantie::create([
            "option" =>  $modele->option,
            'Pog' => $modele->Pog,
            'log' => $modele->log,
            'Pccg' => $modele->Pccg,
            'Uccg' => $modele->Uccg,
            'Ptot' => $modele->Ptot,
            'Poglimit' => $modele->Poglimit,
            'loglimit' => $modele->loglimit,
            'Pccglimit' => $modele->Pccglimit,
            'Uccglimit' => $modele->Uccglimit,
            'Ptotlimit' => $modele->Ptotlimit,
            'echauffementHuile' => $modele->echauffementHuile,
            'echauffementEnroulement' => $modele->echauffementEnroulement,

        ]);
        // dd($garantie->id);
        $Bobinage = Bobinage::create([
            'materiau' => $modele->materiau,
            'conducteur' => $modele->conducteur,
            'etageMT' => $modele->etageMT,
            'saillieMT' => $modele->saillieMT,
            'scu1' => $modele->scu1,
            'j1' => $modele->j1,
            'hbrin1MT' => $modele->hbrin1MT,
            'hbrin2MT' => $modele->hbrin2MT,
            'nbBrin1MT' => $modele->nbBrin1MT,
            'nbBrin2MT' => $modele->nbBrin2MT,
            'nbcoucheMT' => $modele->nbcoucheMT,
            'Hspire' => $modele->Hspire,
            'HSFS' => $modele->HSFS,
            'canauxMT' => $modele->canauxMT,
            'e1ax' => $modele->e1ax,
            'e1r' => $modele->e1r,
            'rigiditePapierMT' => $modele->rigiditePapierMT,
            'ep1PapierMT' => $modele->ep1PapierMT,
            'nbrPapierMT' => $modele->nbrPapierMT,
            'EpxMT' => $modele->EpxMT,
            'typeCanaux' => $modele->typeCanaux,
            'canauxMT' => $modele->canauxMT,
            'lgCales' => $modele->lgCales,
            'canauxEp1Papier' => $modele->canauxEp1Papier,
            'HFS' => $modele->HFS,
            'canauxNbrPapier' => $modele->canauxNbrPapier,
            'collierBT' => $modele->collierBT,
            'collierBT2' => $modele->collierBT2,
            'majPoid' => $modele->majPoid,
            'EpCylindre' => $modele->EpCylindre,
            'ep1PapierMT' => $modele->ep1PapierMT,
            'nbrPapierMT' => $modele->nbrPapierMT,
            'poidMT' => $modele->poidMT,
            'DintMT' => $modele->DintMT,
            'BintMT' => $modele->BintMT,
            'EpyMT' => $modele->EpyMT,
            'DextMT' => $modele->DextMT,
            'BextMT' => $modele->BextMT,
            'spCoucheMT' => $modele->spCoucheMT,
            'scu1d' => $modele->scu1d,
            'J1D' => $modele->J1D,
            'D1d' => $modele->D1d,
            'filobtenueNue' => $modele->filobtenueNue,
            'filobtenueIsoler' => $modele->filobtenueIsoler,
            'choix' => $modele->choix,
            'brinParallele' => $modele->brinParallele,
            'SpchB' => $modele->SpchB,
            'NchB' => $modele->NchB,
            'SpchA' => $modele->SpchA,
            'NchA' => $modele->NchA,
            'HCondMt' => $modele->HCondMt,
            'DistanceBTMT' => $modele->DistanceBTMT,
            'HCollier' => $modele->HCollier,
            'EpfeuillePapier' => $modele->EpfeuillePapier,
            'EpaiseurPapier' => $modele->EpaiseurPapier,
            'EpaisseurPapierCanaux' => $modele->EpaisseurPapierCanaux,

        ]);
        $BobinageSec = BobinageSec::create([
            'materiauSec' => $modele->materiauSec,
            'conducteurSec' => $modele->conducteurSec,
            'etageBT' => $modele->etageBT,
            'saillieBT' => $modele->saillieBT,
            'scu2' => $modele->scu2,
            'j2' => $modele->j2,
            'hbrin1BT' => $modele->hbrin1BT,
            'hbrin2BT' => $modele->hbrin2BT,
            'nbBrin1BT' => $modele->nbBrin1BT,
            'nbBrin2BT' => $modele->nbBrin2BT,
            'nbcoucheBT' => $modele->nbcoucheBT,
            'HbobineBtSec' => $modele->HbobineBtSec,
            'HspireBT' => $modele->HspireBT,
            'HSFSBT' => $modele->HSFSBT,
            'canauxBT' => $modele->canauxBT,
            'e2ax' => $modele->e2ax,
            'e2r' => $modele->e2r,
            'rigiditePapierBT' => $modele->rigiditePapierBT,
            'ep1PapierBT' => $modele->ep1PapierBT,
            'nbrPapierBT' => $modele->nbrPapierBT,
            'ePapBT' => $modele->ePapBT,
            'EpxBT' => $modele->EpxBT,
            'typeCanauxBT' => $modele->typeCanauxBT,
            'lgCalesBT' => $modele->lgCalesBT,
            'canauxEp1PapierBT' => $modele->canauxEp1PapierBT,
            'HFSBT' => $modele->HFSBT,
            'canauxNbrPapierBT' => $modele->canauxNbrPapierBT,
            'CMBTSec' => $modele->CMBTSec,
            'collierBT2Sec' => $modele->collierBT2Sec,
            'majPoidBT' => $modele->majPoidBT,
            'HfeuillardBT' => $modele->HfeuillardBT,
            'epFeuil1BT' => $modele->epFeuil1BT,
            'epFeuil2BT' => $modele->epFeuil2BT,
            'ep2PapierBT' => $modele->ep2PapierBT,
            'nbrPap2BT' => $modele->nbrPap2BT,
            'nbrPap1BT' => $modele->nbrPap1BT,
            'epFeuilPapBT' => $modele->epFeuilPapBT,
            'EpCylindreBT' => $modele->EpCylindreBT,
            'EpbarreBT' => $modele->EpbarreBT,
            'ep1PapierBT' => $modele->ep1PapierBT,
            'nbrPapierBT' => $modele->nbrPapierBT,
            'epFeuillardBT' => $modele->epFeuillardBT,
            'lgCalesBT' => $modele->lgCalesBT,
            'epaisseurBarreBT' => $modele->epaisseurBarreBT,
            'largeurBarreBT' => $modele->largeurBarreBT,
            'poidBT' => $modele->poidBT,
            'SbarreBT' => $modele->SbarreBT,
            'JbarreBT' => $modele->JbarreBT,
            'collierBTSec' => $modele->collierBTSec,
            'DintBT' => $modele->DintBT,
            'BintBT' => $modele->BintBT,
            'EpyBT' => $modele->EpyBT,
            'DextBT' => $modele->DextBT,
            'BextBT' => $modele->BextBT,
            'spCoucheBT' => $modele->spCoucheBT,

        ]);
        $gradin = Gradin::create([
            "tole" =>  $modele->tole,
            'diamPropose' => $modele->diamPropose,
            'diamNominale' => $modele->diamNominale,
            'pas' => $modele->pas,
            'coeffRemplissage' => $modele->coeffRemplissage,
            'nbrGradin' => $modele->nbrGradin,
            'demiGradin' => $modele->demiGradin,
            'largeur' => $modele->largeur,
            'epaisseur' => $modele->epaisseur,
            'Sbrut' => $modele->Sbrut,
            'Snette' => $modele->Snette,
            'EpaisseurTot' => $modele->EpaisseurTot,
            'largeurMin' => $modele->largeurMin,
            'CMBT' => $modele->CMBT,
        ]);
        $VoltSpire = VoltSpire::create([
            'Bmaxdesire' => $modele->Bmaxdesire,
            'Bmax' => $modele->Bmax,
            'Vsp' => $modele->Vsp,
            'N2c' => $modele->N2c,
            'N1c' =>  $modele->N1c,
            'prise' => $modele->prise,
            'spire' => $modele->spire
        ]);
        $pccUcc = PccUcc::create([
            'MajourationU' => $modele->MajourationU,
            'pcc1' => $modele->pcc1,
            'pcc2' => $modele->pcc2,
            'pccMaj' => $modele->pccMaj,
            'Pccgarantie' => $modele->Pccgarantie,
            'Uccr' => $modele->Uccr,
            'Ucca' => $modele->Ucca,
            'Ucc' => $modele->Ucc,
            'Uccgarantie' => $modele->Uccgarantie,
        ]);
        $circuitMagnetique = Circuitmagnetique::create([
            'masseFertot' => $modele->masseFertot,
            'Bmax' => $modele->Bmax,
            'pFerspecifique' => $modele->pFerspecifique,
            'Majferprop' => $modele->Majferprop,
            'tole' => $modele->tole,
            'Majfer' => $modele->Majfer,
            'pFer' => $modele->pFer,
            'pFergarantie' => $modele->pFergarantie,
            'Ex' => $modele->Ex,
            'Hc' => $modele->Hc,
            'E1' => $modele->E1,
            'E2' => $modele->E2,
            'E3' => $modele->E3,
            'E4' => $modele->E4,
            'Eh' => $modele->Eh,
            'Ebc' => $modele->Ebc,
            'Longeurcuve' => $modele->Longeurcuve,
            'Largeurcuve' => $modele->Largeurcuve,
            'LCM' => $modele->LCM,
            'masseFerCM' => $modele->masseFerCM,
            'surfaceCM' => $modele->surfaceCM,
            'Hauteurcuve' => $modele->Hauteurcuve,
        ]);
        $donnebobines=DonneBobine::create([
            'materiauMT' => $modele->materiauMT,
            'conducteurMT' => $modele->conducteurMT,
            'materiauBT' => $modele->materiauBT,
            'conducteurBT' => $modele->conducteurBT,
        ]);
        $projet = Projet::create([
            'appareil' => $modele->appareil,
            'reference' => $modele->reference,
            'client' => $modele->client,
            'refClient' => $modele->refClient,
            'temperatureMax' => $modele->temperatureMax,
            'attitudeMax' => $modele->attitudeMax,
            'type' => $modele->type,
            'remplissage' => $modele->remplissage,
            'installation' => $modele->installation,
            'montage' => $modele->montage,
            'echangeurs' => $modele->echangeurs,
            'dielectrique' => $modele->dielectrique,
            'fonctionnement' => $modele->fonctionnement,
            'refroidissement' => $modele->refroidissement,
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
    public function ProjetProjet($id,Request $request)
    {
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
        ->select('electriques.*', 'electriques.id as elec_id', 'circuitmagnetiques.*', 'circuitmagnetiques.id as circuitmagnetiqus_id','donne_bobines.*', 'donne_bobines.id as donne_bob_id', 'garanties.*', 'garanties.id as garenti_id', 'bobinages.*', 'bobinages.id as bobine_id', 'bobinage_secs.*', 'bobinage_secs.id as bobinesec_id', 'gradins.*', 'gradins.id as gradins_id', 'volt_Spires.*', 'volt_Spires.id as volt_id', 'pcc_uccs.*', 'pcc_uccs.id as pucc_id', 'projets.*')
        ->where('projets.id', $id)
        ->select()
        ->get()->first();
        $header = $request->header('Authorization');
        $token = PersonalAccessToken::findToken($header);
        $user = $token->tokenable;
        $elec = Electrique::create([
            "colonnes" =>  $projet->colonnes,
            "frequence" => $projet->frequence,
            "u1n" => $projet->u1n,
            "u2o" => $projet->u2o,
            "couplagePrimaire" => $projet->couplagePrimaire,
            "couplageSecondaire" => $projet->couplageSecondaire,
            "indiceHoraire" => $projet->indiceHoraire,
            "priseSoustractive" => $projet->priseSoustractive,
            "priseAdditive" => $projet->priseAdditive,
            "echelonSousctractive" => $projet->echelonSousctractive,
            "echelonAdditive" => $projet->echelonAdditive,
            "classeU1" => $projet->classeU1,
            "classeU2" => $projet->classeU2,
            "puissance" => $projet->puissance,
            "couplage" => $projet->couplage,
            "tenueFr1" => $projet->tenueFr1,
            "tenueChoc1" => $projet->tenueChoc1,
            "tenueFr2" => $projet->tenueFr2,
            "tenueChoc2" => $projet->tenueChoc2,
            "PrimaireUligne" => $projet->PrimaireUligne,
            "PrimaireUPhase" => $projet->PrimaireUPhase,
            "PrimaireIligne" => $projet->PrimaireIligne,
            "PrimaireIPhase" => $projet->PrimaireIPhase,
            "secondaireUligne" => $projet->secondaireUligne,
            "secondaireUPhase" => $projet->secondaireUPhase,
            "secondaireIligne" => $projet->secondaireIligne,
            "secondaireIPhase" => $projet->secondaireIPhase,
            "Uz" => $projet->Uz,
            "nbrePosition" => $projet->nbrePosition

        ]);
        $garantie = Garantie::create([
            "option" =>  $projet->option,
            'Pog' => $projet->Pog,
            'log' => $projet->log,
            'Pccg' => $projet->Pccg,
            'Uccg' => $projet->Uccg,
            'Ptot' => $projet->Ptot,
            'Poglimit' => $projet->Poglimit,
            'loglimit' => $projet->loglimit,
            'Pccglimit' => $projet->Pccglimit,
            'Uccglimit' => $projet->Uccglimit,
            'Ptotlimit' => $projet->Ptotlimit,
            'echauffementHuile' => $projet->echauffementHuile,
            'echauffementEnroulement' => $projet->echauffementEnroulement,

        ]);
        // dd($garantie->id);
        $Bobinage = Bobinage::create([
            'materiau' => $projet->materiau,
            'conducteur' => $projet->conducteur,
            'etageMT' => $projet->etageMT,
            'saillieMT' => $projet->saillieMT,
            'scu1' => $projet->scu1,
            'j1' => $projet->j1,
            'hbrin1MT' => $projet->hbrin1MT,
            'hbrin2MT' => $projet->hbrin2MT,
            'nbBrin1MT' => $projet->nbBrin1MT,
            'nbBrin2MT' => $projet->nbBrin2MT,
            'nbcoucheMT' => $projet->nbcoucheMT,
            'Hspire' => $projet->Hspire,
            'HSFS' => $projet->HSFS,
            'canauxMT' => $projet->canauxMT,
            'e1ax' => $projet->e1ax,
            'e1r' => $projet->e1r,
            'rigiditePapierMT' => $projet->rigiditePapierMT,
            'ep1PapierMT' => $projet->ep1PapierMT,
            'nbrPapierMT' => $projet->nbrPapierMT,
            'EpxMT' => $projet->EpxMT,
            'typeCanaux' => $projet->typeCanaux,
            'canauxMT' => $projet->canauxMT,
            'lgCales' => $projet->lgCales,
            'canauxEp1Papier' => $projet->canauxEp1Papier,
            'HFS' => $projet->HFS,
            'canauxNbrPapier' => $projet->canauxNbrPapier,
            'collierBT' => $projet->collierBT,
            'collierBT2' => $projet->collierBT2,
            'majPoid' => $projet->majPoid,
            'EpCylindre' => $projet->EpCylindre,
            'ep1PapierMT' => $projet->ep1PapierMT,
            'nbrPapierMT' => $projet->nbrPapierMT,
            'poidMT' => $projet->poidMT,
            'DintMT' => $projet->DintMT,
            'BintMT' => $projet->BintMT,
            'EpyMT' => $projet->EpyMT,
            'DextMT' => $projet->DextMT,
            'BextMT' => $projet->BextMT,
            'spCoucheMT' => $projet->spCoucheMT,
            'scu1d' => $projet->scu1d,
            'J1D' => $projet->J1D,
            'D1d' => $projet->D1d,
            'filobtenueNue' => $projet->filobtenueNue,
            'filobtenueIsoler' => $projet->filobtenueIsoler,
            'choix' => $projet->choix,
            'brinParallele' => $projet->brinParallele,
            'SpchB' => $projet->SpchB,
            'NchB' => $projet->NchB,
            'SpchA' => $projet->SpchA,
            'NchA' => $projet->NchA,
            'HCondMt' => $projet->HCondMt,
            'DistanceBTMT' => $projet->DistanceBTMT,
            'HCollier' => $projet->HCollier,
            'EpfeuillePapier' => $projet->EpfeuillePapier,
            'EpaiseurPapier' => $projet->EpaiseurPapier,
            'EpaisseurPapierCanaux' => $projet->EpaisseurPapierCanaux,

        ]);
        $BobinageSec = BobinageSec::create([
            'materiauSec' => $projet->materiauSec,
            'conducteurSec' => $projet->conducteurSec,
            'etageBT' => $projet->etageBT,
            'saillieBT' => $projet->saillieBT,
            'scu2' => $projet->scu2,
            'j2' => $projet->j2,
            'hbrin1BT' => $projet->hbrin1BT,
            'hbrin2BT' => $projet->hbrin2BT,
            'nbBrin1BT' => $projet->nbBrin1BT,
            'nbBrin2BT' => $projet->nbBrin2BT,
            'nbcoucheBT' => $projet->nbcoucheBT,
            'HbobineBtSec' => $projet->HbobineBtSec,
            'HspireBT' => $projet->HspireBT,
            'HSFSBT' => $projet->HSFSBT,
            'canauxBT' => $projet->canauxBT,
            'e2ax' => $projet->e2ax,
            'e2r' => $projet->e2r,
            'rigiditePapierBT' => $projet->rigiditePapierBT,
            'ep1PapierBT' => $projet->ep1PapierBT,
            'nbrPapierBT' => $projet->nbrPapierBT,
            'ePapBT' => $projet->ePapBT,
            'EpxBT' => $projet->EpxBT,
            'typeCanauxBT' => $projet->typeCanauxBT,
            'lgCalesBT' => $projet->lgCalesBT,
            'canauxEp1PapierBT' => $projet->canauxEp1PapierBT,
            'HFSBT' => $projet->HFSBT,
            'canauxNbrPapierBT' => $projet->canauxNbrPapierBT,
            'CMBTSec' => $projet->CMBTSec,
            'collierBT2Sec' => $projet->collierBT2Sec,
            'majPoidBT' => $projet->majPoidBT,
            'HfeuillardBT' => $projet->HfeuillardBT,
            'epFeuil1BT' => $projet->epFeuil1BT,
            'epFeuil2BT' => $projet->epFeuil2BT,
            'ep2PapierBT' => $projet->ep2PapierBT,
            'nbrPap2BT' => $projet->nbrPap2BT,
            'nbrPap1BT' => $projet->nbrPap1BT,
            'epFeuilPapBT' => $projet->epFeuilPapBT,
            'EpCylindreBT' => $projet->EpCylindreBT,
            'EpbarreBT' => $projet->EpbarreBT,
            'ep1PapierBT' => $projet->ep1PapierBT,
            'nbrPapierBT' => $projet->nbrPapierBT,
            'epFeuillardBT' => $projet->epFeuillardBT,
            'lgCalesBT' => $projet->lgCalesBT,
            'epaisseurBarreBT' => $projet->epaisseurBarreBT,
            'largeurBarreBT' => $projet->largeurBarreBT,
            'poidBT' => $projet->poidBT,
            'SbarreBT' => $projet->SbarreBT,
            'JbarreBT' => $projet->JbarreBT,
            'collierBTSec' => $projet->collierBTSec,
            'DintBT' => $projet->DintBT,
            'BintBT' => $projet->BintBT,
            'EpyBT' => $projet->EpyBT,
            'DextBT' => $projet->DextBT,
            'BextBT' => $projet->BextBT,
            'spCoucheBT' => $projet->spCoucheBT,

        ]);
        $gradin = Gradin::create([
            "tole" =>  $projet->tole,
            'diamPropose' => $projet->diamPropose,
            'diamNominale' => $projet->diamNominale,
            'pas' => $projet->pas,
            'coeffRemplissage' => $projet->coeffRemplissage,
            'nbrGradin' => $projet->nbrGradin,
            'demiGradin' => $projet->demiGradin,
            'largeur' => $projet->largeur,
            'epaisseur' => $projet->epaisseur,
            'Sbrut' => $projet->Sbrut,
            'Snette' => $projet->Snette,
            'EpaisseurTot' => $projet->EpaisseurTot,
            'largeurMin' => $projet->largeurMin,
            'CMBT' => $projet->CMBT,
        ]);
        $VoltSpire = VoltSpire::create([
            'Bmaxdesire' => $projet->Bmaxdesire,
            'Bmax' => $projet->Bmax,
            'Vsp' => $projet->Vsp,
            'N2c' => $projet->N2c,
            'N1c' =>  $projet->N1c,
            'prise' => $projet->prise,
            'spire' => $projet->spire
        ]);
        $pccUcc = PccUcc::create([
            'MajourationU' => $projet->MajourationU,
            'pcc1' => $projet->pcc1,
            'pcc2' => $projet->pcc2,
            'pccMaj' => $projet->pccMaj,
            'Pccgarantie' => $projet->Pccgarantie,
            'Uccr' => $projet->Uccr,
            'Ucca' => $projet->Ucca,
            'Ucc' => $projet->Ucc,
            'Uccgarantie' => $projet->Uccgarantie,
        ]);
        $circuitMagnetique = Circuitmagnetique::create([
            'masseFertot' => $projet->masseFertot,
            'Bmax' => $projet->Bmax,
            'pFerspecifique' => $projet->pFerspecifique,
            'Majferprop' => $projet->Majferprop,
            'tole' => $projet->tole,
            'Majfer' => $projet->Majfer,
            'pFer' => $projet->pFer,
            'pFergarantie' => $projet->pFergarantie,
            'Ex' => $projet->Ex,
            'Hc' => $projet->Hc,
            'E1' => $projet->E1,
            'E2' => $projet->E2,
            'E3' => $projet->E3,
            'E4' => $projet->E4,
            'Eh' => $projet->Eh,
            'Ebc' => $projet->Ebc,
            'Longeurcuve' => $projet->Longeurcuve,
            'Largeurcuve' => $projet->Largeurcuve,
            'LCM' => $projet->LCM,
            'masseFerCM' => $projet->masseFerCM,
            'surfaceCM' => $projet->surfaceCM,
            'Hauteurcuve' => $projet->Hauteurcuve,
        ]);
        $donnebobines=DonneBobine::create([
            'materiauMT' => $projet->materiauMT,
            'conducteurMT' => $projet->conducteurMT,
            'materiauBT' => $projet->materiauBT,
            'conducteurBT' => $projet->conducteurBT,
        ]);
        $projet = Projet::create([
            'appareil' => $projet->appareil,
            'reference' => $projet->reference,
            'client' => $projet->client,
            'refClient' => $projet->refClient,
            'temperatureMax' => $projet->temperatureMax,
            'attitudeMax' => $projet->attitudeMax,
            'type' => $projet->type,
            'remplissage' => $projet->remplissage,
            'installation' => $projet->installation,
            'montage' => $projet->montage,
            'echangeurs' => $projet->echangeurs,
            'dielectrique' => $projet->dielectrique,
            'fonctionnement' => $projet->fonctionnement,
            'refroidissement' => $projet->refroidissement,
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

}
