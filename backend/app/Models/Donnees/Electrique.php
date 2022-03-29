<?php

namespace App\Models\Donnees;

use App\Models\Donnees\Projet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Electrique extends Model
{
    use HasFactory;
    protected $table="electriques";

    protected $fillable= [
        'colonnes',
        'frequence',
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
    // public function projet()
    // {
    //     return $this->hasOne(Projet::class);
    //     // return $this->hasOne(Projet::class,'projet_id','id');
    // }
    
    // public function projets(){
    //     return $this->hasMany(Projet::class);
    // }
}
