<?php $this->layout = false; $base = $this->request->getAttribute('webroot'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="<?= $base ?>images/favicon.png" />
  <title>MakeOver Star HIIT — Premium Fitness & HIIT Training Club</title>
  <meta name="description" content="MakeOver Star HIIT is a premium fitness club offering HIIT, strength, cardio, and nutrition programs led by certified trainers." />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <link rel="stylesheet" href="<?= $base ?>css/site.css" />
  <link rel="stylesheet" href="<?= $base ?>css/modal.css" />
</head>
<body>

  <!-- ============ NAVBAR ============ -->
  <header class="navbar">
    <div class="container nav-wrap">
      <a href="<?= $this->Url->build('/') ?>" class="logo" style="display:inline-flex;align-items:center;">
        <img src="<?= $base ?>images/final-logo.png" alt="MakeOver Star HIIT" style="height:65px;width:auto;" />
      </a>
      <nav>
        <ul class="nav-menu">
          <li><a href="<?= $this->Url->build('/') ?>">Home</a></li>
          <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'about']) ?>">About</a></li>
          <li><a href="#programs">Programs</a></li>
          <li><a href="#trainers">Trainers</a></li>
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

  <!-- ============ HERO ============ -->
  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <span class="hero-badge">★ #1 HIIT Training Club</span>
        <h1>Transform Your Body. <span class="text-gradient">Elevate Your Mind.</span></h1>
        <p>Push past your limits with science-backed HIIT programs, world-class trainers, and a community that lifts you higher every single day.</p>
        <div class="hero-buttons">
          <a href="#programs" class="btn btn-primary btn-pulse">Join Now <i class="fa-solid fa-arrow-right"></i></a>
          <a href="#programs" class="btn btn-outline">Explore Programs</a>
        </div>
      </div>

      <div class="hero-stats reveal">
        <div class="stat"><div class="stat-num"><span data-counter="500" data-suffix="+">0</span></div><div class="stat-label">Active Members</div></div>
        <div class="stat"><div class="stat-num"><span data-counter="20" data-suffix="+">0</span></div><div class="stat-label">Expert Trainers</div></div>
        <div class="stat"><div class="stat-num"><span data-counter="10" data-suffix=" Yrs">0</span></div><div class="stat-label">Of Experience</div></div>
      </div>
    </div>
  </section>

  <!-- ============ FEATURES ============ -->
  <section class="features">
    <div class="container">
      <h2 class="section-title reveal">What We <span class="text-gradient">Offer</span></h2>
      <p class="section-sub reveal">Programs designed by professionals to deliver real, measurable results — whatever your starting point.</p>

      <div class="features-grid">
        <div class="feature-card reveal">
          <div class="feature-icon"><i class="fa-solid fa-bolt"></i></div>
          <h3>HIIT Training</h3>
          <p>High-intensity interval workouts that torch calories and skyrocket endurance in just 30 minutes.</p>
        </div>
        <div class="feature-card reveal">
          <div class="feature-icon"><i class="fa-solid fa-dumbbell"></i></div>
          <h3>Strength Workout</h3>
          <p>Progressive overload programs to sculpt lean muscle and build unstoppable functional strength.</p>
        </div>
        <div class="feature-card reveal">
          <div class="feature-icon"><i class="fa-solid fa-heart-pulse"></i></div>
          <h3>Cardio Fitness</h3>
          <p>Boost stamina and cardiovascular health with guided cardio that's anything but boring.</p>
        </div>
        <div class="feature-card reveal">
          <div class="feature-icon"><i class="fa-solid fa-apple-whole"></i></div>
          <h3>Nutrition Plans</h3>
          <p>Personalized meal plans engineered to fuel your goals and accelerate your transformation.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ ABOUT PREVIEW ============ -->
  <section class="about-preview">
    <div class="container grid-2">
      <div class="about-img reveal">
        <img src="<?= $base ?>images/about-img.jpg" alt="Trainer coaching a member" />
      </div>
      <div class="about-text reveal">
        <h2>Built For Athletes. <span class="text-gradient">Open To Everyone.</span></h2>
        <p>For over a decade, MakeOver Star HIIT has been more than a gym — it's a movement. We combine elite coaching, modern equipment, and a results-first mindset to help you redefine what your body can do.</p>
        <ul class="about-list">
          <li>Certified, internationally trained coaches</li>
          <li>State-of-the-art HIIT &amp; strength equipment</li>
          <li>Personalized programming for every level</li>
          <li>Supportive, motivating community culture</li>
        </ul>
        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'about']) ?>" class="btn btn-primary">Discover Our Story <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </section>

  <!-- ============ PROGRAMS ============ -->
  <section class="programs" id="programs">
    <div class="container">
      <h2 class="section-title reveal">Choose Your <span class="text-gradient">Program</span></h2>
      <p class="section-sub reveal">Flexible memberships built around your goals, your schedule, and your ambitions.</p>

      <div class="programs-grid">
        <div class="program-card reveal">
          <h3>Beginner Plan</h3>
          <p>Perfect for first-timers ready to start strong.</p>
          <div class="price">$29<span>/month</span></div>
          <ul class="program-features">
            <li><i class="fa-solid fa-check"></i> 3 sessions per week</li>
            <li><i class="fa-solid fa-check"></i> Beginner HIIT &amp; cardio</li>
            <li><i class="fa-solid fa-check"></i> Group classes access</li>
            <li><i class="fa-solid fa-check"></i> Welcome assessment</li>
          </ul>
          <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'contact']) ?>" class="btn btn-outline">Get Started</a>
        </div>

        <div class="program-card featured reveal">
          <h3>Pro Athlete Plan</h3>
          <p>For serious results and full access.</p>
          <div class="price">$59<span>/month</span></div>
          <ul class="program-features">
            <li><i class="fa-solid fa-check"></i> Unlimited sessions</li>
            <li><i class="fa-solid fa-check"></i> Personal trainer access</li>
            <li><i class="fa-solid fa-check"></i> Custom HIIT programming</li>
            <li><i class="fa-solid fa-check"></i> Nutrition consultation</li>
          </ul>
          <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'contact']) ?>" class="btn btn-primary">Join Pro Plan</a>
        </div>

        <div class="program-card reveal">
          <h3>Weight Loss Plan</h3>
          <p>Targeted programming for fat loss and tone.</p>
          <div class="price">$45<span>/month</span></div>
          <ul class="program-features">
            <li><i class="fa-solid fa-check"></i> 5 sessions per week</li>
            <li><i class="fa-solid fa-check"></i> HIIT &amp; metabolic conditioning</li>
            <li><i class="fa-solid fa-check"></i> Weekly progress tracking</li>
            <li><i class="fa-solid fa-check"></i> Meal plan included</li>
          </ul>
          <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'contact']) ?>" class="btn btn-outline">Start Burning</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ TRAINERS ============ -->
  <section class="trainers" id="trainers">
    <div class="container">
      <h2 class="section-title reveal">Meet Our <span class="text-gradient">Trainers</span></h2>
      <p class="section-sub reveal">Certified professionals committed to pushing you safely past every limit.</p>

      <div class="trainers-grid">
        <div class="trainer-card reveal">
          <div class="trainer-img"><img src="<?= $base ?>images/trainer-1.jpg" alt="Trainer Alex" /></div>
          <div class="trainer-info">
            <h3>Alex Morgan</h3>
            <p>HIIT Specialist</p>
            <div class="trainer-socials">
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
          </div>
        </div>
        <div class="trainer-card reveal">
          <div class="trainer-img"><img src="<?= $base ?>images/trainer-2.jpg" alt="Trainer Sara" /></div>
          <div class="trainer-info">
            <h3>Sara Lopez</h3>
            <p>Strength Coach</p>
            <div class="trainer-socials">
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
          </div>
        </div>
        <div class="trainer-card reveal">
          <div class="trainer-img"><img src="<?= $base ?>images/trainer-3.jpg" alt="Trainer Marco" /></div>
          <div class="trainer-info">
            <h3>Marco Rivera</h3>
            <p>Cardio &amp; Endurance</p>
            <div class="trainer-socials">
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
          </div>
        </div>
        <div class="trainer-card reveal">
          <div class="trainer-img"><img src="<?= $base ?>images/trainer-4.jpg" alt="Trainer Maya" /></div>
          <div class="trainer-info">
            <h3>Maya Chen</h3>
            <p>Nutrition Expert</p>
            <div class="trainer-socials">
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ TESTIMONIALS ============ -->
  <section class="testimonials">
    <div class="container">
      <h2 class="section-title reveal">Real People. <span class="text-gradient">Real Results.</span></h2>
      <p class="section-sub reveal">Hear from members who reshaped their lives at MakeOver Star HIIT.</p>

      <div class="slider reveal">
        <div class="slides">
          <div class="slide">
            <i class="fa-solid fa-quote-left quote"></i>
            <p>"I lost 18kg in 6 months and gained confidence I never thought possible. The trainers genuinely care."</p>
            <div class="avatar">JD</div>
            <h4>Jessica Daniels</h4>
            <small>Pro Athlete Member</small>
          </div>
          <div class="slide">
            <i class="fa-solid fa-quote-left quote"></i>
            <p>"The HIIT classes are addictive. 30 minutes feels like a full transformation every single time."</p>
            <div class="avatar">RK</div>
            <h4>Ravi Kumar</h4>
            <small>Beginner Plan Member</small>
          </div>
          <div class="slide">
            <i class="fa-solid fa-quote-left quote"></i>
            <p>"This is the only gym that finally felt like home. The community is unmatched and the programming is elite."</p>
            <div class="avatar">EM</div>
            <h4>Emily Martin</h4>
            <small>Weight Loss Member</small>
          </div>
        </div>
        <div class="slider-dots"></div>
      </div>
    </div>
  </section>

  <!-- ============ CTA BANNER ============ -->
  <section class="cta-banner">
    <div class="container">
      <h2 class="reveal">Your Strongest Self Starts Today.</h2>
      <p class="reveal">Join MakeOver Star HIIT and unlock workouts, coaching and a community built to transform you.</p>
      <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'contact']) ?>" class="btn btn-primary reveal">Start Free Trial <i class="fa-solid fa-arrow-right"></i></a>
    </div>
  </section>

  <!-- ============ FOOTER ============ -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col">
          <a href="<?= $this->Url->build('/') ?>" class="logo" style="display:inline-flex;align-items:center;">
            <img src="<?= $base ?>images/final-logo.png" alt="MakeOver Star HIIT" style="height:50px;width:auto;" />
          </a>
          <p style="margin-top:14px;">Premium HIIT and strength training designed to elevate your body, mind, and lifestyle.</p>
          <div class="social-row">
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="<?= $this->Url->build('/') ?>">Home</a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'about']) ?>">About Us</a></li>
            <li><a href="#programs">Programs</a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'contact']) ?>">Contact</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Programs</h4>
          <ul>
            <li><a href="#programs">HIIT Training</a></li>
            <li><a href="#programs">Strength</a></li>
            <li><a href="#programs">Cardio</a></li>
            <li><a href="#programs">Nutrition</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Contact</h4>
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

  <!-- Auto-open login modal with backend error messages, if any exist -->
  <?php
  $flashmsg = $this->Flash->render();
  if (!empty($flashmsg)):
  ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const loginModal = document.getElementById('loginModal');
      if (loginModal) {
        loginModal.classList.add('open');
        document.body.style.overflow = 'hidden';
        
        const loginForm = document.getElementById('modalLoginForm');
        if (loginForm) {
          const alertDiv = document.createElement('div');
          alertDiv.className = 'modal-alert error';
          alertDiv.innerHTML = <?= json_encode($flashmsg) ?>;
          loginForm.insertBefore(alertDiv, loginForm.firstChild);
        }
      }
    });
  </script>
  <?php endif; ?>
</body>
</html>