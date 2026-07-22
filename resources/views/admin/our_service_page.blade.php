@extends('layouts.admin')

@section('title', 'Manage Our Service Page - Admin Dashboard')

@section('page_title', 'Our Service Page Configuration')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 24px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.our-service-page.save') }}" method="POST" enctype="multipart/form-data" onsubmit="syncJsonFields()">
        @csrf

        <!-- 1. Hero Settings Card -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                1. Hero Banner Settings
            </h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label for="hero_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Hero Main Title</label>
                    <input type="text" name="hero_title" id="hero_title" value="{{ $heroTitle ?? 'Our Service' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
                </div>
                <div>
                    <label for="hero_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Hero Subtitle</label>
                    <input type="text" name="hero_subtitle" id="hero_subtitle" value="{{ $heroSubtitle ?? '' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
                </div>
            </div>
        </div>

        <!-- 2. Section 1 (Future-Ready Teams) Card -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    2. Section 1: Future-Ready Teams
                </h3>
                <button type="button" onclick="addFeatureRow()" class="dash-btn-primary" style="background-color: #22c55e; padding: 8px 16px; font-size: 13px;">
                    + Add Feature Card
                </button>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="section1_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Heading</label>
                <input type="text" name="section1_title" id="section1_title" value="{{ $section1Title ?? '' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="section1_paragraph" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Paragraph</label>
                <textarea name="section1_paragraph" id="section1_paragraph" rows="3" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; resize: vertical;" required>{{ $section1Paragraph ?? '' }}</textarea>
            </div>

            <input type="hidden" name="features_json" id="features_json">

            <div style="overflow-x: auto; margin-top: 15px;">
                <table class="dash-table" style="width: 100%; border: 1px solid #e0e8ff; border-radius: 10px; overflow: hidden;">
                    <thead>
                        <tr style="background-color: #f8faff; text-align: left;">
                            <th style="padding: 12px 14px; width: 20%;">Feature Title</th>
                            <th style="padding: 12px 14px; width: 60%;">Description</th>
                            <th style="padding: 12px 14px; width: 12%;">Lucide Icon</th>
                            <th style="padding: 12px 14px; text-align: center; width: 8%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="features_tbody">
                        <!-- Filled by JS -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 3. Section 2 (Building Great Teams - Arc Wheel) Card -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                3. Section 2: Building Great Teams & Arc Wheel
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label for="section2_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Heading</label>
                    <input type="text" name="section2_title" id="section2_title" value="{{ $section2Title ?? '' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
                </div>
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Skyline Silhouette Background Image</label>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        @if($section2SkylineImage)
                            <img src="{{ $section2SkylineImage }}" alt="Skyline Preview" style="height: 40px; border-radius: 6px; border: 1px solid #e0e8ff; background: #0f172a; padding: 2px;">
                        @endif
                        <input type="file" name="section2_skyline_image" accept="image/*" style="font-size: 13px; color: #a3aed0;">
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label for="section2_paragraph" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Paragraph</label>
                <textarea name="section2_paragraph" id="section2_paragraph" rows="3" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; resize: vertical;" required>{{ $section2Paragraph ?? '' }}</textarea>
            </div>

            <h4 style="font-size: 15px; font-weight: 700; color: #2b3674; margin-bottom: 12px; margin-top: 24px;">Arc Wheel Timeline Nodes (6 Items)</h4>
            <input type="hidden" name="nodes_json" id="nodes_json">

            <div style="overflow-x: auto;">
                <table class="dash-table" style="width: 100%; border: 1px solid #e0e8ff; border-radius: 10px; overflow: hidden;">
                    <thead>
                        <tr style="background-color: #f8faff; text-align: left;">
                            <th style="padding: 12px 14px; width: 15%;">Node Tab Label</th>
                            <th style="padding: 12px 14px; width: 25%;">Center Card Title</th>
                            <th style="padding: 12px 14px; width: 45%;">Center Card Description</th>
                            <th style="padding: 12px 14px; width: 15%;">Lucide Icon</th>
                        </tr>
                    </thead>
                    <tbody id="nodes_tbody">
                        <!-- Filled dynamically by JS -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 4. Section 3 (Connecting Businesses & Map) Card -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                4. Section 3: Connecting Businesses & Global Map
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label for="section3_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Heading</label>
                    <input type="text" name="section3_title" id="section3_title" value="{{ $section3Title ?? '' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none;" required>
                </div>
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Global Reach World Map Image</label>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        @if($section3MapImage)
                            <img src="{{ $section3MapImage }}" alt="Map Preview" style="height: 40px; border-radius: 6px; border: 1px solid #e0e8ff; padding: 2px;">
                        @endif
                        <input type="file" name="section3_map_image" accept="image/*" style="font-size: 13px; color: #a3aed0;">
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label for="section3_paragraph" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Section Paragraph</label>
                <textarea name="section3_paragraph" id="section3_paragraph" rows="4" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; resize: vertical;" required>{{ $section3Paragraph ?? '' }}</textarea>
            </div>

            <h4 style="font-size: 15px; font-weight: 700; color: #2b3674; margin-bottom: 12px; margin-top: 24px;">Global Statistics (4 Cards)</h4>
            <input type="hidden" name="stats_json" id="stats_json">

            <div style="overflow-x: auto;">
                <table class="dash-table" style="width: 100%; border: 1px solid #e0e8ff; border-radius: 10px; overflow: hidden;">
                    <thead>
                        <tr style="background-color: #f8faff; text-align: left;">
                            <th style="padding: 12px 14px; width: 25%;">Value (e.g. 15+)</th>
                            <th style="padding: 12px 14px; width: 50%;">Label Description</th>
                            <th style="padding: 12px 14px; width: 25%;">Lucide Icon</th>
                        </tr>
                    </thead>
                    <tbody id="stats_tbody">
                        <!-- Filled dynamically by JS -->
                    </tbody>
                </table>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; margin-bottom: 40px;">
            <button type="submit" class="dash-btn-primary" style="padding: 14px 32px; font-size: 15px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1-2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Save Page Settings
            </button>
        </div>

    </form>
