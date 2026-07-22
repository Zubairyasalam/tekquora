@extends('layouts.app')

@section('title', 'Contact Us - TekQuora')

@section('content')
<!-- Contact Hero Section -->
<section class="contact-hero">
    <div class="contact-hero-content">
        <span class="contact-eyebrow-pill">Contact Us</span>
        <h1 class="contact-hero-title">{{ $contactSettings['title'] ?? "Let's Connect" }}</h1>
        <p class="contact-hero-subtitle">{{ $contactSettings['subtitle'] ?? "Have questions? Want to join our team? We'd love to hear from you." }}</p>
    </div>
</section>

<!-- Contact Form & Info Section -->
<section class="contact-page-section">
    <div class="contact-page-container">
        
        <!-- Top: Form Column (Long / Full-Width Card) -->
        <div class="contact-form-card">
            <h2 style="font-family: var(--font-heading); font-size: 2.4rem; font-weight: 800; background: linear-gradient(135deg, #00c6ff 0%, #0072ff 45%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 2rem; display: inline-block;">Send Us a Message</h2>
            
            @if(session('success'))
                <div style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; margin-bottom: 24px; display: flex; align-items: center; gap: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <form action="/contact" method="POST">
                @csrf
                <div class="contact-form-grid">
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Your Full Name" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="yourname@domain.com" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="company">Company Name</label>
                        <input type="text" id="company" name="company" class="form-control" placeholder="Your Company Name" value="{{ old('company') }}">
                    </div>

                    <div class="form-group">
                        <label for="service">Project Type / Service *</label>
                        <select id="service" name="service" class="form-control service-select-dropdown" style="appearance: auto; background-color: white; color: #0f172a;" required>
                            <option value="" disabled {{ old('service') ? '' : 'selected' }}>Select a service</option>
                            <option value="web" {{ old('service') == 'web' ? 'selected' : '' }}>Web Development</option>
                            <option value="mobile" {{ old('service') == 'mobile' ? 'selected' : '' }}>Mobile App</option>
                            <option value="ai" {{ old('service') == 'ai' ? 'selected' : '' }}>AI Solution</option>
                            <option value="other" {{ old('service') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="form-group other-service-input-group" style="display: {{ old('service') == 'other' ? 'block' : 'none' }}; grid-column: span 2;">
                        <label for="other_service">Specify Service / Requirement *</label>
                        <input type="text" id="other_service" name="other_service" class="form-control" placeholder="e.g. Cybersecurity, Cloud Migration, etc." value="{{ old('other_service') }}" {{ old('service') == 'other' ? 'required' : '' }}>
                    </div>
                </div>

                <div class="form-group">
                    <label for="details">Project Details / Message *</label>
                    <textarea id="details" name="details" rows="5" class="form-control" placeholder="Tell us what you'd like to discuss..." style="resize: none;" required>{{ old('details') }}</textarea>
                </div>

                <!-- Footer row: Captcha left, Send button right -->
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem; margin-top: 2rem;">
                    <!-- Mock Google reCAPTCHA -->
                    <div class="recaptcha-box" style="display: flex; align-items: center; justify-content: space-between; border: 1px solid #d3d3d3; padding: 0.75rem 1rem; border-radius: 4px; background: #f9f9f9; width: 100%; max-width: 305px; box-sizing: border-box;">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <input type="checkbox" id="captcha-checkbox" required style="width: 22px; height: 22px; cursor: pointer;">
                            <label for="captcha-checkbox" style="font-size: 0.9rem; color: #000; font-family: Roboto, sans-serif; cursor: pointer; font-weight: normal; margin-bottom: 0; user-select: none;">I'm not a robot</label>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 2px;">
                            <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" alt="reCAPTCHA" style="width: 32px; height: auto;">
                            <span style="font-size: 0.65rem; color: #555; font-family: Roboto, sans-serif; font-weight: 500;">reCAPTCHA</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-contact-submit" style="width: auto; min-width: 220px; margin-bottom: 0;">Send Message</button>
                </div>
            </form>
        </div>

        <!-- Bottom: Map & Details Column (Down keep as map) -->
        <div class="contact-location-horizontal">
            <!-- Details Panel -->
            <div class="contact-details-panel">
                <h3 style="font-family: var(--font-heading); font-size: 1.6rem; font-weight: 700; color: #0f172a; margin-top: 0; margin-bottom: 1.5rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 22px; height: 22px; stroke: var(--primary);"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Head Office
                </h3>
                
                @if(isset($contactSettings['location']))
                    <div class="contact-info-item">
                        <div class="contact-info-icon-wrapper">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div class="contact-info-text">
                            {{ $contactSettings['location'] }}
                        </div>
                    </div>
                @endif

                @if(isset($contactSettings['phone']))
                    <div class="contact-info-item">
                        <div class="contact-info-icon-wrapper">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div class="contact-info-text">
                            <a href="tel:{{ $contactSettings['phone'] }}">{{ $contactSettings['phone'] }}</a>
                        </div>
                    </div>
                @endif

                @if(isset($contactSettings['email']))
                    <div class="contact-info-item">
                        <div class="contact-info-icon-wrapper">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2z"></path></svg>
                        </div>
                        <div class="contact-info-text">
                            <a href="mailto:{{ $contactSettings['email'] }}">{{ $contactSettings['email'] }}</a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Map Panel -->
            <div class="contact-map-panel">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.003584852924!2d80.2422709!3d12.965429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a525d61081515ef%3A0xc346617fcbd8ad94!2sKandancavadi%2520Perungudi!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

    </div>
</section>
@endsection










