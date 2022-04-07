<?php

namespace App\Http\Controllers\Donnees;
use App\Http\Controllers\Controller;

use App\Models\Donnees\Garantie36;
use Illuminate\Http\Request;

class GarantieController extends Controller
{
    public function add(){
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
}
