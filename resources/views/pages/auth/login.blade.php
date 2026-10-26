@extends('layouts.app')

@section('title', 'Sign In - Pharma Career Compass')
@section('meta_description', 'Sign in to access your Pharma Career Compass candidate dashboard, exam results, roadmap, and consultation bookings.')

@section('content')
<section class="py-16 md:py-20 bg-slate-50 min-h-[80vh] flex items-center">
    <div class="max-w-md mx-auto w-full px-4 sm:px-6">
        
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-4">
                @include('components.logo', ['size' => 'md'])
            </a>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">Welcome Back</h1>
            <p class="text-xs text-slate-500 mt-1">Access your pharmaceutical career preparation dashboard</p>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
            @if(session('status'))
                <div class="mb-4 p-3 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4" id="loginForm">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF]/20 focus:border-[#0085FF] transition-colors"
                           placeholder="you@example.com">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Password</label>
                    </div>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF]/20 focus:border-[#0085FF] transition-colors"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-[#0085FF] focus:ring-[#0085FF]">
                        <span class="text-xs text-slate-600 font-medium">Keep me signed in</span>
                    </label>
                </div>

                <button type="submit"
                        class="btn-primary w-full py-3 shadow-sm mt-2">
                    Sign In to Dashboard
                </button>
            </form>

            <!-- Quick Demo Login Switcher -->
            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-2.5">
                    Quick Demo Autofill Credentials
                </span>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" onclick="fillCreds('admin@pharmacareer.com', 'password')"
                            class="px-2 py-1.5 rounded-lg bg-slate-900 text-white font-bold text-[10px] uppercase hover:bg-slate-800 transition-colors shadow-sm">
                        Admin
                    </button>
                    <button type="button" onclick="fillCreds('consultant@pharmacareer.com', 'password')"
                            class="px-2 py-1.5 rounded-lg bg-amber-400 text-slate-900 font-bold text-[10px] uppercase hover:bg-amber-500 transition-colors shadow-sm">
                        Consultant
                    </button>
                    <button type="button" onclick="fillCreds('student@pharmacareer.com', 'password')"
                            class="px-2 py-1.5 rounded-lg bg-slate-100 text-slate-700 font-bold text-[10px] uppercase hover:bg-slate-200 transition-colors border border-slate-200 shadow-sm">
                        Candidate
                    </button>
                </div>
            </div>

            <div class="mt-6 text-center text-xs text-slate-500">
                Don't have an account yet? 
                <a href="{{ route('register') }}" class="font-bold text-[#0085FF] hover:underline">
                    Create Free Profile
                </a>
            </div>
        </div>

    </div>
</section>

<script>
function fillCreds(email, password) {
    document.getElementById('email').value = email;
    document.getElementById('password').value = password;
}
</script>
@endsection
