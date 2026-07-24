<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $footerDescription = Setting::get('footer_description', 'Pioneering the future of technology with innovative solutions that transform businesses and empower digital growth across industries worldwide.');
        $footerCopyright = Setting::get('footer_copyright', '© ' . date('Y') . ' TekQuora. All rights reserved. Crafted with innovation and precision.');

        // Social Links
        $socialsJson = Setting::get('footer_socials');
        $socials = $socialsJson ? json_decode($socialsJson, true) : [
            'facebook' => '#',
            'twitter' => '#',
            'linkedin' => '#',
            'instagram' => '#',
            'whatsapp' => '#'
        ];
        if (!isset($socials['whatsapp'])) {
            $socials['whatsapp'] = '#';
        }

        // Column Titles
        $col1Title = Setting::get('footer_col1_title', 'Services');
        $col2Title = Setting::get('footer_col2_title', 'Company');
        $col3Title = Setting::get('footer_col3_title', 'Resources');

        // Column Links
        $col1LinksJson = Setting::get('footer_col1_links');
        $col1Links = $col1LinksJson ? json_decode($col1LinksJson, true) : [
            ['label' => 'Web Development', 'url' => '/#services'],
            ['label' => 'Mobile Apps', 'url' => '/#services'],
            ['label' => 'Cloud Services', 'url' => '/#services'],
            ['label' => 'AI Solutions', 'url' => '/#services'],
            ['label' => 'Cybersecurity', 'url' => '/#services'],
            ['label' => 'Data Analytics', 'url' => '/#services']
        ];

        $col2LinksJson = Setting::get('footer_col2_links');
        $col2Links = $col2LinksJson ? json_decode($col2LinksJson, true) : [
            ['label' => 'About Us', 'url' => '/#about'],
            ['label' => 'Our Team', 'url' => '/team'],
            ['label' => 'News & Blog', 'url' => '#'],
            ['label' => 'Case Studies', 'url' => '#'],
            ['label' => 'Contact', 'url' => '/contact']
        ];

        $col3LinksJson = Setting::get('footer_col3_links');
        $col3Links = $col3LinksJson ? json_decode($col3LinksJson, true) : [
            ['label' => 'Documentation', 'url' => '#'],
            ['label' => 'API Reference', 'url' => '#'],
            ['label' => 'Support Center', 'url' => '#'],
            ['label' => 'Community', 'url' => '#'],
            ['label' => 'Partners', 'url' => '#'],
            ['label' => 'Downloads', 'url' => '#']
        ];

        return view('admin.footer', compact(
            'footerDescription', 'footerCopyright', 'socials',
            'col1Title', 'col1Links', 'col2Title', 'col2Links', 'col3Title', 'col3Links'
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'footer_description' => 'required|string|max:1000',
            'footer_copyright' => 'required|string|max:255',
            'socials' => 'nullable|array',
            
            'col1_title' => 'required|string|max:100',
            'col1_links' => 'nullable|array',
            
            'col2_title' => 'required|string|max:100',
            'col2_links' => 'nullable|array',
            
            'col3_title' => 'required|string|max:100',
            'col3_links' => 'nullable|array',
        ]);

        Setting::set('footer_description', $request->footer_description);
        Setting::set('footer_copyright', $request->footer_copyright);

        // Save Socials
        $socials = [
            'facebook' => $request->input('socials.facebook', '#'),
            'twitter' => $request->input('socials.twitter', '#'),
            'linkedin' => $request->input('socials.linkedin', '#'),
            'instagram' => $request->input('socials.instagram', '#'),
            'whatsapp' => $request->input('socials.whatsapp', '#')
        ];
        Setting::set('footer_socials', json_encode($socials));

        // Save Column 1
        Setting::set('footer_col1_title', $request->col1_title);
        $col1Links = [];
        if ($request->has('col1_links') && is_array($request->col1_links)) {
            foreach ($request->col1_links as $item) {
                if (!empty($item['label'])) {
                    $col1Links[] = ['label' => $item['label'], 'url' => $item['url'] ?? '#'];
                }
            }
        }
        Setting::set('footer_col1_links', json_encode($col1Links));

        // Save Column 2
        Setting::set('footer_col2_title', $request->col2_title);
        $col2Links = [];
        if ($request->has('col2_links') && is_array($request->col2_links)) {
            foreach ($request->col2_links as $item) {
                if (!empty($item['label'])) {
                    $col2Links[] = ['label' => $item['label'], 'url' => $item['url'] ?? '#'];
                }
            }
        }
        Setting::set('footer_col2_links', json_encode($col2Links));

        // Save Column 3
        Setting::set('footer_col3_title', $request->col3_title);
        $col3Links = [];
        if ($request->has('col3_links') && is_array($request->col3_links)) {
            foreach ($request->col3_links as $item) {
                if (!empty($item['label'])) {
                    $col3Links[] = ['label' => $item['label'], 'url' => $item['url'] ?? '#'];
                }
            }
        }
        Setting::set('footer_col3_links', json_encode($col3Links));

        return redirect()->back()->with('success', 'Website Footer navigation and settings updated successfully!');
    }
}
