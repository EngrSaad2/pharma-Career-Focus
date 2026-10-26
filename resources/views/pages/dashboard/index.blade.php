@extends('layouts.dashboard')

@section('title', 'Candidate Dashboard - Pharma Career Compass')

@section('dashboard_content')
<div class="space-y-8">
    
    <!-- Welcome Header -->
    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded bg-[#FFCD00]/25 text-[#00245A] text-[10px] font-bold uppercase tracking-wider border border-amber-300">
                    {{ $profile->education_level ?? 'Pharmacy Graduate' }}
                </span>
                <span class="text-xs text-slate-500">
                    {{ $profile->university ?? 'Pharmaceutical Candidate' }}
                </span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#00245A]">
                Hello, {{ $user->name }}!
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 mt-1">
                Target Sector: <strong class="text-[#0085FF]">{{ $profile->target_department ?? 'Not set yet' }}</strong>
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('quiz.index') }}" class="px-4 py-2.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider shadow-sm hover:bg-blue-600">
                Retake Assessment
            </a>
            <a href="{{ route('practice.exams') }}" class="px-4 py-2.5 rounded-lg bg-[#FFCD00] text-[#00245A] text-xs font-bold uppercase tracking-wider shadow-sm hover:bg-yellow-400">
                Start Exam Practice
            </a>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Roadmap Progress</p>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-[#0085FF] mt-1">{{ $roadmapProgress }}%</h3>
            <p class="text-[10px] text-slate-500 mt-1">Milestones Completed</p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Exam Attempts</p>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-[#00245A] mt-1">{{ $stats['exam_attempts_count'] ?? 0 }}</h3>
            <p class="text-[10px] text-slate-500 mt-1">Avg Score: {{ round($stats['average_score'] ?? 0) }}%</p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Viva Questions</p>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-[#00245A] mt-1">{{ $stats['viva_practised_count'] ?? 0 }}</h3>
            <p class="text-[10px] text-slate-500 mt-1">Practised & Mastered</p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Consultations</p>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-[#00245A] mt-1">{{ $stats['bookings_count'] ?? 0 }}</h3>
            <p class="text-[10px] text-slate-500 mt-1">Booked Sessions</p>
        </div>
    </div>

    <!-- 2 Column Section: Latest Assessment & Active Roadmap -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Assessment Match Summary -->
        <div class="bg-white p-6 sm:p-7 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-extrabold text-[#00245A]">Career Assessment</h2>
                    <a href="{{ route('dashboard.assessment') }}" class="text-xs font-bold text-[#0085FF] hover:underline">View All &rarr;</a>
                </div>

                @if($latestAssessment)
                    <div class="p-4 rounded-xl bg-blue-50/50 border border-blue-100 mb-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#0085FF]">Top Career Match</span>
                        <h4 class="text-lg font-extrabold text-[#00245A] mt-0.5">{{ $latestAssessment->primary_match }}</h4>
                        <p class="text-xs text-slate-500 mt-1">Assessed on {{ $latestAssessment->created_at->format('M d, Y') }}</p>
                    </div>

                    <div class="space-y-2">
                        <p class="text-xs font-bold uppercase text-slate-400">Recommended Paths:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($latestAssessment->recommended_paths ?? [] as $path)
                                <span class="px-2.5 py-1 rounded-lg bg-slate-50 text-slate-700 text-xs font-semibold border border-slate-200">
                                    {{ $path }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-xs text-slate-500 mb-3">You have not completed the Career Assessment Quiz yet.</p>
                        <a href="{{ route('quiz.index') }}" class="inline-block px-4 py-2 rounded-lg bg-[#0085FF] text-white text-xs font-bold shadow-sm hover:bg-blue-600">
                            Take 5-Minute Quiz
                        </a>
                    </div>
                @endif
            </div>

            <div class="pt-4 border-t border-slate-100 mt-6 flex items-center justify-between">
                <span class="text-xs text-slate-500">Explore full report & recommendations</span>
                <a href="{{ route('dashboard.assessment') }}" class="text-xs font-bold text-[#00245A] hover:underline">Details &rarr;</a>
            </div>
        </div>

        <!-- Roadmap Progress Snapshot -->
        <div class="bg-white p-6 sm:p-7 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-extrabold text-[#00245A]">Active Career Roadmap</h2>
                    <a href="{{ route('dashboard.roadmap') }}" class="text-xs font-bold text-[#0085FF] hover:underline">Open Roadmap &rarr;</a>
                </div>

                @if($activeRoadmap)
                    <div class="mb-4">
                        <div class="flex items-center justify-between text-xs font-bold mb-1">
                            <span>{{ $activeRoadmap->target_role }} ({{ $activeRoadmap->current_level }})</span>
                            <span class="text-[#0085FF]">{{ $roadmapProgress }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2.5 rounded-full border border-slate-200 overflow-hidden">
                            <div class="bg-[#0085FF] h-full transition-all duration-500" style="width: {{ $roadmapProgress }}%"></div>
                        </div>
                    </div>

                    <div class="space-y-2 mt-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Recent Milestones:</span>
                        @foreach($activeRoadmap->milestones->take(3) as $ms)
                            <div class="flex items-center gap-2 text-xs py-1">
                                <span class="w-4 h-4 rounded-full flex items-center justify-center text-[10px] font-bold {{ $ms->is_completed ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $ms->is_completed ? '✓' : $loop->iteration }}
                                </span>
                                <span class="{{ $ms->is_completed ? 'line-through text-slate-400' : 'text-slate-700 font-medium' }} truncate">
                                    {{ $ms->title }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-xs text-slate-500 mb-3">No active roadmap generated yet.</p>
                        <a href="{{ route('roadmap.index') }}" class="inline-block px-4 py-2 rounded-lg bg-[#0085FF] text-white text-xs font-bold shadow-sm hover:bg-blue-600">
                            Generate Career Roadmap
                        </a>
                    </div>
                @endif
            </div>

            <div class="pt-4 border-t border-slate-100 mt-6 flex items-center justify-between">
                <span class="text-xs text-slate-500">Track, check off, and build skills</span>
                <a href="{{ route('dashboard.roadmap') }}" class="text-xs font-bold text-[#00245A] hover:underline">Manage Roadmap &rarr;</a>
            </div>
        </div>

    </div>

    <!-- Upcoming Consultations & Recent Exam Attempts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Bookings -->
        <div class="bg-white p-6 sm:p-7 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-extrabold text-[#00245A]">Consultation Sessions</h2>
                <a href="{{ route('consultation.book') }}" class="text-xs font-bold text-[#0085FF] hover:underline">+ Book New</a>
            </div>

            @if($upcomingBookings && $upcomingBookings->count() > 0)
                <div class="space-y-3">
                    @foreach($upcomingBookings as $bk)
                        <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/60 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#0085FF]">
                                    {{ $bk->booking_date->format('M d, Y') }} at {{ date('h:i A', strtotime($bk->start_time)) }}
                                </span>
                                <h4 class="font-bold text-[#00245A] text-sm">{{ $bk->consultant->name ?? 'Advisor' }}</h4>
                                <p class="text-xs text-slate-600">{{ $bk->service->title ?? 'Consultation' }} ({{ $bk->status }})</p>
                            </div>
                            @if($bk->meeting_link)
                                <a href="{{ $bk->meeting_link }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-[#0085FF] text-white font-bold text-xs shadow-sm hover:bg-blue-600">
                                    Join Link
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-xs text-slate-500 py-6 text-center">No upcoming consultations booked.</p>
            @endif
        </div>

        <!-- Exam attempts -->
        <div class="bg-white p-6 sm:p-7 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-extrabold text-[#00245A]">Recent Exam Practice</h2>
                <a href="{{ route('practice.exams') }}" class="text-xs font-bold text-[#0085FF] hover:underline">+ New Practice</a>
            </div>

            @if($recentAttempts && $recentAttempts->count() > 0)
                <div class="space-y-3">
                    @foreach($recentAttempts as $att)
                        <div class="p-3.5 rounded-xl border border-slate-200 bg-white flex items-center justify-between shadow-xs">
                            <div>
                                <h4 class="font-bold text-[#00245A] text-xs">{{ $att->category->name ?? 'General Practice' }}</h4>
                                <p class="text-[10px] text-slate-500">{{ $att->created_at->format('M d, Y - h:i A') }}</p>
                            </div>
                            <div class="text-right">
                                <span class="px-2 py-0.5 rounded text-xs font-bold {{ $att->is_passed ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $att->score_percentage }}%
                                </span>
                                <p class="text-[10px] text-slate-500 mt-0.5">{{ $att->correct_answers }}/{{ $att->total_questions }} Correct</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-xs text-slate-500 py-6 text-center">No exam attempts recorded yet.</p>
            @endif
        </div>

    </div>

</div>
@endsection
