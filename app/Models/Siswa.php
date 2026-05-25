<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';

    protected $fillable = [
        'nis',
        'nama',
        'email',
        'kelas',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_hp',
        'alamat',
        'status',
    ];
}