<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Candidate Registration</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 24px; color: #1e293b;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #00245A 0%, #0085FF 100%); padding: 28px 32px; color: #ffffff;">
                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; color: #FFCD00; margin-bottom: 6px;">
                    Pharma Career Compass • Admin Alert
                </div>
                <h1 style="margin: 0; font-size: 22px; font-weight: 800; color: #ffffff;">
                    🎓 New Candidate Registration
                </h1>
                <p style="margin: 6px 0 0; font-size: 13px; color: #e2e8f0;">
                    A new pharmacy candidate has registered an account on the platform.
                </p>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding: 32px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 14px; line-height: 1.6;">
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 140px; font-weight: 600;">Full Name</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #00245A; font-weight: 700;">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Email Address</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
                            <a href="mailto:{{ $user->email }}" style="color: #0085FF; text-decoration: none; font-weight: 600;">{{ $user->email }}</a>
                        </td>
                    </tr>
                    @if($user->phone)
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Phone Number</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b;">{{ $user->phone }}</td>
                    </tr>
                    @endif
                    @if($user->profile)
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Education Level</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b;">{{ $user->profile->education_level ?: 'Not specified' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">University / College</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b;">{{ $user->profile->university ?: 'Not specified' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Graduation Year</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b;">{{ $user->profile->graduation_year ?: 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; font-weight: 600;">Target Department</td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; color: #0085FF; font-weight: 700;">{{ $user->profile->target_department ?: 'Not specified' }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Registered At</td>
                        <td style="padding: 10px 0; color: #1e293b;">{{ $user->created_at->format('M d, Y h:i A') }} (UTC)</td>
                    </tr>
                </table>

                <!-- Action Button -->
                <div style="margin-top: 28px; text-align: center;">
                    <a href="{{ route('admin.dashboard') }}" style="display: inline-block; background-color: #00245A; color: #ffffff; font-weight: 700; font-size: 13px; padding: 12px 28px; border-radius: 8px; text-decoration: none; letter-spacing: 0.5px;">
                        Open Admin Dashboard →
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
