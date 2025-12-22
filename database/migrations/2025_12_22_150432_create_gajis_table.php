<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();

            // relasi ke karyawan
            $table->foreignId('karyawan_id')
                  ->constrained('karyawan')
                  ->cascadeOnDelete();

            $table->integer('gaji_pokok');
            $table->integer('total_potongan')->default(0);
            $table->integer('total_gaji');

            // contoh: 2025-01
            $table->string('periode', 7);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gajis');
    }
};

