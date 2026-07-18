<?php
$status      = $this->Common->getstatus();
$user_type   = $this->Common->getType();
$getModPayment  = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();
?>
<style>
/* ─── Simple Modern Payment Page ─── */
.payment-wrapper {
    max-width: 900px;
    margin: 20px auto;
    padding: 0 15px;
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
    background: #fafbfe;
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
.payment-header h2 i {
    color: #ff9800;
    font-size: 22px;
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
}

/* Custom Dropdown Styling for Selects */
.form-field select,
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
    cursor: pointer;
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
</style>

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

        <!-- Initial Toggle Wrapper -->
        <div id="hidePayment" class="start-payment-wrap">
            <button class="btn-start" onclick="makePayment()">
                <i class="material-icons">add_circle</i>
                <?= __('Add Plan & Payment') ?>
            </button>
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="btn-skip">
                <?= __('Skip for Now') ?>
            </a>
        </div>

        <!-- Main Form Body -->
        <div class="payment-body" id="makepayment" hidden="">
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

                <?php if ($users_type == 2): ?>
                <div class="form-field">
                    <label><?= __('Assign Trainer') ?></label>
                    <?= $this->Form->control('trainer_userid', [
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
                    <?= $this->Form->input('active', ['options' => $status, 'empty' => __('Select Status'), 'label' => false]) ?>
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
                    <select id="planSelectDropdown" name="plan_id" required>
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
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="btn-cancel">
                    <?= __('Cancel') ?>
                </a>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

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
