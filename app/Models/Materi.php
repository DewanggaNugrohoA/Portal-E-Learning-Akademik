<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_materi',
        'deskripsi',
        'file_materi',
        'nama_mata_pelajaran',
        'nama_guru',
    ];
}