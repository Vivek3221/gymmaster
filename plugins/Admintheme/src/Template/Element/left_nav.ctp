<?php
$controller = $this->request['controller'];
$action = $this->request['action'];
?>



<section>
     <!--Left Sidebar-->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
<!--            <div class="image">
            </div>-->
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $usersdetail['users_name']; ?></div>
                <div class="email">  <div class="email"><?php echo $usersdetail['users_email']; ?></div></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li role="seperator" class="divider"></li>
                        <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>"><i class="material-icons">input</i><?= __('Sign Out') ?></a></li>
                    </ul>
                </div>
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
<!--                        <li class="<?php if ($controller == 'Bodies' && ($action == 'index'|| $action == 'add' || $action == 'edit' || $action == 'view')) {echo 'active';} ?>">
                        <?= $this->Html->link(__('Body Parts'), ['controller' => 'Bodies', 'action' => 'index']) ?>
                        </li>
                   <li class="<?php if ($controller == 'Exercises' && ($action == 'index'|| $action == 'add' || $action == 'edit' || $action == 'view')) {echo 'active';} ?>">
                        <?= $this->Html->link(__('Exercise List'), ['controller' => 'Exercises', 'action' => 'index']) ?>
                   </li>-->
                   <?php if($usersdetail['users_type'] == 1 || $usersdetail['users_type'] == 2){; ?>
                   <li class="<?php if ($controller == 'DietDirectories' && ($action == 'index'|| $action == 'add' || $action == 'edit' || $action == 'view')) {echo 'active';} ?>">
                        <?= $this->Html->link(__('Diet Directories'), ['controller' => 'DietDirectories', 'action' => 'index']) ?>
                   </li>
                  <?php } ?>
                   <li class="<?php if ($controller == 'Diets' && ($action == 'index'|| $action == 'add' || $action == 'edit' || $action == 'view')) {echo 'active';} ?>">
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
                &copy; 2018 <a href="javascript:void(0);"><?= __('Data monitor admin') ?></a>.
            </div>
            <div class="version">
                <b><?= __('Version') ?>: </b> 1.0.4
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    
    <!-- #END# Right Sidebar -->
</section>