</div>

<script>
// Features lists
let features = @json($features);
// Timeline nodes
let nodes = @json($nodes);
// Statistics cards
let stats = @json($stats);

document.addEventListener("DOMContentLoaded", function () {
    renderFeatures();
    renderNodes();
    renderStats();
});

// Render Section 1 features
function renderFeatures() {
    const tbody = document.getElementById("features_tbody");
    tbody.innerHTML = "";
    
    features.forEach((feature, index) => {
        const tr = document.createElement("tr");
        tr.style.borderBottom = "1px solid #e0e8ff";
        
        tr.innerHTML = `
            <td style="padding: 12px 14px;">
                <input type="text" value="${feature.title}" onchange="updateFeatureField(${index}, 'title', this.value)" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px;" required>
            </td>
            <td style="padding: 12px 14px;">
                <input type="text" value="${feature.description}" onchange="updateFeatureField(${index}, 'description', this.value)" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px;" required>
            </td>
            <td style="padding: 12px 14px;">
                <select onchange="updateFeatureField(${index}, 'icon', this.value)" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px;">
                    <option value="lightbulb" ${feature.icon === 'lightbulb' ? 'selected' : ''}>Lightbulb</option>
                    <option value="users" ${feature.icon === 'users' ? 'selected' : ''}>Users</option>
                    <option value="graduation-cap" ${feature.icon === 'graduation-cap' ? 'selected' : ''}>Graduation Cap</option>
                    <option value="globe" ${feature.icon === 'globe' ? 'selected' : ''}>Globe</option>
                    <option value="zap" ${feature.icon === 'zap' ? 'selected' : ''}>Zap</option>
                    <option value="award" ${feature.icon === 'award' ? 'selected' : ''}>Award</option>
                    <option value="heart" ${feature.icon === 'heart' ? 'selected' : ''}>Heart</option>
                    <option value="book-open" ${feature.icon === 'book-open' ? 'selected' : ''}>Book Open</option>
                </select>
            </td>
            <td style="padding: 12px 14px; text-align: center;">
                <button type="button" onclick="removeFeature(${index})" style="background: none; border: none; color: #ef4444; cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function updateFeatureField(index, field, value) {
    features[index][field] = value;
}

function addFeatureRow() {
    features.push({ title: "New Feature", description: "Enter description details here", icon: "lightbulb" });
    renderFeatures();
}

function removeFeature(index) {
    if (features.length <= 1) {
        alert("You must keep at least one feature item!");
        return;
    }
    features.splice(index, 1);
    renderFeatures();
}

// Render Section 2 nodes
function renderNodes() {
    const tbody = document.getElementById("nodes_tbody");
    tbody.innerHTML = "";
    
    nodes.forEach((node, index) => {
        const tr = document.createElement("tr");
        tr.style.borderBottom = "1px solid #e0e8ff";
        
        tr.innerHTML = `
            <td style="padding: 12px 14px;">
                <input type="text" value="${node.label}" onchange="updateNodeField(${index}, 'label', this.value)" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px;" required>
            </td>
            <td style="padding: 12px 14px;">
                <input type="text" value="${node.title}" onchange="updateNodeField(${index}, 'title', this.value)" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px;" required>
            </td>
            <td style="padding: 12px 14px;">
                <input type="text" value="${node.description}" onchange="updateNodeField(${index}, 'description', this.value)" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px;" required>
            </td>
            <td style="padding: 12px 14px;">
                <select onchange="updateNodeField(${index}, 'icon', this.value)" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px;">
                    <option value="trending-up" ${node.icon === 'trending-up' ? 'selected' : ''}>Trending Up</option>
                    <option value="users" ${node.icon === 'users' ? 'selected' : ''}>Users</option>
                    <option value="zap" ${node.icon === 'zap' ? 'selected' : ''}>Zap</option>
                    <option value="award" ${node.icon === 'award' ? 'selected' : ''}>Award</option>
                    <option value="heart" ${node.icon === 'heart' ? 'selected' : ''}>Heart</option>
                    <option value="book-open" ${node.icon === 'book-open' ? 'selected' : ''}>Book Open</option>
                </select>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function updateNodeField(index, field, value) {
    nodes[index][field] = value;
}

// Render Section 3 statistics
function renderStats() {
    const tbody = document.getElementById("stats_tbody");
    tbody.innerHTML = "";
    
    stats.forEach((stat, index) => {
        const tr = document.createElement("tr");
        tr.style.borderBottom = "1px solid #e0e8ff";
        
        tr.innerHTML = `
            <td style="padding: 12px 14px;">
                <input type="text" value="${stat.value}" onchange="updateStatField(${index}, 'value', this.value)" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px;" required>
            </td>
            <td style="padding: 12px 14px;">
                <input type="text" value="${stat.label}" onchange="updateStatField(${index}, 'label', this.value)" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px;" required>
            </td>
            <td style="padding: 12px 14px;">
                <select onchange="updateStatField(${index}, 'icon', this.value)" style="width: 100%; padding: 8px 12px; border: 1px solid #e0e8ff; border-radius: 6px; font-size: 13px;">
                    <option value="globe" ${stat.icon === 'globe' ? 'selected' : ''}>Globe</option>
                    <option value="check-square" ${stat.icon === 'check-square' ? 'selected' : ''}>Check Square</option>
                    <option value="users" ${stat.icon === 'users' ? 'selected' : ''}>Users</option>
                    <option value="star" ${stat.icon === 'star' ? 'selected' : ''}>Star</option>
                </select>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function updateStatField(index, field, value) {
    stats[index][field] = value;
}

// Synchronize all JSON inputs on form submission
function syncJsonFields() {
    document.getElementById("features_json").value = JSON.stringify(features);
    document.getElementById("nodes_json").value = JSON.stringify(nodes);
    document.getElementById("stats_json").value = JSON.stringify(stats);
}
</script>
@endsection
