@extends('layouts.admin')

@section('title', 'Manage Testimonials - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8" x-data="{ addModal: false }">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Candidate & Member Feedback</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Manage feedback quotes from candidates and mentorship graduates.</p>
        </div>
        <div class="flex items-center gap-2 no-print">
            <button type="button" onclick="window.print()"
                    class="px-3.5 py-2 rounded-lg bg-white border border-[#00245A]/20 text-[#00245A] text-xs font-bold hover:bg-slate-50 flex items-center gap-1.5 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Print</span>
            </button>
            <button type="button" @click="addModal = true"
                    class="px-4 py-2.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider border border-[#00245A] shadow-[2px_2px_0px_#00245a] hover:bg-blue-600 transition">
                + Add Feedback Entry
            </button>
        </div>
    </div>

    <!-- Feedback Compliance Banner -->
    <div class="p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-950 text-xs flex items-center gap-2">
        <span class="text-base">📌</span>
        <span>Only authentic verified client reviews or clearly labeled demonstration simulations are featured on the website.</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($testimonials as $t)
            <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] p-6 flex flex-col justify-between hover:shadow-[6px_6px_0px_#00245a] transition">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-amber-500 font-bold text-sm tracking-wider">
                            @for($i = 0; $i < ($t->rating ?: 5); $i++) ★ @endfor
                        </span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-100 text-[#00245A] border border-slate-300">
                            {{ $t->service_tag ?: 'Consultation' }}
                        </span>
                    </div>

                    <p class="text-xs text-[#00245A]/90 italic mb-4 leading-relaxed">
                        "{{ $t->content ?: 'No review content entered yet.' }}"
                    </p>
                </div>

                <div class="pt-4 border-t border-[#00245A]/10">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <h4 class="font-black text-xs text-[#00245A]">{{ $t->name ?: 'Anonymous Candidate' }}</h4>
                            <p class="text-[11px] text-[#00245A]/70">
                                {{ $t->role ?: 'Pharmacist' }}
                                @if($t->previous_status)
                                    • {{ $t->previous_status }}
                                @endif
                            </p>
                        </div>
                        <form action="{{ route('admin.testimonials.delete', $t->id) }}" method="POST" onsubmit="return confirm('Delete this feedback entry?');" class="no-print">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-[11px] text-red-600 hover:text-red-800 font-bold px-1.5 py-0.5 rounded hover:bg-red-50">
                                Delete
                            </button>
                        </form>
                    </div>

                    <div class="flex items-center gap-2 mt-2">
                        @if($t->is_demo)
                            <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase bg-amber-100 text-amber-900 border border-amber-300">
                                Demo Simulation
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase bg-green-100 text-green-800 border border-green-300">
                                Verified Client
                            </span>
                        @endif

                        @if($t->is_featured)
                            <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase bg-blue-100 text-blue-800">
                                Featured
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full p-12 text-center text-xs text-[#00245A]/60 bg-white rounded-2xl border-2 border-dashed border-slate-300">
                No feedback testimonials entered yet. Click "+ Add Feedback Entry" to create one.
            </div>
        @endforelse
    </div>

    @if($testimonials->hasPages())
        <div class="no-print">
            {{ $testimonials->links() }}
        </div>
    @endif

    <!-- Modal for adding testimonial -->
    <div x-show="addModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak style="display: none;">
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-lg w-full p-6 sm:p-8" @click.away="addModal = false">
            <div class="flex items-center justify-between pb-4 border-b border-[#00245A]/10 mb-6">
                <h3 class="text-xl font-black text-[#00245A]">Add Feedback Entry</h3>
                <button type="button" @click="addModal = false" class="text-lg font-bold text-slate-500 hover:text-black">&times;</button>
            </div>

            <form action="{{ route('admin.testimonials.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Candidate / Member Name *</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Asif Mahmud, RPh">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Current Role / Department *</label>
                        <input type="text" name="role" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Officer, QA - Sterile Facility">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Previous Status / University</label>
                        <input type="text" name="previous_status" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Fresh B.Pharm Graduate">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Feedback Quote *</label>
                    <textarea name="content" rows="3" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Enter genuine review commentary..."></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Service Tag *</label>
                        <input type="text" name="service_tag" value="Viva Preparation" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Rating (1-5) *</label>
                        <select name="rating" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm bg-white">
                            <option value="5" selected>5 Stars (★★★★★)</option>
                            <option value="4">4 Stars (★★★★☆)</option>
                            <option value="3">3 Stars (★★★☆☆)</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_demo" value="1" id="is_demo_chk" class="w-4 h-4 text-[#0085FF] rounded">
                    <label for="is_demo_chk" class="text-xs font-semibold text-[#00245A]">Mark as Demonstration Simulation</label>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="addModal = false" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-bold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0085FF] text-white rounded-lg text-xs font-black uppercase tracking-wider border border-[#00245A] hover:bg-blue-600 transition">Save Feedback</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
