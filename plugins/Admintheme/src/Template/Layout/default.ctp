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
    <title><?= __('Athlete Monitoring Software,Fitness Testing,Athlete Management System') ?></title>
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
    <?= $this->Html->css('daterangepicker.css') ?>
    <!-- Waves Effect Css -->
    <!-- Animation Css -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Custom Css -->
     <?= $this->Html->css('morris.css') ?>
     <?= $this->Html->css('style.css') ?>
     <?= $this->Html->css('bootstrap-select.min.css') ?>
<!--  table css -->
 <?= $this->Html->css('dataTables.bootstrap.css') ?>
 <?= $this->Html->css('datatables_custom_modern.css') ?>
    <!-- Albuzzer Themes. You can choose a theme from css/themes instead of get all themes -->
     <?= $this->Html->css('themes/all-themes.css') ?>
     <?php echo $this->Html->css('datePicker.css') ?>
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

        /* ===== GLOBAL SELECT2 MODERN STYLE — Applied across entire system ===== */
        .select2-container--default .select2-selection--single {
            height: 44px !important;
            border: 1.5px solid #cbd5e1 !important;
            border-radius: 8px !important;
            background-color: #f8fafc !important;
            display: flex !important;
            align-items: center !important;
            transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 42px !important;
            padding-left: 14px !important;
            color: #1e293b !important;
            font-size: 14px !important;
            font-weight: 400 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 42px !important;
            right: 10px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #94a3b8 !important;
        }
        .select2-container--default.select2-container--open .select2-selection--single,
        .select2-container--default .select2-selection--single:focus,
        .select2-container--focus .select2-selection--single {
            border-color: #ff9800 !important;
            background-color: #ffffff !important;
            box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
            outline: none !important;
        }
        .select2-dropdown {
            border: 1.5px solid #ff9800 !important;
            border-radius: 8px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12) !important;
            overflow: hidden !important;
            z-index: 99999 !important;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1.5px solid #cbd5e1 !important;
            border-radius: 6px !important;
            padding: 8px 12px !important;
            font-size: 13.5px !important;
            outline: none !important;
            width: 100% !important;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            border-color: #ff9800 !important;
            box-shadow: 0 0 0 2px rgba(255, 152, 0, 0.12) !important;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected],
        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #ff9800 !important;
            color: #ffffff !important;
        }
        .select2-container--default .select2-results__option {
            padding: 9px 14px !important;
            font-size: 13.5px !important;
            color: #334155 !important;
        }
        .select2-container--default .select2-results__option[aria-selected="true"] {
            background-color: #fff3e0 !important;
            color: #e65100 !important;
            font-weight: 600 !important;
        }
        .select2-search--dropdown {
            padding: 8px !important;
            border-bottom: 1px solid #f1f5f9 !important;
        }
        .select2-results__options {
            max-height: 220px !important;
        }

        /* ── Modern Plan Summary Card ── */
        .plan-summary-card {
            background: #ffffff !important;
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 12px !important;
            padding: 16px 20px !important;
            margin: 10px 0 16px !important;
            box-shadow: 0 4px 16px rgba(0,0,0,0.04) !important;
            box-sizing: border-box !important;
            width: 100% !important;
        }
        .psc-top {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            margin-bottom: 14px !important;
            padding-bottom: 10px !important;
            border-bottom: 1px solid #f1f5f9 !important;
            flex-wrap: wrap !important;
            gap: 8px !important;
        }
        .psc-title {
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            font-size: 13.5px !important;
            font-weight: 700 !important;
            color: #1e293b !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }
        .psc-badge {
            display: inline-flex !important;
            align-items: center !important;
            gap: 5px !important;
            padding: 4px 12px !important;
            border-radius: 20px !important;
            font-size: 12px !important;
            font-weight: 700 !important;
        }
        .psc-badge.paid {
            background: #dcfce7 !important;
            color: #15803d !important;
            border: 1px solid #bbf7d0 !important;
        }
        .psc-badge.pending {
            background: #fff7ed !important;
            color: #c2410c !important;
            border: 1px solid #fed7aa !important;
        }
        .psc-grid {
            display: grid !important;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)) !important;
            gap: 12px 18px !important;
        }
        .psc-item {
            display: flex !important;
            flex-direction: column !important;
            gap: 3px !important;
        }
        .psc-label {
            font-size: 11px !important;
            font-weight: 700 !important;
            color: #64748b !important;
            text-transform: uppercase !important;
            letter-spacing: 0.4px !important;
        }
        .psc-val {
            font-size: 15px !important;
            font-weight: 800 !important;
            color: #1e293b !important;
        }
        .psc-val.date {
            font-size: 13.5px !important;
            font-weight: 600 !important;
            color: #334155 !important;
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
    <?php }  ?>
        <!-- <body  style="background-image: url(<?= $this->Url->image('runners-635906_1920.jpg') ?>)"> -->
    <?= $this->fetch('content') ?>
    <!-- Bootstrap Core Js -->
    <?= $this->Html->script('bootstrap.js') ?>
    <?php // echo  $this->Html->script('ckeditor/ckeditor.js') ?>
    <!-- Select Plugin Js -->
    <?= $this->Html->script('autosize.js') ?>
    <?= $this->Html->script('moment.js') ?>
    <?= $this->Html->script('daterangepicker.js') ?>
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
    <?= $this->Html->script('demo.js') ?>
    <?php echo $this->Html->script('date.js') ?>
    <?php echo $this->Html->script('jquery_002.js') ?>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    $(document).ready(function() {
        if (typeof flatpickr !== 'undefined') {
            flatpickr('.datetimepicker, .datepicker, .plan-datepicker, .flatpickr-date, .datepicker-filter', {
                dateFormat: 'Y-m-d',
                allowInput: true,
                monthSelectorType: 'dropdown'
            });
        }
        $(document).on('click', '.flatpickr-prev-month', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var cal = $(this).closest('.flatpickr-calendar')[0];
            if (cal && cal._flatpickr) {
                cal._flatpickr.changeMonth(-1);
            }
        });
        $(document).on('click', '.flatpickr-next-month', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var cal = $(this).closest('.flatpickr-calendar')[0];
            if (cal && cal._flatpickr) {
                cal._flatpickr.changeMonth(1);
            }
        });
    });
    </script>
    <?php //echo $this->Html->script('pages/index.js') ?>
    <!-- Demo Js -->
<!--    <script src="js/demo.js"></script>-->
    <script>
        $('#payment-due-date').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD HH:mm', minDate : new Date() });
        $('#plan-expire-date').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD HH:mm', minDate : new Date() });
        $('.select2').select2({ width: '100%' });
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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-133201715-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-133201715-1');
</script>
    <?php } ?>
</body>
</html>
