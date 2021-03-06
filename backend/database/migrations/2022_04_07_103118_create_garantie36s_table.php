<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarantie36sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garantie36s', function (Blueprint $table) {
            $table->id();
            $table->integer('pn');
            $table->integer('po');
            $table->float('lo');
            $table->integer('pcc');
            $table->float('ucc');
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
        Schema::dropIfExists('garantie36s');
    }
}
