<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <title>Registration Confirmed - {{ $seminar->title }}</title>
    <!--[if mso]>
    <style type="text/css">
        body, table, td { font-family: Arial, Helvetica, sans-serif !important; }
    </style>
    <![endif]-->
    <style type="text/css">
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { margin: 0 !important; padding: 0 !important; width: 100% !important; min-width: 100% !important; }

        @media only screen and (max-width: 600px) {
            .email-outer { padding: 10px 8px !important; }
            .email-card { width: 100% !important; max-width: 100% !important; border-radius: 8px !important; }
            .header-cell { padding: 22px 16px !important; }
            .header-title { font-size: 19px !important; line-height: 24px !important; }
            .body-cell { padding: 20px 14px !important; }
            .footer-cell { padding: 16px 14px !important; }
            .col-label { width: 38% !important; font-size: 13px !important; }
            .col-value { width: 62% !important; font-size: 13px !important; }
            .btn-action { display: block !important; width: 100% !important; text-align: center !important; }
            .info-box { padding: 14px 12px !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; width: 100% !important; min-width: 100%; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b;">
    <table role="presentation" width="100%" border="0" cellpadding="0" cellspacing="0" class="email-outer" style="background-color: #f1f5f9; margin: 0 auto; padding: 24px 12px; width: 100% !important; table-layout: fixed;">
        <tr>
            <td align="center" valign="top">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="email-card" style="width: 100%; max-width: 600px; background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); table-layout: fixed; word-wrap: break-word;">
                    
                    <!-- Header -->
                    <tr>
                        <td class="header-cell" style="background: linear-gradient(135deg, #059669 0%, #0085FF 100%); padding: 28px 30px; color: #ffffff;">
                            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; color: #FFCD00; margin-bottom: 6px;">
                                Pharma Career Compass • Registration Confirmed
                            </div>
                            <h1 class="header-title" style="margin: 0; font-size: 21px; font-weight: 800; color: #ffffff; line-height: 1.3;">
                                ✓ Payment Verified & Seat Confirmed!
                            </h1>
                            <p style="margin: 6px 0 0; font-size: 13px; color: #ecfdf5; line-height: 1.4;">
                                Reference: <strong>{{ $registration->registration_reference }}</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Verified Status Pill -->
                    <tr>
                        <td style="background-color: #f0fdf4; border-bottom: 1px solid #bbf7d0; padding: 14px 28px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="vertical-align: top; width: 24px; font-size: 16px;">🎉</td>
                                    <td style="font-size: 13px; color: #166534; line-height: 1.5; padding-left: 8px;">
                                        <strong>Payment Verified:</strong> Your registration fee of <strong>৳{{ number_format($registration->verified_amount ?: $registration->registration_fee, 2) }} BDT</strong> has been successfully verified. Your seat is officially reserved.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td class="body-cell" style="padding: 26px 28px;">
                            <p style="margin: 0 0 16px; font-size: 14px; line-height: 1.6; color: #334155;">
                                Dear <strong>{{ $registration->full_name }}</strong>,
                            </p>
                            <p style="margin: 0 0 20px; font-size: 14px; line-height: 1.6; color: #334155;">
                                We are delighted to confirm your participation in <strong>{{ $seminar->title }}</strong>. Below you will find your session schedule, speaker info, and participation access details.
                            </p>

                            <!-- Seminar & Session Summary -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width: 100%; table-layout: fixed; font-size: 14px; line-height: 1.6; margin-bottom: 24px;">
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top;">Program</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #00245A; width: 64%; font-weight: 800; font-size: 15px; vertical-align: top;">
                                        {{ $seminar->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top;">Session Date</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #0085FF; width: 64%; font-weight: 700; vertical-align: top;">
                                        {{ $seminar->event_date ? $seminar->event_date->format('l, F j, Y') : 'Scheduled' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top;">Session Time</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #00245A; width: 64%; font-weight: 700; vertical-align: top;">
                                        {{ $seminar->start_time ? \Carbon\Carbon::parse($seminar->start_time)->format('h:i A') : '' }}
                                        @if($seminar->end_time) - {{ \Carbon\Carbon::parse($seminar->end_time)->format('h:i A') }} @endif (BST)
                                    </td>
                                </tr>
                                @if($seminar->speaker_name)
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top;">Lead Speaker</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; width: 64%; font-weight: 700; vertical-align: top;">
                                        {{ $seminar->speaker_name }}
                                        @if($seminar->speaker_designation)
                                            <span style="font-size: 12px; color: #64748b; font-weight: normal; display: block;">{{ $seminar->speaker_designation }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top;">Participation Mode</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; width: 64%; font-weight: 700; vertical-align: top;">
                                        <span style="display: inline-block; padding: 3px 10px; border-radius: 9999px; font-size: 12px; font-weight: 700; background: {{ $registration->participation_type === 'online' ? '#e0f2fe' : '#fef3c7' }}; color: {{ $registration->participation_type === 'online' ? '#0369a1' : '#b45309' }};">
                                            {{ strtoupper($registration->participation_type) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            {{-- DYNAMIC PARTICIPATION INSTRUCTIONS --}}
                            @if($registration->participation_type === 'online')
                                <!-- ONLINE JOINING INSTRUCTIONS -->
                                <div class="info-box" style="background-color: #f0f9ff; border: 1px solid #bae6fd; border-radius: 10px; padding: 20px; margin-bottom: 24px;">
                                    <div style="font-size: 15px; font-weight: 800; color: #0369a1; margin-bottom: 8px;">
                                        🌐 Online Joining Credentials
                                    </div>
                                    @if($seminar->meeting_url)
                                        <div style="margin-bottom: 14px;">
                                            <a href="{{ $seminar->meeting_url }}" target="_blank" class="btn-action" style="background-color: #0284c7; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 14px; display: inline-block;">
                                                🔗 Click Here to Join Meeting
                                            </a>
                                        </div>
                                        <div style="font-size: 12px; color: #475569; word-break: break-all; margin-bottom: 12px;">
                                            Direct URL: <a href="{{ $seminar->meeting_url }}" style="color: #0284c7;">{{ $seminar->meeting_url }}</a>
                                        </div>
                                    @else
                                        <div style="font-size: 13px; color: #0284c7; font-weight: 600; margin-bottom: 12px;">
                                            The interactive live meeting link will be emailed to you 2 hours prior to session start.
                                        </div>
                                    @endif

                                    @if($seminar->joining_instructions)
                                        <div style="font-size: 13px; color: #0f172a; line-height: 1.6; padding-top: 10px; border-top: 1px dashed #bae6fd;">
                                            <strong>Joining Guidelines:</strong><br>
                                            {!! nl2br(e($seminar->joining_instructions)) !!}
                                        </div>
                                    @else
                                        <div style="font-size: 12px; color: #64748b; line-height: 1.5;">
                                            • Please join 10 minutes before the scheduled start time.<br>
                                            • Keep your microphone muted during presentations; use chat or raise hand for Q&A.<br>
                                            • Ensure a stable internet connection for high-quality audio and video.
                                        </div>
                                    @endif
                                </div>
                            @else
                                <!-- OFFLINE / VENUE INSTRUCTIONS -->
                                <div class="info-box" style="background-color: #fefce8; border: 1px solid #fef08a; border-radius: 10px; padding: 20px; margin-bottom: 24px;">
                                    <div style="font-size: 15px; font-weight: 800; color: #854d0e; margin-bottom: 8px;">
                                        📍 Venue & Attendance Details
                                    </div>
                                    <div style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">
                                        Venue Address:
                                    </div>
                                    <div style="font-size: 14px; color: #334155; line-height: 1.6; margin-bottom: 14px; padding: 10px; background: #ffffff; border-radius: 6px; border: 1px solid #fef08a;">
                                        {{ $seminar->venue_address ?: 'Pharma Career Compass Corporate Auditorium, Dhaka, Bangladesh' }}
                                    </div>

                                    @if($seminar->joining_instructions)
                                        <div style="font-size: 13px; color: #713f12; line-height: 1.6;">
                                            <strong>Arrival Guidelines:</strong><br>
                                            {!! nl2br(e($seminar->joining_instructions)) !!}
                                        </div>
                                    @else
                                        <div style="font-size: 12px; color: #713f12; line-height: 1.5;">
                                            • Please report to the registration desk 15 minutes prior to the start time.<br>
                                            • Show this confirmation email or your reference number <strong>{{ $registration->registration_reference }}</strong> at the check-in desk.<br>
                                            • Training materials and refreshments will be provided on site.
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if($seminar->facebook_url)
                                <div style="text-align: center; margin: 20px 0;">
                                    <a href="{{ $seminar->facebook_url }}" target="_blank" style="color: #1877f2; text-decoration: none; font-size: 13px; font-weight: 700;">
                                        📢 Follow the Official Facebook Event for Live Updates →
                                    </a>
                                </div>
                            @endif

                            <!-- Registration Receipt Button -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding: 10px 0 10px;">
                                        <a href="{{ route('seminars.confirmation', $registration->registration_reference) }}" class="btn-action" style="background-color: #00245A; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: 700; font-size: 14px; display: inline-block;">
                                            View & Print Official Participant Pass →
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer-cell" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 20px 28px; text-align: center; color: #64748b; font-size: 12px; line-height: 1.5;">
                            <div style="font-weight: 700; color: #00245A; margin-bottom: 4px;">Pharma Career Compass</div>
                            <div>Need assistance? Email <a href="mailto:hello@pharmacareercompass.com" style="color: #0085FF; text-decoration: none;">hello@pharmacareercompass.com</a> or call +880 1722 531335</div>
                            <div style="margin-top: 8px; font-size: 11px; color: #94a3b8;">
                                Participant: {{ $registration->full_name }} • Pass Ref: {{ $registration->registration_reference }}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
