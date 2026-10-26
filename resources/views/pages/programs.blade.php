@extends('layouts.app')

@section('title', 'Pharma Career Launchpad Flagship Program | Pharma Career Compass')
@section('meta_description', 'PHARMA CAREER LAUNCHPAD is a practical career preparation program for pharmacists. Master career planning, written exam preparation, viva skills, and interview readiness.')

@section('content')
<section class="py-14 md:py-20 bg-gradient-to-b from-[#00245A] to-[#00173B] text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <span class="inline-block text-xs font-bold uppercase tracking-widest text-[#FFCD00] bg-white/10 px-4 py-1.5 rounded-full border border-white/20">
            Flagship Preparation Curriculum
        </span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight">
            PHARMA CAREER LAUNCHPAD
        </h1>
        <p class="text-lg sm:text-xl font-medium text-blue-200">
            A Practical Career Preparation Program for Pharmacists
        </p>
        <p class="text-sm sm:text-base text-blue-100/90 max-w-2xl mx-auto leading-relaxed">
            “Your pharmaceutical career deserves a clear direction. Pharma Career Launchpad helps you understand your opportunities, strengthen your knowledge, prepare for recruitment assessments, and develop the confidence to present yourself professionally.”
        </p>
        <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('quiz.index') }}" class="btn-accent px-7 py-3 text-sm shadow-md hover:shadow-lg">
                Start with Free Career Quiz
            </a>
            <a href="{{ route('booking.create') }}" class="btn-secondary px-7 py-3 text-sm shadow-md hover:shadow-lg">
                Book 1-on-1 Consultation
            </a>
        </div>
    </div>
</section>

