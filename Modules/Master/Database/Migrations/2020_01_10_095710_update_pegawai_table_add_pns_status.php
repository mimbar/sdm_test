<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePegawaiTableAddPnsStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->integer('pns_status')->default(0)->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropColumn(['pns_status']);
        });
    }
}
