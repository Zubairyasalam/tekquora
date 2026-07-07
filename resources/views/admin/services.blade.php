@extends('layouts.admin')

@section('title', 'Services Settings - Admin Dashboard')

@section('page_title', 'Services Configuration')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 32px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 32px; align-items: start;">
        
        <!-- Left Side: Services Header Info -->
        <div class="dash-table-card" style="padding: 28px;">
            <h2 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Section Title & Subtitle
            </h2>

            <form action="/admin/services" method="POST">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label for="services_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Title</label>
                    <input type="text" name="services_title" id="services_title" value="{{ $servicesTitle }}" required style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">
                    @error('services_title')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 24px;">
                    <label for="services_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Subtitle</label>
                    <textarea name="services_subtitle" id="services_subtitle" rows="4" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s; resize: vertical;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'">{{ $servicesSubtitle }}</textarea>
                    @error('services_subtitle')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="dash-btn-primary" style="width: 100%; justify-content: center; padding: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Section Header
                </button>
            </form>
        </div>

        <!-- Right Side: Services List Settings -->
        <div class="dash-table-card" style="padding: 28px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h2 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    Manage Services
                </h2>
                <button type="button" onclick="addNewServiceRow()" class="dash-btn-primary" style="background-color: #22c55e; padding: 6px 14px; font-size: 13px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Add Service Card
                </button>
            </div>

            <form action="/admin/services/list" method="POST" id="services-form">
                @csrf
                <div id="services-container" style="display: flex; flex-direction: column; gap: 20px; margin-bottom: 24px;">
                    @forelse($servicesList as $index => $service)
                        <div class="service-row" style="display: flex; flex-direction: column; gap: 12px; background-color: #f8faff; border: 1px solid #e0e8ff; border-radius: 16px; padding: 20px; position: relative;">
                            
                            <!-- Control toolbar on top of card -->
                            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eef2f6; padding-bottom: 10px; margin-bottom: 4px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <button type="button" onclick="moveUp(this)" style="background: none; border: none; cursor: pointer; color: #a3aed1; padding: 2px;" title="Move Up">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
                                    </button>
                                    <button type="button" onclick="moveDown(this)" style="background: none; border: none; cursor: pointer; color: #a3aed1; padding: 2px;" title="Move Down">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                                    </button>
                                    <span style="font-weight: 700; font-size: 13px; color: #a3aed1; text-transform: uppercase;">Service #{{ $index + 1 }}</span>
                                </div>
                                <button type="button" onclick="deleteRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 4px;" title="Delete Card">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </div>

                            <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 16px;">
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; margin-bottom: 6px;">Service Title</label>
                                    <input type="text" name="services[{{ $index }}][title]" value="{{ $service['title'] }}" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; margin-bottom: 6px;">Icon Style</label>
                                    <select name="services[{{ $index }}][icon]" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white; appearance: none; -webkit-appearance: none;">
                                        <option value="code" {{ $service['icon'] == 'code' ? 'selected' : '' }}>Web / Developer (&lt;/&gt;)</option>
                                        <option value="mobile" {{ $service['icon'] == 'mobile' ? 'selected' : '' }}>Mobile Phone</option>
                                        <option value="ai" {{ $service['icon'] == 'ai' ? 'selected' : '' }}>AI / Microchip</option>
                                        <option value="iot" {{ $service['icon'] == 'iot' ? 'selected' : '' }}>IoT / Wireless</option>
                                        <option value="cloud" {{ $service['icon'] == 'cloud' ? 'selected' : '' }}>Cloud Upload</option>
                                        <option value="database" {{ $service['icon'] == 'database' ? 'selected' : '' }}>Data & Analytics</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; margin-bottom: 6px;">Description</label>
                                <textarea name="services[{{ $index }}][description]" rows="2" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white; resize: vertical;">{{ $service['description'] }}</textarea>
                            </div>

                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; margin-bottom: 6px;">Read More Link Destination</label>
                                <input type="text" name="services[{{ $index }}][link_url]" value="{{ $service['link_url'] }}" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white;">
                            </div>

                        </div>
                    @empty
                        <div id="no-services-msg" style="text-align: center; padding: 40px; color: #a3aed1; font-size: 14px;">
                            No services created yet. Click "Add Service Card" above to create one.
                        </div>
                    @endforelse
                </div>

                <div style="display: flex; justify-content: flex-end; border-top: 1px solid #f0f3f8; padding-top: 20px;">
                    <button type="submit" class="dash-btn-primary" style="padding: 12px 28px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Save Services List
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    function addNewServiceRow() {
        const container = document.getElementById('services-container');
        const noMsg = document.getElementById('no-services-msg');
        if (noMsg) {
            noMsg.remove();
        }

        const index = container.getElementsByClassName('service-row').length;

        const newRow = document.createElement('div');
        newRow.className = 'service-row';
        newRow.style = "display: flex; flex-direction: column; gap: 12px; background-color: #f8faff; border: 1px solid #e0e8ff; border-radius: 16px; padding: 20px; position: relative;";
        newRow.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eef2f6; padding-bottom: 10px; margin-bottom: 4px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <button type="button" onclick="moveUp(this)" style="background: none; border: none; cursor: pointer; color: #a3aed1; padding: 2px;" title="Move Up">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
                    </button>
                    <button type="button" onclick="moveDown(this)" style="background: none; border: none; cursor: pointer; color: #a3aed1; padding: 2px;" title="Move Down">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <span style="font-weight: 700; font-size: 13px; color: #a3aed1; text-transform: uppercase;">Service #${index + 1}</span>
                </div>
                <button type="button" onclick="deleteRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 4px;" title="Delete Card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                </button>
            </div>

            <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 16px;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; margin-bottom: 6px;">Service Title</label>
                    <input type="text" name="services[${index}][title]" placeholder="e.g. Cloud Hosting" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; margin-bottom: 6px;">Icon Style</label>
                    <select name="services[${index}][icon]" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white; appearance: none; -webkit-appearance: none;">
                        <option value="code">Web / Developer (&lt;/&gt;)</option>
                        <option value="mobile">Mobile Phone</option>
                        <option value="ai">AI / Microchip</option>
                        <option value="iot">IoT / Wireless</option>
                        <option value="cloud">Cloud Upload</option>
                        <option value="database">Data & Analytics</option>
                    </select>
                </div>
            </div>

            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; margin-bottom: 6px;">Description</label>
                <textarea name="services[${index}][description]" rows="2" required placeholder="Service description details..." style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white; resize: vertical;"></textarea>
            </div>

            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; margin-bottom: 6px;">Read More Link Destination</label>
                <input type="text" name="services[${index}][link_url]" placeholder="e.g. /services/cloud" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; color: #2b3674; outline: none; background: white;">
            </div>
        `;
        container.appendChild(newRow);
    }

    function deleteRow(button) {
        const row = button.closest('.service-row');
        row.remove();
        
        const container = document.getElementById('services-container');
        if (container.getElementsByClassName('service-row').length === 0) {
            container.innerHTML = `
                <div id="no-services-msg" style="text-align: center; padding: 40px; color: #a3aed1; font-size: 14px;">
                    No services created yet. Click "Add Service Card" above to create one.
                </div>
            `;
        } else {
            reindexRows();
        }
    }

    function moveUp(button) {
        const row = button.closest('.service-row');
        const previous = row.previousElementSibling;
        if (previous && previous.classList.contains('service-row')) {
            row.parentNode.insertBefore(row, previous);
            reindexRows();
        }
    }

    function moveDown(button) {
        const row = button.closest('.service-row');
        const next = row.nextElementSibling;
        if (next && next.classList.contains('service-row')) {
            row.parentNode.insertBefore(next, row);
            reindexRows();
        }
    }

    function reindexRows() {
        const container = document.getElementById('services-container');
        const rows = container.getElementsByClassName('service-row');
        for (let i = 0; i < rows.length; i++) {
            // Update labels
            const label = rows[i].querySelector('span');
            if (label) {
                label.textContent = `Service #${i + 1}`;
            }
            
            // Update input names
            const inputs = rows[i].querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    const newName = name.replace(/services\[\d+\]/, `services[${i}]`);
                    input.setAttribute('name', newName);
                }
            });
        }
    }
</script>
@endsection
