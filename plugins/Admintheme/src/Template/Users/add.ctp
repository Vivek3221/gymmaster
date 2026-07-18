<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
?>

<style>
    /* Modern Add Page Styling */
    .modern-add-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        border: 1px solid #f0f0f0;
        overflow: hidden;
        margin-bottom: 30px;
    }
    .modern-add-card .header {
        background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%) !important;
        padding: 24px 30px !important;
        border-bottom: none !important;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modern-add-card .header h2 {
        color: #fff !important;
        font-size: 20px !important;
        font-weight: 700 !important;
        margin: 0 !important;
        letter-spacing: 0.5px;
    }
    .modern-add-card .header h2::after {
        display: none !important;
    }
    .modern-add-card .body {
        padding: 40px !important;
    }
    
    /* Layout grid */
    .modern-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 30px;
    }
    @media (max-width: 768px) {
        .modern-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
    .full-width {
        grid-column: span 2;
    }
    @media (max-width: 768px) {
        .full-width {
            grid-column: span 1;
        }
    }

    /* Section styling */
    .form-section-title {
        grid-column: span 2;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        color: #777;
        letter-spacing: 1px;
        margin: 15px 0 5px 0;
        padding-bottom: 8px;
        border-bottom: 2px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    @media (max-width: 768px) {
        .form-section-title {
            grid-column: span 1;
        }
    }
    .form-section-title i {
        color: #4f46e5;
        font-size: 18px;
    }

    /* Form Fields */
    .modern-field-group {
        margin-bottom: 0 !important;
    }
    .modern-field-group label.field-label {
        font-weight: 600 !important;
        font-size: 13px !important;
        color: #444 !important;
        margin-bottom: 8px !important;
        display: block !important;
    }
    
    /* Override bootstrap material form control */
    .modern-add-card .form-control {
        border-radius: 8px !important;
        border: 1px solid #dcdcdc !important;
        padding: 10px 14px !important;
        height: 44px !important;
        font-size: 14px !important;
        box-shadow: none !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background-color: #fafafa !important;
        color: #333 !important;
    }
    .modern-add-card .form-control:focus {
        border-color: #4f46e5 !important;
        background-color: #fff !important;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15) !important;
    }

    /* Style Select dropdowns */
    .modern-add-card select.form-control {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg fill='%23666' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 20px;
        padding-right: 36px !important;
    }

    /* Remove bootstrap floating labels overlay that can conflict */
    .modern-add-card .form-line:after, 
    .modern-add-card .form-line:before {
        display: none !important;
    }
    .modern-add-card .form-line {
        border-bottom: none !important;
        margin-bottom: 0 !important;
    }
    
    /* Actions container */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 40px;
        border-top: 1px solid #f0f0f0;
        padding-top: 24px;
    }
    .btn-modern-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%) !important;
        color: #fff !important;
        border-radius: 8px !important;
        padding: 12px 28px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        border: none !important;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3) !important;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }
    .btn-modern-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.5) !important;
    }
    .btn-modern-secondary {
        background: #f5f5f5 !important;
        color: #555 !important;
        border-radius: 8px !important;
        padding: 12px 28px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        border: 1px solid #e0e0e0 !important;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none !important;
    }
    .btn-modern-secondary:hover {
        background: #eeeeee !important;
        color: #333 !important;
    }
    
    /* Radio options */
    .modern-radio-group {
        display: flex;
        gap: 20px;
        margin-top: 10px;
    }
    .modern-radio-group input[type="radio"] {
        display: none !important;
    }
    .modern-radio-group label {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        cursor: pointer !important;
        padding: 8px 16px !important;
        border: 1px solid #dcdcdc !important;
        border-radius: 6px !important;
        background: #fafafa !important;
        font-weight: 500 !important;
        color: #555 !important;
        transition: all 0.2s ease !important;
    }
    .modern-radio-group input[type="radio"]:checked + label {
        background: #eef2ff !important;
        border-color: #4f46e5 !important;
        color: #4f46e5 !important;
    }
