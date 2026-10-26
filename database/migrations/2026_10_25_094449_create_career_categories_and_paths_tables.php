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
        Schema::create('career_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('career_paths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('career_categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->string('badge')->nullable();
            $table->text('summary');
            $table->longText('overview')->nullable();
            $table->json('required_skills')->nullable();
            $table->json('relevant_qualifications')->nullable();
            $table->json('possible_entry_points')->nullable();
            $table->json('recommended_preparation')->nullable();
            $table->text('typical_day')->nullable();
            $table->string('salary_range')->nullable();
            $table->string('work_environment')->nullable();
            $table->string('experience_level')->default('Fresh Graduate / Entry');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_paths');
        Schema::dropIfExists('career_categories');
    }
};
