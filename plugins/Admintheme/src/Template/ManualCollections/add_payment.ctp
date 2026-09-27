<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
$getModPayment = $this->Common->getModPayment();
?>
<style>
/* ─── Compact Modern Design System for Add Payment ─── */
.payment-wrapper {
    max-width: 860px;
    margin: 10px auto;
    padding: 0 15px;
}
.payment-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
    border: 1px solid #eef2f6;
    overflow: hidden;
}
.payment-header {
    padding: 14px 24px;
    background: linear-gradient(135deg, #e8f5e9 0%, #fafbfe 100%);
    border-bottom: 1px solid #f1f4f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.payment-header h2 {
    font-size: 16px;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.payment-header h2 i {
    color: #4caf50;
    font-size: 20px;
}
.payment-body {
    padding: 20px 24px;
}

/* Two-column layout grid to fit in one screen */
.compact-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px 20px;
}
@media (max-width: 600px) {
    .compact-grid {
        grid-template-columns: 1fr;
    }
}

.form-group {
    margin-bottom: 12px;
    display: flex;
    flex-direction: column;
}
.form-group label {
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
}
.form-group input,
.form-group .form-control {
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
    font-size: 13.5px !important;
    color: #334155 !important;
    background-color: #f8fafc !important;
    outline: none !important;
    height: 38px !important;
    box-sizing: border-box !important;
    box-shadow: none !important;
}
.form-group input:focus {
    border-color: #4caf50 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.12) !important;
}

/* Style Select2 containers to look modern & premium */
.payment-card .select2-container {
    display: block;
    width: 100% !important;
}
.payment-card .select2-container--default .select2-selection--single {
    height: 38px !important;
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 8px !important;
    background: #f8fafc !important;
    box-shadow: none !important;
    display: flex;
    align-items: center;
    width: 100% !important;
}
.payment-card .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 38px !important;
    padding-left: 12px !important;
    color: #334155 !important;
    font-size: 13.5px !important;
}
.payment-card .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px !important;
    right: 8px !important;
}
.payment-card .select2-container--default.select2-container--focus .select2-selection--single,
.payment-card .select2-container--default.select2-container--open .select2-selection--single {
    border-color: #4caf50 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1) !important;
    outline: none !important;
}
.mc-s2-drop {
    border: 1px solid #81c784 !important;
    border-radius: 8px !important;
    box-shadow: 0 4px 16px rgba(0,0,0,.08) !important;
}
.mc-s2-drop .select2-results__option--highlighted {
    background: #4caf50 !important;
    color: #fff !important;
}

/* Plan details box */
#planDetailDiv {
    grid-column: 1 / -1;
    background: #f1f8e9;
    border: 1px solid #c8e6c9;
    border-radius: 8px;
    padding: 10px 16px;
    font-size: 13px;
    color: #2e7d32;
    animation: fadeIn 0.3s ease;
    display: flex;
    flex-wrap: wrap;
    gap: 12px 24px;
}
#planDetailDiv > div {
    display: inline-block;
}

