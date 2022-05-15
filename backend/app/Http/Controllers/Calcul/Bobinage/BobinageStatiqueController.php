<?php

namespace App\Http\Controllers\Calcul\Bobinage;

use App\Http\Controllers\Controller;
use App\Models\Donnees\bobinage\Barre;
use App\Models\Donnees\bobinage\Emaille;
use App\Models\Donnees\bobinage\Hbrin;
use App\Models\Donnees\bobinage\Saillie;
use App\Models\Donnees\gradin\Tole;
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
    public function getToles()
    {
        $Tole = Tole::all();
        return response()->json($Tole);
    }
    public function getoneTole($id)
    {
        $Tole = Tole::FindOrFail($id);
        return response()->json($Tole);
    }

    public function createTole(Request $request){

        $Tole = Tole::create([
            'tole' =>$request->tole,
            'coef0' =>$request->coef0,
            'coef1' =>$request->coef1,
            'coef2' =>$request->coef2,
            'coef3' =>$request->coef3,
            'coef4' =>$request->coef4,
            'coef5' =>$request->coef5,
            'coef6' =>$request->coef6,
            ]);
        if($Tole->save()){
            return response()->json($Tole);
        }
    }

    public function updateTole($id,Request $request){
        $Tole = Tole::FindOrFail($id);
        $Tole->update([
            'tole' =>$request->tole,
            'coef0' =>$request->coef0,
            'coef1' =>$request->coef1,
            'coef2' =>$request->coef2,
            'coef3' =>$request->coef3,
            'coef4' =>$request->coef4,
            'coef5' =>$request->coef5,
            'coef6' =>$request->coef6,
            ]);
        if($Tole->save()){
            return response()->json($Tole);
        }
    }
    public function deleteTole($id){
        $Tole= Tole::FindOrFail($id);
        $Tole->delete();
        return response()->json($Tole);
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
    public function getTole()
    {
        $tab=[];
        $tole = Tole::get('tole');
        foreach ($tole as $valeur){
            array_push($tab, $valeur->tole);
        }
        return response()->json($tab);
    }
    public function getEmaille()
    {
        $tab = Emaille::all();
        // $tab=[];
        // $tole = Emaille::get('tole');
        // foreach ($tole as $valeur){
        //     array_push($tab, $valeur->tole);
        // }
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
