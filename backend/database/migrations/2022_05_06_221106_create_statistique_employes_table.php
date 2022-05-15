<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatistiqueEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistique_employes', function (Blueprint $table) {
            $table->id();
            $table->json('ProjetChart')->nullable();
            $table->json('NbreProjet')->nullable();
            $table->integer('NbreCuivre')->nullable();
            $table->integer('NbreAlu')->nullable();
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
        Schema::dropIfExists('statistique_employes');
    }
}
