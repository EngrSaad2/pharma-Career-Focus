@extends('layouts.app')

@section('title', 'Pharmaceutical Career Consultation & Preparation Services | Pharma Career Compass')
@section('meta_description', 'Explore our 7 structured career consultation and exam preparation services for pharmacy graduates, including written exam prep, viva practice, and CV review.')

@section('content')
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12 space-y-3">
            <span class="inline-flex items-center text-[11px] font-semibold uppercase tracking-wider text-slate-600 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                Service Catalog
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Structured Career Guidance & Preparation Offerings
            </h1>
            <p class="text-sm sm:text-base text-slate-600 max-w-2xl mx-auto">
                Practical, results-oriented consultation packages designed to bridge the gap between academic theory and recruitment benchmarks.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-left mb-16">
            @foreach($services as $service)
                <div class="bg-white rounded-2xl border border-slate-200 hover:border-slate-400 p-7 flex flex-col justify-between shadow-2xs hover:shadow-sm transition-all relative overflow-hidden">
                    @if($service->tag)
                        <div class="absolute top-4 right-4 text-[10px] font-semibold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-800 border border-slate-200 uppercase tracking-wider">
                            {{ $service->tag }}
                        </div>
                    @endif

                    <div>
                        <div class="text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1">
                            {{ $service->delivery_mode }}
                        </div>
                        <h2 class="text-lg font-bold text-slate-900 mb-2">
                            <a href="{{ route('services.show', $service->slug) }}" class="hover:text-black transition-colors">
                                {{ $service->title }}
                            </a>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-5">
                            {{ $service->summary }}
                        </p>

                        <!-- Expected Outcomes list -->
                        @if(!empty($service->expected_outcomes))
                            <div class="space-y-2 mb-6">
                                <div class="text-xs font-semibold text-slate-900 uppercase tracking-wider">Target Outcomes:</div>
                                <ul class="space-y-1.5 text-xs text-slate-600">
                                    @foreach(array_slice($service->expected_outcomes, 0, 3) as $outcome)
                                        <li class="flex items-start gap-2">
                                            <span class="text-slate-900 font-bold shrink-0">✓</span>
                                            <span>{{ $outcome }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="pt-5 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <div class="text-lg font-bold text-slate-900 tabular-nums">
                                @if($service->price == 0)
                                    <span class="text-emerald-700">Free / Compl.</span>
                                @else
                                    ৳{{ number_format($service->price, 0) }} <span class="text-xs font-normal text-slate-500">/ session</span>
                                @endif
                            </div>
                            <div class="text-[11px] text-slate-400">{{ $service->duration_minutes }} mins • {{ $service->delivery_mode }}</div>
                        </div>

                        <a href="{{ route('booking.create', ['service_id' => $service->id]) }}" class="bg-slate-900 hover:bg-black text-white text-xs font-semibold py-2 px-4 rounded-xl shadow-2xs transition-colors">
                            Book Now
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endsection
