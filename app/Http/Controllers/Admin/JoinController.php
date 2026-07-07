<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    public function index()
    {
        $joinTitle = Setting::get('join_title', 'Why Join TekQuora?');
        $joinSubtitle = Setting::get('join_subtitle', "More than just a workplace a family that grows together");
        $joinListJson = Setting::get('join_list');
        $joinList = $joinListJson ? json_decode($joinListJson, true) : [];

        return view('admin.join', compact('joinTitle', 'joinSubtitle', 'joinList'));
    }

    public function save(Request $request)
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
}
