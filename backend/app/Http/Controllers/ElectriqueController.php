<?php

namespace App\Http\Controllers;

use App\Http\Resources\ElectriqueResource;
use App\Models\Electrique;
use Illuminate\Http\Request;

class ElectriqueController extends Controller
{
    public function index()
    {
        $electriques =Electrique::all();
        return ElectriqueResource::collection($electriques);
    }
    public function getoneelec($id)
    {
        $electrique =Electrique::FindOrFail($id);
        return ElectriqueResource::collection($electrique);
    }
}
