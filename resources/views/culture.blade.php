@extends('layouts.app')

@section('title', 'Our Service - TekQuora')

@section('content')

@php
    $heroTitle = \App\Models\Setting::get('service_hero_title', 'Our Service');
    $heroSubtitle = \App\Models\Setting::get('service_hero_subtitle', 'We believe great products are built by happy, collaborative teams.');

    $section1Title = \App\Models\Setting::get('service_section1_title', 'Building Future-Ready Teams Through Innovation');
    $section1Paragraph = \App\Models\Setting::get('service_section1_paragraph', 'At TekQuora, we foster an environment where creativity, learning, and team coordination are valued. We support every team member in reaching their potential, encouraging open collaboration, and building high-performance digital products together.');
    $featuresJson = \App\Models\Setting::get('service_section1_features');
    $features = $featuresJson ? json_decode($featuresJson, true) : [
        ['title' => 'Innovation First', 'description' => 'We encourage creativity, experimentation, and continuous learning.', 'icon' => 'lightbulb'],
        ['title' => 'Collaborative Environment', 'description' => 'Every project is built through teamwork, communication, and shared success.', 'icon' => 'users'],
        ['title' => 'Growth & Learning', 'description' => 'Employees receive mentorship, training, and opportunities to grow.', 'icon' => 'graduation-cap']
    ];

    $section2Title = \App\Models\Setting::get('service_section2_title', 'Building Great Teams, Creating Greater Impact!');
    $section2Paragraph = \App\Models\Setting::get('service_section2_paragraph', 'At TekQuora, we foster a culture of innovation, collaboration, and continuous learning where every individual grows and makes a difference.');
    $section2SkylineImage = \App\Models\Setting::get('service_section2_skyline_image', '');

    $nodesJson = \App\Models\Setting::get('service_section2_nodes');
    $nodes = $nodesJson ? json_decode($nodesJson, true) : [
        ['label' => 'Growth', 'title' => 'Employee Growth', 'description' => 'We believe in nurturing talent and providing clear paths for personal and professional advancement through continuous mentorship.', 'icon' => 'trending-up'],
        ['label' => 'Collaboration', 'title' => 'Team Collaboration', 'description' => 'We prioritize open communication, active listening, and collective brainstorming to solve complex engineering challenges.', 'icon' => 'users'],
        ['label' => 'Innovation', 'title' => 'Innovation & Creativity', 'description' => 'We foster an atmosphere of curiosity, encouraging developers to experiment with new technologies and architectures.', 'icon' => 'zap'],
        ['label' => 'Excellence', 'title' => 'Excellence & Quality', 'description' => 'We strive for top-tier code quality, high performance, and robust security in every line of code we write.', 'icon' => 'award'],
        ['label' => 'Wellbeing', 'title' => 'Work-Life Balance', 'description' => 'We offer flexible hours, wellness programs, and team-building events to support healthy work-life integration.', 'icon' => 'heart'],
        ['label' => 'Learning', 'title' => 'Continuous Learning', 'description' => 'We sponsor certificates, training courses, and encourage sharing knowledge through regular technical sessions.', 'icon' => 'book-open']
    ];

    $section3Title = \App\Models\Setting::get('service_section3_title', 'Connecting Businesses and Innovation Worldwide');
    $section3Paragraph = \App\Models\Setting::get('service_section3_paragraph', 'TekQuora proudly partners with businesses across multiple countries, delivering innovative digital solutions that drive growth and transformation. From custom software development and web applications to AI-powered solutions, cloud technologies, and enterprise platforms, we help organizations achieve their goals with scalable, secure, and high-performance products.');
    $section3MapImage = \App\Models\Setting::get('service_section3_map_image', '/assets/world_map_clean.png');

    $statsJson = \App\Models\Setting::get('service_section3_stats');
    $stats = $statsJson ? json_decode($statsJson, true) : [
        ['value' => '15+', 'label' => 'Countries Served', 'icon' => 'globe'],
        ['value' => '500+', 'label' => 'Projects Delivered', 'icon' => 'check-square'],
        ['value' => '50+', 'label' => 'Global Partners', 'icon' => 'users'],
        ['value' => '100%', 'label' => 'Client Satisfaction', 'icon' => 'star']
    ];

    if (!function_exists('getLucideSvg')) {
        function getLucideSvg($iconName, $size = 22, $strokeWidth = 2) {
            $svgs = [
                'lightbulb' => '<svg xmlns="http://www.w3.org/2000/svg" width="%size%" height="%size%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%stroke%" stroke-linecap="round" stroke-linejoin="round"><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A5 5 0 0 0 8 8c0 1 .3 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"/><path d="M9 18h6"/><path d="M10 22h4"/></svg>',
                'users' => '<svg xmlns="http://www.w3.org/2000/svg" width="%size%" height="%size%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%stroke%" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
                'graduation-cap' => '<svg xmlns="http://www.w3.org/2000/svg" width="%size%" height="%size%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%stroke%" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"/></svg>',
                'globe' => '<svg xmlns="http://www.w3.org/2000/svg" width="%size%" height="%size%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%stroke%" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
                'zap' => '<svg xmlns="http://www.w3.org/2000/svg" width="%size%" height="%size%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%stroke%" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
                'award' => '<svg xmlns="http://www.w3.org/2000/svg" width="%size%" height="%size%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%stroke%" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>',
                'heart' => '<svg xmlns="http://www.w3.org/2000/svg" width="%size%" height="%size%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%stroke%" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.5 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>',
                'book-open' => '<svg xmlns="http://www.w3.org/2000/svg" width="%size%" height="%size%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%stroke%" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>',
                'trending-up' => '<svg xmlns="http://www.w3.org/2000/svg" width="%size%" height="%size%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%stroke%" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>',
                'check-square' => '<svg xmlns="http://www.w3.org/2000/svg" width="%size%" height="%size%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%stroke%" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
                'star' => '<svg xmlns="http://www.w3.org/2000/svg" width="%size%" height="%size%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%stroke%" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>'
            ];
            $svg = $svgs[$iconName] ?? $svgs['lightbulb'];
            return str_replace(['%size%', '%stroke%'], [$size, $strokeWidth], $svg);
        }
    }
