@extends('layouts.admin')

@section('title', 'Manage FAQs - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8" x-data="{ addModal: false }">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Frequently Asked Questions</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Manage public questions and guidance answers displayed on the homepage and consultation pages</p>
        </div>
        <button type="button" @click="addModal = true"
                class="px-4 py-2.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider border border-[#00245A] shadow-[2px_2px_0px_#00245a] hover:bg-blue-600">
            + Add New FAQ
        </button>
    </div>

    <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] overflow-hidden">
        <div class="divide-y divide-slate-100">
            @foreach($faqs as $faq)
                <div class="p-6 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-100 text-[#00245A] border border-slate-300">
                            {{ $faq->category ?? 'General' }}
                        </span>
                        <span class="text-xs text-[#00245A]/60">Order #{{ $faq->sort_order }}</span>
                    </div>

                    <h3 class="font-bold text-sm text-[#00245A] mb-2">{{ $faq->question }}</h3>
                    <p class="text-xs text-[#00245A]/75 leading-relaxed">{{ $faq->answer }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal for adding FAQ -->
    <div x-show="addModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-lg w-full p-6 sm:p-8" @click.away="addModal = false">
            <div class="flex items-center justify-between pb-4 border-b border-[#00245A]/10 mb-6">
                <h3 class="text-xl font-black text-[#00245A]">Create FAQ Item</h3>
                <button type="button" @click="addModal = false" class="text-lg font-bold text-slate-500 hover:text-black">&times;</button>
            </div>

            <form action="{{ route('admin.faqs.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Question *</label>
                    <input type="text" name="question" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Can fresh graduates join the Pharma Career Launchpad?">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Answer *</label>
                    <textarea name="answer" rows="4" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Comprehensive, clear answer..."></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Category *</label>
                        <select name="category" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm bg-white">
                            <option value="General">General</option>
                            <option value="Consultation">Consultation</option>
                            <option value="Exams">Exams</option>
                            <option value="Payments">Payments</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Sort Order *</label>
                        <input type="number" name="sort_order" value="10" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="addModal = false" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-bold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0085FF] text-white rounded-lg text-xs font-black uppercase tracking-wider border border-[#00245A]">Save FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
