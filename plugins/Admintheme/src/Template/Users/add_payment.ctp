<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
$getModPayment = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
/* Suppress old bootstrap date picker */
.dtp, .dtp * {
    display: none !important;
    visibility: hidden !important;
    pointer-events: none !important;
    z-index: -9999 !important;
}

/* ── Full-Page Payment Form ── */
.apm-section {
    padding: 18px 22px;
}
.apm-card {
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    border: 1px solid #e2e8f0;
    overflow: hidden;
}
.apm-header {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    padding: 20px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}
.apm-header h2 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 10px;
}
.apm-header h2 i { color: #ff9800; font-size: 22px; }
.apm-body { padding: 28px 28px 20px; }

/* 2-column responsive grid */
.apm-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px 24px;
}
.apm-grid .full-col { grid-column: 1 / -1; }

/* Field styles */
.apm-field { display: flex; flex-direction: column; }
.apm-field label {
    font-size: 12.5px;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 4px;
}
.apm-field label span { color: #ef4444; font-size: 14px; text-transform: none; }
.apm-field input,
.apm-field select,
.apm-field textarea {
    border: 1.5px solid #cbd5e1 !important;
    border-radius: 9px !important;
    padding: 10px 14px !important;
    font-size: 14px !important;
    color: #1e293b !important;
    background: #f8fafc !important;
    box-shadow: none !important;
    transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
    width: 100%;
    box-sizing: border-box;
    position: relative !important;
    z-index: 2 !important;
    pointer-events: all !important;
    cursor: text !important;
    height: 44px !important;
}
.apm-field input:focus,
.apm-field select:focus {
    border-color: #ff9800 !important;
    background: #fff !important;
    box-shadow: 0 0 0 3px rgba(255,152,0,0.14) !important;
    outline: none !important;
}
/* Kill AdminBSB overlay */
.apm-field .form-line { border-bottom: none !important; }
.apm-field .form-line:after { display: none !important; }
.apm-field .form-label { display: none !important; pointer-events: none !important; }

#amountPaid {
    position: relative !important;
    z-index: 10 !important;
    pointer-events: auto !important;
    cursor: text !important;
    -webkit-user-select: text !important;
    user-select: text !important;
    background: #ffffff !important;
}

