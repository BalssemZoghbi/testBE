<?php

namespace App\Models;
use App\Models\Donnees\Projet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobinageSec extends Model
{
    use HasFactory;
    protected $fillable= [
        'materiauSec',
        'conducteurSec'
    ];
    public function projets(){
        return $this->hasMany(Projet::class);
    }
}
