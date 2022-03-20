<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    'echangeurs',
    'dielectrique',
    'fonctionnement',
    'refroidissement',
];

}
