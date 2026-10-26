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
        Schema::create('consultation_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('consultant_id')->constrained('consultants')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('status', 30)->default('confirmed'); // pending, confirmed, completed, cancelled, rescheduled
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone')->nullable();
            $table->string('current_qualification')->nullable();
            $table->string('target_goal')->nullable();
            $table->text('notes')->nullable();
            $table->string('meeting_link')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();

            $table->index(['consultant_id', 'booking_date', 'start_time'], 'cb_slot_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_bookings');
    }
};
