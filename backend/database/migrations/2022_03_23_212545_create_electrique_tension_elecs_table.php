<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectriqueTensionElecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electrique_tension_elecs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('electrique_id')->unsigned();
            $table->bigInteger('tensionElectrique_id')->unsigned();
            $table->timestamps();
            $table->foreign('electrique_id')->references('id')->on('electriques')->onDelete('cascade');
            $table->foreign('tensionElectrique_id')->references('id')->on('tension_electriques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('electrique_tension_elecs');
    }
}
