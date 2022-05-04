<?php

namespace App\Http\Controllers\projet;

use App\Http\Controllers\Controller;
use App\Models\Donnees\bobinage\Emaille;
use App\Models\Donnees\bobinage\Hbrin;
use App\Models\Donnees\bobinage\Saillie;
use App\Models\Donnees\gradin\Tole;
use Illuminate\Http\Request;


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
    public function addSaillie(){
         $saillie=[
        ["valeur"=>2],
        ["valeur"=>2.12],
        ["valeur"=>2.24],
        ["valeur"=>2.36],
        ["valeur"=>2.5],
        ["valeur"=>2.65],
        ["valeur"=>2.80],
        ["valeur"=>3.00],
        ["valeur"=>3.15],
        ["valeur"=>3.35],
        ["valeur"=>3.55],
        ["valeur"=>3.75],
        ["valeur"=>4],
        ["valeur"=>4.25],
        ["valeur"=>4.5],
        ["valeur"=>4.75],
        ["valeur"=>5],
        ["valeur"=>6],
        ["valeur"=>7],
    ];
    Saillie ::insert($saillie);
    }
    public function addHbrin(){
         $Hbrin=[
        ["valeurHbrin"=>2.24],
        ["valeurHbrin"=>2.36],
        ["valeurHbrin"=>2.5],
        ["valeurHbrin"=>2.65],
        ["valeurHbrin"=>2.80],
        ["valeurHbrin"=>3.0],
        ["valeurHbrin"=>3.15],
        ["valeurHbrin"=>3.35],
        ["valeurHbrin"=>3.55],
        ["valeurHbrin"=>3.75],
        ["valeurHbrin"=>4],
        ["valeurHbrin"=>4.25],
        ["valeurHbrin"=>4.5],
        ["valeurHbrin"=>4.75],
        ["valeurHbrin"=>5],
        ["valeurHbrin"=>6],
        ["valeurHbrin"=>7],
        ["valeurHbrin"=>7.1],
        ["valeurHbrin"=>7.5],
        ["valeurHbrin"=>8],
        ["valeurHbrin"=>8.5],
        ["valeurHbrin"=>9],
        ["valeurHbrin"=>9.5],
        ["valeurHbrin"=>10],
        ["valeurHbrin"=>10.6],
        ["valeurHbrin"=>11.2],
        ["valeurHbrin"=>11.8],
        ["valeurHbrin"=>12.5],
        ["valeurHbrin"=>13.2],
        ["valeurHbrin"=>14],
        ["valeurHbrin"=>15],
        ["valeurHbrin"=>16.3],
    ];
    Hbrin ::insert($Hbrin);
    }
    public function addTole(){
         $tole=[
        ["tole"=>"M110-23","coef0"=>0.6871,"coef1"=>5.3047,"coef2"=>16.647,"coef3"=>25.755,"coef4"=>21.94,"coef5"=>9.6368,"coef6"=>1.7155],
        ["tole"=>"M120-27","coef0"=>0.9095,"coef1"=>7.5868,"coef2"=>23.504,"coef3"=>35.929,"coef4"=>30.047,"coef5"=>12.927,"coef6"=>2.2477],
        ["tole"=>"M130-30","coef0"=>0.8455,"coef1"=>6.4205,"coef2"=>19.8,"coef3"=>29.836,"coef4"=>24.635,"coef5"=>10.447,"coef6"=>1.7901],
        ["tole"=>"H75-23","coef0"=>0.2649,"coef1"=>2.136,"coef2"=>7.2284,"coef3"=>11.466,"coef4"=>9.9941,"coef5"=>4.4096,"coef6"=>0.7742],
        ["tole"=>"H80-23","coef0"=>0.6898,"coef1"=>5.2224,"coef2"=>15.934,"coef3"=>23.768,"coef4"=>19.261,"coef5"=>7.9701,"coef6"=>1.3248],
        ["tole"=>"H85-23","coef0"=>0.9212,"coef1"=>6.8998,"coef2"=>20.718,"coef3"=>30.683,"coef4"=>24.668,"coef5"=>10.171,"coef6"=>1.6863],
        ["tole"=>"H95-27","coef0"=>1.0835,"coef1"=>8.1645,"coef2"=>24.683,"coef3"=>36.781,"coef4"=>29.731,"coef5"=>12.309,"coef6"=>2.0518],
        ["tole"=>"H105-30","coef0"=>0.8277,"coef1"=>6.2168,"coef2"=>18.91,"coef3"=>27.854,"coef4"=>22.323,"coef5"=>9.1423,"coef6"=>1.5047]

    ];
    Tole ::insert($tole);
    }

}
