<?php

namespace Tests\Feature;

use App\Models\CareerAssessmentQuestion;
use App\Models\CareerPath;
use App\Models\Consultant;
use App\Models\ConsultationBooking;
use App\Models\ExamCategory;
use App\Models\ExamQuestion;
use App\Models\Service;
use App\Models\User;
use Tests\TestCase;

class PharmaCareerFeatureTest extends TestCase
{
    public function test_homepage_loads_with_brand_and_pillars(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Pharma Career Compass');
        $response->assertSee('Discover Your Direction. Build Your Future.');
        $response->assertSee('PHARMA CAREER LAUNCHPAD');
        $response->assertSee('Career Planning');
        $response->assertSee('Written Exam Preparation');
        $response->assertSee('Viva Skills');
        $response->assertSee('Interview Readiness');
        $response->assertSee('Pharmaceutical Industry Insights');
    }

    public function test_career_paths_directory_and_detail_page(): void
    {
        $response = $this->get('/career-paths');
        $response->assertStatus(200);
        $response->assertSee('Quality Assurance');

        $path = CareerPath::first();
        if ($path) {
            $showResponse = $this->get('/career-paths/' . $path->slug);
            $showResponse->assertStatus(200);
            $showResponse->assertSee($path->title);
        }
    }

    public function test_services_catalog_and_detail_page(): void
    {
        $response = $this->get('/services');
        $response->assertStatus(200);
        $response->assertSee('Structured Career Guidance');

        $service = Service::first();
        if ($service) {
            $showResponse = $this->get('/services/' . $service->slug);
            $showResponse->assertStatus(200);
            $showResponse->assertSee($service->title);
        }
    }

    public function test_consultant_directory_and_profile(): void
    {
        $response = $this->get('/consultants');
        $response->assertStatus(200);

        $consultant = Consultant::first();
        if ($consultant) {
            $profileResponse = $this->get('/consultants/' . $consultant->slug);
            $profileResponse->assertStatus(200);
            $profileResponse->assertSee($consultant->name);
        }
    }

    public function test_career_assessment_quiz_flow(): void
    {
        $response = $this->get('/quiz');
        $response->assertStatus(200);
        $response->assertSee('Pharmaceutical Career Assessment Quiz');

        $submitResponse = $this->post('/quiz/submit', [
            'step_1' => 'b_pharm',
            'step_2' => 'fresh_grad',
            'step_3' => 'plant',
            'step_4' => ['cgmp', 'validation'],
            'step_5' => 'full_mentorship',
        ]);

        $submitResponse->assertRedirect();
        $this->followRedirects($submitResponse)->assertSee('Personalized Career Direction Report');
    }

    public function test_career_roadmap_generation(): void
    {
        $response = $this->get('/roadmap');
        $response->assertStatus(200);

        $user = User::where('role', 'user')->first();
        $path = CareerPath::first();

        if ($user && $path) {
            $postResponse = $this->actingAs($user)->post('/roadmap/generate', [
                'career_path_id' => $path->id,
                'experience_level' => 'Fresh Graduate',
                'timeline_months' => 6,
            ]);

            $postResponse->assertRedirect('/dashboard/roadmap');
        }
    }

    public function test_written_exam_practice_and_scoring(): void
    {
        $response = $this->get('/practice/exams');
        $response->assertStatus(200);
        $response->assertSee('Written Exam Preparation');

        $category = ExamCategory::first();
        if ($category) {
            $examPage = $this->get('/practice/exams/' . $category->slug);
            $examPage->assertStatus(200);

            // Test submission
            $questions = ExamQuestion::where('category_id', $category->id)->get();
            $answers = [];
            foreach ($questions as $q) {
                $answers[$q->id] = $q->correct_option;
            }

            $submit = $this->post('/practice/exams/' . $category->slug, [
                'time_taken_seconds' => 120,
                'answers' => $answers,
            ]);

            $submit->assertRedirect();
        }
    }

