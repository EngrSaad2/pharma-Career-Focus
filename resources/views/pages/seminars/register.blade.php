@extends('layouts.app')

@section('title', 'Register: ' . $seminar->title . ' | Pharma Career Compass')

@section('content')
<div class="bg-gradient-to-b from-[#00245A]/5 via-white to-slate-50 min-h-screen py-10 sm:py-14">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#0085FF]">Home</a>
            <span>/</span>
            <a href="{{ route('seminars.index') }}" class="hover:text-[#0085FF]">Seminars</a>
            <span>/</span>
            <a href="{{ route('seminars.show', $seminar->slug) }}" class="hover:text-[#0085FF] truncate">{{ $seminar->title }}</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold">Registration</span>
        </nav>

        {{-- Seminar Header Snapshot --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 mb-8">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold mb-2
                        @if($seminar->participation_type === 'online') bg-sky-100 text-sky-800
                        @elseif($seminar->participation_type === 'offline') bg-amber-100 text-amber-800
                        @else bg-emerald-100 text-emerald-800 @endif">
                        {{ strtoupper($seminar->participation_type) }} WORKSHOP
                    </div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-[#00245A]">
                        {{ $seminar->title }}
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        {{ $seminar->event_date ? $seminar->event_date->format('l, F j, Y') : 'Date TBA' }}
                        @if($seminar->start_time)
                            • {{ \Carbon\Carbon::parse($seminar->start_time)->format('h:i A') }}
                            @if($seminar->end_time) - {{ \Carbon\Carbon::parse($seminar->end_time)->format('h:i A') }} @endif
                        @endif
                    </p>
                </div>
                <div class="sm:text-right shrink-0">
                    <span class="text-xs text-slate-400 block font-medium">Registration Fee</span>
                    <span class="text-2xl sm:text-3xl font-extrabold text-[#00245A]">৳{{ number_format($seminar->registration_fee, 0) }}</span>
                    <span class="text-xs font-bold text-slate-500">BDT</span>
                </div>
            </div>

            @if($isWaitlist)
                <div class="mt-4 p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-800 text-xs sm:text-sm">
                    <strong>Notice:</strong> This seminar has reached maximum capacity. Submitting this form adds you to the <strong>Priority Waitlist</strong>. If a seat is vacated, our admin team will contact and verify your seat immediately.
                </div>
            @endif
        </div>

        {{-- Registration Form Container --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-10">

            {{-- Error Alerts --}}
            @if ($errors->any())
                <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 text-xs sm:text-sm mb-6 space-y-1">
                    <strong class="block font-bold">Please correct the following errors:</strong>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('seminars.register.submit', $seminar->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Honeypot Spam Protection --}}
                <div style="display:none;">
                    <input type="text" name="website_url" value="">
                </div>

                <div class="text-sm font-bold uppercase tracking-wider text-[#0085FF] border-b border-slate-100 pb-2">
                    1. Participant Information
                </div>

                {{-- Full Name --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="full_name" value="{{ old('full_name', auth()->user()->name ?? '') }}" required placeholder="e.g. Dr. Tanvir Ahmed / Sarah Rahman" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                </div>

                {{-- Email & Phone --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required placeholder="your.name@example.com" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                        <span class="text-[11px] text-slate-400 mt-1 block">Your verification receipt & joining links will be sent here.</span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Mobile Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" required placeholder="e.g. 017XXXXXXXX" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                        <span class="text-[11px] text-slate-400 mt-1 block">Used for SMS / WhatsApp reminder updates.</span>
                    </div>
                </div>

                {{-- Organization & Designation --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Company / University <span class="text-slate-400 font-normal">(Optional)</span>
                        </label>
                        <input type="text" name="organization" value="{{ old('organization') }}" placeholder="e.g. Square Pharmaceuticals / Dhaka University" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Designation / Degree <span class="text-slate-400 font-normal">(Optional)</span>
                        </label>
                        <input type="text" name="designation" value="{{ old('designation') }}" placeholder="e.g. QA Executive / M.Pharm Student" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                    </div>
                </div>

                {{-- Participation Type Selection --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">
                        Preferred Attendance Format <span class="text-red-500">*</span>
                    </label>

                    @if($seminar->participation_type === 'both')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="flex items-center gap-3 p-4 rounded-2xl border-2 cursor-pointer transition-all hover:border-[#0085FF] has-checked:border-[#0085FF] has-checked:bg-blue-50/50">
                                <input type="radio" name="participation_type" value="online" {{ old('participation_type', 'online') === 'online' ? 'checked' : '' }} class="w-4 h-4 text-[#0085FF] focus:ring-[#0085FF]">
                                <div>
                                    <div class="font-bold text-sm text-[#00245A]">🌐 Online Participation</div>
                                    <div class="text-xs text-slate-500">Live HD interactive session from anywhere</div>
                                </div>
                            </label>

                            <label class="flex items-center gap-3 p-4 rounded-2xl border-2 cursor-pointer transition-all hover:border-[#0085FF] has-checked:border-[#0085FF] has-checked:bg-blue-50/50">
                                <input type="radio" name="participation_type" value="offline" {{ old('participation_type') === 'offline' ? 'checked' : '' }} class="w-4 h-4 text-[#0085FF] focus:ring-[#0085FF]">
                                <div>
                                    <div class="font-bold text-sm text-[#00245A]">🏢 In-Person Attendance</div>
                                    <div class="text-xs text-slate-500">Attend at our corporate seminar hall</div>
                                </div>
                            </label>
                        </div>
                    @elseif($seminar->participation_type === 'online')
                        <div class="p-3.5 rounded-xl bg-sky-50 border border-sky-200 text-sky-900 text-xs font-semibold flex items-center gap-2">
                            <span>🌐 This seminar is exclusively conducted <strong>Online</strong>.</span>
                            <input type="hidden" name="participation_type" value="online">
                        </div>
                    @else
                        <div class="p-3.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs font-semibold flex items-center gap-2">
                            <span>🏢 This seminar is exclusively conducted <strong>In-Person (Offline)</strong>.</span>
                            <input type="hidden" name="participation_type" value="offline">
                        </div>
                    @endif
                </div>

                {{-- Payment Instructions Section --}}
                <div class="pt-4">
                    <div class="text-sm font-bold uppercase tracking-wider text-[#0085FF] border-b border-slate-100 pb-2 mb-4">
                        2. Payment & Verification
                    </div>

                    <div class="bg-gradient-to-tr from-pink-500/10 via-purple-500/5 to-blue-500/10 rounded-2xl p-5 border border-pink-200/80 mb-5">
                        <div class="flex items-center justify-between mb-3">
                            <span class="font-bold text-sm text-pink-900 flex items-center gap-1.5">
                                <span>📱 {{ $defaultPaymentMethod }} Send Money Instructions</span>
                            </span>
                            <span class="text-xs font-extrabold text-pink-700 bg-white px-2.5 py-1 rounded-md border border-pink-200">
                                Fee: ৳{{ number_format($seminar->registration_fee, 0) }} BDT
                            </span>
                        </div>

                        <div class="text-xs text-slate-700 space-y-2 mb-4">
                            <p>1. Open your <strong>bKash App</strong> or dial <strong>*247#</strong>.</p>
                            <p>2. Select <strong>Send Money</strong>.</p>
                            <p>3. Enter the official account number:</p>
                        </div>

                        <div class="flex items-center justify-between bg-white px-4 py-3 rounded-xl border border-pink-200 shadow-2xs mb-4">
                            <div>
                                <span class="text-[10px] uppercase font-bold text-slate-400 block">bKash Personal Number</span>
                                <span class="font-mono font-extrabold text-base text-[#00245A]" id="bkashNumberText">{{ $defaultBkashNumber }}</span>
                            </div>
                            <button type="button" onclick="navigator.clipboard.writeText('{{ $defaultBkashNumber }}'); alert('bKash Number Copied: {{ $defaultBkashNumber }}');" class="px-3 py-1.5 rounded-lg bg-pink-100 hover:bg-pink-200 text-pink-800 text-xs font-bold transition-colors">
                                Copy Number
                            </button>
                        </div>

                        <p class="text-[11px] text-slate-500 italic">
                            * Note: Once you complete Send Money, enter the 10-character Transaction ID (TrxID) below. You can also upload a screenshot of your payment confirmation.
                        </p>
                    </div>

                    {{-- Transaction ID --}}
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            bKash Transaction ID (TrxID)
                        </label>
                        <input type="text" name="transaction_id" value="{{ old('transaction_id') }}" placeholder="e.g. BL459XK78Q" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-mono uppercase focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                        <span class="text-[11px] text-slate-400 mt-1 block">Found in the SMS confirmation from bKash or inside your bKash statement.</span>
                    </div>

                    {{-- Screenshot Upload --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Payment Screenshot / Receipt <span class="text-slate-400 font-normal">(Optional, recommended)</span>
                        </label>
                        <input type="file" name="payment_screenshot" accept="image/jpeg,image/png,image/webp" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#0085FF] file:text-white hover:file:bg-[#0070d9]">
                        <span class="text-[11px] text-slate-400 mt-1 block">Formats: JPG, PNG, WebP (Max 5MB). Accelerates payment verification.</span>
                    </div>
                </div>

                {{-- Terms Checkbox --}}
                <div class="pt-4 border-t border-slate-100">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="terms_agreed" value="1" {{ old('terms_agreed') ? 'checked' : '' }} required class="w-4 h-4 mt-0.5 rounded text-[#0085FF] focus:ring-[#0085FF]">
                        <span class="text-xs text-slate-600 leading-relaxed">
                            I confirm that the information provided is accurate, and I agree to the <a href="{{ route('seminars.show', $seminar->slug) }}" target="_blank" class="text-[#0085FF] underline font-semibold">Terms and Conditions</a> of Pharma Career Compass. I understand my seat will be reserved upon administrative verification of my bKash transaction.
                        </span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-[#0085FF] hover:bg-[#0070d9] text-white font-extrabold text-base shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                        <span>{{ $isWaitlist ? 'Submit Waitlist Application' : 'Complete Registration & Submit Payment' }}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    <p class="text-center text-[11px] text-slate-400 mt-3">
                        🔒 Safe & Secure. Your personal details are strictly used for session logistics and attendance confirmation.
                    </p>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
