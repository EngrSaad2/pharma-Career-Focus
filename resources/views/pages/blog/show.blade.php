@extends('layouts.app')

@section('title', $post->meta_title ?? ($post->title . ' - Pharma Career Compass'))
@section('meta_description', $post->meta_description ?? $post->excerpt)
@section('og_image', !empty($post->featured_image) ? asset($post->featured_image) : asset('images/og-pharma-compass.jpg'))

@section('content')
<!-- Article Header -->
<section class="bg-white py-14 border-b border-slate-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#0085FF] hover:underline mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Knowledge Resources</span>
        </a>

        <div class="flex items-center gap-2 mb-4">
            <span class="px-3 py-1 rounded bg-blue-50 text-[#0085FF] font-bold text-xs uppercase tracking-wider border border-blue-200">
                {{ $post->category->name ?? 'Career Guidance' }}
            </span>
            <span class="text-xs text-slate-500">
                {{ $post->reading_time ?? 5 }} min read
            </span>
        </div>

        <h1 class="text-3xl md:text-5xl font-extrabold text-[#00245A] tracking-tight mb-6 leading-tight">
            {{ $post->title }}
        </h1>

        <div class="flex items-center gap-4 py-4 border-y border-slate-200 text-xs text-slate-600">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-[#00245A] text-[#FFCD00] font-black text-sm flex items-center justify-center">
                    {{ substr($post->author_name ?? 'Pharma', 0, 1) }}
                </div>
                <div>
                    <p class="font-bold text-[#00245A] text-sm">{{ $post->author_name ?? 'Editorial Board' }}</p>
                    <p class="text-[11px] text-slate-500">{{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="py-14 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Summary Callout -->
        @if($post->excerpt)
            <div class="p-6 rounded-2xl bg-blue-50/50 border border-blue-200 shadow-sm mb-10">
                <h2 class="text-xs font-bold uppercase tracking-wider text-[#0085FF] mb-2">Executive Summary</h2>
                <p class="text-base text-slate-800 font-semibold leading-relaxed">
                    {{ $post->excerpt }}
                </p>
            </div>
        @endif

        <!-- Main Body -->
        <div class="blog-article-content text-slate-800 leading-relaxed font-normal">
            {!! $post->content !!}
        </div>

        <style>
            .blog-article-content {
                font-size: 1.0625rem;
                line-height: 1.85;
                color: #243048;
            }
            .blog-article-content p {
                margin-bottom: 1.35rem;
            }
            .blog-article-content h2 {
                font-size: 1.625rem;
                font-weight: 800;
                color: #00245A;
                margin-top: 2.25rem;
                margin-bottom: 0.85rem;
                letter-spacing: -0.02em;
            }
            .blog-article-content h3 {
                font-size: 1.3rem;
                font-weight: 700;
                color: #00245A;
                margin-top: 1.75rem;
                margin-bottom: 0.65rem;
            }
            .blog-article-content h4 {
                font-size: 1.125rem;
                font-weight: 700;
                color: #00245A;
                margin-top: 1.5rem;
                margin-bottom: 0.5rem;
            }
            .blog-article-content ul {
                list-style-type: disc;
                padding-left: 1.5rem;
                margin-bottom: 1.35rem;
            }
            .blog-article-content ol {
                list-style-type: decimal;
                padding-left: 1.5rem;
                margin-bottom: 1.35rem;
            }
            .blog-article-content li {
                margin-bottom: 0.5rem;
                padding-left: 0.25rem;
            }
            .blog-article-content blockquote {
                border-left: 4px solid #0085FF;
                background: #F8FAFC;
                padding: 1rem 1.25rem;
                border-radius: 0 0.75rem 0.75rem 0;
                font-style: italic;
                color: #334155;
                margin: 1.5rem 0;
            }
            .blog-article-content a {
                color: #0085FF;
                text-decoration: underline;
                font-weight: 600;
            }
            .blog-article-content a:hover {
                color: #00245A;
            }
            .blog-article-content strong {
                color: #00245A;
                font-weight: 700;
            }
        </style>

        <!-- Tags -->
        @if($post->tags && count($post->tags) > 0)
            <div class="mt-12 pt-6 border-t border-slate-200 flex flex-wrap items-center gap-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-700 mr-2">Tags:</span>
                @foreach($post->tags as $tag)
                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-medium border border-slate-200">
                        #{{ $tag }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Advisory Note & CTA -->
        <div class="mt-14 p-8 rounded-2xl bg-[#00245A] text-white shadow-md">
            <span class="text-xs font-bold uppercase tracking-wider text-[#FFCD00]">Career Next Step</span>
            <h3 class="text-2xl font-extrabold mt-2 mb-3">Want 1-on-1 Guidance on This Topic?</h3>
            <p class="text-sm text-white/80 leading-relaxed mb-6 max-w-xl">
                Discuss department opportunities, prepare your CV, or schedule a mock viva with a senior industry mentor.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('consultation.book') }}" class="px-6 py-3 rounded-lg bg-[#FFCD00] text-[#00245A] font-bold text-xs uppercase tracking-wider hover:bg-yellow-400 shadow-sm">
                    Book Consultation Session
                </a>
                <a href="{{ route('quiz.index') }}" class="px-6 py-3 rounded-lg bg-white/10 text-white font-bold text-xs uppercase tracking-wider hover:bg-white/20 border border-white/30">
                    Take Career Assessment Quiz
                </a>
            </div>
        </div>

        <!-- Related Articles -->
        @if($relatedPosts && $relatedPosts->count() > 0)
            <div class="mt-16 pt-10 border-t border-slate-200">
                <h3 class="text-2xl font-extrabold text-[#00245A] mb-6">Related Career Guides</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $rel)
                        <a href="{{ route('blog.show', $rel->slug) }}" class="p-5 rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold uppercase text-[#0085FF] block mb-2">{{ $rel->category->name ?? 'Article' }}</span>
                                <h4 class="font-extrabold text-sm text-[#00245A] leading-snug line-clamp-2">{{ $rel->title }}</h4>
                            </div>
                            <span class="text-xs font-bold text-[#0085FF] mt-4 flex items-center gap-1">Read article &rarr;</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
