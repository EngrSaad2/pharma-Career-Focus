@extends('layouts.app')

@section('title', 'Pharmaceutical Job Interview Readiness Hub | Pharma Career Compass')
@section('meta_description', 'Role-specific pharmaceutical interview questions and sample answers using the STAR method (Situation, Task, Action, Result) for QA, QC, and Production.')

@section('content')
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-10 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                Pillar 4: Interview Readiness
            </span>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#00245A]">
                Pharmaceutical Job Interview Readiness Center
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 max-w-xl mx-auto">
                Tackle plant-floor situational questions, behavioral challenges, and technical panels using the STAR (Situation, Task, Action, Result) response model.
            </p>
        </div>

        <!-- Filter Bar -->
        <form method="GET" action="{{ route('practice.interviews') }}" class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-sm mb-8">
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                <div class="sm:col-span-5">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search interview prompts..." class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0085FF]">
                </div>
                <div class="sm:col-span-4">
                    <select name="role" class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white">
                        <option value="">All Pharmaceutical Roles</option>
                        @foreach($roles as $r)
                            <option value="{{ $r }}" {{ request('role') == $r ? 'selected' : '' }}>
                                {{ $r }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-3 flex gap-2">
                    <button type="submit" class="btn-primary text-xs py-2 px-4 shadow-sm hover:shadow w-full">
                        Filter Prompts
                    </button>
                    @if(request()->hasAny(['search', 'role']))
                        <a href="{{ route('practice.interviews') }}" class="btn-secondary text-xs py-2 px-3 shadow-sm hover:shadow">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <!-- Interview Questions List -->
        <div class="space-y-6 text-left">
            @forelse($questions as $question)
                @php
                    $isBookmarked = isset($userProgress[$question->id]) && $userProgress[$question->id]->is_bookmarked;
                    $isPrepared = isset($userProgress[$question->id]) && $userProgress[$question->id]->is_prepared;
                @endphp

                <div class="bg-white rounded-2xl border border-slate-200 hover:border-[#0085FF] p-6 shadow-sm hover:shadow-md transition-all text-left"
                     x-data="{
                        expanded: false,
                        bookmarked: {{ $isBookmarked ? 'true' : 'false' }},
                        prepared: {{ $isPrepared ? 'true' : 'false' }},
                        async toggleProgress(type) {
                            @guest
                                alert('Please sign in to save your interview practice progress.');
                                return;
                            @endguest
                            try {
                                const res = await fetch(`{{ url('/practice/interviews') }}/{{ $question->id }}/toggle`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({ type: type })
                                });
                                const data = await res.json();
                                if (type === 'bookmark') {
                                    this.bookmarked = data.is_bookmarked;
                                } else {
                                    this.prepared = data.is_prepared;
                                }
                            } catch(e) {
                                console.error(e);
                            }
                        }
                     }">

                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-[#00245A] bg-slate-100 px-2.5 py-0.5 rounded-full">
                                {{ $question->target_role }}
                            </span>
                            <span class="text-xs font-semibold text-[#0085FF]">
                                {{ $question->category }}
                            </span>
                        </div>

                        <!-- Progress actions -->
                        <div class="flex items-center gap-2">
                            <button type="button" 
                                    @click="toggleProgress('bookmark')" 
                                    class="text-xs px-2.5 py-1 rounded-lg border font-semibold transition-colors"
                                    :class="bookmarked ? 'bg-amber-50 border-amber-300 text-amber-800' : 'bg-slate-50 border-slate-200 text-slate-500 hover:text-slate-800'">
                                <span x-text="bookmarked ? '★ Saved' : '☆ Save'"></span>
                            </button>

                            <button type="button" 
                                    @click="toggleProgress('prepared')" 
                                    class="text-xs px-2.5 py-1 rounded-lg border font-semibold transition-colors"
                                    :class="prepared ? 'bg-emerald-50 border-emerald-300 text-emerald-800' : 'bg-slate-50 border-slate-200 text-slate-500 hover:text-slate-800'">
                                <span x-text="prepared ? '✓ Prepared' : 'Mark Prepared'"></span>
                            </button>
                        </div>
                    </div>

                    <h3 class="text-base sm:text-lg font-bold text-[#00245A] mb-2 leading-snug">
                        {{ $question->question_text }}
                    </h3>

                    @if($question->context_explanation)
                        <p class="text-xs text-slate-500 mb-4">
                            <strong>Why recruiters ask this:</strong> {{ $question->context_explanation }}
                        </p>
                    @endif

                    <div class="pt-2">
                        <button type="button" 
                                @click="expanded = !expanded" 
                                class="text-xs font-bold px-3 py-1.5 rounded-lg border transition-colors"
                                :class="expanded ? 'bg-slate-100 text-slate-700 border-slate-300' : 'bg-[#0085FF] text-white border-[#0085FF] hover:bg-[#006ED6]'">
                            <span x-text="expanded ? 'Hide STAR Answer Guide' : 'View STAR Answer Guide & Sample Model Response &rarr;'"></span>
                        </button>
                    </div>

                    <!-- STAR Breakdown Details -->
                    <div x-show="expanded" x-collapse x-transition class="mt-4 pt-4 border-t border-slate-100 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div class="p-3 rounded-lg bg-blue-50/50 border border-blue-200">
                                <strong class="text-[#00245A] block mb-1">S - Situation:</strong>
                                {{ $question->star_situation }}
                            </div>
                            <div class="p-3 rounded-lg bg-blue-50/50 border border-blue-200">
                                <strong class="text-[#00245A] block mb-1">T - Task:</strong>
                                {{ $question->star_task }}
                            </div>
                            <div class="p-3 rounded-lg bg-blue-50/50 border border-blue-200">
                                <strong class="text-[#00245A] block mb-1">A - Action:</strong>
                                {{ $question->star_action }}
                            </div>
                            <div class="p-3 rounded-lg bg-blue-50/50 border border-blue-200">
                                <strong class="text-[#00245A] block mb-1">R - Result:</strong>
                                {{ $question->star_result }}
                            </div>
                        </div>

                        @if($question->model_answer)
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs sm:text-sm text-slate-700 leading-relaxed font-sans">
                                <strong class="text-[#00245A] font-bold block mb-1 text-xs uppercase tracking-wider">Sample Verbatim Answer:</strong>
                                “{{ $question->model_answer }}”
                            </div>
                        @endif

                        @if($question->recruiter_red_flags)
                            <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-xs text-rose-900 leading-relaxed">
                                <strong class="font-bold block mb-0.5">⚠️ Common Red Flags to Avoid:</strong>
                                {{ $question->recruiter_red_flags }}
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-12 text-center bg-white rounded-2xl border border-slate-200">
                    <p class="text-slate-500 text-sm">No interview prompts match your selected filters.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $questions->links() }}
        </div>

    </div>
</section>
@endsection
