<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electrique extends Model
{
    use HasFactory;
    protected $table="electriques";

    protected $fillable= [
        'colonnes',
        'frequence',
        'pn',
        'u1n',
        'u2o',
        'couplagePrimaire',
        'couplageSecondaire',
        'indiceHoraire',
        'couplage',
        'classeU1',
        'tenueFr1',
        'tenueChoc1',
        'classeU2',
        'tenueFr2',
        'tenueChoc2',
        'priseSoustractive',
        'priseAdditive',
        'echelonSousctractive',
        'echelonAdditive',
        'puissance',
        'PrimaireUligne',
        'PrimaireUPhase',
        'PrimaireIligne',
        'PrimaireIPhase',
        'secondaireUligne',
        'secondaireUPhase',
        'secondaireIligne',
        'secondaireIPhase',
        'Uz',
        'nbrePosition',
    ];

    public function tensionElectriques()
    {
        return $this->belongsToMany(TensionElectrique::class,'electrique_tension_elecs');
    }
}
