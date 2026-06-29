<?php
$getModPayment  = $this->Common->getModPayment();
$totalPaid = 0;
if (!empty($planSubscriber->payments)) {
    foreach ($planSubscriber->payments as $p) $totalPaid += $p->amount;
}
$remaining = $planSubscriber->fee - $totalPaid;
?>
<section class="content">
    <div class="container-fluid">
        <style>
            .view-card { background:#fff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.05);border:1px solid #eaeaea;margin-bottom:25px; }
            .view-card-header { background:#fafafa;border-bottom:1px solid #eaeaea;padding:16px 20px;display:flex;justify-content:space-between;align-items:center;border-radius:12px 12px 0 0; }
            .view-card-header h2 { font-size:16px;font-weight:700;color:#333;margin:0;display:flex;align-items:center;gap:8px; }
            .view-card-header h2 i { color:#ff9800;font-size:20px; }
            .view-card-body { padding:20px; }
            .subscriber-stats { display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:25px; }
            .sub-stat-card { background:#fff;border-radius:10px;border:1px solid #eaeaea;padding:15px;display:flex;align-items:center;gap:15px; }
            .sub-stat-icon { width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center; }
            .sub-stat-icon i { font-size:22px; }
            .sub-stat-title { font-size:11px;font-weight:700;color:#888;text-transform:uppercase;letter-spacing:.5px;margin-bottom:2px; }
            .sub-stat-value { font-size:18px;font-weight:800;color:#333; }
            .stat-fee { border-left:4px solid #ff9800; } .stat-fee .sub-stat-icon { background:#fff3e0;color:#ff9800; }
            .stat-paid { border-left:4px solid #4caf50; } .stat-paid .sub-stat-icon { background:#e8f5e9;color:#4caf50; }
            .stat-remain { border-left:4px solid #ff9800; } .stat-remain .sub-stat-icon { background:#fff3e0;color:#ff9800; }
            .stat-remain-zero { border-left:4px solid #4caf50; } .stat-remain-zero .sub-stat-icon { background:#e8f5e9;color:#4caf50; }
            .view-grid { display:grid;grid-template-columns:1fr 1fr;gap:25px; }
            @media(max-width:991px){.view-grid{grid-template-columns:1fr;}}
            .detail-list { list-style:none;padding:0;margin:0; }
            .detail-row { display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:1px solid #f5f5f5; }
            .detail-row:last-child { border-bottom:none; }
            .detail-label { font-weight:600;color:#666;font-size:13px;display:flex;align-items:center;gap:8px; }
            .detail-label i { color:#888;font-size:18px; }
            .detail-val { font-weight:700;color:#333;font-size:14px; }
            .payments-table { width:100%;border-collapse:separate;border-spacing:0; }
            .payments-table th { background:#f8f9fa;color:#555;font-weight:700;font-size:11px;text-transform:uppercase;letter-spacing:.5px;padding:10px 12px;border-bottom:2px solid #eaeaea; }
            .payments-table td { padding:12px;vertical-align:middle;border-bottom:1px solid #f0f0f0;color:#555;font-size:13px; }
            .payment-badge { padding:4px 10px;border-radius:20px;font-size:10px;font-weight:700;text-transform:uppercase;display:inline-block; }
            .badge-cash { background:#e8f5e9;color:#2e7d32; } .badge-other { background:#eceff1;color:#37474f; }
            .manual-badge-lg { background:#fff3e0;color:#e65100;padding:3px 10px;border-radius:10px;font-size:11px;font-weight:700; }
            .btn-back { background:#fff!important;color:#555!important;border:1px solid #ccc!important;border-radius:6px!important;font-weight:600!important;padding:8px 16px!important;display:inline-flex;align-items:center;gap:6px;font-size:13px!important; }
        </style>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="view-card">
                    <div class="view-card-header">
                        <h2>
                            <i class="material-icons">assignment_ind</i>
                            <?= __('Manual Collection Detail') ?> —
                            <span style="color:#9c27b0;"><?= $planSubscriber->has('user') ? h(ucwords($planSubscriber->user->name)) : '' ?></span>
                            <span class="manual-badge-lg" style="margin-left:8px;">Manual</span>
                        </h2>
                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-back">
                            <i class="material-icons">arrow_back</i> <?= __('Back to List') ?>
                        </a>
                    </div>
                    <div class="view-card-body">

                        <!-- Stats -->
                        <div class="subscriber-stats">
                            <div class="sub-stat-card stat-fee">
                                <div class="sub-stat-icon"><i class="material-icons">account_balance_wallet</i></div>
                                <div><div class="sub-stat-title"><?= __('Total Fee') ?></div><div class="sub-stat-value"><?= $this->Number->format($planSubscriber->fee) ?></div></div>
                            </div>
                            <div class="sub-stat-card stat-paid">
                                <div class="sub-stat-icon"><i class="material-icons">check_circle</i></div>
                                <div><div class="sub-stat-title"><?= __('Paid Fee') ?></div><div class="sub-stat-value"><?= $this->Number->format($totalPaid) ?></div></div>
                            </div>
                            <div class="sub-stat-card <?= $remaining > 0 ? 'stat-remain' : 'stat-remain-zero' ?>">
                                <div class="sub-stat-icon"><i class="material-icons"><?= $remaining > 0 ? 'hourglass_empty' : 'verified' ?></i></div>
                                <div><div class="sub-stat-title"><?= __('Remaining') ?></div><div class="sub-stat-value"><?= $this->Number->format($remaining) ?></div></div>
                            </div>
                        </div>

                        <!-- Grid -->
                        <div class="view-grid">
                            <!-- Left: details -->
                            <div class="view-card" style="margin-bottom:0;">
                                <div class="view-card-header" style="padding:12px 16px;">
                                    <h2><i class="material-icons">info</i><?= __('Subscription Details') ?></h2>
                                </div>
                                <div class="view-card-body" style="padding:16px;">
                                    <ul class="detail-list">
                                        <li class="detail-row">
                                            <span class="detail-label"><i class="material-icons">person</i><?= __('User') ?></span>
                                            <span class="detail-val"><?= $planSubscriber->has('user') ? h(ucwords($planSubscriber->user->name)) : '-' ?></span>
                                        </li>
                                        <li class="detail-row">
                                            <span class="detail-label"><i class="material-icons">fitness_center</i><?= __('Plan Name') ?></span>
                                            <span class="detail-val"><?= h(ucwords($planSubscriber->plan_name)) ?></span>
                                        </li>
                                        <li class="detail-row">
                                            <span class="detail-label"><i class="material-icons">event</i><?= __('Plan Start') ?></span>
                                            <span class="detail-val"><?= h(date('d-m-Y', strtotime($planSubscriber->created))) ?></span>
                                        </li>
                                        <li class="detail-row">
                                            <span class="detail-label"><i class="material-icons">event_busy</i><?= __('Plan Expire') ?></span>
                                            <span class="detail-val" style="color:#c62828;"><?= h(date('d-m-Y', strtotime($planSubscriber->plan_expire_date))) ?></span>
                                        </li>
                                        <li class="detail-row">
                                            <span class="detail-label"><i class="material-icons">payment</i><?= __('Payment Due') ?></span>
                                            <span class="detail-val" style="color:#ef6c00;"><?= h(date('d-m-Y', strtotime($planSubscriber->payment_due_date))) ?></span>
                                        </li>
                                        <li class="detail-row">
                                            <span class="detail-label"><i class="material-icons">label</i><?= __('Type') ?></span>
                                            <span class="detail-val"><span class="manual-badge-lg">Manual</span></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Right: payments -->
                            <div class="view-card" style="margin-bottom:0;">
                                <div class="view-card-header" style="padding:12px 16px;">
                                    <h2><i class="material-icons">receipt</i><?= __('Payment History') ?></h2>
                                </div>
                                <div class="view-card-body" style="padding:16px;">
                                    <?php if (!empty($planSubscriber->payments)) { ?>
                                        <div class="table-responsive">
                                            <table class="payments-table">
                                                <thead>
                                                    <tr>
                                                        <th><?= __('Amount') ?></th>
                                                        <th><?= __('Method') ?></th>
                                                        <th><?= __('Date') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($planSubscriber->payments as $payment) {
                                                        $modeText   = h($getModPayment[$payment->mode_ofpay] ?? 'Other');
                                                        $badgeClass = stripos($modeText,'cash') !== false ? 'badge-cash' : 'badge-other';
                                                    ?>
                                                        <tr>
                                                            <td style="color:#2e7d32;font-weight:bold;"><?= $this->Number->format($payment->amount) ?></td>
                                                            <td><span class="payment-badge <?= $badgeClass ?>"><?= $modeText ?></span></td>
                                                            <td><?= date('d-m-Y H:i', strtotime($payment->created)) ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } else { ?>
                                        <div class="text-center" style="padding:30px 0;color:#888;font-weight:600;">
                                            <i class="material-icons" style="font-size:48px;color:#ccc;display:block;margin-bottom:10px;">warning</i>
                                            <?= __('No payments recorded.') ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
