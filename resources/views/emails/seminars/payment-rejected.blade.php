<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <title>Payment Verification Notice - {{ $seminar->title }}</title>
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
                        <td class="header-cell" style="background: linear-gradient(135deg, #dc2626 0%, #ea580c 100%); padding: 28px 30px; color: #ffffff;">
                            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; color: #fef08a; margin-bottom: 6px;">
                                Pharma Career Compass • Payment Attention Required
                            </div>
                            <h1 class="header-title" style="margin: 0; font-size: 21px; font-weight: 800; color: #ffffff; line-height: 1.3;">
                                Action Required: Payment Not Verified
                            </h1>
                            <p style="margin: 6px 0 0; font-size: 13px; color: #fee2e2; line-height: 1.4;">
                                Reference: <strong>{{ $registration->registration_reference }}</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td class="body-cell" style="padding: 26px 28px;">
                            <p style="margin: 0 0 16px; font-size: 14px; line-height: 1.6; color: #334155;">
                                Dear <strong>{{ $registration->full_name }}</strong>,
                            </p>
                            <p style="margin: 0 0 18px; font-size: 14px; line-height: 1.6; color: #334155;">
                                We were unable to verify the transaction details submitted for your registration to <strong>{{ $seminar->title }}</strong>.
                            </p>

                            <!-- Reason Box -->
                            <div style="background-color: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 16px; margin-bottom: 22px;">
                                <div style="font-weight: 700; color: #991b1b; font-size: 13px; margin-bottom: 6px;">
                                    Reason provided by Admin:
                                </div>
                                <div style="font-size: 14px; color: #7f1d1d; line-height: 1.5;">
                                    "{{ $reason ?: 'The transaction ID provided was not found in our bKash statement or the transferred amount was incorrect.' }}"
                                </div>
                            </div>

                            <!-- Details Table -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width: 100%; table-layout: fixed; font-size: 14px; line-height: 1.6; margin-bottom: 24px;">
                                <tr>
                                    <td class="col-label" style="padding: 8px 8px 8px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600;">Submitted Trx ID</td>
                                    <td class="col-value" style="padding: 8px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; width: 64%; font-family: monospace; font-weight: 700;">
                                        {{ $registration->transaction_id ?: 'None provided' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-label" style="padding: 8px 8px 8px 0; border-bottom: 1px solid #f1f5f9; color: #64748b; width: 36%; font-weight: 600;">Applicable Fee</td>
                                    <td class="col-value" style="padding: 8px 0; border-bottom: 1px solid #f1f5f9; color: #1e293b; width: 64%; font-weight: 700;">
                                        ৳{{ number_format($registration->registration_fee, 2) }} BDT
                                    </td>
                                </tr>
                            </table>

                            <!-- Resolution Steps -->
                            <div style="background-color: #f8fafc; border-left: 4px solid #ea580c; padding: 14px 16px; border-radius: 4px; margin-bottom: 24px;">
                                <div style="font-weight: 700; color: #00245A; font-size: 13px; margin-bottom: 4px;">How to resolve this:</div>
                                <div style="font-size: 13px; color: #475569; line-height: 1.5;">
                                    1. Check your bKash app statement to verify the exact Transaction ID and amount.<br>
                                    2. Reply directly to this email with your corrected Transaction ID and screenshot.<br>
                                    3. Or reach out to us at <a href="mailto:hello@pharmacareercompass.com" style="color: #0085FF;">hello@pharmacareercompass.com</a> / call +880 1722 531335 with your reference number <strong>{{ $registration->registration_reference }}</strong>.
                                </div>
                            </div>

                            <!-- Button -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding: 6px 0 16px;">
                                        <a href="{{ route('seminars.confirmation', $registration->registration_reference) }}" class="btn-action" style="background-color: #ea580c; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: 700; font-size: 14px; display: inline-block;">
                                            Check Registration Status →
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
                            <div>Support: hello@pharmacareercompass.com | Phone: +880 1722 531335</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
