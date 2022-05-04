<?php

namespace App\Http\Controllers;

use App\Models\Circuitmagnetique;
use App\Models\Tole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CircuitmagnetiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    // functions
    public function Hauteurcuve($hbobine,$ebc,$largeur,$eh,$e4)
    {
         $largeur = str_replace("[","",$largeur);
        $largeur = str_replace("]","",$largeur);
        $largeur=explode(',',$largeur);
       $largMax= $largeur[0];
       return $hbobine+2*$ebc+2*$largMax+$eh+$e4;

    }
    public function surfaceCM($largeur,$epaisseur){

        $largeur = str_replace("[","",$largeur);
        $largeur = str_replace("]","",$largeur);
        $largeur=explode(',',$largeur);
        $epaisseur = str_replace("[","",$epaisseur);
        $epaisseur = str_replace("]","",$epaisseur);
        $epaisseur=explode(',',$epaisseur);
for($i=0;$i<count($largeur);$i++){
    $surface[$i]=$largeur[$i]*$epaisseur[$i];
}
return $surface;
    }
    public function masseFerCM($materiau,$lcm,$surface){
        if($materiau=='cuivre'){
            $coefPoid=8.9;
            $coefPerte=2.286;
        }else if($materiau=='aluminium'){
            $coefPoid=2.7;
            $coefPerte=12.18;
        }
        for($i=0;$i<count($lcm);$i++){
            $masseferCM[$i]=$lcm[$i]*$surface[$i]*$coefPoid*7.65*pow(10,-5);
        }
        return $masseferCM;
    }


    public function LCM($ex,$largeur,$hc){
        $largeur = str_replace("[","",$largeur);
        $largeur = str_replace("]","",$largeur);
        $largeur=explode(',',$largeur);

        for($i=0;$i<count($largeur);$i++){
            $LCM[$i]=2*(2*$ex+$largeur[$i]+3*$hc)/10;
        }
        return $LCM;

    }
    public function pFerspecifique($tole,$bmax){
        $tole=Tole::where('tole',$tole)->get()->first();
        $pFerspecifique=$tole->coef6*pow($bmax,6)-$tole->coef5*pow($bmax,5)+$tole->coef4*pow($bmax,4)-$tole->coef3*pow($bmax,3)+$tole->coef2*pow($bmax,2)-$tole->coef1*$bmax+$tole->coef0;
        return $pFerspecifique;
    }
      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Circuitmagnetique  $circuitmagnetique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $projet = DB::table('projets')
        ->join('circuitmagnetiques', 'circuitmagnetiques.id', '=', 'projets.circuitmagnetiques_id')
        ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
        ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
        ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
        ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
        ->where('projets.id',$id)
        ->select('circuitmagnetiques.*','gradins.epaisseur','gradins.largeur','gradins.tole','circuitmagnetiques.id as circuitmagnetique_id','volt_Spires.Bmaxdesire','bobinage_secs.HbobineBt','bobinages.DextMT','bobinage_secs.materiauSec','bobinages.materiau','projets.*')
        ->get()->first();
        $Ex=418+$request->E1;
        $Hc=$projet->HbobineBt+2*($request->Ebc);
        $Largeurcuve=418+2*($request->E3);
        $Longeurcuve=2*$Ex+418+2*($request->E2);
        $CM= Circuitmagnetique::FindOrFail($projet->circuitmagnetique_id);
        $Hauteurcuve=$this->Hauteurcuve($projet->HbobineBt,$request->Ebc,$projet->largeur,$request->Eh,$request->E4);
        $surfaceCM=$this->surfaceCM($projet->largeur,$projet->epaisseur);
        $LCM=$this->LCM($Ex,$projet->largeur,$Hc);
        $masseFerCM=$this->masseFerCM($projet->materiau,$LCM,$surfaceCM);
        $masseFertot=array_sum($masseFerCM);
        $pFerspecifique=$this->pFerspecifique($projet->tole,$projet->Bmaxdesire);
        $CM->update([
             'masseFertot' =>$masseFertot,
             'Bmax' =>$projet->Bmaxdesire,
             'pFerspecifique' =>$pFerspecifique,
             'Majfer' =>$request->Majfer,
             'E1' =>$request->E1,
             'E2' =>$request->E2,
             'E3' =>$request->E3,
             'E4' =>$request->E4,
             'Ebc' =>$request->Ebc,
             'Majferprop' =>$request->Majferprop,
            'tole' =>$projet->tole,
             'pFer' =>$request->pFer,
             'pFergarantie' =>$request->pFergarantie,
             'Ex' =>$Ex,
             'Hc' =>$Hc,
             'Eh' => $request->Eh,
             'Longeurcuve' =>$Longeurcuve,
                'Largeurcuve' =>$Largeurcuve,
                'LCM' =>$LCM,
                'masseFerCM' =>$masseFerCM,
                'surfaceCM' =>$surfaceCM,
                'Hauteurcuve'=>$Hauteurcuve,
         ]);

             return response()->json($CM);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Circuitmagnetique  $circuitmagnetique
     * @return \Illuminate\Http\Response
     */
    public function destroy(Circuitmagnetique $circuitmagnetique)
    {
        //
    }
}
