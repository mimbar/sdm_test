<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik')->nullable();
            $table->integer('no_ppnpn')->nullable();
            $table->char('gender')->default('L');
            $table->string('gelar_depan')->nullable();
            $table->string('nama');
            $table->string('gelar_belakang')->nullable();
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->integer('unitID')->default(1);
            $table->tinyInteger('status_kawin')->default(1);
            $table->tinyInteger('jumlah_tanggungan')->default(0);
            $table->date('tanggal_masuk');
            $table->integer('masa_kerja')->default(0);
            $table->char('golonganID',3)->default('I');
            $table->char('ruangID')->default('A');
            $table->integer('strukturalID')->nullable();
            $table->integer('fungsionalID')->nullable();
            $table->integer('bankID')->default(1);
            $table->integer('nomor_rekening')->default(0);
            $table->string('npwp')->nullable();
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
        Schema::dropIfExists('pegawai');
    }
}
