<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmgiahlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmgiahl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('masothue')->nullable();
            $table->string('madichvu')->nullable();
            $table->string('tendichvu')->nullable();
            $table->string('qccl')->nullable();
            $table->string('dvt')->nullable();
            $table->string('ghichu')->nullable();
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
        Schema::dropIfExists('dmgiahl');
    }
}