<!-- The 5 Pillars in Detail -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-left">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <h2 class="text-3xl font-extrabold text-[#00245A]">The 5 Pillars of Career Launchpad</h2>
            <p class="text-sm text-slate-600">
                A systematic curriculum covering the end-to-end recruitment lifecycle from self-discovery to placement.
            </p>
        </div>

        <div class="space-y-6">
            <!-- Pillar 1 -->
            <div class="bg-white rounded-2xl border border-slate-200 p-8 flex flex-col md:flex-row gap-6 items-start shadow-sm hover:shadow-md transition-all">
                <div class="w-14 h-14 rounded-2xl bg-[#0085FF] text-white flex items-center justify-center font-black text-xl shrink-0 shadow-sm">
                    01
                </div>
                <div class="space-y-2 flex-grow">
                    <span class="text-xs font-bold text-[#0085FF] uppercase tracking-wider">Pillar 1</span>
                    <h3 class="text-2xl font-bold text-[#00245A]">Career Planning & Specialization Mapping</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Examine your analytical, technological, and communication strengths. Understand the differing daily workflows of Quality Assurance, Quality Control, Production, Regulatory Affairs, and Commercial Marketing.
                    </p>
                    <ul class="pt-2 text-xs text-slate-600 space-y-1 list-disc list-inside">
                        <li>Department fit diagnostic test and gap analysis</li>
                        <li>Personalized 3-year pharmaceutical growth trajectory</li>
                        <li>Industry hierarchy and promotional milestones mapping</li>
                    </ul>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-white rounded-2xl border border-slate-200 p-8 flex flex-col md:flex-row gap-6 items-start shadow-sm hover:shadow-md transition-all">
                <div class="w-14 h-14 rounded-2xl bg-[#FFCD00] text-[#00245A] flex items-center justify-center font-black text-xl shrink-0 shadow-sm">
                    02
                </div>
                <div class="space-y-2 flex-grow">
                    <span class="text-xs font-bold text-amber-700 uppercase tracking-wider">Pillar 2</span>
                    <h3 class="text-2xl font-bold text-[#00245A]">Written Recruitment Exam Preparation</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Master the technical screening assessments required by top tier national and multinational pharmaceutical firms.
                    </p>
                    <ul class="pt-2 text-xs text-slate-600 space-y-1 list-disc list-inside">
                        <li>500+ curated pharmaceutical multiple choice and descriptive question patterns</li>
                        <li>Formula cheat sheets for HPLC theoretical plates, dissolution f2 similarity, and bioequivalence</li>
                        <li>Full-length timed mock tests with diagnostic score breakdown</li>
                    </ul>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div class="bg-white rounded-2xl border border-slate-200 p-8 flex flex-col md:flex-row gap-6 items-start shadow-sm hover:shadow-md transition-all">
                <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-black text-xl shrink-0 shadow-sm">
                    03
                </div>
                <div class="space-y-2 flex-grow">
                    <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Pillar 3</span>
                    <h3 class="text-2xl font-bold text-[#00245A]">Viva & Oral Examination Skills</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Bridge the gap between knowing an answer and speaking it authoritatively under oral board scrutiny.
                    </p>
                    <ul class="pt-2 text-xs text-slate-600 space-y-1 list-disc list-inside">
                        <li>Model answers for CAPA, OOS Phase I/II, tablet defects, and cleanroom air flow</li>
                        <li>Body language, posture, and professional pharmaceutical vocabulary</li>
                        <li>Interactive rehearsal hub with bookmarking and practice logging</li>
                    </ul>
                </div>
            </div>

            <!-- Pillar 4 -->
            <div class="bg-white rounded-2xl border border-slate-200 p-8 flex flex-col md:flex-row gap-6 items-start shadow-sm hover:shadow-md transition-all">
                <div class="w-14 h-14 rounded-2xl bg-purple-600 text-white flex items-center justify-center font-black text-xl shrink-0 shadow-sm">
                    04
                </div>
                <div class="space-y-2 flex-grow">
                    <span class="text-xs font-bold text-purple-700 uppercase tracking-wider">Pillar 4</span>
                    <h3 class="text-2xl font-bold text-[#00245A]">Job Interview Readiness & STAR Technique</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Conquer panel interviews by structuring responses with the Situation, Task, Action, and Result (STAR) framework.
                    </p>
                    <ul class="pt-2 text-xs text-slate-600 space-y-1 list-disc list-inside">
                        <li>Handling high-stress plant floor crisis and line clearance questions</li>
                        <li>Elevator pitch tailored specifically for pharmaceutical recruiters</li>
                        <li>Mock interview simulations with constructive rubric evaluations</li>
                    </ul>
                </div>
            </div>

            <!-- Pillar 5 -->
            <div class="bg-white rounded-2xl border border-slate-200 p-8 flex flex-col md:flex-row gap-6 items-start shadow-sm hover:shadow-md transition-all">
                <div class="w-14 h-14 rounded-2xl bg-[#00245A] text-white flex items-center justify-center font-black text-xl shrink-0 shadow-sm">
                    05
                </div>
                <div class="space-y-2 flex-grow">
                    <span class="text-xs font-bold text-blue-800 uppercase tracking-wider">Pillar 5</span>
                    <h3 class="text-2xl font-bold text-[#00245A]">Pharmaceutical Industry Insights & Senior Mentorship</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Learn directly from industry leaders who share insider perspectives on regulatory audits, automation, and corporate culture.
                    </p>
                    <ul class="pt-2 text-xs text-slate-600 space-y-1 list-disc list-inside">
                        <li>US FDA, EU GMP, and WHO prequalification audit protocols</li>
                        <li>Mastering digital laboratories (LIMS) and ERP systems (SAP)</li>
                        <li>Direct 1-on-1 access to senior consultants for ongoing career advice</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-14 text-center">
            <a href="{{ route('booking.create') }}" class="btn-primary text-base py-3.5 px-8 shadow-sm hover:shadow-md font-bold">
                Join the Launchpad Program &rarr;
            </a>
        </div>
    </div>
</section>
@endsection
