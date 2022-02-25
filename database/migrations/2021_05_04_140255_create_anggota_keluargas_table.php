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
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string("tempat_lahir")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->enum("status_dalam_keluarga", ['Kepala Keluarga', 'Suami', 'Istri', 'Anak Kandung', 'Cucu', 'Anak Angkat', 'Orang Tua', 'Famili Lain', 'Saudara', 'N/A']);
            $table->enum("status_perkawinan", ['Kawin', 'Belum Kawin', 'Duda', 'Janda']);
            $table->enum("agama", ['Kristen', 'Hindu', 'Budha', 'Islam', 'Konghucu', 'Aliran Kepercayaan Kepada Tuhan YME', 'Aliran Kepercayaan Lainnya', 'N/A']);
            $table->string("current_address")->nullable();
            $table->enum("golongan_darah", ['A', 'B', 'O', 'AB', 'N/A'])->default('N/A');
            $table->enum("kewarganegaraan", ['WNI', 'WNA']);
            $table->enum("pendidikan", ['Belum Masuk TK', 'Sedang PAUD', 'Sedang TK', 'Tidak Pernah Sekolah', 'Sedang SD/Sederajat', 'Tamat SD/Sederajat', 'Sedang SLTP/Sederajat', 'Tamat SLTP/Sederajat', 'Sedang SLTA/Sederajat', 'Tamat SLTA/Sederajat', 'Sedang Kuliah', 'Sedang D1/Sederajat', 'Tamat D1/Sederajat', 'Sedang D2/Sederajat', 'Tamat D2/Sederajat', 'Sedang D3/Sederajat', 'Tamat D3/Sederajat', 'Sedang D4/Sederajat', 'Tamat D4/Sederajat', 'Sedang S1/Sederajat', 'Tamat S1/Sederajat', 'Sedang S2/Sederajat', 'Tamat S2/Sederajat', 'Sedang S3/Sederajat', 'Tamat S3/Sederajat', 'Sedang SLB/Sederajat', 'N/A'])->default('N/A');
            $table->enum("pekerjaan", ['Petani', 'Buruh', 'Abdi Puskesmas', 'Imam', 'Pegawai Negeri Sipil', 'Karyawan Swasta', 'Penjahit', 'Pedagang', 'Peternak', 'Nelayan', 'Montir', 'Teknisi', 'Dokter', 'Perawat', 'Bidan', 'TNI', 'POLRI', 'SATPOL PP', 'Petugas Keamanan', 'Pengusaha kecil, menengah dan besar', 'Guru', 'Baby Sitter', 'Dosen', 'Seniman/artis', 'Pedagang Keliling', 'Pengemudi Becak', 'Tukang', 'Tukang Batu', 'Tukang Kayu', 'Tukang Las', 'Tukang Urut', 'Tukang Emas', 'Tukang Bentor', 'Pembantu Rumah Tangga', 'Pengacara', 'Notaris', 'Dukun Tradisional', 'Arsitektur/Desainer', 'Karyawan Perusahaan Swasta', 'Karyawan Perusahaan Pemenrintah', 'Pembuat Kue', 'Honorer', 'UKM', 'Wiraswasta', 'Wirausaha', 'Belum Bekerja', 'Tidak Mempunyai Pekerjaan Tetap', 'Pengrajin', 'Pelajar', 'Ibu Rumah Tangga', 'Pensiunan', 'Supir', 'Pemulung', 'Penambang Pasir', 'N/A'])->default('N/A');
            $table->enum("akseptor_kb", ['Alat Kontrasepsi Suntik', 'Alat Kontrasepsi Spiral', 'Alat Kontrasepsi Implan', 'Alat Kontrasepsi Vasektomi', 'Alat Kontrasepsi Tubektomi', 'Alat Kontrasepsi Pil', 'KB Alamiah/Kalender', 'Alat Kontrasepsi IUD', 'Obat Tradisional', 'Tidak Menggunakan Alat Kontrasepsi'])->default('Tidak Menggunakan Alat Kontrasepsi');
            $table->enum("penyandang_cacat", ['Cacat Fisik', 'Tuna Rungu', 'Tuna Wicara', 'Tuna Netra', 'Lumpuh', 'Sumbing', 'Cacat Mental', 'Disabilitas', 'Autis', 'Stress/Gila', 'N/A'])->default('N/A');
            $table->enum("status_kepemilikan_rumah", ['Milik Sendiri', 'Milik Orang Tua', 'Milik Saudara', 'Sewa/Kontrak', 'Budel', 'Rumah Dinas Negara', 'N/A'])->default('N/A');
            $table->enum("penghasilan_perbulan", ['Dibawah Rp.500.000', 'Rp.500.000-1.000.000', 'Rp.1.000.000-2.000.000', 'Rp.2.000.000-3.000.000', 'Rp.3.000.000-5.000.000', 'Rp.5.000.000-10.000.000', 'Diatas Rp.10.000.000', 'Tidak Tetap'])->default('Tidak Tetap');
            $table->enum("pengeluaran_perbulan", ['<Rp.500.000', 'Rp.500.000-1.000.000', 'Rp.1.000.000-2.000.000', 'Rp.2.000.000-3.000.000', 'Rp.3.000.000-5.000.000', 'Rp.5.000.000-10.000.000', '>Rp.10.000.000', 'Tidak Tetap'])->default('Tidak Tetap');
            $table->enum("kepemilikan_lahan", ['Tidak Memiliki', '<0,5ha', '0.5-1.0ha', '>1.0ha', 'N/A'])->default('N/A');
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
