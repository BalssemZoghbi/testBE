<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonneBobinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donne_bobines', function (Blueprint $table) {
            $table->id();
            $table->enum('materiauMT',['cuivre','aluminium'])->nullable();
            $table->enum('conducteurMT',['meplat guipé','Rond emaille','feuillard'])->nullable();
            $table->enum('materiauBT',['cuivre','aluminium'])->nullable();
            $table->enum('conducteurBT',['meplat guipé','Rond emaille','feuillard'])->nullable();
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
        Schema::dropIfExists('donne_bobines');
    }
}
