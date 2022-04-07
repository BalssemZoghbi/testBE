<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garanties', function (Blueprint $table) {
            $table->id();
            $table->enum('option',['StandardTri24KV','StandardTri36KV'])->nullable();
            $table->integer('Pog');
            $table->float('log');
            $table->integer('Pccg');
            $table->float('Uccg');
            $table->integer('Ptot');
            $table->integer('Poglimit');
            $table->float('loglimit');
            $table->integer('Pccglimit');
            $table->float('Uccglimit');
            $table->integer('Ptotlimit');
            $table->integer('echauffementHuile');
            $table->integer('echauffementEnroulement');
            $table->foreignId('garantie36_id')->constrained()->nullable();
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
        Schema::dropIfExists('garanties');
    }
}
