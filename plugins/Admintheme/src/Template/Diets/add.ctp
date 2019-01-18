<?php
    $status = $this->Common->getstatus();
    $get_dietdirectories_lists = $this->Common->getDietsDirectories($users_id);
    //print_r($get_dietdirectories_lists); die;
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
                            <?= __('Create Diet') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <?= $this->Form->create($diet, ['id' => 'addbodys', 'templates' => ['inputContainer' => '{{content}}']]) ?>
                        <?php if ($user_type != 3) {
                            ?>
                            <div class="form-group form-float">
                                <label class="form-label">Select Users</label>
                                <div class="form-line">
                                    <?= $this->Form->control('user_id', ['class' => 'form-control select2 ','multiple'=>'multiple', 'type' => 'select', 'empty' => __('Select User'),  'options' => $user_name ,'label'=>false]) ?> 
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('date', ['id'=>'test-div','class' => 'form-control date-pick dp-applied', 'rows'=>1,'type' => 'textarea', 'placeholder' => 'Select Date', 'label' => FALSE, 'required', 'format' => 'YYYY-MM-DD']) ?>          
                            </div>
                        </div> 
                        <!-- <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('diet_type', ['class' => 'form-control', 'type' => 'text', 'label' => FALSE]) ?> 
                                <label class="form-label">Session Type</label>
                            </div>
                        </div> -->
                        <div id="exerDataDiv" class="col-sm-12" style="margin-bottom: -2px;">                       
                            <?php // data from ajax comes here ?>
                        </div>  
                         <?php if ($user_type == 1) {  ?>
                        <div class="input-group" style="margin-bottom: -12px;">
                            <div id="exerDataDiva" class="col-sm-4"> 
                           <?= $this->Form->control('partner_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select Partner'), 'options' => $partner , 'onchange' => 'getpartnerexcr(this.id)', 'label'=>FALSE]) ?>
                        </div>
                            <div id="exerDataDiva" class="col-sm-4" > 
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
                        <div class="input-group">
                            <label class="form-label">Diets</label>
                            <div class="select-m" id="changeexcr">
                            <?= $this->Form->control('dietdirectories_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select Diet'), 'options' => $get_dietdirectories_lists , 'label'=>FALSE]) ?>
                            </div>
                            <span class="input-group-btn" style="padding-top: 23px;">
                               <span id="dietdirectories" onclick="get_Diets()" class="btn btn-success"><?= __('+ Add Diets') ?></span>
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
</section>
<script type="text/javascript">
            $(function()
            {
                $('.date-pick')
                    .datePicker(
                        {
                            createButton:false,
                            displayClose:true,
                            closeOnSelect:false,
                            selectMultiple:true,
                            numSelectable:7
                        }
                    )
                    .bind(
                        'click',
                        function()
                        {
                            $(this).dpDisplay();
                            this.blur();
                            $('#test-div').html('');
                            return false;
                        }
                    )
                    .bind(
                        'dateSelected',
                        function(e, selectedDate, $td, state)
                        {
//                          console.log('You ' + (state ? '' : 'un') // wrap
//                              + 'selected ' + selectedDate);
                        }
                    )
                    .bind(
                        'dpClosed',
                        function(e, selectedDates)
                        {
                                                    $.each( selectedDates, function( key, selectedDate ) {
                                                        var dd = selectedDate.getDate();
                                                    var mm = selectedDate.getMonth()+1; //January is 0!
                                                    var yyyy = selectedDate.getFullYear();

                                                    if(dd<10) {
                                                        dd = '0'+dd
                                                    } 

                                                    if(mm<10) {
                                                        mm = '0'+mm
                                                    } 
                                                    selectedDate = yyyy + '-' + mm + '-' + dd+',';
                                                        $('#test-div').append(selectedDate);
                                                        
                                                      });
                        }
                    );
            });

    $(document).ready(function () {
        $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD', lang: 'fr', weekStart: 1, cancelText: 'Cancel', minDate: new Date(), time: 'false'});
        $('').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});
    });

    function removeExcercise(clicked_id) {
        var id = 'remove' + clicked_id;
        $('#' + id).remove();
    }
    function removeExcerciseall(clicked_id) {
        var id = 'getdiets' + clicked_id;
        $('#' + id).remove();
    }
    
    var start = 100;
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
                    $('#getdietsmore').show();
                }
            });
        }
        start = start + 1;
        return false;
    }
        
    function getSum2(clicked_id){
        var res = clicked_id.slice(1,9); 
        var val1 = $('#a'+res).val();
        var val2 = $('#'+clicked_id).val();
        document.getElementById('c'+res).value = val1 * val2;
        return false;
    }
</script>