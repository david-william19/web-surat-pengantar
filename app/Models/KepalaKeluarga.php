<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaKeluarga extends Model
{
    use HasFactory;
    protected $table = "kepala_keluarga";
    protected $fillable=[
        "nik",
        "nama",
        "email",
        "password",
        "kontak",
        "alamat",
        "photo_kartu_keluarga",
        "rt",
        "rw",
    ];

}
