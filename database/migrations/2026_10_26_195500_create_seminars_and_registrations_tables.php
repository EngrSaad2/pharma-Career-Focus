<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Seminars Table
        Schema::create('seminars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('topic')->nullable();
            $table->string('category')->default('General'); // e.g. Quality Assurance, Regulatory, Industrial Pharmacy
            $table->text('short_description')->nullable();
            $table->longText('full_description');
            
            // Visuals
            $table->string('featured_image')->nullable();
            $table->string('banner_image')->nullable();
            
            // Speaker / Trainer
            $table->string('speaker_name');
            $table->string('speaker_designation');
            $table->text('speaker_bio')->nullable();
            $table->string('speaker_avatar')->nullable();
            
            // Schedule & Dates
            $table->date('start_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('registration_opens_at')->nullable();
            $table->date('registration_closes_at')->nullable();
            
            // Mode & Pricing & Capacity
            $table->enum('participation_type', ['online', 'offline', 'both'])->default('both');
            $table->decimal('registration_fee', 10, 2)->default(1000.00);
            $table->integer('max_capacity')->default(100);
            
            // Location / Access Details
            $table->string('venue_name')->nullable();
            $table->text('venue_address')->nullable();
            $table->text('venue_map_url')->nullable();
            $table->string('online_meeting_url')->nullable();
            $table->text('online_joining_instructions')->nullable();
            
            // Policies & Links
            $table->text('terms_conditions')->nullable();
            $table->text('payment_instructions')->nullable();
            $table->string('facebook_url')->nullable();
            
            // Status & SEO
            $table->enum('status', [
                'draft', 
                'published', 
                'registration_open', 
                'registration_closed', 
                'completed', 
                'cancelled'
            ])->default('draft');
            
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->boolean('is_featured')->default(false);
            
            $table->timestamps();
            
            $table->index(['status', 'start_date']);
        });

        // 2. Seminar Registrations Table
        Schema::create('seminar_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seminar_id')->constrained('seminars')->cascadeOnDelete();
            $table->string('registration_reference')->unique(); // e.g. SEM-2026-A1B2C
            
            // Participant Info
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('organization')->nullable();
            $table->string('designation')->nullable();
            $table->enum('participation_type', ['online', 'offline'])->default('online');
            
            // Payment Info
            $table->decimal('amount_payable', 10, 2)->default(1000.00);
            $table->string('payment_method')->default('bKash');
            $table->string('transaction_id');
            $table->string('sender_number')->nullable();
            $table->string('payment_proof')->nullable(); // uploaded receipt file path
            
            // Statuses
            $table->enum('payment_status', [
                'pending', 
                'verified', 
                'rejected', 
                'refunded'
            ])->default('pending');
            
            $table->enum('registration_status', [
                'pending_payment', 
                'pending_verification', 
                'confirmed', 
                'waitlisted', 
                'cancelled'
            ])->default('pending_verification');
            
            // Administrative Review
            $table->text('rejection_reason')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            
            // Notifications tracking
            $table->timestamp('confirmation_sent_at')->nullable();
            $table->integer('confirmation_sent_count')->default(0);
            
            $table->timestamps();
            
            $table->index(['seminar_id', 'registration_status']);
            $table->index(['payment_status']);
            $table->index(['email']);
        });

        // 3. Email Logs Table (Tracking delivery & failures)
        Schema::create('seminar_email_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seminar_registration_id')->constrained('seminar_registrations')->cascadeOnDelete();
            $table->string('email_type'); // registration_received, payment_verified, payment_rejected, registration_cancelled, broadcast_update
            $table->string('recipient_email');
            $table->string('subject');
            $table->enum('status', ['sent', 'failed'])->default('sent');
            $table->text('error_message')->nullable();
            $table->foreignId('sent_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            
            $table->index(['seminar_registration_id', 'email_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seminar_email_logs');
        Schema::dropIfExists('seminar_registrations');
        Schema::dropIfExists('seminars');
    }
};
