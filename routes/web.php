<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminSeminarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CareerPathController;
use App\Http\Controllers\CareerQuizController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Brand & Information Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/programs', [HomeController::class, 'programs'])->name('programs');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
Route::post('/newsletter', [HomeController::class, 'submitNewsletter'])->name('newsletter.submit');

// Career Paths
Route::get('/career-paths', [CareerPathController::class, 'index'])->name('career-paths.index');
Route::get('/career-paths/{slug}', [CareerPathController::class, 'show'])->name('career-paths.show');

// Services & Consultations
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Mentors & Consultants
Route::get('/consultants', [ConsultantController::class, 'index'])->name('consultants.index');
Route::get('/consultants/{slug}', [ConsultantController::class, 'show'])->name('consultants.show');

// Consultation Booking Workflow
Route::get('/consultation/book', [BookingController::class, 'create'])->name('consultation.book');
Route::get('/consultation/available-slots', [BookingController::class, 'getAvailableSlots'])->name('consultation.slots');
Route::post('/consultation/book', [BookingController::class, 'store'])->name('consultation.store');
Route::get('/consultation/confirmation/{id}', [BookingController::class, 'confirmation'])->name('consultation.confirmation');
Route::post('/consultation/cancel/{id}', [DashboardController::class, 'cancelBooking'])->name('consultation.cancel');

Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
Route::get('/booking/slots', [BookingController::class, 'getAvailableSlots'])->name('booking.slots');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/confirmation/{id}', [BookingController::class, 'confirmation'])->name('booking.confirmation');

// Career Assessment Quiz
Route::get('/quiz', [CareerQuizController::class, 'index'])->name('quiz.index');
Route::post('/quiz/submit', [CareerQuizController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/results/{id?}', [CareerQuizController::class, 'results'])->name('quiz.results');
Route::post('/quiz/save/{id}', [CareerQuizController::class, 'saveToAccount'])->name('quiz.save');

Route::get('/career-quiz', [CareerQuizController::class, 'index']);
Route::post('/career-quiz', [CareerQuizController::class, 'submit']);
Route::get('/career-quiz/results/{id?}', [CareerQuizController::class, 'results']);

// Career Roadmap Builder
Route::get('/roadmap', [RoadmapController::class, 'index'])->name('roadmap.index');
Route::post('/roadmap/generate', [RoadmapController::class, 'generate'])->name('roadmap.generate');
Route::post('/roadmap/milestone/{id}/toggle', [RoadmapController::class, 'toggleMilestone'])->name('roadmap.toggle-milestone');

Route::get('/career-roadmap', [RoadmapController::class, 'index']);
Route::post('/career-roadmap/generate', [RoadmapController::class, 'generate']);
Route::post('/career-roadmap/milestone/{id}/toggle', [RoadmapController::class, 'toggleMilestone'])->name('roadmap.milestone.toggle');

// Practice Hub
Route::get('/practice/exams', [PracticeController::class, 'exams'])->name('practice.exams');
Route::get('/practice/exams/{categorySlug}', [PracticeController::class, 'takeExam'])->name('practice.exam.take');
Route::post('/practice/exams/submit', [PracticeController::class, 'submitExam'])->name('practice.exam.submit');
Route::post('/practice/exams/{categorySlug}', [PracticeController::class, 'submitExam']);
Route::get('/practice/exams/results/{id}', [PracticeController::class, 'examResults'])->name('practice.exam.results');

Route::get('/practice/viva', [PracticeController::class, 'viva'])->name('practice.viva');
Route::post('/practice/viva/{id}/toggle', [PracticeController::class, 'toggleVivaProgress'])->name('practice.viva.toggle');

Route::get('/practice/interviews', [PracticeController::class, 'interviews'])->name('practice.interviews');
Route::post('/practice/interviews/{id}/toggle', [PracticeController::class, 'toggleInterviewProgress'])->name('practice.interviews.toggle');

// Blog & Resources CMS
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Seminars & Workshops
Route::get('/seminars', [SeminarController::class, 'index'])->name('seminars.index');
Route::get('/seminars/{slug}', [SeminarController::class, 'show'])->name('seminars.show');
Route::get('/seminars/{slug}/register', [SeminarController::class, 'registerForm'])->name('seminars.register');
Route::post('/seminars/{slug}/register', [SeminarController::class, 'registerSubmit'])->name('seminars.register.submit');
Route::get('/seminar/status/{reference}', [SeminarController::class, 'confirmation'])->name('seminars.confirmation');
Route::post('/seminar/status/lookup', [SeminarController::class, 'statusLookup'])->name('seminars.status.lookup');

// Technical SEO
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::redirect('/admin/login', '/login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Candidate User Dashboard Routes (Auth protected)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/assessment', [DashboardController::class, 'assessment'])->name('dashboard.assessment');
    Route::get('/roadmap', [DashboardController::class, 'roadmap'])->name('dashboard.roadmap');
    Route::get('/exams', [DashboardController::class, 'exams'])->name('dashboard.exams');
    Route::get('/viva', [DashboardController::class, 'viva'])->name('dashboard.viva');
    Route::get('/bookings', [DashboardController::class, 'bookings'])->name('dashboard.bookings');
    Route::post('/bookings/{id}/cancel', [DashboardController::class, 'cancelBooking'])->name('dashboard.bookings.cancel');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::post('/profile', [DashboardController::class, 'updateProfile'])->name('dashboard.profile.update');
    Route::post('/password', [DashboardController::class, 'updatePassword'])->name('dashboard.password.update');
});

