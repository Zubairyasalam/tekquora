<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Client Inquiry - TekQuora</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f8fafc; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #334155; -webkit-font-smoothing: antialiased;">
    @php
        $logoPath = \App\Models\Setting::get('header_logo_path');
        $logoText = \App\Models\Setting::get('header_logo_text', 'TekQuora');
    @endphp
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; padding: 48px 24px;">
        <tr>
            <td align="center">
                <!-- Main Card Container -->
                <table width="600" border="0" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03); max-width: 600px; width: 100%; border: 1px solid #e2e8f0;">
                    
                    <!-- Gradient Top Bar -->
                    <tr>
                        <td height="4" style="background-color: #4f46e5; background: linear-gradient(135deg, #00d2ff 0%, #4a55e8 50%, #8b5cf6 100%); line-height: 4px; font-size: 4px;">&nbsp;</td>
                    </tr>
                    
                    <!-- Header Banner with Logo -->
                    <tr>
                        <td style="background-color: #ffffff; padding: 32px 40px; text-align: center; border-bottom: 1px solid #e2e8f0;">
                            @if($logoPath)
                                @if(isset($message) && file_exists(public_path(ltrim($logoPath, '/'))))
                                    <img src="{{ $message->embed(public_path(ltrim($logoPath, '/'))) }}" alt="{{ $logoText }} Logo" style="height: 42px; width: auto; max-width: 220px; display: block; margin: 0 auto;">
                                @else
                                    <img src="{{ asset(ltrim($logoPath, '/')) }}" alt="{{ $logoText }} Logo" style="height: 42px; width: auto; max-width: 220px; display: block; margin: 0 auto;">
                                @endif
                            @else
                                <h1 style="margin: 0; font-size: 26px; font-weight: 800; color: #4f46e5; letter-spacing: -0.5px;">{{ $logoText }}</h1>
                            @endif
                            <p style="margin: 8px 0 0; font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px;">Website Notification</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <!-- Status Pill -->
                            <div style="margin-bottom: 24px;">
                                <span style="background-color: #e0e7ff; color: #4f46e5; padding: 6px 14px; border-radius: 9999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">New Client Inquiry</span>
                            </div>

                            <h2 style="margin: 0 0 12px; font-size: 20px; font-weight: 700; color: #0f172a; line-height: 1.3;">New inquiry received from contact form</h2>
                            <p style="margin: 0 0 28px; font-size: 15px; line-height: 1.6; color: #475569;">A visitor has submitted a new inquiry through the contact form on the TekQuora website. The submission details are listed below:</p>

                            <!-- Client Details Table -->
                            <table width="100%" border="0" cellpadding="14" cellspacing="0" style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 28px;">
                                <tr>
                                    <td width="35%" style="font-size: 14px; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0;">Full Name</td>
                                    <td width="65%" style="font-size: 14px; font-weight: 700; color: #0f172a; border-bottom: 1px solid #e2e8f0;">{{ $data['name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0;">Email Address</td>
                                    <td style="font-size: 14px; font-weight: 700; color: #000000; border-bottom: 1px solid #e2e8f0;">
                                        <a href="mailto:{{ $data['email'] }}" style="color: #000000; text-decoration: underline; font-weight: 700;">{{ $data['email'] }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0;">Company</td>
                                    <td style="font-size: 14px; font-weight: 700; color: #0f172a; border-bottom: 1px solid #e2e8f0;">{{ $data['company'] ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; font-weight: 600; color: #64748b;">Service</td>
                                    <td>
                                        <span style="background-color: #000000; color: #ffffff; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">{{ $data['service'] }}</span>
                                    </td>
                                </tr>
                            </table>

                            <!-- Message Callout Box -->
                            <div style="margin-bottom: 36px;">
                                <div style="font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 10px;">Message / Project Details:</div>
                                <div style="background-color: #ffffff; border-left: 4px solid #4f46e5; padding: 18px 20px; border-radius: 4px 12px 12px 4px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02); border-top: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; font-size: 14px; line-height: 1.6; color: #334155; white-space: pre-wrap;">{{ $data['details'] }}</div>
                            </div>

                            <!-- Action Button -->
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">
                                        <a href="http://127.0.0.1:8000/admin/inquiries" style="display: inline-block; background-color: #4f46e5; color: #ffffff; font-size: 14px; font-weight: 700; text-decoration: none; padding: 14px 36px; border-radius: 10px; box-shadow: 0 4px 14px rgba(79, 70, 229, 0.25); transition: background-color 0.2s ease;">View In Dashboard</a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 28px 40px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0; font-size: 13px; color: #64748b; font-weight: 500;">You can reply directly to this notification email to contact the client.</p>
                            <p style="margin: 6px 0 0; font-size: 12px; color: #94a3b8; font-weight: 500;">&copy; {{ date('Y') }} TekQuora. All rights reserved.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
