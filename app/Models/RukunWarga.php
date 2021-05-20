<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RukunWarga extends Authenticatable
{
    use HasFactory;
    protected $table = "rukun_warga";
    protected $fillable = [
        "kode","username","kontak","password","alamat"
    ];
}
