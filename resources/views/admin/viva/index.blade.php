@extends('layouts.admin')

@section('title', 'Viva Questions Management - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8" x-data="{ addModal: false }">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Viva & Oral Examination Bank</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Manage technical viva questions, structured model answers, and key talking points</p>
        </div>
        <button type="button" @click="addModal = true"
                class="px-4 py-2.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider border border-[#00245A] shadow-[2px_2px_0px_#00245a] hover:bg-blue-600">
            + Add Viva Question
        </button>
    </div>

    <!-- Questions List -->
    <div class="space-y-4">
        @foreach($questions as $q)
            <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase bg-[#00245A] text-white">
                            {{ $q->subject }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase {{ $q->difficulty_level === 'hard' ? 'bg-red-100 text-red-800' : 'bg-slate-200 text-slate-700' }}">
                            {{ ucfirst($q->difficulty_level) }}
                        </span>
                    </div>
                    <span class="text-xs text-[#00245A]/60">Added {{ $q->created_at->format('M d, Y') }}</span>
                </div>

                <h3 class="font-black text-base text-[#00245A]">{{ $q->question }}</h3>

                <div class="p-4 rounded-xl bg-[#F4F9FF] border border-[#00245A]/15 text-xs text-[#00245A]/85 leading-relaxed">
                    <p class="font-bold text-[#0085FF] uppercase text-[10px] mb-1">Model Answer:</p>
                    <p>{{ $q->model_answer }}</p>
                </div>

                @if($q->key_points && count($q->key_points) > 0)
                    <div class="pt-2">
                        <span class="text-[10px] font-bold uppercase text-[#00245A]/60 block mb-1">Key Points Evaluated:</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($q->key_points as $kp)
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-[#00245A] text-[11px] font-medium border border-slate-300">
                                    • {{ $kp }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $questions->links() }}
    </div>

    <!-- Modal for adding viva question -->
    <div x-show="addModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-2xl w-full p-6 sm:p-8" @click.away="addModal = false">
            <div class="flex items-center justify-between pb-4 border-b border-[#00245A]/10 mb-6">
                <h3 class="text-xl font-black text-[#00245A]">Create Viva Question</h3>
                <button type="button" @click="addModal = false" class="text-lg font-bold text-slate-500 hover:text-black">&times;</button>
            </div>

            <form action="{{ route('admin.viva.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Domain / Subject *</label>
                        <select name="subject" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm bg-white">
                            <option value="Quality Assurance">Quality Assurance</option>
                            <option value="Quality Control">Quality Control</option>
                            <option value="Production">Production</option>
                            <option value="Regulatory Affairs">Regulatory Affairs</option>
                            <option value="Pharmacology">Pharmacology</option>
                            <option value="Biopharmaceutics">Biopharmaceutics</option>
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
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Viva Question *</label>
                    <textarea name="question" rows="2" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. What is the fundamental difference between calibration and qualification?"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Suggested Model Answer *</label>
                    <textarea name="model_answer" rows="4" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Structured technical explanation..."></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Key Evaluation Points (comma separated)</label>
                    <input type="text" name="key_points" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Calibration applies to instruments, Qualification applies to systems (DQ, IQ, OQ, PQ)">
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
