@extends('layouts.admin')

@section('title', 'Manage About Page - Admin Dashboard')

@section('page_title', 'About Page Configuration')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 24px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.about-page.save') }}" method="POST">
        @csrf

        <!-- 1. Hero Headings Card -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                1. Hero Banner Settings
            </h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label for="about_hero_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Hero Main Title</label>
                    <input type="text" name="about_hero_title" id="about_hero_title" value="{{ $aboutHeroTitle ?? 'About Us' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
                </div>
                <div>
                    <label for="about_hero_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Hero Subtitle</label>
                    <input type="text" name="about_hero_subtitle" id="about_hero_subtitle" value="{{ $aboutHeroSubtitle ?? 'Pioneering technology solutions and empowering digital growth since 2016.' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
                </div>
            </div>
        </div>

        <!-- 2. About TekQuora Main Description Card -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                2. About TekQuora Description Section
            </h3>
            <div style="margin-bottom: 20px;">
                <label for="about_tekquora_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Title</label>
                <input type="text" name="about_tekquora_title" id="about_tekquora_title" value="{{ $aboutTekquoraTitle ?? 'About TekQuora' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label for="about_tekquora_p1" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Main Highlight Paragraph (Top)</label>
                    <textarea name="about_tekquora_p1" id="about_tekquora_p1" rows="5" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; resize: vertical;" required>{{ $aboutTekquoraP1 ?? '' }}</textarea>
                </div>
                <div>
                    <label for="about_tekquora_p2" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Secondary Paragraph (Bottom)</label>
                    <textarea name="about_tekquora_p2" id="about_tekquora_p2" rows="5" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; resize: vertical;" required>{{ $aboutTekquoraP2 ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- 3. Our Values Manager -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    3. Our Values Section (Interactive Cards)
                </h3>
                <button type="button" onclick="addValue()" class="dash-btn-primary" style="background-color: #22c55e; padding: 8px 16px; font-size: 13px;">
                    + Add Value Card
                </button>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label for="about_values_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Main Title</label>
                    <input type="text" name="about_values_title" id="about_values_title" value="{{ $ourValuesTitle ?? 'Our Values' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
                </div>
                <div>
                    <label for="about_values_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Subtitle</label>
                    <input type="text" name="about_values_subtitle" id="about_values_subtitle" value="{{ $ourValuesSubtitle ?? 'The principles that guide everything we build and deliver.' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
                </div>
            </div>

            <input type="hidden" name="values_json" id="values_json">

            <div style="overflow-x: auto;">
                <table class="dash-table" style="width: 100%; border: 1px solid #e0e8ff; border-radius: 10px; overflow: hidden;">
                    <thead>
                        <tr style="background-color: #f8faff; text-align: left;">
                            <th style="padding: 12px 14px;">Value Title</th>
                            <th style="padding: 12px 14px;">Description</th>
                            <th style="padding: 12px 14px; text-align: center; width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="values_tbody">
                        <!-- Rendered dynamically by JS -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 4. Our Approach & Why Choose Us Card -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                4. Our Approach & Why Choose TekQuora Section
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <!-- Our Approach Column -->
                <div style="background: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 20px;">
                    <h4 style="font-size: 16px; font-weight: 700; color: #2b3674; margin-bottom: 16px;">Our Approach Block</h4>
                    <div style="margin-bottom: 12px;">
                        <label for="about_approach_title" style="display: block; font-size: 13px; font-weight: 600; color: #2b3674; margin-bottom: 6px;">Title</label>
                        <input type="text" name="about_approach_title" id="about_approach_title" value="{{ $ourApproachTitle ?? 'Our Approach' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; background: white;" required>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <label for="about_approach_p1" style="display: block; font-size: 13px; font-weight: 600; color: #2b3674; margin-bottom: 6px;">Paragraph 1</label>
                        <textarea name="about_approach_p1" id="about_approach_p1" rows="3" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; background: white; resize: vertical;" required>{{ $ourApproachP1 ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="about_approach_p2" style="display: block; font-size: 13px; font-weight: 600; color: #2b3674; margin-bottom: 6px;">Paragraph 2</label>
                        <textarea name="about_approach_p2" id="about_approach_p2" rows="3" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; background: white; resize: vertical;" required>{{ $ourApproachP2 ?? '' }}</textarea>
                    </div>
                </div>

                <!-- Why Choose Us Column -->
                <div style="background: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <h4 style="font-size: 16px; font-weight: 700; color: #2b3674; margin: 0;">Why Choose Us Checklist</h4>
                        <button type="button" onclick="addWhyChoosePoint()" class="dash-btn-primary" style="background-color: #4318ff; padding: 6px 12px; font-size: 12px;">
                            + Add Bullet Point
                        </button>
                    </div>
                    <div style="margin-bottom: 14px;">
                        <label for="about_why_choose_title" style="display: block; font-size: 13px; font-weight: 600; color: #2b3674; margin-bottom: 6px;">Block Title</label>
                        <input type="text" name="about_why_choose_title" id="about_why_choose_title" value="{{ $whyChooseTitle ?? 'Why Choose TekQuora' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; background: white;" required>
                    </div>

                    <input type="hidden" name="why_choose_json" id="why_choose_json">
                    <div id="why_choose_container" style="display: flex; flex-direction: column; gap: 8px; max-height: 260px; overflow-y: auto;">
                        <!-- Rendered by JS -->
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Grow Beyond Borders Banner Card -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                5. Bottom Globe CTA Banner Settings
            </h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label for="grow_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Banner Title</label>
                    <input type="text" name="grow_title" id="grow_title" value="{{ $growTitle ?? 'GROW BEYOND BORDERS WITH TEKQUORA' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
                </div>
                <div>
                    <label for="grow_btn_text" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Button Label</label>
                    <input type="text" name="grow_btn_text" id="grow_btn_text" value="{{ $growBtnText ?? 'Explore More' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                <div>
                    <label for="grow_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Banner Subtitle / Description</label>
                    <input type="text" name="grow_subtitle" id="grow_subtitle" value="{{ $growSubtitle ?? '' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
                </div>
                <div>
                    <label for="grow_btn_url" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Button Link URL</label>
                    <input type="text" name="grow_btn_url" id="grow_btn_url" value="{{ $growBtnUrl ?? '/contact' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; margin-bottom: 40px;">
            <button type="submit" class="dash-btn-primary" style="padding: 14px 32px; font-size: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1-2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Save About Page Configuration
            </button>
        </div>
    </form>
