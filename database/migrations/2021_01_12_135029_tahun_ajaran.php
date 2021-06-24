<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TahunAjaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tahun_ajaran', function (Blueprint $table) {
            $table->bigIncrements('id_tahun_ajaran');
            $table->integer('tahun_awal')->default('2019');
            $table->integer('tahun_akhir')->default('2020');

     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tahun_ajaran');
    }
}
