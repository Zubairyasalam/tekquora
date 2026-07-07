@extends('layouts.admin')

@section('title', 'Manage Our Team - Admin Dashboard')

@section('page_title', 'Meet Our Team Configuration')

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

    <form action="{{ route('admin.team.save') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 1. Section Header -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Section Header Details
            </h3>
            
            <div style="margin-bottom: 20px;">
                <label for="team_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Main Title</label>
                <input type="text" name="team_title" id="team_title" value="{{ $teamTitle }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'" required>
            </div>
            <div>
                <label for="team_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Subtitle / Description</label>
                <textarea name="team_subtitle" id="team_subtitle" rows="2" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s; resize: vertical;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'" required>{{ $teamSubtitle }}</textarea>
            </div>
        </div>

        <!-- 2. Team Members List -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    Team Members Directory
                </h3>
                <button type="button" onclick="addMemberRow()" style="background: #e0e8ff; color: #4318ff; border: none; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 6px; transition: background 0.2s;">
                    + Add New Member
                </button>
            </div>

            <div id="members_container" style="display: flex; flex-direction: column; gap: 16px;">
                @foreach($members as $i => $member)
                <div class="member-container" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px; display: flex; gap: 24px; align-items: flex-start; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02); position: relative;">
                    <!-- Left Column: Image Preview & File Input -->
                    <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; width: 100px; flex-shrink: 0;">
                        @if(!empty($member['image']))
                            <img src="{{ asset($member['image']) }}" style="width: 80px; height: 80px; border-radius: 12px; object-fit: cover; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);">
                        @else
                            <div style="width: 80px; height: 80px; border-radius: 12px; background: #e0e8ff; color: #4318ff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 24px; border: 1px solid #e2e8f0;">{{ strtoupper(substr(trim($member['name'] ?? 'NM'), 0, 2)) }}</div>
                        @endif
                        <label class="custom-file-upload" style="background: #f1f5f9; color: #475569; padding: 6px 12px; border-radius: 6px; font-size: 11px; font-weight: 600; cursor: pointer; border: 1px solid #cbd5e1; text-align: center; width: 100%; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            Choose File
                            <input type="file" name="members[{{ $i }}][image_file]" accept="image/*" style="display: none;" onchange="updateFileNameLabel(this)">
                        </label>
                        <input type="hidden" name="members[{{ $i }}][image]" value="{{ $member['image'] ?? '' }}">
                    </div>

                    <!-- Middle Column: Grid of Inputs -->
                    <div style="flex: 1; display: flex; flex-direction: column; gap: 16px; min-width: 0;">
                        <!-- Fields Grid -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 16px;">
                            <div>
                                <label style="display: block; font-size: 10px; font-weight: 700; color: #a3aed0; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Full Name</label>
                                <input type="text" name="members[{{ $i }}][name]" value="{{ $member['name'] }}" placeholder="e.g. Arun Kumar" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #1e293b; font-weight: 500;" required>
                            </div>
                            <div>
                                <label style="display: block; font-size: 10px; font-weight: 700; color: #a3aed0; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Role / Designation</label>
                                <input type="text" name="members[{{ $i }}][role]" value="{{ $member['role'] }}" placeholder="e.g. Managing Director" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #1e293b; font-weight: 500;" required>
                            </div>
                            <div>
                                <label style="display: block; font-size: 10px; font-weight: 700; color: #a3aed0; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Location</label>
                                <input type="text" name="members[{{ $i }}][location]" value="{{ $member['location'] ?? '' }}" placeholder="e.g. Chennai" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #1e293b; font-weight: 500;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 10px; font-weight: 700; color: #a3aed0; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Type</label>
                                <select name="members[{{ $i }}][type]" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #1e293b; font-weight: 500; background: white;">
                                    <option value="management" {{ ($member['type'] ?? '') == 'management' ? 'selected' : '' }}>Management</option>
                                    <option value="hr_operation" {{ ($member['type'] ?? '') == 'hr_operation' ? 'selected' : '' }}>HR & Operation</option>
                                    <option value="employee" {{ ($member['type'] ?? '') == 'employee' ? 'selected' : '' }}>Employee</option>
                                    <option value="marketing" {{ ($member['type'] ?? '') == 'marketing' ? 'selected' : '' }}>Digital Marketing</option>
                                    <option value="intern" {{ ($member['type'] ?? '') == 'intern' ? 'selected' : '' }}>Intern</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Delete Button -->
                    <div style="display: flex; align-items: center; justify-content: center; align-self: center; width: 44px;">
                        <button type="button" onclick="this.closest('.member-container').remove()" style="background: transparent; border: none; color: #ef4444; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='transparent'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; margin-bottom: 40px;">
            <button type="submit" class="dash-btn-primary" style="padding: 14px 32px; font-size: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1-2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Save Team Members Settings
            </button>
        </div>

    </form>

