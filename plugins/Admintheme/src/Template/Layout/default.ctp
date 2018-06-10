<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

//$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?= __('Welcome to datamonitoring') ?></title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <?= $this->Html->css('bootstrap.css') ?>
    
    <?= $this->Html->css('datetimepicker.css') ?>
    <?= $this->Html->css('waitMe.min.css') ?>
    <?= $this->Html->css('bootstrap-material-datetimepicker.css') ?>
    <!-- Waves Effect Css -->
    <!-- Animation Css -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <!-- Custom Css -->
     <?= $this->Html->css('morris.css') ?>
     <?= $this->Html->css('style.css') ?>
     <?= $this->Html->css('bootstrap-select.min.css') ?>
<!--  table css -->
 <?= $this->Html->css('dataTables.bootstrap.css') ?>
    <!-- Albuzzer Themes. You can choose a theme from css/themes instead of get all themes -->
     <?= $this->Html->css('themes/all-themes.css') ?>
    <style>
        .addLangDv{ cursor: pointer; text-align: right;    margin-right: 23px;}
        .addLangDv span{ float: right; margin-top: 2px; margin-bottom: 2px; }
        .addLangDv:hover{ color: #000;   }
        .tooltipHelp{ color: #333; }
        .tooltipHelp:hover{ color: #000; }
        .MoreLang .LangContent {
            display: none;
                float: left;
            width: 100%;
        }
        .LangContent .input{ margin-top: 5px; }
        .tooltipHelpDv{  margin-top: 2px;}
        .tooltipHelpDv .popover{ width: 210px; }
        
        .fixed-action-btn{
            position: fixed;
    right: 23px;
    bottom: 23px;
    padding-top: 15px;
    margin-bottom: 0;
    z-index: 998;
        }
        .btn-floating{
             border-radius: 100%;
             padding: 14px 17px;
        }
    </style>
  <?= $this->Html->script('jquery.min.js') ?>
</head>

    <?php if ($this->request->action != 'adminLogin' && $this->request->action != 'resetPassword') { ?>
        <body>
    <?php
     echo $this->element('header');
     echo $this->element('left_nav');
    ?>
    <?php } else { ?>
        <body  style="background-image: url(<?= $this->Url->image('runners-635906_1920.jpg') ?>)">
    <?php } ?>
    <?= $this->fetch('content') ?>
    <!-- Bootstrap Core Js -->
    <?= $this->Html->script('bootstrap.js') ?>
    <?php // echo  $this->Html->script('ckeditor/ckeditor.js') ?>
    <!-- Select Plugin Js -->
    <?= $this->Html->script('autosize.js') ?>
    <?= $this->Html->script('moment.js') ?>
    <?php // echo $this->Html->script('bootstrap-datetimepicker.js') ?>
    <?= $this->Html->script('bootstrap-material-datetimepicker.js') ?>
    
    
    <?= $this->Html->script('bootstrap-select.js') ?>
    <!-- Slimscroll Plugin Js -->
   
    <?= $this->Html->script('jquery.slimscroll.js') ?>

    <!-- Waves Effect Plugin Js -->
    
    <?= $this->Html->script('waves.js') ?>
    <?= $this->Html->script('jquery.countTo.js') ?>
    <?= $this->Html->script('raphael.min.js') ?>
    <?= $this->Html->script('morris.js') ?>
    <?= $this->Html->script('jquery.sparkline.js') ?>
    
   
    <?= $this->Html->script('tableEdit-0.1.js') ?>
    <?= $this->Html->script('form-validation.js') ?>

    <!-- Jquery CountTo Plugin Js -->
   
   <?= $this->Html->script('waitMe.min.js') ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- Sparkline Chart Plugin Js -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>
    <!--  table js -->
      <?= $this->Html->script('jquery.dataTables.js') ?>
      <?= $this->Html->script('dataTables.bootstrap.js') ?>
      <?= $this->Html->script('dataTables.buttons.min.js') ?>
      <?= $this->Html->script('buttons.flash.min.js') ?>
      <?= $this->Html->script('buttons.html5.min.js') ?>
      <?= $this->Html->script('buttons.print.min.js') ?>
    <!-- Custom Js -->
    <?= $this->Html->script('pages/tables/jquery-datatable.js') ?>
    <?= $this->Html->script('admin.js') ?>
     <?= $this->Html->script('basic-form-elements.js') ?>
    <?= $this->Html->script('demo.js') ?>
    <?php //echo $this->Html->script('pages/index.js') ?>
    <!-- Demo Js -->
<!--    <script src="js/demo.js"></script>-->
    <script>
        $('.select2').select2();
        $('#forgetPasswordDiv').hide();    
        $("#showForgetForm").click(function(){
            $('#forgetPasswordDiv').show();
            $('#loginDiv').hide();
        });
        $("#showLoginForm").click(function(){
            $('#loginDiv').show();
            $('#forgetPasswordDiv').hide();
        });
        $("#forgetPasswordBtn").click(function(){
            var formId = '#forgetPasswordForm';
            var errorDiv = $("#forgetPasswordDiv .customerror");
            var btn = $("#forgetPasswordBtn");
            if ($(formId).valid()) {
                var urllink = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'forgetPassword']) ?>';
                btn.attr("disabled", "disabled");
                var postdata = $(formId).serialize();
                errorDiv.css("display", "none");
                $.ajax({
                    url: urllink,
                    type: 'POST',
                    data: postdata,
                    success: function (data) {
                        var myjson = JSON.parse(data);
                        if (myjson.msg_type === 'fail') {
                            errorDiv.html('<span style="color:red">'+myjson.msg+'</span>');
                        } else if (myjson.msg_type === 'success') {
                            errorDiv.html('<span style="color:green">'+myjson.msg+'</span>');
                            $('#forget-email').val('');
                        }
                        errorDiv.css("display", "block");
                        btn.removeAttr("disabled");
                    },
                    error: function () {

                    }
                });
            }
            return false;
        });
    </script>   
    <footer>
    </footer>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <?php if($this->request->env('HTTP_HOST')=='datamonitering.com' || $this->request->env('HTTP_HOST')=='datamonitering.com'){ ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117829826-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-117829826-1');
  
</script>
    <?php } ?>
</body>
</html>
