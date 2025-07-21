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
        Schema::create('kinhphi', function (Blueprint $table) {
            $table->increments('id_kp');
            $table->unsignedInteger('id_detai')->nullable();
            $table->unsignedInteger('id_tiendo')->nullable();
            $table->text('ctkhoanchi')->nullable();
            $table->text('donvitinh')->nullable();
            $table->text('soluong')->nullable();
            $table->decimal('dongia', 11, 2)->nullable();
            $table->decimal('thanhtien', 11, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_detai')
                ->references('id_detai')
                ->on('detai');
            $table->foreign('id_tiendo')
                ->references('id_tiendo')
                ->on('tiendo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kinhphi');
    }
};
