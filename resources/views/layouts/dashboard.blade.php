<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Candidate Dashboard - Pharma Career Compass')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="h-full flex flex-col text-slate-900 bg-white" x-data="{ sidebarOpen: false }">

    <!-- Top Navigation Bar -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <!-- Mobile Menu Button -->
                <button type="button" @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-lg border border-slate-200 text-slate-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    @include('components.logo', ['size' => 'sm'])
                </a>

                <span class="hidden sm:inline-block px-2.5 py-0.5 rounded bg-[#FFCD00]/25 text-[#00245A] text-[10px] font-black uppercase tracking-wider border border-[#FFCD00]">
                    Candidate Portal
                </span>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('consultation.book') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider shadow-sm hover:bg-blue-600">
                    <span>Book Session</span>
                </a>

                <div class="flex items-center gap-2 border-l border-slate-200 pl-3">
                    <div class="w-8 h-8 rounded-full bg-[#00245A] text-white font-black text-xs flex items-center justify-center">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-xs font-bold leading-tight">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-500 leading-none">{{ auth()->user()->role ?? 'Candidate' }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="ml-2">
                        @csrf
                        <button type="submit" class="p-1.5 text-xs text-red-600 hover:text-red-800 font-bold" title="Sign Out">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Container with Sidebar -->
    <div class="flex-1 flex overflow-hidden">
        
        <!-- Sidebar Navigation -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
               class="fixed md:static inset-y-0 left-0 z-30 w-64 bg-white border-r border-slate-200 flex flex-col justify-between transition-transform duration-200 ease-in-out md:translate-x-0 pt-16 md:pt-0">
            
            <div class="p-4 space-y-1 overflow-y-auto">
                <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 px-3 py-2 block">
                    Preparation Modules
                </span>

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('dashboard') ? 'bg-[#00245A] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span>Dashboard Overview</span>
                </a>

                <a href="{{ route('dashboard.assessment') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('dashboard.assessment') ? 'bg-[#00245A] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Career Assessment</span>
                </a>

                <a href="{{ route('dashboard.roadmap') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('dashboard.roadmap') ? 'bg-[#00245A] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                    <span>Career Roadmap</span>
                </a>

                <a href="{{ route('dashboard.exams') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('dashboard.exams') ? 'bg-[#00245A] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Exam Attempts</span>
                </a>

                <a href="{{ route('dashboard.viva') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('dashboard.viva') ? 'bg-[#00245A] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z"/></svg>
                    <span>Viva & Interview Prep</span>
                </a>

                <a href="{{ route('dashboard.bookings') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('dashboard.bookings') ? 'bg-[#00245A] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>Consultation Bookings</span>
                </a>

                <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 px-3 pt-4 pb-2 block">
                    Account & Profile
                </span>

                <a href="{{ route('dashboard.profile') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold transition-all {{ request()->routeIs('dashboard.profile') ? 'bg-[#00245A] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>My Profile</span>
                </a>

                @if(auth()->user()->role === 'admin')
                    <div class="pt-4 border-t border-slate-200 mt-4">
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-black bg-[#FFCD00] text-[#00245A] border border-amber-300 shadow-sm hover:bg-yellow-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Open Admin Panel</span>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Footer quick links -->
            <div class="p-4 border-t border-slate-200 bg-slate-50">
                <a href="{{ route('home') }}" class="text-xs font-bold text-[#0085FF] hover:underline flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Back to Website</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-slate-50/60">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-900 text-xs font-bold flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-900 text-xs font-bold">
                    {{ session('error') }}
                </div>
            @endif

            @yield('dashboard_content')
        </main>
    </div>

</body>
</html>
