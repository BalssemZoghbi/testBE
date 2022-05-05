<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircuitmagnetiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circuitmagnetiques', function (Blueprint $table) {
            $table->id();
            $table->integer('masseFertot');//calcul automatique
            $table->float('Bmax');
            $table->float('pFerspecifique');
            $table->float('Majferprop');
            $table->string('tole');
            $table->integer('Majfer');//manuelle
            $table->integer('pFer');
            $table->integer('pFergarantie');
            $table->integer('Ex');
            $table->integer('Hc');
            $table->integer('E1');//manuelle
            $table->integer('E2');//manuelle
            $table->integer('E3');//manuelle
            $table->integer('E4');//manuelle
            $table->integer('Eh');
            $table->integer('Ebc');//manuelle
            $table->integer('Longeurcuve');
            $table->integer('Largeurcuve');
            $table->json('LCM');
            $table->json('masseFerCM');
            $table->json('surfaceCM');
            $table->integer('Hauteurcuve');
            $table->integer('coeffPoid');
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
        Schema::dropIfExists('circuitmagnetiques');
    }
}
