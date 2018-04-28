<?php
$status = $this->Common->getstatus();
//$exercises = $this->Common->getExercises();
$bodies_lists = $this->Common->getBodies();
$user_name = $this->Common->getUsers();
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
                            <?php if($user_type !=3)
                       {?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('user_id', ['class' => 'form-control select2', 'type' => 'select','empty'=>__('Select User'),'options' => $user_name]) ?> 
                            </div>
                        </div>
                       <?php }?>

                         <?php if(!empty($bodies_lists)) {
                                        foreach ($bodies_lists as $bodies_list):
                                        ?>
                        <div class="form-group form-float">
                            <label class="form-label text-center"><?= $bodies_list->name ?></label>
                          
                        </div>
                        <div class="row"> 
                            <?php   $exercises = $this->Common->getExercises($bodies_list->id);    foreach ($exercises as $exercise):  ?>
                         <div class="col-md-6"> 
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control($bodies_list->id.'['.$exercise->id.']', ['class' => 'form-control', 'type' => 'number', 'label' => false ,'required']) ?> 
                                <label class="form-label"><?= $exercise->name ?></label>
                            </div>
                            <small class="text-muted"> * <?= $exercise->description ?></small>
                        </div>
                        </div>
                            <?php endforeach;   ?>
                        </div>
                         <?php endforeach;  } ?>
                        <div class="form-group form-float">
                             <div class="form-line">
                                <?= $this->Form->control('exercise_id', ['class' => 'form-control', 'type' => 'hidden', 'value'=>5 , 'label' => false, 'hidden']) ?> 
                                
                            </div>
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