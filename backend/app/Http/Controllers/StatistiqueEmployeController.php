<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class StatistiqueEmployeController extends Controller
{
    public function create()
    {
        $MeplatP =count( DB::table('donne_bobines')->where('conducteurMT', 'meplat guipé')->get());
        $MeplatS =count( DB::table('donne_bobines')->where('conducteurBT', 'meplat guipé')->get());
        $RondP =count( DB::table('donne_bobines')->where('conducteurMT', 'Rond emaille')->get());
        $RondS =count( DB::table('donne_bobines')->where('conducteurBT', 'Rond emaille')->get());
        $feuillardP =count( DB::table('donne_bobines')->where('conducteurMT', 'feuillard')->get());
        $feuillardS =count( DB::table('donne_bobines')->where('conducteurBT', 'feuillard')->get());
       $bobine=[];
       $bobine[0]=$MeplatP;
       $bobine[1]=$RondP;
       $bobine[2]=$feuillardP;
       $bobine[3]=$MeplatS;
       $bobine[4]=$RondS;
       $bobine[5]=$feuillardS;

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

        $modeles = DB::table('projets')->get();
            return response()->json([
                        'ProjetChart' => $bobine,
                        'NbreProjet' => $countProjet,
                        'NbreCuivre' => $cuivreP+$cuivreS,
                        'NbreAlu' => $alumuniumP+$alumuniumS,
                        'ModeleCount' => count($modeles),
            ]);
    }

}
