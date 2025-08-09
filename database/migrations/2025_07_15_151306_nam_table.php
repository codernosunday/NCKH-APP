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
        Schema::create('sogiotheonam', function (Blueprint $table) {
            $table->increments('id_nam');
            $table->unsignedInteger('id_loaidt');
            $table->integer('sogioTGtoida');
            $table->integer('sogioTVtoida');
            $table->integer('soTVtoida');
            $table->integer('nam');
            $table->text('namtinhgio')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->foreign('id_loaidt')
                ->references('id_loaidt')
                ->on('loaidetai');
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
