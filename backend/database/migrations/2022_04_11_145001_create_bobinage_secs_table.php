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
            $table->enum('materiauSec',['cuivre','aluminium'])->nullable();
            $table->enum('conducteurSec',['meplat guipé','Rond emaille','feuillard'])->nullable();
            $table->enum('etage',['1','2'])->nullable();
            $table->float('saillie')->nullable();
            $table->float('hbrin1')->nullable();
            $table->float('hbrin2')->nullable();
            $table->float('nbBrin1')->nullable();
            $table->float('nbBrin2')->nullable();
            $table->float('scu2')->nullable();
            $table->float('j2')->nullable();
            $table->integer('nbcouche')->nullable();
            $table->integer('sp/couche')->nullable();
            $table->float('e2ax')->nullable();
            $table->float('e2r')->nullable();
            $table->integer('rigiditePapier')->nullable();
            $table->float('ep1Papier')->nullable();
            $table->integer('nbrPapier')->nullable();
            $table->enum('typeCanaux',['complet','lune'])->nullable();
            $table->integer('canauxBT')->nullable();
            $table->integer('lgCales')->nullable();
            $table->float('canauxEp1Papier')->nullable();
            $table->integer('canauxNbrPapier')->nullable();
            $table->float('Hspire')->nullable();
            $table->float('HSFS')->nullable();
            $table->float('HFS')->nullable();
            $table->integer('collierBT')->nullable();
            $table->integer('collierBT2')->nullable();
            $table->float('CMBT')->nullable();
            $table->float('Dint')->nullable();
            $table->float('Bint')->nullable();
            $table->float('Epx')->nullable();
            $table->float('Epy')->nullable();
            $table->float('Dext')->nullable();
            $table->float('Bext')->nullable();
            $table->float('poidBT')->nullable();
            $table->float('majPoid')->nullable();
            $table->float('HBOBT')->nullable();
            $table->integer('Hfeuillard')->nullable();
            $table->integer('HbobineBt')->nullable();
            $table->float('epFeuil1')->nullable();
            $table->float('epFeuil2')->nullable();
            $table->float('epFeuillard')->nullable();
            $table->float('ep2Papier')->nullable();
            $table->integer('nbrPap2')->nullable();
            $table->integer('ePap')->nullable();
            $table->float('epFeuilPap')->nullable();
            $table->integer('nbrPap1')->nullable();
            $table->float('EpPapier')->nullable();
            $table->float('EpCylindre')->nullable();
            $table->string('Epbarre')->nullable();
            $table->integer('epaisseurBarre')->nullable();
            $table->integer('largeurBarre')->nullable();
            $table->integer('Sbarre')->nullable();
            $table->float('Jbarre')->nullable();
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
