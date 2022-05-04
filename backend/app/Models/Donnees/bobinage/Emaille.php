<?php

namespace App\Models\Donnees\bobinage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emaille extends Model
{
    use HasFactory;
    protected $fillable= [
        'Designation',
        'Isole'
    ];
}
