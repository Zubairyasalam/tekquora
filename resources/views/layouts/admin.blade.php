<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - TekQuora')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}?v={{ time() }}">
</head>
<body class="admin-dashboard-body">

    <div class="admin-dashboard-wrapper">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                <a href="/admin" style="display: flex; align-items: center; text-decoration: none; padding-left: 4px;">
                    @if(isset($headerSettings['logo_path']) && $headerSettings['logo_path'])
                        <img src="{{ asset($headerSettings['logo_path']) }}" alt="TekQuora Logo" style="height: 64px; max-width: 210px; object-fit: contain; transform: scale(1.15); transform-origin: left center;">
                    @else
                        <img src="{{ asset('assets/admin-logo.png') }}" alt="TekQuora Logo" style="height: 64px; max-width: 210px; object-fit: contain; transform: scale(1.15); transform-origin: left center;" onerror="this.onerror=null; this.src='{{ asset('assets/logo.png') }}';">
                    @endif
                </a>
                <button class="sidebar-toggle-btn" style="color: #a3aed0;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
            </div>
            
            <nav class="admin-sidebar-nav">
                <div class="sidebar-category">ANALYTICS</div>
                <a href="/admin" class="admin-nav-link {{ Request::is('admin') && !Request::is('admin/*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="/admin/inquiries" class="admin-nav-link {{ Request::is('admin/inquiries*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <span>Inquiries Inbox</span>
                </a>

                <div class="sidebar-category">CONTENT</div>
                <a href="/admin/hero" class="admin-nav-link {{ Request::is('admin/hero*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    <span>Hero Section</span>
                </a>
                <a href="/admin/about" class="admin-nav-link {{ Request::is('admin/about*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <span>About Section</span>
                </a>
                <a href="/admin/services" class="admin-nav-link {{ Request::is('admin/services*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    <span>Our Services</span>
                </a>
                <a href="/admin/projects" class="admin-nav-link {{ Request::is('admin/projects*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                    <span>Projects</span>
                </a>
                <a href="/admin/culture" class="admin-nav-link {{ Request::is('admin/culture*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span>Work Culture</span>
                </a>
                <a href="/admin/join" class="admin-nav-link {{ Request::is('admin/join*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    <span>Why Join Us</span>
                </a>
                <a href="/admin/gallery" class="admin-nav-link {{ Request::is('admin/gallery*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    <span>Moments Gallery</span>
                </a>

                <div class="sidebar-category">CUSTOMIZATION</div>
                <a href="/admin/header" class="admin-nav-link {{ Request::is('admin/header*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    <span>Header Logo & Links</span>
                </a>
                <a href="/admin/team" class="admin-nav-link {{ Request::is('admin/team*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span>Meet Our Team</span>
                </a>
                <a href="/admin/contact-settings" class="admin-nav-link {{ Request::is('admin/contact-settings*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <span>Contact Us Page</span>
                </a>
                <a href="/admin/footer" class="admin-nav-link {{ Request::is('admin/footer*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="15" x2="21" y2="15"/></svg>
                    <span>Website Footer</span>
                </a>

                <div class="sidebar-category">SYSTEM</div>
                <a href="/admin/system-config" class="admin-nav-link {{ Request::is('admin/system-config*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    <span>System Configuration</span>
                </a>
            </nav>

            <div class="admin-sidebar-footer">
                <span>Copyright &copy; {{ date('Y') }}</span>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="admin-main-area">
            <!-- Top Header -->
            <header class="admin-top-header">
                <div class="admin-header-left" style="display: flex; flex-direction: column; gap: 8px;">
                    <!-- Breadcrumb Pill -->
                    <div style="display: inline-flex; align-items: center; gap: 8px; background: #ffffff; padding: 6px 14px; border-radius: 20px; border: 1px solid #e2e8f0; width: fit-content; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0061ff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        <span style="font-size: 12px; font-weight: 700; color: #64748b;">Admin Console</span>
                        <span style="color: #cbd5e1; font-size: 10px;">❯</span>
                        <span style="font-size: 12px; font-weight: 800; color: #0061ff;">{{ trim($__env->yieldContent('page_title')) ?: (trim($__env->yieldContent('header_title')) ?: 'Dashboard Overview') }}</span>
                    </div>

                    <!-- Title with glowing accent indicator -->
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 6px; height: 32px; background: linear-gradient(180deg, #0061ff 0%, #60efff 100%); border-radius: 4px; box-shadow: 0 4px 12px rgba(0, 97, 255, 0.3);"></div>
                        <h1 class="admin-page-title" style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 30px; font-weight: 800; color: #1b2559; margin: 0; letter-spacing: -0.5px;">{{ trim($__env->yieldContent('page_title')) ?: (trim($__env->yieldContent('header_title')) ?: 'Dashboard Overview') }}</h1>
                    </div>
                </div>
                <div class="admin-header-right">
                    <div class="admin-user-profile">
                        <img src="https://ui-avatars.com/api/?name=Admin+User&background=4318FF&color=fff&size=40" alt="Admin" class="admin-user-avatar">
                        <span class="admin-user-name">Admin User</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </div>
                    <a href="/admin/logout" class="admin-logout-btn" title="Logout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    </a>
                </div>
            </header>

            <!-- Main Scrollable Body -->
            <main class="admin-content-body">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="admin-dashboard-footer">
                <p>&copy; {{ date('Y') }} TekQuora Admin Console. Powered by TekQuora CRM.</p>
            </footer>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
