<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedTinyInteger('discount_percent')->default(0)->after('price');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedInteger('original_price')->nullable()->after('title');
            $table->unsignedTinyInteger('discount_percent')->default(0)->after('original_price');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['original_price', 'discount_percent']);
        });

        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('discount_percent');
        });
    }
};
