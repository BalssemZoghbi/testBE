<?php

namespace App\Models;
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
        'Dext',
        'Bext',
        'poidBT',
        'majPoid',
        'HBOBT',
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
        'scu1d',
        'J1D',
        'D1d',
        'filobtenueNue',
        'filobtenueIsoler',
        'choix',
         'brinParallele',
        'nbCoucheMt',
        'SpchB',
        'NchB',
        'SpchA',
        'NchA',
        'HCondMt',
        'HCollier',
        'EpfeuillePapier',
        'nbrPapier',
        'EpaiseurPapier',
    ];
    public function projets(){
        return $this->hasMany(Projet::class);
    }
}
