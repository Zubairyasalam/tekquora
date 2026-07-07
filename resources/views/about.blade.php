@extends('layouts.app')

@section('title', 'About Us - TekQuora')

@section('content')
<!-- About Hero Section -->
<section class="about-page-hero">
    <div class="about-hero-content">
        <h1 style="font-family: var(--font-heading); font-size: 3.5rem; font-weight: 800; letter-spacing: -0.025em; margin-bottom: 1.5rem;">About Us</h1>
        <p style="font-family: var(--font-body); font-size: 1.25rem; opacity: 0.9; max-width: 600px; margin: 0 auto;">Pioneering technology solutions and empowering digital growth since 2016.</p>
    </div>
</section>


<!-- About TekQuora Section -->
<section class="about-content-section" style="padding-bottom: 1rem;">
    <div class="about-two-col" style="display: block; max-width: 900px; margin: 0 auto;">
        <div class="about-text-content">
            <h2 class="services-title" style="font-size: 3.5rem !important; text-align: center; margin-bottom: 3rem;">About <span class="text-gradient">TekQuora</span></h2>
            
            <div style="background: #ffffff; padding: 4rem; border-radius: 24px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02); border: 1px solid rgba(226, 232, 240, 0.8); position: relative; overflow: hidden;">
                <!-- Decorative gradient line -->
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: var(--gradient);"></div>
                
                <p style="text-align: left; color: #0f172a; font-size: 1.3rem; line-height: 1.8; margin-bottom: 2rem; font-weight: 500; font-family: 'Outfit', sans-serif;">
                    TekQuora is a technology-driven company focused on building innovative digital solutions that help businesses grow, streamline operations, and stay ahead in a fast-changing digital world. We specialize in transforming ideas into practical, scalable, and user-friendly software products that solve real business challenges.
                </p>
                <div style="width: 60px; height: 3px; background-color: #e2e8f0; margin-bottom: 2rem;"></div>
                <p style="text-align: left; color: #64748b; font-size: 1.1rem; line-height: 1.8; margin-bottom: 1.5rem;">
                    Founded with a vision to combine technology, creativity, and business strategy, TekQuora works with startups, enterprises, and organizations to deliver high-quality web applications, mobile apps, business platforms, and custom digital solutions. Our team is passionate about creating products that are not only visually modern but also technically strong, reliable, and performance-focused.
                </p>
                <p style="text-align: left; color: #64748b; font-size: 1.1rem; line-height: 1.8; margin-bottom: 0;">
                    At TekQuora, we believe that technology should do more than just function — it should create value, improve efficiency, and deliver meaningful results. From concept to deployment, we focus on building solutions that are aligned with business goals and future-ready for growth.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Our Values Section -->
