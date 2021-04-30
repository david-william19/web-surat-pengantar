<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RukunWarga extends Model
{
    use HasFactory;
    protected $table = "rukun_warga";
    protected $fillable = [
        "kode","username","kontak","password"
    ];
}
