<?php

namespace Tests\Feature;

use App\Models\Seminar;
use App\Models\SeminarRegistration;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function test_seminars_book_page_displays_two_modules_with_friday_and_saturday_dates(): void
    {
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

    public function test_can_book_single_module_with_bkash_payment(): void
    {
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

    public function test_can_book_both_modules_with_bkash_payment(): void
    {
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

    public function test_can_book_module_with_dbbl_bank_transfer(): void
    {
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
}

