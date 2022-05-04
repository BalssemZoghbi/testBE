<?php

namespace App\Models;

use App\Models\Donnees\Projet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circuitmagnetique extends Model
{
    use HasFactory;
    protected $casts=[
        'LCM'=>'array',
        'masseFerCM'=>'array',
        'surfaceCM'=>'array',
    ];
    protected $fillable = [
        'masseFertot',
        'Bmax',
        'pFerspecifique',
        'Majferprop',
        'tole',
        'Majfer',
        'pFer',
        'pFergarantie',
        'Ex',
        'Hc',
        'E1',
        'E2',
        'E3',
        'E4',
        'Eh',
        'Ebc',
        'Longeurcuve',
        'Largeurcuve',
        'LCM',
        'masseFerCM',
        'surfaceCM',
        'Hauteurcuve',
    ];
    public function projets(){
        return $this->hasMany(Projet::class);
    }
}