<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInactive extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'type',
        'password',
        'poste',
        'numero',
    ];
}
