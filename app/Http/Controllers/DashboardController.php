<?php

namespace App\Http\Controllers;

use App\Models\CareerAssessment;
use App\Models\CareerRoadmap;
use App\Models\ConsultationBooking;
use App\Models\ExamAttempt;
use App\Models\UserInterviewProgress;
use App\Models\UserProfile;
use App\Models\UserVivaProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $activeRoadmap = CareerRoadmap::with('milestones')
            ->where('user_id', $user->id)
            ->where('is_active', true)
            ->latest()
            ->first();

        $latestAssessment = CareerAssessment::where('user_id', $user->id)
            ->latest()
            ->first();

        $examAttempts = ExamAttempt::with('category')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $upcomingBookings = ConsultationBooking::with(['consultant', 'service'])
            ->where('user_id', $user->id)
            ->where('booking_date', '>=', now()->toDateString())
            ->where('status', '!=', 'cancelled')
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->take(3)
            ->get();

        $totalExams = ExamAttempt::where('user_id', $user->id)->count();
        $avgScore = $totalExams > 0 ? round(ExamAttempt::where('user_id', $user->id)->avg('score_percentage'), 1) : 0;
        $practisedVivaCount = UserVivaProgress::where('user_id', $user->id)->where('is_practised', true)->count();

        $profile = $user->profile;

        $roadmapProgress = 0;
        if ($activeRoadmap && $activeRoadmap->milestones->count() > 0) {
            $totalM = $activeRoadmap->milestones->count();
            $compM = $activeRoadmap->milestones->where('is_completed', true)->count();
            $roadmapProgress = round(($compM / $totalM) * 100);
        }

        $recentAttempts = $examAttempts;

        $stats = [
            'exam_attempts_count' => $totalExams,
            'average_score' => $avgScore,
            'viva_practised_count' => $practisedVivaCount,
            'bookings_count' => ConsultationBooking::where('user_id', $user->id)->count(),
        ];

        return view('pages.dashboard.index', compact(
            'user',
            'profile',
            'activeRoadmap',
            'roadmapProgress',
            'latestAssessment',
            'recentAttempts',
            'upcomingBookings',
            'stats'
        ));
    }

    public function assessment()
    {
        $user = Auth::user();
        $assessments = CareerAssessment::where('user_id', $user->id)->latest()->get();
        $latestAssessment = $assessments->first();

        return view('pages.dashboard.assessment', compact('assessments', 'latestAssessment'));
    }

    public function roadmap()
    {
        $user = Auth::user();
        $activeRoadmap = CareerRoadmap::with('milestones')
            ->where('user_id', $user->id)
            ->where('is_active', true)
            ->latest()
            ->first();

        return view('pages.dashboard.roadmap', compact('activeRoadmap'));
    }

    public function exams()
    {
        $user = Auth::user();
        $attempts = ExamAttempt::with('category')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        $totalAttempts = ExamAttempt::where('user_id', $user->id)->count();
        $averageScore = $totalAttempts > 0 ? ExamAttempt::where('user_id', $user->id)->avg('score_percentage') : 0;

        return view('pages.dashboard.exams', compact('attempts', 'totalAttempts', 'averageScore'));
    }

    public function viva()
    {
        $user = Auth::user();
        $practised = UserVivaProgress::with('vivaQuestion')
            ->where('user_id', $user->id)
            ->where('is_practised', true)
            ->latest()
            ->get();

        $bookmarked = UserVivaProgress::with('vivaQuestion')
            ->where('user_id', $user->id)
            ->where('is_bookmarked', true)
            ->latest()
            ->get();

        return view('pages.dashboard.viva', compact('practised', 'bookmarked'));
    }

    public function bookings()
    {
        $user = Auth::user();
        $bookings = ConsultationBooking::with(['consultant', 'service'])
            ->where('user_id', $user->id)
            ->orderBy('booking_date', 'desc')
            ->paginate(10);

        return view('pages.dashboard.bookings', compact('bookings'));
    }

    public function cancelBooking($id)
    {
        $booking = ConsultationBooking::where('user_id', Auth::id())->findOrFail($id);

        if ($booking->status === 'completed') {
            return back()->with('error', 'Cannot cancel a completed consultation.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Your consultation session has been cancelled.');
    }

    public function profile()
    {
        $user = Auth::user()->load('profile');
        $profile = $user->profile;
        return view('pages.dashboard.profile', compact('user', 'profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:50',
            'headline' => 'nullable|string|max:200',
            'bio' => 'nullable|string|max:1000',
            'education_level' => 'nullable|string|max:100',
            'university' => 'nullable|string|max:150',
            'graduation_year' => 'nullable|integer|min:1990|max:2035',
            'target_department' => 'nullable|string|max:100',
            'target_role' => 'nullable|string|max:100',
            'years_experience' => 'nullable|numeric|min:0|max:40',
            'linkedin_url' => 'nullable|url|max:255',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? $user->phone,
            'headline' => $validated['headline'] ?? $user->headline,
            'bio' => $validated['bio'] ?? $user->bio,
        ]);

        if (!empty($validated['new_password'])) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Current password does not match.']);
            }
            $user->update(['password' => Hash::make($validated['new_password'])]);
        }

        UserProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'education_level' => $validated['education_level'] ?? null,
                'university' => $validated['university'] ?? null,
                'graduation_year' => $validated['graduation_year'] ?? null,
                'target_department' => $validated['target_department'] ?? null,
                'target_role' => $validated['target_role'] ?? null,
                'years_experience' => $validated['years_experience'] ?? 0,
                'linkedin_url' => $validated['linkedin_url'] ?? null,
            ]
        );

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        Auth::user()->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Your password has been updated successfully.');
    }
}
