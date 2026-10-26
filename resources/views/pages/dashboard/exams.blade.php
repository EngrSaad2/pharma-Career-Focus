@extends('layouts.dashboard')

@section('title', 'Exam Practice History - Pharma Career Compass')

@section('dashboard_content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Written Exam History</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Review your mock test attempts, scores, and performance trends</p>
        </div>
        <a href="{{ route('practice.exams') }}" class="btn-primary text-xs py-2 px-4 shadow-sm">
            Take New Mock Exam
        </a>
    </div>

    <!-- Exam Performance Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Mock Attempts</span>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">{{ $totalAttempts }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Average Score</span>
            <h3 class="text-3xl font-extrabold text-[#0085FF] mt-1">{{ round($averageScore) }}%</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Passing Benchmark</span>
            <h3 class="text-3xl font-extrabold text-amber-500 mt-1">60%</h3>
        </div>
    </div>

    <!-- Attempts Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-900">Past Exam Attempts</h3>
        </div>

        @if($attempts->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-900">
                    <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold uppercase tracking-wider text-slate-600">
                        <tr>
                            <th class="px-6 py-4">Category / Subject</th>
                            <th class="px-6 py-4">Score</th>
                            <th class="px-6 py-4">Result</th>
                            <th class="px-6 py-4">Time Spent</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($attempts as $att)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-900">
                                    {{ $att->category->name ?? 'General Practice' }}
                                </td>
                                <td class="px-6 py-4 font-extrabold text-base text-slate-900">
                                    {{ $att->score_percentage }}%
                                    <span class="text-xs font-normal text-slate-500">({{ $att->correct_answers }}/{{ $att->total_questions }})</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded text-xs font-bold {{ $att->is_passed ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                        {{ $att->is_passed ? 'Passed' : 'Needs Review' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-600">
                                    {{ floor($att->time_taken_seconds / 60) }}m {{ $att->time_taken_seconds % 60 }}s
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-600">
                                    {{ $att->created_at->format('M d, Y - h:i A') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('practice.exam.results', $att->id) }}" class="text-xs font-bold text-[#0085FF] hover:underline">
                                        View Scorecard &rarr;
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-slate-100">
                {{ $attempts->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <p class="text-xs text-slate-500 mb-4">No exam practice attempts found yet.</p>
                <a href="{{ route('practice.exams') }}" class="btn-primary text-xs py-2 px-5 shadow-sm">
                    Take Your First Practice Exam
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
