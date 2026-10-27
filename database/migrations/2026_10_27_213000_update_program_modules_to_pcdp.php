<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Seminar;
use App\Models\SiteSetting;
use Carbon\Carbon;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Update site settings
        SiteSetting::updateOrCreate(
            ['key' => 'program_name'],
            ['value' => 'Pharmaceutical Career Development Program', 'group' => 'program']
        );

        SiteSetting::updateOrCreate(
            ['key' => 'program_description'],
            ['value' => 'Building Your Future in the Pharmaceutical Industry', 'group' => 'program']
        );

        SiteSetting::updateOrCreate(
            ['key' => 'announcement_ticker'],
            [
                'value' => '• Registration Open: Pharmaceutical Career Development Program • Module 1: Industrial Operations & Module 2: Pharmaceutical Marketing • Online Sessions Every Friday & Saturday • BDT 1,000 / Session •',
                'group' => 'general'
            ]
        );

        // Next upcoming Friday
        $nextFriday = Carbon::now()->next(Carbon::FRIDAY);
        if ($nextFriday->isPast()) {
            $nextFriday = Carbon::now()->addDays(2);
        }
        $nextSaturday = (clone $nextFriday)->addDay();

        $module1Description = '<div class="space-y-6">
    <div class="p-5 bg-blue-50/60 rounded-2xl border border-blue-100">
        <h3 class="text-xl font-bold text-[#00245A] mb-2">Pharmaceutical Career Development Program</h3>
        <p class="text-sm font-semibold text-[#0085FF] mb-2">Building Your Future in the Pharmaceutical Industry</p>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            A career-oriented professional development program designed for final-year pharmacy students and graduate pharmacists who want to build a successful career in the pharmaceutical industry.
        </p>
    </div>

    <div>
        <h3 class="text-lg font-bold text-[#00245A] mb-3">Course Outline: Career Preparation for Key Pharmaceutical Departments</h3>
        <div class="text-sm text-slate-700">
            <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                <strong class="text-[#00245A] font-bold block mb-0.5">Production:</strong>
                <span>Manufacturing operations, GMP practices, production documentation, and interview preparation.</span>
            </div>
            <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                <strong class="text-[#00245A] font-bold block mb-0.5">Quality Assurance (QA):</strong>
                <span>Quality Management Systems (QMS), GMP compliance, deviation management, CAPA, change control, and audit preparation.</span>
            </div>
            <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                <strong class="text-[#00245A] font-bold block mb-0.5">Quality Control (QC):</strong>
                <span>Pharmaceutical analysis, laboratory practices, analytical instruments, and QC interview preparation.</span>
            </div>
            <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                <strong class="text-[#00245A] font-bold block mb-0.5">Research & Development (R&D):</strong>
                <span>Formulation development, preformulation studies, process development, and product development.</span>
            </div>
            <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                <strong class="text-[#00245A] font-bold block mb-0.5">Production Planning & Inventory Control (PPIC):</strong>
                <span>Production planning, material management, inventory control, and coordination with other departments.</span>
            </div>
            <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                <strong class="text-[#00245A] font-bold block mb-0.5">Regulatory Affairs (RA):</strong>
                <span>Regulatory documentation, product registration, dossier preparation, and regulatory compliance.</span>
            </div>
        </div>
    </div>

    <div class="pt-4 border-t border-slate-200">
        <h3 class="text-lg font-bold text-[#00245A] mb-3">Additional Focus Areas</h3>
        <ul class="space-y-2 text-sm text-slate-700">
            <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold">✓</span> <span>Career planning and professional development</span></li>
            <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold">✓</span> <span>CV writing and job application strategies</span></li>
            <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold">✓</span> <span>Pharmaceutical written examination preparation</span></li>
            <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold">✓</span> <span>Technical viva and interview preparation</span></li>
            <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold">✓</span> <span>Industry expectations and essential professional skills</span></li>
        </ul>
    </div>

    <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200">
        <h4 class="text-sm font-bold text-[#00245A] uppercase tracking-wider mb-2">Session Schedule & Registration</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs sm:text-sm text-slate-600">
            <div><strong>Session Days:</strong> Every Friday and Saturday</div>
            <div><strong>Session Duration:</strong> 2–3 hours per session</div>
            <div><strong>Registration Fee:</strong> BDT 1,000 per session</div>
            <div><strong>Mode:</strong> Online Live Session</div>
            <div class="sm:col-span-2"><strong>Eligibility:</strong> Final-year pharmacy students and graduate pharmacists</div>
        </div>
    </div>
