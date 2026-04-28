<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_id')->constrained('trainings')->cascadeOnDelete();
            $table->string('invoice')->unique();
            $table->string('name', 120);
            $table->string('phone', 30);
            $table->string('email', 120)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('note', 500)->nullable();
            $table->string('bkash_number', 30)->nullable();
            $table->string('bkash_trx_id', 100)->nullable();
            $table->unsignedInteger('amount')->default(0);
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
