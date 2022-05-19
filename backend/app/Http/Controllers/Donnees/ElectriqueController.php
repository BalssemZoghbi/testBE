<?php

namespace App\Http\Controllers\Donnees;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ElectriqueResource;
use App\Models\Donnees\electrique\Electrique;
use App\Models\Donnees\electrique\TensionElectrique;

class ElectriqueController extends Controller
{
    public function nbrePosition()
    {
        return $this->priseAdditive + $this->priseSoustractive + 1;
    }
    public function index()
    {
        $electriques = Electrique::all();

        return ElectriqueResource::collection($electriques);
    }
    public function getoneelec($id)
    {

        $electrique = Electrique::FindOrFail($id);
        return new ElectriqueResource($electrique);
    }

    public function tension($u1nRange)
    {
        $tension = null;
        switch ($u1nRange) {
            case $u1nRange < 1.1:
                $tension = TensionElectrique::where('tensionEleve', 1.10)->get()->first();
                break;

            case $u1nRange < 3.60:
                $tension = TensionElectrique::where('tensionEleve', 3.60)->get()->first();
                break;

            case $u1nRange < 7.20:
                $tension = TensionElectrique::where('tensionEleve', 7.20)->get()->first();
                break;

            case $u1nRange < 12.00:
                $tension = TensionElectrique::where('tensionEleve', 12.00)->get()->first();
                break;

            case $u1nRange < 17.50:
                $tension = TensionElectrique::where('tensionEleve', 17.50)->get()->first();
                break;

            case $u1nRange < 24.0:
                $tension = TensionElectrique::where('tensionEleve', 24.0)->get()->first();
                break;

            case $u1nRange < 36.0:
                $tension = TensionElectrique::where('tensionEleve', 36.0)->get()->first();
                break;

            case $u1nRange < 52.0:
                $tension = TensionElectrique::where('tensionEleve', 52.0)->get()->first();
                break;
            case $u1nRange < 72.5:
                $tension = TensionElectrique::where('tensionEleve', 72.5)->get()->first();
                break;
            case $u1nRange < 100.0:
                $tension = TensionElectrique::where('tensionEleve', 100.0)->get()->first();
                break;
            case $u1nRange < 123.0:
                $tension = TensionElectrique::where('tensionEleve', 123.0)->get()->first();
                break;
            case $u1nRange < 145.0:
                $tension = TensionElectrique::where('tensionEleve', 145.0)->get()->first();
                break;
            case $u1nRange < 170.0:
                $tension = TensionElectrique::where('tensionEleve', 170.0)->get()->first();
                break;
            case $u1nRange < 245.00:
                $tension = TensionElectrique::where('tensionEleve', 245.0)->get()->first();
                break;

            default:
                break;
        }
        return $tension;
    }
    public function couplage($couplage, $u1n, $puissance)
    {
        $Uligne = null;
        $UPhase = null;
        $Iligne = null;
        $IPhase = null;
        $Uz = 0;
        switch ($couplage) {
            case in_array($couplage, ['D', 'd']):
                $Uligne = $u1n;
                $UPhase = $u1n;
                $Iligne = ($puissance * 1000) / ($u1n * sqrt(3));
                $IPhase = $Iligne / sqrt(3);
                break;

            case in_array($couplage, ['YN', 'Y', 'y', 'yn']):
                $Uligne = $u1n;
                $UPhase = $Uligne / sqrt(3);
                $Iligne = ($puissance * 1000) / ($u1n * sqrt(3));
                $IPhase = $Iligne;
                break;

            case in_array($couplage, ['zn', 'z']):
                $Uligne = $u1n;
                $UPhase = $Uligne / sqrt(3);
                $Iligne = ($puissance * 1000) / ($u1n * sqrt(3));
                $IPhase = $Iligne;
                $Uz = ((2 * $Uligne) / 3) / 2;
                break;

            default:
                # code...
                break;
        }
        return array($Uligne, $UPhase, $Iligne, $IPhase, $Uz);
    }

