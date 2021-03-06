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
            $table->float('Ex')->nullable();
            $table->float('Hc')->nullable();
            $table->float('E1')->nullable();//manuelle
            $table->float('E2')->nullable();//manuelle
            $table->float('E3')->nullable();//manuelle
            $table->float('E4')->nullable();//manuelle
            $table->float('Eh')->nullable();
            $table->float('Ebc')->nullable();//manuelle
            $table->float('Longeurcuve')->nullable();
            $table->float('Largeurcuve')->nullable();
            $table->json('LCM')->nullable();
            $table->json('masseFerCM')->nullable();
            $table->json('surfaceCM')->nullable();
            $table->integer('Hauteurcuve')->nullable();
            $table->float('coeffPoid')->nullable();
            $table->float('I0')->nullable();
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
