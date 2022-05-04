<?php

namespace App\Http\Controllers\Calcul\Bobinage;

use App\Http\Controllers\Controller;
use App\Models\Donnees\bobinage\Barre;
use App\Models\Donnees\bobinage\Hbrin;
use App\Models\Donnees\bobinage\Saillie;
use Illuminate\Http\Request;

class BobinageStatiqueController extends Controller
{
    public function getSaillie()
    {
        $saillie = Saillie::all();
        return response()->json($saillie);
    }
    public function getoneSaillie($id)
    {
        $saillie = Saillie::FindOrFail($id);
        return response()->json($saillie);
    }

    public function createSaillie(Request $request){

        $saillie = Saillie::create([
            'valeur' =>$request->valeur
            ]);
        if($saillie->save()){
            return response()->json($saillie);
        }
    }
    public function getValeurSaillie()
    {
        $tab=[];
        $Saillie = Saillie::get('valeur');
        foreach ($Saillie as $valeur){
            array_push($tab, $valeur->valeur);
        }
        return response()->json($tab);
    }
    public function updateSaillie($id,Request $request){
        $saillie = Saillie::FindOrFail($id);
        $saillie->update([
            'valeur' =>$request->valeur
            ]);
        if($saillie->save()){
            return response()->json($saillie);
        }
    }
    public function deleteSaillie($id){
        $saillie= Saillie::FindOrFail($id);
        $saillie->delete();
        return response()->json($saillie);
     }
    public function getHbrin()
    {
        $hbrin = Hbrin::all();
        return response()->json($hbrin);
    }
    public function getValeurHbrin()
    {
        $tab=[];
        $brin = Hbrin::get('valeurHbrin');
        foreach ($brin as $valeur){
            array_push($tab, $valeur->valeurHbrin);
        }
        return response()->json($tab);
    }
    public function getoneHbrin($id)
    {
        $hbrin = Hbrin::FindOrFail($id);
        return response()->json($hbrin);
    }

    public function createHbrin(Request $request){

        $hbrin = Hbrin::create([
            'valeurHbrin' =>$request->valeurHbrin
            ]);
        if($hbrin->save()){
            return response()->json($hbrin);
        }
    }

    public function updateHbrin($id,Request $request){
        $hbrin = Hbrin::FindOrFail($id);
        $hbrin->update([
            'valeurHbrin' =>$request->valeurHbrin
            ]);
        if($hbrin->save()){
            return response()->json($hbrin);
        }
    }
    public function deleteHbrin($id){
        $hbrin= Hbrin::FindOrFail($id);
        $hbrin->delete();
        return response()->json($hbrin);
     }
    public function getBarre()
    {
        $Barre = Barre::all();
        return response()->json($Barre);
    }
    public function getdesignationBarre()
    {
        $tab=[];
        $Barre = Barre::get('designation');
        foreach ($Barre as $valeur){
            array_push($tab, $valeur->designation);
        }
        return response()->json($tab);
    }
    public function getoneBarre($id)
    {
        $Barre = Barre::FindOrFail($id);
        return response()->json($Barre);
    }

    public function createBarre(Request $request){

        $Barre = Barre::create([
            'designation' =>$request->epaisseur.'*'.$request->largeur,
            'epaisseur' =>$request->epaisseur,
            'largeur' =>$request->largeur,
            ]);
        if($Barre->save()){
            return response()->json($Barre);
        }
    }

    public function updateBarre($id,Request $request){
        $Barre = Barre::FindOrFail($id);
        $Barre->update([
            'designation' =>$request->epaisseur.'*'.$request->largeur,
            'epaisseur' =>$request->epaisseur,
            'largeur' =>$request->largeur,
        ]);
        if($Barre->save()){
            return response()->json($Barre);
        }
    }
    public function deleteBarre($id){
        $Barre= Barre::FindOrFail($id);
        $Barre->delete();
        return response()->json($Barre);
     }
     public function addStatBarre(){
        $Barre=[
       ["designation"=>"5*63","epaisseur"=>5,"largeur"=>63],
       ["designation"=>"6*80","epaisseur"=>6,"largeur"=>80],
       ["designation"=>"6*100","epaisseur"=>6,"largeur"=>100],
       ["designation"=>"8*80","epaisseur"=>8,"largeur"=>80],
       ["designation"=>"8*100","epaisseur"=>8,"largeur"=>100],
       ["designation"=>"5*50","epaisseur"=>5,"largeur"=>50],
       ["designation"=>"5*80","epaisseur"=>5,"largeur"=>80],
       ["designation"=>"6*60","epaisseur"=>6,"largeur"=>60],
       ["designation"=>"5*100","epaisseur"=>5,"largeur"=>100],
       ["designation"=>"7*100","epaisseur"=>7,"largeur"=>100],
       ["designation"=>"10*100","epaisseur"=>10,"largeur"=>100],
   ];
    Barre::insert($Barre);
   }
}
