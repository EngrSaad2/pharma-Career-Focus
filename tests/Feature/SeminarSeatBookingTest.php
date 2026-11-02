<?php

namespace Tests\Feature;

use App\Models\Seminar;
use App\Models\SeminarRegistration;
use App\Models\SiteSetting;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class SeminarSeatBookingTest extends TestCase
{
    public function test_home_page_shows_book_seminars_seat_button(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Book Seminars Seat');
        $response->assertSee('/seminars/book');
        $response->assertSee('1-to-Many');
        $response->assertDontSee('Book a Consultation');
    }

    public function test_default_mode_is_off_and_shows_free_with_crossed_price_and_hidden_payment(): void
    {
        SiteSetting::set('module_price_enabled', '0');

        $response = $this->get('/seminars/book');
        $response->assertStatus(200);
        $response->assertSee('Book Seminars Seat');
        $response->assertSee('Module 1: Career in Pharmaceutical Industrial Operations');
        $response->assertSee('Module 2: Career in Pharmaceutical Marketing');
        $response->assertSee('line-through', false);
        $response->assertSee('Free');
        // Payment options must be completely hidden
        $response->assertDontSee('Official bKash / Nagad Account');
        $response->assertDontSee('bKash / Nagad Sender Mobile Number');
        $response->assertDontSee('DBBL Account Number (A/C)');
        $response->assertSee('Complimentary Free Admission');
    }

    public function test_can_register_for_free_when_toggle_is_off(): void
    {
        SiteSetting::set('module_price_enabled', '0');

        $email = 'free.' . uniqid() . '@example.com';

        $response = $this->post('/seminars/book', [
            'modules' => ['1'],
            'full_name' => 'Tasnim Ahmed',
            'email' => $email,
            'phone' => '01711223344',
            'organization' => 'University of Dhaka',
            'designation' => '4th Year B.Pharm',
            'terms_agreed' => '1',
        ]);

        $response->assertRedirect();

        $registration = SeminarRegistration::where('email', $email)->first();
        $this->assertNotNull($registration);
        $this->assertEquals(1, $registration->seminar_id);
        $this->assertEquals('0.00', $registration->amount_payable);
        $this->assertEquals('Free Admission', $registration->payment_method);
        $this->assertEquals('verified', $registration->payment_status);
        $this->assertEquals('confirmed', $registration->registration_status);
    }

    public function test_seminars_book_page_displays_price_and_payment_options_when_toggle_is_on(): void
    {
        SiteSetting::set('module_price_enabled', '1');

        $response = $this->get('/seminars/book');
        $response->assertStatus(200);
        $response->assertSee('Book Seminars Seat');
        $response->assertSee('Module 1: Career in Pharmaceutical Industrial Operations');
        $response->assertSee('Module 2: Career in Pharmaceutical Marketing');
        $response->assertSee('Friday');
        $response->assertSee('Saturday');
        $response->assertSee('৳1,000');
        $response->assertSee('bKash');
        $response->assertSee('Nagad');
        $response->assertSee('01722531335');
        $response->assertSee('Md. Abul Bashar');
        $response->assertSee('1221030213784');
        $response->assertSee('DEPZ Branch');
        $response->assertSee('DBBL');
    }

    public function test_booking_create_redirects_to_seminars_book(): void
    {
        $response = $this->get('/booking/create');
        $response->assertRedirect('/seminars/book');
    }

    public function test_can_book_single_module_with_bkash_payment_when_on(): void
    {
        SiteSetting::set('module_price_enabled', '1');
        $trxId = 'TEST' . strtoupper(substr(md5(uniqid()), 0, 6));

        $response = $this->post('/seminars/book', [
            'modules' => ['1'],
            'full_name' => 'Dr. Sadia Islam',
            'email' => 'sadia.' . uniqid() . '@example.com',
            'phone' => '01711998877',
            'organization' => 'Square Pharmaceuticals Ltd.',
            'designation' => 'Executive, QA',
            'sender_number' => '01711998877',
            'transaction_id' => $trxId,
            'terms_agreed' => '1',
        ]);

        $response->assertRedirect();
        
        $registration = SeminarRegistration::where('transaction_id', $trxId)->first();
        $this->assertNotNull($registration);
        $this->assertEquals(1, $registration->seminar_id);
        $this->assertEquals('1000.00', $registration->amount_payable);
        $this->assertEquals('01711998877', $registration->sender_number);
        $this->assertEquals('pending_verification', $registration->registration_status);
    }

    public function test_can_book_both_modules_with_bkash_payment_when_on(): void
    {
        SiteSetting::set('module_price_enabled', '1');
        $trxId = 'DUAL' . strtoupper(substr(md5(uniqid()), 0, 6));
        $email = 'dual.' . uniqid() . '@example.com';

        $response = $this->post('/seminars/book', [
            'modules' => ['1', '2'],
            'full_name' => 'Fahim Rahman',
            'email' => $email,
            'phone' => '01811223344',
            'organization' => 'Beximco Pharma',
            'designation' => 'Brand Executive',
            'sender_number' => '01811223344',
            'transaction_id' => $trxId,
            'terms_agreed' => '1',
        ]);

        $response->assertRedirect();

        $registrations = SeminarRegistration::where('transaction_id', $trxId)->get();
        $this->assertCount(2, $registrations);

        $moduleIds = $registrations->pluck('seminar_id')->toArray();
        $this->assertContains(1, $moduleIds);
        $this->assertContains(2, $moduleIds);

        foreach ($registrations as $reg) {
            $this->assertEquals('1000.00', $reg->amount_payable);
            $this->assertEquals('01811223344', $reg->sender_number);
            $this->assertEquals('pending_verification', $reg->registration_status);
        }
    }

    public function test_can_book_module_with_dbbl_bank_transfer_when_on(): void
    {
        SiteSetting::set('module_price_enabled', '1');
        $slipRef = 'DBBL-DEPZ-' . strtoupper(substr(md5(uniqid()), 0, 8));
        $email = 'bank.' . uniqid() . '@example.com';

        $response = $this->post('/seminars/book', [
            'modules' => ['1'],
            'full_name' => 'Md. Tariqul Islam',
            'email' => $email,
            'phone' => '01799887766',
            'organization' => 'Incepta Pharmaceuticals',
            'designation' => 'Officer, Production',
            'payment_method' => 'Bank Transfer (DBBL)',
            'sender_number' => 'Md. Tariqul Islam (DBBL A/C: 110.120.9876)',
            'transaction_id' => $slipRef,
            'terms_agreed' => '1',
        ]);

        $response->assertRedirect();

        $registration = SeminarRegistration::where('transaction_id', $slipRef)->first();
        $this->assertNotNull($registration);
        $this->assertEquals(1, $registration->seminar_id);
        $this->assertEquals('1000.00', $registration->amount_payable);
        $this->assertEquals('Bank Transfer (DBBL)', $registration->payment_method);
        $this->assertEquals('Md. Tariqul Islam (DBBL A/C: 110.120.9876)', $registration->sender_number);
        $this->assertEquals('pending_verification', $registration->registration_status);
    }

    public function test_admin_can_toggle_module_pricing(): void
    {
        $admin = User::where('role', 'admin')->first() ?? User::factory()->create(['role' => 'admin']);

        SiteSetting::set('module_price_enabled', '0');
        $this->actingAs($admin)->post('/admin/seminars/toggle-pricing');
        $this->assertEquals('1', SiteSetting::get('module_price_enabled'));

        $this->actingAs($admin)->post('/admin/seminars/toggle-pricing');
        $this->assertEquals('0', SiteSetting::get('module_price_enabled'));
    }

    public function test_admin_can_send_meeting_link_to_registered_candidates(): void
    {
        \Illuminate\Support\Facades\Mail::fake();

        $admin = User::where('role', 'admin')->first() ?? User::factory()->create(['role' => 'admin']);

        $email = 'attendee.' . uniqid() . '@example.com';
        SeminarRegistration::create([
            'seminar_id' => 1,
            'registration_reference' => 'TEST-' . uniqid(),
            'name' => 'Candidate Test',
            'email' => $email,
            'phone' => '01700000000',
            'amount_payable' => 0,
            'transaction_id' => 'FREE-' . uniqid(),
            'payment_status' => 'verified',
            'registration_status' => 'confirmed',
        ]);

        $response = $this->actingAs($admin)->post('/admin/seminars/send-meeting-link', [
            'meeting_link' => 'https://meet.google.com/abc-defg-hij',
            'target' => 'all',
            'session_time' => '7:30 PM BST',
            'custom_note' => 'Please join 5 mins early.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\SeminarMeetingLinkMail::class, function ($mail) use ($email) {
            return $mail->hasTo($email) && $mail->meetingLink === 'https://meet.google.com/abc-defg-hij';
        });

        $this->assertEquals('https://meet.google.com/abc-defg-hij', SiteSetting::get('last_seminar_meeting_link'));
    }
}

