<?php

namespace App\Models\Donnees\garantie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantie extends Model
{
    use HasFactory;
    protected $fillable= [
        'option',
        'Pog',
        'log',
        'Pccg',
        'Uccg',
        'UccgMin',
        'Ptot',
        'Poglimit',
        'loglimit',
        'Pccglimit',
        'Uccglimit',
        'Ptotlimit',
        'echauffementHuile',
        'echauffementEnroulement',
    ];

    public function projets(){
        return $this->hasMany(Projet::class);
    }
}
