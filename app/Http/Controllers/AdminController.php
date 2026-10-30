<?php

namespace App\Http\Controllers;

use App\Models\CareerAssessment;
use App\Models\CareerCategory;
use App\Models\CareerPath;
use App\Models\Consultant;
use App\Models\ConsultantAvailability;
use App\Models\ConsultationBooking;
use App\Models\ContactMessage;
use App\Models\ExamAttempt;
use App\Models\ExamCategory;
use App\Models\ExamQuestion;
use App\Models\Faq;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\VivaQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $metrics = [
            'users_count' => User::count(),
            'bookings_count' => ConsultationBooking::count(),
            'exam_questions_count' => ExamQuestion::count(),
            'viva_questions_count' => VivaQuestion::count(),
            'career_paths_count' => CareerPath::count(),
            'consultants_count' => Consultant::count(),
            'blog_posts_count' => BlogPost::count(),
            'contact_messages_count' => ContactMessage::count(),
        ];

        $recentBookings = ConsultationBooking::with(['consultant', 'service', 'user'])
            ->latest()
            ->take(6)
            ->get();

        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('metrics', 'recentBookings', 'recentMessages'));
    }

    // --- Bookings ---
    public function bookings(Request $request)
    {
        $query = ConsultationBooking::with(['consultant', 'service', 'user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('booking_date', 'desc')->paginate(15)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateBooking(Request $request, $id)
    {
        $booking = ConsultationBooking::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled,rescheduled',
            'meeting_link' => 'nullable|url|max:255',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $booking->update($validated);

        return back()->with('success', 'Booking updated successfully!');
    }

    // --- Services ---
    public function services()
    {
        $services = Service::orderBy('sort_order')->paginate(15);
        return view('admin.services.index', compact('services'));
    }

    public function storeService(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'tag' => 'nullable|string|max:50',
            'summary' => 'required|string|max:500',
            'description' => 'nullable|string',
            'target_audience' => 'nullable|string|max:255',
            'duration_minutes' => 'required|integer|min:15|max:240',
            'price' => 'required|numeric|min:0',
            'delivery_mode' => 'required|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        Service::create($validated);

        return back()->with('success', 'Service package added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'tag' => 'nullable|string|max:50',
            'summary' => 'required|string|max:500',
            'description' => 'nullable|string',
            'target_audience' => 'nullable|string|max:255',
            'duration_minutes' => 'required|integer|min:15|max:240',
            'price' => 'required|numeric|min:0',
            'delivery_mode' => 'required|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $service->update($validated);

        return back()->with('success', 'Service updated successfully!');
    }

    public function deleteService($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return back()->with('success', 'Service deleted successfully!');
    }

    // --- Career Paths ---
    public function careerPaths()
    {
        $careerPaths = CareerPath::with('category')->orderBy('sort_order')->paginate(15);
        $paths = $careerPaths;
        $categories = CareerCategory::all();
        return view('admin.career-paths.index', compact('careerPaths', 'paths', 'categories'));
    }

    public function storeCareerPath(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category_id' => 'required|exists:career_categories,id',
            'icon' => 'nullable|string|max:50',
            'badge' => 'nullable|string|max:50',
            'summary' => 'required|string',
            'overview' => 'nullable|string',
            'salary_range' => 'nullable|string|max:100',
            'work_environment' => 'nullable|string|max:100',
            'experience_level' => 'required|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'typical_day' => 'nullable|string',
        ]);

        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $count = 1;
        while (CareerPath::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$count}";
            $count++;
        }
        $validated['slug'] = $slug;
        $validated['icon'] = $request->input('icon') ?: 'clipboard-check';
        $validated['sort_order'] = (int) $request->input('sort_order', 0);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : true;

        // JSON array fields
        $validated['relevant_qualifications'] = $this->parseDelimitedList($request->input('relevant_qualifications'));
        $validated['required_skills'] = $this->parseDelimitedList($request->input('required_skills'));
        $validated['possible_entry_points'] = $this->parseDelimitedList($request->input('possible_entry_points'));
        $validated['recommended_preparation'] = $this->parseDelimitedList($request->input('recommended_preparation'));

        CareerPath::create($validated);

        return back()->with('success', 'Career path created successfully!');
    }

    public function updateCareerPath(Request $request, $id)
    {
        $path = CareerPath::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category_id' => 'required|exists:career_categories,id',
            'icon' => 'nullable|string|max:50',
            'badge' => 'nullable|string|max:50',
            'summary' => 'required|string',
            'overview' => 'nullable|string',
            'salary_range' => 'nullable|string|max:100',
            'work_environment' => 'nullable|string|max:100',
            'experience_level' => 'required|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'typical_day' => 'nullable|string',
        ]);

        if ($validated['title'] !== $path->title) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $count = 1;
            while (CareerPath::where('slug', $slug)->where('id', '!=', $path->id)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        }

        $validated['icon'] = $request->input('icon') ?: ($path->icon ?: 'clipboard-check');
        $validated['sort_order'] = (int) $request->input('sort_order', $path->sort_order ?? 0);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        // JSON array fields
        $validated['relevant_qualifications'] = $this->parseDelimitedList($request->input('relevant_qualifications'));
        $validated['required_skills'] = $this->parseDelimitedList($request->input('required_skills'));
        $validated['possible_entry_points'] = $this->parseDelimitedList($request->input('possible_entry_points'));
        $validated['recommended_preparation'] = $this->parseDelimitedList($request->input('recommended_preparation'));

        $path->update($validated);

        return back()->with('success', 'Career path "' . $path->title . '" updated successfully!');
    }

    public function deleteCareerPath($id)
    {
        $path = CareerPath::findOrFail($id);
        $title = $path->title;
        $path->delete();

        return back()->with('success', 'Career path "' . $title . '" deleted successfully!');
    }

    private function parseDelimitedList($val): array
    {
        if (is_array($val)) {
            return array_values(array_filter(array_map('trim', $val)));
        }
        if (empty($val)) {
            return [];
        }
        $lines = preg_split('/[\r\n]+/', (string)$val);
        $items = [];
        foreach ($lines as $line) {
            $parts = explode(',', $line);
            foreach ($parts as $p) {
                $trimmed = trim($p);
                if ($trimmed !== '') {
                    $items[] = $trimmed;
                }
            }
        }
        return array_values(array_unique($items));
    }

    // --- Consultants / Career Leaders ---
    public function consultants()
    {
        $consultants = Consultant::orderBy('sort_order')->paginate(15);
        return view('admin.consultants.index', compact('consultants'));
    }

    public function storeConsultant(Request $request)
    {
        if ($request->has('years_of_experience') && !$request->has('experience_years')) {
            $request->merge(['experience_years' => $request->years_of_experience]);
        }
        if ($request->has('hourly_rate_bdt') && !$request->has('hourly_rate')) {
            $request->merge(['hourly_rate' => $request->hourly_rate_bdt]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'title' => 'required|string|max:150',
            'specialization' => 'required|string|max:150',
            'current_company' => 'nullable|string|max:150',
            'qualifications' => 'nullable|string|max:200',
            'experience_years' => 'required|integer|min:0|max:50',
            'bio' => 'nullable|string',
            'hourly_rate' => 'nullable|numeric|min:0',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_featured' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        if (Consultant::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] .= '-' . time();
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'consultant_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/consultants'), $filename);
            $validated['avatar'] = '/images/consultants/' . $filename;
        }

        $validated['hourly_rate'] = $validated['hourly_rate'] ?? 1000.00;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = true;

        Consultant::create($validated);

        return back()->with('success', 'Career leader added successfully!');
    }

    public function updateConsultant(Request $request, $id)
    {
        $consultant = Consultant::findOrFail($id);

        if ($request->has('years_of_experience') && !$request->has('experience_years')) {
            $request->merge(['experience_years' => $request->years_of_experience]);
        }
        if ($request->has('hourly_rate_bdt') && !$request->has('hourly_rate')) {
            $request->merge(['hourly_rate' => $request->hourly_rate_bdt]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'title' => 'required|string|max:150',
            'specialization' => 'required|string|max:150',
            'current_company' => 'nullable|string|max:150',
            'qualifications' => 'nullable|string|max:200',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'bio' => 'nullable|string',
            'hourly_rate' => 'nullable|numeric|min:0',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_featured' => 'boolean',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'consultant_' . $consultant->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/consultants'), $filename);
            $validated['avatar'] = '/images/consultants/' . $filename;
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        if ($request->has('is_active')) {
            $validated['is_active'] = $request->boolean('is_active');
        }

        $consultant->update(array_filter($validated, fn($val) => !is_null($val)));

        return back()->with('success', 'Career leader profile updated successfully!');
    }

    public function deleteConsultant($id)
    {
        $consultant = Consultant::findOrFail($id);
        $name = $consultant->name;
        $consultant->availabilities()->delete();
        $consultant->delete();

        return back()->with('success', "Career leader '{$name}' deleted successfully.");
    }

    // --- Exam Questions ---
    public function exams()
    {
        $categories = ExamCategory::withCount('questions')->get();
        $questions = ExamQuestion::with('category')->latest()->paginate(15);
        return view('admin.exams.index', compact('categories', 'questions'));
    }

    public function storeExamQuestion(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:exam_categories,id',
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:a,b,c,d',
            'explanation' => 'nullable|string',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
        ]);

        $validated['is_active'] = true;

        ExamQuestion::create($validated);

        return back()->with('success', 'Exam question added successfully!');
    }

    public function deleteExamQuestion($id)
    {
        ExamQuestion::findOrFail($id)->delete();
        return back()->with('success', 'Question deleted successfully.');
    }

    // --- Viva Questions ---
    public function viva()
    {
        $questions = VivaQuestion::orderBy('sort_order')->paginate(15);
        return view('admin.viva.index', compact('questions'));
    }

    public function storeVivaQuestion(Request $request)
    {
        $validated = $request->validate([
            'domain' => 'required|string|max:100',
            'topic' => 'required|string|max:150',
            'question_text' => 'required|string',
            'model_answer' => 'required|string',
            'interviewer_tip' => 'nullable|string',
            'difficulty' => 'required|in:Fundamental,Standard,Advanced',
        ]);

        $validated['is_active'] = true;

        VivaQuestion::create($validated);

        return back()->with('success', 'Viva question added successfully!');
    }

    // --- Blog Posts ---
    public function blog()
    {
        $posts = BlogPost::with('category')->latest()->paginate(15);
        $categories = BlogCategory::all();
        return view('admin.blog.index', compact('posts', 'categories'));
    }

    public function storeBlogPost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'category_id' => 'required|exists:blog_categories,id',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'author_name' => 'required|string|max:100',
            'author_title' => 'nullable|string|max:100',
            'read_time_minutes' => 'required|integer|min:1|max:60',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        BlogPost::create($validated);

        return back()->with('success', 'Blog article published successfully!');
    }

    public function updateBlogPost(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'category_id' => 'required|exists:blog_categories,id',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'author_name' => 'required|string|max:100',
            'author_title' => 'nullable|string|max:100',
            'read_time_minutes' => 'required|integer|min:1|max:60',
            'is_published' => 'boolean',
        ]);

        if ($post->title !== $validated['title']) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;
            while (BlogPost::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $validated['slug'] = $slug;
        }

        $validated['is_published'] = $request->boolean('is_published');
        if ($validated['is_published'] && !$post->published_at) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        return back()->with('success', 'Blog article updated successfully!');
    }

    public function destroyBlogPost($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        return back()->with('success', 'Blog article deleted successfully!');
    }

    // --- FAQs ---
    public function faqs()
    {
        $faqs = Faq::orderBy('sort_order')->paginate(15);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function storeFaq(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:50',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'integer',
        ]);

        $validated['is_active'] = true;

        Faq::create($validated);

        return back()->with('success', 'FAQ added successfully!');
    }

    // --- Testimonials ---
    public function testimonials()
    {
        $testimonials = Testimonial::orderBy('sort_order')->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'role' => 'required|string|max:150',
            'previous_status' => 'nullable|string|max:150',
            'content' => 'required|string',
            'service_tag' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'is_demo' => 'boolean',
        ]);

        $validated['is_demo'] = $request->boolean('is_demo');
        $validated['is_featured'] = true;

        Testimonial::create($validated);

        return back()->with('success', 'Testimonial added successfully!');
    }

    public function deleteTestimonial($id)
    {
        Testimonial::findOrFail($id)->delete();
        return back()->with('success', 'Testimonial deleted successfully!');
    }

    // --- Contact Messages ---
    public function messages()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function markMessageRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);
        return back()->with('success', 'Message marked as read.');
    }

    // --- Settings ---
    public function settings()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $inputs = $request->except('_token');

        foreach ($inputs as $key => $val) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $val]);
        }

        return back()->with('success', 'Website settings and branding updated successfully!');
    }
}
