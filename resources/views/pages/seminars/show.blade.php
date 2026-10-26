@extends('layouts.app')

@section('title', ($seminar->seo_title ?: $seminar->title) . ' | Pharma Career Compass')
@section('meta_description', $seminar->seo_meta_description ?: ($seminar->short_description ?: 'Join this specialized pharmaceutical workshop and professional training session by Pharma Career Compass.'))

@section('content')
<div class="bg-gradient-to-b from-[#00245A]/5 via-white to-slate-50 min-h-screen py-10 sm:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#0085FF]">Home</a>
            <span>/</span>
            <a href="{{ route('seminars.index') }}" class="hover:text-[#0085FF]">Seminars</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold truncate">{{ $seminar->title }}</span>
        </nav>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            {{-- Left Column: Details, Overview, Speaker, Logistics, Curriculum --}}
            <div class="lg:col-span-8 space-y-8">

                {{-- Hero Card --}}
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden">
                    
                    {{-- Banner Graphic --}}
                    @if($seminar->banner_image || $seminar->featured_image)
                        <div class="h-64 sm:h-80 w-full overflow-hidden bg-slate-900 relative">
                            <img src="{{ $seminar->banner_image ?: $seminar->featured_image }}" alt="{{ $seminar->title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4 sm:left-6 flex flex-wrap gap-2">
                                <span class="px-3 py-1 rounded-full text-xs font-bold shadow-xs
                                    @if($seminar->participation_type === 'online') bg-sky-500 text-white
                                    @elseif($seminar->participation_type === 'offline') bg-amber-500 text-white
                                    @else bg-emerald-600 text-white @endif">
                                    {{ strtoupper($seminar->participation_type) }} EVENT
                                </span>
                                @if($seminar->category)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/90 text-[#00245A] shadow-xs">
                                        {{ $seminar->category }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="p-6 sm:p-8">
                        {{-- Badges if no banner --}}
                        @if(!($seminar->banner_image || $seminar->featured_image))
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    @if($seminar->participation_type === 'online') bg-sky-100 text-sky-800
                                    @elseif($seminar->participation_type === 'offline') bg-amber-100 text-amber-800
                                    @else bg-emerald-100 text-emerald-800 @endif">
                                    {{ strtoupper($seminar->participation_type) }}
                                </span>
                                @if($seminar->category)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                        {{ $seminar->category }}
                                    </span>
                                @endif
                                @if($seminar->topic)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-[#0085FF]">
                                        {{ $seminar->topic }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#00245A] leading-tight mb-4">
                            {{ $seminar->title }}
                        </h1>

                        {{-- Metadata Quick Bar --}}
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100 text-xs mb-6">
                            <div>
                                <span class="text-slate-400 block mb-0.5">Event Date</span>
                                <strong class="text-slate-800 font-bold block">{{ $seminar->event_date ? $seminar->event_date->format('M j, Y') : 'TBA' }}</strong>
                            </div>
                            <div>
                                <span class="text-slate-400 block mb-0.5">Time Schedule</span>
                                <strong class="text-[#0085FF] font-bold block">
                                    {{ $seminar->start_time ? \Carbon\Carbon::parse($seminar->start_time)->format('h:i A') : '' }}
                                    @if($seminar->end_time) - {{ \Carbon\Carbon::parse($seminar->end_time)->format('h:i A') }} @endif
                                </strong>
                            </div>
                            <div>
                                <span class="text-slate-400 block mb-0.5">Registration Fee</span>
                                <strong class="text-emerald-700 font-bold block">৳{{ number_format($seminar->registration_fee, 0) }} BDT</strong>
                            </div>
                            <div>
                                <span class="text-slate-400 block mb-0.5">Seat Availability</span>
                                <strong class="{{ $seminar->availableSeats() > 0 ? 'text-blue-600' : 'text-red-600' }} font-bold block">
                                    {{ $seminar->availableSeats() }} of {{ $seminar->max_participants }} Left
                                </strong>
                            </div>
                        </div>

                        {{-- Short Description --}}
                        @if($seminar->short_description)
                            <div class="text-base text-slate-700 leading-relaxed font-medium mb-6">
                                {{ $seminar->short_description }}
                            </div>
                        @endif

                        {{-- Full Description Content --}}
                        <div class="prose prose-slate max-w-none text-sm sm:text-base text-slate-700 leading-relaxed space-y-4">
                            {!! nl2br(e($seminar->full_description ?: $seminar->short_description)) !!}
                        </div>
                    </div>
                </div>

                {{-- Speaker Profile Box --}}
                @if($seminar->speaker_name)
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-8">
                        <div class="text-xs font-bold uppercase tracking-wider text-[#0085FF] mb-2">Featured Speaker & Mentor</div>
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                            @if($seminar->speaker_avatar)
                                <img src="{{ $seminar->speaker_avatar }}" alt="{{ $seminar->speaker_name }}" class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl object-cover shadow-sm shrink-0 border-2 border-slate-100">
                            @else
                                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gradient-to-tr from-[#00245A] to-[#0085FF] text-white flex items-center justify-center font-bold text-2xl shadow-sm shrink-0">
                                    {{ strtoupper(substr($seminar->speaker_name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-[#00245A]">{{ $seminar->speaker_name }}</h3>
                                <div class="text-sm font-semibold text-[#0085FF] mb-2">{{ $seminar->speaker_designation ?: 'Pharmaceutical Industry Specialist' }}</div>
                                @if($seminar->speaker_bio)
                                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                        {{ $seminar->speaker_bio }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Participation Logistics & Venue Info --}}
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-[#00245A] mb-4 flex items-center gap-2">
                        <span>📍 Participation Mode & Attendance Guidelines</span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Online Guidance --}}
                        @if(in_array($seminar->participation_type, ['online', 'both']))
                            <div class="p-5 rounded-2xl bg-sky-50/70 border border-sky-100">
                                <div class="font-bold text-sky-900 text-sm mb-1 flex items-center gap-2">
                                    <span>🌐 Live Interactive Online Session</span>
                                </div>
                                <p class="text-xs text-slate-600 leading-relaxed mb-3">
                                    Conducting over secure Google Meet / Zoom HD. Access link & joining instructions will be delivered in your verified confirmation email.
                                </p>
                                <div class="text-[11px] font-semibold text-sky-800 bg-sky-100/60 px-3 py-1.5 rounded-lg inline-block">
                                    ✓ Live Q&A • Recording access • Digital handouts
                                </div>
                            </div>
                        @endif

                        {{-- Offline Guidance --}}
                        @if(in_array($seminar->participation_type, ['offline', 'both']))
                            <div class="p-5 rounded-2xl bg-amber-50/70 border border-amber-100">
                                <div class="font-bold text-amber-900 text-sm mb-1 flex items-center gap-2">
                                    <span>🏢 In-Person Training Venue</span>
                                </div>
                                <p class="text-xs text-slate-700 leading-relaxed mb-2 font-medium">
                                    {{ $seminar->venue_address ?: 'Pharma Career Compass Corporate Learning Center, Dhaka, Bangladesh' }}
                                </p>
                                <div class="text-[11px] font-semibold text-amber-800 bg-amber-100/60 px-3 py-1.5 rounded-lg inline-block">
                                    ✓ Printed study materials • Refreshments • Networking
                                </div>
                            </div>
                        @endif
                    </div>

                    @if($seminar->joining_instructions)
                        <div class="mt-4 p-4 rounded-xl bg-slate-50 border border-slate-200/80 text-xs text-slate-600 leading-relaxed">
                            <strong class="text-slate-800 block mb-1">Additional Guidelines:</strong>
                            {!! nl2br(e($seminar->joining_instructions)) !!}
                        </div>
                    @endif
                </div>

                {{-- Terms & Conditions --}}
                @if($seminar->terms_and_conditions)
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-8">
                        <h4 class="text-sm font-bold uppercase tracking-wider text-slate-500 mb-3">Registration Terms & Policies</h4>
                        <div class="text-xs text-slate-600 leading-relaxed space-y-2">
                            {!! nl2br(e($seminar->terms_and_conditions)) !!}
                        </div>
                    </div>
                @endif

            </div>

            {{-- Right Column: Sticky Action Card, Payment Details & Facebook Updates --}}
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">

                {{-- Registration CTA Card --}}
                <div class="bg-white rounded-3xl border-2 border-[#0085FF]/20 shadow-md p-6 sm:p-7">
                    
                    {{-- Price Tag --}}
                    <div class="mb-5 pb-5 border-b border-slate-100">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Registration Fee</span>
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl sm:text-4xl font-extrabold text-[#00245A]">৳{{ number_format($seminar->registration_fee, 0) }}</span>
                            <span class="text-sm font-bold text-slate-500">BDT</span>
                        </div>
                        <span class="text-[11px] text-slate-400 mt-1 block">Payable via bKash Personal / Send Money</span>
                    </div>

                    {{-- Available Seats Status --}}
                    <div class="mb-5">
                        <div class="flex justify-between text-xs font-semibold mb-1.5">
                            <span class="text-slate-600">Reserved Seats:</span>
                            <span class="font-bold text-[#00245A]">{{ $seminar->confirmedRegistrations()->count() }} / {{ $seminar->max_participants }}</span>
                        </div>
                        @php
                            $confirmed = $seminar->confirmedRegistrations()->count();
                            $percent = min(100, round(($confirmed / max(1, $seminar->max_participants)) * 100));
                        @endphp
                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden mb-2">
                            <div class="h-2 rounded-full {{ $percent >= 90 ? 'bg-red-500' : ($percent >= 60 ? 'bg-amber-500' : 'bg-emerald-500') }}" style="width: {{ $percent }}%"></div>
                        </div>
                        <div class="text-[11px] {{ $seminar->availableSeats() > 0 ? 'text-emerald-700' : 'text-red-600' }} font-bold">
                            @if($seminar->isFull())
                                ⚠️ Normal seats filled. You may submit to enter the waitlist.
                            @else
                                ✓ {{ $seminar->availableSeats() }} seats currently open for immediate confirmation
                            @endif
                        </div>
                    </div>

                    {{-- Registration Deadline --}}
                    @if($seminar->registration_closes_at)
                        <div class="p-3 rounded-xl bg-blue-50 border border-blue-100 text-xs text-[#00245A] mb-5">
                            <span class="font-bold block">⏰ Registration Closes:</span>
                            <span>{{ $seminar->registration_closes_at->format('l, F j, Y - h:i A') }}</span>
                        </div>
                    @endif

                    {{-- Primary Action Button --}}
                    <div class="mb-5">
                        @if($seminar->isRegistrationClosed())
                            <button disabled style="white-space: nowrap !important;" class="w-full py-3.5 px-4 rounded-xl bg-slate-200 text-slate-500 font-bold text-sm cursor-not-allowed whitespace-nowrap">
                                Registration Closed
                            </button>
                        @elseif($seminar->isFull())
                            <a href="{{ route('seminars.register', $seminar->slug) }}" style="white-space: nowrap !important;" class="w-full py-3.5 px-4 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-sm text-center flex items-center justify-center shadow-sm transition-colors whitespace-nowrap">
                                Join Participant Waitlist →
                            </a>
                        @else
                            <a href="{{ route('seminars.register', $seminar->slug) }}" style="white-space: nowrap !important;" class="w-full py-3.5 px-4 rounded-xl bg-[#0085FF] hover:bg-[#0070d9] text-white font-extrabold text-sm text-center flex items-center justify-center shadow-md hover:shadow-lg transition-all whitespace-nowrap">
                                Register for this Seminar →
                            </a>
                        @endif
                    </div>

                    {{-- Quick bKash Snippet --}}
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-700">
                        <div class="font-bold text-[#00245A] mb-1 flex items-center justify-between">
                            <span>Payment Instructions (bKash)</span>
                            <span class="text-[10px] bg-pink-100 text-pink-700 px-2 py-0.5 rounded-full font-bold">bKash</span>
                        </div>
                        <div class="text-[11px] text-slate-600 mb-2">
                            Send Money <strong>৳{{ number_format($seminar->registration_fee, 0) }} BDT</strong> to:
                        </div>
                        <div class="flex items-center justify-between bg-white px-3 py-2 rounded-lg border border-slate-200 mb-2">
                            <span class="font-mono font-bold text-sm text-[#00245A]" id="bkashNum">{{ $defaultBkashNumber }}</span>
                            <button type="button" onclick="navigator.clipboard.writeText('{{ $defaultBkashNumber }}'); alert('bKash Number Copied!');" class="text-[10px] text-[#0085FF] hover:underline font-bold">
                                Copy
                            </button>
                        </div>
                        <p class="text-[10px] text-slate-500">
                            Submit your Transaction ID during registration to verify your seat reservation.
                        </p>
                    </div>

                    {{-- Facebook Post/Event Link --}}
                    @if($seminar->facebook_url)
                        <div class="mt-4 pt-4 border-t border-slate-100">
                            <a href="{{ $seminar->facebook_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 w-full py-2.5 px-3 rounded-xl bg-[#1877f2]/10 text-[#1877f2] hover:bg-[#1877f2] hover:text-white font-bold text-xs transition-colors">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                <span>Follow Updates on Facebook</span>
                            </a>
                        </div>
                    @endif

                </div>

                {{-- Status Lookup Shortcut --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-5 text-center text-xs text-slate-600 shadow-xs">
                    <span class="block font-bold text-[#00245A] mb-1">Already registered for this session?</span>
                    <a href="{{ route('seminars.index') }}#lookup" class="text-[#0085FF] font-bold hover:underline">
                        Lookup your registration reference & pass →
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
