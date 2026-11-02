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
