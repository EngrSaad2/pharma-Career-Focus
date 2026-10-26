@extends('layouts.app')

@section('title', 'Pharmaceutical Written Exam Practice Hub | Pharma Career Compass')
@section('meta_description', 'Practice multiple choice questions and timed mock tests for pharmaceutical recruitment examinations covering Pharmacology, Pharmaceutics, QC Analysis, and cGMP.')

@section('content')
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                Pillar 2: Written Exam Readiness
            </span>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#00245A]">
                Pharmaceutical Written Assessment Practice Hub
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 max-w-2xl mx-auto">
                Prepare for technical recruitment exams conducted by leading pharmaceutical manufacturers. Master high-yield MCQs with comprehensive pharmacopoeial explanations.
            </p>
        </div>

        <!-- Exam Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left mb-16">
            @foreach($categories as $category)
                <div class="card-classic p-6 sm:p-7 flex flex-col justify-between hover:border-[#0085FF]">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-[#0085FF] bg-blue-50 px-2.5 py-1 rounded-md">
                                {{ $category->questions_count }} Questions Available
                            </span>
                            <span class="text-xs text-slate-500 font-medium">
                                ⏱ {{ $category->default_time_minutes }} Minutes
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-[#00245A] mb-2">
                            {{ $category->name }}
                        </h3>

                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-6">
                            {{ $category->description }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs text-slate-500">Instant score & explanations</span>
                        <a href="{{ route('practice.exam.take', $category->slug) }}" class="btn-primary text-xs py-2 px-4 shadow-sm hover:shadow font-bold">
                            Start Timed Assessment &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Recent Attempts (if authenticated) -->
        @if(auth()->check() && count($recentAttempts) > 0)
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 text-left shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-[#00245A]">Your Recent Assessment Attempts</h3>
                    <a href="{{ route('dashboard.exams') }}" class="text-xs font-bold text-[#0085FF] hover:underline">
                        View All History &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-slate-50 text-slate-600 border-b border-slate-200">
                            <tr>
                                <th class="p-3">Category</th>
                                <th class="p-3">Score</th>
                                <th class="p-3">Correct / Total</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Date</th>
                                <th class="p-3 text-right">Review</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($recentAttempts as $attempt)
                                <tr>
                                    <td class="p-3 font-semibold text-slate-800">{{ $attempt->category->name ?? 'Assessment' }}</td>
                                    <td class="p-3 font-bold text-[#0085FF]">{{ $attempt->score_percentage }}%</td>
                                    <td class="p-3 text-slate-600">{{ $attempt->correct_answers }} / {{ $attempt->total_questions }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $attempt->passed ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                            {{ $attempt->passed ? 'Passed (>=70%)' : 'Needs Practice' }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-slate-500">{{ $attempt->created_at->format('M j, Y') }}</td>
                                    <td class="p-3 text-right">
                                        <a href="{{ route('practice.exam.results', $attempt->id) }}" class="font-bold text-[#0085FF] hover:underline">
                                            View Solution &rarr;
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
