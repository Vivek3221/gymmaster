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
                            <?= __('Update Exercise Plan for User') ?>
                        </h2>

                    </div>
                    <div class="body">
                        <div  id="hidePayment"class="form-btn text-center">
                            <button  class="btn btn-primary waves-effect" onclick="makePayment()">Update Plan</button>
                            <a href="<?= $this->Url->build(['controller' => 'PlanSubscribers', 'action' => 'index']) ?>" class="">Update Later</a>
                        </div>
                        <div class="" id="makepayment" hidden="">
                        <?= $this->Form->create($planSubscriber, ['id' => 'payment','templates' => ['inputContainer' => '{{content}}']]) ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('user_id', ['class' => 'form-control', 'type' => 'select','required', 'label' => 'Select User']) ?>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('plan_name', ['class' => 'form-control', 'type' => 'text','required', 'label' => false]) ?>
                                <label class="form-label">Plan Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('fee', ['class' => 'form-control', 'type' => 'number','required', 'label' => false]) ?>
                                <label class="form-label">Plan Total Fee</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('plan_expire_date', ['class' => 'form-control', 'type' => 'text','label' => FALSE ,'required', 'value'=>date('Y-m-d H:i:s',strtotime($planSubscriber['plan_expire_date']))]) ?>          
                                <label class="form-label">Plan Expire Date</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('payment_due_date', ['class' => 'form-control', 'type' => 'text', 'label' => FALSE, 'value'=>date('Y-m-d H:i:s',strtotime($planSubscriber['payment_due_date'])) ]) ?>          
                                <label class="form-label">Payment Due Date</label>
                            </div>
                        </div> 
                        <div class="form-btn text-center">
                            <?= $this->Form->button('Update Plan', ['class' => 'btn btn-primary waves-effect']) ?>
                           <a href="<?= $this->Url->build(['controller' => 'PlanSubscribers', 'action' => 'index']) ?>" class="">Update Later</a>
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

    $(document).ready(function () {
        $('#payment-due-date').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD HH:mm', minDate : new Date() });
        $('#plan-expire-date').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD HH:mm', minDate : new Date() });
        $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD HH:mm', lang: 'fr', weekStart: 1, cancelText: 'Cancel', maxDate: new Date()});
        $('').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});
    });

</script>
