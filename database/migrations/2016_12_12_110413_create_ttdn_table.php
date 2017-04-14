<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTtdnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ttdn', function (Blueprint $table) {
            $table->increments('id');
            $table->string('masothue',30)->nullable();
            $table->string('tendn')->nullable();
            $table->string('diachi')->nullable();
            $table->string('tel')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('diadanh')->nullable();
            $table->string('chucdanhky')->nullable();
            $table->string('nguoiky')->nullable();
            $table->string('noidknopthue')->nullable();
            $table->string('giayphepkd')->nullable();
            $table->string('tailieu')->nullable();
            $table->text('setting')->nullable();
            $table->boolean('dvxk');
            $table->boolean('dvxb');
            $table->boolean('dvxtx');
            $table->boolean('dvk');
            $table->string('toado')->nullable();
            $table->string('ghichu')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('pl')->nullable();
            $table->string('link')->nullable();
            $table->string('cqcq')->nullable();
            $table->string('lydo')->nullable();
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
        Schema::dropIfExists('ttdn');
    }
}
