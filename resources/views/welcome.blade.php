@extends('layouts.app')

@section('title', 'TekQuora - Future-Ready Technology Solutions')

@section('content')
<section class="hero-full">
    <div class="hero-full-bg" style="background-image: url('{{ asset($heroSettings['image'] ?? 'assets/hero-bg-custom.png') }}');"></div>
    <div class="hero-overlay"></div>
    
    <div class="hero-full-content">
        <h1 class="hero-full-title">{!! str_replace('Technology', '<span class="hero-title-theme">Technology</span>', $heroSettings['title'] ?? 'Future-Ready<br>Technology Solutions') !!}</h1>
        @if(isset($heroSettings['subtitle']) && $heroSettings['subtitle'])
            <p class="hero-full-subtitle">
                {{ $heroSettings['subtitle'] }}
            </p>
        @endif

    </div>
</section>

<!-- About TekQuora Section (Premium Redesign) -->
<section class="about-section" id="about">
    <!-- Blurred Background Glow Circles for SaaS depth -->
    <div class="about-bg-glow-1"></div>
    <div class="about-bg-glow-2"></div>
    
    <div class="about-container">
        <div class="about-content new-about-layout">
            <!-- Left Column: Illustration Placeholder (new design to be added) -->
            <div class="about-image-column reveal-left">
                <div class="about-illustration-container">
                    <div class="about-gradient-ring"></div>
                    <div class="about-white-card">
                        <img src="{{ asset('assets/Tekquora_icon_with_bg_cropped.png') }}" alt="TekQuora Icon" class="about-center-logo">
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Content -->
            <div class="about-text-column reveal-right">
                <span class="about-eyebrow">{{ $aboutSettings['eyebrow'] ?? 'ABOUT TEKQUORA' }}</span>
                <div class="about-description">
                    @if(isset($aboutSettings['description_1']) && $aboutSettings['description_1'])
                        <p>{{ $aboutSettings['description_1'] }}</p>
                    @endif
                    @if(isset($aboutSettings['description_2']) && $aboutSettings['description_2'])
                        <p>{{ $aboutSettings['description_2'] }}</p>
                    @endif
                </div>
                
                <div class="about-features-stats">
                    <!-- Left: Checklist -->
                    <ul class="about-checklist">
                        @if(isset($aboutSettings['points']) && is_array($aboutSettings['points']) && count($aboutSettings['points']) > 0)
                            @foreach($aboutSettings['points'] as $point)
                                @php
                                    // Bold the numbers or key phrase in each point
                                    $pointHtml = preg_replace('/^(\d+\+?\s*[a-zA-Z]*\s*[a-zA-Z]*)/', '<strong>$1</strong>', $point);
                                    if (!preg_match('/^\d+/', $point)) {
                                        $pointHtml = preg_replace('/^(Global reach)/', '<strong>$1</strong>', $point);
                                    }
                                @endphp
                                <li>
                                    <span class="icon-wrapper">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>{!! $pointHtml !!}</span>
                                </li>
                            @endforeach
                        @else
                            <li>
                                <span class="icon-wrapper">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </span>
                                <span><strong>10+ years</strong> of industry expertise</span>
                            </li>
                            <li>
                                <span class="icon-wrapper">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </span>
                                <span><strong>500+</strong> successful project deliveries</span>
                            </li>
                            <li>
                                <span class="icon-wrapper">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </span>
                                <span><strong>Global reach</strong> across 30+ countries</span>
                            </li>
                        @endif
                    </ul>
                    
                    <!-- Right: Stat Box -->
                    @if((isset($aboutSettings['stat_value']) && $aboutSettings['stat_value']) || (isset($aboutSettings['stat_label']) && $aboutSettings['stat_label']))
                        <div class="about-stat-box">
                            <div class="stat-box-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                            <div class="stat-box-content">
                                <strong class="counter-up">{{ $aboutSettings['stat_value'] ?? '' }}</strong>
                                <span class="stat-label-text">{{ $aboutSettings['stat_label'] ?? '' }}</span>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Bottom: Actions -->
                @if(isset($aboutSettings['btn_text']) && $aboutSettings['btn_text'])
                    <div class="about-actions">
                        <a href="/about" class="btn-solid-primary about-explore-btn">{{ $aboutSettings['btn_text'] }} &rarr;</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Our Services Section -->
