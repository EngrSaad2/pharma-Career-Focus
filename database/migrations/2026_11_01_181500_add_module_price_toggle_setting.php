<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\SiteSetting;

return new class extends Migration
{
    public function up(): void
    {
        // By default it will be turned off ('0')
        SiteSetting::updateOrCreate(
            ['key' => 'module_price_enabled'],
            ['value' => '0', 'group' => 'seminar']
        );
    }

    public function down(): void
    {
    }
};
