<?php

namespace App\Http\Controllers\Calcul\Bobinage;

use App\Http\Controllers\Controller;
use App\Models\Donnees\bobinage\DonneBobine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonneBobineController extends Controller
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
        //
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
     * @param  \App\Models\DonneBobine  $donneBobine
     * @return \Illuminate\Http\Response
     */
    public function show(DonneBobine $donneBobine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DonneBobine  $donneBobine
     * @return \Illuminate\Http\Response
     */
    public function edit(DonneBobine $donneBobine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DonneBobine  $donneBobine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $projet = DB::table('projets')
        ->join('donne_bobines', 'donne_bobines.id', '=', 'projets.donne_bobines_id')
        ->where('projets.id',$id)
        ->select()
        ->get()->first();
        $DonneBobine=DonneBobine::FindOrFail($projet->donne_bobines_id );
        $DonneBobine->update([
            'materiauMT'=> $request->materiauMT,
            'conducteurMT'=> $request->conducteurMT,
            'materiauBT'=> $request->materiauBT,
            'conducteurBT'=> $request->conducteurBT,
        ]);

    return response()->json($DonneBobine);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DonneBobine  $donneBobine
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonneBobine $donneBobine)
    {
        //
    }
}
