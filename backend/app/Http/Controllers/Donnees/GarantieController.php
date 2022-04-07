<?php

namespace App\Http\Controllers\Donnees;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Donnees\garantie\Garantie;
use App\Models\Donnees\garantie\Garantie24;
use App\Models\Donnees\garantie\Garantie36;

class GarantieController extends Controller
{
    public function calcul24($puissance){
                $garantie24=Garantie24::where('Pn',$puissance)->get()->first();
        return $garantie24;
    }
    public function calcul36($puissance){
                $garantie36=Garantie36::where('Pn',$puissance)->get()->first();
        return $garantie36;
    }
    public function edit($id, Request $request){

        $projet = DB::table('projets')
        ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
        ->join('garanties', 'garanties.id', '=', 'projets.garantie_id')
        ->where('projets.id',$id)
        ->select('projets.garantie_id','electriques.puissance','electriques.u1n', 'electriques.u2o','projets.temperatureMax')
        ->get()->first();
        if($projet->u1n>$projet->u2o){
            $max=$projet->u1n;
        }else{
            $max=$projet->u2o;
        }
        if($max<36000){
           $calcul= $this->calcul24($projet->puissance);
           $option="StandardTri24KV";
        }else{
            $calcul=  $this->calcul36($projet->puissance);
            $option="StandardTri36KV";
        }
        $garantie= Garantie::FindOrFail($projet->garantie_id);
        $garantie->update([
             'option' => $option,
             'Pog' =>$calcul->po,
             'log' =>$calcul->lo,
             'Pccg' =>$calcul->pcc,
             'Uccg' => $calcul->ucc,
             'Ptot' =>$calcul->pcc+$calcul->po,
             'Poglimit' =>$calcul->po+(($calcul->po*15)/100),
             'loglimit' => $calcul->lo+(($calcul->lo*30)/100),
             'Pccglimit' =>$calcul->pcc+(($calcul->pcc*15)/100),
             'Uccglimit' =>$calcul->ucc+(($calcul->ucc*10)/100),
             'Ptotlimit' =>$calcul->pcc+$calcul->po+((($calcul->pcc+$calcul->po)*10)/100),
             'echauffementHuile' =>100 - $projet->temperatureMax,
             'echauffementEnroulement' =>105 - $projet->temperatureMax,
         ]);

             return response()->json($garantie);
     }

