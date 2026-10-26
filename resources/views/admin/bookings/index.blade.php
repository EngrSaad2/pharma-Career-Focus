@extends('layouts.admin')

@section('title', 'Manage Bookings - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Consultation Bookings Management</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Review, approve, update video meeting links, and manage candidate consultation statuses</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] overflow-hidden">
        @if($bookings->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-[#00245A]">
                    <thead class="bg-[#F4F9FF] border-b border-[#00245A]/15 text-xs font-bold uppercase tracking-wider text-[#00245A]/70">
                        <tr>
                            <th class="px-6 py-4">Ref / Candidate</th>
                            <th class="px-6 py-4">Consultant & Service</th>
                            <th class="px-6 py-4">Schedule</th>
                            <th class="px-6 py-4">Meeting Link & Status</th>
                            <th class="px-6 py-4 text-right">Update</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($bookings as $bk)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <span class="text-xs font-bold font-mono text-[#0085FF] block">{{ $bk->booking_reference }}</span>
                                    <strong class="font-bold text-sm text-[#00245A]">{{ $bk->user->name ?? 'Candidate' }}</strong>
                                    <span class="text-xs text-[#00245A]/60 block">{{ $bk->user->email ?? '' }}</span>
                                    @if($bk->notes)
                                        <p class="text-[11px] text-[#00245A]/70 mt-1 bg-slate-100 p-1.5 rounded">Note: {{ $bk->notes }}</p>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <strong class="font-bold text-xs text-[#00245A] block">{{ $bk->consultant->name ?? 'N/A' }}</strong>
                                    <span class="text-xs text-[#00245A]/70 block">{{ $bk->service->title ?? 'Consultation' }}</span>
                                    <span class="text-[11px] font-semibold text-[#0085FF]">BDT {{ number_format($bk->service->price_bdt ?? 0) }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    <strong class="font-bold text-xs text-[#00245A] block">{{ $bk->booking_date->format('M d, Y') }}</strong>
                                    <span class="text-xs text-[#00245A]/70">{{ date('h:i A', strtotime($bk->start_time)) }} - {{ date('h:i A', strtotime($bk->end_time)) }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.bookings.update', $bk->id) }}" method="POST" class="space-y-2">
                                        @csrf
                                        <select name="status" class="w-full text-xs font-bold rounded border border-[#00245A] px-2 py-1 bg-white">
                                            <option value="pending" {{ $bk->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $bk->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="completed" {{ $bk->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $bk->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <input type="url" name="meeting_link" value="{{ $bk->meeting_link }}" placeholder="https://meet.google.com/..."
                                               class="w-full text-xs rounded border border-[#00245A]/30 px-2 py-1">
                                </td>

                                <td class="px-6 py-4 text-right">
                                        <button type="submit" class="px-3 py-1.5 rounded bg-[#0085FF] text-white font-bold text-xs uppercase hover:bg-blue-600 border border-[#00245A]">
                                            Save
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-[#00245A]/10">
                {{ $bookings->links() }}
            </div>
        @else
            <div class="p-12 text-center text-xs text-[#00245A]/60">
                No consultation bookings yet.
            </div>
        @endif
    </div>
</div>
@endsection
