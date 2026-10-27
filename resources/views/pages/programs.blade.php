@extends('layouts.app')

@section('title', 'Pharmaceutical Career Development Program | Building Your Future in the Pharmaceutical Industry')
@section('meta_description', 'A career-oriented professional development program designed for final-year pharmacy students and graduate pharmacists who want to build a successful career in the pharmaceutical industry.')

@section('content')
<!-- Hero Section -->
<section class="relative py-14 sm:py-20 md:py-24 bg-white border-b border-slate-100 overflow-hidden">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 text-[#0085FF] border border-blue-200/80 text-xs font-bold uppercase tracking-widest shadow-xs">
            <span>Career-Oriented Professional Development</span>
        </div>
        
        <h1 class="text-3xl sm:text-5xl md:text-6xl font-black text-slate-900 tracking-tight leading-tight">
            Pharmaceutical Career<br class="hidden sm:inline" />
            <span class="text-[#0085FF]">
                Development Program
            </span>
        </h1>
        
        <p class="text-xl sm:text-2xl font-bold text-slate-800 tracking-wide">
            Building Your Future in the Pharmaceutical Industry
        </p>
        
        <p class="text-sm sm:text-base md:text-lg text-slate-600 max-w-3xl mx-auto leading-relaxed font-normal">
            A career-oriented professional development program designed for final-year pharmacy students and graduate pharmacists who want to build a successful career in the pharmaceutical industry.
        </p>

        <!-- Quick Summary Metrics Bar -->
        <div class="pt-6 grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-3xl mx-auto">
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 text-center shadow-xs">
                <div class="text-xs text-slate-500 uppercase font-bold tracking-wider">Format</div>
                <div class="text-sm sm:text-base font-extrabold text-slate-900 mt-1">🌐 Online Live</div>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 text-center shadow-xs">
                <div class="text-xs text-slate-500 uppercase font-bold tracking-wider">Schedule</div>
                <div class="text-sm sm:text-base font-extrabold text-slate-900 mt-1">Fri & Sat</div>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 text-center shadow-xs">
                <div class="text-xs text-slate-500 uppercase font-bold tracking-wider">Duration</div>
                <div class="text-sm sm:text-base font-extrabold text-slate-900 mt-1">2–3 Hours / Session</div>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 text-center shadow-xs">
                <div class="text-xs text-slate-500 uppercase font-bold tracking-wider">Fee</div>
                <div class="text-sm sm:text-base font-black text-[#0085FF] mt-1">৳1,000 / Session</div>
            </div>
        </div>

        <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
            <a href="#modules" class="btn-primary px-8 py-3.5 text-sm sm:text-base font-bold shadow-md hover:shadow-lg transition-all">
                Explore Program Modules ↓
            </a>
            <a href="{{ route('seminars.index') }}" class="btn-secondary px-8 py-3.5 text-sm sm:text-base font-semibold shadow-xs hover:shadow-md transition-all">
                Register for Live Sessions
            </a>
        </div>
    </div>
</section>

<!-- Program Modules Section -->
<section id="modules" class="py-20 bg-slate-50 border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3.5 py-1.5 rounded-full border border-blue-200/60">
                Flagship Preparation Curriculum
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-[#00245A]">
                Structured Career Guidance & Preparation Services
            </h2>
            <p class="text-lg font-bold text-[#0085FF]">
                Pharmaceutical Career Development Program Modules
            </p>
            <p class="text-sm sm:text-base text-slate-600">
                Two comprehensive, department-targeted modules structured to equip aspiring pharmacists with technical command, regulatory awareness, and commercial competence.
            </p>
        </div>

        <!-- 2 Modules Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
            
            <!-- MODULE 1: Industrial Operations -->
            <div class="bg-white rounded-3xl border-2 border-blue-200/80 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                <div>
                    <!-- Card Top Banner -->
                    <div class="bg-gradient-to-r from-[#00245A] to-[#004B99] text-white p-6 sm:p-8 relative" style="background: linear-gradient(135deg, #00245A 0%, #004B99 100%); color: #ffffff;">
                        <div class="flex items-center justify-between gap-3 mb-3">
                            <span class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-wider bg-[#FFCD00] text-[#00245A] px-3 py-1 rounded-full shadow-xs">
                                Module 1
                            </span>
                            <span class="text-xs text-blue-200 font-bold bg-white/10 px-2.5 py-1 rounded-lg backdrop-blur-md">
                                Industrial & Technical Track
                            </span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight">
                            Career in Pharmaceutical Industrial Operations
                        </h3>
                        <p class="text-xs sm:text-sm text-blue-100/90 mt-2">
                            Comprehensive preparation across all key manufacturing, analytical, formulation, planning, and regulatory functions.
                        </p>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 sm:p-8 space-y-6">
                        
                        <!-- Course Outline: Key Departments -->
                        <div>
                            <div class="flex items-center gap-2 mb-3.5 pb-2 border-b border-slate-100">
                                <svg class="w-5 h-5 text-[#0085FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                <h4 class="font-bold text-base text-[#00245A]">
                                    Course Outline: Career Preparation for Key Pharmaceutical Departments
                                </h4>
                            </div>

                            <div class="space-y-3.5 text-xs sm:text-sm text-slate-700">
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Production:</strong>
                                    <span>Manufacturing operations, GMP practices, production documentation, and interview preparation.</span>
                                </div>

                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Quality Assurance (QA):</strong>
                                    <span>Quality Management Systems (QMS), GMP compliance, deviation management, CAPA, change control, and audit preparation.</span>
                                </div>

                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Quality Control (QC):</strong>
                                    <span>Pharmaceutical analysis, laboratory practices, analytical instruments, and QC interview preparation.</span>
                                </div>

                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Research & Development (R&D):</strong>
                                    <span>Formulation development, preformulation studies, process development, and product development.</span>
                                </div>

                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Production Planning & Inventory Control (PPIC):</strong>
                                    <span>Production planning, material management, inventory control, and coordination with other departments.</span>
                                </div>

                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Regulatory Affairs (RA):</strong>
                                    <span>Regulatory documentation, product registration, dossier preparation, and regulatory compliance.</span>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Focus Areas -->
                        <div class="pt-4 border-t border-slate-100">
                            <h4 class="font-bold text-sm text-[#00245A] uppercase tracking-wider mb-3 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Additional Focus Areas
                            </h4>
                            <ul class="grid grid-cols-1 gap-2 text-xs sm:text-sm text-slate-700">
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                    <span>Career planning and professional development</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                    <span>CV writing and job application strategies</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                    <span>Pharmaceutical written examination preparation</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                    <span>Technical viva and interview preparation</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                    <span>Industry expectations and essential professional skills</span>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Card Footer / Actions -->
                <div class="p-6 sm:p-8 bg-slate-50/80 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div>
                        <div class="text-xs text-slate-500 font-medium">Session Fee</div>
                        <div class="text-xl font-black text-[#00245A]">BDT 1,000 <span class="text-xs font-normal text-slate-500">/ session</span></div>
                    </div>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <a href="{{ route('seminars.show', 'module-1-career-in-pharmaceutical-industrial-operations') }}" class="flex-1 sm:flex-none text-center px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-bold text-slate-700 hover:bg-white transition-colors">
                            Details
                        </a>
                        <a href="{{ route('seminars.register', 'module-1-career-in-pharmaceutical-industrial-operations') }}" class="flex-1 sm:flex-none text-center px-6 py-2.5 rounded-xl bg-[#0085FF] hover:bg-[#0070d9] text-white text-xs font-bold shadow-md hover:shadow-lg transition-all">
                            Register for Module 1 →
                        </a>
                    </div>
                </div>
            </div>

            <!-- MODULE 2: Pharmaceutical Marketing -->
            <div class="bg-white rounded-3xl border-2 border-blue-200/80 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                <div>
                    <!-- Card Top Banner -->
                    <div class="bg-gradient-to-r from-[#00245A] to-[#004B99] text-white p-6 sm:p-8 relative" style="background: linear-gradient(135deg, #00245A 0%, #004B99 100%); color: #ffffff;">
                        <div class="flex items-center justify-between gap-3 mb-3">
                            <span class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-wider bg-[#FFCD00] text-[#00245A] px-3 py-1 rounded-full shadow-xs">
                                Module 2
                            </span>
                            <span class="text-xs text-blue-200 font-bold bg-white/10 px-2.5 py-1 rounded-lg backdrop-blur-md">
                                Commercial & Strategic Track
                            </span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight">
                            Career in Pharmaceutical Marketing
                        </h3>
                        <p class="text-xs sm:text-sm text-blue-100/90 mt-2">
                            Structured pathways into Sales & Brand Management (SBMD), International Business (IBD), and commercial leadership.
                        </p>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 sm:p-8 space-y-6">
                        
                        <!-- Course Outline: Marketing -->
                        <div>
                            <div class="flex items-center gap-2 mb-3.5 pb-2 border-b border-slate-100">
                                <svg class="w-5 h-5 text-[#0085FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                <h4 class="font-bold text-base text-[#00245A]">
                                    Course Outline: Career Preparation for Pharmaceutical Marketing Professionals
                                </h4>
                            </div>

                            <div class="space-y-3.5 text-xs sm:text-sm text-slate-700">
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Sales & Brand Management Department (SBMD):</strong>
                                    <span>Pharmaceutical sales, product knowledge, brand promotion, communication skills, and sales force career preparation.</span>
                                </div>

                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">International Business Division (IBD):</strong>
                                    <span>International pharmaceutical business, export operations, international market development, and global business communication.</span>
                                </div>

                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Marketing Career Pathways:</strong>
                                    <span>Marketing career pathways and professional competencies across prescription, OTC, and specialty segments.</span>
                                </div>

                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Recruitment Preparation:</strong>
                                    <span>CV preparation, written examinations, brand presentation tests, and interview techniques.</span>
                                </div>

                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Essential Professional Skills:</strong>
                                    <span>Essential communication, negotiation, and executive presentation skills for doctor engagement.</span>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Focus Areas -->
                        <div class="pt-4 border-t border-slate-100">
                            <h4 class="font-bold text-sm text-[#00245A] uppercase tracking-wider mb-3 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                Commercial Competencies Covered
                            </h4>
                            <ul class="grid grid-cols-1 gap-2 text-xs sm:text-sm text-slate-700">
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                    <span>Therapeutic brand positioning & continuous medical education (CME)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                    <span>Global regulatory tender documents & export market logistics</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                    <span>Market share analytics, IMS/IQVIA data, and prescription audits</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                    <span>Commercial board viva questions and situational case solving</span>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Card Footer / Actions -->
                <div class="p-6 sm:p-8 bg-slate-50/80 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div>
                        <div class="text-xs text-slate-500 font-medium">Session Fee</div>
                        <div class="text-xl font-black text-[#00245A]">BDT 1,000 <span class="text-xs font-normal text-slate-500">/ session</span></div>
                    </div>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <a href="{{ route('seminars.show', 'module-2-career-in-pharmaceutical-marketing') }}" class="flex-1 sm:flex-none text-center px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-bold text-slate-700 hover:bg-white transition-colors">
                            Details
                        </a>
                        <a href="{{ route('seminars.register', 'module-2-career-in-pharmaceutical-marketing') }}" class="flex-1 sm:flex-none text-center px-6 py-2.5 rounded-xl bg-[#0085FF] hover:bg-[#0070d9] text-white text-xs font-bold shadow-md hover:shadow-lg transition-all">
                            Register for Module 2 →
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Session Schedule & Registration Details Section -->
<section class="py-16 md:py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                Participation Guidelines
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#00245A] mt-2">
                Session Schedule & Registration
            </h2>
            <p class="text-sm text-slate-600 mt-1">
                Flexible online access designed to fit academic and job preparation schedules.
            </p>
        </div>

        <div class="bg-gradient-to-br from-slate-50 via-white to-blue-50/40 rounded-3xl border border-slate-200 p-6 sm:p-10 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 text-[#0085FF] flex items-center justify-center text-xl shrink-0">
                        📅
                    </div>
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Session Days</div>
                        <div class="text-lg font-extrabold text-[#00245A] mt-0.5">Every Friday and Saturday</div>
                        <div class="text-xs text-slate-500 mt-1">Dedicated interactive weekend sessions with live Q&A.</div>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl shrink-0">
                        ⏱️
                    </div>
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Session Duration</div>
                        <div class="text-lg font-extrabold text-[#00245A] mt-0.5">2–3 Hours per Session</div>
                        <div class="text-xs text-slate-500 mt-1">Deep-dive technical presentation + viva rehearsal walkthrough.</div>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl shrink-0">
                        💳
                    </div>
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Registration Fee</div>
                        <div class="text-lg font-extrabold text-emerald-700 mt-0.5">BDT 1,000 per Session</div>
                        <div class="text-xs text-slate-500 mt-1">Transparent pricing payable via bKash with instant verification.</div>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center text-xl shrink-0">
                        🌐
                    </div>
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Delivery Mode</div>
                        <div class="text-lg font-extrabold text-[#00245A] mt-0.5">Online Live Session</div>
                        <div class="text-xs text-slate-500 mt-1">Join securely from anywhere in Bangladesh or abroad.</div>
                    </div>
                </div>

            </div>

            <!-- Eligibility Banner -->
            <div class="mt-8 pt-6 border-t border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-blue-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#0085FF] flex items-center justify-center text-lg shrink-0">
                        🎓
                    </div>
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-600 block">Candidate Eligibility</span>
                        <span class="text-sm font-bold text-slate-800">Final-year pharmacy students and graduate pharmacists</span>
                    </div>
                </div>
                <div class="shrink-0">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Batches Open
                    </span>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Closing Banner CTA -->
<section class="py-20 bg-gradient-to-tr from-[#00245A] via-[#003882] to-[#0085FF] text-white relative overflow-hidden">
    <!-- Ambient circle -->
    <div class="absolute -right-16 -bottom-16 w-80 h-80 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
        <span class="inline-block text-xs font-bold uppercase tracking-widest text-[#FFCD00] bg-white/10 px-4 py-1.5 rounded-full border border-white/20">
            Professional Growth
        </span>
        
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight">
            Take the Next Step in Your Pharmaceutical Career!
        </h2>
        
        <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed font-normal">
            Gain practical career insights, strengthen your professional skills, and prepare yourself for opportunities in the pharmaceutical industry.
        </p>

        <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('seminars.register', 'module-1-career-in-pharmaceutical-industrial-operations') }}" class="btn-accent px-7 py-3.5 text-sm sm:text-base font-bold shadow-lg hover:shadow-xl">
                Register for Module 1 (৳1,000)
            </a>
            <a href="{{ route('seminars.register', 'module-2-career-in-pharmaceutical-marketing') }}" class="btn-secondary px-7 py-3.5 text-sm sm:text-base font-bold shadow-lg hover:shadow-xl">
                Register for Module 2 (৳1,000)
            </a>
            <a href="{{ route('booking.create') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm border border-white/20 transition-all">
                <span>Book 1-on-1 Consultation</span>
                <span>→</span>
            </a>
        </div>
    </div>
</section>
@endsection
