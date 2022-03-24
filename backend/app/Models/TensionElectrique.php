<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TensionElectrique extends Model
{
    use HasFactory;
    protected $table="tension_electriques";
    protected $fillable= [
        'tensionEleve',
        'tenueChoc',
        'tenueFr',
    ];

    public function electriques()
    {
        return $this->belongsToMany(Electrique::class,'electrique_tension_elecs');
    }

}
