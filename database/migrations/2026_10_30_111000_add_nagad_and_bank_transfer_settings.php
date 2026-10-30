<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\SiteSetting;

return new class extends Migration
{
    public function up(): void
    {
        SiteSetting::set('seminar_payment_method', 'bKash / Nagad / Bank Transfer');
        SiteSetting::set('seminar_bkash_number', '01722531335');
        SiteSetting::set('seminar_bkash_type', 'Personal (Send Money)');
        SiteSetting::set('seminar_nagad_number', '01722531335');
        SiteSetting::set('seminar_bank_name', 'Dutch-Bangla Bank PLC (DBBL)');
        SiteSetting::set('seminar_bank_account_name', 'Md. Abul Bashar');
        SiteSetting::set('seminar_bank_account_number', '1221030213784');
        SiteSetting::set('seminar_bank_branch', 'DEPZ Branch');
    }

    public function down(): void
    {
    }
};
