<?php $this->layout = false; $base = $this->request->getAttribute('webroot'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="<?= $base ?>images/favicon.png" />
  <title>My Profile — MakeOver Star HIIT</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="<?= $base ?>css/site.css" />
  <link rel="stylesheet" href="<?= $base ?>css/modal.css" />
  <style>
    .profile-page {
      min-height: 100vh;
      padding: 120px 24px 60px;
      position: relative;
    }
    .profile-page::before {
      content: '';
      position: fixed; inset: 0; z-index: -1;
      background:
        linear-gradient(135deg, rgba(13,17,23,0.97), rgba(11,110,168,0.3)),
        url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
    }
    .profile-wrap {
      max-width: 900px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 28px;
      align-items: start;
    }
    /* ---- Sidebar Card ---- */
    .profile-sidebar {
      background: rgba(18,24,33,0.9);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255,255,255,0.09);
      border-radius: 20px;
      padding: 36px 24px;
      text-align: center;
      position: sticky;
      top: 100px;
      animation: cardIn 0.5s ease;
    }
    .avatar-big {
      width: 96px; height: 96px;
      border-radius: 50%;
      background: linear-gradient(135deg, #f7931e, #0b6ea8);
      display: flex; align-items: center; justify-content: center;
      font-size: 2.4rem; font-weight: 800; color: #fff;
      margin: 0 auto 18px;
      box-shadow: 0 8px 32px rgba(247,147,30,0.4);
    }
    .sidebar-name {
      font-size: 1.15rem; font-weight: 700; color: #fff; margin-bottom: 4px;
    }
    .sidebar-email {
      color: #8b95a5; font-size: 0.85rem; margin-bottom: 20px;
      word-break: break-all;
    }
    .sidebar-badge {
      display: inline-block;
      padding: 5px 16px;
      background: rgba(247,147,30,0.12);
      border: 1px solid rgba(247,147,30,0.4);
      border-radius: 50px;
      color: #f7931e;
      font-size: 0.78rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      margin-bottom: 28px;
    }
    .sidebar-stats {
      display: flex;
      justify-content: center;
      gap: 20px;
      border-top: 1px solid rgba(255,255,255,0.07);
      padding-top: 20px;
    }
    .sidebar-stat .num {
      font-size: 1.3rem; font-weight: 700; color: #fff;
      background: linear-gradient(135deg, #f7931e, #0b6ea8);
      -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;
    }
    .sidebar-stat .lbl { font-size: 0.73rem; color: #8b95a5; margin-top: 2px; }
    .sidebar-links { margin-top: 22px; display: flex; flex-direction: column; gap: 6px; }
    .sidebar-links a {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 14px; border-radius: 10px;
      color: #c9d1d9; font-size: 0.875rem; text-decoration: none;
      transition: 0.25s; border: 1px solid transparent;
    }
    .sidebar-links a:hover { background: rgba(255,255,255,0.05); color: #fff; border-color: rgba(255,255,255,0.08); }
    .sidebar-links a i { width: 18px; color: #8b95a5; }
    .sidebar-links a:hover i { color: #f7931e; }
    .sidebar-links a.active { background: rgba(247,147,30,0.1); border-color: rgba(247,147,30,0.25); color: #f7931e; }
    .sidebar-links a.active i { color: #f7931e; }

    /* ---- Main Form ---- */
    .profile-main { animation: cardIn 0.5s 0.1s ease both; }
    @keyframes cardIn {
      from { opacity: 0; transform: translateY(18px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .profile-section {
      background: rgba(18,24,33,0.9);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255,255,255,0.09);
      border-radius: 20px;
      padding: 32px 36px;
      margin-bottom: 22px;
    }
    .section-head {
      display: flex; align-items: center; gap: 12px;
      margin-bottom: 28px;
      padding-bottom: 18px;
      border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    .section-icon {
      width: 42px; height: 42px;
      border-radius: 11px;
      background: linear-gradient(135deg, rgba(247,147,30,0.2), rgba(11,110,168,0.2));
      border: 1px solid rgba(247,147,30,0.25);
      display: flex; align-items: center; justify-content: center;
      color: #f7931e; font-size: 1rem;
    }
    .section-head h2 { font-size: 1.1rem; color: #fff; margin: 0; }
    .section-head p  { font-size: 0.8rem; color: #8b95a5; margin: 0; }
    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    .field-grp { margin-bottom: 20px; }
    .field-grp.full { grid-column: 1 / -1; }
    .field-grp label { display: block; margin-bottom: 8px; font-size: 0.82rem; font-weight: 600; color: #c9d1d9; letter-spacing: 0.3px; }
    .field-wrap { position: relative; }
    .field-wrap input {
      width: 100%;
      padding: 13px 14px 13px 44px;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 11px;
      color: #fff;
      font-family: 'Poppins', sans-serif;
      font-size: 0.93rem;
      transition: 0.3s;
      outline: none;
    }
    .field-wrap input:focus {
      border-color: #f7931e;
      box-shadow: 0 0 0 3px rgba(247,147,30,0.18);
      background: rgba(255,255,255,0.06);
    }
    .field-wrap input:disabled {
      opacity: 0.45; cursor: not-allowed;
    }
    .field-icon {
      position: absolute; left: 15px; top: 50%;
      transform: translateY(-50%); color: #8b95a5;
      pointer-events: none; font-size: 0.95rem; transition: color 0.3s;
    }
    .field-wrap:focus-within .field-icon { color: #f7931e; }
    .toggle-pass {
      position: absolute; right: 13px; top: 50%;
      transform: translateY(-50%); background: none; border: none;
      color: #8b95a5; cursor: pointer; font-size: 0.9rem; transition: color 0.3s;
    }
    .toggle-pass:hover { color: #f7931e; }
    .strength-bar { display: flex; gap: 4px; margin-top: 8px; }
    .strength-bar span { flex: 1; height: 3px; border-radius: 3px; background: rgba(255,255,255,0.07); transition: background 0.4s; }
    .strength-label { font-size: 0.72rem; color: #8b95a5; text-align: right; margin-top: 4px; }
    .match-msg { font-size: 0.78rem; margin-top: 5px; display: none; }
    .match-msg.ok { color: #56d364; display: block; }
    .match-msg.no { color: #ff7b72; display: block; }
    .hint { font-size: 0.75rem; color: #8b95a5; margin-top: 5px; }
    .save-btn {
      display: inline-flex; align-items: center; gap: 9px;
      padding: 13px 32px; border: none; border-radius: 12px;
      background: linear-gradient(135deg, #f7931e, #0b6ea8);
      color: #fff; font-family: 'Poppins', sans-serif; font-size: 0.95rem; font-weight: 600;
      cursor: pointer; transition: 0.3s; box-shadow: 0 6px 20px rgba(247,147,30,0.35);
    }
    .save-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(247,147,30,0.45); }
    .save-btn:disabled { opacity: 0.55; cursor: not-allowed; transform: none; }
    .flash-success {
      padding: 13px 18px; border-radius: 10px; margin-bottom: 20px;
      background: rgba(46,160,67,0.15); border: 1px solid #2ea043; color: #56d364;
      font-size: 0.88rem; display: flex; align-items: center; gap: 10px;
    }
    .flash-error {
      padding: 13px 18px; border-radius: 10px; margin-bottom: 20px;
      background: rgba(248,81,73,0.15); border: 1px solid #f85149; color: #ff7b72;
      font-size: 0.88rem; display: flex; align-items: center; gap: 10px;
    }
    @media (max-width: 760px) {
      .profile-wrap { grid-template-columns: 1fr; }
      .profile-sidebar { position: static; }
      .field-row { grid-template-columns: 1fr; }
      .profile-section { padding: 24px 20px; }
    }
  </style>
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
          <li><a href="<?= $this->Url->build(['controller'=>'Users','action'=>'about']) ?>">About</a></li>
          <li><a href="<?= $this->Url->build('/') ?>#programs">Programs</a></li>
          <li><a href="<?= $this->Url->build('/') ?>#trainers">Trainers</a></li>
          <li><a href="<?= $this->Url->build(['controller'=>'Users','action'=>'contact']) ?>">Contact</a></li>
          <li>
            <?php if (!empty($usersdetail['users_name'])): ?>
            <div class="account-dropdown">
              <button class="account-btn">
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
                  <a href="<?= $this->Url->build('/user-profile') ?>" class="active"><i class="fa-solid fa-user"></i> My Profile</a>
                  <div class="account-menu-divider"></div>
                  <a href="<?= $this->Url->build(['controller'=>'Users','action'=>'logout']) ?>" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a>
                </div>
              </div>
            </div>
            <?php else: ?>
            <a href="<?= $this->Url->build('/') ?>" class="nav-login-btn"><i class="fa-solid fa-user"></i> Login</a>
            <?php endif; ?>
          </li>
        </ul>
      </nav>
      <button class="hamburger" aria-label="Menu"><i class="fa-solid fa-bars"></i></button>
    </div>
  </header>

  <div class="profile-page">
    <div class="profile-wrap">

      <!-- SIDEBAR -->
      <aside class="profile-sidebar">
        <div class="avatar-big"><?= strtoupper(substr($usersdetail['users_name'] ?? 'U', 0, 1)) ?></div>
        <div class="sidebar-name"><?= h($usersdetail['users_name'] ?? '') ?></div>
        <div class="sidebar-email"><?= h($usersdetail['users_email'] ?? '') ?></div>
        <div class="sidebar-badge"><i class="fa-solid fa-star"></i> Member</div>
        <div class="sidebar-stats">
          <div class="sidebar-stat"><div class="num">Active</div><div class="lbl">Status</div></div>
        </div>
        <nav class="sidebar-links">
          <a href="<?= $this->Url->build('/user-profile') ?>" class="active"><i class="fa-solid fa-user-pen"></i> Edit Profile</a>
          <a href="<?= $this->Url->build(['controller'=>'Users','action'=>'dashboard']) ?>"><i class="fa-solid fa-gauge"></i> Dashboard</a>
          <a href="<?= $this->Url->build(['controller'=>'Users','action'=>'logout']) ?>" style="color:#ff7b72;"><i class="fa-solid fa-right-from-bracket" style="color:#ff7b72;"></i> Sign Out</a>
        </nav>
      </aside>

      <!-- MAIN -->
      <div class="profile-main">

        <?php $flashmsg = $this->Flash->render(); ?>
        <?php if (!empty($flashmsg)): ?>
          <div class="<?= strpos($flashmsg, 'successfully') !== false ? 'flash-success' : 'flash-error' ?>">
            <i class="fa-solid fa-<?= strpos($flashmsg, 'successfully') !== false ? 'circle-check' : 'circle-exclamation' ?>"></i>
            <?= $flashmsg ?>
          </div>
        <?php endif; ?>

        <?= $this->Form->create(null, [
          'url'        => ['action' => 'userProfile'],
          'method'     => 'post',
          'id'         => 'profileForm'
        ]) ?>

        <!-- Personal Info -->
        <div class="profile-section">
          <div class="section-head">
            <div class="section-icon"><i class="fa-solid fa-user"></i></div>
            <div>
              <h2>Personal Information</h2>
              <p>Update your display name</p>
            </div>
          </div>

          <div class="field-row">
            <div class="field-grp">
              <label>Full Name</label>
              <div class="field-wrap">
                <i class="fa-solid fa-user field-icon"></i>
                <input type="text" name="users_name" id="users_name"
                  value="<?= h($user->name ?? '') ?>"
                  placeholder="Your full name" required />
              </div>
            </div>
            <div class="field-grp">
              <label>Email Address <span style="color:#8b95a5;font-weight:400;">(cannot be changed)</span></label>
              <div class="field-wrap">
                <i class="fa-solid fa-envelope field-icon"></i>
                <input type="email" value="<?= h($user->email ?? '') ?>" disabled />
              </div>
            </div>
          </div>
        </div>

        <!-- Change Password -->
        <div class="profile-section">
          <div class="section-head">
            <div class="section-icon"><i class="fa-solid fa-lock"></i></div>
            <div>
              <h2>Change Password</h2>
              <p>Leave blank to keep current password</p>
            </div>
          </div>

          <div class="field-row">
            <div class="field-grp">
              <label>New Password</label>
              <div class="field-wrap">
                <i class="fa-solid fa-lock field-icon"></i>
                <input type="password" name="new_password" id="newPass"
                  placeholder="Enter new password"
                  oninput="checkStrength(this.value);checkMatch();" />
                <button type="button" class="toggle-pass" onclick="togglePass('newPass',this)">
                  <i class="fa-regular fa-eye"></i>
                </button>
              </div>
              <div class="strength-bar"><span id="sb1"></span><span id="sb2"></span><span id="sb3"></span><span id="sb4"></span></div>
              <div class="strength-label" id="sLabel"></div>
              <div class="hint">Min 8 chars, mix of letters, numbers & symbols for best security</div>
            </div>
            <div class="field-grp">
              <label>Confirm Password</label>
              <div class="field-wrap">
                <i class="fa-solid fa-lock field-icon"></i>
                <input type="password" name="confirm_password" id="confirmPass"
                  placeholder="Re-enter new password"
                  oninput="checkMatch();" />
                <button type="button" class="toggle-pass" onclick="togglePass('confirmPass',this)">
                  <i class="fa-regular fa-eye"></i>
                </button>
              </div>
              <div class="match-msg" id="matchMsg"></div>
            </div>
          </div>
        </div>

        <!-- Save Button -->
        <div style="display:flex; justify-content:flex-end; gap:14px;">
          <a href="<?= $this->Url->build('/') ?>" class="btn btn-outline" style="padding:12px 28px;">Cancel</a>
          <button type="submit" class="save-btn" id="saveBtn">
            <i class="fa-solid fa-floppy-disk"></i> Save Changes
          </button>
        </div>

        <?= $this->Form->end() ?>
      </div><!-- /profile-main -->
    </div><!-- /profile-wrap -->
  </div><!-- /profile-page -->

  <script src="<?= $base ?>js/site.js"></script>
  <script>
  function togglePass(id, btn) {
    const inp = document.getElementById(id);
    const show = inp.type === 'password';
    inp.type = show ? 'text' : 'password';
    btn.innerHTML = show ? '<i class="fa-regular fa-eye-slash"></i>' : '<i class="fa-regular fa-eye"></i>';
  }
  function checkStrength(val) {
    const bars = [document.getElementById('sb1'),document.getElementById('sb2'),document.getElementById('sb3'),document.getElementById('sb4')];
    const lbl = document.getElementById('sLabel');
    const cols = ['#f85149','#f7931e','#e3b341','#56d364'];
    const lbls = ['','Weak','Fair','Good','Strong'];
    let s = 0;
    if (val.length >= 8) s++;
    if (/[A-Z]/.test(val)) s++;
    if (/[0-9]/.test(val)) s++;
    if (/[^A-Za-z0-9]/.test(val)) s++;
    bars.forEach((b,i) => { b.style.background = i < s ? cols[s-1] : 'rgba(255,255,255,0.07)'; });
    lbl.textContent = val.length ? lbls[s] : '';
    lbl.style.color = s > 0 ? cols[s-1] : '#8b95a5';
  }
  function checkMatch() {
    const p1 = document.getElementById('newPass').value;
    const p2 = document.getElementById('confirmPass').value;
    const msg = document.getElementById('matchMsg');
    const btn = document.getElementById('saveBtn');
    if (!p1 || !p2) { msg.className = 'match-msg'; btn.disabled = false; return; }
    if (p1 === p2) { msg.textContent = '✓ Passwords match'; msg.className = 'match-msg ok'; btn.disabled = false; }
    else { msg.textContent = '✗ Passwords do not match'; msg.className = 'match-msg no'; btn.disabled = true; }
  }
  </script>
</body>
</html>
