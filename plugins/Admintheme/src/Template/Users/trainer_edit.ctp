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
                               <?= __('Edit Trainer') ?>
                            </h2>
                            
                        </div>
                    <div class="body">
                        <?= $this->Form->create($user, ['enctype' => 'multipart/form-data','id' => 'editusers','templates' => ['inputContainer' => '{{content}}']]) ?>
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
                                    <?= $this->Form->control('location', ['class' => 'form-control', 'label' => false]) ?> 
                                    <label class="form-label">Address</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <?= $this->Form->control('mobile_no', ['class' => 'form-control','type'=>'number', 'label' => false]) ?> 
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
                                   <input type="radio" name="gender" id="a"  value="1"class="indual with-gap" <?= $user->gender==1?'checked':'' ?>> <label for="a"><?= __('Male') ?></label>
                                   <input type="radio" name="gender" id="b" value="2" class="company with-gap" <?= $user->gender==2?'checked':'' ?>> <label for="b"><?= __('Female') ?></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <?php
                                        $dob1 = $user->dob;
                                        $dob  =   date_format($dob1,"Y-m-d");
                                        echo $this->Form->control('dob', ['class' => 'form-control datetimepicker', 'type' => 'text', 'placeholder' => 'DOB','value' => $dob, 'label' => FALSE ,'required']) ?>          
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Status</label>
                                    <?= $this->Form->input('active', ['options' => $status, 'class' => 'form-control', 'empty' => __('Select Status'), 'label' => false]); ?>
                                </div>
                            </div>
                            <?= $this->Form->button('Edit Trainer', ['class' => 'btn btn-primary waves-effect']) ?>
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