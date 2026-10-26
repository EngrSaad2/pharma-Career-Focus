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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('education_level')->nullable();
            $table->string('university')->nullable();
            $table->integer('graduation_year')->nullable();
            $table->string('current_status')->nullable();
            $table->string('current_company')->nullable();
            $table->string('target_department')->nullable();
            $table->string('target_role')->nullable();
            $table->decimal('years_experience', 4, 1)->default(0);
            $table->string('linkedin_url')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('preferred_learning_mode')->nullable();
            $table->text('career_summary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
