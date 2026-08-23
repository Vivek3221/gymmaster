<?php
$controller = $this->request['controller'];
$action = $this->request['action'];
$firstLetter = !empty($usersdetail['users_name']) ? strtoupper(substr(trim($usersdetail['users_name']), 0, 1)) : 'A';
?>

<!-- Modern Sidebar Styling Blocks -->
<style>
    /* Modern Sidebar Container */
    aside#leftsidebar.sidebar {
        background: #ffffff !important;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05) !important;
        border-right: 1px solid #edf2f7 !important;
    }
    
    /* User Info Container - styled to fit exactly in 70px height */
    .sidebar .user-info {
        background: #ffffff !important;
        border-bottom: 1px solid #f0f4f8 !important;
        padding: 0 15px !important;
        height: 70px !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        position: relative !important;
    }
    
    /* Reset theme's absolute/relative offset on info-container */
    .sidebar .user-info .info-container {
        padding: 0 !important;
        margin: 0 !important;
        position: static !important;
        top: 0 !important;
        flex: 1;
        min-width: 0;
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        height: 100% !important;
    }
    
    /* Dynamic Circular Initials Avatar */
    .sidebar .user-info .avatar-circle {
        width: 36px !important;
        height: 36px !important;
        background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%) !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 15px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: 0 4px 10px rgba(255, 152, 0, 0.3) !important;
        flex-shrink: 0 !important;
    }
    
    .sidebar .user-info .info-container .name {
        color: #1a202c !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        margin: 0 0 1px 0 !important;
        text-transform: none !important;
        line-height: 1.2 !important;
        display: flex !important;
        align-items: center !important;
        gap: 4px !important;
        cursor: pointer !important;
    }
    
    .sidebar .user-info .info-container .email {
        color: #718096 !important;
        font-size: 10px !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        text-transform: none !important;
        margin: 0 !important;
        line-height: 1.2 !important;
    }
 
    /* Menu Layout */
    .sidebar .menu .list {
        padding: 4px 0 !important;
        list-style: none !important;
    }
    
    .sidebar .menu .list .header {
        font-size: 10px !important;
        font-weight: 800 !important;
        color: #a0aec0 !important;
        letter-spacing: 1.2px !important;
        text-transform: uppercase !important;
        background: transparent !important;
        padding: 8px 15px 4px 15px !important;
        margin: 0 !important;
    }
    
    .sidebar .menu .list li {
        margin: 1px 8px !important;
        border-radius: 6px !important;
        overflow: hidden !important;
        border: none !important;
    }
    
    .sidebar .menu .list li a {
        padding: 8px 12px !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        color: #4a5568 !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        border-radius: 6px !important;
        transition: all 0.2s ease !important;
        text-decoration: none !important;
        height: auto !important;
    }
    
    .sidebar .menu .list li a i.material-icons {
        margin: 0 !important;
        font-size: 17px !important;
        color: #718096 !important;
        transition: all 0.2s ease !important;
    }
    
    /* Active State Style for single menu items */
    .sidebar .menu .list > li.active:not(:has(.ml-menu)) {
        background: #fff3e0 !important;
    }
    
    .sidebar .menu .list > li.active:not(:has(.ml-menu)) > a {
        color: #e65100 !important;
    }
    
    .sidebar .menu .list > li.active:not(:has(.ml-menu)) > a i.material-icons {
        color: #ff9800 !important;
    }

    /* Parent Dropdown Menu when active/open */
    .sidebar .menu .list > li.active:has(.ml-menu) {
        background: #fafafa !important;
    }

    .sidebar .menu .list > li.active:has(.ml-menu) > a.menu-toggle {
        background: #f7fafc !important;
        color: #1a202c !important;
        font-weight: 700 !important;
    }

    .sidebar .menu .list > li.active:has(.ml-menu) > a.menu-toggle i.material-icons {
        color: #ff9800 !important;
    }
    
    /* Hover State Style */
    .sidebar .menu .list li:not(.active):hover {
        background: #f7fafc !important;
    }
    
    .sidebar .menu .list li:not(.active):hover a {
        color: #1a202c !important;
    }
    
    .sidebar .menu .list li:not(.active):hover a i.material-icons {
        color: #4a5568 !important;
    }
    
    /* Submenus (ml-menu) */
    .sidebar .menu .list li .ml-menu {
        background: #ffffff !important;
        padding: 4px 0 !important;
        border-radius: 0 0 6px 6px !important;
        list-style: none !important;
    }
    
    .sidebar .menu .list li .ml-menu li {
        margin: 1px 8px !important;
        border-radius: 6px !important;
        background: transparent !important;
    }
    
    .sidebar .menu .list li .ml-menu li a {
        padding: 6px 12px 6px 26px !important;
        font-size: 12.5px !important;
        font-weight: 500 !important;
        color: #4a5568 !important;
        border-radius: 6px !important;
    }

    .sidebar .menu .list li .ml-menu li a:hover {
        background: #f7fafc !important;
        color: #1a202c !important;
    }
    
    .sidebar .menu .list li .ml-menu li.active {
        background: #fff3e0 !important;
    }

    .sidebar .menu .list li .ml-menu li.active a {
        color: #e65100 !important;
        font-weight: 700 !important;
    }
    .sidebar .menu .list li .ml-menu li.active a::before {
        content: '› ';
        font-size: 14px;
        font-weight: 800;
        margin-right: 4px;
        color: #ff9800;
    }
    
    /* Legal Footer Section */
    .sidebar .legal {
        background: #ffffff !important;
        border-top: 1px solid #edf2f7 !important;
        padding: 8px 15px !important;
        font-size: 11px !important;
        color: #718096 !important;
    }
    
    .sidebar .legal .copyright a {
        color: #ff9800 !important;
        font-weight: 600 !important;
        text-decoration: none !important;
    }
