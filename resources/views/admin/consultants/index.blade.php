@extends('layouts.admin')

@section('title', 'Manage Career Leaders - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8" x-data="{ addModal: false, editModal: false, editingConsultant: null }">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-4 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Career Leaders & Consultants</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Manage verified pharmaceutical industry leaders, executive profiles, session pricing, and photos</p>
        </div>
        <button type="button" @click="addModal = true"
                class="px-4 py-2.5 rounded-xl bg-[#0085FF] hover:bg-[#0070d9] text-white text-xs font-bold uppercase tracking-wider shadow-sm transition-all flex items-center gap-1.5 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>+ Add Career Leader</span>
        </button>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-2 shadow-2xs">
            <span>✓</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Career Leaders Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse($consultants as $c)
            <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] p-6 space-y-4 flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-center gap-3.5">
                            @if($c->avatar)
                                <img src="{{ asset($c->avatar) }}" alt="{{ $c->name }}" class="w-14 h-14 rounded-xl object-cover object-top border-2 border-[#00245A] shrink-0 shadow-2xs">
                            @else
                                <div class="w-14 h-14 rounded-xl bg-[#00245A] text-[#FFCD00] font-black text-xl flex items-center justify-center border border-[#00245A] shrink-0">
                                    {{ substr($c->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h3 class="font-black text-lg text-[#00245A] leading-tight">{{ $c->name }}</h3>
                                <p class="text-xs text-[#0085FF] font-bold mt-0.5">{{ $c->title }}</p>
                                <p class="text-[11px] text-slate-500 font-medium">{{ $c->current_company ?: 'Pharma Career Compass' }} • {{ $c->experience_years }}+ yrs exp</p>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $c->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                            {{ $c->is_active ? 'Active' : 'Hidden' }}
                        </span>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs space-y-1">
                        <div>
                            <span class="text-slate-400 font-medium">Specialization:</span>
                            <strong class="text-slate-800">{{ $c->specialization }}</strong>
                        </div>
                        @if($c->qualifications)
                            <div>
                                <span class="text-slate-400 font-medium">Qualifications:</span>
                                <span class="text-slate-700">{{ $c->qualifications }}</span>
                            </div>
                        @endif
                    </div>

                    <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                        {{ $c->bio }}
                    </p>
                </div>

                {{-- Card Actions Row (Edit, Delete, Profile) --}}
                <div class="pt-4 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                    <div>
                        <span class="text-[10px] uppercase font-bold text-slate-400 block">Session Fee</span>
                        <span class="font-black text-base text-[#00245A]">৳{{ number_format($c->hourly_rate) }} <span class="text-xs font-normal text-slate-500">BDT</span></span>
                    </div>

                    <div class="flex items-center gap-2">
                        {{-- Edit Button --}}
                        <button type="button" 
                                @click="editingConsultant = {{ json_encode($c) }}; editModal = true"
                                class="px-3 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-[#0085FF] font-bold text-xs flex items-center gap-1 border border-blue-200 shadow-2xs transition-colors cursor-pointer"
                                title="Edit Profile & Photo">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            <span>Edit</span>
                        </button>

                        {{-- Delete Button --}}
                        <form action="{{ route('admin.consultants.delete', $c->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete career leader {{ $c->name }}? This action cannot be undone.');" 
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs flex items-center gap-1 border border-red-200 shadow-2xs transition-colors cursor-pointer"
                                    title="Delete Career Leader">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                <span>Delete</span>
                            </button>
                        </form>

                        {{-- Public Profile Link --}}
                        <a href="{{ route('consultants.show', $c->slug) }}" target="_blank" 
                           class="px-3 py-1.5 rounded-lg bg-slate-50 hover:bg-slate-100 text-[#00245A] font-bold text-xs flex items-center gap-1 border border-slate-200 transition-colors"
                           title="View Public Profile">
                            <span>Profile</span>
                            <span class="text-[10px]">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2 p-12 text-center bg-white rounded-2xl border-2 border-dashed border-slate-300">
                <p class="text-sm font-bold text-slate-500">No career leaders found.</p>
            </div>
        @endforelse
    </div>

    <!-- ========================================================================= -->
    <!-- EDIT CONSULTANT MODAL -->
    <!-- ========================================================================= -->
    <div x-show="editModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-xl w-full p-6 sm:p-8" @click.away="editModal = false">
            <div class="flex items-center justify-between pb-3 border-b border-slate-200 mb-5">
                <h3 class="text-xl font-black text-[#00245A]">Edit Career Leader</h3>
                <button type="button" @click="editModal = false" class="text-slate-400 hover:text-black font-bold text-lg cursor-pointer">&times;</button>
            </div>

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

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Company / Organization</label>
                        <input type="text" name="current_company" :value="editingConsultant?.current_company" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Experience (Yrs) *</label>
                        <input type="number" name="experience_years" :value="editingConsultant?.experience_years" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Session Fee (BDT) *</label>
                        <input type="number" name="hourly_rate" :value="editingConsultant?.hourly_rate" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Qualifications & Licenses</label>
                    <input type="text" name="qualifications" :value="editingConsultant?.qualifications" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                </div>

                <!-- Photo Upload Field -->
                <div class="p-4 rounded-xl bg-blue-50 border-2 border-dashed border-[#0085FF] space-y-1.5">
                    <label class="block text-xs font-black uppercase text-[#00245A]">Upload Profile Picture / Photo</label>
                    <input type="file" name="avatar" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#00245A] file:text-white hover:file:bg-[#0085FF] cursor-pointer">
                    <p class="text-[11px] text-slate-500">Supports JPG, PNG, WEBP (Max 5MB).</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Professional Biography</label>
                    <textarea name="bio" rows="3" x-text="editingConsultant?.bio" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm"></textarea>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" id="edit_is_active" value="1" :checked="editingConsultant?.is_active" class="w-4 h-4 rounded text-[#0085FF]">
                    <label for="edit_is_active" class="text-xs font-bold text-slate-700 cursor-pointer">Visible & Active on Platform</label>
                </div>

                <div class="pt-4 border-t border-slate-200 flex justify-end gap-3">
                    <button type="button" @click="editModal = false" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-bold cursor-pointer">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0085FF] hover:bg-[#0070d9] text-white rounded-lg text-xs font-black uppercase tracking-wider border border-[#00245A] shadow-xs cursor-pointer">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- ADD CONSULTANT MODAL -->
    <!-- ========================================================================= -->
    <div x-show="addModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-xl w-full p-6 sm:p-8" @click.away="addModal = false">
            <div class="flex items-center justify-between pb-3 border-b border-slate-200 mb-5">
                <h3 class="text-xl font-black text-[#00245A]">Add New Career Leader</h3>
                <button type="button" @click="addModal = false" class="text-slate-400 hover:text-black font-bold text-lg cursor-pointer">&times;</button>
            </div>

            <form action="{{ route('admin.consultants.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Full Name *</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Shah Sharfin">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Professional Title *</label>
                        <input type="text" name="title" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. AGM and Head of QA">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Specialization *</label>
                        <input type="text" name="specialization" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Quality Assurance & cGMP">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Company</label>
                        <input type="text" name="current_company" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Leading Pharma">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Experience (Yrs) *</label>
                        <input type="number" name="experience_years" required value="15" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Session Fee (BDT) *</label>
                        <input type="number" name="hourly_rate" required value="1000" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Qualifications & Licenses</label>
                    <input type="text" name="qualifications" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. B.Pharm, M.Pharm, Registered Pharmacist">
                </div>

                <!-- Photo Upload Field -->
                <div class="p-4 rounded-xl bg-blue-50 border-2 border-dashed border-[#0085FF] space-y-1.5">
                    <label class="block text-xs font-black uppercase text-[#00245A]">Upload Profile Picture / Photo</label>
                    <input type="file" name="avatar" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#00245A] file:text-white hover:file:bg-[#0085FF] cursor-pointer">
                    <p class="text-[11px] text-slate-500">Supports JPG, PNG, WEBP (Max 5MB).</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Professional Biography</label>
                    <textarea name="bio" rows="3" class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Executive leadership overview..."></textarea>
                </div>

                <div class="pt-4 border-t border-slate-200 flex justify-end gap-3">
                    <button type="button" @click="addModal = false" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-bold cursor-pointer">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0085FF] hover:bg-[#0070d9] text-white rounded-lg text-xs font-black uppercase tracking-wider border border-[#00245A] shadow-xs cursor-pointer">Save Career Leader</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