<section class="services-section animate-zoom-in" id="services">
    <div class="services-container">
        <div class="services-header">
            <h2 class="services-title">{{ $servicesSettings['title'] ?? 'Our Services' }}</h2>
            <p class="services-subtitle">{{ !empty($servicesSettings['subtitle']) ? $servicesSettings['subtitle'] : 'Comprehensive technology solutions designed to accelerate your business growth and drive digital innovation across all industries.' }}</p>
        </div>

        <div class="services-grid">
            @if(isset($servicesSettings['list']) && is_array($servicesSettings['list']) && count($servicesSettings['list']) > 0)
                @foreach($servicesSettings['list'] as $service)
                    <div class="service-card">
                        <div class="service-icon-outer">
                            <div class="service-icon-inner">
                                @switch($service['icon'] ?? 'code')
                                    @case('mobile')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                                        @break
                                    @case('ai')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="15" x2="23" y2="15"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="15" x2="4" y2="15"/></svg>
                                        @break
                                    @case('iot')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><circle cx="12" cy="20" r="1"/></svg>
                                        @break
                                    @case('cloud')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/></svg>
                                        @break
                                    @case('database')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/><path d="M3 12c0 1.66 4 3 9 3s9-1.34 9-3"/></svg>
                                        @break
                                    @default
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/><line x1="14" y1="22" x2="10" y2="2"/></svg>
                                @endswitch
                            </div>
                        </div>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['description'] }}</p>
                    </div>
                @endforeach
            @else
                <!-- Web Development -->
                <div class="service-card">
                    <div class="service-icon-outer">
                        <div class="service-icon-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/><line x1="14" y1="22" x2="10" y2="2"/></svg>
                        </div>
                    </div>
                    <h3>Web Development</h3>
                    <p>Cutting-edge web applications built with modern frameworks and optimized for performance.</p>
                </div>

                <!-- Mobile Solutions -->
                <div class="service-card">
                    <div class="service-icon-outer">
                        <div class="service-icon-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                        </div>
                    </div>
                    <h3>Mobile Solutions</h3>
                    <p>Native and cross-platform mobile apps that deliver exceptional user experiences.</p>
                </div>

                <!-- AI & Machine Learning -->
                <div class="service-card">
                    <div class="service-icon-outer">
                        <div class="service-icon-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="15" x2="23" y2="15"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="15" x2="4" y2="15"/></svg>
                        </div>
                    </div>
                    <h3>AI & Machine Learning</h3>
                    <p>Intelligent solutions powered by machine learning and artificial intelligence technologies.</p>
                </div>

                <!-- IoT Solutions -->
                <div class="service-card">
                    <div class="service-icon-outer">
                        <div class="service-icon-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><circle cx="12" cy="20" r="1"/></svg>
                        </div>
                    </div>
                    <h3>IoT Solutions</h3>
                    <p>Connected device ecosystems and IoT platforms for smart business automation.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Our Work Culture Section -->
<section class="culture-section animate-zoom-in" id="culture">
    <div class="culture-container">
        <div class="culture-header">
            <h2 class="culture-title">{{ $cultureSettings['title'] ?? 'Our Work Culture' }}</h2>
            <p class="culture-subtitle">{{ $cultureSettings['subtitle'] ?? '' }}</p>
        </div>
 
        <div class="culture-carousel">
            <button class="nav-btn prev-btn" id="culturePrev">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
             
            <div class="culture-cards" id="cultureCardsContainer">
                @if(isset($cultureSettings['list']) && is_array($cultureSettings['list']))
                    @foreach($cultureSettings['list'] as $item)
                        <div class="culture-card">
                            <div class="card-img-wrapper"><img src="{{ asset($item['image'] ?? 'assets/culture-global.png') }}" alt="{{ $item['title'] }}"></div>
                            <div class="card-content">
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
 
            <button class="nav-btn next-btn" id="cultureNext">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
            </button>
        </div>
    </div>
