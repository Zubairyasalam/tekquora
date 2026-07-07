@extends('layouts.admin')

@section('title', 'Manage Projects - Admin Dashboard')

@section('page_title', 'Projects CRUD')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 32px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="dash-table-card" style="padding: 28px;">
        <h2 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
            Projects Section Header Configuration
        </h2>

        <form action="{{ route('admin.projects.settings') }}" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf
            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div>
                    <label for="projects_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Title</label>
                    <input type="text" name="projects_title" id="projects_title" value="{{ $projectsTitle }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">
                    @error('projects_title')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="projects_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Subtitle</label>
                    <textarea name="projects_subtitle" id="projects_subtitle" rows="3" required style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s; resize: vertical;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">{{ $projectsSubtitle }}</textarea>
                    @error('projects_subtitle')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div style="display: flex; justify-content: flex-end; border-top: 1px solid #f0f3f8; padding-top: 20px;">
                <button type="submit" class="dash-btn-primary" style="padding: 10px 24px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Header Settings
                </button>
            </div>
        </form>
    </div>

    <div class="dash-table-card">
        <div class="dash-table-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Projects Directory</h2>
            <div class="dash-table-actions">
                <a href="/admin/projects/create" class="dash-btn-primary" style="background-color: #22c55e;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Add New Project
                </a>
            </div>
        </div>

        <div class="dash-table-wrapper">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Image</th>
                        <th>Project Title</th>
                        <th>Category</th>
                        <th>Tech Stack</th>
                        <th style="width: 100px;">Sort Order</th>
                        <th style="width: 150px; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>
                                <div style="width: 60px; height: 45px; border-radius: 8px; overflow: hidden; background-color: #f8faff; border: 1px solid #e0e8ff; display: flex; align-items: center; justify-content: center;">
                                    @if($project->image_1)
                                        <img src="{{ asset($project->image_1) }}" alt="{{ $project->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <span style="font-size: 10px; color: #a3aed1;">No Image</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #2b3674; font-size: 15px;">{{ $project->title }}</div>
                                <div style="font-size: 12px; color: #a3aed1; max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $project->description }}
                                </div>
                            </td>
                            <td>
                                <span style="font-weight: 600; text-transform: uppercase; font-size: 12px; padding: 4px 10px; border-radius: 6px; background-color: {{ $project->category == 'ai' ? '#e0e8ff' : ($project->category == 'web' ? '#e8f5e9' : '#fff3e0') }}; color: {{ $project->category == 'ai' ? '#4318ff' : ($project->category == 'web' ? '#2e7d32' : '#ef6c00') }};">
                                    {{ $project->category }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; flex-wrap: wrap; gap: 4px; max-width: 300px;">
                                    @if(is_array($project->tech_tags))
                                        @foreach($project->tech_tags as $tag)
                                            <span style="font-size: 11px; background-color: #f0f3f8; color: #64748b; padding: 2px 8px; border-radius: 4px; font-weight: 500;">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 600; text-align: center; color: #2b3674;">
                                    {{ $project->sort_order }}
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                                    <a href="/admin/projects/{{ $project->id }}/edit" class="dash-btn-primary" style="padding: 6px 12px; font-size: 12px; gap: 4px;" title="Edit Project">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Edit
                                    </a>
                                    
                                    <form action="/admin/projects/{{ $project->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dash-btn-primary" style="background-color: #ef4444; padding: 6px 12px; font-size: 12px; gap: 4px;" title="Delete Project">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></button>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #a3aed1;">
                                No projects found in database. Click "Add New Project" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
