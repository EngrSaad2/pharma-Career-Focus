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
                <h3 class="text-base font-black text-[#00245A] mb-4">Contact, Support & Admin Alert Channels</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Official Public Email</label>
                        <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? 'hello@pharmacareercompass.com' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Admin Alert Notification Emails (comma-separated)</label>
                        <input type="text" name="admin_notification_email" value="{{ $settings['admin_notification_email'] ?? 'engr.saad477@gmail.com, bashar3074@gmail.com, abashar.qo@acmeglobal.com' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#0085FF] bg-blue-50/40 rounded-lg text-sm font-semibold text-[#00245A]">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Helpline Phone</label>
                        <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '+880 1844 567890' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Office Address</label>
                        <input type="text" name="contact_address" value="{{ $settings['contact_address'] ?? 'Gulshan-1, Dhaka 1212, Bangladesh' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>
            </div>

            <!-- Seminar & Payment Management Configuration -->
            <div class="border-b border-[#00245A]/10 pb-6">
                <h3 class="text-base font-black text-[#00245A] mb-4">Seminar & Payment Gateway Configuration</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Primary Payment Method</label>
                        <input type="text" name="seminar_payment_method" value="{{ $settings['seminar_payment_method'] ?? 'bKash / Nagad / Bank Transfer' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">bKash / Nagad Official Number</label>
                        <input type="text" name="seminar_bkash_number" value="{{ $settings['seminar_bkash_number'] ?? '01722531335' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#0085FF] bg-blue-50/40 rounded-lg text-sm font-bold text-[#00245A]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Account Type / Channel</label>
                        <input type="text" name="seminar_bkash_type" value="{{ $settings['seminar_bkash_type'] ?? 'Personal (Send Money)' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>

                {{-- Bank Transfer Settings --}}
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 mb-4 space-y-3">
                    <span class="text-xs font-black uppercase text-[#00245A] tracking-wider block">Official Bank Account Information</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-600 mb-1">Bank Name</label>
                            <input type="text" name="seminar_bank_name" value="{{ $settings['seminar_bank_name'] ?? 'Dutch-Bangla Bank PLC (DBBL)' }}"
                                   class="w-full px-3 py-2 border border-slate-300 rounded-lg text-xs font-semibold">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-600 mb-1">Account Name</label>
                            <input type="text" name="seminar_bank_account_name" value="{{ $settings['seminar_bank_account_name'] ?? 'Md. Abul Bashar' }}"
                                   class="w-full px-3 py-2 border border-slate-300 rounded-lg text-xs font-semibold">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-600 mb-1">Account Number (A/C)</label>
                            <input type="text" name="seminar_bank_account_number" value="{{ $settings['seminar_bank_account_number'] ?? '1221030213784' }}"
                                   class="w-full px-3 py-2 border border-slate-300 rounded-lg text-xs font-mono font-bold text-[#00245A]">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-600 mb-1">Branch Name</label>
                            <input type="text" name="seminar_bank_branch" value="{{ $settings['seminar_bank_branch'] ?? 'DEPZ Branch' }}"
                                   class="w-full px-3 py-2 border border-slate-300 rounded-lg text-xs font-semibold">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Default Seminar Fee (BDT)</label>
                        <input type="number" step="0.01" name="seminar_default_fee" value="{{ $settings['seminar_default_fee'] ?? '1000.00' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm font-bold">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Default Participant Capacity Limit</label>
                        <input type="number" name="seminar_default_capacity" value="{{ $settings['seminar_default_capacity'] ?? '100' }}"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm font-bold">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Payment Instructions (Shown on public checkout)</label>
                    <textarea name="seminar_payment_instructions" rows="3"
                              class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-lg text-sm">{{ $settings['seminar_payment_instructions'] ?? "1. Send Money the applicable fee to our verified bKash number.\n2. Copy the 10-character Transaction ID (TrxID) received via SMS.\n3. Enter the TrxID below to confirm your seat." }}</textarea>
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
