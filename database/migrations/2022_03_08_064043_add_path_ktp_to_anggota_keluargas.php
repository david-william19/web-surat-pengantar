<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPathKtpToAnggotaKeluargas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anggota_keluarga', function (Blueprint $table) {
            //
            $table->string('path_ktp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anggota_keluarga', function (Blueprint $table) {
            //
            $table->dropColumn('path_ktp');
        });
    }
}