</section>

<!-- Our Portfolio Section -->
<section class="portfolio-section animate-zoom-in" id="projects">
    <div class="portfolio-container">
        <div class="portfolio-header">
            <h2 class="portfolio-title">{{ $projectsSettings['title'] ?? 'Our Projects' }}</h2>
            <p class="portfolio-subtitle">{{ $projectsSettings['subtitle'] ?? 'Explore our latest projects showcasing innovation, technical excellence, and transformative digital solutions across various industries.' }}</p>
        </div>

        <!-- Filter Tabs -->
        <div class="portfolio-filters">
            <button class="filter-btn active" data-filter="all" id="filter-all">All Projects</button>
            <button class="filter-btn" data-filter="web" id="filter-web">Web Apps</button>
            <button class="filter-btn" data-filter="mobile" id="filter-mobile">Mobile Apps</button>
            <button class="filter-btn" data-filter="ai" id="filter-ai">AI Solutions</button>
        </div>

        <!-- Project Cards Grid -->
        <div class="portfolio-grid" id="portfolioGrid">
            @if(isset($projects))
                @foreach($projects->take(6) as $project)
                    <div class="portfolio-card" data-category="{{ $project->category }}" data-images="{{ asset($project->image_1) }},{{ asset($project->image_2) }}">
                        <div class="portfolio-card-img">
                            @if($project->image_1)
                                <img src="{{ asset($project->image_1) }}" alt="{{ $project->title }}" class="portfolio-img">
                            @endif
                        </div>
                        <div class="portfolio-card-body">
                            <span class="portfolio-tag tag-{{ $project->category }}">
                                @if($project->category == 'ai')
                                    AI Solution
                                @elseif($project->category == 'web')
                                    Web App
                                @else
                                    Mobile App
                                @endif
                            </span>
                            <h3>{{ $project->title }}</h3>
                            <p>{{ $project->description }}</p>
                            <div class="portfolio-tech">
                                @if(is_array($project->tech_tags))
                                    @foreach($project->tech_tags as $tag)
                                        <span>{{ $tag }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- See All Button -->
        <div class="portfolio-see-all" style="text-align: center; margin-top: 2rem;">
            <a href="/portfolio" class="btn-solid-primary">See All Projects &rarr;</a>
        </div>
    </div>
</section>
<section class="join-section animate-zoom-in" id="careers">
    <div class="join-container">
        <div class="join-header">
            <h2 class="join-title">{{ $joinSettings['title'] ?? 'Why Join TekQuora?' }}</h2>
            <p class="join-subtitle">{{ $joinSettings['subtitle'] ?? '' }}</p>
        </div>
        
        <div class="join-grid">
            @if(isset($joinSettings['list']) && is_array($joinSettings['list']))
                @foreach($joinSettings['list'] as $item)
                    <div class="join-card">
                        <div class="join-icon">
                            @switch($item['icon'] ?? 'popper')
                                @case('popper')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/>
                                        <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/>
                                        <path d="M4 22h16"/>
                                        <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/>
                                        <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/>
                                        <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/>
                                    </svg>
                                    @break
                                @case('clock')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l3 3"/></svg>
                                    @break
                                @case('home')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M12 18c-2 0-4-1.5-4-3.5 0-1.5 1-2.5 4-5 3 2.5 4 3.5 4 5 0 2-2 3.5-4 3.5z"/></svg>
                                    @break
                                @case('monitor')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                                    @break
                                @case('coffee')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8h1a4 4 0 1 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4Z"/><line x1="6" y1="2" x2="6" y2="4"/><line x1="10" y1="2" x2="10" y2="4"/><line x1="14" y1="2" x2="14" y2="4"/></svg>
                                    @break
                                @case('heart')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                                    @break
                                @default
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v8M8 12h8"/></svg>
                            @endswitch
                        </div>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['description'] }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Glimpses of Moments Section -->
