<?php

namespace App\Http\Controllers;

use App\Models\CareerAssessment;
use App\Models\CareerAssessmentQuestion;
use App\Models\CareerPath;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CareerQuizController extends Controller
{
    public function index()
    {
        $questions = CareerAssessmentQuestion::where('is_active', true)->orderBy('step_number')->get();
        return view('pages.quiz.index', compact('questions'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'step_1' => 'required|string',
            'step_2' => 'required|string',
            'step_3' => 'required|string',
            'step_4' => 'required|array|min:1',
            'step_5' => 'required|string',
            'full_name' => 'nullable|string|max:150',
            'email' => 'nullable|email|max:150',
        ]);

        $edu = $validated['step_1'];
        $exp = $validated['step_2'];
        $env = $validated['step_3'];
        $interests = $validated['step_4'];
        $goal = $validated['step_5'];

        // Transparent Matching Algorithm
        $allPaths = CareerPath::with('category')->where('is_active', true)->get();
        $scoredPaths = [];

        foreach ($allPaths as $path) {
            $score = 50; // base compatibility
            $slug = $path->slug;

            // Environment weighting
            if ($env === 'plant' && in_array($slug, ['quality-assurance-qa', 'production-and-manufacturing', 'supply-chain-pharmaceutical-operations'])) {
                $score += 25;
            } elseif ($env === 'lab' && in_array($slug, ['quality-control-qc', 'research-and-development'])) {
                $score += 25;
            } elseif ($env === 'corporate_regulatory' && in_array($slug, ['regulatory-affairs', 'pharmacovigilance'])) {
                $score += 25;
            } elseif ($env === 'commercial' && in_array($slug, ['pharmaceutical-sales-marketing', 'medical-affairs'])) {
                $score += 25;
            } elseif ($env === 'clinical' && in_array($slug, ['hospital-and-community-pharmacy', 'clinical-research'])) {
                $score += 25;
            }

            // Interest domain weighting
            if (in_array('qa_audit', $interests) && $slug === 'quality-assurance-qa') $score += 20;
            if (in_array('instrumental_qc', $interests) && $slug === 'quality-control-qc') $score += 20;
            if (in_array('formulation_prod', $interests) && $slug === 'production-and-manufacturing') $score += 20;
            if (in_array('reg_dossier', $interests) && $slug === 'regulatory-affairs') $score += 20;
            if (in_array('safety_pv', $interests) && $slug === 'pharmacovigilance') $score += 20;
            if (in_array('marketing_pmd', $interests) && $slug === 'pharmaceutical-sales-marketing') $score += 20;
            if (in_array('clinical_tdm', $interests) && in_array($slug, ['hospital-and-community-pharmacy', 'clinical-research'])) $score += 20;

            // Education bonus
            if ($edu === 'pharm_d' && in_array($slug, ['clinical-research', 'hospital-and-community-pharmacy', 'medical-affairs'])) $score += 10;
            if ($edu === 'm_pharm_tech' && in_array($slug, ['research-and-development', 'quality-assurance-qa'])) $score += 10;

            $scoredPaths[] = [
                'path_id' => $path->id,
                'title' => $path->title,
                'slug' => $path->slug,
                'summary' => $path->summary,
                'badge' => $path->badge,
                'match_percentage' => min(98, $score),
            ];
        }

        // Sort by match percentage descending
        usort($scoredPaths, fn($a, $b) => $b['match_percentage'] <=> $a['match_percentage']);
        $topPaths = array_slice($scoredPaths, 0, 3);

        // Map Recommended Services
        $recommendedServices = [];
        if (in_array($goal, ['pass_exams', 'full_mentorship'])) {
            $recommendedServices[] = Service::where('slug', 'written-exam-preparation')->first()?->only(['title', 'slug', 'price', 'summary']);
        }
        if (in_array($goal, ['master_viva', 'full_mentorship'])) {
            $recommendedServices[] = Service::where('slug', 'viva-oral-examination-preparation')->first()?->only(['title', 'slug', 'price', 'summary']);
        }
        if (in_array($goal, ['ace_interviews', 'full_mentorship'])) {
            $recommendedServices[] = Service::where('slug', 'job-interview-preparation')->first()?->only(['title', 'slug', 'price', 'summary']);
        }
        if (in_array($goal, ['cv_upgrade', 'full_mentorship'])) {
            $recommendedServices[] = Service::where('slug', 'cv-linkedin-review')->first()?->only(['title', 'slug', 'price', 'summary']);
        }
        $recommendedServices[] = Service::where('slug', 'career-planning-consultation')->first()?->only(['title', 'slug', 'price', 'summary']);
        $recommendedServices = array_filter($recommendedServices);

        // Action Plan Steps
        $actionPlan = [
            [
                'step' => 1,
                'title' => 'Target Your Primary Department',
                'description' => 'Focus your preparation on ' . $topPaths[0]['title'] . ' based on your high ' . $topPaths[0]['match_percentage'] . '% profile alignment.',
            ],
            [
                'step' => 2,
                'title' => 'Calibrate Your Written Assessment Score',
                'description' => 'Practice 20-30 technical MCQs daily in our Written Exam Practice module focusing on cGMP, HPLC, and pharmacopoeial guidelines.',
            ],
            [
                'step' => 3,
                'title' => 'Master Oral Technical Viva Articulation',
                'description' => 'Review model answers in our Viva Hub to articulate deviation handling, line clearance, and analytical formulas fluently.',
            ],
            [
                'step' => 4,
                'title' => 'Book a 1-on-1 Strategic Consultation',
                'description' => 'Discuss your personalized career trajectory with a senior pharmaceutical mentor and refine your resume before applying.',
            ],
        ];

        $guidanceSummary = "Based on your academic profile, preference for " . ucwords(str_replace('_', ' ', $env)) . " settings, and technical interests in " . implode(', ', array_map(fn($i) => ucwords(str_replace('_', ' ', $i)), $interests)) . ", you exhibit exceptionally strong potential for roles in " . $topPaths[0]['title'] . " (" . $topPaths[0]['match_percentage'] . "% match) and " . $topPaths[1]['title'] . " (" . $topPaths[1]['match_percentage'] . "% match). Structured preparation will give you an immediate competitive edge over candidates relying solely on textbook recall.";

        $sessionToken = Str::random(32);

        $assessment = CareerAssessment::create([
            'user_id' => Auth::id(),
            'session_token' => $sessionToken,
            'full_name' => $validated['full_name'] ?? (Auth::user()?->name ?? 'Candidate'),
            'email' => $validated['email'] ?? (Auth::user()?->email ?? null),
            'education_level' => $edu,
            'specialization' => $env,
            'experience_level' => $exp,
            'preferred_environment' => $env,
            'interests' => $interests,
            'career_goals' => [$goal],
            'responses' => $validated,
            'recommended_paths' => $topPaths,
            'recommended_services' => array_values($recommendedServices),
            'action_plan' => $actionPlan,
            'guidance_summary' => $guidanceSummary,
            'is_saved' => Auth::check(),
        ]);

        return redirect()->route('quiz.results', ['id' => $assessment->id])
            ->with('success', 'Your personalized pharmaceutical career guidance summary has been generated!');
    }

    public function results(Request $request, $id = null)
    {
        // Handle direct query string like /quiz/results?8 or query parameter ?id=8
        if (!$id) {
            $queryString = $request->getQueryString();
            if ($queryString && is_numeric($queryString)) {
                $id = (int) $queryString;
            } elseif ($request->has('id')) {
                $id = (int) $request->input('id');
            } elseif ($request->route('id')) {
                $id = (int) $request->route('id');
            }
        }

        $assessment = null;
        if ($id) {
            $assessment = CareerAssessment::find($id);
        }

        if (!$assessment && Auth::check()) {
            $assessment = CareerAssessment::where('user_id', Auth::id())->latest()->first();
        }

        if (!$assessment) {
            $assessment = CareerAssessment::latest()->first();
        }

        if (!$assessment) {
            return redirect()->route('quiz.index')->with('info', 'Please complete the assessment quiz first.');
        }

        return view('pages.quiz.results', compact('assessment'));
    }

    public function saveToAccount(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Please sign in or register to save your assessment report to your dashboard.');
        }

        $assessment = CareerAssessment::findOrFail($id);
        $assessment->update([
            'user_id' => Auth::id(),
            'is_saved' => true,
        ]);

        return redirect()->route('dashboard.assessment')
            ->with('success', 'Assessment report successfully saved to your dashboard profile!');
    }
}
