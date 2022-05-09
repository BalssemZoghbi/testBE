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
            $table->integer('masseFertot')->nullable();//calcul automatique
            $table->float('Bmax')->nullable();
            $table->float('pFerspecifique')->nullable();
            $table->float('Majferprop')->nullable();
            $table->string('tole')->nullable();
            $table->integer('Majfer')->nullable();//manuelle
            $table->integer('pFer')->nullable();
            $table->integer('pFergarantie')->nullable();
            $table->integer('Ex')->nullable();
            $table->integer('Hc')->nullable();
            $table->integer('E1')->nullable();//manuelle
            $table->integer('E2')->nullable();//manuelle
            $table->integer('E3')->nullable();//manuelle
            $table->integer('E4')->nullable();//manuelle
            $table->integer('Eh')->nullable();
            $table->integer('Ebc')->nullable();//manuelle
            $table->integer('Longeurcuve')->nullable();
            $table->integer('Largeurcuve')->nullable();
            $table->json('LCM')->nullable();
            $table->json('masseFerCM')->nullable();
            $table->json('surfaceCM')->nullable();
            $table->integer('Hauteurcuve')->nullable();
            $table->integer('coeffPoid')->nullable();
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
