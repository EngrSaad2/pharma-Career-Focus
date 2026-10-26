@extends('layouts.admin')

@section('title', 'Exam Question Bank - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8" x-data="{ addModal: false }">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Written Exam Question Bank</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Manage multiple-choice questions, answer options, explanations, and difficulty levels</p>
        </div>
        <button type="button" @click="addModal = true"
                class="px-4 py-2.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider border border-[#00245A] shadow-[2px_2px_0px_#00245a] hover:bg-blue-600">
            + Add Exam Question
        </button>
    </div>

    <!-- Questions Table -->
    <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] overflow-hidden">
        <div class="p-4 bg-[#F4F9FF] border-b border-[#00245A]/10 flex items-center justify-between">
            <span class="text-xs font-bold text-[#00245A]">Total Questions: {{ $questions->total() }}</span>
        </div>

        <div class="divide-y divide-slate-100">
            @foreach($questions as $q)
                <div class="p-6 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center justify-between gap-4 mb-2">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase bg-[#00245A] text-white">
                                {{ $q->category->name ?? 'General' }}
                            </span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $q->difficulty_level === 'hard' ? 'bg-red-100 text-red-800' : 'bg-slate-200 text-slate-700' }}">
                                {{ ucfirst($q->difficulty_level) }}
                            </span>
                        </div>
                        <span class="text-xs font-bold text-[#0085FF]">{{ $q->marks }} Mark</span>
                    </div>

                    <h4 class="font-bold text-sm text-[#00245A] leading-snug mb-3">
                        {{ $q->question_text }}
                    </h4>

                    <!-- Options grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-3">
                        @foreach($q->options as $opt)
                            <div class="p-2.5 rounded-lg border text-xs flex items-center justify-between {{ $opt->is_correct ? 'bg-green-50 border-green-500 font-bold text-green-900' : 'bg-white border-slate-200 text-slate-700' }}">
                                <span>{{ $opt->option_text }}</span>
                                @if($opt->is_correct)
                                    <span class="text-[10px] font-black uppercase text-green-700">✓ Correct</span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    @if($q->explanation)
                        <div class="p-3 rounded-lg bg-amber-50/70 border border-amber-200 text-[11px] text-amber-900">
                            <strong>Explanation:</strong> {{ $q->explanation }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="p-6 border-t border-[#00245A]/10">
            {{ $questions->links() }}
        </div>
    </div>

    <!-- Modal for adding exam question -->
    <div x-show="addModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-2xl w-full p-6 sm:p-8" @click.away="addModal = false">
            <div class="flex items-center justify-between pb-4 border-b border-[#00245A]/10 mb-6">
                <h3 class="text-xl font-black text-[#00245A]">Create Written MCQ Question</h3>
                <button type="button" @click="addModal = false" class="text-lg font-bold text-slate-500 hover:text-black">&times;</button>
            </div>

            <form action="{{ route('admin.exams.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Subject / Category *</label>
                        <select name="exam_category_id" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm bg-white">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Difficulty Level *</label>
                        <select name="difficulty_level" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm bg-white">
                            <option value="easy">Easy</option>
                            <option value="medium" selected>Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Question Text *</label>
                    <textarea name="question_text" rows="3" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Enter pharmaceutical technical question..."></textarea>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase text-[#00245A]">Options & Select Correct Answer *</label>
                    
                    @for($i = 0; $i < 4; $i++)
                        <div class="flex items-center gap-3">
                            <input type="radio" name="correct_option_index" value="{{ $i }}" {{ $i === 0 ? 'checked' : '' }}
                                   class="w-4 h-4 text-[#0085FF] focus:ring-[#0085FF] cursor-pointer" title="Mark as correct answer">
                            <input type="text" name="options[]" required class="flex-1 px-3 py-2 border-2 border-[#00245A] rounded-lg text-xs" placeholder="Option {{ chr(65 + $i) }} text">
                        </div>
                    @endfor
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Rationale / Explanation *</label>
                    <textarea name="explanation" rows="2" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-xs" placeholder="Explain why this option is correct..."></textarea>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="addModal = false" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-bold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0085FF] text-white rounded-lg text-xs font-black uppercase tracking-wider border border-[#00245A]">Save Question</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
