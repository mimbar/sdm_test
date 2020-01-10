<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePegawaiTableUpdateV3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable()->change();
            $table->integer('status_kawin')->nullable()->change();
            $table->integer('jumlah_tanggungan')->nullable()->change();
            $table->date('tanggal_masuk')->nullable()->change();
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
