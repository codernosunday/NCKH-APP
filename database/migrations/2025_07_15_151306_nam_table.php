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
            $table->unsignedInteger('id_sogio');
            $table->text('nam');
            $table->integer('sonam')->nullable();
            $table->integer('sogio');
            $table->timestamps();

            $table->foreign('id_loaidt')
                ->references('id_loaidt')
                ->on('loaidetai');
            $table->foreign('id_sogio')
                ->references('id_sogio')
                ->on('sogioNCKH');
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
