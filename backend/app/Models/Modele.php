<?php

namespace App\Models;

use App\Models\Donnees\Projet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    use HasFactory;
    protected $fillable = [
        'NomModele',
        'projet_id'
    ];
    public function projets(){
        return $this->hasMany(Projet::class);
    }

}
