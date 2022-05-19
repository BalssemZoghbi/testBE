<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBobinageSecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bobinage_secs', function (Blueprint $table) {
            $table->id();
            $table->string('materiauSec')->nullable();
            $table->string('conducteurSec')->nullable();
            $table->enum('etageBT',['1','2'])->nullable();
            $table->float('saillieBT')->nullable();
            $table->float('hbrin1BT')->nullable();
            $table->float('hbrin2BT')->nullable();
            $table->float('nbBrin1BT')->nullable();
            $table->float('nbBrin2BT')->nullable();
            $table->float('scu2')->nullable();
            $table->float('j2')->nullable();
            $table->integer('nbcoucheBT')->nullable();
            $table->integer('spCoucheBT')->nullable();
            $table->float('e2ax')->nullable();
            $table->float('e2r')->nullable();
            $table->integer('rigiditePapierBT')->nullable();
            $table->float('ep1PapierBT')->nullable();
            $table->integer('nbrPapierBT')->nullable();
            $table->enum('typeCanauxBT',['complet','lune'])->nullable();
            $table->integer('canauxBT')->nullable();
            $table->integer('lgCalesBT')->nullable();
            $table->float('canauxEp1PapierBT')->nullable();
            $table->integer('canauxNbrPapierBT')->nullable();
            $table->float('HspireBT')->nullable();
            $table->float('HSFSBT')->nullable();
            $table->float('HFSBT')->nullable();
            $table->integer('collierBTSec')->nullable();
            $table->integer('collierBT2Sec')->nullable();
            $table->float('CMBTSec')->nullable();
            $table->float('DintBT')->nullable();
            $table->float('BintBT')->nullable();
            $table->float('EpxBT')->nullable();
            $table->float('EpyBT')->nullable();
            $table->float('DextBT')->nullable();
            $table->float('BextBT')->nullable();
            $table->float('poidBT')->nullable();
            $table->float('majPoidBT')->nullable();
            $table->integer('HfeuillardBT')->nullable();
            $table->integer('HbobineBtSec')->nullable();
            $table->float('epFeuil1BT')->nullable();
            $table->float('epFeuil2BT')->nullable();
            $table->float('epFeuillardBT')->nullable();
            $table->float('ep2PapierBT')->nullable();
            $table->integer('nbrPap2BT')->nullable();
            $table->float('ePapBT')->nullable();
            $table->float('epFeuilPapBT')->nullable();
            $table->integer('nbrPap1BT')->nullable();
            $table->float('EpPapierBT')->nullable();
            $table->float('EpCylindreBT')->nullable();
            $table->string('EpbarreBT')->nullable();
            $table->integer('epaisseurBarreBT')->nullable();
            $table->integer('largeurBarreBT')->nullable();
            $table->integer('SbarreBT')->nullable();
            $table->float('JbarreBT')->nullable();
            $table->float('scu2d')->nullable();
            $table->float('J2D')->nullable();
            $table->float('D2d')->nullable();
            $table->float('filobtenueNueBT')->nullable();
            $table->float('filobtenueIsolerBT')->nullable();
            $table->string('choixBT')->default('automatique')->nullable();
            $table->enum('brinParalleleBT',['1','2'])->nullable();
            $table->float('SpchBBT')->nullable();
            $table->float('NchBBT')->nullable();
            $table->float('SpchABT')->nullable();
            $table->float('NchABT')->nullable();
            $table->float('HCondBt')->nullable();
            $table->float('DistanceBTMTSec')->nullable();
            $table->float('HCollierBT')->nullable();
            $table->float('EpfeuillePapierBT')->nullable();
            $table->float('EpaiseurPapierBT')->nullable();
            $table->float('EpaisseurPapierCanauxBT')->nullable();
            $table->float('N2cmax')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bobinage_secs');
    }
}
