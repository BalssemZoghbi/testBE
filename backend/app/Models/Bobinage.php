<?php

namespace App\Models;
use App\Models\Donnees\Projet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bobinage extends Model
{
    use HasFactory;
    // protected $table="bobinages";

    protected $fillable= [
        'materiau',
        'conducteur',
        'etageMT',
        'saillieMT',
        'hbrin1MT',
        'hbrin2MT',
        'nbBrin1MT',
        'nbBrin2MT',
        'scu1',
        'j1',
        'nbcoucheMT',
        'sp/coucheMT',
        'e1ax',
        'e1r',
        'rigiditePapierMT',
        'ep1PapierMT',
        'nbrPapierMT',
        'typeCanaux',
        'canauxMT',
        'lgCales',
        'canauxEp1Papier',
        'canauxNbrPapier',
        'Hspire',
        'HSFS',
        'HFS',
        'collierBT',
        'collierBT2',
        'CMBT',
        'N1cmax',
        'DintMT',
        'BintMT',
        'EpxMT',
        'EpyMT',
        'DextMT',
        'BextMT',
        'poidMT',
        'majPoid',
        'EpCylindre',
        'scu1d',
        'J1D',
        'D1d',
        'filobtenueNue',
        'filobtenueIsoler',
        'choix',
        'brinParallele',
        'SpchB',
        'NchB',
        'SpchA',
        'NchA',
        'HCondMt',
        'DistanceBTMT',
        'HCollier',
        'EpfeuillePapier',
        'EpaiseurPapier',
        'EpaisseurPapierCanaux',
        'HbobineBt'
    ];
    public function projets(){
        return $this->hasMany(Projet::class);
    }
}
