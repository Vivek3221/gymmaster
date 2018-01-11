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
                               <?= __('fitnessMeserment Form') ?>
                            </h2>
                            
                        </div>
                    <div class="body">
                        <!--                            <form id="form_validation" method="POST">-->
                        <?php //echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addUserForm', 'submitButtonId'=>'addUserSubmitBtn']); ?>
                        <?= $this->Form->create($fitnessMeserment, ['name'=>'bmiForm','id' => 'addusers','templates' => ['inputContainer' => '{{content}}']]) ?>
      
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('weight', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">Weight</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('height', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">Height</label>
                            </div>
                        </div>
                        <input type="button" value="Calculate BMI" onClick="calculateBmi()">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('bmi', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">Bmi</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('neck', ['class' => 'form-control', 'id'=>'neck', 'type' => 'text', 'label' => false,'value'=>'1' , 'onchange'=>'getLastValue("neck")']) ?> 
                                <label class="form-label">Neck</label>
                                <div id="1neck"> </div>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('upper_arm', ['class' => 'form-control','id'=>'upper_arm', 'type' => 'text', 'label' => false, 'onchange'=>'getLastValue("upper_arm")']) ?> 
                                <label class="form-label">Upper_arm</label>
                                 <div id="1upper_arm"> </div>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('chest', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">chest</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('waist', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">waist</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('lower_abdomen', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">lower_abdomen</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('hips', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">hips</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('thigh', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">thigh</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('calf', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">calf</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('whr', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">whr</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('fat', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">fat</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('tricep', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">tricep</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('abdomen', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">abdomen</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('ad_hold', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">ad_hold</label>
                            </div>
                        </div>
                       
                       <div class="form-group form-float">
                                    <div class="form-line">

                                        <?= $this->Form->control('date', ['class' => 'form-control datetimepicker', 'type' => 'text', 'placeholder' => 'DOB', 'label' => FALSE ,'required', 'format'=>'YYYY-MM-DD']) ?>          

                                    </div>
                                </div> 
                        
                        
                        <?= $this->Form->button('Fitness User', ['class' => 'btn btn-primary waves-effect']) ?>

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
            var position =  $('#'+fitnessfield+'').val();
             
            var urls = '<?= $this->Url->build(['controller' =>'FitnessMeserments', 'action' =>'getLastValue'])?>';
   
            var data = '&fitnessfield=' + escape(fitnessfield)+ '&position=' + escape(position);
         
            $.ajax({
                 
        type: "POST",
        
        cache:false,
       
        data: data,
        
        url: urls,
        
        success: function(data)
			{
                            //alert(data);
                       $('#1'+fitnessfield+'').html(data)   
                   
                     
			} 
                  });
    return false;  
    }
      
      
      
      function calculateBmi() {
var weight = document.bmiForm.weight.value
var height = document.bmiForm.height.value
if(weight > 0 && height > 0){	
var finalBmi = weight/(height/100*height/100)
document.bmiForm.bmi.value = finalBmi
if(finalBmi < 18.5){
document.bmiForm.meaning.value = "That you are too thin."
}
if(finalBmi > 18.5 && finalBmi < 25){
document.bmiForm.meaning.value = "That you are healthy."
}
if(finalBmi > 25){
document.bmiForm.meaning.value = "That you have overweight."
}
}
else{
alert("Please Fill in everything correctly")
}
}
      
      
       $(document).ready(function () {
     $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD HH:mm', lang: 'fr', weekStart: 1, cancelText: 'Cancel',maxDate : new Date()});
     $('').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });
     });
      
      </script>