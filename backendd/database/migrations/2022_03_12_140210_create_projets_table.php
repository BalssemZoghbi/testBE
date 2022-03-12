<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->string('appreil');
            $table->string('reference');
            $table->string('client');
            $table->string('refClient');
        //     $table->integer('temperatureMax');
        //     $table->integer('attitudeMax');
        //     $table->enum('type',['cabine','poteau','h61','h59','sec']);
        //   $table->enum('remplissage',['à matelas d`air','integral','respirant']);
        //     $table->enum('installation', ['interieure', 'exterieure','interieur&exterieure']);
        //     $table->enum('montage', ['sur galets','sur pieds']);
        //     $table->enum('echangeurs', ['ondes','radiateurs','parois']);
        //     $table->enum('dielectrique', ['huile biodegradable','huile minerale inhibée','huile siliconne','huile minerale non inhibée']);
        //     $table->enum('fonctionnement',['abaisseur','elevateur','isolement']);
        //     $table->enum('refroidissement', ['onan','onaf']);
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
        Schema::dropIfExists('projets');
    }
}
