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
        'etageBT',
        'saillieBT',
        'hbrin1BT',
        'hbrin2BT',
        'nbBrin1BT',
        'nbBrin2BT',
        'scu2',
        'j2',
        'nbcoucheBT',
        'spCoucheBT',
        'e2ax',
        'e2r',
        'rigiditePapierBT',
        'ep1PapierBT',
        'nbrPapierBT',
        'typeCanauxBT',
        'canauxBT',
        'lgCalesBT',
        'canauxEp1PapierBT',
        'canauxNbrPapierBT',
        'HspireBT',
        'HSFSBT',
        'HFSBT',
        'collierBTSec',
        'collierBT2Sec',
        'CMBTSec',
        'DintBT',
        'BintBT',
        'EpxBT',
        'EpyBT',
        'DextBT',
        'BextBT',
        'poidBT',
        'majPoidBT',
        'HfeuillardBT',
        'HbobineBtSec',
        'epFeuil1BT',
        'epFeuil2BT',
        'epFeuillardBT',
        'ep2PapierBT',
        'nbrPap2BT',
        'ePapBT',
        'epFeuilPapBT',
        'nbrPap1BT',
        'EpPapierBT',
        'EpCylindreBT',
        'EpbarreBT',
        'epaisseurBarreBT',
        'largeurBarreBT',
        'SbarreBT',
        'JbarreBT',
        'scu2d',
        'J2D',
        'D2d',
        'filobtenueNueBT',
        'filobtenueIsolerBT',
        'choixBT',
        'brinParalleleBT',
        'nbCoucheBtBT',
        'SpchBBT',
        'NchBBT',
        'SpchABT',
        'NchABT',
        'HCondBt',
        'HCollierBT',
        'EpfeuillePapierBT',
        'nbrPapierBT',
        'EpaiseurPapierBT',
        'N2cmax',
        'DistanceBTMTSec',
        'EpaisseurPapierCanauxBT'
    ];
    public function projets(){
        return $this->hasMany(Projet::class);
    }
}
