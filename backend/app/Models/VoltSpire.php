<?php

namespace App\Models;
use App\Models\Donnees\Projet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoltSpire extends Model
{
    use HasFactory;
    protected $casts=[
        'prise'=>'array',
        'spire'=>'array'
    ];
    protected $fillable= [
        'Bmaxdesire',
        'Bmax',
        'Vsp',
        'N2c',
        'N1c',
        'prise',
        'spire'
    ];
    public function projets(){
        return $this->hasMany(Projet::class);
    }
}
