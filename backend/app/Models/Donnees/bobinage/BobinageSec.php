<?php

namespace App\Models\Donnees\bobinage;
use App\Models\Donnees\Projet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobinageSec extends Model
{
    use HasFactory;
    protected $fillable= [
        'materiauSec',
        'conducteurSec',
        'etage',
        'saillie',
        'hbrin1',
        'hbrin2',
        'nbBrin1',
        'nbBrin2',
        'scu2',
        'j2',
        'nbcouche',
        'sp/couche',
        'e2ax',
        'e2r',
        'rigiditePapier',
        'ep1Papier',
        'nbrPapier',
        'typeCanaux',
        'canauxBT',
        'lgCales',
        'canauxEp1Papier',
        'canauxNbrPapier',
        'Hspire',
        'HSFS',
        'HFS',
        'collierBT',
        'collierBT2',
        'CMBT',
        'Dint',
        'Bint',
        'Epx',
        'Epy',
        'DextBT',
        'Bext',
        'poidBT',
        'majPoid',
        'Hfeuillard',
        'HbobineBt',
        'epFeuil1',
        'epFeuil2',
        'epFeuillard',
        'ep2Papier',
        'nbrPap2',
        'ePap',
        'epFeuilPap',
        'nbrPap1',
        'EpPapier',
        'EpCylindre',
        'Epbarre',
        'epaisseurBarre',
        'largeurBarre',
        'Sbarre',
        'Jbarre',
        'scu2d',
        'J2D',
        'D2d',
        'filobtenueNue',
        'filobtenueIsoler',
        'choix',
        'brinParallele',
        'nbCoucheBt',
        'SpchB',
        'NchB',
        'SpchA',
        'NchA',
        'HCondBt',
        'HCollier',
        'EpfeuillePapier',
        'nbrPapier',
        'EpaiseurPapier',
        'N1cmax'
    ];
    public function projets(){
        return $this->hasMany(Projet::class);
    }
}
