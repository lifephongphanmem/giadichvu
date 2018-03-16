<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDndvgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dndvgs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tendn')->nullable();
            $table->string('masothue')->nullable();
            $table->string('diachidn')->nullable();
            $table->string('teldn')->nullable();
            $table->string('faxdn')->nullable();
            $table->string('email')->nullable();
            $table->string('noidknopthue')->nullable();
            $table->string('giayphepkd')->nullable();
            $table->string('chucdanhky')->nullable();
            $table->string('nguoiky')->nullable();
            $table->string('diadanh')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('tailieu')->nullable();
            $table->string('toado')->nullable();
            $table->string('link')->nullable();
            $table->string('cqcq')->nullable();
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
        Schema::dropIfExists('dndvgs');
    }
}
