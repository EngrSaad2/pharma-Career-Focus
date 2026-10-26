@extends('layouts.app')

@section('title', 'About Pharma Career Compass | Guiding Your Pharma Career')
@section('meta_description', 'Learn about Pharma Career Compass, our mission to guide and accelerate your pharma career through industrial mentorship, written exam prep, and viva coaching.')

@section('content')
<section class="py-14 md:py-20 bg-gradient-to-b from-white via-[#F4F9FF] to-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="inline-block text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3.5 py-1.5 rounded-full border border-blue-200">
            About Our Organization
        </span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#00245A]">
            Empowering Your Pharma Career Direction
        </h1>
        <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed">
            Pharma Career Compass is an independent pharmaceutical career guidance and professional preparation platform dedicated to empowering pharmacy students, fresh graduates, and working professionals.
        </p>
    </div>
</section>

<!-- Mission & Story -->
<section class="py-16 bg-white border-y border-slate-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-left space-y-12">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="space-y-4">
                <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF]">Why We Exist</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#00245A]">Bridging the Academic-to-Industrial Chasm</h2>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Every year, thousands of talented pharmacy graduates complete rigorous 4-year or 5-year B.Pharm, M.Pharm, and Pharm.D degrees. However, when entering the pharmaceutical job market, many find that academic examinations did not prepare them for the real-world demands of recruitment assessments, oral technical boards, or plant-floor compliance cultures.
                </p>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Pharma Career Compass was established to change that. We bring verified industry leaders directly into dialogue with aspiring pharmacists to offer structured, actionable preparation.
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-7 shadow-sm space-y-4">
                <h3 class="font-bold text-lg text-slate-900">Our Guiding Commitments</h3>
                <ul class="space-y-3 text-xs sm:text-sm text-slate-600">
                    <li class="flex items-start gap-2.5">
                        <span class="text-[#0085FF] font-bold mt-0.5">✓</span>
                        <span><strong class="text-slate-900">Realistic Guidance:</strong> We provide authentic advice based on actual industry expectations—never fabricated success claims.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="text-[#0085FF] font-bold mt-0.5">✓</span>
                        <span><strong class="text-slate-900">Verified Mentors:</strong> All consultants possess documented senior experience across top pharmaceutical companies.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="text-[#0085FF] font-bold mt-0.5">✓</span>
                        <span><strong class="text-slate-900">Holistic Preparation:</strong> From self-discovery quizzes to timed exam simulations and viva rehearsals.</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- 3 Core Principles -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6">
            <div class="p-6 rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="text-2xl mb-2">🎯</div>
                <h4 class="font-bold text-base text-slate-900 mb-1">Clarity of Direction</h4>
                <p class="text-xs text-slate-600 leading-relaxed">Helping candidates select the right pharmaceutical department early to avoid wasted time and mismatched careers.</p>
            </div>

            <div class="p-6 rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="text-2xl mb-2">🔬</div>
                <h4 class="font-bold text-base text-slate-900 mb-1">Technical Competence</h4>
                <p class="text-xs text-slate-600 leading-relaxed">Reinforcing core pharmacopoeial concepts, cGMP guidelines, and analytical troubleshooting that recruiters look for.</p>
            </div>

            <div class="p-6 rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="text-2xl mb-2">🗣️</div>
                <h4 class="font-bold text-base text-slate-900 mb-1">Articulate Confidence</h4>
                <p class="text-xs text-slate-600 leading-relaxed">Transforming candidates from nervous exam takers into authoritative, professional communicators during interviews.</p>
            </div>
        </div>

    </div>
</section>

<!-- Meet Our Founder Section -->
<section class="py-16 bg-white border-t border-slate-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-blue-50/60 via-white to-slate-50 rounded-3xl border border-blue-200/80 p-8 sm:p-10 lg:p-12 shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative">
                        @php
                            $founder = $consultants->firstWhere('slug', 'md-abul-bashar') ?? \App\Models\Consultant::where('slug', 'md-abul-bashar')->first();
                        @endphp
                        @if($founder && $founder->avatar)
                            <img src="{{ asset($founder->avatar) }}" alt="MD Abul Bashar, RPh - Founder & Lead Consultant" class="w-44 h-44 sm:w-48 sm:h-48 rounded-2xl object-cover object-top border-2 border-white shadow-md ring-1 ring-slate-200">
                        @else
                            <div class="w-44 h-44 sm:w-48 sm:h-48 rounded-2xl bg-slate-50 border border-slate-200 text-[#00245A] flex flex-col items-center justify-center shadow-xs">
                                <span class="font-medium text-4xl sm:text-5xl tracking-normal text-slate-700">AB</span>
                                <span class="text-[11px] uppercase tracking-wider text-slate-400 mt-2 font-normal">Founder & RPh</span>
                            </div>
                        @endif
                        <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 whitespace-nowrap bg-[#00245A] text-white text-[11px] font-semibold px-3 py-1 rounded-full shadow-xs flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            <span>PCB Reg. Pharmacist</span>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-7 space-y-4 text-left">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-100/60 px-3 py-1 rounded-full border border-blue-200">
                        Leadership & Vision
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-[#00245A]">
                        MD Abul Bashar, <span class="text-base font-normal text-slate-500">RPh</span>
                    </h2>
                    <div class="text-sm font-semibold text-[#0085FF]">
                        Founder & Lead Pharmaceutical Career Consultant
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        MD Abul Bashar founded Pharma Career Compass with a singular focus: giving Bangladeshi pharmacy graduates the precise technical clarity, viva skills, and strategic direction required to succeed in Bangladesh’s thriving pharmaceutical manufacturing industry.
                    </p>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Having worked with professionals across top pharmaceutical corporations including Square, Incepta, Beximco, and Renata, he bridges the gap between academic theory and real-world cGMP plant floor execution.
                    </p>
                    <div class="pt-2 flex flex-wrap items-center gap-3">
                        <a href="{{ route('booking.create', ['consultant_id' => 5]) }}" class="btn-primary text-xs py-2.5 px-5 shadow-sm font-bold">
                            Book Session with Founder &rarr;
                        </a>
                        <a href="{{ route('consultants.show', 'md-abul-bashar') }}" class="btn-secondary text-xs py-2.5 px-4 font-bold">
                            Read Full Bio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Closing CTA -->
<section class="py-16 bg-slate-50 border-t border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Ready to Define Your Direction?</h2>
        <p class="text-sm text-slate-600 max-w-lg mx-auto">Take our free career assessment quiz or schedule a 1-on-1 session with an industry consultant.</p>
        <div class="pt-2 flex justify-center gap-4">
            <a href="{{ route('quiz.index') }}" class="btn-primary text-xs sm:text-sm py-2.5 px-6 shadow-sm">
                Take Free Career Quiz
            </a>
            <a href="{{ route('booking.create') }}" class="btn-secondary text-xs sm:text-sm py-2.5 px-6 shadow-sm">
                Book Consultation
            </a>
        </div>
    </div>
</section>
@endsection
