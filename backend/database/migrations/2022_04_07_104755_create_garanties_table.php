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
            $table->integer('Pog')->nullable();
            $table->float('log')->nullable();
            $table->integer('Pccg')->nullable();
            $table->float('Uccg')->nullable();
            $table->float('UccgMin')->nullable();
            $table->integer('Ptot')->nullable();
            $table->integer('Poglimit')->nullable();
            $table->float('loglimit')->nullable();
            $table->integer('Pccglimit')->nullable();
            $table->float('Uccglimit')->nullable();
            $table->integer('Ptotlimit')->nullable();
            $table->integer('echauffementHuile')->nullable();
            $table->integer('echauffementEnroulement')->nullable();
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
