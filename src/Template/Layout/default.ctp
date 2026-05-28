<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
    <div id="loginModal" class="login-modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(10px); z-index: 10000; align-items: center; justify-content: center;">
        <div class="login-modal-content" style="background: rgba(22, 22, 22, 0.85); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 40px; width: 90%; max-width: 450px; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37); position: relative; text-align: left;">
            <button id="closeLoginModal" style="position: absolute; top: 15px; right: 20px; background: none; border: none; color: #fff; font-size: 24px; cursor: pointer; transition: color 0.3s;">&times;</button>
            
            <div style="text-align: center; margin-bottom: 30px;">
                <img src="<?= $this->Url->build('/assets/images/final-logo.png') ?>" alt="Logo" style="max-height: 45px; margin-bottom: 15px;">
                <h3 style="color: #fff; font-weight: 700; font-size: 24px;">Admin Sign In</h3>
                <p style="color: #888; font-size: 14px;">Access your GymMaster Dashboard</p>
            </div>

            <form method="post" action="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">
                <input type="hidden" name="_csrfToken" value="<?= $this->request->getParam('_csrfToken') ?>">
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; color: #c0c0c0; font-size: 13px; font-weight: 500; margin-bottom: 8px;">Email Address</label>
                    <input type="email" name="email" required placeholder="Enter email" style="width: 100%; background: #161616 !important; border: 1px solid #2d2d2d !important; color: #fff !important; padding: 15px !important; border-radius: 8px !important; font-size: 15px; outline: none; transition: border-color 0.3s;">
                </div>

                <div style="margin-bottom: 25px;">
                    <label style="display: block; color: #c0c0c0; font-size: 13px; font-weight: 500; margin-bottom: 8px;">Password</label>
                    <input type="password" name="password" required placeholder="Enter password" style="width: 100%; background: #161616 !important; border: 1px solid #2d2d2d !important; color: #fff !important; padding: 15px !important; border-radius: 8px !important; font-size: 15px; outline: none; transition: border-color 0.3s;">
                </div>

                <button type="submit" class="box-style box-second cmn-btn alt d-center d-inline-flex gap-0 rounded-pill border-0 w-100" style="cursor: pointer; padding: 15px 30px;">
                    <span class="fs-six px-4">SIGN IN</span>
                    <span class="icon rounded-circle d-center fs-five transition">
                        <i class="ph ph-arrow-up-right"></i>
                    </span>
                </button>
                
                <div style="text-align: center; margin-top: 20px;">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'forgotPassword']) ?>" style="color: #d11e5d; font-size: 14px; text-decoration: none;">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginModal = document.getElementById('loginModal');
        const openButtons = document.querySelectorAll('.trigger-login-modal');
        const closeBtn = document.getElementById('closeLoginModal');

        openButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                loginModal.style.display = 'flex';
                // Close sidebar if open
                const sidebar = document.querySelector('.sidebar-menu');
                if (sidebar && sidebar.classList.contains('active')) {
                    const closeSidebar = document.querySelector('.menu-close-btn');
                    if (closeSidebar) closeSidebar.click();
                }
            });
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                loginModal.style.display = 'none';
            });
        }

        // Close when clicking outside content
        window.addEventListener('click', function(e) {
            if (e.target === loginModal) {
                loginModal.style.display = 'none';
            }
        });
    });
    </script>
</body>
</html>
