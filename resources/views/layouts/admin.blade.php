<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Pharma Career Compass')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}?v=2">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=2">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        @media print {
            header, aside, .no-print { display: none !important; }
            body, main { background: #ffffff !important; color: #000000 !important; padding: 0 !important; margin: 0 !important; }
            .print-only { display: block !important; }
            table { width: 100% !important; border-collapse: collapse !important; }
            th, td { border: 1px solid #cbd5e1 !important; padding: 8px 10px !important; font-size: 11px !important; }
            th { background-color: #f1f5f9 !important; color: #00245A !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .shadow-\[4px_4px_0px_\#00245a\], .shadow-\[2px_2px_0px_\#00245a\], .shadow-\[8px_8px_0px_\#00245a\], .border-2 {
                box-shadow: none !important;
                border: 1px solid #cbd5e1 !important;
            }
        }
    </style>
    @stack('head')
</head>
<body class="h-full flex flex-col text-slate-900 bg-slate-50" x-data="{ sidebarOpen: false }">

    <!-- Admin Header -->
    <header class="bg-[#00245A] text-white border-b border-blue-950 sticky top-0 z-40">
        <div class="px-4 sm:px-6 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button type="button" @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-lg bg-blue-900 border border-white/20 text-white hover:bg-blue-800 transition" aria-label="Toggle navigation">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                <a href="{{ route('admin.dashboard') }}" class="hidden md:flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-[#FFCD00] text-[#00245A] flex items-center justify-center font-black text-sm border border-white">
                        🧭
                    </div>
                    <div>
                        <span class="font-black text-sm tracking-wider uppercase text-white">Pharma Career Compass</span>
                        <span class="text-[10px] text-[#FFCD00] block font-bold leading-none">Administration Suite</span>
                    </div>
                </a>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="hidden md:flex text-xs font-bold text-white/80 hover:text-white items-center gap-1.5 px-3 py-1.5 rounded bg-white/10 border border-white/20 hover:bg-white/20 transition">
                    <span>View Live Site</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>

                <div class="flex items-center gap-2 md:border-l md:border-white/20 md:pl-3">
                    <span class="text-xs font-bold text-[#FFCD00] hidden sm:inline">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 rounded bg-red-600 text-white text-xs font-bold hover:bg-red-700 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="flex-1 flex overflow-hidden">
        
        <!-- Sidebar Navigation -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
               class="fixed md:static inset-y-0 left-0 z-30 w-64 bg-white border-r border-slate-200 flex flex-col justify-between transition-transform duration-200 ease-in-out md:translate-x-0 pt-16 md:pt-0 overflow-y-auto">
            
            <div class="p-3 space-y-0.5">
                <span class="text-[10px] font-black uppercase tracking-wider text-[#00245A]/50 px-3 py-2 block">
                    Management
                </span>

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard Home</span>
                </a>

                <a href="{{ route('admin.bookings') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.bookings') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Bookings</span>
                </a>

                <a href="{{ route('admin.seminars.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.seminars.index') || request()->routeIs('admin.seminars.create') || request()->routeIs('admin.seminars.edit') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span>Seminars & Events</span>
                </a>

                <a href="{{ route('admin.seminars.registrations') }}"
                   class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.seminars.registrations*') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Seminar Registrations</span>
                    </div>
                    <span class="text-[9px] uppercase px-1.5 py-0.5 rounded font-black {{ request()->routeIs('admin.seminars.registrations*') ? 'bg-[#FFCD00] text-[#00245A]' : 'bg-emerald-100 text-emerald-800' }}">
                        Payments
                    </span>
                </a>

                <a href="{{ route('admin.services') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.services') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Services & Pricing</span>
                </a>

                <a href="{{ route('admin.career-paths') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.career-paths') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                    <span>Career Paths (11)</span>
                </a>

                <a href="{{ route('admin.consultants') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.consultants') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>Consultants & Slots</span>
                </a>

                <span class="text-[10px] font-black uppercase tracking-wider text-[#00245A]/50 px-3 pt-3 pb-1 block">
                    Preparation Banks
                </span>

                <a href="{{ route('admin.exams') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.exams') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Written Exam Questions</span>
                </a>

                <a href="{{ route('admin.viva') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.viva') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z"/></svg>
                    <span>Viva & Model Answers</span>
                </a>

                <span class="text-[10px] font-black uppercase tracking-wider text-[#00245A]/50 px-3 pt-3 pb-1 block">
                    Content & Feedback
                </span>

                <a href="{{ route('admin.blog') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.blog') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span>Articles & CMS</span>
                </a>

                <a href="{{ route('admin.testimonials') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.testimonials') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <span>Testimonials</span>
                </a>

                <a href="{{ route('admin.faqs') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.faqs') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>FAQs</span>
                </a>

                <a href="{{ route('admin.messages') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.messages') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Contact Inquiries</span>
                </a>

                <a href="{{ route('admin.settings') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('admin.settings') ? 'bg-[#00245A] text-white' : 'text-[#00245A] hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Site Settings</span>
                </a>
            </div>

            <div class="p-4 border-t border-slate-200 bg-slate-50 space-y-2">
                <a href="{{ route('home') }}" target="_blank" class="text-xs font-bold text-slate-700 hover:text-[#00245A] flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>View Live Site ↗</span>
                </a>
                <a href="{{ route('dashboard') }}" class="text-xs font-bold text-[#0085FF] hover:underline flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Switch to Candidate Mode</span>
                </a>
            </div>
        </aside>

        <!-- Mobile Sidebar Backdrop Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-20 md:hidden" style="display: none;" x-transition.opacity></div>

        <!-- Main Admin Canvas -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border-2 border-green-600 text-green-900 text-xs font-bold">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-50 border-2 border-red-500 text-red-900 text-xs font-bold">
                    {{ session('error') }}
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border-2 border-red-500 text-red-900 text-xs">
                    <span class="font-bold">Errors encountered:</span>
                    <ul class="list-disc list-inside mt-1">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('admin_content')
        </main>
    </div>

</body>
</html>
