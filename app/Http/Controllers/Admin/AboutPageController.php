<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function index()
    {
        $aboutHeroTitle = Setting::get('about_hero_title', 'About Us');
        $aboutHeroSubtitle = Setting::get('about_hero_subtitle', 'Pioneering technology solutions and empowering digital growth since 2016.');

        $aboutTekquoraTitle = Setting::get('about_tekquora_title', 'About TekQuora');
        $aboutTekquoraP1 = Setting::get('about_tekquora_p1', 'TekQuora is a technology-driven company focused on building innovative digital solutions that help businesses grow, streamline operations, and stay ahead in a fast-changing digital world. We specialize in transforming ideas into practical, scalable, and user-friendly software products that solve real business challenges.');
        $aboutTekquoraP2 = Setting::get('about_tekquora_p2', 'Founded with a vision to combine technology, creativity, and business strategy, TekQuora works with startups, enterprises, and organizations to deliver high-quality web applications, mobile apps, business platforms, and custom digital solutions. Our team is passionate about creating products that are not only visually modern but also technically strong, reliable, and performance-focused.');

        $ourValuesTitle = Setting::get('about_values_title', 'Our Values');
        $ourValuesSubtitle = Setting::get('about_values_subtitle', 'The principles that guide everything we build and deliver.');
        
        $ourValuesJson = Setting::get('about_values_items');
        $ourValues = $ourValuesJson ? json_decode($ourValuesJson, true) : [
            ['title' => 'Innovation', 'description' => 'We explore new ideas, tools, and technologies to create smart and future-ready digital solutions.', 'position' => 'valley'],
            ['title' => 'Excellence', 'description' => 'We aim to deliver high-quality work in every project, with attention to detail, performance, and user experience.', 'position' => 'peak'],
            ['title' => 'Collaboration', 'description' => 'We work closely with clients and teams, believing that the best solutions come from strong communication and shared vision.', 'position' => 'valley'],
            ['title' => 'Results', 'description' => 'We focus on building solutions that create measurable value, improve workflows, and support business growth.', 'position' => 'peak']
        ];

        $ourApproachTitle = Setting::get('about_approach_title', 'Our Approach');
        $ourApproachP1 = Setting::get('about_approach_p1', 'At TekQuora, every project begins with understanding the client’s vision, goals, and challenges. We follow a practical and collaborative approach where planning, design, development, testing, and deployment are all handled with attention to quality and performance.');
        $ourApproachP2 = Setting::get('about_approach_p2', 'We don’t just develop software — we build digital experiences that support long-term business success. Our team works closely with clients to ensure transparency, adaptability, and timely delivery throughout the project lifecycle.');

        $whyChooseTitle = Setting::get('about_why_choose_title', 'Why Choose TekQuora');
        $whyChoosePointsJson = Setting::get('about_why_choose_points');
        $whyChoosePoints = $whyChoosePointsJson ? json_decode($whyChoosePointsJson, true) : [
            'Strong focus on quality, performance, and usability',
            'Expertise in modern web and software technologies',
            'Business-oriented solutions tailored to real-world needs',
            'Clean and responsive UI with scalable architecture',
            'Dedicated team support from idea to deployment',
            'Commitment to innovation, reliability, and client satisfaction'
        ];

        $growTitle = Setting::get('about_grow_title', 'GROW BEYOND BORDERS WITH TEKQUORA');
        $growSubtitle = Setting::get('about_grow_subtitle', "Whether you're paying a freelancer or a full team overseas, TekQuora makes it simple, fast, secure, and with no sacrifice for every detail.");
        $growBtnText = Setting::get('about_grow_btn_text', 'Explore More');
        $growBtnUrl = Setting::get('about_grow_btn_url', '/contact');

        return view('admin.about_page', compact(
            'aboutHeroTitle', 'aboutHeroSubtitle', 'aboutTekquoraTitle', 'aboutTekquoraP1', 'aboutTekquoraP2',
            'ourValuesTitle', 'ourValuesSubtitle', 'ourValues', 'ourApproachTitle', 'ourApproachP1', 'ourApproachP2',
            'whyChooseTitle', 'whyChoosePoints', 'growTitle', 'growSubtitle', 'growBtnText', 'growBtnUrl'
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'about_hero_title' => 'required|string|max:255',
            'about_hero_subtitle' => 'required|string|max:500',
            'about_tekquora_title' => 'required|string|max:255',
            'about_tekquora_p1' => 'required|string',
            'about_tekquora_p2' => 'required|string',
            'about_values_title' => 'required|string|max:255',
            'about_values_subtitle' => 'required|string|max:500',
            'about_approach_title' => 'required|string|max:255',
            'about_approach_p1' => 'required|string',
            'about_approach_p2' => 'required|string',
            'about_why_choose_title' => 'required|string|max:255',
            'grow_title' => 'required|string|max:255',
            'grow_subtitle' => 'required|string|max:500',
            'grow_btn_text' => 'required|string|max:100',
            'grow_btn_url' => 'required|string|max:255',
        ]);

        Setting::set('about_hero_title', $request->about_hero_title);
        Setting::set('about_hero_subtitle', $request->about_hero_subtitle);
        Setting::set('about_tekquora_title', $request->about_tekquora_title);
        Setting::set('about_tekquora_p1', $request->about_tekquora_p1);
        Setting::set('about_tekquora_p2', $request->about_tekquora_p2);
        Setting::set('about_values_title', $request->about_values_title);
        Setting::set('about_values_subtitle', $request->about_values_subtitle);
        
        if ($request->filled('values_json')) {
            Setting::set('about_values_items', $request->values_json);
        }

        Setting::set('about_approach_title', $request->about_approach_title);
        Setting::set('about_approach_p1', $request->about_approach_p1);
        Setting::set('about_approach_p2', $request->about_approach_p2);
        Setting::set('about_why_choose_title', $request->about_why_choose_title);

        if ($request->filled('why_choose_json')) {
            Setting::set('about_why_choose_points', $request->why_choose_json);
        }

        Setting::set('about_grow_title', $request->grow_title);
        Setting::set('about_grow_subtitle', $request->grow_subtitle);
        Setting::set('about_grow_btn_text', $request->grow_btn_text);
        Setting::set('about_grow_btn_url', $request->grow_btn_url);

        return redirect()->back()->with('success', 'About Page configuration updated successfully!');
    }
}
