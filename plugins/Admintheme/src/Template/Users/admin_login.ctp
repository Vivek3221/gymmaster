<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data Monitor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  
  <style type="text/css">
    .top-panel{
          position: absolute;
          top: 0;
          color: #fff;
          left: 0;
          z-index: 1;
          height: 80px;
          background-color: rgba(0, 0, 0, 0.5);
          width: 100%;
      }
      .manage-form{padding: 14px 0;}
      /* Login & Register Pages*/

    .login-container {
      display: table-cell;
      vertical-align: middle;
        position: absolute;
        vertical-align: middle;
        z-index: 10000;
        margin: 0 auto;
        margin-top: 160px;
        text-align: center;
        left: 66px;
        background-color: #100f11;
        padding: 25px 40px;
        opacity: 0.9;
        color: #fff;
        border-top: 2px solid #f3c624;
    }
    /*for Mobile*/
    .mobile-bg { 
      display: table;
    background-image: url("<?= $this->Url->image('9.jpg') ?>");
    height: 728px; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    }
    .help-inline {
        font-size: 11px;
    }
    .home-email .help-inline {
        position: absolute;
        top: 51px;
        left: 277px;  
        font-size: 11px;
    }
    .home-password .help-inline {
        position: absolute;
        top: 51px;
        left: 479px;  
        font-size: 11px;
    }
    /*End*/
    @media (max-width: 466px) {     
      .heading-txt{text-align: center;}
    }
     @media (max-width: 312px) {     
      .login-container{left: 20px; top: -30px;}
    }

  </style>
</head>
<body style="height: 100%;">

<div class="asdsadf"> 
  <div class="top-panel">
    <div class="container">
      <div class="col-sm-4">
        <h1 class="heading-txt">Data Monitor</h1>
      </div>
      <!-- start:login page for desktop -->
      <div class="col-sm-8 text-right home-email hidden-xs">
        <?= $this->Form->create('Login Form', ['url' => ['controller' => 'Users', 'action' => 'login'], 'class'=>'form-inline manage-form','id' => 'adminloginform', 'novalidate' => 'novalidate']) ?>    
          <div class="form-group">
            <?= $this->Form->control('email', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Enter Email', 'label' => false, 'required'=>'required']) ?> 
          </div>
          <div class="form-group home-password">
            <?= $this->Form->control('password', ['class' => 'form-control','id'=>'pwd', 'type' => 'password', 'placeholder' => 'Enter Password', 'label' => false, 'required'=>'required']) ?> 
          </div>          
          <button class="btn btn-default" type="submit"><?= __('Submit') ?></button>
          <div class="" style="display: inherit;margin-right: 3px;">
            <a href="#" style=" color: #fff;">Forget Password</a>
          </div>
        <?= $this->Form->end() ?>
      </div>
      <!-- End login desktop -->
    </div>
  </div>
  <!-- Start login page for mobile -->
  <div class="col-xs-12 mobile-bg hidden-sm hidden-lg hidden-md">
    <div class="text-center">
       <div class="login-container">
          <div>
              <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
          </div>
          <h3 class="text-whitesmoke">Sign In</h3>
          <div class="container-content">
              <?= $this->Form->create('Login Form', ['url' => ['controller' => 'Users', 'action' => 'login'], 'class'=>'margin-t','id' => 'adminloginformmobile', 'novalidate' => 'novalidate']) ?>    
                  <div class="form-group">
                      <?= $this->Form->control('email', ['id'=>'email-mobile','class' => 'form-control', 'type' => 'text', 'placeholder' => 'Enter Email', 'label' => false, 'required'=>'required']) ?> 
                  </div>
                  <div class="form-group">
                      <?= $this->Form->control('password', ['id'=>'password-mobile','class' => 'form-control','id'=>'pwd', 'type' => 'password', 'placeholder' => 'Enter Password', 'label' => false, 'required'=>'required']) ?> 
                  </div>
                  <div class="text-center">
                    <button class="btn btn-primary button-l margin-b" type="submit"><?= __('Sign In') ?></button>
                  </div>
                  <div class="text-center"><a class="text-darkyellow" href="#"><small>Forgot your password?</small></a></div>
              <?= $this->Form->end() ?>
          </div>
      </div>
    </div>
  </div>
  <!-- End login page for mobile -->
  <div id="myCarousel" class="carousel slide hidden-xs" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <?= $this->Html->image('11.jpg',['alt'=>'Los Angeles','class'=>'img-responsive']) ?>
      </div>

      <div class="item">
        <?= $this->Html->image('9.jpg',['alt'=>'Chicago','class'=>'img-responsive']) ?>  
      </div>
    
      <div class="item">
          <?= $this->Html->image('10.jpg',['alt'=>'New york','class'=>'img-responsive']) ?>
      </div>

      <div class="item">
          <?= $this->Html->image('8.jpg',['alt'=>'Los Angeles','class'=>'img-responsive']) ?>
      </div>

      <div class="item">
        <?= $this->Html->image('6.jpg',['alt'=>'Chicago','class'=>'img-responsive']) ?>
      </div>
      <div class="item">
        <?= $this->Html->image('12.jpg',['alt'=>'Chicago','class'=>'img-responsive']) ?>
      </div>
      <div class="item">
        <?= $this->Html->image('5.jpg',['alt'=>'Chicago','class'=>'img-responsive']) ?>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- Sparkline Chart Plugin Js -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>
     <?= $this->Html->script('form-validation.js') ?>
</body>
</html>

<!--<div class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Data Monitor</a>
            <?= $this->Flash->render() ?>
        </div>
        <div class="card login-back">
             start login form 
            <div class="body" id="loginDiv">
                <?= $this->Form->create('Login Form', ['url' => ['controller' => 'Users', 'action' => 'login'], 'id' => 'adminloginform', 'novalidate' => 'novalidate']) ?>
                <div class="msg">Sign in to start your session</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <?= $this->Form->control('email', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Enter email id', 'label' => false]) ?> 
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <?= $this->Form->control('password', ['class' => 'form-control', 'type' => 'password', 'placeholder' => 'Password', 'label' => false]) ?> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit"><?= __('SIGN IN') ?></button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <div>Forgot Password? <a href="javascript:void()" id="showForgetForm">Click Here</a></div>
            </div>
             end login form 
             start forgot password form 
            <div class="body" id="forgetPasswordDiv">
                <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login'], 'id' => 'forgetPasswordForm', 'novalidate' => 'novalidate']) ?>
                <div class="msg">Enter your registered email Id.</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <?= $this->Form->control('email', ['id'=>'forget-email','class' => 'form-control', 'type' => 'text', 'placeholder' => 'Enter email id', 'label' => false]) ?> 
                    </div>
                </div>
                <div class="customerror"></div>
                <div class="row">
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" id="forgetPasswordBtn" type="button"><?= __('Send Email') ?></button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <div>Go back to <a href="javascript:void()" id="showLoginForm">Sign in</a></div>
            </div>
             end forgot password form 
        </div>
    </div>
</div>-->