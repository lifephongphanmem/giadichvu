<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKkgdvgsctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkgdvgsct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('mahh')->nullable();
            $table->string('tenhh')->nullable();
            $table->string('qccl')->nullable();
            $table->string('dvt')->nullable();
            $table->string('mucgialk')->nullable();
            $table->string('mucgiakk')->nullable();
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
        Schema::dropIfExists('kkgdvgsct');
    }
}
