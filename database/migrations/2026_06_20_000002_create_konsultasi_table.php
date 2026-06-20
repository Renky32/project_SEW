<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id('id_konsultasi');
            $table->unsignedBigInteger('dokter_id');
            $table->unsignedBigInteger('pasien_id');
            $table->date('tanggal_konsultasi');
            $table->string('diagnosis', 255);
            $table->longText('resep_obat');
            $table->longText('catatan');
            $table->enum('status', ['pending', 'selesai', 'cancelled'])->default('selesai');
            $table->timestamps();

            $table->foreign('dokter_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pasien_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('dokter_id');
            $table->index('pasien_id');
            $table->index('tanggal_konsultasi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};
