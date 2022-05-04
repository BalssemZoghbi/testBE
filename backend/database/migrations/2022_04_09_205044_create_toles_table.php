<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toles', function (Blueprint $table) {
            $table->id();
            $table->string('tole');
            $table->float('coef0');
            $table->float('coef1');
            $table->float('coef2');
            $table->float('coef3');
            $table->float('coef4');
            $table->float('coef5');
            $table->float('coef6');
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
        Schema::dropIfExists('toles');
    }
}
