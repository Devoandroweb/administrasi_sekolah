<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('data_siswa', function (Blueprint $table) {
            $table->bigIncrements('id_siswa');
            $table->char('nama',100);
            $table->char('tmp_lahir',225);
            $table->timestamp('tgl_lahir');
            $table->integer('nisn');
            $table->unsignedBigInteger('no_induk');
            $table->integer('kelas');
            $table->char('rombel',225);
            $table->char('no_tlp',13);
            $table->longText('alamat');
            $table->string('password');
            $table->index('no_induk');
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
        Schema::dropIfExists('data_siswa');
    }
}
