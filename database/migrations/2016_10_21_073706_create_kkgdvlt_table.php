<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKkgdvltTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkgdvlt', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('macskd')->nullable();
            $table->string('masothue')->nullable();
            $table->date('ngaynhap')->nullable();
            $table->string('socv')->nullable();
            $table->string('socvlk')->nullable();
            $table->date('ngaycvlk')->nullable();
            $table->date('ngayhieuluc')->nullable();
            $table->text('ttnguoinop')->nullable();
            $table->date('ngaynhan')->nullable();
            $table->string('sohsnhan')->nullable();
            $table->text('ghichu')->nullable();
            $table->dateTime('ngaychuyen')->nullable();
            $table->text('lydo')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('cqcq')->nullable();
            $table->string('dvt')->nullable();
            $table->string('filedk')->nullable();
            $table->string('phanloai')->nullable();
            $table->string('plhs')->nullable();
            $table->string('thoihan')->nullable();
            $table->string('tencskd')->nullable();
            $table->string('tendn')->nullable();
            $table->string('loaihang')->nullable();
            $table->string('giaycnhangcs')->nullable();
            $table->string('filedk1')->nullable();
            $table->string('filedk2')->nullable();
            $table->string('filedk3')->nullable();
            $table->string('filedk4')->nullable();
            $table->string('soqdgiaycnhangcs')->nullable();
            $table->date('giaycnhangcstungay')->nullable();
            $table->date('giaycnhangcsdenngay')->nullable();
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
        Schema::dropIfExists('kkgdvlt');
    }
}
