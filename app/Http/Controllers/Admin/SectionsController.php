<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SectionsController extends Controller
{
    public function index()
    {
        // Work Culture
        $cultureTitle = Setting::get('culture_title', 'Our Work Culture');
        $cultureSubtitle = Setting::get('culture_subtitle', 'More than just a workplace...');
        $cultureListJson = Setting::get('culture_list');
        $cultureList = $cultureListJson ? json_decode($cultureListJson, true) : [];

        // Why Join Us
        $joinTitle = Setting::get('join_title', 'Why Join TekQuora?');
        $joinSubtitle = Setting::get('join_subtitle', 'More than just a workplace...');
        $joinListJson = Setting::get('join_list');
        $joinList = $joinListJson ? json_decode($joinListJson, true) : [];

        // Gallery
        $galleryTitle = Setting::get('gallery_title', 'Glimpses of TekQuora Moments');
        $gallerySubtitle = Setting::get('gallery_subtitle', 'A sneak peek...');
        $galleryImagesJson = Setting::get('gallery_images');
        $galleryImages = $galleryImagesJson ? json_decode($galleryImagesJson, true) : [];

        // Contact Info
        $contactTitle = Setting::get('contact_title', 'Get In Touch');
        $contactSubtitle = Setting::get('contact_subtitle', 'Ready to transform...');
        $contactEmail = Setting::get('contact_email', 'tekquora@gmail.com');
        $contactPhone = Setting::get('contact_phone', '+91 7373306677');
        $contactLocation = Setting::get('contact_location', 'Chennai, Tamil Nadu, India');
        $contactWorkingHours = Setting::get('contact_working_hours', 'Mon - Fri: 9:00 AM - 6:00 PM');
        
        $contactCtaJson = Setting::get('contact_cta');
        $contactCta = $contactCtaJson ? json_decode($contactCtaJson, true) : [
            'title' => '',
            'description' => '',
            'btn_text' => '',
            'btn_url' => ''
        ];

        // Footer
        $footerDescription = Setting::get('footer_description', '');
        $footerCopyright = Setting::get('footer_copyright', '');

        return view('admin.sections', compact(
            'cultureTitle', 'cultureSubtitle', 'cultureList',
            'joinTitle', 'joinSubtitle', 'joinList',
            'galleryTitle', 'gallerySubtitle', 'galleryImages',
            'contactTitle', 'contactSubtitle', 'contactEmail', 'contactPhone', 'contactLocation', 'contactWorkingHours', 'contactCta',
            'footerDescription', 'footerCopyright'
        ));
    }

    public function saveCulture(Request $request)
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

    public function saveJoin(Request $request)
    {
        $request->validate([
            'join_title' => 'required|string|max:255',
            'join_subtitle' => 'required|string|max:500',
            'join' => 'nullable|array',
            'join.*.title' => 'required|string|max:255',
            'join.*.description' => 'required|string|max:500',
            'join.*.icon' => 'required|string|max:100',
        ]);

        Setting::set('join_title', $request->join_title);
        Setting::set('join_subtitle', $request->join_subtitle);

        $joinList = [];
        if ($request->has('join') && is_array($request->join)) {
            foreach ($request->join as $itemData) {
                $joinList[] = [
                    'title' => $itemData['title'],
                    'description' => $itemData['description'],
                    'icon' => $itemData['icon']
                ];
            }
        }

        Setting::set('join_list', json_encode($joinList));

        return redirect()->back()->with('success', 'Why Join Us settings updated successfully!');
    }

    public function saveGallery(Request $request)
    {
        $request->validate([
            'gallery_title' => 'required|string|max:255',
            'gallery_subtitle' => 'required|string|max:500',
            'new_images' => 'nullable|array',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
        ]);

        Setting::set('gallery_title', $request->gallery_title);
        Setting::set('gallery_subtitle', $request->gallery_subtitle);

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

        return redirect()->back()->with('success', 'Gallery settings updated successfully!');
    }

    public function deleteGalleryImage(Request $request)
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

        return redirect()->back()->with('success', 'Gallery image removed successfully!');
    }

    public function saveContactFooter(Request $request)
    {
        $request->validate([
            'contact_title' => 'required|string|max:255',
            'contact_subtitle' => 'required|string|max:500',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:100',
            'contact_location' => 'required|string|max:255',
            'contact_working_hours' => 'required|string|max:255',
            
            'cta_title' => 'required|string|max:255',
            'cta_description' => 'required|string|max:500',
            'cta_btn_text' => 'required|string|max:100',
            'cta_btn_url' => 'required|string|max:255',

            'footer_description' => 'required|string|max:1000',
            'footer_copyright' => 'required|string|max:255',
        ]);

        Setting::set('contact_title', $request->contact_title);
        Setting::set('contact_subtitle', $request->contact_subtitle);
        Setting::set('contact_email', $request->contact_email);
        Setting::set('contact_phone', $request->contact_phone);
        Setting::set('contact_location', $request->contact_location);
        Setting::set('contact_working_hours', $request->contact_working_hours);

        $contactCta = [
            'title' => $request->cta_title,
            'description' => $request->cta_description,
            'btn_text' => $request->cta_btn_text,
            'btn_url' => $request->cta_btn_url,
        ];
        Setting::set('contact_cta', json_encode($contactCta));

        Setting::set('footer_description', $request->footer_description);
        Setting::set('footer_copyright', $request->footer_copyright);

        return redirect()->back()->with('success', 'Contact and Footer settings updated successfully!');
    }
}
