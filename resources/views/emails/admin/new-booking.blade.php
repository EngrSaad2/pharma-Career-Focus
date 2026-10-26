<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Consultation Booking</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 24px; color: #1e293b;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #00245A 0%, #0085FF 100%); padding: 28px 32px; color: #ffffff;">
                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; color: #FFCD00; margin-bottom: 6px;">
                    Pharma Career Compass • Booking Alert
                </div>
                <h1 style="margin: 0; font-size: 22px; font-weight: 800; color: #ffffff;">
                    📅 New Consultation Booking #{{ $booking->id }}
                </h1>
                <p style="margin: 6px 0 0; font-size: 13px; color: #e2e8f0;">
                    A candidate has scheduled and confirmed a pharmaceutical mentorship session.
                </p>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding: 32px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 14px; line-height: 1.6;">
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 140px; font-weight: 600;">Service Package</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #00245A; font-weight: 800; font-size: 15px;">
                            {{ $booking->service->title ?? 'Consultation Session' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Assigned Mentor</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; font-weight: 700;">
                            {{ $booking->consultant->name ?? 'Senior Industry Consultant' }}
                            @if(!empty($booking->consultant->current_role))
                                <span style="font-size: 12px; color: #64748b; font-weight: normal;">({{ $booking->consultant->current_role }})</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Scheduled Time</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #0085FF; font-weight: 700;">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('l, F j, Y') }}<br>
                            <span style="font-size: 13px; color: #00245A;">
                                {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Package Fee</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; font-weight: 700;">
                            ৳{{ number_format($booking->service->price ?? 800, 0) }} BDT
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Candidate Name</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; font-weight: 700;">{{ $booking->client_name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Candidate Email</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
                            <a href="mailto:{{ $booking->client_email }}" style="color: #0085FF; text-decoration: none; font-weight: 600;">{{ $booking->client_email }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Candidate Phone</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b;">{{ $booking->client_phone }}</td>
                    </tr>
                    @if($booking->current_qualification)
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Qualification</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b;">{{ $booking->current_qualification }}</td>
                    </tr>
                    @endif
                    @if($booking->target_goal)
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Target Goal</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b;">{{ $booking->target_goal }}</td>
                    </tr>
                    @endif
                    @if($booking->notes)
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Notes / Focus</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; font-style: italic;">"{{ $booking->notes }}"</td>
                    </tr>
                    @endif
                    @if($booking->meeting_link)
                    <tr>
                        <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Video Meeting Link</td>
                        <td style="padding: 10px 0;">
                            <a href="{{ $booking->meeting_link }}" target="_blank" style="color: #0085FF; font-weight: 700; text-decoration: underline; word-break: break-all;">
                                {{ $booking->meeting_link }}
                            </a>
                        </td>
                    </tr>
                    @endif
                </table>

                <!-- Action Button -->
                <div style="margin-top: 28px; text-align: center;">
                    <a href="{{ route('admin.bookings') }}" style="display: inline-block; background-color: #00245A; color: #ffffff; font-weight: 700; font-size: 13px; padding: 12px 28px; border-radius: 8px; text-decoration: none; letter-spacing: 0.5px;">
                        Manage Bookings in Admin Panel →
                    </a>
                </div>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #f8fafc; padding: 18px 32px; border-top: 1px solid #e2e8f0; font-size: 11px; color: #94a3b8; text-align: center;">
                Sent automatically by Pharma Career Compass system to platform administrators.<br>
                Site: <a href="{{ url('/') }}" style="color: #64748b; text-decoration: underline;">https://pharmacareercompass.com</a>
            </td>
        </tr>
    </table>
</body>
</html>
