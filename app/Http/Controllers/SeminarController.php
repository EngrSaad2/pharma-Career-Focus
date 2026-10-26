<?php

namespace App\Http\Controllers;

use App\Mail\SeminarRegistrationReceivedMail;
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

class SeminarController extends Controller
{
    /**
     * Display public seminar catalog with search and filters.
     */
    public function index(Request $request)
    {
        $query = Seminar::whereIn('status', ['published', 'registration_open', 'registration_closed', 'completed']);

        // Keyword Search
        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('topic', 'like', "%{$q}%")
                    ->orWhere('short_description', 'like', "%{$q}%")
                    ->orWhere('speaker_name', 'like', "%{$q}%");
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Participation Type Filter
        if ($request->filled('type')) {
            $type = $request->type;
            if ($type === 'online') {
                $query->whereIn('participation_type', ['online', 'both']);
            } elseif ($type === 'offline') {
                $query->whereIn('participation_type', ['offline', 'both']);
            }
        }

        $allSeminars = $query->orderBy('start_date', 'asc')->get();

        $today = Carbon::today();
        $upcomingSeminars = $allSeminars->filter(function ($s) use ($today) {
            return $s->start_date && $s->start_date->gte($today) && $s->status !== 'completed';
        });

        $pastSeminars = $allSeminars->filter(function ($s) use ($today) {
            return ($s->start_date && $s->start_date->lt($today)) || $s->status === 'completed';
        })->sortByDesc('start_date');

        // Distinct categories for filter dropdown
        $categories = Seminar::whereIn('status', ['published', 'registration_open', 'registration_closed', 'completed'])
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('pages.seminars.index', compact('upcomingSeminars', 'pastSeminars', 'categories'));
    }

    /**
     * Show single seminar details page.
     */
    public function show($slug)
    {
        $seminar = Seminar::where('slug', $slug)
            ->whereIn('status', ['published', 'registration_open', 'registration_closed', 'completed'])
            ->firstOrFail();

        $defaultPaymentMethod = SiteSetting::get('seminar_payment_method', 'bKash');
        $defaultBkashNumber = SiteSetting::get('seminar_bkash_number', '01722531335');
        $defaultBkashType = SiteSetting::get('seminar_bkash_type', 'Personal (Send Money)');

        // Related upcoming seminars
        $relatedSeminars = Seminar::whereIn('status', ['published', 'registration_open'])
            ->where('id', '!=', $seminar->id)
            ->latest('start_date')
            ->take(3)
            ->get();

        return view('pages.seminars.show', compact('seminar', 'defaultPaymentMethod', 'defaultBkashNumber', 'defaultBkashType', 'relatedSeminars'));
    }

    /**
     * Show dedicated seminar registration form.
     */
    public function registerForm($slug)
    {
        $seminar = Seminar::where('slug', $slug)
            ->whereIn('status', ['published', 'registration_open', 'registration_closed', 'completed'])
            ->firstOrFail();

        if ($seminar->status === 'cancelled') {
            return redirect()->route('seminars.show', $seminar->slug)
                ->with('error', 'This seminar has been cancelled.');
        }

        if ($seminar->isRegistrationClosed()) {
            return redirect()->route('seminars.show', $seminar->slug)
                ->with('error', 'Registration for this seminar is currently closed.');
        }

        $defaultPaymentMethod = SiteSetting::get('seminar_payment_method', 'bKash');
        $defaultBkashNumber = SiteSetting::get('seminar_bkash_number', '01722531335');
        $defaultBkashType = SiteSetting::get('seminar_bkash_type', 'Personal (Send Money)');
        $isWaitlist = $seminar->isFull();

        return view('pages.seminars.register', compact('seminar', 'defaultPaymentMethod', 'defaultBkashNumber', 'defaultBkashType', 'isWaitlist'));
    }

