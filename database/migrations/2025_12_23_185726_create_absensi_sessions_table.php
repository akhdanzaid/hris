<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('absensi_sessions', function (Blueprint $table) {
            $table->id();

            $table->date('tanggal');

            $table->enum('tipe', [
                'hadir',
                'pulang'
            ]);

            $table->string('token')->unique();

            $table->boolean('is_active')->default(false);

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->timestamps();

            // Satu sesi hadir & satu sesi pulang per hari
            $table->unique(['tanggal', 'tipe']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi_sessions');
    }
};
