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
                            <?= __('Session Reports') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <!--                            <form id="form_validation" method="POST">-->
                        <?php //echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addUserForm', 'submitButtonId'=>'addUserSubmitBtn']);  ?>
                        <?= $this->Form->create($session, ['id' => 'addbodys', 'templates' => ['inputContainer' => '{{content}}']]) ?>


                        <div class="row" id="getexercise">
                            <div class="col-sm-6" style="background-color:lavender;">
                                <div>
                            <span class="">  <h3 class="text-center">Planned</h3></span> 
                                </div>
                                <?php foreach ($session_values as $key => $value) {
                                    ?>
                                <div>
                            <span class=""> <?= ucfirst($this->Common->getExrciseDirectoriesname($key)) ?></span> 
                                </div>
                                    <div class="body">
            
                                        <?php foreach ($value as $val => $vale) {
                                            ?>
                                            <div class="col-md-3"> 
                                                <div class="form-group form-float">
                                                    <label class="form-label"><?= ucfirst($val) ?></label>
                                                    <div class="form-line">
                                                        <?= $this->Form->control('excrcise[' . $key . '][' . $val . ']', ['class' => 'form-control', 'type' => 'text', 'value' => $vale, 'label' => false, 'readonly']) ?> 
                                                    </div>

                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div><?php } ?>

                            </div>
                            <div class="col-sm-6" style="background-color:#f1e6fa;">
                                <div>
                            <span class=""> <h3 class="text-center">Report</h3> </span> 
                                </div>
                                <?php foreach ($session_values as $key => $value) {
                                    ?>
                                <div>
                            <span class=""> <?= ucfirst($this->Common->getExrciseDirectoriesname($key)) ?></span> 
                                </div>  <div class="body">
 
                                        <?php $i =1; foreach ($value as $val => $vale) {
                                            ?>
                                            <div class="col-md-3"> 
                                                <div class="form-group form-float">
                                                    <label class="form-label"><?= ucfirst($val) ?></label>
                                                    <div class="form-line">
                                                    <?php
                                                         if($i == 1)
                                                         {
                                                       echo $this->Form->control('userexcrcise[' . $key . '][' . $val . ']', ['class' => 'form-control', 'type' => 'text','id'=>'a'.$key, 'label' => false, 'required']) ;
                                                         } elseif ($i == 2) {
                                                        echo $this->Form->control('userexcrcise[' . $key . '][' . $val . ']', ['class' => 'form-control', 'type' => 'text','id'=>'b'.$key,'onblur'=>'getSum(this.id)', 'label' => false, 'required']); 
                                                         } elseif ($i == 3) {
                                                        echo $this->Form->control('userexcrcise[' . $key . '][' . $val . ']', ['class' => 'form-control', 'type' => 'text', 'id'=>'d'.$key, 'label' => false, 'required']) ;
                                                        } else {
                                                      echo $this->Form->control('userexcrcise[' . $key . '][' . $val . ']', ['class' => 'form-control', 'type' => 'text','id'=>'c'.$key, 'label' => false, 'required', 'readonly']) ;
                                                       }
                                                          ?> 
                                                    </div>

                                                </div>
                                            </div>
                                        <?php $i++; } ?>

                                    </div><?php } ?>

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

    function getExcercise() {

        var exrcisedirectorie_id = $('#exrcisedirectorie-id').val();
        //alert(exrcisedirectorie_id);
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
    }
    
    function getSum(clicked_id)
    {
          //alert(clicked_id);
        var res = clicked_id.slice(1,2); 
        var val1 = $('#a'+res).val();
        var val2 = $('#'+clicked_id).val();
        //alert(val1);
       // alert(val2);
     document.getElementById('c'+res).value = val1 * val2;
        
       
              //  $('#get_sub_category').html(html);
          
        return false;
    }

    //});

</script>