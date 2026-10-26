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

                    <a href="{{ route('booking.create') }}" class="btn-secondary w-full sm:w-auto text-base">
                        <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Book a Consultation</span>
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
                        <div class="text-xl sm:text-2xl font-black text-slate-900">1-on-1</div>
                        <div class="text-xs text-slate-500 font-medium">Senior Industry Mentors</div>
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
                                <div class="text-xs font-bold text-slate-900">PHARMA CAREER LAUNCHPAD</div>
                                <div class="text-[11px] text-slate-500">1-on-1 Mentorship • Real Industry Insights</div>
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

<!-- Career Launchpad Introduction & 5 Pillars Section -->
<section id="pillars" class="py-20 bg-white border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                Core Program Pillars
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#00245A]">
                PHARMA CAREER LAUNCHPAD
            </h2>
            <p class="text-lg font-medium text-slate-600">
                A Practical Career Preparation Program for Pharmacists
            </p>
            <p class="text-sm sm:text-base text-slate-500 leading-relaxed">
                “Your pharmaceutical career deserves a clear direction. Pharma Career Launchpad helps you understand your opportunities, strengthen your knowledge, prepare for recruitment assessments, and develop the confidence to present yourself professionally.”
            </p>
        </div>

        <!-- 5 Key Pillars Grid -->
        <div class="mt-14 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <!-- Pillar 1 -->
            <div class="card-solid p-6 flex flex-col justify-between text-left group hover:border-[#0085FF]">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#0085FF] flex items-center justify-center font-bold text-lg mb-5 group-hover:bg-[#0085FF] group-hover:text-white transition-colors">
                        01
                    </div>
                    <h3 class="font-bold text-lg text-[#00245A] mb-2">Career Planning</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Identify your strengths, interests, and qualifications to map the ideal pharmaceutical department fit.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('services.show', 'career-planning-consultation') }}" class="text-xs font-bold text-[#0085FF] hover:underline flex items-center gap-1">
                        Explore Pillar &rarr;
                    </a>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="card-solid p-6 flex flex-col justify-between text-left group hover:border-[#0085FF]">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-lg mb-5 group-hover:bg-[#FFCD00] group-hover:text-[#00245A] transition-colors">
                        02
                    </div>
                    <h3 class="font-bold text-lg text-[#00245A] mb-2">Written Exam Prep</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Master technical assessment tests with structured topic reviews, MCQ banks, and timed mock exams.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('practice.exams') }}" class="text-xs font-bold text-[#0085FF] hover:underline flex items-center gap-1">
                        Start Practice &rarr;
                    </a>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div class="card-solid p-6 flex flex-col justify-between text-left group hover:border-[#0085FF]">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg mb-5 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        03
                    </div>
                    <h3 class="font-bold text-lg text-[#00245A] mb-2">Viva Skills</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Practise oral pharmaceutical concepts, technical questions, and structured verbal answers without hesitation.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('practice.viva') }}" class="text-xs font-bold text-[#0085FF] hover:underline flex items-center gap-1">
                        Browse Viva Q&A &rarr;
                    </a>
                </div>
            </div>

            <!-- Pillar 4 -->
            <div class="card-solid p-6 flex flex-col justify-between text-left group hover:border-[#0085FF]">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-lg mb-5 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        04
                    </div>
                    <h3 class="font-bold text-lg text-[#00245A] mb-2">Interview Readiness</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Master behavioral, situational plant questions, and panel interviews with proven STAR answer structures.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('practice.interviews') }}" class="text-xs font-bold text-[#0085FF] hover:underline flex items-center gap-1">
                        Interview Bank &rarr;
                    </a>
                </div>
            </div>

            <!-- Pillar 5 -->
            <div class="card-solid p-6 flex flex-col justify-between text-left group hover:border-[#0085FF]">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center font-bold text-lg mb-5 group-hover:bg-[#00245A] group-hover:text-white transition-colors">
                        05
                    </div>
                    <h3 class="font-bold text-lg text-[#00245A] mb-2">Industry Insights</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Gain firsthand knowledge on pharmaceutical hierarchy, GMP audits, recruitment expectations, and trends.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('services.show', 'pharmaceutical-industry-insights') }}" class="text-xs font-bold text-[#0085FF] hover:underline flex items-center gap-1">
                        Learn More &rarr;
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Career Path Exploration Section (11 Pharmaceutical Sectors) -->
<section id="career-paths" class="py-20 bg-slate-50/70 border-b border-slate-100">
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

<!-- Services and Consultation Packages Section -->
<section id="services" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                Tailored Consultation Packages
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#00245A]">
                Structured Career Guidance & Preparation Services
            </h2>
            <p class="text-sm sm:text-base text-slate-600">
                Choose the preparation module that suits your current recruitment stage, from CV revamp to intensive written test and viva coaching.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div class="card-solid p-7 flex flex-col justify-between hover:border-[#0085FF] text-left relative overflow-hidden">
                    <div>
                        <div class="text-xs font-semibold text-[#0085FF] uppercase tracking-wider mb-1">
                            {{ $service->delivery_mode }}
                        </div>
                        <h3 class="text-xl font-bold text-[#00245A] mb-3">
                            {{ $service->title }}
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-5">
                            {{ $service->summary }}
                        </p>

                        <!-- Expected Outcomes list -->
                        @if(!empty($service->expected_outcomes))
                            <div class="space-y-2 mb-6">
                                <div class="text-xs font-bold text-slate-800 uppercase tracking-wider">What you will gain:</div>
                                <ul class="space-y-1.5 text-xs text-slate-600">
                                    @foreach(array_slice($service->expected_outcomes, 0, 3) as $outcome)
                                        <li class="flex items-start gap-2">
                                            <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                            <span>{{ $outcome }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="pt-5 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <div class="text-lg font-black text-[#00245A]">
                                @if($service->price == 0)
                                    <span class="text-emerald-600">Free / Compl.</span>
                                @else
                                    ৳{{ number_format($service->price, 0) }} <span class="text-xs font-normal text-slate-500">/ session</span>
                                @endif
                            </div>
                            <div class="text-[11px] text-slate-500">{{ $service->duration_minutes }} minutes duration</div>
                        </div>

                        <a href="{{ route('booking.create', ['service_id' => $service->id]) }}" class="btn-primary text-xs py-2 px-3.5">
                            Book Now
                        </a>
                    </div>
                </div>
            @endforeach
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
                    1-on-1 Consultation
                </div>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('booking.create') }}" class="btn-accent px-8 py-3.5 text-base">
                Schedule Your Step 1 Session &rarr;
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
                        <div class="font-bold text-emerald-700 mb-1">With Pharma Career Launchpad:</div>
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

<!-- Mentors & Consultants Directory Preview -->
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
                    Our advisors bring decades of verified experience across Quality Assurance, Regulatory Affairs, Analytical QC, and Product Management.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('consultants.index') }}" class="btn-secondary text-sm">
                    View All Consultants &rarr;
                </a>
            </div>
        </div>

        <!-- Founder Spotlight Card -->
        <div class="mb-12 bg-white rounded-3xl border border-slate-200 shadow-2xs p-6 sm:p-8 lg:p-10 relative overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-4 flex justify-center lg:justify-start">
                    <div class="relative">
                        @php
                            $founder = $consultants->firstWhere('slug', 'md-abul-bashar') ?? \App\Models\Consultant::where('slug', 'md-abul-bashar')->first();
                        @endphp
                        @if($founder && $founder->avatar)
                            <img src="{{ asset($founder->avatar) }}" alt="{{ $founder->name }}" class="w-40 h-40 sm:w-44 sm:h-44 rounded-2xl object-cover object-top border-2 border-white shadow-md ring-1 ring-slate-200">
                        @else
                            <div class="w-40 h-40 sm:w-44 sm:h-44 rounded-2xl bg-slate-50 border border-slate-200 text-slate-900 flex flex-col items-center justify-center shadow-xs">
                                <span class="font-medium text-3xl sm:text-4xl tracking-normal text-slate-700">AB</span>
                                <span class="text-[10px] uppercase tracking-wider text-slate-400 mt-1.5 font-normal">Founder & RPh</span>
                            </div>
                        @endif
                        <div class="absolute -bottom-2 -right-2 bg-emerald-600 text-white text-[10px] font-semibold px-2.5 py-0.5 rounded-full shadow-xs flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                            <span>PCB Registered Pharmacist</span>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-8 text-left space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-700 text-xs font-semibold uppercase tracking-wider">
                        <span>Meet Our Founder & Lead Advisor</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        MD Abul Bashar, <span class="text-sm font-normal text-slate-500">RPh</span>
                    </h3>
                    <div class="text-sm font-medium text-slate-600">
                        Founder & Lead Pharmaceutical Career Consultant
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        “Our mission is to empower Bangladeshi pharmacy students and fresh graduates to transition confidently into top-tier national and multinational pharmaceutical companies. From cracking written tests at Square, Incepta, and Beximco to acing technical vivas and regulatory interviews, we provide authentic, industry-backed guidance every step of the way.”
                    </p>
                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        <a href="{{ route('booking.create', ['consultant_id' => 5]) }}" class="bg-slate-900 hover:bg-black text-white text-xs font-semibold py-2.5 px-5 rounded-xl shadow-2xs transition-colors">
                            Book Consultation with Founder &rarr;
                        </a>
                        <a href="{{ route('consultants.show', 'md-abul-bashar') }}" class="btn-secondary text-xs py-2.5 px-4 font-semibold rounded-xl">
                            View Full Profile
                        </a>
                        <span class="text-xs font-semibold text-slate-500 pl-2">
                            Session Fee: <strong class="text-slate-900 tabular-nums">৳1,500 BDT</strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Consultant Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($consultants as $consultant)
                <div class="bg-white rounded-2xl border border-slate-200 hover:border-slate-400 p-5 flex flex-col justify-between text-left shadow-2xs hover:shadow-sm transition-all">
                    <div>
                        <!-- Avatar -->
                        @if($consultant->avatar)
                            <img src="{{ asset($consultant->avatar) }}" alt="{{ $consultant->name }}" class="w-12 h-12 rounded-xl object-cover object-top mb-4 shadow-2xs border border-slate-200">
                        @else
                            <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 flex items-center justify-center font-semibold text-sm mb-4 shrink-0 tracking-wider">
                                {{ substr($consultant->name, 0, 2) }}
                            </div>
                        @endif

                        <div class="flex items-center gap-1 text-amber-500 text-xs font-bold mb-1">
                            <span>★</span>
                            <span class="text-slate-700">{{ number_format($consultant->rating, 2) }}</span>
                            <span class="text-slate-400 font-normal">({{ $consultant->reviews_count }} sessions)</span>
                        </div>

                        <h3 class="font-bold text-base text-slate-900 mb-0.5">
                            {{ $consultant->name }}
                        </h3>

                        <div class="text-xs font-medium text-slate-600 mb-2">
                            {{ $consultant->title }}
                        </div>

                        <div class="text-[11px] text-slate-400 font-normal mb-3">
                            {{ $consultant->experience_years }}+ Years Experience • {{ $consultant->qualifications }}
                        </div>

                        <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed mb-4">
                            {{ $consultant->bio }}
                        </p>

                        <!-- Areas of expertise -->
                        @if(!empty($consultant->areas_of_expertise))
                            <div class="flex flex-wrap gap-1 mb-4">
                                @foreach(array_slice($consultant->areas_of_expertise, 0, 2) as $area)
                                    <span class="text-[10px] bg-slate-50 text-slate-700 border border-slate-200 px-2 py-0.5 rounded-md font-medium">
                                        {{ $area }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block font-normal">Consultation</span>
                            <span class="text-sm font-bold text-slate-900 tabular-nums">৳{{ number_format($consultant->hourly_rate, 0) }}</span>
                            <span class="text-[10px] text-slate-400">/session</span>
                        </div>
                        <a href="{{ route('booking.create', ['consultant_id' => $consultant->id]) }}" class="bg-slate-900 hover:bg-black text-white text-xs font-semibold py-1.5 px-3.5 rounded-lg shadow-2xs transition-colors">
                            Book
                        </a>
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
            <a href="{{ route('booking.create') }}" class="btn-secondary px-8 py-3.5 text-base">
                Book a Consultation
            </a>
        </div>
    </div>
</section>
@endsection
