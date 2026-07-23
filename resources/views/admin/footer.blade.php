@extends('layouts.admin')

@section('title', 'Manage Website Footer - Admin Dashboard')

@section('page_title', 'Website Footer Configuration')

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

    <form action="{{ route('admin.footer.save') }}" method="POST">
        @csrf

        <!-- 1. Brand Description & Copyright -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="15" x2="21" y2="15"/></svg>
                Footer Brand & Copyright Notice
            </h3>
            
            <div style="margin-bottom: 20px;">
                <label for="footer_description" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Footer Brand Bio / Description</label>
                <textarea name="footer_description" id="footer_description" rows="3" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s; resize: vertical;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'" required>{{ $footerDescription }}</textarea>
                <span style="font-size: 12px; color: #a3aed0;">Displayed directly underneath the TekQuora logo on the left side of the footer.</span>
            </div>
            <div>
                <label for="footer_copyright" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Bottom Copyright Notice</label>
                <input type="text" name="footer_copyright" id="footer_copyright" value="{{ $footerCopyright }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'" required>
            </div>
        </div>

        <!-- 2. Social Media URLs -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                Social Media Links
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Facebook URL</label>
                    <input type="text" name="socials[facebook]" value="{{ $socials['facebook'] ?? '#' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Twitter / X URL</label>
                    <input type="text" name="socials[twitter]" value="{{ $socials['twitter'] ?? '#' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">LinkedIn URL</label>
                    <input type="text" name="socials[linkedin]" value="{{ $socials['linkedin'] ?? '#' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Instagram URL</label>
                    <input type="text" name="socials[instagram]" value="{{ $socials['instagram'] ?? '#' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px;">
                </div>
                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">WhatsApp URL / Link</label>
                    <input type="text" name="socials[whatsapp]" value="{{ $socials['whatsapp'] ?? '#' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px;">
                </div>
            </div>
        </div>

        <!-- 3. Navigation Columns -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                Footer Navigation Columns
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px;">
                
                <!-- Column 1 -->
                <div style="background: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 18px;">
                    <label style="display: block; font-size: 14px; font-weight: 700; color: #2b3674; margin-bottom: 12px;">Column 1 Title</label>
                    <input type="text" name="col1_title" value="{{ $col1Title }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-weight: 600; margin-bottom: 16px; background: white;" required>
                    
                    <div style="font-size: 12px; font-weight: 600; color: #a3aed0; margin-bottom: 8px; display: flex; justify-content: space-between;">
                        <span>LINK LABEL</span>
                        <span>TARGET URL</span>
                    </div>
                    <div id="col1_container" style="display: flex; flex-direction: column; gap: 10px;">
                        @foreach($col1Links as $i => $link)
                        <div class="link-row" style="display: flex; gap: 8px;">
                            <input type="text" name="col1_links[{{ $i }}][label]" value="{{ $link['label'] }}" placeholder="Label" style="width: 50%; padding: 8px 10px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px; background: white;">
                            <input type="text" name="col1_links[{{ $i }}][url]" value="{{ $link['url'] }}" placeholder="URL" style="width: 50%; padding: 8px 10px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px; background: white;">
                            <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 4px;">&times;</button>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addLinkRow('col1_container', 'col1_links')" style="margin-top: 12px; background: white; border: 1px dashed #4318ff; color: #4318ff; width: 100%; padding: 8px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s;">+ Add Link</button>
                </div>

                <!-- Column 2 -->
                <div style="background: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 18px;">
                    <label style="display: block; font-size: 14px; font-weight: 700; color: #2b3674; margin-bottom: 12px;">Column 2 Title</label>
                    <input type="text" name="col2_title" value="{{ $col2Title }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-weight: 600; margin-bottom: 16px; background: white;" required>
                    
                    <div style="font-size: 12px; font-weight: 600; color: #a3aed0; margin-bottom: 8px; display: flex; justify-content: space-between;">
                        <span>LINK LABEL</span>
                        <span>TARGET URL</span>
                    </div>
                    <div id="col2_container" style="display: flex; flex-direction: column; gap: 10px;">
                        @foreach($col2Links as $i => $link)
                        <div class="link-row" style="display: flex; gap: 8px;">
                            <input type="text" name="col2_links[{{ $i }}][label]" value="{{ $link['label'] }}" placeholder="Label" style="width: 50%; padding: 8px 10px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px; background: white;">
                            <input type="text" name="col2_links[{{ $i }}][url]" value="{{ $link['url'] }}" placeholder="URL" style="width: 50%; padding: 8px 10px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px; background: white;">
                            <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 4px;">&times;</button>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addLinkRow('col2_container', 'col2_links')" style="margin-top: 12px; background: white; border: 1px dashed #4318ff; color: #4318ff; width: 100%; padding: 8px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s;">+ Add Link</button>
                </div>

                <!-- Column 3 -->
                <div style="background: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 18px;">
                    <label style="display: block; font-size: 14px; font-weight: 700; color: #2b3674; margin-bottom: 12px;">Column 3 Title</label>
                    <input type="text" name="col3_title" value="{{ $col3Title }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-weight: 600; margin-bottom: 16px; background: white;" required>
                    
                    <div style="font-size: 12px; font-weight: 600; color: #a3aed0; margin-bottom: 8px; display: flex; justify-content: space-between;">
                        <span>LINK LABEL</span>
                        <span>TARGET URL</span>
                    </div>
                    <div id="col3_container" style="display: flex; flex-direction: column; gap: 10px;">
                        @foreach($col3Links as $i => $link)
                        <div class="link-row" style="display: flex; gap: 8px;">
                            <input type="text" name="col3_links[{{ $i }}][label]" value="{{ $link['label'] }}" placeholder="Label" style="width: 50%; padding: 8px 10px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px; background: white;">
                            <input type="text" name="col3_links[{{ $i }}][url]" value="{{ $link['url'] }}" placeholder="URL" style="width: 50%; padding: 8px 10px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px; background: white;">
                            <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 4px;">&times;</button>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addLinkRow('col3_container', 'col3_links')" style="margin-top: 12px; background: white; border: 1px dashed #4318ff; color: #4318ff; width: 100%; padding: 8px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s;">+ Add Link</button>
                </div>

            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; margin-bottom: 40px;">
            <button type="submit" class="dash-btn-primary" style="padding: 14px 32px; font-size: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1-2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Save Website Footer Settings
            </button>
        </div>

    </form>

</div>

<script>
let rowCounters = {
    'col1_links': {{ count($col1Links) }},
    'col2_links': {{ count($col2Links) }},
    'col3_links': {{ count($col3Links) }}
};

function addLinkRow(containerId, inputPrefix) {
    const container = document.getElementById(containerId);
    const index = rowCounters[inputPrefix]++;
    
    const row = document.createElement('div');
    row.className = 'link-row';
    row.style.cssText = 'display: flex; gap: 8px;';
    row.innerHTML = `
        <input type="text" name="${inputPrefix}[${index}][label]" placeholder="Label" style="width: 50%; padding: 8px 10px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px; background: white;">
        <input type="text" name="${inputPrefix}[${index}][url]" value="#" placeholder="URL" style="width: 50%; padding: 8px 10px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px; background: white;">
        <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 4px;">&times;</button>
    `;
    container.appendChild(row);
}
</script>
@endsection
