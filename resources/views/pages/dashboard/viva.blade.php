@extends('layouts.dashboard')

@section('title', 'Saved Viva & Interview Preparation - Pharma Career Compass')

@section('dashboard_content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Viva & Interview Progress</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Review questions you have marked as practised or saved for quick revision</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('practice.viva') }}" class="px-3.5 py-2 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider shadow-sm hover:bg-blue-600">
                Viva Practice Hub
            </a>
            <a href="{{ route('practice.interviews') }}" class="px-3.5 py-2 rounded-lg bg-[#FFCD00] text-[#00245A] text-xs font-bold uppercase tracking-wider shadow-sm hover:bg-yellow-400">
                Interview Guide
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Practised Questions -->
        <div class="bg-white p-6 sm:p-7 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-extrabold text-[#00245A]">Practised Questions</h2>
                    <p class="text-xs text-slate-500">{{ $practised->count() }} questions reviewed</p>
                </div>
            </div>

            @if($practised->count() > 0)
                <div class="space-y-3">
                    @foreach($practised as $prog)
                        @if($prog->vivaQuestion)
                            <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/60">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#0085FF]">
                                    {{ $prog->vivaQuestion->subject }} • {{ $prog->vivaQuestion->difficulty_level }}
                                </span>
                                <h4 class="font-bold text-xs text-[#00245A] mt-1 leading-snug">
                                    {{ $prog->vivaQuestion->question }}
                                </h4>
                                <p class="text-[10px] text-slate-500 mt-1">Practised {{ $prog->practised_at ? $prog->practised_at->diffForHumans() : 'recently' }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="text-xs text-slate-500 py-8 text-center">No questions marked as practised yet. Go to Viva Practice to mark them.</p>
            @endif
        </div>

        <!-- Bookmarked Questions -->
        <div class="bg-white p-6 sm:p-7 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-extrabold text-[#00245A]">Bookmarked for Revision</h2>
                    <p class="text-xs text-slate-500">{{ $bookmarked->count() }} saved questions</p>
                </div>
            </div>

            @if($bookmarked->count() > 0)
                <div class="space-y-3">
                    @foreach($bookmarked as $prog)
                        @if($prog->vivaQuestion)
                            <div class="p-3.5 rounded-xl border border-slate-200 bg-white shadow-xs">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-700">
                                    {{ $prog->vivaQuestion->subject }}
                                </span>
                                <h4 class="font-bold text-xs text-[#00245A] mt-1 leading-snug">
                                    {{ $prog->vivaQuestion->question }}
                                </h4>
                                <div class="mt-2 text-right">
                                    <a href="{{ route('practice.viva') }}" class="text-[11px] font-bold text-[#0085FF] hover:underline">
                                        Open in Viva Bank &rarr;
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="text-xs text-slate-500 py-8 text-center">No questions bookmarked yet. Use the star icon on any viva question to save it here.</p>
            @endif
        </div>

    </div>
</div>
@endsection
