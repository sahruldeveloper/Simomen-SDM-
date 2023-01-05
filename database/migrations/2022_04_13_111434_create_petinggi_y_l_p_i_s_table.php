<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetinggiYLPISTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PetinggiYLPI', function (Blueprint $table) {
            $table->string('NPK');
            $table->string('nama');
            $table->string('password');
            $table->string('email')->unique();
            $table->date('tgl_lahir');
            $table->string('tmp_lahir');
            $table->date('tgl_sk');
            $table->string('kode_jabatan');
            $table->string('kode_unit');
            $table->string('jenis_kelamin');
            $table->string('pendidikan');
            $table->text('deskripsi');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('petinggi_y_l_p_i_s');
    }
}