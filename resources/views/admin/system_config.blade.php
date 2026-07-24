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
                        <div style="position: relative;">
                            <input type="password" id="mail_password" name="mail_password" value="{{ $config['mail_password'] }}" required style="width: 100%; padding: 12px 46px 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                            <button type="button" id="toggle_password_btn" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #94a3b8; padding: 4px; display: flex; align-items: center; justify-content: center;">
                                <!-- Eye Icon (visible when type is password) -->
                                <svg xmlns="http://www.w3.org/2000/svg" id="eye_icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <!-- Eye Off Icon (visible when type is text) -->
                                <svg xmlns="http://www.w3.org/2000/svg" id="eye_off_icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
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

            <!-- 3. Social Media Links -->
            <div style="margin-bottom: 40px;">
                <h3 style="font-size: 18px; font-weight: 800; color: #1b2559; display: flex; align-items: center; gap: 10px; margin-bottom: 24px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
                    <span style="color: #0061ff;">🌐</span> Social Media Links
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">Facebook URL</label>
                        <input type="text" name="socials[facebook]" value="{{ $config['socials']['facebook'] ?? '#' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">Instagram URL</label>
                        <input type="text" name="socials[instagram]" value="{{ $config['socials']['instagram'] ?? '#' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">Twitter URL</label>
                        <input type="text" name="socials[twitter]" value="{{ $config['socials']['twitter'] ?? '#' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">LinkedIn URL</label>
                        <input type="text" name="socials[linkedin]" value="{{ $config['socials']['linkedin'] ?? '#' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                    </div>
                </div>

                <div style="margin-bottom: 20px; width: 50%;">
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">WhatsApp URL / Number</label>
                    <input type="text" name="socials[whatsapp]" value="{{ $config['socials']['whatsapp'] ?? '#' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                </div>
            </div>

            <!-- 4. Change Admin Login Credentials -->
            <div style="margin-bottom: 40px;">
                <h3 style="font-size: 18px; font-weight: 800; color: #1b2559; display: flex; align-items: center; gap: 10px; margin-bottom: 24px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
                    <span style="color: #0061ff;">🔑</span> Admin Login Credentials
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">Admin Login Email ID</label>
                        <input type="email" name="admin_login_email" value="{{ $config['admin_login_email'] }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                        <span style="display: block; font-size: 11px; color: #94a3b8; margin-top: 6px;">Email address used to log into the Admin Console.</span>
                    </div>

                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 8px;">New Admin Password</label>
                        <div style="position: relative;">
                            <input type="password" id="new_admin_password" name="admin_password" placeholder="Enter new admin password" style="width: 100%; padding: 12px 46px 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1b2559; background: #ffffff;">
                            <button type="button" id="toggle_admin_password_btn" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #94a3b8; padding: 4px; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" id="admin_eye_icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" id="admin_eye_off_icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                        <span style="display: block; font-size: 11px; color: #94a3b8; margin-top: 6px;">Leave blank if you do not wish to change your password.</span>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle_password_btn');
            const passwordInput = document.getElementById('mail_password');
            const eyeIcon = document.getElementById('eye_icon');
            const eyeOffIcon = document.getElementById('eye_off_icon');

            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    if (type === 'password') {
                        eyeIcon.style.display = 'block';
                        eyeOffIcon.style.display = 'none';
                    } else {
                        eyeIcon.style.display = 'none';
                        eyeOffIcon.style.display = 'block';
                    }
                });
            }

            const adminToggleBtn = document.getElementById('toggle_admin_password_btn');
            const adminPasswordInput = document.getElementById('new_admin_password');
            const adminEyeIcon = document.getElementById('admin_eye_icon');
            const adminEyeOffIcon = document.getElementById('admin_eye_off_icon');

            if (adminToggleBtn && adminPasswordInput) {
                adminToggleBtn.addEventListener('click', function() {
                    const type = adminPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    adminPasswordInput.setAttribute('type', type);
                    
                    if (type === 'password') {
                        adminEyeIcon.style.display = 'block';
                        adminEyeOffIcon.style.display = 'none';
                    } else {
                        adminEyeIcon.style.display = 'none';
                        adminEyeOffIcon.style.display = 'block';
                    }
                });
            }
        });
    </script>

</div>
@endsection
