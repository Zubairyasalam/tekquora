@extends('layouts.admin')

@section('title', 'Manage Work Culture - Admin Dashboard')

@section('page_title', 'Work Culture Configuration')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 24px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.culture.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                Work Culture Section Headings
            </h3>
            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div>
                    <label for="culture_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Title</label>
                    <input type="text" name="culture_title" id="culture_title" value="{{ $cultureTitle }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'" required>
                </div>
                <div>
                    <label for="culture_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Subtitle</label>
                    <textarea name="culture_subtitle" id="culture_subtitle" rows="3" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s; resize: vertical;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'" required>{{ $cultureSubtitle }}</textarea>
                </div>
            </div>
        </div>

        <div class="dash-table-card" style="padding: 28px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                    Culture Cards List
                </h3>
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
                                <img id="culture_img_preview_{{ $index }}" src="{{ $item['image'] ? asset($item['image']) : 'https://placehold.co/100?text=Upload' }}" style="width: 100%; height: 100%; object-fit: contain;">
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
                    Save Work Culture
                </button>
            </div>
        </div>
    </form>
</div>

<script>
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
            const inputs = rows[i].querySelectorAll('input, textarea, img');
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
</script>
@endsection