<section class="glimpses-section animate-zoom-in" id="gallery">
    <div class="glimpses-header">
        <h2 class="glimpses-title">{{ $gallerySettings['title'] ?? 'Glimpses of TekQuora Moments' }}</h2>
        <p class="glimpses-subtitle">{{ $gallerySettings['subtitle'] ?? '' }}</p>
    </div>
    
    <div class="glimpses-carousel-wrapper">
        <button class="nav-btn prev-btn" id="glimpsePrev">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        
        <div class="glimpses-slider">
            @if(isset($gallerySettings['images']) && is_array($gallerySettings['images']))
                @foreach($gallerySettings['images'] as $index => $img)
                    <div class="glimpse-slide"><img src="{{ asset($img) }}" alt="TekQuora Moment {{ $index + 1 }}"></div>
                @endforeach
            @endif
        </div>
        
        <button class="nav-btn next-btn" id="glimpseNext">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
        </button>
    </div>
</section>

<!-- Project Lightbox Modal -->
<div id="projectModal" class="project-modal">
    <div class="project-modal-backdrop"></div>
    <div class="project-modal-content">
        <button class="project-modal-close" id="modalClose">&times;</button>
        <div class="project-modal-body">
            <h2 id="modalTitle" class="modal-project-title">Project Title</h2>
            <p id="modalCategory" class="modal-project-category">Web App</p>
            
            <!-- Image Slider -->
            <div class="modal-slider">
                <button class="slider-btn prev" id="sliderPrev" aria-label="Previous image">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                </button>
                <div class="slider-track">
                    <img id="modalImg1" src="" alt="Screenshot 1" class="modal-slide-img active">
                    <img id="modalImg2" src="" alt="Screenshot 2" class="modal-slide-img">
                </div>
                <button class="slider-btn next" id="sliderNext" aria-label="Next image">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </button>
            </div>
            
            <p id="modalDesc" class="modal-project-desc">Project description...</p>
            <div id="modalTech" class="modal-project-tech">
                <!-- Tech tags will be inserted here dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Get In Touch / Contact Section -->
