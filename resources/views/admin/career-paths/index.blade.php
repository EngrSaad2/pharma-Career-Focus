@extends('layouts.admin')

@section('title', 'Manage Career Paths - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Pharmaceutical Career Sectors (11)</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Review department requirements, qualifications, and core competencies</p>
        </div>
    </div>

    <!-- Career Paths Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach(($careerPaths ?? $paths ?? []) as $path)
            <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] p-6 flex flex-col justify-between">
                    @php
                        $iconMap = [
                            'clipboard-check' => '📋',
                            'microscope' => '🔬',
                            'cpu' => '🏭',
                            'file-text' => '📄',
                            'activity' => '🩺',
                            'sparkles' => '🧪',
                            'flask' => '🧪',
                            'shield' => '🛡️',
                            'truck' => '📦',
                            'pill' => '💊',
                        ];
                        $displayIcon = $iconMap[$path->icon] ?? (str_contains($path->icon ?? '', '-') ? '💊' : ($path->icon ?: '💊'));
                    @endphp
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-2xl">{{ $displayIcon }}</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-[#FFCD00]/30 text-[#00245A] border border-[#FFCD00]">
                            {{ $path->experience_level ?? 'Entry Level' }}
                        </span>
                    </div>

                    <h3 class="text-lg font-black text-[#00245A] leading-snug mb-1">
                        {{ $path->title }}
                    </h3>
                    <p class="text-xs font-semibold text-[#0085FF] mb-3">
                        {{ $path->category->name ?? 'Industrial' }}
                    </p>

                    <p class="text-xs text-[#00245A]/75 line-clamp-3 mb-4 leading-relaxed">
                        {{ $path->short_description ?? ($path->summary ?? '') }}
                    </p>

                    <div class="space-y-2 pt-2 border-t border-[#00245A]/10 text-[11px] text-[#00245A]/80">
                        <p><strong>Required Degree:</strong> {{ is_array($path->relevant_qualifications) ? implode(', ', $path->relevant_qualifications) : ($path->required_qualifications ?? ($path->relevant_qualifications ?? 'B.Pharm')) }}</p>
                        <p><strong>Work Environment:</strong> {{ $path->work_environment ?? 'Pharma Plant' }}</p>
                    </div>
                </div>

                <div class="pt-4 border-t border-[#00245A]/10 mt-4 flex items-center justify-between">
                    <a href="{{ route('career-paths.show', $path->slug) }}" target="_blank" class="text-xs font-bold text-[#0085FF] hover:underline flex items-center gap-1">
                        <span>View Public Page</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    @if(isset($careerPaths) && method_exists($careerPaths, 'hasPages') && $careerPaths->hasPages())
        <div class="mt-6">
            {{ $careerPaths->links() }}
        </div>
    @elseif(isset($paths) && method_exists($paths, 'hasPages') && $paths->hasPages())
        <div class="mt-6">
            {{ $paths->links() }}
        </div>
    @endif
</div>
@endsection
