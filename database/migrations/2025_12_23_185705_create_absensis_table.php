<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();

            // Relasi ke karyawan (bukan users)
            $table->foreignId('karyawan_id')
                  ->constrained('karyawan')
                  ->cascadeOnDelete();

            $table->date('tanggal');

            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();

            $table->enum('status', [
                'hadir',
                'telat',
                'cuti',
                'tidak hadir'
            ]);

            $table->enum('metode', [
                'barcode',
                'manual'
            ])->default('barcode');

            $table->timestamps();

            // Satu karyawan hanya boleh 1 absensi per tanggal
            $table->unique(['karyawan_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
