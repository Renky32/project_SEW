<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_konsultasi', function (Blueprint $table) {
            $table->id('id_jadwal_konsultasi');
            $table->unsignedBigInteger('dokter_id');
            $table->unsignedBigInteger('pasien_id');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->text('keluhan');
            $table->text('riwayat_penyakit')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->foreign('dokter_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pasien_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('dokter_id');
            $table->index('pasien_id');
            $table->index('tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_konsultasi');
    }
};
