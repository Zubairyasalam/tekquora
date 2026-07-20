<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TekQuora')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <style>
        html, body {
            max-width: 100%;
            overflow-x: hidden !important;
        }
    </style>
    @if(isset($systemConfig))
    <style>
        :root {
            --primary: {{ $systemConfig['primary_color'] ?? '#0061ff' }};
            --primary-dark: {{ $systemConfig['primary_color'] ?? '#0061ff' }};
            @if(isset($systemConfig['enable_secondary_theme']) && $systemConfig['enable_secondary_theme'] == '1')
            --gradient: linear-gradient(135deg, {{ $systemConfig['primary_color'] ?? '#0061ff' }}, {{ $systemConfig['secondary_color'] ?? '#7c3aed' }});
            @endif
        }
        @if(isset($systemConfig['enable_secondary_theme']) && $systemConfig['enable_secondary_theme'] == '1')
        .navbar, .footer {
            border-bottom: 3px solid {{ $systemConfig['secondary_color'] ?? '#7c3aed' }} !important;
        }
        @endif
    </style>
    @endif
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <a href="/" class="navbar-brand" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
            @if(isset($headerSettings['logo_path']) && $headerSettings['logo_path'])
                <img src="{{ asset($headerSettings['logo_path']) }}" alt="{{ $headerSettings['logo_text'] ?? 'TekQuora' }} Logo" style="height: 32px; width: auto; object-fit: contain;">
            @else
                <span class="navbar-logo-text" style="font-family: 'Outfit', sans-serif; font-size: 24px; font-weight: 700; color: #1f2937;">{{ $headerSettings['logo_text'] ?? 'TekQuora' }}</span>
            @endif
        </a>
        
        <ul class="nav-links">
            <li><a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="/about" class="{{ Request::is('about*') ? 'active' : '' }}">About</a></li>
            <li><a href="/team" class="{{ Request::is('team*') ? 'active' : '' }}">Our Team</a></li>
            <li><a href="/work-culture" class="{{ Request::is('work-culture*') ? 'active' : '' }}">Work Culture</a></li>
            <li><a href="/#careers">Careers</a></li>
            <li><a href="/portfolio" class="{{ Request::is('portfolio*') ? 'active' : '' }}">Projects</a></li>
            <li><a href="/contact" class="btn-nav-contact {{ Request::is('contact*') ? 'active' : '' }}">Contact</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @if(!Request::is('team'))
    <footer class="footer">
        <div class="footer-container">
            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="/" class="footer-logo-link">
                    <img src="{{ asset('assets/footer-icon.png') }}" alt="TekQuora Icon" class="footer-logo-icon">
                    <span class="footer-logo-text">TekQuora</span>
                </a>
                <p>{{ $footerSettings['description'] ?? 'Pioneering the future of technology with innovative solutions that transform businesses and empower digital growth across industries worldwide.' }}</p>
                
                <div class="footer-contact-info">
                    @if(isset($contactSettings['email']))
                        <a href="mailto:{{ $contactSettings['email'] }}" class="footer-contact-item">
                            <div class="footer-contact-icon-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                            <span>{{ $contactSettings['email'] }}</span>
                        </a>
                    @endif
                    @if(isset($contactSettings['phone']))
                        <a href="tel:{{ $contactSettings['phone'] }}" class="footer-contact-item">
                            <div class="footer-contact-icon-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <span>{{ $contactSettings['phone'] }}</span>
                        </a>
                    @endif
                    @if(isset($contactSettings['location']))
                        <div class="footer-contact-item">
                            <div class="footer-contact-icon-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <span>{{ $contactSettings['location'] }}</span>
                        </div>
                    @endif
                </div>

                <div class="footer-social-icons">
                    <a href="{{ $footerSettings['socials']['facebook'] ?? '#' }}" class="footer-social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="{{ $footerSettings['socials']['twitter'] ?? '#' }}" class="footer-social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                    </a>
                    <a href="{{ $footerSettings['socials']['linkedin'] ?? '#' }}" class="footer-social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    <a href="{{ $footerSettings['socials']['instagram'] ?? '#' }}" class="footer-social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="{{ $footerSettings['socials']['github'] ?? '#' }}" class="footer-social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
                    </a>
                </div>
            </div>

            <!-- Column 1 -->
            <div class="footer-column">
                <h4>{{ $footerSettings['col1_title'] ?? 'Services' }}</h4>
                <ul>
                    @if(isset($footerSettings['col1_links']) && is_array($footerSettings['col1_links']))
                        @foreach($footerSettings['col1_links'] as $link)
                            <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <!-- Column 2 -->
            <div class="footer-column">
                <h4>{{ $footerSettings['col2_title'] ?? 'Company' }}</h4>
                <ul>
                    @if(isset($footerSettings['col2_links']) && is_array($footerSettings['col2_links']))
                        @foreach($footerSettings['col2_links'] as $link)
                            <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <!-- Column 3 -->
            <div class="footer-column">
                <h4>{{ $footerSettings['col3_title'] ?? 'Resources' }}</h4>
                <ul>
                    @if(isset($footerSettings['col3_links']) && is_array($footerSettings['col3_links']))
                        @foreach($footerSettings['col3_links'] as $link)
                            <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>{{ $footerSettings['copyright'] ?? '© ' . date('Y') . ' TekQuora. All rights reserved.' }}</p>
        </div>
    </footer>
    @endif

    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Floating Back to Top Button -->
    <button id="scrollToTopBtn" class="scroll-to-top-btn" aria-label="Scroll to top">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
    </button>
</body>
</html>
