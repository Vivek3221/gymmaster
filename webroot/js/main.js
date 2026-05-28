/* ============================================
   MakeOver Star HIIT — Main JS
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {

  /* ---------- Sticky Navbar ---------- */
  const navbar = document.querySelector('.navbar');
  const onScroll = () => {
    if (!navbar) return;
    navbar.classList.toggle('scrolled', window.scrollY > 40);
  };
  window.addEventListener('scroll', onScroll);
  onScroll();

  /* ---------- Mobile Menu Toggle ---------- */
  const hamburger = document.querySelector('.hamburger');
  const navMenu = document.querySelector('.nav-menu');
  if (hamburger && navMenu) {
    hamburger.addEventListener('click', () => {
      navMenu.classList.toggle('active');
      const open = navMenu.classList.contains('active');
      hamburger.innerHTML = open
        ? '<i class="fa-solid fa-xmark"></i>'
        : '<i class="fa-solid fa-bars"></i>';
    });
    navMenu.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        navMenu.classList.remove('active');
        hamburger.innerHTML = '<i class="fa-solid fa-bars"></i>';
      });
    });
  }

  /* ---------- Active Nav Highlight ---------- */
  const current = location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-menu a').forEach(link => {
    const href = link.getAttribute('href');
    if (href === current) link.classList.add('active');
  });

  /* ---------- Scroll Reveal ---------- */
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));

  /* ---------- Counter Animation ---------- */
  const counters = document.querySelectorAll('[data-counter]');
  const counterObs = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (!e.isIntersecting) return;
      const el = e.target;
      const target = parseInt(el.dataset.counter, 10);
      const suffix = el.dataset.suffix || '';
      let n = 0;
      const step = Math.max(1, Math.ceil(target / 60));
      const tick = () => {
        n += step;
        if (n >= target) { el.textContent = target + suffix; return; }
        el.textContent = n + suffix;
        requestAnimationFrame(tick);
      };
      tick();
      counterObs.unobserve(el);
    });
  }, { threshold: 0.5 });
  counters.forEach(c => counterObs.observe(c));

  /* ---------- Testimonial Slider ---------- */
  const slidesEl = document.querySelector('.slides');
  const dotsWrap = document.querySelector('.slider-dots');
  if (slidesEl && dotsWrap) {
    const slides = slidesEl.children;
    let index = 0;
    for (let i = 0; i < slides.length; i++) {
      const b = document.createElement('button');
      if (i === 0) b.classList.add('active');
      b.addEventListener('click', () => go(i));
      dotsWrap.appendChild(b);
    }
    const go = (i) => {
      index = i;
      slidesEl.style.transform = `translateX(-${i * 100}%)`;
      [...dotsWrap.children].forEach((d, di) => d.classList.toggle('active', di === i));
    };
    setInterval(() => go((index + 1) % slides.length), 6000);
  }

  /* ---------- FAQ Accordion ---------- */
  document.querySelectorAll('.faq-item').forEach(item => {
    const q = item.querySelector('.faq-q');
    if (!q) return;
    q.addEventListener('click', () => {
      document.querySelectorAll('.faq-item.open').forEach(o => {
        if (o !== item) o.classList.remove('open');
      });
      item.classList.toggle('open');
    });
  });

  /* ---------- Contact Form ---------- */
  const form = document.querySelector('.contact-form form');
  if (form) {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const btn = form.querySelector('button[type="submit"]');
      const original = btn.innerHTML;
      btn.innerHTML = '<i class="fa-solid fa-check"></i> Message Sent!';
      btn.disabled = true;
      form.reset();
      setTimeout(() => { btn.innerHTML = original; btn.disabled = false; }, 2800);
    });
  }

  /* ---------- Login & Recover Password Modal ---------- */
  const loginModal = document.getElementById('loginModal');
  const openLoginBtn = document.getElementById('openLoginModal');
  const closeLoginBtn = document.getElementById('closeLoginModal');
  
  const toForgotPassword = document.getElementById('toForgotPassword');
  const toLogin = document.getElementById('toLogin');
  
  const loginContainer = document.getElementById('modalLoginContainer');
  const forgotContainer = document.getElementById('modalForgotContainer');
  const forgotForm = document.getElementById('modalForgotForm');
  const alertBox = document.getElementById('forgotPasswordAlert');

  // Toggle modal open
  if (openLoginBtn && loginModal) {
    openLoginBtn.addEventListener('click', (e) => {
      e.preventDefault();
      loginModal.classList.add('open');
      // Always show login by default when opening
      if (loginContainer) loginContainer.classList.remove('hidden');
      if (forgotContainer) forgotContainer.classList.add('hidden');
      if (alertBox) {
        alertBox.className = 'modal-alert hidden';
        alertBox.textContent = '';
      }
      document.body.style.overflow = 'hidden'; // Disable background scrolling
    });
  }

  // Toggle modal close
  if (closeLoginBtn && loginModal) {
    closeLoginBtn.addEventListener('click', () => {
      loginModal.classList.remove('open');
      document.body.style.overflow = ''; // Re-enable background scrolling
    });
  }

  // Close when clicking outside of card
  if (loginModal) {
    loginModal.addEventListener('click', (e) => {
      if (e.target === loginModal) {
        loginModal.classList.remove('open');
        document.body.style.overflow = '';
      }
    });
  }

  // Switch to forgot password view
  if (toForgotPassword && loginContainer && forgotContainer) {
    toForgotPassword.addEventListener('click', (e) => {
      e.preventDefault();
      loginContainer.classList.add('hidden');
      forgotContainer.classList.remove('hidden');
      if (alertBox) {
        alertBox.className = 'modal-alert hidden';
        alertBox.textContent = '';
      }
    });
  }

  // Switch back to login view
  if (toLogin && loginContainer && forgotContainer) {
    toLogin.addEventListener('click', (e) => {
      e.preventDefault();
      forgotContainer.classList.add('hidden');
      loginContainer.classList.remove('hidden');
    });
  }

  // Forgot password form submission via AJAX
  if (forgotForm && alertBox) {
    forgotForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const emailInput = document.getElementById('forgotEmail');
      const submitBtn = forgotForm.querySelector('button[type="submit"]');
      const originalBtnContent = submitBtn.innerHTML;

      // Loading state
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Sending...';
      alertBox.className = 'modal-alert hidden';

      const formData = new FormData(forgotForm);
      fetch(forgotForm.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network error');
        }
        return response.json();
      })
      .then(data => {
        alertBox.textContent = data.msg;
        if (data.msg_type === 'success') {
          alertBox.className = 'modal-alert success';
          if (emailInput) emailInput.value = ''; // Reset input field
        } else {
          alertBox.className = 'modal-alert error';
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alertBox.textContent = 'An error occurred. Please try again.';
        alertBox.className = 'modal-alert error';
      })
      .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnContent;
      });
    });
  }
});
