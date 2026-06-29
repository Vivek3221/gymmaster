<?php
$status              = $this->Common->getstatus();
$user_type_options   = $this->Common->getType();
$getModPayment       = $this->Common->getModPayment();
?>
<style>
/* ─── Compact Modern Design System for Add Plan ─── */
.payment-wrapper {
    max-width: 900px;
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
    background: linear-gradient(135deg, #fff8e1 0%, #fafbfe 100%);
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
    color: #ff9800;
    font-size: 20px;
}
.payment-body {
    padding: 20px 24px;
}

/* Custom form section titles - compact margins */
.section-title {
    font-size: 11px;
    font-weight: 700;
    color: #e65100;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin: 16px 0 10px 0;
    padding-bottom: 5px;
    border-bottom: 1.5px solid #fff3e0;
    display: flex;
    align-items: center;
    gap: 6px;
}
.section-title:first-of-type {
    margin-top: 0;
}

/* Flexible Grid */
.field-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 12px 20px;
}

/* Form Fields */
.form-field {
    display: flex;
    flex-direction: column;
    margin-bottom: 2px;
}
.form-field label {
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
}
.form-field input,
.form-field .form-control {
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
    font-size: 13.5px !important;
    color: #334155 !important;
    background-color: #f8fafc !important;
    transition: all 0.2s ease !important;
    outline: none !important;
    height: 38px !important;
    box-sizing: border-box !important;
    box-shadow: none !important;
}
.form-field input:focus {
    border-color: #ff9800 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.12) !important;
}
.form-field input[readonly] {
    background-color: #f1f5f9 !important;
    border-color: #cbd5e1 !important;
    color: #475569 !important;
    cursor: not-allowed;
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
    border-color: #ff9800 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.1) !important;
    outline: none !important;
}
.mc-s2-drop {
    border: 1px solid #ffb74d !important;
    border-radius: 8px !important;
    box-shadow: 0 4px 16px rgba(0,0,0,.08) !important;
}
.mc-s2-drop .select2-results__option--highlighted {
    background: #ff9800 !important;
    color: #fff !important;
}

/* Plan Preview Badge */
.plan-detail-pill {
    grid-column: 1 / -1;
    display: none;
    background: #fff8e1;
    border: 1px solid #ffe082;
    border-radius: 8px;
    padding: 10px 16px;
    align-items: center;
    gap: 16px;
    margin-bottom: 4px;
    animation: fadeIn 0.3s ease;
}
.plan-detail-pill.active {
    display: flex;
}
.badge-item {
    font-size: 13px;
    font-weight: 700;
    color: #b45309;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.badge-item i {
    font-size: 16px;
    color: #d97706;
}

/* Action Area */
.form-actions {
    margin-top: 20px;
    padding-top: 14px;
    border-top: 1px solid #f1f4f9;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
}
.btn-save {
    background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%) !important;
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
    box-shadow: 0 3px 10px rgba(255, 152, 0, 0.18);
    height: 38px;
}
.btn-save:hover {
    transform: translateY(-1px);
    box-shadow: 0 5px 14px rgba(255, 152, 0, 0.25);
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
                        <i class="material-icons">card_membership</i>
                        <?= __('Manage User & Manual Plan Subscription') ?>
                    </h2>
                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-cancel" style="padding:6px 12px;font-size:12.5px;height:auto;">
                        <i class="material-icons" style="font-size:15px;">arrow_back</i> <?= __('Back') ?>
                    </a>
                </div>

                <!-- Main Form Body -->
                <div class="payment-body" id="makepayment">
                    <?= $this->Form->create($user, [
                        'enctype'   => 'multipart/form-data',
                        'id'        => 'payment',
                        'url'       => ['controller' => 'ManualCollections', 'action' => 'add', $user_id],
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
                                'class'   => 'select2',
                                'type'    => 'select',
                                'options' => $user_type_options,
                                'empty'   => __('Select Type'),
                                'label'   => false
                            ]) ?>
                        </div>
                        <?php else: ?>
                            <?= $this->Form->control('user_type', ['value' => 3, 'type' => 'hidden', 'options' => $user_type_options]) ?>
                        <?php endif; ?>

                        <div class="form-field">
                            <label><?= __('Full Name') ?></label>
                            <?= $this->Form->control('name', ['type' => 'text', 'label' => false, 'placeholder' => 'Full name']) ?>
                        </div>

                        <div class="form-field">
                            <label><?= __('Email') ?></label>
                            <?= $this->Form->control('email', ['label' => false, 'placeholder' => 'Email address']) ?>
                        </div>

                        <div class="form-field">
                            <label><?= __('Mobile Number') ?></label>
                            <?= $this->Form->control('mobile_no', ['type' => 'text', 'label' => false, 'placeholder' => 'Mobile number']) ?>
                        </div>

                        <?php if ($users_type == 2): ?>
                        <div class="form-field">
                            <label><?= __('Assign Trainer') ?></label>
                            <?= $this->Form->control('trainer_userid', [
                                'class'   => 'select2',
                                'type'    => 'select',
                                'options' => $trainers,
                                'empty'   => 'Select Trainer',
                                'label'   => false
                            ]) ?>
                        </div>
                        <?php endif; ?>
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
                            <?= $this->Form->input('active', ['class' => 'select2', 'options' => $status, 'empty' => __('Select Status'), 'label' => false]) ?>
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
                            <label><?= __('Plan Total Fee (₹)') ?></label>
                            <?= $this->Form->control('fee', ['type' => 'number', 'label' => false, 'id' => 'fee', 'placeholder' => '0', 'min' => 0]) ?>
                        </div>

                        <div class="form-field">
                            <label><?= __('Amount Paid (₹)') ?></label>
                            <?= $this->Form->control('amount', ['type' => 'number', 'label' => false, 'placeholder' => '0', 'min' => 0]) ?>
                        </div>

                        <div class="form-field">
                            <label><?= __('Mode of Payment') ?></label>
                            <?= $this->Form->control('mode_ofpay', [
                                'class'   => 'select2',
                                'type'    => 'select',
                                'empty'   => 'Select Mode',
                                'label'   => false,
                                'options' => $getModPayment
                            ]) ?>
                        </div>

                        <div class="form-field">
                            <label><?= __('Remaining Due Date') ?></label>
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
                        <a href="<?= $this->Url->build(['controller' => 'ManualCollections', 'action' => 'index']) ?>" class="btn-cancel">
                            <?= __('Cancel') ?>
                        </a>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
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
    var d = new Date(dateStr);
    d.setDate(d.getDate() + days);
    var yyyy = d.getFullYear();
    var mm   = String(d.getMonth() + 1).padStart(2, '0');
    var dd   = String(d.getDate()).padStart(2, '0');
    return yyyy + '-' + mm + '-' + dd;
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
    $('.plan-datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        time: false,
        weekStart: 1
    });

    $(document).on('change', '#subscriptionStartDate', function() {
        recalcDates();
    });

    $('#planSelectDropdown').on('change', function() {
        var planId = $(this).val();
        if (!planId) {
            selectedPlanDays = 0;
            $('#planInfoStrip').removeClass('active');
            $('#hiddenPlanName').val('');
            $('#fee').val('');
            recalcDates();
            return;
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
                    recalcDates();
                }
            }
        });
    });
});
</script>
