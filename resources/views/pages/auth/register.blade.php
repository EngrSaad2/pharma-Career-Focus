@extends('layouts.app')

@section('title', 'Register - Pharma Career Compass')
@section('meta_description', 'Create your Pharma Career Compass account to track your pharmaceutical career roadmap, practice written exams, and book 1-on-1 consultations.')

@section('content')
<section class="py-16 bg-slate-50 min-h-[85vh] flex items-center">
    <div class="max-w-lg mx-auto w-full px-4 sm:px-6">
        
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-4">
                @include('components.logo', ['size' => 'md'])
            </a>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">Create Your Candidate Account</h1>
            <p class="text-xs text-slate-500 mt-1">Start your structured pharmaceutical career preparation journey</p>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
            @if($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                    <p class="font-bold mb-1">Registration couldn't proceed:</p>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Full Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF]/20 focus:border-[#0085FF] transition-colors"
                           placeholder="e.g. Nusrat Jahan">
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Email Address *</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF]/20 focus:border-[#0085FF] transition-colors"
                           placeholder="nusrat@example.com">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Password *</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF]/20 focus:border-[#0085FF] transition-colors"
                               placeholder="Min 8 characters">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Confirm Password *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF]/20 focus:border-[#0085FF] transition-colors"
                               placeholder="Repeat password">
                    </div>
                </div>

                <!-- Pharmacy Academic Background -->
                <div class="pt-2 border-t border-slate-100">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#0085FF] block mb-3">Academic & Career Profile</span>
                    
                    <div class="space-y-3">
                        <div>
                            <label for="university" class="block text-xs font-bold text-slate-700 mb-1.5">University / Institute</label>
                            <input type="text" id="university" name="university" value="{{ old('university') }}"
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF]/20 focus:border-[#0085FF] transition-colors"
                                   placeholder="e.g. University of Dhaka, Jahangirnagar University, North South University">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label for="graduation_year" class="block text-xs font-bold text-slate-700 mb-1.5">Graduation Year</label>
                                <select id="graduation_year" name="graduation_year"
                                        class="w-full px-3 py-2.5 rounded-lg border border-slate-300 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-[#0085FF]/20 focus:border-[#0085FF] transition-colors">
                                    <option value="">Select year</option>
                                    @for($y = date('Y') + 3; $y >= date('Y') - 10; $y--)
                                        <option value="{{ $y }}" {{ old('graduation_year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div>
                                <label for="target_department" class="block text-xs font-bold text-slate-700 mb-1.5">Target Sector</label>
                                <select id="target_department" name="target_department"
                                        class="w-full px-3 py-2.5 rounded-lg border border-slate-300 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-[#0085FF]/20 focus:border-[#0085FF] transition-colors">
                                    <option value="">Exploring Options</option>
                                    <option value="Quality Assurance (QA)">Quality Assurance (QA)</option>
                                    <option value="Quality Control (QC)">Quality Control (QC)</option>
                                    <option value="Production & Manufacturing">Production & Manufacturing</option>
                                    <option value="Regulatory Affairs">Regulatory Affairs</option>
                                    <option value="Research & Development">Research & Development</option>
                                    <option value="Pharmacovigilance">Pharmacovigilance</option>
                                    <option value="Product Management (PMD)">Product Management (PMD)</option>
                                    <option value="Hospital & Clinical">Hospital & Clinical</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="btn-primary w-full py-3 shadow-sm">
                        Create Free Candidate Profile
                    </button>
                    <p class="text-[11px] text-slate-500 text-center mt-2.5">
                        Free access to standard exam questions, viva bank, and roadmap generator.
                    </p>
                </div>
            </form>

            <div class="mt-6 pt-4 border-t border-slate-100 text-center text-xs text-slate-500">
                Already registered? 
                <a href="{{ route('login') }}" class="font-bold text-[#0085FF] hover:underline">
                    Sign In Here
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
