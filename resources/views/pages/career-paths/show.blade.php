@extends('layouts.app')

@section('title', $path->title . ' Career Guide | Pharma Career Compass')
@section('meta_description', $path->summary)
@section('og_image', asset('images/og-career-paths.jpg'))

@section('content')
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-left">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#0085FF]">Home</a>
            <span>/</span>
            <a href="{{ route('career-paths.index') }}" class="hover:text-[#0085FF]">Career Paths</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold">{{ $path->title }}</span>
        </div>

        <!-- Role Header Card -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-10 shadow-sm mb-10 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-blue-50 text-[#0085FF] border border-blue-200">
                            {{ $path->category->name ?? 'Industrial Sector' }}
                        </span>
                        @if($path->badge)
                            <span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-[#FFCD00] text-[#00245A]">
                                {{ $path->badge }}
                            </span>
                        @endif
                    </div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#00245A]">
                        {{ $path->title }}
                    </h1>
                </div>

                <!-- CTAs -->
                <div class="flex flex-wrap sm:flex-col items-stretch gap-2 shrink-0">
                    <form action="{{ route('roadmap.generate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="career_path_id" value="{{ $path->id }}">
                        <input type="hidden" name="experience_level" value="{{ $path->experience_level }}">
                        <button type="submit" class="btn-primary text-xs py-2 px-4 shadow-sm hover:shadow w-full text-center font-bold">
                            Build My Roadmap for This Role &rarr;
                        </button>
                    </form>
                    <a href="{{ route('seminars.book') }}" class="btn-secondary text-xs py-2 px-4 shadow-sm hover:shadow text-center font-bold">
                        Book Seminars Seat
                    </a>
                </div>
            </div>

            <!-- Quick Specs Row -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs">
                <div>
                    <span class="text-slate-400 block font-medium">Work Setting:</span>
                    <span class="font-bold text-slate-800">{{ $path->work_environment }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block font-medium">Experience Level:</span>
                    <span class="font-bold text-slate-800">{{ $path->experience_level }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block font-medium">Compensation Guide:</span>
                    <span class="font-bold text-[#0085FF]">{{ $path->salary_range }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block font-medium">Demand Outlook:</span>
                    <span class="font-bold text-emerald-600">High / Stable Growth</span>
                </div>
            </div>

            <!-- Role Summary -->
            <p class="text-sm sm:text-base text-slate-700 leading-relaxed">
                {{ $path->summary }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Main Column -->
            <div class="lg:col-span-8 space-y-8">
                <!-- In-depth Overview -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                    <h2 class="text-xl font-bold text-[#00245A] mb-4">Detailed Role Overview</h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                        {{ $path->overview }}
                    </p>

                    @if($path->typical_day)
                        <div class="mt-6 pt-5 border-t border-slate-100">
                            <h3 class="font-bold text-sm text-[#00245A] mb-2">A Typical Day on the Job</h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic bg-slate-50 p-4 rounded-xl border border-slate-200">
                                “{{ $path->typical_day }}”
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Required Skills & Competencies -->
                @if(!empty($path->required_skills))
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                        <h2 class="text-xl font-bold text-[#00245A] mb-4">Core Skills & Technical Competencies</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($path->required_skills as $skill)
                                <div class="flex items-center gap-2.5 p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-800 font-semibold">
                                    <span class="w-5 h-5 rounded-full bg-blue-100 text-[#0085FF] flex items-center justify-center font-bold text-[10px] shrink-0">✓</span>
                                    <span>{{ $skill }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Possible Entry Points -->
                @if(!empty($path->possible_entry_points))
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                        <h2 class="text-xl font-bold text-[#00245A] mb-4">Possible Entry Points & Designations</h2>
                        <div class="space-y-2.5">
                            @foreach($path->possible_entry_points as $entry)
                                <div class="p-3.5 rounded-xl bg-blue-50/50 border border-blue-200 flex items-center justify-between text-xs">
                                    <span class="font-bold text-[#00245A]">{{ $entry }}</span>
                                    <span class="text-[11px] text-[#0085FF] font-semibold">Fresh Grad / Trainee</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Recommended Preparation Steps -->
                @if(!empty($path->recommended_preparation))
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                        <h2 class="text-xl font-bold text-[#00245A] mb-4">Recommended Preparation Strategy</h2>
                        <div class="space-y-3">
                            @foreach($path->recommended_preparation as $step)
                                <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 leading-relaxed">
                                    <span class="text-[#0085FF] font-bold text-sm shrink-0">→</span>
                                    <span>{{ $step }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Sidebar Column -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Academic Requirements -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs">
                    <h3 class="font-bold text-base text-[#00245A] mb-3">Academic Requirements</h3>
                    <ul class="space-y-2 text-xs text-slate-600">
                        @foreach($path->relevant_qualifications ?? [] as $qual)
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>{{ $qual }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- 1-on-1 Mentorship CTA -->
                <div class="bg-gradient-to-br from-[#00245A] to-[#00173B] text-white rounded-2xl p-6 shadow-md text-left">
                    <h3 class="font-bold text-lg text-white mb-2">Want to Enter {{ $path->title }}?</h3>
                    <p class="text-xs text-blue-100 leading-relaxed mb-4">
                        Join interactive live cohorts with industry leaders preparing candidates for this department.
                    </p>
                    <a href="{{ route('seminars.book') }}" class="btn-accent w-full text-xs py-2.5 shadow-sm hover:shadow font-bold text-center block">
                        Book Seminars Seat
                    </a>
                </div>

                <!-- Related Paths -->
                @if($relatedPaths->count() > 0)
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs">
                        <h3 class="font-bold text-base text-[#00245A] mb-3">Related Roles</h3>
                        <div class="space-y-2.5">
                            @foreach($relatedPaths as $rel)
                                <a href="{{ route('career-paths.show', $rel->slug) }}" class="block p-3 rounded-xl border border-slate-100 hover:border-[#0085FF] hover:bg-blue-50/40 transition-all text-xs">
                                    <div class="font-bold text-slate-800">{{ $rel->title }}</div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">{{ $rel->experience_level }}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>
@endsection
