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
        Schema::create('viva_questions', function (Blueprint $table) {
            $table->id();
            $table->string('domain');
            $table->string('topic');
            $table->text('question_text');
            $table->longText('model_answer');
            $table->text('interviewer_tip')->nullable();
            $table->json('key_points')->nullable();
            $table->string('difficulty', 20)->default('Standard'); // Fundamental, Standard, Advanced
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('user_viva_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('viva_question_id')->constrained('viva_questions')->cascadeOnDelete();
            $table->boolean('is_bookmarked')->default(false);
            $table->boolean('is_practised')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'viva_question_id']);
        });

        Schema::create('interview_questions', function (Blueprint $table) {
            $table->id();
            $table->string('target_role');
            $table->string('category', 40)->default('Technical'); // Technical, Behavioral, Situational, HR & Career Strategy
            $table->text('question_text');
            $table->text('context_explanation')->nullable();
            $table->text('star_situation')->nullable();
            $table->text('star_task')->nullable();
            $table->text('star_action')->nullable();
            $table->text('star_result')->nullable();
            $table->longText('model_answer')->nullable();
            $table->text('recruiter_red_flags')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('user_interview_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('interview_question_id')->constrained('interview_questions')->cascadeOnDelete();
            $table->boolean('is_bookmarked')->default(false);
            $table->boolean('is_prepared')->default(false);
            $table->text('user_notes')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'interview_question_id'], 'uip_user_q_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_interview_progress');
        Schema::dropIfExists('interview_questions');
        Schema::dropIfExists('user_viva_progress');
        Schema::dropIfExists('viva_questions');
    }
};
