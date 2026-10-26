@extends('layouts.app')

@section('title', 'Pharma Career Paths & Specializations | Pharma Career Compass')
@section('meta_description', 'Explore 11 high-demand pharma career paths in Quality Assurance, QC, Production, and Regulatory Affairs with Pharma Career Compass.')

@section('content')
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-10 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                Industry Opportunities
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-[#00245A]">
                Pharma Career Paths & Specializations
            </h1>
            <p class="text-sm sm:text-base text-slate-600 max-w-2xl mx-auto">
                Explore in-depth specifications for all 11 core pharmaceutical sectors. Understand day-to-day responsibilities, entry points, salary benchmarks, and preparation requirements.
            </p>
        </div>

        <!-- Filter Bar -->
        <form method="GET" action="{{ route('career-paths.index') }}" class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-sm mb-10">
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                <div class="sm:col-span-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by role title or skill..." class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0085FF]">
                </div>
                <div class="sm:col-span-3">
                    <select name="category" class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white">
                        <option value="">All Sectors</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-3">
                    <select name="environment" class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white">
                        <option value="">All Work Environments</option>
                        <option value="Plant" {{ request('environment') == 'Plant' ? 'selected' : '' }}>Plant / Cleanroom</option>
                        <option value="Laboratory" {{ request('environment') == 'Laboratory' ? 'selected' : '' }}>Analytical Laboratory</option>
                        <option value="Corporate" {{ request('environment') == 'Corporate' ? 'selected' : '' }}>Corporate Office</option>
                        <option value="Hospital" {{ request('environment') == 'Hospital' ? 'selected' : '' }}>Hospital / Clinical</option>
                    </select>
                </div>
                <div class="sm:col-span-2 flex gap-2">
                    <button type="submit" class="btn-primary text-xs py-2 px-4 shadow-sm hover:shadow w-full font-bold">
                        Filter
                    </button>
                    @if(request()->hasAny(['search', 'category', 'environment']))
                        <a href="{{ route('career-paths.index') }}" class="btn-secondary text-xs py-2 px-3 shadow-sm hover:shadow font-bold">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <!-- Career Paths Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
            @forelse($paths as $path)
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 flex flex-col justify-between hover:border-[#0085FF] hover:shadow-lg transition-all">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700">
                                {{ $path->category->name ?? 'Industrial' }}
                            </span>
                            @if($path->badge)
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-[#0085FF] border border-blue-200">
                                    {{ $path->badge }}
                                </span>
                            @endif
                        </div>

                        <h3 class="text-xl font-bold text-[#00245A] mb-2">
                            <a href="{{ route('career-paths.show', $path->slug) }}" class="hover:text-[#0085FF] transition-colors">
                                {{ $path->title }}
                            </a>
                        </h3>

                        <p class="text-xs sm:text-sm text-slate-600 line-clamp-3 leading-relaxed mb-4">
                            {{ $path->summary }}
                        </p>

                        <!-- Key skills -->
                        @if(!empty($path->required_skills))
                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @foreach(array_slice($path->required_skills, 0, 3) as $skill)
                                    <span class="text-[11px] bg-slate-50 text-slate-600 border border-slate-200 px-2 py-0.5 rounded">
                                        {{ $skill }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <div class="text-xs text-slate-500 space-y-1 mb-4">
                            <div><strong>Setting:</strong> {{ $path->work_environment }}</div>
                            <div><strong>Salary:</strong> {{ $path->salary_range }}</div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs text-slate-400 font-medium">{{ $path->experience_level }}</span>
                        <a href="{{ route('career-paths.show', $path->slug) }}" class="btn-primary text-xs py-1.5 px-3.5 shadow-sm hover:shadow font-bold">
                            Role Details &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 p-12 text-center bg-white rounded-2xl border border-slate-200">
                    <p class="text-slate-500 text-sm">No career paths matched your filter parameters.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $paths->links() }}
        </div>

    </div>
</section>
@endsection
