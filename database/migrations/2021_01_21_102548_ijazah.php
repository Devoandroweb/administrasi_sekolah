<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ijazah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ijazah', function (Blueprint $table) {
            $table->bigIncrements('id_ijazah');
            $table->unsignedBigInteger('no_induk_alumni');
            $table->foreign('no_induk_alumni')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade')
                    ->references('no_induk')
                    ->on('data_siswa');
            $table->text('tahun_ajaran')->default('0');
            $table->bigInteger('ijazah')->default('0');
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
        Schema::dropIfExists('ijazah');
    }
}
