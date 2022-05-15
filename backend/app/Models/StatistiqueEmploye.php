<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistiqueEmploye extends Model
{
    use HasFactory;
    protected $casts=[
        'ProjetChart'=>'array',
        'NbreProjet'=>'array',
    ];
    protected $fillable = [
        'ProjetChart',
        'NbreProjet',
        'NbreCuivre',
        'NbreAlu',
    ];
}
