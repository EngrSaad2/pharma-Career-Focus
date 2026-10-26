@extends('layouts.app')

@section('title', 'Contact Pharma Career Compass | Pharma Career Guidance')
@section('meta_description', 'Connect with Pharma Career Compass. Reach out for pharma career consultation, exam preparation guidance, and mentorship inquiries.')

@section('content')
<!-- Hero Header -->
<section class="bg-white py-16 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-3 py-1 bg-blue-50 text-[#0085FF] text-xs font-bold uppercase tracking-wider rounded mb-3 border border-blue-200">
            Get In Touch
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-[#00245A] tracking-tight mb-4">
            Contact Pharma Career Compass
        </h1>
        <p class="text-base md:text-lg text-slate-600 max-w-2xl mx-auto">
            Have questions about Pharma Career Launchpad, one-on-one mentorship, mock exams, or booking a consultation? Drop us a line.
        </p>
    </div>
</section>

<!-- Contact Info & Form -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Left Info Panel -->
            <div class="lg:col-span-5 space-y-8">
                <div>
                    <h2 class="text-2xl font-extrabold text-[#00245A] mb-3">Direct Communication Channels</h2>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Our career advisors review messages Sunday through Thursday, 9:00 AM – 6:00 PM. We reply to all inquiries within one working day.
                    </p>
                </div>

                <!-- Info Cards -->
                <div class="space-y-4">
                    <div class="p-5 rounded-xl border border-slate-200 bg-white shadow-sm flex items-start gap-4">
                        <div class="w-12 h-12 rounded-lg bg-[#0085FF] text-white flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-[#00245A] text-sm">Direct Email</h3>
                            <a href="mailto:{{ $siteSettings['contact_email'] ?? 'support@pharmacareercompass.com' }}" class="text-sm font-semibold text-[#0085FF] hover:underline">
                                {{ $siteSettings['contact_email'] ?? 'support@pharmacareercompass.com' }}
                            </a>
                            <p class="text-xs text-slate-500 mt-1">Official support & partnership queries</p>
                        </div>
                    </div>

                    <div class="p-5 rounded-xl border border-slate-200 bg-white shadow-sm flex items-start gap-4">
                        <div class="w-12 h-12 rounded-lg bg-[#FFCD00] text-[#00245A] flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-[#00245A] text-sm">Phone Helpline</h3>
                            <p class="text-sm font-semibold text-[#00245A]">
                                {{ $siteSettings['contact_phone'] ?? '+880 1700-000000' }}
                            </p>
                            <p class="text-xs text-slate-500 mt-1">Sunday to Thursday: 10:00 AM - 6:00 PM</p>
                        </div>
                    </div>

                    <div class="p-5 rounded-xl border border-slate-200 bg-white shadow-sm flex items-start gap-4">
                        <div class="w-12 h-12 rounded-lg bg-[#00245A] text-white flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-[#00245A] text-sm">Consultation Office</h3>
                            <p class="text-sm text-slate-700">
                                {{ $siteSettings['contact_address'] ?? 'Gulshan-1, Dhaka 1212, Bangladesh' }}
                            </p>
                            <p class="text-xs text-slate-500 mt-1">Visits by appointment only</p>
                        </div>
                    </div>
                </div>

                <!-- Fast Booking Callout -->
                <div class="p-6 rounded-2xl bg-[#00245A] text-white shadow-sm">
                    <h3 class="text-lg font-extrabold mb-2">Need Direct 1-on-1 Consultation?</h3>
                    <p class="text-xs text-white/80 leading-relaxed mb-4">
                        Skip the waiting queue. Select an industrial consultant and schedule a 30-min or 60-min video session directly.
                    </p>
                    <a href="{{ route('consultation.book') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-[#FFCD00] text-[#00245A] font-bold text-xs uppercase tracking-wider hover:bg-yellow-400 shadow-sm">
                        <span>Book Instant Session</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="lg:col-span-7">
                <div class="bg-white p-8 md:p-10 rounded-2xl border border-slate-200 shadow-sm">
                    <h2 class="text-2xl font-extrabold text-[#00245A] mb-1">Send Us a Message</h2>
                    <p class="text-xs text-slate-500 mb-6">Fill in details below and an advisor will connect with you.</p>

                    @if(session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-900 text-sm flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <div>
                                <span class="font-bold">Message Delivered:</span> {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-900 text-sm">
                            <p class="font-bold mb-1">Please correct errors below:</p>
                            <ul class="list-disc list-inside text-xs space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Full Name *</label>
                                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required
                                       class="w-full px-4 py-3 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white"
                                       placeholder="e.g. Dr. Tanvir Hossain">
                            </div>
                            <div>
                                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Email Address *</label>
                                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required
                                       class="w-full px-4 py-3 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white"
                                       placeholder="tanvir@example.com">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Contact Phone</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                       class="w-full px-4 py-3 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white"
                                       placeholder="+880 17XXXXXXXX">
                            </div>
                            <div>
                                <label for="subject" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Inquiry Topic</label>
                                <select id="subject" name="subject"
                                        class="w-full px-4 py-3 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white">
                                    <option value="Career Launchpad Inquiry">Career Launchpad Program</option>
                                    <option value="Consultation Booking">1-on-1 Consultation Query</option>
                                    <option value="Exam Preparation Questions">Written Exam Question Bank</option>
                                    <option value="Viva & Interview Coaching">Viva & Interview Prep</option>
                                    <option value="Institutional Partnership">University / Corporate Partnership</option>
                                    <option value="Other">General Question</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Your Message *</label>
                            <textarea id="message" name="message" rows="5" required
                                      class="w-full px-4 py-3 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white"
                                      placeholder="Tell us about your background, current career stage (student, fresh graduate, or working professional), and what guidance you need...">{{ old('message') }}</textarea>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                    class="w-full py-3.5 px-6 rounded-lg bg-[#0085FF] text-white font-bold text-sm uppercase tracking-wider shadow-sm hover:bg-blue-600 transition-all">
                                Send Inquiry Message
                            </button>
                            <p class="text-[11px] text-slate-500 text-center mt-3">
                                By submitting, you agree to our privacy policy. Your information is held strictly confidential.
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
