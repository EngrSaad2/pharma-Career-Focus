@extends('layouts.dashboard')

@section('title', 'Candidate Profile Settings - Pharma Career Compass')

@section('dashboard_content')
<div class="space-y-8 max-w-4xl">
    <div>
        <h1 class="text-2xl font-black text-[#00245A]">Profile Settings</h1>
        <p class="text-xs text-[#00245A]/70 mt-1">Keep your pharmaceutical academic records and career interests updated</p>
    </div>

    <!-- Personal & Academic Details Form -->
    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-sm">
        <h3 class="text-lg font-extrabold text-[#00245A] mb-4">Academic & Career Information</h3>

        <form action="{{ route('dashboard.profile.update') }}" method="POST" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Full Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white">
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Email Address (Read Only)</label>
                    <input type="email" id="email" value="{{ $user->email }}" disabled
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-slate-50 text-slate-500 text-sm cursor-not-allowed">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Contact Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $profile->phone ?? '') }}"
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white"
                           placeholder="+880 17XXXXXXXX">
                </div>

                <div>
                    <label for="university" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">University / Institute</label>
                    <input type="text" id="university" name="university" value="{{ old('university', $profile->university ?? '') }}"
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white"
                           placeholder="e.g. University of Dhaka">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label for="education_level" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Degree / Qualification</label>
                    <select id="education_level" name="education_level"
                            class="w-full px-3 py-2.5 rounded-lg border border-slate-300 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-[#0085FF]">
                        <option value="B.Pharm" {{ old('education_level', $profile->education_level ?? '') == 'B.Pharm' ? 'selected' : '' }}>B.Pharm</option>
                        <option value="M.Pharm" {{ old('education_level', $profile->education_level ?? '') == 'M.Pharm' ? 'selected' : '' }}>M.Pharm</option>
                        <option value="Pharm.D" {{ old('education_level', $profile->education_level ?? '') == 'Pharm.D' ? 'selected' : '' }}>Pharm.D</option>
                        <option value="B.Sc in Chemistry/Biochem" {{ old('education_level', $profile->education_level ?? '') == 'B.Sc in Chemistry/Biochem' ? 'selected' : '' }}>B.Sc in Chemistry/Biochem</option>
                        <option value="Undergraduate Student" {{ old('education_level', $profile->education_level ?? '') == 'Undergraduate Student' ? 'selected' : '' }}>Undergraduate Student</option>
                    </select>
                </div>

                <div>
                    <label for="graduation_year" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Graduation Year</label>
                    <select id="graduation_year" name="graduation_year"
                            class="w-full px-3 py-2.5 rounded-lg border border-slate-300 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-[#0085FF]">
                        <option value="">Select year</option>
                        @for($y = date('Y') + 3; $y >= date('Y') - 10; $y--)
                            <option value="{{ $y }}" {{ old('graduation_year', $profile->graduation_year ?? '') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label for="target_department" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Primary Target Sector</label>
                    <select id="target_department" name="target_department"
                            class="w-full px-3 py-2.5 rounded-lg border border-slate-300 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-[#0085FF]">
                        <option value="">Exploring Options</option>
                        <option value="Quality Assurance (QA)" {{ old('target_department', $profile->target_department ?? '') == 'Quality Assurance (QA)' ? 'selected' : '' }}>Quality Assurance (QA)</option>
                        <option value="Quality Control (QC)" {{ old('target_department', $profile->target_department ?? '') == 'Quality Control (QC)' ? 'selected' : '' }}>Quality Control (QC)</option>
                        <option value="Production & Manufacturing" {{ old('target_department', $profile->target_department ?? '') == 'Production & Manufacturing' ? 'selected' : '' }}>Production & Manufacturing</option>
                        <option value="Regulatory Affairs" {{ old('target_department', $profile->target_department ?? '') == 'Regulatory Affairs' ? 'selected' : '' }}>Regulatory Affairs</option>
                        <option value="Research & Development" {{ old('target_department', $profile->target_department ?? '') == 'Research & Development' ? 'selected' : '' }}>Research & Development</option>
                        <option value="Pharmacovigilance" {{ old('target_department', $profile->target_department ?? '') == 'Pharmacovigilance' ? 'selected' : '' }}>Pharmacovigilance</option>
                        <option value="Hospital & Clinical Pharmacy" {{ old('target_department', $profile->target_department ?? '') == 'Hospital & Clinical Pharmacy' ? 'selected' : '' }}>Hospital & Clinical Pharmacy</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="linkedin_url" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">LinkedIn Profile Link</label>
                <input type="url" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $profile->linkedin_url ?? '') }}"
                       class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white"
                       placeholder="https://linkedin.com/in/username">
            </div>

            <div>
                <button type="submit"
                        class="px-6 py-2.5 rounded-lg bg-[#0085FF] text-white font-bold text-xs uppercase tracking-wider shadow-sm hover:bg-blue-600">
                    Save Profile Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Password Change Card -->
    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-sm">
        <h3 class="text-lg font-extrabold text-[#00245A] mb-4">Security & Password</h3>

        <form action="{{ route('dashboard.password.update') }}" method="POST" class="space-y-4 max-w-md">
            @csrf
            <div>
                <label for="current_password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Current Password *</label>
                <input type="password" id="current_password" name="current_password" required
                       class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white">
            </div>

            <div>
                <label for="new_password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">New Password (Min 8 characters) *</label>
                <input type="password" id="new_password" name="new_password" required
                       class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white">
            </div>

            <div>
                <label for="new_password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Confirm New Password *</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" required
                       class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#0085FF] bg-white">
            </div>

            <div>
                <button type="submit"
                        class="px-6 py-2.5 rounded-lg bg-[#00245A] text-white font-bold text-xs uppercase tracking-wider shadow-sm hover:bg-blue-900">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
