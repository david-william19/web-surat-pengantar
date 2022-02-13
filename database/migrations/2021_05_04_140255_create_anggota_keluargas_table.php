<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaKeluargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_keluarga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_keluarga');
            $table->foreign('id_keluarga')->references('id')->on('keluarga')->onDelete('cascade');
            $table->string("nik")->unique();
            $table->string("nama");
            $table->string("gender");
            $table->string("tempat_lahir")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->string("status_dalam_keluarga")->nullable();
            $table->string("status_perkawinan")->nullable();
            $table->string("agama")->nullable();
            $table->string("current_address")->nullable();
            $table->string("golongan_darah")->nullable();
            $table->string("kewarganegaraan")->nullable();
            $table->string("pendidikan")->nullable();
            $table->string("pekerjaan")->nullable();
            $table->string("akseptor_kb")->nullable();
            $table->boolean("penyandang_cacat")->nullable();
            $table->string("status_kepemilikan_rumah")->nullable();
            $table->integer("penghasilan_perbulan")->nullable();
            $table->integer("pengeluaran_perbulan")->nullable();
            $table->string("kepemilikan_lahan")->nullable();
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
        Schema::dropIfExists('anggota_keluarga');
    }
}