<section class="process-section" id="values">
    <div class="process-container">
        <div class="process-title-wrapper">
            <h2 class="services-title" style="font-size: 3.5rem !important;">Our <span class="text-gradient">Values</span></h2>
            <p class="services-subtitle" style="margin-top: 0.5rem; font-size: 1.15rem; color: #64748b; max-width: 600px; margin-left: auto; margin-right: auto;">The principles that guide everything we build and deliver.</p>
        </div>
        
        <div class="timeline-wrapper">
            <div class="timeline-line">
                <svg viewBox="0 0 1000 120" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="waveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#00c6ff" />
                            <stop offset="50%" stop-color="#4a55e8" />
                            <stop offset="100%" stop-color="#7f00ff" />
                        </linearGradient>
                    </defs>
                    <!-- Wave goes: Peak(0,0) -> Valley(125,120) -> Peak(375,0) -> Valley(625,120) -> Peak(875,0) -> Valley(1000,120) -->
                    <path d="M 0 0 C 62.5 0, 62.5 120, 125 120 C 250 120, 250 0, 375 0 C 500 0, 500 120, 625 120 C 750 120, 750 0, 875 0 C 937.5 0, 937.5 120, 1000 120" fill="none" stroke="url(#waveGradient)" stroke-width="3" />
                </svg>
            </div>

            <div class="timeline-nodes">
                <!-- Value 1 (Valley) -->
                <div class="timeline-step">
                    <div class="step-text-top">
                        <div class="step-bg-number">1</div>
                        <h3>Innovation</h3>
                        <p>We explore new ideas, tools, and technologies to create smart and future-ready digital solutions.</p>
                    </div>
                    <div class="step-icon-wrapper valley-icon">
                        <div class="service-icon-wrap" style="background: var(--gradient); box-shadow: 0 0 0 8px rgba(0, 198, 255, 0.15), 0 8px 20px rgba(0, 198, 255, 0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: white;"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        </div>
                    </div>
                </div>
                
                <!-- Value 2 (Peak) -->
                <div class="timeline-step">
                    <div class="step-icon-wrapper peak-icon">
                        <div class="service-icon-wrap" style="background: var(--gradient); box-shadow: 0 0 0 8px rgba(74, 85, 232, 0.15), 0 8px 20px rgba(74, 85, 232, 0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: white;"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </div>
                    </div>
                    <div class="step-text-bottom">
                        <div class="step-bg-number">2</div>
                        <h3>Excellence</h3>
                        <p>We aim to deliver high-quality work in every project, with attention to detail, performance, and user experience.</p>
                    </div>
                </div>

                <!-- Value 3 (Valley) -->
                <div class="timeline-step">
                    <div class="step-text-top">
                        <div class="step-bg-number">3</div>
                        <h3>Collaboration</h3>
                        <p>We work closely with clients and teams, believing that the best solutions come from strong communication and shared vision.</p>
                    </div>
                    <div class="step-icon-wrapper valley-icon">
                        <div class="service-icon-wrap" style="background: var(--gradient); box-shadow: 0 0 0 8px rgba(127, 0, 255, 0.15), 0 8px 20px rgba(127, 0, 255, 0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: white;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Value 4 (Peak) -->
                <div class="timeline-step">
                    <div class="step-icon-wrapper peak-icon">
                        <div class="service-icon-wrap" style="background: var(--gradient); box-shadow: 0 0 0 8px rgba(74, 85, 232, 0.15), 0 8px 20px rgba(74, 85, 232, 0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: white;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                    </div>
                    <div class="step-text-bottom">
                        <div class="step-bg-number">4</div>
                        <h3>Results</h3>
                        <p>We focus on building solutions that create measurable value, improve workflows, and support business growth.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .process-section {
            padding: 2rem 2rem 2rem 2rem;
            background-color: var(--bg-white, #ffffff);
            overflow: hidden;
        }
        .process-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .process-title-wrapper {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }
        
        .timeline-wrapper {
            position: relative;
            max-width: 1100px;
            margin: 0 auto;
            padding-top: 0;
            padding-bottom: 0;
            height: 370px;
        }
        
        /* Wave is centered at top: 160px with height: 120px */
        .timeline-line {
            position: absolute;
            top: 160px;
            left: 0;
            right: 0;
            z-index: 1;
        }
        .timeline-line svg {
            width: 100%;
            height: 120px;
            display: block;
            overflow: visible;
        }
        
        .timeline-nodes {
            display: flex;
            justify-content: space-around;
            position: relative;
            z-index: 2;
            height: 100%;
        }
        
        .timeline-step {
            width: 260px;
            position: relative;
        }
        
        .step-icon-wrapper {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
        }
        
        /* Valleys are at bottom of wave (160 + 120 = 280 center). Icon is ~60px, so top: 250px */
        .valley-icon {
            top: 250px;
        }
        
        /* Peaks are at top of wave (160 center). Icon top: 130px */
        .peak-icon {
            top: 130px;
        }
        
        .service-icon-wrap {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        
        .step-text-top, .step-text-bottom {
            position: absolute;
            left: 0;
            right: 0;
            text-align: center;
        }
        
        /* Text for valley icons sits above the wave (bottom: 260px) */
        .step-text-top {
            bottom: 250px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding-bottom: 20px;
        }
        
        /* Text for peak icons sits below the wave (top: 230px) */
        .step-text-bottom {
            top: 220px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding-top: 20px;
        }
        
        .step-bg-number {
            position: absolute;
            font-size: 10rem;
            font-weight: 800;
            color: rgba(0, 0, 0, 0.03);
            z-index: -1;
            line-height: 1;
            font-family: 'Outfit', sans-serif;
            pointer-events: none;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .step-text-top .step-bg-number {
            bottom: 0;
        }
        
        .step-text-bottom .step-bg-number {
            top: 0;
        }
        
        .timeline-step h3 {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: #0f172a;
            font-family: 'Outfit', sans-serif;
        }
        
        .timeline-step p {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }
        
        @media (max-width: 900px) {
            .timeline-line {
                display: none;
            }
            .timeline-wrapper {
                height: auto;
                padding-top: 0;
            }
            .timeline-nodes {
                flex-direction: column;
                height: auto;
                gap: 3rem;
                align-items: center;
            }
            .timeline-step {
                width: 100%;
                max-width: 450px;
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 2rem;
            }
            .step-icon-wrapper {
                position: relative !important;
                top: auto !important;
                left: auto !important;
                transform: none !important;
                flex-shrink: 0;
            }
            .step-text-top, .step-text-bottom {
                position: relative !important;
                top: auto !important;
                bottom: auto !important;
                width: 100% !important;
                text-align: left;
                padding: 0 !important;
                display: block;
            }
            .step-bg-number {
                left: auto !important;
                right: 10px !important;
                top: 50% !important;
                transform: translateY(-50%) !important;
                font-size: 6rem;
                bottom: auto !important;
            }
        }
    </style>
</section>

<!-- Our Approach & Why Choose Us -->
<section class="about-approach-section" style="padding: 2rem 2rem 2rem 2rem; background-color: var(--bg-white);">
    <div class="about-approach-grid">
        <div class="about-approach-content">
            <h2 class="services-title" style="font-size: 2.5rem !important; text-align: left;">Our <span class="text-gradient">Approach</span></h2>
            <p>At TekQuora, every project begins with understanding the client’s vision, goals, and challenges. We follow a practical and collaborative approach where planning, design, development, testing, and deployment are all handled with attention to quality and performance.</p>
            <p>We don’t just develop software — we build digital experiences that support long-term business success. Our team works closely with clients to ensure transparency, adaptability, and timely delivery throughout the project lifecycle.</p>
        </div>
        
        <div class="about-choose-content">
            <h2 class="services-title" style="font-size: 2.5rem !important; text-align: left;">Why Choose <span class="text-gradient">TekQuora</span></h2>
            <ul class="about-choose-list">
                <li class="about-choose-item">
                    <div class="about-choose-icon" style="background-color: rgba(74, 85, 232, 0.1); color: #4a55e8;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <span class="about-choose-text">Strong focus on quality, performance, and usability</span>
                </li>
                <li class="about-choose-item">
                    <div class="about-choose-icon" style="background-color: rgba(74, 85, 232, 0.1); color: #4a55e8;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <span class="about-choose-text">Expertise in modern web and software technologies</span>
                </li>
                <li class="about-choose-item">
                    <div class="about-choose-icon" style="background-color: rgba(74, 85, 232, 0.1); color: #4a55e8;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <span class="about-choose-text">Business-oriented solutions tailored to real-world needs</span>
                </li>
                <li class="about-choose-item">
                    <div class="about-choose-icon" style="background-color: rgba(74, 85, 232, 0.1); color: #4a55e8;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <span class="about-choose-text">Clean and responsive UI with scalable architecture</span>
                </li>
                <li class="about-choose-item">
                    <div class="about-choose-icon" style="background-color: rgba(74, 85, 232, 0.1); color: #4a55e8;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <span class="about-choose-text">Dedicated team support from idea to deployment</span>
                </li>
                <li class="about-choose-item">
                    <div class="about-choose-icon" style="background-color: rgba(74, 85, 232, 0.1); color: #4a55e8;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <span class="about-choose-text">Commitment to innovation, reliability, and client satisfaction</span>
                </li>
            </ul>
        </div>
    </div>
</section>




<!-- Grow Beyond Borders Section -->
<section class="global-card-section" style="padding: 6rem 2rem 6rem 2rem; background-color: var(--bg-white);">
    <div class="global-card-container">
        <!-- The Semicircular Notch Background -->
        <div class="global-card-notch"></div>
        
        <!-- The Earth Globe Image with Wrapper -->
        <div class="global-card-globe-wrapper">
            <img src="{{ asset('assets/globe.png') }}" alt="Global Earth Globe" class="global-card-globe">
        </div>
        
        <!-- The Dark Blue Card Content -->
        <div class="global-card">
            <h2 class="global-card-title">GROW BEYOND<br>BORDERS WITH <span class="text-gradient">TEKQUORA</span></h2>
            <p class="global-card-subtitle">Whether you're paying a freelancer or a full team overseas, <span class="text-gradient" style="font-weight: 700;">TekQuora</span> makes it simple, fast, secure, and with no sacrifice for every detail.</p>
            <a href="/contact" class="global-card-btn-yellow" style="text-decoration: none;">
                <span>Explore More</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
@endsection
