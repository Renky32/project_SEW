<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('specialty'); // Spesialisasi dokter
            $table->string('phone')->unique();
            $table->string('license_number')->unique(); // Nomor lisensi dokter
            $table->text('bio')->nullable();
            $table->decimal('consultation_fee', 10, 2)->default(0); // Biaya konsultasi
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
