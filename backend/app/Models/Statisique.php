<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statisique extends Model
{
    use HasFactory;
    protected $casts=[
        'UserChart'=>'array',
        'UserName'=>'array',
        'UserProjet'=>'array',
    ];
    protected $fillable = [
        'userCount',
        'projetCount',
        'UserChart',
        'UserName',
        'UserProjet'
    ];
}
