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
            $table->string('tole')->nullable();
            $table->integer('diamPropose')->nullable();
            $table->integer('diamNominale')->nullable();
            $table->enum('pas',['10','20'])->nullable();
            $table->float('coeffRemplissage')->nullable();
            $table->integer('nbrGradin')->nullable();
            $table->integer('demiGradin')->nullable();
            $table->json('largeur')->nullable();
            $table->json('epaisseur')->nullable();
            $table->float('Sbrut')->nullable();
            $table->float('Snette')->nullable();
            $table->float('EpaisseurTot')->nullable();
            $table->integer('largeurMin')->nullable();
            $table->float('CMBT')->nullable();
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
