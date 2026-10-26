@extends('layouts.admin')

@section('title', 'Create Seminar Program | Admin Portal')

@section('admin_content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- Breadcrumb & Header --}}
    <div class="flex items-center justify-between">
        <div>
            <nav class="flex items-center gap-2 text-xs text-slate-400 mb-1">
                <a href="{{ route('admin.seminars.index') }}" class="hover:text-[#0085FF]">Seminars</a>
                <span>/</span>
                <span class="text-slate-700 font-bold">New Program</span>
            </nav>
            <h1 class="text-2xl font-black text-[#00245A]">Create Seminar Program</h1>
        </div>
        <a href="{{ route('admin.seminars.index') }}" class="px-3.5 py-2 rounded-lg border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50">
            ← Cancel
        </a>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs space-y-1">
            <strong class="block font-bold">Please fix the following validation issues:</strong>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.seminars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Section 1: Basic Information --}}
        <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs p-6 space-y-4">
            <h2 class="text-sm font-bold uppercase tracking-wider text-[#0085FF] border-b border-slate-100 pb-2">
                1. Program Details & Categorization
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Title --}}
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Seminar Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Industrial Quality Assurance & Sterile Validation Masterclass" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- URL Slug --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        URL Slug <span class="text-slate-400 font-normal">(Leave empty to auto-generate)</span>
                    </label>
                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="industrial-qa-sterile-validation-masterclass" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- Topic --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Topic / Specialization</label>
                    <input type="text" name="topic" value="{{ old('topic') }}" placeholder="e.g. Quality Assurance, QC HPLC, Regulatory Affairs" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- Category --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Category</label>
                    <input type="text" name="category" value="{{ old('category', 'Technical Training') }}" placeholder="e.g. Technical Training, Workshop, Executive Seminar" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- Event Status --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Event Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-[#0085FF]">
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Admin Only)</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Visible)</option>
                        <option value="registration_open" {{ old('status', 'registration_open') === 'registration_open' ? 'selected' : '' }}>Registration Open (Active)</option>
                        <option value="registration_closed" {{ old('status') === 'registration_closed' ? 'selected' : '' }}>Registration Closed</option>
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>

            {{-- Short Description --}}
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Short Description (Summary)</label>
                <textarea name="short_description" rows="2" placeholder="Brief 1-2 sentence overview shown on catalog cards..." class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">{{ old('short_description') }}</textarea>
            </div>

            {{-- Full Description --}}
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Full Description & Learning Outcomes</label>
                <textarea name="full_description" rows="6" placeholder="Comprehensive agenda, curriculum, key takeaways, who should attend..." class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">{{ old('full_description') }}</textarea>
            </div>
        </div>

        {{-- Section 2: Speaker / Trainer Information --}}
        <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs p-6 space-y-4">
            <h2 class="text-sm font-bold uppercase tracking-wider text-[#0085FF] border-b border-slate-100 pb-2">
                2. Speaker & Trainer Profile
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Speaker Name</label>
                    <input type="text" name="speaker_name" value="{{ old('speaker_name') }}" placeholder="e.g. Dr. Mohammad Rafiqul Islam" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Designation & Company</label>
                    <input type="text" name="speaker_designation" value="{{ old('speaker_designation') }}" placeholder="e.g. Head of Quality Assurance, Beximco Pharma" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Speaker Biography</label>
                    <textarea name="speaker_bio" rows="3" placeholder="Overview of speaker's background, pharma career, and achievements..." class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">{{ old('speaker_bio') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Speaker Profile Image</label>
                    <input type="file" name="speaker_avatar" accept="image/*" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-bold file:bg-[#0085FF] file:text-white">
                </div>
            </div>
        </div>

        {{-- Section 3: Schedule, Capacity & Pricing --}}
        <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs p-6 space-y-4">
            <h2 class="text-sm font-bold uppercase tracking-wider text-[#0085FF] border-b border-slate-100 pb-2">
                3. Date, Schedule, Capacity & Pricing
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                {{-- Event Date --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Seminar Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="event_date" value="{{ old('event_date') }}" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- Start Time --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Start Time <span class="text-red-500">*</span>
                    </label>
                    <input type="time" name="start_time" value="{{ old('start_time', '19:00') }}" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- End Time --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">End Time</label>
                    <input type="time" name="end_time" value="{{ old('end_time', '21:30') }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- Participation Type --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Format <span class="text-red-500">*</span>
                    </label>
                    <select name="participation_type" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-[#0085FF]">
                        <option value="online" {{ old('participation_type') === 'online' ? 'selected' : '' }}>🌐 Online Only</option>
                        <option value="offline" {{ old('participation_type') === 'offline' ? 'selected' : '' }}>📍 In-Person (Offline)</option>
                        <option value="both" {{ old('participation_type', 'both') === 'both' ? 'selected' : '' }}>🔄 Hybrid (Both Options)</option>
                    </select>
                </div>

                {{-- Registration Fee --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Registration Fee (BDT) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" name="registration_fee" value="{{ old('registration_fee', $defaultFee) }}" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-bold focus:ring-2 focus:ring-[#0085FF]">
                    <span class="text-[10px] text-slate-400">Default: ৳1,000</span>
                </div>

                {{-- Participant Capacity --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Max Capacity (Seats) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="max_participants" value="{{ old('max_participants', 100) }}" required min="1" max="5000" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-bold focus:ring-2 focus:ring-[#0085FF]">
                    <span class="text-[10px] text-slate-400">Default: 100 seats</span>
                </div>

                {{-- Registration Closes At --}}
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Registration Deadline</label>
                    <input type="datetime-local" name="registration_closes_at" value="{{ old('registration_closes_at') }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>
            </div>
        </div>

        {{-- Section 4: Venue & Online Meeting Logistics --}}
        <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs p-6 space-y-4">
            <h2 class="text-sm font-bold uppercase tracking-wider text-[#0085FF] border-b border-slate-100 pb-2">
                4. Venue & Online Meeting Access
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Venue Address --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Venue Address (For Offline Attendees)</label>
                    <textarea name="venue_address" rows="3" placeholder="e.g. Pharma Career Compass Training Auditorium, Level 4, Plot 12, Road 5, Dhanmondi, Dhaka 1205" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">{{ old('venue_address') }}</textarea>
                </div>

                {{-- Online Meeting URL --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Online Meeting URL (For Online Attendees)</label>
                    <input type="url" name="meeting_url" value="{{ old('meeting_url') }}" placeholder="https://meet.google.com/xxx-yyyy-zzz or Zoom URL" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF] mb-2">
                    <span class="text-[10px] text-slate-400 block mb-1">Only sent to verified participants.</span>
                </div>

                {{-- Joining Instructions --}}
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Attendance & Joining Instructions</label>
                    <textarea name="joining_instructions" rows="3" placeholder="Arrival times, check-in instructions, software requirements, microphone etiquette..." class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">{{ old('joining_instructions') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Section 5: Promotional Graphics, Facebook & Policies --}}
        <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs p-6 space-y-4">
            <h2 class="text-sm font-bold uppercase tracking-wider text-[#0085FF] border-b border-slate-100 pb-2">
                5. Graphics, Facebook URL & Policies
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Featured Image --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Featured Card Graphic</label>
                    <input type="file" name="featured_image" accept="image/*" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-bold file:bg-[#0085FF] file:text-white">
                </div>

                {{-- Banner Image --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Wide Hero Banner</label>
                    <input type="file" name="banner_image" accept="image/*" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-bold file:bg-[#0085FF] file:text-white">
                </div>

                {{-- Facebook URL --}}
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Facebook Event or Post URL</label>
                    <input type="url" name="facebook_url" value="{{ old('facebook_url') }}" placeholder="https://www.facebook.com/events/1234567890/" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                    <span class="text-[10px] text-slate-400">Displayed on the public seminar page for social updates & discussions.</span>
                </div>

                {{-- Terms & Conditions --}}
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Terms & Conditions</label>
                    <textarea name="terms_and_conditions" rows="3" placeholder="Registration policies, seat transfer rules, cancellation policy..." class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">{{ old('terms_and_conditions', "1. Registration fee is non-refundable within 48 hours of event start.\n2. Official certificate of participation will be issued to verified attendees.\n3. Recordings are for personal professional study and cannot be distributed.") }}</textarea>
                </div>
            </div>
        </div>

        {{-- Section 6: SEO Settings --}}
        <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs p-6 space-y-4">
            <h2 class="text-sm font-bold uppercase tracking-wider text-[#0085FF] border-b border-slate-100 pb-2">
                6. Search Engine Optimization (SEO)
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">SEO Meta Title</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title') }}" placeholder="Custom Google title tag..." class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">SEO Meta Description</label>
                    <input type="text" name="seo_meta_description" value="{{ old('seo_meta_description') }}" placeholder="Concise summary for search engine snippet..." class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>
            </div>
        </div>

        {{-- Form Submit Actions --}}
        <div class="flex items-center justify-end gap-3 pt-4">
            <a href="{{ route('admin.seminars.index') }}" class="px-5 py-2.5 rounded-lg border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-[#0085FF] hover:bg-[#0070d9] text-white text-xs font-bold shadow-xs transition">
                Create & Publish Seminar Program
            </button>
        </div>

    </form>
</div>
@endsection
