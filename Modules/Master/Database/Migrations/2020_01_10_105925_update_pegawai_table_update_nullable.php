<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePegawaiTableUpdateNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('golonganID')->nullable()->change();
            $table->string('ruangID')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('pegawai', function (Blueprint $table) {
//
//        });
    }
}
