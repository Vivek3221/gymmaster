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
                            <?= __('Body Measurement ') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <?= $this->Form->create($fitnessMeserment, ['enctype' => 'multipart/form-data','name' => 'bmiForm', 'id' => 'bodym', 'templates' => ['inputContainer' => '{{content}}']]) ?>
                        <div class="row"> 
                            <div class="col-md-6">  
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?= $this->Form->control('weight', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                        <label class="form-label">Weight</label>
                                    </div>
                                    <small class="text-muted"> *Weight in KG.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?= $this->Form->control('height', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                        <label class="form-label">Height</label>
                                    </div>
                                    <small class="text-muted"> *Height in CM.</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">  
                            <div class="col-md-6">
                                <input type="button" value="Calculate BMI" onClick="calculateBmi()">
                                <small class="text-muted"> *Click here to autofill BMI.</small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?= $this->Form->control('bmi', ['class' => 'form-control', 'type' => 'text', 'readonly', 'label' => false]) ?> 
                                        <label class="form-label">BMI</label>
                                    </div>
                                    <small class="text-muted"> *It's autofill.</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">  
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?= $this->Form->control('neck', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                        <label class="form-label">Neck</label>
                                    </div>
                                    <small class="text-muted"> *Neck in inch.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?= $this->Form->control('upper_arm', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                        <label class="form-label">Upper Arm</label>
                                    </div>
                                    <small class="text-muted">*Upper Arm in inch.</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">  
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?= $this->Form->control('chest', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                        <label class="form-label">Chest</label>
                                    </div>
                                    <small class="text-muted">*Chest in inch.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?= $this->Form->control('waist', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                        <label class="form-label">Waist</label>
                                    </div>
                                    <small class="text-muted">*Waist in inch.</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">  
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?= $this->Form->control('lower_abdomen', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                        <label class="form-label">Lower Abdomen</label>
                                    </div>
                                    <small class="text-muted">*Lower Abdomen in inch.</small>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?= $this->Form->control('hips', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                        <label class="form-label">Hips</label>
                                    </div>
                                    <small class="text-muted">*Hips in inch.</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">  
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?= $this->Form->control('thigh', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                        <label class="form-label">Thigh</label>
                                    </div>
                                    <small class="text-muted"> *Thigh in inch.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?= $this->Form->control('calf', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                        <label class="form-label">Calf</label>
                                    </div>
                                    <small class="text-muted">*Calf in inch.</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">  
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php
                                        $date='';
                                                    if($fitnessMeserment->date !='')
                                                    {
                                                    
                                       $date = ($fitnessMeserment->date->i18nFormat('YYYY-MM-dd'));
                                                    }
                                        // $datetime = $news->news_expire;
                                       
                                        ?>
                                        <?= $this->Form->control('date', ['class' => 'form-control datetimepicker', 'type' => 'text','value'=>$date, 'placeholder' => 'Select Date', 'label' => FALSE, 'required', 'format' => 'YYYY-MM-DD']) ?>          
                                    </div>
                                </div> 
                                <small class="text-muted">*Select date.</small>
                            </div> 
                            <div class="col-md-6">
<div class="form-group form-float">
                                    <div class="form-line image">
                                                    <?= $this->Form->control('imageslu', ['label' => 'Left Image', 'class' => 'form-control', 'type' => 'file', 'onchange' => "ImageFilesizelu();"]) ?>            
                                                </div>
                                </div> 
                            </div>
                        </div>
                     <div class="row">  
                        <div class="col-md-6">
                       <div class="form-group form-float">
                                    <div class="form-line image">
                                                    <?= $this->Form->control('imagesru', ['label' => 'Right Image', 'class' => 'form-control', 'type' => 'file', 'onchange' => "ImageFilesizeru();"]) ?>            
                                                </div>
                                </div> 
                            <small class="text-muted">*Select Right.</small>
                                </div> 
                        <div class="col-md-6">
                            <div class="form-group form-float">
                        <div class="form-line image">
                                                    <?= $this->Form->control('imagesfu', ['label' => 'Front Image', 'class' => 'form-control', 'type' => 'file', 'onchange' => "ImageFilesizefu();"]) ?>            
                                                </div>
                                                </div>
                        </div>
                        </div>
                          <div class="row">  
                        <div class="col-md-6">
                       <div class="form-group form-float">
                                   <div class="form-line image">
                                                    <?= $this->Form->control('imagesbu', ['label' => 'Back Image', 'class' => 'form-control', 'type' => 'file', 'onchange' => "ImageFilesizebu();"]) ?>            
                                                </div>
                                </div> 
                            <small class="text-muted">*Select Back.</small>
                                </div> 
                        <div class="col-md-6">
                        
                        <?= $this->Form->button('Submit', ['class' => 'btn btn-primary waves-effect']) ?>
                        </div>
                        </div>   
                        
                        
                        
                        
                        
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script type="text/javascript">

    function getLastValue(id)
    {
        var fitnessfield = id;
        // alert(fitnessfield);
        var position = $('#' + fitnessfield + '').val();

        var urls = '<?= $this->Url->build(['controller' => 'FitnessMeserments', 'action' => 'getLastValue']) ?>';

        var data = '&fitnessfield=' + escape(fitnessfield) + '&position=' + escape(position);

        $.ajax({

            type: "POST",

            cache: false,

            data: data,

            url: urls,

            success: function (data)
            {
                //alert(data);
                $('#1' + fitnessfield + '').html(data)


            }
        });
        return false;
    }



    function calculateBmi() {
        var weight = document.bmiForm.weight.value
        var height = document.bmiForm.height.value
        if (weight > 0 && height > 0) {
            var finalBmi = weight / (height / 100 * height / 100)
            document.bmiForm.bmi.value = finalBmi
            if (finalBmi < 18.5) {
                document.bmiForm.meaning.value = "That you are too thin."
            }
            if (finalBmi > 18.5 && finalBmi < 25) {
                document.bmiForm.meaning.value = "That you are healthy."
            }
            if (finalBmi > 25) {
                document.bmiForm.meaning.value = "That you have overweight."
            }
        } else {
            alert("Please Fill in everything correctly")
        }
    }


    $(document).ready(function () {
        $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD', lang: 'fr', weekStart: 1, cancelText: 'Cancel', maxDate: new Date(), time: 'false'});
        $('').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});
    });
    
      function ImageFilesizelu() {
      
        var Extension = '';
        if (window.ActiveXObject) {
            var fso = new ActiveXObject("Scripting.FileSystemObject");
            var filepath = document.getElementById('imageslu').value;
            var thefile = fso.getFile(filepath);
            var sizeinbytes = thefile.size;
        } else {
            var filepath = document.getElementById('imageslu').value;
            var Extension = filepath.substring(filepath.lastIndexOf('.') + 1).toLowerCase();
            var sizeinbytes = document.getElementById('imageslu').files[0].size;
        }
        var size = sizeinbytes / 1024 / 1024;
        if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
            if (size <= 2) {
            } else {
                alert('Allowed maximum imagelu sizes is 2MB.');
                document.getElementById('imagesl').value = '';
            }
        } else {
            alert('Allowed only .gif,.png,.bmp,.jpg,.jpeg image files.');
            document.getElementById('imageslu').value = '';
        }

    }   
    
      function ImageFilesizeru() {
      
        var Extension = '';
        if (window.ActiveXObject) {
            var fso = new ActiveXObject("Scripting.FileSystemObject");
            var filepath = document.getElementById('imagesru').value;
            var thefile = fso.getFile(filepath);
            var sizeinbytes = thefile.size;
        } else {
            var filepath = document.getElementById('imagesru').value;
            var Extension = filepath.substring(filepath.lastIndexOf('.') + 1).toLowerCase();
            var sizeinbytes = document.getElementById('imagesru').files[0].size;
        }
        var size = sizeinbytes / 1024 / 1024;
        if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
            if (size <= 2) {
            } else {
                alert('Allowed maximum imageru sizes is 2MB.');
                document.getElementById('imagesru').value = '';
            }
        } else {
            alert('Allowed only .gif,.png,.bmp,.jpg,.jpeg image files.');
            document.getElementById('imagesru').value = '';
        }

    }
    
      function ImageFilesizefu() {
      
        var Extension = '';
        if (window.ActiveXObject) {
            var fso = new ActiveXObject("Scripting.FileSystemObject");
            var filepath = document.getElementById('imagesfu').value;
            var thefile = fso.getFile(filepath);
            var sizeinbytes = thefile.size;
        } else {
            var filepath = document.getElementById('imagesfu').value;
            var Extension = filepath.substring(filepath.lastIndexOf('.') + 1).toLowerCase();
            var sizeinbytes = document.getElementById('imagesfu').files[0].size;
        }
        var size = sizeinbytes / 1024 / 1024;
        if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
            if (size <= 2) {
            } else {
                alert('Allowed maximum imagefu sizes is 2MB.');
                document.getElementById('imagesf').value = '';
            }
        } else {
            alert('Allowed only .gif,.png,.bmp,.jpg,.jpeg image files.');
            document.getElementById('imagesfu').value = '';
        }

    }
    
      function ImageFilesizebu() {
      
        var Extension = '';
        if (window.ActiveXObject) {
            var fso = new ActiveXObject("Scripting.FileSystemObject");
            var filepath = document.getElementById('imagesbu').value;
            var thefile = fso.getFile(filepath);
            var sizeinbytes = thefile.size;
        } else {
            var filepath = document.getElementById('imagesbu').value;
            var Extension = filepath.substring(filepath.lastIndexOf('.') + 1).toLowerCase();
            var sizeinbytes = document.getElementById('imagesbu').files[0].size;
        }
        var size = sizeinbytes / 1024 / 1024;
        if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
            if (size <= 2) {
            } else {
                alert('Allowed maximum imagebu sizes is 2MB.');
                document.getElementById('imagesbu').value = '';
            }
        } else {
            alert('Allowed only .gif,.png,.bmp,.jpg,.jpeg image files.');
            document.getElementById('imagesbu').value = '';
        }

    } 
    

</script>