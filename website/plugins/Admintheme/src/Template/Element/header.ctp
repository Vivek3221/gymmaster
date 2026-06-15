<?php 
$session = $this->Common->getSession();
$birthday = $this->Common->getBirthday();
$paymantexp = $this->Common->getPaymentDue();
$planexpire = $this->Common->getPlanexpire();
// pr($paymantexp);exit;
?>
<body class="theme-red">
    <!-- Page Loader -->
   <!--  <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div> -->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar change-color">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                 <a href="" class="navbar-brand">
                <?= __('Data Monitor') ?></a>
                <a class="hidden-md hidden-lg logout-icon" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>"><i class="material-icons" style="vertical-align: middle;">power_settings_new</i></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                     <li>
                        <a class="hidden-xs" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>"><i class="material-icons" title="Log Out">power_settings_new</i>

                        </a>
                    </li>

                   
</ul>
<!--            </div>
          <div class="collapse navbar-collapse" id="navbar-collapse">-->
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
                </ul>
            </div>
        </div>
    </nav>