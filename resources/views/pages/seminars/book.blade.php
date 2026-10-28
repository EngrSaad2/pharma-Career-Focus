@extends('layouts.app')

@section('title', 'Book Seminars Seat | Pharmaceutical Career Development Program')
@section('meta_description', 'Reserve your seat for the Pharmaceutical Career Development Program (PCDP). Live interactive cohort sessions every Friday and Saturday for Industrial Operations and Pharma Marketing.')

@section('content')
<div class="min-h-screen py-10 sm:py-14"
     style="background-color: #f8fafc !important;"
     x-data="{
        selectedModules: {{ $preselected === '1' ? "['1']" : ($preselected === '2' ? "['2']" : "['1', '2']") }},
        pricePerModule: 1000,
        copiedNumber: false,
        get totalAmount() {
            return this.selectedModules.length * this.pricePerModule;
        },
        isModuleSelected(id) {
            return this.selectedModules.includes(String(id));
        },
        toggleModule(id) {
            id = String(id);
            if (this.selectedModules.includes(id)) {
                if (this.selectedModules.length > 1) {
                    this.selectedModules = this.selectedModules.filter(m => m !== id);
                } else {
                    // Prevent deselecting all
                    alert('Please select at least one module (Module 1, Module 2, or Both).');
                }
            } else {
                this.selectedModules.push(id);
            }
        },
        selectBoth() {
            this.selectedModules = ['1', '2'];
        },
        selectOnly(id) {
            this.selectedModules = [String(id)];
        },
        copyBkash(num) {
            navigator.clipboard.writeText(num);
            this.copiedNumber = true;
            setTimeout(() => this.copiedNumber = false, 2500);
        }
     }">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#0085FF]">Home</a>
            <span>/</span>
            <a href="{{ route('seminars.index') }}" class="hover:text-[#0085FF]">Seminars</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold">Book Seminars Seat</span>
        </nav>

        {{-- Header / Hero Card --}}
        <div class="rounded-3xl p-6 sm:p-10 text-white shadow-xl mb-8 relative overflow-hidden" style="background-color: #00245A !important; color: #ffffff !important;">
            <div class="relative z-10 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider mb-4 shadow-xs" style="background-color: #FFCD00 !important; color: #00245A !important;">
                    <span>Pharmaceutical Career Development Program</span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-white tracking-tight leading-tight">
                    Book Seminars Seat
                </h1>
                <p class="text-sm sm:text-base text-blue-100/90 mt-2.5 leading-relaxed font-normal">
                    Building Your Future in the Pharmaceutical Industry. Live interactive cohorts conducted every <strong>Friday and Saturday</strong>. Select one or both modules to reserve your seat (BDT 1,000 per module).
                </p>

                <div class="flex flex-wrap items-center gap-4 mt-5 text-xs text-blue-200">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg" style="background-color: #003882 !important; color: #ffffff !important;">
                        📅 <strong>Session Days:</strong> Friday & Saturday
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg" style="background-color: #003882 !important; color: #ffffff !important;">
                        ⏱️ <strong>Time:</strong> 7:30 PM – 10:00 PM (BST)
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg" style="background-color: #003882 !important; color: #ffffff !important;">
                        🌐 <strong>Mode:</strong> Online Live (Google Meet)
                    </span>
                </div>
            </div>

            {{-- Decorative pattern overlay --}}
            <div class="absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-white/5 pointer-events-none"></div>
        </div>

        {{-- Validation Error Alerts --}}
        @if ($errors->any())
            <div class="p-5 rounded-2xl bg-red-50 border border-red-200 text-red-800 text-xs sm:text-sm mb-8 space-y-1 shadow-xs">
                <strong class="block font-bold">Please review and correct the errors below:</strong>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Main Booking Form --}}
        <form action="{{ route('seminars.book.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- Honeypot Spam Protection --}}
            <div style="display:none;">
                <input type="text" name="website_url" value="">
            </div>

            {{-- ========================================================================= --}}
            {{-- STEP 1: SELECT MODULE(S) --}}
            {{-- ========================================================================= --}}
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-[#0085FF] block">Step 1</span>
                        <h2 class="text-lg sm:text-xl font-black text-[#00245A]">Select Your Module(s)</h2>
                    </div>

                    {{-- Quick Module Preset Buttons --}}
                    <div class="flex items-center gap-2">
                        <button type="button" @click="selectBoth()" 
                                class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all"
                                :class="selectedModules.length === 2 ? 'bg-[#00245A] text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'">
                            Both Modules (৳2,000)
                        </button>
                        <button type="button" @click="selectOnly('1')" 
                                class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all"
                                :class="selectedModules.length === 1 && selectedModules.includes('1') ? 'bg-[#00245A] text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'">
                            Module 1 (Friday)
                        </button>
                        <button type="button" @click="selectOnly('2')" 
                                class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all"
                                :class="selectedModules.length === 1 && selectedModules.includes('2') ? 'bg-[#00245A] text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'">
                            Module 2 (Saturday)
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- MODULE 1 CARD: Industrial Operations (Friday) --}}
                    <div class="relative rounded-2xl border-2 transition-all duration-200 p-5 sm:p-6 cursor-pointer flex flex-col justify-between shadow-xs"
                         :style="isModuleSelected('1') ? 'background-color: #eff6ff !important; border-color: #0085FF !important;' : 'background-color: #ffffff !important; border-color: #e2e8f0 !important;'"
                         @click="toggleModule('1')">
                        
                        <div>
                            <div class="flex items-start justify-between gap-3 mb-3">
                                <span class="inline-flex items-center gap-1.5 text-[11px] font-black uppercase tracking-wider bg-[#FFCD00] text-[#00245A] px-2.5 py-0.5 rounded-full shadow-2xs">
                                    Module 1
                                </span>
                                <div class="w-5 h-5 rounded-md border flex items-center justify-center shrink-0 transition-all"
                                     :class="isModuleSelected('1') ? 'bg-[#0085FF] border-[#0085FF] text-white' : 'border-slate-300 bg-white'">
                                    <svg x-show="isModuleSelected('1')" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </div>

                            <input type="checkbox" name="modules[]" value="1" x-model="selectedModules" class="sr-only">

                            <h3 class="text-base sm:text-lg font-black text-[#00245A] leading-tight mb-2">
                                Module 1: Career in Pharmaceutical Industrial Operations
                            </h3>

                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-white border border-blue-200 text-[#00245A] text-xs font-bold mb-3 shadow-2xs">
                                <span>📅 Day: <strong>Friday</strong> (7:30 PM - 10:00 PM)</span>
                            </div>

                            <div class="text-xs text-slate-500 mb-3">
                                <strong>Upcoming Session:</strong> 
                                <span class="font-bold text-slate-700">
                                    {{ $module1 && $module1->start_date ? $module1->start_date->format('l, F j, Y') : 'Every Friday' }}
                                </span>
                            </div>

                            <p class="text-xs text-slate-600 leading-relaxed mb-4">
                                Comprehensive preparation for key plant departments: <strong>Production, Quality Assurance (QA), Quality Control (QC), R&D, PPIC & Regulatory Affairs</strong>.
                            </p>
                        </div>

                        <div class="pt-3 border-t border-slate-200/80 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] uppercase font-bold text-slate-400 block">Registration Fee</span>
                                <span class="text-lg font-black text-[#00245A]">৳1,000 <span class="text-xs font-normal text-slate-500">BDT</span></span>
                            </div>
                            <span class="text-xs font-bold" :class="isModuleSelected('1') ? 'text-[#0085FF]' : 'text-slate-400'">
                                <span x-text="isModuleSelected('1') ? '✓ Selected' : '+ Click to Select'"></span>
                            </span>
                        </div>
                    </div>

                    {{-- MODULE 2 CARD: Pharmaceutical Marketing (Saturday) --}}
                    <div class="relative rounded-2xl border-2 transition-all duration-200 p-5 sm:p-6 cursor-pointer flex flex-col justify-between shadow-xs"
                         :style="isModuleSelected('2') ? 'background-color: #eff6ff !important; border-color: #0085FF !important;' : 'background-color: #ffffff !important; border-color: #e2e8f0 !important;'"
                         @click="toggleModule('2')">
                        
                        <div>
                            <div class="flex items-start justify-between gap-3 mb-3">
                                <span class="inline-flex items-center gap-1.5 text-[11px] font-black uppercase tracking-wider bg-[#FFCD00] text-[#00245A] px-2.5 py-0.5 rounded-full shadow-2xs">
                                    Module 2
                                </span>
                                <div class="w-5 h-5 rounded-md border flex items-center justify-center shrink-0 transition-all"
                                     :class="isModuleSelected('2') ? 'bg-[#0085FF] border-[#0085FF] text-white' : 'border-slate-300 bg-white'">
                                    <svg x-show="isModuleSelected('2')" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </div>

                            <input type="checkbox" name="modules[]" value="2" x-model="selectedModules" class="sr-only">

                            <h3 class="text-base sm:text-lg font-black text-[#00245A] leading-tight mb-2">
                                Module 2: Career in Pharmaceutical Marketing
                            </h3>

                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-white border border-blue-200 text-[#00245A] text-xs font-bold mb-3 shadow-2xs">
                                <span>📅 Day: <strong>Saturday</strong> (7:30 PM - 10:00 PM)</span>
                            </div>

                            <div class="text-xs text-slate-500 mb-3">
                                <strong>Upcoming Session:</strong> 
                                <span class="font-bold text-slate-700">
                                    {{ $module2 && $module2->start_date ? $module2->start_date->format('l, F j, Y') : 'Every Saturday' }}
                                </span>
                            </div>

                            <p class="text-xs text-slate-600 leading-relaxed mb-4">
                                Career preparation for pharmaceutical marketing professionals: <strong>Sales & Brand Management (SBMD), International Business (IBD), CV & Viva techniques</strong>.
                            </p>
                        </div>

                        <div class="pt-3 border-t border-slate-200/80 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] uppercase font-bold text-slate-400 block">Registration Fee</span>
                                <span class="text-lg font-black text-[#00245A]">৳1,000 <span class="text-xs font-normal text-slate-500">BDT</span></span>
                            </div>
                            <span class="text-xs font-bold" :class="isModuleSelected('2') ? 'text-[#0085FF]' : 'text-slate-400'">
                                <span x-text="isModuleSelected('2') ? '✓ Selected' : '+ Click to Select'"></span>
                            </span>
                        </div>
                    </div>

                </div>

                {{-- Live Selection & Pricing Bar (Solid Background) --}}
                <div class="rounded-2xl p-5 sm:p-6 text-white flex flex-col sm:flex-row items-center justify-between gap-4 shadow-md"
                     style="background-color: #00245A !important; color: #ffffff !important;">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 text-xl shadow-xs" style="background-color: #003882 !important;">
                            🎟️
                        </div>
                        <div>
                            <div class="text-xs font-semibold" style="color: #cbd5e1 !important;">
                                Currently Selected: <strong class="font-black text-white" x-text="selectedModules.length + ' Module(s)'"></strong>
                            </div>
                            <div class="text-xs font-bold mt-1" style="color: #FFCD00 !important;">
                                <span x-show="selectedModules.length === 2">Full 2-Day Track (Friday & Saturday sessions)</span>
                                <span x-show="selectedModules.length === 1 && selectedModules.includes('1')">Module 1 only (Friday Industrial Operations session)</span>
                                <span x-show="selectedModules.length === 1 && selectedModules.includes('2')">Module 2 only (Saturday Marketing session)</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center sm:text-right shrink-0">
                        <span class="text-[10px] font-bold uppercase tracking-wider block" style="color: #94a3b8 !important;">Total Investment</span>
                        <div class="text-2xl sm:text-3xl font-black" style="color: #FFCD00 !important;">
                            ৳<span x-text="totalAmount.toLocaleString()"></span> <span class="text-xs font-normal text-white">BDT</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================================================= --}}
            {{-- STEP 2: PARTICIPANT INFORMATION --}}
            {{-- ========================================================================= --}}
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
                <div class="pb-4 border-b border-slate-100">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#0085FF] block">Step 2</span>
                    <h2 class="text-lg sm:text-xl font-black text-[#00245A]">Participant Information</h2>
                </div>

                {{-- Full Name --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="full_name" 
                           value="{{ old('full_name', auth()->user()->name ?? '') }}" 
                           required 
                           placeholder="e.g. Tanvir Ahmed / Sarah Rahman" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                </div>

                {{-- Email & Phone --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email', auth()->user()->email ?? '') }}" 
                               required 
                               placeholder="your.email@example.com" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                        <span class="text-[11px] text-slate-400 mt-1 block">Your official admission ticket and session Google Meet link will be sent here.</span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Mobile Number (WhatsApp) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="phone" 
                               value="{{ old('phone', auth()->user()->phone ?? '') }}" 
                               required 
                               placeholder="e.g. 017XXXXXXXX" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                        <span class="text-[11px] text-slate-400 mt-1 block">Used for SMS / WhatsApp session reminders and logistical updates.</span>
                    </div>
                </div>

                {{-- Organization & Designation --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Current University / Company <span class="text-slate-400 font-normal">(Optional)</span>
                        </label>
                        <input type="text" 
                               name="organization" 
                               value="{{ old('organization') }}" 
                               placeholder="e.g. University of Dhaka / Incepta Pharmaceuticals" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Academic Level / Designation <span class="text-slate-400 font-normal">(Optional)</span>
                        </label>
                        <input type="text" 
                               name="designation" 
                               value="{{ old('designation') }}" 
                               placeholder="e.g. 4th Year B.Pharm / QA Executive" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                    </div>
                </div>

                {{-- Mode Notice --}}
                <div class="p-3.5 rounded-xl bg-sky-50 border border-sky-200 text-sky-900 text-xs font-semibold flex items-center gap-2.5">
                    <span class="text-base">🌐</span>
                    <span>These sessions are conducted <strong>Online (Live Interactive via Google Meet)</strong>. You will receive joining coordinates automatically upon bKash payment verification.</span>
                </div>
            </div>

            {{-- ========================================================================= --}}
            {{-- STEP 3: MANUAL BKASH PAYMENT & VERIFICATION --}}
            {{-- ========================================================================= --}}
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
                <div class="pb-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-[#0085FF] block">Step 3</span>
                        <h2 class="text-lg sm:text-xl font-black text-[#00245A]">bKash Manual Payment & Verification</h2>
                    </div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-pink-50 border border-pink-200 text-pink-700 text-xs font-bold">
                        <span>📱 bKash Send Money</span>
                    </div>
                </div>

                {{-- bKash Instruction Card (Solid Background & Solid Colors) --}}
                <div class="rounded-2xl p-5 sm:p-6 space-y-4 shadow-xs" style="background-color: #fff1f2 !important; border: 2px solid #fecdd3 !important;">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2.5">
                            <span class="w-9 h-9 rounded-xl flex items-center justify-center font-black text-base shrink-0 shadow-xs" style="background-color: #E2136E !important; color: #ffffff !important;">
                                ৳
                            </span>
                            <div>
                                <span class="font-extrabold text-sm block" style="color: #881337 !important;">Official bKash Account</span>
                                <span class="text-xs font-bold" style="color: #be123c !important;">Personal (Send Money)</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] uppercase font-bold text-slate-500 block">Amount to Send</span>
                            <span class="text-xl font-black" style="color: #E2136E !important;">৳<span x-text="totalAmount.toLocaleString()"></span> BDT</span>
                        </div>
                    </div>

                    {{-- Step list (Solid white) --}}
                    <div class="text-xs text-slate-800 space-y-2 p-4 rounded-xl shadow-2xs" style="background-color: #ffffff !important; border: 1px solid #fecdd3 !important;">
                        <p>1. Open your <strong>bKash App</strong> or dial <strong>*247#</strong>.</p>
                        <p>2. Select <strong>Send Money</strong>.</p>
                        <p>3. Enter the account number below and send exactly <strong>৳<span x-text="totalAmount.toLocaleString()"></span> BDT</strong>.</p>
                        <p>4. After sending, enter your <strong>Sender Number</strong> and <strong>TrxID</strong> in the fields below.</p>
                    </div>

                    {{-- Number Copy Strip (Solid white with solid border & solid button) --}}
                    <div class="flex items-center justify-between px-4 py-3.5 rounded-xl shadow-xs" style="background-color: #ffffff !important; border: 2px solid #f43f5e !important;">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">bKash Personal Account Number</span>
                            <span class="font-mono font-black text-lg sm:text-xl tracking-wider" style="color: #00245A !important;">{{ $defaultBkashNumber }}</span>
                        </div>
                        <button type="button" 
                                @click="copyBkash('{{ $defaultBkashNumber }}')" 
                                class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer shadow-xs"
                                :style="copiedNumber ? 'background-color: #059669 !important; color: #ffffff !important;' : 'background-color: #E2136E !important; color: #ffffff !important;'">
                            <span x-text="copiedNumber ? '✓ Copied!' : 'Copy Number'"></span>
                        </button>
                    </div>
                </div>

                {{-- Manual Payment Input Fields --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- bKash Sender Number --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            bKash Sender Mobile Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="sender_number" 
                               value="{{ old('sender_number') }}" 
                               required 
                               placeholder="e.g. 017XXXXXXXX" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-mono focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                        <span class="text-[11px] text-slate-400 mt-1 block">The mobile number from which you initiated Send Money.</span>
                    </div>

                    {{-- Transaction ID --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            bKash Transaction ID (TrxID) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="transaction_id" 
                               value="{{ old('transaction_id') }}" 
                               required 
                               placeholder="e.g. BL459XK78Q" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-mono uppercase focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                        <span class="text-[11px] text-slate-400 mt-1 block">Found in your bKash SMS confirmation or app statement.</span>
                    </div>
                </div>

                {{-- Payment Screenshot Upload --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Payment Screenshot / Receipt <span class="text-slate-400 font-normal">(Optional, recommended)</span>
                    </label>
                    <input type="file" 
                           name="payment_screenshot" 
                           accept="image/jpeg,image/png,image/webp" 
                           class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#0085FF] file:text-white hover:file:bg-[#0070d9]">
                    <span class="text-[11px] text-slate-400 mt-1 block">JPG, PNG, WebP (Max 5MB). Accelerates administrative verification of your seat.</span>
                </div>

                {{-- Terms Checkbox --}}
                <div class="pt-4 border-t border-slate-100">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" 
                               name="terms_agreed" 
                               value="1" 
                               {{ old('terms_agreed') ? 'checked' : '' }} 
                               required 
                               class="w-4 h-4 mt-0.5 rounded text-[#0085FF] focus:ring-[#0085FF]">
                        <span class="text-xs text-slate-600 leading-relaxed">
                            I confirm that I have sent <strong>৳<span x-text="totalAmount.toLocaleString()"></span> BDT</strong> via bKash and that the submitted TrxID is genuine. I understand my seat will be reserved and verified by the Pharma Career Compass admin team.
                        </span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <div class="pt-3">
                    <button type="submit" 
                            style="white-space: nowrap !important;" 
                            class="w-full py-4 px-6 rounded-2xl bg-[#0085FF] hover:bg-[#0070d9] text-white font-extrabold text-base shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 whitespace-nowrap cursor-pointer">
                        <span style="white-space: nowrap;">
                            Book Seminars Seat • Complete Registration (৳<span x-text="totalAmount.toLocaleString()"></span> BDT)
                        </span>
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    <p class="text-center text-[11px] text-slate-400 mt-3">
                        🔒 Safe & Secure. Your official confirmation pass will be displayed immediately upon submission.
                    </p>
                </div>

            </div>

        </form>

    </div>
</div>
@endsection