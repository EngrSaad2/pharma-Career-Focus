<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Pharma Career Compass | Premier Pharma Career Guidance, Exam Prep & Mentorship')</title>
    <meta name="description" content="@yield('meta_description', 'Pharma Career Compass is your dedicated pharma career platform. Master pharmaceutical written exams, viva coaching, career planning, and 1-on-1 industry mentorship.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Pharma Career, Pharma Career Compass, pharma career bangladesh, pharmaceutical career guidance, industrial pharmacy, QA pharmacist career, QC analyst preparation, pharma viva coaching, pharma written exam preparation, pharma career launchpad')">
    <meta name="author" content="Pharma Career Compass">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}?v=2">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=2">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2">

    <!-- Open Graph / Facebook Debugger Metadata -->
    <meta property="og:site_name" content="Pharma Career Compass">
    <meta property="og:title" content="@yield('og_title', 'Pharma Career Compass | Pharma Career Guidance & Exam Prep')">
    <meta property="og:description" content="@yield('og_description', 'Discover your pharma career trajectory with Pharma Career Compass. Master recruitment exams, viva interviews, and industrial GMP standards with senior pharmaceutical mentors.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US">
    <meta property="og:image" content="@yield('og_image', asset('images/og-pharma-compass.jpg'))">
    <meta property="og:image:secure_url" content="@yield('og_image', asset('images/og-pharma-compass.jpg'))">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Pharma Career Compass - Discover Your Direction. Build Your Future.">

    <!-- Twitter Card Metadata -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Pharma Career Compass | Pharma Career Guidance & Exam Prep')">
    <meta name="twitter:description" content="@yield('og_description', 'Discover your pharma career trajectory with Pharma Career Compass. Master recruitment exams, viva interviews, and industrial GMP standards with senior pharmaceutical mentors.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-pharma-compass.jpg'))">
    <meta name="twitter:image:alt" content="Pharma Career Compass - Discover Your Direction. Build Your Future.">

    <!-- Google Fonts: Plus Jakarta Sans (Modern Classic Editorial Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Structured Data (JSON-LD Schema) for Google Search -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@graph": [
        {
          "@@type": "WebSite",
          "@@id": "{{ url('/') }}#website",
          "url": "{{ url('/') }}",
          "name": "Pharma Career Compass",
          "alternateName": ["Pharma Career", "Pharma Career BD", "Pharma Career Compass Bangladesh"],
          "description": "Premier pharmaceutical career guidance, written exam preparation, viva coaching, and 1-on-1 mentorship platform.",
          "inLanguage": "en-US",
          "potentialAction": {
            "@@type": "SearchAction",
            "target": "{{ url('/career-paths') }}?q={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        },
        {
          "@@type": "EducationalOrganization",
          "@@id": "{{ url('/') }}#organization",
          "name": "Pharma Career Compass",
          "alternateName": "Pharma Career",
          "url": "{{ url('/') }}",
          "logo": {
            "@@type": "ImageObject",
            "url": "{{ asset('favicon-192x192.png') }}",
            "width": 192,
            "height": 192
          },
          "image": "{{ asset('images/og-pharma-compass.jpg') }}",
          "description": "Dedicated pharmaceutical career guidance and exam preparation platform. We help pharmacy graduates and professionals advance their pharma career in Industrial QA, QC, Production, and Regulatory Affairs.",
          "keywords": "Pharma Career, Pharma Career Compass, Pharmacy Career Guidance, Pharmaceutical Exam Prep, Pharma Viva Coaching",
          "sameAs": [
            "https://linkedin.com/company/pharma-career-compass",
            "https://facebook.com/pharmacareercompass"
          ],
          "contactPoint": {
            "@@type": "ContactPoint",
            "telephone": "+880 1844 567890",
            "contactType": "Customer Support & Inquiries",
            "email": "info@pharmacareercompass.com",
            "areaServed": "BD",
            "availableLanguage": ["English", "Bengali"]
          }
        }
      ]
    }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased text-slate-900 bg-white min-h-screen flex flex-col overflow-x-hidden w-full" x-data="{ mobileMenuOpen: false }">

    <!-- Top Announcement Ticker Banner (Gritty Mentor inspired) -->
    <div class="bg-[#FFCD00] text-[#00245A] font-semibold text-xs sm:text-sm py-2 overflow-hidden border-b border-yellow-400 select-none shadow-sm">
        <div class="relative w-full overflow-hidden flex items-center">
            <div class="animate-marquee whitespace-nowrap flex items-center gap-8 tracking-wide">
                <span>• &nbsp; Consultation Packages Starting from ৳800 to ৳1,500 with Senior Industry Pharmacists</span>
                <span>• &nbsp; Join the PHARMA CAREER LAUNCHPAD Cohort</span>
                <span>• &nbsp; Discover Your Direction in Quality Assurance, QC, Production & Regulatory Affairs</span>
                <span>• &nbsp; Consultation Packages Starting from ৳800 to ৳1,500 with Senior Industry Pharmacists</span>
                <span>• &nbsp; Join the PHARMA CAREER LAUNCHPAD Cohort</span>
                <span>• &nbsp; Discover Your Direction in Quality Assurance, QC, Production & Regulatory Affairs</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="focus:outline-none focus:ring-2 focus:ring-[#0085FF] rounded-lg">
                    @include('components.logo')
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-3.5 xl:gap-6 2xl:gap-7 text-xs xl:text-sm font-semibold text-slate-700">
                    <a href="{{ route('home') }}" class="hover:text-[#0085FF] transition-colors {{ request()->routeIs('home') ? 'text-[#0085FF] font-semibold' : '' }}">
                        Home
                    </a>

                    <!-- Career Programs Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1 hover:text-[#0085FF] transition-colors focus:outline-none py-2 {{ request()->routeIs('programs*') ? 'text-[#0085FF] font-semibold' : '' }}">
                            <span>Career Programs</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                             class="absolute left-0 mt-0 w-72 bg-white rounded-xl shadow-xl border border-slate-100 p-2.5 z-50">
                            <a href="{{ route('programs') }}" class="flex items-start gap-3 p-2.5 rounded-lg hover:bg-[#EAF4FF] transition-colors group">
                                <div class="w-8 h-8 rounded-lg bg-[#0085FF]/10 text-[#0085FF] flex items-center justify-center shrink-0 group-hover:bg-[#0085FF] group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-800 text-sm">Pharma Career Launchpad</div>
                                    <div class="text-xs text-slate-500">Comprehensive flagship preparation program</div>
                                </div>
                            </a>
                            <a href="{{ route('career-paths.index') }}" class="flex items-start gap-3 p-2.5 rounded-lg hover:bg-[#EAF4FF] transition-colors group">
                                <div class="w-8 h-8 rounded-lg bg-[#00245A]/10 text-[#00245A] flex items-center justify-center shrink-0 group-hover:bg-[#00245A] group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-800 text-sm">11 Pharma Career Paths</div>
                                    <div class="text-xs text-slate-500">QA, QC, Production, Regulatory & more</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Services Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1 hover:text-[#0085FF] transition-colors focus:outline-none py-2 {{ request()->routeIs('services*') ? 'text-[#0085FF] font-semibold' : '' }}">
                            <span>Our Services</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                             class="absolute left-0 mt-0 w-80 bg-white rounded-xl shadow-xl border border-slate-100 p-2.5 z-50">
                            <a href="{{ route('services.index') }}" class="block px-3 py-2 text-xs font-bold uppercase tracking-wider text-[#0085FF] hover:underline">
                                View All 7 Services &rarr;
                            </a>
                            <div class="divide-y divide-slate-100">
                                <a href="{{ route('services.show', 'career-planning-consultation') }}" class="block p-2 rounded hover:bg-[#EAF4FF] text-sm text-slate-700">Career Planning Consultation</a>
                                <a href="{{ route('services.show', 'written-exam-preparation') }}" class="block p-2 rounded hover:bg-[#EAF4FF] text-sm text-slate-700">Written Exam Preparation</a>
                                <a href="{{ route('services.show', 'viva-oral-examination-preparation') }}" class="block p-2 rounded hover:bg-[#EAF4FF] text-sm text-slate-700">Viva & Oral Exam Coaching</a>
                                <a href="{{ route('services.show', 'job-interview-preparation') }}" class="block p-2 rounded hover:bg-[#EAF4FF] text-sm text-slate-700">Job Interview Readiness</a>
                                <a href="{{ route('services.show', 'cv-linkedin-review') }}" class="block p-2 rounded hover:bg-[#EAF4FF] text-sm text-slate-700">CV & LinkedIn Review</a>
                                <a href="{{ route('services.show', 'one-to-one-mentorship') }}" class="block p-2 rounded hover:bg-[#EAF4FF] text-sm text-slate-700">1-on-1 Mentorship</a>
                            </div>
                        </div>
                    </div>

                    <!-- Career Assessment Quiz Link -->
                    <a href="{{ route('quiz.index') }}" class="relative inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-blue-50 text-[#0085FF] font-semibold text-xs border border-blue-200 hover:bg-[#0085FF] hover:text-white transition-all shadow-sm">
                        Career Quiz
                        <span class="bg-[#FFCD00] text-[#00245A] text-[9px] font-bold px-1.5 py-0.2 rounded-full ml-0.5">Free</span>
                    </a>

                    <!-- Practice Hub Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1 hover:text-[#0085FF] transition-colors focus:outline-none py-2 {{ request()->routeIs('practice*') || request()->routeIs('roadmap*') ? 'text-[#0085FF] font-semibold' : '' }}">
                            <span>Practice Hub</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                             class="absolute left-0 mt-0 w-72 bg-white rounded-xl shadow-xl border border-slate-100 p-2 z-50">
                            <a href="{{ route('practice.exams') }}" class="flex items-center gap-2.5 p-2 rounded-lg hover:bg-[#EAF4FF] text-sm text-slate-700">
                                <span class="w-6 h-6 rounded bg-blue-100 text-[#0085FF] flex items-center justify-center text-xs font-bold">1</span>
                                <div>
                                    <div class="font-semibold">Written Exam MCQs</div>
                                    <div class="text-[11px] text-slate-500">Timed tests & scoring</div>
                                </div>
                            </a>
                            <a href="{{ route('practice.viva') }}" class="flex items-center gap-2.5 p-2 rounded-lg hover:bg-[#EAF4FF] text-sm text-slate-700">
                                <span class="w-6 h-6 rounded bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold">2</span>
                                <div>
                                    <div class="font-semibold">Viva Questions & Answers</div>
                                    <div class="text-[11px] text-slate-500">Model answers & tips</div>
                                </div>
                            </a>
                            <a href="{{ route('practice.interviews') }}" class="flex items-center gap-2.5 p-2 rounded-lg hover:bg-[#EAF4FF] text-sm text-slate-700">
                                <span class="w-6 h-6 rounded bg-amber-100 text-amber-700 flex items-center justify-center text-xs font-bold">3</span>
                                <div>
                                    <div class="font-semibold">Job Interview Bank</div>
                                    <div class="text-[11px] text-slate-500">STAR method responses</div>
                                </div>
                            </a>
                            <a href="{{ route('roadmap.index') }}" class="flex items-center gap-2.5 p-2 rounded-lg hover:bg-[#EAF4FF] text-sm text-slate-700 border-t border-slate-100 mt-1 pt-2">
                                <span class="w-6 h-6 rounded bg-purple-100 text-purple-700 flex items-center justify-center text-xs font-bold">&bull;</span>
                                <div>
                                    <div class="font-semibold">Career Roadmap Builder</div>
                                    <div class="text-[11px] text-slate-500">Step-by-step milestones</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('seminars.index') }}" class="hover:text-[#0085FF] transition-colors {{ request()->routeIs('seminars*') ? 'text-[#0085FF] font-semibold' : '' }}">
                        Seminars
                    </a>

                    <a href="{{ route('blog.index') }}" class="hover:text-[#0085FF] transition-colors {{ request()->routeIs('blog*') ? 'text-[#0085FF]' : '' }}">
                        Blog
                    </a>

                    <a href="{{ route('contact') }}" class="hover:text-[#0085FF] transition-colors {{ request()->routeIs('contact') ? 'text-[#0085FF]' : '' }}">
                        Contact
                    </a>
                </nav>

                <!-- Right Action / User Profile Icon (Gritty Mentor style) -->
                <div class="hidden lg:flex items-center">
                    <div class="relative" x-data="{ userMenuOpen: false }" @click.outside="userMenuOpen = false">
                        @auth
                            <button @click="userMenuOpen = !userMenuOpen" 
                                    type="button"
                                    class="flex items-center gap-2 p-1.5 rounded-full hover:bg-slate-100 transition-colors focus:outline-none focus:ring-2 focus:ring-[#0085FF]" 
                                    aria-label="User Account Menu"
                                    title="{{ auth()->user()->name }}">
                                <span class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#00245A] to-[#0085FF] text-white flex items-center justify-center font-bold text-xs shadow-xs border border-white">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                                <svg class="w-3.5 h-3.5 text-slate-500 transition-transform duration-150" :class="{ 'rotate-180': userMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <!-- Account Dropdown Menu -->
                            <div x-show="userMenuOpen" 
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-slate-200/80 p-2 z-50 text-left"
                                 style="display: none;">
                                <div class="px-3 py-2 border-b border-slate-100">
                                    <div class="font-bold text-sm text-[#00245A] truncate">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</div>
                                    @if(auth()->user()->isAdmin())
                                        <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-bold bg-purple-100 text-purple-700">Administrator</span>
                                    @endif
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-slate-700 hover:bg-[#EAF4FF] hover:text-[#0085FF] transition-colors font-medium">
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                        <span>Candidate Portal</span>
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-slate-700 hover:bg-[#EAF4FF] hover:text-[#0085FF] transition-colors font-medium">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            <span class="font-semibold text-purple-700">Admin Suite</span>
                                        </a>
                                    @endif
                                    <a href="{{ route('dashboard.bookings') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-slate-700 hover:bg-[#EAF4FF] hover:text-[#0085FF] transition-colors font-medium">
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>My Consultations</span>
                                    </a>
                                </div>
                                <div class="pt-1 border-t border-slate-100">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-red-600 hover:bg-red-50 transition-colors font-medium text-left">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                            <span>Sign Out</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <!-- Guest Profile Icon (Gritty Mentor style) -->
                            <a href="{{ route('login') }}" 
                               class="w-10 h-10 rounded-full hover:bg-slate-100 flex items-center justify-center text-slate-700 hover:text-[#0085FF] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0085FF]" 
                               aria-label="Account Login" 
                               title="Log In / Account">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Mobile Header Right (User Icon + Hamburger Button) -->
                <div class="flex items-center gap-2 lg:hidden">
                    @auth
                        <a href="{{ route('dashboard') }}" class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#00245A] to-[#0085FF] text-white flex items-center justify-center font-bold text-xs shadow-xs" title="My Dashboard">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-9 h-9 rounded-full hover:bg-slate-100 flex items-center justify-center text-slate-700 hover:text-[#0085FF]" title="Log In">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </a>
                    @endauth

                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            type="button" 
                            class="p-2 rounded-lg text-slate-700 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-[#0085FF]" 
                            aria-label="Toggle navigation menu">
                        <svg class="w-6 h-6" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                        <svg class="w-6 h-6" x-show="mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden bg-white border-b border-slate-200 px-4 pt-3 pb-6 space-y-3"
             style="display: none;">
            
            <!-- Quick CTA Button in Drawer -->
            <a href="{{ route('booking.create') }}" class="btn-primary w-full py-2.5 text-center text-sm shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span>Book a Consultation</span>
            </a>

            <div class="grid grid-cols-2 gap-2 text-sm pt-2">
                <a href="{{ route('home') }}" class="p-2.5 rounded-lg bg-slate-50 font-medium text-slate-800 hover:bg-[#EAF4FF] hover:text-[#0085FF]">Home</a>
                <a href="{{ route('programs') }}" class="p-2.5 rounded-lg bg-slate-50 font-medium text-slate-800 hover:bg-[#EAF4FF] hover:text-[#0085FF]">Career Launchpad</a>
                <a href="{{ route('services.index') }}" class="p-2.5 rounded-lg bg-slate-50 font-medium text-slate-800 hover:bg-[#EAF4FF] hover:text-[#0085FF]">Our Services</a>
                <a href="{{ route('career-paths.index') }}" class="p-2.5 rounded-lg bg-slate-50 font-medium text-slate-800 hover:bg-[#EAF4FF] hover:text-[#0085FF]">11 Career Paths</a>
                <a href="{{ route('quiz.index') }}" class="p-2.5 rounded-lg bg-blue-50 font-bold text-[#0085FF]">Career Quiz (Free)</a>
                <a href="{{ route('roadmap.index') }}" class="p-2.5 rounded-lg bg-slate-50 font-medium text-slate-800 hover:bg-[#EAF4FF] hover:text-[#0085FF]">Career Roadmap</a>
                <a href="{{ route('practice.exams') }}" class="p-2.5 rounded-lg bg-slate-50 font-medium text-slate-800 hover:bg-[#EAF4FF] hover:text-[#0085FF]">Written Exams</a>
                <a href="{{ route('practice.viva') }}" class="p-2.5 rounded-lg bg-slate-50 font-medium text-slate-800 hover:bg-[#EAF4FF] hover:text-[#0085FF]">Viva Questions</a>
                <a href="{{ route('practice.interviews') }}" class="p-2.5 rounded-lg bg-slate-50 font-medium text-slate-800 hover:bg-[#EAF4FF] hover:text-[#0085FF]">Interview Bank</a>
                <a href="{{ route('consultants.index') }}" class="p-2.5 rounded-lg bg-slate-50 font-medium text-slate-800 hover:bg-[#EAF4FF] hover:text-[#0085FF]">Consultants</a>
                <a href="{{ route('seminars.index') }}" class="p-2.5 rounded-lg bg-slate-50 font-medium text-slate-800 hover:bg-[#EAF4FF] hover:text-[#0085FF]">Seminars & Events</a>
                <a href="{{ route('blog.index') }}" class="p-2.5 rounded-lg bg-slate-50 font-medium text-slate-800 hover:bg-[#EAF4FF] hover:text-[#0085FF]">Articles & Blog</a>
                <a href="{{ route('contact') }}" class="p-2.5 rounded-lg bg-slate-50 font-medium text-slate-800 hover:bg-[#EAF4FF] hover:text-[#0085FF]">Contact Us</a>
            </div>

            <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
                @auth
                    <div class="flex items-center justify-between p-2.5 rounded-lg bg-slate-50">
                        <div class="flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#00245A] to-[#0085FF] text-white flex items-center justify-center font-bold text-xs">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <div class="text-xs">
                                <div class="font-bold text-[#00245A]">{{ auth()->user()->name }}</div>
                                <div class="text-slate-500">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-xs text-red-600 font-semibold px-2 py-1 rounded hover:bg-red-50">
                                Sign Out
                            </button>
                        </form>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('dashboard') }}" class="text-center py-2 rounded-lg bg-[#00245A] text-white font-semibold text-xs">
                            Candidate Portal
                        </a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-center py-2 rounded-lg bg-purple-700 text-white font-semibold text-xs">
                                Admin Suite
                            </a>
                        @else
                            <a href="{{ route('dashboard.bookings') }}" class="text-center py-2 rounded-lg bg-[#EAF4FF] text-[#0085FF] font-semibold text-xs">
                                My Consultations
                            </a>
                        @endif
                    </div>
                @else
                    <div class="flex gap-2">
                        <a href="{{ route('login') }}" class="w-1/2 text-center py-2 rounded-lg border border-slate-300 font-semibold text-sm text-slate-700 hover:bg-slate-50">
                            Log In
                        </a>
                        <a href="{{ route('register') }}" class="w-1/2 text-center py-2 rounded-lg bg-[#0085FF] font-semibold text-sm text-white hover:bg-blue-600">
                            Sign Up
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Global Toast / Alerts -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4" x-data="{ show: true }" x-show="show">
            <div class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-300 rounded-xl text-emerald-900 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-700 hover:text-emerald-900">&times;</button>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4" x-data="{ show: true }" x-show="show">
            <div class="flex items-center justify-between p-4 bg-blue-50 border border-blue-300 rounded-xl text-blue-900 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#0085FF] shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="text-sm font-medium">{{ session('info') }}</span>
                </div>
                <button @click="show = false" class="text-blue-700 hover:text-blue-900">&times;</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4" x-data="{ show: true }" x-show="show">
            <div class="flex items-center justify-between p-4 bg-rose-50 border border-rose-300 rounded-xl text-rose-900 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-rose-700 hover:text-rose-900">&times;</button>
            </div>
        </div>
    @endif

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Comprehensive Footer -->
    <footer class="bg-[#00173B] text-slate-300 border-t border-slate-800 pt-16 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#00245A] to-[#0085FF] p-2 flex items-center justify-center">
                            <svg class="w-full h-full text-white" viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="2"/><polygon points="24,24 22,25 29,11 25,22" fill="#FFCD00"/><polygon points="24,24 26,23 19,37 23,26" fill="#FFFFFF"/></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-xl text-white">Pharma<span class="text-[#0085FF]">Career</span> Compass</span>
                            <span class="text-[10px] tracking-widest uppercase text-slate-400">Discover Your Direction. Build Your Future.</span>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                        A dedicated career preparation and consultation platform for pharmacists, pharmaceutical graduates, job seekers, and working professionals. Bridging academic knowledge with industrial reality.
                    </p>
                    <div class="pt-2 text-xs text-slate-400 space-y-1">
                        <div><strong class="text-slate-300">Office:</strong> Suite 7B, Pharma Innovation Hub, Navana Tower, Gulshan-1, Dhaka</div>
                        <div><strong class="text-slate-300">Direct Inquiries:</strong> info@pharmacareercompass.com</div>
                        <div><strong class="text-slate-300">Support Desk:</strong> +880 1844 567890</div>
                    </div>
                </div>

                <!-- Col 2: Program Pillars -->
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">5 Launchpad Pillars</h4>
                    <ul class="space-y-2.5 text-xs sm:text-sm text-slate-400">
                        <li><a href="{{ route('services.show', 'career-planning-consultation') }}" class="hover:text-white transition-colors">Career Planning</a></li>
                        <li><a href="{{ route('services.show', 'written-exam-preparation') }}" class="hover:text-white transition-colors">Written Exam Preparation</a></li>
                        <li><a href="{{ route('services.show', 'viva-oral-examination-preparation') }}" class="hover:text-white transition-colors">Viva Skills Coaching</a></li>
                        <li><a href="{{ route('services.show', 'job-interview-preparation') }}" class="hover:text-white transition-colors">Interview Readiness</a></li>
                        <li><a href="{{ route('services.show', 'pharmaceutical-industry-insights') }}" class="hover:text-white transition-colors">Industry Insights</a></li>
                    </ul>
                </div>

                <!-- Col 3: Interactive Hubs -->
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Practice Hubs</h4>
                    <ul class="space-y-2.5 text-xs sm:text-sm text-slate-400">
                        <li><a href="{{ route('quiz.index') }}" class="hover:text-white transition-colors">Career Quiz</a></li>
                        <li><a href="{{ route('roadmap.index') }}" class="hover:text-white transition-colors">Roadmap Builder</a></li>
                        <li><a href="{{ route('practice.exams') }}" class="hover:text-white transition-colors">Written Exam MCQs</a></li>
                        <li><a href="{{ route('practice.viva') }}" class="hover:text-white transition-colors">Viva Model Answers</a></li>
                        <li><a href="{{ route('practice.interviews') }}" class="hover:text-white transition-colors">Interview Questions</a></li>
                        <li><a href="{{ route('career-paths.index') }}" class="hover:text-white transition-colors">11 Career Paths</a></li>
                    </ul>
                </div>

                <!-- Col 4: Newsletter & Consult -->
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Stay Informed</h4>
                    <p class="text-xs text-slate-400 mb-3">
                        Receive weekly pharmaceutical exam questions, recruitment alerts, and interview strategies.
                    </p>
                    <form action="{{ route('newsletter.submit') }}" method="POST" class="space-y-2">
                        @csrf
                        <input type="email" name="email" required placeholder="Enter your email" class="w-full px-3 py-2 text-xs bg-slate-900 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#0085FF]">
                        <button type="submit" class="w-full btn-accent text-xs py-2 shadow-none font-bold">
                            Subscribe
                        </button>
                    </form>
                    <div class="mt-4 pt-3 border-t border-slate-800">
                        <a href="{{ route('booking.create') }}" class="text-xs text-[#FFCD00] hover:underline font-semibold block">
                            &rarr; Book a 1-on-1 Consultation
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Disclaimer & Copyright -->
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} Pharma Career Compass. All rights reserved. Professional career education & preparation.</p>
                <p class="text-xs text-slate-400">
                    Developed by <a href="https://engr-saad.com" target="_blank" rel="noopener noreferrer" class="text-[#FFCD00] hover:underline font-semibold inline-flex items-center gap-0.5">Engr Saad ↗</a>
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
