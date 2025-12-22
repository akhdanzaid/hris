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
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('nik')->unique();
        $table->string('email')->nullable();
        $table->string('phone')->nullable();

        $table->unsignedBigInteger('department_id')->nullable();
        $table->unsignedBigInteger('position_id')->nullable();

        $table->date('join_date')->nullable();
        $table->enum('employment_status', ['permanent','contract','intern'])->default('contract');

        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
