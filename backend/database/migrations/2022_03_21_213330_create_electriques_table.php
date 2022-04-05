<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electriques', function (Blueprint $table) {
            $table->id();
            $table->enum('colonnes',['3','4'])->nullable();
            $table->enum('frequence', ['50','60'])->nullable();
            $table->integer('u1n')->nullable();
            $table->integer('u2o')->nullable();
            $table->enum('couplagePrimaire',['YN','Y','D'])->nullable();
            $table->enum('couplageSecondaire',['d','zn','z','yn','y'])->nullable();
            $table->enum('indiceHoraire', ['0','1','2','3','4','5','6','7','8','9','10','11'])->nullable();
            $table->string('couplage')->nullable();
            $table->integer('classeU1')->nullable();
            $table->integer('tenueFr1')->nullable();
            $table->integer('tenueChoc1')->nullable();
            $table->integer('classeU2')->nullable();
            $table->integer('tenueFr2')->nullable();
            $table->integer('tenueChoc2')->nullable();
            $table->integer('priseSoustractive')->nullable();
            $table->integer('priseAdditive')->nullable();
            $table->float('echelonSousctractive')->nullable();
            $table->float('echelonAdditive')->nullable();
            $table->integer('puissance')->nullable();
            $table->float('PrimaireUligne')->nullable();
            $table->float('PrimaireUPhase')->nullable();
            $table->float('PrimaireIligne')->nullable();
            $table->float('PrimaireIPhase')->nullable();
            $table->float('secondaireUligne')->nullable();
            $table->float('secondaireUPhase')->nullable();
            $table->float('secondaireIligne')->nullable();
            $table->float('secondaireIPhase')->nullable();
            $table->float('Uz')->nullable();
            $table->integer('nbrePosition')->nullable();
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
        Schema::dropIfExists('electriques');
    }
}
