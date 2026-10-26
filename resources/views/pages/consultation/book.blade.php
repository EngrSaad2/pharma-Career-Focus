@extends('layouts.app')

@section('title', 'Book a Consultation | Pharma Career Compass')
@section('meta_description', 'Book a 1-on-1 pharmaceutical career consultation or mock interview with an industry veteran. Check live availability and select your preferred date and time.')

@section('content')
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8"
         x-data="{
            consultantId: '{{ $selectedConsultantId }}',
            serviceId: '{{ $selectedServiceId }}',
            selectedDate: '{{ now()->addDay()->format('Y-m-d') }}',
            selectedSlot: '',
            slots: [],
            loadingSlots: false,
            slotsMessage: '',
            async fetchSlots() {
                if (!this.consultantId || !this.selectedDate) return;
                this.loadingSlots = true;
                this.selectedSlot = '';
                this.slots = [];
                try {
                    const res = await fetch(`{{ route('booking.slots') }}?consultant_id=${this.consultantId}&date=${this.selectedDate}`);
                    const data = await res.json();
                    this.slots = data.slots || [];
                    this.slotsMessage = data.message || '';
                } catch(e) {
                    this.slotsMessage = 'Could not load availability. Please select another date.';
                } finally {
                    this.loadingSlots = false;
                }
            },
            init() {
                this.fetchSlots();
            }
         }">

        <!-- Header -->
        <div class="text-center mb-10 space-y-2">
            <span class="inline-flex items-center text-[11px] font-semibold uppercase tracking-wider text-slate-600 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                Live Booking Calendar
            </span>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                Schedule Your 1-on-1 Pharmaceutical Consultation
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 max-w-xl mx-auto">
                Select your preferred industry mentor, consultation focus, date, and verified open time slot.
            </p>
        </div>

        <form action="{{ route('booking.store') }}" method="POST" class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-10 shadow-sm text-left space-y-8">
            @csrf

            <!-- STEP 1: Select Consultant -->
            <div class="space-y-4">
                <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded-md bg-slate-900 text-white flex items-center justify-center font-bold text-xs shrink-0">1</span>
                    <h2 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight">Select Your Consultant / Mentor</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    @foreach($consultants as $c)
                        <label class="relative p-4 rounded-xl border cursor-pointer transition-all flex items-start gap-3.5 bg-white text-left group"
                               :class="consultantId == '{{ $c->id }}' ? 'border-slate-900 ring-2 ring-slate-900 shadow-sm' : 'border-slate-200 hover:border-slate-400 shadow-2xs'">
                            <input type="radio" 
                                   name="consultant_id" 
                                   value="{{ $c->id }}" 
                                   x-model="consultantId" 
                                   @change="fetchSlots()" 
                                   class="sr-only">
                            
                            <!-- Custom Modern Radio Indicator -->
                            <div class="mt-0.5 w-4 h-4 rounded-full border flex items-center justify-center shrink-0 transition-colors"
                                 :class="consultantId == '{{ $c->id }}' ? 'border-slate-900 bg-slate-900' : 'border-slate-300 bg-white group-hover:border-slate-400'">
                                <div class="w-1.5 h-1.5 rounded-full bg-white" x-show="consultantId == '{{ $c->id }}'"></div>
                            </div>
                            
                            @if($c->avatar)
                                <img src="{{ asset($c->avatar) }}" alt="{{ $c->name }}" class="w-11 h-11 rounded-lg object-cover object-top shrink-0 border border-slate-200">
                            @else
                                <div class="w-11 h-11 rounded-lg bg-slate-100 border border-slate-200 text-slate-800 flex items-center justify-center font-semibold text-xs shrink-0 tracking-wider">
                                    {{ substr($c->name, 0, 2) }}
                                </div>
                            @endif

                            <div class="flex-grow min-w-0">
                                <div class="flex items-baseline justify-between gap-2">
                                    <span class="font-bold text-sm text-slate-900 truncate">{{ $c->name }}</span>
                                    <span class="text-sm font-bold text-slate-900 tabular-nums shrink-0">৳{{ number_format($c->hourly_rate, 0) }}</span>
                                </div>
                                <div class="text-xs text-slate-600 font-medium mt-0.5">{{ $c->title }}</div>
                                <div class="text-[11px] text-slate-400 mt-1 leading-tight">{{ $c->specialization }} • {{ $c->experience_years }}+ yrs exp</div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- STEP 2: Select Service Package -->
            <div class="pt-8 border-t border-slate-200 space-y-4">
                <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded-md bg-slate-900 text-white flex items-center justify-center font-bold text-xs shrink-0">2</span>
                    <h2 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight">Select Consultation Service</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($services as $s)
                        <label class="relative p-3.5 rounded-xl border cursor-pointer transition-all flex items-center justify-between gap-3 bg-white group text-left"
                               :class="serviceId == '{{ $s->id }}' ? 'border-slate-900 ring-2 ring-slate-900 shadow-sm' : 'border-slate-200 hover:border-slate-400 shadow-2xs'">
                            <div class="flex items-center gap-3 min-w-0">
                                <input type="radio" 
                                       name="service_id" 
                                       value="{{ $s->id }}" 
                                       x-model="serviceId" 
                                       class="sr-only">
                                
                                <!-- Custom Modern Radio Indicator -->
                                <div class="w-4 h-4 rounded-full border flex items-center justify-center shrink-0 transition-colors"
                                     :class="serviceId == '{{ $s->id }}' ? 'border-slate-900 bg-slate-900' : 'border-slate-300 bg-white group-hover:border-slate-400'">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white" x-show="serviceId == '{{ $s->id }}'"></div>
                                </div>

                                <div class="min-w-0">
                                    <div class="font-bold text-xs sm:text-sm text-slate-900 truncate">{{ $s->title }}</div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">{{ $s->duration_minutes }} mins • {{ $s->delivery_mode }}</div>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-slate-900 tabular-nums shrink-0">
                                {{ $s->price == 0 ? 'Free' : '৳' . number_format($s->price, 0) }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- STEP 3: Select Date & Available Time Slot -->
            <div class="pt-8 border-t border-slate-200 space-y-4">
                <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded-md bg-slate-900 text-white flex items-center justify-center font-bold text-xs shrink-0">3</span>
                    <h2 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight">Choose Date & Time Slot (BST / Dhaka Time)</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 items-start">
                    <!-- Date Input -->
                    <div class="sm:col-span-5 space-y-2">
                        <label class="block text-xs font-bold text-slate-900 uppercase tracking-wider">Select Consultation Date</label>
                        <input type="date" 
                               name="booking_date" 
                               x-model="selectedDate" 
                               @change="fetchSlots()" 
                               min="{{ now()->format('Y-m-d') }}" 
                               class="w-full text-sm px-3.5 py-2.5 border border-slate-200 rounded-xl focus:border-slate-900 focus:ring-1 focus:ring-slate-900 outline-none bg-white text-slate-900 transition-colors shadow-2xs">
                        <p class="text-[11px] text-slate-500">
                            Available days: Sunday, Tuesday, Thursday, Saturday (17:00 - 21:00 BST)
                        </p>
                    </div>

                    <!-- Live Slots Radio Grid -->
                    <div class="sm:col-span-7 space-y-2">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-bold text-slate-900 uppercase tracking-wider">Available Open Slots</label>
                            <span class="text-[10px] font-semibold text-slate-400">Bangladesh Standard Time (GMT+6)</span>
                        </div>
                        
                        <div x-show="loadingSlots" class="py-8 text-center text-xs text-slate-500">
                            <svg class="animate-spin h-5 w-5 text-slate-900 mx-auto mb-2" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                            Checking consultant calendar...
                        </div>

                        <div x-show="!loadingSlots && slots.length === 0" class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-600 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span x-text="slotsMessage || 'No available slots for this date. Please select another day.'"></span>
                        </div>

                        <div x-show="!loadingSlots && slots.length > 0" class="grid grid-cols-2 gap-2">
                            <template x-for="slot in slots" :key="slot.start">
                                <label class="p-2.5 rounded-lg border cursor-pointer transition-all flex items-center justify-between text-xs"
                                       :class="selectedSlot === slot.start ? 'border-slate-900 bg-slate-900 text-white font-semibold shadow-xs' : 'border-slate-200 bg-white text-slate-800 hover:border-slate-400'">
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="start_time" :value="slot.start" x-model="selectedSlot" class="sr-only">
                                        <div class="w-3.5 h-3.5 rounded-full border flex items-center justify-center shrink-0 transition-colors"
                                             :class="selectedSlot === slot.start ? 'border-white bg-white' : 'border-slate-300 bg-white'">
                                            <div class="w-1.5 h-1.5 rounded-full bg-slate-900" x-show="selectedSlot === slot.start"></div>
                                        </div>
                                        <span x-text="slot.display"></span>
                                    </div>
                                </label>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STEP 4: Candidate Information & Bangladeshi Payment Notice -->
            <div class="pt-8 border-t border-slate-200 space-y-4">
                <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded-md bg-slate-900 text-white flex items-center justify-center font-bold text-xs shrink-0">4</span>
                    <h2 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight">Your Contact & Academic Background</h2>
                </div>

                <!-- Payment Channels Card -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex items-start gap-3.5 text-left">
                    <div class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center font-bold text-sm shrink-0">
                        ৳
                    </div>
                    <div class="text-xs text-slate-600 leading-relaxed">
                        <span class="font-bold text-slate-900 block mb-0.5">Payment & Confirmation Information</span>
                        For paid consultation modules, payments can be made through <strong>bKash</strong>, <strong>Nagad</strong>, <strong>Rocket</strong>, or <strong>Bank Transfer (City Bank / DBBL)</strong>. Free 15-minute consultations require no payment. Payment instructions will appear on confirmation.
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div>
                        <label class="block text-xs font-semibold text-slate-900 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="client_name" required value="{{ auth()->user()?->name ?? old('client_name') }}" placeholder="e.g. Tanvir Hasan" class="w-full text-xs px-3.5 py-2.5 border border-slate-200 rounded-xl focus:border-slate-900 focus:ring-1 focus:ring-slate-900 outline-none bg-white text-slate-900 transition-colors shadow-2xs">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-900 mb-1.5">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="client_email" required value="{{ auth()->user()?->email ?? old('client_email') }}" placeholder="e.g. tanvir.pharma@gmail.com" class="w-full text-xs px-3.5 py-2.5 border border-slate-200 rounded-xl focus:border-slate-900 focus:ring-1 focus:ring-slate-900 outline-none bg-white text-slate-900 transition-colors shadow-2xs">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-900 mb-1.5">Mobile Number (BD) <span class="text-red-500">*</span></label>
                        <input type="text" name="client_phone" required value="{{ auth()->user()?->phone ?? old('client_phone') }}" placeholder="e.g. 01712-345678 or +880 1812-345678" class="w-full text-xs px-3.5 py-2.5 border border-slate-200 rounded-xl focus:border-slate-900 focus:ring-1 focus:ring-slate-900 outline-none bg-white text-slate-900 transition-colors shadow-2xs">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-900 mb-1.5">Current Qualification / University</label>
                        <input type="text" name="current_qualification" value="{{ auth()->user()?->profile?->education_level ?? old('current_qualification') }}" placeholder="e.g. B.Pharm (Final Year), DU / JU / NSU / RU" class="w-full text-xs px-3.5 py-2.5 border border-slate-200 rounded-xl focus:border-slate-900 focus:ring-1 focus:ring-slate-900 outline-none bg-white text-slate-900 transition-colors shadow-2xs">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-slate-900 mb-1.5">Target Department & Company</label>
                        <input type="text" name="target_goal" value="{{ old('target_goal') }}" placeholder="e.g. Seeking Trainee Officer role in QA/QC at Square, Incepta, or Beximco" class="w-full text-xs px-3.5 py-2.5 border border-slate-200 rounded-xl focus:border-slate-900 focus:ring-1 focus:ring-slate-900 outline-none bg-white text-slate-900 transition-colors shadow-2xs">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-slate-900 mb-1.5">Specific Questions or Topics You Wish to Discuss</label>
                        <textarea name="notes" rows="3" placeholder="Tell the consultant what you would like to focus on during your session (e.g. viva questions, written test format, CV tailoring)..." class="w-full text-xs px-3.5 py-2.5 border border-slate-200 rounded-xl focus:border-slate-900 focus:ring-1 focus:ring-slate-900 outline-none bg-white text-slate-900 transition-colors shadow-2xs">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
                <a href="{{ route('consultants.index') }}" class="text-xs font-semibold text-slate-500 hover:text-slate-900 transition-colors">
                    &larr; View Consultant Profiles
                </a>

                <button type="submit" 
                        :disabled="!selectedSlot || loadingSlots"
                        class="bg-slate-900 hover:bg-black text-white text-xs sm:text-sm font-semibold py-3 px-8 rounded-xl shadow-xs hover:shadow transition-all disabled:opacity-40 disabled:cursor-not-allowed">
                    Confirm Consultation Booking &rarr;
                </button>
            </div>
        </form>

    </div>
</section>
@endsection
