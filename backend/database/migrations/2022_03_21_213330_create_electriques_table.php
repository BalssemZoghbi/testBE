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
            $table->enum('frequence', [30,40,50,60]);
            $table->integer('pn');
            $table->integer('u1n');
            $table->integer('u2o');
            $table->string('couplagePrimaire');
            $table->string('couplageSecondaire');
            $table->enum('indiceHoraire', [0,6]);
            $table->string('couplage');
            $table->integer('priseSoustractive');
            $table->integer('priseAdditive');
            $table->float('echelonSousctractive');
            $table->float('echelonAdditive');
            $table->string('variation');
            $table->integer('puissance');
            $table->integer('PrimaireUligne');
            $table->integer('PrimaireUPhase');
            $table->float('PrimaireIligne');
            $table->float('PrimaireIPhase');
            $table->integer('secondaireUligne');
            $table->integer('secondaireUPhase');
            $table->integer('secondaireIligne');
            $table->integer('secondaireIPhase');
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
