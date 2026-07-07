@extends('layouts.admin')

@section('title', 'System Configuration - TekQuora Admin')
@section('header_title', '⚙ System Configuration')

@section('content')
<div style="max-width: 1100px; margin: 0 auto; padding-bottom: 50px;">

    @if(session('success'))
        <div style="background-color: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 16px 20px; border-radius: 10px; margin-bottom: 24px; font-weight: 600; display: flex; align-items: center; gap: 10px;">
            <span>✔</span> {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.system-config.save') }}">
        @csrf
        
        <!-- Main Configuration Box -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03); margin-bottom: 30px;">
            
            <!-- 1. Mail Service Configuration -->
            <div style="margin-bottom: 40px;">
                <h3 style="font-size: 18px; font-weight: 800; color: #1b2559; display: flex; align-items: center; gap: 10px; margin-bottom: 24px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
                    <span style="color: #0061ff;">✉</span> Mail Service Configuration
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">System Email Address (Sender)</label>
                        <input type="email" name="system_email_address" value="{{ $config['system_email_address'] }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">Mail Password / App Password</label>
                        <input type="password" name="mail_password" value="{{ $config['mail_password'] }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                        <span style="display: block; font-size: 11px; color: #94a3b8; margin-top: 6px;">🔒 This password is encrypted for security.</span>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">Mail Host</label>
                        <input type="text" name="mail_host" value="{{ $config['mail_host'] }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">Mail Port</label>
                        <input type="text" name="mail_port" value="{{ $config['mail_port'] }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">Mail Encryption</label>
                        <select name="mail_encryption" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                            <option value="TLS" {{ $config['mail_encryption'] == 'TLS' ? 'selected' : '' }}>TLS</option>
                            <option value="SSL" {{ $config['mail_encryption'] == 'SSL' ? 'selected' : '' }}>SSL</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">Mail Driver / Mailer</label>
                        <select name="mail_driver" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                            <option value="SMTP (Default)" {{ $config['mail_driver'] == 'SMTP (Default)' ? 'selected' : '' }}>SMTP (Default)</option>
                            <option value="Sendmail" {{ $config['mail_driver'] == 'Sendmail' ? 'selected' : '' }}>Sendmail</option>
                        </select>
                    </div>
                </div>

                <div style="background-color: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 10px; padding: 16px 20px; font-size: 13px; color: #065f46; line-height: 1.5;">
                    <strong style="color: #047857;">✔ Configuration Active:</strong> These credentials will be used for <strong style="text-decoration: underline;">all outgoing system emails</strong> including approvals and notifications.
                </div>
            </div>

            <!-- 2. Appearance & Branding -->
            <div style="margin-bottom: 40px;">
                <h3 style="font-size: 18px; font-weight: 800; color: #1b2559; display: flex; align-items: center; gap: 10px; margin-bottom: 24px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
                    <span style="color: #0061ff;">🎨</span> Appearance & Branding
                </h3>

                <div style="border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 20px; background: #f8fafc;">
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #1b2559; margin-bottom: 12px;">Global Primary Color</label>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                        <input type="color" name="primary_color" id="primaryColorPicker" value="{{ $config['primary_color'] }}" style="width: 50px; height: 42px; padding: 2px; border: 1px solid #cbd5e1; border-radius: 8px; cursor: pointer; background: #ffffff;" onchange="document.getElementById('primaryColorHex').value = this.value">
                        <input type="text" id="primaryColorHex" value="{{ $config['primary_color'] }}" readonly style="width: 200px; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; font-weight: 700; color: #0061ff; background: #ffffff;">
                    </div>
                    <span style="font-size: 12px; color: #64748b;">ⓘ This is the main theme color used for buttons, links, and icons throughout the site.</span>
                </div>

                <div style="border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; background: #f8fafc;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                        <label style="display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 700; color: #1b2559; cursor: pointer;">
                            <input type="checkbox" name="enable_secondary_theme" value="1" {{ $config['enable_secondary_theme'] == '1' ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #0061ff;">
                            Enable Secondary Complementary Theme
                        </label>
                        <span style="background: #e2e8f0; color: #475569; font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 6px;">{{ $config['enable_secondary_theme'] == '1' ? 'ACTIVE' : 'DISABLED' }}</span>
                    </div>

                    <label style="display: block; font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 8px;">Accent Secondary Color</label>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                        <input type="color" name="secondary_color" id="secondaryColorPicker" value="{{ $config['secondary_color'] }}" style="width: 50px; height: 42px; padding: 2px; border: 1px solid #cbd5e1; border-radius: 8px; cursor: pointer; background: #ffffff;" onchange="document.getElementById('secondaryColorHex').value = this.value">
                        <input type="text" id="secondaryColorHex" value="{{ $config['secondary_color'] }}" readonly style="width: 200px; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; font-weight: 700; color: #7c3aed; background: #ffffff;">
                    </div>
                    <span style="font-size: 12px; color: #64748b;">ⓘ The secondary color creates structural depth by applying it to the main footer and header borders.</span>
                </div>
            </div>

            <!-- 3. WhatsApp Notification Integration -->
            <div style="margin-bottom: 30px;">
                <h3 style="font-size: 18px; font-weight: 800; color: #1b2559; display: flex; align-items: center; gap: 10px; margin-bottom: 24px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
                    <span style="color: #22c55e;">💬</span> WhatsApp Notification Integration
                </h3>

                <div style="border: 1.5px solid #bbf7d0; border-radius: 14px; padding: 24px; background: #f0fdf4;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; border-bottom: 1px solid #dcfce7; padding-bottom: 16px;">
                        <label style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 800; color: #166534; cursor: pointer;">
                            <input type="checkbox" name="enable_whatsapp" value="1" {{ $config['enable_whatsapp'] == '1' ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #22c55e;">
                            Enable WhatsApp Notifications for Principal
                        </label>
                        <span style="background: #22c55e; color: #ffffff; font-size: 11px; font-weight: 800; padding: 5px 12px; border-radius: 6px; letter-spacing: 0.5px;">ACTIVE</span>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #166534; margin-bottom: 8px;">Principal's WhatsApp Phone Number (with Country Code prefix)</label>
                        <input type="text" name="whatsapp_phone" value="{{ $config['whatsapp_phone'] }}" style="width: 100%; padding: 12px 16px; border: 1px solid #bbf7d0; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                        <span style="display: block; font-size: 12px; color: #15803d; margin-top: 6px;">Include the country code prefix (e.g. +91 for India)</span>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 700; color: #166534; margin-bottom: 8px;">WhatsApp Service Provider</label>
                            <select name="whatsapp_provider" style="width: 100%; padding: 12px 16px; border: 1px solid #bbf7d0; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                                <option value="Ultramsg (Recommended)" {{ $config['whatsapp_provider'] == 'Ultramsg (Recommended)' ? 'selected' : '' }}>Ultramsg (Recommended)</option>
                                <option value="Twilio" {{ $config['whatsapp_provider'] == 'Twilio' ? 'selected' : '' }}>Twilio</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 700; color: #166534; margin-bottom: 8px;">Sender/From Phone Number (Optional)</label>
                            <input type="text" name="whatsapp_sender" value="{{ $config['whatsapp_sender'] }}" style="width: 100%; padding: 12px 16px; border: 1px solid #bbf7d0; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 700; color: #166534; margin-bottom: 8px;">Instance ID (Ultramsg)</label>
                            <input type="text" name="whatsapp_instance_id" value="{{ $config['whatsapp_instance_id'] }}" style="width: 100%; padding: 12px 16px; border: 1px solid #bbf7d0; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 700; color: #166534; margin-bottom: 8px;">API Token (Ultramsg)</label>
                            <input type="password" name="whatsapp_api_token" value="{{ $config['whatsapp_api_token'] }}" style="width: 100%; padding: 12px 16px; border: 1px solid #bbf7d0; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div style="padding-top: 10px;">
                <button type="submit" style="background-color: #0061ff; color: #ffffff; font-size: 15px; font-weight: 800; padding: 14px 36px; border-radius: 10px; border: none; cursor: pointer; box-shadow: 0 4px 15px rgba(0, 97, 255, 0.3); transition: background 0.2s;">
                    Save Configuration
                </button>
            </div>

        </div>
    </form>

    <!-- Helper Guide Box -->
    <div style="background-color: #fffbeb; border: 1.5px solid #fde68a; border-radius: 14px; padding: 28px 32px; color: #92400e;">
        <h4 style="margin: 0 0 16px; font-size: 16px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <span>💡</span> How to generate a Gmail App Password?
        </h4>
        <ol style="margin: 0; padding-left: 20px; font-size: 14px; line-height: 2; font-weight: 600;">
            <li>Go to your <a href="https://myaccount.google.com/" target="_blank" style="color: #d97706; text-decoration: underline;">Google Account</a>.</li>
            <li>Ensure <strong style="color: #78350f;">2-Step Verification</strong> is ON in the Security tab.</li>
            <li>Go directly to <a href="https://myaccount.google.com/apppasswords" target="_blank" style="color: #d97706; text-decoration: underline;">App Passwords</a>.</li>
            <li>Select "Mail" and "Other (Custom name: TekQuora System)".</li>
            <li>Copy the <strong style="color: #78350f;">16-character code</strong> and paste it above.</li>
            <li style="font-style: italic; color: #b45309; font-weight: 500;">Note: Do not include spaces when pasting; the system will handle it automatically.</li>
        </ol>
    </div>

</div>
@endsection
