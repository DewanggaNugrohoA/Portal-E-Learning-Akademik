<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = "nilais";

    protected $fillable = [
        "guru_id",
        "kkm",
        "deskripsi_a",
        "deskripsi_b",
        "deskripsi_c",
        "deskripsi_d",
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, "guru_id");
    }
}