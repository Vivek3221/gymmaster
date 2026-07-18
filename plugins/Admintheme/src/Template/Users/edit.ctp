<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
$getModPayment = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();
?>

<style>
    /* Modern Edit Page Styling */
    .modern-edit-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        border: 1px solid #f0f0f0;
        overflow: hidden;
        margin-bottom: 30px;
    }
    .modern-edit-card .header {
        background: linear-gradient(135deg, #ff9800 0%, #e68a00 100%) !important;
        padding: 24px 30px !important;
        border-bottom: none !important;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modern-edit-card .header h2 {
        color: #fff !important;
        font-size: 20px !important;
        font-weight: 700 !important;
        margin: 0 !important;
        letter-spacing: 0.5px;
    }
    .modern-edit-card .header h2::after {
        display: none !important;
    }
    .modern-edit-card .body {
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
        color: #ff9800;
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
    .modern-edit-card .form-control {
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
    .modern-edit-card .form-control:focus {
        border-color: #ff9800 !important;
        background-color: #fff !important;
        box-shadow: 0 0 0 4px rgba(255, 152, 0, 0.15) !important;
    }
    .modern-edit-card .form-control[readonly] {
        background-color: #f1f1f1 !important;
        color: #888 !important;
        cursor: not-allowed;
        border-color: #e0e0e0 !important;
    }

    /* Style Select dropdowns */
    .modern-edit-card select.form-control {
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
    .modern-edit-card .form-line:after, 
    .modern-edit-card .form-line:before {
        display: none !important;
    }
    .modern-edit-card .form-line {
        border-bottom: none !important;
        margin-bottom: 0 !important;
    }
    
    /* Cover Image Preview */
    .modern-image-upload {
        display: flex;
        align-items: center;
        gap: 20px;
        background: #fafafa;
        padding: 16px;
        border-radius: 12px;
        border: 1px dashed #dcdcdc;
    }
    .image-preview-container {
        width: 100px;
        height: 100px;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        background: #f5f5f5;
        flex-shrink: 0;
    }
    .image-preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .upload-input-wrap {
        flex-grow: 1;
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
        background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%) !important;
        color: #fff !important;
        border-radius: 8px !important;
        padding: 12px 28px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        border: none !important;
        box-shadow: 0 4px 14px rgba(255, 152, 0, 0.3) !important;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }
    .btn-modern-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 152, 0, 0.5) !important;
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
</style>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
                 <?= $this->Flash->render() ?>
                
                <div class="modern-edit-card">
                    <div class="header">
                        <h2>
                            <i class="material-icons" style="vertical-align: middle; margin-right: 8px;">edit</i><?= __('Edit User') ?>
                        </h2>
                        <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="btn-modern-secondary" style="padding: 6px 14px !important; font-size: 12px !important; border-radius: 6px !important; height: auto;">
                            <i class="material-icons" style="font-size: 16px;">arrow_back</i><?= __('Back to List') ?>
                        </a>
                    </div>
                    
                    <div class="body">
                        <?= $this->Form->create($user, [
                            'enctype' => 'multipart/form-data',
                            'id' => 'editusers',
                            'templates' => [
                                'inputContainer' => '{{content}}'
                            ]
                        ]) ?>
                        
                        <div class="modern-grid">
                            
                            <!-- Section: Account Settings -->
                            <div class="form-section-title">
                                <i class="material-icons">account_box</i>
                                <span><?= __('Account Details') ?></span>
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
                                            'label' => false
                                        ]) ?>          
                                    </div>
                                </div>
                            <?php } ?>
                            
                            <div class="modern-field-group">
                                <label class="field-label"><?= __('Name') ?></label>
                                <div class="form-line">
                                    <?= $this->Form->control('name', [
                                        'class' => 'form-control', 
                                        'type' => 'text', 
                                        'label' => false,
                                        'required' => true
                                    ]) ?> 
                                </div>
                            </div>
                            
                            <div class="modern-field-group">
                                <label class="field-label"><?= __('Email') ?></label>
                                <div class="form-line">
                                    <?php 
                                    $isEmailEditable = in_array($usersdetail['users_email'], ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com']);
                                    if ($isEmailEditable) {
                                        echo $this->Form->control('email', [
                                            'class' => 'form-control', 
                                            'label' => false,
                                            'required' => true
                                        ]);
                                    } else {
                                        echo $this->Form->control('email', [
                                            'class' => 'form-control', 
                                            'label' => false, 
                                            'readonly' => true
                                        ]);
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="modern-field-group">
                                <label class="field-label"><?= __('Mobile Number') ?></label>
                                <div class="form-line">
                                    <?= $this->Form->control('mobile_no', [
                                        'class' => 'form-control',
                                        'type' => 'number', 
                                        'label' => false,
                                        'required' => true
                                    ]) ?> 
                                </div>
                            </div>
                            
                            <div class="modern-field-group">
                                <label class="field-label"><?= __('Date of Birth') ?></label>
                                <div class="form-line">
                                    <?php
                                    $dob1 = $user->dob;
                                    $dob = $dob1 ? date_format($dob1, "Y-m-d") : '';
                                    ?>
                                    <?= $this->Form->control('dob', [
                                        'class' => 'form-control datetimepicker', 
                                        'type' => 'text', 
                                        'placeholder' => 'YYYY-MM-DD',
                                        'value' => $dob, 
                                        'label' => false,
                                        'required' => true
                                    ]) ?>          
                                </div>
                            </div>

                            <div class="modern-field-group">
                                <label class="field-label"><?= __('Status') ?></label>
                                <div class="form-line">
                                    <?= $this->Form->input('active', [
                                        'empty' => __('Select status'), 
                                        'options' => $status, 
                                        'class' => 'form-control',
                                        'label' => false
                                    ]); ?>
                                </div>
                            </div>

                            <?php if ($users_type == 2) { ?>
                                <div class="modern-field-group">
                                    <label class="field-label"><?= __('Select Trainer') ?></label>
                                    <div class="form-line">
                                        <?= $this->Form->control('trainer_userid', [
                                            'class' => 'form-control select2', 
                                            'type' => 'select',
                                            'options' => $trainers,
                                            'default' => $user->trainer_userid, 
                                            'empty' => 'Select Trainer', 
                                            'label' => false
                                        ]) ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <!-- Section: Payment Details -->
                            <?php if (!empty($user->payment)) { ?>
                                <div class="form-section-title">
                                    <i class="material-icons">payment</i>
                                    <span><?= __('Payment & Plan Details') ?></span>
                                </div>
                                
                                <div class="modern-field-group">
                                    <label class="field-label"><?= __('Payment Rs.') ?></label>
                                    <div class="form-line">
                                        <?= $this->Form->control('payment', [
                                            'class' => 'form-control', 
                                            'type' => 'text', 
                                            'label' => false
                                        ]) ?> 
                                    </div>
                                </div>
                                
                                <div class="modern-field-group">
                                    <label class="field-label"><?= __('Payment Due') ?></label>
                                    <div class="form-line">
                                        <?= $this->Form->control('b_payment', [
                                            'class' => 'form-control', 
                                            'type' => 'text', 
                                            'label' => false
                                        ]) ?> 
                                    </div>
                                </div>
                                
                                <div class="modern-field-group">
                                    <label class="field-label"><?= __('Mode Of Payment') ?></label>
                                    <div class="form-line">
                                        <?= $this->Form->control('mode_ofpay', [
                                            'class' => 'form-control', 
                                            'type' => 'select',
                                            'empty' => 'Select Mode Of Payment',
                                            'options' => $getModPayment,
                                            'label' => false
                                        ]) ?>          
                                    </div>
                                </div>
                                
                                <div class="modern-field-group">
                                    <label class="field-label"><?= __('Course Of Duration') ?></label>
                                    <div class="form-line">
                                        <?= $this->Form->control('course_duration', [
                                            'class' => 'form-control', 
                                            'type' => 'select',
                                            'empty' => 'Select Course Of Duration',
                                            'options' => $getPayDuration,
                                            'label' => false
                                        ]) ?>          
                                    </div>
                                </div>
                            <?php } ?>
                            
                            <!-- Section: Media / Photo -->
                            <div class="form-section-title">
                                <i class="material-icons">image</i>
                                <span><?= __('Profile Picture') ?></span>
                            </div>
                            
                            <div class="full-width">
                                <div class="modern-image-upload">
                                    <div class="image-preview-container">
                                        <?php 
                                        $cover = '/img/avatar-placeholder.png'; // default fallback
                                        if (!empty($user->photo)) {
                                            $cover = '/img/' . $user->photo;
                                            if (strpos($user->photo, 'http') !== false) {
                                                $cover = $user->photo;
                                            }
                                        }
                                        ?>
                                        <?= $this->Html->image($cover, [
                                            'class' => 'preview-img-tag', 
                                            'id' => 'profile-preview',
                                            'alt' => 'Profile Photo',
                                            'width' => 100,
                                            'height' => 100
                                        ]); ?>
                                    </div>
                                    <div class="upload-input-wrap">
                                        <label class="field-label" style="margin-bottom: 5px !important;"><?= __('Upload New Image') ?></label>
                                        <?= $this->Form->control('images', [
                                            'label' => false, 
                                            'class' => 'form-control', 
                                            'type' => 'file', 
                                            'id' => 'images-upload',
                                            'onchange' => "previewAndValidateImage();"
                                        ]) ?>
                                        <small style="color: #888; display: block; margin-top: 4px;"><?= __('Allowed sizes up to 2MB (jpg, jpeg, png, gif, bmp)') ?></small>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-actions">
                            <?= $this->Form->button('<i class="material-icons" style="font-size:18px; vertical-align:middle; margin-top:-2px;">save</i> ' . __('Save Changes'), [
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
    
    function previewAndValidateImage() {
        var fileInput = document.getElementById('images-upload');
        var preview = document.getElementById('profile-preview');
        
        if (fileInput.files && fileInput.files[0]) {
            var file = fileInput.files[0];
            var sizeinbytes = file.size;
            var size = sizeinbytes / 1024 / 1024;
            
            var Extension = file.name.substring(file.name.lastIndexOf('.') + 1).toLowerCase();
            var allowedExtensions = ["gif", "png", "bmp", "jpeg", "jpg"];
            
            if (allowedExtensions.indexOf(Extension) === -1) {
                alert('Allowed only .gif,.png,.bmp,.jpg,.jpeg image files.');
                fileInput.value = '';
                return;
            }
            
            if (size > 2) {
                alert('Allowed maximum image size is 2MB.');
                fileInput.value = '';
                return;
            }
            
            // Show real-time preview of the selected image!
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>