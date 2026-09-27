<?php
$status         = $this->Common->getstatus();
$user_type      = $this->Common->getType();
$getModPayment  = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();

/** @var array $trainers */
$trainers       = !empty($trainers) ? $trainers : [];
/** @var array $availablePlans */
$availablePlans = !empty($availablePlans) ? $availablePlans : [];
$users_type     = isset($users_type) ? $users_type : (isset($user_type) ? $user_type : 1);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
/* Suppress bootstrapMaterialDatePicker modal completely so only Flatpickr shows */
.dtp, .dtp * {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
    z-index: -9999 !important;
}

/* ─── Simple Modern Payment Page ─── */
.payment-wrapper {
    max-width: 100%;
    margin: 0;
    padding: 0;
}
.payment-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
    border: 1px solid #eef2f6;
    overflow: hidden;
}
.payment-header {
    padding: 24px 30px;
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    border-bottom: 1px solid #f1f4f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.payment-header h2 {
    font-size: 18px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.payment-header h2 i {
    color: #ff9800;
    font-size: 22px;
}

/* Discount toggle card styles */
.discount-toggle-card {
    grid-column: 1 / -1;
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px 20px;
    margin: 6px 0;
    transition: all 0.25s ease;
}
.discount-toggle-card.is-active {
    background: #fffbf5;
    border-color: #ffd8a8;
    box-shadow: 0 4px 14px rgba(255, 152, 0, 0.08);
}
.discount-checkbox-label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
    user-select: none;
    margin: 0;
}
.discount-checkbox-label input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: #ff9800;
    cursor: pointer;
}
.discount-details-body {
    display: none;
    margin-top: 14px;
    padding-top: 14px;
    border-top: 1px dashed #cbd5e1;
}
.discount-type-selector {
    display: inline-flex;
    background: #e2e8f0;
    padding: 3px;
    border-radius: 8px;
    gap: 4px;
    margin-bottom: 14px;
}
.discount-type-option {
    display: inline-flex;
    align-items: center;
    padding: 6px 16px;
    border-radius: 6px;
    font-size: 12.5px;
    font-weight: 700;
    cursor: pointer;
    color: #475569;
    user-select: none;
    transition: all 0.2s ease;
    margin: 0;
}
.discount-type-option input[type="radio"] {
    display: none;
}
.discount-type-option.active {
    background: #ffffff;
    color: #ff9800;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
}
.payment-body {
    padding: 30px;
}

/* Sections inside single card */
.section-title {
    font-size: 13px;
    font-weight: 700;
    color: #ff9800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin: 24px 0 16px 0;
    padding-bottom: 6px;
    border-bottom: 1px solid #f1f4f9;
    display: flex;
    align-items: center;
    gap: 6px;
}
.section-title:first-of-type {
    margin-top: 0;
}

/* Clean Simple Grid */
.field-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 18px 24px;
}

/* Modern inputs */
.form-field {
    display: flex;
    flex-direction: column;
}
.form-field label {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 6px;
}
.form-field input,
.form-field select,
.form-field textarea,
.form-field .input.select select,
.form-field div.select select {
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
    position: relative !important;
    z-index: 2 !important;
    pointer-events: all !important;
    cursor: text !important;
}
/* Kill any AdminBSB floating label overlay inside our form-field */
.form-field .form-line {
    border-bottom: none !important;
}
.form-field .form-line:after {
    display: none !important;
}
.form-field .form-label {
    display: none !important;
    pointer-events: none !important;
}
/* Ensure all payment inputs in this page are fully clickable */
#discountPercent, #discountAmount, #amountPaid, #fee {
    position: relative !important;
    z-index: 5 !important;
    pointer-events: all !important;
    cursor: text !important;
    -webkit-user-select: text !important;
    user-select: text !important;
}
/* Custom Dropdown Styling for Selects */
.form-field select,
.form-field select.form-control,
.form-field .input.select select,
.form-field div.select select,
select#planSelectDropdown {
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    background-image: url("data:image/svg+xml;utf8,<svg fill='%2364748b' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>") !important;
    background-repeat: no-repeat !important;
    background-position: right 14px center !important;
    background-size: 18px !important;
    padding-right: 40px !important;
    cursor: pointer !important;
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 8px !important;
    height: 44px !important;
    font-size: 14px !important;
    color: #1e293b !important;
    background-color: #f8fafc !important;
}

