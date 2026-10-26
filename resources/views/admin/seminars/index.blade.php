@extends('layouts.admin')

@section('title', 'Seminars & Workshops Management | Admin Portal')

@section('content')
<div class="space-y-6">

    {{-- Top Action Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A] tracking-tight">Seminars & Masterclasses</h1>
            <p class="text-xs text-slate-500 mt-1">Manage interactive industry sessions, participants, seats, and payments.</p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('admin.seminars.registrations') }}" class="px-4 py-2 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 font-bold text-xs flex items-center gap-1.5 shadow-2xs">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span>All Registrations ({{ $totalRegistrations }})</span>
            </a>
            <a href="{{ route('admin.seminars.create') }}" class="px-4 py-2 rounded-lg bg-[#0085FF] hover:bg-[#0070d9] text-white font-bold text-xs flex items-center gap-1.5 shadow-xs transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Create New Seminar</span>
            </a>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-2">
            <span>✓</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs font-bold flex items-center gap-2">
            <span>⚠️</span>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- Key Metrics Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-6 gap-3 sm:gap-4">
        {{-- Total Seminars --}}
        <div class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-2xs">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Programs</span>
            <div class="text-2xl font-black text-[#00245A] mt-1">{{ $totalSeminars }}</div>
            <span class="text-[10px] text-slate-500">{{ $upcomingSeminars }} upcoming</span>
        </div>

        {{-- Total Registrations --}}
        <div class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-2xs">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Registrations</span>
            <div class="text-2xl font-black text-[#0085FF] mt-1">{{ $totalRegistrations }}</div>
            <span class="text-[10px] text-slate-500">Across all sessions</span>
        </div>

        {{-- Pending Verifications --}}
        <div class="p-4 rounded-xl bg-amber-50/70 border border-amber-200 shadow-2xs">
            <span class="text-[11px] font-bold text-amber-800 uppercase tracking-wider block">Pending Payment</span>
            <div class="text-2xl font-black text-amber-700 mt-1">{{ $pendingVerifications }}</div>
            <a href="{{ route('admin.seminars.registrations', ['payment_status' => 'pending']) }}" class="text-[10px] text-amber-800 font-bold hover:underline">
                Review Trx IDs →
            </a>
        </div>

        {{-- Verified Attendees --}}
        <div class="p-4 rounded-xl bg-emerald-50/70 border border-emerald-200 shadow-2xs">
            <span class="text-[11px] font-bold text-emerald-800 uppercase tracking-wider block">Verified Paid</span>
            <div class="text-2xl font-black text-emerald-700 mt-1">{{ $verifiedPaymentsCount }}</div>
            <span class="text-[10px] text-emerald-600 font-medium">Guaranteed seats</span>
        </div>

        {{-- Collected Revenue --}}
        <div class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-2xs">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Verified Revenue</span>
            <div class="text-xl font-black text-emerald-600 mt-1">৳{{ number_format($collectedRevenue, 0) }}</div>
            <span class="text-[10px] text-slate-400">BDT collected</span>
        </div>

        {{-- Expected Revenue --}}
        <div class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-2xs">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Expected Revenue</span>
            <div class="text-xl font-black text-slate-600 mt-1">৳{{ number_format($expectedRevenue, 0) }}</div>
            <span class="text-[10px] text-slate-400">Total booked</span>
        </div>
    </div>

    {{-- Search & Filter Form --}}
    <div class="bg-white p-4 rounded-xl border border-slate-200/90 shadow-2xs">
        <form action="{{ route('admin.seminars.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1 relative">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by title, topic, or speaker..." class="w-full pl-3 pr-4 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
            </div>
            <div class="w-full sm:w-48">
                <select name="status" class="w-full py-2 px-3 rounded-lg border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-[#0085FF]">
                    <option value="">All Statuses</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="registration_open" {{ request('status') === 'registration_open' ? 'selected' : '' }}>Registration Open</option>
                    <option value="registration_closed" {{ request('status') === 'registration_closed' ? 'selected' : '' }}>Registration Closed</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 rounded-lg bg-[#00245A] text-white text-xs font-bold hover:bg-[#00173b] transition">
                Filter
            </button>
            @if(request()->hasAny(['q', 'status']))
                <a href="{{ route('admin.seminars.index') }}" class="px-3 py-2 rounded-lg bg-slate-100 text-slate-600 text-xs font-bold hover:bg-slate-200 flex items-center justify-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Seminars Listing Table --}}
    <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-sm font-bold text-[#00245A]">All Seminar Programs</h2>
            <span class="text-xs text-slate-400">{{ $seminars->total() }} records</span>
        </div>

        @if($seminars->isEmpty())
            <div class="p-12 text-center">
                <div class="text-3xl mb-2">🎓</div>
                <h3 class="text-sm font-bold text-slate-800">No Seminars Found</h3>
                <p class="text-xs text-slate-500 mt-1 mb-4">Create your first seminar program to begin receiving registrations.</p>
                <a href="{{ route('admin.seminars.create') }}" class="px-4 py-2 rounded-lg bg-[#0085FF] text-white font-bold text-xs">
                    + Create First Seminar
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-bold uppercase tracking-wider text-[10px]">
                        <tr>
                            <th class="py-3 px-4">Program & Topic</th>
                            <th class="py-3 px-3">Date & Time</th>
                            <th class="py-3 px-3">Speaker</th>
                            <th class="py-3 px-3">Format</th>
                            <th class="py-3 px-3">Fee</th>
                            <th class="py-3 px-3">Capacity & Seats</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach($seminars as $sem)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="font-bold text-slate-900 line-clamp-1 max-w-xs">
                                        <a href="{{ route('seminars.show', $sem->slug) }}" target="_blank" class="hover:text-[#0085FF]">
                                            {{ $sem->title }}
                                        </a>
                                    </div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">
                                        {{ $sem->category ?: 'General' }} • {{ $sem->topic ?: 'Industry Session' }}
                                    </div>
                                </td>
                                <td class="py-3 px-3 whitespace-nowrap">
                                    <div class="font-bold text-[#00245A]">{{ $sem->event_date ? $sem->event_date->format('M j, Y') : 'TBA' }}</div>
                                    <div class="text-[10px] text-slate-400">
                                        {{ $sem->start_time ? \Carbon\Carbon::parse($sem->start_time)->format('h:i A') : '' }}
                                    </div>
                                </td>
                                <td class="py-3 px-3">
                                    <div class="font-semibold text-slate-800">{{ $sem->speaker_name ?: 'TBA' }}</div>
                                    <div class="text-[10px] text-slate-400 truncate max-w-[120px]">{{ $sem->speaker_designation }}</div>
                                </td>
                                <td class="py-3 px-3 whitespace-nowrap">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold
                                        @if($sem->participation_type === 'online') bg-sky-100 text-sky-800
                                        @elseif($sem->participation_type === 'offline') bg-amber-100 text-amber-800
                                        @else bg-emerald-100 text-emerald-800 @endif">
                                        {{ strtoupper($sem->participation_type) }}
                                    </span>
                                </td>
                                <td class="py-3 px-3 whitespace-nowrap font-bold text-slate-900">
                                    ৳{{ number_format($sem->registration_fee, 0) }}
                                </td>
                                <td class="py-3 px-3 whitespace-nowrap">
                                    <div class="font-bold {{ $sem->availableSeats() > 0 ? 'text-blue-600' : 'text-red-600' }}">
                                        {{ $sem->confirmed_regs ?? $sem->confirmedRegistrations()->count() }} / {{ $sem->max_participants }}
                                    </div>
                                    <div class="text-[10px] text-slate-400">
                                        {{ $sem->availableSeats() }} seats available
                                    </div>
                                </td>
                                <td class="py-3 px-3 whitespace-nowrap">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold
                                        @if($sem->status === 'published' || $sem->status === 'registration_open') bg-emerald-100 text-emerald-800
                                        @elseif($sem->status === 'draft') bg-slate-100 text-slate-600
                                        @elseif($sem->status === 'registration_closed') bg-amber-100 text-amber-800
                                        @elseif($sem->status === 'completed') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ strtoupper(str_replace('_', ' ', $sem->status)) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.seminars.registrations', ['seminar_id' => $sem->id]) }}" title="View Registrations" class="p-1.5 rounded hover:bg-slate-100 text-[#0085FF]">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </a>

                                        {{-- Broadcast Modal Trigger --}}
                                        <button type="button" onclick="openBroadcastModal({{ $sem->id }}, '{{ addslashes($sem->title) }}')" title="Broadcast Message to Confirmed Participants" class="p-1.5 rounded hover:bg-slate-100 text-purple-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </button>

                                        <a href="{{ route('admin.seminars.edit', $sem->id) }}" title="Edit Seminar" class="p-1.5 rounded hover:bg-slate-100 text-slate-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        <form action="{{ route('admin.seminars.destroy', $sem->id) }}" method="POST" onsubmit="return confirm('Delete seminar {{ addslashes($sem->title) }}? All associated registration records will also be removed.')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Delete" class="p-1.5 rounded hover:bg-red-50 text-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $seminars->links() }}
            </div>
        @endif
    </div>

