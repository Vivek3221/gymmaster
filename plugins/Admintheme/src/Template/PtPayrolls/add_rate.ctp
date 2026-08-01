<style>
.payment-wrapper {
    max-width: 800px;
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
.field-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 12px 20px;
}
.form-field {
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
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
    outline: none !important;
    box-sizing: border-box !important;
    box-shadow: none !important;
    height: 38px !important;
}
.form-field input:focus {
    border-color: #ff9800 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.12) !important;
}
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
.payment-card .select2-container {
    display: block;
    width: 100% !important;
}
.payment-card .select2-container--default .select2-selection--single {
    height: 38px !important;
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 8px !important;
    background: #f8fafc !important;
    display: flex;
    align-items: center;
}
.payment-card .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 38px !important;
    padding-left: 12px !important;
    color: #334155 !important;
}
.payment-card .select2-container--default.select2-container--focus .select2-selection--single,
.payment-card .select2-container--default.select2-container--open .select2-selection--single {
    border-color: #ff9800 !important;
    background-color: #ffffff !important;
}
</style>

<section class="content">
    <div class="container-fluid">
        <div class="payment-wrapper">
            <?= $this->Flash->render() ?>

            <div class="payment-card">
                <div class="payment-header">
                    <h2>
                        <i class="material-icons">add</i>
                        <?= __('Add PT Rate') ?>
                    </h2>
                    <a href="<?= $this->Url->build(['action' => 'rates']) ?>" class="btn-cancel" style="padding:6px 12px;font-size:12.5px;height:auto;">
                        <i class="material-icons" style="font-size:15px;">arrow_back</i> <?= __('Back') ?>
                    </a>
                </div>

                <div class="payment-body">
                    <?= $this->Form->create($rate, [
                        'id' => 'ptRateForm',
                        'templates' => ['inputContainer' => '{{content}}']
                    ]) ?>

                    <div class="section-title">
                        <i class="material-icons" style="font-size:18px;">monetization_on</i>
                        <?= __('1. Rate configuration') ?>
                    </div>

                    <div class="field-grid">
                        <?php if ($isGlobal) { ?>
                            <div class="form-field">
                                <label><?= __('Partner') ?> <span style="color:red">*</span></label>
                                <?= $this->Form->control('partner_id', [
                                    'class' => 'select2',
                                    'type' => 'select',
                                    'options' => $partners,
                                    'empty' => __('Select Partner'),
                                    'id' => 'partnerSelectDropdown',
                                    'label' => false,
                                    'required' => true
                                ]) ?>
                            </div>
                        <?php } ?>

                        <div class="form-field">
                            <label><?= __('Trainer') ?> <span style="color:red">*</span></label>
                            <?= $this->Form->control('trainer_id', [
                                'class' => 'select2',
                                'type' => 'select',
                                'options' => $trainers,
                                'empty' => __('Select Trainer'),
                                'id' => 'trainerSelectDropdown',
                                'label' => false,
                                'required' => true
                            ]) ?>
                        </div>

                        <div class="form-field">
                            <label><?= __('Rate Per Class (₹)') ?> <span style="color:red">*</span></label>
                            <?= $this->Form->control('rate_per_class', [
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => 0,
                                'placeholder' => '0.00',
                                'label' => false,
                                'required' => true
                            ]) ?>
                        </div>

                        <div class="form-field">
                            <label><?= __('Effective From') ?> <span style="color:red">*</span></label>
                            <?= $this->Form->control('effective_from', [
                                'class' => 'form-control datepicker',
                                'type' => 'text',
                                'placeholder' => 'YYYY-MM-DD',
                                'label' => false,
                                'required' => true,
                                'autocomplete' => 'off'
                            ]) ?>
                        </div>

                        <div class="form-field">
                            <label><?= __('Status') ?> <span style="color:red">*</span></label>
                            <?= $this->Form->control('status', [
                                'class' => 'select2',
                                'type' => 'select',
                                'options' => [1 => 'Active', 0 => 'Inactive'],
                                'label' => false,
                                'required' => true
                            ]) ?>
                        </div>
                    </div>

                    <div class="form-actions">
                        <?= $this->Form->button('<i class="material-icons" style="font-size:18px;vertical-align:middle;">check_circle</i> Save Rate', [
                            'class' => 'btn-save',
                            'escapeTitle' => false
                        ]) ?>
                        <a href="<?= $this->Url->build(['action' => 'rates']) ?>" class="btn-cancel">
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
$(document).ready(function() {
    $('.select2').select2({
        width: '100%'
    });

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        time: false,
        weekStart: 1
    });

    <?php if ($isGlobal) { ?>
    // Filter trainers dynamically by selected partner
    $('#partnerSelectDropdown').on('change', function() {
        var partnerId = $(this).val();
        var trainerSelect = $('#trainerSelectDropdown');
        trainerSelect.empty().append('<option value="">-- Choose Trainer --</option>');
        
        if (!partnerId) {
            return;
        }

        var url = '<?= $this->Url->build(['controller' => 'PtPayrolls', 'action' => 'getTrainersByPartner']) ?>/' + partnerId;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $.each(res, function(id, name) {
                    trainerSelect.append('<option value="' + id + '">' + name + '</option>');
                });
                trainerSelect.trigger('change.select2');
            }
        });
    });
    <?php } ?>
});
</script>
