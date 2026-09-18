<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->unique();
            $table->string('name', 120);
            $table->string('phone', 30);
            $table->string('email', 120)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('note', 500)->nullable();
            $table->unsignedInteger('total_amount')->default(0);

            // bKash Tokenized Checkout fields
            $table->string('bkash_payment_id')->nullable();
            $table->string('bkash_trx_id')->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending');

            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
