@extends('layouts.app')

@section('title', 'Exam: ' . $category->name . ' | Pharma Career Compass')

@section('content')
<section class="py-10 bg-white min-h-[90vh]" 
         x-data="{
            totalSeconds: {{ ($category->default_time_minutes ?: 15) * 60 }},
            secondsLeft: {{ ($category->default_time_minutes ?: 15) * 60 }},
            timerString: '',
            timerInterval: null,
            timeTaken: 0,
            initTimer() {
                this.updateDisplay();
                this.timerInterval = setInterval(() => {
                    if (this.secondsLeft > 0) {
                        this.secondsLeft--;
                        this.timeTaken++;
                        this.updateDisplay();
                    } else {
                        clearInterval(this.timerInterval);
                        alert('Time is up! Submitting your assessment answers now.');
                        document.getElementById('examForm').submit();
                    }
                }, 1000);
            },
            updateDisplay() {
                const mins = Math.floor(this.secondsLeft / 60);
                const secs = this.secondsLeft % 60;
                this.timerString = (mins < 10 ? '0' : '') + mins + ':' + (secs < 10 ? '0' : '') + secs;
            }
         }"
         x-init="initTimer()">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Sticky Timer & Header Bar -->
        <div class="sticky top-20 z-40 bg-white/95 backdrop-blur-md border border-slate-200 rounded-2xl p-4 shadow-md flex items-center justify-between mb-8">
            <div class="text-left">
                <span class="text-[11px] font-bold text-[#0085FF] uppercase tracking-wider block">Timed Assessment</span>
                <h1 class="text-base sm:text-lg font-extrabold text-[#00245A] truncate max-w-sm sm:max-w-md">
                    {{ $category->name }}
                </h1>
            </div>

            <!-- Countdown Timer Gauge -->
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <span class="text-[10px] text-slate-500 block uppercase font-bold tracking-wider">Time Remaining</span>
                    <span class="text-lg sm:text-xl font-mono font-black text-[#00245A]" :class="secondsLeft < 180 ? 'text-red-600 animate-pulse' : ''" x-text="timerString">
                        15:00
                    </span>
                </div>
                <button type="button" onclick="if(confirm('Are you ready to submit your exam answers?')) document.getElementById('examForm').submit();" class="btn-primary text-xs py-2 px-4 shadow-sm hover:shadow">
                    Submit Test
                </button>
            </div>
        </div>

        <!-- Exam Questions Form -->
        <form id="examForm" action="{{ route('practice.exam.submit', $category->slug) }}" method="POST" class="space-y-6 text-left">
            @csrf
            <input type="hidden" name="time_taken_seconds" :value="timeTaken">

            @foreach($questions as $index => $q)
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-xs relative">
                    <div class="flex items-center justify-between mb-4">
                        <span class="w-8 h-8 rounded-lg bg-blue-100 text-[#0085FF] flex items-center justify-center font-bold text-xs">
                            #{{ $index + 1 }}
                        </span>
                        <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                            {{ ucfirst($q->difficulty) }} Level
                        </span>
                    </div>

                    <h3 class="text-base sm:text-lg font-bold text-[#00245A] mb-5 leading-snug">
                        {{ $q->question_text }}
                    </h3>

                    <!-- Options Grid -->
                    <div class="space-y-2.5">
                        <label class="p-3.5 rounded-xl border border-slate-200 hover:border-[#0085FF] hover:bg-blue-50/30 transition-all flex items-start gap-3 cursor-pointer">
                            <input type="radio" name="answers[{{ $q->id }}]" value="a" class="w-4 h-4 text-[#0085FF] mt-0.5">
                            <span class="text-xs sm:text-sm text-slate-700 leading-relaxed"><strong class="text-slate-800">A.</strong> {{ $q->option_a }}</span>
                        </label>

                        <label class="p-3.5 rounded-xl border border-slate-200 hover:border-[#0085FF] hover:bg-blue-50/30 transition-all flex items-start gap-3 cursor-pointer">
                            <input type="radio" name="answers[{{ $q->id }}]" value="b" class="w-4 h-4 text-[#0085FF] mt-0.5">
                            <span class="text-xs sm:text-sm text-slate-700 leading-relaxed"><strong class="text-slate-800">B.</strong> {{ $q->option_b }}</span>
                        </label>

                        <label class="p-3.5 rounded-xl border border-slate-200 hover:border-[#0085FF] hover:bg-blue-50/30 transition-all flex items-start gap-3 cursor-pointer">
                            <input type="radio" name="answers[{{ $q->id }}]" value="c" class="w-4 h-4 text-[#0085FF] mt-0.5">
                            <span class="text-xs sm:text-sm text-slate-700 leading-relaxed"><strong class="text-slate-800">C.</strong> {{ $q->option_c }}</span>
                        </label>

                        <label class="p-3.5 rounded-xl border border-slate-200 hover:border-[#0085FF] hover:bg-blue-50/30 transition-all flex items-start gap-3 cursor-pointer">
                            <input type="radio" name="answers[{{ $q->id }}]" value="d" class="w-4 h-4 text-[#0085FF] mt-0.5">
                            <span class="text-xs sm:text-sm text-slate-700 leading-relaxed"><strong class="text-slate-800">D.</strong> {{ $q->option_d }}</span>
                        </label>
                    </div>
                </div>
            @endforeach

            <!-- Bottom Submit Button -->
            <div class="pt-6 pb-12 text-center">
                <button type="submit" class="btn-accent text-base py-3.5 px-10 shadow-md hover:shadow-lg font-bold">
                    Finish & Submit Examination Answers &rarr;
                </button>
            </div>
        </form>

    </div>
</section>
@endsection
