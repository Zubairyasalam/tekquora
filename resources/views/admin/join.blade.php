@extends('layouts.admin')

@section('title', 'Manage Why Join Us - Admin Dashboard')

@section('page_title', 'Why Join Us Configuration')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 24px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.join.save') }}" method="POST">
        @csrf
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                Why Join Us Section Headings
            </h3>
            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div>
                    <label for="join_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Title</label>
                    <input type="text" name="join_title" id="join_title" value="{{ $joinTitle }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'" required>
                </div>
                <div>
                    <label for="join_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Subtitle</label>
                    <textarea name="join_subtitle" id="join_subtitle" rows="3" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s; resize: vertical;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'" required>{{ $joinSubtitle }}</textarea>
                </div>
            </div>
        </div>

        <div class="dash-table-card" style="padding: 28px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Features & Benefits Checklist
                </h3>
                <button type="button" onclick="addNewJoinRow()" class="dash-btn-primary" style="background-color: #22c55e; padding: 6px 14px; font-size: 13px;">
                    + Add Feature Benefit
                </button>
            </div>

            <div id="join-list-container" style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 24px;">
                @forelse($joinList as $index => $item)
                    <div class="join-row" style="background-color: #f8faff; border: 1px solid #e0e8ff; border-radius: 14px; padding: 20px; display: grid; grid-template-columns: 2fr 3fr 1fr auto; gap: 16px; align-items: center; position: relative;">
                        
                        <!-- Card Title -->
                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 6px;">Title</label>
                            <input type="text" name="join[{{ $index }}][title]" value="{{ $item['title'] }}" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; font-weight: 600; color: #2b3674; background: white;">
                        </div>

                        <!-- Card Description -->
                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 6px;">Description</label>
                            <input type="text" name="join[{{ $index }}][description]" value="{{ $item['description'] }}" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; color: #2b3674; background: white;">
                        </div>

                        <!-- Display Icon -->
                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 6px;">Icon</label>
                            <select name="join[{{ $index }}][icon]" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; color: #2b3674; background: white;">
                                <option value="popper" {{ ($item['icon'] ?? '') == 'popper' ? 'selected' : '' }}>🎉 Celebrations</option>
                                <option value="clock" {{ ($item['icon'] ?? '') == 'clock' ? 'selected' : '' }}>🕒 Work-Life Balance</option>
                                <option value="home" {{ ($item['icon'] ?? '') == 'home' ? 'selected' : '' }}>🏠 Family Culture</option>
                                <option value="monitor" {{ ($item['icon'] ?? '') == 'monitor' ? 'selected' : '' }}>💻 Training Programs</option>
                                <option value="coffee" {{ ($item['icon'] ?? '') == 'coffee' ? 'selected' : '' }}>☕ Free Snacks/Coffee</option>
                                <option value="heart" {{ ($item['icon'] ?? '') == 'heart' ? 'selected' : '' }}>❤️ Health Benefits</option>
                            </select>
                        </div>

                        <!-- Action buttons -->
                        <div style="display: flex; flex-direction: column; gap: 8px; align-self: center;">
                            <button type="button" onclick="deleteJoinRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 8px; border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Delete Card">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
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
                    Save Configuration
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function addNewJoinRow() {
        const container = document.getElementById('join-list-container');
        const noMsg = document.getElementById('no-join-msg');
        if (noMsg) {
            noMsg.remove();
        }

        const index = container.getElementsByClassName('join-row').length;
        const newRow = document.createElement('div');
        newRow.className = 'join-row';
        newRow.style = "background-color: #f8faff; border: 1px solid #e0e8ff; border-radius: 14px; padding: 20px; display: grid; grid-template-columns: 2fr 3fr 1fr auto; gap: 16px; align-items: center; position: relative;";
        newRow.innerHTML = `
            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 6px;">Title</label>
                <input type="text" name="join[${index}][title]" placeholder="e.g. Celebrations" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; font-weight: 600; color: #2b3674; background: white;">
            </div>
            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 6px;">Description</label>
                <input type="text" name="join[${index}][description]" placeholder="e.g. Regular events & recognition" required style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; color: #2b3674; background: white;">
            </div>
            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #a3aed1; text-transform: uppercase; margin-bottom: 6px;">Icon</label>
                <select name="join[${index}][icon]" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; color: #2b3674; background: white;">
                    <option value="popper">🎉 Celebrations</option>
                    <option value="clock">🕒 Work-Life Balance</option>
                    <option value="home">🏠 Family Culture</option>
                    <option value="monitor">💻 Training Programs</option>
                    <option value="coffee">☕ Free Snacks/Coffee</option>
                    <option value="heart">❤️ Health Benefits</option>
                </select>
            </div>
            <div style="display: flex; flex-direction: column; gap: 8px; align-self: center;">
                <button type="button" onclick="deleteJoinRow(this)" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 8px; border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Delete Card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
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
