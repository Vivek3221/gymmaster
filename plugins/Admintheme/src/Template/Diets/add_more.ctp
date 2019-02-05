<?php
    $status = $this->Common->getstatus();
    $get_dietdirectories_lists = $this->Common->getDietsDirectories($users_id);
    $user_name = $this->Common->getUsers();
    $partner = $this->Common->getpartner();
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
                            <?= __('Edit Diet') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <?= $this->Form->create($diet, ['id' => 'addbodys', 'templates' => ['inputContainer' => '{{content}}']]) ?>
                        <?php if ($user_type != 3) {
                            ?>
                            <div class="form-group form-float">
                                <label class="form-label">Select Users</label>
                                <div class="form-line">
                                    <?= $this->Form->control('user_id', ['class' => 'form-control select2', 'type' => 'select','multiple'=>'multiple', 'empty' => __('Select User'), 'options' => $user_name, 'label' => false]) ?> 
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group form-float">
                            <?php
                                $dob1 = $diet->date;
                                $dob = date_format($dob1, "y-m-d");
                            ?>
                            <div class="form-line">
                                <?= $this->Form->control('date', ['class' => 'form-control datetimepicker', 'type' => 'text', 'placeholder' => 'Select Date', 'label' => FALSE, 'required', 'value' => $dob, 'format' => 'YYYY-MM-DD']) ?>          
                            </div>
                        </div> 
                        <!-- <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('diet_type', ['class' => 'form-control', 'type' => 'text', 'label' => FALSE]) ?> 
                                <label class="form-label">diet Type</label>
                            </div>
                        </div> -->
                        <div id="exerDataDiv" class="col-sm-12" style="margin-bottom: -2px;">
                            <?php foreach ($diet_values as $key => $value) {
                                $excid = $key;
                                $addexc[] = $key;
                            ?>
                                <div class="row" id="getexercise<?= $key ?>" style="margin-bottom: 10px">
                                    
                                    <?php $ex_name = $this->Common->getDietDirectoriesname($key) ?>
                                    <span class="pull-right" id="getdietsmore" style="margin-bottom: -6px">
                                        <button type="button" class="btn btn-default btn-sm" id="<?= $key ?>" onclick="get_Dietsmore(this.id)">
                                            <i class="material-icons">add</i> 
                                        </button>
                                    </span>
                                    <button type="button" class="btn btn-default btn-sm pull-right " id="<?= $key ?>" onclick="removeExcerciseall(this.id)">
            <i class="material-icons">clear</i> 
        </button>
                                    <span class=""> <p class="text-primary"><?= ucfirst($ex_name->name) ?></p></span>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-highlight">
                                            <thead>
                                                <?php $ex_name = $this->Common->getDietDirectoriesname($key) ?>
                                            <th><?= ucfirst($ex_name->technical1) ?></th>
                                            <th><?= ucfirst($ex_name->technical2) ?></th>
                                            <th><?= ucfirst($ex_name->technical3) ?></th>
                                            <th><?= ucfirst($ex_name->technical4) ?></th>
                                             <th><?= ucfirst($ex_name->technical5) ?></th>
                                             <th><?= ucfirst($ex_name->technical6) ?></th>
                                             <th><?= ucfirst($ex_name->technical7) ?></th>
                                            <th>Remove</th>
                                            </thead>
                                            <tbody id="addmore<?= $key ?>" >
                                                <?php
                                                $count = count($value);
                                                $i = 10;
                                                $j = 0;
                                                 $inClass= 0;

                                                ?>
                                                <?php
                                                foreach ($value as $val => $vale) {

                                                    if ($j % 7 == 0){
                                                        $inClass= 0;
                                                        $k = $j;
                                                        echo '<tr id=remove'.$key.$j.' class="'.$key.$j.'">';
                                                    }
                                                    echo '<td>';
                                                    foreach ($vale as $valn => $valen) {

                                                        if($inClass==0){
                                                         $class='a' ;
                                                        }else if($inClass==1){
                                                            $class='b' ;
                                                         }else if($inClass==2){
                                                            $class='d' ;
                                                        }else if($inClass==3){
                                                            $class='c' ;
                                                        }else if($inClass==4){
                                                            $class='e' ;
                                                        }else if($inClass==5){
                                                            $class='f' ;
                                                        }else if($inClass==6){
                                                            $class='g' ;
                                                        }
                                                        $inClass++;
                                                        if ($i == 10) {
                                                            echo $this->Form->control('excrcise[' . $key . '][' . $new_id . '][' . $valn . ']', ['class' => 'form-control', 'type' => 'text', 'value' => $valen, 'id' => $class .$excid. $key . $k, 'label' => false, 'required']);
                                                        } elseif ($i == 11 OR $i == 15 OR $i == 19 OR $i == 23 OR $i == 27 OR $i == 31) {
                                                            echo $this->Form->control('excrcise[' . $key . '][' . $new_id . '][' . $valn . ']', ['class' => 'form-control', 'type' => 'text', 'value' => $valen, 'id' => $class .$excid. $key .  $k, 'label' => false, 'required']);
                                                        } elseif ($i == 13 OR $i == 17 OR $i == 21 OR $i == 25 OR $i == 29 OR $i == 33) {
                                                            echo $this->Form->control('excrcise[' . $key . '][' . $new_id . '][' . $valn . ']', ['class' => 'form-control', 'type' => 'text', 'value' => $valen, 'id' => $class .$excid. $key . $k, 'label' => false, 'required', '']);
                                                        } else {
                                                            echo $this->Form->control('excrcise[' . $key . '][' . $new_id . '][' . $valn . ']', ['class' => 'form-control', 'type' => 'text', 'value' => $valen, 'id' => $class .$excid. $key .  $k, 'label' => false, 'required']);
                                                        }
                                                    }
                                                    echo '</td>';

                                                    $i++;
                                                    $j++;
                                                    if ($j % 7 == 0) {
                                                      echo '<td>'
                                                        . '<button type="button" class="btn btn-default btn-sm" id="'.$key.$k.'" onclick="removeExcercise(this.id,'.$key.$k.')">
                                                            <i class="material-icons">clear</i>
                                                            </button>
                                                          </td>';     
                                                        echo '</tr>';
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div> 
                                    
                                </div>
                            <?php } ?>
                            <?php // data from ajax comes here ?>
                        </div>  
                        <?php if ($user_type == 1) {  ?>
                        <div class="input-group" style="margin-bottom: -12px;">
                            <div id="exerDataDiva" class="col-sm-4"> 
                           <?= $this->Form->control('partner_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select Partner'), 'options' => $partner , 'onchange' => 'getpartnerexcr(this.id)', 'label'=>FALSE]) ?>
                        </div>
                            <div id="exerDataDiva" class="col-sm-4"> 
                            <span id="exrcisedirectorie" onclick="getOwnexer()" class="btn btn-success"><?= __('Own Diet') ?></span>
                             </div>
                        </div>
                          <?php } ?>
                         <?php if ($user_type == 2) {  ?>
                        <div class="input-group" style="margin-bottom: -12px;">
                            <div id="exerDataDivp" class="col-sm-4"> 
                       <span id="<?= $partner_id ?>" onclick="getPartnere(this.id)" value="<?= $partner_id ?>" class="btn btn-success"><?= __('Admin Diet') ?></span>
                            </div>
                            <div id="exerDataDivp" class="col-sm-4"> 
                            <span id="<?= $users_id ?>" onclick="getPartnere(this.id)" value="<?= $users_id ?>" class="btn btn-success"><?= __('Own Diet') ?></span>
                             </div>
                        </div>
                          <?php } if ($user_type == 4) { ?>
                        <div id="exerDataDivp" class="col-sm-4"> 
                       <span id="<?= $AdminofTrainner->partner_id ?>" onclick="getPartnere(this.id)" value="<?= $AdminofTrainner->partner_id ?>" class="btn btn-success"><?= __('Admin Diet') ?></span>
                            </div>
                          <div id="exerDataDivp" class="col-sm-4"> 
                       <span id="<?= $partner_id ?>" onclick="getPartnere(this.id)" value="<?= $partner_id ?>" class="btn btn-success"><?= __('Own Diet') ?></span>
                            </div>
                          <?php  } ?>
                        <div class="input-group" style="margin-top: -18px">
                            <label class="form-label">Diet</label>
                            <div id="changeexcr">
                            <?= $this->Form->control('dietdirectories_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select Diet'), 'options' => $get_dietdirectories_lists, 'label' => FALSE]) ?>
                            </div>
                                <span class="input-group-btn" style="padding-top: 23px;">
                                <span id="exrcisedirectorie" onclick="get_Diets()" class="btn btn-success"><?= __('+ Add Diet') ?></span>
                            </span>
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

