<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

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