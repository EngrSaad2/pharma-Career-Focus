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
        Schema::create('exam_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('default_time_minutes')->default(15);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('exam_categories')->cascadeOnDelete();
            $table->text('question_text');
            $table->text('option_a');
            $table->text('option_b');
            $table->text('option_c');
            $table->text('option_d');
            $table->char('correct_option', 1); // a, b, c, d
            $table->text('explanation')->nullable();
            $table->string('difficulty', 20)->default('intermediate'); // beginner, intermediate, advanced
            $table->string('tags')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('exam_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('category_id')->constrained('exam_categories')->cascadeOnDelete();
            $table->string('session_title');
            $table->integer('total_questions');
            $table->integer('correct_answers');
            $table->decimal('score_percentage', 5, 2);
            $table->integer('time_taken_seconds')->default(0);
            $table->json('user_answers')->nullable();
            $table->boolean('passed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_attempts');
        Schema::dropIfExists('exam_questions');
        Schema::dropIfExists('exam_categories');
    }
};
