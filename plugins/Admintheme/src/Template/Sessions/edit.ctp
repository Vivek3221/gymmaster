<?php
$status = $this->Common->getstatus();
//$exercises = $this->Common->getExercises();
$get_exrcisedirectorie_lists = $this->Common->getExrciseDirectories();
//$get_exrcisedirectorie_name = $this->Common->getExrciseDirectoriesname(1);

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
                            <?= __('Create Session') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <!--                            <form id="form_validation" method="POST">-->
                        <?php //echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addUserForm', 'submitButtonId'=>'addUserSubmitBtn']);  ?>
                        <?= $this->Form->create($session, ['id' => 'addbodys', 'templates' => ['inputContainer' => '{{content}}']]) ?>
                        <?php if ($user_type != 3) {
                            ?>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <?= $this->Form->control('user_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select User'), 'options' => $user_name]) ?> 
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('date', ['class' => 'form-control datetimepicker', 'type' => 'text', 'placeholder' => 'Select Date', 'label' => FALSE, 'required', 'format' => 'YYYY-MM-DD']) ?>          
                            </div>
                        </div> 
<!--                        <div class="input-group mb-3" >
                            <label class="form-label">Exercise</label>
                            <div class="">
                                <?= $this->Form->control('exrcisedirectorie_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select Excercise'), 'options' => $get_exrcisedirectorie_lists , 'label'=>FALSE]) ?> 
                                <div class="input-group-append">
                                    <button id="exrcisedirectorie"  class="btn btn-success"><?= __('+ Add Excercise') ?></button>
                                </div>
                            </div>
                        </div>-->
                        <div class="input-group">
                            <label class="form-label">Exercise</label>
    <?= $this->Form->control('exrcisedirectorie_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select Excercise'), 'options' => $get_exrcisedirectorie_lists , 'label'=>FALSE]) ?>
                            <span class="input-group-btn" style="padding-top: 23px;">
        <button id="exrcisedirectorie"  class="btn btn-success"><?= __('+ Add Excercise') ?></button>
   </span>
</div>
                        
                        <div class="row" id="getexercise">
                            
                             <?php foreach($session_values as $key=> $value)
                             {?>
    <div class="body">
<div class="form-group row" id="remove<?= $key ?>">
  <div>
    <div class="col-xs-6">
    <span class="pull-left"> <?= ucfirst($this->Common->getExrciseDirectoriesname($key)) ?></span>
    </div>
    <div class="col-xs-6">
 <span class="pull-right">
     <button type="button" class="btn btn-default btn-sm" id="<?= $key ?>" onclick="removeExcercise(this.id,<?= $key ?>)">
        <i class="material-icons">clear</i> 
    </button></span>
    </div>
    </div> 
    
    
    <?php foreach ($value as $val=>$vale)  
                                  {?>
    <div class="col-md-3"> 
        <div class="form-group form-float">
            <label class="form-label"><?= ucfirst($val) ?></label>
            <div class="form-line">
                <?= $this->Form->control('excrcise['. $key . '][' . $val . ']', ['class' => 'form-control', 'type' => 'text', 'value'=>$vale, 'label' => false, 'required']) ?> 
            </div>

        </div>
    </div>
                             <?php }   ?>
    
</div>
                             </div><?php }?>
                                 
                             </div>
 
                            
                            
                        </div>
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
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

<script type="text/javascript">
    $(document).ready(function () {
        $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD', lang: 'fr', weekStart: 1, cancelText: 'Cancel', minDate: new Date(), time: 'false'});
        $('').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});
    });

</script>
<script>

    function removeExcercise(clicked_id)
    {

        var id = 'remove' + clicked_id;
        $('#' + id).remove();
        //alert(id);

    }
    $(function () {

        $("#exrcisedirectorie").click(function () {

            var exrcisedirectorie_id = $('#exrcisedirectorie-id').val();
//              alert(exrcisedirectorie_id);
            //  
            if (exrcisedirectorie_id)
            {
                var urls = '<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'addExrice']) ?>';
                // alert(urls)
                //urllink = urls + '/' + bank_name ;
                var data = '&exrcisedirectorie_id=' + escape(exrcisedirectorie_id);
                $.ajax({
                    type: "POST",
                    cache: false,
                    data: data,
                    url: urls,
                    success: function (html) {
//                          alert(html);
                        $('#getexercise').append(html);
                    }
                });
            }
        });

    });

</script>