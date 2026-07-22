@extends('layouts.admin')

@section('title', ($project->exists ? 'Edit Project' : 'Create Project') . ' - Admin Dashboard')

@section('page_title', $project->exists ? 'Edit Project' : 'Create New Project')

@section('content')
<div class="dash-content-container" style="max-width: 900px; margin: 0 auto; display: flex; flex-direction: column; gap: 24px;">

    <!-- Back Button link -->
    <div>
        <a href="/admin/projects" class="dash-btn-primary" style="background-color: #64748b; padding: 8px 16px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to Projects List
        </a>
    </div>

    <div class="dash-table-card" style="padding: 32px;">
        <h2 style="font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: #2b3674; margin-bottom: 28px; display: flex; align-items: center; gap: 8px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
            {{ $project->exists ? 'Update Project Details' : 'Project Details' }}
        </h2>

        <form action="{{ $project->exists ? '/admin/projects/' . $project->id : '/admin/projects' }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($project->exists)
                @method('PUT')
            @endif

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 20px;">
                <!-- Project Title -->
                <div>
                    <label for="title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Project Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" placeholder="e.g. TVK Tiruchengodu Digital Portal" required style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">
                    @error('title')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Category</label>
                    <select name="category" id="category" required style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; background-color: white; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">
                        <option value="web" {{ old('category', $project->category) == 'web' ? 'selected' : '' }}>Web Development</option>
                        <option value="mobile" {{ old('category', $project->category) == 'mobile' ? 'selected' : '' }}>Mobile Solution</option>
                        <option value="ai" {{ old('category', $project->category) == 'ai' ? 'selected' : '' }}>AI & Machine Learning</option>
                    </select>
                    @error('category')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div style="margin-bottom: 20px;">
                <label for="description" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Project Description</label>
                <textarea name="description" id="description" rows="4" placeholder="Brief details about the project goals, user experiences, and client challenges..." required style="width: 100%; padding: 12px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; resize: vertical; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-bottom: 24px;">
                <!-- Tech Tags -->
                <div>
                    <label for="tech_tags_string" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Tech Stack Tags</label>
                    @php
                        $tagsString = '';
                        if(is_array($project->tech_tags)) {
                            $tagsString = implode(', ', $project->tech_tags);
                        }
                    @endphp
                    <input type="text" name="tech_tags_string" id="tech_tags_string" value="{{ old('tech_tags_string', $tagsString) }}" placeholder="Comma separated, e.g. React.js, Node.js, MySQL, Tailwind" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">
                    <span style="font-size: 12px; color: #a3aed1; display: block; margin-top: 4px;">Separate technologies using commas.</span>
                    @error('tech_tags_string')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" min="0" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">
                    @error('sort_order')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Images Row -->
            <div style="max-width: 500px; margin: 0 auto 32px auto;">
                
                <!-- Image 1: Main Thumbnail -->
                <div style="background-color: #f8faff; border: 1px solid #e0e8ff; border-radius: 14px; padding: 20px;">
                    <label style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 12px;">Main Project Image (Thumbnail)</label>
                    
                    <div style="background-color: white; border: 2px dashed #e0e8ff; border-radius: 10px; padding: 16px; display: flex; align-items: center; justify-content: center; min-height: 160px; margin-bottom: 16px;">
                        <img id="image_1_preview" src="{{ $project->image_1 ? asset($project->image_1) : 'https://placehold.co/300x200?text=No+Thumbnail+Image' }}" alt="Thumbnail Preview" style="max-height: 140px; max-width: 100%; object-fit: contain;">
                    </div>

                    <input type="file" name="image_1" id="image_1" accept="image/*" onchange="previewImage(this, 'image_1_preview')" {{ $project->exists ? '' : 'required' }} style="display: block; width: 100%; font-size: 13px; color: #a3aed1; file-selector-button-background: #4318ff; file-selector-button-color: white; file-selector-button-border: none; file-selector-button-padding: 6px 12px; file-selector-button-border-radius: 6px; file-selector-button-cursor: pointer;">
                    @error('image_1')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div style="display: flex; gap: 16px; border-top: 1px solid #f0f3f8; padding-top: 24px; justify-content: flex-end;">
                <a href="/admin/projects" class="dash-btn-primary" style="background-color: #a3aed1; padding: 12px 24px;">
                    Cancel
                </a>
                <button type="submit" class="dash-btn-primary" style="padding: 12px 32px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    {{ $project->exists ? 'Save Changes' : 'Create Project' }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
