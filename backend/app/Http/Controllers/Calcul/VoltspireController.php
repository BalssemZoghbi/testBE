<?php

namespace App\Http\Controllers\Calcul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donnees\Projet;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\VoltSpireResource;
use App\Models\Donnees\VoltSpire;

class VoltspireController extends Controller
{
    public function getAllVoltSpire()
    {
        $VoltSpire = VoltSpire::all();
        return VoltSpireResource::collection($VoltSpire);
    }
    public function getOneVoltSpire($id)
    {
        $VoltSpire = VoltSpire::FindOrFail($id);
        return new VoltSpireResource($VoltSpire);
    }
    public function deleteVoltSpire($id)
    {
        $VoltSpire = VoltSpire::FindOrFail($id);
        $VoltSpire->delete();
        return response()->json('deleted');
    }
    public function N2c($U2ph,$Snette,$B,$frequence,$u2ligne,$couplage){
        if($couplage=='zn'){
            $N2c=($u2ligne*2/3)*(pow(10,6))/(pi()*$frequence*sqrt(2)*$Snette*$B);
        }else{
          $N2c=$U2ph*(pow(10,6))/(pi()*$frequence*sqrt(2)*$Snette*$B);
        }
          if($N2c%2==0){
                return floor($N2c);}
                else{
                    return Ceil($N2c);
                }



    }
    public function N1c($U1ph,$Vsp){

        $N1c=$U1ph/$Vsp;
        return $N1c;
    }
    public function Vsp($U2ph,$Snette,$B,$frequence,$u2ligne,$couplage){
        $N2c = $this->N2c($U2ph,$Snette,$B,$frequence,$u2ligne,$couplage);
        if($couplage=='zn'){
            $Vsp=$u2ligne*2/3/$N2c;
        }else{
        $Vsp=$U2ph/$N2c;}
        return $Vsp;
    }
    public function Bmax($U2ph,$Snette,$B,$frequence,$u2ligne,$couplage){
        $N2c = $this->N2c($U2ph,$Snette,$B,$frequence,$u2ligne,$couplage);
        if($couplage=='zn'){
        $Bmax=($u2ligne*2/3*(pow(10,6))/(pi()*$frequence*sqrt(2)*$Snette*$N2c));

        }else{
            $Bmax=($U2ph*(pow(10,6))/(pi()*$frequence*sqrt(2)*$Snette*$N2c));
        }
        // dd($N2c);
    return $Bmax;
    }

    public function prise($priseAdditive,$priseSoustractive)
    {
        $prise=[];
        $prise1=[];
        for($i=0;$i<$priseSoustractive;$i++){
            $prise[$i]='Prise'.($i-$priseSoustractive);
        }
        for($i=$priseSoustractive;$i<$priseAdditive+$priseSoustractive+1;$i++){
            $prise[$i]='Prise+'.($i-$priseSoustractive);
        }
        for($i=0;$i<$priseAdditive+$priseSoustractive+1;$i++){
            $prise1[$i]=$prise[$priseAdditive+$priseSoustractive-$i];
        }
        // dd($prise1);
        return $prise1;
    }
    public function spires($echelonAdd,$echelonSous,$priseAdditive,$priseSoustractive,$n1)
    {
        $spires=[];
        $spires1=[];
        for($i=0;$i<$priseSoustractive;$i++){
            $spires[$i]=$n1-abs((($i-$priseSoustractive)*$n1*$echelonSous)/100);
        }
        for($i=$priseSoustractive;$i<$priseAdditive+$priseSoustractive+1;$i++){
            $spires[$i]=$n1+abs((($i-$priseSoustractive)*$n1*$echelonAdd)/100);
        }
        for($i=0;$i<$priseAdditive+$priseSoustractive+1;$i++){
            $spires1[$i]=$spires[$priseAdditive+$priseSoustractive-$i];
        }
        // dd($spires1);
        return $spires1;
    }

    public function updateVoltSpire($id, Request $request)
    {
        $projet = DB::table('projets')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->join('volt_spires', 'volt_spires.id', '=', 'projets.volt_spires_id')
            ->where('projets.id', $id)
            ->select('volt_spires.*','projets.volt_spires_id','gradins.Snette', 'electriques.secondaireUPhase', 'electriques.secondaireUligne', 'electriques.couplageSecondaire', 'electriques.PrimaireUPhase', 'electriques.frequence','electriques.priseAdditive','electriques.priseSoustractive','electriques.echelonSousctractive','electriques.echelonAdditive','projets.*')
            ->get()->first();
        $VoltSpire = VoltSpire::FindOrFail($projet->volt_spires_id);
        $Bmax=$this->Bmax($projet->secondaireUPhase,$projet->Snette,$request->Bmaxdesire,$projet->frequence,$projet->secondaireUligne,$projet->couplageSecondaire);
        $N2c = $this->N2c($projet->secondaireUPhase,$projet->Snette,$Bmax,$projet->frequence,$projet->secondaireUligne,$projet->couplageSecondaire);

        $Vsp=$this->Vsp($projet->secondaireUPhase,$projet->Snette,$Bmax,$projet->frequence,$projet->secondaireUligne,$projet->couplageSecondaire);
        $N1c=$this->N1c($projet->PrimaireUPhase,$projet->Vsp);
        // $largeur=$this->largeur($request->diamNominale,$request->nbrGradin,$request->pas);
        // $epaisseur=$this->epaisseur($request->diamNominale,$largeur,$request->nbrGradin);
        // $epaisseurfeuillard=$this->epaisseurfeuillard($request->diamNominale,$largeur,$request->nbrGradin,$request->demiGradin);
        // $brut=array_sum(array_map(function($a, $b) { return $a * $b; }, $largeur, $epaisseur));
      $prise=$this->prise($projet->priseAdditive,$projet->priseSoustractive);
      $spires=$this->spires($projet->echelonAdditive,$projet->echelonSousctractive,$projet->priseAdditive,$projet->priseSoustractive,$N1c);
      $VoltSpire->update([
                'Bmaxdesire' =>$request->Bmaxdesire,
                'Bmax' => $Bmax,
                'Vsp' => $Vsp,
                'N2c' => $N2c,
                'N1c' => $N1c,
                'prise' => $prise,
                'spire' => $spires,

            ]);

        return response()->json($VoltSpire);
    }
    public function storeVoltSpire()
    {

        $VoltSpire = VoltSpire::create([
            'Bmaxdesire'=>  'H95-27',
            'Bmax'=> 8,
            'Vsp'=> 20,
            'N2c'=> 4,
            'N1c'=> 7,
            'prise' => '[1,5,6]',
            'spire' => '[1,5,6]'
        ]);

        if ($VoltSpire->save()) {
            return response()->json($VoltSpire);
        }
    }

}
