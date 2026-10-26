@extends('layouts.dashboard')

@section('title', 'My Career Roadmap - Pharma Career Compass')

@section('dashboard_content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Career Preparation Roadmap</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Track learning milestones, check off completed preparation tasks, and advance your competencies</p>
        </div>
        <a href="{{ route('roadmap.index') }}" class="btn-accent text-xs py-2 px-4 shadow-sm">
            Generate New Roadmap
        </a>
    </div>

    @if($activeRoadmap)
        @php
            $total = $activeRoadmap->milestones->count();
            $completed = $activeRoadmap->milestones->where('is_completed', true)->count();
            $percent = $total > 0 ? round(($completed / $total) * 100) : 0;
        @endphp

        <!-- Roadmap Header Card -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
                <div>
                    <span class="px-2.5 py-0.5 rounded bg-amber-50 text-amber-800 font-bold text-[10px] uppercase tracking-wider border border-amber-200">
                        {{ $activeRoadmap->current_level }}
                    </span>
                    <h2 class="text-2xl font-bold text-slate-900 mt-1">{{ $activeRoadmap->target_role }} Preparation Plan</h2>
                    <p class="text-xs text-slate-500 mt-1">Target Duration: {{ $activeRoadmap->estimated_months }} Months • Created {{ $activeRoadmap->created_at->format('M d, Y') }}</p>
                </div>

                <div class="text-right">
                    <span class="text-3xl font-black text-[#0085FF]">{{ $percent }}%</span>
                    <span class="text-xs text-slate-500 block">{{ $completed }} of {{ $total }} Milestones Achieved</span>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                <div class="bg-[#0085FF] h-full transition-all duration-500 rounded-full" style="width: {{ $percent }}%"></div>
            </div>
        </div>

        <!-- Milestones Checklist -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Milestones Checklist</h3>

            <div class="space-y-4">
                @foreach($activeRoadmap->milestones as $ms)
                    <div class="p-4 rounded-xl border {{ $ms->is_completed ? 'border-emerald-200 bg-emerald-50/40' : 'border-slate-200 bg-white' }} flex items-start justify-between gap-4 transition-all">
                        <div class="flex items-start gap-4">
                            <form action="{{ route('roadmap.toggle-milestone', $ms->id) }}" method="POST" class="mt-0.5">
                                @csrf
                                <input type="checkbox" onchange="this.form.submit()" {{ $ms->is_completed ? 'checked' : '' }}
                                       class="w-4 h-4 rounded border-slate-300 text-[#0085FF] focus:ring-[#0085FF] cursor-pointer">
                            </form>
                            <div>
                                <h4 class="font-bold text-sm text-slate-900 {{ $ms->is_completed ? 'line-through text-slate-400' : '' }}">
                                    {{ $ms->title }}
                                </h4>
                                <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                    {{ $ms->description }}
                                </p>
                                @if($ms->skills_acquired)
                                    <div class="flex flex-wrap gap-1.5 mt-2">
                                        @foreach($ms->skills_acquired as $skill)
                                            <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-[10px] font-semibold border border-slate-200">
                                                {{ $skill }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="shrink-0 text-right">
                            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded {{ $ms->is_completed ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                {{ $ms->is_completed ? 'Completed' : 'Pending' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="bg-white p-12 rounded-2xl border border-slate-200 shadow-sm text-center max-w-lg mx-auto">
            <svg class="w-16 h-16 text-[#0085FF] mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            <h3 class="text-xl font-bold text-slate-900 mb-2">No Active Roadmap Found</h3>
            <p class="text-xs text-slate-600 leading-relaxed mb-6">
                Pick your target pharmaceutical role (QA, QC, Regulatory Affairs, Production) to generate a personalized step-by-step preparation plan.
            </p>
            <a href="{{ route('roadmap.index') }}" class="btn-primary text-xs py-2.5 px-6 shadow-sm">
                Generate Preparation Roadmap
            </a>
        </div>
    @endif
</div>
@endsection
