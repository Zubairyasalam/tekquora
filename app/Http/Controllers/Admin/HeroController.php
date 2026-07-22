<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        $heroImage = Setting::get('hero_background_image', 'assets/hero-bg-custom.png');
        $heroTitle = Setting::get('hero_title', 'Future-Ready<br>Technology Solutions');
        $heroSubtitle = Setting::get('hero_subtitle', '');

        return view('admin.hero', compact(
            'heroImage',
            'heroTitle',
            'heroSubtitle'
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string',
            'hero_subtitle' => 'nullable|string',
            'hero_background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        Setting::set('hero_title', $request->hero_title);
        Setting::set('hero_subtitle', $request->hero_subtitle ?? '');

        if ($request->hasFile('hero_background_image')) {
            $file = $request->file('hero_background_image');
            $fileName = 'hero_bg_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Move file to public/uploads
            $file->move(public_path('uploads'), $fileName);
            
            // Update settings with new path
            Setting::set('hero_background_image', '/uploads/' . $fileName);
        }

        return redirect()->back()->with('success', 'Hero section configuration updated successfully!');
    }
}
