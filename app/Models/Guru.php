<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'nama',
        'nip',
        'email',
        'no_hp',
        'alamat',
        'mata_pelajaran',
    ];
}