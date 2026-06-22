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
    
    /* Active State Style */
    .sidebar .menu .list li.active {
        background: #fff3e0 !important;
    }
    
    .sidebar .menu .list li.active a {
        color: #e65100 !important;
    }
    
    .sidebar .menu .list li.active a i.material-icons {
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
        background: #fafafa !important;
        padding: 1px 0 !important;
        border-radius: 0 0 6px 6px !important;
        list-style: none !important;
    }
    
    .sidebar .menu .list li .ml-menu li {
        margin: 1px 8px !important;
    }
    
    .sidebar .menu .list li .ml-menu li a {
        padding: 5px 12px 5px 30px !important;
        font-size: 12px !important;
        font-weight: 500 !important;
    }
    
    .sidebar .menu .list li .ml-menu li.active {
        background: #ffe0b2 !important;
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
                <?php if($usersdetail['users_type'] == 2){; ?>
                 <li class="<?php if (($controller == 'Users' && ($action == 'trainerList' || $action == 'trainerAdd' || $action == 'trainerEdit' || $action == 'trainerView'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'trainerList']); ?>">
                        <i class="material-icons">list</i>
                        <span><?= __('Trainers') ?></span>
                    </a>
                </li>
                <?php } ?>    
                <?php if($usersdetail['users_type'] == 1 || $usersdetail['users_type'] == 2){; ?>
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
                <li class="<?php if (($controller == 'PlanSubscribers' && ($action == 'index' || $action == 'add' || $action == 'edit' || $action == 'view'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'PlanSubscribers', 'action' => 'index']); ?>">
                        <i class="material-icons">pageview</i>
                        <span><?= __('Plan Subscribe') ?></span>
                    </a>
                </li>
                <li class="<?php if (($controller == 'Payments' && ($action == 'index' || $action == 'add' || $action == 'edit' || $action == 'view'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'Payments', 'action' => 'index']); ?>">
                        <i class="material-icons">payment</i>
                        <span><?= __('Payments') ?></span>
                    </a>
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
                <?php if($usersdetail['users_type'] != 3){ ;?>
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
