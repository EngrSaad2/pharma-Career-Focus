@extends('layouts.dashboard')

@section('title', 'My Career Assessments - Pharma Career Compass')

@section('dashboard_content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Career Assessment History</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Review your saved assessment recommendations and suggested sector directions</p>
        </div>
        <a href="{{ route('quiz.index') }}" class="btn-primary text-xs py-2 px-4 shadow-sm">
            Take New Assessment
        </a>
    </div>

    @if($assessments->count() > 0)
        <div class="space-y-6">
            @foreach($assessments as $item)
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-4 border-b border-slate-100 gap-3">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#0085FF]">Assessment Record #{{ $item->id }}</span>
                            <h3 class="text-xl font-bold text-slate-900 mt-0.5">{{ $item->primary_match }}</h3>
                            <p class="text-xs text-slate-500">Completed on {{ $item->created_at->format('M d, Y - h:i A') }}</p>
                        </div>
                        <a href="{{ route('quiz.results', $item->id) }}" class="px-3.5 py-1.5 rounded-lg bg-slate-50 border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-100 transition-colors">
                            View Full Report
                        </a>
                    </div>

                    <!-- Guidance summary -->
                    <div class="py-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Guidance Recommendation:</p>
                        <p class="text-sm text-slate-700 leading-relaxed">{{ $item->guidance_summary }}</p>
                    </div>

                    <!-- Recommended Paths -->
                    <div class="pt-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block mb-2">Recommended Career Paths:</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($item->recommended_paths ?? [] as $p)
                                <span class="px-3 py-1 rounded-lg bg-slate-50 text-slate-800 text-xs font-semibold border border-slate-200">
                                    {{ $p }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white p-12 rounded-2xl border border-slate-200 shadow-sm text-center max-w-lg mx-auto">
            <svg class="w-16 h-16 text-[#0085FF] mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <h3 class="text-xl font-bold text-slate-900 mb-2">No Assessments Completed Yet</h3>
            <p class="text-xs text-slate-600 leading-relaxed mb-6">
                Take our 5-step career assessment quiz to get personalized recommendations for your pharmaceutical career.
            </p>
            <a href="{{ route('quiz.index') }}" class="btn-primary text-xs py-2.5 px-6 shadow-sm">
                Start Career Assessment
            </a>
        </div>
    @endif
</div>
@endsection
