<?php

namespace App\Http\Controllers;
use App\Models\Bobinage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BobinageResource;

class BobinageController extends Controller
{
    public function getAllBobine()
    {
        $Bobinages =Bobinage::all();

        return BobinageResource::collection($Bobinages);
    }
    public function getOneBobine($id)
    {

        $Bobinage =Bobinage::FindOrFail($id);
        return new BobinageResource($Bobinage);
    }
    public function storeBobinage(Request $request){
   

        $Bobinage= Bobinage::create([
            'materiau'=> $request->materiau,
            'conducteur'=> $request->conducteur,
            
         ]);

         if($Bobinage->save()){
             return response()->json($Bobinage);
         }

     }
        public function updateBobinage(Request $request, $id){
            $Bobinage = Bobinage::FindOrFail($id);
            $Bobinage->update($request->all());
            return response()->json($Bobinage);
        }
        public function deleteBobinage($id){
            $Bobinage = Bobinage::FindOrFail($id);
            $Bobinage->delete();
            return response()->json('deleted');
        }
}
