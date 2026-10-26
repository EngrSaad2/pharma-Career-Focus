<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no" />
    <title>New Contact Message Received</title>
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
            .email-outer {
                padding: 10px 8px !important;
            }
            .email-card {
                width: 100% !important;
                max-width: 100% !important;
                border-radius: 8px !important;
            }
            .header-cell {
                padding: 22px 16px !important;
            }
            .header-title {
                font-size: 19px !important;
                line-height: 24px !important;
            }
            .body-cell {
                padding: 20px 14px !important;
            }
            .footer-cell {
                padding: 16px 14px !important;
            }
            .col-label {
                width: 38% !important;
                font-size: 13px !important;
                padding: 8px 6px 8px 0 !important;
            }
            .col-value {
                width: 62% !important;
                font-size: 13px !important;
                padding: 8px 0 !important;
            }
            .btn-action {
                display: block !important;
                width: 100% !important;
                box-sizing: border-box !important;
                text-align: center !important;
                padding: 13px 16px !important;
                margin-right: 0 !important;
                margin-bottom: 8px !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; width: 100% !important; min-width: 100%; background-color: #f1f5f9; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b;">
    <table role="presentation" width="100%" border="0" cellpadding="0" cellspacing="0" class="email-outer" style="background-color: #f1f5f9; margin: 0 auto; padding: 24px 12px; width: 100% !important; table-layout: fixed;">
        <tr>
            <td align="center" valign="top">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="email-card" style="width: 100%; max-width: 600px; background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); table-layout: fixed; word-wrap: break-word; word-break: break-word;">
                    <!-- Header -->
                    <tr>
                        <td class="header-cell" style="background: #00245A; background: linear-gradient(135deg, #00245A 0%, #0085FF 100%); padding: 28px 30px; color: #ffffff;">
                            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; color: #FFCD00; margin-bottom: 6px;">
                                Pharma Career Compass • Inquiry Alert
                            </div>
                            <h1 class="header-title" style="margin: 0; font-size: 21px; font-weight: 800; color: #ffffff; line-height: 1.3;">
                                💬 New Contact Form Inquiry
                            </h1>
                            <p style="margin: 6px 0 0; font-size: 13px; color: #e2e8f0; line-height: 1.4;">
                                A candidate or visitor submitted a new message through the contact page.
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td class="body-cell" style="padding: 26px 28px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width: 100%; table-layout: fixed; font-size: 14px; line-height: 1.6;">
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top; word-break: break-word;">From Name</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #00245A; width: 64%; font-weight: 700; vertical-align: top; word-break: break-word;">{{ $contactMessage->name }}</td>
                                </tr>
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top; word-break: break-word;">Email Address</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; width: 64%; vertical-align: top; word-break: break-word; overflow-wrap: anywhere;">
                                        <a href="mailto:{{ $contactMessage->email }}" style="color: #0085FF; text-decoration: none; font-weight: 600;">{{ $contactMessage->email }}</a>
                                    </td>
                                </tr>
                                @if($contactMessage->phone)
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top; word-break: break-word;">Phone Number</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; width: 64%; vertical-align: top; word-break: break-word;">{{ $contactMessage->phone }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top; word-break: break-word;">Subject</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; width: 64%; font-weight: 700; vertical-align: top; word-break: break-word;">{{ $contactMessage->subject }}</td>
                                </tr>
                                <tr>
                                    <td class="col-label" style="padding: 10px 8px 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600; vertical-align: top; word-break: break-word;">Received At</td>
                                    <td class="col-value" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; width: 64%; vertical-align: top; word-break: break-word;">{{ $contactMessage->created_at->format('M d, Y h:i A') }} (UTC)</td>
                                </tr>
                            </table>

                            <!-- Message Box -->
                            <div style="margin-top: 20px; background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #0085FF; padding: 16px 18px; border-radius: 6px; word-break: break-word; overflow-wrap: break-word;">
                                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; margin-bottom: 8px; letter-spacing: 0.5px;">Message Content:</div>
                                <div style="font-size: 14px; line-height: 1.65; color: #1e293b; white-space: pre-wrap;">{{ $contactMessage->message }}</div>
                            </div>

                            <!-- Action Buttons -->
                            <div style="margin-top: 26px; text-align: center;">
                                <a href="mailto:{{ $contactMessage->email }}?subject={{ rawurlencode('Re: ' . $contactMessage->subject) }}" class="btn-action" style="display: inline-block; background-color: #0085FF; color: #ffffff; font-weight: 700; font-size: 13px; padding: 12px 22px; border-radius: 8px; text-decoration: none; margin-right: 6px;">
                                    Reply to {{ $contactMessage->name }} ✉
                                </a>
                                <a href="{{ route('admin.messages') }}" class="btn-action" style="display: inline-block; background-color: #00245A; color: #ffffff; font-weight: 700; font-size: 13px; padding: 12px 22px; border-radius: 8px; text-decoration: none;">
                                    View in Admin Panel →
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer-cell" style="background-color: #f8fafc; padding: 16px 24px; border-top: 1px solid #e2e8f0; font-size: 11px; color: #94a3b8; text-align: center; line-height: 1.5;">
                            Sent automatically by Pharma Career Compass to administrators.<br>
                            Site: <a href="{{ url('/') }}" style="color: #64748b; text-decoration: underline;">https://pharmacareercompass.com</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
