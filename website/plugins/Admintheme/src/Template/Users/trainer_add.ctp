<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
//pr($users_type); die;
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
                               <?= __('Add Trainer') ?>
                            </h2>
                            
                        </div>
                    <div class="body">
                        <?= $this->Form->create($user, ['id' => 'payment','templates' => ['inputContainer' => '{{content}}']]) ?>
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
                               <input type="radio" name="gender" id="a"  value="1"class="indual with-gap" > <label for="a"><?= __('Male') ?></label>
                               <input type="radio" name="gender" id="b" value="2" class="company with-gap"> <label for="b"><?= __('Female') ?></label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('dob', ['class' => 'form-control datetimepicker', 'type' => 'text', 'placeholder' => 'DOB', 'label' => FALSE ,'required', 'format'=>'YYYY-MM-DD']) ?>          
                            </div>
                        </div> 
                            <div class="form-group form-float">
                               <div class="form-line">
                                   <?= $this->Form->control('password', ['class' => 'form-control', 'type' => 'password', 'label' => false,'id'=>'npassword']) ?>
                                   <label class="form-label">Password</label>
                               </div>
                               <small class="text-muted"> *Enter password 6-16 alphanumeric & one special character.</small>
                            </div>
                            <div class="form-group form-float">
                               <div class="form-line">
                                   <?= $this->Form->control('cpassword', ['class' => 'form-control', 'type' => 'password', 'label' => false]) ?>
                                   <label class="form-label">Confirm Password</label>
                               </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Status</label>
                                    <?= $this->Form->input('active', ['options' => $status, 'class' => 'form-control', 'empty' => __('Select Status'), 'label' => false]); ?>
                                </div>
                            </div>
                        <?= $this->Form->button('Add Trainer', ['class' => 'btn btn-primary waves-effect']) ?>

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
      
      </script>