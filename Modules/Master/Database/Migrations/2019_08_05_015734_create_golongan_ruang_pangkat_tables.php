<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGolonganRuangPangkatTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('golongan_ruang_pangkat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('golongan',3);
            $table->char('ruang',1);
            $table->string('pangkat');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('golongan_ruang_pangkat');
    }
}
