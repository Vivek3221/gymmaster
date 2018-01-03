<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
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
                               <?= __('Enquery Form') ?>
                            </h2>
                            
                        </div>
                    <div class="body">
                        <!--                            <form id="form_validation" method="POST">-->
                        <?php //echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addUserForm', 'submitButtonId'=>'addUserSubmitBtn']); ?>
                        <?= $this->Form->create($user, ['id' => 'addusers','templates' => ['inputContainer' => '{{content}}']]) ?>
      
                        <div class="form-group form-float">
                            <div class="form-line">
<!--                                        <input type="text" class="form-control" name="name" required>-->
                                <?= $this->Form->control('user_type', ['class' => 'form-control', 'type' => 'select','options'=>$user_type]) ?>          
                                
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('name', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('email', ['class' => 'form-control', 'label' => false]) ?> 
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('location', ['class' => 'form-control', 'label' => false]) ?> 
                                <label class="form-label">Address</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('mobile_no', ['class' => 'form-control','type'=>'text', 'label' => false]) ?> 
                                <label class="form-label">Mobile No.</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('emerg_no', ['class' => 'form-control','type'=>'text', 'label' => false]) ?> 
                                <label class="form-label">Emergency No.</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                               <input name="gender" type="radio" value="1" checked id="radio_4" class="with-gap">
                                                <label for="radio_4"><?= __('Male') ?></label>
                                                <input name="genderu" type="radio" value="2" id="radio_5" class="with-gap">
                                                <label for="radio_5"><?= __('Female') ?></label>
                                
                            </div>
                        </div>
                       <div class="form-group form-float">
                                    <div class="form-line">

                                        <?= $this->Form->control('dob', ['class' => 'form-control datetimepicker', 'type' => 'text', 'placeholder' => 'DOB', 'label' => FALSE ,'required', 'format'=>'YYYY-MM-DD']) ?>          

                                    </div>
                                </div> 
                        
                        
                        <?= $this->Form->button('Add User', ['class' => 'btn btn-primary waves-effect']) ?>

                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

  <script type="text/javascript">
       $(document).ready(function () {
     $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD HH:mm', lang: 'fr', weekStart: 1, cancelText: 'Cancel',maxDate : new Date()});
     $('').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });
     });
      
      </script>