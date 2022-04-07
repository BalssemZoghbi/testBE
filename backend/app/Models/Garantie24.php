<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantie24 extends Model
{
    use HasFactory;
    protected $table="garantie24s";
    protected $fillable= [
        'po',
        'pn',
        'lo',
        'pcc',
        'ucc'
    ];
}
