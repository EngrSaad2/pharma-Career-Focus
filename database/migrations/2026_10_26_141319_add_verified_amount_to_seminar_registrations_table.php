<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seminar_registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('seminar_registrations', 'verified_amount')) {
                $table->decimal('verified_amount', 10, 2)->nullable()->after('amount_payable');
            }
        });
    }

    public function down(): void
    {
        Schema::table('seminar_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('seminar_registrations', 'verified_amount')) {
                $table->dropColumn('verified_amount');
            }
        });
    }
};
