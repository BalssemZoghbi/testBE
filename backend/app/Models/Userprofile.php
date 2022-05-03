<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userprofile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'type',
        'password',
        'poste',
        'numero',
        'image',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
