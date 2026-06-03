<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('mapel_id')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->integer('tugas')->default(0);
            $table->integer('uts')->default(0);
            $table->integer('uas')->default(0);
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->enum('status', ['Lulus', 'Tidak Lulus'])->nullable();
            $table->timestamps();
            
            // Prevent duplicate nilai for same siswa and mapel
            $table->unique(['siswa_id', 'mapel_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};