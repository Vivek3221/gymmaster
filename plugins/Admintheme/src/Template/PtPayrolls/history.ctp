<style>
    html, body, .content, .container-fluid {
        overflow-x: hidden !important;
    }
    /* Dashboard Cards Layout */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }
    .dashboard-card {
        border-radius: 16px;
        color: #fff;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }
    .dashboard-card::before {
        content: '';
        position: absolute;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -50px;
        right: -50px;
        pointer-events: none;
    }
    .card-classes {
        background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
    }
    .card-paid {
        background: linear-gradient(135deg, #10b981 0%, #065f46 100%);
    }
    .card-pending {
        background: linear-gradient(135deg, #ef4444 0%, #991b1b 100%);
    }
    .dashboard-card .card-content {
        position: relative;
        z-index: 2;
    }
    .dashboard-card .card-title {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        margin-bottom: 8px;
        opacity: 0.9;
    }
    .dashboard-card .card-value {
        font-size: 24px;
        font-weight: 800;
        line-height: 1;
    }
    .dashboard-card .card-icon-wrapper {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 15px;
        flex-shrink: 0;
    }
    .dashboard-card .card-icon-wrapper i {
        font-size: 24px;
        color: #fff;
    }

    /* Modern Filters Card */
    .filter-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.02);
        padding: 20px 24px !important;
        margin-bottom: 24px !important;
        border: 1px solid #eef2f6;
    }
    .filter-card-title {
        font-size: 15px !important;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 16px !important;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .filter-card-title i {
        color: #ff9800;
    }
    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px !important;
        align-items: end;
    }
    .filter-group {
        margin-bottom: 0 !important;
        display: flex;
        flex-direction: column;
    }
    .filter-group label {
        font-weight: 700;
        font-size: 11px !important;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px !important;
        display: block;
    }
    .filter-group .form-control,
    .filter-group .select2-container--default .select2-selection--single {
        border-radius: 8px !important;
        border: 1.5px solid #cbd5e1 !important;
        padding: 6px 12px !important;
        height: 38px !important;
        font-size: 13.5px !important;
        box-shadow: none !important;
        transition: all 0.2s ease;
        background-color: #f8fafc !important;
        box-sizing: border-box !important;
    }
    .filter-group .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px !important;
        padding-left: 0 !important;
        color: #334155 !important;
    }
    .filter-group .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 34px !important;
    }
    .filter-group .form-control:focus,
    .filter-group .select2-container--default.select2-container--focus .select2-selection--single,
    .filter-group .select2-container--default.select2-container--open .select2-selection--single {
        border-color: #ff9800 !important;
        background-color: #fff !important;
        box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.12) !important;
        outline: none !important;
    }
    .filter-actions-row {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
        flex-wrap: wrap;
        gap: 12px;
    }
    .filter-actions-left {
        display: flex;
        gap: 10px;
    }
    .btn-gradient-search {
        background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 8px 20px !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        box-shadow: 0 4px 10px rgba(255, 152, 0, 0.18) !important;
        transition: all 0.2s !important;
        height: 38px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
    }
    .btn-gradient-search:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(255, 152, 0, 0.25) !important;
    }
    .btn-outline-clear {
        background: #fff !important;
        color: #64748b !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 8px 18px !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        transition: all 0.2s !important;
        height: 38px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        text-decoration: none !important;
    }
    .btn-outline-clear:hover {
        background: #f8fafc !important;
        color: #334155 !important;
        border-color: #94a3b8 !important;
    }

    /* Header Actions bar */
    .header-actions {
        display: flex;
        gap: 12px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    /* Table & Calculations section */
    .card.modern-card {
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        border: 1px solid #eef2f6;
        overflow: hidden;
        background: #fff;
    }
    .card.modern-card .header {
        background: #f8fafc;
        border-bottom: 1px solid #eef2f6;
        padding: 20px 24px;
    }
    .card.modern-card .header h2 {
        font-size: 15px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .card.modern-card .body {
        padding: 24px;
    }
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
    }
    .modern-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    .modern-table th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 14px 16px;
        border-bottom: 2px solid #cbd5e1;
        text-align: left;
    }
    .modern-table td {
        padding: 12px 16px;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
        font-size: 13.5px;
        vertical-align: middle;
    }
    .modern-table tbody tr {
        transition: background-color 0.2s ease;
    }
    .modern-table tbody tr:nth-child(even) {
        background-color: #f8fafc;
    }
    .modern-table tbody tr:hover {
        background-color: #f1f5f9;
    }

    /* Badges */
    .status-badge {
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 5px 12px;
        border-radius: 30px;
        display: inline-block;
        text-align: center;
    }
    .status-badge.pending-badge {
        background-color: #fff3e0;
        color: #e65100;
    }
    .status-badge.paid-badge {
        background-color: #e8f5e9;
        color: #1b5e20;
    }

    /* Action Buttons styling */
    .action-btn-container {
        display: flex;
        align-items: center;
        gap: 8px;
        justify-content: center;
    }
    .action-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: #fff;
        color: #64748b !important;
        text-decoration: none !important;
        transition: all 0.2s ease;
        border: 1.5px solid #cbd5e1;
        cursor: pointer;
        padding: 0;
    }
    .action-icon-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    .action-icon-btn i {
        font-size: 18px !important;
    }
    .action-icon-btn.view-btn:hover {
        background: #e0f2fe;
        color: #0284c7 !important;
        border-color: #bae6fd;
    }

    /* Paging styling */
    .paginator {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .paginator p {
        color: #64748b;
        font-size: 13.5px;
        margin: 0;
    }
    .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 8px;
        margin: 0;
    }
    .pagination li {
        margin: 0 2px;
    }
    .pagination li a {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 34px;
        min-width: 34px;
        padding: 0 8px;
        border-radius: 6px;
        border: 1.5px solid #e2e8f0;
        background-color: #fff;
        color: #64748b;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.2s;
    }
    .pagination li a:hover {
        background-color: #f1f5f9;
        color: #334155;
        border-color: #cbd5e1;
    }
    .pagination li.active a {
        background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
        color: #fff;
        border-color: #f57c00;
    }

    /* Empty State */
    .empty-state-container {
        text-align: center;
        padding: 48px 24px;
    }
    .empty-state-icon {
        margin-bottom: 16px;
    }
