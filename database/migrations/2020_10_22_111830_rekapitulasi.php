<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rekapitulasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapitulasi', function (Blueprint $table) {
            $table->bigIncrements('id_rekapitulasi');
            $table->date('tanggal');
            $table->longText('uraian');
            $table->unsignedBigInteger('masuk');
            $table->foreign('masuk')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade')
                    ->references('id_pemasukan')
                    ->on('pemasukan');
            $table->unsignedBigInteger('keluar');
            $table->foreign('keluar')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade')
                    ->references('id_pengeluaran')
                    ->on('pengeluaran');
            $table->bigInteger('saldo');
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
        Schema::dropIfExists('rekapitulasi');
    }
}
