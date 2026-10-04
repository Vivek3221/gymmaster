<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
$getModPayment = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();
$isAdmin = $this->Common->isAdminUser($usersdetail['users_type'] ?? 0, $usersdetail['users_email'] ?? '');
?>

<style>
/* Modern Payments Edit Styling */
.modern-edit-payment-card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    border: 1px solid #eef2f6;
    overflow: hidden;
    margin-bottom: 30px;
}
.modern-edit-payment-card .header-banner {
    background: linear-gradient(135deg, #ff9800 0%, #e68a00 100%);
    padding: 22px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.modern-edit-payment-card .header-banner h2 {
    color: #ffffff !important;
    font-size: 19px !important;
    font-weight: 700 !important;
    margin: 0 !important;
    display: flex;
    align-items: center;
    gap: 10px;
    letter-spacing: 0.3px;
}
.modern-edit-payment-card .body-container {
    padding: 35px 40px;
}
.modern-form-group {
    margin-bottom: 22px;
}
.modern-form-group label {
    display: block;
    font-size: 12.5px;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}
.modern-form-group .form-control {
    border-radius: 8px !important;
    border: 1.5px solid #cbd5e1 !important;
    padding: 10px 14px !important;
    height: 44px !important;
    font-size: 14px !important;
    box-shadow: none !important;
    background-color: #fafafa !important;
    color: #1e293b !important;
    transition: all 0.25s ease;
}
.modern-form-group .form-control:focus {
    border-color: #ff9800 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 4px rgba(255, 152, 0, 0.15) !important;
}
.modern-form-group .form-control[readonly] {
    background-color: #f1f5f9 !important;
    color: #64748b !important;
    cursor: not-allowed;
    border-color: #e2e8f0 !important;
}
.recalc-card {
    background: #fffbf5;
    border: 1.5px solid #ffd8a8;
    border-radius: 10px;
    padding: 14px 18px;
    margin: 18px 0 24px 0;
}
.recalc-card label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    margin: 0;
    font-size: 13.5px;
    font-weight: 600;
    color: #1e293b;
    user-select: none;
}
.recalc-card input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: #ff9800;
    cursor: pointer;
}
.form-actions-bar {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 30px;
    border-top: 1px solid #f1f5f9;
    padding-top: 24px;
}
.btn-modern-primary {
    background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%) !important;
    color: #fff !important;
    border-radius: 8px !important;
    padding: 12px 28px !important;
    font-weight: 700 !important;
    font-size: 14px !important;
    border: none !important;
    box-shadow: 0 4px 14px rgba(255, 152, 0, 0.3) !important;
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}
.btn-modern-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 152, 0, 0.45) !important;
}
.btn-modern-secondary {
    background: #f8fafc !important;
    color: #475569 !important;
    border-radius: 8px !important;
    padding: 12px 24px !important;
    font-weight: 600 !important;
    font-size: 14px !important;
    border: 1px solid #e2e8f0 !important;
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none !important;
}
.btn-modern-secondary:hover {
    background: #f1f5f9 !important;
    color: #1e293b !important;
}
</style>

