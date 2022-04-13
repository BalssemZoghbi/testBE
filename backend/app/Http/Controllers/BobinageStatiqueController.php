<?php

namespace App\Http\Controllers;

use App\Models\Hbrin;
use App\Models\Saillie;
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
}