</div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD', lang: 'fr', weekStart: 1, cancelText: 'Cancel', minDate: new Date(), time: 'false'});
        $('').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});
    });

    function removeExcercise(clicked_id) {
        var id = 'remove' + clicked_id;
        $('#' + id).remove();
    }
     function removeExcerciseall(clicked_id) {
        var id = 'getexercise' + clicked_id;
        $('#' + id).remove();
    }
function getPartnere(admin_id) {
       // alert(id);
        //var admin_id = $('#admin_id').val();
       // alert(admin_id);
       var partner_id = admin_id;
       //alert(partner_id);
       // if (partner_id) {
            var urls = '<?= $this->Url->build(['controller' => 'DietDirectories', 'action' => 'partnerExcr']) ?>';
            var data = '&partner_id=' + escape(partner_id);
            $.ajax({
                type: "POST",
                cache: false,
                data: data,
                url: urls,
                success: function (html) {
                  //  alert(html);
                   
                        $('#changeexcr').html(html);
                    
                }
            });
        //}
        return false;
    }
    function getOwnexer() {
       var partner_id = '';
       //alert(partner_id);
       // if (partner_id) {
            var urls = '<?= $this->Url->build(['controller' => 'DietDirectories', 'action' => 'partnerExcr']) ?>';
            var data = '&partner_id=' + escape(partner_id);
            $.ajax({
                type: "POST",
                cache: false,
                data: data,
                url: urls,
                success: function (html) {
                    //alert(html);
                   
                        $('#changeexcr').html(html);
                    
                }
            });
        //}
        return false;
    }
    function getpartnerexcr() {
        var partner_id = $('#partner-id').val();
      // alert(partner_id);
        if (partner_id) {
            var urls = '<?= $this->Url->build(['controller' => 'DietDirectories', 'action' => 'partnerExcr']) ?>';
            var data = '&partner_id=' + escape(partner_id);
            $.ajax({
                type: "POST",
                cache: false,
                data: data,
                url: urls,
                success: function (html) {
                  //  alert(html);
                   
                        $('#changeexcr').html(html);
                    
                }
            });
        }
        return false;
    }
    var start = 100;
   function get_Diets() {
        var dietdirectories_id = $('#dietdirectories-id').val();
       // alert(dietdirectories_id);
        var next_id = $('#dietdirectories_id').val();
        var first =  $('#getdiets'+ dietdirectories_id).html();
      //  alert(first);
        if(typeof first === "undefined") {
            first = 'yes';
        } else{
            first = 'no';
        }
       // alert(dietdirectories_id);
        if (dietdirectories_id) {
            var urls = '<?= $this->Url->build(['controller' => 'DietDirectories', 'action' => 'addDiet']) ?>';
            var data = '&dietdirectories_id=' + escape(dietdirectories_id)+'&start='+escape(start)+'&first='+first;
            $.ajax({
                type: "POST",
                cache: false,
                data: data,
                url: urls,
                success: function (html) {
                  //  alert(html);
                    if(first === 'no') {
                        $('#addmore' +dietdirectories_id).append(html);
                        $('#getdietsmore').show();
                    } else {
                        $('#exerDataDiv').append(html);
                    }
                }
            });
        }
        start = start + 1;
        return false;
    }
        
    function get_Dietsmore(clickid) {
        var dietdirectories_id = clickid;
        var next_id = $('#dietdirectories_id').val();
        $('#getdiets'+ dietdirectories_id).show();
        var last     = $('#getdiets'+ dietdirectories_id+' tr').last().attr('class');
        var lasttr   =dietdirectories_id+last;
        var starttr  = dietdirectories_id+start;
        if (dietdirectories_id) {
            var urls = '<?= $this->Url->build(['controller' => 'DietDirectories', 'action' => 'addDiet']) ?>';
            var data = '&dietdirectories_id=' + escape(dietdirectories_id)+'&start='+escape(start);
                $.ajax({
                type: "POST",
                cache: false,
                data: data,
                url: urls,
                success: function (html) {
                    $('#addmore' +dietdirectories_id).append(html);
                    $('#a'+starttr).val($('#a'+lasttr).val());
                    $('#b'+starttr).val($('#b'+lasttr).val());
                    $('#c'+starttr).val($('#c'+lasttr).val());
                    $('#d'+starttr).val($('#d'+lasttr).val());
                    $('#e'+starttr).val($('#e'+lasttr).val());
                    $('#f'+starttr).val($('#f'+lasttr).val());
                    $('#g'+starttr).val($('#g'+lasttr).val());
                    $('#getdietsmore').show();
                }
            });
        }
        start = start + 1;
        return false;
    }
    function getSum2(clicked_id) {
        var res = clicked_id.slice(1, 9);
        var val1 = $('#a' + res).val();
        var val2 = $('#' + clicked_id).val();
        document.getElementById('c' + res).value = val1 * val2;
        return false;
    }

    function getSum(clicked_id) {
        var res = clicked_id.slice(1, 9);
        var sum2 = 3;
        var firstv = res - 1;
        var lastv = firstv + sum2;
        var val1 = $('#a' + firstv).val();
        var val2 = $('#' + clicked_id).val();
        document.getElementById('a' + lastv).value = val1 * val2;
        return false;
    }
</script>