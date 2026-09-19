<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * bkash_trx_id was validated as "unique" at the application layer only
     * (see TrainingEnrollmentController::EnrollSubmit), which does not
     * protect against concurrent duplicate submissions. This adds the
     * matching DB-level constraint, consistent with orders.bkash_trx_id.
     */
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->unique('bkash_trx_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropUnique(['bkash_trx_id']);
        });
    }
};
