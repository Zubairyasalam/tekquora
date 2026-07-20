@extends('layouts.app')

@section('title', 'Work Culture - TekQuora')

@section('content')
@php
    $step = request()->query('step', 1);
@endphp

<!-- Hero Section -->
<section class="team-hero">
    <div class="team-hero-content" style="max-width: 800px; margin: 0 auto;">
        <h1 class="team-hero-title">Work Culture</h1>
        <p class="team-hero-subtitle">Explore our workspace, team values, and collaborative environment.</p>
    </div>
</section>

<!-- Step Wizard Content -->
<section style="padding: 6rem 1.5rem; background: #f8fafc; min-height: 45vh; display: flex; align-items: center; justify-content: center;">
    <div style="max-width: 550px; width: 100%; text-align: center; background: #ffffff; padding: 3.5rem 2.5rem; border-radius: 1.5rem; box-shadow: 0 10px 40px rgba(15, 23, 42, 0.05); border: 1px solid #e2e8f0; animation: fadeInUp 0.4s ease-out;">
        
        @if($step == 1)
            <!-- Step 1 -->
            <div style="background: rgba(79, 70, 229, 0.08); color: var(--primary); font-size: 0.85rem; font-weight: 700; padding: 0.5rem 1.25rem; border-radius: 2rem; display: inline-block; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 0.05em;">Step 1</div>
            <h2 style="font-family: var(--font-heading); font-size: 2.2rem; font-weight: 800; color: #0f172a; margin-bottom: 1rem; letter-spacing: -0.01em;">Welcome to TekQuora</h2>
            <p style="color: #64748b; font-size: 1.05rem; line-height: 1.7; margin-bottom: 2.5rem; font-weight: 400;">Our workspace is built on collaboration, continuous learning, and absolute transparency. Get ready to experience a state-of-the-art work environment.</p>
            
            <a href="/work-culture?step=2" class="btn-primary" style="display: inline-flex; align-items: center; justify-content: center; background: var(--gradient); color: #ffffff; padding: 0.9rem 2.25rem; border-radius: 2rem; font-size: 1rem; font-weight: 700; text-decoration: none; box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3); transition: all 0.3s ease;">
                Next
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 8px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        @elseif($step == 2)
            <!-- Step 2 -->
            <div style="background: rgba(79, 70, 229, 0.08); color: var(--primary); font-size: 0.85rem; font-weight: 700; padding: 0.5rem 1.25rem; border-radius: 2rem; display: inline-block; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 0.05em;">Step 2</div>
            <h2 style="font-family: var(--font-heading); font-size: 2.2rem; font-weight: 800; color: #0f172a; margin-bottom: 1rem; letter-spacing: -0.01em;">Innovation First</h2>
            <p style="color: #64748b; font-size: 1.05rem; line-height: 1.7; margin-bottom: 2.5rem; font-weight: 400;">We encourage experimentation, calculated risks, and challenging the status quo. We believe failure is just another step towards creating breakthrough technology.</p>
            
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <a href="/work-culture?step=1" style="display: inline-flex; align-items: center; justify-content: center; background: #f1f5f9; color: #475569; padding: 0.9rem 1.75rem; border-radius: 2rem; font-size: 1rem; font-weight: 600; text-decoration: none; transition: all 0.3s ease;">
                    Back
                </a>
                <a href="/work-culture?step=3" class="btn-primary" style="display: inline-flex; align-items: center; justify-content: center; background: var(--gradient); color: #ffffff; padding: 0.9rem 2.25rem; border-radius: 2rem; font-size: 1rem; font-weight: 700; text-decoration: none; box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3); transition: all 0.3s ease;">
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 8px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        @elseif($step == 3)
            <!-- Step 3 -->
            <div style="background: rgba(79, 70, 229, 0.08); color: var(--primary); font-size: 0.85rem; font-weight: 700; padding: 0.5rem 1.25rem; border-radius: 2rem; display: inline-block; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 0.05em;">Step 3</div>
            <h2 style="font-family: var(--font-heading); font-size: 2.2rem; font-weight: 800; color: #0f172a; margin-bottom: 1rem; letter-spacing: -0.01em;">Join Our Journey</h2>
            <p style="color: #64748b; font-size: 1.05rem; line-height: 1.7; margin-bottom: 2.5rem; font-weight: 400;">Ready to make an impact and work with the best minds in the industry? Explore our open roles or contact us directly to start your TekQuora journey today.</p>
            
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <a href="/work-culture?step=2" style="display: inline-flex; align-items: center; justify-content: center; background: #f1f5f9; color: #475569; padding: 0.9rem 1.75rem; border-radius: 2rem; font-size: 1rem; font-weight: 600; text-decoration: none; transition: all 0.3s ease;">
                    Back
                </a>
                <a href="/contact" class="btn-primary" style="display: inline-flex; align-items: center; justify-content: center; background: var(--gradient); color: #ffffff; padding: 0.9rem 2.25rem; border-radius: 2rem; font-size: 1rem; font-weight: 700; text-decoration: none; box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3); transition: all 0.3s ease;">
                    Get in Touch
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 8px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        @endif
        
    </div>
</section>

<style>
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
@endsection
