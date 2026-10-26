@extends('layouts.admin')

@section('title', 'Edit: ' . $seminar->title . ' | Admin Portal')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- Breadcrumb & Header --}}
    <div class="flex items-center justify-between">
        <div>
            <nav class="flex items-center gap-2 text-xs text-slate-400 mb-1">
                <a href="{{ route('admin.seminars.index') }}" class="hover:text-[#0085FF]">Seminars</a>
                <span>/</span>
                <span class="text-slate-700 font-bold">Edit Program</span>
            </nav>
            <h1 class="text-2xl font-black text-[#00245A]">Edit Seminar: {{ $seminar->title }}</h1>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('seminars.show', $seminar->slug) }}" target="_blank" class="px-3 py-2 rounded-lg border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 flex items-center gap-1">
                <span>View Live</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </a>
            <a href="{{ route('admin.seminars.index') }}" class="px-3.5 py-2 rounded-lg border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50">
                Back
            </a>
        </div>
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
    <form action="{{ route('admin.seminars.update', $seminar->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

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
                    <input type="text" name="title" value="{{ old('title', $seminar->title) }}" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- URL Slug --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        URL Slug <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="slug" value="{{ old('slug', $seminar->slug) }}" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- Topic --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Topic / Specialization</label>
                    <input type="text" name="topic" value="{{ old('topic', $seminar->topic) }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- Category --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Category</label>
                    <input type="text" name="category" value="{{ old('category', $seminar->category) }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- Event Status --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Event Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-[#0085FF]">
                        <option value="draft" {{ old('status', $seminar->status) === 'draft' ? 'selected' : '' }}>Draft (Admin Only)</option>
                        <option value="published" {{ old('status', $seminar->status) === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="registration_open" {{ old('status', $seminar->status) === 'registration_open' ? 'selected' : '' }}>Registration Open (Active)</option>
                        <option value="registration_closed" {{ old('status', $seminar->status) === 'registration_closed' ? 'selected' : '' }}>Registration Closed</option>
                        <option value="completed" {{ old('status', $seminar->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status', $seminar->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>

            {{-- Short Description --}}
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Short Description (Summary)</label>
                <textarea name="short_description" rows="2" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">{{ old('short_description', $seminar->short_description) }}</textarea>
            </div>

            {{-- Full Description --}}
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Full Description & Learning Outcomes</label>
                <textarea name="full_description" rows="6" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">{{ old('full_description', $seminar->full_description) }}</textarea>
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
                    <input type="text" name="speaker_name" value="{{ old('speaker_name', $seminar->speaker_name) }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Designation & Company</label>
                    <input type="text" name="speaker_designation" value="{{ old('speaker_designation', $seminar->speaker_designation) }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Speaker Biography</label>
                    <textarea name="speaker_bio" rows="3" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">{{ old('speaker_bio', $seminar->speaker_bio) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Speaker Profile Image</label>
                    @if($seminar->speaker_avatar)
                        <div class="flex items-center gap-2 mb-2">
                            <img src="{{ $seminar->speaker_avatar }}" alt="{{ $seminar->speaker_name }}" class="w-12 h-12 rounded-lg object-cover">
                            <span class="text-[10px] text-slate-400">Current avatar</span>
                        </div>
                    @endif
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
                    <input type="date" name="event_date" value="{{ old('event_date', $seminar->event_date ? $seminar->event_date->format('Y-m-d') : '') }}" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- Start Time --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Start Time <span class="text-red-500">*</span>
                    </label>
                    <input type="time" name="start_time" value="{{ old('start_time', $seminar->start_time ? substr($seminar->start_time, 0, 5) : '19:00') }}" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- End Time --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">End Time</label>
                    <input type="time" name="end_time" value="{{ old('end_time', $seminar->end_time ? substr($seminar->end_time, 0, 5) : '21:30') }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- Participation Type --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Format <span class="text-red-500">*</span>
                    </label>
                    <select name="participation_type" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-[#0085FF]">
                        <option value="online" {{ old('participation_type', $seminar->participation_type) === 'online' ? 'selected' : '' }}>🌐 Online Only</option>
                        <option value="offline" {{ old('participation_type', $seminar->participation_type) === 'offline' ? 'selected' : '' }}>📍 In-Person (Offline)</option>
                        <option value="both" {{ old('participation_type', $seminar->participation_type) === 'both' ? 'selected' : '' }}>🔄 Hybrid (Both Options)</option>
                    </select>
                </div>

                {{-- Registration Fee --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Registration Fee (BDT) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" name="registration_fee" value="{{ old('registration_fee', $seminar->registration_fee) }}" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-bold focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- Participant Capacity --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Max Capacity (Seats) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="max_participants" value="{{ old('max_participants', $seminar->max_participants) }}" required min="1" max="5000" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-bold focus:ring-2 focus:ring-[#0085FF]">
                    <span class="text-[10px] text-slate-400">{{ $seminar->confirmedRegistrations()->count() }} currently confirmed</span>
                </div>

                {{-- Registration Closes At --}}
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Registration Deadline</label>
                    <input type="datetime-local" name="registration_closes_at" value="{{ old('registration_closes_at', $seminar->registration_closes_at ? $seminar->registration_closes_at->format('Y-m-d\TH:i') : '') }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
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
                    <textarea name="venue_address" rows="3" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">{{ old('venue_address', $seminar->venue_address) }}</textarea>
                </div>

                {{-- Online Meeting URL --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Online Meeting URL (For Online Attendees)</label>
                    <input type="url" name="meeting_url" value="{{ old('meeting_url', $seminar->meeting_url) }}" placeholder="https://meet.google.com/xxx-yyyy-zzz" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF] mb-2">
                    <span class="text-[10px] text-slate-400 block mb-1">Only sent to verified participants in their confirmation pass.</span>
                </div>

                {{-- Joining Instructions --}}
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Attendance & Joining Instructions</label>
                    <textarea name="joining_instructions" rows="3" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">{{ old('joining_instructions', $seminar->joining_instructions) }}</textarea>
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
                    @if($seminar->featured_image)
                        <div class="flex items-center gap-2 mb-2">
                            <img src="{{ $seminar->featured_image }}" alt="Featured" class="w-16 h-10 rounded object-cover">
                            <span class="text-[10px] text-slate-400">Current</span>
                        </div>
                    @endif
                    <input type="file" name="featured_image" accept="image/*" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-bold file:bg-[#0085FF] file:text-white">
                </div>

                {{-- Banner Image --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Wide Hero Banner</label>
                    @if($seminar->banner_image)
                        <div class="flex items-center gap-2 mb-2">
                            <img src="{{ $seminar->banner_image }}" alt="Banner" class="w-20 h-10 rounded object-cover">
                            <span class="text-[10px] text-slate-400">Current</span>
                        </div>
                    @endif
                    <input type="file" name="banner_image" accept="image/*" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-bold file:bg-[#0085FF] file:text-white">
                </div>

                {{-- Facebook URL --}}
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Facebook Event or Post URL</label>
                    <input type="url" name="facebook_url" value="{{ old('facebook_url', $seminar->facebook_url) }}" placeholder="https://www.facebook.com/events/1234567890/" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                {{-- Terms & Conditions --}}
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Terms & Conditions</label>
                    <textarea name="terms_and_conditions" rows="3" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">{{ old('terms_and_conditions', $seminar->terms_and_conditions) }}</textarea>
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
                    <input type="text" name="seo_title" value="{{ old('seo_title', $seminar->seo_title) }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">SEO Meta Description</label>
                    <input type="text" name="seo_meta_description" value="{{ old('seo_meta_description', $seminar->seo_meta_description) }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-[#0085FF]">
                </div>
            </div>
        </div>

        {{-- Submit Buttons --}}
        <div class="flex items-center justify-end gap-3 pt-4">
            <a href="{{ route('admin.seminars.index') }}" class="px-5 py-2.5 rounded-lg border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-[#0085FF] hover:bg-[#0070d9] text-white text-xs font-bold shadow-xs transition">
                Save & Update Program
            </button>
        </div>

    </form>
</div>
@endsection
