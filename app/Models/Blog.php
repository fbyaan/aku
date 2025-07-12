<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'gambar',
        'nama_jenis_olahraga',
        'informasi_olahraga',
        'deskripsi_olahraga',
        'kategori_olahraga',
    ];
}
