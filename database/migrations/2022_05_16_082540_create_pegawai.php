<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('NPK', 10);
            $table->string('kode_jabatan', 10);
            $table->string('kode_golongan', 10);
            $table->string('kode_unit', 10);
            $table->string('nama_pegawai', 36);
            $table->string('email', 55);
            $table->date('tgl_lahir');
            $table->string('tmp_lahir', 24);
            $table->date('tgl_sk');
            $table->string('pendidikan', 13);
            $table->string('jenis_kelamin', 6);
            $table->text('deskripsi');
            $table->string('foto');
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
        Schema::dropIfExists('pegawai');
    }
}