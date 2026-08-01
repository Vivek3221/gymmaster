<?php
/**
 * Log User PT Class Entry View - Modern Design System
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
.form-field textarea,
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
.form-field select:focus,
.form-field textarea:focus {
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
.pt-card .select2-container--default.select2-container--focus .select2-selection--single,
.pt-card .select2-container--default.select2-container--open .select2-selection--single {
    border-color: #6366f1 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12) !important;
    outline: none !important;
}

/* Live Profit Banner */
.profit-banner {
    grid-column: 1 / -1;
    background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
    border: 1.5px solid #a7f3d0;
    border-radius: 10px;
    padding: 16px;
    margin: 10px 0;
}
.profit-banner .title {
    font-size: 12px;
    font-weight: 700;
    color: #065f46;
    text-transform: uppercase;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.profit-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}
.profit-item {
    background: #ffffff;
    padding: 10px 14px;
    border-radius: 8px;
    border: 1px solid #d1fae5;
    text-align: center;
}
.profit-item label {
    font-size: 10px;
    font-weight: 700;
    color: #065f46;
    text-transform: uppercase;
    margin: 0;
}
.profit-item .val {
    font-size: 17px;
    font-weight: 800;
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
                        <i class="material-icons">event_available</i>
                        <?= __('Log User PT Class Entry & Payroll') ?>
                    </h2>
                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-cancel">
                        <i class="material-icons" style="font-size:16px;">arrow_back</i> <?= __('Back to Payroll') ?>
                    </a>
                </div>

                <div class="pt-body">
                    <?= $this->Form->create($classEntry, ['id' => 'classEntryForm']) ?>

                    <input type="hidden" name="user_pt_subscription_id" id="subIdInput" value="">

                    <!-- SECTION 1: Member & Trainer Selection -->
                    <div class="section-title">
                        <i class="material-icons" style="font-size:18px;">person</i>
                        <?= __('1. Member & Trainer Selection') ?>
                    </div>
                    <div class="field-grid">
                        <div class="form-field">
                            <label><?= __('Select Member / Client') ?></label>
                            <select name="user_id" id="userSelect" class="form-control select2" required>
                                <option value=""><?= __('Select Member / Client') ?></option>
                                <?php foreach ($usersList as $uid => $uname): ?>
                                    <option value="<?= $uid ?>"><?= h($uname) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-field">
                            <label><?= __('Select Trainer') ?></label>
                            <select name="trainer_id" id="trainerSelect" class="form-control select2" required>
                                <option value=""><?= __('Select Trainer') ?></option>
                                <?php foreach ($trainers as $tid => $tname): ?>
                                    <option value="<?= $tid ?>"><?= h($tname) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div id="planAlert" style="display:none; padding:12px 16px; border-radius:8px; margin:12px 0; font-weight:600; font-size:13px;"></div>

                    <!-- SECTION 2: Month, Year & Class Details -->
                    <div class="section-title">
                        <i class="material-icons" style="font-size:18px;">calendar_month</i>
                        <?= __('2. Period & Class Details') ?>
                    </div>
                    <div class="field-grid">
                        <div class="form-field">
                            <label><?= __('Month') ?></label>
                            <select name="month" class="form-control select2" required>
                                <?php 
                                $months = [1=>'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December'];
                                $curMonth = date('n');
                                foreach ($months as $mNum => $mName):
                                ?>
                                    <option value="<?= $mNum ?>" <?= ($curMonth == $mNum) ? 'selected' : '' ?>><?= $mName ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-field">
                            <label><?= __('Year') ?></label>
                            <input type="number" name="year" class="form-control" value="<?= date('Y') ?>" required>
                        </div>

                        <div class="form-field">
                            <label><?= __('Classes Conducted (Count)') ?></label>
                            <input type="number" name="total_classes" id="classesInput" class="form-control" min="1" placeholder="e.g. 4" required>
                        </div>

                        <div class="form-field">
                            <label><?= __('Trainer Rate Per Class (₹)') ?></label>
                            <input type="number" step="0.01" name="rate_per_class" id="trainerRateInput" class="form-control" placeholder="e.g. 400" required>
                        </div>
                    </div>

                    <!-- Live Revenue & Profit Breakdown Banner -->
                    <div class="profit-banner">
                        <div class="title">
                            <i class="material-icons" style="font-size:16px;">analytics</i>
                            <?= __('Live Revenue & Profit Breakdown') ?>
                        </div>
                        <div class="profit-grid">
                            <div class="profit-item">
                                <label><?= __('Client Fee Charged') ?></label>
                                <div class="val" id="calcRevenue" style="color:#0284c7;">₹0.00</div>
                            </div>
                            <div class="profit-item">
                                <label><?= __('Trainer Payout') ?></label>
                                <div class="val" id="calcTrainerPay" style="color:#dc2626;">₹0.00</div>
                            </div>
                            <div class="profit-item">
                                <label><?= __('Gym Net Share') ?></label>
                                <div class="val" id="calcGymProfit" style="color:#16a34a;">₹0.00</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-field" style="margin-top: 10px;">
                        <label><?= __('Notes / Remarks') ?></label>
                        <textarea name="notes" class="form-control" style="height:60px!important;" placeholder="Optional notes..."></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #f1f4f9; display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-cancel"><?= __('Cancel') ?></a>
                        <button type="submit" class="btn-save">
                            <i class="material-icons" style="font-size:18px;">save</i>
                            <?= __('Save Class Entry & Payroll') ?>
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

    var clientRatePerClass = 0;

    $('#userSelect').on('change', function() {
        var userId = $(this).val();
        if (!userId) {
            $('#planAlert').hide();
            clientRatePerClass = 0;
            updateProfit();
            return;
        }

        $.ajax({
            url: '<?= $this->Url->build(['controller' => 'PtPlans', 'action' => 'getUserPtInfo']) ?>/' + userId,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success' && res.has_pt_plan) {
                    clientRatePerClass = res.client_per_class_rate;
                    $('#subIdInput').val(res.subscription_id);
                    if (res.trainer_id && $.fn.select2) {
                        $('#trainerSelect').val(res.trainer_id).trigger('change');
                    } else if (res.trainer_id) {
                        $('#trainerSelect').val(res.trainer_id);
                    }

                    $('#planAlert')
                        .css({'background': '#eff6ff', 'color': '#1e40af', 'border': '1px solid #bfdbfe'})
                        .html('<i class="material-icons" style="font-size:16px;vertical-align:middle;">check_circle</i> Active PT Plan: <strong>' + res.plan_name + '</strong> | Client Rate: <strong>₹' + res.client_per_class_rate.toFixed(2) + '/class</strong> | Balance: <strong>' + res.remaining_classes + ' classes remaining</strong>')
                        .show();
                } else {
                    clientRatePerClass = 0;
                    $('#subIdInput').val('');
                    $('#planAlert')
                        .css({'background': '#fff7ed', 'color': '#c2410c', 'border': '1px solid #ffedd5'})
                        .html('<i class="material-icons" style="font-size:16px;vertical-align:middle;">warning</i> No active PT plan subscription found for this member.')
                        .show();
                }
                updateProfit();
            }
        });
    });

    function updateProfit() {
        var classes = parseInt($('#classesInput').val()) || 0;
        var trainerRate = parseFloat($('#trainerRateInput').val()) || 0;

        var totalRev = classes * clientRatePerClass;
        var totalTrainerPay = classes * trainerRate;
        var gymNet = totalRev - totalTrainerPay;

        $('#calcRevenue').text('₹' + totalRev.toFixed(2));
        $('#calcTrainerPay').text('₹' + totalTrainerPay.toFixed(2));
        $('#calcGymProfit').text('₹' + gymNet.toFixed(2));
    }

    $('#classesInput, #trainerRateInput').on('input change', updateProfit);
});
</script>
