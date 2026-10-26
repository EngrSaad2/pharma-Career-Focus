<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Message Received</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 24px; color: #1e293b;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #00245A 0%, #0085FF 100%); padding: 28px 32px; color: #ffffff;">
                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; color: #FFCD00; margin-bottom: 6px;">
                    Pharma Career Compass • Inquiry Alert
                </div>
                <h1 style="margin: 0; font-size: 22px; font-weight: 800; color: #ffffff;">
                    💬 New Contact Form Inquiry
                </h1>
                <p style="margin: 6px 0 0; font-size: 13px; color: #e2e8f0;">
                    A candidate or visitor submitted a new message through the contact page.
                </p>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding: 32px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 14px; line-height: 1.6;">
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 140px; font-weight: 600;">From Name</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #00245A; font-weight: 700;">{{ $contactMessage->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Email Address</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
                            <a href="mailto:{{ $contactMessage->email }}" style="color: #0085FF; text-decoration: none; font-weight: 600;">{{ $contactMessage->email }}</a>
                        </td>
                    </tr>
                    @if($contactMessage->phone)
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Phone Number</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b;">{{ $contactMessage->phone }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Subject</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; font-weight: 700;">{{ $contactMessage->subject }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Received At</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b;">{{ $contactMessage->created_at->format('M d, Y h:i A') }} (UTC)</td>
                    </tr>
                </table>

                <!-- Message Box -->
                <div style="margin-top: 20px; background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #0085FF; padding: 18px 20px; border-radius: 6px;">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; margin-bottom: 8px;">Message Content:</div>
                    <div style="font-size: 14px; line-height: 1.65; color: #1e293b; white-space: pre-wrap;">{{ $contactMessage->message }}</div>
                </div>

                <!-- Action Buttons -->
                <div style="margin-top: 28px; text-align: center; display: flex; gap: 12px; justify-content: center;">
                    <a href="mailto:{{ $contactMessage->email }}?subject={{ rawurlencode('Re: ' . $contactMessage->subject) }}" style="display: inline-block; background-color: #0085FF; color: #ffffff; font-weight: 700; font-size: 13px; padding: 12px 24px; border-radius: 8px; text-decoration: none; margin-right: 8px;">
                        Reply to {{ $contactMessage->name }} ✉
                    </a>
                    <a href="{{ route('admin.messages') }}" style="display: inline-block; background-color: #00245A; color: #ffffff; font-weight: 700; font-size: 13px; padding: 12px 24px; border-radius: 8px; text-decoration: none;">
                        View in Admin Panel →
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
