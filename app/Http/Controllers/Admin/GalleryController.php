<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryTitle = Setting::get('gallery_title', 'Glimpses of TekQuora Moments');
        $gallerySubtitle = Setting::get('gallery_subtitle', 'A sneak peek into our events, celebrations, and team experiences.');
        $galleryImagesJson = Setting::get('gallery_images');
        $galleryImages = $galleryImagesJson ? json_decode($galleryImagesJson, true) : [];

        return view('admin.gallery', compact('galleryTitle', 'gallerySubtitle', 'galleryImages'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'gallery_title' => 'required|string|max:255',
            'gallery_subtitle' => 'nullable|string|max:500',
            'new_images' => 'nullable|array',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
        ]);

        Setting::set('gallery_title', $request->gallery_title);
        Setting::set('gallery_subtitle', $request->gallery_subtitle ?? '');

        // Get current images
        $galleryImagesJson = Setting::get('gallery_images');
        $galleryImages = $galleryImagesJson ? json_decode($galleryImagesJson, true) : [];

        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $fileName = 'glimpse_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $fileName);
                $galleryImages[] = '/uploads/' . $fileName;
            }
        }

        Setting::set('gallery_images', json_encode($galleryImages));

        return redirect()->back()->with('success', 'Moments Gallery settings updated successfully!');
    }

    public function deleteImage(Request $request)
    {
        $request->validate([
            'image_path' => 'required|string',
        ]);

        $imagePath = $request->image_path;

        // Get current images
        $galleryImagesJson = Setting::get('gallery_images');
        $galleryImages = $galleryImagesJson ? json_decode($galleryImagesJson, true) : [];

        // Remove from list
        if (($key = array_search($imagePath, $galleryImages)) !== false) {
            unset($galleryImages[$key]);
            
            // Delete file if starts with /uploads/
            if (str_starts_with($imagePath, '/uploads/')) {
                File::delete(public_path(substr($imagePath, 1)));
            }
        }

        Setting::set('gallery_images', json_encode(array_values($galleryImages)));

        return redirect()->back()->with('success', 'Gallery photo removed successfully!');
    }
}
