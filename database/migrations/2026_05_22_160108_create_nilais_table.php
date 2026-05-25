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
            $table->unsignedBigInteger("guru_id");
            $table->integer("kkm");
            $table->text("deskripsi_a");
            $table->text("deskripsi_b");
            $table->text("deskripsi_c");
            $table->text("deskripsi_d");
            $table->timestamps();

            // $table->foreign("guru_id")
            //     ->references("id")
            //     ->on("gurus")
            //     ->onDelete("cascade");
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
