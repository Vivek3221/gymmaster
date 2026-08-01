<?php
/**
 * Assign PT Plan to Member View - Modern Design System
 */
?>
<style>
.pt-wrapper {
    width: 100%;
    margin: 10px 0;
}
.pt-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
    border: 1px solid #eef2f6;
    overflow: hidden;
}
.pt-header {
    padding: 16px 24px;
    background: linear-gradient(135deg, #eef2ff 0%, #fafbfe 100%);
    border-bottom: 1px solid #f1f4f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.pt-header h2 {
    font-size: 17px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.pt-header h2 i {
    color: #6366f1;
    font-size: 22px;
}
.pt-body {
    padding: 24px;
}

.section-title {
    font-size: 11px;
    font-weight: 700;
    color: #4f46e5;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin: 20px 0 12px 0;
    padding-bottom: 6px;
    border-bottom: 1.5px solid #e0e7ff;
    display: flex;
    align-items: center;
    gap: 6px;
}
.section-title:first-of-type {
    margin-top: 0;
}

.field-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 16px;
}
.form-field {
    display: flex;
    flex-direction: column;
    margin-bottom: 4px;
}
.form-field label {
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
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
.form-field input:focus,
.form-field .form-control:focus {
    border-color: #6366f1 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12) !important;
}

/* Select2 Container Overrides */
.pt-card .select2-container {
    display: block;
    width: 100% !important;
}
.pt-card .select2-container--default .select2-selection--single {
    height: 38px !important;
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 8px !important;
    background: #f8fafc !important;
    box-shadow: none !important;
    display: flex;
    align-items: center;
    width: 100% !important;
}
.pt-card .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 38px !important;
    padding-left: 12px !important;
    color: #334155 !important;
    font-size: 13.5px !important;
}
.pt-card .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px !important;
    right: 8px !important;
}
.pt-card .select2-container--default.select2-container--focus .select2-selection--single,
.pt-card .select2-container--default.select2-container--open .select2-selection--single {
    border-color: #6366f1 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12) !important;
    outline: none !important;
}

/* Plan Financial Breakdown Banner */
.financial-banner {
    grid-column: 1 / -1;
    background: linear-gradient(135deg, #eff6ff 0%, #f0fdf4 100%);
    border: 1.5px solid #bfdbfe;
    border-radius: 10px;
    padding: 16px;
    display: none;
}
.financial-banner .title {
    font-size: 12px;
    font-weight: 700;
    color: #1e40af;
    text-transform: uppercase;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.banner-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}
.banner-item {
    background: #ffffff;
    padding: 10px 14px;
    border-radius: 8px;
    border: 1px solid #dbeafe;
}
.banner-item label {
    font-size: 10px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    margin: 0;
}
.banner-item .val {
    font-size: 16px;
    font-weight: 800;
    color: #0f172a;
    margin-top: 2px;
}

.btn-save {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%) !important;
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
    box-shadow: 0 3px 10px rgba(99, 102, 241, 0.2);
    height: 40px;
}
.btn-save:hover {
    transform: translateY(-1px);
    box-shadow: 0 5px 14px rgba(99, 102, 241, 0.3);
}
.btn-cancel {
    background: #f8fafc;
    color: #64748b;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    height: 38px;
    box-sizing: border-box;
}
.btn-cancel:hover {
    background: #f1f5f9;
    color: #334155;
}
</style>

