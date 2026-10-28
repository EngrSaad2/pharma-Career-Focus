@extends('layouts.app')

@section('title', 'Official Seminar Ticket - ' . $registration->registration_reference . ' | Pharma Career Compass')

@push('styles')
<style>
@media print {
    @page {
        size: A4 portrait;
        margin: 10mm 12mm;
    }
    html, body {
        background: #ffffff !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    header, footer, nav, .animate-marquee, #mobile-menu, [role="navigation"], .no-print {
        display: none !important;
    }
    .print-full-width {
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .ticket-container {
        border: 2px solid #00245A !important;
        box-shadow: none !important;
        page-break-inside: avoid !important;
        break-inside: avoid !important;
        margin: 0 auto !important;
        border-radius: 16px !important;
        background: #ffffff !important;
    }
    .notch {
        display: none !important;
    }
}
</style>
@endpush

@section('content')
<div class="bg-gradient-to-b from-[#00245A]/5 via-white to-slate-50 min-h-screen py-8 sm:py-12 print:bg-white print:py-0 print:min-h-0">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 print-full-width">

        {{-- Screen Top Action Header --}}
        <div class="flex items-center justify-between gap-4 mb-6 no-print print:hidden">
            <a href="{{ route('seminars.index') }}" class="text-xs font-bold text-slate-600 hover:text-[#0085FF] flex items-center gap-1.5 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Back to Seminars</span>
            </a>
            <div class="flex items-center gap-2">
                <button type="button" onclick="window.print()" class="px-4 py-2.5 rounded-xl bg-[#00245A] hover:bg-[#00173B] text-white font-bold text-xs flex items-center gap-2 shadow-sm transition-all hover:shadow-md cursor-pointer">
                    <svg class="w-4 h-4 text-[#FFCD00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    <span>Print / Save Ticket (PDF)</span>
                </button>
            </div>
        </div>

        {{-- Screen Flash Feedback --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm font-semibold flex items-center gap-3 shadow-xs no-print print:hidden">
                <span class="text-xl">✓</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        {{-- Sibling / Dual Module Enrollment Banner --}}
        @if(isset($siblingRegistrations) && $siblingRegistrations->isNotEmpty())
            <div class="mb-6 p-5 rounded-2xl bg-blue-50 border border-blue-200 text-[#00245A] shadow-xs no-print print:hidden">
                <div class="flex items-center gap-2 font-black text-sm mb-2 text-[#0085FF]">
                    <span>✨</span>
                    <span>2-Module Track Enrollment Detected</span>
                </div>
                <p class="text-xs text-slate-600 mb-3 leading-relaxed">
                    You have reserved seats for both modules in this session series! Click below to access your companion admission pass:
                </p>
                <div class="space-y-2">
                    @foreach($siblingRegistrations as $sibling)
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3 bg-white rounded-xl border border-blue-100 shadow-2xs">
                            <div>
                                <span class="text-xs font-bold text-[#00245A] block">{{ $sibling->seminar->title }}</span>
                                <span class="text-[11px] text-slate-500 font-medium">
                                    {{ $sibling->seminar->event_date ? $sibling->seminar->event_date->format('l, F j, Y') : '' }} • Ref: <span class="font-mono font-bold text-slate-700">{{ $sibling->registration_reference }}</span>
                                </span>
                            </div>
                            <a href="{{ route('seminars.confirmation', $sibling->registration_reference) }}" class="btn-primary text-xs py-1.5 px-3 whitespace-nowrap self-start sm:self-auto font-bold">
                                View Module Ticket &rarr;
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ========================================================================= --}}
        {{-- OFFICIAL SEMINAR TICKET / ADMISSION PASS (PRINTABLE & SCREEN) --}}
        {{-- ========================================================================= --}}
        <div class="ticket-container bg-white rounded-3xl border-2 border-slate-200 shadow-xl overflow-hidden relative print:rounded-xl">

            {{-- Ticket Header Band --}}
            <div class="p-6 sm:p-7 text-white
                @if($registration->payment_status === 'verified') bg-gradient-to-r from-[#00245A] via-[#004085] to-[#059669]
                @elseif($registration->payment_status === 'rejected') bg-gradient-to-r from-[#00245A] via-[#991b1b] to-[#dc2626]
                @else bg-gradient-to-r from-[#00245A] via-[#003875] to-[#0085FF] @endif border-b border-white/10">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    {{-- Brand & Ticket Label --}}
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-xs p-2 flex items-center justify-center border border-white/20 shrink-0">
                            <svg class="w-full h-full text-white" viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="2.5"/>
                                <polygon points="24,24 22,25 29,11 25,22" fill="#FFCD00"/>
                                <polygon points="24,24 26,23 19,37 23,26" fill="#FFFFFF"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] font-extrabold uppercase tracking-widest text-[#FFCD00]">
                                Pharma Career Compass • Official Event Pass
                            </div>
                            <h1 class="text-xl sm:text-2xl font-black tracking-tight text-white">
                                Seminar Admission Ticket
                            </h1>
                        </div>
                    </div>

                    {{-- Pass ID & Status Stamp --}}
                    <div class="sm:text-right flex sm:flex-col items-center sm:items-end justify-between gap-2">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-white/70 block">Ticket Reference</span>
                            <span class="font-mono font-black text-lg sm:text-xl text-[#FFCD00] tracking-wider">
                                {{ $registration->registration_reference }}
                            </span>
                        </div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider
                            @if($registration->payment_status === 'verified') bg-emerald-400 text-emerald-950
                            @elseif($registration->registration_status === 'waitlisted') bg-sky-300 text-sky-950
                            @elseif($registration->payment_status === 'rejected') bg-red-400 text-red-950
                            @else bg-[#FFCD00] text-[#00245A] @endif">
                            @if($registration->payment_status === 'verified')
                                ✓ Seat Guaranteed
                            @elseif($registration->registration_status === 'waitlisted')
                                ⏳ Priority Waitlist
                            @elseif($registration->payment_status === 'rejected')
                                ⚠️ Payment Issue
                            @else
                                ⏳ Payment Pending
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Ticket Body --}}
            <div class="p-6 sm:p-7 space-y-5">

                {{-- Seminar Title & Mode Badges --}}
                <div class="border-b border-slate-100 pb-5">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider
                            @if($seminar->participation_type === 'online') bg-sky-100 text-sky-800
                            @elseif($seminar->participation_type === 'offline') bg-amber-100 text-amber-800
                            @else bg-emerald-100 text-emerald-800 @endif">
                            {{ strtoupper($seminar->participation_type) }} ADMISSION
                        </span>
                        @if($seminar->category)
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-700">
                                {{ $seminar->category }}
                            </span>
                        @endif
                    </div>
                    <h2 class="text-xl sm:text-2xl font-black text-[#00245A] leading-tight">
                        {{ $seminar->title }}
                    </h2>
                </div>

                {{-- Key Logistics 3-Column Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    {{-- Date & Time --}}
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-[#0085FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>Scheduled Date & Time</span>
                        </div>
                        <div class="text-xs font-bold text-slate-800">
                            {{ $seminar->event_date ? $seminar->event_date->format('l, F j, Y') : 'Date TBA' }}
                        </div>
                        <div class="text-xs font-semibold text-[#0085FF] mt-0.5">
                            {{ $seminar->start_time ? \Carbon\Carbon::parse($seminar->start_time)->format('h:i A') : '' }}
                            @if($seminar->end_time) - {{ \Carbon\Carbon::parse($seminar->end_time)->format('h:i A') }} @endif (BST)
                        </div>
                    </div>

                    {{-- Speaker (Full Name, Qualification under name, no dot) --}}
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-[#0085FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span>Lead Speaker</span>
                        </div>
                        <div class="text-xs font-bold text-slate-900 leading-snug">
                            {{ $seminar->speaker_name ?: 'Pharma Career Specialist' }}
                        </div>
                        @if($seminar->speaker_designation)
                            <div class="text-[11px] text-slate-500 font-medium leading-normal mt-0.5">
                                {{ $seminar->speaker_designation }}
                            </div>
                        @endif
                    </div>

                    {{-- Venue / Mode --}}
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-[#0085FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Session Location</span>
                        </div>
                        @if($registration->participation_type === 'online')
                            <div class="text-xs font-bold text-sky-800">
                                🌐 Online Live Interactive Stream
                            </div>
                            <div class="text-[11px] text-slate-500 mt-0.5">
                                Access Link dispatched via email & portal
                            </div>
                        @else
                            <div class="text-xs font-bold text-amber-800">
                                🏢 In-Person Attendance Desk
                            </div>
                            <div class="text-[11px] text-slate-600 mt-0.5 line-clamp-2">
                                {{ $seminar->venue_address ?: 'Pharma Career Center, Gulshan-1, Dhaka' }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Participant Credentials Strip --}}
                <div class="p-4 rounded-2xl bg-blue-50/50 border border-blue-100/80">
                    <div class="text-[10px] font-bold uppercase tracking-wider text-[#00245A]/70 mb-2">
                        Registered Attendee Details
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                        <div>
                            <span class="text-slate-400 block text-[10px]">Attendee Name</span>
                            <strong class="text-slate-900 font-bold block">{{ $registration->full_name }}</strong>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[10px]">Email Address</span>
                            <strong class="text-slate-800 font-bold block truncate">{{ $registration->email }}</strong>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[10px]">Contact Mobile</span>
                            <strong class="text-slate-800 font-bold block">{{ $registration->phone }}</strong>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[10px]">Registration Fee</span>
                            <strong class="text-emerald-700 font-bold block">৳{{ number_format($registration->registration_fee, 0) }} BDT</strong>
                            <span class="text-[10px] font-mono text-slate-500">TrxID: {{ $registration->transaction_id ?: 'Pending' }}</span>
                        </div>
                        @if($registration->organization)
                            <div class="col-span-2 sm:col-span-4 pt-1 border-t border-blue-100/50 text-[11px] text-slate-600">
                                <span class="text-slate-400">Affiliation:</span> <strong class="text-slate-800">{{ $registration->organization }}</strong>
                                @if($registration->designation) ({{ $registration->designation }}) @endif
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- Perforated Ticket Notches & Cut Divider --}}
            <div class="relative py-2 select-none">
                {{-- Left Cutout Notch --}}
                <div class="notch absolute -left-3.5 top-1/2 -translate-y-1/2 w-7 h-7 rounded-full bg-slate-100 border border-slate-300 shadow-inner z-10 print:hidden"></div>
                
                {{-- Dashed Cut Line --}}
                <div class="border-t-2 border-dashed border-slate-300 mx-5 relative flex items-center justify-center">
                    <span class="bg-white px-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest flex items-center gap-1.5 -top-2 relative">
                        <span>✂</span>
                        <span>Official Admission Pass & Verification Stub</span>
                        <span>✂</span>
                    </span>
                </div>

                {{-- Right Cutout Notch --}}
                <div class="notch absolute -right-3.5 top-1/2 -translate-y-1/2 w-7 h-7 rounded-full bg-slate-100 border border-slate-300 shadow-inner z-10 print:hidden"></div>
            </div>

            {{-- Ticket Stub Bottom Section (Barcode, QR Code & Security Notice) --}}
            <div class="p-6 sm:p-7 bg-slate-50/70 border-t border-slate-100">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-5">
                    
                    {{-- QR Code + Barcode --}}
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 sm:w-22 sm:h-22 bg-white p-1.5 rounded-xl border border-slate-200 shadow-xs shrink-0 flex items-center justify-center">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=140x140&data={{ urlencode(route('seminars.confirmation', $registration->registration_reference)) }}" 
                                 alt="Verification QR" 
                                 class="w-full h-full object-contain"
                                 loading="lazy">
                        </div>

                        <div class="flex flex-col">
                            {{-- Stylized SVG Barcode --}}
                            <svg class="h-9 w-40 text-slate-800" viewBox="0 0 170 35" fill="currentColor">
                                <rect x="0" y="0" width="3" height="35"/>
                                <rect x="5" y="0" width="1" height="35"/>
                                <rect x="8" y="0" width="4" height="35"/>
                                <rect x="14" y="0" width="2" height="35"/>
                                <rect x="18" y="0" width="1" height="35"/>
                                <rect x="21" y="0" width="3" height="35"/>
                                <rect x="26" y="0" width="5" height="35"/>
                                <rect x="33" y="0" width="2" height="35"/>
                                <rect x="37" y="0" width="1" height="35"/>
                                <rect x="40" y="0" width="4" height="35"/>
                                <rect x="46" y="0" width="2" height="35"/>
                                <rect x="50" y="0" width="3" height="35"/>
                                <rect x="55" y="0" width="1" height="35"/>
                                <rect x="58" y="0" width="4" height="35"/>
                                <rect x="64" y="0" width="2" height="35"/>
                                <rect x="68" y="0" width="5" height="35"/>
                                <rect x="75" y="0" width="1" height="35"/>
                                <rect x="78" y="0" width="3" height="35"/>
                                <rect x="83" y="0" width="2" height="35"/>
                                <rect x="87" y="0" width="4" height="35"/>
                                <rect x="93" y="0" width="1" height="35"/>
                                <rect x="96" y="0" width="5" height="35"/>
                                <rect x="103" y="0" width="2" height="35"/>
                                <rect x="107" y="0" width="3" height="35"/>
                                <rect x="112" y="0" width="1" height="35"/>
                                <rect x="115" y="0" width="4" height="35"/>
                                <rect x="121" y="0" width="2" height="35"/>
                                <rect x="125" y="0" width="5" height="35"/>
                                <rect x="132" y="0" width="1" height="35"/>
                                <rect x="135" y="0" width="3" height="35"/>
                                <rect x="140" y="0" width="2" height="35"/>
                                <rect x="144" y="0" width="4" height="35"/>
                                <rect x="150" y="0" width="1" height="35"/>
                                <rect x="153" y="0" width="4" height="35"/>
                                <rect x="160" y="0" width="2" height="35"/>
                                <rect x="165" y="0" width="3" height="35"/>
                            </svg>
                            <span class="font-mono text-[10px] font-bold text-slate-700 tracking-wider mt-0.5">
                                * {{ $registration->registration_reference }} *
                            </span>
                        </div>
                    </div>

                    {{-- Security Terms & Verification Notice --}}
                    <div class="flex-1 text-left sm:text-right text-[10px] text-slate-500 leading-relaxed border-t sm:border-t-0 border-slate-200 pt-3 sm:pt-0">
                        <div class="font-bold text-slate-800 uppercase tracking-wider text-[11px] mb-1">
                            Pharma Career Compass Verification System
                        </div>
                        <p>
                            • Present this pass (printed or digital) at attendance check-in.
                        </p>
                        <p>
                            • Seat is reserved solely for the designated attendee. Non-transferable.
                        </p>
                        <p class="font-medium text-slate-600 mt-1">
                            Direct Support: <a href="mailto:info@pharmacareercompass.com" class="text-[#0085FF]">info@pharmacareercompass.com</a> • +880 1844 567890
                        </p>
                    </div>

                </div>
            </div>

        </div>
        {{-- ========================================================================= --}}
        {{-- END OF PRINTABLE TICKET --}}
        {{-- ========================================================================= --}}

        {{-- ========================================================================= --}}
        {{-- SCREEN-ONLY LOGISTICS & ACTION MODULES (HIDDEN IN PRINT) --}}
        {{-- ========================================================================= --}}
        <div class="mt-8 space-y-6 no-print print:hidden">

            {{-- Verified Online Session Direct Action --}}
            @if($registration->payment_status === 'verified')
                @if($registration->participation_type === 'online')
                    <div class="p-6 rounded-3xl bg-white border border-sky-200 shadow-sm">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="w-8 h-8 rounded-xl bg-sky-500 text-white flex items-center justify-center font-bold text-sm">🌐</span>
                            <h3 class="text-base font-bold text-sky-950">Live Online Session Joining Access</h3>
                        </div>
                        @if($seminar->meeting_url)
                            <div class="mb-4">
                                <a href="{{ $seminar->meeting_url }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs shadow-sm transition-all hover:shadow">
                                    <span>Click Here to Join Live Session</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            </div>
                            <div class="text-xs text-slate-500 break-all mb-2">
                                Direct Meeting Link: <a href="{{ $seminar->meeting_url }}" class="text-sky-700 underline font-medium">{{ $seminar->meeting_url }}</a>
                            </div>
                        @else
                            <p class="text-xs text-slate-600 mb-2">
                                The direct live stream meeting link will be dispatched to <strong>{{ $registration->email }}</strong> two hours before the session start time.
                            </p>
                        @endif

                        @if($seminar->joining_instructions)
                            <div class="text-xs text-slate-700 leading-relaxed pt-3 border-t border-sky-100">
                                <strong class="text-slate-900 block mb-1">Joining Instructions:</strong>
                                {!! nl2br(e($seminar->joining_instructions)) !!}
                            </div>
                        @endif
                    </div>
                @else
                    <div class="p-6 rounded-3xl bg-white border border-amber-200 shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-8 h-8 rounded-xl bg-amber-500 text-white flex items-center justify-center font-bold text-sm">🏢</span>
                            <h3 class="text-base font-bold text-amber-950">In-Person Venue & Arrival Instructions</h3>
                        </div>
                        <div class="text-xs sm:text-sm font-bold text-slate-800 mb-1">
                            {{ $seminar->venue_address ?: 'Pharma Career Compass Corporate Learning Center, Dhaka, Bangladesh' }}
                        </div>
                        <p class="text-xs text-slate-600 mb-3">
                            Please show this ticket pass (printed or digital) at the registration desk 15 minutes before the session starts.
                        </p>
                        @if($seminar->joining_instructions)
                            <div class="text-xs text-slate-700 leading-relaxed pt-3 border-t border-amber-100">
                                <strong class="text-slate-900 block mb-1">Arrival Guidelines:</strong>
                                {!! nl2br(e($seminar->joining_instructions)) !!}
                            </div>
                        @endif
                    </div>
                @endif
            @else
                {{-- Payment / Transaction Submission Guidance --}}
                <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-sm text-xs text-slate-600 space-y-3">
                    <div class="flex items-center gap-2 text-sm font-bold text-[#00245A]">
                        <span class="text-base">💳</span>
                        <span>Need to complete or update your registration payment?</span>
                    </div>
                    <p class="leading-relaxed">
                        If you haven't completed the registration fee payment of <strong>৳{{ number_format($registration->registration_fee, 0) }} BDT</strong> yet, please Send Money to bKash Personal Number: <strong class="text-slate-900 font-mono text-sm px-2 py-0.5 rounded bg-slate-100">{{ $defaultBkashNumber }}</strong>.
                    </p>
                    <p class="leading-relaxed">
                        Once sent, message your <strong>Transaction ID</strong> and Pass Reference <strong class="text-[#0085FF] font-mono">{{ $registration->registration_reference }}</strong> to <a href="mailto:hello@pharmacareercompass.com" class="text-[#0085FF] font-semibold underline">hello@pharmacareercompass.com</a> or WhatsApp <strong>+880 1722 531335</strong>.
                    </p>
                </div>
            @endif

            {{-- Event Updates Link --}}
            @if($seminar->facebook_url)
                <div class="text-center pt-2">
                    <a href="{{ $seminar->facebook_url }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1877f2] hover:underline">
                        <span>Follow Live Seminar Discussion on Facebook →</span>
                    </a>
                </div>
            @endif

        </div>

    </div>
</div>
@endsection
