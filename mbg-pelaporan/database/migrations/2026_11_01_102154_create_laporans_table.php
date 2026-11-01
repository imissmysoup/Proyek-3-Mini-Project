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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('sekolah_id')->constrained('sekolahs')->restrictOnDelete();
            $table->foreignId('distribusi_id')->constrained('distribusis')->restrictOnDelete();
            $table->text('keluhan');
            $table->string('path_bukti')->nullable();
            $table->enum('status', ['Menunggu Tinjauan', 'Diproses', 'Diteruskan', 'Selesai'])->default('Menunggu Tinjauan');
            $table->text('catatan_pemantau')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
