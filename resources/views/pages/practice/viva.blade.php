@extends('layouts.app')

@section('title', 'Pharma Career Technical Viva Practice Hub | Pharma Career Compass')
@section('meta_description', 'Excel in your pharma career technical oral viva interviews with Pharma Career Compass. Model answers, examiner tips, and high-yield prompts.')
@section('og_image', asset('images/og-practice.jpg'))

@section('content')
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-10 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                Pillar 3: Viva Skills Coaching
            </span>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#00245A]">
                Pharma Career Technical Viva Hub
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 max-w-xl mx-auto">
                Review rapid-fire oral technical prompts, model answers, and board advice. Rehearse out loud to eliminate hesitation under interview pressure.
            </p>
        </div>

        <!-- Filter Bar -->
        <form method="GET" action="{{ route('practice.viva') }}" class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-sm mb-8">
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                <div class="sm:col-span-5">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search questions by topic (e.g. CAPA, HPLC, Capping)..." class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0085FF]">
                </div>
                <div class="sm:col-span-4">
                    <select name="domain" class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white">
                        <option value="">All Technical Domains</option>
                        @foreach($domains as $dom)
                            <option value="{{ $dom }}" {{ request('domain') == $dom ? 'selected' : '' }}>
                                {{ $dom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-3 flex gap-2">
                    <button type="submit" class="btn-primary text-xs py-2 px-4 shadow-sm hover:shadow w-full">
                        Filter Questions
                    </button>
                    @if(request()->hasAny(['search', 'domain']))
                        <a href="{{ route('practice.viva') }}" class="btn-secondary text-xs py-2 px-3 shadow-sm hover:shadow">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <!-- Viva Question Cards -->
        <div class="space-y-6 text-left">
            @forelse($questions as $question)
                @php
                    $isBookmarked = isset($userProgress[$question->id]) && $userProgress[$question->id]->is_bookmarked;
                    $isPractised = isset($userProgress[$question->id]) && $userProgress[$question->id]->is_practised;
                @endphp

                <div class="bg-white rounded-2xl border border-slate-200 hover:border-[#0085FF] p-6 shadow-sm hover:shadow-md transition-all relative"
                     x-data="{
                        revealed: false,
                        bookmarked: {{ $isBookmarked ? 'true' : 'false' }},
                        practised: {{ $isPractised ? 'true' : 'false' }},
                        async toggleProgress(type) {
                            @guest
                                alert('Please sign in or register to bookmark questions and track your viva practice.');
                                return;
                            @endguest
                            try {
                                const res = await fetch(`{{ url('/practice/viva') }}/{{ $question->id }}/toggle`, {
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
                                    this.practised = data.is_practised;
                                }
                            } catch(e) {
                                console.error(e);
                            }
                        }
                     }">

                    <!-- Top Meta Bar -->
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-[#0085FF] bg-blue-50 px-2.5 py-0.5 rounded-full border border-blue-200">
                                {{ $question->domain }}
                            </span>
                            <span class="text-xs text-slate-500 font-medium">
                                Topic: {{ $question->topic }}
                            </span>
                        </div>

                        <!-- Bookmark & Practised Actions -->
                        <div class="flex items-center gap-2">
                            <button type="button" 
                                    @click="toggleProgress('bookmark')" 
                                    class="text-xs px-2.5 py-1 rounded-lg border transition-colors flex items-center gap-1 font-semibold"
                                    :class="bookmarked ? 'bg-amber-50 border-amber-300 text-amber-800' : 'bg-slate-50 border-slate-200 text-slate-500 hover:text-slate-800'">
                                <span x-text="bookmarked ? '★ Saved' : '☆ Save'"></span>
                            </button>

                            <button type="button" 
                                    @click="toggleProgress('practised')" 
                                    class="text-xs px-2.5 py-1 rounded-lg border transition-colors flex items-center gap-1 font-semibold"
                                    :class="practised ? 'bg-emerald-50 border-emerald-300 text-emerald-800' : 'bg-slate-50 border-slate-200 text-slate-500 hover:text-slate-800'">
                                <span x-text="practised ? '✓ Practised' : 'Mark Practised'"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Question Prompt -->
                    <h3 class="text-base sm:text-lg font-bold text-[#00245A] mb-4">
                        {{ $question->question_text }}
                    </h3>

                    <!-- Key takeaway tags -->
                    @if(!empty($question->key_points))
                        <div class="flex flex-wrap gap-1.5 mb-4">
                            @foreach($question->key_points as $kp)
                                <span class="text-[11px] bg-slate-100 text-slate-700 px-2 py-0.5 rounded font-medium">
                                    • {{ $kp }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Model Answer Toggle Button -->
                    <div class="pt-2">
                        <button type="button" 
                                @click="revealed = !revealed" 
                                class="text-xs font-bold px-3 py-1.5 rounded-lg border transition-colors"
                                :class="revealed ? 'bg-slate-100 text-slate-700 border-slate-300' : 'bg-[#0085FF] text-white border-[#0085FF] hover:bg-[#006ED6]'">
                            <span x-text="revealed ? 'Hide Model Answer' : 'Reveal Model Answer & Board Tip &rarr;'"></span>
                        </button>
                    </div>

                    <!-- Expandable Model Answer & Board Tip -->
                    <div x-show="revealed" x-collapse x-transition class="mt-4 pt-4 border-t border-slate-100 space-y-4">
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs sm:text-sm text-slate-700 leading-relaxed font-sans whitespace-pre-line">
                            <strong class="text-[#00245A] font-bold block mb-2 text-xs uppercase tracking-wider">Suggested Model Answer:</strong>
{{ $question->model_answer }}
                        </div>

                        @if($question->interviewer_tip)
                            <div class="p-3.5 rounded-xl bg-amber-50 border border-amber-200 text-xs text-amber-900 leading-relaxed">
                                <strong class="font-bold block mb-0.5">💡 Interview Board Tip:</strong>
                                {{ $question->interviewer_tip }}
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-12 text-center bg-white rounded-2xl border border-slate-200">
                    <p class="text-slate-500 text-sm">No viva questions match your selected filter criteria.</p>
                    <a href="{{ route('practice.viva') }}" class="btn-primary text-xs py-2 px-4 shadow-sm hover:shadow mt-3 inline-block">
                        View All Questions
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $questions->links() }}
        </div>

    </div>
</section>
@endsection
