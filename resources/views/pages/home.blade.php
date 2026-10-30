@extends('layouts.app')

@section('title', 'Pharma Career Compass | Premier Pharma Career Guidance & Exam Prep')
@section('meta_description', 'Advance your Pharma Career with Pharma Career Compass. Master pharmaceutical recruitment written exams, technical viva coaching, and 1-on-1 industry mentorship.')
@section('og_title', 'Pharma Career Compass | Premier Pharma Career Guidance & Exam Prep')
@section('og_description', 'Advance your Pharma Career with Pharma Career Compass. Master pharmaceutical recruitment written exams, technical viva coaching, and 1-on-1 industry mentorship.')

@section('content')
<!-- Hero Section (Classic White Background + Real Pharmaceutical Photo + Editorial Typography) -->
<section class="relative bg-white pt-10 pb-16 md:pt-16 md:pb-24 border-b border-slate-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-14 items-center">
            
            <!-- Left Hero Content -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <!-- Tagline Badge -->
                <div class="inline-flex items-center px-3.5 py-1.5 rounded-full bg-slate-50 border border-slate-200 text-slate-700 text-xs sm:text-sm font-medium">
                    <span>Discover Your Direction. Build Your Future.</span>
                </div>

                <!-- Main Heading (Modern Sans Typography) -->
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-extrabold text-slate-900 tracking-tight leading-[1.12]">
                    Advance Your <span class="text-[#0085FF]">Pharma Career</span> with Pharma Career Compass
                </h1>

                <!-- Subtitle / Supporting copy -->
                <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-normal max-w-2xl mx-auto lg:mx-0">
                    <strong class="font-semibold text-slate-800">Pharma Career Compass</strong> will match you with a mentor in the Pharmaceutical Industry with extensive experience and knowledge to guide you in advancing your career goals and ambitions.
                </p>

                <!-- Actions / CTAs -->
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ route('quiz.index') }}" class="btn-primary w-full sm:w-auto text-base">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        <span>Take Our Career Quiz</span>
                    </a>

                    <a href="{{ route('seminars.book') }}" class="btn-secondary w-full sm:w-auto text-base">
                        <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        <span>Book Seminars Seat</span>
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="pt-6 border-t border-slate-100 grid grid-cols-3 gap-4 text-center lg:text-left">
                    <div>
                        <div class="text-xl sm:text-2xl font-black text-slate-900">11 Sectors</div>
                        <div class="text-xs text-slate-500 font-medium">QA, QC, Production & More</div>
                    </div>
                    <div>
                        <div class="text-xl sm:text-2xl font-black text-[#0085FF]">5 Pillars</div>
                        <div class="text-xs text-slate-500 font-medium">End-to-End Preparation</div>
                    </div>
                    <div>
                        <div class="text-xl sm:text-2xl font-black text-slate-900">1-to-Many</div>
                        <div class="text-xs text-slate-500 font-medium">Live Interactive Cohorts</div>
                    </div>
                </div>
            </div>

            <!-- Right Hero Visual Card (Authentic High-End Photography, No AI Slab Mockups) -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-3xl overflow-hidden shadow-xl border border-slate-100 aspect-[4/3] bg-slate-50 group">
                    <img src="{{ asset('images/hero-consultation.jpg') }}" 
                         alt="Senior pharmaceutical industry mentor guiding a pharmacist candidate" 
                         class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500" 
                         loading="eager">
                    
                    <!-- Clean Floating Mentorship Pill (Classic human design touch) -->
                    <div class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur-md p-3.5 rounded-2xl border border-slate-200/80 shadow-md flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#0085FF] flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-900 uppercase">Pharmaceutical Career Development Program</div>
                                <div class="text-[11px] text-slate-500">Module 1: Industrial Operations • Module 2: Marketing</div>
                            </div>
                        </div>
                        <span class="inline-flex items-center text-[11px] font-bold text-[#0085FF] bg-blue-50 px-2.5 py-1 rounded-full">
                            Active
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- Structured Career Guidance & Preparation Services Section -->
<section id="services" class="py-20 bg-slate-50/80 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="inline-block text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3.5 py-1.5 rounded-full border border-blue-200/60 mb-4" style="margin-bottom: 18px;">
                Flagship Career Preparation
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-[#00245A]">
                Structured Career Guidance & Preparation Services
            </h2>
            <p class="text-lg font-bold text-[#0085FF]">
                Pharmaceutical Career Development Program
            </p>
            <p class="text-sm sm:text-base text-slate-600 max-w-2xl mx-auto">
                Building Your Future in the Pharmaceutical Industry. Two comprehensive, department-targeted modules structured to equip aspiring pharmacists with technical command, regulatory awareness, and commercial competence.
            </p>
        </div>

        <!-- 2 Modules Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch mb-10">
            
            <!-- MODULE 1: Industrial Operations -->
            <div class="bg-white rounded-3xl border-2 border-blue-200/80 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                <div>
                    <!-- Card Top Banner -->
                    <div class="bg-gradient-to-r from-[#00245A] to-[#004B99] text-white p-6 sm:p-8 relative flex flex-col justify-start" style="background: linear-gradient(135deg, #00245A 0%, #004B99 100%); color: #ffffff; min-height: 195px;">
                        <div class="flex items-center justify-between gap-3 mb-3">
                            <span class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-wider bg-[#FFCD00] text-[#00245A] px-3 py-1 rounded-full shadow-xs">
                                Module 1
                            </span>
                            <span class="text-xs text-blue-200 font-bold bg-white/10 px-2.5 py-1 rounded-lg backdrop-blur-md">
                                Industrial & Technical Track
                            </span>
                        </div>
                        <h3 class="font-extrabold text-white leading-tight tracking-tight flex items-start" style="font-size: clamp(1.1rem, 1.45vw, 1.35rem); min-height: 2.25rem;">
                            Career in Pharmaceutical Industrial Operations
                        </h3>
                        <p class="text-xs sm:text-sm text-blue-100/90 mt-2" style="min-height: 2.75rem;">
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

                            <div class="text-xs sm:text-sm text-slate-700">
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
                                    <span>Material planning, capacity planning, supply chain coordination, and production scheduling.</span>
                                </div>

                                <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Regulatory Affairs:</strong>
                                    <span>Drug registration, regulatory compliance, dossier preparation (CTD/ACTD), and submissions.</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Card Footer -->
                <div class="p-6 sm:p-8 bg-slate-50/80 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <span class="text-[11px] text-slate-400 block font-medium">Session Fee</span>
                        <span class="text-xl font-black text-[#00245A]">BDT 1,000 <span class="text-xs font-normal text-slate-500">/ session</span></span>
                    </div>
                    <div class="flex items-stretch gap-2 w-full sm:w-auto">
                        <a href="{{ route('seminars.show', 'module-1-career-in-pharmaceutical-industrial-operations') }}" class="btn-secondary text-xs px-4 py-2.5 font-bold flex-1 sm:flex-none text-center flex items-center justify-center" style="min-height: 48px;">
                            Details
                        </a>
                        <a href="{{ route('seminars.book', ['module' => 1]) }}" class="btn-accent text-xs px-5 py-2.5 font-bold shadow-sm flex-1 sm:flex-none text-center flex items-center justify-center leading-snug" style="min-height: 48px;">
                            Book Module 1 Seat →
                        </a>
                    </div>
                </div>
            </div>

            <!-- MODULE 2: Pharmaceutical Marketing -->
            <div class="bg-white rounded-3xl border-2 border-blue-200/80 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                <div>
                    <!-- Card Top Banner -->
                    <div class="bg-gradient-to-r from-[#00245A] to-[#004B99] text-white p-6 sm:p-8 relative flex flex-col justify-start" style="background: linear-gradient(135deg, #00245A 0%, #004B99 100%); color: #ffffff; min-height: 195px;">
                        <div class="flex items-center justify-between gap-3 mb-3">
                            <span class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-wider bg-[#FFCD00] text-[#00245A] px-3 py-1 rounded-full shadow-xs">
                                Module 2
                            </span>
                            <span class="text-xs text-blue-200 font-bold bg-white/10 px-2.5 py-1 rounded-lg backdrop-blur-md">
                                Commercial & Strategic Track
                            </span>
                        </div>
                        <h3 class="font-extrabold text-white leading-tight tracking-tight flex items-start" style="font-size: clamp(1.1rem, 1.45vw, 1.35rem); min-height: 2.25rem;">
                            Career in Pharmaceutical Marketing
                        </h3>
                        <p class="text-xs sm:text-sm text-blue-100/90 mt-2" style="min-height: 2.75rem;">
                            Structured pathways into Sales & Brand Management (SBMD), International Business (IBD), and commercial leadership.
                        </p>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 sm:p-8 space-y-6">
                        
                        <!-- Course Outline: Marketing Functions -->
                        <div>
                            <div class="flex items-center gap-2 mb-3.5 pb-2 border-b border-slate-100">
                                <svg class="w-5 h-5 text-[#0085FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                                <h4 class="font-bold text-base text-[#00245A]">
                                    Course Outline: Career Preparation for Pharmaceutical Marketing Professionals
                                </h4>
                            </div>

                            <div class="text-xs sm:text-sm text-slate-700">
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
                                    <span>Marketing career pathways and professional competencies across prescription, OTC, and specialty segments.</span>
                                </div>

                                <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Recruitment Preparation:</strong>
                                    <span>CV preparation, written examinations, brand presentation tests, and interview techniques.</span>
                                </div>

                                <div class="p-3.5 rounded-xl border border-slate-200/90 shadow-2xs" style="background-color: #f4f6f8; margin-bottom: 10px;">
                                    <strong class="text-[#00245A] font-bold block mb-0.5">Essential Professional Skills:</strong>
                                    <span>Essential communication, negotiation, and executive presentation skills for doctor engagement.</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Card Footer -->
                <div class="p-6 sm:p-8 bg-slate-50/80 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <span class="text-[11px] text-slate-400 block font-medium">Session Fee</span>
                        <span class="text-xl font-black text-[#00245A]">BDT 1,000 <span class="text-xs font-normal text-slate-500">/ session</span></span>
                    </div>
                    <div class="flex items-stretch gap-2 w-full sm:w-auto">
                        <a href="{{ route('seminars.show', 'module-2-career-in-pharmaceutical-marketing') }}" class="btn-secondary text-xs px-4 py-2.5 font-bold flex-1 sm:flex-none text-center flex items-center justify-center" style="min-height: 48px;">
                            Details
                        </a>
                        <a href="{{ route('seminars.book', ['module' => 2]) }}" class="btn-accent text-xs px-5 py-2.5 font-bold shadow-sm flex-1 sm:flex-none text-center flex items-center justify-center leading-snug" style="min-height: 48px;">
                            Book Module 2 Seat →
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Schedule & Summary Strip -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200 shadow-xs flex flex-col md:flex-row items-center justify-between gap-4 text-xs sm:text-sm text-slate-700">
            <div class="flex flex-wrap items-center gap-4 sm:gap-6 font-medium">
                <div>📅 <strong>Session Days:</strong> Every Friday and Saturday</div>
                <div>⏱️ <strong>Duration:</strong> 2–3 hours per session</div>
                <div>🌐 <strong>Mode:</strong> Online Live</div>
                <div>🎓 <strong>Eligibility:</strong> Final-year students & graduates</div>
            </div>
            <a href="{{ route('programs') }}" class="btn-secondary text-xs py-2.5 px-5 font-bold whitespace-nowrap shrink-0">
                View Full Curriculum &rarr;
            </a>
        </div>

    </div>
</section>

<!-- Career Path Exploration Section (11 Pharmaceutical Sectors) -->
<section id="career-paths" class="py-20 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div class="max-w-2xl text-left">
                <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                    Pharmaceutical Career Sectors
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#00245A] mt-3">
                    Explore Pharmaceutical Career Paths
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-2">
                    Every pharmaceutical department requires distinct technical skills and qualifications. Explore where your talents fit best.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('career-paths.index') }}" class="btn-secondary text-sm">
                    View All 11 Paths &rarr;
                </a>
            </div>
        </div>

        <!-- Career Path Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredPaths->take(6) as $path)
                <div class="card-classic p-6 flex flex-col justify-between text-left">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700">
                                {{ $path->category->name ?? 'Industrial' }}
                            </span>
                            @if($path->badge)
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-[#0085FF] border border-blue-200">
                                    {{ $path->badge }}
                                </span>
                            @endif
                        </div>

                        <h3 class="text-xl font-bold text-[#00245A] mb-2">
                            <a href="{{ route('career-paths.show', $path->slug) }}" class="hover:text-[#0085FF] transition-colors">
                                {{ $path->title }}
                            </a>
                        </h3>

                        <p class="text-xs sm:text-sm text-slate-600 line-clamp-3 leading-relaxed mb-4">
                            {{ $path->summary }}
                        </p>

                        <!-- Key skills pills -->
                        @if(!empty($path->required_skills))
                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @foreach(array_slice($path->required_skills, 0, 3) as $skill)
                                    <span class="text-[11px] bg-slate-50 text-slate-600 border border-slate-200 px-2 py-0.5 rounded-md">
                                        {{ $skill }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500 font-medium">{{ $path->experience_level }}</span>
                        <a href="{{ route('career-paths.show', $path->slug) }}" class="font-bold text-[#0085FF] hover:underline flex items-center gap-1">
                            Explore Role &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('quiz.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#00245A] hover:text-[#0085FF] transition-colors">
                <span>Not sure which path aligns with your background?</span>
                <span class="underline text-[#0085FF] font-bold">Take our 3-minute Career Quiz &rarr;</span>
            </a>
        </div>

    </div>
</section>

<!-- How It Works (5-Step Visual Journey) -->
<section class="py-20 bg-[#00173B] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-[#FFCD00] bg-white/10 px-3 py-1 rounded-full border border-white/20">
                Simple 5-Step Process
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white">
                How Pharma Career Compass Works
            </h2>
            <p class="text-sm sm:text-base text-blue-100">
                From initial assessment to landing your target pharmaceutical role, follow our transparent career preparation path.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 text-left relative">
            <!-- Step 1 -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 relative backdrop-blur-xs flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-full bg-[#0085FF] text-white flex items-center justify-center font-bold text-sm mb-4 shadow-sm">
                        1
                    </div>
                    <h3 class="font-bold text-base text-white mb-2">Explore Your Direction</h3>
                    <p class="text-xs text-blue-100/80 leading-relaxed">
                        Tell us about your pharmacy education, interests, thesis work, and preferred work environment.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-white/10 text-[11px] text-[#FFCD00] font-semibold">
                    Career Quiz
                </div>
            </div>

            <!-- Step 2 -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 relative backdrop-blur-xs flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-full bg-[#0085FF] text-white flex items-center justify-center font-bold text-sm mb-4 shadow-sm">
                        2
                    </div>
                    <h3 class="font-bold text-base text-white mb-2">Identify Your Needs</h3>
                    <p class="text-xs text-blue-100/80 leading-relaxed">
                        Receive personalized department recommendations and uncover technical knowledge gaps.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-white/10 text-[11px] text-[#FFCD00] font-semibold">
                    Guidance Report
                </div>
            </div>

            <!-- Step 3 -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 relative backdrop-blur-xs flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-full bg-[#0085FF] text-white flex items-center justify-center font-bold text-sm mb-4 shadow-sm">
                        3
                    </div>
                    <h3 class="font-bold text-base text-white mb-2">Build Your Roadmap</h3>
                    <p class="text-xs text-blue-100/80 leading-relaxed">
                        Follow a structured 4-phase preparation plan covering cGMP, instruments, and SOP mastery.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-white/10 text-[11px] text-[#FFCD00] font-semibold">
                    Roadmap Builder
                </div>
            </div>

            <!-- Step 4 -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 relative backdrop-blur-xs flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-full bg-[#0085FF] text-white flex items-center justify-center font-bold text-sm mb-4 shadow-sm">
                        4
                    </div>
                    <h3 class="font-bold text-base text-white mb-2">Practise & Improve</h3>
                    <p class="text-xs text-blue-100/80 leading-relaxed">
                        Complete practice questions, timed mock tests, and oral viva model answer rehearsals.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-white/10 text-[11px] text-[#FFCD00] font-semibold">
                    MCQs & Viva Hub
                </div>
            </div>

            <!-- Step 5 -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 relative backdrop-blur-xs flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-full bg-[#FFCD00] text-[#00245A] flex items-center justify-center font-bold text-sm mb-4 shadow-sm">
                        5
                    </div>
                    <h3 class="font-bold text-base text-white mb-2">Move Forward</h3>
                    <p class="text-xs text-blue-100/80 leading-relaxed">
                        Review your verified progress with an industry mentor and step into recruitment boards with confidence.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-white/10 text-[11px] text-[#FFCD00] font-semibold">
                    Interactive Cohort Session
                </div>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('seminars.book') }}" class="btn-accent px-8 py-3.5 text-base">
                Book Seminars Seat &rarr;
            </a>
        </div>

    </div>
</section>

<!-- Why Choose Pharma Career Compass -->
<section class="py-20 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-left space-y-6">
                <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                    Why Choose Our Platform
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#00245A]">
                    Structured Preparation Built for Pharmacy Candidates
                </h2>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Most graduates struggle not because of a lack of intelligence, but because academic syllabi do not teach industrial recruitment realities—such as OOS investigations, cleanroom air classifications, HPLC system suitability formulas, and STAR interview delivery.
                </p>

                <div class="space-y-4 pt-2">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-[#0085FF] flex items-center justify-center shrink-0 font-bold text-sm">
                            &check;
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Pharmaceutical Industry Focused Guidance</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Every resource is verified by pharmacists with real plant and regulatory experience.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-[#0085FF] flex items-center justify-center shrink-0 font-bold text-sm">
                            &check;
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Personalized Career Trajectory Mapping</h4>
                            <p class="text-xs text-slate-500 mt-0.5">No one-size-fits-all advice. We tailor preparation whether you target QA, QC, R&D, or Regulatory.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-[#0085FF] flex items-center justify-center shrink-0 font-bold text-sm">
                            &check;
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Practical Exam & Viva Simulation</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Timed MCQ testing, answer keys with explanations, and oral model answers reduce exam anxiety.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-[#0085FF] flex items-center justify-center shrink-0 font-bold text-sm">
                            &check;
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Transparent Progress Tracking</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Save quiz recommendations, track completed roadmap milestones, and log mock test scores in your dashboard.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visual Comparison / Value Box (Classic Modern Card, No Heavy Black Outline) -->
            <div class="bg-slate-50 rounded-2xl p-7 sm:p-8 border border-slate-200 shadow-sm text-left">
                <h3 class="text-xl font-bold text-[#00245A] mb-4">The Preparation Difference</h3>
                
                <div class="space-y-4 text-xs sm:text-sm">
                    <div class="bg-white p-4 rounded-xl border border-red-200">
                        <div class="font-bold text-red-600 mb-1">Traditional Unprepared Approach:</div>
                        <ul class="space-y-1 text-slate-500 list-disc list-inside">
                            <li>Re-reading 8 semesters of textbooks with no exam pattern focus</li>
                            <li>Submitting generic CVs that fail automated ATS filters</li>
                            <li>Nervous, unstructured answers during technical recruitment vivas</li>
                            <li>Uncertainty regarding which department matches personal skills</li>
                        </ul>
                    </div>

                    <div class="bg-white p-4 rounded-xl border border-emerald-300">
                        <div class="font-bold text-emerald-700 mb-1">With Pharmaceutical Career Development Program:</div>
                        <ul class="space-y-1 text-slate-700 list-disc list-inside font-medium">
                            <li>Targeted mastery over high-yield pharmaceutical exam questions</li>
                            <li>ATS-optimized pharmaceutical resume highlighting equipment skills</li>
                            <li>Fluent, structured answers for deviation, CAPA, and GMP prompts</li>
                            <li>Clear 3-year career roadmap and 1-on-1 expert mentor feedback</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('programs') }}" class="btn-primary w-full py-3">
                        Explore Full Program Curriculum &rarr;
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Mentors & Consultants Directory (All Leaders Side by Side) -->
<section id="consultants" class="py-20 bg-slate-50/60 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div class="max-w-2xl text-left">
                <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                    Expert Advisory Panel
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#00245A] mt-3">
                    Consult with Pharmaceutical Industry Leaders
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-2">
                    Our advisors bring decades of verified experience across Quality Assurance, Regulatory Affairs, Analytical QC, and Plant Operations.
                </p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center gap-2">
                <span class="inline-flex items-center gap-2 text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 px-3.5 py-1.5 rounded-full">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ $consultants->count() }} Senior Industry Leaders</span>
                </span>
            </div>
        </div>

        <!-- Career Leaders Side by Side Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
            @foreach($consultants as $consultant)
                <div class="bg-white rounded-3xl border border-slate-200 hover:border-slate-300 shadow-2xs hover:shadow-md transition-all p-6 sm:p-8 flex flex-col justify-between text-left relative overflow-hidden">
                    <div>
                        <!-- Top Badge Row -->
                        <div class="flex items-center justify-between gap-3 mb-6">
                            @if(str_contains(strtolower($consultant->title), 'founder') || str_contains(strtolower($consultant->name), 'bashar'))
                                <span class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-blue-700 bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                                    Founder & Lead Advisor
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                    {{ $consultant->title }}
                                </span>
                            @endif

                            <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full border border-slate-200">
                                {{ $consultant->experience_years }}+ Years Exp.
                            </span>
                        </div>

                        <!-- Avatar + Header Info -->
                        <div class="flex items-start gap-4 sm:gap-5 mb-5">
                            <div class="relative shrink-0">
                                @if($consultant->avatar)
                                    <img src="{{ asset($consultant->avatar) }}" alt="{{ $consultant->name }}" class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl object-cover object-top border-2 border-white shadow-md ring-1 ring-slate-200">
                                @else
                                    @php
                                        $words = explode(' ', preg_replace('/[^a-zA-Z\s]/', '', $consultant->name));
                                        $initials = '';
                                        foreach (array_filter($words) as $w) {
                                            if (in_array(strtoupper($w), ['MD', 'RPH', 'DR', 'PROF'])) continue;
                                            $initials .= strtoupper(substr($w, 0, 1));
                                            if (strlen($initials) >= 2) break;
                                        }
                                        if (empty($initials)) {
                                            $initials = strtoupper(substr($consultant->name, 0, 2));
                                        }
                                    @endphp
                                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gradient-to-br from-slate-50 to-slate-100 border border-slate-200 text-slate-800 flex flex-col items-center justify-center shadow-xs">
                                        <span class="font-extrabold text-2xl sm:text-3xl tracking-tight text-slate-700">{{ $initials }}</span>
                                        <span class="text-[9px] uppercase tracking-wider text-slate-400 font-medium mt-0.5">Leader</span>
                                    </div>
                                @endif
                                <div class="absolute -bottom-2 -right-1 bg-emerald-600 text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-xs flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                    <span>Verified</span>
                                </div>
                            </div>

                            <div class="min-w-0 flex-1">
                                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight leading-snug">
                                    {{ $consultant->name }}
                                </h3>
                                <div class="text-xs sm:text-sm font-semibold text-[#0085FF] mt-0.5">
                                    {{ $consultant->title }}
                                </div>
                                <div class="text-xs text-slate-500 mt-1 font-medium">
                                    {{ $consultant->current_company ?? 'Leading Pharmaceutical Industry' }}
                                </div>
                                @if($consultant->qualifications)
                                    <div class="text-[11px] text-slate-400 mt-0.5 font-normal truncate">
                                        {{ $consultant->qualifications }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Specialization Badge -->
                        @if($consultant->specialization)
                            <div class="mb-4">
                                <span class="text-[11px] font-semibold text-slate-700 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-lg inline-block">
                                    {{ $consultant->specialization }}
                                </span>
                            </div>
                        @endif

                        <!-- Bio -->
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4 line-clamp-4">
                            “{{ $consultant->bio }}”
                        </p>

                        <!-- Areas of Expertise Tags -->
                        @if(!empty($consultant->areas_of_expertise))
                            <div class="flex flex-wrap gap-1.5 mb-2">
                                @foreach(array_slice($consultant->areas_of_expertise, 0, 4) as $area)
                                    <span class="text-[11px] bg-blue-50/70 text-blue-900 border border-blue-100 px-2.5 py-0.5 rounded-md font-medium">
                                        {{ $area }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Bottom Price and Actions -->
                    <div class="pt-6 mt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-medium">Session Fee</span>
                            <div class="flex items-baseline gap-1">
                                <span class="text-xl font-extrabold text-slate-900 tabular-nums">৳{{ number_format($consultant->hourly_rate, 0) }}</span>
                                <span class="text-xs text-slate-500 font-normal">BDT / session</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2.5">
                            <a href="{{ route('consultants.show', $consultant->slug) }}" class="btn-secondary text-xs py-2.5 px-3.5 font-semibold rounded-xl">
                                View Full Profile
                            </a>
                            <a href="{{ route('booking.create', ['consultant_id' => $consultant->id]) }}" class="bg-slate-900 hover:bg-black text-white text-xs font-semibold py-2.5 px-4 rounded-xl shadow-2xs transition-colors flex items-center gap-1.5">
                                <span>Book Consultation</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Testimonials and Demonstration Feedback (Clearly marked per prompt) -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                Candidate Experience
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#00245A]">
                Structured Preparation Feedback
            </h2>
            <div class="inline-block bg-amber-50 text-amber-800 border border-amber-200 text-xs px-3 py-1 rounded-full font-medium">
                Note: Demonstration feedback representing candidate learning outcomes.
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $item)
                <div class="bg-[#FBFDFF] border border-slate-200/90 rounded-2xl p-7 flex flex-col justify-between text-left hover:border-blue-300 transition-all">
                    <div>
                        <!-- Rating stars -->
                        <div class="flex items-center gap-1 text-amber-400 text-sm mb-3">
                            @for($i=0; $i<$item->rating; $i++)
                                <span>★</span>
                            @endfor
                        </div>

                        <p class="text-xs sm:text-sm text-slate-700 leading-relaxed italic mb-6">
                            “{{ $item->content }}”
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <div class="font-bold text-sm text-[#00245A]">{{ $item->name }}</div>
                            <div class="text-xs text-slate-500">{{ $item->role }}</div>
                            <div class="text-[10px] text-slate-400">{{ $item->previous_status }}</div>
                        </div>
                        <span class="text-[10px] bg-blue-50 text-[#0085FF] font-semibold px-2 py-0.5 rounded border border-blue-200">
                            {{ $item->service_tag }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Frequently Asked Questions Section (Accessible Accordion) -->
<section id="faqs" class="py-20 bg-slate-50/60 border-b border-slate-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-12 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                Got Questions?
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#00245A]">
                Frequently Asked Questions
            </h2>
            <p class="text-sm text-slate-600">
                Everything you need to know about our preparation programs, practice hub, and consultation sessions.
            </p>
        </div>

        <div class="space-y-3 text-left">
            @foreach($faqs as $index => $faq)
                <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs overflow-hidden" x-data="{ expanded: false }">
                    <button @click="expanded = !expanded" 
                            type="button" 
                            class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 focus:outline-none hover:bg-slate-50 transition-colors">
                        <span class="font-semibold text-sm sm:text-base text-[#00245A]">
                            {{ $faq->question }}
                        </span>
                        <svg class="w-5 h-5 text-slate-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': expanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="expanded" x-collapse x-transition class="px-5 pb-5 pt-1 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Latest Articles Preview -->
<section class="py-20 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div class="max-w-2xl text-left">
                <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                    Pharmaceutical Career Insights
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#00245A] mt-3">
                    Latest Articles & Preparation Guides
                </h2>
                <p class="text-sm text-slate-600 mt-2">
                    Actionable advice written by pharmaceutical consultants to help you excel in recruitment assessments.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('blog.index') }}" class="btn-secondary text-sm">
                    View All Articles &rarr;
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            @foreach($latestPosts as $post)
                <div class="card-classic p-5 flex flex-col justify-between text-left">
                    <div>
                        <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                            <span class="font-bold text-[#0085FF]">{{ $post->category->name ?? 'Career Guide' }}</span>
                            <span>{{ $post->read_time_minutes }} min read</span>
                        </div>
                        <h3 class="font-bold text-lg text-[#00245A] mb-2 leading-snug">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-[#0085FF] transition-colors">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 line-clamp-3 leading-relaxed mb-4">
                            {{ $post->summary }}
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500">{{ $post->author_name }}</span>
                        <a href="{{ route('blog.show', $post->slug) }}" class="font-bold text-[#0085FF] hover:underline">
                            Read Guide &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Final Call to Action (Closing Section) -->
<section class="py-20 bg-gradient-to-tr from-[#00245A] via-[#003882] to-[#0085FF] text-white relative overflow-hidden">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
        <span class="inline-block text-xs font-bold uppercase tracking-widest text-[#FFCD00] bg-white/10 px-3.5 py-1.5 rounded-full border border-white/20">
            Start Your Journey
        </span>
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight">
            Your Future in Pharma Starts with the Right Direction
        </h2>
        <p class="text-base sm:text-lg text-blue-100 max-w-2xl mx-auto leading-relaxed">
            “Take the next step towards a clearer pharmaceutical career path. Explore your options, strengthen your preparation, and build the confidence to move forward.”
        </p>
        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('programs') }}" class="btn-accent px-8 py-3.5 text-base">
                Explore Career Programs
            </a>
            <a href="{{ route('seminars.book') }}" class="btn-secondary px-8 py-3.5 text-base">
                Book Seminars Seat
            </a>
        </div>
    </div>
</section>
@endsection
