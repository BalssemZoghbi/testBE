<?php

namespace App\Http\Controllers;
use App\Models\Donnees\Projet;
use App\Models\VoltSpire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function N2c($U2ph,$Snette,$B,$frequence){
  $N2c=($U2ph*(pow(10,6))/(3.14*$frequence*sqrt(2)*$Snette*$B));
  dd($N2c);
        return $N2c;
    }
    public function N1c($U1ph,$Vsp){
        $N1c=$U1ph/$Vsp;
        return $N1c;
    }
    public function Vsp($U2ph,$N2c){
        $N2c = $this->N2c($U2ph,$Snette,$B,$frequence);
        $Vsp=$U2ph/$N2c;
        return $Vsp;
    }
    public function Bmax($U2ph,$Snette,$frequence){
        $N2c = $this->N2c($U2ph,$Snette,$B,$frequence);
        $Bmax=($U2ph/(3.14*$frequence*sqrt(2)*$Snette*$N2c)*(pow(10,6)));
    return $Bmax;
    }

    public function prise($priseAdditive)
    {
        $prise=[];
        for($i=0;$i<$priseAdditive;$i++){
            $prise[$i]='Prise'+$i;
          
        }
        dd($prise);
        return $prise;
    }

    public function updateVoltSpire($id, Request $request)
    {

        $projet = DB::table('projets')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->join('volt_spires', 'volt_spires.id', '=', 'projets.volt_spires_id')
            ->where('projets.id', $id)
            ->select('volt_spires.*','volt_spires.id as volSpire_id','gradins.Snette', 'electriques.secondaireUPhase', 'electriques.PrimaireUPhase', 'electriques.frequence','electriques.priseAdditive','electriques.priseSoustractive','electriques.echelonSousctractive','electriques.priseAdditive', 'projets.*')
            ->get()->first();
        $VoltSpire = VoltSpire::FindOrFail($projet->volSpire_id);
        $N2c = $this->N2c($projet->secondaireUPhase,$projet->Snette,$request->Bmaxdesire,$projet->frequence);
        $N1c=$this->N1c($projet->PrimaireUPhase,$VoltSpire->Vsp);
        $Bmax=$this->Bmax($projet->secondaireUPhase,$projet->Snette,$projet->frequence);
        $VoltSpire->N2c=$N2c;
        $VoltSpire->N1c=$N1c;
        $VoltSpire->Bmax=$Bmax;
        $Vsp=$this->Vsp($projet->secondaireUPhase,$N2c);
        // $largeur=$this->largeur($request->diamNominale,$request->nbrGradin,$request->pas);
        // $epaisseur=$this->epaisseur($request->diamNominale,$largeur,$request->nbrGradin);
        // $epaisseurfeuillard=$this->epaisseurfeuillard($request->diamNominale,$largeur,$request->nbrGradin,$request->demiGradin);
        // $brut=array_sum(array_map(function($a, $b) { return $a * $b; }, $largeur, $epaisseur));
      $prise=$this->prise($projet->priseAdditive);
            $VoltSpire->update([
                'Bmaxdesire' =>  $request->Bmaxdesire,
                'Bmax' => $Bmax,
                'Vsp' => $Vsp,
                'N2c' => $N2c,
                'N1c' => $N1c,
                'prise' => $prise,
                'spire' => $spire,
                
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