</div>

{{-- Broadcast Message Modal --}}
<div id="broadcastModal" class="fixed inset-0 z-50 bg-black/60 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl relative">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
            <h3 class="font-bold text-sm text-[#00245A]">Broadcast Update to Confirmed Attendees</h3>
            <button type="button" onclick="closeBroadcastModal()" class="text-slate-400 hover:text-slate-600 text-lg font-bold">&times;</button>
        </div>

        <form id="broadcastForm" method="POST" action="">
            @csrf
            <div class="space-y-4">
                <div>
                    <span class="text-xs text-slate-500 block mb-1">Target Program:</span>
                    <strong class="text-xs text-slate-800 font-bold block" id="broadcastProgramTitle"></strong>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Email Subject <span class="text-red-500">*</span></label>
                    <input type="text" name="subject" required placeholder="e.g. Schedule Update / Venue Room Change / Joining Link" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Message Content <span class="text-red-500">*</span></label>
                    <textarea name="message" rows="5" required placeholder="Type the message to send to all verified confirmed participants..." class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]"></textarea>
                </div>

                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeBroadcastModal()" class="px-4 py-2 rounded-lg bg-slate-100 text-slate-700 text-xs font-bold hover:bg-slate-200">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-purple-700 text-white text-xs font-bold hover:bg-purple-800 shadow-xs">
                        Send Broadcast Email Now
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function openBroadcastModal(seminarId, title) {
    document.getElementById('broadcastProgramTitle').innerText = title;
    document.getElementById('broadcastForm').action = "/admin/seminars/" + seminarId + "/broadcast";
    document.getElementById('broadcastModal').classList.remove('hidden');
    document.getElementById('broadcastModal').classList.add('flex');
}
function closeBroadcastModal() {
    document.getElementById('broadcastModal').classList.remove('flex');
    document.getElementById('broadcastModal').classList.add('hidden');
}
</script>
@endsection
