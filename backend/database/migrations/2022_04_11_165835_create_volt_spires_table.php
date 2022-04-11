<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoltSpiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volt_spires', function (Blueprint $table) {
            $table->id();
            $table->float('Bmaxdesire');
            $table->float('Bmax');
            $table->float('Vsp');
            $table->float('N2c');
            $table->float('N1c');
            $table->json('prise');
            $table->json('spire');
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
        Schema::dropIfExists('volt_spires');
    }
}
