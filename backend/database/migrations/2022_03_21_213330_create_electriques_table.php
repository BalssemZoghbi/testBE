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
            $table->enum('colonnes',['3','4']);
            $table->enum('frequence', ['50','60']);
            $table->integer('u1n');
            $table->integer('u2o');
            $table->enum('couplagePrimaire',['YN','Y','D']);
            $table->enum('couplageSecondaire',['d','zn','z','yn','y']);
            $table->enum('indiceHoraire', ['0','1','2','3','4','5','6','7','8','9','10','11']);
            $table->string('couplage');
            $table->integer('classeU1');
            $table->integer('tenueFr1');
            $table->integer('tenueChoc1');
            $table->integer('classeU2');
            $table->integer('tenueFr2');
            $table->integer('tenueChoc2');
            $table->integer('priseSoustractive')->default(2);
            $table->integer('priseAdditive')->default(2);
            $table->float('echelonSousctractive')->default(2.5);
            $table->float('echelonAdditive')->default(2.5);
            $table->integer('puissance');
            $table->float('PrimaireUligne');
            $table->float('PrimaireUPhase');
            $table->float('PrimaireIligne');
            $table->float('PrimaireIPhase');
            $table->float('secondaireUligne');
            $table->float('secondaireUPhase');
            $table->float('secondaireIligne');
            $table->float('secondaireIPhase');
            $table->float('Uz')->nullable();
            $table->integer('nbrePosition');
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
