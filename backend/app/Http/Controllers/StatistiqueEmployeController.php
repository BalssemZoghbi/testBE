<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatistiqueEmploye;
use Illuminate\Support\Facades\DB;

class StatistiqueEmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $Vierge = DB::table('projets')->where('modele', 'Document Vierge')->get();
        // $FE = DB::table('projets')->where('modele', 'Modele Feuillard Emaille')->get();
        // $ME = DB::table('projets')->where('modele', 'Modele Meplat Emaille')->get();
        // $FM = DB::table('projets')->where('modele', 'Modele Feuillard Meplat')->get();
        // $ProjetChart = [];
        // $ProjetChart[0] = count($Vierge);
        // $ProjetChart[1] = count($FE);
        // $ProjetChart[2] = count($FM);
        // $ProjetChart[3] = count($ME);


        $projets = DB::table('projets')->get();
        $lengthProjet = count($projets);
        $DateProjet = [];
        $DateProjet = DB::table('projets')->get('created_at');
        for ($i = 0; $i < $lengthProjet; $i++) {
            $DateProjet[$i] = date('F', strtotime($DateProjet[$i]->created_at));
        }
        $month = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
        $count = 0;
        $countProjet = [];
        for ($j = 0; $j < count($month); $j++) {
            for ($i = 0; $i < count($DateProjet); $i++) {
                if ($month[$j] == $DateProjet[$i]) {
                    $count++;
                }
            }
            $countProjet[$j] = $count;
            $count = 0;
        }

        $cuivreP =count( DB::table('bobinages')->where('materiau', 'cuivre')->get());
        $cuivreS = count(DB::table('bobinage_secs')->where('materiauSec', 'cuivre')->get());
        $alumuniumP = count(DB::table('bobinages')->where('materiau', 'alumunium')->get());
        $alumuniumS = count(DB::table('bobinage_secs')->where('materiauSec', 'alumunium')->get());
// dd($cuivreP+$cuivreS);
        $statistiquecount = count(DB::table('statistique_employes')->get());
        if($statistiquecount==0){
        $stat = StatistiqueEmploye::create([
            'ProjetChart' => [0,5,6,8],
            'NbreProjet' => $countProjet,
            'NbreCuivre' => $cuivreP+$cuivreS,
            'NbreAlu' => $alumuniumP+$alumuniumS,
        ]);



    }else{
        $stat= StatistiqueEmploye::FindOrFail(1);
        $stat->update([
            'ProjetChart' => [0,5,6,8],
            'NbreProjet' => $countProjet,
            'NbreCuivre' => $cuivreP+$cuivreS,
            'NbreAlu' => $alumuniumP+$alumuniumS,
        ]);
    }
        if ($stat->save()) {
            return response()->json($stat);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatistiqueEmploye  $statistiqueEmploye
     * @return \Illuminate\Http\Response
     */
    public function show(StatistiqueEmploye $statistiqueEmploye)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatistiqueEmploye  $statistiqueEmploye
     * @return \Illuminate\Http\Response
     */
    public function edit(StatistiqueEmploye $statistiqueEmploye)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StatistiqueEmploye  $statistiqueEmploye
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatistiqueEmploye $statistiqueEmploye)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatistiqueEmploye  $statistiqueEmploye
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatistiqueEmploye $statistiqueEmploye)
    {
        //
    }
}