    public function garantie36(){
        $garantie36=[
            ["Pn"=>25, "Po"=>200, "lo"=>7.9, "Pcc"=>800, "Ucc"=>4.5],
            ["Pn"=>40, "Po"=>230, "lo"=>6.3, "Pcc"=>870, "Ucc"=>4.5],
            ["Pn"=>50, "Po"=>260, "lo"=>5, "Pcc"=>1450, "Ucc"=>4.5],
            ["Pn"=>63, "Po"=>300, "lo"=>4.8, "Pcc"=>1640, "Ucc"=>4.5],
            ["Pn"=>80, "Po"=>360, "lo"=>4.5, "Pcc"=>1980, "Ucc"=>4.5],
            ["Pn"=>100, "Po"=>400, "lo"=>4.4, "Pcc"=>2340, "Ucc"=>4.5],
            ["Pn"=>125, "Po"=>460, "lo"=>4.1, "Pcc"=>2790, "Ucc"=>4.5],
            ["Pn"=>160, "Po"=>530, "lo"=>3.9, "Pcc"=>3330, "Ucc"=>4.5],
            ["Pn"=>200, "Po"=>600, "lo"=>3.7, "Pcc"=>3980, "Ucc"=>4.5],
            ["Pn"=>250, "Po"=>750, "lo"=>3.5, "Pcc"=>4230, "Ucc"=>4.5],
            ["Pn"=>315, "Po"=>920, "lo"=>3.4, "Pcc"=>5200, "Ucc"=>4.5],
            ["Pn"=>400, "Po"=>1160, "lo"=>3.2, "Pcc"=>6210, "Ucc"=>4.5],
            ["Pn"=>500, "Po"=>1300, "lo"=>3.1, "Pcc"=>7400, "Ucc"=>4.5],
            ["Pn"=>630, "Po"=>1600, "lo"=>2.9, "Pcc"=>8820, "Ucc"=>4.5],
            ["Pn"=>800, "Po"=>1800, "lo"=>2.8, "Pcc"=>12500, "Ucc"=>5],
            ["Pn"=>1000, "Po"=>1900, "lo"=>2.7, "Pcc"=>14000, "Ucc"=>5.5],
            ["Pn"=>1250, "Po"=>2500, "lo"=>2.5, "Pcc"=>18500, "Ucc"=>6],
            ["Pn"=>1600, "Po"=>2900, "lo"=>2.2, "Pcc"=>21500, "Ucc"=>6.5],
            ["Pn"=>2000, "Po"=>3430, "lo"=>2.1, "Pcc"=>27300, "Ucc"=>7],
            ["Pn"=>2500, "Po"=>3870, "lo"=>1.9, "Pcc"=>30500, "Ucc"=>7.5],
            ["Pn"=>3150, "Po"=>4600, "lo"=>1.8, "Pcc"=>36800, "Ucc"=>7.5],
        ];
        Garantie36::insert($garantie36);
    }
    public function garantie24(){
        $garantie=[
            ["pn"=>25, "po"=>140, "lo"=>3.3,"pcc"=>700, "ucc"=>4],
            ["pn"=>40, "po"=>190, "lo"=>3,"pcc"=>900, "ucc"=>4],
            ["pn"=>50, "po"=>220, "lo"=>2.9,"pcc"=>1320, "ucc"=>4],
            ["pn"=>63, "po"=>235, "lo"=>2.8,"pcc"=>1500, "ucc"=>4],
            ["pn"=>75, "po"=>285, "lo"=>2.7,"pcc"=>1650, "ucc"=>4],
            ["pn"=>80, "po"=>320, "lo"=>2.6,"pcc"=>1800, "ucc"=>4],
            ["pn"=>100, "po"=>330, "lo"=>2.5,"pcc"=>2100, "ucc"=>4],
            ["pn"=>125, "po"=>400, "lo"=>2.4,"pcc"=>2250, "ucc"=>4],
            ["pn"=>160, "po"=>530, "lo"=>2.3,"pcc"=>2600, "ucc"=>4],
            ["pn"=>200, "po"=>570, "lo"=>2.2,"pcc"=>3000, "ucc"=>4],
            ["pn"=>250, "po"=>600, "lo"=>2.1,"pcc"=>3800, "ucc"=>4],
            ["pn"=>300, "po"=>780, "lo"=>2,"pcc"=>4300, "ucc"=>4],
            ["pn"=>315, "po"=>840, "lo"=>2,"pcc"=>4400, "ucc"=>4],
            ["pn"=>400, "po"=>930, "lo"=>1.9,"pcc"=>5100, "ucc"=>4],
            ["pn"=>500, "po"=>1180, "lo"=>1.9,"pcc"=>6000, "ucc"=>4],
            ["pn"=>630, "po"=>1320, "lo"=>1.8,"pcc"=>7900, "ucc"=>4],
            ["pn"=>800, "po"=>1600, "lo"=>2.5,"pcc"=>12000, "ucc"=>4.5],
            ["pn"=>1000, "po"=>1800, "lo"=>2.4,"pcc"=>13300, "ucc"=>5],
            ["pn"=>1250, "po"=>2160, "lo"=>2.2,"pcc"=>17600, "ucc"=>5.5],
            ["pn"=>1600, "po"=>2540, "lo"=>2,"pcc"=>20500, "ucc"=>6],
            ["pn"=>2000, "po"=>3300, "lo"=>1.9,"pcc"=>26000, "ucc"=>6.5],
            ["pn"=>2500, "po"=>3680, "lo"=>1.8,"pcc"=>29000, "ucc"=>7],
            ["pn"=>3150, "po"=>4360, "lo"=>1.7,"pcc"=>35000, "ucc"=>7],

        ];
        Garantie24::insert($garantie);
    }

}
