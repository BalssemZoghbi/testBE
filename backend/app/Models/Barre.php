<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barre extends Model
{
    use HasFactory;
    protected $fillable= [
        'designation',
        'epaisseur',
        'largeur',
    ];
}
