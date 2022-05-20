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
    public function getGarantie($id)
    {
        $garanties = DB::table('projets')
            ->join('garanties', 'garanties.id', '=', 'projets.garantie_id')
            ->where('projets.id', $id)
            ->select()
            ->get()->first();
        $garantie = Garantie::FindOrFail($garanties->garantie_id);

        return response()->json($garantie);
    }
    public function get24()
    {
        $garanties24 = Garantie24::all();
        return response()->json($garanties24);
    }
    public function get36()
    {
        $garanties36 = Garantie36::all();
        return response()->json($garanties36);
    }
    public function create36(Request $request)
    {
        $garanties36 = Garantie36::create([
            'pn' => $request->pn,
            'po' => $request->po,
            'lo' => $request->lo,
            'pcc' => $request->pcc,
            'ucc' => $request->ucc
        ]);
        if ($garanties36->save()) {
            return response()->json($garanties36);
        }
    }
    public function create24(Request $request)
    {

        $garanties24 = Garantie24::create([
            'pn' => $request->pn,
            'po' => $request->po,
            'lo' => $request->lo,
            'pcc' => $request->pcc,
            'ucc' => $request->ucc
        ]);
        if ($garanties24->save()) {
            return response()->json($garanties24);
        }
    }
    public function update36($id, Request $request)
    {
        $garanties36 = Garantie36::FindOrFail($id);
        $garanties36->update([
            'pn' => $request->pn,
            'po' => $request->po,
            'lo' => $request->lo,
            'pcc' => $request->pcc,
            'ucc' => $request->ucc
        ]);
        if ($garanties36->save()) {
            return response()->json($garanties36);
        }
    }
    public function update24($id, Request $request)
    {
        $garanties24 = Garantie24::FindOrFail($id);
        $garanties24->update([
            'pn' => $request->pn,
            'po' => $request->po,
            'lo' => $request->lo,
            'pcc' => $request->pcc,
            'ucc' => $request->ucc
        ]);
        if ($garanties24->save()) {
            return response()->json($garanties24);
        }
    }
    public function deletegar36($id)
    {
        $garantie = Garantie36::FindOrFail($id);
        $garantie->delete();
        return response()->json($garantie);
    }
    public function deletegar24($id)
    {
        $garantie = Garantie24::FindOrFail($id);
        $garantie->delete();
        return response()->json($garantie);
    }

    public function calcul24($puissance)
    {
        $garantie24 = Garantie24::where('pn', $puissance)->get()->first();
        return $garantie24;
    }
    public function calcul36($puissance)
    {
        $garantie36 = Garantie36::where('pn', $puissance)->get()->first();
        return $garantie36;
    }
    public function edit($id)
    {

        $projet = DB::table('projets')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('garanties', 'garanties.id', '=', 'projets.garantie_id')
            ->where('projets.id', $id)
            ->select('projets.garantie_id', 'electriques.puissance', 'electriques.u1n', 'electriques.u2o', 'projets.temperatureMax')
            ->get()->first();
        if ($projet->u1n > $projet->u2o) {
            $max = $projet->u1n;
        } else {
            $max = $projet->u2o;
        }
        if ($max < 24000) {
            $calcul = $this->calcul24($projet->puissance);
            $option = "StandardTri24KV";
        } else {
            $calcul =  $this->calcul36($projet->puissance);
            $option = "StandardTri36KV";
        }
        $garantie = Garantie::FindOrFail($projet->garantie_id);
        $garantie->update([
            'option' => $option,
            'Pog' => $calcul->po,
            'log' => $calcul->lo,
            'Pccg' => $calcul->pcc,
            'Uccg' => $calcul->ucc,
            'Ptot' => $calcul->pcc + $calcul->po,
            'Poglimit' => $calcul->po + (($calcul->po * 15) / 100),
            'loglimit' => $calcul->lo + (($calcul->lo * 30) / 100),
            'Pccglimit' => $calcul->pcc + (($calcul->pcc * 15) / 100),
            'Uccglimit' => $calcul->ucc + (($calcul->ucc * 10) / 100),
            'UccgMin' => $calcul->ucc - (($calcul->ucc * 10) / 100),
            'Ptotlimit' => $calcul->pcc + $calcul->po + ((($calcul->pcc + $calcul->po) * 10) / 100),
            'echauffementHuile' => 100 - $projet->temperatureMax,
            'echauffementEnroulement' => 105 - $projet->temperatureMax,
        ]);

        return response()->json($garantie);
    }
    public function updateManuelle($id, Request $request)
    {

        $projet = DB::table('projets')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('garanties', 'garanties.id', '=', 'projets.garantie_id')
            ->where('projets.id', $id)
            ->select('projets.garantie_id', 'electriques.puissance', 'electriques.u1n', 'electriques.u2o', 'projets.temperatureMax')
            ->get()->first();
        $garantie = Garantie::FindOrFail($projet->garantie_id);
        $garantie->update([
            'option' => $request->option,
            'Pog' => $request->Pog,
            'log' => $request->log,
            'Pccg' => $request->Pccg,
            'Uccg' => $request->Uccg,
            'Ptot' => $request->pcc + $request->Pog,
            'Poglimit' => $request->Pog + (($request->Pog * 15) / 100),
            'loglimit' => $request->log + (($request->log * 30) / 100),
            'Pccglimit' => $request->Pccg + (($request->Pccg * 15) / 100),
            'Uccglimit' => $request->Uccg + (($request->Uccg * 10) / 100),
            'UccgMin' => $request->Uccg - (($request->Uccg * 10) / 100),
            'Ptotlimit' => $request->Pccg + $request->Pog + ((($request->Pccg + $request->Pog) * 10) / 100),
            'echauffementHuile' => 100 - $projet->temperatureMax,
            'echauffementEnroulement' => 105 - $projet->temperatureMax,
        ]);

        return response()->json($garantie);
    }

    public function garantie36()
    {
        $garantie36 = [
            ["pn" => 25, "po" => 200, "lo" => 7.9, "pcc" => 800, "ucc" => 4.5],
            ["pn" => 40, "po" => 230, "lo" => 6.3, "pcc" => 870, "ucc" => 4.5],
            ["pn" => 50, "po" => 260, "lo" => 5, "pcc" => 1450, "ucc" => 4.5],
            ["pn" => 63, "po" => 300, "lo" => 4.8, "pcc" => 1640, "ucc" => 4.5],
            ["pn" => 80, "po" => 360, "lo" => 4.5, "pcc" => 1980, "ucc" => 4.5],
            ["pn" => 100, "po" => 400, "lo" => 4.4, "pcc" => 2340, "ucc" => 4.5],
            ["pn" => 125, "po" => 460, "lo" => 4.1, "pcc" => 2790, "ucc" => 4.5],
            ["pn" => 160, "po" => 530, "lo" => 3.9, "pcc" => 3330, "ucc" => 4.5],
            ["pn" => 200, "po" => 600, "lo" => 3.7, "pcc" => 3980, "ucc" => 4.5],
            ["pn" => 250, "po" => 750, "lo" => 3.5, "pcc" => 4230, "ucc" => 4.5],
            ["pn" => 315, "po" => 920, "lo" => 3.4, "pcc" => 5200, "ucc" => 4.5],
            ["pn" => 400, "po" => 1160, "lo" => 3.2, "pcc" => 6210, "ucc" => 4.5],
            ["pn" => 500, "po" => 1300, "lo" => 3.1, "pcc" => 7400, "ucc" => 4.5],
            ["pn" => 630, "po" => 1600, "lo" => 2.9, "pcc" => 8820, "ucc" => 4.5],
            ["pn" => 800, "po" => 1800, "lo" => 2.8, "pcc" => 12500, "ucc" => 5],
            ["pn" => 1000, "po" => 1900, "lo" => 2.7, "pcc" => 14000, "ucc" => 5.5],
            ["pn" => 1250, "po" => 2500, "lo" => 2.5, "pcc" => 18500, "ucc" => 6],
            ["pn" => 1600, "po" => 2900, "lo" => 2.2, "pcc" => 21500, "ucc" => 6.5],
            ["pn" => 2000, "po" => 3430, "lo" => 2.1, "pcc" => 27300, "ucc" => 7],
            ["pn" => 2500, "po" => 3870, "lo" => 1.9, "pcc" => 30500, "ucc" => 7.5],
            ["pn" => 3150, "po" => 4600, "lo" => 1.8, "pcc" => 36800, "ucc" => 7.5],
        ];
        Garantie36::insert($garantie36);
    }
    public function garantie24()
    {
        $garantie = [
            ["pn" => 25, "po" => 140, "lo" => 3.3, "pcc" => 700, "ucc" => 4],
            ["pn" => 40, "po" => 190, "lo" => 3, "pcc" => 900, "ucc" => 4],
            ["pn" => 50, "po" => 220, "lo" => 2.9, "pcc" => 1320, "ucc" => 4],
            ["pn" => 63, "po" => 235, "lo" => 2.8, "pcc" => 1500, "ucc" => 4],
            ["pn" => 75, "po" => 285, "lo" => 2.7, "pcc" => 1650, "ucc" => 4],
            ["pn" => 80, "po" => 320, "lo" => 2.6, "pcc" => 1800, "ucc" => 4],
            ["pn" => 100, "po" => 330, "lo" => 2.5, "pcc" => 2100, "ucc" => 4],
            ["pn" => 125, "po" => 400, "lo" => 2.4, "pcc" => 2250, "ucc" => 4],
            ["pn" => 160, "po" => 530, "lo" => 2.3, "pcc" => 2600, "ucc" => 4],
            ["pn" => 200, "po" => 570, "lo" => 2.2, "pcc" => 3000, "ucc" => 4],
            ["pn" => 250, "po" => 600, "lo" => 2.1, "pcc" => 3800, "ucc" => 4],
            ["pn" => 300, "po" => 780, "lo" => 2, "pcc" => 4300, "ucc" => 4],
            ["pn" => 315, "po" => 840, "lo" => 2, "pcc" => 4400, "ucc" => 4],
            ["pn" => 400, "po" => 930, "lo" => 1.9, "pcc" => 5100, "ucc" => 4],
            ["pn" => 500, "po" => 1180, "lo" => 1.9, "pcc" => 6000, "ucc" => 4],
            ["pn" => 630, "po" => 1320, "lo" => 1.8, "pcc" => 7900, "ucc" => 4],
            ["pn" => 800, "po" => 1600, "lo" => 2.5, "pcc" => 12000, "ucc" => 4.5],
            ["pn" => 1000, "po" => 1800, "lo" => 2.4, "pcc" => 13300, "ucc" => 5],
            ["pn" => 1250, "po" => 2160, "lo" => 2.2, "pcc" => 17600, "ucc" => 5.5],
            ["pn" => 1600, "po" => 2540, "lo" => 2, "pcc" => 20500, "ucc" => 6],
            ["pn" => 2000, "po" => 3300, "lo" => 1.9, "pcc" => 26000, "ucc" => 6.5],
            ["pn" => 2500, "po" => 3680, "lo" => 1.8, "pcc" => 29000, "ucc" => 7],
            ["pn" => 3150, "po" => 4360, "lo" => 1.7, "pcc" => 35000, "ucc" => 7],

        ];
        Garantie24::insert($garantie);
    }
}
