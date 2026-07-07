@extends('layouts.admin')

@section('title', 'Hero Section Settings - Admin Dashboard')

@section('page_title', 'Hero Section Configuration')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 32px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="/admin/hero" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 32px; align-items: start;">
            
            <!-- Left Column: Background Image Settings -->
            <div class="dash-table-card" style="padding: 28px;">
                <h2 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    Hero Banner Image
                </h2>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Current Banner Preview</label>
                    <div style="background-color: #f8faff; border: 2px dashed #e0e8ff; border-radius: 12px; padding: 12px; display: flex; align-items: center; justify-content: center; min-height: 180px; position: relative; overflow: hidden;">
                        @if($heroImage)
                            <img id="hero-preview-img" src="{{ asset($heroImage) }}" alt="Hero Background" style="width: 100%; height: 180px; object-fit: cover; border-radius: 8px;">
                        @else
                            <span style="color: #a3aed1; font-size: 14px;">No banner image set</span>
                        @endif
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="hero_background_image" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Upload New Banner</label>
                    <input type="file" name="hero_background_image" id="hero_background_image" accept="image/*" onchange="previewHeroImage(this)" style="display: block; width: 100%; font-size: 14px; color: #a3aed1; file-selector-button-background: #4318ff; file-selector-button-color: white; file-selector-button-border: none; file-selector-button-padding: 8px 16px; file-selector-button-border-radius: 8px; file-selector-button-cursor: pointer;">
                    <small style="color: #a3aed1; display: block; margin-top: 8px;">Recommended resolution: 1920x1080px (landscape). Maximum size: 5MB.</small>
                    @error('hero_background_image')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Right Column: Title, Subtitle, & Button Configurations -->
            <div class="dash-table-card" style="padding: 28px; display: flex; flex-direction: column; gap: 24px;">
                <h2 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    Hero Content Details
                </h2>

                <!-- Title Configuration -->
                <div>
                    <label for="hero_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Main Title (HTML Allowed e.g. &lt;br&gt; for line break)</label>
                    <input type="text" name="hero_title" id="hero_title" value="{{ $heroTitle }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">
                    @error('hero_title')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subtitle Configuration -->
                <div>
                    <label for="hero_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Description / Subtitle Text</label>
                    <textarea name="hero_subtitle" id="hero_subtitle" rows="3" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s; resize: vertical;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">{{ $heroSubtitle }}</textarea>
                    @error('hero_subtitle')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons Config Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; border-top: 1px solid #f0f3f8; padding-top: 24px;">
                    
                    <!-- Primary Button (Yellow styled) -->
                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 6px;">
                            <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background-color: #fbbf24;"></span>
                            Primary Action Button
                        </h3>
                        
                        <div>
                            <label for="hero_primary_btn_text" style="display: block; font-size: 13px; font-weight: 500; color: #a3aed1; margin-bottom: 6px;">Button Label</label>
                            <input type="text" name="hero_primary_btn_text" id="hero_primary_btn_text" value="{{ $heroPrimaryText }}" placeholder="e.g. See Our Team" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none;">
                        </div>

                        <div>
                            <label for="hero_primary_btn_url" style="display: block; font-size: 13px; font-weight: 500; color: #a3aed1; margin-bottom: 6px;">Button Link URL</label>
                            <input type="text" name="hero_primary_btn_url" id="hero_primary_btn_url" value="{{ $heroPrimaryUrl }}" placeholder="e.g. /team" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none;">
                        </div>
                    </div>

                    <!-- Secondary Button (Glass/Border styled) -->
                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 6px;">
                            <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background-color: #a3aed1;"></span>
                            Secondary Action Button
                        </h3>
                        
                        <div>
                            <label for="hero_secondary_btn_text" style="display: block; font-size: 13px; font-weight: 500; color: #a3aed1; margin-bottom: 6px;">Button Label</label>
                            <input type="text" name="hero_secondary_btn_text" id="hero_secondary_btn_text" value="{{ $heroSecondaryText }}" placeholder="e.g. Explore Work Culture" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none;">
                        </div>

                        <div>
                            <label for="hero_secondary_btn_url" style="display: block; font-size: 13px; font-weight: 500; color: #a3aed1; margin-bottom: 6px;">Button Link URL</label>
                            <input type="text" name="hero_secondary_btn_url" id="hero_secondary_btn_url" value="{{ $heroSecondaryUrl }}" placeholder="e.g. /#culture" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none;">
                        </div>
                    </div>

                </div>

                <div style="display: flex; justify-content: flex-end; border-top: 1px solid #f0f3f8; padding-top: 24px;">
                    <button type="submit" class="dash-btn-primary" style="padding: 12px 28px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Save Hero Configuration
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    function previewHeroImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById('hero-preview-img');
                if (previewImg) {
                    previewImg.src = e.target.result;
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