/* Modern Select2 Styling */
.select2-container {
    width: 100% !important;
}
.select2-container .select2-selection--single {
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 8px !important;
    height: 44px !important;
    background-color: #f8fafc !important;
    transition: all 0.2s ease !important;
    display: flex !important;
    align-items: center !important;
    box-shadow: none !important;
}
.select2-container .select2-selection--single:focus,
.select2-container.select2-container--open .select2-selection--single {
    border-color: #ff9800 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 14px !important;
    padding-right: 32px !important;
    color: #1e293b !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    line-height: 42px !important;
}
.select2-container .select2-selection--single .select2-selection__arrow {
    height: 42px !important;
    right: 12px !important;
}
.select2-dropdown {
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 8px !important;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    z-index: 99999 !important;
    overflow: hidden !important;
}
.select2-search--dropdown {
    padding: 8px 10px !important;
}
.select2-search--dropdown .select2-search__field {
    border: 1.5px solid #cbd5e1 !important;
    border-radius: 6px !important;
    padding: 8px 12px !important;
    font-size: 13.5px !important;
    width: 100% !important;
    box-sizing: border-box !important;
    outline: none !important;
}
.select2-search--dropdown .select2-search__field:focus {
    border-color: #ff9800 !important;
}
.select2-results__option {
    padding: 10px 14px !important;
    font-size: 13.5px !important;
    color: #334155 !important;
}
.select2-results__option--highlighted[aria-selected] {
    background-color: #ff9800 !important;
    color: #ffffff !important;
}
.select2-results__option[aria-selected="true"] {
    background-color: #fff7ed !important;
    color: #c2410c !important;
    font-weight: 600 !important;
}

/* Fix for CakePHP wrapper divs around selects */
.form-field .input.select,
.form-field div.select {
    width: 100%;
}

.form-field input:focus,
.form-field select:focus,
.form-field textarea:focus,
.form-field .input.select select:focus,
.form-field div.select select:focus {
    border-color: #ff9800;
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.1);
}
.form-field input[readonly] {
    background-color: #f1f5f9;
    border-color: #cbd5e1;
    color: #475569;
    cursor: not-allowed;
}

/* Live Plan Badge */
.plan-detail-pill {
    grid-column: 1 / -1;
    display: none;
    background: #fff8e1;
    border: 1px solid #ffe082;
    border-radius: 8px;
    padding: 12px 16px;
    align-items: center;
    gap: 16px;
    margin-bottom: 10px;
}
.plan-detail-pill.active {
    display: flex;
}
.badge-item {
    font-size: 13px;
    font-weight: 600;
    color: #b45309;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.badge-item i {
    font-size: 16px;
    color: #d97706;
}

/* Actions Section */
.form-actions {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #f1f4f9;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
}
.btn-save {
    background: #ff9800;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 12px 24px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
}
.btn-save:hover {
    background: #f57c00;
    transform: translateY(-1px);
}
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
.btn-cancel:hover {
    background: #f1f5f9;
    color: #334155;
}

/* Add plan start button */
.start-payment-wrap {
    text-align: center;
    padding: 40px 20px;
}
.btn-start {
    background: #ff9800;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 14px 28px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(255, 152, 0, 0.2);
    text-decoration: none !important;
}
.btn-start:hover {
    background: #f57c00;
    transform: translateY(-1px);
}
.btn-skip {
    display: block;
    margin-top: 15px;
    color: #64748b;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none !important;
}
.btn-skip:hover {
    color: #334155;
}

