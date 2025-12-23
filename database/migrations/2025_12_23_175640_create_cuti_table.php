<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();

            // Relasi ke karyawan
            $table->foreignId('karyawan_id')
                  ->constrained('karyawan')
                  ->onDelete('cascade');

            // Data pengajuan
            $table->text('alasan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            // Berkas pendukung (pdf / jpg / png)
            $table->string('berkas')->nullable();

            // Status pengajuan
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');

            // Timestamp
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};
