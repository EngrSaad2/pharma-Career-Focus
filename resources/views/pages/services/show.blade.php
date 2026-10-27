@extends('layouts.app')

@section('title', $service->title . ' | Pharma Career Compass')
@section('meta_description', $service->summary)
@section('og_image', asset('images/og-services.jpg'))

@section('content')
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-left">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#0085FF]">Home</a>
            <span>/</span>
            <a href="{{ route('services.index') }}" class="hover:text-[#0085FF]">Our Services</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold">{{ $service->title }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Main Column -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Header Card -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold text-[#0085FF] bg-blue-50 px-2.5 py-0.5 rounded-full border border-blue-200">
                            {{ $service->delivery_mode }}
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#00245A]">
                        {{ $service->title }}
                    </h1>

                    <p class="text-sm sm:text-base text-slate-700 leading-relaxed">
                        {{ $service->summary }}
                    </p>

                    <!-- Meta specs -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs">
                        <div>
                            <span class="text-slate-400 block font-medium">Session Duration:</span>
                            <span class="font-bold text-slate-800">{{ $service->duration_minutes }} Minutes</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">Session Fee:</span>
                            <span class="font-bold text-[#0085FF]">
                                {{ $service->price == 0 ? 'Complimentary' : '৳' . number_format($service->price, 0) }}
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">Format:</span>
                            <span class="font-bold text-slate-800">Live 1-on-1 Video</span>
                        </div>
                    </div>
                </div>

                <!-- In-depth Description -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                    <h2 class="text-xl font-bold text-[#00245A] mb-3">Service Scope & Description</h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                        {{ $service->description }}
                    </p>

                    @if($service->target_audience)
                        <div class="mt-6 pt-5 border-t border-slate-100">
                            <h3 class="font-bold text-sm text-[#00245A] mb-1">Target Audience & Suitability:</h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                {{ $service->target_audience }}
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Expected Outcomes List -->
                @if(!empty($service->expected_outcomes))
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                        <h2 class="text-xl font-bold text-[#00245A] mb-4">What You Will Gain from This Service</h2>
                        <div class="space-y-3">
                            @foreach($service->expected_outcomes as $outcome)
                                <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs sm:text-sm text-slate-700 leading-relaxed">
                                    <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">✓</span>
                                    <span>{{ $outcome }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Sidebar Column -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Book CTA Box -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-md space-y-4">
                    <div class="text-xs font-bold uppercase tracking-wider text-slate-500">Book This Service</div>
                    <div class="text-2xl font-black text-[#00245A]">
                        {{ $service->price == 0 ? 'Complimentary' : '৳' . number_format($service->price, 0) }}
                    </div>
                    <p class="text-xs text-slate-600">
                        Select a consultant and choose an open slot on our live booking calendar.
                    </p>
                    <a href="{{ route('booking.create', ['service_id' => $service->id]) }}" class="btn-primary w-full text-xs py-3 shadow-sm hover:shadow font-bold text-center block">
                        Proceed to Booking Calendar &rarr;
                    </a>
                </div>

                <!-- Other Services -->
                @if($otherServices->count() > 0)
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs">
                        <h3 class="font-bold text-sm text-[#00245A] mb-3">Other Preparation Services</h3>
                        <div class="space-y-2.5">
                            @foreach($otherServices as $other)
                                <a href="{{ route('services.show', $other->slug) }}" class="block p-3 rounded-xl border border-slate-100 hover:border-[#0085FF] hover:bg-blue-50/30 transition-all text-xs">
                                    <div class="font-bold text-[#00245A]">{{ $other->title }}</div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">{{ $other->duration_minutes }} mins • {{ $other->delivery_mode }}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>
@endsection
