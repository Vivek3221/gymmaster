<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 
$csrfToken = '';
if (isset($this->request)) {
    if (method_exists($this->request, 'getParam')) {
        $csrfToken = $this->request->getParam('_csrfToken');
    }
    if (empty($csrfToken) && method_exists($this->request, 'cookie')) {
        $csrfToken = $this->request->cookie('_csrfToken');
    }
}
if (empty($csrfToken) && isset($_COOKIE['csrfToken'])) {
    $csrfToken = $_COOKIE['csrfToken'];
}
?>
<input type="hidden" name="_csrfToken" value="<?= h($csrfToken) ?>">

<style>
    html, body, .content, .container-fluid {
        overflow-x: hidden !important;
    }
    /* Top Actions Bar */
    .header-actions {
        display: flex;
        gap: 12px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    .header-actions .btn {
        font-weight: 700;
        font-size: 13px;
        border-radius: 8px;
        padding: 10px 20px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        color: #fff !important;
        text-transform: none;
    }
    .header-actions .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    }
    .header-actions .btn-primary {
        background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%) !important;
    }
    .header-actions .btn-info {
        background: linear-gradient(135deg, #2196f3 0%, #1e88e5 100%) !important;
    }
    .header-actions .btn-success {
        background: linear-gradient(135deg, #4caf50 0%, #43a047 100%) !important;
    }

    /* Premium Dashboard Cards */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }
    .dashboard-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0, 0, 0, 0.01);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        color: #fff;
        min-height: 105px;
    }
    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.075);
    }
    .dashboard-card.card-trainers {
        background: linear-gradient(135deg, #ec407a 0%, #d81b60 100%);
    }
    .dashboard-card.card-classes {
        background: linear-gradient(135deg, #26c6da 0%, #00acc1 100%);
    }
    .dashboard-card.card-payroll {
        background: linear-gradient(135deg, #66bb6a 0%, #43a047 100%);
    }
    .dashboard-card.card-pending {
        background: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%);
    }
    .dashboard-card .card-content {
        flex-grow: 1;
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
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
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
        justify-content: space-between;
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
    .filter-actions-right {
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
    .btn-success-export {
        background: linear-gradient(135deg, #4caf50 0%, #43a047 100%) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 8px 20px !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        box-shadow: 0 4px 10px rgba(76, 175, 80, 0.18) !important;
        transition: all 0.2s !important;
        height: 38px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        text-decoration: none !important;
    }
    .btn-success-export:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(76, 175, 80, 0.25) !important;
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
        overflow-x: auto;
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

    /* Inline Inputs styling */
    .inline-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        max-width: 120px;
    }
    .inline-input-wrapper .input-prefix {
        position: absolute;
        left: 10px;
        font-size: 13px;
        color: #64748b;
        pointer-events: none;
    }
    .inline-input {
        width: 100%;
        height: 34px;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 13.5px;
        font-weight: 600;
        color: #334155;
        background-color: #fff;
        text-align: center;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }
    .inline-input:focus {
        border-color: #ff9800;
        box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.12);
        outline: none;
        background-color: #fff;
    }
    .inline-input[readonly], .inline-input:disabled {
        background-color: #f1f5f9;
        border-color: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
    }
    .inline-input-wrapper.has-prefix .inline-input {
        padding-left: 22px;
        text-align: left;
    }
    .inline-input-wrapper .inline-input {
        padding-right: 26px; /* Space for spinner/check */
    }

    /* AJAX Loader Spinners */
    .save-status-indicator {
        position: absolute;
        right: 8px;
        display: none;
        align-items: center;
        pointer-events: none;
    }
    .save-status-indicator i {
        font-size: 15px;
    }
    .save-status-indicator.loading {
        display: flex;
        color: #ff9800;
    }
    .save-status-indicator.success {
        display: flex;
        color: #4caf50;
    }
    .save-status-indicator.error {
        display: flex;
        color: #f44336;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .spinner {
        animation: spin 1s linear infinite;
    }

    /* Action Buttons styling */
    .action-btn-container {
        display: flex;
        align-items: center;
        gap: 6px;
        justify-content: center;
    }
    .action-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: #f8fafc;
        color: #64748b !important;
        text-decoration: none !important;
        transition: all 0.2s ease;
        border: 1.5px solid #e2e8f0;
        cursor: pointer;
        padding: 0;
    }
    .action-icon-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }
    .action-icon-btn i {
        font-size: 18px !important;
    }
    .action-icon-btn.view-btn:hover {
        background: #e0f2fe;
        color: #0284c7 !important;
        border-color: #bae6fd;
    }
    .action-icon-btn.edit-btn:hover {
        background: #f5f3ff;
        color: #7c3aed !important;
        border-color: #ddd6fe;
    }
    .action-icon-btn.pay-btn {
        border: 1.5px solid #dcfce7;
        background: #f0fdf4;
        color: #16a34a !important;
    }
    .action-icon-btn.pay-btn:hover {
        background: #bbf7d0;
        color: #15803d !important;
        border-color: #86efac;
    }
    .action-icon-btn.history-btn:hover {
        background: #fff7ed;
        color: #ea580c !important;
        border-color: #ffedd5;
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
</style>

<section class="content">
    <div class="container-fluid">
        <!-- Dashboard Summary Cards -->
        <div class="dashboard-cards">
            <div class="dashboard-card card-trainers">
                <div class="card-content">
                    <div class="card-title"><?= __('Total Trainers') ?></div>
                    <div class="card-value" id="val-total-trainers"><?= $totalTrainers ?></div>
                </div>
                <div class="card-icon-wrapper">
                    <i class="material-icons">people</i>
                </div>
            </div>
            <div class="dashboard-card card-classes">
                <div class="card-content">
                    <div class="card-title"><?= __('Monthly PT Classes') ?></div>
                    <div class="card-value" id="val-total-classes"><?= $totalClasses ?></div>
                </div>
                <div class="card-icon-wrapper">
                    <i class="material-icons">class</i>
                </div>
            </div>
            <div class="dashboard-card card-payroll">
                <div class="card-content">
                    <div class="card-title"><?= __('Monthly Payroll') ?></div>
                    <div class="card-value" id="val-total-payroll">₹<?= number_format($totalPayrollAmount, 2) ?></div>
                </div>
                <div class="card-icon-wrapper">
                    <i class="material-icons">monetization_on</i>
                </div>
            </div>
            <div class="dashboard-card card-pending">
                <div class="card-content">
                    <div class="card-title"><?= __('Pending Payroll') ?></div>
                    <div class="card-value" id="val-pending-payroll">₹<?= number_format($pendingPayroll, 2) ?></div>
                </div>
                <div class="card-icon-wrapper">
                    <i class="material-icons">hourglass_empty</i>
                </div>
            </div>
        </div>

        <!-- Top Actions Bar -->
        <div class="header-actions">
            <?= $this->Html->link('<i class="material-icons">add</i> ' . __('Log PT Classes'), ['action' => 'addClassEntry'], ['class' => 'btn btn-primary waves-effect', 'escape' => false]) ?>
            <?= $this->Html->link('<i class="material-icons">settings</i> ' . __('Manage Rates'), ['action' => 'rates'], ['class' => 'btn btn-info waves-effect', 'escape' => false]) ?>
            <?= $this->Html->link('<i class="material-icons">assessment</i> ' . __('Reports & Export'), ['action' => 'reports'], ['class' => 'btn btn-success waves-effect', 'escape' => false]) ?>
        </div>

        <?= $this->Flash->render() ?>

        <!-- Filters Card -->
        <div class="filter-card">
            <div class="filter-card-title">
                <i class="material-icons">filter_list</i>
                <span><?= __('Filter Payroll Records') ?></span>
            </div>
            <?= $this->Form->create(NULL, [
                'type' => 'get',
                'url' => ['action' => 'index'],
                'id' => 'filterForm',
                'templates' => ['inputContainer' => '{{content}}']
            ]) ?>
            <div class="filter-grid">
                <?php if ($isGlobal) { ?>
                    <div class="filter-group">
                        <label><?= __('Partner') ?></label>
                        <?= $this->Form->control('partner_id', [
                            'type' => 'select',
                            'class' => 'form-control select2',
                            'empty' => __('All Partners'),
                            'options' => $partners,
                            'value' => $partnerId,
                            'label' => false
                        ]) ?>
                    </div>
                <?php } ?>
                <div class="filter-group">
                    <label><?= __('Trainer') ?></label>
                    <?= $this->Form->control('trainer_id', [
                        'type' => 'select',
                        'class' => 'form-control select2',
                        'empty' => __('All Trainers'),
                        'options' => $trainers,
                        'value' => $trainerId,
                        'label' => false
                    ]) ?>
                </div>
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
                <div class="filter-group">
                    <label><?= __('Status') ?></label>
                    <?= $this->Form->control('status', [
                        'type' => 'select',
                        'class' => 'form-control select2',
                        'empty' => __('All Statuses'),
                        'options' => ['Pending' => 'Pending', 'Paid' => 'Paid'],
                        'value' => $status,
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
                    <?= $this->Html->link('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">clear_all</i> ' . __('Clear'), ['action' => 'index'], [
                        'class' => 'btn btn-danger waves-effect btn-outline-clear',
                        'escape' => false
                    ]) ?>
                </div>
                <div class="filter-actions-right">
                    <a href="#" class="btn btn-success waves-effect btn-success-export">
                        <i class="material-icons">cloud_download</i> <?= __('Export Excel') ?>
                    </a>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>

        <!-- Main Payroll List -->
        <div class="card modern-card">
            <div class="header">
                <h2><?= __('PT Payroll Calculations') ?></h2>
            </div>
            <div class="body">
                <?php if ($payrolls->count() > 0) { ?>
                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th><?= __('Trainer Name') ?></th>
                                    <th><?= __('Partner Name') ?></th>
                                    <th><?= __('Month / Year') ?></th>
                                    <th><?= __('Classes Completed') ?></th>
                                    <th><?= __('Rate Per Class') ?></th>
                                    <th><?= __('Total Amount') ?></th>
                                    <th><?= __('Status') ?></th>
                                    <th style="width: 180px; text-align: center;"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($payrolls as $payroll) { 
                                    $monthName = date('F', mktime(0, 0, 0, $payroll->pt_class_entry->month, 10));
                                    $isPaid = ($payroll->status === 'Paid');
                                ?>
                                    <tr>
                                        <td><?= h($payroll->trainer->name) ?></td>
                                        <td><?= h($payroll->partner->name) ?></td>
                                        <td><?= h($monthName . ' ' . $payroll->pt_class_entry->year) ?></td>
                                        
                                        <!-- Classes Completed Input -->
                                        <td>
                                            <div class="inline-input-wrapper" <?= $isPaid ? 'title="Payroll already paid. Editing is disabled."' : '' ?>>
                                                <input type="number" 
                                                       class="inline-input inline-classes-input" 
                                                       data-id="<?= $payroll->id ?>" 
                                                       value="<?= (int)$payroll->total_classes ?>" 
                                                       min="0" 
                                                       step="1"
                                                       <?= $isPaid ? 'readonly disabled' : '' ?>>
                                                <span class="save-status-indicator">
                                                    <i class="material-icons spinner">sync</i>
                                                </span>
                                            </div>
                                        </td>
                                        
                                        <!-- Rate Per Class Input -->
                                        <td>
                                            <div class="inline-input-wrapper has-prefix" <?= $isPaid ? 'title="Payroll already paid. Editing is disabled."' : '' ?>>
                                                <span class="input-prefix">₹</span>
                                                <input type="number" 
                                                       class="inline-input inline-rate-input" 
                                                       data-id="<?= $payroll->id ?>" 
                                                       value="<?= number_format($payroll->rate_per_class, 2, '.', '') ?>" 
                                                       min="0" 
                                                       step="0.01"
                                                       <?= $isPaid ? 'readonly disabled' : '' ?>>
                                                <span class="save-status-indicator">
                                                    <i class="material-icons spinner">sync</i>
                                                </span>
                                            </div>
                                        </td>
                                        
                                        <!-- Calculated Total Amount -->
                                        <td class="total-amount-cell">
                                            <strong>₹<?= number_format($payroll->total_amount, 2) ?></strong>
                                        </td>
                                        
                                        <!-- Status Badge -->
                                        <td class="status-badge-cell">
                                            <?php if ($payroll->status === 'Pending') { ?>
                                                <span class="status-badge pending-badge"><?= __('Pending') ?></span>
                                            <?php } else { ?>
                                                <span class="status-badge paid-badge"><?= __('Paid') ?></span>
                                            <?php } ?>
                                        </td>
                                        
                                        <td align="center">
                                            <div class="action-btn-container">
                                                <a href="<?= $this->Url->build(['action' => 'view', $payroll->id]) ?>" class="action-icon-btn view-btn" title="<?= __('View Details') ?>">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <?php if ($payroll->status === 'Pending') { ?>
                                                    <a href="<?= $this->Url->build(['action' => 'editClassEntry', $payroll->pt_class_entry->id]) ?>" class="action-icon-btn edit-btn" title="<?= __('Edit Class count') ?>">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                <?php } ?>
                                                <?php if ($payroll->status === 'Pending') { ?>
                                                    <button type="button"
                                                            data-url="<?= $this->Url->build(['action' => 'markPaid', $payroll->id]) ?>"
                                                            data-id="<?= $payroll->id ?>"
                                                            class="action-icon-btn pay-btn pay-ajax-btn"
                                                            title="<?= __('Mark as Paid') ?>">
                                                        <i class="material-icons">payment</i>
                                                    </button>
                                                <?php } ?>
                                                <a href="<?= $this->Url->build(['action' => 'history', $payroll->trainer_id]) ?>" class="action-icon-btn history-btn" title="<?= __('Payment History') ?>">
                                                    <i class="material-icons">history</i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="paginator">
                        <ul class="pagination">
                            <?= $this->Paginator->first('<<') ?>
                            <?= $this->Paginator->prev('<') ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next('>') ?>
                            <?= $this->Paginator->last('>>') ?>
                        </ul>
                        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                    </div>

                <?php } else { ?>
                    <!-- Empty State -->
                    <div class="empty-state-container">
                        <div class="empty-state-icon">
                            <i class="material-icons" style="font-size: 56px; color: #94a3b8; background: #f1f5f9; padding: 18px; border-radius: 50%;">assignment_late</i>
                        </div>
                        <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 6px;"><?= __('No payroll records found') ?></h4>
                        <p style="color: #64748b; font-size: 13.5px; max-width: 420px; margin: 0 auto;"><?= __('We couldn\'t find any PT payroll calculations. Try logging a new class count or adjusting your search filters.') ?></p>
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

    // Handle AJAX-based export parameter serialization
    $(document).on('click', '.btn-success-export', function(e) {
        e.preventDefault();
        var query = $('#filterForm').serialize();
        window.location.href = '<?= $this->Url->build(["action" => "exportExcel"]) ?>?' + query;
    });

    // Store initial value on focus for rollback
    $(document).on('focus', '.inline-input', function() {
        $(this).data('prev-value', $(this).val());
    });

    // AJAX Inline Edit handler
    $(document).on('change', '.inline-input', function() {
        var $input = $(this);
        var payrollId = $input.data('id');
        var isClasses = $input.hasClass('inline-classes-input');
        var val = $input.val();
        var prevVal = $input.data('prev-value');

        // Validation
        if (isClasses) {
            if (val === '' || isNaN(val) || parseInt(val) < 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Value',
                    text: 'Please enter a valid non-negative integer for class counts.'
                });
                $input.val(prevVal);
                return;
            }
            val = parseInt(val);
            $input.val(val);
        } else {
            if (val === '' || isNaN(val) || parseFloat(val) < 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Value',
                    text: 'Please enter a valid non-negative decimal value for class rate.'
                });
                $input.val(prevVal);
                return;
            }
            val = parseFloat(val).toFixed(2);
            $input.val(val);
        }

        // Avoid requests if nothing changed
        if (val == prevVal) {
            return;
        }

        var $wrapper = $input.closest('.inline-input-wrapper');
        var $indicator = $wrapper.find('.save-status-indicator');

        // Show spinner & disable input
        $indicator.removeClass('success error').addClass('loading');
        $indicator.html('<i class="material-icons spinner">sync</i>');
        $input.prop('disabled', true);

        var dataPayload = { payroll_id: payrollId };
        if (isClasses) {
            dataPayload.total_classes = val;
        } else {
            dataPayload.rate_per_class = val;
        }

        $.ajax({
            url: '<?= $this->Url->build(["controller" => "PtPayrolls", "action" => "saveInlinePayroll"]) ?>',
            type: 'POST',
            data: dataPayload,
            dataType: 'json',
            headers: {
                'X-CSRF-Token': $('[name="_csrfToken"]').val()
            },
            success: function(res) {
                $input.prop('disabled', false);
                if (res.success) {
                    // Update Total Amount column
                    var $row = $input.closest('tr');
                    $row.find('.total-amount-cell').html('<strong>₹' + res.total_amount + '</strong>');

                    // Update Top Dashboard stats
                    if (res.metrics) {
                        $('#val-total-trainers').text(res.metrics.totalTrainers);
                        $('#val-total-classes').text(res.metrics.totalClasses);
                        $('#val-total-payroll').text('₹' + res.metrics.totalPayrollAmount);
                        $('#val-pending-payroll').text('₹' + res.metrics.pendingPayroll);
                    }

                    // Green Checkmark animation
                    $indicator.removeClass('loading').addClass('success').html('<i class="material-icons">check_circle</i>');
                    setTimeout(function() {
                        $indicator.removeClass('success').fadeOut(200, function() {
                            $(this).removeClass('success').html('<i class="material-icons spinner">sync</i>').show();
                        });
                    }, 1500);

                    $input.data('prev-value', val);
                } else {
                    $indicator.removeClass('loading').addClass('error').html('<i class="material-icons">cancel</i>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Save Failed',
                        text: res.message || 'Could not update PT payroll.'
                    });
                    $input.val(prevVal);
                    setTimeout(function() {
                        $indicator.removeClass('error').html('<i class="material-icons spinner">sync</i>');
                    }, 2000);
                }
            },
            error: function() {
                $input.prop('disabled', false);
                $indicator.removeClass('loading').addClass('error').html('<i class="material-icons">cancel</i>');
                Swal.fire({
                    icon: 'error',
                    title: 'System Error',
                    text: 'An error occurred while saving the PT payroll.'
                });
                $input.val(prevVal);
                setTimeout(function() {
                    $indicator.removeClass('error').html('<i class="material-icons spinner">sync</i>');
                }, 2000);
            }
        });
    });

    // Mark Paid AJAX SweetAlert confirmation
    $(document).on('click', '.pay-ajax-btn', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var url = $btn.data('url');
        var payrollId = $btn.data('id');

        Swal.fire({
            title: 'Are you sure?',
            html: 'This payroll will be marked as <strong>PAID</strong>.<br><br>After payment, Classes Completed and Rate per Class can no longer be edited.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2e7d32',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Mark Paid',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Paid',
                                text: res.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            var $row = $btn.closest('tr');
                            
                            // Change badge to Paid
                            $row.find('.status-badge-cell').html('<span class="status-badge paid-badge">Paid</span>');

                            // Make inputs read-only & disabled
                            $row.find('.inline-input').prop('readonly', true).prop('disabled', true);
                            $row.find('.inline-input-wrapper').attr('title', 'Payroll already paid. Editing is disabled.');

                            // Remove mark paid button
                            $btn.remove();

                            // Update top dashboard stats
                            if (res.metrics) {
                                $('#val-total-trainers').text(res.metrics.totalTrainers);
                                $('#val-total-classes').text(res.metrics.totalClasses);
                                $('#val-total-payroll').text('₹' + res.metrics.totalPayrollAmount);
                                $('#val-pending-payroll').text('₹' + res.metrics.pendingPayroll);
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed',
                                text: res.message || 'Could not update payment status.'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while marking this payroll as Paid.'
                        });
                    }
                });
            }
        });
    });
});
</script>
