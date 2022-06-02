<?php

namespace App\Http\Controllers\Calcul;

use App\Http\Controllers\Controller;
use App\Models\Donnees\PccUcc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PccUccController extends Controller
{
    public function pcc1($materiau,$jn,$poid,$majorationcc){
        if($materiau=='cuivre'){
            return 2.286*pow($jn,2)*$poid*(100+$majorationcc)/100;
        }else if($materiau=='aluminium'){
            return 12.18*pow($jn,2)*$poid*(100+$majorationcc)/100;
    }
}
// public function pcc2($materiau,$j2,$poid,$majorationcc){
//     if($materiau=='cuivre'){
//         return 2.286*pow($j2)*$poid*$majorationcc;
//     }else if($materiau=='aluminium'){
//         return 12.18*pow($j2)*$poid*$majorationcc;
// }
// }
public function pccMaj($pcc1,$pcc2){
    return $pcc1+$pcc2;
}
public function comoy($dintBt,$bintBT,$dextbT,$bextbt,$dintMt,$bintMT,$dextMT,$bextMt){
  $coBt= ($dintBt+$bintBT+$dextbT+$bextbt)*pi()/4;

  $coMt=  ($dintMt+$bintMT+$dextMT+$bextMt)*pi()/4;
//   dd(($coBt+$coMt)/2);
    return ($coBt+$coMt)/2 ;
}

public function delta($disMTBT,$epx,$epy){
    return($epx+$epy)/3+$disMTBT;

}
public function Hmoy($conducteurMT,$conducteurBT,$HCondMt,$HCondBt,$HSFS,$HSFSBT,$Hfeuillard,$HfeuillardBT){

    if(($conducteurMT=='feuillard')&&($conducteurBT=='feuillard')){
    $hmoy=($Hfeuillard+$HfeuillardBT)/2;
   }else if($conducteurBT=='feuillard'){
    $hmoy=($HCondMt+$HfeuillardBT)/2;
   }else if(($conducteurMT=='meplat guipé')&&($conducteurBT=='meplat guipé')){

    $hmoy=($HSFS+$HSFSBT)/2;
   }
   else if(($conducteurMT=='Rond emaille')&&($conducteurBT=='Rond emaille')){

    $hmoy=($HCondMt+$HCondBt)/2;
   }

   else if($conducteurMT=='meplat guipé'){
    $hmoy=($HSFS+$HfeuillardBT)/2;
   }
   else{
     $hmoy=($HCondMt+$HSFSBT)/2;
   }
       return $hmoy;

}

public function Uccr($coMoy,$delta,$n1c,$Iph1,$Uph,$Hmoy){

$Uccr=(3.81*($coMoy*$delta*pow($n1c,2)*$Iph1)/($Uph*$Hmoy))*pow(10,-5);
return $Uccr;
}
public function Ucca($pccMaj,$puissance){
    return ($pccMaj*100/$puissance*1000+$pccMaj)*pow(10,-6);
    }
    public function Ucc($uccr,$ucca){
        return sqrt(pow($uccr,2)+pow($ucca,2));
        }
    public function updatePUCC($id, Request $request){
    $projet = DB::table('projets')
    ->join('pcc_uccs', 'pcc_uccs.id', '=', 'projets.pcc_uccs_id')
    ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
    ->join('garanties', 'garanties.id', '=', 'projets.garantie_id')
    ->join('donne_bobines', 'donne_bobines.id', '=', 'projets.donne_bobines_id')
    ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
    ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
    ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
    ->where('projets.id',$id)
    ->select('pcc_uccs.*','donne_bobines.materiauMT','donne_bobines.conducteurMT','donne_bobines.conducteurBT','garanties.Uccg','garanties.Pccg','pcc_uccs.id as pccucc_id','volt_Spires.N2c','volt_Spires.N1c','electriques.PrimaireIPhase','electriques.PrimaireUPhase','electriques.secondaireUPhase','electriques.secondaireIPhase','electriques.puissance','bobinage_secs.HfeuillardBT','bobinage_secs.j2','bobinage_secs.DextBT','bobinage_secs.BextBT','bobinage_secs.BintBT','bobinage_secs.DintBT','bobinage_secs.HCondBt','bobinage_secs.EpxBT','donne_bobines.materiauBT','bobinage_secs.HSFSBT','bobinage_secs.poidBT','bobinages.j1','bobinages.Hfeuillard','bobinages.HSFS','bobinages.DintMT','bobinages.DistanceBTMT','bobinages.poidMT','bobinages.*','bobinages.HCondMt','bobinages.EpyMT','bobinages.BintMT','bobinages.DextMT','bobinages.BextMT','bobinages.EpxMT','projets.*')
    ->get()->first();
   $pcc1=$this->pcc1($projet->materiauMT,$projet->j1,$projet->poidMT,$request->MajourationU);
   $pcc2=$this->pcc1($projet->materiauBT,$projet->j2,$projet->poidBT,$request->MajourationU);

    $pccMaj=$this->pccMaj($pcc1,$pcc2);
    $CMoy=$this->comoy($projet->DintBT,$projet->BintBT,$projet->DextBT,$projet->BextBT,$projet->DintMT,$projet->BintMT,$projet->DextMT,$projet->BextMT);

    $delta=$this->delta($projet->DistanceBTMT,$projet->EpxBT,$projet->EpxMT);
   $Hmoy=$this->Hmoy($projet->conducteurMT,$projet->conducteurBT,$projet->HCondMt,$projet->HCondBt,$projet->HSFS,$projet->HSFSBT,$projet->Hfeuillard,$projet->HfeuillardBT);
    $Uccr=$this->Uccr($CMoy,$delta,$projet->N1c,$projet->PrimaireIPhase,$projet->PrimaireUPhase,$Hmoy);
    $Ucca=$this->Ucca($pccMaj,$projet->puissance);
    $Ucc=$this->Ucc($Uccr,$Ucca);

    $pUCC= PccUcc::FindOrFail($projet->pcc_uccs_id);
    $pUCC->update([
         'MajourationU' =>$request->MajourationU,
         'pcc1' =>$pcc1,
         'pcc2' =>$pcc2,
        'pccMaj' =>$pccMaj,
         'Pccg' =>$projet->Pccg,
         'Uccr' =>$Uccr,
         'Ucca' =>$Ucca,
         'Ucc' =>$Ucc,
         'Uccg' => $projet->Uccg,
     ]);

         return response()->json($pUCC);
 }

}
