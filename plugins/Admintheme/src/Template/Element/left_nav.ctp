<?php
$controller = $this->request['controller'];
$action = $this->request['action'];
?>



<section>
    <!-- Left Sidebar -->
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
                        <li><a href=""><i class="material-icons">input</i><?= __('Profile') ?></a></li>
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
                 <li class="<?php if (($controller == 'Users' && ($action == 'index' || $action == 'add' || $action == 'edit' || $action == 'view'|| $action == 'adminLogin'|| $action == 'login'|| $action == 'logoutqq' || $action == 'payment'))){echo "active";}?>">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>">
                        <i class="material-icons">list</i>
                        <span><?= __('Users') ?></span>
                    </a>
                </li>
             <li class="<?php if (($controller == 'Bodies') || ($controller == 'Exercises') || ($controller == 'FitnessMeserments')){echo "active";}?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">view_list</i>
                        <span><?= __('Workout Directry') ?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?php if ($controller == 'Bodies' && ($action == 'index'|| $action == 'add' || $action == 'edit' || $action == 'view')) {echo 'active';} ?>">
                        <?= $this->Html->link(__('Body Parts'), ['controller' => 'Bodies', 'action' => 'index']) ?>
                        </li>  
                   <li class="<?php if ($controller == 'Exercises' && ($action == 'index'|| $action == 'add' || $action == 'edit' || $action == 'view')) {echo 'active';} ?>">
                        <?= $this->Html->link(__('Exercise List'), ['controller' => 'Exercises', 'action' => 'index']) ?>
                   </li>
                   <li class="<?php if ($controller == 'FitnessMeserments' && ($action == 'index'|| $action == 'add' || $action == 'edit' || $action == 'view')) {echo 'active';} ?>">
                        <?= $this->Html->link(__('Body Meserment List'), ['controller' => 'FitnessMeserments', 'action' => 'index']) ?>
                   </li>
                   <li class="<?php if ($controller == 'FitnessType' && ($action == 'index'|| $action == 'add' || $action == 'edit' || $action == 'view')) {echo 'active';} ?>">
                        <?= $this->Html->link(__('FitnessType List'), ['controller' => 'FitnessType', 'action' => 'index']) ?>
                   </li>
                    </ul>
                </li>   
              
            </ul>

        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2018 <a href="javascript:void(0);"><?= __('Gym Admin') ?></a>.
            </div>
            <div class="version">
                <b><?= __('Version') ?>: </b> 1.0.4
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>
