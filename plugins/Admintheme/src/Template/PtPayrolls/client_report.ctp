<?php
/**
 * Client PT Revenue & Trainer Share Report View - Modern Design System
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
    padding: 24px;
}
.pt-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}
.pt-header h2 {
    font-size: 18px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.pt-header h2 i {
    color: #10b981;
    font-size: 24px;
}

.summary-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}
.stat-card {
    background: #ffffff;
    border-radius: 10px;
    padding: 18px;
    border: 1.5px solid #e2e8f0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.02);
}
.stat-card label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    color: #64748b;
    margin: 0;
    letter-spacing: 0.5px;
}
.stat-card .num {
    font-size: 24px;
    font-weight: 800;
    margin-top: 4px;
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
    border-color: #10b981 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12) !important;
    outline: none !important;
}

.table-custom {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}
.table-custom th {
    background: #f8fafc;
    color: #475569;
    font-weight: 700;
    font-size: 11.5px;
    text-transform: uppercase;
    padding: 12px 16px;
    border-bottom: 1.5px solid #e2e8f0;
    letter-spacing: 0.5px;
}
.table-custom td {
    padding: 14px 16px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 13.5px;
    color: #334155;
    vertical-align: middle;
}

.btn-reset {
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
    transition: all 0.2s;
}
.btn-reset:hover {
    background: #f1f5f9;
    color: #1e293b;
}

.badge-classes-left {
    padding: 5px 10px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 12px;
}
.badge-active-left {
    background: #ecfdf5;
    color: #047857;
    border: 1px solid #a7f3d0;
}
.badge-zero-left {
    background: #fef2f2;
    color: #b91c1c;
    border: 1px solid #fecaca;
}
</style>

<section class="content">
    <div class="container-fluid">
        <div class="pt-wrapper">
            <?= $this->Flash->render() ?>

            <div class="pt-card">
                <div class="pt-header">
                    <h2>
                        <i class="material-icons">monetization_on</i>
                        <?= __('Client PT Revenue & Trainer Share Report') ?>
                    </h2>
                </div>

                <!-- Summary Cards -->
                <div class="summary-cards">
                    <div class="stat-card">
                        <label><?= __('Total Client PT Revenue') ?></label>
                        <div class="num" style="color: #0284c7;">₹<?= number_format($totalClientRevenue, 2) ?></div>
                    </div>
                    <div class="stat-card">
                        <label><?= __('Total Trainer Payouts') ?></label>
                        <div class="num" style="color: #dc2626;">₹<?= number_format($totalTrainerPayout, 2) ?></div>
                    </div>
                    <div class="stat-card">
                        <label><?= __('Total Gym Profit / Share') ?></label>
                        <div class="num" style="color: #16a34a;">₹<?= number_format($totalGymProfit, 2) ?></div>
                    </div>
                </div>

                <!-- Filter Bar -->
                <form method="get" class="row" style="margin-bottom: 24px;">
                    <div class="col-md-5 col-sm-12" style="margin-bottom: 10px;">
                        <select name="trainer_id" class="form-control select2" onchange="this.form.submit()">
                            <option value=""><?= __('All Trainers') ?></option>
                            <?php foreach ($trainers as $tid => $tname): ?>
                                <option value="<?= $tid ?>" <?= ($trainerId == $tid) ? 'selected' : '' ?>><?= h($tname) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-5 col-sm-12" style="margin-bottom: 10px;">
                        <select name="user_id" class="form-control select2" onchange="this.form.submit()">
                            <option value=""><?= __('All Clients / Members') ?></option>
                            <?php foreach ($usersList as $uid => $uname): ?>
                                <option value="<?= $uid ?>" <?= ($userIdFilter == $uid) ? 'selected' : '' ?>><?= h($uname) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-12" style="margin-bottom: 10px;">
                        <a href="<?= $this->Url->build(['action' => 'clientReport']) ?>" class="btn-reset">
                            <i class="material-icons" style="font-size:16px;">refresh</i> <?= __('Reset Filters') ?>
                        </a>
                    </div>
                </form>

                <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable responsive" id="clientReportTable" style="width:100%;">
                        <thead>
                            <tr>
                                <th><?= __('Client Name') ?></th>
                                <th><?= __('Assigned Trainer') ?></th>
                                <th><?= __('PT Plan') ?></th>
                                <th><?= __('Client Fee') ?></th>
                                <th><?= __('Conducted Classes') ?></th>
                                <th><?= __('Client Revenue') ?></th>
                                <th><?= __('Paid to Trainer') ?></th>
                                <th><?= __('Gym Profit / Share') ?></th>
                                <th><?= __('Remaining Balance') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($reportData) && count($reportData) > 0): ?>
                                <?php foreach ($reportData as $row): ?>
                                    <?php $sub = $row['subscription']; ?>
                                    <tr>
                                        <td style="font-weight: 700; color: #1e293b;"><?= h($sub->user ? $sub->user->name : 'N/A') ?></td>
                                        <td>
                                            <i class="material-icons" style="font-size:16px; color:#6366f1; vertical-align:middle;">person</i>
                                            <?= h($sub->trainer ? $sub->trainer->name : 'N/A') ?>
                                        </td>
                                        <td><span style="font-weight: 600; color: #4338ca;"><?= h($sub->plan_name) ?></span></td>
                                        <td>₹<?= number_format($sub->total_amount, 2) ?></td>
                                        <td><strong><?= $row['conducted_classes'] ?> / <?= $sub->total_classes ?></strong></td>
                                        <td style="font-weight: 700; color: #0284c7;">₹<?= number_format($row['client_revenue'], 2) ?></td>
                                        <td style="font-weight: 700; color: #dc2626;">₹<?= number_format($row['trainer_payout'], 2) ?></td>
                                        <td style="font-weight: 800; color: #16a34a;">+₹<?= number_format($row['gym_profit'], 2) ?></td>
                                        <td>
                                            <?php if ($row['remaining_classes'] > 0): ?>
                                                <span class="badge-classes-left badge-active-left"><?= $row['remaining_classes'] ?> classes left</span>
                                            <?php else: ?>
                                                <span class="badge-classes-left badge-zero-left">0 classes left</span>
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
    </div>
</section>

<script>
$(document).ready(function() {
    if ($.fn.select2) {
        $('.select2').select2({ width: '100%' });
    }

    if ($('#clientReportTable').length) {
        $('#clientReportTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                lengthMenu: "_MENU_"
            }
        });
    }
});
</script>
