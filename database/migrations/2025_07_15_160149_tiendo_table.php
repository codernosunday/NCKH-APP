<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiendo', function (Blueprint $table) {
            $table->increments('id_tiendo');
            $table->unsignedInteger('id_detai');
            $table->unsignedInteger('id_tv')->nullable();
            $table->text('ndcongviec');
            $table->text('nguoithuchien')->nullable();
            $table->date('tgbatdau');
            $table->date('tgketthuc');
            $table->text('trangthai')->nullable();
            $table->timestamps();
            $table->foreign('id_detai')
                ->references('id_detai')
                ->on('detai');
            $table->foreign('id_tv')
                ->references('id_tv')
                ->on('thanhvien');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiendo');
    }
};