</div>

<script>
let memberCounter = {{ count($members) }};

function updateFileNameLabel(input) {
    if (input.files && input.files[0]) {
        const fileName = input.files[0].name;
        const label = input.closest('.custom-file-upload');
        label.childNodes[0].nodeValue = fileName + ' ';
    }
}

function addMemberRow() {
    const container = document.getElementById('members_container');
    const index = memberCounter++;
    
    const row = document.createElement('div');
    row.className = 'member-container';
    row.style.cssText = 'background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px; display: flex; gap: 24px; align-items: flex-start; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02); position: relative; margin-bottom: 16px;';
    
    row.innerHTML = `
        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; width: 100px; flex-shrink: 0;">
            <div style="width: 80px; height: 80px; border-radius: 12px; background: #e0e8ff; color: #4318ff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 24px; border: 1px solid #e2e8f0;">NM</div>
            <label class="custom-file-upload" style="background: #f1f5f9; color: #475569; padding: 6px 12px; border-radius: 6px; font-size: 11px; font-weight: 600; cursor: pointer; border: 1px solid #cbd5e1; text-align: center; width: 100%; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                Choose File
                <input type="file" name="members[${index}][image_file]" accept="image/*" style="display: none;" onchange="updateFileNameLabel(this)">
            </label>
            <input type="hidden" name="members[${index}][image]" value="">
        </div>

        <div style="flex: 1; display: flex; flex-direction: column; gap: 16px; min-width: 0;">
            <!-- Fields Grid -->
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 16px;">
                <div>
                    <label style="display: block; font-size: 10px; font-weight: 700; color: #a3aed0; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Full Name</label>
                    <input type="text" name="members[${index}][name]" placeholder="e.g. New Member" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #1e293b; font-weight: 500;" required>
                </div>
                <div>
                    <label style="display: block; font-size: 10px; font-weight: 700; color: #a3aed0; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Role / Designation</label>
                    <input type="text" name="members[${index}][role]" placeholder="e.g. Software Engineer" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #1e293b; font-weight: 500;" required>
                </div>
                <div>
                    <label style="display: block; font-size: 10px; font-weight: 700; color: #a3aed0; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Location</label>
                    <input type="text" name="members[${index}][location]" placeholder="e.g. Chennai" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #1e293b; font-weight: 500;">
                </div>
                <div>
                    <label style="display: block; font-size: 10px; font-weight: 700; color: #a3aed0; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Type</label>
                    <select name="members[${index}][type]" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #1e293b; font-weight: 500; background: white;">
                        <option value="management">Management</option>
                        <option value="hr_operation">HR & Operation</option>
                        <option value="employee" selected>Employee</option>
                        <option value="marketing">Digital Marketing</option>
                        <option value="intern">Intern</option>
                    </select>
                </div>
            </div>
        </div>

        <div style="display: flex; align-items: center; justify-content: center; align-self: center; width: 44px;">
            <button type="button" onclick="this.closest('.member-container').remove()" style="background: transparent; border: none; color: #ef4444; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='transparent'">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
        </div>
    `;
    container.appendChild(row);
}
</script>
@endsection