/*
|--------------------------------------------------------------------------
| Administrator Management Panel Routes (Admin role protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Bookings
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{id}', [AdminController::class, 'updateBooking'])->name('bookings.update');

    // Services
    Route::get('/services', [AdminController::class, 'services'])->name('services');
    Route::post('/services', [AdminController::class, 'storeService'])->name('services.store');
    Route::put('/services/{id}', [AdminController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{id}', [AdminController::class, 'deleteService'])->name('services.delete');

    // Career Paths
    Route::get('/career-paths', [AdminController::class, 'careerPaths'])->name('career-paths');
    Route::post('/career-paths', [AdminController::class, 'storeCareerPath'])->name('career-paths.store');
    Route::put('/career-paths/{id}', [AdminController::class, 'updateCareerPath'])->name('career-paths.update');
    Route::delete('/career-paths/{id}', [AdminController::class, 'deleteCareerPath'])->name('career-paths.delete');

    // Consultants
    Route::get('/consultants', [AdminController::class, 'consultants'])->name('consultants');
    Route::post('/consultants', [AdminController::class, 'storeConsultant'])->name('consultants.store');
    Route::post('/consultants/{id}', [AdminController::class, 'updateConsultant'])->name('consultants.update');

    // Exams
    Route::get('/exams', [AdminController::class, 'exams'])->name('exams');
    Route::post('/exams', [AdminController::class, 'storeExamQuestion'])->name('exams.store');
    Route::delete('/exams/{id}', [AdminController::class, 'deleteExamQuestion'])->name('exams.delete');

    // Viva
    Route::get('/viva', [AdminController::class, 'viva'])->name('viva');
    Route::post('/viva', [AdminController::class, 'storeVivaQuestion'])->name('viva.store');

    // Blog
    Route::get('/blog', [AdminController::class, 'blog'])->name('blog');
    Route::post('/blog', [AdminController::class, 'storeBlogPost'])->name('blog.store');
    Route::put('/blog/{id}', [AdminController::class, 'updateBlogPost'])->name('blog.update');
    Route::delete('/blog/{id}', [AdminController::class, 'destroyBlogPost'])->name('blog.destroy');

    // FAQs
    Route::get('/faqs', [AdminController::class, 'faqs'])->name('faqs');
    Route::post('/faqs', [AdminController::class, 'storeFaq'])->name('faqs.store');

    // Testimonials
    Route::get('/testimonials', [AdminController::class, 'testimonials'])->name('testimonials');
    Route::post('/testimonials', [AdminController::class, 'storeTestimonial'])->name('testimonials.store');
    Route::delete('/testimonials/{id}', [AdminController::class, 'deleteTestimonial'])->name('testimonials.delete');

    // Messages
    Route::get('/messages', [AdminController::class, 'messages'])->name('messages');
    Route::post('/messages/{id}/read', [AdminController::class, 'markMessageRead'])->name('messages.read');

    // Site Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

    // Seminars & Workshops Management
    Route::get('/seminars', [AdminSeminarController::class, 'index'])->name('seminars.index');
    Route::get('/seminars/create', [AdminSeminarController::class, 'create'])->name('seminars.create');
    Route::post('/seminars', [AdminSeminarController::class, 'store'])->name('seminars.store');
    Route::get('/seminars/{id}/edit', [AdminSeminarController::class, 'edit'])->name('seminars.edit');
    Route::put('/seminars/{id}', [AdminSeminarController::class, 'update'])->name('seminars.update');
    Route::delete('/seminars/{id}', [AdminSeminarController::class, 'destroy'])->name('seminars.destroy');

    // Seminar Registrations & Payment Verification
    Route::get('/seminars-registrations/export', [AdminSeminarController::class, 'exportCsv'])->name('seminars.registrations.export');
    Route::get('/seminars-registrations', [AdminSeminarController::class, 'registrations'])->name('seminars.registrations');
    Route::get('/seminar-registrations', [AdminSeminarController::class, 'registrations'])->name('seminars.registrations.alias');
    Route::get('/payments', [AdminSeminarController::class, 'registrations'])->name('payments');
    Route::post('/seminars-registrations/{id}/verify', [AdminSeminarController::class, 'verifyPayment'])->name('seminars.registrations.verify');
    Route::post('/seminars-registrations/{id}/reject', [AdminSeminarController::class, 'rejectPayment'])->name('seminars.registrations.reject');
    Route::post('/seminars-registrations/{id}/resend', [AdminSeminarController::class, 'resendConfirmation'])->name('seminars.registrations.resend');
    Route::post('/seminars/{id}/broadcast', [AdminSeminarController::class, 'broadcastUpdate'])->name('seminars.broadcast');
});
