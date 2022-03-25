<?php
namespace App\Http\Controllers\Donnees;
use App\Http\Controllers\Controller;

use App\Models\Donnees\TensionElectrique;
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
            ["tensionEleve"=>52, "tenueChoc"=>250, "tenueFr"=>95],
            ["tensionEleve"=>72.5, "tenueChoc"=>325, "tenueFr"=>140],
            ["tensionEleve"=>100, "tenueChoc"=>450, "tenueFr"=>185],
            ["tensionEleve"=>123, "tenueChoc"=>550, "tenueFr"=>230],
            ["tensionEleve"=>145, "tenueChoc"=>550, "tenueFr"=>230],
            ["tensionEleve"=>170, "tenueChoc"=>650, "tenueFr"=>275],
            ["tensionEleve"=>245, "tenueChoc"=>850, "tenueFr"=>360],
        ];
        TensionElectrique::insert($tension);
    }
}
