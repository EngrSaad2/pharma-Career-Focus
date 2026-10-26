@extends('layouts.dashboard')

@section('title', 'My Consultation Bookings - Pharma Career Compass')

@section('dashboard_content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">My Consultation Bookings</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Review scheduled 1-on-1 career guidance sessions with pharmaceutical industry consultants</p>
        </div>
        <a href="{{ route('consultation.book') }}" class="px-4 py-2.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider shadow-sm hover:bg-blue-600">
            Book New Session
        </a>
    </div>

    @if($bookings->count() > 0)
        <div class="space-y-4">
            @foreach($bookings as $booking)
                <div class="bg-white p-6 sm:p-7 rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ $booking->status === 'confirmed' ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-amber-100 text-amber-800 border border-amber-300' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                            <span class="text-xs font-semibold text-slate-500">Ref: {{ $booking->booking_reference }}</span>
                        </div>

                        <h3 class="text-lg font-extrabold text-[#00245A]">{{ $booking->service->title ?? 'Career Consultation' }}</h3>

                        <div class="flex flex-wrap items-center gap-4 text-xs text-slate-600 pt-1">
                            <span>📅 <strong>{{ $booking->booking_date->format('l, F d, Y') }}</strong></span>
                            <span>⏰ <strong>{{ date('h:i A', strtotime($booking->start_time)) }} - {{ date('h:i A', strtotime($booking->end_time)) }}</strong></span>
                            <span>👤 Consultant: <strong>{{ $booking->consultant->name ?? 'Advisor' }}</strong> ({{ $booking->consultant->current_company ?? 'Industry Expert' }})</span>
                        </div>

                        @if($booking->notes)
                            <p class="text-xs text-slate-600 bg-slate-50 p-2.5 rounded-lg border border-slate-200 mt-2">
                                <em>Discussion topics:</em> {{ $booking->notes }}
                            </p>
                        @endif
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                        @if($booking->meeting_link && $booking->status !== 'cancelled')
                            <a href="{{ $booking->meeting_link }}" target="_blank"
                               class="w-full sm:w-auto text-center px-4 py-2.5 rounded-lg bg-[#0085FF] text-white font-bold text-xs uppercase tracking-wider shadow-sm hover:bg-blue-600">
                                Join Video Call
                            </a>
                        @endif

                        @if($booking->status !== 'cancelled')
                            <form action="{{ route('consultation.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" class="w-full sm:w-auto text-center px-3.5 py-2.5 rounded-lg bg-red-50 text-red-700 font-bold text-xs uppercase tracking-wider border border-red-300 hover:bg-red-100">
                                    Cancel
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $bookings->links() }}
        </div>
    @else
        <div class="bg-white p-12 rounded-2xl border border-slate-200 shadow-sm text-center max-w-lg mx-auto">
            <svg class="w-16 h-16 text-[#0085FF] mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <h3 class="text-xl font-extrabold text-[#00245A] mb-2">No Scheduled Sessions</h3>
            <p class="text-xs text-slate-500 leading-relaxed mb-6">
                Consult with experienced pharmaceutical quality managers, production heads, and regulatory specialists.
            </p>
            <a href="{{ route('consultation.book') }}" class="px-6 py-3 rounded-lg bg-[#0085FF] text-white font-bold text-xs uppercase tracking-wider shadow-sm hover:bg-blue-600">
                Book a Consultation
            </a>
        </div>
    @endif
</div>
@endsection
