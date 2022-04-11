<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBobinageSecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bobinage_secs', function (Blueprint $table) {
            $table->id();
            $table->enum('materiauSec',['cuivre','aluminium'])->nullable();
            $table->enum('conducteurSec',['meplat guipé','Rond emaille','feuillard'])->nullable();
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
        Schema::dropIfExists('bobinage_secs');
    }
}
