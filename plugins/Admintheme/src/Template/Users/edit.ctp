<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
$getModPayment = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();


?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">

        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <?= $this->Flash->render() ?>
                <div class="card">
                   <div class="header">
                            <h2>
                               <?= __('Edit User') ?>
                            </h2>
                            
                        </div>
                    <div class="body">
                        <!--                            <form id="form_validation" method="POST">-->
                        <?php //echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addUserForm', 'submitButtonId'=>'addUserSubmitBtn']); ?>
                        <?= $this->Form->create($user, ['enctype' => 'multipart/form-data','id' => 'editusers','templates' => ['inputContainer' => '{{content}}']]) ?>
      <?php  if(isset($users_type) && ($users_type == 1))
                    {?>
                        <div class="form-group form-float">
                            <div class="form-line">
<!--                                        <input type="text" class="form-control" name="name" required>-->
                                <?= $this->Form->control('user_type', ['class' => 'form-control', 'type' => 'select', 'empty'=>__('Select Type'),'options'=>$user_type]) ?>          
                                
                            </div>
                        </div>
                    <?php } ?>
                        
                            <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('name', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">Name</label>
                            </div>
                        </div>
                        
                        
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('email', ['class' => 'form-control', 'label' => false ,'readonly']) ?> 
                                <label class="form-label">Email</label>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('mobile_no', ['class' => 'form-control','type'=>'number', 'label' => false]) ?> 
                                <label class="form-label">Mobile No.</label>
                            </div>
                        </div>
                        
                        <?php
                        if(!empty($user->payment))
                        {?>
                        
                          <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('payment', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">Payment Rs.</label>
                            </div>
                        </div>
                          <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('b_payment', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">Payment Due.</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
<!--                                        <input type="text" class="form-control" name="name" required>-->
                                <?= $this->Form->control('mode_ofpay', ['class' => 'form-control', 'type' => 'select','empty'=>'Select Mode Of Payment','options'=>$getModPayment]) ?>          
                                
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
<!--                                        <input type="text" class="form-control" name="name" required>-->
                                <?= $this->Form->control('course_duration', ['class' => 'form-control', 'type' => 'select','empty'=>'Select Course Of Duration','options'=>$getPayDuration]) ?>          
                                
                            </div>
                        </div>
                        <?php } ?>
                        
                        <div class="form-group form-floa">
                                                <div class="form-line image">
                                                    <?= $this->Form->control('images', ['label' => 'Cover Image', 'class' => 'form-control', 'type' => 'file', 'onchange' => "ImageFilesize();"]) ?>            
                                                </div>
                                            </div>
                        <?php
                        if(!empty($user->photo))
                        {?>
                          <div class="add-pic">
                                   <?php $cover = '/img/' .$user->photo;
                        if (strpos($user->photo, 'http') !== false) {
                        $cover = $user->photo;
                    }?>
                                    <?= $this->Html->image($cover, ['class' => 'add-img', 'alt' => 'related-news', 'accept' => 'image/*','width' => 300, 'height' => 150]); ?>
                                </div>
                        <?php } ?>
                        
                            <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php
                                        $dob1 = $user->dob;
                                        //pr($dob1);
                                    $dob  =   date_format($dob1,"Y-m-d");
                                    //pr($dob); 
                                        ?>

                                        <?= $this->Form->control('dob', ['class' => 'form-control datetimepicker', 'type' => 'text', 'placeholder' => 'DOB','value' => $dob, 'label' => FALSE ,'required']) ?>          

                                    </div>
                                </div> 

                         <div class="form-group form-float">
                            <div class="form-line">
                        <?= $this->Form->input('active', ['empty' => __('Select status'), 'options' => $status, 'class' => 'form-control']); ?>
                         
                    </div>
                        </div>
                        <?= $this->Form->button('Edit User', ['class' => 'btn btn-primary waves-effect']) ?>

                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<script type="text/javascript">
    
     $(document).ready(function () {
     $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD', lang: 'fr', weekStart: 1, cancelText: 'Cancel',maxDate : new Date(),time:'false'});
     $('').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });
     });
    
    
    function ImageFilesize() {
      
        var Extension = '';
        if (window.ActiveXObject) {
            var fso = new ActiveXObject("Scripting.FileSystemObject");
            var filepath = document.getElementById('images').value;
            var thefile = fso.getFile(filepath);
            var sizeinbytes = thefile.size;
        } else {
            var filepath = document.getElementById('images').value;
            var Extension = filepath.substring(filepath.lastIndexOf('.') + 1).toLowerCase();
            var sizeinbytes = document.getElementById('images').files[0].size;
        }
        var size = sizeinbytes / 1024 / 1024;
        if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
            if (size <= 2) {
            } else {
                alert('Allowed maximum image sizes is 2MB.');
                document.getElementById('images').value = '';
            }
        } else {
            alert('Allowed only .gif,.png,.bmp,.jpg,.jpeg image files.');
            document.getElementById('images').value = '';
        }

    }
    </script>