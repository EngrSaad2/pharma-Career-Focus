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
        Schema::create('career_roadmaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('career_path_id')->nullable()->constrained('career_paths')->nullOnDelete();
            $table->string('target_role_title');
            $table->string('experience_level');
            $table->integer('target_timeline_months')->default(6);
            $table->integer('progress_percent')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('roadmap_milestones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roadmap_id')->constrained('career_roadmaps')->cascadeOnDelete();
            $table->string('phase_name');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('resource_recommendation')->nullable();
            $table->integer('milestone_order')->default(0);
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roadmap_milestones');
        Schema::dropIfExists('career_roadmaps');
    }
};
