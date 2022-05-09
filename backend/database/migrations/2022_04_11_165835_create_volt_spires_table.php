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
            $table->float('Bmaxdesire')->nullable();
            $table->float('Bmax')->nullable();
            $table->float('Vsp')->nullable();
            $table->float('N2c')->nullable();
            $table->float('N1c')->nullable();
            $table->json('prise')->nullable();
            $table->json('spire')->nullable();
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
