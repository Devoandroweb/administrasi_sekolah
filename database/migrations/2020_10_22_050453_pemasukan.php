<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pemasukan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('pemasukan', function (Blueprint $table) {
            $table->bigIncrements('id_pemasukan');
           $table->unsignedBigInteger('no_induk_siswa');
            $table->foreign('no_induk_siswa')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade')
                    ->references('no_induk')
                    ->on('data_siswa');
            $table->longText('uraian');
            $table->bigInteger('total');
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
       Schema::dropIfExists('pemasukan');
    }
}
