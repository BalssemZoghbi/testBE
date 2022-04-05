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
            $table->id();
            $table->string('appareil')->nullable();
            $table->string('reference')->nullable();
            $table->string('client')->nullable();
            $table->string('refClient')->nullable();
            $table->string('temperatureMax')->nullable();
            $table->string('attitudeMax')->nullable();
            $table->string('elaborateur')->nullable();
            $table->enum('type',['cabine','poteau','h61','h59','sec'])->nullable();
            $table->enum('remplissage',['à matelas d`air','integral','respirant'])->nullable();
            $table->enum('installation',['interieure', 'exterieure','interieur&exterieure'])->nullable();
            $table->enum('montage',['sur galets','sur pieds'])->nullable();
            $table->enum('echangeurs',['ondes','radiateurs','parois'])->nullable();
            $table->enum('dielectrique',['huile biodegradable','huile minerale inhibée','huile siliconne','huile minerale non inhibée'])->nullable();
            $table->enum('fonctionnement',['abaisseur','elevateur','isolement'])->nullable();
            $table->enum('refroidissement',['onan','onaf'])->nullable();
            $table->foreignId('user_id')->constrained()->nullable();
            $table->foreignId('electrique_id')->constrained()->onDelete('cascade');
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
