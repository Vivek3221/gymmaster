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
                            <?= __('Update Payments for Exercise Plan of User') ?>
                        </h2>

                    </div>
                    <div class="body">
                        <div  id="hidePayment"class="form-btn text-center">

                            <button  class="btn btn-primary waves-effect" onclick="makePayment()">Update Payment</button>

                            <a href="<?= $this->Url->build(['controller' => 'Payments', 'action' => 'index']) ?>" class="">Update Later</a>
                        </div>
                        <div class="" id="makepayment" hidden="">
                        <?= $this->Form->create($payment, ['enctype' => 'multipart/form-data','id' => 'payment','templates' => ['inputContainer' => '{{content}}']]) ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('user_id', ['class' => 'form-control', 'type' => 'select','options' => $users, 'empty'=>'Select User', 'required', 'label'=>'Select User','onchange'=>'showPlanList(this.value)']) ?>
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
                                <label style="font-weight:600;color:#555;font-size:12px;"><?= __('Payment Date') ?></label>
                                <?= $this->Form->control('payment_date', [
                                    'class' => 'form-control',
                                    'type' => 'date',
                                    'label' => false,
                                    'value' => $payment->payment_date ? $payment->payment_date->format('Y-m-d') : ($payment->created ? $payment->created->format('Y-m-d') : date('Y-m-d'))
                                ]) ?>
                            </div>
                        </div>

                        <div class="row" style="background:#f9f9f9;border-radius:8px;padding:15px;margin:15px 0;border:1px dashed #ddd;">
                            <div class="col-sm-12">
                                <h4 style="font-size:14px;font-weight:700;color:#333;margin-top:0;margin-bottom:10px;">
                                    <i class="material-icons" style="font-size:16px;vertical-align:middle;color:#ff9800;">local_offer</i> <?= __('Discount Details') ?>
                                </h4>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float" style="margin-bottom:10px;">
                                    <label style="font-weight:600;color:#555;font-size:12px;"><?= __('Discount (%)') ?></label>
                                    <div class="form-line">
                                        <?= $this->Form->control('discount_percent', [
                                            'class' => 'form-control',
                                            'type' => 'number',
                                            'step' => '0.01',
                                            'min' => 0,
                                            'max' => 100,
                                            'id' => 'discount_percent',
                                            'label' => false,
                                            'placeholder' => '0%'
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float" style="margin-bottom:10px;">
                                    <label style="font-weight:600;color:#555;font-size:12px;"><?= __('Discount Amount (₹)') ?></label>
                                    <div class="form-line">
                                        <?= $this->Form->control('discount_amount', [
                                            'class' => 'form-control',
                                            'type' => 'number',
                                            'step' => '0.01',
                                            'id' => 'discount_amount',
                                            'label' => false,
                                            'placeholder' => '₹0.00'
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float" style="margin-bottom:0;">
                                    <label style="font-weight:600;color:#555;font-size:12px;">
                                        <?= __('Discount Remark / Reason') ?> <span id="reason_req_mark" style="color:red;display:none;">*</span>
                                    </label>
                                    <div class="form-line">
                                        <?= $this->Form->control('discount_reason', [
                                            'class' => 'form-control',
                                            'type' => 'textarea',
                                            'rows' => 2,
                                            'id' => 'discount_reason',
                                            'label' => false,
                                            'placeholder' => __('Enter mandatory reason when discount is given (e.g., referral, festive promo, special approval)')
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <label style="font-weight:600;color:#555;font-size:12px;"><?= __('Net Paid Amount (₹)') ?></label>
                                <?= $this->Form->control('amount', ['class' => 'form-control', 'type' => 'number', 'min'=>0, 'id' => 'paid_amount', 'label' => false]) ?>
                            </div>
                        </div>

                        <div class="form-group form-float" style="margin-top:10px;margin-bottom:15px;">
                            <label style="font-weight:600;color:#333;font-size:13px;display:flex;align-items:center;gap:8px;cursor:pointer;">
                                <input type="checkbox" name="recalculate_amount" value="1" id="recalc_chk" style="width:18px;height:18px;cursor:pointer;">
                                <span><?= __('Recalculate payment amount according to selected plan fee') ?></span>
                            </label>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('mode_ofpay', ['class' => 'form-control', 'type' => 'select','empty'=>'Select Mode Of Payment','label' => 'Mode Of Payment','options'=>$getModPayment]) ?>
                            </div>
                        </div>
                        <div class="form-btn text-center" style="margin-top:20px;">
                            <?= $this->Form->button(__('Update Payment'), ['class' => 'btn btn-primary waves-effect', 'style' => 'border-radius:6px;padding:8px 24px;font-weight:600;']) ?>
                           <a href="<?= $this->Url->build(['controller' => 'Payments', 'action' => 'index']) ?>" class="btn btn-default waves-effect" style="margin-left:10px;border-radius:6px;padding:8px 20px;"><?= __('Cancel') ?></a>
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
            var urls = urls+'/' + escape(planid)+'?amount=<?= $payment->amount ?>';
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
        showPlanDetails($('#plan-subscriber-id').val());

        function calculateDiscount() {
            var fee = parseFloat($('#fee').val()) || parseFloat($('#paid_amount').val()) || 0;
            var discPercent = parseFloat($('#discount_percent').val()) || 0;

            if (discPercent > 0) {
                $('#reason_req_mark').show();
                $('#discount_reason').prop('required', true);
                var discAmt = Math.round((fee * discPercent / 100) * 100) / 100;
                $('#discount_amount').val(discAmt);
                if ($('#recalc_chk').is(':checked')) {
                    var netAmt = Math.max(0, fee - discAmt);
                    $('#paid_amount').val(netAmt);
                }
            } else {
                $('#reason_req_mark').hide();
                $('#discount_reason').prop('required', false);
                $('#discount_amount').val('0.00');
                if ($('#recalc_chk').is(':checked')) {
                    $('#paid_amount').val(fee);
                }
            }
        }

        $('#discount_percent').on('input change', calculateDiscount);
        $('#recalc_chk').on('change', calculateDiscount);

        $('#payment').on('submit', function(e) {
            var discPercent = parseFloat($('#discount_percent').val()) || 0;
            var reason = $.trim($('#discount_reason').val());
            if (discPercent > 0 && reason === '') {
                e.preventDefault();
                alert('<?= __('Discount Remark / Reason is mandatory when a discount is applied.') ?>');
                $('#discount_reason').focus();
                return false;
            }
        });
    });
</script>
