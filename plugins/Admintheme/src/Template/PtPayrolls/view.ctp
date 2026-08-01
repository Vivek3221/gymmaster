<style>
    html, body, .content, .container-fluid {
        overflow-x: hidden !important;
    }
    .details-wrapper {
        max-width: 950px;
        margin: 10px auto;
        padding: 0 15px;
    }
    .details-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
        border: 1px solid #eef2f6;
        overflow: hidden;
    }
    .details-header {
        padding: 16px 24px;
        background: #f8fafc;
        border-bottom: 1px solid #eef2f6;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .details-header h2 {
        font-size: 15px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .details-header h2 i {
        color: #ff9800;
    }
    .details-body {
        padding: 20px 24px;
    }
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    .info-section-card {
        background: #fff;
        border: 1.5px solid #f1f5f9;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.2s ease;
    }
    .info-section-card:hover {
        border-color: #e2e8f0;
    }
    .info-section-header {
        background: #f8fafc;
        border-bottom: 1.5px solid #f1f5f9;
        padding: 10px 16px;
        font-size: 11px;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .info-section-body {
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .info-item {
        display: flex;
        flex-direction: column;
    }
    .info-label {
        font-size: 10px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 3px;
    }
    .info-value {
        font-size: 13.5px;
        color: #334155;
        font-weight: 600;
    }
    .info-value.amount {
        font-size: 18px;
        font-weight: 800;
        color: #16a34a;
    }

    /* Badges */
    .status-badge {
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 4px 10px;
        border-radius: 30px;
        display: inline-block;
        text-align: center;
        width: fit-content;
    }
    .status-badge.pending-badge {
        background-color: #fff3e0;
        color: #e65100;
    }
    .status-badge.paid-badge {
        background-color: #e8f5e9;
        color: #1b5e20;
    }

    /* Notes Box */
    .notes-card {
        background: #fff;
        border: 1.5px solid #f1f5f9;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
    }
    .notes-card label {
        font-weight: 700;
        font-size: 11px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 6px;
    }
    .notes-content {
        background: #f8fafc;
        border-radius: 8px;
        padding: 12px;
        color: #334155;
        font-size: 13px;
        line-height: 1.5;
        border: 1px solid #e2e8f0;
    }

    /* Buttons */
    .btn-back {
        background: #fff;
        color: #64748b;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px;
        padding: 8px 18px;
        font-weight: 700;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        height: 38px;
        text-decoration: none !important;
    }
    .btn-back:hover {
        background: #f8fafc;
        color: #334155;
        border-color: #94a3b8;
    }
    .btn-pay {
        background: linear-gradient(135deg, #4caf50 0%, #43a047 100%) !important;
        color: #ffffff !important;
        border: none;
        border-radius: 8px;
        padding: 8px 20px;
        font-size: 13px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        box-shadow: 0 4px 10px rgba(76, 175, 80, 0.18);
        height: 38px;
        text-decoration: none !important;
        cursor: pointer;
    }
    .btn-pay:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(76, 175, 80, 0.25);
    }
</style>

<section class="content">
    <div class="container-fluid">
        <div class="details-wrapper">
            <?= $this->Flash->render() ?>

            <div class="details-card">
                <div class="details-header">
                    <h2>
                        <i class="material-icons">payment</i>
                        <?= __('PT Payroll Details') ?>
                    </h2>
                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-back">
                        <i class="material-icons" style="font-size:18px;">arrow_back</i> <?= __('Back') ?>
                    </a>
                </div>

                <div class="details-body">
                    <div class="details-grid">
                        <!-- Card 1: Trainer & Partner Details -->
                        <div class="info-section-card">
                            <div class="info-section-header">
                                <i class="material-icons" style="font-size: 16px;">info</i>
                                <?= __('1. Trainer & Partner details') ?>
                            </div>
                            <div class="info-section-body">
                                <div class="info-item">
                                    <span class="info-label"><?= __('Trainer Name') ?></span>
                                    <span class="info-value"><?= h($payroll->trainer->name) ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?= __('Partner Name') ?></span>
                                    <span class="info-value"><?= h($payroll->partner->name) ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?= __('Period') ?></span>
                                    <?php 
                                    $monthName = date('F', mktime(0, 0, 0, $payroll->pt_class_entry->month, 10));
                                    ?>
                                    <span class="info-value"><?= h($monthName . ' ' . $payroll->pt_class_entry->year) ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Payroll Calculations -->
                        <div class="info-section-card">
                            <div class="info-section-header">
                                <i class="material-icons" style="font-size: 16px;">monetization_on</i>
                                <?= __('2. Payroll calculations') ?>
                            </div>
                            <div class="info-section-body">
                                <div class="info-item">
                                    <span class="info-label"><?= __('Classes Completed') ?></span>
                                    <span class="info-value"><?= h($payroll->total_classes) ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?= __('Rate Per Class') ?></span>
                                    <span class="info-value">₹<?= number_format($payroll->rate_per_class, 2) ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?= __('Total Amount') ?></span>
                                    <span class="info-value amount">₹<?= number_format($payroll->total_amount, 2) ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Status & Payments -->
                        <div class="info-section-card">
                            <div class="info-section-header">
                                <i class="material-icons" style="font-size: 16px;">check_circle</i>
                                <?= __('3. Status & Payments') ?>
                            </div>
                            <div class="info-section-body">
                                <div class="info-item">
                                    <span class="info-label"><?= __('Payroll Status') ?></span>
                                    <span class="info-value">
                                        <?php if ($payroll->status === 'Pending') { ?>
                                            <span class="status-badge pending-badge"><?= __('Pending') ?></span>
                                        <?php } else { ?>
                                            <span class="status-badge paid-badge"><?= __('Paid') ?></span>
                                        <?php } ?>
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?= __('Payment Date') ?></span>
                                    <span class="info-value">
                                        <?= $payroll->payment_date ? $payroll->payment_date->format('d-m-Y') : '<span style="color:#94a3b8; font-style:italic;">N/A</span>' ?>
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?= __('Paid By') ?></span>
                                    <span class="info-value">
                                        <?= $paidByUser ? h($paidByUser->name) : '<span style="color:#94a3b8; font-style:italic;">N/A</span>' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($payroll->pt_class_entry->notes)) { ?>
                        <!-- SECTION 4: Notes -->
                        <div class="notes-card">
                            <label><?= __('Notes / Description') ?></label>
                            <div class="notes-content">
                                <?= nl2br(h($payroll->pt_class_entry->notes)) ?>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Action Area -->
                    <div style="margin-top: 10px; padding-top: 14px; border-top: 1px solid #f1f4f9; display: flex; justify-content: flex-end; gap: 12px;">
                        <?php if ($payroll->status === 'Pending') { ?>
                            <?= $this->Form->postLink(
                                '<i class="material-icons" style="font-size:18px;vertical-align:middle;">payment</i> ' . __('Mark as Paid'),
                                ['action' => 'markPaid', $payroll->id],
                                [
                                    'escape' => false,
                                    'class' => 'btn-pay',
                                    'confirm' => __('Are you sure you want to mark this payroll as Paid?')
                                ]
                            ) ?>
                        <?php } ?>
                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-back">
                            <?= __('Back to Dashboard') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
