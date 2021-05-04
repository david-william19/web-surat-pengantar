<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Keluarga extends Authenticatable{
    use HasFactory;
    protected $table = "keluarga";
    protected $fillable=[
        "no_kk",
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
