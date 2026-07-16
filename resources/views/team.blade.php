@extends('layouts.app')

@section('title', 'Meet Our Team - TekQuora')

@section('content')

<style>
/* Team Hero Section */
.team-hero {
    position: relative;
    padding: 100px 20px;
    text-align: center;
    background-image: linear-gradient(135deg, #0f172a, #1e293b);
    color: white;
}
.team-hero-title {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 15px;
    font-family: 'Outfit', sans-serif;
}
.team-hero-subtitle {
    font-size: 18px;
    max-width: 600px;
    margin: 0 auto;
    opacity: 0.9;
}

/* Filter Bar */
.team-filter-bar {
    display: flex;
    justify-content: center;
    gap: 12px;
    padding: 24px 20px 16px 20px;
    flex-wrap: wrap;
    background: white;
    border-bottom: 1px solid #f1f5f9;
}
.filter-btn {
    padding: 6px 18px;
    border: 1px solid #000000;
    border-radius: 20px;
    background: white;
    color: #000000;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}
.filter-btn:hover {
    background: #f1f5f9;
}
.filter-btn.active {
    background: #000000;
    border-color: #000000;
    color: white;
}

/* Team Grid */
.team-container {
    max-width: 1320px;
    margin: 0 auto;
    padding: 16px 24px 50px 24px;
}
.team-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

/* Team Card */
.team-card {
    background: white;
    border: 1px solid #E2E8F0;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}
.team-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px -4px rgba(0, 0, 0, 0.08);
    border-color: #CBD5E1;
}
.team-image-wrapper {
    width: 100%;
    height: 280px;
    background: #F1F5F9;
    position: relative;
    overflow: hidden;
}
.team-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    transition: transform 0.3s ease;
}
.team-card-content {
    padding: 18px 20px 20px 20px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    -webkit-font-smoothing: antialiased;
}
.team-name {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: #0F172A;
    margin: 0 0 4px 0;
    letter-spacing: -0.01em;
    line-height: 1.3;
}
.team-role {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    font-size: 15px;
    font-weight: 500;
    color: #B3261E;
    margin: 0 0 14px 0;
    letter-spacing: normal;
    line-height: 1.4;
}
.team-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: 0;
}
.team-tag {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    background: #F3E8FF;
    padding: 6px 16px;
    border-radius: 9999px;
    font-weight: 500;
    color: #6B21A8;
    border: none;
    font-size: 13.5px;
    line-height: 1.4;
    display: inline-flex;
    align-items: center;
}
.team-location {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #F1F5F9;
    padding: 6px 16px;
    border-radius: 9999px;
    font-weight: 500;
    color: #475569;
    border: none;
    font-size: 13.5px;
    line-height: 1.4;
}
.team-location svg {
    width: 14px;
    height: 14px;
    stroke: #64748b;
    stroke-width: 2;
    flex-shrink: 0;
}
.team-desc {
    font-size: 13px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 20px;
}
.team-social {
    margin-top: 15px;
}
.team-social a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    background: #f0f9ff;
    border-radius: 4px;
    color: #0284c7; 
    transition: background 0.2s ease;
}
.team-social a:hover {
    background: #e0f2fe;
}
.team-social a svg {
    width: 14px;
    height: 14px;
}

@media (max-width: 1200px) {
    .team-grid { grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .team-image-wrapper { height: 300px; }
}
@media (max-width: 850px) {
    .team-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
    .team-image-wrapper { height: 280px; }
}
@media (max-width: 520px) {
    .team-grid { grid-template-columns: 1fr; gap: 20px; }
    .team-image-wrapper { height: 300px; }
    .team-card-content { padding: 20px; }
}
</style>

<!-- Hero Section -->
<section class="team-hero">
    <div class="team-hero-content">
        <h1 class="team-hero-title">{{ $teamSettings['title'] ?? 'Meet Our Team' }}</h1>
        <p class="team-hero-subtitle">{{ $teamSettings['subtitle'] ?? 'The talented individuals who make TekQuora a great place to work' }}</p>
    </div>
</section>

<!-- Filter Section -->
<div class="team-filter-bar">
    <button class="filter-btn active" data-filter="all">All</button>
    <button class="filter-btn" data-filter="leadership">Leadership</button>
    <button class="filter-btn" data-filter="hr_operation">HR & Operation</button>
    <button class="filter-btn" data-filter="employee">Employee</button>
    <button class="filter-btn" data-filter="marketing">Digital Marketing</button>
    <button class="filter-btn" data-filter="intern">Intern</button>
</div>

<!-- Grid Section -->
<div class="team-container">
    <div class="team-grid">
        @php
            $members = $teamSettings['members'] ?? [];
        @endphp
        
        @if(!empty($members))
            @foreach($members as $member)
                @php
                    // Map type/role to one of: leadership, hr_operation, employee, marketing, intern
                    $memberType = strtolower($member['type'] ?? 'employee');
                    $memberRole = strtolower($member['role'] ?? '');
                    $memberName = strtolower($member['name'] ?? '');

                    // Explicitly restrict Employee to only these 5 names
                    $isEmployeeName = str_contains($memberName, 'praveen') || 
                                      str_contains($memberName, 'raghul') || 
                                      str_contains($memberName, 'nancy') || 
                                      str_contains($memberName, 'zubirya') || 
                                      str_contains($memberName, 'zubairya') || 
                                      str_contains($memberName, 'charles');

                    if ($isEmployeeName) {
                        $deptFilter = 'employee';
                        $displayType = 'Employee';
                    } elseif ($memberType === 'management' || str_contains($memberRole, 'director') || str_contains($memberRole, 'officer')) {
                        $deptFilter = 'leadership';
                        $displayType = 'Leadership';
                    } elseif ($memberType === 'hr_operation' || str_contains($memberRole, 'hr') || str_contains($memberRole, 'human resource')) {
                        $deptFilter = 'hr_operation';
                        $displayType = 'HR & Operation';
                    } elseif ($memberType === 'intern' || str_contains($memberRole, 'intern')) {
                        $deptFilter = 'intern';
                        $displayType = 'Intern';
                    } elseif (str_contains($memberRole, 'marketing') || str_contains($memberRole, 'social media') || str_contains($memberRole, 'seo') || $memberType === 'marketing' || $memberType === 'seo') {
                        $deptFilter = 'marketing';
                        $displayType = 'Digital Marketing';
                    } else {
                        // Fallback category if not matching the 5 employee names
                        $deptFilter = 'intern';
                        $displayType = 'Intern';
                    }
                @endphp
                <div class="team-card" data-department="{{ $deptFilter }}">
                    <div class="team-image-wrapper">
                        @if(!empty($member['image']))
                            <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" onerror="this.src='/assets/team.png'">
                        @else
                            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #475569, #1e293b); display: flex; align-items: center; justify-content: center; color: white; font-size: 32px; font-weight: 700;">
                                {{ $member['initials'] ?? 'TQ' }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="team-card-content">
                        <h3 class="team-name">{{ $member['name'] }}</h3>
                        <p class="team-role">{{ $member['role'] }}</p>
                        
                        <div class="team-meta">
                            <span class="team-tag">{{ $displayType }}</span>
                            <span class="team-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#475569" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ !empty($member['location']) ? $member['location'] : 'Chennai' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const memberCards = document.querySelectorAll('.team-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            memberCards.forEach(card => {
                const cardDept = card.getAttribute('data-department');
                if (filterValue === 'all') {
                    card.style.display = 'flex';
                } else {
                    if (cardDept === filterValue) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });
});
</script>

@endsection