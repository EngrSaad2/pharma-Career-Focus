@extends('layouts.admin')

@section('title', 'Manage Bookings - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8">
    <!-- Print Only Header -->
    <div class="hidden print-only mb-6">
        <div class="flex items-center justify-between border-b-2 border-[#00245A] pb-3 mb-3">
            <div>
                <h1 class="text-xl font-black text-[#00245A]">Pharma Career Compass</h1>
                <p class="text-xs text-slate-600">Consultation Bookings Master Schedule Report</p>
            </div>
            <div class="text-right text-xs text-slate-600">
                <p class="font-bold">Printed: {{ now()->format('M d, Y h:i A') }}</p>
                <p>Total Bookings: {{ $bookings->total() }}</p>
            </div>
        </div>
    </div>

    <!-- Screen Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Consultation Bookings Management</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Review, approve, update video meeting links, and manage candidate consultation statuses</p>
        </div>
        <div class="flex items-center gap-2 no-print">
            <button type="button" onclick="window.print()"
                    class="px-4 py-2.5 rounded-lg bg-white border border-[#00245A]/20 text-[#00245A] text-xs font-bold hover:bg-slate-50 flex items-center gap-2 shadow-sm transition">
                <svg class="w-4 h-4 text-[#00245A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Print Schedule / PDF</span>
            </button>
        </div>
    </div>

    <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] overflow-hidden">
        @if($bookings->count() > 0)
            <div class="p-4 bg-[#F4F9FF] border-b border-[#00245A]/10 flex items-center justify-between no-print">
                <span class="text-xs font-bold text-[#00245A]">Total Bookings: {{ $bookings->total() }}</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-[#00245A]">
                    <thead class="bg-[#F4F9FF] border-b border-[#00245A]/15 text-xs font-bold uppercase tracking-wider text-[#00245A]/70">
                        <tr>
                            <th class="px-6 py-4">Candidate</th>
                            <th class="px-6 py-4">Consultant & Service</th>
                            <th class="px-6 py-4">Schedule</th>
                            <th class="px-6 py-4">Meeting Link & Status</th>
                            <th class="px-6 py-4 text-right no-print">Update</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($bookings as $bk)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 align-top">
                                    <strong class="font-black text-sm text-[#00245A] block">
                                        {{ $bk->client_name ?: ($bk->user->name ?? 'Candidate') }}
                                    </strong>
                                    <a href="mailto:{{ $bk->client_email ?: ($bk->user->email ?? '') }}" class="text-xs text-[#0085FF] hover:underline block">
                                        {{ $bk->client_email ?: ($bk->user->email ?? 'N/A') }}
                                    </a>
                                    @if($bk->client_phone ?: ($bk->user->phone ?? null))
                                        <span class="text-[11px] text-[#00245A]/70 block font-mono">
                                            ☎ {{ $bk->client_phone ?: $bk->user->phone }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 align-top">
                                    <strong class="font-bold text-xs text-[#00245A] block">{{ $bk->consultant->name ?? 'Senior Consultant' }}</strong>
                                    <span class="text-xs text-[#00245A]/80 block">{{ $bk->service->title ?? 'Consultation Session' }}</span>
                                    <span class="text-[11px] font-bold text-[#0085FF]">
                                        ৳{{ number_format($bk->service->price ?? 0, 0) }} BDT
                                    </span>
                                </td>

                                <td class="px-6 py-4 align-top">
                                    <strong class="font-bold text-xs text-[#00245A] block">
                                        {{ $bk->booking_date ? $bk->booking_date->format('M d, Y') : 'Date N/A' }}
                                    </strong>
                                    <span class="text-xs text-[#00245A]/70 block">
                                        {{ date('h:i A', strtotime($bk->start_time)) }} - {{ date('h:i A', strtotime($bk->end_time)) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 align-top">
                                    <!-- Print representation -->
                                    <div class="hidden print-only space-y-1">
                                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-black uppercase border border-slate-400">
                                            {{ strtoupper($bk->status) }}
                                        </span>
                                        @if($bk->meeting_link)
                                            <p class="text-[10px] text-blue-700 break-all">{{ $bk->meeting_link }}</p>
                                        @else
                                            <p class="text-[10px] text-slate-400">No link assigned</p>
                                        @endif
                                    </div>

                                    <!-- Interactive screen representation -->
                                    <form action="{{ route('admin.bookings.update', $bk->id) }}" method="POST" class="space-y-2 no-print">
                                        @csrf
                                        <select name="status" class="w-full text-xs font-bold rounded border border-[#00245A] px-2 py-1.5 bg-white">
                                            <option value="pending" {{ $bk->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $bk->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="completed" {{ $bk->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $bk->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <input type="url" name="meeting_link" value="{{ $bk->meeting_link }}" placeholder="https://meet.jit.si/... or Google Meet"
                                               class="w-full text-xs rounded border border-[#00245A]/30 px-2 py-1">
                                </td>

                                <td class="px-6 py-4 text-right align-top no-print">
                                        <button type="submit" class="px-3.5 py-1.5 rounded bg-[#0085FF] text-white font-black text-xs uppercase hover:bg-blue-600 border border-[#00245A] transition shadow-sm">
                                            Save
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($bookings->hasPages())
                <div class="p-6 border-t border-[#00245A]/10 no-print">
                    {{ $bookings->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center text-xs text-[#00245A]/60">
                No consultation bookings yet.
            </div>
        @endif
    </div>
</div>
@endsection
