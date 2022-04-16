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
            $table->integer('MajourationU');
            $table->float('pcc1');
            $table->float('pcc2');
            $table->float('pccMaj');
            $table->float('Pccg');
            $table->float('Uccr');
            $table->float('Ucca');
            $table->float('Ucc');
            $table->float('Uccg');
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
