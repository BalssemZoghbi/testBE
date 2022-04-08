<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBobinagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bobinages', function (Blueprint $table) {
            $table->id();
            $table->enum('materiau',['cuivre','aluminium'])->nullable();
            $table->enum('conducteur',['meplat guipé','Rond emaille','feuillard'])->nullable();
            $table->enum('type',['primaire','secondaire']);
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
        Schema::dropIfExists('bobinages');
    }
}
