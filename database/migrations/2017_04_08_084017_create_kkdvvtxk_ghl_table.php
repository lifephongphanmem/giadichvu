<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKkdvvtxkGhlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkgiahl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('masokk')->nullable();
            $table->string('madichvu')->nullable();
            $table->string('tendichvu')->nullable();
            $table->string('qccl')->nullable();
            $table->string('dvt')->nullable();
            $table->double('giahllk')->nullable();
            $table->double('giahl')->nullable();
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
        Schema::dropIfExists('kkgiahl');
    }
}
