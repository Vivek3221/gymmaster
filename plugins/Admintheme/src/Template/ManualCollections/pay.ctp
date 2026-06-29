<section class="content">
<div class="container-fluid">
<style>
/* ─── Pay Pending Fee Page ─── */
.payment-wrapper {
    max-width: 860px;
    margin: 20px auto;
    padding: 0 15px;
}
.payment-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.06);
    border: 1px solid #eef2f6;
    overflow: hidden;
}
.payment-header {
    padding: 22px 28px;
    background: linear-gradient(135deg, #e8f5e9 0%, #fafbfe 100%);
    border-bottom: 1px solid #f1f4f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.payment-header h2 {
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.payment-header h2 i { color: #4caf50; font-size: 22px; }
.payment-body { padding: 28px 30px; }

.section-title {
    font-size: 12px;
    font-weight: 700;
    color: #ff9800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin: 28px 0 16px 0;
    padding-bottom: 8px;
    border-bottom: 2px solid #fff3e0;
    display: flex;
    align-items: center;
    gap: 6px;
}
.section-title:first-of-type { margin-top: 0; }

.field-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 16px 22px;
}

.form-field { display: flex; flex-direction: column; }
.form-field label {
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}
.form-field input,
.form-field select {
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 14px;
    color: #334155;
    background-color: #f8fafc;
    transition: all 0.2s ease;
    outline: none;
    height: 42px;
    width: 100%;
    box-sizing: border-box;
}
.form-field input:focus,
.form-field select:focus {
    border-color: #ff9800 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(255,152,0,0.12) !important;
}
.form-field input[readonly] {
    background-color: #f1f5f9;
    border-color: #cbd5e1;
    color: #475569;
    cursor: not-allowed;
}

/* Subscriber summary pill */
.sub-summary-pill {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    gap: 28px;
    flex-wrap: wrap;
    margin-bottom: 8px;
}
.pill-item {
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.pill-label {
    font-size: 10px;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}
.pill-value {
    font-size: 15px;
    font-weight: 800;
    color: #334155;
}
.pill-value.green  { color: #2e7d32; }
.pill-value.red    { color: #c62828; }
.pill-value.orange { color: #ef6c00; }

/* Quick-pay full button */
.quick-pay-btn {
    background: #e8f5e9;
    border: 1.5px dashed #66bb6a;
    border-radius: 8px;
    padding: 10px 16px;
    font-size: 13px;
    font-weight: 600;
    color: #2e7d32;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
    margin-bottom: 14px;
}
.quick-pay-btn:hover { background: #c8e6c9; border-color: #43a047; }

/* Actions */
.form-actions {
    margin-top: 28px;
    padding-top: 18px;
    border-top: 1px solid #f1f4f9;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    flex-wrap: wrap;
}
.btn-save {
    background: #4caf50 !important;
    color: #ffffff !important;
    border: none;
    border-radius: 8px;
    padding: 12px 28px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(76,175,80,0.2);
}
.btn-save:hover { background: #388e3c !important; transform: translateY(-1px); }
.btn-cancel {
    background: #f8fafc;
    color: #64748b;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
}
.btn-cancel:hover { background: #f1f5f9; color: #334155; }

/* Select2 overrides */
.mc-s2-drop { border:1px solid #ffb74d !important; border-radius:8px !important; box-shadow:0 8px 28px rgba(0,0,0,.12) !important; }
.mc-s2-drop .select2-results__option--highlighted { background:#ff9800 !important; color:#fff !important; }
.payment-card .select2-container { display:block; width:100% !important; }
.payment-card .select2-container--default .select2-selection--single {
    height:42px !important; border:1.5px solid #e2e8f0 !important; border-radius:8px !important;
    background:#f8fafc !important; box-shadow:none !important; display:flex; align-items:center;
}
.payment-card .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height:42px !important; padding-left:14px !important; color:#334155 !important; font-size:14px !important;
}
.payment-card .select2-container--default .select2-selection--single .select2-selection__arrow { height:40px !important; right:10px !important; }
.payment-card .select2-container--default.select2-container--focus .select2-selection--single,
.payment-card .select2-container--default.select2-container--open .select2-selection--single {
    border-color:#ff9800 !important; background-color:#fff !important;
    box-shadow:0 0 0 3px rgba(255,152,0,0.1) !important; outline:none !important;
}
</style>

<div class="payment-wrapper">
    <?= $this->Flash->render() ?>

    <div class="payment-card">
        <!-- Header -->
        <div class="payment-header">
            <h2>
                <i class="material-icons">payments</i>
                <?= __('Record Fee Payment') ?>
            </h2>
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-cancel" style="padding:6px 14px;font-size:13px;">
                <i class="material-icons" style="font-size:16px;">arrow_back</i> <?= __('Back') ?>
            </a>
        </div>

        <div class="payment-body">
            <?= $this->Form->create($planSubscriber, [
                'id'        => 'paymentForm',
                'templates' => ['inputContainer' => '{{content}}']
            ]) ?>

            <!-- ══ SECTION 1: Subscription Info ══ -->
            <div class="section-title">
                <i class="material-icons" style="font-size:17px;">assignment</i>
                <?= __('1. Subscription Summary') ?>
            </div>

            <div class="sub-summary-pill">
                <div class="pill-item">
                    <span class="pill-label"><i class="material-icons" style="font-size:13px;vertical-align:middle;">person</i> User</span>
                    <span class="pill-value"><?= h(ucwords($planSubscriber->user->name)) ?></span>
                </div>
                <div class="pill-item">
                    <span class="pill-label"><i class="material-icons" style="font-size:13px;vertical-align:middle;">card_membership</i> Plan</span>
                    <span class="pill-value"><?= h(ucwords($planSubscriber->plan_name)) ?></span>
                </div>
                <div class="pill-item">
                    <span class="pill-label"><i class="material-icons" style="font-size:13px;vertical-align:middle;">event_busy</i> Expires</span>
                    <span class="pill-value orange"><?= date('d-m-Y', strtotime($planSubscriber->plan_expire_date)) ?></span>
                </div>
            </div>

            <div class="field-grid" style="margin-top:14px;">
                <div class="form-field">
                    <label><?= __('Total Plan Fee') ?></label>
                    <input type="text" value="₹ <?= number_format($planSubscriber->fee, 2) ?>" readonly>
                </div>
                <div class="form-field">
                    <label><?= __('Paid So Far') ?></label>
                    <input type="text" value="₹ <?= number_format($planSubscriber->paid_fee, 2) ?>" readonly style="color:#2e7d32;font-weight:700;">
                </div>
                <div class="form-field">
                    <label><?= __('Remaining Due') ?></label>
                    <input type="text" id="remainingDueAmount" value="<?= $planSubscriber->remain_fee ?>" readonly style="color:#c62828;font-weight:700;">
                </div>
            </div>

            <!-- ══ SECTION 2: Record Payment ══ -->
            <div class="section-title" style="margin-top:24px;">
                <i class="material-icons" style="font-size:17px;">monetization_on</i>
                <?= __('2. Payment Details') ?>
            </div>

            <!-- Quick Pay Full -->
            <?php if ($planSubscriber->remain_fee > 0): ?>
            <button type="button" class="quick-pay-btn" id="payFullBtn">
                <i class="material-icons" style="font-size:17px;">bolt</i>
                Pay Full Remaining (₹<?= number_format($planSubscriber->remain_fee, 2) ?>)
            </button>
            <?php endif; ?>

            <div class="field-grid">
                <div class="form-field">
                    <label><?= __('Payment Amount (₹)') ?> <span style="color:red">*</span></label>
                    <input type="number" name="payment_amount" id="payAmount" required
                        placeholder="0.00" min="0.01"
                        max="<?= $planSubscriber->remain_fee ?>"
                        step="0.01"
                        value="<?= $planSubscriber->remain_fee ?>">
                </div>

                <div class="form-field">
                    <label><?= __('Mode of Payment') ?> <span style="color:red">*</span></label>
                    <select name="mode_ofpay" id="modePay" class="select2" style="width:100%;" required>
                        <?php foreach ($getModPayment as $k => $v): ?>
                            <option value="<?= h($k) ?>"><?= h($v) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-field" id="dueDateContainer">
                    <label><?= __('Next Due Date') ?> <span style="color:#94a3b8;font-size:10px;">(if partial)</span></label>
                    <input type="text" name="payment_due_date" id="paymentDueDate"
                        class="plan-datepicker" placeholder="YYYY-MM-DD" autocomplete="off"
                        value="<?= $planSubscriber->payment_due_date ? date('Y-m-d', strtotime($planSubscriber->payment_due_date)) : '' ?>">
                </div>
            </div>

            <!-- After-payment summary -->
            <div id="afterPaySummary" style="display:none;margin-top:14px;background:#f1f8e9;border:1px solid #aed581;border-radius:8px;padding:12px 16px;font-size:13px;font-weight:600;">
                <span style="color:#2e7d32;"><i class="material-icons" style="font-size:15px;vertical-align:middle;">check_circle</i> After this payment — Paid: ₹<span id="afterPaid">0</span></span>
                &nbsp;&nbsp;
                <span style="color:#c62828;"><i class="material-icons" style="font-size:15px;vertical-align:middle;">hourglass_empty</i> Still Pending: ₹<span id="afterPending">0</span></span>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <?= $this->Form->button(
                    '<i class="material-icons" style="font-size:18px;vertical-align:middle;">check_circle</i> Record Payment',
                    ['class' => 'btn-save', 'escapeTitle' => false]
                ) ?>
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-cancel">
                    <i class="material-icons" style="font-size:16px;">close</i> <?= __('Cancel') ?>
                </a>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div><!-- /.container-fluid -->
</section>

<script>
$(window).on('load', function () {
    // Select2
    $('#modePay').select2({ dropdownCssClass: 'mc-s2-drop', minimumResultsForSearch: Infinity, width: '100%' });

    // Datepicker
    $('#paymentDueDate').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD', time: false, minDate: new Date()
    });

    var totalRemaining = parseFloat($('#remainingDueAmount').val()) || 0;

    // Quick pay full button
    $('#payFullBtn').on('click', function () {
        $('#payAmount').val(totalRemaining.toFixed(2)).trigger('change');
    });

    function checkDueContainer() {
        var entered = parseFloat($('#payAmount').val()) || 0;
        if (entered >= totalRemaining) {
            $('#dueDateContainer').slideUp(200);
            $('#paymentDueDate').prop('required', false);
        } else {
            $('#dueDateContainer').slideDown(200);
        }
        // After-payment summary
        var paidSoFar = <?= (float)$planSubscriber->paid_fee ?>;
        var newPaid   = paidSoFar + entered;
        var newPend   = Math.max(0, <?= (float)$planSubscriber->fee ?> - newPaid);
        if (entered > 0) {
            $('#afterPaid').text(newPaid.toFixed(2));
            $('#afterPending').text(newPend.toFixed(2));
            $('#afterPaySummary').show();
        } else {
            $('#afterPaySummary').hide();
        }
    }

    $('#payAmount').on('input change', function () { checkDueContainer(); });
    checkDueContainer();
});
</script>
