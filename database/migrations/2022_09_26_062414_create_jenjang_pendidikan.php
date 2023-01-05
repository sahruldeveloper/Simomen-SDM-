<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenjangPendidikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenjangPendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('npk');
            $table->string('pendidikan_strata');
            $table->string('pendidikan_magister');
            $table->string('pendidikan_doctor');
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
        Schema::dropIfExists('jenjangPendidikan');
    }
}