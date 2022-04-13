<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saillie extends Model
{
    use HasFactory;
    protected $fillable = [
        'valeur',
    ];
}
