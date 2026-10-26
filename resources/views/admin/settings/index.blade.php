@extends('layouts.admin')

@section('title', 'Site Branding & Settings - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8 max-w-4xl">
    <div>
        <h1 class="text-2xl font-black text-[#00245A]">Site Branding & Operational Settings</h1>
        <p class="text-xs text-[#00245A]/70 mt-1">Configure brand identity, taglines, announcement bar, contact channels, and footer information</p>
    </div>

    <div class="bg-white p-6 sm:p-8 rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a]">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Brand Identity -->
            <div class="border-b border-[#00245A]/10 pb-6">
                <h3 class="text-base font-black text-[#00245A] mb-4">Core Brand Identity</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Site / Brand Name</label>
                        <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'Pharma Career Compass' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Primary Tagline</label>
                        <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? 'Discover Your Direction. Build Your Future.' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Top Announcement Bar Ticker</label>
                    <input type="text" name="ticker_announcement" value="{{ $settings['ticker_announcement'] ?? 'Special Offer: Get 15-min Career Orientation with Industrial Pharmacists • Batch Registration Open for Pharma Career Launchpad' }}"
                           class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                </div>
            </div>

            <!-- Program Info -->
            <div class="border-b border-[#00245A]/10 pb-6">
                <h3 class="text-base font-black text-[#00245A] mb-4">Flagship Program Branding</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Program Name</label>
                        <input type="text" name="program_name" value="{{ $settings['program_name'] ?? 'PHARMA CAREER LAUNCHPAD' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Program Subtitle</label>
                        <input type="text" name="program_description" value="{{ $settings['program_description'] ?? 'A Practical Career Preparation Program for Pharmacists' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>
            </div>

            <!-- Contact Channels -->
            <div class="border-b border-[#00245A]/10 pb-6">
                <h3 class="text-base font-black text-[#00245A] mb-4">Contact & Support Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Official Email</label>
                        <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? 'support@pharmacareercompass.com' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Helpline Phone</label>
                        <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '+880 1700-000000' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Office Address</label>
                        <input type="text" name="contact_address" value="{{ $settings['contact_address'] ?? 'Gulshan-1, Dhaka 1212, Bangladesh' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>
            </div>

            <!-- Social Links -->
            <div class="pb-2">
                <h3 class="text-base font-black text-[#00245A] mb-4">Social Media Channels</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">LinkedIn URL</label>
                        <input type="url" name="social_linkedin" value="{{ $settings['social_linkedin'] ?? 'https://linkedin.com/company/pharma-career-compass' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Facebook URL</label>
                        <input type="url" name="social_facebook" value="{{ $settings['social_facebook'] ?? 'https://facebook.com/pharmacareercompass' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">YouTube URL</label>
                        <input type="url" name="social_youtube" value="{{ $settings['social_youtube'] ?? 'https://youtube.com/@pharmacareercompass' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="px-8 py-3 rounded-lg bg-[#0085FF] text-white font-black text-xs uppercase tracking-wider border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] hover:bg-blue-600 active:translate-x-0.5 active:translate-y-0.5 transition-all">
                    Save Site Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
