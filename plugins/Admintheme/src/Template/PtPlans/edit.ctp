<?php
/**
 * Edit PT Master Plan View
 */
?>
<style>
.form-card {
    max-width: 650px;
    margin: 20px auto;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid #eef2f6;
    padding: 24px;
}
.form-header {
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 14px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.form-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 8px;
}
.form-group label {
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    color: #64748b;
    margin-bottom: 6px;
}
.form-control {
    border-radius: 8px !important;
    border: 1.5px solid #cbd5e1 !important;
    padding: 8px 12px !important;
    height: 42px !important;
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
</style>

<section class="content">
    <div class="container-fluid">
        <?= $this->Flash->render() ?>

        <div class="form-card">
            <div class="form-header">
                <h3>
                    <i class="material-icons" style="color: #6366f1;">edit</i>
                    <?= __('Edit PT Master Plan') ?>
                </h3>
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default btn-sm">
                    <?= __('Back to List') ?>
                </a>
            </div>

            <?= $this->Form->create($ptPlan) ?>

            <div class="form-group">
                <label><?= __('Plan Title / Name') ?></label>
                <?= $this->Form->control('title', [
                    'class' => 'form-control',
                    'label' => false,
                    'required' => true
                ]) ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?= __('Duration (Months)') ?></label>
                        <?= $this->Form->control('duration_months', [
                            'type' => 'number',
                            'class' => 'form-control',
                            'id' => 'durationMonths',
                            'min' => 1,
                            'label' => false
                        ]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?= __('Total Classes') ?></label>
                        <?= $this->Form->control('total_classes', [
                            'type' => 'number',
                            'class' => 'form-control',
                            'id' => 'totalClasses',
                            'min' => 1,
                            'label' => false
                        ]) ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label><?= __('Total Plan Price (₹)') ?></label>
                <?= $this->Form->control('price', [
                    'type' => 'number',
                    'step' => '0.01',
                    'class' => 'form-control',
                    'id' => 'totalPrice',
                    'label' => false,
                    'required' => true
                ]) ?>
            </div>

            <div class="rate-calc-box">
                <?= __('Calculated Per-Class Rate to Client: ') ?>
                <span id="calculatedRate" style="font-size: 16px; color: #047857; font-weight: 800;">₹<?= number_format($ptPlan->per_class_rate, 2) ?> / class</span>
            </div>

            <div style="margin-top: 24px; text-align: right;">
                <button type="submit" class="btn btn-primary" style="padding: 10px 24px; border-radius: 8px; font-weight: 700;">
                    <i class="material-icons" style="font-size:18px; vertical-align:middle;">save</i> <?= __('Update PT Plan') ?>
                </button>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
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

    $('#totalClasses, #totalPrice').on('input change', updateRate);
});
</script>
