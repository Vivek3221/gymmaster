<?php
$status = $this->Common->getstatus();

//$exercises = $this->Common->getExercises();
$get_exrcisedirectorie_lists = $this->Common->getExrciseDirectories($users_id);
//pr($get_exrcisedirectorie_lists); die;
$user_name = $this->Common->getUsers();
//pr($user_name); die;
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
                                <label class="form-label">Select Users</label>
                                <div class="form-line">
                                    <?= $this->Form->control('user_id', ['class' => 'form-control select2 ','multiple'=>'multiple', 'type' => 'select', 'empty' => __('Select User'), 'options' => $user_name ,'label'=>false]) ?> 
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
        <span id="exrcisedirectorie" onclick="getExcercise()" class="btn btn-success"><?= __('+ Add Excercise') ?></span>
   </span>
</div>
   <?php   foreach ($get_exrcisedirectorie_lists as $key=>$get_exrcisedirectorie_list){ ?>                     
<div class="row" id="getexercise<?= $key ?>" hidden>
    
    <span class=""> <?= ucfirst($get_exrcisedirectorie_list) ?></span>
    
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-highlight">
      <thead>
        <th>Name</th>
        <th>Date</th>
        <th>Cost</th>
        <th>Billing Type</th>
        <th>Remove</th>
      </thead>
      <tbody>
        <div id="addmore<?= $key ?>">
       </div>
      </tbody>
    </table>
  </div>  </div>
<span class="pull-right" id="getexercisemore" hidden >
     <button type="button" class="btn btn-default btn-sm" id="" onclick="getExcercise()">
        <i class="material-icons">add</i> 
         </button></span>
<br>  <?php } ?> 
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
    var start = 100;
  function getExcercise() {
          // alert(start);

            var exrcisedirectorie_id = $('#exrcisedirectorie-id').val();
          alert(exrcisedirectorie_id);
            var next_id = $('#exrcisedirectorie_id').val();
             // alert(exrcisedirectorie_id);
              
              $('#getexercise'+ exrcisedirectorie_id).show();
              
            //  
            if (exrcisedirectorie_id)
            {
                var urls = '<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'addExrice']) ?>';
                // alert(urls)
                //urllink = urls + '/' + bank_name ;
                var data = '&exrcisedirectorie_id=' + escape(exrcisedirectorie_id)+'&start='+escape(start);
                //alert(data);
                    $.ajax({
                    type: "POST",
                    cache: false,
                    data: data,
                    url: urls,
                    success: function (html) {
                      
//                          alert(html);
                        $('#addmore' +exrcisedirectorie_id).append(html);
                       // $('#getexercisemore').show();
                    }
                });
                
                
            }
            start = start + 1;
            return false;
        }
  function getExcercisemore(clickid) {
           alert(clickid);

            var exrcisedirectorie_id = $('#exrcisedirectorie-id').val();
         alert(exrcisedirectorie_id);
            var next_id = $('#exrcisedirectorie_id').val();
             // alert(exrcisedirectorie_id);
              
              
              
            //  
            if (exrcisedirectorie_id)
            {
                var urls = '<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'addExriceMore']) ?>';
                 alert(urls)
                //urllink = urls + '/' + bank_name ;
                var data = '&exrcisedirectorie_id=' + escape(exrcisedirectorie_id)+'&start='+escape(start);
                alert(data);
                    $.ajax({
                    type: "POST",
                    cache: false,
                    data: data,
                    url: urls,
                    success: function (html) {
                      
                         alert(html);
                        $('#more'+clickid).append(html);
                    }
                });
                
                
            }
            start = start + 1;
            return false;
        }
        
         function getSum2(clicked_id)
    {
          //alert(clicked_id);
          //var curr = $(this);
          // var gg =   curr.parents('#'+remove2).find('#'+clicked_id).val();
          //alert(gg);
        var res = clicked_id.slice(1,9); 
        var val1 = $('#a'+res).val();
        var val2 = $('#'+clicked_id).val();
        //alert(val1);
       // alert(val2);
     document.getElementById('c'+res).value = val1 * val2;
        
       
              //  $('#get_sub_category').html(html);
          
        return false;
    }

</script>