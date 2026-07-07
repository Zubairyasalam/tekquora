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
            'default_gst_rate' => Setting::get('default_gst_rate', '5.8'),
            'enable_whatsapp' => Setting::get('enable_whatsapp', '1'),
            'whatsapp_phone' => Setting::get('whatsapp_phone', '+919345272947'),
            'whatsapp_provider' => Setting::get('whatsapp_provider', 'Ultramsg (Recommended)'),
            'whatsapp_sender' => Setting::get('whatsapp_sender', '+919600097807'),
            'whatsapp_instance_id' => Setting::get('whatsapp_instance_id', 'instance180170'),
            'whatsapp_api_token' => Setting::get('whatsapp_api_token', '*****************'),
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
            'mail_encryption', 'mail_driver', 'primary_color', 'secondary_color',
            'default_gst_rate', 'whatsapp_phone', 'whatsapp_provider',
            'whatsapp_sender', 'whatsapp_instance_id', 'whatsapp_api_token'
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        Setting::set('enable_secondary_theme', $request->has('enable_secondary_theme') ? '1' : '0');
        Setting::set('enable_whatsapp', $request->has('enable_whatsapp') ? '1' : '0');

        // Also update .env file if email or password changed so Laravel mailer uses new credentials
        $this->updateEnv([
            'MAIL_USERNAME' => $request->input('system_email_address'),
            'MAIL_FROM_ADDRESS' => $request->input('system_email_address'),
            'MAIL_PASSWORD' => $request->input('mail_password'),
            'MAIL_HOST' => $request->input('mail_host'),
            'MAIL_PORT' => $request->input('mail_port'),
        ]);

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
