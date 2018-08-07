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
        margin: 0 auto;
        margin-top: 160px;
        text-align: center;
        background-color: #100f11;
        padding: 25px 40px;
        opacity: 0.9;
        color: #fff;
        border-top: 2px solid #f3c624;
    }
    /*for Mobile*/
    .mobile-bg { 
    background-image: url("<?= $this->Url->image('24-min.jpg') ?>");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    height: 700px;
    }
    /*End*/
    @media (max-width: 466px) {     
      .heading-txt{text-align: center;}
    }
     @media (max-width: 312px) {     
      .login-container{left: 20px; top: -30px;}
    }
    /********************************/
    .mt-15{margin-top: 15px;}
        /*.payment-view-bg{margin-top: 160px}*/
        .payment-card-content{padding:25px 15px;}
        .no-padding{padding: 0;}
        .payment-card-content .btn-card{
            color: #000!important;
            background-color: #fff;
            padding: 8px 12px;
            border: 0 solid;
            box-shadow: inset 0 0 20px rgba(255, 255, 255, 0);
            outline: 1px solid;
            outline-color: rgba(255, 255, 255, 0.5);
            outline-offset: 0px;
            text-shadow: none;
            transition: all 1250ms cubic-bezier(0.19, 1, 0.22, 1);
        }
        .help-inline {
        font-size: 11px;
    }
        .payment-card-content .btn-card:hover{
            border: 1px solid;
            box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.5), 0 0 20px rgba(255, 255, 255, 0.2);
            outline-color: rgba(255, 255, 255, 0);
            outline-offset: 15px;
            text-shadow: 1px 1px 2px #427388;
        }
        /* form starting stylings ------------------------------- */
        .payment-card-content .group  { 
          position:relative; 
          margin-bottom:25px; 
        }
        .payment-card-content input{
          background-color: transparent;
          font-size:22px;
          padding:10px 10px 0px 5px;
          display:block;
          width:100%;
          color: #fff;
          border:none;
          border-bottom:1px solid #fff;
          outline: none;
        }
        .payment-card-content input:focus { outline:none; }

        /* LABEL ======================================= */
        .payment-card-content label  {
          color:#ddd; 
          font-size:22px;
          font-weight:normal;
          position:absolute;
          pointer-events:none;
          left:5px;
          top:0px;
          transition:0.2s ease all; 
          -moz-transition:0.2s ease all; 
          -webkit-transition:0.2s ease all;
        }

        /* active state */
        .payment-card-content input:focus ~ label, input:valid ~ label      {
          top:-12px;
          font-size:16px;
          color:#fff;
        }

        /* BOTTOM BARS ================================= */
        .payment-card-content .bar  { position:relative; display:block; width:100%; }
        .payment-card-content .bar:before, .bar:after   {
          content:'';
          height:1px; 
          width:0;
          bottom:1px; 
          position:absolute;
          background:#ddd; 
          transition:0.2s ease all; 
          -moz-transition:0.2s ease all; 
          -webkit-transition:0.2s ease all;
        }
        .payment-card-content .bar:before {
          left:50%;
        }
        .payment-card-content .bar:after {
          right:50%; 
        }

        /* active state */
        .payment-card-content input:focus ~ .bar:before, input:focus ~ .bar:after {
          width:50%;
        }

        /* HIGHLIGHTER ================================== */
        .payment-card-content .highlight {
          position:absolute;
          height:60%; 
          width:100px; 
          top:25%; 
          left:0;
          pointer-events:none;
          opacity:0.5;
        }

        /* active state */
        .payment-card-content input:focus ~ .highlight {
          -webkit-animation:inputHighlighter 0.3s ease;
          -moz-animation:inputHighlighter 0.3s ease;
          animation:inputHighlighter 0.3s ease;
        }

        /* ANIMATIONS ================ */
        @-webkit-keyframes inputHighlighter {
            from { background:#5264AE; }
          to    { width:0; background:transparent; }
        }
        @-moz-keyframes inputHighlighter {
            from { background:#5264AE; }
          to    { width:0; background:transparent; }
        }
        @keyframes inputHighlighter {
            from { background:#5264AE; }
          to    { width:0; background:transparent; }
        }
    /*******************************/
    .btn-custom {
    /* display: inline-block; */
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
  </style>
</head>
<body style="height: 100%;">

<div class="asdsadf"> 
  <div class="top-panel">
    <div class="container">
        <?= $this->Flash->render() ?>
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
    <div class="text-center" style="margin-top: 100px;">
       <div class="top-form">
          <div style="margin-bottom: 60px;"> <img src="img/logo.png" alt="" title=""></div>          
          <div class="container-content payment-view-bg">
            <h3 style="font-size: 40px; color: #fff;">Sign In</h3>
              <?= $this->Form->create('Login Form', ['url' => ['controller' => 'Users', 'action' => 'login'], 'class'=>'margin-t payment-card-content','id' => 'adminloginformmobile', 'novalidate' => 'novalidate']) ?>    
                  <div class="group">
                      <?= $this->Form->input('email', ['id'=>'email-mobile','class' => 'form-control', 'type' => 'text', 'placeholder' => '', 'label' => false, 'required'=>'required']) ?>
                      <span class="highlight"></span>
                      <span class="bar"></span>
                      <label>Email Id</label> 
                  </div>
                  <div class="group">
                      <?= $this->Form->input('password', ['id'=>'password-mobile','class' => 'form-control','id'=>'pwd', 'type' => 'password', 'placeholder' => '', 'label' => false, 'required'=>'required']) ?> 
                     <span class="highlight"></span>
                     <span class="bar"></span>
                    <label>Password</label>
                  </div>
                  <div class="text-right" style="margin-bottom: 20px;">
                  <a href="<?= $this->Url->build(['action'=>'forgotPassword']) ?>" style="font-size: 18px; color: #fff;">Forgot your password?</a>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn-custom">Sign In</button>
                </div>
               <?= $this->Form->end() ?>
          </div>
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