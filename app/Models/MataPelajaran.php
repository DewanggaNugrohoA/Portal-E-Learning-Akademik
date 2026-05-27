<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajarans';

    protected $fillable = [
        'kode_mata_pelajaran',
        'nama_mata_pelajaran',
        'guru_pengampu',
        'jam_pelajaran',
        'semester',
        'status',
    ];
}