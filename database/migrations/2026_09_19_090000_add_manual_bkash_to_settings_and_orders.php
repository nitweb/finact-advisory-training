<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('bkash_number', 30)->nullable()->after('suburbs_charge');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('bkash_number', 30)->nullable()->after('payment_method');
            $table->boolean('stock_deducted')->default(false)->after('payment_status');
        });

        // Legacy orders: stock was only deducted for paid / COD orders
        DB::table('orders')
            ->where(function ($q) {
                $q->where('payment_status', 'paid')->orWhere('payment_method', 'cod');
            })
            ->update(['stock_deducted' => true]);
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['bkash_number', 'stock_deducted']);
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('bkash_number');
        });
    }
};
