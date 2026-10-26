@extends('layouts.admin')

@section('title', 'Manage Career Paths - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A] tracking-tight">Pharmaceutical Career Sectors (11)</h1>
            <p class="text-xs text-slate-500 mt-1">Review department requirements, qualifications, and core competencies</p>
        </div>
        <div>
            <a href="{{ route('career-paths.index') }}" target="_blank" class="px-3.5 py-2 rounded-lg bg-[#00245A] hover:bg-[#00173B] text-white font-bold text-xs inline-flex items-center gap-1.5 shadow-xs transition">
                <span>View Public Directory ↗</span>
            </a>
        </div>
    </div>

    <!-- Career Paths Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach(($careerPaths ?? $paths ?? []) as $path)
            @php
                $iconMap = [
                    'clipboard-check' => '📋',
                    'microscope' => '🔬',
                    'cpu' => '🏭',
                    'file-text' => '📄',
                    'activity' => '🩺',
                    'sparkles' => '🧪',
                    'flask' => '🧪',
                    'flask-conical' => '🧪',
                    'shield' => '🛡️',
                    'truck' => '📦',
                    'pill' => '💊',
                    'stethoscope' => '🩺',
                    'trending-up' => '📈',
                    'heart-pulse' => '❤️',
                ];
                $displayIcon = $iconMap[$path->icon] ?? (str_contains($path->icon ?? '', '-') ? '💊' : ($path->icon ?: '💊'));
            @endphp
            <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] p-6 flex flex-col justify-between hover:-translate-y-0.5 transition-transform duration-150">
                
                {{-- Top Section --}}
                <div>
                    {{-- Icon & Level Badge --}}
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-2xl select-none">{{ $displayIcon }}</span>
                        <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase bg-[#FFCD00]/30 text-[#00245A] border border-[#FFCD00]">
                            {{ $path->experience_level ?? 'Entry Level' }}
                        </span>
                    </div>

                    {{-- Title & Category --}}
                    <h3 class="text-lg font-black text-[#00245A] leading-snug mb-1">
                        {{ $path->title }}
                    </h3>
                    <p class="text-xs font-bold text-[#0085FF] mb-3">
                        {{ $path->category->name ?? 'Industrial Operations' }}
                    </p>

                    {{-- Summary / Description --}}
                    <p class="text-xs text-slate-600 line-clamp-3 mb-4 leading-relaxed font-normal">
                        {{ $path->short_description ?? ($path->summary ?? '') }}
                    </p>

                    {{-- Requirements Snapshot --}}
                    <div class="space-y-1.5 pt-3 border-t border-slate-100 text-[11px] text-slate-600">
                        <p>
                            <strong class="text-slate-800">Required Degree:</strong>
                            {{ is_array($path->relevant_qualifications) ? implode(', ', $path->relevant_qualifications) : ($path->required_qualifications ?? ($path->relevant_qualifications ?? 'B.Pharm')) }}
                        </p>
                        <p>
                            <strong class="text-slate-800">Work Environment:</strong>
                            {{ $path->work_environment ?? 'Pharma Plant' }}
                        </p>
                    </div>
                </div>

                {{-- Bottom Action Bar --}}
                <div class="pt-4 border-t border-slate-100 mt-5 flex items-center justify-between">
                    <a href="{{ route('career-paths.show', $path->slug) }}" target="_blank" class="text-xs font-bold text-[#0085FF] hover:text-[#00245A] inline-flex items-center gap-1 transition-colors">
                        <span>View Public Page</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                    <span class="text-[10px] font-mono text-slate-400 font-semibold">
                        #{{ $path->sort_order ?? $path->id }}
                    </span>
                </div>

            </div>
        @endforeach
    </div>

    {{-- Pagination if present --}}
    @if(isset($careerPaths) && method_exists($careerPaths, 'hasPages') && $careerPaths->hasPages())
        <div class="mt-8">
            {{ $careerPaths->links() }}
        </div>
    @elseif(isset($paths) && method_exists($paths, 'hasPages') && $paths->hasPages())
        <div class="mt-8">
            {{ $paths->links() }}
        </div>
    @endif
</div>
@endsection
