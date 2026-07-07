<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'service' => 'required|string|in:web,mobile,ai,other',
            'details' => 'required|string',
        ]);

        $inquiry = Inquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'company' => $request->company,
            'service' => $request->service,
            'details' => $request->details,
            'priority' => 'Medium',
            'status' => 'Open',
        ]);

        // Send Email Notification to Admin
        try {
            $adminEmail = \App\Models\Setting::get('system_email_address', 'zubairyakhan48@gmail.com');
            $subject = "New TekQuora Inquiry: " . $request->name;

            Mail::send('emails.inquiry', ['data' => $request->all()], function ($message) use ($adminEmail, $subject, $request) {
                $message->to($adminEmail)
                        ->subject($subject)
                        ->replyTo($request->email, $request->name);
            });
        } catch (\Exception $e) {
            // Log error silently so user still gets success redirect if mailer isn't configured yet
            \Illuminate\Support\Facades\Log::error("Mail sending failed: " . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully. We will get back to you soon.');
    }
}
