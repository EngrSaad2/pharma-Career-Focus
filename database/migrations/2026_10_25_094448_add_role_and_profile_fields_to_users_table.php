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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 30)->default('user')->after('password')->index();
            $table->string('phone', 50)->nullable()->after('email');
            $table->string('avatar')->nullable()->after('role');
            $table->string('headline')->nullable()->after('avatar');
            $table->text('bio')->nullable()->after('headline');
            $table->boolean('is_active')->default(true)->after('bio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'avatar', 'headline', 'bio', 'is_active']);
        });
    }
};
