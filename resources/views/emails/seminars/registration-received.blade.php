<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <title>Registration Received - {{ $seminar->title }}</title>
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
                        <td class="header-cell" style="background: linear-gradient(135deg, #00245A 0%, #0085FF 100%); padding: 28px 30px; color: #ffffff;">
                            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; color: #FFCD00; margin-bottom: 6px;">
                                Pharma Career Compass • Seminar Registration
                            </div>
                            <h1 class="header-title" style="margin: 0; font-size: 21px; font-weight: 800; color: #ffffff; line-height: 1.3;">
                                Registration Received
                            </h1>
                            <p style="margin: 6px 0 0; font-size: 13px; color: #e2e8f0; line-height: 1.4;">
                                Reference: <strong>{{ $registration->registration_reference }}</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Alert Banner -->
                    <tr>
                        <td style="background-color: #fffbeb; border-bottom: 1px solid #fef3c7; padding: 14px 28px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="vertical-align: top; width: 24px; font-size: 16px;">⏳</td>
                                    <td style="font-size: 13px; color: #92400e; line-height: 1.5; padding-left: 8px;">
                                        <strong>Payment Verification Pending:</strong> Your registration has been logged and is awaiting administrative verification of your payment transaction. Your seat is confirmed only after verification.
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
                                Thank you for registering for the upcoming pharmaceutical training session. Here are the details of your submission:
                            </p>

                            <!-- Registration Details Table -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width: 100%; table-layout: fixed; font-size: 14px; line-height: 1.6; margin-bottom: 24px;">
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top;">Seminar Title</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #00245A; width: 64%; font-weight: 800; font-size: 15px; vertical-align: top;">
                                        {{ $seminar->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top;">Date & Time</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #0085FF; width: 64%; font-weight: 700; vertical-align: top;">
                                        {{ $seminar->event_date ? $seminar->event_date->format('l, F j, Y') : 'TBA' }}<br>
                                        <span style="font-size: 13px; color: #00245A; font-weight: 600;">
                                            {{ $seminar->start_time ? \Carbon\Carbon::parse($seminar->start_time)->format('h:i A') : '' }}
                                            @if($seminar->end_time) - {{ \Carbon\Carbon::parse($seminar->end_time)->format('h:i A') }} @endif
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top;">Participation Mode</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; width: 64%; font-weight: 700; vertical-align: top;">
                                        <span style="display: inline-block; padding: 3px 10px; border-radius: 9999px; font-size: 12px; font-weight: 700; background: {{ $registration->participation_type === 'online' ? '#e0f2fe' : '#fef3c7' }}; color: {{ $registration->participation_type === 'online' ? '#0369a1' : '#b45309' }};">
                                            {{ strtoupper($registration->participation_type) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top;">Registration Fee</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; width: 64%; font-weight: 700; vertical-align: top;">
                                        ৳{{ number_format($registration->registration_fee, 2) }} BDT
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top;">Transaction ID</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #0f172a; width: 64%; font-weight: 700; font-family: monospace; font-size: 14px; vertical-align: top;">
                                        {{ $registration->transaction_id ?: 'Not provided' }}
                                    </td>
                                </tr>
                                @if($registration->organization)
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top;">Organization</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; width: 64%; vertical-align: top;">
                                        {{ $registration->organization }} @if($registration->designation) ({{ $registration->designation }}) @endif
                                    </td>
                                </tr>
                                @endif
                            </table>

                            <!-- Payment Verification Notice -->
                            <div style="background-color: #f8fafc; border-left: 4px solid #0085FF; padding: 14px 16px; border-radius: 4px; margin-bottom: 24px;">
                                <div style="font-weight: 700; color: #00245A; font-size: 13px; margin-bottom: 4px;">What happens next?</div>
                                <div style="font-size: 13px; color: #475569; line-height: 1.5;">
                                    Our administrative team will verify your transaction ID against our bKash account records. Upon verification, you will receive an official <strong>Confirmation Email</strong> with your complete joining credentials (meeting link for online or venue directions for offline).
                                </div>
                            </div>

                            <!-- View Registration Link -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding: 10px 0 20px;">
                                        <a href="{{ route('seminars.confirmation', $registration->registration_reference) }}" class="btn-action" style="background-color: #0085FF; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: 700; font-size: 14px; display: inline-block;">
                                            Check Live Registration Status →
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0; font-size: 12px; color: #64748b; line-height: 1.5;">
                                If you did not submit a transaction ID or need to make corrections, please reply to this email or contact us at <a href="mailto:hello@pharmacareercompass.com" style="color: #0085FF; text-decoration: none;">hello@pharmacareercompass.com</a>.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer-cell" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 20px 28px; text-align: center; color: #64748b; font-size: 12px; line-height: 1.5;">
                            <div style="font-weight: 700; color: #00245A; margin-bottom: 4px;">Pharma Career Compass</div>
                            <div>Empowering Pharmaceutical Professionals across Bangladesh & Worldwide</div>
                            <div style="margin-top: 8px; font-size: 11px; color: #94a3b8;">
                                Reference: {{ $registration->registration_reference }} • Automated Confirmation System
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
