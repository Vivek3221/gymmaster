<section class="content">
    <div class="container-fluid">

        <style>
            .plan-form-header {
                background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
                border-radius: 14px;
                padding: 20px 28px;
                margin-bottom: 24px;
                display: flex;
                align-items: center;
                gap: 12px;
                box-shadow: 0 6px 24px rgba(255, 152, 0, 0.25);
            }
            .plan-form-header h2 { color:#fff; font-size:20px; font-weight:700; margin:0; }
            .plan-form-header i  { color:#fff; font-size:26px; }
            .plan-form-card {
                background: #fff;
                border-radius: 14px;
                box-shadow: 0 4px 24px rgba(0,0,0,0.07);
                border: 1px solid #f0f0f0;
                padding: 32px 36px;
                max-width: 700px;
                margin: 0 auto;
            }
            .plan-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                margin-bottom: 0;
            }
            @media (max-width: 600px) {
                .plan-row {
                    grid-template-columns: 1fr;
                }
            }
            .plan-field-group { margin-bottom: 22px; }
            .plan-field-group label {
                display: block;
                font-size: 12px;
                font-weight: 700;
                color: #888;
                text-transform: uppercase;
                letter-spacing: 0.6px;
                margin-bottom: 7px;
            }
            .plan-field-group input,
            .plan-field-group select,
            .plan-field-group textarea,
            .plan-field-group .input.select select,
            .plan-field-group div.select select {
                width: 100%;
                border: 1.5px solid #e8e8e8;
                border-radius: 8px;
                padding: 11px 14px;
                font-size: 14px;
                color: #333;
                background: #fafafa;
                transition: all 0.25s;
                outline: none;
                box-sizing: border-box;
            }
            .plan-field-group select,
            .plan-field-group .input.select select,
            .plan-field-group div.select select {
                appearance: none !important;
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                background-image: url("data:image/svg+xml;utf8,<svg fill='%23888888' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>") !important;
                background-repeat: no-repeat !important;
                background-position: right 14px center !important;
                background-size: 18px !important;
                padding-right: 40px !important;
                cursor: pointer;
            }
            .plan-field-group input:focus,
            .plan-field-group select:focus,
            .plan-field-group textarea:focus,
            .plan-field-group .input.select select:focus,
            .plan-field-group div.select select:focus {
                border-color: #ff9800;
                background: #fff;
                box-shadow: 0 0 0 3px rgba(255,152,0,0.12);
            }
            .days-display-box {
                display: flex;
                align-items: center;
                gap: 10px;
                background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
                border: 1.5px solid #c8e6c9;
                border-radius: 8px;
                padding: 11px 16px;
                font-size: 16px;
                font-weight: 700;
                color: #2e7d32;
            }
            .days-display-box i { font-size:20px; color:#4caf50; }
            .plan-form-actions { display: flex; gap: 12px; margin-top: 28px; }
            .btn-save-plan {
                background: linear-gradient(135deg, #ff9800, #f57c00);
                color: #fff; border: none; border-radius: 8px;
                padding: 12px 28px; font-size: 14px; font-weight: 700;
                cursor: pointer; display: inline-flex; align-items: center; gap: 8px;
                transition: all 0.25s; box-shadow: 0 4px 12px rgba(255,152,0,0.3);
            }
            .btn-save-plan:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(255,152,0,0.4); }
            .btn-cancel-plan {
                background: #f5f5f5; color: #555; border: 1.5px solid #e0e0e0;
                border-radius: 8px; padding: 12px 24px; font-size: 14px; font-weight: 600;
                cursor: pointer; text-decoration: none !important; display: inline-flex;
                align-items: center; gap: 6px; transition: all 0.25s;
            }
            .btn-cancel-plan:hover { background: #eeeeee; color: #333; }
        </style>

        <?= $this->Flash->render() ?>

        <!-- Header -->
        <div class="plan-form-header">
            <i class="material-icons">edit</i>
            <h2><?= __('Edit Plan') ?>: <?= h($plan->title) ?></h2>
        </div>

        <!-- Form Card -->
        <div class="plan-form-card">
            <?= $this->Form->create($plan, [
                'id'        => 'planEditForm',
                'templates' => ['inputContainer' => '{{content}}']
            ]) ?>

            <div class="plan-row">
                <!-- Plan Title -->
                <div class="plan-field-group">
                    <label for="plan-title"><?= __('Plan Name / Title') ?> <span style="color:red">*</span></label>
                    <?= $this->Form->control('title', [
                        'id'      => 'plan-title',
                        'label'   => false,
                        'required'
                    ]) ?>
                </div>

                <!-- Duration -->
                <div class="plan-field-group">
                    <label for="plan-duration"><?= __('Duration') ?> <span style="color:red">*</span></label>
                    <?= $this->Form->control('duration_months', [
                        'id'      => 'plan-duration',
                        'type'    => 'select',
                        'label'   => false,
                        'options' => $durationOptions,
                        'empty'   => '-- Select Duration --',
                        'value'   => $plan->duration_months,
                        'required'
                    ]) ?>
                </div>
            </div>

            <!-- Days (auto-calculated) -->
            <div class="plan-field-group">
                <label><?= __('Days (Auto-calculated)') ?></label>
                <div class="days-display-box" id="daysDisplay">
                    <i class="material-icons">today</i>
                    <span id="daysValue"><?= $plan->days ?> Days</span>
                </div>
                <?= $this->Form->hidden('days', ['id' => 'planDaysInput', 'value' => $plan->days]) ?>
            </div>

            <!-- Price -->
            <div class="plan-field-group">
                <label for="plan-price"><?= __('Price (₹ INR)') ?> <span style="color:red">*</span></label>
                <?= $this->Form->control('price', [
                    'id'    => 'plan-price',
                    'type'  => 'number',
                    'label' => false,
                    'step'  => '0.01',
                    'min'   => '0',
                    'required'
                ]) ?>
            </div>

            <!-- Description -->
            <div class="plan-field-group">
                <label for="plan-desc"><?= __('Description (Optional)') ?></label>
                <?= $this->Form->control('description', [
                    'id'    => 'plan-desc',
                    'type'  => 'textarea',
                    'label' => false,
                    'rows'  => 3,
                ]) ?>
            </div>

            <!-- Active Status -->
            <div class="plan-field-group">
                <label for="plan-active"><?= __('Status') ?></label>
                <?= $this->Form->control('active', [
                    'id'      => 'plan-active',
                    'type'    => 'select',
                    'label'   => false,
                    'options' => [1 => 'Active', 0 => 'Inactive'],
                    'value'   => $plan->active
                ]) ?>
            </div>

            <!-- Actions -->
            <div class="plan-form-actions">
                <?= $this->Form->button('<i class="material-icons" style="font-size:18px;vertical-align:middle;">save</i> Update Plan', [
                    'class'       => 'btn-save-plan',
                    'escapeTitle' => false
                ]) ?>
                <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="btn-cancel-plan">
                    <i class="material-icons" style="font-size:17px;">arrow_back</i>
                    <?= __('Cancel') ?>
                </a>
            </div>

            <?= $this->Form->end() ?>
        </div>

    </div>
</section>

<script>
$(document).ready(function() {
    $('#plan-duration').on('change', function() {
        var months = parseInt($(this).val(), 10);
        if (months >= 1 && months <= 12) {
            var days = (months === 12) ? 365 : (months * 30);
            $('#daysValue').text(days + ' Days');
            $('#planDaysInput').val(days);
        }
    });
});
</script>