<section class="content" style="overflow-x: hidden;">
    <div class="container-fluid" style="max-width: 100%; box-sizing: border-box;">
        <?= $this->Flash->render() ?>

        <div class="modern-edit-payment-card">
            <div class="header-banner">
                <h2>
                    <i class="material-icons">payment</i>
                    <?= __('Update Payments for Exercise Plan of User') ?>
                </h2>
                <a href="<?= $this->Url->build(['controller' => 'Payments', 'action' => 'index']); ?>" class="btn-modern-secondary" style="padding: 6px 14px !important; font-size: 12.5px !important; background: rgba(255,255,255,0.2) !important; color:#fff !important; border:1px solid rgba(255,255,255,0.4) !important;">
                    <i class="material-icons" style="font-size: 16px;">arrow_back</i><?= __('Back to List') ?>
                </a>
            </div>

            <div class="body-container">
                <?= $this->Form->create($payment, [
                    'enctype'   => 'multipart/form-data',
                    'id'        => 'payment',
                    'templates' => ['inputContainer' => '{{content}}']
                ]) ?>

                <div class="modern-form-group">
                    <label><?= __('Select User') ?></label>
                    <?= $this->Form->control('user_id', [
                        'class'    => 'form-control select2',
                        'type'     => 'select',
                        'options'  => $users,
                        'empty'    => __('Select User'),
                        'required' => true,
                        'label'    => false,
                        'onchange' => 'showPlanList(this.value)'
                    ]) ?>
                </div>

                <div class="modern-form-group">
                    <label><?= __('Select Plan') ?></label>
                    <div id="planDiv">
                        <?= $this->Form->control('plan_subscriber_id', [
                            'class'    => 'form-control select2',
                            'type'     => 'select',
                            'options'  => $planSubscribers,
                            'empty'    => __('Select Plan'),
                            'required' => true,
                            'label'    => false,
                            'onchange' => 'showPlanDetails(this.value)'
                        ]) ?>
                    </div>
                </div>

                <div id="planDetailDiv" style="margin-bottom: 22px;"></div>

                <div class="modern-form-group">
                    <label><?= __('Payment Date') ?></label>
                    <?= $this->Form->control('payment_date', [
                        'class'    => 'form-control ' . ($isAdmin ? 'flatpickr-date' : ''),
                        'type'     => 'text',
                        'label'    => false,
                        'readonly' => !$isAdmin,
                        'value'    => $payment->payment_date ? $payment->payment_date->format('Y-m-d') : ($payment->created ? $payment->created->format('Y-m-d') : date('Y-m-d'))
                    ]) ?>
                    <?php if (!$isAdmin): ?>
                        <small style="color: #dc2626; display: block; margin-top: 4px; font-weight: 600;">* Only Super Admin can edit payment dates.</small>
                    <?php endif; ?>
                </div>

                <?php /* Discount Details section commented out per user request
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
                */ ?>

                <div class="modern-form-group">
                    <label><?= __('Net Paid Amount (₹)') ?></label>
                    <?= $this->Form->control('amount', [
                        'class' => 'form-control',
                        'type'  => 'number',
                        'min'   => 0,
                        'id'    => 'paid_amount',
                        'label' => false
                    ]) ?>
                </div>

                <div class="recalc-card">
                    <label>
                        <input type="checkbox" name="recalculate_amount" value="1" id="recalc_chk">
                        <span><?= __('Recalculate payment amount according to selected plan fee') ?></span>
                    </label>
                </div>

                <div class="modern-form-group">
                    <label><?= __('Mode of Payment') ?></label>
                    <?= $this->Form->control('mode_ofpay', [
                        'class'   => 'form-control select2',
                        'type'    => 'select',
                        'empty'   => __('Select Mode Of Payment'),
                        'label'   => false,
                        'options' => $getModPayment
                    ]) ?>
                </div>

                <div class="form-actions-bar">
                    <?= $this->Form->button('<i class="material-icons" style="font-size:18px;vertical-align:middle;margin-top:-2px;">save</i> ' . __('Update Payment'), [
                        'class'       => 'btn-modern-primary waves-effect',
                        'escapeTitle' => false
                    ]) ?>
                    <a href="<?= $this->Url->build(['controller' => 'Payments', 'action' => 'index']) ?>" class="btn-modern-secondary">
                        <i class="material-icons" style="font-size:18px;vertical-align:middle;margin-top:-2px;">close</i><?= __('Cancel') ?>
                    </a>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    function showPlanList(userid) {
        if (userid !== '') {
            var urls = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'showPlanList']) ?>/' + escape(userid);
            $.ajax({
                type: "POST",
                cache: false,
                url: urls,
                success: function (html) {
                   $('#planDiv').html(html);
                   if ($.fn.select2) { $('#planDiv select').select2({ width: '100%' }); }
                }
            });
        }
        return false;
    }
    
    function showPlanDetails(planid) {
        if (planid && planid !== '') {
            var urls = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'showPlanDetails']) ?>/' + escape(planid) + '?amount=<?= $payment->amount ?>';
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
        if ($.fn.select2) {
            $('.select2').select2({ width: '100%' });
        }
        if (typeof flatpickr !== 'undefined') {
            flatpickr('.flatpickr-date', {
                dateFormat: 'Y-m-d',
                allowInput: true,
                monthSelectorType: 'dropdown'
            });
        }
        
        var initialPlanId = $('#plan-subscriber-id').val();
        if (initialPlanId) {
            showPlanDetails(initialPlanId);
        }

        function calculateDiscount() {
            if (!$('#discount_percent').length) return;
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
            if ($('#discount_percent').length) {
                var discPercent = parseFloat($('#discount_percent').val()) || 0;
                var reason = $.trim($('#discount_reason').val());
                if (discPercent > 0 && reason === '') {
                    e.preventDefault();
                    alert('<?= __('Discount Remark / Reason is mandatory when a discount is applied.') ?>');
                    $('#discount_reason').focus();
                    return false;
                }
            }
        });
    });
</script>
