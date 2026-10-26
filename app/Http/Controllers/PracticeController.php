<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use App\Models\ExamQuestion;
use App\Models\ExamAttempt;
use App\Models\VivaQuestion;
use App\Models\UserVivaProgress;
use App\Models\InterviewQuestion;
use App\Models\UserInterviewProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PracticeController extends Controller
{
    // --- Written Exams ---
    public function exams()
    {
        $categories = ExamCategory::withCount('questions')->where('is_active', true)->orderBy('sort_order')->get();
        $recentAttempts = [];
        if (Auth::check()) {
            $recentAttempts = ExamAttempt::with('category')->where('user_id', Auth::id())->latest()->take(5)->get();
        }
        return view('pages.practice.exams', compact('categories', 'recentAttempts'));
    }

    public function takeExam($categorySlug)
    {
        $category = ExamCategory::where('slug', $categorySlug)->where('is_active', true)->firstOrFail();
        $questions = ExamQuestion::where('category_id', $category->id)->where('is_active', true)->inRandomOrder()->get();

        if ($questions->isEmpty()) {
            return redirect()->route('practice.exams')->with('info', 'No active questions available in this category yet.');
        }

        return view('pages.practice.take-exam', compact('category', 'questions'));
    }

    public function submitExam(Request $request, $categorySlug)
    {
        $category = ExamCategory::where('slug', $categorySlug)->firstOrFail();
        $submittedAnswers = $request->input('answers', []);
        $timeTaken = (int) $request->input('time_taken_seconds', 0);

        $questions = ExamQuestion::where('category_id', $category->id)->where('is_active', true)->get();
        $total = $questions->count();
        $correct = 0;
        $breakdown = [];

        foreach ($questions as $q) {
            $selected = $submittedAnswers[$q->id] ?? null;
            $isCorrect = ($selected === $q->correct_option);
            if ($isCorrect) {
                $correct++;
            }

            $breakdown[] = [
                'question_id' => $q->id,
                'question_text' => $q->question_text,
                'option_a' => $q->option_a,
                'option_b' => $q->option_b,
                'option_c' => $q->option_c,
                'option_d' => $q->option_d,
                'correct_option' => $q->correct_option,
                'selected_option' => $selected,
                'is_correct' => $isCorrect,
                'explanation' => $q->explanation,
            ];
        }

        $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
        $passed = ($percentage >= 70.00);

        $attempt = ExamAttempt::create([
            'user_id' => Auth::id(),
            'category_id' => $category->id,
            'session_title' => $category->name . ' Mock Assessment',
            'total_questions' => $total,
            'correct_answers' => $correct,
            'score_percentage' => $percentage,
            'time_taken_seconds' => $timeTaken,
            'user_answers' => $breakdown,
            'passed' => $passed,
        ]);

        return redirect()->route('practice.exam.results', $attempt->id);
    }

    public function examResults($id)
    {
        $attempt = ExamAttempt::with('category')->findOrFail($id);
        
        // Authorization: if user_id is set, only that user can view
        if ($attempt->user_id && Auth::check() && $attempt->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pages.practice.exam-results', compact('attempt'));
    }

    // --- Viva Practice Hub ---
    public function viva(Request $request)
    {
        $domains = VivaQuestion::where('is_active', true)->pluck('domain')->unique();
        
        $query = VivaQuestion::where('is_active', true);

        if ($request->filled('domain')) {
            $query->where('domain', $request->domain);
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('question_text', 'LIKE', "%{$search}%")
                  ->orWhere('topic', 'LIKE', "%{$search}%")
                  ->orWhere('model_answer', 'LIKE', "%{$search}%");
            });
        }

        $questions = $query->orderBy('sort_order')->paginate(8)->withQueryString();

        $userProgress = [];
        if (Auth::check()) {
            $userProgress = UserVivaProgress::where('user_id', Auth::id())
                ->get()
                ->keyBy('viva_question_id');
        }

        return view('pages.practice.viva', compact('questions', 'domains', 'userProgress'));
    }

    public function toggleVivaProgress(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Please sign in to save viva practice progress.'], 401);
        }

        $question = VivaQuestion::findOrFail($id);
        $type = $request->input('type', 'practised'); // 'practised' or 'bookmark'

        $progress = UserVivaProgress::firstOrCreate(
            ['user_id' => Auth::id(), 'viva_question_id' => $question->id],
            ['is_practised' => false, 'is_bookmarked' => false]
        );

        if ($type === 'bookmark') {
            $progress->update(['is_bookmarked' => !$progress->is_bookmarked]);
            return response()->json(['success' => true, 'is_bookmarked' => $progress->is_bookmarked]);
        } else {
            $progress->update(['is_practised' => !$progress->is_practised]);
            return response()->json(['success' => true, 'is_practised' => $progress->is_practised]);
        }
    }

    // --- Interview Preparation Hub ---
    public function interviews(Request $request)
    {
        $roles = InterviewQuestion::where('is_active', true)->pluck('target_role')->unique();
        $categories = InterviewQuestion::where('is_active', true)->pluck('category')->unique();

        $query = InterviewQuestion::where('is_active', true);

        if ($request->filled('role')) {
            $query->where('target_role', $request->role);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('question_text', 'LIKE', "%{$search}%");
        }

        $questions = $query->orderBy('sort_order')->paginate(8)->withQueryString();

        $userProgress = [];
        if (Auth::check()) {
            $userProgress = UserInterviewProgress::where('user_id', Auth::id())
                ->get()
                ->keyBy('interview_question_id');
        }

        return view('pages.practice.interviews', compact('questions', 'roles', 'categories', 'userProgress'));
    }

    public function toggleInterviewProgress(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Please sign in to save interview practice progress.'], 401);
        }

        $question = InterviewQuestion::findOrFail($id);
        $type = $request->input('type', 'prepared'); // 'prepared' or 'bookmark'

        $progress = UserInterviewProgress::firstOrCreate(
            ['user_id' => Auth::id(), 'interview_question_id' => $question->id],
            ['is_prepared' => false, 'is_bookmarked' => false]
        );

        if ($type === 'bookmark') {
            $progress->update(['is_bookmarked' => !$progress->is_bookmarked]);
            return response()->json(['success' => true, 'is_bookmarked' => $progress->is_bookmarked]);
        } else {
            $progress->update(['is_prepared' => !$progress->is_prepared]);
            return response()->json(['success' => true, 'is_prepared' => $progress->is_prepared]);
        }
    }
}
