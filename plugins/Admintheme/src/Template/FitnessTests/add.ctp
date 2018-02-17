<?php
$status = $this->Common->getstatus();
$exercises = $this->Common->getExercises();
//pr($exercises[0]->name); die;
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
                           <?php if(!empty($exercises[0]->name)) {?>
                        <div class="form-group form-float">
                            <label class="form-label text-center"><?= $exercises[0]->name ?></label>
                            <div class="form-line">
                                <?= $this->Form->control('exercise_id['.$exercises[0]->id.']', ['class' => 'form-control', 'type' => 'hidden', 'value'=>$exercises[0]->id , 'label' => false, 'hidden']) ?> 
                                
                            </div>
                        </div>
                        <div class="row"> 
                         <div class="col-md-6"> 
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('exercise_l['.$exercises[0]->id.']', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">Left</label>
                            </div>
                        </div>
                        </div>
                            <div class="col-md-6"> 
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('exerciser['.$exercises[0]->id.']', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">Right</label>
                            </div>
                        </div>
                        </div>
                        </div>
                             <?php } ?>
                        <?php if(!empty($exercises[1]->name)) {?>
                         <div class="form-group form-float">
                            <label class="form-label text-center"><?= $exercises[1]->name ?></label>
                            <div class="form-line">
                                <?= $this->Form->control('exercise_id['.$exercises[1]->id.']', ['class' => 'form-control',  'value'=>$exercises[1]->id,'type' => 'hidden', 'label' => false, 'hidden']) ?> 
                                
                            </div>
                        </div>
                        <div class="row"> 
                         <div class="col-md-6"> 
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('exercise_l['.$exercises[1]->id.']', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">Left</label>
                            </div>
                        </div>
                        </div>
                            <div class="col-md-6"> 
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('exerciser['.$exercises[1]->id.']', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?> 
                                <label class="form-label">Right</label>
                            </div>
                        </div>
                        </div>
                        </div>
                        <?php }?>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->input('status', ['empty' => __('Select status'), 'options' => $status, 'class' => 'form-control']); ?>
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