@extends('layouts.app')

@section('title', 'Registration Status - ' . $registration->registration_reference . ' | Pharma Career Compass')

@section('content')
<div class="bg-gradient-to-b from-[#00245A]/5 via-white to-slate-50 min-h-screen py-10 sm:py-14 print:bg-white print:py-0">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm font-semibold flex items-center gap-3 shadow-xs print:hidden">
                <span class="text-xl">✓</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('info'))
            <div class="mb-6 p-4 rounded-2xl bg-blue-50 border border-blue-200 text-blue-800 text-xs sm:text-sm font-semibold flex items-center gap-3 shadow-xs print:hidden">
                <span class="text-xl">ℹ</span>
                <div>{{ session('info') }}</div>
            </div>
        @endif

        {{-- Print Action Header --}}
        <div class="flex items-center justify-between mb-6 print:hidden">
            <a href="{{ route('seminars.show', $seminar->slug) }}" class="text-xs font-bold text-slate-500 hover:text-[#0085FF] flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Back to Seminar Page</span>
            </a>
            <button type="button" onclick="window.print()" class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-xs flex items-center gap-2 shadow-xs transition-colors">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                <span>Print Official Pass</span>
            </button>
        </div>

        {{-- Official Registration Card --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-md overflow-hidden print:border-none print:shadow-none">

            {{-- Top Branding Banner --}}
            <div class="p-6 sm:p-8 text-white
                @if($registration->payment_status === 'verified') bg-gradient-to-r from-[#059669] to-[#0085FF]
                @elseif($registration->payment_status === 'rejected') bg-gradient-to-r from-[#dc2626] to-[#ea580c]
                @else bg-gradient-to-r from-[#00245A] to-[#0085FF] @endif">
                
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div class="text-[11px] font-bold uppercase tracking-wider text-[#FFCD00] mb-1">
                            Pharma Career Compass • Official Registration
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                            @if($registration->payment_status === 'verified')
                                ✓ Seat Confirmed & Pass Issued
                            @elseif($registration->registration_status === 'waitlisted')
                                ⏳ Priority Waitlist Entry
                            @elseif($registration->payment_status === 'rejected')
                                ⚠️ Payment Verification Issue
                            @else
                                ⏳ Payment Verification Pending
                            @endif
                        </h1>
                    </div>

                    <div class="sm:text-right">
                        <span class="text-[11px] text-white/80 block uppercase font-bold">Reference Number</span>
                        <span class="font-mono font-extrabold text-xl sm:text-2xl tracking-wider text-[#FFCD00]">
                            {{ $registration->registration_reference }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Status Banner Notice --}}
            @if($registration->payment_status === 'verified')
                <div class="bg-emerald-50 border-b border-emerald-100 p-4 sm:px-8 text-emerald-800 text-xs sm:text-sm font-medium flex items-center gap-3">
                    <span class="text-xl">🎉</span>
                    <div>
                        <strong>Payment Verified:</strong> Your registration fee of <strong>৳{{ number_format($registration->verified_amount ?: $registration->registration_fee, 2) }} BDT</strong> has been successfully verified. Your seat is guaranteed.
                    </div>
                </div>
            @elseif($registration->payment_status === 'rejected')
                <div class="bg-red-50 border-b border-red-100 p-4 sm:px-8 text-red-800 text-xs sm:text-sm font-medium">
                    <div class="font-bold mb-1">⚠️ Payment Notice:</div>
                    <div>
                        {{ $registration->rejection_reason ?: 'The transaction ID submitted could not be matched with our bKash statement. Please contact support or resubmit.' }}
                    </div>
                </div>
            @elseif($registration->registration_status === 'waitlisted')
                <div class="bg-blue-50 border-b border-blue-100 p-4 sm:px-8 text-blue-900 text-xs sm:text-sm font-medium">
                    You are on the priority waitlist for this session. You will be notified immediately once a seat becomes available.
                </div>
            @else
                <div class="bg-amber-50 border-b border-amber-100 p-4 sm:px-8 text-amber-900 text-xs sm:text-sm font-medium">
                    <strong>Awaiting Verification:</strong> Our administrative team verifies bKash transactions within a few hours. Once confirmed, you will receive an official confirmation email.
                </div>
            @endif

            {{-- Participant & Program Details Table --}}
            <div class="p-6 sm:p-8 space-y-6">

                <div>
                    <h2 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-3">Participant Credentials</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100 text-xs sm:text-sm">
                        <div>
                            <span class="text-slate-400 block text-xs">Participant Name</span>
                            <strong class="text-slate-800 font-bold">{{ $registration->full_name }}</strong>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-xs">Email Address</span>
                            <strong class="text-slate-800 font-bold">{{ $registration->email }}</strong>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-xs">Mobile Number</span>
                            <strong class="text-slate-800 font-bold">{{ $registration->phone }}</strong>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-xs">Participation Mode</span>
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold mt-0.5
                                {{ $registration->participation_type === 'online' ? 'bg-sky-100 text-sky-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ strtoupper($registration->participation_type) }}
                            </span>
                        </div>
                        @if($registration->organization)
                            <div class="sm:col-span-2">
                                <span class="text-slate-400 block text-xs">Affiliation</span>
                                <strong class="text-slate-800 font-bold">{{ $registration->organization }} @if($registration->designation) ({{ $registration->designation }}) @endif</strong>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Seminar Snapshot --}}
                <div>
                    <h2 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-3">Program Details</h2>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 text-xs sm:text-sm space-y-2.5">
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center pb-2 border-b border-slate-200/60">
                            <span class="text-slate-500 font-medium">Seminar:</span>
                            <strong class="text-[#00245A] font-bold sm:text-right">{{ $seminar->title }}</strong>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200/60">
                            <span class="text-slate-500 font-medium">Scheduled Date:</span>
                            <strong class="text-slate-800 font-bold">{{ $seminar->event_date ? $seminar->event_date->format('l, F j, Y') : 'Date TBA' }}</strong>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200/60">
                            <span class="text-slate-500 font-medium">Time:</span>
                            <strong class="text-[#0085FF] font-bold">
                                {{ $seminar->start_time ? \Carbon\Carbon::parse($seminar->start_time)->format('h:i A') : '' }}
                                @if($seminar->end_time) - {{ \Carbon\Carbon::parse($seminar->end_time)->format('h:i A') }} @endif (BST)
                            </strong>
                        </div>
                        @if($seminar->speaker_name)
                            <div class="flex justify-between items-center pb-2 border-b border-slate-200/60">
                                <span class="text-slate-500 font-medium">Lead Speaker:</span>
                                <strong class="text-slate-800 font-bold">{{ $seminar->speaker_name }}</strong>
                            </div>
                        @endif
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 font-medium">Submitted TrxID:</span>
                            <strong class="text-slate-800 font-mono font-bold">{{ $registration->transaction_id ?: 'Not submitted yet' }}</strong>
                        </div>
                    </div>
                </div>

                {{-- Participation Logistics (Unlocked once verified) --}}
                @if($registration->payment_status === 'verified')
                    @if($registration->participation_type === 'online')
                        <div class="p-6 rounded-2xl bg-sky-50 border border-sky-200">
                            <h3 class="text-sm font-bold uppercase tracking-wider text-sky-900 mb-2">🌐 Live Meeting Access Credentials</h3>
                            @if($seminar->meeting_url)
                                <div class="mb-3">
                                    <a href="{{ $seminar->meeting_url }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs shadow-xs transition-colors">
                                        <span>Click Here to Join Live Session</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </div>
                                <div class="text-xs text-slate-600 break-all mb-2">
                                    Direct Link: <a href="{{ $seminar->meeting_url }}" class="text-sky-700 underline">{{ $seminar->meeting_url }}</a>
                                </div>
                            @else
                                <p class="text-xs text-sky-800 font-semibold mb-2">
                                    The direct live meeting link will be dispatched to your email 2 hours before the session start time.
                                </p>
                            @endif

                            @if($seminar->joining_instructions)
                                <div class="text-xs text-slate-700 leading-relaxed pt-2 border-t border-sky-200">
                                    <strong>Joining Guidelines:</strong><br>
                                    {!! nl2br(e($seminar->joining_instructions)) !!}
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="p-6 rounded-2xl bg-amber-50 border border-amber-200">
                            <h3 class="text-sm font-bold uppercase tracking-wider text-amber-900 mb-2">🏢 In-Person Attendance & Venue Details</h3>
                            <div class="text-xs sm:text-sm font-bold text-slate-800 mb-1">
                                {{ $seminar->venue_address ?: 'Pharma Career Compass Corporate Learning Center, Dhaka, Bangladesh' }}
                            </div>
                            <p class="text-xs text-slate-600 mb-3">
                                Please show this confirmation pass (printed or on your mobile device) at the registration desk 15 minutes before the scheduled start.
                            </p>
                            @if($seminar->joining_instructions)
                                <div class="text-xs text-slate-700 leading-relaxed pt-2 border-t border-amber-200">
                                    <strong>Arrival Guidelines:</strong><br>
                                    {!! nl2br(e($seminar->joining_instructions)) !!}
                                </div>
                            @endif
                        </div>
                    @endif
                @else
                    {{-- Unverified instructions --}}
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-600 space-y-2">
                        <div class="font-bold text-[#00245A]">Need to submit or update your transaction details?</div>
                        <p>
                            If you haven't sent the registration fee of <strong>৳{{ number_format($registration->registration_fee, 0) }} BDT</strong> yet, please send money to bKash Personal Number <strong>{{ $defaultBkashNumber }}</strong>.
                        </p>
                        <p>
                            Email your Transaction ID and reference <strong>{{ $registration->registration_reference }}</strong> to <a href="mailto:hello@pharmacareercompass.com" class="text-[#0085FF] font-semibold">hello@pharmacareercompass.com</a> or message +880 1722 531335.
                        </p>
                    </div>
                @endif

                {{-- Facebook link --}}
                @if($seminar->facebook_url)
                    <div class="text-center pt-2 print:hidden">
                        <a href="{{ $seminar->facebook_url }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1877f2] hover:underline">
                            <span>Follow Live Event Updates on Facebook →</span>
                        </a>
                    </div>
                @endif

            </div>

            {{-- Footer Branding --}}
            <div class="p-4 sm:px-8 bg-slate-50 border-t border-slate-100 text-center text-xs text-slate-500">
                Pharma Career Compass • Official Participant Verification System • Pass Reference: <strong>{{ $registration->registration_reference }}</strong>
            </div>

        </div>

    </div>
</div>
@endsection
