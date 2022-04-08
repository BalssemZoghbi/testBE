<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradins', function (Blueprint $table) {
            $table->id();
            $table->string('tole');
            $table->integer('diamPropose');
            $table->integer('diamNominale');
            $table->enum('pas',['10','20']);
            $table->float('coeffRemplissage');
            $table->integer('nbrGradin');
            $table->integer('demiGradin');
            $table->json('largeur');
            $table->json('epaisseur');
            $table->float('Sbrut');
            $table->float('Snette');
            $table->float('EpaisseurTot');
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
        Schema::dropIfExists('gradins');
    }
}
