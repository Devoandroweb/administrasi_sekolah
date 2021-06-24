<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TanggunganPrev extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('TanggunganPrev', function (Blueprint $table) {
            $table->bigIncrements('id_tgg_prev');
            $table->unsignedBigInteger('no_induk_siswa');
            $table->foreign('no_induk_siswa')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade')
                    ->references('no_induk')
                    ->on('data_siswa');
            $table->char('kelas_prev',225);
            $table->bigInteger('spp')->default('0');
            $table->bigInteger('psb')->default('0');
            $table->bigInteger('uts_1')->default('0');
            $table->bigInteger('uts_2')->default('0');
            $table->bigInteger('lks_1')->default('0');
            $table->bigInteger('lks_2')->default('0');
            $table->bigInteger('pas_1')->default('0');
            $table->bigInteger('pas_2')->default('0');
            $table->bigInteger('unas')->default('0');
            $table->text('daftar_ulang')->default('0');
            $table->text('tahun_ajaran')->default('2019-2020');
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
        //
        Schema::dropIfExists('TanggunganPrev');
    }
}