</style>

<section>
    <!--Left Sidebar-->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="avatar-circle">
                <?php echo $firstLetter; ?>
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span><?php echo h($usersdetail['users_name']); ?></span>
                    <i class="material-icons" style="font-size: 16px; color: #718096; vertical-align: middle;">keyboard_arrow_down</i>
                </div>
                <div class="email"><?php echo h($usersdetail['users_email']); ?></div>
                
                <ul class="dropdown-menu pull-right" style="border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 1px solid #edf2f7; margin-top: 5px;">
                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>" style="display: flex; align-items: center; gap: 8px; padding: 10px 16px; color: #e53935; font-weight: 600;"><i class="material-icons" style="font-size: 18px; color: #e53935;">input</i><?= __('Sign Out') ?></a></li>
                </ul>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header"><?= __('MAIN NAVIGATION') ?></li>
                <li class="<?php if (($controller == 'Users' && ($action == 'dashboard'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']); ?>">
                        <i class="material-icons">home</i>
                        <span><?=__('Dashboard')?></span>
                    </a>
                </li>
                <?php if($usersdetail['users_type'] == 2 || $usersdetail['users_type'] == 1){; ?>
                 <li class="<?php if (($controller == 'Users' && ($action == 'trainerList' || $action == 'trainerAdd' || $action == 'trainerEdit' || $action == 'trainerView'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'trainerList']); ?>">
                        <i class="material-icons">list</i>
                        <span><?= __('Trainers') ?></span>
                    </a>
                </li>
                <li class="<?php if (($controller == 'Users' && ($action == 'frontDeskList' || $action == 'frontDeskAdd' || $action == 'frontDeskEdit' || $action == 'frontDeskView'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'frontDeskList']); ?>">
                        <i class="material-icons">badge</i>
                        <span><?= __('Front Desk') ?></span>
                    </a>
                </li>
                <?php } ?>    
                <?php if($usersdetail['users_type'] == 1 || $usersdetail['users_type'] == 2 || $usersdetail['users_type'] == 5){; ?>
                 <li class="<?php if (($controller == 'Users' && ($action == 'index' || $action == 'add' || $action == 'edit' || $action == 'view'|| $action == 'adminLogin'|| $action == 'login'|| $action == 'addPayment' || $action == 'payment'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>">
                        <i class="material-icons">list</i>
                        <span><?= __('Users') ?></span>
                    </a>
                </li>
                 <li class="<?php if (($controller == 'Plans' && ($action == 'index' || $action == 'add' || $action == 'edit' || $action == 'view'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'Plans', 'action' => 'index']); ?>">
                        <i class="material-icons">loyalty</i>
                        <span><?= __('Plans') ?></span>
                    </a>
                </li>
                <?php if (!isset($usersdetail['users_type']) || $usersdetail['users_type'] != 5) { ?>
                <li class="<?php if (($controller == 'PlanSubscribers' && ($action == 'index' || $action == 'add' || $action == 'edit' || $action == 'view'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'PlanSubscribers', 'action' => 'index']); ?>">
                        <i class="material-icons">pageview</i>
                        <span><?= __('Plan Subscribe') ?></span>
                    </a>
                </li>
                <?php } ?>
                <?php
                // Manual Collection: show only to permitted emails
                if (!empty($usersdetail['users_email'])) {
                    try {
                        $db = \Cake\ORM\TableRegistry::get('PlanSubscribers')->getConnection();
                        $mcAccess = $db->execute(
                            "SELECT id FROM manual_collection_access WHERE LOWER(email) = ? AND is_active = 1 LIMIT 1",
                            [strtolower(trim($usersdetail['users_email']))]
                        )->fetch('assoc');
                    } catch(\Exception $e) { $mcAccess = false; }
                    if ($mcAccess) { ?>
                <li class="<?php if ($controller == 'ManualCollections'){echo "active";}?>" style="background:<?= $controller=='ManualCollections'?'#f3e5f5':''; ?>">
                    <a href="<?= $this->Url->build(['controller' => 'ManualCollections', 'action' => 'index']); ?>" style="<?= $controller=='ManualCollections'?'color:#7b1fa2!important;':''; ?>">
                        <i class="material-icons" style="<?= $controller=='ManualCollections'?'color:#9c27b0!important;':''; ?>">playlist_add_check</i>
                        <span><?= __('Manual Collection') ?></span>
                    </a>
                </li>
                <?php } } ?>
                <li class="<?php if (($controller == 'Payments' && ($action == 'index' || $action == 'add' || $action == 'edit' || $action == 'view'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'Payments', 'action' => 'index']); ?>">
                        <i class="material-icons">payment</i>
                        <span><?= __('Payments') ?></span>
                    </a>
                </li>
                 <?php } ?>
                <?php
                // PT Master Plans & PT Payroll: show to partners, admins, permitted front desk, and special emails
                $showPtPayroll = false;
                if (!empty($usersdetail)) {
                    $userType = isset($usersdetail['users_type']) ? $usersdetail['users_type'] : 0;
                    $userEmail = isset($usersdetail['users_email']) ? $usersdetail['users_email'] : '';
                    $showPtPayroll = $this->Common->canAccessPtModule($userType, $userEmail);
                }
                if ($showPtPayroll) { ?>
                <li class="<?php if ($controller == 'PtPlans' || $controller == 'PtPayrolls'){echo "active";}?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">fitness_center</i>
                        <span><?= __('PT Plans & Payroll') ?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?php if ($controller == 'PtPlans' && $action == 'index'){echo "active";}?>">
                            <a href="<?= $this->Url->build(['controller' => 'PtPlans', 'action' => 'index']); ?>"><?= __('PT Master Plans') ?></a>
                        </li>
                        <li class="<?php if ($controller == 'PtPlans' && $action == 'assign'){echo "active";}?>">
                            <a href="<?= $this->Url->build(['controller' => 'PtPlans', 'action' => 'assign']); ?>"><?= __('Assign PT Plan') ?></a>
                        </li>
                        <li class="<?php if ($controller == 'PtPlans' && $action == 'subscriptions'){echo "active";}?>">
                            <a href="<?= $this->Url->build(['controller' => 'PtPlans', 'action' => 'subscriptions']); ?>"><?= __('Client PT Subscriptions') ?></a>
                        </li>
                        <li class="<?php if ($controller == 'PtPayrolls' && $action == 'addClassEntry'){echo "active";}?>">
                            <a href="<?= $this->Url->build(['controller' => 'PtPayrolls', 'action' => 'addClassEntry']); ?>"><?= __('Log PT Class Entry') ?></a>
                        </li>
                        <li class="<?php if ($controller == 'PtPayrolls' && $action == 'index'){echo "active";}?>">
                            <a href="<?= $this->Url->build(['controller' => 'PtPayrolls', 'action' => 'index']); ?>"><?= __('Trainer Payroll List') ?></a>
                        </li>
                        <li class="<?php if ($controller == 'PtPayrolls' && $action == 'clientReport'){echo "active";}?>">
                            <a href="<?= $this->Url->build(['controller' => 'PtPayrolls', 'action' => 'clientReport']); ?>"><?= __('Client PT Revenue Report') ?></a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <?php if($usersdetail['users_type'] == 1 || $usersdetail['users_type'] == 2){; ?>
                <li class="<?php if (($controller == 'ExrciseDirectories' && ($action == 'index' || $action == 'add' || $action == 'edit' || $action == 'view'|| $action == 'adminLogin'|| $action == 'login'|| $action == 'logoutqq' || $action == 'payment'))){echo "active";}?>">
                <a href="<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'index']); ?>">
                        <i class="material-icons">home</i>
                        <span><?= __('Exercise Directory') ?></span>
                    </a>
                </li>
                <?php } ?>

                <?php if($usersdetail['users_type'] != 5){ ?>
                <li class="<?php if ($controller == 'FitnessTests' && ($action == 'index'|| $action == 'add' || $action == 'edit' || $action == 'view')) {echo 'active';} ?>">
                    <a href="<?= $this->Url->build(['controller' => 'FitnessTests', 'action' => 'index']); ?>">
                        <i class="material-icons">home</i>
                        <span><?= __('Fitness Test') ?></span>
                    </a>
                </li>

                <li class="<?php if (($controller == 'Bodies')  || ($controller == 'FitnessMeserments') || ($controller == 'Diets') || ($controller == 'DietDirectories')){echo "active";}?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">text_fields</i>
                        <span><?= __('Nutrition') ?></span>
                    </a>
                    <ul class="ml-menu">
                       <?php if($usersdetail['users_type'] == 1 || $usersdetail['users_type'] == 2){; ?>
                       <li class="<?php if ($controller == 'DietDirectories' && ($action == 'index'|| $action == 'add' || $action == 'edit' || $action == 'view')) {echo 'active';} ?>">
                            <?= $this->Html->link(__('Diet Directories'), ['controller' => 'DietDirectories', 'action' => 'index']) ?>
                       </li>
                      <?php } ?>
                       <li class="<?php if ($controller == 'Diets' && ($action == 'index'|| $action == 'add' || $action == 'edit' || $action == 'view' || $action == 'addMore' || $action == 'userEdit')) {echo 'active';} ?>">
                            <?= $this->Html->link(__('Diets'), ['controller' => 'Diets', 'action' => 'index']) ?>
                       </li>
                       <li class="<?php if ($controller == 'FitnessMeserments' && ($action == 'index'|| $action == 'add' || $action == 'edit' || $action == 'view')) {echo 'active';} ?>">
                            <?= $this->Html->link(__('Body Measurement'), ['controller' => 'FitnessMeserments', 'action' => 'index']) ?>
                       </li>
                    </ul>
                </li>
                <?php } ?>
                <?php if($usersdetail['users_type'] != 3 && $usersdetail['users_type'] != 5){ ;?>
                <li class="<?php if (($controller == 'Sessions' && ($action == 'index' || $action == 'add' || $action == 'edit' || $action == 'view'|| $action == 'userEdit' || $action == 'addMore'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'Sessions', 'action' => 'index']); ?>">
                        <i class="material-icons">perm_media</i>
                        <span><?= __('Create Session') ?></span>
                    </a>
                </li>
                <?php } ?>
                <?php if(($usersdetail['users_type'] == 3) ) {;?>
                <li class="<?php if (($controller == 'Sessions' && ($action == 'index' || $action == 'add' || $action == 'edit' || $action == 'view'|| $action == 'userEdit' || $action == 'addMore'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'Sessions', 'action' => 'index']); ?>">
                        <i class="material-icons">perm_media</i>
                        <span><?= __('Report Session') ?></span>
                    </a>
                </li>
                <?php } ?>
                <li class="<?php if (($controller == 'Exercises' && ($action == 'privacyPolicy'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'Exercises', 'action' => 'privacyPolicy']); ?>">
                        <i class="material-icons">perm_media</i>
                        <span><?= __('privacy Policy') ?></span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2019 <a href="javascript:void(0);"><?= __('Data monitor admin') ?></a>.
            </div>
            <div class="version">
                <b><?= __('Version') ?>: </b> 1.0.4
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>
