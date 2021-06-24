<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Administrasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrasi', function (Blueprint $table) {
            $table->bigIncrements('id_administrasi');
            $table->unsignedBigInteger('no_induk_adm');
            $table->foreign('no_induk_adm')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade')
                    ->references('no_induk')
                    ->on('data_siswa');
            $table->bigInteger('spp')->default('0');
            $table->bigInteger('psb')->default('0');
            $table->bigInteger('uts_1')->default('0');
            $table->bigInteger('uts_2')->default('0');
            $table->bigInteger('lks_1')->default('0');
            $table->bigInteger('lks_2')->default('0');
            $table->bigInteger('pas_1')->default('0');
            $table->bigInteger('pas_2')->default('0');
            $table->bigInteger('unas')->default('0');
            $table->bigInteger('daftar_ulang')->default('0');
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
        Schema::dropIfExists('administrasi');
    }
}
