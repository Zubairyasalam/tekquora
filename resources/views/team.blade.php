@extends('layouts.app')

@section('title', 'Meet Our Team - TekQuora')

@section('content')
<!-- Team Hero Section -->
<section class="team-hero" style="background-image: linear-gradient(rgba(15, 23, 42, 0.45), rgba(15, 23, 42, 0.6)), url('{{ asset('assets/team.png') }}');">
    <div class="team-hero-content">
        <h1 class="team-hero-title">{{ $teamSettings['title'] ?? 'Meet Our Team' }}</h1>
        <p class="team-hero-subtitle">{{ $teamSettings['subtitle'] ?? 'The talented individuals who make TekQuora a great place to work' }}</p>
    </div>
</section>

<!-- Team Filter & Grid Section -->
<section class="team-directory-section">
    <div class="team-directory-container">
        
        <!-- Filter Bar -->
        <div class="team-filter-bar">
            <button class="filter-btn active" data-filter="all">Everyone</button>
            <button class="filter-btn" data-filter="management">Leadership</button>
            <button class="filter-btn" data-filter="hr_operation">HR & Operation</button>
            <button class="filter-btn" data-filter="employee">Employee</button>
            <button class="filter-btn" data-filter="marketing">Digital Marketing</button>
            <button class="filter-btn" data-filter="intern">Intern</button>
        </div>

        @php
            $members = $teamSettings['members'] ?? [];
            if (is_array($members)) {
                usort($members, function($a, $b) {
                    $typeA = strtolower($a['type'] ?? 'employee');
                    $typeB = strtolower($b['type'] ?? 'employee');
                    
                    $priority = [
                        'management' => 1,
                        'hr_operation' => 2,
                        'employee' => 3,
                        'marketing' => 4,
                        'intern' => 5
                    ];
                    
                    $pA = $priority[$typeA] ?? 2;
                    $pB = $priority[$typeB] ?? 2;
                    
                    return $pA <=> $pB;
                });
            }
        @endphp

        <!-- Team Grid -->
        <div class="team-grid">
            @if(!empty($members))
                @foreach($members as $member)
                    <div class="team-card-wrapper management-card" data-department="{{ strtolower($member['type'] ?? 'employee') }}">
                        <div class="management-image">
                            <img src="{{ !empty($member['image']) ? $member['image'] : '/assets/team.png' }}" alt="{{ $member['name'] }}" onerror="this.src='/assets/team.png'">
                        </div>
                        <div class="management-content">
                            <h3>{{ $member['name'] }}</h3>
                            <p class="management-role">{{ $member['role'] }}</p>
                            <div class="management-tags">
                                @php
                                    $typeDisplay = [
                                        'management' => 'Leadership',
                                        'hr_operation' => 'HR & Operation',
                                        'employee' => 'Employee',
                                        'marketing' => 'Digital Marketing',
                                        'intern' => 'Intern'
                                    ];
                                    $displayType = $typeDisplay[strtolower($member['type'] ?? 'employee')] ?? ucfirst($member['type'] ?? 'Employee');
                                @endphp
                                <span class="tag-badge tag-{{ strtolower($member['type'] ?? 'employee') }}">{{ $displayType }}</span>
                                <span class="tag-badge tag-location">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                    {{ !empty($member['location']) ? $member['location'] : 'Chennai' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Filter Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const memberCards = document.querySelectorAll('.team-card-wrapper');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            memberCards.forEach(card => {
                const cardDept = card.getAttribute('data-department');
                if (filterValue === 'all' || cardDept === filterValue) {
                    card.style.display = 'flex';
                    // Trigger reflow for transition
                    card.offsetHeight;
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1) translateY(0)';
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.95) translateY(10px)';
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endsection
            </div>

            <div class="team-member-card" data-department="intern">
                <div class="member-image-wrapper">
                    <div class="member-avatar-placeholder dev-gradient">
                        <span>MR</span>
                    </div>
                </div>