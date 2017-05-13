<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmdvqlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmdvql', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maqhns')->nullable();
            $table->string('tendv')->nullable();
            $table->string('plql')->nullable();
            $table->string('diachi')->nulable();
            $table->string('level')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->text('sohsnhan')->nullable();
            $table->text('ttlh')->nullable();
            $table->string('email')->nullalbe();
            $table->string('emailqt')->nullalbe();
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
        Schema::dropIfExists('dmdvql');
    }
}
