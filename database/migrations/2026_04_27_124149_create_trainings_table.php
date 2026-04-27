<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('slug')->unique();
            $table->string('training_image')->nullable();
            $table->string('training_banner_image')->nullable();
            $table->enum('type', ['online', 'offline'])->nullable();
            $table->date('course_start')->nullable();
            $table->date('registration_deadline')->nullable();
            $table->string('duration', 100)->nullable();
            $table->unsignedInteger('no_of_classes')->nullable();
            $table->unsignedInteger('registration_fee')->nullable();
            $table->unsignedInteger('regular_fee')->nullable();
            $table->string('certification')->nullable();
            $table->string('short_description', 250)->nullable();
            $table->longText('long_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('training_trainer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id');
            $table->unsignedBigInteger('trainer_id');
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_trainer'); // ← আগে pivot drop
        Schema::dropIfExists('trainings');        // ← তারপর main table
    }
};
