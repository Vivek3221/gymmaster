<style>
    html, body, .content, .container-fluid {
        overflow-x: hidden !important;
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
    .btn-info-print {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 8px 20px !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        box-shadow: 0 4px 10px rgba(2, 132, 199, 0.18) !important;
        transition: all 0.2s !important;
        height: 38px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        text-decoration: none !important;
        cursor: pointer;
    }
    .btn-info-print:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(2, 132, 199, 0.25) !important;
    }

    /* Header Actions Bar */
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
        overflow-x: auto;
        border: 1px solid #e2e8f0;
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

    /* Empty State */
    .empty-state-container {
        text-align: center;
        padding: 48px 24px;
    }
    .empty-state-icon {
        margin-bottom: 16px;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        #printSection, #printSection * {
            visibility: visible;
        }
        #printSection {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            background: #fff;
        }
        .no-print {
            display: none !important;
        }
        .card.modern-card {
            box-shadow: none !important;
            border: none !important;
        }
        .card.modern-card .header {
            border-bottom: 2px solid #333 !important;
            background: none !important;
        }
        .modern-table th {
            background-color: #eaeaea !important;
            color: #000 !important;
            border-bottom: 2px solid #000 !important;
        }
    }
</style>

<section class="content">
    <div class="container-fluid">
        <!-- Top Actions Bar -->
        <div class="header-actions no-print">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-outline-clear">
                <i class="material-icons">arrow_back</i> <?= __('Back to Dashboard') ?>
            </a>
            <a href="<?= $this->Url->build(array_merge(['action' => 'exportExcel'], $this->request->getQuery())) ?>" class="btn-success-export">
                <i class="material-icons">cloud_download</i> <?= __('Export to Excel') ?>
            </a>
            <button onclick="window.print();" class="btn-info-print">
                <i class="material-icons">print</i> <?= __('Print Report') ?>
            </button>
        </div>

        <?= $this->Flash->render() ?>

        <!-- Filters Card -->
        <div class="filter-card no-print">
            <div class="filter-card-title">
                <i class="material-icons">filter_list</i>
                <span><?= __('Filter Report Criteria') ?></span>
            </div>
            <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['action' => 'reports']]) ?>
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
                    <?= $this->Html->link('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">clear_all</i> ' . __('Clear'), ['action' => 'reports'], [
                        'class' => 'btn-outline-clear',
                        'escape' => false
                    ]) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>

        <!-- Main Report Section -->
        <div id="printSection">
            <div class="card modern-card">
                <div class="header">
                    <h2><?= __('PT Payroll Report Summary') ?></h2>
                </div>
                <div class="body">
                    <?php if (count($payrolls) > 0) { ?>
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
                                        <th><?= __('Payment Date') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $grandTotal = 0;
                                    foreach ($payrolls as $payroll) { 
                                        $monthName = date('F', mktime(0, 0, 0, $payroll->pt_class_entry->month, 10));
                                        $grandTotal += $payroll->total_amount;
                                    ?>
                                        <tr>
                                            <td><?= h($payroll->trainer->name) ?></td>
                                            <td><?= h($payroll->partner->name) ?></td>
                                            <td><?= h($monthName . ' ' . $payroll->pt_class_entry->year) ?></td>
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
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr style="background-color: #f8fafc; border-top: 2px solid #cbd5e1;">
                                        <th colspan="5" style="text-align: right; font-weight: bold; color: #475569; padding: 14px 16px;"><?= __('Grand Total:') ?></th>
                                        <th colspan="3" style="font-size: 16px; font-weight: 800; color: #16a34a; padding: 14px 16px;">₹<?= number_format($grandTotal, 2) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php } else { ?>
                        <!-- Empty State -->
                        <div class="empty-state-container">
                            <div class="empty-state-icon">
                                <i class="material-icons" style="font-size: 56px; color: #94a3b8; background: #f1f5f9; padding: 18px; border-radius: 50%;">assessment</i>
                            </div>
                            <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 6px;"><?= __('No reports found') ?></h4>
                            <p style="color: #64748b; font-size: 13.5px; max-width: 420px; margin: 0 auto;"><?= __('We couldn\'t find any records matching the selected search criteria.') ?></p>
                        </div>
                    <?php } ?>
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
});
</script>
