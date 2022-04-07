<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garantie24;
class Garantie24Controller extends Controller
{
    public function add(){
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
