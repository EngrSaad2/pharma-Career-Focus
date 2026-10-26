@extends('layouts.app')

@section('title', 'Consultation Confirmed | Pharma Career Compass')

@section('content')
<section class="py-16 md:py-24 bg-white">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        
        <!-- Confirmation Card -->
        <div class="bg-white rounded-2xl border border-slate-200 p-8 sm:p-12 shadow-sm text-left space-y-6">
            
            <div class="flex items-center gap-3 pb-6 border-b border-slate-100">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-2xl">
                    &check;
                </div>
                <div>
                    <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Consultation Confirmed</span>
                    <h1 class="text-2xl font-extrabold text-[#00245A]">Your Session Is Scheduled!</h1>
                </div>
            </div>

            <div class="bg-slate-50 rounded-xl p-5 border border-slate-200/80 space-y-3 text-xs sm:text-sm">
                <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium">Consultant:</span>
                    <span class="font-bold text-[#00245A]">{{ $booking->consultant->name }}</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium">Service Focus:</span>
                    <span class="font-bold text-[#0085FF]">{{ $booking->service->title }}</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium">Date:</span>
                    <span class="font-bold text-slate-800">{{ $booking->booking_date->format('l, F j, Y') }}</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium">Time Slot:</span>
                    <span class="font-bold text-slate-800">{{ date('h:i A', strtotime($booking->start_time)) }} - {{ date('h:i A', strtotime($booking->end_time)) }} (BST)</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium">Session Fee:</span>
                    <span class="font-bold text-[#0085FF]">{{ $booking->service->price == 0 ? 'Complimentary (Free)' : '৳' . number_format($booking->service->price, 0) . ' BDT' }}</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium">Candidate Name:</span>
                    <span class="font-semibold text-slate-800">{{ $booking->client_name }}</span>
                </div>
                <div class="flex justify-between items-center py-1">
                    <span class="text-slate-500 font-medium">Booking ID:</span>
                    <span class="font-mono text-slate-600">#PCC-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>

            @if($booking->service->price > 0)
                <!-- Bangladeshi Payment Verification Box -->
                <div class="p-5 rounded-xl bg-emerald-50 border border-emerald-200 space-y-2 text-left">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-xs uppercase tracking-wider text-emerald-800">Payment Verification (৳{{ number_format($booking->service->price, 0) }} BDT)</span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-emerald-200/60 text-emerald-900">Pending Payment</span>
                    </div>
                    <p class="text-xs text-slate-700 leading-relaxed">
                        Please complete your payment via <strong>bKash: 01844-567890</strong> or <strong>Nagad: 01711-223344</strong> (Reference: <strong class="font-mono">PCC-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</strong>). Our coordinator will verify the transaction and confirm your slot via SMS/WhatsApp.
                    </p>
                </div>
            @endif

            <!-- Virtual Meeting Link Box -->
            <div class="p-5 rounded-xl bg-blue-50 border border-blue-200 space-y-2">
                <div class="font-bold text-xs uppercase tracking-wider text-[#0085FF]">Live Online Video Meeting</div>
                <p class="text-xs text-slate-600">
                    Your session will be hosted via our secure video room. Click below at your scheduled time or save the link:
                </p>
                <div class="pt-2 flex flex-col sm:flex-row items-center gap-3">
                    <a href="{{ $booking->meeting_link }}" target="_blank" rel="noopener noreferrer" class="btn-primary text-xs py-2 px-4 shadow-sm hover:shadow w-full sm:w-auto text-center">
                        Launch Video Meeting Room &rarr;
                    </a>
                    <span class="text-[11px] text-slate-500 font-mono select-all truncate max-w-xs">
                        {{ $booking->meeting_link }}
                    </span>
                </div>
            </div>

            <!-- Preparation Advice -->
            <div class="space-y-2 text-xs text-slate-600">
                <div class="font-bold text-slate-800 text-xs">How to Prepare for Your Consultation:</div>
                <ul class="list-disc list-inside space-y-1 text-slate-500">
                    <li>Have your current CV or academic transcript ready to screen-share.</li>
                    <li>Write down 2-3 specific questions regarding your target pharmaceutical department.</li>
                    <li>Ensure you are in a quiet room with working audio/video.</li>
                </ul>
            </div>

            <!-- Actions -->
            <div class="pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
                <a href="{{ route('home') }}" class="btn-secondary text-xs py-2 px-4 shadow-sm hover:shadow">
                    &larr; Return to Home
                </a>

                @auth
                    <a href="{{ route('dashboard.bookings') }}" class="text-xs font-bold text-[#0085FF] hover:underline">
                        View All Bookings in Dashboard &rarr;
                    </a>
                @endauth
            </div>
        </div>

    </div>
</section>
@endsection
