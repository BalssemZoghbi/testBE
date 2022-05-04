<?php

namespace App\Models\Donnees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PccUcc extends Model
{
    use HasFactory;
    protected $fillable = [
            'MajourationU',
            'pcc1',
            'pcc2',
            'pccMaj',
            'Pccg',
            'Uccr',
            'Ucca',
            'Ucc',
            'Uccg',
    ];
}
