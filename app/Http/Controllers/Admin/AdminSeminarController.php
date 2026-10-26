<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SeminarBroadcastUpdateMail;
use App\Mail\SeminarPaymentRejectedMail;
use App\Mail\SeminarPaymentVerifiedMail;
use App\Models\Seminar;
use App\Models\SeminarEmailLog;
use App\Models\SeminarRegistration;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminSeminarController extends Controller
{
    /**
     * Seminar Dashboard & Listing.
     */
    public function index(Request $request)
    {
        $today = Carbon::today();

        // 1. Core Metrics
        $totalSeminars = Seminar::count();
        $upcomingSeminars = Seminar::where('start_date', '>=', $today)->where('status', '!=', 'completed')->count();
        $publishedSeminars = Seminar::whereIn('status', ['published', 'registration_open'])->count();
        $completedSeminars = Seminar::where('status', 'completed')->orWhere('start_date', '<', $today)->count();

        $totalRegistrations = SeminarRegistration::count();
        $pendingVerifications = SeminarRegistration::where('payment_status', 'pending')
            ->whereNotNull('transaction_id')
            ->count();
        $verifiedPaymentsCount = SeminarRegistration::where('payment_status', 'verified')->count();
        $rejectedPaymentsCount = SeminarRegistration::where('payment_status', 'rejected')->count();

        // Expected vs Verified Collected Revenue
        $expectedRevenue = SeminarRegistration::whereNotIn('registration_status', ['cancelled'])
            ->sum('amount_payable');
        $collectedRevenue = SeminarRegistration::where('payment_status', 'verified')
            ->sum(DB::raw('COALESCE(verified_amount, amount_payable)'));

        $failedEmailLogsCount = SeminarEmailLog::where('status', 'failed')->count();

        // 2. Seminars query with filters
        $seminarsQuery = Seminar::withCount([
            'registrations as total_regs',
            'confirmedRegistrations as confirmed_regs',
            'pendingRegistrations as pending_regs',
            'waitlistRegistrations as waitlist_regs',
        ]);

        if ($request->filled('q')) {
            $q = trim($request->q);
            $seminarsQuery->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('topic', 'like', "%{$q}%")
                    ->orWhere('speaker_name', 'like', "%{$q}%");
            });
        }

        if ($request->filled('status')) {
            $seminarsQuery->where('status', $request->status);
        }

        $seminars = $seminarsQuery->orderBy('start_date', 'desc')->paginate(12)->withQueryString();

        $recentRegistrations = SeminarRegistration::with('seminar')
            ->latest()
            ->take(8)
            ->get();

        return view('admin.seminars.index', compact(
            'seminars',
            'totalSeminars',
            'upcomingSeminars',
            'publishedSeminars',
            'completedSeminars',
            'totalRegistrations',
            'pendingVerifications',
            'verifiedPaymentsCount',
            'rejectedPaymentsCount',
            'expectedRevenue',
            'collectedRevenue',
            'failedEmailLogsCount',
            'recentRegistrations'
        ));
    }

    /**
     * Show create seminar form.
     */
    public function create()
    {
        $defaultFee = SiteSetting::get('seminar_default_fee', 1000.00);
        $defaultPaymentMethod = SiteSetting::get('seminar_payment_method', 'bKash');
        $defaultBkashNumber = SiteSetting::get('seminar_bkash_number', '01722531335');

        return view('admin.seminars.create', compact('defaultFee', 'defaultPaymentMethod', 'defaultBkashNumber'));
    }

    /**
     * Store new seminar.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:seminars,slug',
            'topic' => 'nullable|string|max:150',
            'category' => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:500',
            'full_description' => 'nullable|string',
            'speaker_name' => 'nullable|string|max:150',
            'speaker_designation' => 'nullable|string|max:150',
            'speaker_bio' => 'nullable|string',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'registration_opens_at' => 'nullable|date',
            'registration_closes_at' => 'nullable|date',
            'participation_type' => 'required|in:online,offline,both',
            'registration_fee' => 'required|numeric|min:0',
            'max_participants' => 'required|integer|min:1|max:5000',
            'venue_address' => 'nullable|string|max:500',
            'meeting_url' => 'nullable|url|max:500',
            'joining_instructions' => 'nullable|string',
            'terms_and_conditions' => 'nullable|string',
            'payment_instructions' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:500',
            'status' => 'required|in:draft,published,registration_open,registration_closed,completed,cancelled',
            'seo_title' => 'nullable|string|max:255',
            'seo_meta_description' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'speaker_avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Auto-generate slug if blank
        $slug = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Seminar::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }
        $validated['slug'] = $slug;

        // Image uploads
        $uploadDir = public_path('uploads/seminars');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $fname = 'feat_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fname);
            $validated['featured_image'] = '/uploads/seminars/' . $fname;
        }

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $fname = 'banner_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fname);
            $validated['banner_image'] = '/uploads/seminars/' . $fname;
        }

        if ($request->hasFile('speaker_avatar')) {
            $file = $request->file('speaker_avatar');
            $fname = 'speaker_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fname);
            $validated['speaker_avatar'] = '/uploads/seminars/' . $fname;
        }

        // Map form attributes to database columns
        $data = [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'topic' => $validated['topic'] ?? null,
            'category' => $validated['category'] ?? 'General',
            'short_description' => $validated['short_description'] ?? null,
            'full_description' => $validated['full_description'] ?? ($validated['short_description'] ?? $validated['title']),
            'speaker_name' => $validated['speaker_name'] ?? 'Senior Mentor',
            'speaker_designation' => $validated['speaker_designation'] ?? 'Pharmaceutical Consultant',
            'speaker_bio' => $validated['speaker_bio'] ?? null,
            'speaker_avatar' => $validated['speaker_avatar'] ?? null,
            'featured_image' => $validated['featured_image'] ?? null,
            'banner_image' => $validated['banner_image'] ?? null,
            'start_date' => $validated['event_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'] ?? '21:30:00',
            'registration_opens_at' => $validated['registration_opens_at'] ?? null,
            'registration_closes_at' => $validated['registration_closes_at'] ?? null,
            'participation_type' => $validated['participation_type'],
            'registration_fee' => $validated['registration_fee'],
            'max_capacity' => $validated['max_participants'],
            'venue_address' => $validated['venue_address'] ?? null,
            'online_meeting_url' => $validated['meeting_url'] ?? null,
            'online_joining_instructions' => $validated['joining_instructions'] ?? null,
            'terms_conditions' => $validated['terms_and_conditions'] ?? null,
            'payment_instructions' => $validated['payment_instructions'] ?? null,
            'facebook_url' => $validated['facebook_url'] ?? null,
            'status' => $validated['status'],
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_meta_description'] ?? null,
        ];

        $seminar = Seminar::create($data);

        return redirect()->route('admin.seminars.index')
            ->with('success', "Seminar '{$seminar->title}' created successfully.");
    }

    /**
     * Show edit seminar form.
     */
    public function edit($id)
    {
        $seminar = Seminar::findOrFail($id);
        return view('admin.seminars.edit', compact('seminar'));
    }

    /**
     * Update existing seminar.
     */
    public function update(Request $request, $id)
    {
        $seminar = Seminar::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:seminars,slug,' . $seminar->id,
            'topic' => 'nullable|string|max:150',
            'category' => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:500',
            'full_description' => 'nullable|string',
            'speaker_name' => 'nullable|string|max:150',
            'speaker_designation' => 'nullable|string|max:150',
            'speaker_bio' => 'nullable|string',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'registration_opens_at' => 'nullable|date',
            'registration_closes_at' => 'nullable|date',
            'participation_type' => 'required|in:online,offline,both',
            'registration_fee' => 'required|numeric|min:0',
            'max_participants' => 'required|integer|min:1|max:5000',
            'venue_address' => 'nullable|string|max:500',
            'meeting_url' => 'nullable|url|max:500',
            'joining_instructions' => 'nullable|string',
            'terms_and_conditions' => 'nullable|string',
            'payment_instructions' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:500',
            'status' => 'required|in:draft,published,registration_open,registration_closed,completed,cancelled',
            'seo_title' => 'nullable|string|max:255',
            'seo_meta_description' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'speaker_avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['slug']);

        $uploadDir = public_path('uploads/seminars');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $fname = 'feat_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fname);
            $validated['featured_image'] = '/uploads/seminars/' . $fname;
        }

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $fname = 'banner_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fname);
            $validated['banner_image'] = '/uploads/seminars/' . $fname;
        }

        if ($request->hasFile('speaker_avatar')) {
            $file = $request->file('speaker_avatar');
            $fname = 'speaker_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fname);
            $validated['speaker_avatar'] = '/uploads/seminars/' . $fname;
        }

        $data = [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'topic' => $validated['topic'] ?? null,
            'category' => $validated['category'] ?? 'General',
            'short_description' => $validated['short_description'] ?? null,
            'full_description' => $validated['full_description'] ?? $seminar->full_description,
            'speaker_name' => $validated['speaker_name'] ?? $seminar->speaker_name,
            'speaker_designation' => $validated['speaker_designation'] ?? $seminar->speaker_designation,
            'speaker_bio' => $validated['speaker_bio'] ?? $seminar->speaker_bio,
            'start_date' => $validated['event_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'] ?? $seminar->end_time,
            'registration_opens_at' => $validated['registration_opens_at'] ?? null,
            'registration_closes_at' => $validated['registration_closes_at'] ?? null,
            'participation_type' => $validated['participation_type'],
            'registration_fee' => $validated['registration_fee'],
            'max_capacity' => $validated['max_participants'],
            'venue_address' => $validated['venue_address'] ?? null,
            'online_meeting_url' => $validated['meeting_url'] ?? null,
            'online_joining_instructions' => $validated['joining_instructions'] ?? null,
            'terms_conditions' => $validated['terms_and_conditions'] ?? null,
            'payment_instructions' => $validated['payment_instructions'] ?? null,
            'facebook_url' => $validated['facebook_url'] ?? null,
            'status' => $validated['status'],
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_meta_description'] ?? null,
        ];

        if (isset($validated['featured_image'])) $data['featured_image'] = $validated['featured_image'];
        if (isset($validated['banner_image'])) $data['banner_image'] = $validated['banner_image'];
        if (isset($validated['speaker_avatar'])) $data['speaker_avatar'] = $validated['speaker_avatar'];

        $seminar->update($data);

        return redirect()->route('admin.seminars.index')
            ->with('success', "Seminar '{$seminar->title}' updated successfully.");
    }

    /**
     * Delete a seminar.
     */
    public function destroy($id)
    {
        $seminar = Seminar::findOrFail($id);
        $title = $seminar->title;
        $seminar->delete();

        return redirect()->route('admin.seminars.index')
            ->with('success', "Seminar '{$title}' removed.");
    }

    /**
     * Registrations & Payment verification list.
     */
    public function registrations(Request $request)
    {
        $query = SeminarRegistration::with(['seminar', 'verifier']);

        if ($request->filled('seminar_id')) {
            $query->where('seminar_id', $request->seminar_id);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('registration_status')) {
            $query->where('registration_status', $request->registration_status);
        }

        if ($request->filled('type')) {
            $query->where('participation_type', $request->type);
        }

        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('registration_reference', 'like', "%{$q}%")
                    ->orWhere('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhere('transaction_id', 'like', "%{$q}%");
            });
        }

        $registrations = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();
        $seminars = Seminar::orderBy('title')->get();

        return view('admin.seminars.registrations', compact('registrations', 'seminars'));
    }

    /**
     * Verify payment and confirm registration.
     */
    public function verifyPayment(Request $request, $id)
    {
        $request->validate([
            'verified_amount' => 'nullable|numeric|min:0',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        return DB::transaction(function () use ($request, $id) {
            $registration = SeminarRegistration::lockForUpdate()->findOrFail($id);
            $seminar = Seminar::lockForUpdate()->findOrFail($registration->seminar_id);

            // Check capacity limit
            $confirmedCount = SeminarRegistration::where('seminar_id', $seminar->id)
                ->where('registration_status', 'confirmed')
                ->where('id', '!=', $registration->id)
                ->count();

            if ($confirmedCount >= $seminar->max_capacity) {
                return back()->with('error', "Cannot confirm: Seminar has reached maximum capacity ({$seminar->max_capacity} seats).");
            }

            $alreadyVerified = ($registration->payment_status === 'verified');
            $amount = $request->filled('verified_amount') ? $request->verified_amount : $registration->amount_payable;

            $registration->update([
                'payment_status' => 'verified',
                'registration_status' => 'confirmed',
                'verified_amount' => $amount,
                'verified_by_user_id' => auth()->id(),
                'verified_at' => now(),
                'admin_notes' => $request->admin_notes ?: $registration->admin_notes,
            ]);

            // Send confirmation email only if not sent previously
            if (!$alreadyVerified || $registration->confirmation_sent_count == 0) {
                try {
                    Mail::to($registration->email)->send(new SeminarPaymentVerifiedMail($registration));

                    $registration->increment('confirmation_sent_count');
                    $registration->update(['confirmation_sent_at' => now()]);

                    SeminarEmailLog::create([
                        'seminar_registration_id' => $registration->id,
                        'seminar_id' => $seminar->id,
                        'recipient_email' => $registration->email,
                        'email_type' => 'payment_verified',
                        'subject' => 'Registration Confirmed: ' . $seminar->title . ' [' . $registration->registration_reference . ']',
                        'status' => 'sent',
                        'sent_at' => now(),
                    ]);
                } catch (\Throwable $e) {
                    Log::error('Verification email send failure: ' . $e->getMessage());
                    SeminarEmailLog::create([
                        'seminar_registration_id' => $registration->id,
                        'seminar_id' => $seminar->id,
                        'recipient_email' => $registration->email,
                        'email_type' => 'payment_verified',
                        'subject' => 'Registration Confirmed: ' . $seminar->title . ' [' . $registration->registration_reference . ']',
                        'status' => 'failed',
                        'error_message' => $e->getMessage(),
                    ]);
                }
            }

            return back()->with('success', "Payment verified and seat confirmed for {$registration->name} ({$registration->registration_reference}).");
        });
    }

    /**
     * Reject payment with reason.
     */
    public function rejectPayment(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $registration = SeminarRegistration::findOrFail($id);
        $seminar = $registration->seminar;

        $registration->update([
            'payment_status' => 'rejected',
            'registration_status' => 'pending_payment',
            'rejection_reason' => $request->rejection_reason,
            'verified_by_user_id' => auth()->id(),
            'admin_notes' => $request->admin_notes ?: $registration->admin_notes,
        ]);

        // Send payment rejected notification
        try {
            Mail::to($registration->email)->send(new SeminarPaymentRejectedMail($registration, $request->rejection_reason));

            SeminarEmailLog::create([
                'seminar_registration_id' => $registration->id,
                'seminar_id' => $seminar->id,
                'recipient_email' => $registration->email,
                'email_type' => 'payment_rejected',
                'subject' => 'Payment Verification Update - ' . $seminar->title,
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Payment rejection email failed: ' . $e->getMessage());
        }

        return back()->with('success', "Payment for {$registration->registration_reference} marked as rejected.");
    }

    /**
     * Resend verification / confirmation email manually.
     */
    public function resendConfirmation($id)
    {
        $registration = SeminarRegistration::with('seminar')->findOrFail($id);

        try {
            if ($registration->payment_status === 'verified') {
                Mail::to($registration->email)->send(new SeminarPaymentVerifiedMail($registration));
                $emailType = 'payment_verified_resend';
            } else {
                Mail::to($registration->email)->send(new \App\Mail\SeminarRegistrationReceivedMail($registration));
                $emailType = 'registration_received_resend';
            }

            $registration->increment('confirmation_sent_count');
            $registration->update(['confirmation_sent_at' => now()]);

            SeminarEmailLog::create([
                'seminar_registration_id' => $registration->id,
                'seminar_id' => $registration->seminar_id,
                'recipient_email' => $registration->email,
                'email_type' => $emailType,
                'subject' => 'Resent: ' . $registration->seminar->title . ' [' . $registration->registration_reference . ']',
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            return back()->with('success', "Confirmation email resent to {$registration->email}.");
        } catch (\Throwable $e) {
            return back()->with('error', "Email dispatch failed: " . $e->getMessage());
        }
    }

    /**
     * Broadcast schedule or venue change / message to all confirmed attendees.
     */
    public function broadcastUpdate(Request $request, $seminarId)
    {
        $request->validate([
            'subject' => 'required|string|max:200',
            'message' => 'required|string',
        ]);

        $seminar = Seminar::findOrFail($seminarId);
        $confirmedAttendees = SeminarRegistration::where('seminar_id', $seminar->id)
            ->where('registration_status', 'confirmed')
            ->get();

        if ($confirmedAttendees->isEmpty()) {
            return back()->with('info', "No confirmed participants found for this seminar.");
        }

        $successCount = 0;
        foreach ($confirmedAttendees as $reg) {
            try {
                Mail::to($reg->email)->send(new SeminarBroadcastUpdateMail(
                    $seminar,
                    $reg,
                    $request->subject,
                    $request->message
                ));

                SeminarEmailLog::create([
                    'seminar_registration_id' => $reg->id,
                    'seminar_id' => $seminar->id,
                    'recipient_email' => $reg->email,
                    'email_type' => 'broadcast_update',
                    'subject' => $request->subject . ' - ' . $seminar->title,
                    'status' => 'sent',
                    'sent_at' => now(),
                ]);
                $successCount++;
            } catch (\Throwable $e) {
                Log::error("Broadcast email failed for {$reg->email}: " . $e->getMessage());
            }
        }

        return back()->with('success', "Broadcast update sent successfully to {$successCount} confirmed participants.");
    }

    /**
     * Export registrations as CSV for attendance check-in and finance audit.
     */
    public function exportCsv(Request $request)
    {
        $query = SeminarRegistration::with(['seminar', 'verifier']);

        if ($request->filled('seminar_id')) {
            $query->where('seminar_id', $request->seminar_id);
        }
        if ($request->filled('registration_status')) {
            $query->where('registration_status', $request->registration_status);
        }
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $registrations = $query->orderBy('created_at', 'desc')->get();

        $filename = 'seminar_registrations_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($registrations) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($file, [
                'Reference',
                'Seminar Title',
                'Participant Name',
                'Email',
                'Phone',
                'Organization',
                'Designation',
                'Participation Mode',
                'Fee (BDT)',
                'Transaction ID',
                'Payment Status',
                'Registration Status',
                'Verified Amount',
                'Verified At',
                'Registered At',
            ]);

            foreach ($registrations as $r) {
                fputcsv($file, [
                    $r->registration_reference,
                    $r->seminar->title ?? 'N/A',
                    $r->name,
                    $r->email,
                    $r->phone,
                    $r->organization ?? '',
                    $r->designation ?? '',
                    strtoupper($r->participation_type),
                    $r->amount_payable,
                    $r->transaction_id ?? '',
                    ucfirst($r->payment_status),
                    ucfirst($r->registration_status),
                    $r->verified_amount ?? 0,
                    $r->verified_at ? $r->verified_at->toDateTimeString() : '',
                    $r->created_at ? $r->created_at->toDateTimeString() : '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
