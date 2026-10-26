@extends('layouts.app')

@section('title', 'Your Pharmaceutical Career Guidance Summary | Pharma Career Compass')

@section('content')
<section class="py-12 md:py-16 bg-white border-b border-slate-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-[#00245A] to-[#0085FF] rounded-2xl p-6 sm:p-10 text-white text-left relative overflow-hidden shadow-lg mb-10">
            <div class="relative z-10 max-w-2xl space-y-3">
                <span class="inline-block text-[11px] font-bold uppercase tracking-widest bg-[#FFCD00] text-[#00245A] px-3 py-1 rounded-full">
                    Assessment Report Generated
                </span>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white">
                    Personalized Career Direction Report for {{ $assessment->full_name ?: 'Candidate' }}
                </h1>
                <p class="text-xs sm:text-sm text-blue-100 leading-relaxed font-normal">
                    {{ $assessment->guidance_summary }}
                </p>
            </div>

            <!-- Print & Save Actions -->
            <div class="mt-6 pt-6 border-t border-white/20 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    @auth
                        @if($assessment->is_saved)
                            <span class="text-xs bg-emerald-500/20 text-emerald-200 border border-emerald-400/30 px-3 py-1.5 rounded-lg flex items-center gap-1 font-semibold">
                                &check; Saved to Your Dashboard
                            </span>
                        @else
                            <form action="{{ route('quiz.save', $assessment->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-accent text-xs py-2 px-4 shadow-none">
                                    Save Report to My Dashboard
                                </button>
                            </form>
                        @endif
                    @else
                        <form action="{{ route('quiz.save', $assessment->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-accent text-xs py-2 px-4 shadow-none">
                                Create Free Account to Save Report
                            </button>
                        </form>
                    @endauth
                </div>

                <button onclick="window.print()" class="text-xs font-semibold px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-white transition-colors flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    <span>Print Summary</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 text-left">
            <!-- Left Main Column (Top Matches & Action Plan) -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Top 3 Matching Career Paths -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7 shadow-xs">
                    <h2 class="text-xl font-bold text-[#00245A] mb-1">
                        Top 3 Matching Pharmaceutical Career Paths
                    </h2>
                    <p class="text-xs text-slate-500 mb-6">
                        Calculated using objective algorithmic scoring based on your qualifications and preferences.
                    </p>

                    <div class="space-y-4">
                        @foreach($assessment->recommended_paths ?? [] as $index => $match)
                            <div class="p-5 rounded-xl border {{ $index === 0 ? 'border-blue-400 bg-blue-50/20 ring-1 ring-blue-300' : 'border-slate-200 bg-white' }} flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $index === 0 ? 'bg-[#0085FF] text-white' : 'bg-slate-200 text-slate-700' }}">
                                            #{{ $index + 1 }} Choice
                                        </span>
                                        <h3 class="text-lg font-bold text-[#00245A]">
                                            {{ $match['title'] }}
                                        </h3>
                                    </div>
                                    <p class="text-xs text-slate-600 line-clamp-2">
                                        {{ $match['summary'] }}
                                    </p>
                                </div>

                                <div class="flex sm:flex-col items-center sm:items-end justify-between shrink-0 gap-2">
                                    <div class="text-right">
                                        <span class="text-xl font-black text-[#0085FF]">{{ $match['match_percentage'] }}%</span>
                                        <span class="text-[10px] text-slate-500 block -mt-1 font-semibold">Alignment</span>
                                    </div>
                                    <a href="{{ route('career-paths.show', $match['slug']) }}" class="btn-secondary text-xs py-1.5 px-3">
                                        View Details &rarr;
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 4-Step Personalized Action Plan -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7 shadow-xs">
                    <h2 class="text-xl font-bold text-[#00245A] mb-1">
                        Your Recommended Action Plan
                    </h2>
                    <p class="text-xs text-slate-500 mb-6">
                        Follow these practical preparation milestones over the next 30 to 60 days.
                    </p>

                    <div class="space-y-4">
                        @foreach($assessment->action_plan ?? [] as $step)
                            <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <div class="w-8 h-8 rounded-lg bg-[#00245A] text-white flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                                    {{ $step['step'] }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-[#00245A]">{{ $step['title'] }}</h4>
                                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $step['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Sidebar Column (Recommended Services & Direct Consultation) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Recommended Services Card -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs text-left">
                    <h3 class="font-bold text-base text-[#00245A] mb-3">
                        Recommended Preparation Modules
                    </h3>

                    <div class="space-y-3">
                        @foreach($assessment->recommended_services ?? [] as $serv)
                            <div class="p-3.5 rounded-xl border border-slate-200 hover:border-[#0085FF] transition-colors">
                                <div class="font-bold text-xs text-[#00245A]">{{ $serv['title'] }}</div>
                                <div class="text-[11px] text-slate-500 mt-1 line-clamp-2">{{ $serv['summary'] }}</div>
                                <div class="mt-2.5 pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                                    <span class="font-bold text-slate-800">
                                        {{ $serv['price'] == 0 ? 'Complimentary' : '$' . number_format($serv['price'], 0) }}
                                    </span>
                                    <a href="{{ route('services.show', $serv['slug']) }}" class="text-[#0085FF] font-bold hover:underline">
                                        Learn More &rarr;
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 1-on-1 Consultation CTA -->
                <div class="bg-gradient-to-br from-[#00245A] to-[#00173B] text-white rounded-2xl p-6 shadow-md text-left">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-[#FFCD00] flex items-center justify-center font-bold text-lg mb-3">
                        💬
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2">Discuss Your Results With an Industry Mentor</h3>
                    <p class="text-xs text-blue-100 leading-relaxed mb-4">
                        Schedule a 1-on-1 session to review your resume, explore salary expectations, and prepare for upcoming recruitment tests.
                    </p>
                    <a href="{{ route('booking.create') }}" class="btn-accent w-full text-xs py-2.5 font-bold text-center">
                        Book a Consultation Session
                    </a>
                </div>

                <!-- Interactive Roadmap Shortcut -->
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 text-left">
                    <h4 class="font-bold text-sm text-[#00245A] mb-1">Track Learning Milestones</h4>
                    <p class="text-xs text-slate-600 mb-3">
                        Build your personalized step-by-step career roadmap and track completed competencies.
                    </p>
                    <a href="{{ route('roadmap.index') }}" class="btn-primary w-full text-xs py-2 text-center">
                        Open Roadmap Builder &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- Guidance Disclaimer -->
        <div class="mt-12 text-center text-xs text-slate-500 max-w-xl mx-auto">
            Recommendations generated by Pharma Career Compass are intended for career preparation, personal development, and educational strategy. They do not represent formal guarantees of employment.
        </div>

    </div>
</section>
@endsection