</style>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
                 <?= $this->Flash->render() ?>
                
                <div class="modern-add-card">
                    <div class="header">
                        <h2>
                            <i class="material-icons" style="vertical-align: middle; margin-right: 8px;">person_add</i><?= __('Enquery Form') ?>
                        </h2>
                        <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="btn-modern-secondary" style="padding: 6px 14px !important; font-size: 12px !important; border-radius: 6px !important; height: auto;">
                            <i class="material-icons" style="font-size: 16px;">arrow_back</i><?= __('Back to List') ?>
                        </a>
                    </div>
                    
                    <div class="body">
                        <?= $this->Form->create($user, [
                            'id' => 'addusers',
                            'templates' => [
                                'inputContainer' => '{{content}}'
                            ]
                        ]) ?>
                        
                        <div class="modern-grid">
                            <!-- Section: Basic Information -->
                            <div class="form-section-title">
                                <i class="material-icons">person</i>
                                <span><?= __('Personal Details') ?></span>
                            </div>
                            
                            <?php if (isset($users_type) && ($users_type == 1)) { ?>
                                <div class="modern-field-group">
                                    <label class="field-label"><?= __('User Type') ?></label>
                                    <div class="form-line">
                                        <?= $this->Form->control('user_type', [
                                            'class' => 'form-control', 
                                            'type' => 'select', 
                                            'empty' => __('Select Type'), 
                                            'options' => $user_type,
                                            'label' => false,
                                            'required' => true
                                        ]) ?>          
                                    </div>
                                </div>
                            <?php } ?>
                            
                            <div class="modern-field-group">
                                <label class="field-label"><?= __('Full Name') ?></label>
                                <div class="form-line">
                                    <?= $this->Form->control('name', [
                                        'class' => 'form-control', 
                                        'type' => 'text', 
                                        'label' => false,
                                        'required' => true,
                                        'placeholder' => __('Enter Full Name')
                                    ]) ?> 
                                </div>
                            </div>
                            
                            <div class="modern-field-group">
                                <label class="field-label"><?= __('Email Address') ?></label>
                                <div class="form-line">
                                    <?= $this->Form->control('email', [
                                        'class' => 'form-control', 
                                        'type' => 'email', 
                                        'label' => false,
                                        'placeholder' => __('Enter Email Address')
                                    ]) ?> 
                                </div>
                            </div>

                            <div class="modern-field-group">
                                <label class="field-label"><?= __('Date of Birth') ?></label>
                                <div class="form-line">
                                    <?= $this->Form->control('dob', [
                                        'class' => 'form-control datetimepicker', 
                                        'type' => 'text', 
                                        'placeholder' => 'YYYY-MM-DD', 
                                        'label' => false,
                                        'required' => true
                                    ]) ?>          
                                </div>
                            </div>

                            <div class="modern-field-group">
                                <label class="field-label"><?= __('Gender') ?></label>
                                <div class="modern-radio-group">
                                    <input type="radio" name="gender" id="a" value="1" class="indual with-gap" checked>
                                    <label for="a">
                                        <i class="material-icons" style="font-size: 16px; vertical-align: middle;">male</i> <?= __('Male') ?>
                                    </label>
                                    
                                    <input type="radio" name="gender" id="b" value="2" class="company with-gap">
                                    <label for="b">
                                        <i class="material-icons" style="font-size: 16px; vertical-align: middle;">female</i> <?= __('Female') ?>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Section: Contact Details -->
                            <div class="form-section-title">
                                <i class="material-icons">contact_phone</i>
                                <span><?= __('Contact Details') ?></span>
                            </div>

                            <div class="modern-field-group">
                                <label class="field-label"><?= __('Mobile Number') ?></label>
                                <div class="form-line">
                                    <?= $this->Form->control('mobile_no', [
                                        'class' => 'form-control',
                                        'type' => 'text', 
                                        'label' => false,
                                        'required' => true,
                                        'placeholder' => __('Enter Mobile Number')
                                    ]) ?> 
                                </div>
                            </div>

                            <div class="modern-field-group">
                                <label class="field-label"><?= __('Emergency Contact No.') ?></label>
                                <div class="form-line">
                                    <?= $this->Form->control('emerg_no', [
                                        'class' => 'form-control',
                                        'type' => 'text', 
                                        'label' => false,
                                        'placeholder' => __('Enter Emergency Number')
                                    ]) ?> 
                                </div>
                            </div>

                            <div class="modern-field-group full-width">
                                <label class="field-label"><?= __('Address') ?></label>
                                <div class="form-line">
                                    <?= $this->Form->control('location', [
                                        'class' => 'form-control', 
                                        'type' => 'text',
                                        'label' => false,
                                        'placeholder' => __('Enter Address')
                                    ]) ?> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <?= $this->Form->button('<i class="material-icons" style="font-size:18px; vertical-align:middle; margin-top:-2px;">person_add</i> ' . __('Add User'), [
                                'class' => 'btn-modern-primary waves-effect',
                                'escapeTitle' => false
                            ]) ?>
                            <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="btn-modern-secondary">
                                <i class="material-icons" style="font-size:18px; vertical-align:middle; margin-top:-2px;">close</i><?= __('Cancel') ?>
                            </a>
                        </div>

                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
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