/* ── Plan detail strip ── */
.plan-info-strip {
    background: linear-gradient(135deg, #fff8e1 0%, #fff3cd 100%);
    border: 1px solid #ffe082;
    border-radius: 10px;
    padding: 14px 20px;
    display: none;
}
.plan-info-strip.visible { display: block; }
.plan-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 10px 20px;
}
.plan-info-item { display: flex; flex-direction: column; gap: 2px; }
.plan-info-label {
    font-size: 10.5px;
    font-weight: 700;
    color: #92400e;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.plan-info-value {
    font-size: 14px;
    font-weight: 800;
    color: #1e293b;
}
.plan-info-value.remaining { color: #e65100; }
.plan-info-value.paid { color: #15803d; }

/* ── Amount helper ── */
.amount-helper {
    margin-top: 5px;
    font-size: 12px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 4px;
}
.amount-helper .chip {
    background: #e0f2fe;
    color: #0369a1;
    border-radius: 20px;
    padding: 2px 10px;
    font-weight: 700;
    font-size: 12px;
    cursor: pointer;
    border: none;
    transition: background 0.2s;
}
.amount-helper .chip:hover { background: #bae6fd; }
.amount-helper .chip.orange { background: #fff3e0; color: #e65100; }
.amount-helper .chip.orange:hover { background: #ffe0b2; }

/* ── Payment date with icon ── */
.date-input-wrap {
    position: relative;
    display: flex;
    align-items: center;
}
.date-input-wrap input { padding-right: 44px !important; cursor: pointer !important; background: #fff !important; }
.date-input-wrap i {
    position: absolute;
    right: 14px;
    color: #64748b;
    font-size: 20px;
    pointer-events: none;
}

/* ── Validation error ── */
.apm-error-box {
    background: #fff5f5;
    border: 1px solid #fed7d7;
    color: #c53030;
    padding: 12px 16px;
    border-radius: 9px;
    margin-bottom: 18px;
    font-size: 13px;
}
.apm-error-box ul { margin: 6px 0 0 18px; padding: 0; }

/* ── Actions ── */
.apm-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 22px;
    padding-top: 18px;
    border-top: 1px solid #f1f5f9;
}
.btn-apm-submit {
    background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 9px !important;
    padding: 12px 28px !important;
    font-size: 14.5px !important;
    font-weight: 700 !important;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(255,152,0,0.28) !important;
    transition: all 0.2s ease;
}
.btn-apm-submit:hover {
    background: linear-gradient(135deg, #f57c00 0%, #e65100 100%) !important;
    box-shadow: 0 6px 20px rgba(255,152,0,0.38) !important;
    transform: translateY(-1px);
}
.btn-apm-cancel {
    background: #f1f5f9 !important;
    color: #475569 !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 9px !important;
    padding: 12px 20px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
}
.btn-apm-cancel:hover { background: #e2e8f0 !important; color: #1e293b !important; }

/* ── Modern Discount Block ── */
.discount-toggle-card {
    background: #f8fafc;
    border: 1.5px dashed #cbd5e1;
    border-radius: 10px;
    padding: 14px 18px;
    transition: all 0.25s ease;
    margin-bottom: 4px;
}
.discount-toggle-card.is-active {
    background: #f0f9ff;
    border-color: #0284c7;
    border-style: solid;
    box-shadow: 0 4px 14px rgba(2, 132, 199, 0.08);
}
.discount-checkbox-label {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0 !important;
    cursor: pointer;
    font-size: 14px !important;
    font-weight: 700 !important;
    color: #0f172a !important;
    text-transform: none !important;
    letter-spacing: normal !important;
}
.discount-checkbox-label input[type="checkbox"] {
    width: 18px !important;
    height: 18px !important;
    accent-color: #0284c7;
    cursor: pointer;
    margin: 0 !important;
}
.discount-details-body {
    display: none;
    margin-top: 14px;
    padding-top: 12px;
    border-top: 1px solid #e2e8f0;
}
.discount-type-selector {
    display: flex;
    gap: 10px;
    margin-bottom: 12px;
}
.discount-type-option {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 12px;
    background: #ffffff;
    border: 1.5px solid #cbd5e1;
    border-radius: 8px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    transition: all 0.2s ease;
}
.discount-type-option input[type="radio"] {
    margin: 0 !important;
    width: 14px !important;
    height: 14px !important;
    accent-color: #0284c7;
}
.discount-type-option.active {
    background: #e0f2fe;
    border-color: #0284c7;
    color: #0369a1;
    font-weight: 700;
}
.discount-inputs-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

@media (max-width: 768px) {
    .apm-grid { grid-template-columns: 1fr; }
    .apm-grid .full-col { grid-column: 1; }
    .discount-inputs-grid { grid-template-columns: 1fr; }
}
</style>

<section class="content apm-section">
    <div class="apm-card">
        <!-- Header -->
        <div class="apm-header">
            <h2>
                <i class="material-icons">payments</i>
                <?= __('Collect Payment') ?>
            </h2>
        </div>

        <div class="apm-body">
            <?= $this->Flash->render() ?>

            <?php if (!empty($payment) && $payment->getErrors()): ?>
                <div class="apm-error-box">
                    <div style="font-weight:700; display:flex; align-items:center; gap:6px; margin-bottom:4px;">
                        <i class="material-icons" style="font-size:18px;">error_outline</i>
                        <?= __('Please fix the following errors:') ?>
                    </div>
                    <ul>
                        <?php foreach ($payment->getErrors() as $field => $errs): ?>
                            <?php foreach ($errs as $err): ?>
                                <li><strong><?= h(ucwords(str_replace('_', ' ', $field))) ?>:</strong> <?= h($err) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?= $this->Form->create($payment, [
                'enctype'   => 'multipart/form-data',
                'id'        => 'paymentForm',
                'templates'  => ['inputContainer' => '{{content}}']
            ]) ?>

            <div class="apm-grid">

                <!-- Select User -->
                <div class="apm-field">
                    <label><?= __('Member / User') ?> <span>*</span></label>
                    <?= $this->Form->control('user_id', [
                        'class'    => 'form-control select2',
                        'type'     => 'select',
                        'options'  => $users,
                        'empty'    => __('Search & select member...'),
                        'required' => true,
                        'label'    => false,
                        'default'  => $userid,
                        'onchange' => 'showPlanList(this.value)'
                    ]) ?>
                </div>

                <!-- Select Plan -->
                <div class="apm-field">
                    <label><?= __('Subscription Plan') ?> <span>*</span></label>
                    <div id="planDiv">
                        <?= $this->Form->control('plan_subscriber_id', [
                            'class'    => 'form-control select2',
                            'type'     => 'select',
                            'options'  => $planSubscribers,
                            'empty'    => __('Select plan...'),
                            'required' => true,
                            'label'    => false,
                            'onchange' => 'showPlanDetails(this.value)'
                        ]) ?>
                    </div>
                </div>

                <!-- Plan Detail Strip (full width, hidden until plan selected) -->
                <div class="full-col" id="planDetailDiv"></div>

                <!-- Apply Discount Toggle Card -->
                <!-- <div class="full-col">
                    <div class="discount-toggle-card" id="discountToggleCard">
                        <label class="discount-checkbox-label" for="applyDiscountToggle">
                            <input type="checkbox" id="applyDiscountToggle" name="apply_discount" value="1">
                            <span><?= __('Apply Discount on this Payment?') ?></span>
                        </label>

                        <div class="discount-details-body" id="discountDetailsBody">
                            <div style="font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; margin-bottom:8px;">
                                <?= __('Choose Discount Type') ?>:
                            </div>

                            <div class="discount-type-selector">
                                <label class="discount-type-option active" id="typeOptionPercent">
                                    <input type="radio" name="discount_type" value="percent" checked>
                                    <span><?= __('Percentage (%)') ?></span>
                                </label>
                                <label class="discount-type-option" id="typeOptionFixed">
                                    <input type="radio" name="discount_type" value="fixed">
                                    <span><?= __('Fixed Amount (₹)') ?></span>
                                </label>
                            </div>

                            <div class="discount-inputs-grid">
                                <div class="apm-field">
                                    <label><?= __('Discount (%)') ?></label>
                                    <input type="text" inputmode="decimal" pattern="[0-9]*\.?[0-9]*" id="discountPercent" name="discount_percent" class="form-control" placeholder="0.00" autocomplete="off">
                                </div>
                                <div class="apm-field">
                                    <label><?= __('Discount Amount (₹)') ?></label>
                                    <input type="text" inputmode="decimal" pattern="[0-9]*\.?[0-9]*" id="discountAmount" name="discount_amount" class="form-control" placeholder="0.00" autocomplete="off">
                                </div>
                            </div>

                            <div class="apm-field" style="margin-top:10px;">
                                <label><?= __('Discount Reason / Remark') ?> <span style="color:red">*</span></label>
                                <textarea id="discountReason" name="discount_reason" rows="2" class="form-control" placeholder="<?= __('Mandatory remark when discount is applied (e.g. promo coupon, referral, special approval)') ?>" style="border-radius:6px;border:1.5px solid #cbd5e1;padding:8px 12px;font-size:13px;width:100%;box-sizing:border-box;"></textarea>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Amount Being Paid -->
                <div class="apm-field full-col">
                    <label><?= __('Amount Being Paid (₹)') ?> <span>*</span></label>
                    <input type="number"
                           step="any"
                           min="0"
                           id="amountPaid"
                           name="amount"
                           class="form-control"
                           placeholder="Enter amount (partial or full payment allowed)"
                           required
                           autocomplete="off">
                    <div class="amount-helper">
                        <i class="material-icons" style="font-size:14px; color:#94a3b8;">info</i>
                        <span>Plan fee: <strong id="planFeeLabel">—</strong> &nbsp;|&nbsp; Remaining: <strong id="remainingLabel" style="color:#e65100;">—</strong> <span id="helperDiscountWrap" style="display:none;">| Discount: <strong id="helperDiscount" style="color:#0284c7;">₹0</strong></span></span>
                        <button type="button" class="chip orange" id="fillRemainingBtn" style="display:none;" onclick="fillRemainingAmount()">Fill Remaining</button>
                        <button type="button" class="chip" id="fillFullBtn" style="display:none;" onclick="fillFullAmount()">Fill Full Plan Fee</button>
                    </div>
                </div>

                <!-- Mode of Payment -->
                <div class="apm-field">
                    <label><?= __('Mode of Payment') ?> <span>*</span></label>
                    <?= $this->Form->control('mode_ofpay', [
                        'class'    => 'form-control select2',
                        'type'     => 'select',
                        'required' => true,
                        'label'    => false,
                        'options'  => $getModPayment,
                        'default'  => '0'
                    ]) ?>
                </div>

                <!-- Payment Date — full width at bottom -->
                <div class="apm-field">
                    <label><?= __('Payment Date') ?> <span>*</span></label>
                    <div class="date-input-wrap">
                        <input type="text"
                               id="payment_date"
                               name="payment_date"
                               class="form-control flatpickr-date"
                               placeholder="YYYY-MM-DD"
                               value="<?= !empty($payment->payment_date) ? $payment->payment_date->format('Y-m-d') : date('Y-m-d') ?>"
                               required
                               autocomplete="off">
                        <i class="material-icons">calendar_month</i>
                    </div>
                </div>

            </div><!-- /apm-grid -->

            <!-- Actions -->
            <div class="apm-actions">
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="btn-apm-cancel">
                    <i class="material-icons" style="font-size:18px;">arrow_back</i>
                    <?= __('Back') ?>
                </a>
                <button type="submit" class="btn-apm-submit">
                    <i class="material-icons" style="font-size:18px;">check_circle</i>
                    <?= __('Record Payment') ?>
                </button>
            </div>

            <?= $this->Form->end() ?>
        </div><!-- /apm-body -->
    </div><!-- /apm-card -->
</section>

<script>
var isUserCustomAmount = false;
var planTotalFee = 0;
var planRemainingFee = 0;

function updatePaymentSummary() {
    var baseRem = planRemainingFee;
    var dAmt = 0;
    if ($('#applyDiscountToggle').is(':checked')) {
        dAmt = parseFloat($('#discountAmount').val()) || 0;
    }
    var netPayable = Math.max(0, Math.round((baseRem - dAmt) * 100) / 100);
    var paid = parseFloat($('#amountPaid').val()) || 0;
    var finalRem = Math.max(0, Math.round((netPayable - paid) * 100) / 100);

    if (dAmt > 0) {
        $('#helperDiscountWrap').show();
        $('#helperDiscount').text('-₹' + dAmt.toLocaleString('en-IN'));
    } else {
        $('#helperDiscountWrap').hide();
    }
}

$(document).ready(function() {
    // Safely remove any existing bootstrapMaterialDatePicker bindings without instantiating new ones
    if ($.fn.bootstrapMaterialDatePicker) {
        $('input').each(function() {
            if ($.data(this, 'plugin_bootstrapMaterialDatePicker')) {
                try {
                    var p = $.data(this, 'plugin_bootstrapMaterialDatePicker');
                    if (p && typeof p.destroy === 'function') { p.destroy(); }
                } catch(e) {}
                delete $.data(this, 'plugin_bootstrapMaterialDatePicker');
            }
            $(this).off('.dtp').removeAttr('data-dtp');
        });
    }
    $('.dtp').remove();

    // Ensure #amountPaid is completely editable and never blocked
    $('#amountPaid, #discountPercent, #discountAmount')
        .prop('readonly', false)
        .prop('disabled', false)
        .removeAttr('readonly')
        .removeAttr('disabled')
        .removeAttr('data-dtp')
        .off('.dtp');

    // Init Flatpickr on #payment_date
    flatpickr('#payment_date', {
        dateFormat: 'Y-m-d',
        defaultDate: '<?= !empty($payment->payment_date) ? $payment->payment_date->format('Y-m-d') : date('Y-m-d') ?>',
        allowInput: true,
        monthSelectorType: 'dropdown'
    });

    // Init Select2
    if ($.fn.select2) {
        $('.select2').select2({ width: '100%' });
    }

    // When user manually edits amount paid
    $('#amountPaid').on('input change keyup', function() {
        isUserCustomAmount = true;
        updatePaymentSummary();
    });

    // Discount Toggle Logic
    $('#applyDiscountToggle').on('change', function() {
        var isChecked = $(this).is(':checked');
        if (isChecked) {
            $('#discountToggleCard').addClass('is-active');
            $('#discountDetailsBody').slideDown(200);
            $('#discountReason').prop('required', true);
            applyDiscountType();
        } else {
            $('#discountToggleCard').removeClass('is-active');
            $('#discountDetailsBody').slideUp(200);
            $('#discountReason').prop('required', false).val('');
            $('#discountPercent').val('');
            $('#discountAmount').val('');
            
            if (!isUserCustomAmount && planRemainingFee > 0) {
                $('#amountPaid').val(planRemainingFee);
            }
            updatePaymentSummary();
        }
    });

    $(document).on('click', '.discount-type-option', function(e) {
        $('.discount-type-option').removeClass('active');
        $(this).addClass('active');
        var radio = $(this).find('input[type="radio"]');
        radio.prop('checked', true);
        applyDiscountType();
    });

    $('input[name="discount_type"]').on('change', function() {
        applyDiscountType();
    });

    function applyDiscountType() {
        var type = $('input[name="discount_type"]:checked').val() || 'percent';
        if (type === 'percent') {
            $('#typeOptionPercent').addClass('active');
            $('#typeOptionFixed').removeClass('active');
            $('#discountPercent').focus();
        } else {
            $('#typeOptionFixed').addClass('active');
            $('#typeOptionPercent').removeClass('active');
            $('#discountAmount').focus();
        }
    }

    function calcFromPercent() {
        var baseFee = planRemainingFee > 0 ? planRemainingFee : planTotalFee;
        var rawVal = $('#discountPercent').val();
        if (rawVal === '') {
            $('#discountAmount').val('');
            if (!isUserCustomAmount && baseFee > 0) {
                $('#amountPaid').val(baseFee);
            }
            updatePaymentSummary();
            return;
        }
        var pct = parseFloat(rawVal);
        if (isNaN(pct)) return;
        if (pct > 100) { pct = 100; $('#discountPercent').val(100); }
        if (pct < 0) { pct = 0; $('#discountPercent').val(0); }

        if (baseFee > 0) {
            var dAmt = Math.round((baseFee * pct / 100) * 100) / 100;
            $('#discountAmount').val(dAmt > 0 ? dAmt : '');
            if (!isUserCustomAmount) {
                var finalPay = Math.max(0, Math.round((baseFee - dAmt) * 100) / 100);
                $('#amountPaid').val(finalPay);
            }
        }
        updatePaymentSummary();
    }

    function calcFromAmount() {
        var baseFee = planRemainingFee > 0 ? planRemainingFee : planTotalFee;
        var rawVal = $('#discountAmount').val();
        if (rawVal === '') {
            $('#discountPercent').val('');
            if (!isUserCustomAmount && baseFee > 0) {
                $('#amountPaid').val(baseFee);
            }
            updatePaymentSummary();
            return;
        }
        var dAmt = parseFloat(rawVal);
        if (isNaN(dAmt)) return;
        if (baseFee > 0 && dAmt > baseFee) { dAmt = baseFee; $('#discountAmount').val(baseFee); }
        if (dAmt < 0) { dAmt = 0; $('#discountAmount').val(0); }

        if (baseFee > 0) {
            var pct = Math.round((dAmt / baseFee * 100) * 100) / 100;
            $('#discountPercent').val(pct > 0 ? pct : '');
            if (!isUserCustomAmount) {
                var finalPay = Math.max(0, Math.round((baseFee - dAmt) * 100) / 100);
                $('#amountPaid').val(finalPay);
            }
        }
        updatePaymentSummary();
    }

    $('#discountPercent').on('input keyup change', function() {
        calcFromPercent();
    });

    $('#discountAmount').on('input keyup change', function() {
        calcFromAmount();
    });

    // Form submit validation
    $('#paymentForm').on('submit', function(e) {
        if ($('#applyDiscountToggle').is(':checked')) {
            var dPct = parseFloat($('#discountPercent').val()) || 0;
            var dAmt = parseFloat($('#discountAmount').val()) || 0;
            var reason = $.trim($('#discountReason').val());

            if ((dPct > 0 || dAmt > 0) && reason === '') {
                e.preventDefault();
                alert('Please enter a mandatory discount reason/remark before submitting.');
                $('#discountReason').focus();
                return false;
            }
        }
    });

    // If plan is already chosen, auto-load its details right away
    var initialPlanId = $('#plan-subscriber-id').val();
    if (initialPlanId) {
        showPlanDetails(initialPlanId);
    }
});

function fillRemainingAmount() {
    var dAmt = 0;
    if ($('#applyDiscountToggle').is(':checked')) {
        dAmt = parseFloat($('#discountAmount').val()) || 0;
    }
    var netRem = Math.max(0, planRemainingFee - dAmt);
    if (netRem > 0) {
        $('#amountPaid').val(netRem).trigger('input').focus();
    }
}
function fillFullAmount() {
    if (planTotalFee > 0) {
        $('#amountPaid').val(planTotalFee).trigger('input').focus();
    }
}

/* Get user's plan list */
function showPlanList(userid) {
    if (userid !== '') {
        var url = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'showPlanList']) ?>/' + escape(userid);
        $.ajax({
            type: 'POST',
            cache: false,
            url: url,
            success: function(html) {
                $('#planDiv').html(html);
                if ($.fn.select2) {
                    $('#planDiv select').select2({ width: '100%' });
                }
                // Bind change on new select
                $('#planDiv select').on('change', function() {
                    showPlanDetails(this.value);
                });
                // Reset info
                $('#planDetailDiv').html('');
                $('#amountPaid').val('');
                updateAmountHelper(0, 0);
            }
        });
    }
    return false;
}

/* Get selected plan details — renders the strip AND updates helper */
function showPlanDetails(planid) {
    if (planid !== '') {
        var url = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'showPlanDetails']) ?>/' + escape(planid);
        $.ajax({
            type: 'POST',
            cache: false,
            url: url,
            success: function(html) {
                $('#planDetailDiv').html(html);

                // Read values from hidden inputs rendered by showPlanDetails
                var totalFee   = parseFloat($('#total_fee').val()) || 0;
                var paidAmt    = parseFloat($('#paid_amount').val()) || 0;
                var remFee     = parseFloat($('#fee').val()) || 0; // remaining = fee hidden field

                planTotalFee     = totalFee > 0 ? totalFee : remFee;
                planRemainingFee = remFee;

                updateAmountHelper(planTotalFee, planRemainingFee);

                // Pre-fill amount with remaining fee if any
                var dAmt = 0;
                if ($('#applyDiscountToggle').is(':checked')) {
                    dAmt = parseFloat($('#discountAmount').val()) || 0;
                }
                var fillVal = Math.max(0, remFee - dAmt);
                if (fillVal > 0) {
                    $('#amountPaid').val(fillVal);
                }
            }
        });
    } else {
        $('#planDetailDiv').html('');
        $('#amountPaid').val('');
        updateAmountHelper(0, 0);
    }
    return false;
}

function updateAmountHelper(totalFee, remainingFee) {
    if (totalFee > 0) {
        $('#planFeeLabel').text('₹' + Number(totalFee).toLocaleString('en-IN'));
        $('#remainingLabel').text('₹' + Number(remainingFee).toLocaleString('en-IN'));
        if (remainingFee > 0) {
            $('#fillRemainingBtn').show();
        } else {
            $('#fillRemainingBtn').hide();
        }
        $('#fillFullBtn').show();
    } else {
        $('#planFeeLabel').text('—');
        $('#remainingLabel').text('—');
        $('#fillRemainingBtn').hide();
        $('#fillFullBtn').hide();
    }
}
</script>
