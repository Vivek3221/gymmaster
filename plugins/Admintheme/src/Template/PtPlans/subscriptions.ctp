<?php
/**
 * Client PT Subscriptions List View - DataTables Integrated
 */
?>
<style>
.sub-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid #eef2f6;
    margin-bottom: 24px;
    padding: 20px;
}
.sub-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}
.sub-title {
    font-size: 18px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.btn-success-gradient {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff !important;
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.progress-bar-bg {
    background: #e2e8f0;
    border-radius: 10px;
    height: 10px;
    width: 120px;
    overflow: hidden;
    margin-top: 4px;
}
.progress-bar-fill {
    background: linear-gradient(90deg, #6366f1 0%, #10b981 100%);
    height: 100%;
    border-radius: 10px;
}
.badge-active {
    background: #dcfce7;
    color: #15803d;
    padding: 4px 10px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 12px;
}
.badge-completed {
    background: #f1f5f9;
    color: #64748b;
    padding: 4px 10px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 12px;
}
</style>

<section class="content">
    <div class="container-fluid">
        <?= $this->Flash->render() ?>

        <div class="sub-card">
            <div class="sub-header">
                <h3 class="sub-title">
                    <i class="material-icons" style="color: #10b981;">card_membership</i>
                    <?= __('Client PT Subscriptions & Active Plans') ?>
                </h3>
                <a href="<?= $this->Url->build(['action' => 'assign']) ?>" class="btn-success-gradient">
                    <i class="material-icons" style="font-size:18px;">person_add</i> <?= __('Assign PT Plan to Member') ?>
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable responsive" id="ptSubscriptionsTable" style="width:100%;">
                    <thead>
                        <tr>
                            <th><?= __('Client / Member') ?></th>
                            <th><?= __('Assigned Trainer') ?></th>
                            <th><?= __('PT Plan Title') ?></th>
                            <th><?= __('Total Fee') ?></th>
                            <th><?= __('Client Class Rate') ?></th>
                            <th><?= __('Class Progress') ?></th>
                            <th><?= __('Validity') ?></th>
                            <th><?= __('Status') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($subscriptions) && count($subscriptions) > 0): ?>
                            <?php foreach ($subscriptions as $sub): ?>
                                <?php 
                                    $pct = $sub->total_classes > 0 ? round(($sub->completed_classes / $sub->total_classes) * 100) : 0;
                                ?>
                                <tr>
                                    <td style="font-weight: 700; color: #1e293b;"><?= h($sub->user ? $sub->user->name : 'N/A') ?></td>
                                    <td><i class="material-icons" style="font-size:16px; color:#6366f1; vertical-align:middle;">person</i> <?= h($sub->trainer ? $sub->trainer->name : 'N/A') ?></td>
                                    <td><span style="font-weight: 600; color: #4338ca;"><?= h($sub->plan_name) ?></span></td>
                                    <td style="font-weight: 700; color: #059669;">₹<?= number_format($sub->total_amount, 2) ?></td>
                                    <td>₹<?= number_format($sub->client_per_class_rate, 2) ?> / class</td>
                                    <td>
                                        <div><strong><?= $sub->completed_classes ?> / <?= $sub->total_classes ?></strong> classes</div>
                                        <div class="progress-bar-bg">
                                            <div class="progress-bar-fill" style="width: <?= min(100, $pct) ?>%;"></div>
                                        </div>
                                    </td>
                                    <td style="font-size: 12px; color: #64748b;">
                                        <?= date('d M Y', strtotime($sub->start_date)) ?> – <?= date('d M Y', strtotime($sub->end_date)) ?>
                                    </td>
                                    <td>
                                        <?php if ($sub->status === 'Active'): ?>
                                            <span class="badge-active">Active</span>
                                        <?php else: ?>
                                            <span class="badge-completed"><?= h($sub->status) ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $('#ptSubscriptionsTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
            lengthMenu: "_MENU_"
        }
    });
});
</script>
