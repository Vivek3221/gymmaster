<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
$getModPayment = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();
?>

<style>
.add-payment-container {
    max-width: 800px;
    margin: 25px auto;
    padding: 0 15px;
}
.add-payment-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    border: 1px solid #eaeaea;
    overflow: hidden;
}
.add-payment-card .card-header-modern {
    background: #fafafa;
    border-bottom: 1px solid #edf2f7;
    padding: 20px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.add-payment-card .card-header-modern h2 {
    font-size: 18px;
    font-weight: 700;
    color: #1a202c;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.add-payment-card .card-header-modern h2 i {
    color: #ff9800;
    font-size: 22px;
}
.add-payment-card .card-body-modern {
    padding: 28px;
}
.form-grid-modern {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}
.form-group-modern {
    display: flex;
    flex-direction: column;
}
.form-group-modern label {
    font-size: 13px;
    font-weight: 600;
    color: #4a5568;
    margin-bottom: 7px;
}
.form-group-modern select,
.form-group-modern input {
    border: 1px solid #cbd5e0 !important;
    border-radius: 8px !important;
    padding: 9px 14px !important;
    height: 42px !important;
    font-size: 14px !important;
    color: #2d3748 !important;
    background-color: #fafafa !important;
    transition: all 0.2s ease !important;
    box-shadow: none !important;
    width: 100%;
}
.form-group-modern select:focus,
.form-group-modern input:focus {
    border-color: #ff9800 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
    outline: none !important;
}
.plan-detail-card-strip {
    background: #fff8e1;
    border: 1px solid #ffe082;
    border-radius: 8px;
    padding: 15px 18px;
    margin-top: 10px;
}
.plan-detail-card-strip .detail-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 13px;
    font-weight: 600;
    color: #b45309;
}
.form-actions-modern {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #edf2f7;
}
.btn-submit-payment {
    background: #ff9800 !important;
    color: #ffffff !important;
    border: none !important;
    border-radius: 8px !important;
    padding: 10px 22px !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(255, 152, 0, 0.25) !important;
}
.btn-submit-payment:hover {
    background: #e68a00 !important;
    box-shadow: 0 6px 16px rgba(255, 152, 0, 0.35) !important;
}
.btn-cancel-payment {
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
.btn-cancel-payment:hover {
    background: #e2e8f0 !important;
    color: #1a202c !important;
}
.alert-validation-error {
    background-color: #fff5f5;
    border: 1px solid #feb2b2;
    color: #c53030;
    padding: 14px 18px;
    border-radius: 8px;
    margin-bottom: 20px;
}
.alert-validation-error ul {
    margin: 6px 0 0 18px;
    padding: 0;
}
</style>

<section class="content">
    <div class="container-fluid">
        <div class="add-payment-container">
            <?= $this->Flash->render() ?>

            <!-- Validation Error Alert Banner -->
            <?php if (!empty($payment) && $payment->getErrors()): ?>
                <div class="alert-validation-error">
                    <div style="font-weight: 700; display: flex; align-items: center; gap: 6px;">
                        <i class="material-icons" style="font-size:20px;">error_outline</i>
                        <?= __('Please fix the following validation errors:') ?>
                    </div>
                    <ul>
                        <?php foreach ($payment->getErrors() as $field => $errs): ?>
                            <?php foreach ($errs as $err): ?>
                                <li><strong><?= h(ucwords(str_replace('_', ' ', $field))) ?>:</strong> <?= h($err) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="add-payment-card">
                <div class="card-header-modern">
                    <h2>
                        <i class="material-icons">payment</i>
                        <?= __('Add Payments for Exercise Plan of User') ?>
                    </h2>
                </div>
                <div class="card-body-modern">
                    <?= $this->Form->create($payment, [
                        'enctype'   => 'multipart/form-data',
                        'id'        => 'payment',
                        'templates' => ['inputContainer' => '{{content}}']
                    ]) ?>

                    <div class="form-grid-modern">
                        <div class="form-group-modern">
                            <label><?= __('Select User') ?> <span style="color:red">*</span></label>
                            <?= $this->Form->control('user_id', [
                                'class'    => 'form-control',
                                'type'     => 'select',
                                'options'  => $users,
                                'empty'    => __('Select User'),
                                'required' => true,
                                'label'    => false,
                                'default'  => $userid,
                                'onchange' => 'showPlanList(this.value)'
                            ]) ?>
                        </div>

                        <div class="form-group-modern">
                            <label><?= __('Select Plan') ?> <span style="color:red">*</span></label>
                            <div id="planDiv">
                                <?= $this->Form->control('plan_subscriber_id', [
                                    'class'    => 'form-control',
                                    'type'     => 'select',
                                    'options'  => $planSubscribers,
                                    'empty'    => __('Select Plan'),
                                    'required' => true,
                                    'label'    => false,
                                    'onchange' => 'showPlanDetails(this.value)'
                                ]) ?>
                            </div>
                        </div>

                        <div id="planDetailDiv"></div>

                        <div class="form-group-modern">
                            <label><?= __('Amount Paid (₹)') ?> <span style="color:red">*</span></label>
                            <?= $this->Form->control('amount', [
                                'class'       => 'form-control',
                                'type'        => 'number',
                                'min'         => 0,
                                'required'    => true,
                                'label'       => false,
                                'placeholder' => 'Enter payment amount'
                            ]) ?>
                        </div>

                        <div class="form-group-modern">
                            <label><?= __('Mode of Payment') ?> <span style="color:red">*</span></label>
                            <?= $this->Form->control('mode_ofpay', [
                                'class'    => 'form-control',
                                'type'     => 'select',
                                'empty'    => __('Select Mode Of Payment'),
                                'required' => true,
                                'label'    => false,
                                'options'  => $getModPayment
                            ]) ?>
                        </div>
                    </div>

                    <div class="form-actions-modern">
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="btn-cancel-payment">
                            <i class="material-icons" style="font-size:18px;">arrow_back</i>
                            <?= __('Payment Later') ?>
                        </a>
                        <button type="submit" class="btn-submit-payment">
                            <i class="material-icons" style="font-size:18px;">check_circle</i>
                            <?= __('Add Payment') ?>
                        </button>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    /*
     * get users plan list
     */
    function showPlanList(userid) {
        if (userid !== '') {
            var urls = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'showPlanList']) ?>';
            var urls = urls + '/' + escape(userid);
            $.ajax({
                type: "POST",
                cache: false,
                url: urls,
                success: function (html) {
                    $('#planDiv').html(html);
                }
            });
        }
        return false;
    }
    
    /*
     * get selected plan details
     */
    function showPlanDetails(planid) {
        if (planid !== '') {
            var urls = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'showPlanDetails']) ?>';
            var urls = urls + '/' + escape(planid);
            $.ajax({
                type: "POST",
                cache: false,
                url: urls,
                success: function (html) {
                    $('#planDetailDiv').html(html);
                }
            });
        } else {
            $('#planDetailDiv').html('');
        }
        return false;
    }
</script>
