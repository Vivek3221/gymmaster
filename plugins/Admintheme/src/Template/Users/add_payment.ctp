<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
$getModPayment = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();
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
                            <?= __('Add Payments for Exercise Plan of User') ?>
                        </h2>

                    </div>
                    <div class="body">
                        <div  id="hidePayment"class="form-btn text-center">

                            <button  class="btn btn-primary waves-effect" onclick="makePayment()">Add Payment</button>

                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="">Payment Later</a>
                        </div>
                        <div class="" id="makepayment" hidden="">
                        <?= $this->Form->create($payment, ['enctype' => 'multipart/form-data','id' => 'payment','templates' => ['inputContainer' => '{{content}}']]) ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('user_id', ['class' => 'form-control', 'type' => 'select','options' => $users, 'empty'=>'Select User', 'required', 'label'=>'Select User','default'=>$userid, 'onchange'=>'showPlanList(this.value)']) ?>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line" id="planDiv">
                                <?= $this->Form->control('plan_subscriber_id', ['class' => 'form-control', 'type' => 'select','options' => $planSubscribers, 'empty'=>'Select Plan', 'required', 'label'=>'Select Plan', 'onchange'=>'showPlanDetails(this.value)']) ?>
                            </div>
                        </div>
                            <div class="row" id="planDetailDiv">

                        </div>    
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('amount', ['class' => 'form-control', 'type' => 'number', 'min'=>0, 'label' => 'Amount']) ?>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('mode_ofpay', ['class' => 'form-control', 'type' => 'select','empty'=>'Select Mode Of Payment','label' => 'Mode Of Payment','options'=>$getModPayment]) ?>
                            </div>
                        </div>
                       <div class="form-btn text-center">
                            <?= $this->Form->button('Add Payment', ['class' => 'btn btn-primary waves-effect']) ?>
                           <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="">Payment Later</a>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script type="text/javascript">

    function makePayment()
    {
        $('#makepayment').show();
        $('#hidePayment').hide();
    }
    
    /*
     * get users plan list
     */
    function showPlanList(userid) {
        if (userid !== '') {
            var urls = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'showPlanList']) ?>';
            var urls = urls+'/' + escape(userid);
            $.ajax({
                type: "POST",
                cache: false,
                url: urls,
                success: function (html) {
                   $('#planDiv').html(html);
                }
            });
        }
        return false;
    }
    
    /*
     * get selected plan details
     */
    function showPlanDetails(planid) {
        if (planid !== '') {
            var urls = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'showPlanDetails']) ?>';
            var urls = urls+'/' + escape(planid);
            $.ajax({
                type: "POST",
                cache: false,
                url: urls,
                success: function (html) {
                   $('#planDetailDiv').html(html);
                }
            });
        } else {
            $('#planDetailDiv').html('');
        }
        return false;
    }
    
    $(document).ready(function () {
        $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD HH:mm', lang: 'fr', weekStart: 1, cancelText: 'Cancel', maxDate: new Date()});
        $('').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});
    });

</script>
