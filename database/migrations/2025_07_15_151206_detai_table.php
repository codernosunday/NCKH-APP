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
        Schema::create('detai', function (Blueprint $table) {
            $table->increments('id_detai');
            $table->unsignedInteger('id_ttcn');
            $table->unsignedInteger('id_lvnc');
            $table->unsignedInteger('id_loaidt');
            $table->text('tendetai');
            $table->text('hotenCN');
            $table->text('donvi')->nullable();
            $table->string('sodt', 10)->nullable();
            $table->string('email', 50)->nullable();
            $table->date('tgbatdau');
            $table->date('tgketthuc');
            $table->integer('sogiotg');
            $table->string('trangthai', 10)->nullable();
            $table->text('diemdanhgia')->nullable();
            $table->text('nhanxet')->nullable();
            $table->decimal('kinhphitong', 11, 2)->nullable();
            $table->timestamps();
            $table->foreign('id_loaidt')
                ->references('id_loaidt')
                ->on('loaidetai')
                ->onDelete('cascade');
            $table->foreign('id_ttcn')
                ->references('id_ttcn')
                ->on('thongtincanhan');
            $table->foreign('id_lvnc')
                ->references('id_lvnc')
                ->on('linhvucnghiencuu');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sogiotheonam');
    }
};
