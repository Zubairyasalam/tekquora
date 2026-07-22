<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class OurServicePageController extends Controller
{
    public function index()
    {
        $heroTitle = Setting::get('service_hero_title', 'Our Service');
        $heroSubtitle = Setting::get('service_hero_subtitle', 'We believe great products are built by happy, collaborative teams.');

        $section1Title = Setting::get('service_section1_title', 'Building Future-Ready Teams Through Innovation');
        $section1Paragraph = Setting::get('service_section1_paragraph', 'At TekQuora, we foster an environment where creativity, learning, and team coordination are valued. We support every team member in reaching their potential, encouraging open collaboration, and building high-performance digital products together.');
        
        $featuresJson = Setting::get('service_section1_features');
        $features = $featuresJson ? json_decode($featuresJson, true) : [
            ['title' => 'Innovation First', 'description' => 'We encourage creativity, experimentation, and continuous learning.', 'icon' => 'lightbulb'],
            ['title' => 'Collaborative Environment', 'description' => 'Every project is built through teamwork, communication, and shared success.', 'icon' => 'users'],
            ['title' => 'Growth & Learning', 'description' => 'Employees receive mentorship, training, and opportunities to grow.', 'icon' => 'graduation-cap']
        ];

        $section2Title = Setting::get('service_section2_title', 'Building Great Teams, Creating Greater Impact!');
        $section2Paragraph = Setting::get('service_section2_paragraph', 'At TekQuora, we foster a culture of innovation, collaboration, and continuous learning where every individual grows and makes a difference.');
        $section2SkylineImage = Setting::get('service_section2_skyline_image', '');

        $nodesJson = Setting::get('service_section2_nodes');
        $nodes = $nodesJson ? json_decode($nodesJson, true) : [
            ['label' => 'Growth', 'title' => 'Employee Growth', 'description' => 'We believe in nurturing talent and providing clear paths for personal and professional advancement through continuous mentorship.', 'icon' => 'trending-up'],
            ['label' => 'Collaboration', 'title' => 'Team Collaboration', 'description' => 'We prioritize open communication, active listening, and collective brainstorming to solve complex engineering challenges.', 'icon' => 'users'],
            ['label' => 'Innovation', 'title' => 'Innovation & Creativity', 'description' => 'We foster an atmosphere of curiosity, encouraging developers to experiment with new technologies and architectures.', 'icon' => 'zap'],
            ['label' => 'Excellence', 'title' => 'Excellence & Quality', 'description' => 'We strive for top-tier code quality, high performance, and robust security in every line of code we write.', 'icon' => 'award'],
            ['label' => 'Wellbeing', 'title' => 'Work-Life Balance', 'description' => 'We offer flexible hours, wellness programs, and team-building events to support healthy work-life integration.', 'icon' => 'heart'],
            ['label' => 'Learning', 'title' => 'Continuous Learning', 'description' => 'We sponsor certificates, training courses, and encourage sharing knowledge through regular technical sessions.', 'icon' => 'book-open']
        ];

        $section3Title = Setting::get('service_section3_title', 'Connecting Businesses and Innovation Worldwide');
        $section3Paragraph = Setting::get('service_section3_paragraph', 'TekQuora proudly partners with businesses across multiple countries, delivering innovative digital solutions that drive growth and transformation. From custom software development and web applications to AI-powered solutions, cloud technologies, and enterprise platforms, we help organizations achieve their goals with scalable, secure, and high-performance products.');
        $section3MapImage = Setting::get('service_section3_map_image', '/assets/world_map_clean.png');

        $statsJson = Setting::get('service_section3_stats');
        $stats = $statsJson ? json_decode($statsJson, true) : [
            ['value' => '15+', 'label' => 'Countries Served', 'icon' => 'globe'],
            ['value' => '500+', 'label' => 'Projects Delivered', 'icon' => 'check-square'],
            ['value' => '50+', 'label' => 'Global Partners', 'icon' => 'users'],
            ['value' => '100%', 'label' => 'Client Satisfaction', 'icon' => 'star']
        ];

        return view('admin.our_service_page', compact(
            'heroTitle', 'heroSubtitle',
            'section1Title', 'section1Paragraph', 'features',
            'section2Title', 'section2Paragraph', 'section2SkylineImage', 'nodes',
            'section3Title', 'section3Paragraph', 'section3MapImage', 'stats'
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:500',
            'section1_title' => 'required|string|max:255',
            'section1_paragraph' => 'required|string',
            'section2_title' => 'required|string|max:255',
            'section2_paragraph' => 'required|string',
            'section2_skyline_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'section3_title' => 'required|string|max:255',
            'section3_paragraph' => 'required|string',
            'section3_map_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        Setting::set('service_hero_title', $request->hero_title);
        Setting::set('service_hero_subtitle', $request->hero_subtitle);

        Setting::set('service_section1_title', $request->section1_title);
        Setting::set('service_section1_paragraph', $request->section1_paragraph);

        if ($request->filled('features_json')) {
            Setting::set('service_section1_features', $request->features_json);
        }

        Setting::set('service_section2_title', $request->section2_title);
        Setting::set('service_section2_paragraph', $request->section2_paragraph);

        if ($request->hasFile('section2_skyline_image')) {
            $file = $request->file('section2_skyline_image');
            $fileName = 'service_skyline_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            Setting::set('service_section2_skyline_image', '/uploads/' . $fileName);
        }

        if ($request->filled('nodes_json')) {
            Setting::set('service_section2_nodes', $request->nodes_json);
        }

        Setting::set('service_section3_title', $request->section3_title);
        Setting::set('service_section3_paragraph', $request->section3_paragraph);

        if ($request->hasFile('section3_map_image')) {
            $file = $request->file('section3_map_image');
            $fileName = 'service_map_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            Setting::set('service_section3_map_image', '/uploads/' . $fileName);
        }

        if ($request->filled('stats_json')) {
            Setting::set('service_section3_stats', $request->stats_json);
        }

        return redirect()->back()->with('success', 'Our Service Page configuration updated successfully!');
    }
}