/* Modern Discount Block */
.discount-toggle-card {
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px 20px;
    margin-top: 6px;
    transition: all 0.25s ease;
    grid-column: 1 / -1;
}
.discount-toggle-card.is-active {
    background: #fffbf5;
    border-color: #ffd8a8;
    box-shadow: 0 4px 14px rgba(255, 152, 0, 0.08);
}
.discount-checkbox-label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    font-size: 14.5px;
    font-weight: 700;
    color: #1e293b;
    user-select: none;
    margin: 0;
}
.discount-checkbox-label input[type="checkbox"] {
    position: static !important;
    left: auto !important;
    opacity: 1 !important;
    visibility: visible !important;
    display: inline-block !important;
    width: 18px !important;
    height: 18px !important;
    accent-color: #ff9800 !important;
    cursor: pointer !important;
    vertical-align: middle !important;
    margin: 0 !important;
}
.discount-details-body {
    display: none;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px dashed #cbd5e1;
}
.discount-type-selector {
    display: inline-flex;
    background: #e2e8f0;
    padding: 4px;
    border-radius: 8px;
    gap: 4px;
    margin-bottom: 16px;
}
.discount-type-option {
    display: inline-flex;
    align-items: center;
    padding: 7px 18px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    color: #475569;
    user-select: none;
    transition: all 0.2s ease;
    margin: 0;
}
.discount-type-option input[type="radio"] {
    position: static !important;
    left: auto !important;
    opacity: 1 !important;
    visibility: visible !important;
    display: inline-block !important;
    margin-right: 6px !important;
    accent-color: #ff9800 !important;
    cursor: pointer !important;
}
.discount-type-option.active {
    background: #ffffff;
    color: #ff9800;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
}
</style>

