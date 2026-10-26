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
        Schema::create('career_assessment_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('step_number')->default(1);
            $table->string('question_text');
            $table->text('description')->nullable();
            $table->string('input_type', 30)->default('radio'); // radio, checkbox, select
            $table->json('options'); // array of [{label, value, tag, career_weight}]
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('career_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('session_token', 64)->nullable()->index();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('education_level');
            $table->string('specialization')->nullable();
            $table->string('experience_level')->nullable();
            $table->string('preferred_environment')->nullable();
            $table->json('interests')->nullable();
            $table->json('strengths')->nullable();
            $table->json('career_goals')->nullable();
            $table->json('responses')->nullable();
            $table->json('recommended_paths')->nullable();
            $table->json('recommended_services')->nullable();
            $table->json('action_plan')->nullable();
            $table->text('guidance_summary')->nullable();
            $table->boolean('is_saved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_assessments');
        Schema::dropIfExists('career_assessment_questions');
    }
};
