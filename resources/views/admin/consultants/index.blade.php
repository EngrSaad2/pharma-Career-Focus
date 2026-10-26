@extends('layouts.admin')

@section('title', 'Manage Consultants - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8" x-data="{ addModal: false, editModal: false, slotModal: false, selectedConsultantId: null, editingConsultant: null }">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Consultants & Availability Slots</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Manage verified pharmaceutical advisors, rates, photos, and recurring consultation time slots</p>
        </div>
        <button type="button" @click="addModal = true"
                class="px-4 py-2.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider border border-[#00245A] shadow-[2px_2px_0px_#00245a] hover:bg-blue-600">
            + Add New Consultant
        </button>
    </div>

    <!-- Consultants List -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach($consultants as $c)
            <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] p-6 space-y-4">
                <div class="flex items-start justify-between">
                    <div class="flex items-center gap-3">
                        @if($c->avatar)
                            <img src="{{ asset($c->avatar) }}" alt="{{ $c->name }}" class="w-12 h-12 rounded-xl object-cover object-top border-2 border-[#00245A]">
                        @else
                            <div class="w-12 h-12 rounded-xl bg-[#00245A] text-[#FFCD00] font-black text-lg flex items-center justify-center border border-[#00245A]">
                                {{ substr($c->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h3 class="font-black text-base text-[#00245A]">{{ $c->name }}</h3>
                            <p class="text-xs text-[#0085FF] font-semibold">{{ $c->title }}</p>
                            <p class="text-[11px] text-[#00245A]/60">{{ $c->current_company }} • {{ $c->experience_years }} yrs exp</p>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $c->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $c->is_active ? 'Active' : 'Hidden' }}
                    </span>
                </div>

                <p class="text-xs text-[#00245A]/75 line-clamp-2">
                    {{ $c->bio }}
                </p>

                <!-- Availability Slots list -->
                <div class="p-3.5 rounded-xl bg-[#F4F9FF] border border-[#00245A]/15 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#00245A]/70">Weekly Available Slots:</span>
                        <button type="button" @click="selectedConsultantId = {{ $c->id }}; slotModal = true"
                                class="text-[11px] font-bold text-[#0085FF] hover:underline">
                            + Add Time Slot
                        </button>
                    </div>

                    <div class="flex flex-wrap gap-1.5">
                        @forelse($c->availabilities as $slot)
                            <span class="px-2 py-1 rounded bg-white text-[#00245A] text-[10px] font-bold border border-[#00245A]/20">
                                {{ ucfirst($slot->day_of_week) }}: {{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}
                            </span>
                        @empty
                            <span class="text-[10px] text-red-600">No availability slots configured yet.</span>
                        @endforelse
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2 text-xs">
                    <span class="font-black text-[#0085FF]">৳{{ number_format($c->hourly_rate) }} / session</span>
                    <div class="flex items-center gap-3">
                        <button type="button" @click="editingConsultant = {{ json_encode($c) }}; editModal = true"
                                class="font-bold text-[#0085FF] hover:underline flex items-center gap-1">
                            <span>Edit / Upload Photo</span>
                        </button>
                        <a href="{{ route('consultants.show', $c->slug) }}" target="_blank" class="font-bold text-[#00245A] hover:underline flex items-center gap-1">
                            <span>Public Profile</span> &rarr;
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal for editing consultant & uploading photo -->
    <div x-show="editModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-xl w-full p-6 sm:p-8" @click.away="editModal = false">
            <h3 class="text-xl font-black text-[#00245A] mb-4">Edit Profile & Upload Photo</h3>

            <form :action="'/admin/consultants/' + (editingConsultant ? editingConsultant.id : '')" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Full Name *</label>
                    <input type="text" name="name" :value="editingConsultant?.name" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Professional Title *</label>
                        <input type="text" name="title" :value="editingConsultant?.title" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Specialization *</label>
                        <input type="text" name="specialization" :value="editingConsultant?.specialization" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Company / Organization</label>
                        <input type="text" name="current_company" :value="editingConsultant?.current_company" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Session Rate (BDT) *</label>
                        <input type="number" name="hourly_rate" :value="editingConsultant?.hourly_rate" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>

                <!-- Photo Upload Field -->
                <div class="p-4 rounded-xl bg-blue-50 border-2 border-dashed border-[#0085FF] space-y-2">
                    <label class="block text-xs font-black uppercase text-[#00245A]">Upload Profile Picture / Photo</label>
                    <input type="file" name="avatar" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#00245A] file:text-white hover:file:bg-[#0085FF] cursor-pointer">
                    <p class="text-[11px] text-slate-500">Supports JPG, PNG, WEBP (Max 5MB). Photo will automatically appear on Homepage, Profile, and Booking.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Professional Biography</label>
                    <textarea name="bio" rows="3" x-text="editingConsultant?.bio" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm"></textarea>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="editModal = false" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-bold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0085FF] text-white rounded-lg text-xs font-black uppercase tracking-wider border border-[#00245A]">Save Changes & Photo</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for adding consultant -->
    <div x-show="addModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-xl w-full p-6 sm:p-8" @click.away="addModal = false">
            <div class="flex items-center justify-between pb-4 border-b border-[#00245A]/10 mb-6">
                <h3 class="text-xl font-black text-[#00245A]">Add Industrial Consultant</h3>
                <button type="button" @click="addModal = false" class="text-lg font-bold text-slate-500 hover:text-black">&times;</button>
            </div>

            <form action="{{ route('admin.consultants.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Full Name *</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Dr. Sabrina Akhter">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Professional Title *</label>
                        <input type="text" name="title" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Senior QA Manager">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Specialization *</label>
                        <input type="text" name="specialization" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Quality Assurance & cGMP">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Company / Organization *</label>
                        <input type="text" name="current_company" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Incepta Pharmaceuticals">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Years of Experience *</label>
                        <input type="number" name="years_of_experience" required value="10" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Professional Biography *</label>
                    <textarea name="bio" rows="3" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Executive experience summary..."></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Hourly Rate (BDT) *</label>
                        <input type="number" name="hourly_rate_bdt" required value="1500" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Session Duration (Mins) *</label>
                        <input type="number" name="session_duration_minutes" required value="45" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="addModal = false" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-bold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0085FF] text-white rounded-lg text-xs font-black uppercase tracking-wider border border-[#00245A]">Save Consultant</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for adding slot -->
    <div x-show="slotModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-md w-full p-6 sm:p-8" @click.away="slotModal = false">
            <h3 class="text-xl font-black text-[#00245A] mb-4">Add Weekly Availability Slot</h3>

            <form :action="'/admin/consultants/' + selectedConsultantId + '/availability'" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Day of Week *</label>
                    <select name="day_of_week" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm bg-white">
                        <option value="monday">Monday</option>
                        <option value="tuesday">Tuesday</option>
                        <option value="wednesday">Wednesday</option>
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                        <option value="saturday">Saturday</option>
                        <option value="sunday">Sunday</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Start Time *</label>
                        <input type="time" name="start_time" required value="19:00" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">End Time *</label>
                        <input type="time" name="end_time" required value="20:00" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="slotModal = false" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-bold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0085FF] text-white rounded-lg text-xs font-black uppercase tracking-wider border border-[#00245A]">Add Slot</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
