<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use App\Http\Resources\ProjetResource;

class ProjetController extends Controller
{
    public function getProjets()
    {
        $projets =Projet::all();
        return ProjetResource::collection($projets);
    }

    public function storeProjet(Request $request){

           $projet= Projet::create([
                'appareil' => $request->appareil,
                'reference' =>$request->reference,
                'elaborateur' =>$request->elaborateur,
                'client' =>$request->client,
                'refClient' =>$request->refClient
            ]);

            if($projet->save()){
                return new ProjetResource($projet);
            }

        }
    public function showProjet($id){
        $projet= Projet::FindOrFail($id);
        return new ProjetResource($projet);
    }
    public function editProjet($id, Request $request){
        $projet= Projet::FindOrFail($id);
        request()->validate([
            'appareil'=>'required',
            'reference'=>'required',
            'elaborateur'=>'required',
            'client'=>'required',
            'refClient'=>'required'
        ]);
        $projet->update([
            'appareil' => $request->appareil,
            'reference' =>$request->reference,
            'client' =>$request->client,
            'elaborateur' =>$request->elaborateur,
            'refClient' =>$request->refClient
        ]);
        if($projet->save()){
            return new ProjetResource($projet);
        }
    }
    public function deleteProjet($id){
        $projet= Projet::FindOrFail($id);
        if($projet->delete()){
            return new ProjetResource($projet);
        }
    }
    public function paginateProjets()
    {
        $projets =Projet::paginate(10);
        return ProjetResource::collection($projets);
    }
    public function getsearch($query)
    {
        // $projets =Projet::where('reference',$query)->get();
        $projets =Projet::where('reference','LIKE','%'.$query.'%')->get();
        return ProjetResource::collection($projets);
    }
}
