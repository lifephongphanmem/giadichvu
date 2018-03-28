<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagdvvtxtxTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagdvvtxtx_temp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('masothue')->nullable();
            $table->string('masokk')->nullable();
            $table->string('madichvu')->nullable();
            $table->double('sanluong')->default(0);
            $table->double('cpnguyenlieutt')->default(0);
            $table->double('cpcongnhantt')->default(0);
            $table->double('cpkhauhaott')->default(0);
            $table->double('cpsanxuatdt')->default(0);
            $table->double('cpsanxuatc')->default(0);
            $table->double('cptaichinh')->default(0);
            $table->double('cpbanhang')->default(0);
            $table->double('cpquanly')->default(0);
            //mẫu 2
            $table->double('nguyengia')->default(0);
            $table->double('tongkm')->default(0);
            $table->double('kmcokhach')->default(0);
            $table->double('khauhao')->default(0);
            $table->double('baohiem')->default(0);
            $table->double('baohiempt')->default(0);
            $table->double('baohiemtnds')->default(0);
            $table->double('lainganhang')->default(0);
            $table->double('thuevp')->default(0);
            $table->double('suachualon')->default(0);
            $table->double('samlop')->default(0);
            $table->double('dangkiem')->default(0);
            $table->double('quanly')->default(0);
            $table->double('banhang')->default(0);
            $table->double('luonglaixe')->default(0);
            $table->double('nhienlieuchinh')->default(0);
            $table->double('nhienlieuboitron')->default(0);
            $table->double('chiphibdcs')->default(0);
            $table->double('giakekhai')->default(0);
            $table->double('doanhthu')->default(0);
            $table->double('phiduongbo')->default(0);
            $table->double('loinhuan')->default(0);
            $table->double('suachuatx')->default(0);
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
        Schema::drop('pagdvvtxtx_temp');
    }
}
