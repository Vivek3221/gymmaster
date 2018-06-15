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
                            <?= __('Add Exercise Plan for User') ?>
                        </h2>

                    </div>
                    <div class="body">
                        <div  id="hidePayment"class="form-btn text-center">

                            <button  class="btn btn-primary waves-effect" onclick="makePayment()">Add Plan</button>

                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="">Add Later</a>
                        </div>
                        <div class="" id="makepayment" hidden="">
                        <!--                            <form id="form_validation" method="POST">-->
                        <?php //echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addUserForm', 'submitButtonId'=>'addUserSubmitBtn']); ?>
                        <?= $this->Form->create($user, ['enctype' => 'multipart/form-data','id' => 'payment','templates' => ['inputContainer' => '{{content}}']]) ?>

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
                                <?= $this->Form->control('plan_name', ['class' => 'form-control', 'type' => 'text','required', 'label' => false]) ?>
                                <label class="form-label">Plan Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('fee', ['class' => 'form-control', 'type' => 'number','required', 'label' => false]) ?>
                                <label class="form-label">Plan Total Fee</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('plan_expire_date', ['class' => 'form-control datetimepicker', 'type' => 'text','label' => FALSE ,'required', 'format'=>'YYYY-MM-DD H:i:s']) ?>          
                                <label class="form-label">Plan Expire Date</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('amount', ['class' => 'form-control', 'type' => 'number', 'min'=>0, 'label' => false]) ?>
                                <label class="form-label">Payment Paid.</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('payment_due_date', ['class' => 'form-control datetimepicker', 'type' => 'text', 'label' => FALSE , 'format'=>'YYYY-MM-DD H:i:s']) ?>          
                                <label class="form-label">Remaining Payment Due Date</label>
                            </div>
                        </div> 
<!--                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php // echo $this->Form->control('b_payment', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?>
                                <label class="form-label">Payment Due.</label>
                            </div>
                        </div>-->
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('mode_ofpay', ['class' => 'form-control', 'type' => 'select','empty'=>'Select Mode Of Payment','label' => 'Mode Of Payment','options'=>$getModPayment]) ?>
                            </div>
                        </div>
<!--                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('course_duration', ['class' => 'form-control', 'type' => 'select','empty'=>'Select Course Of Duration','options'=>$getPayDuration]) ?>
                            </div>
                        </div>-->
                        <?php if(empty($user['password'])) { ?>
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
                        <?php } ?>   
                         <div class="form-group form-floa">
                                                <div class="form-line image">
                                                    <?= $this->Form->control('images', ['label' => 'Cover Image', 'class' => 'form-control', 'type' => 'file', 'onchange' => "ImageFilesize();"]) ?>
                                                </div>
                                            </div>
                        <div class="form-group">
                            <div class="form-line">
                                <?= $this->Form->input('active', ['options' => $status, 'class' => 'form-control', 'empty' => __('Select Status')]); ?>
                            </div>
                        </div>

                       <div class="form-btn text-center">

                            <?= $this->Form->button('Add Plan', ['class' => 'btn btn-primary waves-effect']) ?>
                           <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="">Add Later</a>
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
