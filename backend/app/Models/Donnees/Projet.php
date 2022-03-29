<?php

namespace App\Models\Donnees;

use App\Models\Donnees\Electrique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projet extends Model
{
    use HasFactory;
    protected $fillable= [
    'appareil',
    'reference',
    'client',
    'refClient',
    'temperatureMax',
    'attitudeMax',
    'type',
    'remplissage',
    'installation',
    'montage',
    'echangeurs',
    'dielectrique',
    'fonctionnement',
    'refroidissement',
    'user_id',
    // 'projet_id',
];

     public function user(){
        return $this->belongsTo(User::class);
    }
    // public function electrique()
    // {
    //     return $this->belongsTo(Electrique::class);
    // }

}
