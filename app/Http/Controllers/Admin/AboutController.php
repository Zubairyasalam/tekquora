<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $aboutImage = Setting::get('about_image', '/assets/logo.png');
        $aboutEyebrow = Setting::get('about_eyebrow', 'ABOUT TEKQUORA');
        $aboutDesc1 = Setting::get('about_description_1', '');
        $aboutDesc2 = Setting::get('about_description_2', '');
        $pointsJson = Setting::get('about_points');
        $aboutPoints = $pointsJson ? json_decode($pointsJson, true) : [];
        $aboutStatValue = Setting::get('about_stat_value', '6,561+');
        $aboutStatLabel = Setting::get('about_stat_label', 'Satisfied Clients');
        $aboutBtnText = Setting::get('about_btn_text', 'Explore More');
        $aboutBtnUrl = Setting::get('about_btn_url', '/about');

        return view('admin.about', compact(
            'aboutImage',
            'aboutEyebrow',
            'aboutDesc1',
            'aboutDesc2',
            'aboutPoints',
            'aboutStatValue',
            'aboutStatLabel',
            'aboutBtnText',
            'aboutBtnUrl'
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'about_eyebrow' => 'required|string|max:100',
            'about_description_1' => 'required|string',
            'about_description_2' => 'nullable|string',
            'about_points' => 'nullable|array',
            'about_points.*' => 'required|string|max:255',
            'about_stat_value' => 'nullable|string|max:50',
            'about_stat_label' => 'nullable|string|max:100',
            'about_btn_text' => 'nullable|string|max:50',
            'about_btn_url' => 'nullable|string|max:255',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        Setting::set('about_eyebrow', $request->about_eyebrow);
        Setting::set('about_description_1', $request->about_description_1);
        Setting::set('about_description_2', $request->about_description_2 ?? '');
        
        $points = [];
        if ($request->has('about_points') && is_array($request->about_points)) {
            $points = array_values(array_filter($request->about_points));
        }
        Setting::set('about_points', json_encode($points));

        Setting::set('about_stat_value', $request->about_stat_value ?? '');
        Setting::set('about_stat_label', $request->about_stat_label ?? '');
        Setting::set('about_btn_text', $request->about_btn_text ?? '');
        Setting::set('about_btn_url', $request->about_btn_url ?? '');

        if ($request->hasFile('about_image')) {
            $file = $request->file('about_image');
            $fileName = 'about_blob_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Move file to public/uploads
            $file->move(public_path('uploads'), $fileName);
            
            // Update settings with new path
            Setting::set('about_image', '/uploads/' . $fileName);
        }

        return redirect()->back()->with('success', 'About section configuration updated successfully!');
    }
}
