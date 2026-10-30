<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Consultant;
use App\Models\ConsultantAvailability;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Clear all consultant availabilities (time slots removed)
        ConsultantAvailability::query()->delete();

        // 2. Ensure / update MD Abul Bashar, RPh (Fee: 1000, 15+ years)
        $bashar = Consultant::where('name', 'like', '%Abul Bashar%')->first();
        if ($bashar) {
            $bashar->update([
                'name' => 'MD Abul Bashar, RPh',
                'title' => 'Founder & Lead Pharmaceutical Career Consultant',
                'specialization' => 'Industrial Pharmacy, QA/QC & Regulatory Affairs',
                'current_company' => 'Pharma Career Compass',
                'experience_years' => 15,
                'hourly_rate' => 1000.00,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1,
            ]);
        } else {
            $bashar = Consultant::create([
                'name' => 'MD Abul Bashar, RPh',
                'slug' => 'md-abul-bashar-rph',
                'title' => 'Founder & Lead Pharmaceutical Career Consultant',
                'specialization' => 'Industrial Pharmacy, QA/QC & Regulatory Affairs',
                'current_company' => 'Pharma Career Compass',
                'qualifications' => 'B.Pharm (Hons), M.Pharm (Industrial Pharmacy), Registered Pharmacist',
                'experience_years' => 15,
                'bio' => 'MD Abul Bashar is the Founder and Lead Consultant of Pharma Career Compass. A licensed pharmacist registered with the Pharmacy Council of Bangladesh, he brings over 15 years of industrial experience across plant operations, cGMP compliance, validation, and professional development in Bangladesh\'s top pharmaceutical companies.',
                'hourly_rate' => 1000.00,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1,
            ]);
        }

        // 3. Ensure / update Shah Sharfin (AGM and Head of QA, Experience 15+, Fee: 1000)
        Consultant::updateOrCreate(
            ['slug' => 'shah-sharfin'],
            [
                'name' => 'Shah Sharfin',
                'title' => 'AGM and Head of QA',
                'specialization' => 'Quality Assurance & cGMP Operations',
                'current_company' => 'Leading Pharmaceutical Industry',
                'qualifications' => 'B.Pharm (Hons), M.Pharm, Registered Pharmacist',
                'experience_years' => 15,
                'bio' => 'Shah Sharfin is an Assistant General Manager (AGM) and Head of Quality Assurance with over 15 years of proven pharmaceutical industry leadership. Expert in Quality Management Systems (QMS), cGMP compliance, regulatory audits, deviation management, CAPA, and mentoring pharmacy graduates for technical excellence.',
                'hourly_rate' => 1000.00,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
            ]
        );

        // 4. Remove all other leaders — keep strictly only these two!
        Consultant::whereNotIn('slug', [$bashar->slug, 'shah-sharfin'])
            ->whereNotIn('name', ['MD Abul Bashar, RPh', 'Shah Sharfin'])
            ->delete();
    }

    public function down(): void
    {
    }
};
