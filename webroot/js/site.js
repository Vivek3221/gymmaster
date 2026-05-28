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
  /* Handled via AJAX in contact.ctp — do not add a handler here */
});
