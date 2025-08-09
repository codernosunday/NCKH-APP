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
        Schema::create('thongtincanhan', function (Blueprint $table) {
            $table->increments('id_ttcn');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('id_khoa')->nullable();
            $table->string('hovaten')->nullable();
            $table->string('dvcongtac')->nullable();
            $table->string('email')->nullable();
            $table->date('ngaysinh')->nullable();
            $table->string('gioitinh')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_khoa')
                ->references('id_khoa')
                ->on('khoa')
                ->onDelete('set null');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thongtincanhan');
    }
};
