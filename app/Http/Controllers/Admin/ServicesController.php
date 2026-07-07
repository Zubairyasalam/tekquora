<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $servicesTitle = Setting::get('services_title', 'Our Services');
        $servicesSubtitle = Setting::get('services_subtitle', '');
        $servicesListJson = Setting::get('services_list');
        $servicesList = $servicesListJson ? json_decode($servicesListJson, true) : [];

        return view('admin.services', compact('servicesTitle', 'servicesSubtitle', 'servicesList'));
    }

    public function saveSection(Request $request)
    {
        $request->validate([
            'services_title' => 'required|string|max:100',
            'services_subtitle' => 'nullable|string',
        ]);

        Setting::set('services_title', $request->services_title);
        Setting::set('services_subtitle', $request->services_subtitle ?? '');

        return redirect()->back()->with('success', 'Services section header updated successfully!');
    }

    public function saveList(Request $request)
    {
        $request->validate([
            'services' => 'nullable|array',
            'services.*.title' => 'required|string|max:100',
            'services.*.description' => 'required|string',
            'services.*.icon' => 'required|string|in:code,mobile,ai,iot,cloud,database',
            'services.*.link_url' => 'required|string|max:255',
        ]);

        $services = [];
        if ($request->has('services') && is_array($request->services)) {
            $idCounter = 1;
            foreach ($request->services as $serviceData) {
                $services[] = [
                    'id' => $idCounter++,
                    'title' => $serviceData['title'],
                    'description' => $serviceData['description'],
                    'icon' => $serviceData['icon'],
                    'link_url' => $serviceData['link_url'],
                ];
            }
        }

        Setting::set('services_list', json_encode($services));

        return redirect()->back()->with('success', 'Services list updated successfully!');
    }
}
