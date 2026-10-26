@extends('layouts.app')

@section('title', 'Pharmaceutical Seminars & Training Masterclasses | Pharma Career Compass')
@section('meta_description', 'Register for cutting-edge pharmaceutical seminars, QA/QC masterclasses, regulatory affairs workshops, and professional career training sessions in Bangladesh.')

@section('content')
<div class="bg-gradient-to-b from-[#00245A]/5 via-white to-slate-50 min-h-screen py-10 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Hero Header --}}
        <div class="text-center max-w-3xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#0085FF]/10 text-[#0085FF] font-bold text-xs uppercase tracking-wider mb-4">
                <span>🎓 Professional Development Sessions</span>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#00245A] tracking-tight mb-4">
                Pharmaceutical Seminars & Masterclasses
            </h1>
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed">
                Learn directly from industry leaders in Industrial Quality Assurance, Sterile Validation, Analytical QC, and Regulatory Compliance. Join online or attend in person.
            </p>
        </div>

        {{-- Search & Filter Controls --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-4 sm:p-6 mb-10">
            <form action="{{ route('seminars.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 sm:gap-4 items-center">
                {{-- Search Box --}}
                <div class="sm:col-span-5 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by topic, speaker, or title..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                </div>

                {{-- Category Filter --}}
                <div class="sm:col-span-3">
                    <select name="category" class="w-full py-2.5 px-3 rounded-xl border border-slate-200 text-sm text-slate-700 focus:ring-2 focus:ring-[#0085FF]">
                        <option value="">All Topics & Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Participation Type Filter --}}
                <div class="sm:col-span-2">
                    <select name="type" class="w-full py-2.5 px-3 rounded-xl border border-slate-200 text-sm text-slate-700 focus:ring-2 focus:ring-[#0085FF]">
                        <option value="">All Formats</option>
                        <option value="online" {{ request('type') === 'online' ? 'selected' : '' }}>🌐 Online Only</option>
                        <option value="offline" {{ request('type') === 'offline' ? 'selected' : '' }}>📍 In-Person</option>
                    </select>
                </div>

                {{-- Submit & Reset --}}
                <div class="sm:col-span-2 flex gap-2">
                    <button type="submit" class="w-full bg-[#0085FF] hover:bg-[#0070d9] text-white font-bold text-sm py-2.5 px-4 rounded-xl shadow-xs transition-colors">
                        Filter
                    </button>
                    @if(request()->hasAny(['q', 'category', 'type']))
                        <a href="{{ route('seminars.index') }}" class="px-3 py-2.5 text-xs font-semibold text-slate-500 hover:text-slate-800 bg-slate-100 rounded-xl flex items-center justify-center">
                            ✕
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Upcoming Seminars Section --}}
        <div class="mb-14">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-[#00245A] flex items-center gap-2">
                        <span>Upcoming Seminars & Workshops</span>
                        <span class="text-xs bg-[#0085FF] text-white px-2.5 py-0.5 rounded-full font-bold">{{ $upcomingSeminars->count() }}</span>
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">Reserve your seat early. Limited spots per session to guarantee interactive engagement.</p>
                </div>
            </div>

            @if($upcomingSeminars->isEmpty())
                <div class="bg-white rounded-2xl border border-slate-200/80 p-12 text-center max-w-xl mx-auto shadow-sm">
                    <div class="w-16 h-16 rounded-full bg-blue-50 text-[#0085FF] flex items-center justify-center mx-auto mb-4 text-2xl">
                        📅
                    </div>
                    <h3 class="text-lg font-bold text-[#00245A] mb-2">No Upcoming Seminars Found</h3>
                    <p class="text-sm text-slate-500 mb-6">
                        @if(request()->hasAny(['q', 'category', 'type']))
                            No seminars matched your specific search criteria. Try resetting the filters.
                        @else
                            New programs for the upcoming month will be announced shortly. Check our past sessions or check back soon!
                        @endif
                    </p>
                    @if(request()->hasAny(['q', 'category', 'type']))
                        <a href="{{ route('seminars.index') }}" class="btn-primary text-xs py-2 px-5">View All Seminars</a>
                    @endif
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($upcomingSeminars as $sem)
                        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-md hover:border-[#0085FF]/40 transition-all flex flex-col overflow-hidden group">
                            
                            {{-- Event Graphic / Banner --}}
                            <div class="relative h-48 bg-[#00245A] overflow-hidden">
                                @if($sem->featured_image || $sem->banner_image)
                                    <img src="{{ $sem->featured_image ?: $sem->banner_image }}" alt="{{ $sem->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full bg-gradient-to-tr from-[#00245A] to-[#0085FF] flex items-center justify-center p-6 text-center text-white">
                                        <div>
                                            <span class="text-3xl mb-2 block">🎓</span>
                                            <span class="font-bold text-sm tracking-wide text-white/90">{{ $sem->topic ?: 'Pharma Masterclass' }}</span>
                                        </div>
                                    </div>
                                @endif

                                {{-- Badges overlay --}}
                                <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold shadow-xs
                                        @if($sem->participation_type === 'online') bg-sky-500 text-white
                                        @elseif($sem->participation_type === 'offline') bg-amber-500 text-white
                                        @else bg-emerald-600 text-white @endif">
                                        {{ strtoupper($sem->participation_type) }}
                                    </span>
                                    @if($sem->category)
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-white/95 text-[#00245A] backdrop-blur-xs shadow-xs">
                                            {{ $sem->category }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Fee badge --}}
                                <div class="absolute bottom-3 right-3 bg-white/95 text-[#00245A] font-extrabold text-xs px-2.5 py-1 rounded-lg shadow-xs">
                                    ৳{{ number_format($sem->registration_fee, 0) }} BDT
                                </div>
                            </div>

                            {{-- Card Body --}}
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    {{-- Date & Time --}}
                                    <div class="flex items-center gap-2 text-xs font-bold text-[#0085FF] mb-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>{{ $sem->event_date ? $sem->event_date->format('l, F j, Y') : 'Date TBA' }}</span>
                                        @if($sem->start_time)
                                            <span>• {{ \Carbon\Carbon::parse($sem->start_time)->format('h:i A') }}</span>
                                        @endif
                                    </div>

                                    {{-- Title --}}
                                    <h3 class="text-lg font-bold text-[#00245A] group-hover:text-[#0085FF] transition-colors line-clamp-2 mb-2">
                                        <a href="{{ route('seminars.show', $sem->slug) }}">
                                            {{ $sem->title }}
                                        </a>
                                    </h3>

                                    {{-- Short Description --}}
                                    <p class="text-xs text-slate-600 line-clamp-2 mb-4 leading-relaxed">
                                        {{ $sem->short_description ?: 'Comprehensive industry preparation and interactive training session designed for pharmaceutical career acceleration.' }}
                                    </p>

                                    {{-- Speaker Snapshot --}}
                                    @if($sem->speaker_name)
                                        <div class="flex items-center gap-2.5 p-2 rounded-xl bg-slate-50 mb-4 border border-slate-100">
                                            @if($sem->speaker_avatar)
                                                <img src="{{ $sem->speaker_avatar }}" alt="{{ $sem->speaker_name }}" class="w-8 h-8 rounded-full object-cover">
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#00245A] to-[#0085FF] text-white flex items-center justify-center font-bold text-xs">
                                                    {{ strtoupper(substr($sem->speaker_name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div class="min-w-0 flex-1">
                                                <div class="text-xs font-bold text-slate-800 truncate">{{ $sem->speaker_name }}</div>
                                                <div class="text-[10px] text-slate-500 truncate">{{ $sem->speaker_designation ?: 'Industry Specialist' }}</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Seat Status & Action --}}
                                <div class="pt-3 border-t border-slate-100">
                                    <div class="flex items-center justify-between text-xs mb-2">
                                        <span class="text-slate-500 font-medium">Available Seats:</span>
                                        <span class="font-bold {{ $sem->availableSeats() > 10 ? 'text-emerald-600' : ($sem->availableSeats() > 0 ? 'text-amber-600' : 'text-red-600') }}">
                                            @if($sem->isFull())
                                                Full (Waitlist Open)
                                            @else
                                                {{ $sem->availableSeats() }} of {{ $sem->max_participants }} left
                                            @endif
                                        </span>
                                    </div>

                                    {{-- Seats Progress Bar --}}
                                    <div class="w-full bg-slate-100 rounded-full h-1.5 mb-3 overflow-hidden">
                                        @php
                                            $confirmed = $sem->confirmedRegistrations()->count();
                                            $percent = min(100, round(($confirmed / max(1, $sem->max_participants)) * 100));
                                        @endphp
                                        <div class="h-1.5 rounded-full {{ $percent >= 90 ? 'bg-red-500' : ($percent >= 60 ? 'bg-amber-500' : 'bg-emerald-500') }}" style="width: {{ $percent }}%"></div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('seminars.show', $sem->slug) }}" class="flex-1 text-center py-2 px-3 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 transition-colors">
                                            Details
                                        </a>
                                        @if($sem->isRegistrationClosed())
                                            <span class="flex-1 text-center py-2 px-3 rounded-xl bg-slate-100 text-slate-400 text-xs font-bold cursor-not-allowed">
                                                Closed
                                            </span>
                                        @elseif($sem->isFull())
                                            <a href="{{ route('seminars.register', $sem->slug) }}" class="flex-1 text-center py-2 px-3 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold transition-colors">
                                                Join Waitlist
                                            </a>
                                        @else
                                            <a href="{{ route('seminars.register', $sem->slug) }}" class="flex-1 text-center py-2 px-3 rounded-xl bg-[#0085FF] hover:bg-[#0070d9] text-white text-xs font-bold transition-colors shadow-xs">
                                                Register Now →
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Past Seminars Archive --}}
        @if($pastSeminars->isNotEmpty())
            <div class="mb-14">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-[#00245A]">Past Masterclasses & Concluded Sessions</h2>
                    <p class="text-xs text-slate-500">Review topics previously conducted by Pharma Career Compass mentors.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($pastSeminars as $psem)
                        <div class="bg-white/80 rounded-2xl border border-slate-200/60 p-5 shadow-xs flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between text-xs text-slate-400 mb-2">
                                    <span>Concluded: {{ $psem->event_date ? $psem->event_date->format('M j, Y') : '' }}</span>
                                    <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 font-bold text-[10px]">COMPLETED</span>
                                </div>
                                <h4 class="font-bold text-[#00245A] text-base mb-1.5">{{ $psem->title }}</h4>
                                <p class="text-xs text-slate-500 line-clamp-2 mb-3">{{ $psem->short_description }}</p>
                                @if($psem->speaker_name)
                                    <div class="text-xs text-slate-600 font-medium">Speaker: <strong>{{ $psem->speaker_name }}</strong></div>
                                @endif
                            </div>
                            <div class="pt-3 border-t border-slate-100 mt-4 flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-500">{{ $psem->confirmedRegistrations()->count() }} Attendees</span>
                                <a href="{{ route('seminars.show', $psem->slug) }}" class="text-xs font-bold text-[#0085FF] hover:underline">
                                    View Summary →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Check Registration Status Bar --}}
        <div class="bg-gradient-to-r from-[#00245A] to-[#0085FF] rounded-2xl p-6 sm:p-8 text-white shadow-lg">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                <div class="lg:col-span-6">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-[#FFCD00] font-bold text-xs uppercase tracking-wider mb-2">
                        <span>🔍 Live Status Verification</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-extrabold mb-1">Already Registered for a Seminar?</h3>
                    <p class="text-xs sm:text-sm text-slate-200">
                        Check your payment verification progress, meeting links, venue address, and download your official participant pass.
                    </p>
                </div>
                <div class="lg:col-span-6">
                    <form action="{{ route('seminars.status.lookup') }}" method="POST" class="flex flex-col sm:flex-row gap-2.5">
                        @csrf
                        <input type="text" name="reference" placeholder="Ref (e.g. SEM-2026-AB12CD)" required class="flex-1 px-4 py-2.5 rounded-xl bg-white text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#FFCD00]">
                        <input type="text" name="identifier" placeholder="Email or Phone" required class="flex-1 px-4 py-2.5 rounded-xl bg-white text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#FFCD00]">
                        <button type="submit" class="bg-[#FFCD00] hover:bg-[#e6b800] text-[#00245A] font-extrabold text-sm px-6 py-2.5 rounded-xl transition-colors whitespace-nowrap shadow-sm">
                            Check Status
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
