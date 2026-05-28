<?php $this->layout = false; $base = $this->request->getAttribute('webroot'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="<?= $base ?>images/favicon.png" />
  <title>Reset Password — MakeOver Star HIIT</title>
  <meta name="description" content="Reset your MakeOver Star HIIT account password securely." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="<?= $base ?>css/site.css" />
  <link rel="stylesheet" href="<?= $base ?>css/modal.css" />
  <style>
    .reset-page {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      background:
        linear-gradient(135deg, rgba(13,17,23,0.93) 0%, rgba(11,110,168,0.6) 100%),
        url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
      padding: 100px 20px 40px;
    }
    .reset-page::before {
      content: '';
      position: absolute;
      top: 10%; left: -10%;
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(247,147,30,0.35), transparent 70%);
      filter: blur(80px);
    }
    .reset-page::after {
      content: '';
      position: absolute;
      bottom: 10%; right: -10%;
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(11,110,168,0.35), transparent 70%);
      filter: blur(80px);
    }
    .reset-card {
      position: relative;
      z-index: 2;
      background: rgba(18, 24, 33, 0.9);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 24px;
      padding: 48px 40px;
      width: 100%;
      max-width: 480px;
      box-shadow: 0 24px 64px rgba(0,0,0,0.6);
      animation: cardIn 0.6s cubic-bezier(0.34,1.56,0.64,1);
    }
    @keyframes cardIn {
      from { opacity: 0; transform: scale(0.92) translateY(20px); }
      to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .reset-logo {
      text-align: center;
      margin-bottom: 32px;
    }
    .reset-logo a {
      font-size: 1.5rem;
      font-weight: 800;
      color: #fff;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
    }
    .reset-logo a i { color: #f7931e; }
    .reset-logo a span {
      background: linear-gradient(135deg, #f7931e, #0b6ea8);
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .reset-header { text-align: center; margin-bottom: 32px; }
    .reset-icon {
      width: 72px; height: 72px;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(247,147,30,0.15), rgba(11,110,168,0.15));
      border: 1px solid rgba(247,147,30,0.3);
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 20px;
      font-size: 1.8rem;
      color: #f7931e;
    }
    .reset-header h1 { font-size: 1.7rem; margin-bottom: 8px; color: #fff; }
    .reset-header p { color: #8b95a5; font-size: 0.92rem; }
    .reset-form .field-group { margin-bottom: 20px; }
    .reset-form label {
      display: block;
      margin-bottom: 8px;
      font-size: 0.85rem;
      font-weight: 500;
      color: #c9d1d9;
    }
    .reset-form .field-wrap { position: relative; }
    .reset-form .field-icon {
      position: absolute;
      left: 16px; top: 50%;
      transform: translateY(-50%);
      color: #8b95a5;
      font-size: 1rem;
      pointer-events: none;
      transition: color 0.3s;
    }
    .reset-form .toggle-pass {
      position: absolute;
      right: 14px; top: 50%;
      transform: translateY(-50%);
      background: none; border: none;
      color: #8b95a5; cursor: pointer;
      font-size: 0.95rem;
      transition: color 0.3s;
    }
    .reset-form .toggle-pass:hover { color: #f7931e; }
    .reset-form input[type="password"],
    .reset-form input[type="text"] {
      width: 100%;
      padding: 14px 44px 14px 44px;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 12px;
      color: #fff;
      font-family: 'Poppins', sans-serif;
      font-size: 0.95rem;
      transition: 0.3s;
      outline: none;
    }
    .reset-form input:focus {
      border-color: #f7931e;
      box-shadow: 0 0 0 3px rgba(247,147,30,0.2);
      background: rgba(255,255,255,0.06);
    }
    .reset-form input:focus + .field-icon,
    .reset-form .field-wrap:focus-within .field-icon { color: #f7931e; }
    .strength-bar {
      margin-top: 8px;
      display: flex;
      gap: 4px;
    }
    .strength-bar span {
      flex: 1;
      height: 4px;
      border-radius: 4px;
      background: rgba(255,255,255,0.08);
      transition: background 0.4s;
    }
    .strength-label {
      font-size: 0.75rem;
      margin-top: 4px;
      color: #8b95a5;
      text-align: right;
    }
    .match-msg {
      font-size: 0.78rem;
      margin-top: 6px;
      display: none;
    }
    .match-msg.ok { color: #56d364; display: block; }
    .match-msg.no { color: #ff7b72; display: block; }
    .submit-btn {
      width: 100%;
      padding: 15px;
      border: none;
      border-radius: 12px;
      background: linear-gradient(135deg, #f7931e, #0b6ea8);
      color: #fff;
      font-family: 'Poppins', sans-serif;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: 0.3s;
      box-shadow: 0 8px 24px rgba(247,147,30,0.35);
      margin-top: 8px;
    }
    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 32px rgba(247,147,30,0.45);
    }
    .submit-btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
    .back-link-row {
      text-align: center;
      margin-top: 24px;
    }
    .back-link-row a {
      color: #8b95a5;
      font-size: 0.875rem;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      text-decoration: none;
      transition: color 0.3s;
    }
    .back-link-row a:hover { color: #f7931e; }
    .flash-box {
      padding: 12px 16px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-size: 0.88rem;
      text-align: center;
    }
    .flash-box.success { background: rgba(46,160,67,0.15); border: 1px solid #2ea043; color: #56d364; }
    .flash-box.error   { background: rgba(248,81,73,0.15);  border: 1px solid #f85149; color: #ff7b72; }
    @media (max-width: 520px) {
      .reset-card { padding: 32px 22px; }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <header class="navbar">
    <div class="container nav-wrap">
      <a href="<?= $this->Url->build('/') ?>" class="logo" style="display:inline-flex;align-items:center;">
        <img src="<?= $base ?>images/final-logo.png" alt="MakeOver Star HIIT" style="height:65px;width:auto;" />
      </a>
      <nav>
        <ul class="nav-menu">
          <li><a href="<?= $this->Url->build('/') ?>">Home</a></li>
          <li><a href="<?= $this->Url->build(['controller'=>'Users','action'=>'about']) ?>">About</a></li>
          <li><a href="<?= $this->Url->build('/') ?>#programs">Programs</a></li>
          <li><a href="<?= $this->Url->build('/') ?>#trainers">Trainers</a></li>
          <li><a href="<?= $this->Url->build(['controller'=>'Users','action'=>'contact']) ?>">Contact</a></li>
        </ul>
      </nav>
      <button class="hamburger" aria-label="Menu"><i class="fa-solid fa-bars"></i></button>
    </div>
  </header>

  <!-- Reset Page -->
  <div class="reset-page">
    <div class="reset-card">

      <div class="reset-logo">
        <a href="<?= $this->Url->build('/') ?>">
          <i class="fa-solid fa-dumbbell"></i>MakeOver<span class="text-gradient">Star</span>
        </a>
      </div>

      <div class="reset-header">
        <div class="reset-icon"><i class="fa-solid fa-key"></i></div>
        <h1>Reset Password</h1>
        <p>Create a strong new password for your account.</p>
      </div>

      <?php $flashmsg = $this->Flash->render(); if (!empty($flashmsg)): ?>
      <div class="flash-box <?= strpos($flashmsg, 'successfully') !== false ? 'success' : 'error' ?>">
        <?= $flashmsg ?>
      </div>
      <?php endif; ?>

      <?= $this->Form->create('Reset Password Form', [
        'url'        => ['controller' => 'Users', 'action' => 'resetPassword', $token],
        'id'         => 'resetPasswordForm',
        'novalidate' => 'novalidate',
        'class'      => 'reset-form'
      ]) ?>

        <!-- New Password -->
        <div class="field-group">
          <label for="newpassword">New Password</label>
          <div class="field-wrap">
            <i class="fa-solid fa-lock field-icon"></i>
            <?= $this->Form->control('newpassword', [
              'type'        => 'password',
              'id'          => 'newpassword',
              'placeholder' => 'Enter new password',
              'label'       => false,
              'oninput'     => 'checkStrength(this.value);checkMatch();'
            ]) ?>
            <button type="button" class="toggle-pass" onclick="togglePass('newpassword', this)">
              <i class="fa-regular fa-eye"></i>
            </button>
          </div>
          <div class="strength-bar">
            <span id="s1"></span><span id="s2"></span><span id="s3"></span><span id="s4"></span>
          </div>
          <div class="strength-label" id="strengthLabel"></div>
        </div>

        <!-- Confirm Password -->
        <div class="field-group">
          <label for="confirmpassword">Confirm Password</label>
          <div class="field-wrap">
            <i class="fa-solid fa-lock field-icon"></i>
            <?= $this->Form->control('confirmpassword', [
              'type'        => 'password',
              'id'          => 'confirmpassword',
              'placeholder' => 'Re-enter password',
              'label'       => false,
              'oninput'     => 'checkMatch();'
            ]) ?>
            <button type="button" class="toggle-pass" onclick="togglePass('confirmpassword', this)">
              <i class="fa-regular fa-eye"></i>
            </button>
          </div>
          <div class="match-msg" id="matchMsg"></div>
        </div>

        <button type="submit" class="submit-btn" id="submitBtn">
          <i class="fa-solid fa-shield-halved"></i> Set New Password
        </button>

      <?= $this->Form->end() ?>

      <div class="back-link-row">
        <a href="<?= $this->Url->build(['controller'=>'Users','action'=>'adminLogin']) ?>">
          <i class="fa-solid fa-arrow-left"></i> Back to Sign In
        </a>
      </div>

    </div>
  </div>

  <script src="<?= $base ?>js/site.js"></script>
  <script>
  function togglePass(id, btn) {
    const inp = document.getElementById(id);
    const isPass = inp.type === 'password';
    inp.type = isPass ? 'text' : 'password';
    btn.innerHTML = isPass ? '<i class="fa-regular fa-eye-slash"></i>' : '<i class="fa-regular fa-eye"></i>';
  }

  function checkStrength(val) {
    const bars = [document.getElementById('s1'), document.getElementById('s2'), document.getElementById('s3'), document.getElementById('s4')];
    const label = document.getElementById('strengthLabel');
    const colors = ['#f85149','#f7931e','#e3b341','#56d364'];
    const labels = ['','Weak','Fair','Good','Strong'];
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    bars.forEach((b, i) => { b.style.background = i < score ? colors[score - 1] : 'rgba(255,255,255,0.08)'; });
    label.textContent = val.length ? labels[score] : '';
    label.style.color = score > 0 ? colors[score - 1] : '#8b95a5';
  }

  function checkMatch() {
    const p1 = document.getElementById('newpassword').value;
    const p2 = document.getElementById('confirmpassword').value;
    const msg = document.getElementById('matchMsg');
    const btn = document.getElementById('submitBtn');
    if (!p2) { msg.className = 'match-msg'; return; }
    if (p1 === p2) {
      msg.textContent = '✓ Passwords match'; msg.className = 'match-msg ok'; btn.disabled = false;
    } else {
      msg.textContent = '✗ Passwords do not match'; msg.className = 'match-msg no'; btn.disabled = true;
    }
  }
  </script>
</body>
</html>