</style>

<section class="content">
    <div class="container-fluid">
        <!-- Top Actions Bar -->
        <div class="header-actions">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-outline-clear">
                <i class="material-icons">arrow_back</i> <?= __('Back to Dashboard') ?>
            </a>
        </div>

        <?= $this->Flash->render() ?>

        <!-- Trainer Summary Cards -->
        <div class="dashboard-cards">
            <!-- Total Classes Card -->
            <div class="dashboard-card card-classes">
                <div class="card-content">
                    <div class="card-title"><?= __('Total Classes Done') ?></div>
                    <div class="card-value"><?= number_format($stats['totalClasses']) ?></div>
                </div>
                <div class="card-icon-wrapper">
                    <i class="material-icons">fitness_center</i>
                </div>
            </div>

            <!-- Total Paid Card -->
            <div class="dashboard-card card-paid">
                <div class="card-content">
                    <div class="card-title"><?= __('Total Paid Payroll') ?></div>
                    <div class="card-value">₹<?= number_format($stats['totalPaid'], 2) ?></div>
                </div>
                <div class="card-icon-wrapper">
                    <i class="material-icons">check_circle</i>
                </div>
            </div>

            <!-- Remaining Pending Card -->
            <div class="dashboard-card card-pending">
                <div class="card-content">
                    <div class="card-title"><?= __('Total Pending Payroll') ?></div>
                    <div class="card-value">₹<?= number_format($stats['totalPending'], 2) ?></div>
                </div>
                <div class="card-icon-wrapper">
                    <i class="material-icons">hourglass_empty</i>
                </div>
            </div>
        </div>

        <!-- Filters Card -->
        <div class="filter-card">
            <div class="filter-card-title">
                <i class="material-icons">filter_list</i>
                <span><?= __('Filter Payroll History') ?></span>
            </div>
            <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['action' => 'history', $trainer->id]]) ?>
            <div class="filter-grid">
                <div class="filter-group">
                    <label><?= __('Month') ?></label>
                    <?= $this->Form->control('month', [
                        'type' => 'select',
                        'class' => 'form-control select2',
                        'empty' => __('All Months'),
                        'options' => [
                            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
                            7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                        ],
                        'value' => $month,
                        'label' => false
                    ]) ?>
                </div>
                <div class="filter-group">
                    <label><?= __('Year') ?></label>
                    <?= $this->Form->control('year', [
                        'type' => 'select',
                        'class' => 'form-control select2',
                        'empty' => __('All Years'),
                        'options' => array_combine(range(2025, 2030), range(2025, 2030)),
                        'value' => $year,
                        'label' => false
                    ]) ?>
                </div>
            </div>
            <div class="filter-actions-row">
                <div class="filter-actions-left">
                    <?= $this->Form->button('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">search</i> ' . __('Search'), [
                        'class' => 'btn btn-primary waves-effect btn-gradient-search',
                        'escapeTitle' => false
                    ]) ?>
                    <?= $this->Html->link('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">clear_all</i> ' . __('Clear'), ['action' => 'history', $trainer->id], [
                        'class' => 'btn-outline-clear',
                        'escape' => false
                    ]) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>

        <!-- Main History List -->
        <div class="card modern-card">
            <div class="header">
                <h2><?= __('PT Payroll History for Trainer: ') ?> <strong><?= h($trainer->name) ?></strong></h2>
            </div>
            <div class="body">
                <?php if ($history->count() > 0) { ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable responsive" id="ptHistoryTable" style="width:100%;">
                            <thead>
                                <tr>
                                    <th><?= __('Client / Member') ?></th>
                                    <th><?= __('Month / Year') ?></th>
                                    <th><?= __('Classes Completed') ?></th>
                                    <th><?= __('Rate Per Class') ?></th>
                                    <th><?= __('Total Amount') ?></th>
                                    <th><?= __('Status') ?></th>
                                    <th><?= __('Payment Date') ?></th>
                                    <th style="width: 80px; text-align: center;"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($history as $payroll) { 
                                    $monthName = date('F', mktime(0, 0, 0, $payroll->pt_class_entry ? $payroll->pt_class_entry->month : date('n'), 10));
                                    $yearVal = $payroll->pt_class_entry ? $payroll->pt_class_entry->year : date('Y');
                                    $clientName = ($payroll->pt_class_entry && $payroll->pt_class_entry->user) ? $payroll->pt_class_entry->user->name : 'N/A';
                                ?>
                                    <tr>
                                        <td style="font-weight: 700; color: #1e293b;">
                                            <i class="material-icons" style="font-size:16px; color:#6366f1; vertical-align:middle; margin-right:4px;">person</i>
                                            <?= h($clientName) ?>
                                        </td>
                                        <td><?= h($monthName . ' ' . $yearVal) ?></td>
                                        <td><?= h($payroll->total_classes) ?></td>
                                        <td>₹<?= number_format($payroll->rate_per_class, 2) ?></td>
                                        <td><strong>₹<?= number_format($payroll->total_amount, 2) ?></strong></td>
                                        <td>
                                            <?php if ($payroll->status === 'Pending') { ?>
                                                <span class="status-badge pending-badge"><?= __('Pending') ?></span>
                                            <?php } else { ?>
                                                <span class="status-badge paid-badge"><?= __('Paid') ?></span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?= $payroll->payment_date ? $payroll->payment_date->format('d-m-Y') : '<span style="color:#94a3b8; font-style:italic;">N/A</span>' ?>
                                        </td>
                                        <td align="center">
                                            <div class="action-btn-container">
                                                <a href="<?= $this->Url->build(['action' => 'view', $payroll->id]) ?>" class="action-icon-btn view-btn" title="<?= __('View Details') ?>">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <!-- Empty State -->
                    <div class="empty-state-container">
                        <div class="empty-state-icon">
                            <i class="material-icons" style="font-size: 56px; color: #94a3b8; background: #f1f5f9; padding: 18px; border-radius: 50%;">history</i>
                        </div>
                        <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 6px;"><?= __('No historical records found') ?></h4>
                        <p style="color: #64748b; font-size: 13.5px; max-width: 420px; margin: 0 auto;"><?= __('We couldn\'t find any PT payroll history for this trainer under the selected filters.') ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Initialize select2
    $('.select2').select2({
        width: '100%'
    });

    if ($('#ptHistoryTable').length) {
        $('#ptHistoryTable').DataTable({
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
