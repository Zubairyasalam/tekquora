@extends('layouts.admin')

@section('title', 'Header Settings - Admin Dashboard')

@section('page_title', 'Header Configuration')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 32px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 32px; align-items: start;">
        
        <!-- Left Side: Logo Settings -->
        <div class="dash-table-card" style="padding: 28px;">
            <h2 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></svg>
                Logo Configuration
            </h2>

            <form action="/admin/header/logo" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Current Logo Preview</label>
                    <div style="background-color: #f8faff; border: 2px dashed #e0e8ff; border-radius: 12px; padding: 20px; display: flex; align-items: center; justify-content: center; min-height: 100px;">
                        @if($logoPath)
                            <img id="logo-preview-img" src="{{ asset($logoPath) }}" alt="Logo" style="height: 60px; object-fit: contain; max-width: 100%;">
                        @else
                            <span style="color: #a3aed1; font-size: 14px;">No logo image set</span>
                        @endif
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="logo_image" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Upload New Logo</label>
                    <input type="file" name="logo_image" id="logo_image" accept="image/*" onchange="previewLogo(this)" style="display: block; width: 100%; font-size: 14px; color: #a3aed1; file-selector-button-background: #4318ff; file-selector-button-color: white; file-selector-button-border: none; file-selector-button-padding: 8px 16px; file-selector-button-border-radius: 8px; file-selector-button-cursor: pointer;">
                    @error('logo_image')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 24px;">
                    <label for="logo_text" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Logo Text</label>
                    <input type="text" name="logo_text" id="logo_text" value="{{ $logoText }}" placeholder="e.g. TekQuora" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">
                    @error('logo_text')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="dash-btn-primary" style="width: 100%; justify-content: center; padding: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Logo Settings
                </button>
            </form>
        </div>

        <!-- Right Side: Navigation Links Settings -->
        <div class="dash-table-card" style="padding: 28px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h2 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    Navigation Menu Items
                </h2>
                <button type="button" onclick="addNewLinkRow()" class="dash-btn-primary" style="background-color: #22c55e; padding: 6px 14px; font-size: 13px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Add Menu Item
                </button>
            </div>

            <form action="/admin/header/links" method="POST" id="links-form">
                @csrf
                <div id="links-container" style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px;">
                    @forelse($links as $index => $link)
                        <div class="link-row" style="display: flex; align-items: center; gap: 12px; background-color: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 12px 16px; transition: all 0.2s;">
                            <!-- Drag/Order Handles -->
                            <div style="display: flex; flex-direction: column; gap: 4px;">
                                <button type="button" onclick="moveUp(this)" style="background: none; border: none; cursor: pointer; color: #a3aed1; padding: 2px;" title="Move Up">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
                                </button>
                                <button type="button" onclick="moveDown(this)" style="background: none; border: none; cursor: pointer; color: #a3aed1; padding: 2px;" title="Move Down">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                                </button>
                            </div>

                            <!-- Label -->
                            <div style="flex: 1;">
                                <label style="display: block; font-size: 11px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 4px;">Link Label</label>
                                <input type="text" name="links[{{ $index }}][label]" value="{{ $link['label'] }}" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white;">
                            </div>

                            <!-- URL -->
                            <div style="flex: 1.5;">
                                <label style="display: block; font-size: 11px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 4px;">URL / Anchor</label>
                                <input type="text" name="links[{{ $index }}][url]" value="{{ $link['url'] }}" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white;">
                            </div>

                            <!-- Button Style Checkbox -->
                            <div style="text-align: center; padding: 0 10px;">
                                <label style="display: block; font-size: 11px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 8px;">Style as Button</label>
                                <input type="checkbox" name="links[{{ $index }}][is_button]" value="1" {{ isset($link['is_button']) && $link['is_button'] ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #4318ff; cursor: pointer;">
                            </div>

                            <!-- Delete -->
                            <div style="align-self: flex-end; padding-bottom: 4px;">
                                <button type="button" onclick="deleteRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 8px; border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onhover="this.style.backgroundColor='rgba(239,68,68,0.1)'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div id="no-links-msg" style="text-align: center; padding: 40px; color: #a3aed1; font-size: 14px;">
                            No navigation menu items created yet. Click "Add Menu Item" above to create one.
                        </div>
                    @endforelse
                </div>

                <div style="display: flex; justify-content: flex-end; border-top: 1px solid #f0f3f8; padding-top: 20px;">
                    <button type="submit" class="dash-btn-primary" style="padding: 12px 28px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Save Navigation Links
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    function previewLogo(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById('logo-preview-img');
                if (previewImg) {
                    previewImg.src = e.target.result;
                } else {
                    const previewContainer = input.previousElementSibling.firstElementChild;
                    previewContainer.innerHTML = `<img id="logo-preview-img" src="${e.target.result}" style="height: 60px; object-fit: contain; max-width: 100%;">`;
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function addNewLinkRow() {
        const container = document.getElementById('links-container');
        const noMsg = document.getElementById('no-links-msg');
        if (noMsg) {
            noMsg.remove();
        }

        // Get index based on current children count
        const index = container.getElementsByClassName('link-row').length;

        const newRow = document.createElement('div');
        newRow.className = 'link-row';
        newRow.style = "display: flex; align-items: center; gap: 12px; background-color: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 12px 16px; transition: all 0.2s;";
        newRow.innerHTML = `
            <div style="display: flex; flex-direction: column; gap: 4px;">
                <button type="button" onclick="moveUp(this)" style="background: none; border: none; cursor: pointer; color: #a3aed1; padding: 2px;" title="Move Up">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
                </button>
                <button type="button" onclick="moveDown(this)" style="background: none; border: none; cursor: pointer; color: #a3aed1; padding: 2px;" title="Move Down">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-size: 11px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 4px;">Link Label</label>
                <input type="text" name="links[${index}][label]" placeholder="e.g. Services" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white;">
            </div>
            <div style="flex: 1.5;">
                <label style="display: block; font-size: 11px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 4px;">URL / Anchor</label>
                <input type="text" name="links[${index}][url]" placeholder="e.g. /#services" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white;">
            </div>
            <div style="text-align: center; padding: 0 10px;">
                <label style="display: block; font-size: 11px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 8px;">Style as Button</label>
                <input type="checkbox" name="links[${index}][is_button]" value="1" style="width: 18px; height: 18px; accent-color: #4318ff; cursor: pointer;">
            </div>
            <div style="align-self: flex-end; padding-bottom: 4px;">
                <button type="button" onclick="deleteRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 8px; border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.2s;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                </button>
            </div>
        `;
        container.appendChild(newRow);
        reindexRows();
    }

    function deleteRow(button) {
        const row = button.closest('.link-row');
        row.remove();
        
        const container = document.getElementById('links-container');
        if (container.getElementsByClassName('link-row').length === 0) {
            container.innerHTML = `
                <div id="no-links-msg" style="text-align: center; padding: 40px; color: #a3aed1; font-size: 14px;">
                    No navigation menu items created yet. Click "Add Menu Item" above to create one.
                </div>
            `;
        } else {
            reindexRows();
        }
    }

    function moveUp(button) {
        const row = button.closest('.link-row');
        const previous = row.previousElementSibling;
        if (previous && previous.classList.contains('link-row')) {
            row.parentNode.insertBefore(row, previous);
            reindexRows();
        }
    }

    function moveDown(button) {
        const row = button.closest('.link-row');
        const next = row.nextElementSibling;
        if (next && next.classList.contains('link-row')) {
            row.parentNode.insertBefore(next, row);
            reindexRows();
        }
    }

    function reindexRows() {
        const container = document.getElementById('links-container');
        const rows = container.getElementsByClassName('link-row');
        for (let i = 0; i < rows.length; i++) {
            const inputs = rows[i].querySelectorAll('input');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    const newName = name.replace(/links\[\d+\]/, `links[${i}]`);
                    input.setAttribute('name', newName);
                }
            });
        }
    }
</script>
@endsection
