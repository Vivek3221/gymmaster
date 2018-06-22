<?php 
$session = $this->Common->getSession();
//pr($session);exit;
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
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                 <a href="" class="navbar-brand">
                <?= __('Welcome To Data Monitor Admin') ?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>"><i class="material-icons">power_settings_new <title>Add Duplicate</title></i></a></li>
                   
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
                                                <h4><?= $session . ' Users' ?></h4>
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