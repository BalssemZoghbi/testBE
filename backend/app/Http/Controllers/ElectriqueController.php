<?php

namespace App\Http\Controllers;

use App\Http\Resources\ElectriqueResource;
use App\Models\Electrique;
use Illuminate\Http\Request;

class ElectriqueController extends Controller
{
    public function nbrePosition()
    {
        return $this->priseAdditive + $this->priseSoustractive +1;
    }
    public function index()
    {
        // $this->nbrePosition=$this->nbrePosition();
        $electriques =Electrique::all();
        return ElectriqueResource::collection($electriques);
    }
    public function getoneelec($id)
    {
        $electrique =Electrique::FindOrFail($id);
        return new ElectriqueResource($electrique);
    }
    public function store(Request $request){

        $projet= Electrique::create([
             'colonnes' => $request->colonnes,
             'frequence' =>$request->frequence,
             'pn' =>$request->pn,
             'u1n' =>$request->u1n,
             'u2o' => $request->u2o,
             'couplagePrimaire' =>$request->couplagePrimaire,
             'couplageSecondaire' =>$request->couplageSecondaire,
             'indiceHoraire' => $request->indiceHoraire,
             'couplage' =>$request->couplage,
            //  'couplage' =>$request->couplagePrimaire + $request->couplagePrimaire ,
             'classeU1' =>$request->classeU1,
             'tenueFr1' =>$request->tenueFr1,
             'tenueChoc1' =>$request->tenueChoc1,
             'tenueFr2' =>$request->tenueFr2,
             'tenueChoc2' =>$request->tenueChoc2,
             'classeU2' =>$request->classeU2,
             'priseSoustractive' =>$request->priseSoustractive,
             'priseAdditive' =>$request->priseAdditive,
             'echelonSousctractive' =>$request->echelonSousctractive,
             'echelonAdditive' =>$request->echelonAdditive,
             'puissance' =>$request->puissance,
             'PrimaireUligne' =>$request->PrimaireUligne,
             'PrimaireUPhase' =>$request->PrimaireUPhase,
             'PrimaireIligne' =>$request->PrimaireIligne,
             'PrimaireIPhase' =>$request->PrimaireIPhase,
             'secondaireUligne' =>$request->secondaireUligne,
             'secondaireUPhase' =>$request->secondaireUPhase,
             'secondaireIligne' =>$request->secondaireIligne,
             'secondaireIPhase' =>$request->secondaireIPhase,
             'nbrePosition' =>$request->priseSoustractive+$request->priseAdditive+1,
         ]);

         if($projet->save()){
             return new ElectriqueResource($projet);
         }

     }
}
