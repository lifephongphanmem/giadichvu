<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKkdvvtxkGhldfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkgiahldf', function (Blueprint $table) {
            $table->increments('id');
            $table->string('masothue')->nullable();
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
        Schema::dropIfExists('kkgiahldf');
    }
}
