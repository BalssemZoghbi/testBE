<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePccUccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcc_uccs', function (Blueprint $table) {
            $table->id();
            $table->integer('MajourationU')->nullable();
            $table->float('pcc1')->nullable();
            $table->float('pcc2')->nullable();
            $table->float('pccMaj')->nullable();
            $table->float('Pccgarantie')->nullable();
            $table->float('Uccr')->nullable();
            $table->float('Ucca')->nullable();
            $table->float('Ucc')->nullable();
            $table->float('Uccgarantie')->nullable();
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
        Schema::dropIfExists('pcc_uccs');
    }
}
