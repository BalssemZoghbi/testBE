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
        $modele = DB::table('modeles')->get();
        return response()->json($modele);
    }
    public function showModele($id)
    {
        $modele = DB::table('modeles')
            ->join('projets', 'projets.id', '=', 'modeles.projets_id')
            ->where('modeles.id', $id)
            ->select()
            ->get()->first();
        return response()->json($modele);
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
        $reference = "PC " . date("m/d/y");
        $projet = Projet::create([
            'appareil' => '',
            'reference' => $reference,
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
        $modele = Modele::FindOrFail($id);
        if ($modele->delete()) {
            return response()->json($modele);
        }
    }
}
