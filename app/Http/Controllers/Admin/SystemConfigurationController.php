<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SystemConfigurationController extends Controller
{
    public function index()
    {
        $socialsJson = Setting::get('footer_socials');
        $socials = $socialsJson ? json_decode($socialsJson, true) : [
            'facebook' => '#',
            'twitter' => '#',
            'linkedin' => '#',
            'instagram' => '#',
            'whatsapp' => '#'
        ];

        $config = [
            'system_email_address' => Setting::get('system_email_address', env('MAIL_USERNAME', 'zubairyakhan48@gmail.com')),
            'mail_password' => Setting::get('mail_password', env('MAIL_PASSWORD', 'jrmgtvepotrqhrze')),
            'mail_host' => Setting::get('mail_host', env('MAIL_HOST', 'smtp.gmail.com')),
            'mail_port' => Setting::get('mail_port', env('MAIL_PORT', '587')),
            'mail_encryption' => Setting::get('mail_encryption', 'TLS'),
            'mail_driver' => Setting::get('mail_driver', 'SMTP (Default)'),
            'primary_color' => Setting::get('primary_color', '#0061ff'),
            'enable_secondary_theme' => Setting::get('enable_secondary_theme', '0'),
            'secondary_color' => Setting::get('secondary_color', '#7c3aed'),
            'admin_login_email' => Setting::get('admin_login_email', 'admin@tekquora.com'),
            'socials' => $socials,
        ];

        if ($config['primary_color'] === '#850f0f') {
            $config['primary_color'] = '#0061ff';
        }
        if ($config['secondary_color'] === '#399d7f') {
            $config['secondary_color'] = '#7c3aed';
        }

        return view('admin.system_config', compact('config'));
    }

    public function save(Request $request)
    {
        $fields = [
            'system_email_address', 'mail_password', 'mail_host', 'mail_port',
            'mail_encryption', 'mail_driver', 'primary_color', 'secondary_color'
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        Setting::set('enable_secondary_theme', $request->has('enable_secondary_theme') ? '1' : '0');

        if ($request->has('socials')) {
            $socials = [
                'facebook' => $request->input('socials.facebook', '#'),
                'twitter' => $request->input('socials.twitter', '#'),
                'linkedin' => $request->input('socials.linkedin', '#'),
                'instagram' => $request->input('socials.instagram', '#'),
                'whatsapp' => $request->input('socials.whatsapp', '#')
            ];
            Setting::set('footer_socials', json_encode($socials));
        }

        // Also update .env file if email or password changed so Laravel mailer uses new credentials
        $this->updateEnv([
            'MAIL_USERNAME' => $request->input('system_email_address'),
            'MAIL_FROM_ADDRESS' => $request->input('system_email_address'),
            'MAIL_PASSWORD' => $request->input('mail_password'),
            'MAIL_HOST' => $request->input('mail_host'),
            'MAIL_PORT' => $request->input('mail_port'),
        ]);

        if ($request->filled('admin_login_email')) {
            Setting::set('admin_login_email', $request->input('admin_login_email'));
        }

        if ($request->filled('admin_password')) {
            Setting::set('admin_password', $request->input('admin_password'));
        }

        return redirect()->back()->with('success', 'System Configuration saved and activated successfully!');
    }

    private function updateEnv($data = array())
    {
        $envPath = base_path('.env');
        if (!File::exists($envPath)) {
            return;
        }

        $content = File::get($envPath);

        foreach ($data as $key => $value) {
            if ($value !== null) {
                $pattern = "/^{$key}=.*/m";
                $replacement = "{$key}={$value}";
                if (preg_match($pattern, $content)) {
                    $content = preg_replace($pattern, $replacement, $content);
                } else {
                    $content .= "\n{$replacement}";
                }
            }
        }

        File::put($envPath, $content);
    }
}