/* Action Area */
.form-actions {
    grid-column: 1 / -1;
    margin-top: 14px;
    padding-top: 14px;
    border-top: 1px solid #f1f4f9;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
}
.btn-save {
    background: linear-gradient(135deg, #4caf50 0%, #388e3c 100%) !important;
    color: #ffffff !important;
    border: none;
    border-radius: 8px;
    padding: 10px 24px;
    font-size: 13.5px;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
    box-shadow: 0 3px 10px rgba(76, 175, 80, 0.18);
    height: 38px;
}
.btn-save:hover {
    transform: translateY(-1px);
    box-shadow: 0 5px 14px rgba(76, 175, 80, 0.25);
}
.btn-cancel {
    background: #f8fafc;
    color: #64748b;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
    height: 38px;
    box-sizing: border-box;
}
.btn-cancel:hover {
    background: #f1f5f9;
    color: #334155;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(3px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<section class="content">
    <div class="container-fluid">
        <div class="payment-wrapper">
            <?= $this->Flash->render() ?>

            <div class="payment-card">
                <!-- Header -->
                <div class="payment-header">
                    <h2>
                        <i class="material-icons">payments</i>
                        <?= __('Add Payments for Exercise Plan of User') ?>
                    </h2>
                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-cancel" style="padding:6px 12px;font-size:12.5px;height:auto;">
                        <i class="material-icons" style="font-size:15px;">arrow_back</i> <?= __('Back') ?>
                    </a>
                </div>

                <div class="payment-body">
                    <!-- Form -->
                    <div id="makepayment">
                        <?= $this->Form->create($payment, ['enctype' => 'multipart/form-data','id' => 'payment','templates' => ['inputContainer' => '{{content}}']]) ?>
                        
                        <div class="compact-grid">
                            <div class="form-group">
                                <label><?= __('Select User') ?></label>
                                <div class="form-line">
                                    <?= $this->Form->control('user_id', ['class' => 'form-control select2', 'type' => 'select','options' => $users, 'empty'=>'Select User', 'required', 'label'=>false,'default'=>$userid, 'onchange'=>'showPlanList(this.value)']) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><?= __('Select Plan') ?></label>
                                <div class="form-line" id="planDiv">
                                    <?= $this->Form->control('plan_subscriber_id', ['class' => 'form-control select2', 'type' => 'select','options' => $planSubscribers, 'empty'=>'Select Plan', 'required', 'label'=>false, 'onchange'=>'showPlanDetails(this.value)']) ?>
                                </div>
                            </div>

                            <div id="planDetailDiv" style="display:none; grid-column: 1 / -1;">
                                <!-- Filled dynamically via AJAX -->
                            </div>

                            <div class="form-group">
                                <label><?= __('Collection / Payment Date') ?> <span style="color:red">*</span></label>
                                <div class="form-line">
                                    <input type="text" name="payment_date" id="paymentDate" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" value="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><?= __('Discount (%)') ?></label>
                                <div class="form-line">
                                    <input type="number" step="0.01" min="0" max="100" id="discountPercent" name="discount_percent" class="form-control" placeholder="0%">
                                </div>
                            </div>

                            <div class="form-group">
                                <label><?= __('Discount Amount (₹)') ?></label>
                                <div class="form-line">
                                    <input type="number" step="0.01" min="0" id="discountAmount" name="discount_amount" class="form-control" placeholder="₹0.00">
                                </div>
                            </div>

                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label><?= __('Discount Remark / Reason') ?> <span id="reasonReqMark" style="color:red;display:none;">*</span></label>
                                <div class="form-line">
                                    <textarea id="discountReason" name="discount_reason" rows="2" class="form-control" placeholder="<?= __('Mandatory remark when discount is applied (e.g. promo, referral, special approval)') ?>" style="border-radius:8px;border:1.5px solid #e2e8f0;padding:8px 12px;font-size:13.5px;width:100%;box-sizing:border-box;background:#f8fafc;"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><?= __('Amount (₹)') ?> <span style="color:red">*</span></label>
                                <div class="form-line">
                                    <?= $this->Form->control('amount', ['class' => 'form-control', 'type' => 'number', 'min'=>0, 'label' => false, 'id' => 'amountPaid', 'placeholder' => 'Enter payment amount', 'required' => true]) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><?= __('Mode Of Payment') ?></label>
                                <div class="form-line">
                                    <?= $this->Form->control('mode_ofpay', ['class' => 'form-control select2', 'type' => 'select','empty'=>'Select Mode Of Payment','label' => false,'options'=>$getModPayment, 'required' => true]) ?>
                                </div>
                            </div>

                            <div class="form-actions" style="grid-column: 1 / -1;">
                                <?= $this->Form->button('<i class="material-icons" style="font-size:16px;vertical-align:middle;">check_circle</i> Add Payment', ['class' => 'btn-save', 'escapeTitle' => false]) ?>
                                <a href="<?= $this->Url->build(['controller' => 'ManualCollections', 'action' => 'index']) ?>" class="btn-cancel">
                                    <?= __('Payment Later') ?>
                                </a>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    /*
     * get users plan list
     */
    function showPlanList(userid) {
        if (userid !== '') {
            var urls = '<?= $this->Url->build(['controller' => 'ManualCollections', 'action' => 'showPlanList']) ?>';
            var urls = urls+'/' + escape(userid);
            $.ajax({
                type: "POST",
                cache: false,
                url: urls,
                success: function (html) {
                   $('#planDiv').html(html);
                   // Safe check to re-initialize select2 if loaded
                   if ($.isFunction($.fn.select2)) {
                       $('#planDiv select').select2({ dropdownCssClass: 'mc-s2-drop' });
                   }
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
            var urls = '<?= $this->Url->build(['controller' => 'ManualCollections', 'action' => 'showPlanDetails']) ?>';
            var urls = urls+'/' + escape(planid);
            $.ajax({
                type: "POST",
                cache: false,
                url: urls,
                success: function (html) {
                   $('#planDetailDiv').html(html).show();
                   var remFee = parseFloat($('#fee').val()) || 0;
                   if (remFee > 0 && !$('#amountPaid').val()) {
                       $('#amountPaid').val(remFee);
                   }
                   recalcDiscount();
                }
            });
        } else {
            $('#planDetailDiv').html('').hide();
        }
        return false;
    }

    function recalcDiscount() {
        var baseFee = parseFloat($('#fee').val()) || 0;
        var dPct = parseFloat($('#discountPercent').val()) || 0;
        var dAmt = parseFloat($('#discountAmount').val()) || 0;

        if (dPct > 0 || dAmt > 0) {
            $('#reasonReqMark').show();
            $('#discountReason').prop('required', true);
        } else {
            $('#reasonReqMark').hide();
            $('#discountReason').prop('required', false);
        }
    }

    $('#discountPercent').on('input', function() {
        var baseFee = parseFloat($('#fee').val()) || 0;
        var pct = parseFloat($(this).val()) || 0;
        if (pct > 100) { pct = 100; $(this).val(100); }
        if (pct < 0) { pct = 0; $(this).val(0); }
        if (baseFee > 0) {
            var dAmt = Math.round((baseFee * pct / 100) * 100) / 100;
            $('#discountAmount').val(dAmt > 0 ? dAmt : '');
            var finalPay = Math.max(0, Math.round((baseFee - dAmt) * 100) / 100);
            $('#amountPaid').val(finalPay);
        }
        recalcDiscount();
    });

    $('#discountAmount').on('input', function() {
        var baseFee = parseFloat($('#fee').val()) || 0;
        var dAmt = parseFloat($(this).val()) || 0;
        if (baseFee > 0) {
            if (dAmt > baseFee) { dAmt = baseFee; $(this).val(baseFee); }
            var pct = Math.round((dAmt / baseFee * 100) * 100) / 100;
            $('#discountPercent').val(pct > 0 ? pct : '');
            var finalPay = Math.max(0, Math.round((baseFee - dAmt) * 100) / 100);
            $('#amountPaid').val(finalPay);
        }
        recalcDiscount();
    });

    $('#payment').on('submit', function(e) {
        var dPct = parseFloat($('#discountPercent').val()) || 0;
        var dAmt = parseFloat($('#discountAmount').val()) || 0;
        var reason = $.trim($('#discountReason').val());
        if ((dPct > 0 || dAmt > 0) && reason === '') {
            e.preventDefault();
            alert('Discount remark/reason is mandatory whenever a discount is applied.');
            $('#discountReason').focus();
            return false;
        }
    });
    
    $(document).ready(function () {
        $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD HH:mm', lang: 'fr', weekStart: 1, cancelText: 'Cancel', maxDate: new Date()});
    });
</script>
