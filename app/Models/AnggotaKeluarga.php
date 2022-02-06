<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKeluarga extends Model
{
    use HasFactory;
    protected $table = "anggota_keluarga";

    protected $fillable=[
        "id_keluarga",
        "nama",
        "gender",
        "tempat_lahir",
        "tanggal_lahir",
        "status_dalam_keluarga",
        "status_perkawinan",
        "agama",
        "current_address",
        "golongan_darah",
        "kewarganegaraan",
        "pendidikan",
        "pekerjaan",
        "akseptor_kb",
        "penyandang_cacat",
        "status_kepemilikan_rumah",
        "penghasilan_perbulan",
        "pengeluaran_perbulan",
        "kepemilikan_lahan",
    ];

    
}
