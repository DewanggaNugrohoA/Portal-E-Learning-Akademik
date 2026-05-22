<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->string('judul_materi');
            $table->text('deskripsi')->nullable();
            $table->string('file_materi')->nullable();
            $table->string('nama_mata_pelajaran')->nullable();
            $table->string('nama_guru')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};