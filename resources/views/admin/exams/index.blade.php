@extends('layouts.admin')

@section('title', 'Exam Question Bank - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8" x-data="{ addModal: false }">
    <!-- Header with Action and Print Buttons -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Written Exam Question Bank</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Manage multiple-choice questions, answer options, explanations, and difficulty levels</p>
        </div>
        <div class="flex items-center gap-2 no-print">
            <button type="button" onclick="window.print()"
                    class="px-3.5 py-2 rounded-lg bg-white border border-[#00245A]/20 text-[#00245A] text-xs font-bold hover:bg-slate-50 flex items-center gap-1.5 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Print Bank</span>
            </button>
            <button type="button" @click="addModal = true"
                    class="px-4 py-2.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider border border-[#00245A] shadow-[2px_2px_0px_#00245a] hover:bg-blue-600 transition">
                + Add Exam Question
            </button>
        </div>
    </div>

    <!-- Questions Table Card -->
    <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] overflow-hidden">
        <div class="p-4 bg-[#F4F9FF] border-b border-[#00245A]/10 flex items-center justify-between">
            <span class="text-xs font-bold text-[#00245A]">Total MCQ Questions: {{ $questions->total() }}</span>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse($questions as $q)
                <div class="p-6 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center justify-between gap-4 mb-2">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase bg-[#00245A] text-white">
                                {{ $q->category->name ?? 'General Pharma' }}
                            </span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $q->difficulty === 'hard' || $q->difficulty === 'advanced' ? 'bg-red-100 text-red-800' : ($q->difficulty === 'beginner' || $q->difficulty === 'easy' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                                {{ ucfirst($q->difficulty) }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 no-print">
                            <form action="{{ route('admin.exams.delete', $q->id) }}" method="POST" onsubmit="return confirm('Delete this MCQ question?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-600 hover:text-red-800 font-bold px-2 py-1 rounded hover:bg-red-50">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <h4 class="font-bold text-sm text-[#00245A] leading-snug mb-3">
                        {{ $loop->iteration + ($questions->currentPage() - 1) * $questions->perPage() }}. {{ $q->question_text }}
                    </h4>

                    <!-- Options grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-3">
                        @foreach(['a' => $q->option_a, 'b' => $q->option_b, 'c' => $q->option_c, 'd' => $q->option_d] as $key => $optText)
                            @if($optText)
                                @php $isCorrect = (strtolower($q->correct_option) === $key); @endphp
                                <div class="p-2.5 rounded-lg border text-xs flex items-center justify-between {{ $isCorrect ? 'bg-green-50 border-green-500 font-bold text-green-900' : 'bg-white border-slate-200 text-slate-700' }}">
                                    <span>
                                        <strong class="uppercase text-[#00245A] mr-1.5">{{ $key }})</strong> {{ $optText }}
                                    </span>
                                    @if($isCorrect)
                                        <span class="text-[10px] font-black uppercase text-green-700 bg-green-100 px-2 py-0.5 rounded">✓ Correct</span>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>

                    @if($q->explanation)
                        <div class="p-3 rounded-lg bg-amber-50/70 border border-amber-200 text-[11px] text-amber-900 leading-relaxed">
                            <strong class="font-bold text-amber-950">Explanation:</strong> {{ $q->explanation }}
                        </div>
                    @endif
                </div>
            @empty
                <div class="p-12 text-center text-xs text-[#00245A]/60">
                    No questions found in question bank.
                </div>
            @endforelse
        </div>

        @if($questions->hasPages())
            <div class="p-6 border-t border-[#00245A]/10 no-print">
                {{ $questions->links() }}
            </div>
        @endif
    </div>

    <!-- Modal for adding exam question -->
    <div x-show="addModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak style="display: none;">
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-2xl w-full p-6 sm:p-8" @click.away="addModal = false">
            <div class="flex items-center justify-between pb-4 border-b border-[#00245A]/10 mb-6">
                <h3 class="text-xl font-black text-[#00245A]">Create Written MCQ Question</h3>
                <button type="button" @click="addModal = false" class="text-lg font-bold text-slate-500 hover:text-black">&times;</button>
            </div>

            <form action="{{ route('admin.exams.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Subject / Category *</label>
                        <select name="category_id" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm bg-white">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Difficulty Level *</label>
                        <select name="difficulty" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm bg-white">
                            <option value="beginner">Beginner</option>
                            <option value="intermediate" selected>Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Question Text *</label>
                    <textarea name="question_text" rows="3" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Enter pharmaceutical technical MCQ question..."></textarea>
                </div>

                <div class="space-y-2.5">
                    <label class="block text-xs font-bold uppercase text-[#00245A]">Options & Select Correct Answer (Radio) *</label>
                    
                    @foreach(['a' => 'Option A', 'b' => 'Option B', 'c' => 'Option C', 'd' => 'Option D'] as $optKey => $optLabel)
                        <div class="flex items-center gap-3">
                            <label class="flex items-center gap-1.5 cursor-pointer text-xs font-bold text-[#00245A] min-w-[70px]">
                                <input type="radio" name="correct_option" value="{{ $optKey }}" {{ $optKey === 'a' ? 'checked' : '' }}
                                       class="w-4 h-4 text-[#0085FF] focus:ring-[#0085FF] cursor-pointer" required>
                                <span>{{ strtoupper($optKey) }}</span>
                            </label>
                            <input type="text" name="option_{{ $optKey }}" required class="flex-1 px-3 py-2 border-2 border-[#00245A] rounded-lg text-xs" placeholder="{{ $optLabel }} text...">
                        </div>
                    @endforeach
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Rationale / Explanation</label>
                    <textarea name="explanation" rows="2" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-xs" placeholder="Explain the pharmacopoeial or cGMP rationale..."></textarea>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="addModal = false" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-bold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0085FF] text-white rounded-lg text-xs font-black uppercase tracking-wider border border-[#00245A] hover:bg-blue-600 transition">Save Question</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