<section class="content" style="padding: 15px 20px;">
<div class="payment-wrapper">
    <?= $this->Flash->render() ?>

    <div class="payment-card">
        <!-- Header -->
        <div class="payment-header">
            <h2>
                <i class="material-icons">payment</i>
                <?= __('Manage User & Plan Subscription') ?>
            </h2>
        </div>

        <!-- Main Form Body -->
        <div class="payment-body" id="makepayment">
            <?= $this->Form->create($user, [
                'enctype'   => 'multipart/form-data',
                'id'        => 'payment',
                'templates'  => ['inputContainer' => '{{content}}']
            ]) ?>

            <!-- SECTION 1: Personal Details (only if password not set) -->
            <?php if (empty($user['password'])): ?>
            <div class="section-title">
                <i class="material-icons" style="font-size:18px;">person</i>
                <?= __('1. User Personal Details') ?>
            </div>
            <div class="field-grid">
                <?php if ($users_type == 1): ?>
                <div class="form-field">
                    <label><?= __('User Type') ?></label>
                    <?= $this->Form->control('user_type', [
                        'type'    => 'select',
                        'options' => $user_type,
                        'empty'   => __('Select Type'),
                        'class'   => 'select2',
                        'label'   => false
                    ]) ?>
                </div>
                <?php else: ?>
                    <?= $this->Form->control('user_type', ['value' => 3, 'type' => 'hidden', 'options' => $user_type]) ?>
                <?php endif; ?>

                <div class="form-field">
                    <label><?= __('Full Name') ?></label>
                    <?= $this->Form->control('name', ['type' => 'text', 'label' => false, 'placeholder' => 'Full name']) ?>
                </div>

                <div class="form-field">
                    <label><?= __('Email') ?> <span style="color:red">*</span></label>
                    <?= $this->Form->control('email', ['label' => false, 'placeholder' => 'Email address', 'required' => true]) ?>
                </div>

                <div class="form-field">
                    <label><?= __('Mobile Number') ?></label>
                    <?= $this->Form->control('mobile_no', ['type' => 'text', 'label' => false, 'placeholder' => 'Mobile number']) ?>
                </div>
            </div>

            <!-- SECTION 2: Account Setup (only if password not set) -->
            <div class="section-title">
                <i class="material-icons" style="font-size:18px;">lock</i>
                <?= __('2. Security & Credentials') ?>
            </div>
            <div class="field-grid">
                <div class="form-field">
                    <label><?= __('Password') ?></label>
                    <?= $this->Form->control('password', ['type' => 'password', 'label' => false, 'id' => 'npassword', 'placeholder' => 'Password (min 6 characters)']) ?>
                </div>

                <div class="form-field">
                    <label><?= __('Confirm Password') ?></label>
                    <?= $this->Form->control('cpassword', ['type' => 'password', 'label' => false, 'placeholder' => 'Confirm password']) ?>
                </div>

                <div class="form-field">
                    <label><?= __('Profile Image') ?></label>
                    <?= $this->Form->control('images', ['label' => false, 'type' => 'file', 'onchange' => 'ImageFilesize();']) ?>
                </div>

                <div class="form-field">
                    <label><?= __('Status') ?></label>
                    <?= $this->Form->input('active', ['options' => $status, 'empty' => __('Select Status'), 'class' => 'select2', 'label' => false]) ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- SECTION 3: Plan Selection & Date Math -->
            <div class="section-title">
                <i class="material-icons" style="font-size:18px;">loyalty</i>
                <?= empty($user['password']) ? __('3. Plan Subscription Details') : __('1. Plan Subscription Details') ?>
            </div>
            <div class="field-grid">
                <div class="form-field" style="grid-column: 1 / -1;">
                    <label><?= __('Assign Trainer') ?></label>
                    <?= $this->Form->control('trainer_userid', [
                        'type'    => 'select',
                        'options' => $trainers,
                        'empty'   => __('Select Trainer (Optional)'),
                        'label'   => false,
                        'value'   => !empty($user->trainer_userid) ? $user->trainer_userid : '',
                        'class'   => 'form-control select2'
                    ]) ?>
                </div>

                <div class="form-field" style="grid-column: 1 / -1;">
                    <label><?= __('Choose Membership Plan') ?> <span style="color:red">*</span></label>
                    <select id="planSelectDropdown" name="plan_id" class="select2" required>
                        <option value="">-- Choose a Plan --</option>
                        <?php if (!empty($availablePlans)): ?>
                            <?php foreach ($availablePlans as $pId => $pTitle): ?>
                                <option value="<?= $pId ?>"><?= h($pTitle) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <?= $this->Form->hidden('plan_name', ['id' => 'hiddenPlanName']) ?>
                </div>

                <!-- Info pill -->
                <div id="planInfoStrip" class="plan-detail-pill">
                    <div class="badge-item">
                        <i class="material-icons">check_circle</i>
                        <span id="stripPlanName">—</span>
                    </div>
                    <div class="badge-item">
                        <i class="material-icons">today</i>
                        <span id="stripDays">— Days</span>
                    </div>
                    <div class="badge-item">
                        <i class="material-icons">payment</i>
                        ₹<span id="stripPrice">—</span>
                    </div>
                </div>

                <div class="form-field">
                    <label><?= __('Subscription Start Date') ?> <span style="color:red">*</span></label>
                    <input type="text" id="subscriptionStartDate" name="subscription_start_date" class="plan-datepicker" placeholder="YYYY-MM-DD" autocomplete="off" required>
                </div>

                <div class="form-field">
                    <label><?= __('Plan Expire Date') ?></label>
                    <?= $this->Form->hidden('plan_expire_date', ['id' => 'planExpireDate']) ?>
                    <input type="text" id="planExpireDateDisplay" placeholder="Auto-calculated" readonly>
                </div>

                <div class="form-field">
                    <label><?= __('Reminder Date') ?> <span style="color:#d97706; font-size:10px;">(-5 Days)</span></label>
                    <?= $this->Form->hidden('reminder_date', ['id' => 'reminderDate']) ?>
                    <input type="text" id="reminderDateDisplay" placeholder="Auto-calculated" readonly>
                </div>
            </div>

            <!-- SECTION 4: Payment Details -->
            <div class="section-title">
                <i class="material-icons" style="font-size:18px;">credit_card</i>
                <?= empty($user['password']) ? __('4. Payment Info') : __('2. Payment Info') ?>
            </div>
            <div class="field-grid">
                <div class="form-field">
                    <label><?= __('Payment Date') ?> <span style="color:red">*</span></label>
                    <input type="text" id="paymentDate" name="payment_date" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" value="<?= date('Y-m-d') ?>" autocomplete="off" required>
                </div>

                <div class="form-field">
                    <label><?= __('Plan Total Fee (₹)') ?></label>
                    <?= $this->Form->control('fee', ['type' => 'number', 'label' => false, 'id' => 'fee', 'placeholder' => '0', 'min' => 0]) ?>
                </div>

                <!-- Apply Discount Toggle Card -->
                <div class="discount-toggle-card" id="discountToggleCard">
                    <label class="discount-checkbox-label" for="applyDiscountToggle">
                        <input type="checkbox" id="applyDiscountToggle" name="apply_discount" value="1">
                        <span><?= __('Apply Discount on this Payment?') ?></span>
                    </label>

                    <div class="discount-details-body" id="discountDetailsBody">
                        <div style="margin-bottom: 8px;">
                            <label style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">
                                <?= __('Choose Discount Type') ?>:
                            </label>
                        </div>
                        <div class="discount-type-selector">
                            <label class="discount-type-option active" id="typeOptionPercent">
                                <input type="radio" name="discount_type" value="percent" checked>
                                <i class="material-icons" style="font-size:15px; margin-right:4px;">percent</i>
                                <?= __('Percentage (%)') ?>
                            </label>
                            <label class="discount-type-option" id="typeOptionFixed">
                                <input type="radio" name="discount_type" value="fixed">
                                <i class="material-icons" style="font-size:15px; margin-right:4px;">currency_rupee</i>
                                <?= __('Fixed Amount (₹)') ?>
                            </label>
                        </div>

                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                            <div class="form-field">
                                <label><?= __('Discount (%)') ?></label>
                                <input type="text" inputmode="decimal" pattern="[0-9]*\.?[0-9]*" id="discountPercent" name="discount_percent" class="form-control" placeholder="0.00" autocomplete="off">
                            </div>

                            <div class="form-field">
                                <label><?= __('Discount Amount (₹)') ?></label>
                                <input type="text" inputmode="decimal" pattern="[0-9]*\.?[0-9]*" id="discountAmount" name="discount_amount" class="form-control" placeholder="0.00" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-field" style="margin-top: 12px;">
                            <label><?= __('Discount Reason / Remark') ?> <span style="color:red">*</span></label>
                            <textarea id="discountReason" name="discount_reason" rows="2" class="form-control" placeholder="<?= __('Mandatory remark when discount is applied (e.g. promo coupon, referral, special approval)') ?>" style="border-radius:6px;border:1.5px solid #cbd5e1;padding:8px 12px;font-size:13px;width:100%;box-sizing:border-box;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-field">
                    <label><?= __('Amount Paid (₹)') ?> <span style="color:red">*</span></label>
                    <input type="number" step="any" min="0" id="amountPaid" name="amount" class="form-control" placeholder="0 (Partial or full payment allowed)" required autocomplete="off">
                    <div id="paymentSummaryHelper" style="margin-top: 6px; font-size: 12px; color: #475569; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                        <span>Plan Fee: <strong id="helperPlanFee">₹0</strong></span>
                        <span id="helperDiscountWrap" style="display:none;">| Discount: <strong id="helperDiscount" style="color:#0284c7;">₹0</strong></span>
                        <span>| Paying Now: <strong id="helperPaying" style="color:#16a34a;">₹0</strong></span>
                        <span>| Remaining Due: <strong id="helperRemaining" style="color:#dc2626;">₹0</strong></span>
                    </div>
                </div>

                <div class="form-field">
                    <label><?= __('Mode of Payment') ?></label>
                    <?= $this->Form->control('mode_ofpay', [
                        'type'    => 'select',
                        'label'   => false,
                        'class'   => 'select2',
                        'options' => $getModPayment,
                        'default' => '0'
                    ]) ?>
                </div>

                <div class="form-field" id="remainingDueDateGroup">
                    <label id="remainingDueDateLabel"><?= __('Remaining Due Date') ?></label>
                    <?= $this->Form->control('payment_due_date', [
                        'class'       => 'plan-datepicker',
                        'type'        => 'text',
                        'label'       => false,
                        'placeholder' => 'YYYY-MM-DD',
                        'autocomplete' => 'off'
                    ]) ?>
                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <?= $this->Form->button('<i class="material-icons" style="font-size:18px;vertical-align:middle;">check_circle</i> Submit & Save', [
                    'class'       => 'btn-save',
                    'escapeTitle' => false
                ]) ?>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="btn-cancel">
                    <?= __('Cancel') ?>
                </a>
            </div>

            <?= $this->Form->end() ?>
        </div><!-- /payment-body -->
    </div><!-- /payment-card -->
