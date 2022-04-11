<?php

namespace App\Http\Controllers;
use App\Models\VoltSpire;
use Illuminate\Http\Request;
use App\Models\Donnees\Projet;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\VoltSpireResource;

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
//   dd($N2c);
        return $N2c;
    }
    public function N1c($U1ph,$Vsp){
        $N1c=$U1ph/$Vsp;
        return $N1c;
    }
    public function Vsp($U2ph,$N2c,$Snette,$B,$frequence){
        $N2c = $this->N2c($U2ph,$Snette,$B,$frequence);
        $Vsp=$U2ph/$N2c;
        return $Vsp;
    }
    public function Bmax($U2ph,$Snette,$B,$frequence){
        $N2c = $this->N2c($U2ph,$Snette,$B,$frequence);
        $Bmax=($U2ph/(3.14*$frequence*sqrt(2)*$Snette*$N2c)*(pow(10,6)));
    return $Bmax;
    }

    public function priseadd($priseSoustractive)
    {
        $prise=[];
        for($i=0;$i<$priseSoustractive;$i++){
            $prise[$i]='Prise-'.($i+1);
            // ($i-$priseSoustractive+1);
        }

        // dd($prise);
        return $prise;
    }
    public function prise($priseAdditive,$priseSoustractive)
    {
        $prise=$this->priseadd($priseSoustractive);

        for($i=$priseSoustractive;$i<$priseAdditive+$priseSoustractive;$i++){
            $prise[$i]='Prise+'.($i);
            // $i-$priseAdditive-1
        }
        // dd($prise);
        return $prise;
    }

    public function updateVoltSpire($id, Request $request)
    {

        $projet = DB::table('projets')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->join('volt_spires', 'volt_spires.id', '=', 'projets.volt_spires_id')
            ->where('projets.id', $id)
            ->select('projets.volt_spires_id','gradins.Snette', 'electriques.secondaireUPhase', 'electriques.PrimaireUPhase', 'electriques.frequence','electriques.priseAdditive','electriques.priseSoustractive','electriques.echelonSousctractive','electriques.priseAdditive')
            ->get()->first();
        $VoltSpire = VoltSpire::FindOrFail($projet->volt_spires_id);
        $N2c = $this->N2c($projet->secondaireUPhase,$projet->Snette,$request->Bmaxdesire,$projet->frequence);
        $N1c=$this->N1c($projet->PrimaireUPhase,$VoltSpire->Vsp);
        $Bmax=$this->Bmax($projet->secondaireUPhase,$projet->Snette,$request->Bmaxdesire,$projet->frequence);
        $Vsp=$this->Vsp($projet->secondaireUPhase,$N2c,$projet->Snette,$request->Bmaxdesire,$projet->frequence);
        // $largeur=$this->largeur($request->diamNominale,$request->nbrGradin,$request->pas);
        // $epaisseur=$this->epaisseur($request->diamNominale,$largeur,$request->nbrGradin);
        // $epaisseurfeuillard=$this->epaisseurfeuillard($request->diamNominale,$largeur,$request->nbrGradin,$request->demiGradin);
        // $brut=array_sum(array_map(function($a, $b) { return $a * $b; }, $largeur, $epaisseur));
      $prise=$this->prise($projet->priseAdditive,$projet->priseSoustractive);
            $VoltSpire->update([
                'Bmaxdesire' =>  $request->Bmaxdesire,
                'Bmax' => $Bmax,
                'Vsp' => $Vsp,
                'N2c' => $N2c,
                'N1c' => $N1c,
                'prise' => $prise,
                'spire' => $prise,

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
