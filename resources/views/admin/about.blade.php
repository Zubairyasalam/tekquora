@extends('layouts.admin')

@section('title', 'About Section Settings - Admin Dashboard')

@section('page_title', 'About Section Configuration')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 32px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="/admin/about" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 32px; align-items: start;">
            
            <!-- Left Column: About Media Settings -->
            <div class="dash-table-card" style="padding: 28px;">
                <h2 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    About Section Image
                </h2>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Current Logo/Image Preview</label>
                    <div style="background-color: #f8faff; border: 2px dashed #e0e8ff; border-radius: 12px; padding: 20px; display: flex; align-items: center; justify-content: center; min-height: 180px; position: relative;">
                        @if($aboutImage)
                            <img id="about-preview-img" src="{{ asset($aboutImage) }}" alt="About Media" style="max-height: 160px; object-fit: contain; max-width: 100%;">
                        @else
                            <span style="color: #a3aed1; font-size: 14px;">No image set</span>
                        @endif
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="about_image" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Upload New Image</label>
                    <input type="file" name="about_image" id="about_image" accept="image/*" onchange="previewAboutImage(this)" style="display: block; width: 100%; font-size: 14px; color: #a3aed1; file-selector-button-background: #4318ff; file-selector-button-color: white; file-selector-button-border: none; file-selector-button-padding: 8px 16px; file-selector-button-border-radius: 8px; file-selector-button-cursor: pointer;">
                    @error('about_image')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Right Column: Content Detail settings -->
            <div class="dash-table-card" style="padding: 28px; display: flex; flex-direction: column; gap: 24px;">
                <h2 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    About Content Details
                </h2>

                <!-- Eyebrow Title -->
                <div>
                    <label for="about_eyebrow" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Eyebrow Title</label>
                    <input type="text" name="about_eyebrow" id="about_eyebrow" value="{{ $aboutEyebrow }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">
                    @error('about_eyebrow')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Paragraph 1 -->
                <div>
                    <label for="about_description_1" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Description Paragraph 1</label>
                    <textarea name="about_description_1" id="about_description_1" rows="3" required style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s; resize: vertical;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">{{ $aboutDesc1 }}</textarea>
                    @error('about_description_1')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Paragraph 2 -->
                <div>
                    <label for="about_description_2" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Description Paragraph 2</label>
                    <textarea name="about_description_2" id="about_description_2" rows="3" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s; resize: vertical;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">{{ $aboutDesc2 }}</textarea>
                    @error('about_description_2')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Checklist Points Editor -->
                <div style="border-top: 1px solid #f0f3f8; padding-top: 24px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Key Checklist Points
                        </h3>
                        <button type="button" onclick="addNewPointRow()" class="dash-btn-primary" style="background-color: #22c55e; padding: 4px 10px; font-size: 12px; border-radius: 6px;">
                            + Add Point
                        </button>
                    </div>

                    <div id="points-container" style="display: flex; flex-direction: column; gap: 8px;">
                        @forelse($aboutPoints as $index => $point)
                            <div class="point-row" style="display: flex; align-items: center; gap: 8px;">
                                <input type="text" name="about_points[]" value="{{ $point }}" required placeholder="e.g. 10+ years of industry expertise" style="flex: 1; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white;">
                                <button type="button" onclick="deletePointRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 6px; display: flex; align-items: center; justify-content: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </div>
                        @empty
                            <div class="point-row" style="display: flex; align-items: center; gap: 8px;">
                                <input type="text" name="about_points[]" required placeholder="e.g. 10+ years of industry expertise" style="flex: 1; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white;">
                                <button type="button" onclick="deletePointRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 6px; display: flex; align-items: center; justify-content: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Stats Box & Button Config Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; border-top: 1px solid #f0f3f8; padding-top: 24px;">
                    
                    <!-- Stat Box Details -->
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Stat Badge Details
                        </h3>
                        
                        <div>
                            <label for="about_stat_value" style="display: block; font-size: 13px; font-weight: 500; color: #a3aed1; margin-bottom: 6px;">Value (e.g. 6,561+)</label>
                            <input type="text" name="about_stat_value" id="about_stat_value" value="{{ $aboutStatValue }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none;">
                        </div>

                        <div>
                            <label for="about_stat_label" style="display: block; font-size: 13px; font-weight: 500; color: #a3aed1; margin-bottom: 6px;">Label (e.g. Satisfied Clients)</label>
                            <input type="text" name="about_stat_label" id="about_stat_label" value="{{ $aboutStatLabel }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none;">
                        </div>
                    </div>

                    <!-- Button Action Details -->
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/></svg>
                            Call-To-Action Button
                        </h3>
                        
                        <div>
                            <label for="about_btn_text" style="display: block; font-size: 13px; font-weight: 500; color: #a3aed1; margin-bottom: 6px;">Button Text</label>
                            <input type="text" name="about_btn_text" id="about_btn_text" value="{{ $aboutBtnText }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none;">
                        </div>

                        <div>
                            <label for="about_btn_url" style="display: block; font-size: 13px; font-weight: 500; color: #a3aed1; margin-bottom: 6px;">Button Link URL</label>
                            <input type="text" name="about_btn_url" id="about_btn_url" value="{{ $aboutBtnUrl }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none;">
                        </div>
                    </div>

                </div>

                <div style="display: flex; justify-content: flex-end; border-top: 1px solid #f0f3f8; padding-top: 24px;">
                    <button type="submit" class="dash-btn-primary" style="padding: 12px 28px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Save About Settings
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    function previewAboutImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById('about-preview-img');
                if (previewImg) {
                    previewImg.src = e.target.result;
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function addNewPointRow() {
        const container = document.getElementById('points-container');
        const newRow = document.createElement('div');
        newRow.className = 'point-row';
        newRow.style = "display: flex; align-items: center; gap: 8px;";
        newRow.innerHTML = `
            <input type="text" name="about_points[]" required placeholder="e.g. 10+ years of industry expertise" style="flex: 1; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white;">
            <button type="button" onclick="deletePointRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 6px; display: flex; align-items: center; justify-content: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
            </button>
        `;
        container.appendChild(newRow);
    }

    function deletePointRow(button) {
        const rows = document.getElementsByClassName('point-row');
        if (rows.length > 1) {
            button.closest('.point-row').remove();
        } else {
            alert('You must have at least one checklist point.');
        }
    }
</script>
@endsection
