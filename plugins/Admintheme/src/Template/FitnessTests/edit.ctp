<?php
$status = $this->Common->getstatus();
//$exercises = $this->Common->getExercises();
$bodies_lists = $this->Common->getBodies();
//pr($bodies_lists); die;
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
                            <?= __('Fitness Test Form') ?>
                        </h2>

                    </div>
                    <div class="body">
                        <!--                            <form id="form_validation" method="POST">-->
                        <?php //echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addUserForm', 'submitButtonId'=>'addUserSubmitBtn']);  ?>
                        <?= $this->Form->create($fitnessTest, ['id' => 'addbody', 'templates' => ['inputContainer' => '{{content}}']]) ?>
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group form-float">
                           <div class="form-line">
                              <?php
                                  $date='';
                                  if($fitnessTest->date !='')
                                {
                                 $date = ($fitnessTest->date->i18nFormat('YYYY-MM-dd'));
                                }
                                 ?>
                              <?= $this->Form->control('date', ['class' => 'form-control datetimepicker', 'type' => 'text','value'=>$date, 'placeholder' => 'Select Date', 'label' => FALSE, 'required', 'format' => 'YYYY-MM-DD']) ?>          
                           </div>
                        </div>
                    </div>
                </div>
                           <?php if(!empty($bodies_lists)) {
                                        foreach ($bodies_lists as $bodies_list):
                                            $body_id = $bodies_list->id;
                                        ?>
                        <div class="form-group form-float">
                            <label class="form-label text-center"><?= $bodies_list->name ?></label>
                          
                        </div>
                        <div class="row"> 
                            <?php   $exercises = $this->Common->getExercises($bodies_list->id);    foreach ($exercises as $exercise): 
                                $exercise_id = $exercise->id;
                                ?>
                         <div class="col-md-6"> 
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control($bodies_list->id.'['.$exercise->id.']', ['class' => 'form-control', 'type' => 'number','step' => '.01', 'value'=> $exercise_value->$body_id->$exercise_id, 'label' => false]) ?> 
                                <label class="form-label"><?= $exercise->name ?></label>
                            </div>
                        </div>
                        </div>
                            <?php endforeach;   ?>
                        </div>
                         <?php endforeach;  } ?>
                       <div class="form-group form-float">
                             <div class="form-line">
                                <?= $this->Form->control('exercise_id', ['class' => 'form-control', 'type' => 'hidden', 'value'=>5 , 'label' => false, 'hidden']) ?> 
                            </div>
                        </div>
                        <?= $this->Form->button('Submit', ['class' => 'btn btn-primary waves-effect']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
       $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD', lang: 'fr', weekStart: 1, cancelText: 'Cancel', maxDate: new Date(), time: 'false'});
       $('').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});
   });
</script>