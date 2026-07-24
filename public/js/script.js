document.addEventListener('DOMContentLoaded', () => {
  // Sticky Navbar shadow effect on scroll with requestAnimationFrame throttling
  const navbar = document.querySelector('.navbar');
  
  if (navbar) {
    let ticking = false;
    window.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          if (window.scrollY > 10) {
            navbar.classList.add('scrolled');
          } else {
            navbar.classList.remove('scrolled');
          }
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });
  }

  // Smooth Scrolling for section links
  const isHomePage = window.location.pathname === '/' || window.location.pathname.endsWith('/index.php');

  // Helper function to smooth scroll to target selector
  const smoothScrollTo = (selector) => {
    try {
      const target = document.querySelector(selector);
      if (target) {
        const navbarHeight = document.querySelector('.navbar')?.offsetHeight || 80;
        const targetPosition = target.getBoundingClientRect().top + window.scrollY - navbarHeight - 20;
        
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
        return true;
      }
    } catch (e) {
      console.warn("Invalid selector target:", selector);
    }
    return false;
  };

  // Intercept nav clicks
  document.querySelectorAll('a').forEach(anchor => {
    const href = anchor.getAttribute('href');
    if (href && href.includes('#')) {
      const parts = href.split('#');
      const path = parts[0];
      const hash = '#' + parts[1];

      // If the link is for the current page
      const isCurrentPageLink = path === '' || path === '/' || (path && window.location.pathname.endsWith(path));

      if (isHomePage && isCurrentPageLink) {
        anchor.addEventListener('click', (e) => {
          if (hash === '#') return;
          const scrolled = smoothScrollTo(hash);
          if (scrolled) {
            e.preventDefault();
            // Update URL hash without reload jump
            history.pushState(null, null, hash);
          }
        });
      }
    }
  });

  // Handle page load with hash (smoothly scroll down on entry)
  if (window.location.hash) {
    const hash = window.location.hash;
    // Temporary override to prevent browser instant jump
    window.scrollTo(0, 0);
    
    // Smooth scroll down to target after a small delay
    setTimeout(() => {
      smoothScrollTo(hash);
    }, 400);
  }

  // Floating back-to-top button logic
  const scrollToTopBtn = document.getElementById('scrollToTopBtn');
  if (scrollToTopBtn) {
    let btnTicking = false;
    window.addEventListener('scroll', () => {
      if (!btnTicking) {
        window.requestAnimationFrame(() => {
          if (window.scrollY > 300) {
            scrollToTopBtn.classList.add('visible');
          } else {
            scrollToTopBtn.classList.remove('visible');
          }
          btnTicking = false;
        });
        btnTicking = true;
      }
    }, { passive: true });

    scrollToTopBtn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }
});
