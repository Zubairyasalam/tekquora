@extends('layouts.admin')

@section('title', 'Manage Contact Us Page - Admin Dashboard')

@section('page_title', 'Contact Us Page Configuration')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 24px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" style="background-color: #fee2e2; color: #b91c1c; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; flex-direction: column; gap: 8px; box-shadow: 0 4px 15px rgba(185, 28, 28, 0.05);">
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                <span>Please fix the following errors:</span>
            </div>
            <ul style="margin: 0; padding-left: 24px; font-size: 13px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.contact-footer.save') }}" method="POST">
        @csrf

        <!-- 1. Section Heading Settings -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                Contact Us Page Hero Headings
            </h3>
            
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px;">
                <div>
                    <label for="contact_title" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Page Title</label>
                    <input type="text" name="contact_title" id="contact_title" value="{{ $contactTitle }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'" required>
                </div>
                <div>
                    <label for="contact_subtitle" style="display: block; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">Page Subtitle</label>
                    <input type="text" name="contact_subtitle" id="contact_subtitle" value="{{ $contactSubtitle }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e8ff; border-radius: 10px; font-size: 14px; color: #2b3674; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4318ff'" onblur="this.style.borderColor='#e0e8ff'" required>
                </div>
            </div>
        </div>

        <!-- 2. Contact Information Settings -->
        <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: #2b3674; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                Office Contact Information & Map
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <!-- Email -->
                <div style="background: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 18px;">
                    <label for="contact_email" style="display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        Office Email Address
                    </label>
                    <input type="email" name="contact_email" id="contact_email" value="{{ $contactEmail }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; background: white;" required>
                </div>

                <!-- Phone -->
                <div style="background: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 18px;">
                    <label for="contact_phone" style="display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Office Phone Number
                    </label>
                    <input type="text" name="contact_phone" id="contact_phone" value="{{ $contactPhone }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; background: white;" required>
                </div>

                <!-- Location -->
                <div style="background: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 18px;">
                    <label for="contact_location" style="display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        Office Location / Address
                    </label>
                    <input type="text" name="contact_location" id="contact_location" value="{{ $contactLocation }}" style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 14px; background: white;" required>
                </div>

            </div>

            <div style="background: #f8faff; border: 1px solid #e0e8ff; border-radius: 12px; padding: 18px;">
                <label for="contact_map_url" style="display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 600; color: #2b3674; margin-bottom: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4318ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                    Google Map Embed URL (iframe src)
                </label>
                <input type="text" name="contact_map_url" id="contact_map_url" value="{{ $contactMapUrl ?? '' }}" placeholder="https://www.google.com/maps/embed?..." style="width: 100%; padding: 10px 14px; border: 1px solid #e0e8ff; border-radius: 8px; font-size: 13px; background: white;">
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; margin-bottom: 40px;">
            <button type="submit" class="dash-btn-primary" style="padding: 14px 32px; font-size: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1-2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Save Get In Touch Settings
            </button>
        </div>
    </form>

</div>
@endsection
