<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gradin;
use App\Http\Resources\GradinResource;
use Illuminate\Support\Facades\DB;
class GradinController extends Controller
{
    public function addg(){
        $gradin=Gradin::create([
            "tole"=>  'StandardTri24KV',
            'diamPropose' => 1320,
            'diamNominale'=> 8,
            'pas'=> 10,
            'coeffRemplissage'=> 4,
            'nbrGr
            adin'=> 9220,
            'demiGradin'=> 198,
            'largeur'=> '[1,5,6]',
            'epaisseur'=> '[1,5,6]',
            'Sbrut'=> 4.8,
            'Snette'=> 101.42,
            'EpaisseurTot'=> 4.0,
        ]);
    }
    public function getAllGradin()
    {
        $Gradin =Gradin::all();

        return GradinResource::collection($Gradin);
    }
    public function getOneGradin($id)
    {
        $Gradin =Gradin::FindOrFail($id);
        return new GradinResource($Gradin);
    }
    public function storeGradin(Request $request){
   
        $Gradin= Gradin::create([
            'tole'=>  $request->$tole,
            'diamPropose' => $request->$diamPropose,
            'diamNominale'=> $request->$diamNominale,
            'pas'=> $request->$pas,
            'coeffRemplissage'=> $request->$coeffRemplissage,
            'nbrGradin'=> $request->$nbrGradin,
            'demiGradin'=> $request->$demiGradin,
            'largeur'=> $request->$largeur,
            'epaisseur'=> $request->$epaisseur,
            'Sbrut'=> $request->$Sbrut,
            'Snette'=> $request->$Snette,
            'EpaisseurTot'=> $request->$EpaisseurTot

         ]);

         if($Gradin->save()){
             return response()->json($Gradin);
         }

     }
     public function diametre($materiau,$puissance){
         $diamPropose=null;
         if($materiau=='cuivre'){
            $diamPropose=pow(($puissance/100),0.236)*220;
         }elseif ($materiau=='aluminum') {
             $diamPropose=pow(($puissance/100),0.236)*200;
         }
     }

        public function updateGradin($id, Request $request){

            $projet = DB::table('projets')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('Gradins', 'Gradins.id', '=', 'projets.Gradin_id')
            ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
            ->where('projets.id',$id)
            ->select('projets.garadin_id','electriques.puissance','bobinages.materiau', 'projets.*')
            ->get()->first();
            $Gradin=Gradin::FindOrFail($projet->grad_id );

            $diamPropose=$this->diametre($projet->materiau,$projet->puissance);




            $Gradin->update([
            'tole'=>  $request->$tole,
            'diamPropose' =>$diamPropose,
            'diamNominale'=> $request->$diamNominale,
            'pas'=> $request->$pas,
            'coeffRemplissage'=> $request->$coeffRemplissage,
            'nbrGradin'=> $request->$nbrGradin,
            'demiGradin'=> $request->$demiGradin,
            'largeur'=> $request->$largeur,
            'epaisseur'=> $request->$epaisseur,
            'Sbrut'=> $request->$Sbrut,

            'Snette'=>$request->Sbrut+$request->coeffRemplissage,

            'EpaisseurTot'=> $request->$EpaisseurTot
            
            // 'EpaisseurTot'=> $epaisseur->sum('epaisseur')
             ]); 
    
                 return response()->json($Gradin);
         }

        public function deleteGradin($id){
            $Gradin = Gradin::FindOrFail($id);
            $Gradin->delete();
            return response()->json('deleted');
        }
}
