<?php

namespace App\Http\Controllers;

use App\Models\CareerPath;
use App\Models\CareerRoadmap;
use App\Models\RoadmapMilestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoadmapController extends Controller
{
    public function index(Request $request)
    {
        $careerPaths = CareerPath::where('is_active', true)->orderBy('title')->get();
        
        $userRoadmap = null;
        if (Auth::check()) {
            $userRoadmap = CareerRoadmap::with('milestones')
                ->where('user_id', Auth::id())
                ->where('is_active', true)
                ->latest()
                ->first();
        }

        return view('pages.roadmap.index', compact('careerPaths', 'userRoadmap'));
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'career_path_id' => 'required|exists:career_paths,id',
            'experience_level' => 'required|string',
            'timeline_months' => 'nullable|integer|min:1|max:24',
        ]);

        $path = CareerPath::findOrFail($validated['career_path_id']);
        $exp = $validated['experience_level'];
        $months = $validated['timeline_months'] ?: 6;

        if (!Auth::check()) {
            session([
                'pending_roadmap' => [
                    'career_path_id' => $path->id,
                    'target_role_title' => $path->title,
                    'experience_level' => $exp,
                    'timeline_months' => $months,
                ]
            ]);
            return redirect()->route('register')->with('info', 'Please create a free account or login to save and track your interactive career roadmap milestones.');
        }

        // Deactivate previous active roadmaps
        CareerRoadmap::where('user_id', Auth::id())->update(['is_active' => false]);

        $roadmap = CareerRoadmap::create([
            'user_id' => Auth::id(),
            'career_path_id' => $path->id,
            'target_role_title' => $path->title,
            'experience_level' => $exp,
            'target_timeline_months' => $months,
            'progress_percent' => 0,
            'is_active' => true,
        ]);

        // Generate tailored milestone items based on role
        $milestones = $this->getMilestoneBlueprint($path->slug, $path->title);

        foreach ($milestones as $index => $m) {
            RoadmapMilestone::create([
                'roadmap_id' => $roadmap->id,
                'phase_name' => $m['phase'],
                'title' => $m['title'],
                'description' => $m['description'],
                'resource_recommendation' => $m['resource'],
                'milestone_order' => $index + 1,
                'is_completed' => false,
            ]);
        }

        return redirect()->route('dashboard.roadmap')
            ->with('success', 'Your interactive ' . $path->title . ' roadmap has been created!');
    }

    public function toggleMilestone(Request $request, $id)
    {
        $milestone = RoadmapMilestone::with('roadmap')->findOrFail($id);

        // Security authorization check
        if ($milestone->roadmap->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to roadmap milestone.');
        }

        $newState = !$milestone->is_completed;
        $milestone->update([
            'is_completed' => $newState,
            'completed_at' => $newState ? now() : null,
        ]);

        $progress = $milestone->roadmap->recalculateProgress();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_completed' => $newState,
                'progress_percent' => $progress,
            ]);
        }

        return back()->with('success', 'Milestone updated! Roadmap completion: ' . $progress . '%');
    }

    private function getMilestoneBlueprint(string $slug, string $title): array
    {
        return [
            // Phase 1: Foundation
            [
                'phase' => 'Phase 1: Foundation & Regulatory Standards',
                'title' => 'Master cGMP Guidelines & Cleanroom Air Classifications',
                'description' => 'Study WHO Good Manufacturing Practices (Annex 2 sterile, Annex 3 solid dosages). Understand Grade A-D particulate limits and differential pressures.',
                'resource' => 'WHO Technical Report Series & cGMP Written Exam Modules',
            ],
            [
                'phase' => 'Phase 1: Foundation & Regulatory Standards',
                'title' => 'Understand ALCOA+ Data Integrity Principles',
                'description' => 'Master documentation standards: Attributable, Legible, Contemporaneous, Original, and Accurate. Prevent common laboratory audit red flags.',
                'resource' => 'US FDA Data Integrity Guidance for Industry',
            ],

            // Phase 2: Technical Skills
            [
                'phase' => 'Phase 2: Core Technical & Role Competencies',
                'title' => 'Study ' . $title . ' Standard Operating Procedures (SOPs)',
                'description' => 'Review core SOP structures: Line clearance, deviation logging, sample receipt, calibration logs, and change control procedures.',
                'resource' => 'Pharma Career Compass SOP & Protocol Masterclass',
            ],
            [
                'phase' => 'Phase 2: Core Technical & Role Competencies',
                'title' => 'Laboratory & Equipment Troubleshooting',
                'description' => 'Understand failure modes relevant to this department (e.g. tablet capping, HPLC tailing, OOS procedures, batch yield reconciliation).',
                'resource' => 'Viva & Practical Exam Question Bank',
            ],

            // Phase 3: Recruitment Readiness
            [
                'phase' => 'Phase 3: Assessment & Written Exam Preparation',
                'title' => 'Complete 5 Timed Mock Recruitment Tests',
                'description' => 'Take full-length written assessments on Pharma Career Compass scoring >= 80% across pharmacology, pharmaceutics, and QC analysis.',
                'resource' => 'Written Exam Practice Hub (Timed Exams)',
            ],
            [
                'phase' => 'Phase 3: Assessment & Written Exam Preparation',
                'title' => 'Transform CV & LinkedIn for ' . $title,
                'description' => 'Highlight relevant instruments, thesis lab techniques, and cGMP coursework with quantifiable achievement bullets.',
                'resource' => 'CV and LinkedIn Review Service',
            ],

            // Phase 4: Final Interview & Board
            [
                'phase' => 'Phase 4: Interview & Board Readiness',
                'title' => 'Practise 20 Technical Viva Questions with Model Answers',
                'description' => 'Rehearse oral explanations for CAPA, root cause analysis, dissolution similarity factors, and line clearance without hesitation.',
                'resource' => 'Viva Practice Hub & Model Answers',
            ],
            [
                'phase' => 'Phase 4: Interview & Board Readiness',
                'title' => 'Complete a 1-on-1 Panel Mock Interview Simulation',
                'description' => 'Undergo a structured mock interview with an industry veteran simulating technical and situational recruitment questions.',
                'resource' => '1-on-1 Mentorship & Interview Coaching',
            ],
        ];
    }
}
