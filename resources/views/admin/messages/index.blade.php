@extends('layouts.admin')

@section('title', 'Contact Messages - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-black text-[#00245A]">Contact Messages & Inquiries</h1>
        <p class="text-xs text-[#00245A]/70 mt-1">Direct inquiries submitted through the contact form</p>
    </div>

    <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] overflow-hidden">
        @if($messages->count() > 0)
            <div class="divide-y divide-slate-100">
                @foreach($messages as $msg)
                    <div class="p-6 hover:bg-slate-50 transition-colors space-y-3">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-[#FFCD00]/30 text-[#00245A] border border-[#FFCD00] mr-2">
                                    {{ $msg->subject ?? 'Inquiry' }}
                                </span>
                                <strong class="text-sm font-bold text-[#00245A]">{{ $msg->name }}</strong>
                                <span class="text-xs text-[#00245A]/60">({{ $msg->email }} {{ $msg->phone ? '• ' . $msg->phone : '' }})</span>
                            </div>
                            <span class="text-xs text-[#00245A]/60">
                                {{ $msg->created_at->format('M d, Y - h:i A') }} ({{ $msg->created_at->diffForHumans() }})
                            </span>
                        </div>

                        <div class="p-4 rounded-xl bg-[#F4F9FF] border border-[#00245A]/10 text-xs text-[#00245A]/85 leading-relaxed">
                            {{ $msg->message }}
                        </div>

                        <div class="text-right">
                            <a href="mailto:{{ $msg->email }}?subject=Re: {{ urlencode($msg->subject ?? 'Your Inquiry to Pharma Career Compass') }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider hover:bg-blue-600">
                                <span>Reply via Email</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="p-6 border-t border-[#00245A]/10">
                {{ $messages->links() }}
            </div>
        @else
            <div class="p-12 text-center text-xs text-[#00245A]/60">
                No contact form submissions recorded yet.
            </div>
        @endif
    </div>
</div>
@endsection
