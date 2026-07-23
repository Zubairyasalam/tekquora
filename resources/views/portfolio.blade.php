@extends('layouts.app')

@section('title', 'Our Projects - TekQuora')

@section('content')
<!-- Portfolio Hero Section -->
<section class="team-hero" style="background-image: linear-gradient(135deg, #0f172a, #1e293b);">
    <div class="team-hero-content">
        <h1 class="team-hero-title">{{ $projectsSettings['title'] ?? 'Our Projects' }}</h1>
        <p class="team-hero-subtitle">{{ $projectsSettings['subtitle'] ?? 'Explore our latest projects showcasing innovation, technical excellence, and transformative digital solutions.' }}</p>
    </div>
</section>

<!-- Our Portfolio Section -->
<section class="portfolio-section">
    <div class="portfolio-container">
        
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
                @foreach($projects as $project)
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

<script>
document.addEventListener('DOMContentLoaded', function() {
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
});
</script>
@endsection
