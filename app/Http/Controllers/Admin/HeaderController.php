<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderController extends Controller
{
    public function index()
    {
        $logoText = Setting::get('header_logo_text', 'TekQuora');
        $logoPath = Setting::get('header_logo_path', '/assets/Tekquora_website_logo-resized.png');
        $linksJson = Setting::get('header_navigation_links');
        $links = $linksJson ? json_decode($linksJson, true) : [];

        return view('admin.header', compact('logoText', 'logoPath', 'links'));
    }

    public function saveLogo(Request $request)
    {
        $request->validate([
            'logo_text' => 'nullable|string|max:100',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->has('logo_text')) {
            Setting::set('header_logo_text', $request->logo_text ?? '');
        }

        if ($request->hasFile('logo_image')) {
            $file = $request->file('logo_image');
            $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Move file to public/uploads
            $file->move(public_path('uploads'), $fileName);
            
            // Update settings with new path
            Setting::set('header_logo_path', '/uploads/' . $fileName);
        }

        return redirect()->back()->with('success', 'Logo settings updated successfully!');
    }

    public function saveLinks(Request $request)
    {
        // We receive the full list of links.
        // It's an array of links: [ ['label' => '...', 'url' => '...', 'is_button' => true/false], ... ]
        $request->validate([
            'links' => 'nullable|array',
            'links.*.label' => 'required|string|max:100',
            'links.*.url' => 'required|string|max:255',
            'links.*.is_button' => 'nullable',
        ]);

        $links = [];
        if ($request->has('links') && is_array($request->links)) {
            $idCounter = 1;
            foreach ($request->links as $linkData) {
                $links[] = [
                    'id' => $idCounter++,
                    'label' => $linkData['label'],
                    'url' => $linkData['url'],
                    'is_button' => isset($linkData['is_button']) && ($linkData['is_button'] == '1' || $linkData['is_button'] == 'true' || $linkData['is_button'] === true),
                ];
            }
        }

        Setting::set('header_navigation_links', json_encode($links));

        return redirect()->back()->with('success', 'Navigation links updated successfully!');
    }
}