</div><!-- /payment-wrapper -->
</section>

<script>
var selectedPlanDays = 0;

function makePayment() {
    $('#makepayment').show();
    $('#hidePayment').hide();
}

function ImageFilesize() {
    var Extension = '';
    if (window.ActiveXObject) {
        var fso = new ActiveXObject("Scripting.FileSystemObject");
        var filepath = document.getElementById('images').value;
        var thefile = fso.getFile(filepath);
        var sizeinbytes = thefile.size;
    } else {
        var filepath = document.getElementById('images').value;
        var Extension = filepath.substring(filepath.lastIndexOf('.') + 1).toLowerCase();
        var sizeinbytes = document.getElementById('images').files[0].size;
    }
    var size = sizeinbytes / 1024 / 1024;
    if (Extension === "gif" || Extension === "png" || Extension === "bmp" || Extension === "jpeg" || Extension === "jpg") {
        if (size > 2) {
            alert('Allowed maximum image size is 2MB.');
            document.getElementById('images').value = '';
        }
    } else {
        alert('Allowed only .gif, .png, .bmp, .jpg, .jpeg image files.');
        document.getElementById('images').value = '';
    }
}

function addDaysToDate(dateStr, days) {
    if (!dateStr) return '';
    var parts = dateStr.split('-');
    if (parts.length === 3) {
        var d = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
        d.setDate(d.getDate() + parseInt(days, 10));
        var yyyy = d.getFullYear();
        var mm   = String(d.getMonth() + 1).padStart(2, '0');
        var dd   = String(d.getDate()).padStart(2, '0');
        return yyyy + '-' + mm + '-' + dd;
    }
    return dateStr;
}

