<?php

namespace App\Models\Donnees\bobinage;

use App\Models\Donnees\Projet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonneBobine extends Model
{
    use HasFactory;
    protected $fillable= [
        'materiauMT',
        'conducteurMT',
        'materiauBT',
        'conducteurBT',
        'projets_id',
    ];

    public function projets(){
        return $this->hasMany(Projet::class);
    }
}

