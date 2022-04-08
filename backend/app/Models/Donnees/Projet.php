<?php

namespace App\Models\Donnees;

use App\Models\Donnees\Electrique;
use App\Models\Bobinage;

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
    'elaborateur',
    'user_id',
    'electrique_id',
    'garantie_id',
    'bobinage_id',
    'gradin_id',
];

     public function user(){
        return $this->belongsTo(User::class);
    }
    public function electrique()
    {
        return $this->belongsTo(Electrique::class);
    }
    public function garantie()
    {
        return $this->belongsTo(Garantie::class);
    }
    public function bobine()
    {
        return $this->belongsTo(Bobinage::class);
    }
    public function gradin()
    {
        return $this->belongsTo(Gradin::class);
    }

}