    public function test_viva_practice_hub(): void
    {
        $response = $this->get('/practice/viva');
        $response->assertStatus(200);
        $response->assertSee('Pharmaceutical Technical Viva Hub');
    }

    public function test_interview_readiness_hub(): void
    {
        $response = $this->get('/practice/interviews');
        $response->assertStatus(200);
        $response->assertSee('Pharmaceutical Job Interview Readiness Center');
    }

    public function test_consultation_slots_api_and_booking(): void
    {
        $consultant = Consultant::with('availabilities')->whereHas('availabilities')->first();
        $service = Service::first();

        if ($consultant && $service) {
            $date = date('Y-m-d', strtotime('next Tuesday'));
            $slotsResponse = $this->getJson("/consultation/available-slots?consultant_id={$consultant->id}&date={$date}");
            $slotsResponse->assertStatus(200);

            $slots = $slotsResponse->json('slots');
            if (!empty($slots)) {
                $slot = $slots[0];
                $booking = $this->post('/consultation/book', [
                    'consultant_id' => $consultant->id,
                    'service_id' => $service->id,
                    'booking_date' => $date,
                    'start_time' => $slot['start'],
                    'end_time' => $slot['end'],
                    'notes' => 'Looking for guidance on QA audit preparation.',
                    'client_name' => 'Test Candidate',
                    'client_email' => 'test@example.com',
                    'client_phone' => '+880 1711-000000',
                ]);

                $booking->assertRedirect();
            }
        }
    }

    public function test_user_registration_and_authentication(): void
    {
        $email = 'cand_' . time() . '@example.com';
        $registerResponse = $this->post('/register', [
            'name' => 'Feature Test User',
            'email' => $email,
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'university' => 'University of Dhaka',
            'graduation_year' => 2024,
            'target_department' => 'Quality Assurance (QA)',
        ]);

        $registerResponse->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    public function test_candidate_dashboard_protected(): void
    {
        $this->post('/logout'); // Ensure guest
        $guestResponse = $this->get('/dashboard');
        $guestResponse->assertRedirect('/login');

        $user = User::where('role', 'user')->first();
        if ($user) {
            $authResponse = $this->actingAs($user)->get('/dashboard');
            $authResponse->assertStatus(200);
            $authResponse->assertSee('Candidate Portal');
        }
    }

    public function test_admin_portal_protected(): void
    {
        $student = User::where('role', 'user')->first();
        if ($student) {
            $forbidden = $this->actingAs($student)->get('/admin');
            $forbidden->assertStatus(403);
        }

        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $adminResponse = $this->actingAs($admin)->get('/admin');
            $adminResponse->assertStatus(200);
            $adminResponse->assertSee('Administration Suite');
        }
    }

    public function test_contact_form_submission(): void
    {
        $response = $this->from('/contact')->post('/contact', [
            'name' => 'Dr. Rafiqul Islam',
            'email' => 'rafiq@example.com',
            'phone' => '+880 1712-345678',
            'subject' => 'Career Launchpad Inquiry',
            'message' => 'I would like to inquire about the upcoming batch for fresh B.Pharm graduates.',
        ]);

        $response->assertRedirect('/contact');
        $this->followRedirects($response)->assertSee('Message Delivered');
    }

    public function test_newsletter_subscription(): void
    {
        $response = $this->from('/')->post('/newsletter', [
            'email' => 'subscriber_' . time() . '@example.com',
        ]);

        $response->assertRedirect('/');
    }

    public function test_sitemap_and_robots(): void
    {
        $sitemap = $this->get('/sitemap.xml');
        $sitemap->assertStatus(200);
        $sitemap->assertHeader('Content-Type', 'text/xml; charset=UTF-8');

        $robots = $this->get('/robots.txt');
        $robots->assertStatus(200);
        $robots->assertSee('User-agent: *');
        $robots->assertSee('Sitemap:');
    }
}
