<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        $projectsTitle = Setting::get('projects_title', 'Our Projects');
        $projectsSubtitle = Setting::get('projects_subtitle', 'Explore our latest projects showcasing innovation, technical excellence, and transformative digital solutions across various industries.');
        return view('admin.projects.index', compact('projects', 'projectsTitle', 'projectsSubtitle'));
    }

    public function saveSettings(Request $request)
    {
        $request->validate([
            'projects_title' => 'required|string|max:255',
            'projects_subtitle' => 'required|string',
        ]);

        Setting::set('projects_title', $request->projects_title);
        Setting::set('projects_subtitle', $request->projects_subtitle);

        return redirect()->route('admin.projects.index')->with('success', 'Projects section settings updated successfully!');
    }

    public function create()
    {
        $project = new Project();
        return view('admin.projects.form', compact('project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:web,mobile,ai',
            'description' => 'required|string',
            'tech_tags_string' => 'nullable|string',
            'image_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $project = new Project();
        $project->title = $request->title;
        $project->category = $request->category;
        $project->description = $request->description;
        $project->sort_order = $request->sort_order ?? 0;

        // Process tech tags
        if ($request->filled('tech_tags_string')) {
            $tags = array_map('trim', explode(',', $request->tech_tags_string));
            $project->tech_tags = array_values(array_filter($tags));
        } else {
            $project->tech_tags = [];
        }

        // Process image 1
        if ($request->hasFile('image_1')) {
            $file = $request->file('image_1');
            $fileName = 'project_1_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $project->image_1 = '/uploads/' . $fileName;
        }

        // Process image 2
        if ($request->hasFile('image_2')) {
            $file = $request->file('image_2');
            $fileName = 'project_2_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $project->image_2 = '/uploads/' . $fileName;
        }

        $project->save();

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:web,mobile,ai',
            'description' => 'required|string',
            'tech_tags_string' => 'nullable|string',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $project->title = $request->title;
        $project->category = $request->category;
        $project->description = $request->description;
        $project->sort_order = $request->sort_order ?? 0;

        // Process tech tags
        if ($request->filled('tech_tags_string')) {
            $tags = array_map('trim', explode(',', $request->tech_tags_string));
            $project->tech_tags = array_values(array_filter($tags));
        } else {
            $project->tech_tags = [];
        }

        // Process image 1
        if ($request->hasFile('image_1')) {
            // Delete old file if exists and starts with /uploads/
            if ($project->image_1 && str_starts_with($project->image_1, '/uploads/')) {
                File::delete(public_path(substr($project->image_1, 1)));
            }
            $file = $request->file('image_1');
            $fileName = 'project_1_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $project->image_1 = '/uploads/' . $fileName;
        }

        // Process image 2
        if ($request->hasFile('image_2')) {
            // Delete old file if exists and starts with /uploads/
            if ($project->image_2 && str_starts_with($project->image_2, '/uploads/')) {
                File::delete(public_path(substr($project->image_2, 1)));
            }
            $file = $request->file('image_2');
            $fileName = 'project_2_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $project->image_2 = '/uploads/' . $fileName;
        }

        $project->save();

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // Delete images
        if ($project->image_1 && str_starts_with($project->image_1, '/uploads/')) {
            File::delete(public_path(substr($project->image_1, 1)));
        }
        if ($project->image_2 && str_starts_with($project->image_2, '/uploads/')) {
            File::delete(public_path(substr($project->image_2, 1)));
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }
}