</div>';

        $module2Description = '<div class="space-y-6">
    <div class="p-5 bg-blue-50/60 rounded-2xl border border-blue-100">
        <h3 class="text-xl font-bold text-[#00245A] mb-2">Pharmaceutical Career Development Program</h3>
        <p class="text-sm font-semibold text-[#0085FF] mb-2">Building Your Future in the Pharmaceutical Industry</p>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            A career-oriented professional development program designed for final-year pharmacy students and graduate pharmacists who want to build a successful career in the pharmaceutical industry.
        </p>
    </div>

    <div>
        <h3 class="text-lg font-bold text-[#00245A] mb-3">Course Outline: Career Preparation for Pharmaceutical Marketing Professionals</h3>
        <div class="text-sm text-slate-700">
            <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                <strong class="text-[#00245A] font-bold block mb-0.5">Sales & Brand Management Department (SBMD):</strong>
                <span>Pharmaceutical sales, product knowledge, brand promotion, communication skills, and sales force career preparation.</span>
            </div>
            <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                <strong class="text-[#00245A] font-bold block mb-0.5">International Business Division (IBD):</strong>
                <span>International pharmaceutical business, export operations, international market development, and global business communication.</span>
            </div>
            <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                <strong class="text-[#00245A] font-bold block mb-0.5">Marketing Career Pathways:</strong>
                <span>Marketing career pathways and professional competencies.</span>
            </div>
            <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                <strong class="text-[#00245A] font-bold block mb-0.5">Recruitment Preparation:</strong>
                <span>CV preparation, written examinations, and interview techniques.</span>
            </div>
            <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                <strong class="text-[#00245A] font-bold block mb-0.5">Essential Professional Skills:</strong>
                <span>Essential communication, negotiation, and presentation skills.</span>
            </div>
        </div>
    </div>

    <div class="pt-4 border-t border-slate-200">
        <h3 class="text-lg font-bold text-[#00245A] mb-3">Key Focus Areas</h3>
        <ul class="space-y-2 text-sm text-slate-700">
            <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold">✓</span> <span>Sales strategy & ethical product promotion</span></li>
            <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold">✓</span> <span>Global pharmaceutical export & market entry analysis</span></li>
            <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold">✓</span> <span>High-impact medical visual aids & doctor presentation skills</span></li>
            <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold">✓</span> <span>Negotiation techniques & commercial viva preparation</span></li>
        </ul>
    </div>

    <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200">
        <h4 class="text-sm font-bold text-[#00245A] uppercase tracking-wider mb-2">Session Schedule & Registration</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs sm:text-sm text-slate-600">
            <div><strong>Session Days:</strong> Every Friday and Saturday</div>
            <div><strong>Session Duration:</strong> 2–3 hours per session</div>
            <div><strong>Registration Fee:</strong> BDT 1,000 per session</div>
            <div><strong>Mode:</strong> Online Live Session</div>
            <div class="sm:col-span-2"><strong>Eligibility:</strong> Final-year pharmacy students and graduate pharmacists</div>
        </div>
    </div>
</div>';

        // 2. Update Seminar 1 (Module 1)
        Seminar::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Module 1: Career in Pharmaceutical Industrial Operations',
                'slug' => 'module-1-career-in-pharmaceutical-industrial-operations',
                'topic' => 'Production, QA, QC, R&D, PPIC & Regulatory Affairs',
                'category' => 'Industrial Operations',
                'short_description' => 'Comprehensive career preparation for key pharmaceutical departments: Production, QA, QC, R&D, PPIC, and Regulatory Affairs.',
                'full_description' => $module1Description,
                'speaker_name' => 'MD Abul Bashar, RPh',
                'speaker_designation' => 'Founder & Lead Pharmaceutical Career Consultant | 15+ Yrs Industrial Experience',
                'speaker_bio' => 'Licensed Pharmacist with over 15 years leading plant operations, cGMP validation, and technical recruitment training.',
                'start_date' => $nextFriday->toDateString(),
                'start_time' => '19:30:00',
                'end_time' => '22:00:00',
                'registration_opens_at' => Carbon::now()->subDays(5)->toDateString(),
                'registration_closes_at' => $nextFriday->toDateString(),
                'participation_type' => 'online',
                'registration_fee' => 1000.00,
                'max_capacity' => 100,
                'online_meeting_url' => 'https://meet.google.com/pharma-career-compass',
                'online_joining_instructions' => 'Interactive live online session via Google Meet. Access link provided automatically upon payment verification.',
                'status' => 'registration_open',
                'is_featured' => true,
                'seo_title' => 'Module 1: Career in Pharmaceutical Industrial Operations | Pharma Career Compass',
                'seo_description' => 'Career preparation for Production, QA, QC, R&D, PPIC, and Regulatory Affairs in Bangladesh pharmaceutical industry.',
            ]
        );

        // 3. Update Seminar 2 (Module 2)
        Seminar::updateOrCreate(
            ['id' => 2],
            [
                'title' => 'Module 2: Career in Pharmaceutical Marketing',
                'slug' => 'module-2-career-in-pharmaceutical-marketing',
                'topic' => 'Sales & Brand Management (SBMD) & International Business (IBD)',
                'category' => 'Pharmaceutical Marketing',
                'short_description' => 'Career preparation for Pharmaceutical Marketing Professionals: Sales & Brand Management, International Business, CV & interview readiness.',
                'full_description' => $module2Description,
                'speaker_name' => 'Tahmina Akhter, RPh',
                'speaker_designation' => 'Senior Brand Manager (PMD) & Medical Marketing Consultant',
                'speaker_bio' => '10+ years driving therapeutic brand positioning, international exports, and medical marketing leadership.',
                'start_date' => $nextSaturday->toDateString(),
                'start_time' => '19:30:00',
                'end_time' => '22:00:00',
                'registration_opens_at' => Carbon::now()->subDays(5)->toDateString(),
                'registration_closes_at' => $nextSaturday->toDateString(),
                'participation_type' => 'online',
                'registration_fee' => 1000.00,
                'max_capacity' => 100,
                'online_meeting_url' => 'https://meet.google.com/pharma-career-compass',
                'online_joining_instructions' => 'Interactive live online session via Google Meet. Access link provided automatically upon payment verification.',
                'status' => 'registration_open',
                'is_featured' => true,
                'seo_title' => 'Module 2: Career in Pharmaceutical Marketing | Pharma Career Compass',
                'seo_description' => 'Career preparation for Sales & Brand Management (SBMD) and International Business Division (IBD) for pharmacists.',
            ]
        );

        // 4. Delete any other seminars to keep strictly ONLY these two modules
        Seminar::whereNotIn('id', [1, 2])->delete();
    }

    public function down(): void
    {
        // No destructive reversal needed
    }
};
