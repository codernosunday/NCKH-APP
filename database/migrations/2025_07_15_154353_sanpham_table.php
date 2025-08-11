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
        Schema::create('sanpham', function (Blueprint $table) {
            $table->increments('id_sanpham');
            $table->unsignedInteger('id_detai');
            $table->text('linkSP');
            $table->text('loaiSP')->nullable(); // Assuming 'loaiSP' can be nullable
            $table->text('tenSP');
            $table->string('trangthai', 10);
            $table->timestamps();
            $table->foreign('id_detai')
                ->references('id_detai')
                ->on('detai')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanpham');
    }
};
