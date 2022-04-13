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
            $table->float('induction');
            $table->float('M110-23');
            $table->float('M120-27');
            $table->float('M130-30');
            $table->float('H75-23');
            $table->float('H80-23');
            $table->float('H85-23');
            $table->float('H95-27');
            $table->float('H105-30');
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