function recalcDates() {
    var startVal = $('#subscriptionStartDate').val();
    if (!startVal || !selectedPlanDays) {
        $('#planExpireDateDisplay').val('');
        $('#planExpireDate').val('');
        $('#reminderDateDisplay').val('');
        $('#reminderDate').val('');
        return;
    }
    var expireDate   = addDaysToDate(startVal, selectedPlanDays);
    var reminderDate = addDaysToDate(expireDate, -5);

    $('#planExpireDateDisplay').val(expireDate);
    $('#planExpireDate').val(expireDate + ' 00:00:00');

    $('#reminderDateDisplay').val(reminderDate);
    $('#reminderDate').val(reminderDate);
}

$(document).ready(function() {
    // Suppress and destroy any bootstrapMaterialDatePicker instances safely
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
    $('body').find('.dtp').remove();

    // 1. Initialize Flatpickr on date inputs
    flatpickr('#subscriptionStartDate', {
        dateFormat: 'Y-m-d',
        allowInput: true,
        monthSelectorType: 'dropdown',
        onChange: function(selectedDates, dateStr, instance) {
            $('#subscriptionStartDate').val(dateStr);
            recalcDates();
        }
    });

    flatpickr('#paymentDate, #payment-due-date, .flatpickr-date', {
        dateFormat: 'Y-m-d',
        allowInput: true,
        monthSelectorType: 'dropdown'
    });

    if ($.fn.select2) {
        $('.select2').select2({
            width: '100%'
        });
    }

    var isUserCustomAmount = false;

    function updatePaymentSummary() {
        var baseFee = parseFloat($('#fee').val()) || 0;
        var dAmt = 0;
        if ($('#applyDiscountToggle').is(':checked')) {
            dAmt = parseFloat($('#discountAmount').val()) || 0;
        }
        var netPayable = Math.max(0, Math.round((baseFee - dAmt) * 100) / 100);
        var paid = parseFloat($('#amountPaid').val()) || 0;
        var remaining = Math.max(0, Math.round((netPayable - paid) * 100) / 100);

        $('#helperPlanFee').text('₹' + baseFee.toLocaleString('en-IN'));
        if (dAmt > 0) {
            $('#helperDiscountWrap').show();
            $('#helperDiscount').text('-₹' + dAmt.toLocaleString('en-IN'));
        } else {
            $('#helperDiscountWrap').hide();
        }
        $('#helperPaying').text('₹' + paid.toLocaleString('en-IN'));
        $('#helperRemaining').text('₹' + remaining.toLocaleString('en-IN'));

        if (remaining > 0) {
            $('#remainingDueDateLabel').html('<?= __('Remaining Due Date') ?> <span style="color:#dc2626;font-size:11px;font-weight:700;">(Pending Due: ₹' + remaining.toLocaleString('en-IN') + ')</span>');
            $('#remainingDueDateGroup input').prop('required', true);
        } else {
            $('#remainingDueDateLabel').text('<?= __('Remaining Due Date') ?>');
            $('#remainingDueDateGroup input').prop('required', false);
        }
    }

    // Ensure all 3 fields are completely editable and never blocked
    $('#discountPercent, #discountAmount, #amountPaid, #fee')
        .prop('readonly', false)
        .prop('disabled', false)
        .removeAttr('readonly')
        .removeAttr('disabled')
        .removeAttr('data-dtp')
        .off('.dtp');

    // When user manually types or edits amount paid
    $('#amountPaid').on('input change keyup', function() {
        isUserCustomAmount = true;
        updatePaymentSummary();
    });

    $('#fee').on('input change keyup', function() {
        if (!isUserCustomAmount && !$('#applyDiscountToggle').is(':checked')) {
            $('#amountPaid').val($(this).val());
        }
        updatePaymentSummary();
    });

    // 2. Discount Toggle Logic
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
            
            // If user hasn't typed a custom partial amount, restore amount paid to fee
            if (!isUserCustomAmount) {
                var baseFee = parseFloat($('#fee').val()) || 0;
                if (baseFee > 0) {
                    $('#amountPaid').val(baseFee);
                }
            }
            updatePaymentSummary();
        }
    });

    // 3. Click handler on discount type pills
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
        $('#discountPercent, #discountAmount, #amountPaid').prop('readonly', false);

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
        var baseFee = parseFloat($('#fee').val()) || 0;
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

        $('#typeOptionPercent').addClass('active');
        $('#typeOptionFixed').removeClass('active');
        $('input[name="discount_type"][value="percent"]').prop('checked', true);

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
        var baseFee = parseFloat($('#fee').val()) || 0;
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

        $('#typeOptionFixed').addClass('active');
        $('#typeOptionPercent').removeClass('active');
        $('input[name="discount_type"][value="fixed"]').prop('checked', true);

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
    $('#payment').on('submit', function(e) {
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
        var planId = $('#planSelectDropdown').val();
        var planTitle = $('#planSelectDropdown option:selected').text();
        if (planId && !$('#hiddenPlanName').val() && planTitle) {
            $('#hiddenPlanName').val(planTitle);
        }
    });

    $(document).on('change input blur', '#subscriptionStartDate', function() {
        recalcDates();
    });

    $('#planSelectDropdown').on('change', function() {
        var planId = $(this).val();
        var planTitle = $(this).find('option:selected').text();
        if (!planId) {
            selectedPlanDays = 0;
            $('#planInfoStrip').removeClass('active');
            $('#hiddenPlanName').val('');
            $('#fee').val('');
            recalcDates();
            updatePaymentSummary();
            return;
        }

        // Set hiddenPlanName immediately so submission never has an empty plan name
        if (planTitle && planTitle !== '-- Choose a Plan --') {
            $('#hiddenPlanName').val(planTitle);
        }

        var url = '<?= $this->Url->build(['controller' => 'Plans', 'action' => 'getPlanDetails']) ?>';
        $.ajax({
            url:      url,
            type:     'GET',
            data:     { plan_id: planId },
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    selectedPlanDays = res.days;

                    $('#stripPlanName').text(res.title);
                    $('#stripDays').text(res.days + ' Days');
                    $('#stripPrice').text(parseFloat(res.price).toFixed(2));
                    $('#planInfoStrip').addClass('active');

                    $('#hiddenPlanName').val(res.title);
                    $('#fee').val(res.price);
                    
                    if (!isUserCustomAmount || !$('#amountPaid').val()) {
                        if (!$('#applyDiscountToggle').is(':checked')) {
                            $('#amountPaid').val(res.price);
                        } else {
                            calcFromPercent();
                        }
                    }
                    recalcDates();
                    updatePaymentSummary();
                }
            }
        });
    });
});
</script>
