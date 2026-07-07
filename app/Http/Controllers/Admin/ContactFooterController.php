<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactFooterController extends Controller
{
    public function index()
    {
        $contactTitle = Setting::get('contact_title', "Let's Connect");
        $contactSubtitle = Setting::get('contact_subtitle', "Have questions? Want to join our team? We'd love to hear from you.");
        $contactEmail = Setting::get('contact_email', 'tekquora@gmail.com');
        $contactPhone = Setting::get('contact_phone', '+91 7373306677');
        $contactLocation = Setting::get('contact_location', 'Chennai, Tamil Nadu, India');
        $contactWorkingHours = Setting::get('contact_working_hours', 'Mon - Fri: 9:00 AM - 6:00 PM');
        $contactMapUrl = Setting::get('contact_map_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.003584852924!2d80.2422709!3d12.965429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a525d61081515ef%3A0xc346617fcbd8ad94!2sKandancavadi%2520Perungudi!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin');
        
        $contactCtaJson = Setting::get('contact_cta');
        $contactCta = $contactCtaJson ? json_decode($contactCtaJson, true) : [
            'title' => 'Ready to Start Your Project?',
            'description' => 'Schedule a free consultation call to discuss your requirements and get a detailed project proposal.',
            'btn_text' => 'Schedule Consultation',
            'btn_url' => '/contact'
        ];

        return view('admin.contact_footer', compact(
            'contactTitle', 'contactSubtitle', 'contactEmail', 'contactPhone', 
            'contactLocation', 'contactWorkingHours', 'contactMapUrl', 'contactCta'
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'contact_title' => 'required|string|max:255',
            'contact_subtitle' => 'required|string|max:500',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:100',
            'contact_location' => 'required|string|max:255',
            'contact_working_hours' => 'required|string|max:255',
            'contact_map_url' => 'nullable|string',
            
            'cta_title' => 'required|string|max:255',
            'cta_description' => 'required|string|max:500',
            'cta_btn_text' => 'required|string|max:100',
            'cta_btn_url' => 'required|string|max:255',
        ]);

        Setting::set('contact_title', $request->contact_title);
        Setting::set('contact_subtitle', $request->contact_subtitle);
        Setting::set('contact_email', $request->contact_email);
        Setting::set('contact_phone', $request->contact_phone);
        Setting::set('contact_location', $request->contact_location);
        Setting::set('contact_working_hours', $request->contact_working_hours);
        Setting::set('contact_map_url', $request->contact_map_url);

        $contactCta = [
            'title' => $request->cta_title,
            'description' => $request->cta_description,
            'btn_text' => $request->cta_btn_text,
            'btn_url' => $request->cta_btn_url,
        ];
        Setting::set('contact_cta', json_encode($contactCta));

        return redirect()->back()->with('success', 'Contact Us Page settings updated successfully!');
    }
}
