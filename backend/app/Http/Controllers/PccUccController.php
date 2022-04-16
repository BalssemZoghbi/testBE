<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\PccUcc;
use Illuminate\Support\Facades\DB;
class PccUccController extends Controller
{
    public function pcc1($materiau,$jn,$poid,$majorationcc){
        if($materiau=='cuivre'){
            return 2.286*pow($jn,2)*$poid*$majorationcc;
        }else if($materiau=='aluminium'){
            return 12.18*pow($jn,2)*$poid*$majorationcc;
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
public function comoy($dintBt,$epxBt,$dintMt,$epxMt){
    return $dintBt+$epxBt+$dintMt+$epxMt;
}
public function delta($disMTBT,$epx,$epy){
    return $epx+$epy/3+$disMTBT;
}
public function Hmoy($conducteur,$hcond,$hsfs,$hfeullard){
   if($conducteur=='feuillard'){
       return $hcond+$hfeullard/2;
   }else{
       return $hcond+$hsfs/2;
   }
}

public function Uccr($coMoy,$delta,$n1c,$Iph1,$Uph,$Hmoy){
$Uccr=3.81*($coMoy*$delta*pow($n1c,2)*$Iph1)/$Uph*$Hmoy;
return $Uccr;
}
public function Ucca($pccMaj,$puissance){
    return $pccMaj*100/$puissance*1000+$pccMaj;
    }
    public function Ucc($uccr,$ucca){
        return sqrt(pow($uccr,2)+pow($ucca,2));
        }
    public function updatePUCC($id, Request $request){
    $projet = DB::table('projets')
    ->join('pcc_uccs', 'pcc_uccs.id', '=', 'projets.pcc_uccs_id')
    ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
    ->join('garanties', 'garanties.id', '=', 'projets.garantie_id')
    ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
    ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
    ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
    ->where('projets.id',$id)
    ->select('pcc_uccs.*','garanties.Uccg','garanties.Pccg','pcc_uccs.id as pccucc_id','volt_Spires.N2c','volt_Spires.N1c','electriques.PrimaireIPhase','electriques.PrimaireUPhase','electriques.secondaireUPhase','electriques.secondaireIPhase','electriques.puissance','bobinage_secs.Hfeuillard','bobinage_secs.j2','bobinage_secs.Dint','bobinage_secs.*','bobinage_secs.Epx','bobinage_secs.materiauSec','bobinage_secs.poidBT','bobinages.j1','bobinages.DintMT','bobinages.poidMT','bobinages.HSFS','bobinages.HCondMt','bobinages.EpxMT','bobinages.materiau','bobinages.EpyMT','bobinages.*','projets.*')
    ->get()->first();
   $pcc1=$this->pcc1($projet->materiau,$projet->j1,$projet->poidMT,$request->MajourationU);
   $pcc2=$this->pcc1($projet->materiauSec,$projet->j2,$projet->poidBT,$request->MajourationU);
    $pccMaj=$this->pccMaj($pcc1,$pcc2);
    $CMoy=$this->comoy($projet->Dint,$projet->Epx,$projet->DintMT,$projet->EpxMT);
    $delta=$this->delta($projet->DistanceBTMT,$projet->EpxMT,$projet->EpyMT);
    $Hmoy=$this->Hmoy($projet->conducteurSec,$projet->HCondMt,$projet->HSFS,$projet->Hfeuillard);
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
