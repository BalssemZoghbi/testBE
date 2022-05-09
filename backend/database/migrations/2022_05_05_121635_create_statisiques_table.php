<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statisiques', function (Blueprint $table) {
            $table->id();
            $table->integer('projetCount')->nullable();
            $table->integer('userCount')->nullable();
            $table->json('UserChart')->nullable();
            $table->json('UserName')->nullable();
            $table->json('UserProjet')->nullable();
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
        Schema::dropIfExists('statisiques');
    }
}
