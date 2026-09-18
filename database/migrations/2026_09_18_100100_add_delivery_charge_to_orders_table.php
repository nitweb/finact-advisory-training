<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('delivery_zone', ['inside_dhaka', 'outside_dhaka', 'suburbs'])->nullable()->after('address');
            $table->unsignedInteger('delivery_charge')->default(0)->after('delivery_zone');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['delivery_zone', 'delivery_charge']);
        });
    }
};
