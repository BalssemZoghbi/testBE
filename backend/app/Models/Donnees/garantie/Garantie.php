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
        'Ptot',
        'Poglimit',
        'loglimit',
        'Pccglimit',
        'Uccglimit',
        'Ptotlimit',
        'echauffementHuile',
        'echauffementEnroulement',
        'garantie36_id',
        'garantie24_id',
    ];
    public function garantie36s(){
        return $this->belongsTo(Garantie36::class);
    }
    public function projets(){
        return $this->hasMany(Projet::class);
    }
}
