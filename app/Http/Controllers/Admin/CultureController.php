<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CultureController extends Controller
{
    public function index()
    {
        $cultureTitle = Setting::get('culture_title', 'Our Work Culture');
        $cultureSubtitle = Setting::get('culture_subtitle', "More than just a workplace it's a community where innovation thrives and people grow");
        $cultureListJson = Setting::get('culture_list');
        $cultureList = $cultureListJson ? json_decode($cultureListJson, true) : [];

        return view('admin.culture', compact('cultureTitle', 'cultureSubtitle', 'cultureList'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'culture_title' => 'required|string|max:255',
            'culture_subtitle' => 'required|string|max:500',
            'culture' => 'nullable|array',
            'culture.*.title' => 'required|string|max:255',
            'culture.*.description' => 'required|string',
            'culture.*.existing_image' => 'nullable|string',
            'culture.*.image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        Setting::set('culture_title', $request->culture_title);
        Setting::set('culture_subtitle', $request->culture_subtitle);

        $cultureList = [];
        if ($request->has('culture') && is_array($request->culture)) {
            foreach ($request->culture as $index => $itemData) {
                $imagePath = $itemData['existing_image'] ?? '';

                // Handle file upload for this specific culture card if provided
                if ($request->hasFile("culture.{$index}.image_file")) {
                    // Delete old one if starts with /uploads/
                    if ($imagePath && str_starts_with($imagePath, '/uploads/')) {
                        File::delete(public_path(substr($imagePath, 1)));
                    }

                    $file = $request->file("culture.{$index}.image_file");
                    $fileName = 'culture_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads'), $fileName);
                    $imagePath = '/uploads/' . $fileName;
                }

                $cultureList[] = [
                    'title' => $itemData['title'],
                    'description' => $itemData['description'],
                    'image' => $imagePath
                ];
            }
        }

        Setting::set('culture_list', json_encode($cultureList));

        return redirect()->back()->with('success', 'Work Culture settings updated successfully!');
    }
}
