<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
?>

<style>
.modern-form-wrapper {
    max-width: 850px;
    margin: 20px auto;
    padding: 0 15px;
}
.modern-form-card {
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.05);
    border: 1px solid #eaedf1;
    overflow: hidden;
}
.modern-form-header {
    background: linear-gradient(135deg, #fafafa 0%, #f4f6f9 100%);
    border-bottom: 1px solid #e9ecef;
    padding: 20px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.modern-form-header h2 {
    font-size: 18px;
    font-weight: 700;
    color: #1a202c;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.modern-form-header h2 i {
    color: #ff9800;
    font-size: 24px;
}
.modern-form-body {
    padding: 30px 32px;
}
.form-grid-2col {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px 24px;
}
@media (max-width: 768px) {
    .form-grid-2col {
        grid-template-columns: 1fr;
    }
}
.full-width-field {
    grid-column: 1 / -1;
}
.form-field-group {
    display: flex;
    flex-direction: column;
}
.form-field-group label {
    font-size: 13px;
    font-weight: 600;
    color: #4a5568;
    margin-bottom: 7px;
}
.form-field-group label .req {
    color: #e53e3e;
    margin-left: 2px;
}
.form-field-group input[type="text"],
.form-field-group input[type="email"],
.form-field-group input[type="password"],
.form-field-group select {
    border: 1px solid #cbd5e0 !important;
    border-radius: 8px !important;
    padding: 9px 14px !important;
    height: 42px !important;
    font-size: 14px !important;
    color: #2d3748 !important;
    background-color: #f8fafc !important;
    transition: all 0.2s ease !important;
    box-shadow: none !important;
    width: 100%;
    box-sizing: border-box !important;
}
.form-field-group input:focus,
.form-field-group select:focus {
    border-color: #ff9800 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
    outline: none !important;
}

/* Password Input Wrapper & Toggle Eye Icon */
.password-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
}
.password-input-wrapper input {
    padding-right: 42px !important;
}
.toggle-password-btn {
    position: absolute;
    right: 8px;
    background: none !important;
    border: none !important;
    color: #718096;
    cursor: pointer;
    padding: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.2s ease;
    outline: none !important;
}
.toggle-password-btn:hover {
    color: #ff9800;
}
.toggle-password-btn i {
    font-size: 20px !important;
}

/* Custom Select2 Styling */
.select2-container {
    width: 100% !important;
}
.select2-container--default .select2-selection--single {
    height: 42px !important;
    border: 1px solid #cbd5e0 !important;
    border-radius: 8px !important;
    background-color: #f8fafc !important;
    display: flex !important;
    align-items: center !important;
    box-shadow: none !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 42px !important;
    padding-left: 14px !important;
    color: #2d3748 !important;
    font-size: 14px !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px !important;
    right: 10px !important;
}
.select2-container--default.select2-container--focus .select2-selection--single,
.select2-container--default.select2-container--open .select2-selection--single {
    border-color: #ff9800 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
    outline: none !important;
}

/* Gender Modern Toggle Buttons - Stripping Theme Pseudo-elements */
.gender-pill-group {
    display: flex;
    align-items: center;
    gap: 12px;
    height: 42px;
}
.gender-pill-group input[type="radio"] {
    position: absolute !important;
    opacity: 0 !important;
    width: 0 !important;
    height: 0 !important;
    pointer-events: none !important;
    left: -9999px !important;
}
.gender-pill-btn {
    flex: 1;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    height: 42px !important;
    padding: 0 16px !important;
    border: 1.5px solid #cbd5e0 !important;
    border-radius: 8px !important;
    background: #f8fafc !important;
    color: #4a5568 !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    margin: 0 !important;
    position: relative !important;
    user-select: none !important;
    text-decoration: none !important;
}
.gender-pill-btn::before,
.gender-pill-btn::after {
    display: none !important;
    content: none !important;
    border: none !important;
    background: none !important;
    width: 0 !important;
    height: 0 !important;
}
.gender-pill-btn i {
    font-size: 20px !important;
    color: #718096 !important;
    vertical-align: middle !important;
    transition: color 0.2s ease !important;
}
.gender-pill-group input[type="radio"]:checked + .gender-pill-btn {
    background: #fff8e1 !important;
    border-color: #ff9800 !important;
    color: #d97706 !important;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
}
.gender-pill-group input[type="radio"]:checked + .gender-pill-btn i {
    color: #ff9800 !important;
}

.form-actions-modern {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 30px;
    padding-top: 22px;
    border-top: 1px solid #edf2f7;
}
.btn-save-modern {
    background: #ff9800 !important;
    color: #ffffff !important;
    border: none !important;
    border-radius: 8px !important;
    padding: 10px 24px !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(255, 152, 0, 0.25) !important;
}
.btn-save-modern:hover {
    background: #e68a00 !important;
    box-shadow: 0 6px 16px rgba(255, 152, 0, 0.35) !important;
}
.btn-cancel-modern {
    background: #edf2f7 !important;
    color: #4a5568 !important;
    border: 1px solid #cbd5e0 !important;
    border-radius: 8px !important;
    padding: 10px 18px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
}
.btn-cancel-modern:hover {
    background: #e2e8f0 !important;
    color: #1a202c !important;
}
</style>

<section class="content">
    <div class="container-fluid">
        <div class="modern-form-wrapper">
            <?= $this->Flash->render() ?>

            <div class="modern-form-card">
                <div class="modern-form-header">
                    <h2>
                        <i class="material-icons">badge</i>
                        <?= __('Add Front Desk User') ?>
                    </h2>
                    <a href="<?= $this->Url->build(['action' => 'frontDeskList']) ?>" class="btn-cancel-modern">
                        <i class="material-icons" style="font-size:18px;">arrow_back</i> <?= __('Back to List') ?>
                    </a>
                </div>

                <div class="modern-form-body">
                    <?= $this->Form->create($user, [
                        'id' => 'frontDeskForm',
                        'templates' => ['inputContainer' => '{{content}}']
                    ]) ?>

                    <div class="form-grid-2col">
                        <?php if (isset($users_type) && $users_type == 1) { ?>
                            <div class="form-field-group full-width-field">
                                <label><?= __('Select Partner') ?> <span class="req">*</span></label>
                                <?= $this->Form->control('partner_id', [
                                    'class' => 'form-control select2',
                                    'type' => 'select',
                                    'options' => $partners,
                                    'empty' => __('-- Select Partner --'),
                                    'required' => true,
                                    'label' => false
                                ]) ?>
                            </div>
                        <?php } ?>

                        <div class="form-field-group">
                            <label><?= __('Full Name') ?> <span class="req">*</span></label>
                            <?= $this->Form->control('name', [
                                'class' => 'form-control',
                                'type' => 'text',
                                'required' => true,
                                'label' => false,
                                'placeholder' => 'Enter full name'
                            ]) ?>
                        </div>

                        <div class="form-field-group">
                            <label><?= __('Email Address') ?> <span class="req">*</span></label>
                            <?= $this->Form->control('email', [
                                'class' => 'form-control',
                                'type' => 'email',
                                'required' => true,
                                'label' => false,
                                'placeholder' => 'Enter email address'
                            ]) ?>
                        </div>

                        <div class="form-field-group">
                            <label><?= __('Mobile Number') ?> <span class="req">*</span></label>
                            <?= $this->Form->control('mobile_no', [
                                'class' => 'form-control',
                                'type' => 'text',
                                'required' => true,
                                'label' => false,
                                'placeholder' => 'Enter mobile number'
                            ]) ?>
                        </div>

                        <div class="form-field-group">
                            <label><?= __('Emergency Contact No.') ?></label>
                            <?= $this->Form->control('emerg_no', [
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false,
                                'placeholder' => 'Enter emergency contact'
                            ]) ?>
                        </div>

                        <div class="form-field-group">
                            <label><?= __('Gender') ?> <span class="req">*</span></label>
                            <div class="gender-pill-group">
                                <input type="radio" name="gender" id="gender_male" value="1" checked>
                                <label for="gender_male" class="gender-pill-btn">
                                    <i class="material-icons">male</i> <span><?= __('Male') ?></span>
                                </label>

                                <input type="radio" name="gender" id="gender_female" value="2">
                                <label for="gender_female" class="gender-pill-btn">
                                    <i class="material-icons">female</i> <span><?= __('Female') ?></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-field-group">
                            <label><?= __('Date of Birth') ?> <span class="req">*</span></label>
                            <?= $this->Form->control('dob', [
                                'class' => 'form-control datetimepicker',
                                'type' => 'text',
                                'placeholder' => 'YYYY-MM-DD',
                                'label' => false,
                                'required' => true,
                                'autocomplete' => 'off'
                            ]) ?>
                        </div>

                        <div class="form-field-group">
                            <label><?= __('Password') ?> <span class="req">*</span></label>
                            <div class="password-input-wrapper">
                                <?= $this->Form->control('password', [
                                    'class' => 'form-control',
                                    'type' => 'password',
                                    'id' => 'pass_input',
                                    'required' => true,
                                    'label' => false,
                                    'placeholder' => 'Enter password'
                                ]) ?>
                                <button type="button" class="toggle-password-btn" onclick="togglePasswordVisibility('pass_input', this)">
                                    <i class="material-icons">visibility</i>
                                </button>
                            </div>
                        </div>

                        <div class="form-field-group">
                            <label><?= __('Confirm Password') ?> <span class="req">*</span></label>
                            <div class="password-input-wrapper">
                                <?= $this->Form->control('cpassword', [
                                    'class' => 'form-control',
                                    'type' => 'password',
                                    'id' => 'cpass_input',
                                    'required' => true,
                                    'label' => false,
                                    'placeholder' => 'Re-enter password'
                                ]) ?>
                                <button type="button" class="toggle-password-btn" onclick="togglePasswordVisibility('cpass_input', this)">
                                    <i class="material-icons">visibility</i>
                                </button>
                            </div>
                        </div>

                        <div class="form-field-group full-width-field">
                            <label><?= __('Account Status') ?> <span class="req">*</span></label>
                            <?= $this->Form->input('active', [
                                'options' => $status,
                                'class' => 'form-control select2',
                                'default' => 1,
                                'label' => false
                            ]) ?>
                        </div>
                    </div>

                    <div class="form-actions-modern">
                        <a href="<?= $this->Url->build(['action' => 'frontDeskList']) ?>" class="btn-cancel-modern">
                            <?= __('Cancel') ?>
                        </a>
                        <button type="submit" class="btn-save-modern">
                            <i class="material-icons" style="font-size:18px;">check_circle</i>
                            <?= __('Add Front Desk User') ?>
                        </button>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
function togglePasswordVisibility(inputId, btn) {
    var input = $('#' + inputId);
    var icon = $(btn).find('i');
    if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        icon.text('visibility_off');
    } else {
        input.attr('type', 'password');
        icon.text('visibility');
    }
}

$(document).ready(function () {
    if ($.isFunction($.fn.select2)) {
        $('.select2').select2({ width: '100%' });
    }
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        lang: 'fr',
        weekStart: 1,
        cancelText: 'Cancel',
        maxDate: new Date(),
        time: false
    });
});
</script>
