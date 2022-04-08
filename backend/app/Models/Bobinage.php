<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bobinage extends Model
{
    use HasFactory;
    // protected $table="bobinages";

    protected $fillable= [
        'materiau',
        'conducteur',
        'type',
    ];
    public function projets(){
        return $this->hasMany(Projet::class);
    }
}
