<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <title>{{ $messageSubject }} - {{ $seminar->title }}</title>
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
                                Pharma Career Compass • Important Update
                            </div>
                            <h1 class="header-title" style="margin: 0; font-size: 21px; font-weight: 800; color: #ffffff; line-height: 1.3;">
                                {{ $messageSubject }}
                            </h1>
                            <p style="margin: 6px 0 0; font-size: 13px; color: #e2e8f0; line-height: 1.4;">
                                Program: {{ $seminar->title }}
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td class="body-cell" style="padding: 26px 28px;">
                            <p style="margin: 0 0 16px; font-size: 14px; line-height: 1.6; color: #334155;">
                                Dear <strong>{{ $registration->full_name }}</strong>,
                            </p>

                            <!-- Message Content Box -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 20px; margin-bottom: 24px; font-size: 14px; color: #1e293b; line-height: 1.7;">
                                {!! nl2br(e($messageContent)) !!}
                            </div>

                            <!-- Current Program Reference Snapshot -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width: 100%; table-layout: fixed; font-size: 13px; line-height: 1.5; margin-bottom: 24px; background: #f1f5f9; border-radius: 8px; padding: 12px 16px;">
                                <tr>
                                    <td style="padding: 4px 0; color: #64748b; width: 35%;">Your Reference:</td>
                                    <td style="padding: 4px 0; color: #00245A; font-weight: 700; font-family: monospace;">{{ $registration->registration_reference }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 4px 0; color: #64748b;">Scheduled Date:</td>
                                    <td style="padding: 4px 0; color: #0085FF; font-weight: 700;">{{ $seminar->event_date ? $seminar->event_date->format('l, F j, Y') : 'TBA' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 4px 0; color: #64748b;">Scheduled Time:</td>
                                    <td style="padding: 4px 0; color: #1e293b; font-weight: 700;">
                                        {{ $seminar->start_time ? \Carbon\Carbon::parse($seminar->start_time)->format('h:i A') : '' }}
                                        @if($seminar->end_time) - {{ \Carbon\Carbon::parse($seminar->end_time)->format('h:i A') }} @endif
                                    </td>
                                </tr>
                                @if($registration->participation_type === 'online' && $seminar->meeting_url)
                                <tr>
                                    <td style="padding: 4px 0; color: #64748b;">Meeting URL:</td>
                                    <td style="padding: 4px 0; color: #0085FF; font-weight: 700; word-break: break-all;">
                                        <a href="{{ $seminar->meeting_url }}" style="color: #0085FF;">{{ $seminar->meeting_url }}</a>
                                    </td>
                                </tr>
                                @elseif($registration->participation_type === 'offline' && $seminar->venue_address)
                                <tr>
                                    <td style="padding: 4px 0; color: #64748b;">Venue:</td>
                                    <td style="padding: 4px 0; color: #1e293b; font-weight: 700;">{{ $seminar->venue_address }}</td>
                                </tr>
                                @endif
                            </table>

                            <!-- Live Pass Button -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding: 8px 0 16px;">
                                        <a href="{{ route('seminars.confirmation', $registration->registration_reference) }}" class="btn-action" style="background-color: #0085FF; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: 700; font-size: 14px; display: inline-block;">
                                            View Updated Session Details →
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
                            <div>Questions? Contact <a href="mailto:hello@pharmacareercompass.com" style="color: #0085FF; text-decoration: none;">hello@pharmacareercompass.com</a></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
