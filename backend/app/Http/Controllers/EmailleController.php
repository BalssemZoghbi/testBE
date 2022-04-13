<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emaille;
class EmailleController extends Controller
{
    public function add(){
        $Emaille=[
            ["Designation"=>0.4, "Isole"=>0.47],
            ["Designation"=>0.5, "Isole"=>0.57],
            ["Designation"=>0.56, "Isole"=>0.63],
            ["Designation"=>0.6, "Isole"=>0.67],
            ["Designation"=>0.63, "Isole"=>0.7],
            ["Designation"=>0.65, "Isole"=>0.72],
            ["Designation"=>0.67, "Isole"=>0.74],
            ["Designation"=>0.71, "Isole"=>0.78],
            ["Designation"=>0.75, "Isole"=>0.84],
            ["Designation"=>0.8, "Isole"=>0.89],
            ["Designation"=>0.85, "Isole"=>0.94],
            ["Designation"=>0.9, "Isole"=>0.99],
            ["Designation"=>0.95, "Isole"=>1.04],
            ["Designation"=>1, "Isole"=>1.1],
            ["Designation"=>1.06, "Isole"=>1.16],
            ["Designation"=>1.12, "Isole"=>1.22],
            ["Designation"=>1.18, "Isole"=>1.28],
            ["Designation"=>1.25, "Isole"=>1.35],
            ["Designation"=>1.32, "Isole"=>1.42],
            ["Designation"=>1.4, "Isole"=>1.5],
            ["Designation"=>1.5, "Isole"=>1.6],
            ["Designation"=>1.6, "Isole"=>1.7],
            ["Designation"=>1.7, "Isole"=>1.8],
            ["Designation"=>1.8, "Isole"=>1.9],
            ["Designation"=>1.9, "Isole"=>2],
            ["Designation"=>2, "Isole"=>2.1],
            ["Designation"=>2.12, "Isole"=>2.22],
            ["Designation"=>2.24, "Isole"=>2.34],
            ["Designation"=>2.36, "Isole"=>2.46],
            ["Designation"=>2.4, "Isole"=>2.5],
            ["Designation"=>2.5, "Isole"=>2.6],
            ["Designation"=>2.65, "Isole"=>2.75],
            ["Designation"=>2.8, "Isole"=>2.9],
            ["Designation"=>2.9, "Isole"=>3],
            ["Designation"=>3, "Isole"=>3.1],
            ["Designation"=>3.15, "Isole"=>3.25],
            ["Designation"=>3.35, "Isole"=>3.45],
            ["Designation"=>3.5, "Isole"=>3.6],
            ["Designation"=>3.55, "Isole"=>3.65],
            ["Designation"=>3.75, "Isole"=>3.85],
            ["Designation"=>3.9, "Isole"=>4],
            ["Designation"=>4, "Isole"=>4.1]


        ];
        Emaille ::insert($Emaille);
    }
    // $Meplat=[
    //     ["saillie"=>2, "Hbrin"=>2.24],
    //     ["saillie"=>2.12, "Hbrin"=>2.36],
    //     ["saillie"=>2.24, "Hbrin"=>2.5],
    //     ["saillie"=>2.36, "Hbrin"=>2.65],
    //     ["saillie"=>2.5, "Hbrin"=>2.8],
    //     ["saillie"=>2.65, "Hbrin"=>3],
    //     ["saillie"=>2.80, "Hbrin"=>3.15],
    //     ["saillie"=>3.00, "Hbrin"=>3.35],
    //     ["saillie"=>3.15, ],
    //     ["saillie"=>3.35, ],
    //     ["saillie"=>3.55,],
    //     ["saillie"=>3.75,],
    //     ["saillie"=>4, ],
    //     ["saillie"=>4.25,],
    //     ["saillie"=>4.5, ],
    //     ["saillie"=>4.75,],
    //     ["saillie"=>5, ],
    //     ["saillie"=>6,],
    // ];
}
