<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gradin extends Model
{
    use HasFactory;
    protected $casts=[
        'largeur'=>'array',
        'epaisseur'=>'array'
    ];
    protected $fillable= [
        'tole',
        'diamPropose',
        'diamNominale',
        'pas',
        'coeffRemplissage',
        'nbrGradin',
        'demiGradin',
        'largeur',
        'epaisseur',
        'Sbrut',
        'Snette',
        'EpaisseurTot',
        'largeurMin',
        'CMBT',

    ];
    public function projets(){
        return $this->hasMany(Projet::class);
    }
}


