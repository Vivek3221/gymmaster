<?php 
$session = $this->Common->getSession();
$birthday = $this->Common->getBirthday();
$paymantexp = $this->Common->getPaymentDue();
$planexpire = $this->Common->getPlanexpire();
?>

<!-- Modern Header Styling Blocks -->
<style>
    /* Modern Header Navbar Styles */
    nav.navbar.change-color {
        background: #ffffff !important;
        border-bottom: 1px solid #edf2f7 !important;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.03) !important;
        height: 70px !important;
        padding: 0 !important;
    }
    
    nav.navbar.change-color .container-fluid {
        padding: 0 15px !important;
    }
    
    /* Header Container Flexing */
    nav.navbar.change-color .navbar-header {
        display: flex !important;
        align-items: center !important;
        height: 70px !important;
        padding: 0 !important;
    }
    
    /* Navbar Brand / Logo */
    nav.navbar.change-color .navbar-brand {
        color: #1a202c !important;
        font-family: 'Roboto', 'Inter', sans-serif !important;
        font-weight: 800 !important;
        font-size: 18px !important;
        letter-spacing: 0.5px !important;
        height: 70px !important;
        line-height: 70px !important;
        padding: 0 20px !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        text-transform: uppercase !important;
        text-decoration: none !important;
    }
    
    /* Premium Orange Accent Dot on Logo */
    nav.navbar.change-color .navbar-brand::before {
        content: '';
        width: 10px;
        height: 10px;
        background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 8px rgba(255, 152, 0, 0.6);
    }
    
    /* Collapse Header Content Adjustments */
    nav.navbar.change-color .navbar-collapse {
        height: 70px !important;
        border-top: none !important;
    }
    
    /* Navigation Icons / Buttons */
    nav.navbar.change-color .nav {
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        height: 70px !important;
    }
    
    nav.navbar.change-color .nav > li {
        height: 70px !important;
        display: flex !important;
        align-items: center !important;
    }
    
    nav.navbar.change-color .nav > li > a {
        color: #4a5568 !important;
        height: 70px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 0 16px !important;
        transition: all 0.2s ease !important;
        background: transparent !important;
    }
    
    nav.navbar.change-color .nav > li > a:hover {
        background: #f7fafc !important;
        color: #ff9800 !important;
    }
    
    nav.navbar.change-color .nav > li > a i.material-icons {
        font-size: 22px !important;
        margin: 0 !important;
    }
    
    /* Notification Label Badge */
    nav.navbar.change-color .label-count {
        background-color: #ff9800 !important;
        color: #ffffff !important;
        font-size: 10px !important;
        font-weight: 700 !important;
        position: absolute !important;
        top: 16px !important;
        right: 8px !important;
        padding: 2px 6px !important;
        border-radius: 10px !important;
        border: 2px solid #ffffff !important;
        box-shadow: 0 2px 5px rgba(255, 152, 0, 0.3) !important;
    }
    
    /* Notification Dropdown Menu */
    nav.navbar.change-color .dropdown-menu {
        border-radius: 12px !important;
        border: 1px solid #edf2f7 !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
        width: 320px !important;
        padding: 0 !important;
        overflow: hidden !important;
        margin-top: 5px !important;
        animation: slideDown 0.2s ease-out !important;
        background: #ffffff !important;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    nav.navbar.change-color .dropdown-menu .header {
        background: #f7fafc !important;
        color: #4a5568 !important;
        font-weight: 700 !important;
        font-size: 11px !important;
        letter-spacing: 1px !important;
        padding: 14px 20px !important;
        border-bottom: 1px solid #edf2f7 !important;
        margin: 0 !important;
        text-transform: uppercase !important;
    }
    
    nav.navbar.change-color .dropdown-menu .body {
        padding: 0 !important;
    }
    
    nav.navbar.change-color .dropdown-menu ul.menu {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    
    nav.navbar.change-color .dropdown-menu ul.menu li {
        border-bottom: 1px solid #f7fafc !important;
    }
    
    nav.navbar.change-color .dropdown-menu ul.menu li:last-child {
        border-bottom: none !important;
    }
    
    nav.navbar.change-color .dropdown-menu ul.menu li a {
        display: flex !important;
        align-items: center !important;
        gap: 14px !important;
        padding: 14px 20px !important;
        transition: all 0.2s ease !important;
        text-decoration: none !important;
        background: transparent !important;
    }
    
    nav.navbar.change-color .dropdown-menu ul.menu li a:hover {
        background: #f7fafc !important;
    }
    
    nav.navbar.change-color .dropdown-menu ul.menu li a .icon-circle {
        width: 38px !important;
        height: 38px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
    }
    
    nav.navbar.change-color .dropdown-menu ul.menu li a .icon-circle i {
        font-size: 18px !important;
        color: #ffffff !important;
    }
    
    nav.navbar.change-color .dropdown-menu ul.menu li a .menu-info h4 {
        margin: 0 !important;
        font-size: 13px !important;
        color: #2d3748 !important;
        font-weight: 600 !important;
        line-height: 1.4 !important;
    }
    
    /* Mobile Toggle Bars Button */
    nav.navbar.change-color .bars {
        color: #4a5568 !important;
        padding: 0 15px !important;
        height: 70px !important;
        line-height: 70px !important;
        display: inline-block !important;
        transition: all 0.2s ease !important;
        background: transparent !important;
    }
    
    nav.navbar.change-color .bars:hover {
        background: #f7fafc !important;
        color: #ff9800 !important;
    }
    
    /* Logout Icon for Mobile */
    nav.navbar.change-color .logout-icon {
        color: #4a5568 !important;
        float: right !important;
        padding: 0 15px !important;
        height: 70px !important;
        line-height: 70px !important;
        transition: all 0.2s ease !important;
    }
    
    nav.navbar.change-color .logout-icon:hover {
        background: #f7fafc !important;
        color: #e53935 !important;
    }
</style>

<body class="theme-red">
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar change-color">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']); ?>" class="navbar-brand">
                    <?= __('Data Monitor') ?>
                </a>
                <a class="hidden-md hidden-lg logout-icon" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>">
                    <i class="material-icons" style="vertical-align: middle; color: #e53935;">power_settings_new</i>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($usersdetail['users_type'] != 3) {?>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count"><?= $session ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"><?= __('NOTIFICATIONS') ?></li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="<?= $this->Url->build(['controller' => 'Sessions', 'action' => 'index',]) ?>?sessions=notedit">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">library_books</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><?= $session . ' Users session not reported.' ?></h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index',]) ?>?users=birthday">
                                            <div class="icon-circle bg-light-blue">
                                                <i class="material-icons">face</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><?= $birthday . ' Users birthday today.' ?></h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $this->Url->build(['controller' => 'PlanSubscribers', 'action' => 'index',]) ?>?payments=paymentexp">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">person_add_disabled</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><?= $paymantexp . ' Users payment due.' ?></h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $this->Url->build(['controller' => 'PlanSubscribers', 'action' => 'index',]) ?>?planexp=planexpire">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">highlight_off</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><?= $planexpire . ' Users plan expire.' ?></h4>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li>
                        <a class="hidden-xs" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>">
                            <i class="material-icons" title="Log Out" style="color: #e53935;">power_settings_new</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>