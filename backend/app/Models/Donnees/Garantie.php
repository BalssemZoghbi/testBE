<?php

namespace App\Models\Donnees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantie extends Model
{
    use HasFactory;
    public function garantie36s(){
        return $this->belongsTo(Garantie36::class);
    }
    public function projets(){
        return $this->hasMany(Projet::class);
    }
}