    public function indice($couplage)
    {
        $indice = [];
        switch ($couplage) {
            case (in_array($couplage, ['Yz', 'YNzn', 'Dyn', 'Yzn', 'Dy'])):
                $indice = ['1', '5', '7', '11'];
                break;

            case $couplage = 'Dd':
                $indice = ['0', '2', '4', '6', '8', '10'];
                break;

            case ($couplage = 'Yy'):
                $indice = ['0', '6'];
                break;

            default:
                # code...
                break;
        }
        return $indice;
    }
    public function store()
    {

        $u1 = 36000 / 1000;
        $u2nRange = 400 / 1000;
        $tension = $this->tension($u1);
        $tension2 = $this->tension($u2nRange);
        list($PrimaireuLigne, $PrimaireuPhase, $PrimaireiLigne, $PrimaireiPhase) = $this->couplage('Y', 36000, 630);
        list($SecondaireuLigne, $SecondaireuPhase, $SecondaireiLigne, $SecondaireiPhase, $Uz) = $this->couplage('z', 400, 630);
        $couplage = 'Yz';
        $indice = $this->indice($couplage);
        if (in_array(1, $indice)) {
            $electrique = Electrique::create([
                'colonnes' => 4,
                'frequence' => 50,
                'pn' => 630,
                'u1n' => 36000,
                'u2o' => 400,
                'couplagePrimaire' => 'Y',
                'couplageSecondaire' => 'z',
                'indiceHoraire' => 1,
                'couplage' => $couplage,
                'classeU1' => $tension->tensionEleve,
                'tenueFr1' => $tension->tenueFr,
                'tenueChoc1' => $tension->tenueChoc,
                'tenueFr2' => $tension2->tenueFr,
                'tenueChoc2' => $tension2->tenueChoc,
                'classeU2' => $tension2->tensionEleve,
                'priseSoustractive' => 2,
                'priseAdditive' => 2,
                'echelonSousctractive' => 2.5,
                'echelonAdditive' => 2.5,
                'puissance' => 360,
                'PrimaireUligne' => $PrimaireuLigne,
                'PrimaireUPhase' => $PrimaireuPhase,
                'PrimaireIligne' => $PrimaireiLigne,
                'PrimaireIPhase' => $PrimaireiPhase,
                'secondaireUligne' => $SecondaireuLigne,
                'secondaireUPhase' => $SecondaireuPhase,
                'secondaireIligne' => $SecondaireiLigne,
                'secondaireIPhase' => $SecondaireiPhase,
                'Uz' => $Uz,
                'nbrePosition' => 5,
            ]);
            if ($electrique->save()) {
                return new ElectriqueResource($electrique);
            }
        } else {
            return 'indice horaire incorrect';
        }
    }

    public function edit($id, Request $request)
    {
        $projet = DB::table('projets')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->where('projets.id', $id)
            ->select()
            ->get()->first();
        $electrique = Electrique::FindOrFail($projet->electrique_id);
        $u1nRange = $request->u1n / 1000;
        $u2nRange = $request->u2o / 1000;
        $tension = $this->tension($u1nRange);
        $tension2 = $this->tension($u2nRange);
        list($PrimaireuLigne, $PrimaireuPhase, $PrimaireiLigne, $PrimaireiPhase) = $this->couplage($request->couplagePrimaire, $request->u1n, $request->puissance);
        list($SecondaireuLigne, $SecondaireuPhase, $SecondaireiLigne, $SecondaireiPhase, $Uz) = $this->couplage($request->couplageSecondaire, $request->u2o, $request->puissance);
        $couplage = $request->couplagePrimaire . $request->couplageSecondaire . $request->indiceHoraire;
        $indice = $this->indice($couplage);
        $electrique->update([
            'colonnes' => $request->colonnes,
            'frequence' => $request->frequence,
            'u1n' => $request->u1n,
            'u2o' => $request->u2o,
            'couplagePrimaire' => $request->couplagePrimaire,
            'couplageSecondaire' => $request->couplageSecondaire,
            'indiceHoraire' => $request->indiceHoraire,
            'couplage' => $couplage,
            'classeU1' => $tension->tensionEleve,
            'tenueFr1' => $tension->tenueFr,
            'tenueChoc1' => $tension->tenueChoc,
            'tenueFr2' => $tension2->tenueFr,
            'tenueChoc2' => $tension2->tenueChoc,
            'classeU2' => $tension2->tensionEleve,
            'priseSoustractive' => $request->priseSoustractive,
            'priseAdditive' => $request->priseAdditive,
            'echelonSousctractive' => $request->echelonSousctractive,
            'echelonAdditive' => $request->echelonAdditive,
            'puissance' => $request->puissance,
            'PrimaireUligne' => $PrimaireuLigne,
            'PrimaireUPhase' => $PrimaireuPhase,
            'PrimaireIligne' => $PrimaireiLigne,
            'PrimaireIPhase' => $PrimaireiPhase,
            'secondaireUligne' => $SecondaireuLigne,
            'secondaireUPhase' => $SecondaireuPhase,
            'secondaireIligne' => $SecondaireiLigne,
            'secondaireIPhase' => $SecondaireiPhase,
            'Uz' => $Uz,
            'nbrePosition' => $request->priseSoustractive + $request->priseAdditive + 1,
        ]);


        if ($electrique->save()) {
            return new ElectriqueResource($electrique);
        }
    }

    public function delete($id)
    {
        $electrique = Electrique::FindOrFail($id);
        if ($electrique->delete()) {
            return new ElectriqueResource($electrique);
        }
    }
}
