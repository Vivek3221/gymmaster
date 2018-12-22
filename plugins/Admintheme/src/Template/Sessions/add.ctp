<?php
    $status = $this->Common->getstatus();
    $get_exrcisedirectorie_lists = $this->Common->getExrciseDirectories($users_id);
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
                            <?= __('Create Session') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <?= $this->Form->create($session, ['id' => 'addbodys', 'templates' => ['inputContainer' => '{{content}}']]) ?>
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
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('session_type', ['class' => 'form-control', 'type' => 'text', 'label' => FALSE]) ?> 
                                <label class="form-label">Session Type</label>
                            </div>
                        </div>
                        <div id="exerDataDiv" class="col-sm-12" style="margin-bottom: -2px;">                       
                            <?php // data from ajax comes here ?>
                        </div>  
                         <?php if ($user_type == 1) {  ?>
                        <div class="input-group" style="margin-bottom: -12px;">
                            <div id="exerDataDiva" class="col-sm-4"> 
                           <?= $this->Form->control('partner_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select Partner'), 'options' => $partner , 'onchange' => 'getpartnerexcr(this.id)', 'label'=>FALSE]) ?>
                        </div>
                            <div id="exerDataDiva" class="col-sm-4" > 
                            <span id="exrcisedirectorie" onclick="getOwnexer()" class="btn btn-success"><?= __('Own Excercise') ?></span>
                             </div>
                        </div>
                          <?php } ?>
                         <?php if ($user_type == 2) {  ?>
                        <div class="input-group" style="margin-bottom: -12px;">
                            <div id="exerDataDivp" class="col-sm-4"> 
                       <span id="<?= $partner_id ?>" onclick="getPartnere(this.id)" value="<?= $partner_id ?>" class="btn btn-success"><?= __('Admin Excercise') ?></span>
                            </div>
                            <div id="exerDataDivp" class="col-sm-4"> 
                            <span id="<?= $users_id ?>" onclick="getPartnere(this.id)" value="<?= $users_id ?>" class="btn btn-success"><?= __('Own Excercise') ?></span>
                             </div>
                        </div>
                          <?php } if ($user_type == 4) { ?>
                        <div id="exerDataDivp" class="col-sm-4"> 
                       <span id="<?= $AdminofTrainner->partner_id ?>" onclick="getPartnere(this.id)" value="<?= $AdminofTrainner->partner_id ?>" class="btn btn-success"><?= __('Admin Excercise') ?></span>
                            </div>
                          <div id="exerDataDivp" class="col-sm-4"> 
                       <span id="<?= $partner_id ?>" onclick="getPartnere(this.id)" value="<?= $partner_id ?>" class="btn btn-success"><?= __('Own Excercise') ?></span>
                            </div>
                          <?php  } ?>
                        <div class="input-group">
                            <label class="form-label">Exercise</label>
                            <div class="select-m" id="changeexcr">
                            <?= $this->Form->control('exrcisedirectorie_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select Excercise'), 'options' => $get_exrcisedirectorie_lists , 'label'=>FALSE]) ?>
                            </div>
                            <span class="input-group-btn" style="padding-top: 23px;">
                               <span id="exrcisedirectorie" onclick="getExcercise()" class="btn btn-success"><?= __('+ Add Excercise') ?></span>
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
//							console.log('You ' + (state ? '' : 'un') // wrap
//								+ 'selected ' + selectedDate);
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

                                                    if(dd<20) {
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
        var id = 'getexercise' + clicked_id;
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
            var urls = '<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'partnerExcr']) ?>';
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
            var urls = '<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'partnerExcr']) ?>';
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
            var urls = '<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'partnerExcr']) ?>';
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
    function getExcercise() {
        var exrcisedirectorie_id = $('#exrcisedirectorie-id').val();
        var next_id = $('#exrcisedirectorie_id').val();
        var first =  $('#getexercise'+ exrcisedirectorie_id).html();
        if(typeof first === "undefined") {
            first = 'yes';
        } else{
            first = 'no';
        }
       // alert(exrcisedirectorie_id);
        if (exrcisedirectorie_id) {
            var urls = '<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'addExrice']) ?>';
            var data = '&exrcisedirectorie_id=' + escape(exrcisedirectorie_id)+'&start='+escape(start)+'&first='+first;
            $.ajax({
                type: "POST",
                cache: false,
                data: data,
                url: urls,
                success: function (html) {
                  //  alert(html);
                    if(first === 'no') {
                        $('#addmore' +exrcisedirectorie_id).append(html);
                        $('#getexercisemore').show();
                    } else {
                        $('#exerDataDiv').append(html);
                    }
                }
            });
        }
        start = start + 1;
        return false;
    }
        
    function getExcercisemore(clickid) {
        var exrcisedirectorie_id = clickid;
        var next_id = $('#exrcisedirectorie_id').val();
        $('#getexercise'+ exrcisedirectorie_id).show();
        var last     = $('#getexercise'+ exrcisedirectorie_id+' tr').last().attr('class');
        var lasttr   =exrcisedirectorie_id+last;
        var starttr  = exrcisedirectorie_id+start;
        if (exrcisedirectorie_id) {
            var urls = '<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'addExrice']) ?>';
            var data = '&exrcisedirectorie_id=' + escape(exrcisedirectorie_id)+'&start='+escape(start);
                $.ajax({
                type: "POST",
                cache: false,
                data: data,
                url: urls,
                success: function (html) {
                    $('#addmore' +exrcisedirectorie_id).append(html);
                    $('#a'+starttr).val($('#a'+lasttr).val());
                    $('#b'+starttr).val($('#b'+lasttr).val());
                    $('#c'+starttr).val($('#c'+lasttr).val());
                    $('#d'+starttr).val($('#d'+lasttr).val());
                    $('#getexercisemore').show();
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