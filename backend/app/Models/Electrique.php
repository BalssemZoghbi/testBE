<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electrique extends Model
{
    use HasFactory;
    protected $fillable= [
        'frequence',
        'pn',
        'u1n',
        'u2o',
        'couplagePrimaire',
        'couplageSecondaire',
        'indiceHoraire',
        'couplage',
        'priseSoustractive',
        'priseAdditive',
        'echelonSousctractive',
        'echelonAdditive',
        'variation',
        'puissance',
        'PrimaireUligne',
        'PrimaireUPhase',
        'PrimaireIligne',
        'PrimaireIPhase',
        'secondaireUligne',
        'secondaireUPhase',
        'secondaireIligne',
        'secondaireIPhase',
    ];
}
