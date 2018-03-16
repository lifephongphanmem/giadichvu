<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general-configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maqhns')->nullable();
            $table->string('tendonvilt')->nullable();
            $table->string('tendonvivt')->nullable();
            $table->string('diachi')->nullable();
            $table->string('teldv')->nullable();
            $table->string('thutruong')->nullable();
            $table->string('ketoan')->nullable();
            $table->string('nguoilapbieu')->nullable();
            $table->string('namhethong')->nullable();
            $table->text('ttlhlt')->nullable();
            $table->text('ttlhvt')->nullable();
            $table->text('sodvlt')->nullable();
            $table->text('sodvvt')->nullable();
            $table->text('setting')->nullale();;
            $table->text('urlwebcb')->nullale();
            $table->double('thoihan_lt')->default(0);
            $table->double('thoihan_vt')->default(0);
            $table->double('thoihan_ct')->default(0);
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
        Schema::dropIfExists('general-configs');
    }
}
