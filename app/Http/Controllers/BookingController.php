<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\ConsultantAvailability;
use App\Models\ConsultationBooking;
use App\Models\Service;
use App\Services\AdminNotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        return redirect()->route('seminars.book');
    }

    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'consultant_id' => 'required|exists:consultants,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        $consultant = Consultant::findOrFail($request->consultant_id);
        $date = Carbon::parse($request->date);
        $dayOfWeek = $date->dayOfWeek; // 0 (Sun) to 6 (Sat)

        $availabilities = ConsultantAvailability::where('consultant_id', $consultant->id)
            ->where('day_of_week', $dayOfWeek)
            ->where('is_active', true)
            ->get();

        if ($availabilities->isEmpty()) {
            return response()->json([
                'available' => false,
                'message' => 'Consultant is not available on ' . $date->format('l') . 's. Please choose another date.',
                'slots' => []
            ]);
        }

        $existingBookings = ConsultationBooking::where('consultant_id', $consultant->id)
            ->where('booking_date', $date->toDateString())
            ->where('status', '!=', 'cancelled')
            ->pluck('start_time')
            ->map(fn($t) => substr($t, 0, 5))
            ->toArray();

        $slots = [];

        foreach ($availabilities as $avail) {
            $start = Carbon::parse($avail->start_time);
            $end = Carbon::parse($avail->end_time);
            $duration = $avail->slot_duration_minutes ?: 30;

            while ($start->copy()->addMinutes($duration)->lte($end)) {
                $slotTime = $start->format('H:i');
                $endTime = $start->copy()->addMinutes($duration)->format('H:i');

                // If date is today, only show future time slots
                $isPast = false;
                if ($date->isToday()) {
                    if ($start->format('H:i') <= Carbon::now()->format('H:i')) {
                        $isPast = true;
                    }
                }

                $isBooked = in_array($slotTime, $existingBookings);

                if (!$isPast && !$isBooked) {
                    $slots[] = [
                        'start' => $slotTime,
                        'end' => $endTime,
                        'display' => $start->format('h:i A') . ' - ' . $start->copy()->addMinutes($duration)->format('h:i A'),
                    ];
                }

                $start->addMinutes($duration);
            }
        }

        return response()->json([
            'available' => count($slots) > 0,
            'message' => count($slots) > 0 ? count($slots) . ' slots available' : 'All consultation slots are booked for this date.',
            'slots' => $slots
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'consultant_id' => 'required|exists:consultants,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|string',
            'client_name' => 'required|string|max:150',
            'client_email' => 'required|email|max:150',
            'client_phone' => 'required|string|max:50',
            'current_qualification' => 'nullable|string|max:200',
            'target_goal' => 'nullable|string|max:300',
            'notes' => 'nullable|string|max:1000',
        ]);

        $bookingDate = Carbon::parse($validated['booking_date']);
        $startTime = Carbon::parse($validated['start_time'])->format('H:i:s');
        
        $service = Service::findOrFail($validated['service_id']);
        $duration = $service->duration_minutes ?: 45;
        $endTime = Carbon::parse($startTime)->addMinutes($duration)->format('H:i:s');

        // Check for conflicting booking
        $conflict = ConsultationBooking::where('consultant_id', $validated['consultant_id'])
            ->where('booking_date', $bookingDate->toDateString())
            ->where('start_time', $startTime)
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($conflict) {
            return back()->withInput()->withErrors(['start_time' => 'This consultation time slot was just booked by another candidate. Please pick another available time slot.']);
        }

        $userId = Auth::id(); // nullable if guest
        $meetingCode = strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
        $meetingLink = "https://meet.jit.si/PharmaCareerCompass-" . $meetingCode;

        $booking = ConsultationBooking::create([
            'user_id' => $userId,
            'consultant_id' => $validated['consultant_id'],
            'service_id' => $validated['service_id'],
            'booking_date' => $bookingDate->toDateString(),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => 'confirmed',
            'client_name' => $validated['client_name'],
            'client_email' => $validated['client_email'],
            'client_phone' => $validated['client_phone'],
            'current_qualification' => $validated['current_qualification'] ?? null,
            'target_goal' => $validated['target_goal'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'meeting_link' => $meetingLink,
        ]);

        // Send email alert to admin
        AdminNotificationService::notifyNewBooking($booking);

        return redirect()->route('booking.confirmation', $booking->id)
            ->with('success', 'Your pharmaceutical consultation has been scheduled successfully!');
    }

    public function confirmation($id)
    {
        $booking = ConsultationBooking::with(['consultant', 'service'])->findOrFail($id);
        return view('pages.consultation.confirmation', compact('booking'));
    }
}
