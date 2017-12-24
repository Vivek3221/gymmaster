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
                               <?= __('Edit User') ?>
                            </h2>
                            
                        </div>
                    <div class="body">
                        <!--                            <form id="form_validation" method="POST">-->
                        <?php //echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addUserForm', 'submitButtonId'=>'addUserSubmitBtn']); ?>
                        <?= $this->Form->create($user, ['id' => 'editusers','templates' => ['inputContainer' => '{{content}}']]) ?>
      
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
                                <?= $this->Form->control('email', ['class' => 'form-control', 'label' => false ,'readonly']) ?> 
                                <label class="form-label">Email</label>
                            </div>
                        </div>
<!--                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('location', ['class' => 'form-control', 'label' => false]) ?> 
                                <label class="form-label">Location</label>
                            </div>
                        </div>-->
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('mobile_no', ['class' => 'form-control','type'=>'number', 'label' => false]) ?> 
                                <label class="form-label">Mobile No.</label>
                            </div>
                        </div>
<!--                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('password', ['class' => 'form-control', 'label' => false]) ?> 
                                <label class="form-label">Password</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('cpassword', ['type' => 'password', 'class' => 'form-control', 'label' => false]) ?> 
                                <label class="form-label">Conform Password</label>
                            </div>
                        </div>-->
                         <div class="form-group form-float">
                            <div class="form-line">
                        <?= $this->Form->input('active', ['empty' => __('Select status'), 'options' => $status, 'class' => 'form-control']); ?>
                         
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