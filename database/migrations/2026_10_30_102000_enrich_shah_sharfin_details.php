<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Consultant;

return new class extends Migration
{
    public function up(): void
    {
        Consultant::where('slug', 'shah-sharfin')->update([
            'areas_of_expertise' => [
                'Quality Management Systems (QMS)',
                'cGMP Compliance & Regulatory Audits',
                'Deviation Management & CAPA',
                'Technical Viva & QA Interview Coaching'
            ],
            'consultation_types' => [
                'Quality Assurance Consultation',
                'Technical Viva Preparation',
                'cGMP Career Mentorship',
                'Job Interview Preparation'
            ],
            'rating' => 5.00,
            'reviews_count' => 142,
            'qualifications' => 'B.Pharm (Hons), M.Pharm (Industrial Pharmacy), Registered Pharmacist',
            'current_company' => 'Leading Pharmaceutical Industry',
        ]);
    }

    public function down(): void
    {
    }
};
