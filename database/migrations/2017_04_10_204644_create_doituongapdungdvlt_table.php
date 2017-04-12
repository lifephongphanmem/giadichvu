<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoituongapdungdvltTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doituongapdungdvlt', function (Blueprint $table) {
            $table->increments('id');
            $table->text('tendoituong')->nullable();
            $table->string('macskd')->nullable();
            $table->string('masothue')->nullable();
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
        Schema::dropIfExists('doituongapdungdvlt');
    }
}
