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
<section class="about-content-section" style="padding-top: 2%; padding-bottom: 1rem;">
    <div class="about-two-col" style="display: block; max-width: 900px; margin: 0 auto; padding-top: 0;">
        <div class="about-text-content">
            <h2 class="services-title" style="font-size: 3.5rem !important; text-align: center; margin-top: 0; margin-bottom: 3rem;">About <span class="text-gradient">TekQuora</span></h2>
            
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
            <h2 class="values-main-title">Our Values</h2>
            <p class="values-main-subtitle">The principles that guide everything we build and deliver.</p>
        </div>
        
        <div class="timeline-wrapper">
            <div class="timeline-line">
                <svg viewBox="0 0 1000 120" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="waveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#19A8FF" />
                            <stop offset="50%" stop-color="#4a55e8" />
                            <stop offset="100%" stop-color="#6C4DFF" />
                        </linearGradient>
                    </defs>
                    <path d="M 0 60 C 62.5 60, 62.5 120, 125 120 C 250 120, 250 0, 375 0 C 500 0, 500 120, 625 120 C 750 120, 750 0, 875 0 C 937.5 0, 937.5 60, 1000 60" fill="none" stroke="url(#waveGradient)" stroke-width="4.5" stroke-linecap="round" />
                </svg>
            </div>

            <div class="timeline-nodes">
                <!-- Value 1 (Valley - Innovation) -->
                <div class="timeline-step">
                    <div class="step-text-top">
                        <h3>Innovation</h3>
                        <p>We explore new ideas, tools, and technologies to create smart and future-ready digital solutions.</p>
                    </div>
                    <div class="step-icon-wrapper valley-icon">
                        <div class="service-icon-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A5 5 0 0 0 8 8c0 1 .3 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"/>
                                <path d="M9 18h6"/>
                                <path d="M10 22h4"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Value 2 (Peak - Excellence) -->
                <div class="timeline-step">
                    <div class="step-icon-wrapper peak-icon">
                        <div class="service-icon-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        </div>
                    </div>
                    <div class="step-text-bottom">
                        <h3>Excellence</h3>
                        <p>We aim to deliver high-quality work in every project, with attention to detail, performance, and user experience.</p>
                    </div>
                </div>

                <!-- Value 3 (Valley - Collaboration) -->
                <div class="timeline-step">
                    <div class="step-text-top">
                        <h3>Collaboration</h3>
                        <p>We work closely with clients and teams, believing that the best solutions come from strong communication and shared vision.</p>
                    </div>
                    <div class="step-icon-wrapper valley-icon">
                        <div class="service-icon-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Value 4 (Peak - Results) -->
                <div class="timeline-step">
                    <div class="step-icon-wrapper peak-icon">
                        <div class="service-icon-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <circle cx="12" cy="12" r="6"/>
                                <circle cx="12" cy="12" r="2"/>
                            </svg>
                        </div>
                    </div>
                    <div class="step-text-bottom">
                        <h3>Results</h3>
                        <p>We focus on building solutions that create measurable value, improve workflows, and support business growth.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        html {
            overflow-y: scroll !important;
        }
        .process-section {
            padding: 2rem 2rem 2rem 2rem;
            background-color: #ffffff;
            overflow: hidden;
            position: relative;
        }
        .process-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .process-title-wrapper {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .values-main-title {
            font-family: 'Outfit', sans-serif;
            font-size: 4.5rem; /* 72px */
            font-weight: 800;
            background: linear-gradient(to right, #19A8FF, #6C4DFF) !important;
            -webkit-background-clip: text !important;
            background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            color: transparent !important;
            margin-bottom: 1.5rem;
            letter-spacing: -0.025em;
            line-height: 1.1;
            display: inline-block;
        }
        .values-main-subtitle {
            font-family: 'Inter', sans-serif;
            font-size: 1.35rem; /* 21px */
            color: #64748B;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        .timeline-wrapper {
            position: relative;
            max-width: 1100px;
            margin: 0 auto;
            height: 460px;
        }
        
        /* Wave is centered at top: 150px with height: 120px */
        .timeline-line {
            position: absolute;
            top: 150px;
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
            position: relative;
            z-index: 2;
            height: 100%;
            width: 100%;
        }
        
        .timeline-step {
            position: absolute;
            width: 320px;
            height: 100%;
            transform: translateX(-50%);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        /* Distribute the 4 items horizontally at 12.5%, 37.5%, 62.5%, 87.5% */
        .timeline-step:nth-child(1) { left: 12.5%; }
        .timeline-step:nth-child(2) { left: 37.5%; }
        .timeline-step:nth-child(3) { left: 62.5%; }
        .timeline-step:nth-child(4) { left: 87.5%; }
        
        .step-icon-wrapper {
            position: absolute;
            left: 50%;
            width: 64px;
            height: 64px;
            transform: translate(-50%, -50%);
            z-index: 3;
        }
        
        /* Valley icon center is 270px */
        .valley-icon {
            top: 270px;
        }
        
        /* Peak icon center is 150px */
        .peak-icon {
            top: 150px;
        }
        
        .service-icon-wrap {
            position: absolute;
            top: 0;
            left: 0;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #19A8FF, #6C4DFF);
            border: 4px solid #ffffff;
            box-shadow: 0 8px 24px rgba(108, 77, 255, 0.25), 0 0 0 1px rgba(108, 77, 255, 0.05);
            cursor: pointer;
            opacity: 0;
            transform: scale(0.5);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        /* Hover scale and translation */
        .timeline-step:hover .service-icon-wrap {
            transform: translateY(-6px) scale(1.08);
            box-shadow: 0 16px 32px rgba(108, 77, 255, 0.45), 0 0 0 2px rgba(25, 168, 255, 0.3);
        }
        
        .step-text-top, .step-text-bottom {
            position: absolute;
            left: 0;
            right: 0;
            text-align: center;
            opacity: 0;
        }
        
        /* Text for valley icons sits above the wave */
        .step-text-top {
            bottom: 252px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 20px;
        }
        
        /* Text for peak icons sits below the wave */
        .step-text-bottom {
            top: 212px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
        }
        
        .timeline-step h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.25rem; /* 36px */
            font-weight: 800;
            margin-bottom: 0.75rem;
            color: #0F172A;
            letter-spacing: -0.02em;
        }
        
        .timeline-step p {
            font-family: 'Inter', sans-serif;
            font-size: 1.125rem; /* 18px */
            color: #64748B;
            line-height: 1.8;
            margin: 0;
            max-width: 320px;
            text-align: center;
        }

        /* SVG animation */
        .timeline-line path {
            stroke-dasharray: 1200;
            stroke-dashoffset: 1200;
            animation: drawPath 2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        /* Staggered entrance animations */
        @keyframes drawPath {
            to { stroke-dashoffset: 0; }
        }
        @keyframes scaleIn {
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes slideUp {
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideDown {
            to { opacity: 1; transform: translateY(0); }
        }

        .timeline-step:nth-child(1) .service-icon-wrap { animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s forwards; }
        .timeline-step:nth-child(2) .service-icon-wrap { animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.6s forwards; }
        .timeline-step:nth-child(3) .service-icon-wrap { animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 1.0s forwards; }
        .timeline-step:nth-child(4) .service-icon-wrap { animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 1.4s forwards; }

        .timeline-step:nth-child(1) .step-text-top { transform: translateY(20px); animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.4s forwards; }
        .timeline-step:nth-child(2) .step-text-bottom { transform: translateY(-20px); animation: slideDown 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.8s forwards; }
        .timeline-step:nth-child(3) .step-text-top { transform: translateY(20px); animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.2s forwards; }
        .timeline-step:nth-child(4) .step-text-bottom { transform: translateY(-20px); animation: slideDown 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.6s forwards; }
        
        @media (max-width: 900px) {
            .timeline-line {
                display: none;
            }
            .timeline-wrapper {
                height: auto;
            }
            .timeline-nodes {
                display: flex;
                flex-direction: column;
                height: auto;
                gap: 4rem;
                align-items: center;
            }
            .timeline-step {
                position: static !important;
                transform: none !important;
                width: 100% !important;
                max-width: 450px;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .step-icon-wrapper {
                position: static !important;
                transform: none !important;
                margin-bottom: 1.5rem;
            }
            .service-icon-wrap {
                opacity: 1 !important;
                transform: none !important;
                animation: none !important;
            }
            .step-text-top, .step-text-bottom {
                position: static !important;
                opacity: 1 !important;
                transform: none !important;
                animation: none !important;
                padding: 0 !important;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .timeline-step p {
                max-width: 100%;
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
