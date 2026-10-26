<?php

namespace App\Http\Controllers;

use App\Models\CareerCategory;
use App\Models\CareerPath;
use App\Models\Service;
use App\Models\Consultant;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPaths = CareerPath::with('category')->where('is_active', true)->orderBy('sort_order')->take(8)->get();
        $allPaths = CareerPath::with('category')->where('is_active', true)->orderBy('sort_order')->get();
        $categories = CareerCategory::withCount('careerPaths')->orderBy('sort_order')->get();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $consultants = Consultant::where('is_active', true)->orderBy('sort_order')->take(4)->get();
        $testimonials = Testimonial::where('is_featured', true)->orderBy('sort_order')->take(6)->get();
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->take(8)->get();
        $latestPosts = BlogPost::with('category')->where('is_published', true)->orderBy('published_at', 'desc')->take(3)->get();
        
        $tickerText = SiteSetting::get('announcement_ticker', '• Special Offer! Get a Free 15-min Career Consultation Session • Special Offer! Get a Free 15-min Career Consultation Session •');

        return view('pages.home', compact(
            'featuredPaths',
            'allPaths',
            'categories',
            'services',
            'consultants',
            'testimonials',
            'faqs',
            'latestPosts',
            'tickerText'
        ));
    }

    public function about()
    {
        $consultants = Consultant::where('is_active', true)->orderBy('sort_order')->get();
        $servicesCount = Service::count();
        $pathsCount = CareerPath::count();
        return view('pages.about', compact('consultants', 'servicesCount', 'pathsCount'));
    }

    public function programs()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $paths = CareerPath::where('is_active', true)->orderBy('sort_order')->get();
        return view('pages.programs', compact('services', 'paths'));
    }

    public function contact()
    {
        $email = SiteSetting::get('contact_email', 'info@pharmacareercompass.com');
        $phone = SiteSetting::get('contact_phone', '+880 1844 567890');
        $address = SiteSetting::get('contact_address', 'Suite 7B, Pharma Innovation Hub, Gulshan-1, Dhaka');
        return view('pages.contact', compact('email', 'phone', 'address'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:3000',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Thank you! Your message has been received. Our pharmaceutical advisory team will reply within 24 hours.');
    }

    public function submitNewsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:150',
        ]);

        NewsletterSubscriber::updateOrCreate(
            ['email' => $validated['email']],
            ['is_active' => true]
        );

        return back()->with('newsletter_success', 'Thank you for subscribing to Pharma Career Compass weekly insights!');
    }
}
