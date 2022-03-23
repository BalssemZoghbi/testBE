<?php

namespace App\Http\Controllers;

use App\Models\TensionElectrique;
use Illuminate\Http\Request;

class TensionElectriqueController extends Controller
{
    public function add(){
        $tension=[
            ["tensionEleve"=>1.1, "tenueChoc"=>0, "tenueFr"=>3],
            ["tensionEleve"=>3.6, "tenueChoc"=>20, "tenueFr"=>10],
            ["tensionEleve"=>7.2, "tenueChoc"=>60, "tenueFr"=>20],
            ["tensionEleve"=>12, "tenueChoc"=>75, "tenueFr"=>28],
            ["tensionEleve"=>17.5, "tenueChoc"=>95, "tenueFr"=>38],
            ["tensionEleve"=>24, "tenueChoc"=>125, "tenueFr"=>50],
            ["tensionEleve"=>36, "tenueChoc"=>170, "tenueFr"=>70],
        ];
        TensionElectrique::insert($tension);
    }
}
