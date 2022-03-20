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
            $table->string('appareil');
            $table->string('reference');
            $table->string('client');
            $table->string('refClient');
            $table->string('temperatureMax');
            $table->string('attitudeMax');
            $table->string('type');
            $table->string('remplissage');
            $table->string('installation');
            $table->string('montage');
            $table->string('echangeurs');
            $table->string('dielectrique');
            $table->string('fonctionnement');
            $table->string('refroidissement');
            $table->foreignId('user_id')->constrained();
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