</div>

<script>
    let valuesItems = @json($ourValues ?? []);
    let whyChoosePoints = @json($whyChoosePoints ?? []);

    function renderValues() {
        const tbody = document.getElementById('values_tbody');
        tbody.innerHTML = '';
        valuesItems.forEach((val, idx) => {
            const tr = document.createElement('tr');
            tr.style.borderBottom = '1px solid #f1f5f9';
            tr.innerHTML = `
                <td style="padding: 10px 14px; width: 25%;">
                    <input type="text" value="${val.title}" onchange="updateValue(${idx}, 'title', this.value)" style="width: 100%; padding: 6px 10px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px; font-weight: 600;">
                </td>
                <td style="padding: 10px 14px;">
                    <input type="text" value="${val.description}" onchange="updateValue(${idx}, 'description', this.value)" style="width: 100%; padding: 6px 10px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px;">
                </td>
                <td style="padding: 10px 14px; text-align: center;">
                    <button type="button" onclick="deleteValue(${idx})" style="padding: 4px 10px; font-size: 12px; background: #fee2e2; color: #ef4444; border: none; border-radius: 4px; cursor: pointer;">Remove</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
        document.getElementById('values_json').value = JSON.stringify(valuesItems);
    }

    function addValue() {
        valuesItems.push({
            title: 'New Value',
            description: 'Enter value description...',
            position: valuesItems.length % 2 === 0 ? 'valley' : 'peak'
        });
        renderValues();
    }

    function updateValue(idx, key, val) {
        valuesItems[idx][key] = val;
        document.getElementById('values_json').value = JSON.stringify(valuesItems);
    }

    function deleteValue(idx) {
        if(confirm('Are you sure you want to remove this value card?')) {
            valuesItems.splice(idx, 1);
            renderValues();
        }
    }

    function renderWhyChoose() {
        const container = document.getElementById('why_choose_container');
        container.innerHTML = '';
        whyChoosePoints.forEach((pt, idx) => {
            const div = document.createElement('div');
            div.style.display = 'flex';
            div.style.gap = '8px';
            div.style.alignItems = 'center';
            div.innerHTML = `
                <input type="text" value="${pt}" onchange="updateWhyChoose(${idx}, this.value)" style="flex: 1; padding: 6px 10px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px; background: white;">
                <button type="button" onclick="deleteWhyChoose(${idx})" style="padding: 4px 8px; font-size: 12px; background: #fee2e2; color: #ef4444; border: none; border-radius: 4px; cursor: pointer;">✕</button>
            `;
            container.appendChild(div);
        });
        document.getElementById('why_choose_json').value = JSON.stringify(whyChoosePoints);
    }

    function addWhyChoosePoint() {
        whyChoosePoints.push('New checklist feature');
        renderWhyChoose();
    }

    function updateWhyChoose(idx, val) {
        whyChoosePoints[idx] = val;
        document.getElementById('why_choose_json').value = JSON.stringify(whyChoosePoints);
    }

    function deleteWhyChoose(idx) {
        whyChoosePoints.splice(idx, 1);
        renderWhyChoose();
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderValues();
        renderWhyChoose();
    });
</script>
@endsection
