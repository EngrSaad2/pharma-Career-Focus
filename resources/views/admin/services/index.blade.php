@extends('layouts.admin')

@section('title', 'Manage Services - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8" x-data="{ addModal: false }">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Services & Consultation Packages</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Configure service pricing, descriptions, session durations, and featured status</p>
        </div>
        <button type="button" @click="addModal = true"
                class="px-4 py-2.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider border border-[#00245A] shadow-[2px_2px_0px_#00245a] hover:bg-blue-600">
            + Add New Service
        </button>
    </div>

    <!-- Services Table -->
    <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-[#00245A]">
                <thead class="bg-[#F4F9FF] border-b border-[#00245A]/15 text-xs font-bold uppercase tracking-wider text-[#00245A]/70">
                    <tr>
                        <th class="px-6 py-4">Service</th>
                        <th class="px-6 py-4">Pricing</th>
                        <th class="px-6 py-4">Duration</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Quick Update</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($services as $svc)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <strong class="font-bold text-sm text-[#00245A] block">{{ $svc->title }}</strong>
                                <span class="text-xs text-[#00245A]/60">{{ $svc->tagline }}</span>
                            </td>
                            <td class="px-6 py-4 font-black text-[#0085FF]">
                                BDT {{ number_format($svc->price_bdt) }}
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-[#00245A]/80">
                                {{ $svc->duration_minutes }} Mins
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $svc->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $svc->is_active ? 'Active' : 'Disabled' }}
                                </span>
                                @if($svc->is_featured)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-[#FFCD00]/40 text-[#00245A] border border-[#FFCD00]">
                                        Featured
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.services.update', $svc->id) }}" method="POST" class="inline-flex items-center gap-2">
                                    @csrf
                                    <input type="number" name="price_bdt" value="{{ $svc->price_bdt }}" class="w-24 px-2 py-1 text-xs border rounded" title="Update Price BDT">
                                    <button type="submit" class="px-3 py-1 rounded bg-[#00245A] text-white text-xs font-bold hover:bg-blue-950">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for adding service -->
    <div x-show="addModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-xl w-full p-6 sm:p-8" @click.away="addModal = false">
            <div class="flex items-center justify-between pb-4 border-b border-[#00245A]/10 mb-6">
                <h3 class="text-xl font-black text-[#00245A]">Create New Service</h3>
                <button type="button" @click="addModal = false" class="text-lg font-bold text-slate-500 hover:text-black">&times;</button>
            </div>

            <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Service Title *</label>
                    <input type="text" name="title" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Quality Control Mock Interview">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Tagline *</label>
                    <input type="text" name="tagline" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Comprehensive oral prep with QC managers">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Description *</label>
                    <textarea name="description" rows="3" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Detailed service description..."></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Price (BDT) *</label>
                        <input type="number" name="price_bdt" required value="1500" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Duration (Minutes) *</label>
                        <input type="number" name="duration_minutes" required value="45" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>

                <div class="flex items-center gap-6 pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="rounded text-[#0085FF]">
                        <span class="text-xs font-bold text-[#00245A]">Feature on Homepage</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded text-[#0085FF]">
                        <span class="text-xs font-bold text-[#00245A]">Active for Booking</span>
                    </label>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="addModal = false" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-bold text-slate-700">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0085FF] text-white rounded-lg text-xs font-black uppercase tracking-wider border border-[#00245A] shadow-[2px_2px_0px_#00245a]">Save Service</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
