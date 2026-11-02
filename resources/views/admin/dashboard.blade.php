@extends('layouts.admin')

@section('title', 'Admin Dashboard - Pharma Career Compass')

@section('admin_content')
<div class="space-y-8">
    
    <div>
        <h1 class="text-2xl sm:text-3xl font-black text-[#00245A]">System Overview & Metrics</h1>
        <p class="text-xs text-[#00245A]/70 mt-1">Real-time status of candidates, consultations, questions, and inquiries</p>
    </div>

    <!-- Metrics Cards Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6">
        
        {{-- Clickable Seminar Booking Card --}}
        <a href="{{ route('admin.seminars.registrations') }}" 
           class="bg-white hover:bg-blue-50/40 p-5 rounded-2xl border-2 border-blue-300/90 hover:border-[#0085FF] shadow-xs hover:shadow-md transition-all block group cursor-pointer relative overflow-hidden">
            <div class="flex items-center justify-between">
                <p class="text-[11px] font-black uppercase tracking-wider text-[#00245A] group-hover:text-[#0085FF] transition-colors">
                    Seminar Bookings
                </p>
                <span class="inline-flex items-center gap-1 text-[10px] font-black px-2 py-0.5 rounded-full bg-blue-100 text-[#0085FF]">
                    PCDP
                </span>
            </div>
            <h3 class="text-3xl font-black text-[#00245A] group-hover:text-[#0085FF] mt-1 transition-colors">
                {{ $metrics['seminar_registrations_count'] ?? 0 }}
            </h3>
            <div class="flex items-center justify-between text-[10px] font-bold text-slate-500 mt-1">
                <span class="text-emerald-700">M1: {{ $metrics['module1_registrations_count'] ?? 0 }} &bull; M2: {{ $metrics['module2_registrations_count'] ?? 0 }}</span>
                <span class="text-[#0085FF] group-hover:translate-x-0.5 transition-transform">&rarr;</span>
            </div>
        </a>

        {{-- Registered Candidates --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Registered Candidates</p>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">{{ $metrics['users_count'] ?? 0 }}</h3>
            <p class="text-[10px] text-emerald-600 font-semibold mt-1">Active Accounts</p>
        </div>

        {{-- Clickable Consultation Bookings --}}
        <a href="{{ route('admin.bookings') }}" class="bg-white hover:bg-slate-50/70 p-5 rounded-2xl border border-slate-200 hover:border-slate-300 shadow-sm transition-all block group cursor-pointer">
            <div class="flex items-center justify-between">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 group-hover:text-[#0085FF] transition-colors">Consultation Bookings</p>
                <span class="text-xs text-slate-400 group-hover:text-[#0085FF]">&rarr;</span>
            </div>
            <h3 class="text-3xl font-extrabold text-[#0085FF] mt-1">{{ $metrics['bookings_count'] ?? 0 }}</h3>
            <p class="text-[10px] text-slate-500 mt-1">1-on-1 Sessions Scheduled</p>
        </a>

        {{-- Written Question Bank --}}
        <a href="{{ route('admin.exams') }}" class="bg-white hover:bg-slate-50/70 p-5 rounded-2xl border border-slate-200 hover:border-slate-300 shadow-sm transition-all block group cursor-pointer">
            <div class="flex items-center justify-between">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 group-hover:text-[#0085FF] transition-colors">Written Question Bank</p>
                <span class="text-xs text-slate-400 group-hover:text-[#0085FF]">&rarr;</span>
            </div>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">{{ $metrics['exam_questions_count'] ?? 0 }}</h3>
            <p class="text-[10px] text-slate-500 mt-1">MCQs across 4 Domains</p>
        </a>

        {{-- Viva Model Answers --}}
        <a href="{{ route('admin.viva') }}" class="bg-white hover:bg-slate-50/70 p-5 rounded-2xl border border-slate-200 hover:border-slate-300 shadow-sm transition-all block group cursor-pointer">
            <div class="flex items-center justify-between">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 group-hover:text-amber-600 transition-colors">Viva Model Answers</p>
                <span class="text-xs text-slate-400 group-hover:text-amber-600">&rarr;</span>
            </div>
            <h3 class="text-3xl font-extrabold text-amber-500 mt-1">{{ $metrics['viva_questions_count'] ?? 0 }}</h3>
            <p class="text-[10px] text-slate-500 mt-1">Technical viva guides</p>
        </a>
    </div>

    {{-- Live Seminar Meeting Link Broadcast Card --}}
    <div class="bg-gradient-to-br from-white to-blue-50/30 rounded-2xl border-2 border-blue-200/90 shadow-sm p-6 sm:p-7 relative overflow-hidden">
        
        {{-- Card Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <span class="w-10 h-10 rounded-xl bg-[#0085FF] text-white flex items-center justify-center font-black text-xl shadow-xs">
                    📹
                </span>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-lg font-black text-[#00245A]">Send Live Seminar Meeting Link</h2>
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Live Broadcast
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Broadcast Google Meet / Zoom coordinates directly to all registered candidate emails with branded invitation template.
                    </p>
                </div>
            </div>

            @if(!empty($lastMeetingLinkSentAt))
                <div class="text-left sm:text-right text-[11px] text-slate-400">
                    <span class="block">Last Sent:</span>
                    <strong class="text-slate-600 font-mono">{{ \Carbon\Carbon::parse($lastMeetingLinkSentAt)->diffForHumans() }}</strong>
                </div>
            @endif
        </div>

        {{-- Broadcast Form --}}
        <form action="{{ route('admin.seminars.send-meeting-link') }}" method="POST" class="mt-5 space-y-4" onsubmit="return confirm('Are you sure you want to send this meeting link to all selected candidate emails?');">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                
                {{-- Meeting Link Input --}}
                <div class="md:col-span-6">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Google Meet / Zoom URL <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-sm">
                            🔗
                        </div>
                        <input type="url" 
                               name="meeting_link" 
                               value="{{ old('meeting_link', $lastMeetingLink) }}" 
                               required 
                               placeholder="https://meet.google.com/xxx-yyyy-zzz or https://zoom.us/j/..." 
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-mono text-[#00245A] focus:ring-2 focus:ring-[#0085FF] focus:border-[#0085FF] bg-white shadow-2xs">
                    </div>
                    <span class="text-[10px] text-slate-400 mt-1 block">Candidates will receive a branded invitation email with a direct 1-click join button.</span>
                </div>

                {{-- Target Audience --}}
                <div class="md:col-span-3">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Recipient Target <span class="text-red-500">*</span>
                    </label>
                    <select name="target" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-[#0085FF] focus:border-[#0085FF] bg-white shadow-2xs font-semibold">
                        <option value="all" selected>All Registered Attendees ({{ $metrics['seminar_registrations_count'] ?? 0 }})</option>
                        <option value="1">Module 1 Only: Industrial Operations ({{ $metrics['module1_registrations_count'] ?? 0 }})</option>
                        <option value="2">Module 2 Only: Pharma Marketing ({{ $metrics['module2_registrations_count'] ?? 0 }})</option>
                    </select>
                </div>

                {{-- Session Time --}}
                <div class="md:col-span-3">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Session Timing <span class="text-slate-400 font-normal">(Optional)</span>
                    </label>
                    <input type="text" 
                           name="session_time" 
                           value="{{ old('session_time', '7:30 PM – 10:00 PM (BST)') }}" 
                           placeholder="e.g. 7:30 PM – 10:00 PM (BST)" 
                           class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-[#0085FF] bg-white shadow-2xs">
                </div>
            </div>

            {{-- Optional Note and Submit Row --}}
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end pt-1">
                
                <div class="md:col-span-9">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Custom Note / Joining Instructions <span class="text-slate-400 font-normal">(Optional)</span>
                    </label>
                    <input type="text" 
                           name="custom_note" 
                           value="{{ old('custom_note') }}" 
                           placeholder="e.g. Please join 5-10 minutes early. Keep microphone muted until the interactive Q&A session." 
                           class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-[#0085FF] bg-white shadow-2xs">
                </div>

                <div class="md:col-span-3">
                    <button type="submit" 
                            class="w-full py-2.5 px-4 rounded-xl bg-[#0085FF] hover:bg-[#0070d9] text-white font-black text-xs shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer h-[42px]">
                        <span>🚀 Send Meeting Link</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </div>

        </form>

    </div>

    <!-- Secondary Metrics -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400 block">Career Paths</span>
            <span class="text-xl font-bold text-slate-900">{{ $metrics['career_paths_count'] ?? 0 }}</span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400 block">Industry Consultants</span>
            <span class="text-xl font-bold text-slate-900">{{ $metrics['consultants_count'] ?? 0 }}</span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400 block">Blog Articles</span>
            <span class="text-xl font-bold text-slate-900">{{ $metrics['blog_posts_count'] ?? 0 }}</span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400 block">Inquiries Received</span>
            <span class="text-xl font-bold text-[#0085FF]">{{ $metrics['contact_messages_count'] ?? 0 }}</span>
        </div>
    </div>

    <!-- 2 Column Section: Recent Bookings & Recent Inquiries -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Recent Bookings -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-slate-900">Recent Consultation Requests</h2>
                <a href="{{ route('admin.bookings') }}" class="text-xs font-bold text-[#0085FF] hover:underline">Manage All &rarr;</a>
            </div>

            @if($recentBookings && $recentBookings->count() > 0)
                <div class="space-y-3">
                    @foreach($recentBookings as $bk)
                        <div class="p-3.5 rounded-xl border border-slate-100 bg-slate-50 flex items-center justify-between">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $bk->status === 'confirmed' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $bk->status }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-900">{{ $bk->user->name ?? 'Candidate' }}</span>
                                </div>
                                <p class="text-[11px] text-slate-500 mt-1">
                                    {{ $bk->booking_date->format('M d, Y') }} at {{ date('h:i A', strtotime($bk->start_time)) }} • {{ $bk->consultant->name ?? 'Advisor' }}
                                </p>
                            </div>
                            <a href="{{ route('admin.bookings') }}" class="text-xs font-bold text-[#0085FF] hover:underline">
                                Edit
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-xs text-slate-500 py-6 text-center">No bookings recorded yet.</p>
            @endif
        </div>

        <!-- Recent Contact Messages -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-slate-900">Recent Inquiries</h2>
                <a href="{{ route('admin.messages') }}" class="text-xs font-bold text-[#0085FF] hover:underline">View All &rarr;</a>
            </div>

            @if($recentMessages && $recentMessages->count() > 0)
                <div class="space-y-3">
                    @foreach($recentMessages as $msg)
                        <div class="p-3.5 rounded-xl border border-slate-100 bg-slate-50">
                            <div class="flex items-center justify-between">
                                <h4 class="font-bold text-xs text-slate-900">{{ $msg->name }} ({{ $msg->email }})</h4>
                                <span class="text-[10px] text-slate-400">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <span class="text-[10px] font-bold uppercase text-[#0085FF] block mt-1">{{ $msg->subject ?? 'General' }}</span>
                            <p class="text-xs text-[#00245A]/70 line-clamp-2 mt-1">{{ $msg->message }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-xs text-[#00245A]/60 py-6 text-center">No contact messages received yet.</p>
            @endif
        </div>

    </div>

</div>
@endsection
