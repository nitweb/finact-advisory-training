<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->unsignedInteger('inside_dhaka_charge')->default(0)->after('meta_description');
            $table->unsignedInteger('outside_dhaka_charge')->default(0)->after('inside_dhaka_charge');
            $table->unsignedInteger('suburbs_charge')->default(0)->after('outside_dhaka_charge');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['inside_dhaka_charge', 'outside_dhaka_charge', 'suburbs_charge']);
        });
    }
};
