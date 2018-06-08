<?php
$status = $this->Common->getstatus();
//$exercises = $this->Common->getExercises();
$get_exrcisedirectorie_lists = $this->Common->getExrciseDirectories($users_id);
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
                                <label class="form-label">Select Users</label>
                                <div class="form-line">
                                    <?= $this->Form->control('user_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select User'), 'options' => $user_name, 'label' => false]) ?> 
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group form-float">
                            <?php
                            $dob1 = $session->date;
                            //pr($dob1);
                            $dob = date_format($dob1, "y-m-d");
                            //pr($dob); 
                            ?>
                            <div class="form-line">
                                <?= $this->Form->control('date', ['class' => 'form-control datetimepicker', 'type' => 'text', 'placeholder' => 'Select Date', 'label' => FALSE, 'required', 'value' => $dob, 'format' => 'YYYY-MM-DD']) ?>          
                            </div>
                        </div> 
                        <!--                        <div class="input-group mb-3" >
                                                    <label class="form-label">Exercise</label>
                                                    <div class="">
                        <?= $this->Form->control('exrcisedirectorie_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select Excercise'), 'options' => $get_exrcisedirectorie_lists, 'label' => FALSE]) ?> 
                                                        <div class="input-group-append">
                                                            <button id="exrcisedirectorie"  class="btn btn-success"><?= __('+ Add Excercise') ?></button>
                                                        </div>
                                                    </div>
                                                </div>-->
                        <div class="input-group">
                            <label class="form-label">Exercise</label>
                            <?= $this->Form->control('exrcisedirectorie_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select Excercise'), 'options' => $get_exrcisedirectorie_lists, 'label' => FALSE]) ?>
                            <span class="input-group-btn" style="padding-top: 23px;">
                                <span id="exrcisedirectorie" onclick="getExcercise()" class="btn btn-success"><?= __('+ Add Excercise') ?></span>
                            </span>
                        </div>

                            <?php foreach ($session_values as $key => $value) {
                                ?>
                                <div class="row" id="getexercise<?= $key ?>" >
                   <?php $ex_name = $this->Common->getExrciseDirectoriesname($key) ?>
                                    <span class=""> <?= ucfirst($ex_name->name) ?></span>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-highlight">
                                            <thead>
                                                <?php $ex_name = $this->Common->getExrciseDirectoriesname($key) ?>
                                            <th><?= $ex_name->tecnical1 ?></th>
                                            <th><?= $ex_name->tecnical2 ?></th>
                                            <th><?= $ex_name->tecnical3 ?></th>
                                            <th><?= $ex_name->tecnical4 ?></th>
                                            <th>Remove</th>
                                            </thead>
                                            <tbody id="addmore<?= $key ?>" >
                                                <?php $count = count($value);
                                                $i=0;
                                                ?>
                                              <?php foreach ($value as $val => $vale) {
                                                  if($i%4==0)
                                                  echo '<tr>';
                                                    echo '<td>';
                                                      foreach($vale as $orgVal){
                                                        echo $orgVal;
                                                      }
                                                    echo '</td>'; 
                                                    $i++;
                                                  if($i%4==0)
                                                  echo '</tr>';
                                                  
                                                       }?>
                                            </tbody>
                                        </table>
                                    </div> 
                                    <span class="pull-left" id="getexercisemore">
                                        <button type="button" class="btn btn-default btn-sm" id="<?= $key ?>" onclick="getExcercisemore(this.id)">
                                            <i class="material-icons">add</i> 
                                        </button></span>
                                </div><?php } ?>

                        
                        <span class="pull-right" id="getexercisemore" hidden >
                            <button type="button" class="btn btn-default btn-sm" id="" onclick="getExcercise()">
                                <i class="material-icons">add</i> 
                            </button></span>
                        <br>

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

    //$(function () {
    var start = 100;
    function getExcercise() {

        var exrcisedirectorie_id = $('#exrcisedirectorie-id').val();
        //alert(exrcisedirectorie_id);
        //  
        if (exrcisedirectorie_id)
        {
            var urls = '<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'addExrice']) ?>';
            // alert(urls)
            //urllink = urls + '/' + bank_name ;
            var data = '&exrcisedirectorie_id=' + escape(exrcisedirectorie_id) + '&start=' + escape(start);
            $.ajax({
                type: "POST",
                cache: false,
                data: data,
                url: urls,
                success: function (html) {
//                          alert(html);
                    $('#getexercise').append(html);
                    $('#getexercisemore').show();
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
        var res = clicked_id.slice(1, 9);
        var val1 = $('#a' + res).val();
        var val2 = $('#' + clicked_id).val();
        //alert(val1);
        // alert(val2);
        document.getElementById('c' + res).value = val1 * val2;


        //  $('#get_sub_category').html(html);

        return false;
    }

    function getSum(clicked_id)
    {
        // alert(clicked_id);
        var res = clicked_id.slice(1, 9);
        // alert(res);
        var sum2 = 3;
        var firstv = res - 1;
        var lastv = firstv + sum2;
        //alert(firstv);
        // alert(lastv);

        var val1 = $('#a' + firstv).val();
        var val2 = $('#' + clicked_id).val();
        // alert(val1);
        // alert(val2);
        document.getElementById('a' + lastv).value = val1 * val2;


        //  $('#get_sub_category').html(html);

        return false;
    }

//        function getSum(clicked_id)
//    {
//          //alert(clicked_id);
//        var res = clicked_id.slice(1,2); 
//        var val1 = $('#a'+res).val();
//        var val2 = $('#'+clicked_id).val();
//        //alert(val1);
//       // alert(val2);
//     document.getElementById('c'+res).value = val1 * val2;
//        
//       
//              //  $('#get_sub_category').html(html);
//          
//        return false;
//    }

    //});

</script>