@extends('layouts.app')

@section('title', 'Pharma Career Insights & Articles | Pharma Career Compass')
@section('meta_description', 'Practical pharma career insights, written exam guides, viva preparation tips, and department comparisons by Pharma Career Compass.')

@section('content')
<!-- Hero Header -->
<section class="bg-white py-14 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-3 py-1 bg-blue-50 text-[#0085FF] text-xs font-bold uppercase tracking-wider rounded mb-3 border border-blue-200">
            Knowledge & Insights
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-[#00245A] tracking-tight mb-4">
            Pharma Career Resources & Articles
        </h1>
        <p class="text-base md:text-lg text-slate-600 max-w-2xl mx-auto">
            Practical articles, department analyses, exam breakdowns, and interview frameworks for ambitious pharmacists.
        </p>
    </div>
</section>

<!-- Main Blog Section -->
<section class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search & Category Filter Toolbar -->
        <div class="mb-12 bg-slate-50/70 p-6 rounded-2xl border border-slate-200 shadow-sm">
            <form action="{{ route('blog.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <!-- Search input -->
                <div class="relative w-full md:w-96">
                    <input type="text" name="search" value="{{ $search ?? '' }}"
                           placeholder="Search articles, topics, QA/QC..."
                           class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white">
                    <svg class="w-5 h-5 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                <!-- Category Pills -->
                <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 scrollbar-none">
                    <a href="{{ route('blog.index') }}"
                       class="px-4 py-2 rounded-lg text-xs font-bold whitespace-nowrap border transition-all {{ empty($selectedCategory) ? 'bg-[#00245A] text-white border-[#00245A] shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50' }}">
                        All Articles
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                           class="px-4 py-2 rounded-lg text-xs font-bold whitespace-nowrap border transition-all {{ ($selectedCategory == $category->slug) ? 'bg-[#00245A] text-white border-[#00245A] shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50' }}">
                            {{ $category->name }} ({{ $category->posts_count ?? 0 }})
                        </a>
                    @endforeach
                </div>
            </form>
        </div>

        <!-- Blog Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <article class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md hover:border-slate-300 transition-all duration-200">
                    <!-- Featured Image / Placeholder Graphic -->
                    <div class="relative h-48 bg-gradient-to-br from-[#00245A] to-[#0085FF] flex items-center justify-center p-6 text-white border-b border-slate-100">
                        <div class="text-center">
                            <span class="inline-block px-2.5 py-0.5 rounded bg-[#FFCD00] text-[#00245A] font-bold text-[10px] uppercase tracking-wider mb-2">
                                {{ $post->category->name ?? 'Career Guide' }}
                            </span>
                            <h3 class="font-extrabold text-lg text-white leading-snug line-clamp-2">
                                {{ $post->title }}
                            </h3>
                        </div>
                    </div>

                    <!-- Post Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                                <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                                <span>•</span>
                                <span>{{ $post->reading_time ?? 5 }} min read</span>
                                <span>•</span>
                                <span>By {{ $post->author_name }}</span>
                            </div>

                            <p class="text-sm text-slate-600 line-clamp-3 mb-4 leading-relaxed">
                                {{ $post->excerpt }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0085FF] hover:text-[#00245A] uppercase tracking-wider">
                                <span>Read Full Article</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-16 bg-[#F4F9FF] rounded-2xl border-2 border-dashed border-[#00245A]/30 p-8">
                    <svg class="w-12 h-12 text-[#00245A]/40 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <h3 class="text-lg font-bold text-[#00245A]">No articles match your criteria</h3>
                    <p class="text-xs text-[#00245A]/60 mt-1 mb-4">Try clearing filters or search keywords.</p>
                    <a href="{{ route('blog.index') }}" class="inline-block px-4 py-2 rounded-lg bg-[#0085FF] text-white text-xs font-bold border border-[#00245A]">
                        Reset All Filters
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection
