@extends('layouts.admin')

@section('title', 'Sections Settings - Admin Dashboard')

@section('page_title', 'Configure Homepage Sections')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 24px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabbed Navigation -->
    <div style="display: flex; gap: 12px; border-bottom: 2px solid #e0e8ff; padding-bottom: 8px; overflow-x: auto; white-space: nowrap;">
        <button onclick="switchTab('culture-tab', this)" class="tab-btn active-tab" style="padding: 10px 20px; font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 15px; border: none; background: none; color: #4318ff; border-bottom: 3px solid #4318ff; cursor: pointer; transition: all 0.2s;">
            Work Culture
        </button>
        <button onclick="switchTab('join-tab', this)" class="tab-btn" style="padding: 10px 20px; font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 15px; border: none; background: none; color: #a3aed1; border-bottom: 3px solid transparent; cursor: pointer; transition: all 0.2s;">
            Why Join Us
        </button>
        <button onclick="switchTab('gallery-tab', this)" class="tab-btn" style="padding: 10px 20px; font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 15px; border: none; background: none; color: #a3aed1; border-bottom: 3px solid transparent; cursor: pointer; transition: all 0.2s;">
            Moments Gallery
        </button>
        <button onclick="switchTab('contact-footer-tab', this)" class="tab-btn" style="padding: 10px 20px; font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 15px; border: none; background: none; color: #a3aed1; border-bottom: 3px solid transparent; cursor: pointer; transition: all 0.2s;">
            Contact & Footer
        </button>
    </div>

    <!-- TAB 1: WORK CULTURE -->
    <div id="culture-tab" class="tab-content" style="display: block;">
        <form action="/admin/sections/culture" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px;">Work Culture Section Headings</h3>
                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px;">
                    <div>
                        <label for="culture_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Title</label>
                        <input type="text" name="culture_title" id="culture_title" value="{{ $cultureTitle }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                    <div>
                        <label for="culture_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Subtitle</label>
                        <input type="text" name="culture_subtitle" id="culture_subtitle" value="{{ $cultureSubtitle }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                </div>
            </div>

            <div class="dash-table-card" style="padding: 28px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin: 0;">Culture Cards List</h3>
                    <button type="button" onclick="addNewCultureRow()" class="dash-btn-primary" style="background-color: #22c55e; padding: 6px 14px; font-size: 13px;">
                        + Add Culture Card
                    </button>
                </div>

                <div id="culture-list-container" style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 24px;">
                    @forelse($cultureList as $index => $item)
                        <div class="culture-row" style="background-color: #f8faff; border: 1px solid #e0e8ff; border-radius: 14px; padding: 20px; display: grid; grid-template-columns: 80px 2fr 3fr auto; gap: 16px; align-items: start; position: relative;">
                            
                            <!-- Thumbnail Preview & Upload -->
                            <div style="text-align: center;">
                                <div style="width: 70px; height: 70px; border-radius: 10px; overflow: hidden; background-color: white; border: 1px solid #e0e8ff; display: flex; align-items: center; justify-content: center; margin-bottom: 8px;">
                                    <img id="culture_img_preview_{{ $index }}" src="{{ $item['image'] ? asset($item['image']) : 'https://placehold.co/100?text=Icon' }}" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <input type="hidden" name="culture[{{ $index }}][existing_image]" value="{{ $item['image'] }}">
                                <input type="file" name="culture[{{ $index }}][image_file]" accept="image/*" onchange="previewCultureImage(this, 'culture_img_preview_{{ $index }}')" style="font-size: 11px; width: 80px; overflow: hidden;">
                            </div>

                            <!-- Card Title -->
                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 6px;">Card Title</label>
                                <input type="text" name="culture[{{ $index }}][title]" value="{{ $item['title'] }}" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; font-weight: 600; color: #2b3674; background: white;">
                            </div>

                            <!-- Card Description -->
                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 6px;">Description</label>
                                <textarea name="culture[{{ $index }}][description]" required rows="2" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; color: #2b3674; resize: vertical; background: white;">{{ $item['description'] }}</textarea>
                            </div>

                            <!-- Action buttons -->
                            <div style="display: flex; flex-direction: column; gap: 8px; align-self: center;">
                                <button type="button" onclick="deleteCultureRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 8px; border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Delete Culture Card">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div id="no-culture-msg" style="text-align: center; padding: 40px; color: #a3aed1; font-size: 14px;">
                            No culture cards created yet. Click "+ Add Culture Card" to build one.
                        </div>
                    @endforelse
                </div>

                <div style="display: flex; justify-content: flex-end; border-top: 1px solid #f0f3f8; padding-top: 20px;">
                    <button type="submit" class="dash-btn-primary" style="padding: 12px 28px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Save Work Culture Section
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TAB 2: WHY JOIN US -->
    <div id="join-tab" class="tab-content" style="display: none;">
        <form action="/admin/sections/join" method="POST">
            @csrf
            <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px;">Why Join Us Headings</h3>
                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px;">
                    <div>
                        <label for="join_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Title</label>
                        <input type="text" name="join_title" id="join_title" value="{{ $joinTitle }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                    <div>
                        <label for="join_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Subtitle</label>
                        <input type="text" name="join_subtitle" id="join_subtitle" value="{{ $joinSubtitle }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                </div>
            </div>

            <div class="dash-table-card" style="padding: 28px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin: 0;">Feature Benefits List</h3>
                    <button type="button" onclick="addNewJoinRow()" class="dash-btn-primary" style="background-color: #22c55e; padding: 6px 14px; font-size: 13px;">
                        + Add Feature Benefit
                    </button>
                </div>

                <div id="join-list-container" style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px;">
                    @forelse($joinList as $index => $item)
                        <div class="join-row" style="background-color: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 16px; display: grid; grid-template-columns: 1fr 2fr 1fr auto; gap: 12px; align-items: center;">
                            
                            <!-- Card Title -->
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 4px;">Title</label>
                                <input type="text" name="join[{{ $index }}][title]" value="{{ $item['title'] }}" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; font-weight: 600; color: #2b3674; background: white;">
                            </div>

                            <!-- Card Description -->
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 4px;">Description / Details</label>
                                <input type="text" name="join[{{ $index }}][description]" value="{{ $item['description'] }}" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; color: #2b3674; background: white;">
                            </div>

                            <!-- Icon Dropdown -->
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 4px;">Display Icon</label>
                                <select name="join[{{ $index }}][icon]" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; color: #2b3674; background: white;">
                                    <option value="popper" {{ $item['icon'] == 'popper' ? 'selected' : '' }}>🎉 Celebrations</option>
                                    <option value="clock" {{ $item['icon'] == 'clock' ? 'selected' : '' }}>🕒 Work-Life Balance</option>
                                    <option value="home" {{ $item['icon'] == 'home' ? 'selected' : '' }}>🏠 Family Culture</option>
                                    <option value="monitor" {{ $item['icon'] == 'monitor' ? 'selected' : '' }}>💻 Training Programs</option>
                                    <option value="coffee" {{ $item['icon'] == 'coffee' ? 'selected' : '' }}>☕ Free Snacks/Coffee</option>
                                    <option value="heart" {{ $item['icon'] == 'heart' ? 'selected' : '' }}>❤️ Health Benefits</option>
                                </select>
                            </div>

                            <!-- Action button -->
                            <div>
                                <button type="button" onclick="deleteJoinRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 8px;" title="Delete Card">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div id="no-join-msg" style="text-align: center; padding: 40px; color: #a3aed1; font-size: 14px;">
                            No why join benefits set. Click "+ Add Feature Benefit" to add one.
                        </div>
                    @endforelse
                </div>

                <div style="display: flex; justify-content: flex-end; border-top: 1px solid #f0f3f8; padding-top: 20px;">
                    <button type="submit" class="dash-btn-primary" style="padding: 12px 28px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Save Why Join Us Section
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TAB 3: MOMENTS GALLERY -->
    <div id="gallery-tab" class="tab-content" style="display: none;">
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px;">Gallery Headings</h3>
            <form action="/admin/sections/gallery" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label for="gallery_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Title</label>
                        <input type="text" name="gallery_title" id="gallery_title" value="{{ $galleryTitle }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                    <div>
                        <label for="gallery_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Subtitle</label>
                        <input type="text" name="gallery_subtitle" id="gallery_subtitle" value="{{ $gallerySubtitle }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                </div>

                <div style="background-color: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 20px; margin-bottom: 20px;">
                    <label for="new_images" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Upload Gallery Photos</label>
                    <input type="file" name="new_images[]" id="new_images" accept="image/*" multiple style="display: block; width: 100%; font-size: 13px; color: #a3aed1; file-selector-button-background: #4318ff; file-selector-button-color: white; file-selector-button-border: none; file-selector-button-padding: 8px 16px; file-selector-button-border-radius: 8px; file-selector-button-cursor: pointer;">
                    <span style="font-size: 12px; color: #a3aed1; display: block; margin-top: 4px;">You can select multiple photos at once. Maximum 3MB per photo.</span>
                </div>

                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="dash-btn-primary" style="padding: 12px 28px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        Upload and Save Gallery
                    </button>
                </div>
            </form>
        </div>

        <div class="dash-table-card" style="padding: 28px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px;">Manage Gallery Images</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 20px;">
                @forelse($galleryImages as $image)
                    <div style="border: 1px solid #e0e8ff; border-radius: 12px; overflow: hidden; background: #f8faff; display: flex; flex-direction: column; align-items: center; padding: 10px; position: relative; box-shadow: 0 4px 10px rgba(0,0,0,0.02); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                        <div style="width: 100%; height: 120px; border-radius: 8px; overflow: hidden; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; background: white;">
                            <img src="{{ asset($image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <form action="/admin/sections/gallery/delete" method="POST" style="margin: 0; width: 100%;">
                            @csrf
                            <input type="hidden" name="image_path" value="{{ $image }}">
                            <button type="submit" class="dash-btn-primary" style="background-color: #ef4444; width: 100%; justify-content: center; padding: 6px 12px; font-size: 12px; gap: 4px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                Delete
                            </button>
                        </form>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #a3aed1;">
                        No images uploaded to moments gallery yet. Use the uploader above.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- TAB 4: CONTACT & FOOTER -->
    <div id="contact-footer-tab" class="tab-content" style="display: none;">
        <form action="/admin/sections/contact-footer" method="POST">
            @csrf
            
            <!-- Contact Info card -->
            <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px;">Contact Information Settings</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label for="contact_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Contact Title</label>
                        <input type="text" name="contact_title" id="contact_title" value="{{ $contactTitle }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                    <div>
                        <label for="contact_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Contact Subtitle</label>
                        <input type="text" name="contact_subtitle" id="contact_subtitle" value="{{ $contactSubtitle }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
                    <div>
                        <label for="contact_email" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Office Email</label>
                        <input type="email" name="contact_email" id="contact_email" value="{{ $contactEmail }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                    <div>
                        <label for="contact_phone" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Office Phone</label>
                        <input type="text" name="contact_phone" id="contact_phone" value="{{ $contactPhone }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                    <div>
                        <label for="contact_location" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Office Location</label>
                        <input type="text" name="contact_location" id="contact_location" value="{{ $contactLocation }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                    <div>
                        <label for="contact_working_hours" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Working Hours</label>
                        <input type="text" name="contact_working_hours" id="contact_working_hours" value="{{ $contactWorkingHours }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                </div>
            </div>

            <!-- Contact CTA settings -->
            <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px;">Contact CTA Card</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label for="cta_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">CTA Heading</label>
                        <input type="text" name="cta_title" id="cta_title" value="{{ $contactCta['title'] ?? '' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                    <div>
                        <label for="cta_description" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">CTA Description</label>
                        <input type="text" name="cta_description" id="cta_description" value="{{ $contactCta['description'] ?? '' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label for="cta_btn_text" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">CTA Button Text</label>
                        <input type="text" name="cta_btn_text" id="cta_btn_text" value="{{ $contactCta['btn_text'] ?? '' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                    <div>
                        <label for="cta_btn_url" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">CTA Button Redirect URL</label>
                        <input type="text" name="cta_btn_url" id="cta_btn_url" value="{{ $contactCta['btn_url'] ?? '' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                    </div>
                </div>
            </div>

            <!-- Footer Details card -->
            <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px;">Website Footer Settings</h3>
                <div style="margin-bottom: 20px;">
                    <label for="footer_description" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Footer Description Text</label>
                    <textarea name="footer_description" id="footer_description" rows="3" style="width: 100%; padding: 12px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; resize: vertical;" required>{{ $footerDescription }}</textarea>
                </div>
                <div>
                    <label for="footer_copyright" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Footer Copyright Text</label>
                    <input type="text" name="footer_copyright" id="footer_copyright" value="{{ $footerCopyright }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px;" required>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; border-top: 1px solid #f0f3f8; padding-top: 20px;">
                <button type="submit" class="dash-btn-primary" style="padding: 12px 28px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Contact & Footer Details
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    function switchTab(tabId, button) {
        // Hide all tab content
        const tabContents = document.getElementsByClassName('tab-content');
        for (let i = 0; i < tabContents.length; i++) {
            tabContents[i].style.display = 'none';
        }

        // Deactivate all tab buttons
        const tabBtns = document.getElementsByClassName('tab-btn');
        for (let i = 0; i < tabBtns.length; i++) {
            tabBtns[i].style.color = '#a3aed1';
            tabBtns[i].style.borderBottomColor = 'transparent';
            tabBtns[i].classList.remove('active-tab');
        }

        // Show selected tab content
        document.getElementById(tabId).style.display = 'block';

        // Activate clicked tab button
        button.style.color = '#4318ff';
        button.style.borderBottomColor = '#4318ff';
        button.classList.add('active-tab');
    }

    // Work Culture Dynamic Row helpers
    function previewCultureImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function addNewCultureRow() {
        const container = document.getElementById('culture-list-container');
        const noMsg = document.getElementById('no-culture-msg');
        if (noMsg) {
            noMsg.remove();
        }

        const index = container.getElementsByClassName('culture-row').length;
        const newRow = document.createElement('div');
        newRow.className = 'culture-row';
        newRow.style = "background-color: #f8faff; border: 1px solid #e0e8ff; border-radius: 14px; padding: 20px; display: grid; grid-template-columns: 80px 2fr 3fr auto; gap: 16px; align-items: start; position: relative;";
        newRow.innerHTML = `
            <div style="text-align: center;">
                <div style="width: 70px; height: 70px; border-radius: 10px; overflow: hidden; background-color: white; border: 1px solid #e0e8ff; display: flex; align-items: center; justify-content: center; margin-bottom: 8px;">
                    <img id="culture_img_preview_${index}" src="https://placehold.co/100?text=Upload" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
                <input type="hidden" name="culture[${index}][existing_image]" value="">
                <input type="file" name="culture[${index}][image_file]" accept="image/*" onchange="previewCultureImage(this, 'culture_img_preview_${index}')" style="font-size: 11px; width: 80px; overflow: hidden;" required>
            </div>
            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 6px;">Card Title</label>
                <input type="text" name="culture[${index}][title]" placeholder="e.g. Innovation First" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; font-weight: 600; color: #2b3674; background: white;">
            </div>
            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 6px;">Description</label>
                <textarea name="culture[${index}][description]" placeholder="e.g. We encourage experimentation..." required rows="2" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; color: #2b3674; resize: vertical; background: white;"></textarea>
            </div>
            <div style="display: flex; flex-direction: column; gap: 8px; align-self: center;">
                <button type="button" onclick="deleteCultureRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 8px;" title="Delete Culture Card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                </button>
            </div>
        `;
        container.appendChild(newRow);
        reindexCultureRows();
    }

    function deleteCultureRow(button) {
        const row = button.closest('.culture-row');
        row.remove();
        
        const container = document.getElementById('culture-list-container');
        if (container.getElementsByClassName('culture-row').length === 0) {
            container.innerHTML = `
                <div id="no-culture-msg" style="text-align: center; padding: 40px; color: #a3aed1; font-size: 14px;">
                    No culture cards created yet. Click "+ Add Culture Card" to build one.
                </div>
            `;
        } else {
            reindexCultureRows();
        }
    }

    function reindexCultureRows() {
        const container = document.getElementById('culture-list-container');
        const rows = container.getElementsByClassName('culture-row');
        for (let i = 0; i < rows.length; i++) {
            const inputs = rows[i].querySelectorAll('input, textarea, select, img');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    const newName = name.replace(/culture\[\d+\]/, `culture[${i}]`);
                    input.setAttribute('name', newName);
                }
                const onchange = input.getAttribute('onchange');
                if (onchange) {
                    const newOnchange = onchange.replace(/culture_img_preview_\d+/, `culture_img_preview_${i}`);
                    input.setAttribute('onchange', newOnchange);
                }
                const id = input.getAttribute('id');
                if (id) {
                    const newId = id.replace(/culture_img_preview_\d+/, `culture_img_preview_${i}`);
                    input.setAttribute('id', newId);
                }
            });
        }
    }

    // Why Join Dynamic Row helpers
    function addNewJoinRow() {
        const container = document.getElementById('join-list-container');
        const noMsg = document.getElementById('no-join-msg');
        if (noMsg) {
            noMsg.remove();
        }

        const index = container.getElementsByClassName('join-row').length;
        const newRow = document.createElement('div');
        newRow.className = 'join-row';
        newRow.style = "background-color: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 16px; display: grid; grid-template-columns: 1fr 2fr 1fr auto; gap: 12px; align-items: center;";
        newRow.innerHTML = `
            <div>
                <label style="display: block; font-size: 11px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 4px;">Title</label>
                <input type="text" name="join[${index}][title]" placeholder="e.g. Celebrations" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; font-weight: 600; color: #2b3674; background: white;">
            </div>
            <div>
                <label style="display: block; font-size: 11px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 4px;">Description / Details</label>
                <input type="text" name="join[${index}][description]" placeholder="e.g. Regular events & recognition" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; color: #2b3674; background: white;">
            </div>
            <div>
                <label style="display: block; font-size: 11px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 4px;">Display Icon</label>
                <select name="join[${index}][icon]" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; color: #2b3674; background: white;">
                    <option value="popper">🎉 Celebrations</option>
                    <option value="clock">🕒 Work-Life Balance</option>
                    <option value="home">🏠 Family Culture</option>
                    <option value="monitor">💻 Training Programs</option>
                    <option value="coffee">☕ Free Snacks/Coffee</option>
                    <option value="heart">❤️ Health Benefits</option>
                </select>
            </div>
            <div>
                <button type="button" onclick="deleteJoinRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 8px;" title="Delete Card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                </button>
            </div>
        `;
        container.appendChild(newRow);
        reindexJoinRows();
    }

    function deleteJoinRow(button) {
        const row = button.closest('.join-row');
        row.remove();
        
        const container = document.getElementById('join-list-container');
        if (container.getElementsByClassName('join-row').length === 0) {
            container.innerHTML = `
                <div id="no-join-msg" style="text-align: center; padding: 40px; color: #a3aed1; font-size: 14px;">
                    No why join benefits set. Click "+ Add Feature Benefit" to add one.
                </div>
            `;
        } else {
            reindexJoinRows();
        }
    }

    function reindexJoinRows() {
        const container = document.getElementById('join-list-container');
        const rows = container.getElementsByClassName('join-row');
        for (let i = 0; i < rows.length; i++) {
            const inputs = rows[i].querySelectorAll('input, select');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    const newName = name.replace(/join\[\d+\]/, `join[${i}]`);
                    input.setAttribute('name', newName);
                }
            });
        }
    }
</script>
@endsection
