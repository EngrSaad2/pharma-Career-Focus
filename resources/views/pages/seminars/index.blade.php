@extends('layouts.app')

@section('title', 'Pharmaceutical Seminars & Training Masterclasses | Pharma Career Compass')
@section('meta_description', 'Register for cutting-edge pharmaceutical seminars, QA/QC masterclasses, regulatory affairs workshops, and professional career training sessions in Bangladesh.')

@section('content')
<div class="bg-gradient-to-b from-[#00245A]/5 via-white to-slate-50 min-h-screen py-10 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-3 shadow-xs">
                <span class="text-xl">✓</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 text-sm font-semibold flex items-center gap-3 shadow-xs">
                <span class="text-xl">⚠️</span>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if(session('info'))
            <div class="mb-6 p-4 rounded-2xl bg-blue-50 border border-blue-200 text-blue-800 text-sm font-semibold flex items-center gap-3 shadow-xs">
                <span class="text-xl">ℹ</span>
                <div>{{ session('info') }}</div>
            </div>
        @endif

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
                    <button type="submit" style="white-space: nowrap !important;" class="w-full bg-[#0085FF] hover:bg-[#0070d9] text-white font-bold text-sm py-2.5 px-4 rounded-xl shadow-xs transition-colors whitespace-nowrap">
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
                                        <a href="{{ route('seminars.show', $sem->slug) }}" style="white-space: nowrap !important;" class="flex-1 text-center py-2 px-3 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 transition-colors whitespace-nowrap">
                                            Details
                                        </a>
                                        @if($sem->isRegistrationClosed())
                                            <span style="white-space: nowrap !important;" class="flex-1 text-center py-2 px-3 rounded-xl bg-slate-100 text-slate-400 text-xs font-bold cursor-not-allowed whitespace-nowrap">
                                                Closed
                                            </span>
                                        @elseif($sem->isFull())
                                            <a href="{{ route('seminars.register', $sem->slug) }}" style="white-space: nowrap !important;" class="flex-1 text-center py-2 px-3 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold transition-colors whitespace-nowrap">
                                                Join Waitlist
                                            </a>
                                        @else
                                            <a href="{{ route('seminars.register', $sem->slug) }}" style="white-space: nowrap !important;" class="flex-1 text-center py-2 px-3 rounded-xl bg-[#0085FF] hover:bg-[#0070d9] text-white text-xs font-bold transition-colors shadow-xs whitespace-nowrap">
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

        {{-- Check Registration Status Banner --}}
        <div id="lookup" class="relative overflow-hidden rounded-3xl text-white shadow-2xl border border-white/10"
             style="background: linear-gradient(135deg, #001A3D 0%, #002855 35%, #004B99 75%, #0077E6 100%);">
            
            <!-- Ambient glowing backdrop blurs -->
            <div style="position: absolute; right: -5rem; bottom: -5rem; width: 22rem; height: 22rem; background: radial-gradient(circle, rgba(0, 133, 255, 0.35) 0%, rgba(0, 133, 255, 0) 70%); pointer-events: none; border-radius: 9999px;"></div>
            <div style="position: absolute; left: 15%; top: -6rem; width: 18rem; height: 18rem; background: radial-gradient(circle, rgba(255, 205, 0, 0.12) 0%, rgba(255, 205, 0) 0%); pointer-events: none; border-radius: 9999px;"></div>

            <div class="relative z-10 p-6 sm:p-10 lg:p-12">
                <div style="display: flex; flex-direction: column; gap: 2rem; width: 100%;" class="lg:flex-row lg:items-center lg:justify-between">
                    
                    {{-- Left column: informative pitch & live badge --}}
                    <div style="flex: 1 1 50%; min-width: 280px; max-width: 100%;">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 text-[#FFCD00] text-xs font-bold tracking-wider uppercase mb-3.5 backdrop-blur-md">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#FFCD00] opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#FFCD00]"></span>
                            </span>
                            <span>Live Status Verification</span>
                        </div>
                        
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white tracking-tight leading-tight mb-3">
                            Already Registered for a Seminar?
                        </h3>
                        
                        <p class="text-sm sm:text-base text-blue-100/90 leading-relaxed font-normal" style="max-width: 34rem;">
                            Check your payment verification progress, unlock online meeting links, access venue directions, and download your official participant pass.
                        </p>

                        <div class="mt-4 flex flex-wrap items-center gap-4 text-xs text-blue-200/90">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-[#FFCD00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Instant Status Check</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-[#FFCD00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Official Digital Badge</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-[#FFCD00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>bKash Auto-Tracking</span>
                            </div>
                        </div>
                    </div>

                    {{-- Right column: ultra-sleek form card with single-line button --}}
                    <div style="flex: 1 1 50%; min-width: 300px; width: 100%;">
                        <div style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.18); border-radius: 1.5rem; padding: 1.5rem;" class="shadow-2xl">
                            
                            <div class="text-[11px] font-bold tracking-wider uppercase text-blue-200 mb-3 flex items-center justify-between">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-[#FFCD00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    <span>Verify Your Registration</span>
                                </span>
                                <span class="text-[10px] text-blue-300/80 font-normal">Reference + Email/Phone</span>
                            </div>

                            <form action="{{ route('seminars.status.lookup') }}" method="POST" style="display: flex; gap: 0.625rem; width: 100%;" class="flex-col sm:flex-row items-stretch">
                                @csrf
                                <div style="flex: 1 1 40%; min-width: 0;">
                                    <input type="text" 
                                           name="reference" 
                                           value="{{ old('reference') }}"
                                           placeholder="Ref: SEM-2026-AB12CD" 
                                           required 
                                           style="width: 100%; box-sizing: border-box;"
                                           class="px-4 py-3.5 rounded-xl bg-white text-slate-900 text-xs sm:text-sm font-mono placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#FFCD00] border-0 shadow-sm font-semibold">
                                </div>
                                <div style="flex: 1 1 40%; min-width: 0;">
                                    <input type="text" 
                                           name="identifier" 
                                           value="{{ old('identifier') }}"
                                           placeholder="Email or Mobile" 
                                           required 
                                           style="width: 100%; box-sizing: border-box;"
                                           class="px-4 py-3.5 rounded-xl bg-white text-slate-900 text-xs sm:text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#FFCD00] border-0 shadow-sm font-medium">
                                </div>
                                <button type="submit" 
                                        style="white-space: nowrap !important; flex: 0 0 auto; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;"
                                        class="px-6 py-3.5 rounded-xl bg-[#FFCD00] hover:bg-[#e6b800] text-[#00245A] font-black text-xs sm:text-sm transition-all duration-200 shadow-md hover:shadow-xl active:scale-98 whitespace-nowrap cursor-pointer">
                                    <span style="white-space: nowrap;">Check Status</span>
                                    <svg style="width: 1rem; height: 1rem; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </form>

                            <div class="mt-3 flex items-center justify-between text-[11px] text-blue-200/75 pt-2 border-t border-white/10">
                                <span class="flex items-center gap-1">
                                    <span class="text-emerald-400">●</span> 24/7 Live Automated Verification
                                </span>
                                <a href="{{ route('contact') }}" class="hover:text-white underline transition-colors">Lost Reference?</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
