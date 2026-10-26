@extends('layouts.admin')

@section('title', 'Seminar Registrations & Payment Verification | Admin Portal')

@section('admin_content')
<div class="space-y-6">

    {{-- Top Action Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A] tracking-tight">Seminar Registrations & Verification</h1>
            <p class="text-xs text-slate-500 mt-1">Review participant submissions, verify bKash transactions, inspect receipts, and manage attendance.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.seminars.registrations.export', request()->query()) }}" class="px-3.5 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center gap-1.5 shadow-xs transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span>Export CSV (Attendance)</span>
            </a>
            <a href="{{ route('admin.seminars.index') }}" class="px-3.5 py-2 rounded-lg border border-slate-200 bg-white text-slate-700 font-bold text-xs hover:bg-slate-50 shadow-2xs">
                ← Seminars List
            </a>
        </div>
    </div>

    {{-- Alerts --}}
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

    {{-- Search & Filtering Panel --}}
    <div class="bg-white p-4 rounded-xl border border-slate-200/90 shadow-2xs">
        <form action="{{ route('admin.seminars.registrations') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            
            {{-- Keyword Search --}}
            <div class="sm:col-span-4 relative">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search ref, name, email, phone, or TrxID..." class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
            </div>

            {{-- Filter by Seminar --}}
            <div class="sm:col-span-3">
                <select name="seminar_id" class="w-full py-2 px-3 rounded-lg border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-[#0085FF]">
                    <option value="">All Seminars</option>
                    @foreach($seminars as $s)
                        <option value="{{ $s->id }}" {{ request('seminar_id') == $s->id ? 'selected' : '' }}>{{ $s->title }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Payment Status Filter --}}
            <div class="sm:col-span-2">
                <select name="payment_status" class="w-full py-2 px-3 rounded-lg border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-[#0085FF]">
                    <option value="">All Payments</option>
                    <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Pending Verification</option>
                    <option value="verified" {{ request('payment_status') === 'verified' ? 'selected' : '' }}>Verified (Paid)</option>
                    <option value="rejected" {{ request('payment_status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            {{-- Participation Mode Filter --}}
            <div class="sm:col-span-2">
                <select name="type" class="w-full py-2 px-3 rounded-lg border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-[#0085FF]">
                    <option value="">All Formats</option>
                    <option value="online" {{ request('type') === 'online' ? 'selected' : '' }}>Online</option>
                    <option value="offline" {{ request('type') === 'offline' ? 'selected' : '' }}>Offline</option>
                </select>
            </div>

            {{-- Filter Actions --}}
            <div class="sm:col-span-1 flex gap-1">
                <button type="submit" class="w-full bg-[#00245A] hover:bg-[#00183b] text-white text-xs font-bold py-2 px-3 rounded-lg transition">
                    Go
                </button>
                @if(request()->hasAny(['q', 'seminar_id', 'payment_status', 'type']))
                    <a href="{{ route('admin.seminars.registrations') }}" class="p-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-xs flex items-center justify-center font-bold">
                        ✕
                    </a>
                @endif
            </div>

        </form>
    </div>

    {{-- Registrations Table --}}
    <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-sm font-bold text-[#00245A]">Participant Registrations</h2>
            <span class="text-xs text-slate-400">{{ $registrations->total() }} registrations</span>
        </div>

        @if($registrations->isEmpty())
            <div class="p-12 text-center">
                <div class="text-3xl mb-2">📋</div>
                <h3 class="text-sm font-bold text-slate-800">No Registrations Found</h3>
                <p class="text-xs text-slate-500 mt-1">No participant registrations matched your search or filter conditions.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-bold uppercase tracking-wider text-[10px]">
                        <tr>
                            <th class="py-3 px-3">Reference & Date</th>
                            <th class="py-3 px-3">Participant</th>
                            <th class="py-3 px-3">Program & Mode</th>
                            <th class="py-3 px-3">Transaction Details</th>
                            <th class="py-3 px-3">Receipt</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3 text-right">Verification Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach($registrations as $reg)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                
                                {{-- Reference & Date --}}
                                <td class="py-3 px-3 whitespace-nowrap">
                                    <div class="font-mono font-extrabold text-[#00245A] text-xs">
                                        <a href="{{ route('seminars.confirmation', $reg->registration_reference) }}" target="_blank" class="hover:text-[#0085FF] hover:underline">
                                            {{ $reg->registration_reference }}
                                        </a>
                                    </div>
                                    <div class="text-[10px] text-slate-400">
                                        {{ $reg->created_at ? $reg->created_at->format('M j, Y h:i A') : '' }}
                                    </div>
                                </td>

                                {{-- Participant Info --}}
                                <td class="py-3 px-3">
                                    <div class="font-bold text-slate-900">{{ $reg->full_name }}</div>
                                    <div class="text-[11px] text-slate-500 flex flex-col">
                                        <a href="mailto:{{ $reg->email }}" class="hover:text-[#0085FF]">{{ $reg->email }}</a>
                                        <a href="tel:{{ $reg->phone }}" class="hover:text-[#0085FF]">{{ $reg->phone }}</a>
                                    </div>
                                    @if($reg->organization)
                                        <div class="text-[10px] text-slate-400 truncate max-w-[160px]">
                                            {{ $reg->organization }} @if($reg->designation) ({{ $reg->designation }}) @endif
                                        </div>
                                    @endif
                                </td>

                                {{-- Seminar & Participation Type --}}
                                <td class="py-3 px-3">
                                    <div class="font-semibold text-slate-800 line-clamp-1 max-w-[180px]" title="{{ $reg->seminar->title ?? 'N/A' }}">
                                        {{ $reg->seminar->title ?? 'N/A' }}
                                    </div>
                                    <div class="mt-1">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold
                                            {{ $reg->participation_type === 'online' ? 'bg-sky-100 text-sky-800' : 'bg-amber-100 text-amber-800' }}">
                                            {{ strtoupper($reg->participation_type) }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Transaction Info --}}
                                <td class="py-3 px-3 whitespace-nowrap">
                                    <div class="font-bold text-slate-900">
                                        Fee: ৳{{ number_format($reg->registration_fee, 0) }}
                                    </div>
                                    <div class="font-mono text-xs font-bold {{ $reg->transaction_id ? 'text-[#0085FF]' : 'text-slate-400' }}">
                                        {{ $reg->transaction_id ?: 'No TrxID' }}
                                    </div>
                                    @if($reg->verified_amount)
                                        <div class="text-[10px] text-emerald-600 font-bold">
                                            Verified: ৳{{ number_format($reg->verified_amount, 0) }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Payment Screenshot Evidence --}}
                                <td class="py-3 px-3 whitespace-nowrap">
                                    @if($reg->payment_screenshot)
                                        <a href="{{ $reg->payment_screenshot }}" target="_blank" class="block w-10 h-10 rounded-lg overflow-hidden border border-slate-200 hover:opacity-80 transition" title="Click to view payment proof">
                                            <img src="{{ $reg->payment_screenshot }}" alt="Receipt" class="w-full h-full object-cover">
                                        </a>
                                    @else
                                        <span class="text-[10px] text-slate-400 italic">None</span>
                                    @endif
                                </td>

                                {{-- Status Badges --}}
                                <td class="py-3 px-3 whitespace-nowrap">
                                    <div class="space-y-1">
                                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold
                                            @if($reg->payment_status === 'verified') bg-emerald-100 text-emerald-800
                                            @elseif($reg->payment_status === 'rejected') bg-red-100 text-red-800
                                            @else bg-amber-100 text-amber-800 @endif">
                                            PAY: {{ strtoupper($reg->payment_status) }}
                                        </span>
                                        <br>
                                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-semibold
                                            @if($reg->registration_status === 'confirmed') bg-emerald-50 text-emerald-700 border border-emerald-200
                                            @elseif($reg->registration_status === 'waitlisted') bg-blue-50 text-blue-700 border border-blue-200
                                            @elseif($reg->registration_status === 'cancelled') bg-slate-100 text-slate-500
                                            @else bg-amber-50 text-amber-700 border border-amber-200 @endif">
                                            REG: {{ strtoupper(str_replace('_', ' ', $reg->registration_status)) }}
                                        </span>
                                    </div>

                                    @if($reg->verified_at)
                                        <div class="text-[9px] text-slate-400 mt-1">
                                            by {{ $reg->verifier->name ?? 'Admin' }} ({{ $reg->verified_at->format('M j') }})
                                        </div>
                                    @endif
                                </td>

                                {{-- Verification Actions --}}
                                <td class="py-3 px-3 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        
                                        {{-- Verify Button --}}
                                        @if($reg->payment_status !== 'verified')
                                            <button type="button" onclick="openVerifyModal({{ $reg->id }}, '{{ addslashes($reg->full_name) }}', '{{ $reg->registration_reference }}', {{ $reg->registration_fee }}, '{{ $reg->transaction_id }}')" class="px-2.5 py-1 rounded bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] shadow-2xs transition">
                                                Verify ✓
                                            </button>
                                        @endif

                                        {{-- Reject Button --}}
                                        @if($reg->payment_status !== 'rejected')
                                            <button type="button" onclick="openRejectModal({{ $reg->id }}, '{{ addslashes($reg->full_name) }}', '{{ $reg->registration_reference }}')" class="px-2 py-1 rounded bg-slate-100 hover:bg-red-50 text-red-600 font-bold text-[11px] transition">
                                                Reject ✕
                                            </button>
                                        @endif

                                        {{-- Resend Confirmation Email --}}
                                        <form action="{{ route('admin.seminars.registrations.resend', $reg->id) }}" method="POST" class="inline" onsubmit="return confirm('Resend email to {{ $reg->email }}?')">
                                            @csrf
                                            <button type="submit" title="Resend Email to Participant" class="p-1 rounded text-slate-400 hover:text-[#0085FF]">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
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
                {{ $registrations->links() }}
            </div>
        @endif
    </div>

</div>

{{-- Payment Verify Modal --}}
<div id="verifyModal" class="fixed inset-0 z-50 bg-black/60 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
            <h3 class="font-bold text-sm text-[#00245A]">Verify bKash Payment & Confirm Seat</h3>
            <button type="button" onclick="closeVerifyModal()" class="text-slate-400 hover:text-slate-600 text-lg font-bold">&times;</button>
        </div>

        <form id="verifyForm" method="POST" action="">
            @csrf
            <div class="space-y-4">
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-xs">
                    <div class="text-slate-500">Participant: <strong class="text-slate-900" id="verifyParticipantName"></strong></div>
                    <div class="text-slate-500 mt-1">Ref: <strong class="font-mono text-[#00245A]" id="verifyReference"></strong></div>
                    <div class="text-slate-500 mt-1">Submitted TrxID: <strong class="font-mono text-[#0085FF]" id="verifyTrxId"></strong></div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Verified Received Amount (BDT) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="verified_amount" id="verifyAmountInput" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-bold focus:ring-2 focus:ring-[#0085FF]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Administrative Note / Statement Check</label>
                    <input type="text" name="admin_notes" placeholder="e.g. Matched in bKash statement at 18:32" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeVerifyModal()" class="px-4 py-2 rounded-lg bg-slate-100 text-slate-700 text-xs font-bold hover:bg-slate-200">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-xs">
                        Confirm & Send Verified Email
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Payment Reject Modal --}}
<div id="rejectModal" class="fixed inset-0 z-50 bg-black/60 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
            <h3 class="font-bold text-sm text-red-600">Reject Payment Submission</h3>
            <button type="button" onclick="closeRejectModal()" class="text-slate-400 hover:text-slate-600 text-lg font-bold">&times;</button>
        </div>

        <form id="rejectForm" method="POST" action="">
            @csrf
            <div class="space-y-4">
                <div class="p-3 rounded-xl bg-red-50 border border-red-100 text-xs text-red-900">
                    Rejecting payment for <strong id="rejectParticipantName"></strong> (<span id="rejectReference" class="font-mono"></span>). An email notification will be dispatched with your rejection reason.
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Rejection Reason <span class="text-red-500">*</span></label>
                    <textarea name="rejection_reason" rows="3" required placeholder="e.g. Transaction ID was not found in statement / Amount was incomplete..." class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-red-500"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Internal Note <span class="text-slate-400 font-normal">(Optional)</span></label>
                    <input type="text" name="admin_notes" placeholder="Internal notes for admin reference..." class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs">
                </div>

                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 rounded-lg bg-slate-100 text-slate-700 text-xs font-bold hover:bg-slate-200">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-xs font-bold shadow-xs">
                        Reject & Notify Participant
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function openVerifyModal(id, name, ref, fee, trx) {
    document.getElementById('verifyParticipantName').innerText = name;
    document.getElementById('verifyReference').innerText = ref;
    document.getElementById('verifyTrxId').innerText = trx || 'None provided';
    document.getElementById('verifyAmountInput').value = fee;
    document.getElementById('verifyForm').action = "/admin/seminars-registrations/" + id + "/verify";
    document.getElementById('verifyModal').classList.remove('hidden');
    document.getElementById('verifyModal').classList.add('flex');
}
function closeVerifyModal() {
    document.getElementById('verifyModal').classList.remove('flex');
    document.getElementById('verifyModal').classList.add('hidden');
}

function openRejectModal(id, name, ref) {
    document.getElementById('rejectParticipantName').innerText = name;
    document.getElementById('rejectReference').innerText = ref;
    document.getElementById('rejectForm').action = "/admin/seminars-registrations/" + id + "/reject";
    document.getElementById('rejectModal').classList.remove('hidden');
    document.getElementById('rejectModal').classList.add('flex');
}
function closeRejectModal() {
    document.getElementById('rejectModal').classList.remove('flex');
    document.getElementById('rejectModal').classList.add('hidden');
}
</script>
@endsection
