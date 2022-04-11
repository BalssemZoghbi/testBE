<?php

namespace App\Http\Controllers;
use App\Models\BobinageSec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BobinageSecResource;
class BobinageSecController extends Controller
{
     public function getAllBobineS()
    {
        $Bobinages =BobinageSec::all();

        return BobinageSecResource::collection($Bobinages);

    }
    public function getOneBobine($id)
    {

        $Bobinage =BobinageSec::FindOrFail($id);
        return new BobinageSecResource($Bobinage);
    }
    public function storeBobinageS(Request $request){
   
        $Bobinage= BobinageSec::create([
            'materiauSec'=> $request->materiauSec,
            'conducteurSec'=> $request->conducteurSec
            
         ]);

         if($Bobinage->save()){
             return response()->json($Bobinage);
         }

     }
     public function updateBobinageS($id, Request $request){

        $projet = DB::table('projets')
        ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
        ->where('projets.id',$id)
        ->select('bobinage_secs.*','bobinage_secs.id as bobinages_secs_id', 'projets.*')
        ->get()->first();
        $Bobinage=BobinageSec::FindOrFail($projet->bobinages_secs_id);
        $Bobinage->update([
            'materiauSec'=> $request->materiauSec,
            'conducteurSec'=> $request->conducteurSec
         ]);

             return response()->json($Bobinage);
     }
     public function deleteBobinageS($id){
        $Bobinage = BobinageSec::FindOrFail($id);
        $Bobinage->delete();
        return response()->json('deleted');
    }

}