@endphp

<!-- Hero Section -->
<section class="team-hero">
    <div class="team-hero-content" style="max-width: 800px; margin: 0 auto;">
        <h1 class="team-hero-title">{!! $heroTitle !!}</h1>
        <p class="team-hero-subtitle">{{ $heroSubtitle }}</p>
    </div>
</section>

<!-- CSS Styles for Work Culture Sections -->
<style>
    /* SECTION 1: TWO-COLUMN TIMELINE LIST */
    .culture-redesign-section {
        padding: 4rem 1.5rem 1rem 1.5rem;
        background-color: #ffffff;
        position: relative;
        overflow: hidden;
    }
    
    .culture-redesign-container {
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
    }
    
    .culture-grid {
        max-width: 850px;
        margin: 0 auto;
    }
    
    .culture-left-content {
        display: flex;
        flex-direction: column;
    }
    
    .culture-sub-title-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1rem;
    }
    
    .culture-sub-line {
        width: 32px;
        height: 2px;
        background-color: var(--primary, #0061ff);
    }
    
    .culture-sub-text {
        font-family: var(--font-heading);
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--primary, #0061ff);
        letter-spacing: 0.05em;
    }
    
    .culture-main-heading {
        font-family: var(--font-heading);
        font-size: 2.6rem;
        font-weight: 800;
        background: linear-gradient(90deg, #00d2ff 0%, #3b82f6 45%, #a855f7 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.25;
        letter-spacing: -0.02em;
        margin-bottom: 1.25rem;
    }
    
    .culture-paragraph {
        font-family: var(--font-body);
        font-size: 1.1rem;
        color: #475569;
        line-height: 1.7;
        margin-bottom: 2.5rem;
    }
    
    .culture-features-wrapper {
        display: flex;
        gap: 2rem;
        align-items: stretch;
        position: relative;
    }
    
    .culture-features-list {
        display: flex;
        flex-direction: column;
        gap: 2rem;
        flex: 1;
    }
    
    .culture-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
        padding: 0.5rem 0;
        background: transparent;
        border: none;
        box-shadow: none;
        opacity: 0.55;
        transition: opacity 0.3s ease, transform 0.3s ease;
        cursor: pointer;
    }
    
    .culture-feature-item.active,
    .culture-feature-item:hover {
        opacity: 1;
        transform: translateX(4px);
    }
    
    .feature-icon-box {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 8px 16px rgba(15, 23, 42, 0.03);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        flex-shrink: 0;
        transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
    }
    
    .culture-feature-item.active .feature-icon-box {
        border-color: rgba(0, 97, 255, 0.3);
        color: var(--primary, #0061ff);
        box-shadow: 0 10px 20px rgba(0, 97, 255, 0.08);
    }
    
    .feature-info {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
    }
    
    .feature-title {
        font-family: var(--font-heading);
        font-size: 1.3rem;
        font-weight: 700;
        color: #0f172a;
        transition: color 0.3s ease;
    }
    
    .culture-feature-item.active .feature-title {
        color: var(--primary, #0061ff);
    }
    
    .feature-desc {
        font-family: var(--font-body);
        font-size: 0.95rem;
        color: #64748b;
        line-height: 1.6;
    }
    
    .features-progress-track {
        width: 4px;
        background-color: #f1f5f9;
        border-radius: 4px;
        position: relative;
        align-self: stretch;
        margin-left: 1rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    
    .features-progress-fill {
        position: absolute;
        width: 100%;
        background-color: var(--primary, #0061ff);
        border-radius: 4px;
        top: 0;
        height: 33.33%;
        transition: top 0.3s cubic-bezier(0.25, 1, 0.5, 1), height 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 97, 255, 0.3);
    }
    
    .culture-right-visual {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1.5rem 1rem;
    }
    
    .culture-visual-bg-shape {
        position: absolute;
        top: 0;
        right: 0;
        width: 88%;
        height: 92%;
        background: linear-gradient(135deg, rgba(0, 97, 255, 0.06) 0%, rgba(124, 58, 237, 0.06) 100%);
        border-radius: 28px;
        z-index: 1;
        transform: rotate(2deg);
    }
    
    .culture-image-container {
        position: relative;
        width: 100%;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(0, 97, 255, 0.12), 0 8px 24px rgba(15, 23, 42, 0.08);
        z-index: 2;
        aspect-ratio: 4 / 3;
    }
    
    .culture-image-container::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 50%, rgba(10, 20, 50, 0.45) 100%);
        z-index: 1;
        pointer-events: none;
    }
    
    .culture-team-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .culture-image-container:hover .culture-team-img {
        transform: scale(1.04);
    }
    
    /* Top-right badge card */
    .floating-badge-card {
        position: absolute;
        top: -16px;
        right: -12px;
        background: linear-gradient(135deg, #0061ff, #7c3aed);
        border-radius: 16px;
        padding: 1rem 1.4rem;
        display: flex;
        align-items: center;
        gap: 0.85rem;
        box-shadow: 0 12px 32px rgba(0, 97, 255, 0.35);
        z-index: 6;
        animation: floatAnimation 4s ease-in-out infinite;
    }

    .floating-badge-card .badge-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(255,255,255,0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
    }
    .floating-badge-card .badge-info {
        display: flex;
        flex-direction: column;
    }
    .floating-badge-card .badge-number {
        font-family: var(--font-heading);
        font-size: 1.3rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.1;
    }
    .floating-badge-card .badge-label {
        font-family: var(--font-body);
        font-size: 0.78rem;
        color: rgba(255,255,255,0.8);
        font-weight: 500;
    }
    
    /* Bottom-left stats card */
    .floating-stats-card {
        position: absolute;
        bottom: 8%;
        left: -5%;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 18px;
        padding: 1.1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.1);
        z-index: 5;
        max-width: 260px;
        animation: floatAnimation 4.5s ease-in-out infinite 0.5s;
    }
    
    @keyframes floatAnimation {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    
    .stats-icon-box {
        width: 44px;
        height: 44px;
        min-width: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, #0061ff, #7c3aed);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
    }
    
    .stats-info {
        display: flex;
        flex-direction: column;
    }
    
    .stats-number {
        font-family: var(--font-heading);
        font-size: 1.3rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
    }
    
    .stats-label {
        font-family: var(--font-body);
        font-size: 0.8rem;
        color: #64748b;
        font-weight: 500;
    }
    
    .fade-up-element {
        opacity: 1;
        transform: none;
        transition: none;
    }
    .fade-up-element.in-view {
        opacity: 1;
        transform: none;
    }

    /* -----------------------------------------------
       SECTION 2: ARC TIMELINE WHEEL (REDESIGNED)
       ----------------------------------------------- */
    .arc-wheel-section {
        padding: 2rem 1.5rem 1rem 1.5rem;
        background: radial-gradient(circle at center, #f8fafc 0%, #ffffff 80%);
        position: relative;
        overflow: hidden;
    }
    
    /* Elegant SaaS grid backdrop centered behind the arc */
    .arc-wheel-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: linear-gradient(rgba(15, 23, 42, 0.03) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(15, 23, 42, 0.03) 1px, transparent 1px);
        background-size: 40px 40px;
        background-position: center;
        mask-image: radial-gradient(circle at center, black 40%, transparent 80%);
        -webkit-mask-image: radial-gradient(circle at center, black 40%, transparent 80%);
        pointer-events: none;
        z-index: 1;
    }
    
    /* Subtle dot grid pattern in top corners matching reference */
    .culture-dots {
        position: absolute;
        top: 0;
        width: 260px;
        height: 260px;
        background-image: radial-gradient(rgba(148, 163, 184, 0.15) 1.5px, transparent 1.5px);
        background-size: 16px 16px;
        pointer-events: none;
        z-index: 1;
    }
    .culture-dots-left { left: 0; }
    .culture-dots-right { right: 0; }
    
    .arc-wheel-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }
    
    .arc-header {
        text-align: center;
        margin-bottom: 4.5rem;
    }
    
    .arc-subtitle-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        color: var(--primary, #0061ff);
        font-family: var(--font-heading);
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 1rem;
        letter-spacing: 0.1em;
    }
    
    .arc-subtitle-line {
        width: 30px;
        height: 2px;
        background-color: var(--primary, #0061ff);
    }
    
    .arc-title {
        font-family: var(--font-heading);
        font-size: 2.8rem;
        font-weight: 900;
        background: linear-gradient(90deg, #00d2ff 0%, #3b82f6 45%, #a855f7 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1.25rem;
        letter-spacing: -0.02em;
        line-height: 1.2;
    }
    
    .arc-desc {
        font-family: var(--font-body);
        color: #64748b;
        font-size: 1.15rem;
        max-width: 680px;
        margin: 0 auto;
        line-height: 1.7;
    }
    
    /* Circular Arc Timeline Wrapper */
    .arc-timeline-wrapper {
        position: relative;
        max-width: 1000px;
        width: 100%;
        aspect-ratio: 1000 / 480;
        margin: 0 auto;
    }
    
    .arc-timeline-svg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }
    
    .arc-timeline-node {
        position: absolute;
        width: 68px;
        height: 68px;
        border-radius: 50%;
        background-color: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.03), 0 1px 3px rgba(15, 23, 42, 0.02);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        translate: -50% -50%;
        transition: background-color 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), 
                    border-color 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), 
                    box-shadow 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), 
                    transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1),
                    color 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        color: var(--primary, #0061ff); /* Blue icons by default matching reference */
    }
    
    .arc-timeline-node:hover {
        background: linear-gradient(135deg, #0061ff 0%, #3b82f6 100%);
        color: #ffffff; /* Hover node has white icon */
        border: 2px solid #ffffff;
        box-shadow: 0 0 0 4px rgba(0, 97, 255, 0.15), 0 12px 25px rgba(0, 97, 255, 0.25); /* Glow halo & shadow */
        transform: scale(1.15); /* Match the active node scale */
    }
    
    .arc-timeline-node:hover .arc-node-label {
        color: var(--primary, #0061ff);
    }
    
    .arc-timeline-node.active {
        background: linear-gradient(135deg, #0061ff 0%, #3b82f6 100%);
        color: #ffffff; /* Active node has white icon */
        border: 2px solid #ffffff;
        box-shadow: 0 0 0 4px rgba(0, 97, 255, 0.15), 0 12px 25px rgba(0, 97, 255, 0.25); /* Glow halo & shadow */
        transform: scale(1.15); /* Premium SaaS active scale */
    }

    .arc-timeline-node.active:hover {
        transform: scale(1.15); /* Keep active scale when hovered */
        box-shadow: 0 0 0 4px rgba(0, 97, 255, 0.2), 0 15px 30px rgba(0, 97, 255, 0.3);
    }
    
    .arc-node-label {
        position: absolute;
        bottom: -28px;
        left: 50%;
        transform: translateX(-50%);
        font-family: var(--font-heading);
        font-size: 0.75rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        white-space: nowrap;
        transition: color 0.3s ease;
    }
    
    .arc-timeline-node.active .arc-node-label {
        color: var(--primary, #0061ff);
    }
    
    /* Float animation on nodes */
    .arc-timeline-node.float-1 { animation: nodeFloat 4s ease-in-out infinite; }
    .arc-timeline-node.float-2 { animation: nodeFloat 4.2s ease-in-out infinite 0.5s; }
    .arc-timeline-node.float-3 { animation: nodeFloat 4.5s ease-in-out infinite 1s; }
    
    @keyframes nodeFloat {
        0%, 100% { margin-top: 0; }
        50% { margin-top: -6px; }
    }
    
    /* Polar node coordinates along 400px radius arc (percentages for responsiveness) */
    .arc-node-index-1 { left: 10.15%; top: 79.17%; }
    .arc-node-index-2 { left: 18.9%; top: 33.96%; }
    .arc-node-index-3 { left: 38.3%; top: 6.67%; }
    .arc-node-index-4 { left: 61.7%; top: 6.67%; }
    .arc-node-index-5 { left: 81.1%; top: 33.96%; }
    .arc-node-index-6 { left: 89.8%; top: 79.17%; }
    
    /* Skyline Silhouettes (High-Quality Architectural Monochrome Assets) */
    .culture-skyline {
        position: absolute;
        bottom: 0;
        width: 550px;
        height: 100%;
        opacity: 0.35; /* Much darker black shade (35% opacity) */
        z-index: 1;
        pointer-events: none;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: bottom;
        mix-blend-mode: multiply; /* Blends naturally into the background gradient */
        filter: grayscale(1); /* Sharp and crisp lines without blur */
        transition: opacity 0.3s ease;
    }
    .culture-skyline-left { 
        left: 0; 
        background-image: url('/assets/skyline_left.png');
    }
    .culture-skyline-right { 
        right: 0; 
        background-image: url('/assets/skyline_right.png');
    }
    
    /* Central Content Display (Borderless & Transparent Card Container matching reference) */
    .arc-center-content-wrapper {
        position: absolute;
        top: 60%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        max-width: 580px;
        text-align: center;
        z-index: 5;
        display: flex;
        flex-direction: column;
        align-items: center;
        animation: textAppear-centered 0.45s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    @keyframes textAppear-centered {
        from { opacity: 0; transform: translate(-50%, -40%) scale(0.98); }
        to { opacity: 1; transform: translate(-50%, -50%) scale(1); }
    }
    
    .arc-center-icon-box {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(0, 97, 255, 0.06) 0%, rgba(96, 165, 250, 0.06) 100%);
        border: 1px solid rgba(0, 97, 255, 0.1);
        color: var(--primary, #0061ff);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
        transition: all 0.3s ease;
    }
    
    .arc-center-title {
        font-family: var(--font-heading);
        font-size: 2.2rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 0.25rem;
        letter-spacing: -0.01em;
    }
    
    /* Blue title underline matching reference */
    .center-title-line {
        width: 40px;
        height: 3px;
        background-color: var(--primary, #0061ff);
        margin: 0.75rem auto 1.25rem auto;
        border-radius: 99px;
    }
    
    .arc-center-desc {
        font-family: var(--font-body);
        color: #475569;
        font-size: 1.05rem;
        line-height: 1.65;
        margin-bottom: 1.75rem;
        max-width: 500px;
    }
    
    .btn-arc-center {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 0.85rem 2.25rem;
        background: linear-gradient(135deg, #0061ff 0%, #0052d4 100%);
        color: #ffffff;
        border-radius: 30px;
        font-family: var(--font-body);
        font-size: 0.95rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 4px 14px rgba(0, 97, 255, 0.25);
    }
    
    .btn-arc-center:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(0, 97, 255, 0.25);
        background-color: #0056e0;
    }
    
    
    
    /* Tab fallback layout for Mobile/Tablet */
    .arc-mobile-tabs {
        display: none;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
        margin-bottom: 2rem;
    }
    
    .arc-mobile-tab-btn {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 0.75rem 0.5rem;
        border-radius: 12px;
        text-align: center;
        font-family: var(--font-heading);
        font-weight: 700;
        font-size: 0.85rem;
        color: #475569;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .arc-mobile-tab-btn.active {
        background: var(--primary, #0061ff);
        border-color: var(--primary, #0061ff);
        color: #ffffff;
    }

    /* Responsive Styling for Arc Timeline */
    @media (max-width: 1024px) {
        .culture-redesign-section {
            padding: 4rem 1.5rem;
        }
        .culture-grid {
            grid-template-columns: 1fr;
            gap: 3.5rem;
        }
        .culture-right-visual {
            order: 2;
        }
        .culture-left-content {
            order: 1;
        }
        .floating-stats-card {
            left: 5%;
            bottom: -5%;
        }
        
        .arc-timeline-wrapper {
            max-width: 800px;
            height: auto;
        }
        .arc-timeline-node {
            width: 60px;
            height: 60px;
        }
        .arc-node-label {
            font-size: 0.8rem;
        }
        .arc-more-culture-container {
            position: static;
            margin: 0 auto 2.5rem auto;
            max-width: 155px;
        }
    }
    
    @media (max-width: 768px) {
        .culture-main-heading, .arc-title {
            font-size: 2.1rem;
        }
        .culture-paragraph, .arc-desc {
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        .floating-stats-card {
            position: relative;
            left: 0;
            bottom: 0;
            margin-top: 1.5rem;
            max-width: 100%;
            width: 100%;
            justify-content: center;
            transform: none !important;
            animation: none;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(15, 23, 42, 0.01);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .culture-image-container {
            aspect-ratio: 16 / 9;
        }
        .culture-right-visual {
            padding: 0;
        }
        .features-progress-track {
            display: none;
        }
        .culture-feature-item {
            opacity: 1 !important;
        }
        
        /* Fallback mobile layouts for Arc Timeline */
        .arc-timeline-svg {
            display: none;
        }
        .arc-timeline-node {
            display: none;
        }
        .arc-mobile-tabs {
            display: grid;
        }
        .arc-timeline-wrapper {
            height: auto;
        }
        .arc-center-content-wrapper {
            position: static;
            transform: none;
            max-width: 100%;
            min-height: auto;
            padding: 1.5rem 0;
            animation: none;
        }
        .culture-skyline {
            display: none;
        }
        .culture-dots {
            display: none;
        }
    }
    
    /* -----------------------------------------------
       SECTION 3: GLOBAL PRESENCE SECTION (REDESIGNED)
       ----------------------------------------------- */
    .global-reach-section {
        padding: 1.5rem 1.5rem 6rem 1.5rem;
        background: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .global-reach-container {
        max-width: 1280px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        position: relative;
        z-index: 2;
    }

    /* Top: Centered Header Block */
    .global-reach-header {
        text-align: center;
        max-width: 820px;
        margin: 0 auto;
    }

    .global-reach-eyebrow {
        display: inline-block;
        color: var(--primary, #0061ff);
        font-family: var(--font-heading);
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        margin-bottom: 1rem;
        padding: 6px 18px;
        border: 1px solid rgba(0, 97, 255, 0.2);
        border-radius: 100px;
        background: rgba(0, 97, 255, 0.05);
    }

    .global-reach-title {
        font-family: var(--font-heading);
        font-size: 2.6rem;
        font-weight: 900;
        background: linear-gradient(90deg, #00d2ff 0%, #3b82f6 45%, #a855f7 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
        letter-spacing: -0.02em;
        margin-bottom: 1.25rem;
    }

    .global-reach-desc {
        font-family: var(--font-body);
        color: #475569;
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 0;
    }

    /* Redesigned Floating Stats Cards Container */
    .global-reach-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        max-width: 1100px;
        margin: 1.5rem auto 0;
        width: 100%;
    }

    .global-stat-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 20px;
        padding: 1.4rem 1.2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02);
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
    }

    .global-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #0061ff 0%, #7c3aed 100%);
        border-radius: 4px 0 0 4px;
        opacity: 0.8;
        transition: opacity 0.3s ease;
    }

    .global-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 97, 255, 0.12), 0 4px 12px rgba(15, 23, 42, 0.04);
        border-color: rgba(0, 97, 255, 0.3);
    }

    .stat-card-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 14px;
        background: linear-gradient(135deg, rgba(0, 97, 255, 0.08) 0%, rgba(124, 58, 237, 0.08) 100%);
        color: #0061ff;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .global-stat-card:hover .stat-card-icon {
        background: linear-gradient(135deg, #0061ff 0%, #7c3aed 100%);
        color: #ffffff;
        box-shadow: 0 8px 18px rgba(0, 97, 255, 0.3);
    }

    .stat-card-content {
        display: flex;
        flex-direction: column;
    }

    .global-stat-value {
        font-family: var(--font-heading);
        font-size: 1.8rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.1;
        margin-bottom: 0.2rem;
    }

    .global-stat-value span {
        background: linear-gradient(135deg, #0061ff 0%, #7c3aed 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .global-stat-label {
        font-family: var(--font-body);
        font-size: 0.78rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        line-height: 1.3;
    }

    /* Map Canvas */
    .global-reach-map-area {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        margin-top: -1rem;
        overflow: hidden;
    }

    .global-map-wrapper {
        position: relative;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        aspect-ratio: 2 / 1;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transform: scale(1.35);
        transform-origin: center center;
    }

    .global-map-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        opacity: 1;
    }

    /* Pulse Animation for Map Hotspots */
    @keyframes mapPulse {
        0% { transform: scale(0.8); opacity: 0.8; }
        50% { transform: scale(2.2); opacity: 0; }
        100% { transform: scale(0.8); opacity: 0; }
    }

    .map-hotspot {
        position: absolute;
        width: 12px;
        height: 12px;
        background-color: #00f2fe;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0 0 10px rgba(0, 242, 254, 0.6), 0 0 25px rgba(0, 242, 254, 0.3);
        z-index: 5;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .map-hotspot::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: #00f2fe;
        border-radius: 50%;
        animation: mapPulse 2.2s infinite ease-out;
        transform-origin: center;
        left: 0;
        top: 0;
    }

    .hotspot-label {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%) translateY(10px);
        background: rgba(15, 23, 42, 0.9);
        color: #ffffff;
        padding: 6px 10px;
        border-radius: 8px;
        font-family: var(--font-body), sans-serif;
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
        pointer-events: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .hotspot-label::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        border-width: 5px 5px 0;
        border-style: solid;
        border-color: rgba(15, 23, 42, 0.9) transparent;
        display: block;
        width: 0;
    }

    .map-hotspot:hover {
        background-color: #ffffff;
        box-shadow: 0 0 20px #00f2fe, 0 0 35px #00f2fe;
        transform: translate(-50%, -50%) scale(1.4);
        z-index: 10;
    }

    .map-hotspot:hover .hotspot-label {
        opacity: 1;
        visibility: visible;
        background: #0061ff;
        transform: translateX(-50%) translateY(0);
    }

    .map-hotspot:hover .hotspot-label::after {
        border-color: #0061ff transparent;
    }

    /* Define Hub Locations on the World Map (Calibrated to landmasses) */
    .spot-1 { left: 67.5%; top: 50%; }   /* Tamil Nadu */
    .spot-2 { left: 72.5%; top: 54%; }   /* Singapore */
    .spot-3 { left: 58.5%; top: 39%; }   /* Dubai */
    .spot-4 { left: 17%; top: 35%; }     /* San Francisco */
    .spot-5 { left: 46%; top: 24%; }     /* London */
    .spot-6 { left: 67%; top: 48%; }     /* Bengaluru */
    .spot-7 { left: 78%; top: 34%; }     /* Tokyo */
    .spot-9 { left: 49.5%; top: 24%; }   /* Berlin */
    .spot-10 { left: 25%; top: 32%; }    /* Toronto */
    .spot-11 { left: 66.5%; top: 51%; }  /* Kerala */
    .spot-12 { left: 27%; top: 34%; }    /* New York */
    .spot-13 { left: 47.5%; top: 26%; }  /* Paris */
    .spot-14 { left: 66%; top: 45%; }    /* Mumbai */
    .spot-16 { left: 51.5%; top: 70%; }  /* Cape Town */
    .spot-17 { left: 33%; top: 68%; }    /* São Paulo */

    /* Responsive overrides for Section 3 */
    @media (max-width: 1024px) {
        .global-reach-stats {
            gap: 2rem;
        }
    }

    @media (max-width: 768px) {
        .global-reach-section {
            padding: 2.5rem 1rem 3.5rem 1rem !important;
        }
        .global-reach-title {
            font-size: 1.95rem !important;
            line-height: 1.25 !important;
            margin-bottom: 0.75rem !important;
        }
        .global-reach-desc {
            font-size: 0.95rem !important;
            line-height: 1.6 !important;
            padding: 0 0.5rem !important;
        }
        .global-reach-stats {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 0.65rem !important;
            margin-top: 1.25rem !important;
            padding: 0 0.25rem !important;
        }
        .global-stat-card {
            padding: 0.75rem 0.6rem !important;
            gap: 0.5rem !important;
            border-radius: 14px !important;
            min-height: 64px !important;
        }
        .stat-card-icon {
            width: 36px !important;
            height: 36px !important;
            min-width: 36px !important;
            border-radius: 10px !important;
        }
        .stat-card-icon svg {
            width: 18px !important;
            height: 18px !important;
        }
        .global-stat-value {
            font-size: 1.15rem !important;
            margin-bottom: 0 !important;
        }
        .global-stat-label {
            font-size: 0.68rem !important;
            letter-spacing: 0.02em !important;
            line-height: 1.2 !important;
        }
        .global-map-wrapper {
            transform: none !important;
            aspect-ratio: 16 / 9 !important;
            margin-top: 1rem !important;
        }
    }
</style>

<!-- SECTION 1: Work Culture Redesign Section (From step 1) -->

<!-- SECTION 1: TWO-COLUMN TIMELINE LIST -->
<section class="culture-redesign-section">
    <div class="culture-redesign-container">
        <div class="culture-grid fade-up-element" id="cultureGrid">

            <!-- Left Side: Content & Features -->
            <div class="culture-left-content">
                <h2 class="culture-main-heading">{{ $section1Title }}</h2>
                <p class="culture-paragraph">
                    {{ $section1Paragraph }}
                </p>

                <div class="culture-features-wrapper">
                    <div class="culture-features-list">
                        @foreach($features as $index => $feature)
                        <div class="culture-feature-item {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                            <div class="feature-icon-box">
                                {!! getLucideSvg($feature['icon'], 22, 2) !!}
                            </div>
                            <div class="feature-info">
                                <h3 class="feature-title">{{ $feature['title'] }}</h3>
                                <p class="feature-desc">{{ $feature['description'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>


        </div>
    </div>
</section>

<!-- SECTION 2: Interactive Arc timeline Wheel Section -->
<section class="arc-wheel-section">
    <!-- Dotted corners decorations matching Image 1 -->
    <div class="culture-dots culture-dots-left"></div>
    <div class="culture-dots culture-dots-right"></div>

    <!-- Skyline Background Silhouettes -->
    @if($section2SkylineImage)
        <div class="culture-skyline culture-skyline-left" style="background-image: url('{{ $section2SkylineImage }}')"></div>
        <div class="culture-skyline culture-skyline-right" style="background-image: url('{{ $section2SkylineImage }}')"></div>
    @else
        <div class="culture-skyline culture-skyline-left"></div>
        <div class="culture-skyline culture-skyline-right"></div>
    @endif

    <div class="arc-wheel-container">

        <div class="arc-header fade-up-element" id="arcHeader">
            <h2 class="arc-title">{{ $section2Title }}</h2>
            <p class="arc-desc">
                {{ $section2Paragraph }}
            </p>
        </div>

        <div class="arc-timeline-wrapper">
            <!-- Very Light Gray/White Track Arc SVG with drop shadow and hand-drawn arrow curve -->
            <svg class="arc-timeline-svg" viewBox="0 0 1000 480" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <!-- Drop shadow for the track -->
                <path d="M 101.5 380 A 400 400 0 0 1 898.5 380" fill="none" stroke="rgba(15, 23, 42, 0.03)" stroke-width="16" filter="blur(2px)" />
                <!-- Main light gray path -->
                <path d="M 101.5 380 A 400 400 0 0 1 898.5 380" fill="none" stroke="#f1f5f9" stroke-width="12" stroke-linecap="round" />
            </svg>

            <!-- Mobile Only Tabs list wrapper -->
            <div class="arc-mobile-tabs">
                @foreach($nodes as $index => $node)
                <div class="arc-mobile-tab-btn {{ $index === 0 ? 'active' : '' }}" data-mobile-index="{{ $index + 1 }}">{{ $node['label'] }}</div>
                @endforeach
            </div>

            @foreach($nodes as $index => $node)
            <div class="arc-timeline-node arc-node-index-{{ $index + 1 }} {{ $index === 0 ? 'active' : '' }} float-{{ ($index % 3) + 1 }}" data-node="{{ $index + 1 }}" data-label="{{ $node['label'] }}">
                {!! getLucideSvg($node['icon'], 24, 2) !!}
                <span class="arc-node-label">{{ $node['label'] }}</span>
            </div>
            @endforeach

            <!-- Central Content Display (Borderless & Transparent matching Image 1) -->
            <div class="arc-center-content-wrapper" id="arcCenterCard">
                <div class="arc-center-icon-box" id="centerIcon">
                    <!-- Loaded dynamically via JS -->
                </div>
                <h3 class="arc-center-title" id="centerTitle"><!-- Loaded dynamically via JS --></h3>
                <!-- Underline element matching mockup -->
                <div class="center-title-line"></div>
                <p class="arc-center-desc" id="centerDesc">
                    <!-- Loaded dynamically via JS -->
                </p>
            </div>

        </div>

    </div>
</section>

<!-- SECTION 3: Global Presence Section (Redesigned) -->
<section class="global-reach-section">
    <div class="global-reach-container">
        
        <!-- Centered Header Block -->
        <div class="global-reach-header">
            <h2 class="global-reach-title">{{ $section3Title }}</h2>
            <p class="global-reach-desc">
                {{ $section3Paragraph }}
            </p>
        </div>

        <!-- Stats Row (Redesigned Cards) -->
        <div class="global-reach-stats">
            @foreach($stats as $stat)
            <div class="global-stat-card">
                <div class="stat-card-icon">
                    {!! getLucideSvg($stat['icon'], 22, 2.2) !!}
                </div>
                <div class="stat-card-content">
                    <div class="global-stat-value">{{ $stat['value'] }}</div>
                    <div class="global-stat-label">{{ $stat['label'] }}</div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Full-Width Interactive Map -->
        <div class="global-reach-map-area">
            <div class="global-map-wrapper">
                <img class="global-map-img" src="{{ $section3MapImage }}" alt="Global Presence Map">
                
                <div class="map-hotspot spot-1" title="Tamil Nadu, India"><span class="hotspot-label">Tamil Nadu</span></div>
                <div class="map-hotspot spot-2" title="Singapore"><span class="hotspot-label">Singapore</span></div>
                <div class="map-hotspot spot-3" title="Dubai, UAE"><span class="hotspot-label">Dubai</span></div>
                <div class="map-hotspot spot-4" title="San Francisco, USA"><span class="hotspot-label">San Francisco</span></div>
                <div class="map-hotspot spot-5" title="London, UK"><span class="hotspot-label">London</span></div>
                <div class="map-hotspot spot-6" title="Sydney, Australia"><span class="hotspot-label">Sydney</span></div>
                <div class="map-hotspot spot-7" title="Tokyo, Japan"><span class="hotspot-label">Tokyo</span></div>
                <div class="map-hotspot spot-8" title="Toronto, Canada"><span class="hotspot-label">Toronto</span></div>
                <div class="map-hotspot spot-9" title="Berlin, Germany"><span class="hotspot-label">Berlin</span></div>
                <div class="map-hotspot spot-10" title="Paris, France"><span class="hotspot-label">Paris</span></div>
                <div class="map-hotspot spot-11" title="Cape Town, South Africa"><span class="hotspot-label">Cape Town</span></div>
                <div class="map-hotspot spot-12" title="Sao Paulo, Brazil"><span class="hotspot-label">Sao Paulo</span></div>
                <div class="map-hotspot spot-13" title="Auckland, New Zealand"><span class="hotspot-label">Auckland</span></div>
                <div class="map-hotspot spot-14" title="Nairobi, Kenya"><span class="hotspot-label">Nairobi</span></div>
                <div class="map-hotspot spot-15" title="Mumbai, India"><span class="hotspot-label">Mumbai</span></div>
            </div>
        </div>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Animation IntersectionObserver
        const fadeElements = document.querySelectorAll('.fade-up-element');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                }
            });
        }, { threshold: 0.1 });
        fadeElements.forEach(el => observer.observe(el));

        // Right Visual Cards Hover/Focus cycle
        const visualCards = document.querySelectorAll('.culture-visual-card');
        const featureItems = document.querySelectorAll('.culture-feature-item');
        const fillBar = document.querySelector('.features-progress-fill');

        featureItems.forEach((item, index) => {
            item.addEventListener('mouseenter', () => {
                featureItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                
                visualCards.forEach(card => card.classList.remove('active'));
                if (visualCards[index]) {
                    visualCards[index].classList.add('active');
                }

                const percent = (index / featureItems.length) * 100;
                if (fillBar) fillBar.style.top = `${percent}%`;
            });
        });

        // -------------------------------------------------------------
        // ARC TIMELINE CONTROLLER (SECTION 2)
        // -------------------------------------------------------------
        const rawNodes = @json($nodes);
        const nodesData = {};
        
        rawNodes.forEach((node, idx) => {
            let svgString = '';
            if (node.icon === 'trending-up') svgString = `<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"></polyline></svg>`;
            else if (node.icon === 'users') svgString = `<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"></polyline></svg>`;
            else if (node.icon === 'zap') svgString = `<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>`;
            else if (node.icon === 'award') svgString = `<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>`;
            else if (node.icon === 'heart') svgString = `<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.5 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path></svg>`;
            else if (node.icon === 'book-open') svgString = `<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>`;
            else if (node.icon === 'lightbulb') svgString = `<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A5 5 0 0 0 8 8c0 1 .3 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"/><path d="M9 18h6"/><path d="M10 22h4"></path></svg>`;
            else svgString = `<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>`;
            
            nodesData[idx + 1] = {
                title: node.title,
                desc: node.description,
                btnText: "Explore Careers",
                btnUrl: "/#careers",
                icon: svgString
            };
        });

        const arcNodes = document.querySelectorAll('.arc-timeline-node');
        const mobileTabBtns = document.querySelectorAll('.arc-mobile-tab-btn');
        const centerTitle = document.getElementById('centerTitle');
        const centerDesc = document.getElementById('centerDesc');
        const centerIcon = document.getElementById('centerIcon');
        const centerCard = document.getElementById('arcCenterCard');

        function updateArcCenterContent(index) {
            if (!nodesData[index]) return;
            
            centerCard.style.animation = 'none';
            centerCard.offsetHeight; 
            centerCard.style.animation = 'textAppear-centered 0.45s cubic-bezier(0.16, 1, 0.3, 1)';

            centerTitle.textContent = nodesData[index].title;
            centerDesc.textContent = nodesData[index].desc;
            centerIcon.innerHTML = nodesData[index].icon;
            
            arcNodes.forEach(node => {
                const nodeIdx = node.getAttribute('data-node');
                if (nodeIdx === index) {
                    node.classList.add('active');
                } else {
                    node.classList.remove('active');
                }
            });
        }

        arcNodes.forEach(node => {
            node.addEventListener('click', function() {
                const nodeIndex = this.getAttribute('data-node');
                mobileTabBtns.forEach(b => {
                    if (b.getAttribute('data-mobile-index') === nodeIndex) {
                        b.classList.add('active');
                    } else {
                        b.classList.remove('active');
                    }
                });
                updateArcCenterContent(nodeIndex);
            });
        });

        mobileTabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const mobileIndex = this.getAttribute('data-mobile-index');
                mobileTabBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                updateArcCenterContent(mobileIndex);
            });
        });
        
        updateArcCenterContent('1');
    });
</script>

@endsection
