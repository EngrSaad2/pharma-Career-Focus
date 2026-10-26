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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->string('tag')->nullable();
            $table->text('summary');
            $table->longText('description')->nullable();
            $table->string('target_audience')->nullable();
            $table->json('expected_outcomes')->nullable();
            $table->integer('duration_minutes')->default(45);
            $table->decimal('price', 10, 2)->default(0.00);
            $table->string('currency', 10)->default('USD');
            $table->string('delivery_mode')->default('Live 1-on-1 Online Session');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('consultants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('current_company')->nullable();
            $table->string('specialization');
            $table->string('qualifications')->nullable();
            $table->integer('experience_years')->default(5);
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->json('areas_of_expertise')->nullable();
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->integer('reviews_count')->default(0);
            $table->json('consultation_types')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('consultant_availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultant_id')->constrained('consultants')->cascadeOnDelete();
            $table->tinyInteger('day_of_week'); // 0 = Sunday, 6 = Saturday
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('slot_duration_minutes')->default(30);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultant_availabilities');
        Schema::dropIfExists('consultants');
        Schema::dropIfExists('services');
    }
};
