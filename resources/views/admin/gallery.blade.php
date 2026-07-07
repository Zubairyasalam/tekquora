@extends('layouts.admin')

@section('title', 'Manage Moments Gallery - Admin Dashboard')

@section('page_title', 'Moments Gallery Configuration')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 24px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" style="background-color: #fee2e2; color: #b91c1c; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; flex-direction: column; gap: 8px; box-shadow: 0 4px 15px rgba(185, 28, 28, 0.05);">
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                <span>Please fix the following errors:</span>
            </div>
            <ul style="margin: 0; padding-left: 24px; font-size: 13px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="dash-table-card" style="padding: 28px;">
        <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            Gallery Headings & Upload New Photos
        </h3>
        
        <form action="{{ route('admin.gallery.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
                <div>
                    <label for="gallery_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Title</label>
                    <input type="text" name="gallery_title" id="gallery_title" value="{{ $galleryTitle }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'" required>
                </div>
                <div>
                    <label for="gallery_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Subtitle</label>
                    <input type="text" name="gallery_subtitle" id="gallery_subtitle" value="{{ $gallerySubtitle }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">
                </div>
            </div>

            <div style="background-color: #f8faff; border: 2px dashed #4318ff; border-radius: 14px; padding: 28px; margin-bottom: 24px; text-align: center; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f1f5ff'" onmouseout="this.style.backgroundColor='#f8faff'">
                <div style="margin-bottom: 12px; color: #4318ff;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                </div>
                <label for="new_images" style="display: block; font-size: 16px; font-weight: 700; color: #2b3674; margin-bottom: 6px; cursor: pointer;">Upload Gallery Photos</label>
                <p style="font-size: 13px; color: #a3aed1; margin-bottom: 16px;">Select multiple photos to add to the Glimpses carousel. Supported formats: JPG, PNG, WEBP (Max 3MB per image).</p>
                
                <input type="file" name="new_images[]" id="new_images" accept="image/*" multiple style="display: block; margin: 0 auto; max-width: 320px; font-size: 13px; color: #2b3674; file-selector-button-background: #4318ff; file-selector-button-color: white; file-selector-button-border: none; file-selector-button-padding: 10px 20px; file-selector-button-border-radius: 8px; file-selector-button-font-weight: 600; file-selector-button-cursor: pointer;">
            </div>

            <div style="display: flex; justify-content: flex-end; border-top: 1px solid #f0f3f8; padding-top: 20px;">
                <button type="submit" class="dash-btn-primary" style="padding: 12px 28px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1-2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save & Upload Gallery Photos
                </button>
            </div>
        </form>
    </div>

    <div class="dash-table-card" style="padding: 28px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Current Gallery Photos ({{ count($galleryImages) }})
            </h3>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 24px;">
            @forelse($galleryImages as $image)
                <div style="border: 1px solid #e0e8ff; border-radius: 14px; overflow: hidden; background: white; display: flex; flex-direction: column; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: all 0.3s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 25px rgba(67, 24, 255, 0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.03)'">
                    <div style="width: 100%; height: 160px; overflow: hidden; background: #f8faff; position: relative;">
                        <img src="{{ asset($image) }}" alt="Gallery photo" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <div style="padding: 14px; background: white; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f0f3f8;">
                        <span style="font-size: 12px; color: #a3aed1; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 120px;" title="{{ basename($image) }}">{{ basename($image) }}</span>
                        <form action="{{ route('admin.gallery.delete') }}" method="POST" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this photo?');">
                            @csrf
                            <input type="hidden" name="image_path" value="{{ $image }}">
                            <button type="submit" style="background-color: #fee2e2; color: #ef4444; border: none; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 4px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#fecaca'" onmouseout="this.style.backgroundColor='#fee2e2'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; background: #f8faff; border-radius: 14px; border: 1px solid #e0e8ff;">
                    <div style="color: #a3aed1; margin-bottom: 12px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #2b3674; margin-bottom: 6px;">No Gallery Photos Yet</h4>
                    <p style="font-size: 14px; color: #a3aed1; margin: 0;">Use the upload box above to add photos to the Glimpses of TekQuora Moments carousel.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
