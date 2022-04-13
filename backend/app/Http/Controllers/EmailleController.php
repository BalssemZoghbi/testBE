<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emaille;
use App\Models\Hbrin;
use App\Models\Saillie;
use App\Models\Tole;

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
        ["induction"=>0.4,"M110-23"=>0.5,"M120-27"=>0.061,"M130-30"=>0.066,"H75-23"=>0.047,"H80-23"=>0.045,"H85-23"=>0.046,"H95-27"=>0.055,"H105-30"=>0.067],
        ["induction"=>0.5,"M110-23"=>0.75,"M120-27"=>0.093,"M130-30"=>0.099,"H75-23"=>0.07,"H80-23"=>0.069,"H85-23"=>0.07,"H95-27"=>0.084,"H105-30"=>0.101],
        ["induction"=>0.6,"M110-23"=>0.108,"M120-27"=>0.131,"M130-30"=>0.14,"H75-23"=>0.097,"H80-23"=>0.096,"H85-23"=>0.099,"H95-27"=>0.117,"H105-30"=>0.141],
        ["induction"=>0.7,"M110-23"=>0.145,"M120-27"=>0.176,"M130-30"=>0.187,"H75-23"=>0.128,"H80-23"=>0.128,"H85-23"=>0.133,"H95-27"=>0.155,"H105-30"=>0.186],
        ["induction"=>0.8,"M110-23"=>0.189,"M120-27"=>0.227,"M130-30"=>0.241,"H75-23"=>0.164,"H80-23"=>0.164,"H85-23"=>0.171,"H95-27"=>0.198,"H105-30"=>0.237],
        ["induction"=>0.9,"M110-23"=>0.238,"M120-27"=>0.284,"M130-30"=>0.301,"H75-23"=>0.204,"H80-23"=>0.205,"H85-23"=>0.214,"H95-27"=>0.246,"H105-30"=>0.293],
        ["induction"=>1,"M110-23"=>0.294,"M120-27"=>0.348,"M130-30"=>0.369,"H75-23"=>0.25,"H80-23"=>0.25,"H85-23"=>0.263,"H95-27"=>0.299,"H105-30"=>0.356],
        ["induction"=>1.1,"M110-23"=>0.355,"M120-27"=>0.418,"M130-30"=>0.445,"H75-23"=>0.302,"H80-23"=>0.301,"H85-23"=>0.316,"H95-27"=>0.357,"H105-30"=>0.424],
        ["induction"=>1.2,"M110-23"=>0.423,"M120-27"=>0.495,"M130-30"=>0.529,"H75-23"=>0.36,"H80-23"=>0.358,"H85-23"=>0.375,"H95-27"=>0.421,"H105-30"=>0.5],
        ["induction"=>1.3,"M110-23"=>0.5,"M120-27"=>0.579,"M130-30"=>0.622,"H75-23"=>0.423,"H80-23"=>0.421,"H85-23"=>0.439,"H95-27"=>0.491,"H105-30"=>0.583],
        ["induction"=>1.35,"M110-23"=>0.542,"M120-27"=>0.625,"M130-30"=>0.672,"H75-23"=>0.456,"H80-23"=>0.455,"H85-23"=>0.474,"H95-27"=>0.529,"H105-30"=>0.627],
        ["induction"=>1.4,"M110-23"=>0.588,"M120-27"=>0.674,"M130-30"=>0.726,"H75-23"=>0.49,"H80-23"=>0.489,"H85-23"=>0.512,"H95-27"=>0.57,"H105-30"=>0.673],
        ["induction"=>1.45,"M110-23"=>0.639,"M120-27"=>0.728,"M130-30"=>0.784,"H75-23"=>0.524,"H80-23"=>0.526,"H85-23"=>0.55,"H95-27"=>0.612,"H105-30"=>0.722],
        ["induction"=>1.5,"M110-23"=>0.694,"M120-27"=>0.786,"M130-30"=>0.843,"H75-23"=>0.54,"H80-23"=>0.566,"H85-23"=>0.591,"H95-27"=>0.658,"H105-30"=>0.772],
        ["induction"=>1.55,"M110-23"=>0.759,"M120-27"=>0.853,"M130-30"=>0.916,"H75-23"=>0.6,"H80-23"=>0.607,"H85-23"=>0.636,"H95-27"=>0.708,"H105-30"=>0.826],
        ["induction"=>1.60,"M110-23"=>0.836,"M120-27"=>0.932,"M130-30"=>0.994,"H75-23"=>0.642,"H80-23"=>0.654,"H85-23"=>0.686,"H95-27"=>0.764,"H105-30"=>0.883],
        ["induction"=>1.65,"M110-23"=>0.934,"M120-27"=>1.03,"M130-30"=>1.087,"H75-23"=>0.687,"H80-23"=>0.705,"H85-23"=>0.742,"H95-27"=>0.828,"H105-30"=>0.947],
        ["induction"=>1.7,"M110-23"=>1.064,"M120-27"=>1.16,"M130-30"=>1.2,"H75-23"=>0.74,"H80-23"=>0.766,"H85-23"=>0.81,"H95-27"=>0.91,"H105-30"=>1.019],
        ["induction"=>1.75,"M110-23"=>1.233,"M120-27"=>1.332,"M130-30"=>1.348,"H75-23"=>0.809,"H80-23"=>0.844,"H85-23"=>0.897,"H95-27"=>1.016,"H105-30"=>1.11],
        ["induction"=>1.8,"M110-23"=>1.436,"M120-27"=>1.553,"M130-30"=>1.536,"H75-23"=>0.898,"H80-23"=>0.953,"H85-23"=>1.029,"H95-27"=>1.174,"H105-30"=>1.236],
    ];
    Tole ::insert($tole);
    }

}
