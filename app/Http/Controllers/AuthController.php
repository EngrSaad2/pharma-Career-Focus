<?php

namespace App\Http\Controllers;

use App\Models\CareerAssessment;
use App\Models\CareerPath;
use App\Models\CareerRoadmap;
use App\Models\RoadmapMilestone;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\AdminNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('dashboard'));
        }

        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|string|email|max:150|unique:users',
            'phone' => 'nullable|string|max:50',
            'password' => 'required|string|min:8|confirmed',
            'education_level' => 'nullable|string|max:100',
            'university' => 'nullable|string|max:150',
            'graduation_year' => 'nullable|integer|min:2000|max:2035',
            'target_department' => 'nullable|string|max:100',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'user',
            'is_active' => true,
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'education_level' => $validated['education_level'] ?? null,
            'university' => $validated['university'] ?? null,
            'graduation_year' => $validated['graduation_year'] ?? null,
            'target_department' => $validated['target_department'] ?? null,
            'current_status' => 'Candidate',
        ]);

        // Send email alert to admin
        AdminNotificationService::notifyNewUser($user);

        Auth::login($user);

        // Check if pending roadmap exists in session
        if (session()->has('pending_roadmap')) {
            $pending = session('pending_roadmap');
            session()->forget('pending_roadmap');

            $roadmap = CareerRoadmap::create([
                'user_id' => $user->id,
                'career_path_id' => $pending['career_path_id'],
                'target_role_title' => $pending['target_role_title'],
                'experience_level' => $pending['experience_level'],
                'target_timeline_months' => $pending['timeline_months'],
                'progress_percent' => 0,
                'is_active' => true,
            ]);

            $path = CareerPath::find($pending['career_path_id']);
            if ($path) {
                // Seed 8 blueprint milestones
                $blueprint = [
                    ['phase' => 'Phase 1: Foundation & Regulatory Standards', 'title' => 'Master cGMP Guidelines & Cleanroom Air Classifications', 'desc' => 'Study WHO Good Manufacturing Practices.', 'res' => 'cGMP Written Exam Modules'],
                    ['phase' => 'Phase 1: Foundation & Regulatory Standards', 'title' => 'Understand ALCOA+ Data Integrity Principles', 'desc' => 'Master documentation standards.', 'res' => 'FDA Data Integrity Guidance'],
                    ['phase' => 'Phase 2: Core Technical & Role Competencies', 'title' => 'Study ' . $path->title . ' SOPs and protocols', 'desc' => 'Review deviation and BMR structures.', 'res' => 'Pharma Career Compass SOP Masterclass'],
                    ['phase' => 'Phase 2: Core Technical & Role Competencies', 'title' => 'Laboratory & Equipment Troubleshooting', 'desc' => 'Understand failure modes in this role.', 'res' => 'Viva & Practical Exam Question Bank'],
                    ['phase' => 'Phase 3: Assessment & Written Exam Preparation', 'title' => 'Complete 5 Timed Mock Recruitment Tests', 'desc' => 'Score >= 80% on mock exams.', 'res' => 'Written Exam Practice Hub'],
                    ['phase' => 'Phase 3: Assessment & Written Exam Preparation', 'title' => 'Transform CV & LinkedIn for ' . $path->title, 'desc' => 'Highlight relevant instruments and thesis.', 'res' => 'CV and LinkedIn Review Service'],
                    ['phase' => 'Phase 4: Interview & Board Readiness', 'title' => 'Practise 20 Technical Viva Questions', 'desc' => 'Master oral articulation without hesitation.', 'res' => 'Viva Practice Hub & Model Answers'],
                    ['phase' => 'Phase 4: Interview & Board Readiness', 'title' => 'Complete a 1-on-1 Panel Mock Interview', 'desc' => 'Simulation with an industry veteran.', 'res' => '1-on-1 Mentorship & Coaching'],
                ];

                foreach ($blueprint as $idx => $b) {
                    RoadmapMilestone::create([
                        'roadmap_id' => $roadmap->id,
                        'phase_name' => $b['phase'],
                        'title' => $b['title'],
                        'description' => $b['desc'],
                        'resource_recommendation' => $b['res'],
                        'milestone_order' => $idx + 1,
                        'is_completed' => false,
                    ]);
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Welcome to Pharma Career Compass! Your account has been initialized.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }
}
