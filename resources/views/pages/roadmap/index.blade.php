@extends('layouts.app')

@section('title', 'Pharmaceutical Career Roadmap Builder | Pharma Career Compass')
@section('meta_description', 'Build a structured, milestone-based pharmaceutical career roadmap for Quality Assurance, QC, Production, or Regulatory Affairs. Track your learning progress step by step.')

@section('content')
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                Interactive Career Roadmap
            </span>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#00245A]">
                Pharmaceutical Career Roadmap Builder
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 max-w-xl mx-auto">
                Select your target pharmaceutical role and current career stage to generate a structured 4-phase preparation roadmap with actionable milestones.
            </p>
        </div>

        @if($userRoadmap)
            <!-- Existing Active Roadmap Display with Interactive Checkboxes -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-10 shadow-sm text-left mb-12 space-y-6"
                 x-data="{
                    progress: {{ $userRoadmap->progress_percent }},
                    async toggle(milestoneId) {
                        try {
                            const res = await fetch(`{{ url('/career-roadmap/milestone') }}/${milestoneId}/toggle`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            });
                            const data = await res.json();
                            if (data.success) {
                                this.progress = data.progress_percent;
                            }
                        } catch(e) {
                            console.error(e);
                        }
                    }
                 }">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF]">Your Active Career Roadmap</span>
                        <h2 class="text-2xl font-extrabold text-[#00245A] mt-1">{{ $userRoadmap->target_role_title }}</h2>
                        <div class="text-xs text-slate-500 mt-0.5">
                            Stage: <span class="font-semibold text-slate-700">{{ $userRoadmap->experience_level }}</span> • Timeline: <span class="font-semibold text-slate-700">{{ $userRoadmap->target_timeline_months }} Months</span>
                        </div>
                    </div>

                    <!-- Progress Gauge -->
                    <div class="w-full sm:w-56 text-right">
                        <div class="flex justify-between items-center text-xs font-bold text-slate-700 mb-1">
                            <span>Completion</span>
                            <span class="text-lg text-[#0085FF]" x-text="progress + '%'">{{ $userRoadmap->progress_percent }}%</span>
                        </div>
                        <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden border border-slate-200">
                            <div class="h-full bg-gradient-to-r from-[#0085FF] to-emerald-500 transition-all duration-300 rounded-full"
                                 :style="'width: ' + progress + '%'"></div>
                        </div>
                    </div>
                </div>

                <!-- Milestones Grouped by Phase -->
                <div class="space-y-6 pt-2">
                    @php
                        $groupedMilestones = $userRoadmap->milestones->groupBy('phase_name');
                    @endphp

                    @foreach($groupedMilestones as $phaseName => $items)
                        <div class="space-y-3">
                            <h3 class="font-bold text-sm text-[#00245A] uppercase tracking-wider">
                                <span>{{ $phaseName }}</span>
                            </h3>

                            <div class="space-y-2.5">
                                @foreach($items as $m)
                                    <div class="p-4 rounded-xl border border-slate-200 hover:border-blue-300 transition-all bg-white shadow-xs"
                                         x-data="{ completed: {{ $m->is_completed ? 'true' : 'false' }} }">
                                        <div class="flex items-start gap-3.5">
                                            <input type="checkbox" 
                                                   :checked="completed"
                                                   @change="completed = !completed; toggle({{ $m->id }})" 
                                                   class="w-5 h-5 text-[#0085FF] rounded border-slate-300 focus:ring-[#0085FF] mt-0.5 cursor-pointer">
                                            
                                            <div class="flex-grow">
                                                <h4 class="font-bold text-sm text-slate-800 transition-all"
                                                    :class="{ 'line-through text-slate-400': completed }">
                                                    {{ $m->title }}
                                                </h4>
                                                @if($m->description)
                                                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                                        {{ $m->description }}
                                                    </p>
                                                @endif
                                                @if($m->resource_recommendation)
                                                    <div class="mt-2 text-[11px] text-[#0085FF] font-medium flex items-center gap-1">
                                                        <span>Recommended Study:</span>
                                                        <span class="font-semibold">{{ $m->resource_recommendation }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pt-6 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-slate-500">Milestone checkboxes automatically persist to your account.</span>
                    <a href="{{ route('dashboard') }}" class="font-bold text-[#0085FF] hover:underline">
                        Go to My Dashboard &rarr;
                    </a>
                </div>
            </div>
        @endif

        <!-- Generate a New Roadmap Form Card -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-10 shadow-sm text-left">
            <h2 class="text-xl font-bold text-[#00245A] mb-2">
                {{ $userRoadmap ? 'Switch Target Role or Generate New Roadmap' : 'Build Your Customized Roadmap' }}
            </h2>
            <p class="text-xs text-slate-500 mb-6">
                Pick your target pharmaceutical role to receive structured technical and regulatory learning checkpoints.
            </p>

            <form action="{{ route('roadmap.generate') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Target Role -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Select Target Role / Department <span class="text-red-500">*</span>
                        </label>
                        <select name="career_path_id" required class="w-full text-xs sm:text-sm px-3.5 py-2.5 border border-slate-300 rounded-xl focus:border-[#0085FF] focus:outline-none bg-white">
                            @foreach($careerPaths as $path)
                                <option value="{{ $path->id }}">
                                    {{ $path->title }} ({{ $path->category->name ?? 'Industrial' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Experience Level -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Current Experience Level <span class="text-red-500">*</span>
                        </label>
                        <select name="experience_level" required class="w-full text-xs sm:text-sm px-3.5 py-2.5 border border-slate-300 rounded-xl focus:border-[#0085FF] focus:outline-none bg-white">
                            <option value="Final Year Pharmacy Student">Final Year Pharmacy Student (Undergraduate)</option>
                            <option value="Fresh Graduate (0-1 Year)">Fresh Graduate (0 - 1 Year)</option>
                            <option value="Junior Officer (1-2 Years)">Junior Officer (1 - 2 Years Experience)</option>
                            <option value="Mid-Level Pharmacist (3+ Years)">Mid-Level Pharmacist (3+ Years Experience)</option>
                        </select>
                    </div>

                    <!-- Target Timeline -->
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Preparation Timeline Goal
                        </label>
                        <div class="grid grid-cols-3 gap-3">
                            <label class="p-3 rounded-xl border border-slate-200 text-center cursor-pointer hover:border-[#0085FF] text-xs font-semibold">
                                <input type="radio" name="timeline_months" value="3" class="hidden">
                                <span class="block text-sm font-bold text-[#00245A]">3 Months</span>
                                <span class="text-[10px] text-slate-500">Accelerated Track</span>
                            </label>
                            <label class="p-3 rounded-xl border border-[#0085FF] bg-blue-50/50 text-center cursor-pointer text-xs font-semibold">
                                <input type="radio" name="timeline_months" value="6" checked class="hidden">
                                <span class="block text-sm font-bold text-[#0085FF]">6 Months</span>
                                <span class="text-[10px] text-slate-500">Standard Thorough</span>
                            </label>
                            <label class="p-3 rounded-xl border border-slate-200 text-center cursor-pointer hover:border-[#0085FF] text-xs font-semibold">
                                <input type="radio" name="timeline_months" value="12" class="hidden">
                                <span class="block text-sm font-bold text-[#00245A]">12 Months</span>
                                <span class="text-[10px] text-slate-500">Final-Year Pace</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs text-slate-500">Roadmap will be saved to your dashboard profile.</span>
                    <button type="submit" class="btn-primary text-xs sm:text-sm py-2.5 px-6 shadow-sm hover:shadow font-bold">
                        Generate & Save Roadmap &rarr;
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>
@endsection
