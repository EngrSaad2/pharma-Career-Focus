@extends('layouts.app')

@section('title', 'Assessment Results | ' . $attempt->session_title)

@section('content')
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Results Scorecard Banner -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm text-left mb-10 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
                <div>
                    <span class="text-xs font-bold text-[#0085FF] uppercase tracking-wider block">Assessment Diagnostic Summary</span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#00245A] mt-1">{{ $attempt->session_title }}</h1>
                    <div class="text-xs text-slate-500 mt-1">
                        Completed on {{ $attempt->created_at->format('M j, Y • h:i A') }} • Duration: {{ gmdate('i:s', $attempt->time_taken_seconds) }}
                    </div>
                </div>

                <!-- Status Badge & Score Percentage -->
                <div class="text-left sm:text-right">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-1 {{ $attempt->passed ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-rose-100 text-rose-800 border border-rose-300' }}">
                        {{ $attempt->passed ? 'Passed (Recruitment Ready)' : 'Needs Additional Practice' }}
                    </span>
                    <div class="text-3xl font-black {{ $attempt->passed ? 'text-emerald-600' : 'text-[#0085FF]' }}">
                        {{ $attempt->score_percentage }}%
                    </div>
                </div>
            </div>

            <!-- Stats Metric Tiles -->
            <div class="grid grid-cols-3 gap-4 text-center">
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <div class="text-2xl font-black text-[#00245A]">{{ $attempt->total_questions }}</div>
                    <div class="text-xs text-slate-500 font-medium">Total Questions</div>
                </div>
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200">
                    <div class="text-2xl font-black text-emerald-700">{{ $attempt->correct_answers }}</div>
                    <div class="text-xs text-emerald-600 font-medium">Correct Answers</div>
                </div>
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200">
                    <div class="text-2xl font-black text-rose-700">{{ $attempt->total_questions - $attempt->correct_answers }}</div>
                    <div class="text-xs text-rose-600 font-medium">Incorrect Answers</div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="pt-2 flex flex-wrap items-center justify-between gap-4">
                <a href="{{ route('practice.exam.take', $attempt->category->slug) }}" class="btn-primary text-xs py-2 px-4 shadow-sm hover:shadow font-bold">
                    Retake This Assessment &rarr;
                </a>
                <a href="{{ route('practice.viva') }}" class="btn-secondary text-xs py-2 px-4 shadow-sm hover:shadow font-bold">
                    Continue to Viva Practice Hub &rarr;
                </a>
            </div>
        </div>

        <!-- Detailed Question-by-Question Solution Review -->
        <div class="text-left space-y-6">
            <h2 class="text-xl font-bold text-[#00245A]">
                Comprehensive Solution & Explanation Key
            </h2>

            <div class="space-y-6">
                @foreach($attempt->user_answers ?? [] as $idx => $ans)
                    <div class="bg-white rounded-2xl border-2 {{ $ans['is_correct'] ? 'border-emerald-300' : 'border-rose-300' }} p-6 shadow-xs text-left">
                        
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-slate-500">Question #{{ $idx + 1 }}</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $ans['is_correct'] ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                {{ $ans['is_correct'] ? 'Correct (+1)' : 'Incorrect (0)' }}
                            </span>
                        </div>

                        <h3 class="font-bold text-base text-[#00245A] mb-4">
                            {{ $ans['question_text'] }}
                        </h3>

                        <!-- Options Display with Highlights -->
                        <div class="space-y-2 mb-4 text-xs sm:text-sm">
                            <div class="p-2.5 rounded-lg border {{ $ans['correct_option'] === 'a' ? 'bg-emerald-50 border-emerald-400 font-bold text-emerald-900' : ($ans['selected_option'] === 'a' ? 'bg-rose-50 border-rose-300 line-through text-rose-800' : 'border-slate-200 text-slate-600') }}">
                                <span>A. {{ $ans['option_a'] }}</span>
                                @if($ans['correct_option'] === 'a') <span class="text-emerald-700 font-bold ml-2">&check; Correct Answer</span> @endif
                                @if(!$ans['is_correct'] && $ans['selected_option'] === 'a') <span class="text-rose-600 font-bold ml-2">&cross; Your Selection</span> @endif
                            </div>

                            <div class="p-2.5 rounded-lg border {{ $ans['correct_option'] === 'b' ? 'bg-emerald-50 border-emerald-400 font-bold text-emerald-900' : ($ans['selected_option'] === 'b' ? 'bg-rose-50 border-rose-300 line-through text-rose-800' : 'border-slate-200 text-slate-600') }}">
                                <span>B. {{ $ans['option_b'] }}</span>
                                @if($ans['correct_option'] === 'b') <span class="text-emerald-700 font-bold ml-2">&check; Correct Answer</span> @endif
                                @if(!$ans['is_correct'] && $ans['selected_option'] === 'b') <span class="text-rose-600 font-bold ml-2">&cross; Your Selection</span> @endif
                            </div>

                            <div class="p-2.5 rounded-lg border {{ $ans['correct_option'] === 'c' ? 'bg-emerald-50 border-emerald-400 font-bold text-emerald-900' : ($ans['selected_option'] === 'c' ? 'bg-rose-50 border-rose-300 line-through text-rose-800' : 'border-slate-200 text-slate-600') }}">
                                <span>C. {{ $ans['option_c'] }}</span>
                                @if($ans['correct_option'] === 'c') <span class="text-emerald-700 font-bold ml-2">&check; Correct Answer</span> @endif
                                @if(!$ans['is_correct'] && $ans['selected_option'] === 'c') <span class="text-rose-600 font-bold ml-2">&cross; Your Selection</span> @endif
                            </div>

                            <div class="p-2.5 rounded-lg border {{ $ans['correct_option'] === 'd' ? 'bg-emerald-50 border-emerald-400 font-bold text-emerald-900' : ($ans['selected_option'] === 'd' ? 'bg-rose-50 border-rose-300 line-through text-rose-800' : 'border-slate-200 text-slate-600') }}">
                                <span>D. {{ $ans['option_d'] }}</span>
                                @if($ans['correct_option'] === 'd') <span class="text-emerald-700 font-bold ml-2">&check; Correct Answer</span> @endif
                                @if(!$ans['is_correct'] && $ans['selected_option'] === 'd') <span class="text-rose-600 font-bold ml-2">&cross; Your Selection</span> @endif
                            </div>
                        </div>

                        <!-- Technical Explanation Note -->
                        @if(!empty($ans['explanation']))
                            <div class="p-3.5 rounded-xl bg-blue-50 border border-blue-200 text-xs text-slate-700 leading-relaxed">
                                <strong class="text-[#00245A] block mb-1">Scientific & Pharmacopoeial Rationale:</strong>
                                {{ $ans['explanation'] }}
                            </div>
                        @endif

                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
@endsection
