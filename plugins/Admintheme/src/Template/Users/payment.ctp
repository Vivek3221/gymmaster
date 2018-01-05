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
                            <?= __('Payment Form') ?>
                        </h2>

                    </div>
                    <div class="body">
                        <div  id="hidePayment"class="form-btn text-center">

                            <button  class="btn btn-primary waves-effect" onclick="makePayment()">Make Payment</button>
                            
                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="">Later Payment</a>
                        </div>
                        <div class="" id="makepayment" hidden="">
                        <!--                            <form id="form_validation" method="POST">-->
                        <?php //echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addUserForm', 'submitButtonId'=>'addUserSubmitBtn']); ?>
                        <?= $this->Form->create($user, ['id' => 'payment','templates' => ['inputContainer' => '{{content}}']]) ?>
      
                        <div class="form-group form-float">
                            <div class="form-line">
<!--                                        <input type="text" class="form-control" name="name" required>-->
                                <?= $this->Form->control('user_type', ['class' => 'form-control', 'type' => 'select','options'=>$user_type, 'empty'=>__('Select Type')]) ?>          
                                
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
                                <?= $this->Form->control('mobile_no', ['class' => 'form-control','type'=>'text', 'label' => false]) ?> 
                                <label class="form-label">Mobile No.</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('payment', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">Payment Rs.</label>
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
                        
                         <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('password', ['class' => 'form-control', 'type' => 'password', 'label' => false,'id'=>'npassword']) ?> 
                                <label class="form-label">Password</label>
                            </div>
                        </div>
                         <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('cpassword', ['class' => 'form-control', 'type' => 'password', 'label' => false]) ?> 
                                <label class="form-label">Confirm Password</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <?= $this->Form->input('active', ['options' => $status, 'class' => 'form-control', 'empty' => __('Select Status')]); ?>
                            </div>
                        </div>
                        
                       <div class="form-btn text-center">

                            <?= $this->Form->button('Make Payment', ['class' => 'btn btn-primary waves-effect']) ?>
                           <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="">Later Payment</a>
                        </div>
                        
                        

                        <?= $this->Form->end() ?>
                    </div>      
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script type="text/javascript">
    
   function makePayment()
    {
            $('#makepayment').show();
            $('#hidePayment').hide();
    }
    
    $(document).ready(function () {
        
    
        
        
        $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD HH:mm', lang: 'fr', weekStart: 1, cancelText: 'Cancel', maxDate: new Date()});
        $('').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});
    });

</script>