<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gradin;
use App\Http\Resources\GradinResource;
use Illuminate\Support\Facades\DB;

class GradinController extends Controller
{
    public function addg()
    {
        Gradin::create([
            "tole" =>  'StandardTri24KV',
            'diamPropose' => 1320,
            'diamNominale' => 8,
            'pas' => 10,
            'coeffRemplissage' => 4,
            'nbrGr
            adin' => 9220,
            'demiGradin' => 198,
            'largeur' => '[1,5,6]',
            'epaisseur' => '[1,5,6]',
            'Sbrut' => 4.8,
            'Snette' => 101.42,
            'EpaisseurTot' => 4.0,
            'largeurMin' => 50,
        ]);
    }
    public function getAllGradin()
    {
        $Gradin = Gradin::all();

        return GradinResource::collection($Gradin);
    }
    public function getOneGradin($id)
    {
        $Gradin = Gradin::FindOrFail($id);
        return new GradinResource($Gradin);
    }

    public function diametre($materiau, $puissance)
    {
        $diamPropose = null;
        if ($materiau == 'cuivre') {
            $diamPropose = pow(($puissance / 1000), 0.2316) * 220;
        } elseif ($materiau == 'aluminium') {
            $diamPropose = pow(($puissance / 1000), 0.2316) * 200;
        }
        return $diamPropose;
    }

    public function largeurcreate($diam,$pas,$nbrGradin)
    {
        $diam=floor($diam/10);
        if($diam%2==0){
            $diam-=1;
        }
        $diam=$diam*10;
        $largeur=[];
        for($i=0;$i<$nbrGradin;$i++){
            $largeur[$i]=$diam;
            $diam-=$pas;
        }
    return $largeur;
    }
    public function largeur($diam,$pas,$nbrGradin,$largMin,$oldlargGradin,$oldnbreGradin)
    {
        $marge=count($oldlargGradin)-$nbrGradin;

        if($nbrGradin>=$oldnbreGradin){
        $diam=floor($diam/10);
        if($diam%2==0){
            $diam-=1;
        }
        $diam=$diam*10;
        for($i=0;$i<$nbrGradin;$i++){
            $largeur[$i]=$diam;
            $diam-=$pas;
        }
        return $largeur;

        }else{

        if($largMin!=0){
                $largeurrev = array_reverse($oldlargGradin);
                $indexLargeurMin = array_search($largMin, $largeurrev);
                // dd($indexLargeurMin);
                array_splice($largeurrev, $indexLargeurMin + 1, $marge);
                $largeur = array_reverse($largeurrev);
            }
            return $largeur;

        }

    }
    public function epaisseur($diam,$largeur,$nbreGradin){
        $epaisseur=[];
        $prec=0;
        // for($i=0;$i<$nbreGradin;$i++){
        //     $epaisseur[$i]=sqrt(pow($diam,2)-pow($largeur[$i],2));
        //     $prec+=$epaisseur[$i];
        //     $epaisseur[$i]-=$prec;
        // }
        for($i=0;$i<$nbreGradin;$i++){
            $epaisseur[$i]=sqrt(pow($diam,2)-pow($largeur[$i],2));
            $epaisseur[$i]-=$prec;
            $prec+=$epaisseur[$i];
            // $prec+=sqrt(pow($diam,2)-pow($largeur[$i],2));
        }
        return $epaisseur;
    }
    public function epaisseurfeuillard($diam,$largeur,$nbreGradin,$demiGradin){
        $epaisseur=$this->epaisseur($diam,$largeur,$nbreGradin);
        $coeff=[0.5, 0.3, 0.25, 0.2];
        $j=0;
        for($i=$nbreGradin-$demiGradin;$i<$nbreGradin;$i++){
            $epaisseur[$i]=$epaisseur[$i]*$coeff[$j];
            $j++;
        }
        return $epaisseur;
    }

    public function updateGradin($id, Request $request)
    {

        $projet = DB::table('projets')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
            ->where('projets.id', $id)
            ->select('projets.gradin_id', 'electriques.puissance', 'bobinages.materiau', 'bobinages.conducteur')
            ->get()->first();
        $Gradin = Gradin::FindOrFail($projet->gradin_id);
        $oldnbreGradin = $Gradin->getOriginal('nbrGradin');
        $oldlargGradin = $Gradin->getOriginal('largeur');
        // dd($oldlargGradin);
        $diamPropose = $this->diametre($projet->materiau, $projet->puissance);
        $largeur=$this->largeur($request->diamNominale,$request->pas,$request->nbrGradin,$request->largeurMin,$oldlargGradin,$oldnbreGradin);
        $epaisseur=$this->epaisseur($request->diamNominale,$largeur,$request->nbrGradin);
        $epaisseurfeuillard=$this->epaisseurfeuillard($request->diamNominale,$largeur,$request->nbrGradin,$request->demiGradin,$request->largeurMin,$oldlargGradin,$oldnbreGradin);
        $brut=array_sum(array_map(function($a, $b) { return $a * $b; }, $largeur, $epaisseur));
        if($projet->conducteur=='feuillard'){
            $Gradin->update([
                'tole' =>  $request->tole,
                'diamPropose' => $diamPropose,
                'diamNominale' => $request->diamNominale,
                'pas' => $request->pas,
                'coeffRemplissage' => $request->coeffRemplissage,
                'nbrGradin' => $request->nbrGradin,
                'demiGradin' => $request->demiGradin,
                'largeur' => $largeur,
                'epaisseur' => $epaisseurfeuillard,
                'Sbrut' => $brut ,
                'Snette' => $brut * $request->coeffRemplissage,
                'EpaisseurTot' => array_sum($epaisseur),
                'largeurMin' => $request->largeurMin,
            ]);
        }else{
        $Gradin->update([
            'tole' =>  $request->tole,
            'diamPropose' => $diamPropose,
            'diamNominale' => $request->diamNominale,
            'pas' => $request->pas,
            'coeffRemplissage' => $request->coeffRemplissage,
            'nbrGradin' => $request->nbrGradin,
            'demiGradin' => 0,
            'largeur' => $largeur,
            'epaisseur' => $epaisseur,
            'Sbrut' => $brut ,
            'Snette' => $brut * $request->coeffRemplissage,
            'EpaisseurTot' => array_sum($epaisseur),
            'largeurMin' => $request->largeurMin,
        ]);
    }
        return response()->json($Gradin);
    }
    public function storeGradin()
    {

        $Gradin = Gradin::create([
            "tole"=>  'H95-27',
            'diamNominale'=> 8,
            'pas'=> 20,
            'coeffRemplissage'=> 4,
            'nbrGradin'=> 7,
            'demiGradin'=> 2,
            'largeurMin' => 50
        ]);

        if ($Gradin->save()) {
            return response()->json($Gradin);
        }
    }

    public function deleteGradin($id)
    {
        $Gradin = Gradin::FindOrFail($id);
        $Gradin->delete();
        return response()->json('deleted');
    }
}
