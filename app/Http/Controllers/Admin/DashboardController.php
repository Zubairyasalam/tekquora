<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Inquiry;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $openInquiries = Inquiry::where('status', 'Open')->count();
        $closedInquiries = Inquiry::where('status', 'Closed')->count();
        $totalInquiries = Inquiry::count();

        $recentInquiries = Inquiry::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProjects',
            'openInquiries',
            'closedInquiries',
            'totalInquiries',
            'recentInquiries'
        ));
    }
}
