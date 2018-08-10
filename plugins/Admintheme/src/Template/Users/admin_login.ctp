<!DOCTYPE html>
<html lang="en">
<head>
  <title>Athlete Monitoring Software,Fitness Testing,Athlete Management System</title>
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
     /* display: table-cell;
      vertical-align: middle;
        position: absolute;
     */   
        
        margin: 0 auto;
        margin-top: 75px;
        text-align: center;
        /*left: 66px;*/
       
        padding: 25px 40px;
        opacity: 0.9;
        color: #fff;
       
    }
    /*for Mobile*/
    .mobile-bg { 
      display: table;
    background-image: url("<?= $this->Url->image('23-min.jpg') ?>");
    height: 640px; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    }
    .mobile-bg input { 
        border: none;
        background-color: transparent;
        outline: none;
        border-bottom: 2px solid #fff;
        font-size: 16px;
        color: #fff;
        border-radious:0;
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .mobile-bg input:focus {outline:none;}
    .mobile-bg .help-inline {
        font-size: 11px;
        position: absolute;
        left: 56px;
    }
    .help-inline{
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
     @media (max-width: 345px) {     
      .login-container{left: 30px; top: -30px;}
    }
    .mt-15{margin-top: 15px}
    .f-15{font-size: 20px}
    .btn-custom {
 /*display: inline-block; */
    padding: 12px 44px;
    background-color: #ffffff;
    border: none;
    font-weight: bold;
    color: #212121;
    /* min-width: 125px; */
    font-size: 18px;
    border-radius: 100px;
    transition: box-shadow .2s, border .2s;
}
.alert.bg-pink.alert-dismissible{    
position: absolute;
    top: 67px;
    right: 284px;
}
.text-darkyellow{font-size:18px; color:#fff;}
.mb-25{margin-bottom:25px;}
.mt-25{margin-top:25px;}

.mobile-bg .alert.bg-pink.alert-dismissible {
    position: absolute;
    top: 115px;
    right: 28px;
}
  </style>
</head>
<body style="height: 100%;">

<div class="asdsadf"> 
  <div class="top-panel hidden-xs">
    <div class="container">
        <?= $flashmsg = $this->Flash->render() ?>
      <div class="col-sm-4">
        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'adminLogin']); ?>">
              <img src="<?php echo $this->Url->image('dm5.png'); ?>" alt="DM" style="width: 208px;">
            </a>
        <!-- <h1 class="heading-txt">Data Monitor</h1> -->
      </div>
      <!-- start:login page for desktop -->
      <div class="col-sm-8 text-right home-email">
        <?= $this->Form->create('Login Form', ['url' => ['controller' => 'Users', 'action' => 'login'], 'class'=>'form-inline manage-form','id' => 'adminloginform', 'novalidate' => 'novalidate']) ?>    
          <div class="form-group">
            <?= $this->Form->control('email', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Enter Email', 'label' => false, 'required'=>'required']) ?> 
          </div>
          <div class="form-group home-password">
            <?= $this->Form->control('password', ['class' => 'form-control','id'=>'pwd', 'type' => 'password', 'placeholder' => 'Enter Password', 'label' => false, 'required'=>'required']) ?> 
          </div>          
          <button class="btn btn-default" type="submit"><?= __('Sign In') ?></button>
          <div class="" style="display: inherit;margin-right: 3px;">
            <a href="<?= $this->Url->build(['action'=>'forgotPassword']) ?>" style=" color: #fff;">Forgot Password?</a>
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
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'adminLogin']); ?>">
              <img src="<?php echo $this->Url->image('dm5.png'); ?>" alt="DM" style="width: 208px;">
            </a>
              <!-- <h1 class="text-center text-whitesmoke mb-25">Data Monitor</h1> -->
          </div>
          <h3 class="text-whitesmoke">Sign In</h3>
          <?= $flashmsg ?>
          <div class="container-content">
              <?= $this->Form->create('Login Form', ['url' => ['controller' => 'Users', 'action' => 'login'], 'class'=>'margin-t','id' => 'adminloginformmobile', 'novalidate' => 'novalidate']) ?>    
                  <div class="form-group">
                      <?= $this->Form->control('email', ['id'=>'email-mobile','class' => 'form-control', 'type' => 'text', 'placeholder' => 'Enter Email', 'label' => false, 'required'=>'required']) ?> 
                  </div>
                  <div class="form-group">
                      <?= $this->Form->control('password', ['id'=>'password-mobile','class' => 'form-control','id'=>'pwd', 'type' => 'password', 'placeholder' => 'Enter Password', 'label' => false, 'required'=>'required']) ?> 
                  </div>
                  <div class="text-center  mt-25">
                    <button class="btn-custom button-l margin-b" type="submit"><?= __('Sign In') ?></button>
                  </div>
                  <div class="text-center mt-15">
                  <a class="text-darkyellow f-15" href="<?= $this->Url->build(['action'=>'forgotPassword']) ?>">Forgot your password?</a></div>
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
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <?= $this->Html->image('21-min.jpg',['alt'=>'Los Angeles','class'=>'img-responsive']) ?>
      </div>

      <div class="item">
        <?= $this->Html->image('22-min.jpg',['alt'=>'Chicago','class'=>'img-responsive']) ?>  
      </div>
    
     <!--  <div class="item">
          <?= $this->Html->image('10.jpg',['alt'=>'New york','class'=>'img-responsive']) ?>
      </div> -->

     <!--  <div class="item">
          <?= $this->Html->image('8.jpg',['alt'=>'Los Angeles','class'=>'img-responsive']) ?>
      </div> -->

      <div class="item">
        <?= $this->Html->image('23-min.jpg',['alt'=>'Chicago','class'=>'img-responsive']) ?>
      </div>
     <!--  <div class="item">
        <?= $this->Html->image('12.jpg',['alt'=>'Chicago','class'=>'img-responsive']) ?>
      </div> -->
      <div class="item">
        <?= $this->Html->image('24-min.jpg',['alt'=>'Chicago','class'=>'img-responsive']) ?>
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