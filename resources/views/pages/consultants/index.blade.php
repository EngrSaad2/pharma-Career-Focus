@extends('layouts.app')

@section('title', 'Pharma Career Consultants & Mentors | Pharma Career Compass')
@section('meta_description', 'Meet senior pharma career consultants and industry mentors at Pharma Career Compass for Quality Assurance, QC, Production, and Regulatory Affairs.')

@section('content')
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-10 space-y-3">
            <span class="inline-flex items-center text-[11px] font-semibold uppercase tracking-wider text-slate-600 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                Industry Mentors
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Pharma Career Consultants & Mentors Directory
            </h1>
            <p class="text-sm sm:text-base text-slate-600 max-w-2xl mx-auto">
                Consult 1-on-1 with experienced practitioners who have led plant inspections, compiled global dossiers, and interviewed hundreds of pharmacy graduates.
            </p>
        </div>

        <!-- Filter Bar -->
        <form method="GET" action="{{ route('consultants.index') }}" class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-2xs mb-10">
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                <div class="sm:col-span-6">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by consultant name, title, or specialization..." class="w-full text-xs px-3.5 py-2.5 border border-slate-200 rounded-xl focus:border-slate-900 focus:ring-1 focus:ring-slate-900 outline-none text-slate-900 bg-white shadow-2xs">
                </div>
                <div class="sm:col-span-4">
                    <select name="specialization" class="w-full text-xs px-3.5 py-2.5 border border-slate-200 rounded-xl focus:border-slate-900 focus:ring-1 focus:ring-slate-900 outline-none bg-white text-slate-900 shadow-2xs">
                        <option value="">All Specializations</option>
                        @foreach($specializations as $spec)
                            <option value="{{ $spec }}" {{ request('specialization') == $spec ? 'selected' : '' }}>
                                {{ $spec }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2 flex gap-2">
                    <button type="submit" class="bg-slate-900 hover:bg-black text-white text-xs font-semibold py-2 px-4 rounded-xl shadow-2xs w-full transition-colors">
                        Filter
                    </button>
                    @if(request()->hasAny(['search', 'specialization']))
                        <a href="{{ route('consultants.index') }}" class="btn-secondary text-xs py-2 px-3 shadow-2xs rounded-xl">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <!-- Consultants Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
            @forelse($consultants as $consultant)
                <div class="bg-white rounded-2xl border border-slate-200 hover:border-slate-400 p-6 shadow-2xs hover:shadow-sm flex flex-col justify-between transition-all">
                    <div>
                        <div class="flex items-start justify-between gap-4 mb-4">
                            @if($consultant->avatar)
                                <img src="{{ asset($consultant->avatar) }}" alt="{{ $consultant->name }}" class="w-14 h-14 rounded-xl object-cover shrink-0 shadow-2xs border border-slate-200">
                            @else
                                <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 flex items-center justify-center font-semibold text-sm shrink-0 tracking-wider">
                                    {{ substr($consultant->name, 0, 2) }}
                                </div>
                            @endif
                            <div class="text-right">
                                <span class="text-xs font-bold text-amber-500">★ {{ number_format($consultant->rating, 2) }}</span>
                                <span class="text-[11px] text-slate-400 block font-normal">({{ $consultant->reviews_count }} sessions)</span>
                            </div>
                        </div>

                        <h2 class="text-base font-bold text-slate-900 mb-0.5">
                            <a href="{{ route('consultants.show', $consultant->slug) }}" class="hover:text-black transition-colors">
                                {{ $consultant->name }}
                            </a>
                        </h2>

                        <div class="text-xs font-medium text-slate-600 mb-2">
                            {{ $consultant->title }}
                        </div>

                        <div class="text-[11px] text-slate-400 font-normal mb-3">
                            {{ $consultant->experience_years }}+ Years Experience • {{ $consultant->qualifications }}
                        </div>

                        <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed mb-4">
                            {{ $consultant->bio }}
                        </p>

                        @if(!empty($consultant->areas_of_expertise))
                            <div class="flex flex-wrap gap-1 mb-4">
                                @foreach(array_slice($consultant->areas_of_expertise, 0, 3) as $area)
                                    <span class="text-[10px] bg-slate-50 text-slate-700 border border-slate-200 px-2 py-0.5 rounded-md font-medium">
                                        {{ $area }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block font-normal">Session Fee</span>
                            <span class="text-sm font-bold text-slate-900 tabular-nums">৳{{ number_format($consultant->hourly_rate, 0) }}</span>
                            <span class="text-[10px] text-slate-500 font-normal">/session</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('consultants.show', $consultant->slug) }}" class="btn-secondary text-xs py-1.5 px-3 shadow-2xs rounded-lg">
                                Profile
                            </a>
                            <a href="{{ route('booking.create', ['consultant_id' => $consultant->id]) }}" class="bg-slate-900 hover:bg-black text-white text-xs font-semibold py-1.5 px-3.5 shadow-2xs rounded-lg transition-colors">
                                Book
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 p-12 text-center bg-white rounded-2xl border border-slate-200">
                    <p class="text-slate-500 text-sm">No consultants matched your search query.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $consultants->links() }}
        </div>

    </div>
</section>
@endsection
