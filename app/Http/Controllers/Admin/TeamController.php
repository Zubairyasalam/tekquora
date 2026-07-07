<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    private function getDefaultMembers()
    {
        return [
            ['name' => 'Ramachandran Subramaniyan', 'role' => 'Director & CTO', 'type' => 'management', 'initials' => 'RS', 'gradient' => 'management-gradient', 'image' => '/assets/team-1.jpg', 'location' => 'Chennai', 'description' => 'Driving innovation and aligning technology with business goals.', 'linkedin' => '#'],
            ['name' => 'Joe Madhan Gunasekar', 'role' => 'Chief Financial & Operations Officer', 'type' => 'management', 'initials' => 'JG', 'gradient' => 'management-gradient', 'image' => '/assets/team-2.jpg', 'location' => 'Chennai', 'description' => 'Overseeing finance and operations to drive growth and efficiency.', 'linkedin' => '#'],
            ['name' => 'Karthick Balasubramaniyan', 'role' => 'Project Manager', 'type' => 'management', 'initials' => 'KB', 'gradient' => 'management-gradient', 'image' => '/assets/team-3.jpg', 'location' => 'Chennai', 'description' => 'Planning, coordinating, and executing projects to ensure timely delivery and client satisfaction.', 'linkedin' => '#'],
            ['name' => 'Kantha Subramanian', 'role' => 'Technical Architect', 'type' => 'management', 'initials' => 'KS', 'gradient' => 'management-gradient', 'image' => '/assets/team-4.jpg', 'location' => 'Chennai', 'description' => 'Leading development teams to deliver scalable, high-performance solutions.', 'linkedin' => '#'],
            ['name' => 'Arun Kumar', 'role' => 'Managing Director', 'type' => 'employee', 'initials' => 'AK', 'gradient' => 'management-gradient'],
            ['name' => 'Deepa Ram', 'role' => 'Chief Technology Officer', 'type' => 'employee', 'initials' => 'DR', 'gradient' => 'management-gradient'],
            ['name' => 'Priya Sharma', 'role' => 'HR Head', 'type' => 'employee', 'initials' => 'PS', 'gradient' => 'hr-gradient'],
            ['name' => 'Rajesh V', 'role' => 'Lead UI/UX Designer', 'type' => 'employee', 'initials' => 'RV', 'gradient' => 'design-gradient'],
            ['name' => 'Anjali Nair', 'role' => 'UI/UX Design Intern', 'type' => 'intern', 'initials' => 'AN', 'gradient' => 'design-gradient'],
            ['name' => 'Siddharth Sen', 'role' => 'Lead Full-Stack Developer', 'type' => 'employee', 'initials' => 'SS', 'gradient' => 'dev-gradient'],
            ['name' => 'Vijay Kumar', 'role' => 'Senior Developer', 'type' => 'employee', 'initials' => 'VK', 'gradient' => 'dev-gradient'],
            ['name' => 'Meera R', 'role' => 'Frontend Developer Intern', 'type' => 'intern', 'initials' => 'MR', 'gradient' => 'dev-gradient']
        ];
    }

    public function index()
    {
        $teamTitle = Setting::get('team_title', 'Meet Our Team');
        $teamSubtitle = Setting::get('team_subtitle', 'The talented individuals who make TekQuora a great place to work');

        $membersJson = Setting::get('team_members');
        $members = $membersJson ? json_decode($membersJson, true) : $this->getDefaultMembers();

        return view('admin.team', compact('teamTitle', 'teamSubtitle', 'members'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'team_title' => 'required|string|max:255',
            'team_subtitle' => 'required|string|max:500',
            'members' => 'nullable|array',
        ]);

        Setting::set('team_title', $request->team_title);
        Setting::set('team_subtitle', $request->team_subtitle);

        $members = [];
        if ($request->has('members') && is_array($request->members)) {
            foreach ($request->members as $i => $item) {
                if (!empty($item['name']) && !empty($item['role'])) {
                    $memberData = [
                        'name' => $item['name'],
                        'role' => $item['role'],
                        'type' => $item['type'] ?? 'employee',
                        'initials' => strtoupper(substr(trim($item['name'] ?? 'NM'), 0, 2)),
                        'gradient' => 'dev-gradient',
                    ];

                    $imageUrl = $item['image'] ?? '';
                    if ($request->hasFile("members.{$i}.image_file")) {
                        $file = $request->file("members.{$i}.image_file");
                        if ($file->isValid()) {
                            $fileName = 'member_' . uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('uploads'), $fileName);
                            $imageUrl = '/uploads/' . $fileName;
                        }
                    }

                    $memberData['image'] = $imageUrl;
                    $memberData['location'] = $item['location'] ?? '';

                    $members[] = $memberData;
                }
            }
        }

        Setting::set('team_members', json_encode($members));

        return redirect()->back()->with('success', 'Meet Our Team settings updated successfully!');
    }
}
