<?php $this->layout = false; $base = $this->request->getAttribute('webroot'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="<?= $base ?>images/favicon.png" />
  <title>About — MakeOver Star HIIT</title>
  <meta name="description" content="Learn the story, mission, and team behind MakeOver Star HIIT — a premium HIIT and strength training club." />
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
      <h1>About <span class="text-gradient">MakeOver Star HIIT</span></h1>
      <p class="breadcrumb"><a href="<?= $this->Url->build('/') ?>">Home</a> / About</p>
    </div>
  </section>

  <!-- ABOUT STORY -->
  <section class="about-preview">
    <div class="container grid-2">
      <div class="about-img reveal">
        <img src="<?= $base ?>images/story-img.jpg" alt="Gym interior" />
      </div>
      <div class="about-text reveal">
        <h2>Our <span class="text-gradient">Story</span></h2>
        <p>Founded in 2016, MakeOver Star HIIT was born from a simple belief: anyone — regardless of background, age or experience — deserves access to elite training and life-changing fitness.</p>
        <p>What started as a single HIIT studio has grown into a premium training club trusted by hundreds of athletes, professionals and everyday warriors chasing their best self.</p>
        <p>Our mission is to deliver world-class coaching, real human community, and programming that produces real, lasting transformations.</p>
        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'contact']) ?>" class="btn btn-primary">Visit The Club <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </section>

  <!-- WHY CHOOSE US -->
  <section class="features" style="background: var(--bg-soft);">
    <div class="container">
      <h2 class="section-title reveal">Why <span class="text-gradient">Choose Us</span></h2>
      <p class="section-sub reveal">Four reasons members choose MakeOver Star HIIT — and stay for years.</p>
      <div class="why-grid">
        <div class="feature-card reveal">
          <div class="feature-icon"><i class="fa-solid fa-medal"></i></div>
          <h3>Certified Trainers</h3>
          <p>NASM, ACE and ISSA-certified coaches with years of competitive experience.</p>
        </div>
        <div class="feature-card reveal">
          <div class="feature-icon"><i class="fa-solid fa-gears"></i></div>
          <h3>Modern Equipment</h3>
          <p>Top-tier machines, free weights, and HIIT-ready training zones.</p>
        </div>
        <div class="feature-card reveal">
          <div class="feature-icon"><i class="fa-solid fa-clock"></i></div>
          <h3>Flexible Timing</h3>
          <p>Open 18 hours a day with classes scheduled around your real life.</p>
        </div>
        <div class="feature-card reveal">
          <div class="feature-icon"><i class="fa-solid fa-user-shield"></i></div>
          <h3>Personal Guidance</h3>
          <p>1-on-1 onboarding, progress tracking and custom plans for every member.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- TEAM -->
  <section class="trainers">
    <div class="container">
      <h2 class="section-title reveal">Our <span class="text-gradient">Team</span></h2>
      <p class="section-sub reveal">The athletes, coaches and minds powering your transformation.</p>
      <div class="trainers-grid">
        <div class="trainer-card reveal">
          <div class="trainer-img"><img src="<?= $base ?>images/trainer-1.jpg" alt="Alex" /></div>
          <div class="trainer-info"><h3>Alex Morgan</h3><p>Founder &amp; Head Coach</p>
            <div class="trainer-socials"><a href="#"><i class="fa-brands fa-instagram"></i></a><a href="#"><i class="fa-brands fa-facebook-f"></i></a><a href="#"><i class="fa-brands fa-x-twitter"></i></a></div>
          </div>
        </div>
        <div class="trainer-card reveal">
          <div class="trainer-img"><img src="<?= $base ?>images/trainer-2.jpg" alt="Sara" /></div>
          <div class="trainer-info"><h3>Sara Lopez</h3><p>Strength Director</p>
            <div class="trainer-socials"><a href="#"><i class="fa-brands fa-instagram"></i></a><a href="#"><i class="fa-brands fa-facebook-f"></i></a><a href="#"><i class="fa-brands fa-x-twitter"></i></a></div>
          </div>
        </div>
        <div class="trainer-card reveal">
          <div class="trainer-img"><img src="<?= $base ?>images/trainer-3.jpg" alt="Marco" /></div>
          <div class="trainer-info"><h3>Marco Rivera</h3><p>HIIT Lead</p>
            <div class="trainer-socials"><a href="#"><i class="fa-brands fa-instagram"></i></a><a href="#"><i class="fa-brands fa-facebook-f"></i></a><a href="#"><i class="fa-brands fa-x-twitter"></i></a></div>
          </div>
        </div>
        <div class="trainer-card reveal">
          <div class="trainer-img"><img src="<?= $base ?>images/trainer-4.jpg" alt="Maya" /></div>
          <div class="trainer-info"><h3>Maya Chen</h3><p>Nutrition Coach</p>
            <div class="trainer-socials"><a href="#"><i class="fa-brands fa-instagram"></i></a><a href="#"><i class="fa-brands fa-facebook-f"></i></a><a href="#"><i class="fa-brands fa-x-twitter"></i></a></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TIMELINE -->
  <section class="timeline">
    <div class="container">
      <h2 class="section-title reveal">Our <span class="text-gradient">Journey</span></h2>
      <p class="section-sub reveal">A decade of growth, sweat and transformation.</p>
      <div class="timeline-list">
        <div class="timeline-item reveal"><h3>Founded</h3><span>2016</span><p>MakeOver Star HIIT opens its first 80-member HIIT studio in downtown.</p></div>
        <div class="timeline-item reveal"><h3>Expanded</h3><span>2019</span><p>Moved to a 12,000 sq ft flagship facility with strength &amp; cardio zones.</p></div>
        <div class="timeline-item reveal"><h3>Awarded</h3><span>2022</span><p>Voted "Best Premium Gym" by City Fitness Awards two years in a row.</p></div>
        <div class="timeline-item reveal"><h3>Community Growth</h3><span>2025</span><p>Surpassed 500 active members and launched our certified coaching academy.</p></div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta-banner">
    <div class="container">
      <h2 class="reveal">Start Your Fitness Journey Today</h2>
      <p class="reveal">Stop waiting for "someday." Walk in, train hard, transform completely.</p>
      <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'contact']) ?>" class="btn btn-primary reveal">Become A Member <i class="fa-solid fa-arrow-right"></i></a>
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
            <li><i class="fa-solid fa-clock"></i> Mon-Sat : 6AM – 9PM</li>
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
