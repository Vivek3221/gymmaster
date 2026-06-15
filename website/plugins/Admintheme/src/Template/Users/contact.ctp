<?php $this->layout = false; $base = $this->request->getAttribute('webroot'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="<?= $base ?>images/favicon.png" />
  <title>Contact — MakeOver Star HIIT</title>
  <meta name="description" content="Get in touch with MakeOver Star HIIT. Visit us, call, or send a message to start your premium fitness journey." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="<?= $base ?>css/site.css" />
  <link rel="stylesheet" href="<?= $base ?>css/modal.css" />
</head>
<body>

  <!-- NAVBAR -->
  <header class="navbar">
    <div class="container nav-wrap">
      <a href="<?= $this->Url->build('/') ?>" class="logo" style="display:inline-flex;align-items:center;">
        <img src="<?= $base ?>images/final-logo.png" alt="MakeOver Star HIIT" style="height:65px;width:auto;" />
      </a>
      <nav>
        <ul class="nav-menu">
          <li><a href="<?= $this->Url->build('/') ?>">Home</a></li>
          <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'about']) ?>">About</a></li>
          <li><a href="<?= $this->Url->build('/') ?>#programs">Programs</a></li>
          <li><a href="<?= $this->Url->build('/') ?>#trainers">Trainers</a></li>
          <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'contact']) ?>">Contact</a></li>
          <li>
            <?php if (!empty($usersdetail['users_name'])): ?>
            <div class="account-dropdown" id="accountDropdown">
              <button class="account-btn" id="accountBtn">
                <span class="avatar-circle"><?= strtoupper(substr($usersdetail['users_name'], 0, 1)) ?></span>
                <?= h($usersdetail['users_name']) ?>
                <i class="fa-solid fa-chevron-down" style="font-size:0.7rem;"></i>
              </button>
              <div class="account-menu">
                <div class="account-menu-inner">
                <div class="account-menu-header">
                  <div class="name"><?= h($usersdetail['users_name']) ?></div>
                  <div class="role">Member</div>
                </div>
                <a href="<?= $this->Url->build(['controller'=>'Users','action'=>'dashboard']) ?>"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                <a href="<?= $this->Url->build('/user-profile') ?>"><i class="fa-solid fa-user"></i> My Profile</a>
                <div class="account-menu-divider"></div>
                <a href="<?= $this->Url->build(['controller'=>'Users','action'=>'logout']) ?>" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a>
                </div>
              </div>
            </div>
            <?php else: ?>
            <button class="nav-login-btn" id="openLoginModal"><i class="fa-solid fa-user"></i> Login</button>
            <?php endif; ?>
          </li>
        </ul>
      </nav>
      <button class="hamburger" aria-label="Menu"><i class="fa-solid fa-bars"></i></button>
    </div>
  </header>

  <!-- PAGE BANNER -->
  <section class="page-banner">
    <div class="container">
      <h1>Get In <span class="text-gradient">Touch</span></h1>
      <p class="breadcrumb"><a href="<?= $this->Url->build('/') ?>">Home</a> / Contact</p>
    </div>
  </section>

  <!-- CONTACT -->
  <section>
    <div class="container">
      <div class="contact-grid">
        <!-- LEFT -->
        <div class="info-stack reveal">
          <div class="info-card">
            <div class="icon"><i class="fa-solid fa-location-dot"></i></div>
            <div><h4>Address</h4><p>MakeOver Fitness, Opp. Singla General Store, Mandi Gobindgarh, Punjab 147301</p></div>
          </div>
          <div class="info-card">
            <div class="icon"><i class="fa-solid fa-phone"></i></div>
            <div><h4>Phone</h4><p><a href="tel:+919891499189">+919891499189</a></p></div>
          </div>
          <div class="info-card">
            <div class="icon"><i class="fa-solid fa-envelope"></i></div>
            <div><h4>Email</h4><p><a href="mailto:makeover72@gmail.com">makeover72@gmail.com</a></p></div>
          </div>
          <div class="info-card">
            <div class="icon"><i class="fa-solid fa-clock"></i></div>
            <div><h4>Working Hours</h4><p>Mon – Sat: 6:00 AM – 9:00 PM</p></div>
          </div>
        </div>

        <!-- RIGHT -->
        <div class="contact-form reveal">
          <h3>Send Us A <span class="text-gradient">Message</span></h3>
          <form id="contactForm" novalidate onsubmit="return cfHandleSubmit(event);">
            <div class="form-row">
              <div class="form-group">
                <label for="cf_name">Full Name *</label>
                <input type="text" id="cf_name" name="name" required placeholder="John Doe" />
              </div>
              <div class="form-group">
                <label for="cf_email">Email *</label>
                <input type="email" id="cf_email" name="email" required placeholder="you@email.com" />
              </div>
            </div>
            <div class="form-group">
              <label for="cf_phone">Phone</label>
              <input type="tel" id="cf_phone" name="phone" placeholder="+91 98914 99189" />
            </div>
            <div class="form-group">
              <label for="cf_message">Message *</label>
              <textarea id="cf_message" name="message" required placeholder="Tell us about your goals..."></textarea>
            </div>
            <button type="submit" id="cfSubmitBtn" class="btn btn-primary" style="width:100%; justify-content:center;">
              Send Message <i class="fa-solid fa-paper-plane"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- ====== CONTACT TOAST ====== -->
  <div id="cfToast" style="display:none;position:fixed;bottom:28px;right:28px;z-index:9999;min-width:300px;max-width:420px;padding:18px 24px;border-radius:14px;box-shadow:0 8px 40px rgba(0,0,0,.35);font-family:'Poppins',sans-serif;font-size:14px;font-weight:500;align-items:center;gap:12px;">
    <span id="cfToastIcon" style="font-size:20px;"></span>
    <span id="cfToastMsg"></span>
  </div>
  <style>@keyframes cfSlideIn{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}</style>

  <!-- ====== CONTACT FORM HANDLER (global scope, no DOMContentLoaded needed) ====== -->
  <script>
  var CF_ACTION_URL = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'sendContact']) ?>';

  function cfShowToast(ok, msg) {
    var t  = document.getElementById('cfToast');
    var ic = document.getElementById('cfToastIcon');
    var mg = document.getElementById('cfToastMsg');
    if (!t) return;
    t.style.display = 'flex';
    if (ok) {
      t.style.background = 'linear-gradient(135deg,#1a3a1a,#0d2d0d)';
      t.style.border = '1px solid #2d7a2d';
      ic.textContent = '\u2705'; mg.style.color = '#7ddd7d';
    } else {
      t.style.background = 'linear-gradient(135deg,#3a1a1a,#2d0d0d)';
      t.style.border = '1px solid #7a2d2d';
      ic.textContent = '\u274C'; mg.style.color = '#dd7d7d';
    }
    mg.textContent = msg;
    clearTimeout(t._h);
    t._h = setTimeout(function(){ t.style.display='none'; }, 6000);
  }

  function cfHandleSubmit(e) {
    e.preventDefault();
    e.stopPropagation();

    var nv = (document.getElementById('cf_name')    || {value:''}).value.trim();
    var ev = (document.getElementById('cf_email')   || {value:''}).value.trim();
    var mv = (document.getElementById('cf_message') || {value:''}).value.trim();
    var pv = (document.getElementById('cf_phone')   || {value:''}).value.trim();

    if (!nv || !ev || !mv) {
      cfShowToast(false, 'Please fill in your Name, Email and Message.');
      return false;
    }

    var btn  = document.getElementById('cfSubmitBtn');
    var orig = btn ? btn.innerHTML : '';
    if (btn) { btn.disabled = true; btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Sending...'; }

    var params = new URLSearchParams();
    params.append('name',    nv);
    params.append('email',   ev);
    params.append('message', mv);
    params.append('phone',   pv);

    fetch(CF_ACTION_URL, {
      method: 'POST',
      body: params,
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r){ return r.json(); })
    .then(function(d){
      if (d.success) {
        cfShowToast(true, d.msg);
        var f = document.getElementById('contactForm'); if (f) f.reset();
      } else {
        cfShowToast(false, d.msg || 'Failed to send. Please try again.');
      }
    })
    .catch(function(){ cfShowToast(false, 'Network error. Please try again.'); })
    .finally(function(){ if (btn){ btn.disabled=false; btn.innerHTML=orig; } });

    return false;
  }
  </script>

  <!-- MAP -->
  <section style="padding-top:0;">
    <div class="container">
      <div class="map-wrap reveal">
        <iframe
            loading="lazy"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen=""
            referrerpolicy="no-referrer-when-downgrade"
            src="https://www.google.com/maps?q=M79W%2BRFX%2C+Railway+Rd%2C+opp.+Singla+Karyana%2C+Nasrali%2C+Mandi+Gobindgarh%2C+Punjab+147301&output=embed">
        </iframe>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="testimonials">
    <div class="container">
      <h2 class="section-title reveal">Frequently Asked <span class="text-gradient">Questions</span></h2>
      <p class="section-sub reveal">Everything you need to know before joining MakeOver Star HIIT.</p>
      <div class="faq-list">
        <div class="faq-item reveal">
          <button class="faq-q">Do I need fitness experience to join? <i class="fa-solid fa-chevron-down"></i></button>
          <div class="faq-a"><p>Not at all. Our Beginner Plan is built specifically for first-timers, with onboarding sessions to introduce you to every movement safely.</p></div>
        </div>
        <div class="faq-item reveal">
          <button class="faq-q">What's included in the free trial? <i class="fa-solid fa-chevron-down"></i></button>
          <div class="faq-a"><p>You get a 7-day full-access trial — group classes, gym access, and one personal assessment with a certified trainer.</p></div>
        </div>
        <div class="faq-item reveal">
          <button class="faq-q">Can I cancel my membership anytime? <i class="fa-solid fa-chevron-down"></i></button>
          <div class="faq-a"><p>Yes. All memberships are month-to-month with zero cancellation fees. You're always in control.</p></div>
        </div>
        <div class="faq-item reveal">
          <button class="faq-q">Do you offer nutrition coaching? <i class="fa-solid fa-chevron-down"></i></button>
          <div class="faq-a"><p>Absolutely. Our Pro Athlete and Weight Loss plans include personalized nutrition consultation with our in-house experts.</p></div>
        </div>
        <div class="faq-item reveal">
          <button class="faq-q">What are your opening hours? <i class="fa-solid fa-chevron-down"></i></button>
          <div class="faq-a"><p>We're open 7 days a week, from 5:00 AM to 11:00 PM, so you can train on your schedule.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col">
          <a href="<?= $this->Url->build('/') ?>" class="logo" style="display:inline-flex;align-items:center;">
            <img src="<?= $base ?>images/final-logo.png" alt="MakeOver Star HIIT" style="height:50px;width:auto;" />
          </a>
          <p style="margin-top:14px;">Premium HIIT and strength training designed to elevate your body, mind, and lifestyle.</p>
          <div class="social-row">
            <a href="#"><i class="fa-brands fa-instagram"></i></a><a href="#"><i class="fa-brands fa-facebook-f"></i></a><a href="#"><i class="fa-brands fa-youtube"></i></a><a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          </div>
        </div>
        <div class="footer-col"><h4>Quick Links</h4>
          <ul><li><a href="<?= $this->Url->build('/') ?>">Home</a></li><li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'about']) ?>">About Us</a></li><li><a href="<?= $this->Url->build('/') ?>#programs">Programs</a></li><li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'contact']) ?>">Contact</a></li></ul>
        </div>
        <div class="footer-col"><h4>Programs</h4>
          <ul><li><a href="<?= $this->Url->build('/') ?>#programs">HIIT Training</a></li><li><a href="<?= $this->Url->build('/') ?>#programs">Strength</a></li><li><a href="<?= $this->Url->build('/') ?>#programs">Cardio</a></li><li><a href="<?= $this->Url->build('/') ?>#programs">Nutrition</a></li></ul>
        </div>
        <div class="footer-col"><h4>Contact</h4>
          <ul>
            <li><i class="fa-solid fa-location-dot"></i>MakeOver Fitness, Opp. Singla General Store, Mandi Gobindgarh, Punjab 147301</li>
            <li><i class="fa-solid fa-phone"></i> <a href="tel:+919891499189">+919891499189</a></li>
            <li><i class="fa-solid fa-envelope"></i> <a href="mailto:makeover72@gmail.com">makeover72@gmail.com</a></li>
            <li><i class="fa-solid fa-clock"></i> Mon–Sat: 6AM – 9PM</li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">© 2026 MakeOver Star HIIT. All rights reserved.</div>
    </div>
  </footer>

  <!-- ============ LOGIN MODAL ============ -->
  <div id="loginModal" class="modal-overlay">
    <div class="modal-card">
      <button class="modal-close-btn" id="closeLoginModal" aria-label="Close modal">&times;</button>
      
      <!-- Login Container -->
      <div id="modalLoginContainer" class="modal-container">
        <div class="modal-header">
          <h2>Welcome <span class="text-gradient">Back</span></h2>
          <p>Sign in to manage your workouts and tracking</p>
        </div>
        
        <form id="modalLoginForm" action="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" method="POST" class="modal-form">
          <div class="form-group">
            <label for="loginEmail">Email Address</label>
            <div class="input-icon-wrap">
              <i class="fa-solid fa-envelope input-icon"></i>
              <input type="email" id="loginEmail" name="email" required placeholder="name@domain.com" />
            </div>
          </div>
          <div class="form-group">
            <label for="loginPassword">Password</label>
            <div class="input-icon-wrap">
              <i class="fa-solid fa-lock input-icon"></i>
              <input type="password" id="loginPassword" name="password" required placeholder="Enter password" />
            </div>
          </div>
          <div class="form-options">
            <a href="#" id="toForgotPassword" class="forgot-link">Forgot password?</a>
          </div>
          <button type="submit" class="btn btn-primary modal-submit-btn">
            Sign In <i class="fa-solid fa-right-to-bracket"></i>
          </button>
        </form>
      </div>
      
      <!-- Forgot Password Container -->
      <div id="modalForgotContainer" class="modal-container hidden">
        <div class="modal-header">
          <h2>Recover <span class="text-gradient">Password</span></h2>
          <p>Enter your email to receive a password reset link</p>
        </div>
        
        <form id="modalForgotForm" action="<?= $this->Url->build(['controller' => 'Users', 'action' => 'forgetPassword']) ?>" method="POST" class="modal-form">
          <div class="form-group">
            <label for="forgotEmail">Email Address</label>
            <div class="input-icon-wrap">
              <i class="fa-solid fa-envelope input-icon"></i>
              <input type="email" id="forgotEmail" name="email" required placeholder="name@domain.com" />
            </div>
          </div>
          
          <!-- Alert Box inside modal -->
          <div id="forgotPasswordAlert" class="modal-alert hidden"></div>
          
          <button type="submit" class="btn btn-primary modal-submit-btn">
            Send Reset Link <i class="fa-solid fa-paper-plane"></i>
          </button>
          
          <div class="form-footer">
            <a href="#" id="toLogin" class="back-link"><i class="fa-solid fa-arrow-left"></i> Back to Sign In</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="<?= $base ?>js/site.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('loginModal');
    const openBtn = document.getElementById('openLoginModal');
    const closeBtn = document.getElementById('closeLoginModal');
    const toForgot = document.getElementById('toForgotPassword');
    const toLogin = document.getElementById('toLogin');
    const loginBox = document.getElementById('modalLoginContainer');
    const forgotBox = document.getElementById('modalForgotContainer');
    const alertBox = document.getElementById('forgotPasswordAlert');
    const forgotForm = document.getElementById('modalForgotForm');
    const openModal = () => { modal.classList.add('open'); document.body.style.overflow = 'hidden'; };
    const closeModal = () => { modal.classList.remove('open'); document.body.style.overflow = ''; };
    if (openBtn) openBtn.addEventListener('click', (e) => { e.preventDefault(); loginBox.classList.remove('hidden'); forgotBox.classList.add('hidden'); openModal(); });
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (modal) modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
    if (toForgot) toForgot.addEventListener('click', (e) => { e.preventDefault(); loginBox.classList.add('hidden'); forgotBox.classList.remove('hidden'); if (alertBox) { alertBox.className = 'modal-alert hidden'; alertBox.textContent = ''; } });
    if (toLogin) toLogin.addEventListener('click', (e) => { e.preventDefault(); forgotBox.classList.add('hidden'); loginBox.classList.remove('hidden'); });
    if (forgotForm && alertBox) {
      forgotForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const btn = forgotForm.querySelector('button[type="submit"]');
        const orig = btn.innerHTML;
        btn.disabled = true; btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Sending...';
        alertBox.className = 'modal-alert hidden';
        fetch(forgotForm.action, { method: 'POST', body: new FormData(forgotForm), headers: { 'X-Requested-With': 'XMLHttpRequest' } })
          .then(r => r.json())
          .then(d => { alertBox.textContent = d.msg; alertBox.className = 'modal-alert ' + (d.msg_type === 'success' ? 'success' : 'error'); if (d.msg_type === 'success') forgotForm.reset(); })
          .catch(() => { alertBox.textContent = 'An error occurred. Please try again.'; alertBox.className = 'modal-alert error'; })
          .finally(() => { btn.disabled = false; btn.innerHTML = orig; });
      });
    }
  });
  </script>
</body>
</html>
