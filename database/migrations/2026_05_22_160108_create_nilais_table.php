<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->integer('nilai');
            $table->integer('kkm');
            $table->string('predikat');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswas')
                ->onDelete('cascade');

            $table->foreign('mata_pelajaran_id')
                ->references('id')
                ->on('mata_pelajarans')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};