<?php

namespace App\Models\Donnees\garantie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantie36 extends Model
{
    use HasFactory;
    protected $table="garantie36s";
    protected $fillable= [
        'po',
        'pn',
        'lo',
        'pcc',
        'ucc'
    ];
    public function garantie(){
        return $this->hasMany(Garantie::class);
    }
}