    /**
     * Handle seminar registration submission.
     */
    public function registerSubmit(Request $request, $slug)
    {
        $seminar = Seminar::where('slug', $slug)
            ->whereIn('status', ['published', 'registration_open', 'registration_closed', 'completed'])
            ->firstOrFail();

        // Spam honeypot
        if ($request->filled('website_url')) {
            return back()->with('error', 'Spam submission detected.');
        }

        if ($seminar->isRegistrationClosed()) {
            return back()->with('error', 'Registration deadline has passed or registration is closed.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:30',
            'organization' => 'nullable|string|max:150',
            'designation' => 'nullable|string|max:150',
            'participation_type' => 'required|in:online,offline',
            'transaction_id' => 'nullable|string|max:100',
            'payment_screenshot' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'terms_agreed' => 'required|accepted',
        ]);

        // Validate participation type against seminar availability
        if ($seminar->participation_type === 'online' && $validated['participation_type'] !== 'online') {
            return back()->withErrors(['participation_type' => 'This event is only available for Online participation.'])->withInput();
        }
        if ($seminar->participation_type === 'offline' && $validated['participation_type'] !== 'offline') {
            return back()->withErrors(['participation_type' => 'This event is only available for In-Person (Offline) participation.'])->withInput();
        }

        // Prevent duplicate registration for the same seminar with pending/confirmed status
        $existing = SeminarRegistration::where('seminar_id', $seminar->id)
            ->where('email', strtolower($validated['email']))
            ->whereIn('registration_status', ['confirmed', 'pending_verification'])
            ->first();

        if ($existing) {
            return redirect()->route('seminars.confirmation', $existing->registration_reference)
                ->with('info', 'You already have an active registration for this seminar with reference ' . $existing->registration_reference . '.');
        }

        // Handle payment receipt screenshot upload
        $screenshotPath = null;
        if ($request->hasFile('payment_screenshot')) {
            $file = $request->file('payment_screenshot');
            $uploadDir = public_path('uploads/receipts');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $filename = 'pay_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $screenshotPath = '/uploads/receipts/' . $filename;
        }

        // Generate unique registration reference SEM-YYYY-XXXXXX
        do {
            $reference = 'SEM-' . date('Y') . '-' . strtoupper(Str::random(6));
        } while (SeminarRegistration::where('registration_reference', $reference)->exists());

        // Determine initial statuses based on capacity and transaction ID
        $isFull = $seminar->isFull();
        $regStatus = $isFull ? 'waitlisted' : (empty($validated['transaction_id']) ? 'pending_payment' : 'pending_verification');
        $payStatus = 'pending';

        $registration = SeminarRegistration::create([
            'registration_reference' => $reference,
            'seminar_id' => $seminar->id,
            'name' => $validated['full_name'],
            'email' => strtolower($validated['email']),
            'phone' => $validated['phone'],
            'organization' => $validated['organization'] ?? null,
            'designation' => $validated['designation'] ?? null,
            'participation_type' => $validated['participation_type'],
            'amount_payable' => $seminar->registration_fee,
            'payment_method' => SiteSetting::get('seminar_payment_method', 'bKash'),
            'transaction_id' => $validated['transaction_id'] ? trim($validated['transaction_id']) : null,
            'payment_proof' => $screenshotPath,
            'payment_status' => $payStatus,
            'registration_status' => $regStatus,
        ]);

        // Send acknowledgement email
        try {
            Mail::to($registration->email)->send(new SeminarRegistrationReceivedMail($registration));

            SeminarEmailLog::create([
                'seminar_registration_id' => $registration->id,
                'seminar_id' => $seminar->id,
                'recipient_email' => $registration->email,
                'email_type' => 'registration_received',
                'subject' => 'Registration Received: ' . $seminar->title . ' [' . $registration->registration_reference . ']',
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Seminar registration email delivery failed: ' . $e->getMessage());
            SeminarEmailLog::create([
                'seminar_registration_id' => $registration->id,
                'seminar_id' => $seminar->id,
                'recipient_email' => $registration->email,
                'email_type' => 'registration_received',
                'subject' => 'Registration Received: ' . $seminar->title . ' [' . $registration->registration_reference . ']',
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
        }

        return redirect()->route('seminars.confirmation', $registration->registration_reference)
            ->with('success', 'Registration submitted successfully! Please check your email for payment confirmation details.');
    }

    /**
     * Display public registration confirmation and status checking page.
     */
    public function confirmation($reference)
    {
        $registration = SeminarRegistration::with('seminar')
            ->where('registration_reference', $reference)
            ->firstOrFail();

        $seminar = $registration->seminar;
        $defaultBkashNumber = SiteSetting::get('seminar_bkash_number', '01722531335');

        return view('pages.seminars.confirmation', compact('registration', 'seminar', 'defaultBkashNumber'));
    }

    /**
     * Lookup registration status by reference and phone/email.
     */
    public function statusLookup(Request $request)
    {
        $request->validate([
            'reference' => 'required|string',
            'identifier' => 'required|string',
        ]);

        $reference = trim($request->reference);
        $identifier = trim($request->identifier);

        $registration = SeminarRegistration::where('registration_reference', $reference)
            ->where(function ($q) use ($identifier) {
                $q->where('email', strtolower($identifier))
                    ->orWhere('phone', $identifier);
            })
            ->first();

        if (!$registration) {
            return back()->with('error', 'No registration found matching this Reference and Email / Phone number.')->withInput();
        }

        return redirect()->route('seminars.confirmation', $registration->registration_reference);
    }
}
