@extends('layouts.app')

@section('title', $consultant->name . ' | Pharma Career Compass')
@section('meta_description', $consultant->bio)

@section('content')
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-left">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#0085FF]">Home</a>
            <span>/</span>
            <a href="{{ route('consultants.index') }}" class="hover:text-[#0085FF]">Consultants</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold">{{ $consultant->name }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Main Column -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Profile Header Card -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-2xs space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                        @if($consultant->avatar)
                            <img src="{{ asset($consultant->avatar) }}" alt="{{ $consultant->name }}" class="w-24 h-24 rounded-2xl object-cover object-top border border-slate-200 shadow-2xs shrink-0">
                        @else
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-slate-100 border border-slate-200 text-slate-800 flex items-center justify-center font-semibold text-xl sm:text-2xl shrink-0 tracking-wider">
                                {{ substr($consultant->name, 0, 2) }}
                            </div>
                        @endif
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-amber-500">★ {{ number_format($consultant->rating, 2) }}</span>
                                <span class="text-xs text-slate-400 font-normal">({{ $consultant->reviews_count }} verified sessions)</span>
                            </div>
                            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-1">{{ $consultant->name }}</h1>
                            <div class="text-xs sm:text-sm font-medium text-slate-600">{{ $consultant->title }}</div>
                            <div class="text-xs text-slate-400 mt-1">{{ $consultant->current_company }}</div>
                        </div>
                    </div>

                    <!-- Meta specs -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs">
                        <div>
                            <span class="text-slate-400 block font-normal">Specialization:</span>
                            <span class="font-bold text-slate-900">{{ $consultant->specialization }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-normal">Experience:</span>
                            <span class="font-bold text-slate-900">{{ $consultant->experience_years }}+ Years</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-normal">Session Rate:</span>
                            <span class="font-bold text-slate-900 tabular-nums">৳{{ number_format($consultant->hourly_rate, 0) }}/session</span>
                        </div>
                    </div>
                </div>

                <!-- Biography & Background -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-2xs">
                    <h2 class="text-lg font-bold text-slate-900 mb-3 tracking-tight">Professional Biography & Industry Background</h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                        {{ $consultant->bio }}
                    </p>

                    <div class="mt-6 pt-5 border-t border-slate-100">
                        <h3 class="font-bold text-sm text-slate-900 mb-2">Qualifications & Licenses:</h3>
                        <p class="text-xs sm:text-sm text-slate-700 font-medium">
                            {{ $consultant->qualifications }}
                        </p>
                    </div>
                </div>

                <!-- Areas of Expertise -->
                @if(!empty($consultant->areas_of_expertise))
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-2xs">
                        <h2 class="text-lg font-bold text-slate-900 mb-4 tracking-tight">Areas of Advisory Expertise</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($consultant->areas_of_expertise as $area)
                                <div class="flex items-center gap-2.5 p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-800 font-medium">
                                    <span class="w-5 h-5 rounded-md bg-slate-900 text-white flex items-center justify-center font-bold text-[10px] shrink-0">✓</span>
                                    <span>{{ $area }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Sidebar Column -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Book Consultation Box -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs space-y-4">
                    <h3 class="font-bold text-base text-slate-900">Book a Session with {{ $consultant->name }}</h3>
                    <div class="text-2xl font-bold text-slate-900 tabular-nums">৳{{ number_format($consultant->hourly_rate, 0) }}<span class="text-xs text-slate-400 font-normal"> / session</span></div>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Check open slots on the live calendar and schedule a dedicated video consultation.
                    </p>
                    <a href="{{ route('booking.create', ['consultant_id' => $consultant->id]) }}" class="bg-slate-900 hover:bg-black text-white w-full text-xs py-3 rounded-xl shadow-2xs font-semibold text-center block transition-colors">
                        Schedule Consultation &rarr;
                    </a>
                </div>

                <!-- Supported Consultation Formats -->
                @if(!empty($consultant->consultation_types))
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs">
                        <h4 class="font-bold text-sm text-[#00245A] mb-3">Supported Consultation Types</h4>
                        <ul class="space-y-2 text-xs text-slate-600">
                            @foreach($consultant->consultation_types as $type)
                                <li class="flex items-center gap-2">
                                    <span class="text-[#0085FF] font-bold">✓</span>
                                    <span>{{ $type }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>
@endsection
