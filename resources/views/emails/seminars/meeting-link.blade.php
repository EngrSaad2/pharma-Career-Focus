<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <title>Live Session Meeting Link - Pharma Career Compass</title>
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
        body { margin: 0 !important; padding: 0 !important; width: 100% !important; min-width: 100% !important; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; }

        .btn-meet:hover { background-color: #0070d9 !important; }

        @media only screen and (max-width: 600px) {
            .email-outer { padding: 12px 8px !important; }
            .email-card { width: 100% !important; max-width: 100% !important; border-radius: 12px !important; }
            .header-cell { padding: 26px 18px !important; }
            .header-title { font-size: 20px !important; line-height: 26px !important; }
            .body-cell { padding: 22px 16px !important; }
            .meet-box { padding: 18px 14px !important; }
            .btn-meet { display: block !important; width: 100% !important; padding: 16px 12px !important; text-align: center !important; box-sizing: border-box !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9;">

    <table role="presentation" width="100%" border="0" cellpadding="0" cellspacing="0" class="email-outer" style="background-color: #f1f5f9; margin: 0 auto; padding: 32px 12px; width: 100% !important; table-layout: fixed;">
        <tr>
            <td align="center" valign="top">
                
                {{-- Main Card --}}
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="email-card" style="width: 100%; max-width: 620px; background-color: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08); table-layout: fixed; word-wrap: break-word;">
                    
                    {{-- Header Top Banner --}}
                    <tr>
                        <td class="header-cell" style="background: linear-gradient(135deg, #00245A 0%, #004B99 50%, #0085FF 100%); padding: 32px 32px 28px; color: #ffffff; text-align: left;">
                            <table role="presentation" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <div style="display: inline-block; background-color: #FFCD00; color: #00245A; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; padding: 4px 12px; rounded-full; border-radius: 9999px; margin-bottom: 12px;">
                                            🔴 Live Session Coordinates
                                        </div>
                                        <h1 class="header-title" style="margin: 0; font-size: 24px; font-weight: 900; color: #ffffff; line-height: 1.25; letter-spacing: -0.5px;">
                                            Your Live Meeting Link is Ready!
                                        </h1>
                                        <p style="margin: 8px 0 0; font-size: 14px; color: #dbeafe; line-height: 1.4;">
                                            {{ $targetTitle }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Body Content --}}
                    <tr>
                        <td class="body-cell" style="padding: 30px 32px; text-align: left;">
                            
                            {{-- Candidate Greeting --}}
                            <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.6; color: #1e293b;">
                                Dear <strong>{{ $registration->full_name }}</strong>,
                            </p>
                            <p style="margin: 0 0 24px; font-size: 14px; line-height: 1.6; color: #475569;">
                                We are excited to welcome you to the live cohort session! Below are your official online meeting credentials. Please save this email and join on time.
                            </p>

                            {{-- Google Meet Callout Box --}}
                            <div class="meet-box" style="background: linear-gradient(180deg, #f0fdf4 0%, #ecfdf5 100%); border: 2px solid #86efac; border-radius: 14px; padding: 24px 20px; text-align: center; margin-bottom: 26px;">
                                <div style="display: inline-block; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #047857; margin-bottom: 8px;">
                                    🟢 Online Live Room (Google Meet / Web)
                                </div>
                                <h3 style="margin: 0 0 16px; font-size: 18px; font-weight: 900; color: #064e3b;">
                                    Click Below to Join Session
                                </h3>

                                {{-- Primary Join Button --}}
                                <div style="margin: 18px 0 14px;">
                                    <a href="{{ $meetingLink }}" 
                                       target="_blank" 
                                       class="btn-meet" 
                                       style="background-color: #0085FF; color: #ffffff; padding: 15px 36px; border-radius: 12px; font-weight: 900; font-size: 16px; text-decoration: none; display: inline-block; box-shadow: 0 4px 14px rgba(0, 133, 255, 0.35); letter-spacing: 0.3px;">
                                        👉 Click Here to Join Live Session 👈
                                    </a>
                                </div>

                                {{-- Direct URL Fallback --}}
                                <p style="margin: 16px 0 6px; font-size: 12px; color: #065f46; font-weight: 600;">
                                    Or copy & paste this direct URL into your browser:
                                </p>
                                <div style="background-color: #ffffff; border: 1px dashed #6ee7b7; padding: 9px 12px; border-radius: 8px; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; font-size: 12px; color: #00245A; word-break: break-all; text-align: center; font-weight: 700;">
                                    <a href="{{ $meetingLink }}" style="color: #0085FF; text-decoration: none;">{{ $meetingLink }}</a>
                                </div>
                            </div>

                            {{-- Session Metadata Table --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width: 100%; font-size: 13px; line-height: 1.5; margin-bottom: 24px; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                                <tr>
                                    <td colspan="2" style="background-color: #00245A; color: #ffffff; padding: 10px 16px; font-weight: 800; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                                        📋 Session Details
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; color: #64748b; font-weight: 600; width: 38%; border-bottom: 1px solid #f1f5f9;">Enrolled Track:</td>
                                    <td style="padding: 10px 16px; color: #00245A; font-weight: 800; border-bottom: 1px solid #f1f5f9;">{{ $registration->seminar->title ?? 'PCDP Module' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; color: #64748b; font-weight: 600; border-bottom: 1px solid #f1f5f9;">Session Schedule:</td>
                                    <td style="padding: 10px 16px; color: #0f172a; font-weight: 700; border-bottom: 1px solid #f1f5f9;">Every Friday & Saturday</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; color: #64748b; font-weight: 600; border-bottom: 1px solid #f1f5f9;">Timing:</td>
                                    <td style="padding: 10px 16px; color: #0f172a; font-weight: 700; border-bottom: 1px solid #f1f5f9;">{{ $sessionTime }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; color: #64748b; font-weight: 600; border-bottom: 1px solid #f1f5f9;">Platform:</td>
                                    <td style="padding: 10px 16px; color: #0085FF; font-weight: 800; border-bottom: 1px solid #f1f5f9;">Google Meet Live</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 16px; color: #64748b; font-weight: 600;">Your Pass Reference:</td>
                                    <td style="padding: 10px 16px; color: #00245A; font-family: monospace; font-weight: 800; font-size: 13px;">{{ $registration->registration_reference }}</td>
                                </tr>
                            </table>

                            {{-- Custom Note from Admin (if provided) --}}
                            @if(!empty($customNote))
                                <div style="background-color: #eff6ff; border-left: 4px solid #0085FF; padding: 14px 18px; border-radius: 0 10px 10px 0; margin-bottom: 24px;">
                                    <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #0085FF; margin-bottom: 4px;">
                                        📌 Message from Instructor / Admin:
                                    </div>
                                    <div style="font-size: 13px; color: #1e3a8a; line-height: 1.6;">
                                        {!! nl2br(e($customNote)) !!}
                                    </div>
                                </div>
                            @endif

                            {{-- Checklist & Joining Guidelines --}}
                            <div style="background-color: #fcfcfc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 20px; margin-bottom: 24px;">
                                <div style="font-size: 12px; font-weight: 800; text-transform: uppercase; color: #00245A; margin-bottom: 10px; letter-spacing: 0.5px;">
                                    🎯 Important Guidelines for Attendees:
                                </div>
                                <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #475569; line-height: 1.7;">
                                    <li><strong>Join 5–10 Minutes Early:</strong> Test your audio and video before the session begins.</li>
                                    <li><strong>Audio Protocol:</strong> Please keep your microphone muted during presentation segments. You may unmute during open Q&A.</li>
                                    <li><strong>Prepare Your Questions:</strong> Bring your department questions (QA, QC, Production, Marketing, Regulatory) for direct feedback from senior industry leaders.</li>
                                    <li><strong>Stable Connection:</strong> Use Wi-Fi and earphones/headphones for clear audio delivery.</li>
                                </ul>
                            </div>

                            <p style="margin: 0; font-size: 13px; line-height: 1.6; color: #64748b;">
                                Best regards,<br />
                                <strong style="color: #00245A;">Pharma Career Compass Team</strong><br />
                                <span style="font-size: 12px; color: #94a3b8;">Empowering Aspiring Pharmacists across Bangladesh</span>
                            </p>

                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 20px 32px; font-size: 11px; color: #94a3b8; text-align: center; line-height: 1.5;">
                            <p style="margin: 0 0 6px;">
                                This official invitation was sent to <strong>{{ $registration->email }}</strong> for Pharma Career Compass Cohort Sessions.
                            </p>
                            <p style="margin: 0;">
                                Need help joining? Email us at <a href="mailto:hello@pharmacareercompass.com" style="color: #0085FF; text-decoration: none; font-weight: 600;">hello@pharmacareercompass.com</a> or visit <a href="https://pharmacareercompass.com" style="color: #0085FF; text-decoration: none; font-weight: 600;">pharmacareercompass.com</a>
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
