<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();

            $table->string('nik')->unique();
            $table->string('name');
            $table->string('gender');
            $table->string('birth_place');
            $table->date('birth_date');

            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('photo')->nullable(); 
            
            $table->foreignId('department_id')
                  ->constrained('departments')
                  ->cascadeOnDelete();

            $table->foreignId('position_id')
                  ->constrained('positions')
                  ->cascadeOnDelete();

            $table->date('join_date');

            $table->foreignId('status_id')
                  ->constrained('statuses')
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