<section class="contact-section animate-zoom-in" id="contact">
    <div class="contact-container">
        <div class="contact-header">
            <h2 class="contact-title">{{ $contactSettings['title'] ?? 'Get In Touch' }}</h2>
            <p class="contact-subtitle">{{ $contactSettings['subtitle'] ?? '' }}</p>
        </div>

        <div class="contact-grid">
            <!-- Left Column: Form -->
            <div class="contact-form-wrapper">
                <h3>Send us a message</h3>
                @if(session('success'))
                    <div style="background-color: #dcfce7; color: #15803d; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-weight: 500;">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="contact-form" action="/contact" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" placeholder="Your name" value="{{ old('name') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" placeholder="name@company.com" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="company">Company Name</label>
                        <input type="text" id="company" name="company" placeholder="Your Company" value="{{ old('company') }}">
                    </div>

                    <div class="form-group">
                        <label for="service">Project Type *</label>
                        <div class="select-wrapper">
                            <select id="service" name="service" required>
                                <option value="" disabled {{ old('service') ? '' : 'selected' }}>Select a service</option>
                                <option value="web" {{ old('service') == 'web' ? 'selected' : '' }}>Web Development</option>
                                <option value="mobile" {{ old('service') == 'mobile' ? 'selected' : '' }}>Mobile App</option>
                                <option value="ai" {{ old('service') == 'ai' ? 'selected' : '' }}>AI Solution</option>
                                <option value="other" {{ old('service') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <svg class="select-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="details">Project Details *</label>
                        <textarea id="details" name="details" rows="4" placeholder="Tell us about your project requirements, timeline, and any specific needs..." required>{{ old('details') }}</textarea>
                    </div>

                    <button type="submit" class="btn-submit">Send Message</button>
                </form>
            </div>

            <!-- Right Column: Info & CTA -->
            <div class="contact-info-wrapper">
                <div class="info-card">
                    <h3>Contact Information</h3>
                    @if(isset($contactSettings['email']))
                        <div class="info-item">
                            <div class="info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            </div>
                            <div class="info-content">
                                <span>Email Us</span>
                                <a href="mailto:{{ $contactSettings['email'] }}">{{ $contactSettings['email'] }}</a>
                            </div>
                        </div>
                    @endif
                    
                    @if(isset($contactSettings['phone']))
                        <div class="info-item">
                            <div class="info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div class="info-content">
                                <span>Call Us</span>
                                <a href="tel:{{ $contactSettings['phone'] }}">{{ $contactSettings['phone'] }}</a>
                            </div>
                        </div>
                    @endif
                    
                    @if(isset($contactSettings['location']))
                        <div class="info-item">
                            <div class="info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div class="info-content">
                                <span>Visit Us</span>
                                <p>{{ $contactSettings['location'] }}</p>
                            </div>
                        </div>
                    @endif

                    @if(isset($contactSettings['working_hours']))
                        <div class="info-item">
                            <div class="info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div class="info-content">
                                <span>Working Hours</span>
                                <p>{{ $contactSettings['working_hours'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                @if(isset($contactSettings['cta']) && is_array($contactSettings['cta']) && !empty($contactSettings['cta']['title']))
                    <div class="cta-card">
                        <h3>{{ $contactSettings['cta']['title'] }}</h3>
                        <p>{{ $contactSettings['cta']['description'] ?? '' }}</p>
                        <a href="{{ $contactSettings['cta']['btn_url'] ?? '#' }}" class="btn-cta">{{ $contactSettings['cta']['btn_text'] ?? 'Schedule Consultation' }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>




<script>
document.addEventListener('DOMContentLoaded', function() {
    // Culture Carousel (Infinite Loop)
    const container = document.getElementById('cultureCardsContainer');
    const prevBtn = document.getElementById('culturePrev');
    const nextBtn = document.getElementById('cultureNext');
    if(container && prevBtn && nextBtn) {
        const originalCards = Array.from(container.children);
        const originalCount = originalCards.length;
        
        // Clone 3 cards to the end for layout padding
        for (let i = 0; i < 3; i++) {
            const clone = originalCards[i].cloneNode(true);
            clone.classList.add('is-clone');
            container.appendChild(clone);
        }
        
        // Clone last 3 cards to the start for layout padding
        for (let i = originalCount - 3; i < originalCount; i++) {
            const clone = originalCards[i].cloneNode(true);
            clone.classList.add('is-clone');
            container.insertBefore(clone, container.firstChild);
        }

        // Helper to get card step width + gap dynamically
        function getCardStep() {
            const cards = container.querySelectorAll('.culture-card');
            if (cards.length === 0) return 0;
            const style = window.getComputedStyle(container);
            const gap = parseFloat(style.columnGap || style.gap || 0) || 32;
            return cards[0].offsetWidth + gap;
        }

        // Initialize scroll position to point to first original card
        let cardStep = getCardStep();
        container.style.scrollBehavior = 'auto';
        container.scrollLeft = 3 * cardStep;
        
        // Restore smooth behavior after layout adjustment
        setTimeout(() => {
            container.style.scrollBehavior = 'smooth';
        }, 50);

        // Click handlers
        prevBtn.addEventListener('click', () => {
            cardStep = getCardStep();
            container.scrollBy({ left: -cardStep, behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', () => {
            cardStep = getCardStep();
            container.scrollBy({ left: cardStep, behavior: 'smooth' });
        });

        // Loop check and active class updates
        let isJumping = false;
        container.addEventListener('scroll', () => {
            if (isJumping) return;
            cardStep = getCardStep();
            const scrollLeft = container.scrollLeft;
            
            // Loop from start clones to end originals
            if (scrollLeft <= 0.5 * cardStep) {
                isJumping = true;
                container.style.scrollBehavior = 'auto';
                container.scrollLeft = scrollLeft + originalCount * cardStep;
                container.offsetHeight; // trigger reflow
                container.style.scrollBehavior = 'smooth';
                isJumping = false;
            }
            // Loop from end clones to start originals
            else if (scrollLeft >= (originalCount + 2.5) * cardStep) {
                isJumping = true;
                container.style.scrollBehavior = 'auto';
                container.scrollLeft = scrollLeft - originalCount * cardStep;
                container.offsetHeight; // trigger reflow
                container.style.scrollBehavior = 'smooth';
                isJumping = false;
            }
            
            updateActiveCenterCard();
        });

        function updateActiveCenterCard() {
            const cards = container.querySelectorAll('.culture-card');
            if (cards.length === 0) return;

            const containerCenter = container.scrollLeft + container.offsetWidth / 2;
            let closestCard = null;
            let minDistance = Infinity;

            cards.forEach(card => {
                const cardCenter = card.offsetLeft + card.offsetWidth / 2;
                const distance = Math.abs(containerCenter - cardCenter);
                if (distance < minDistance) {
                    minDistance = distance;
                    closestCard = card;
                }
            });

            cards.forEach(card => {
                if (card === closestCard) {
                    card.classList.add('active-center');
                } else {
                    card.classList.remove('active-center');
                }
            });
        }

        // Run initially and set on resize
        setTimeout(updateActiveCenterCard, 100);
        window.addEventListener('resize', () => {
            cardStep = getCardStep();
            updateActiveCenterCard();
        });
    }

    // Glimpses Carousel
    const glimpseSlides = document.querySelectorAll('.glimpse-slide');
    const glimpsePrev = document.getElementById('glimpsePrev');
    const glimpseNext = document.getElementById('glimpseNext');
    if(glimpseSlides.length > 0) {
        let currentGlimpse = 0;
        const totalGlimpses = glimpseSlides.length;
        function updateGlimpses() {
            glimpseSlides.forEach((slide, index) => {
                slide.className = 'glimpse-slide';
                if (index === currentGlimpse) slide.classList.add('active');
                else if (index === (currentGlimpse - 1 + totalGlimpses) % totalGlimpses) slide.classList.add('prev');
                else if (index === (currentGlimpse + 1) % totalGlimpses) slide.classList.add('next');
                else if (index === (currentGlimpse - 2 + totalGlimpses) % totalGlimpses) slide.classList.add('prev-hidden');
                else if (index === (currentGlimpse + 2) % totalGlimpses) slide.classList.add('next-hidden');
            });
        }
        glimpseNext.addEventListener('click', () => { currentGlimpse = (currentGlimpse + 1) % totalGlimpses; updateGlimpses(); });
        glimpsePrev.addEventListener('click', () => { currentGlimpse = (currentGlimpse - 1 + totalGlimpses) % totalGlimpses; updateGlimpses(); });
        glimpseSlides.forEach((slide, index) => slide.addEventListener('click', () => { currentGlimpse = index; updateGlimpses(); }));
        updateGlimpses();
    }

    // Testimonials Carousel
    const testiCards = document.querySelectorAll('.testimonial-card');
    const testiDots = document.querySelectorAll('.testi-dot');
    const tPrev = document.getElementById('testiPrev');
    const tNext = document.getElementById('testiNext');
    if(testiCards.length > 0) {
        let tIndex = 0;
        const tTotal = testiCards.length;
        function updateTestimonials() {
            testiCards.forEach((card, idx) => { card.classList.remove('active-slide'); if(idx === tIndex) card.classList.add('active-slide'); });
            testiDots.forEach((dot, idx) => { dot.classList.remove('active'); if(idx === tIndex) dot.classList.add('active'); });
        }
        tNext.addEventListener('click', () => { tIndex = (tIndex + 1) % tTotal; updateTestimonials(); });
        tPrev.addEventListener('click', () => { tIndex = (tIndex - 1 + tTotal) % tTotal; updateTestimonials(); });
        testiDots.forEach((dot, idx) => dot.addEventListener('click', () => { tIndex = idx; updateTestimonials(); }));
    }

    // Scroll Animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('is-visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.animate-zoom-in').forEach(el => observer.observe(el));

    // Portfolio Filter
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioCards = document.querySelectorAll('.portfolio-card');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const filter = btn.dataset.filter;
            portfolioCards.forEach(card => {
                const match = filter === 'all' || card.dataset.category === filter;
                if (match) {
                    card.classList.remove('hidden');
                    card.classList.remove('fade-in');
                    void card.offsetWidth; // reflow to restart animation
                    card.classList.add('fade-in');
                } else {
                    card.classList.add('hidden');
                    card.classList.remove('fade-in');
                }
            });
        });
    });

    // Project Lightbox Modal logic
    const modal = document.getElementById('projectModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalCategory = document.getElementById('modalCategory');
    const modalImg1 = document.getElementById('modalImg1');
    const modalImg2 = document.getElementById('modalImg2');
    const modalDesc = document.getElementById('modalDesc');
    const modalTech = document.getElementById('modalTech');
    const modalClose = document.getElementById('modalClose');
    const backdrop = document.querySelector('.project-modal-backdrop');

    const sliderPrev = document.getElementById('sliderPrev');
    const sliderNext = document.getElementById('sliderNext');

    let currentSlideIndex = 0;
    const slides = [modalImg1, modalImg2];

    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.add('active');
            } else {
                slide.classList.remove('active');
            }
        });
        currentSlideIndex = index;
    }

    sliderPrev.addEventListener('click', (e) => {
        e.stopPropagation();
        let prevIndex = currentSlideIndex - 1;
        if (prevIndex < 0) prevIndex = slides.length - 1;
        showSlide(prevIndex);
    });

    sliderNext.addEventListener('click', (e) => {
        e.stopPropagation();
        let nextIndex = currentSlideIndex + 1;
        if (nextIndex >= slides.length) nextIndex = 0;
        showSlide(nextIndex);
    });

    portfolioCards.forEach(card => {
        card.addEventListener('click', () => {
            const title = card.querySelector('h3').textContent;
            const category = card.querySelector('.portfolio-tag').textContent;
            const desc = card.querySelector('p').textContent;
            
            // Get images from data-images attribute
            const imagesStr = card.getAttribute('data-images') || '';
            const images = imagesStr.split(',');
            
            modalTitle.textContent = title;
            modalCategory.textContent = category;
            modalDesc.textContent = desc;
            
            // Load images
            if (images[0]) {
                modalImg1.src = images[0];
                modalImg1.style.display = 'block';
            } else {
                modalImg1.style.display = 'none';
            }
            
            if (images[1]) {
                modalImg2.src = images[1];
                modalImg2.style.display = 'block';
                sliderPrev.style.display = 'flex';
                sliderNext.style.display = 'flex';
            } else {
                modalImg2.style.display = 'none';
                sliderPrev.style.display = 'none';
                sliderNext.style.display = 'none';
            }
            
            showSlide(0);
            
            // Tech tags
            modalTech.innerHTML = '';
            const techSpans = card.querySelectorAll('.portfolio-tech span');
            techSpans.forEach(span => {
                const tag = document.createElement('span');
                tag.textContent = span.textContent;
                modalTech.appendChild(tag);
            });
            
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    modalClose.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);

    // Counter animation for Satisfied Clients and stats
    const counters = document.querySelectorAll('.counter-up');
    if (counters.length > 0) {
        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const originalText = el.textContent.trim();
                    const numericValue = parseInt(originalText.replace(/[^0-9]/g, ''), 10);
                    const suffix = originalText.replace(/[0-9,]/g, ''); // get non-numeric suffix like +
                    
                    if (isNaN(numericValue)) return;
                    
                    const duration = 1800; // 1.8 seconds duration
                    const startTime = performance.now();
                    
                    function updateCounter(currentTime) {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        
                        // Ease out quad formula
                        const easeProgress = progress * (2 - progress);
                        const currentVal = Math.floor(easeProgress * numericValue);
                        
                        // Format with commas
                        el.textContent = currentVal.toLocaleString('en-US') + suffix;
                        
                        if (progress < 1) {
                            requestAnimationFrame(updateCounter);
                        } else {
                            el.textContent = originalText; // guarantee exact original text
                        }
                    }
                    
                    requestAnimationFrame(updateCounter);
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.1 });

        counters.forEach(counter => counterObserver.observe(counter));
    }
});
</script>
@endsection