<section class="content">
    <div class="container-fluid">
        <div class="pt-wrapper">
            <?= $this->Flash->render() ?>

            <div class="pt-card">
                <div class="pt-header">
                    <h2>
                        <i class="material-icons">person_add</i>
                        <?= __('Assign PT Plan to Member') ?>
                    </h2>
                    <a href="<?= $this->Url->build(['action' => 'subscriptions']) ?>" class="btn-cancel">
                        <i class="material-icons" style="font-size:16px;">format_list_bulleted</i> <?= __('View Subscriptions') ?>
                    </a>
                </div>

                <div class="pt-body">
                    <?= $this->Form->create($subscription, ['id' => 'assignForm']) ?>

                    <!-- SECTION 1: Member & Trainer Selection -->
                    <div class="section-title">
                        <i class="material-icons" style="font-size:18px;">person</i>
                        <?= __('1. Member & Trainer Assignment') ?>
                    </div>
                    <div class="field-grid">
                        <div class="form-field">
                            <label><?= __('Select Member / Client') ?></label>
                            <select name="user_id" id="userSelect" class="form-control select2" required>
                                <option value=""><?= __('Select Member') ?></option>
                                <?php foreach ($usersList as $uid => $uname): ?>
                                    <option value="<?= $uid ?>" <?= ($selectedUserId == $uid) ? 'selected' : '' ?>><?= h($uname) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-field">
                            <label><?= __('Select Assigned Trainer') ?></label>
                            <select name="trainer_id" id="trainerSelect" class="form-control select2" required>
                                <option value=""><?= __('Select Trainer') ?></option>
                                <?php foreach ($trainersList as $tid => $tname): ?>
                                    <option value="<?= $tid ?>"><?= h($tname) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-field">
                            <label><?= __('Select PT Master Plan') ?></label>
                            <select name="pt_plan_id" id="ptPlanSelect" class="form-control select2" required>
                                <option value=""><?= __('Select PT Master Plan') ?></option>
                                <?php foreach ($ptPlans as $p): ?>
                                    <option value="<?= $p->id ?>" 
                                            data-price="<?= $p->price ?>" 
                                            data-classes="<?= $p->total_classes ?>" 
                                            data-months="<?= $p->duration_months ?>"
                                            data-rate="<?= $p->per_class_rate ?>">
                                        <?= h($p->title) ?> — ₹<?= number_format($p->price, 2) ?> (<?= $p->total_classes ?> Classes)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Financial Summary Preview Banner -->
                    <div class="financial-banner" id="summaryCard">
                        <div class="title">
                            <i class="material-icons" style="font-size:16px;">analytics</i>
                            <?= __('PT Plan Financial Breakdown') ?>
                        </div>
                        <div class="banner-grid">
                            <div class="banner-item">
                                <label><?= __('Total Classes') ?></label>
                                <div class="val" id="prevClasses">12</div>
                            </div>
                            <div class="banner-item">
                                <label><?= __('Total Amount') ?></label>
                                <div class="val" id="prevAmount" style="color:#059669;">₹12,000</div>
                            </div>
                            <div class="banner-item">
                                <label><?= __('Client Rate Per Class') ?></label>
                                <div class="val" id="prevRate" style="color:#4f46e5;">₹1,000 / class</div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: Pricing & Validity Dates -->
                    <div class="section-title">
                        <i class="material-icons" style="font-size:18px;">event_available</i>
                        <?= __('2. Plan Pricing & Validity Dates') ?>
                    </div>
                    <div class="field-grid">
                        <div class="form-field">
                            <label><?= __('Amount Charged (₹)') ?></label>
                            <input type="number" step="0.01" name="price" id="customPrice" class="form-control" placeholder="e.g. 12000" required>
                        </div>

                        <div class="form-field">
                            <label><?= __('Total Classes Count') ?></label>
                            <input type="number" name="total_classes" id="customClasses" class="form-control" placeholder="e.g. 12" required>
                        </div>

                        <div class="form-field">
                            <label><?= __('Start Date') ?></label>
                            <input type="date" name="start_date" id="startDateInput" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>

                        <div class="form-field">
                            <label><?= __('End / Expiry Date') ?></label>
                            <input type="date" name="end_date" id="endDateInput" class="form-control" value="<?= date('Y-m-d', strtotime('+1 month')) ?>" required>
                        </div>
                    </div>

                    <!-- Form Action Buttons -->
                    <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #f1f4f9; display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="<?= $this->Url->build(['action' => 'subscriptions']) ?>" class="btn-cancel"><?= __('Cancel') ?></a>
                        <button type="submit" class="btn-save">
                            <i class="material-icons" style="font-size:18px;">check_circle</i>
                            <?= __('Assign PT Plan') ?>
                        </button>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    if ($.fn.select2) {
        $('.select2').select2({ width: '100%' });
    }

    $('#ptPlanSelect').on('change', function() {
        var opt = $(this).find(':selected');
        if (opt.val()) {
            var price = parseFloat(opt.data('price')) || 0;
            var classes = parseInt(opt.data('classes')) || 12;
            var rate = parseFloat(opt.data('rate')) || (price / classes);
            var months = parseInt(opt.data('months')) || 1;

            $('#customPrice').val(price);
            $('#customClasses').val(classes);

            $('#prevClasses').text(classes + ' Classes');
            $('#prevAmount').text('₹' + price.toLocaleString());
            $('#prevRate').text('₹' + rate.toFixed(2) + ' / class');
            $('#summaryCard').slideDown(200);

            var today = new Date();
            today.setMonth(today.getMonth() + months);
            var yyyy = today.getFullYear();
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var dd = String(today.getDate()).padStart(2, '0');
            $('#endDateInput').val(yyyy + '-' + mm + '-' + dd);
        } else {
            $('#summaryCard').slideUp(200);
        }
    });

    $('#customPrice, #customClasses').on('input change', function() {
        var p = parseFloat($('#customPrice').val()) || 0;
        var c = parseInt($('#customClasses').val()) || 1;
        if (c > 0 && p > 0) {
            var r = (p / c).toFixed(2);
            $('#prevRate').text('₹' + r + ' / class');
            $('#prevAmount').text('₹' + p.toLocaleString());
            $('#prevClasses').text(c + ' Classes');
        }
    });
});
</script>
