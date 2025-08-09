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
        Schema::create('thanhvien', function (Blueprint $table) {
            $table->increments('id_tv');
            $table->unsignedInteger('id_detai');
            $table->unsignedInteger('id_ttcn')->nullable();
            $table->text('tenthanhvien');
            $table->text('nhiemvu')->nullable();
            $table->text('vaitro')->nullable();
            $table->integer('sogiothamgia');
            $table->timestamps();

            $table->foreign('id_detai')
                ->references('id_detai')
                ->on('detai')
                ->onDelete('cascade');
            $table->foreign('id_ttcn')
                ->references('id_ttcn')
                ->on('thongtincanhan')
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
        Schema::dropIfExists('thanhvien');
    }
};
