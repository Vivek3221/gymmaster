<?php
/**
 * Create PT Master Plan View - Modern Design System
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
.form-field select,
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
.form-field select:focus {
    border-color: #6366f1 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12) !important;
}

/* Select2 Overrides */
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

.rate-calc-box {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 8px;
    padding: 12px 16px;
    margin-top: 16px;
    color: #166534;
    font-weight: 600;
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
                        <i class="material-icons">fitness_center</i>
                        <?= __('Create PT Master Plan') ?>
                    </h2>
                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-cancel">
                        <i class="material-icons" style="font-size:16px;">arrow_back</i> <?= __('Back to List') ?>
                    </a>
                </div>

                <div class="pt-body">
                    <?= $this->Form->create($ptPlan, ['id' => 'ptPlanForm']) ?>

                    <div class="section-title">
                        <i class="material-icons" style="font-size:18px;">tune</i>
                        <?= __('Plan Details & Pricing') ?>
                    </div>
                    <div class="field-grid">
                        <?php if ($userType == 1 && !empty($partners)): ?>
                            <div class="form-field">
                                <label><?= __('Partner / Branch') ?></label>
                                <select name="partner_id" class="form-control select2" required>
                                    <option value=""><?= __('Select Partner') ?></option>
                                    <?php foreach ($partners as $pid => $pname): ?>
                                        <option value="<?= $pid ?>"><?= h($pname) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>

                        <div class="form-field" style="grid-column: 1 / -1;">
                            <label><?= __('Plan Title / Name') ?></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. 1 Month PT (12 Classes)" required>
                        </div>

                        <div class="form-field">
                            <label><?= __('Duration (Months)') ?></label>
                            <input type="number" name="duration_months" id="durationMonths" class="form-control" value="1" min="1" required>
                        </div>

                        <div class="form-field">
                            <label><?= __('Total Classes (Standard: 12/mo)') ?></label>
                            <input type="number" name="total_classes" id="totalClasses" class="form-control" value="12" min="1" required>
                        </div>

                        <div class="form-field">
                            <label><?= __('Total Plan Price (₹)') ?></label>
                            <input type="number" step="0.01" name="price" id="totalPrice" class="form-control" placeholder="e.g. 12000" required>
                        </div>
                    </div>

                    <div class="rate-calc-box">
                        <?= __('Calculated Per-Class Rate to Client: ') ?>
                        <span id="calculatedRate" style="font-size: 16px; color: #047857; font-weight: 800;">₹0.00 / class</span>
                    </div>

                    <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #f1f4f9; display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-cancel"><?= __('Cancel') ?></a>
                        <button type="submit" class="btn-save">
                            <i class="material-icons" style="font-size:18px;">save</i>
                            <?= __('Save PT Plan') ?>
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

    function updateRate() {
        var classes = parseFloat($('#totalClasses').val()) || 0;
        var price = parseFloat($('#totalPrice').val()) || 0;
        if (classes > 0 && price > 0) {
            var rate = (price / classes).toFixed(2);
            $('#calculatedRate').text('₹' + rate + ' / class');
        } else {
            $('#calculatedRate').text('₹0.00 / class');
        }
    }

    $('#durationMonths').on('input change', function() {
        var months = parseInt($(this).val()) || 1;
        $('#totalClasses').val(months * 12);
        updateRate();
    });

    $('#totalClasses, #totalPrice').on('input change', updateRate);
});
</script>
