<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Inquiry</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7fe; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #000000;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #f4f7fe; padding: 40px 20px;">
        <tr>
            <td align="center">
                <!-- Main Card Container -->
                <table width="600" border="0" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); max-width: 600px; width: 100%; border: 1px solid #e2e8f0;">
                    
                    <!-- Header Banner -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1b2559 0%, #0061ff 100%); padding: 32px 40px; text-align: center;">
                            <h1 style="margin: 0; font-size: 28px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px;">TekQuora</h1>
                            <p style="margin: 6px 0 0; font-size: 14px; color: #ffffff; font-weight: 600;">New Website Notification</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <!-- Status Pill -->
                            <div style="margin-bottom: 24px;">
                                <span style="background-color: #f1f5f9; color: #000000; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; border: 1px solid #cbd5e1;">🚀 NEW CLIENT INQUIRY</span>
                            </div>

                            <h2 style="margin: 0 0 16px; font-size: 22px; font-weight: 800; color: #000000;">You have received a new message!</h2>
                            <p style="margin: 0 0 28px; font-size: 15px; line-height: 1.6; color: #000000; font-weight: 500;">A visitor has submitted the contact form on your TekQuora website. Here are the project details:</p>

                            <!-- Client Details Table -->
                            <table width="100%" border="0" cellpadding="12" cellspacing="0" style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #cbd5e1; margin-bottom: 28px;">
                                <tr>
                                    <td width="35%" style="font-size: 14px; font-weight: 700; color: #000000; border-bottom: 1px solid #cbd5e1;">Full Name:</td>
                                    <td width="65%" style="font-size: 15px; font-weight: 800; color: #000000; border-bottom: 1px solid #cbd5e1;">{{ $data['name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; font-weight: 700; color: #000000; border-bottom: 1px solid #cbd5e1;">Email Address:</td>
                                    <td style="font-size: 15px; font-weight: 800; color: #000000; border-bottom: 1px solid #cbd5e1;">
                                        <a href="mailto:{{ $data['email'] }}" style="color: #000000; font-weight: 800; text-decoration: underline;">{{ $data['email'] }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; font-weight: 700; color: #000000; border-bottom: 1px solid #cbd5e1;">Company:</td>
                                    <td style="font-size: 15px; font-weight: 800; color: #000000; border-bottom: 1px solid #cbd5e1;">{{ $data['company'] ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; font-weight: 700; color: #000000;">Service Requested:</td>
                                    <td>
                                        <span style="background-color: #000000; color: #ffffff; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 800; text-transform: uppercase;">{{ $data['service'] }}</span>
                                    </td>
                                </tr>
                            </table>

                            <!-- Message Callout Box -->
                            <div style="margin-bottom: 32px;">
                                <div style="font-size: 14px; font-weight: 800; color: #000000; margin-bottom: 8px;">Project Details / Message:</div>
                                <div style="background-color: #ffffff; border-left: 4px solid #000000; padding: 16px 20px; border-radius: 0 8px 8px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: 1px solid #cbd5e1; font-size: 15px; line-height: 1.6; color: #000000; font-weight: 600; white-space: pre-wrap;">{{ $data['details'] }}</div>
                            </div>

                            <!-- Action Button -->
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">
                                        <a href="http://127.0.0.1:8000/admin/inquiries" style="display: inline-block; background-color: #0061ff; color: #ffffff; font-size: 15px; font-weight: 800; text-decoration: none; padding: 14px 32px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 97, 255, 0.3);">View in Admin Dashboard</a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 24px 40px; text-align: center; border-top: 1px solid #cbd5e1;">
                            <p style="margin: 0; font-size: 13px; color: #000000; font-weight: 600;">You can reply directly to this email to contact the sender.</p>
                            <p style="margin: 6px 0 0; font-size: 12px; color: #000000; font-weight: 500;">&copy; {{ date('Y') }} TekQuora Automated System. All rights reserved.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
