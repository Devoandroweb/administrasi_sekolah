<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Alumni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('alumni', function (Blueprint $table) {
            $table->bigIncrements('id_alumni');
            $table->bigInteger('no_induk_alumni');
            $table->text('tahun_ajaran');
            $table->char('nama',100);
            $table->char('tmp_lahir',225);
            $table->timestamp('tgl_lahir');
            $table->integer('nisn');
            $table->char('rombel',225);
            $table->char('no_tlp',13);
            $table->longText('alamat');
            $table->index('no_induk_alumni');
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
       Schema::dropIfExists('alumni');
    }
}
