@extends('layouts.admin')

@section('title', 'Manage Testimonials - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8" x-data="{ addModal: false }">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Candidate & Member Feedback</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Manage review quotes. Notice: All demonstration entries must carry demonstration indicators.</p>
        </div>
        <button type="button" @click="addModal = true"
                class="px-4 py-2.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider border border-[#00245A] shadow-[2px_2px_0px_#00245a] hover:bg-blue-600">
            + Add Testimonial Entry
        </button>
    </div>

    <!-- Alert on authentic feedback compliance -->
    <div class="p-4 rounded-xl bg-amber-50 border-2 border-amber-400 text-amber-900 text-xs">
        <strong class="font-bold">Project Policy:</strong> Strictly no fabricated ratings, fake claims, or deceptive stats. Only authentic verified client reviews or clearly badged demo simulations are allowed.
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($testimonials as $t)
            <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-amber-500 font-bold text-xs">
                            @for($i = 0; $i < $t->rating; $i++) ★ @endfor
                        </span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-100 text-[#00245A] border border-slate-300">
                            {{ $t->service_tag ?? 'Launchpad' }}
                        </span>
                    </div>

                    <p class="text-xs text-[#00245A]/85 italic mb-4 leading-relaxed">
                        "{{ $t->quote }}"
                    </p>
                </div>

                <div class="pt-4 border-t border-[#00245A]/10">
                    <h4 class="font-bold text-xs text-[#00245A]">{{ $t->client_name }}</h4>
                    <p class="text-[11px] text-[#00245A]/60">{{ $t->client_role }} • {{ $t->company_or_institution }}</p>
                    <span class="inline-block mt-2 px-2 py-0.5 rounded text-[9px] font-bold uppercase {{ $t->is_approved ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $t->is_approved ? 'Approved & Visible' : 'Pending' }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal for adding testimonial -->
    <div x-show="addModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-lg w-full p-6 sm:p-8" @click.away="addModal = false">
            <div class="flex items-center justify-between pb-4 border-b border-[#00245A]/10 mb-6">
                <h3 class="text-xl font-black text-[#00245A]">Add Feedback Entry</h3>
                <button type="button" @click="addModal = false" class="text-lg font-bold text-slate-500 hover:text-black">&times;</button>
            </div>

            <form action="{{ route('admin.testimonials.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Candidate / Member Name *</label>
                    <input type="text" name="client_name" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Asif Mahmud">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Role / Degree *</label>
                        <input type="text" name="client_role" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. B.Pharm Graduate">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Institution / Dept *</label>
                        <input type="text" name="company_or_institution" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. University of Dhaka">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Feedback Quote *</label>
                    <textarea name="quote" rows="3" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Authentic feedback text..."></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Service Tag *</label>
                        <input type="text" name="service_tag" value="Viva Preparation" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Rating (1-5) *</label>
                        <select name="rating" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm bg-white">
                            <option value="5">5 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="3">3 Stars</option>
                        </select>
                    </div>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="addModal = false" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-bold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0085FF] text-white rounded-lg text-xs font-black uppercase tracking-wider border border-[#00245A]">Save Feedback</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
