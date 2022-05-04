<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tole extends Model
{
    use HasFactory;
    protected $fillable = [
        'tole',
        'coef0',
        'coef1',
        'coef2',
        'coef3',
        'coef4',
        'coef5',
        'coef6',
    ];
}
