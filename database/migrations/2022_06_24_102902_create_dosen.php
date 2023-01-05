<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->string('nidn');
            $table->string('nama');
            $table->string('email')->unique();
            $table->date('tgl_lahir');
            $table->string('tmp_lahir');
            $table->date('tgl_sk');
            $table->string('kode_jurusan');
            $table->string('kode_jabatan');
            $table->string('kode_fakultas');
            $table->string('jenis_kelamin');
            $table->string('pendidikan');
            $table->string('status');
            $table->text('deskripsi');
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
        Schema::dropIfExists('dosen');
    }
}