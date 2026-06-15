<?php
/**
 * @var \App\View\AppView $this
 * @var array $reportData
 */

$years = array_keys($reportData);
$currentYear = date('Y');
$activeYear = in_array($currentYear, $years) ? $currentYear : (!empty($years) ? end($years) : null);
?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card modern-card" style="border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border: 1px solid #eaeaea; overflow: hidden; background: #fff;">
                    <div class="header" style="background: #fafafa; border-bottom: 1px solid #eaeaea; padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                        <div>
                            <h2 style="margin: 0; font-size: 20px; font-weight: 700; color: #333; display: flex; align-items: center; gap: 8px;">
                                <i class="material-icons" style="color: #00bcd4; font-size: 28px; vertical-align: middle;">assessment</i>
                                <span><?= __('Subscribers Overlap & Payment Report') ?></span>
                            </h2>
                            <p style="margin: 5px 0 0 0; font-size: 13px; color: #777; font-weight: 400;"><?= __('Interactive year-wise breakdown of subscriber payments and monthly active metrics.') ?></p>
                        </div>
                        <div class="header-actions">
                            <a href="javascript:window.print()" class="btn btn-primary waves-effect" style="background-color: #607d8b !important; color: #fff !important; font-weight: 600 !important; border-radius: 6px !important; padding: 6px 14px !important; font-size: 13px !important; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;">
                                <i class="material-icons" style="font-size: 18px; vertical-align: middle;">print</i> <?= __('Print') ?>
                            </a>
                            <a href="javascript:window.close()" class="btn btn-default waves-effect" style="font-weight: 600 !important; border-radius: 6px !important; padding: 6px 14px !important; font-size: 13px !important; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; margin-left: 8px;">
                                <i class="material-icons" style="font-size: 18px; vertical-align: middle;">close</i> <?= __('Close') ?>
                            </a>
                        </div>
                    </div>
                    <div class="body" style="padding: 24px;">
                        <?php if (empty($reportData)): ?>
                            <div class="alert alert-info text-center" style="margin: 20px 0; border-radius: 8px; padding: 30px;">
                                <i class="material-icons" style="font-size: 48px; display: block; margin-bottom: 10px; color: #00bcd4;">info</i>
                                <span style="font-size: 16px; font-weight: 600; color: #555;"><?= __('No report data available with the current filter settings.') ?></span>
                            </div>
                        <?php else: ?>
                            <!-- Navigation Tabs for Years -->
                            <ul class="nav nav-tabs report-year-tabs" role="tablist" style="margin-bottom: 24px; border-bottom: 2px solid #eaeaea; display: flex; gap: 4px; padding-left: 0; list-style: none;">
                                <?php foreach (array_keys($reportData) as $year): ?>
                                    <li role="presentation" class="<?= $year == $activeYear ? 'active' : '' ?>">
                                        <a href="#report-year-<?= $year ?>" data-toggle="tab" aria-expanded="<?= $year == $activeYear ? 'true' : 'false' ?>" style="font-weight: 700; font-size: 14px; padding: 12px 24px; border-radius: 6px 6px 0 0; display: block; text-decoration: none; border: 1px solid transparent; transition: all 0.3s ease;">
                                            <?= $year ?> <?= __('Report') ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <!-- Tab Panes -->
                            <div class="tab-content">
                                <?php foreach ($reportData as $year => $data): 
                                    $months = $data['months'];
                                    $paymentDates = $data['paymentDates'];
                                    $dataRows = $data['dataRows'];
                                    $monthActiveCounts = $data['monthActiveCounts'];
                                    $monthTotals = $data['monthTotals'];
                                ?>
                                    <div role="tabpanel" class="tab-pane fade <?= $year == $activeYear ? 'active in' : '' ?>" id="report-year-<?= $year ?>">
                                        
                                        <!-- Year Statistics Cards -->
                                        <div class="row" style="margin-bottom: 24px; display: flex; flex-wrap: wrap; gap: 15px;">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="flex: 1; min-width: 220px;">
                                                <div class="stat-box" style="background: #e0f7fa; border-left: 5px solid #00bcd4; padding: 16px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,188,212,0.08); display: flex; flex-direction: column; justify-content: center;">
                                                    <div style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #00838f; letter-spacing: 0.5px; margin-bottom: 4px;"><?= __('Total Subscribers') ?></div>
                                                    <div style="font-size: 26px; font-weight: 800; color: #006064;"><?= count($dataRows) ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="flex: 1; min-width: 220px;">
                                                <div class="stat-box" style="background: #e8f5e9; border-left: 5px solid #4caf50; padding: 16px; border-radius: 8px; box-shadow: 0 4px 12px rgba(76,175,80,0.08); display: flex; flex-direction: column; justify-content: center;">
                                                    <div style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #2e7d32; letter-spacing: 0.5px; margin-bottom: 4px;"><?= __('Total Calculated Fee') ?></div>
                                                    <div style="font-size: 26px; font-weight: 800; color: #1b5e20;">
                                                        <?= $this->Number->format(array_sum(array_column($dataRows, 'total_amount'))) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="flex: 1; min-width: 220px;">
                                                <div class="stat-box" style="background: #fff3e0; border-left: 5px solid #ff9800; padding: 16px; border-radius: 8px; box-shadow: 0 4px 12px rgba(255,152,0,0.08); display: flex; flex-direction: column; justify-content: center;">
                                                    <div style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #e65100; letter-spacing: 0.5px; margin-bottom: 4px;"><?= __('Total Paid Fee') ?></div>
                                                    <div style="font-size: 26px; font-weight: 800; color: #e65100;">
                                                        <?= $this->Number->format(array_sum(array_column($dataRows, 'paid_amount'))) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="flex: 1; min-width: 220px;">
                                                <div class="stat-box" style="background: #ffebee; border-left: 5px solid #f44336; padding: 16px; border-radius: 8px; box-shadow: 0 4px 12px rgba(244,67,54,0.08); display: flex; flex-direction: column; justify-content: center;">
                                                    <div style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #c62828; letter-spacing: 0.5px; margin-bottom: 4px;"><?= __('Total Due Fee') ?></div>
                                                    <div style="font-size: 26px; font-weight: 800; color: #b71c1c;">
                                                        <?= $this->Number->format(array_sum(array_column($dataRows, 'due_amount'))) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="report-table-wrapper" style="width: 100%; overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 8px; background: #fff;">
                                            <table class="table table-bordered report-grid" style="margin-bottom: 0; min-width: 1600px; border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <!-- Row 1: Active Members Count -->
                                                    <tr class="active-members-row" style="background-color: #f8fafc;">
                                                        <td colspan="11" style="font-weight: 700; background: #f1f5f9; text-transform: uppercase; color: #475569; font-size: 12px; vertical-align: middle; border: 1px solid #cbd5e1; padding: 12px;">
                                                            <strong><?= __('Active Members') ?></strong>
                                                        </td>
                                                        <?php foreach ($months as $m): ?>
                                                            <td class="text-center" style="background-color: #e0f2f1; color: #00796b; font-weight: 800; border: 1px solid #cbd5e1; padding: 12px; text-align: center;">
                                                                <?= $monthActiveCounts[$m] ?>
                                                            </td>
                                                        <?php endforeach; ?>
                                                        <?php if (!empty($paymentDates)): ?>
                                                            <td colspan="<?= count($paymentDates) ?>" style="background-color: #f8fafc; border: 1px solid #cbd5e1;"></td>
                                                        <?php endif; ?>
                                                    </tr>

                                                    <!-- Row 2: Amount / Month Totals -->
                                                    <tr class="amount-month-row" style="background-color: #f8fafc;">
                                                        <td colspan="11" style="font-weight: 700; background: #f1f5f9; text-transform: uppercase; color: #475569; font-size: 12px; vertical-align: middle; border: 1px solid #cbd5e1; padding: 12px;">
                                                            <strong><?= __('Amount / Month') ?></strong>
                                                        </td>
                                                        <?php foreach ($months as $m): ?>
                                                            <td class="text-center" style="background-color: #e8f5e9; color: #2e7d32; font-weight: 800; border: 1px solid #cbd5e1; padding: 12px; text-align: center;">
                                                                <?= $this->Number->format(round($monthTotals[$m], 2)) ?>
                                                            </td>
                                                        <?php endforeach; ?>
                                                        <?php if (!empty($paymentDates)): ?>
                                                            <td colspan="<?= count($paymentDates) ?>" style="background-color: #f8fafc; border: 1px solid #cbd5e1;"></td>
                                                        <?php endif; ?>
                                                    </tr>

                                                    <!-- Row 3: Grid Headers -->
                                                    <tr class="headers-row" style="background-color: #3f51b5; color: #fff;">
                                                        <th style="background-color: #3f51b5 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #303f9f; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;"><?= __('Name') ?></th>
                                                        <th style="background-color: #3f51b5 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #303f9f; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;"><?= __('Date of Joining') ?></th>
                                                        <th style="background-color: #3f51b5 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #303f9f; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; text-align: center;"><?= __('Membership') ?></th>
                                                        <th style="background-color: #3f51b5 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #303f9f; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; text-align: right;"><?= __('Total Amount') ?></th>
                                                        <th style="background-color: #3f51b5 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #303f9f; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; text-align: right;"><?= __('Paid Amount') ?></th>
                                                        <th style="background-color: #3f51b5 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #303f9f; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; text-align: right;"><?= __('Due Amount') ?></th>
                                                        <th style="background-color: #3f51b5 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #303f9f; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;"><?= __('End Date') ?></th>
                                                        <th style="background-color: #3f51b5 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #303f9f; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; text-align: center;"><?= __('Pending Days') ?></th>
                                                        <th style="background-color: #3f51b5 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #303f9f; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; text-align: right;"><?= __('Pending Amount') ?></th>
                                                        <th style="background-color: #3f51b5 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #303f9f; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; text-align: center;"><?= __('Days') ?></th>
                                                        <th style="background-color: #3f51b5 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #303f9f; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; text-align: right;"><?= __('Daily Amt') ?></th>
                                                        
                                                        <!-- Month Columns Headers -->
                                                        <?php foreach ($months as $m): ?>
                                                            <th style="background-color: #009688 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #00796b; font-size: 11px; text-transform: uppercase; text-align: center; min-width: 95px;"><?= date('d-m-Y', strtotime($m)) ?></th>
                                                        <?php endforeach; ?>

                                                        <!-- Payment Columns Headers -->
                                                        <?php foreach ($paymentDates as $d): ?>
                                                            <th style="background-color: #795548 !important; color: #fff !important; font-weight: 700; padding: 12px; border: 1px solid #5d4037; font-size: 11px; text-transform: uppercase; text-align: center; min-width: 105px;"><?= __('Paid ') . $d ?></th>
                                                        <?php endforeach; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($dataRows as $r): ?>
                                                        <tr style="transition: background-color 0.2s ease;">
                                                            <td style="font-weight: 600; padding: 10px 12px; border: 1px solid #e2e8f0; color: #1e293b;"><?= h($r['name']) ?></td>
                                                            <td style="padding: 10px 12px; border: 1px solid #e2e8f0; color: #334155;"><?= h($r['joining_date']) ?></td>
                                                            <td style="padding: 10px 12px; border: 1px solid #e2e8f0; text-align: center; color: #334155;"><?= h($r['membership']) ?></td>
                                                            <td style="padding: 10px 12px; border: 1px solid #e2e8f0; text-align: right; font-weight: 700; color: #0f172a;"><?= $this->Number->format($r['total_amount']) ?></td>
                                                            <td style="padding: 10px 12px; border: 1px solid #e2e8f0; text-align: right; font-weight: 700; color: #16a34a;"><?= $this->Number->format($r['paid_amount']) ?></td>
                                                            <td style="padding: 10px 12px; border: 1px solid #e2e8f0; text-align: right; font-weight: 700; color: #dc2626;"><?= $this->Number->format($r['due_amount']) ?></td>
                                                            <td style="padding: 10px 12px; border: 1px solid #e2e8f0; color: #334155;"><?= h($r['end_date']) ?></td>
                                                            <td style="padding: 10px 12px; border: 1px solid #e2e8f0; text-align: center; color: #334155;"><?= h($r['pending_days']) ?></td>
                                                            <td style="padding: 10px 12px; border: 1px solid #e2e8f0; text-align: right; color: #334155;"><?= $this->Number->format($r['pending_amount']) ?></td>
                                                            <td style="padding: 10px 12px; border: 1px solid #e2e8f0; text-align: center; color: #334155;"><?= h($r['days']) ?></td>
                                                            <td style="padding: 10px 12px; border: 1px solid #e2e8f0; text-align: right; color: #334155;"><?= $this->Number->format($r['daily_amt']) ?></td>

                                                            <!-- Month Cells -->
                                                            <?php foreach ($months as $m): 
                                                                $val = $r['months'][$m];
                                                            ?>
                                                                <td class="<?= $val > 0 ? 'bg-overlap-active' : '' ?>" style="padding: 10px 12px; border: 1px solid #e2e8f0; text-align: center; <?= $val > 0 ? 'background-color: #e8f5e9; color: #1b5e20; font-weight: 700;' : 'color: #cbd5e1;' ?>">
                                                                    <?= $val > 0 ? $this->Number->format($val) : '-' ?>
                                                                </td>
                                                            <?php endforeach; ?>

                                                            <!-- Payment Cells -->
                                                            <?php foreach ($paymentDates as $d): 
                                                                $val = $r['payments'][$d];
                                                            ?>
                                                                <td class="<?= $val > 0 ? 'bg-payment-active' : '' ?>" style="padding: 10px 12px; border: 1px solid #e2e8f0; text-align: center; <?= $val > 0 ? 'background-color: #efebe9; color: #4e342e; font-weight: 700;' : 'color: #cbd5e1;' ?>">
                                                                    <?= $val > 0 ? $this->Number->format($val) : '-' ?>
                                                                </td>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php $first = false; endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Prevent wrapping in cells to ensure horizontal scroll rather than vertical stretch */
    .report-grid th, 
    .report-grid td {
        white-space: nowrap !important;
    }

    /* Styling for Excel-like Tab Layout */
    .report-year-tabs {
        border-bottom: 2px solid #e2e8f0 !important;
        margin-bottom: 24px !important;
        display: flex;
        flex-wrap: wrap;
        padding-left: 0;
        list-style: none;
    }
    
    .report-year-tabs > li {
        margin-bottom: -2px;
    }
    
    .report-year-tabs > li > a {
        color: #64748b !important;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        margin-right: 4px;
        font-weight: 700 !important;
        padding: 10px 18px !important;
        font-size: 13px !important;
        display: block;
        border-radius: 6px 6px 0 0 !important;
        text-decoration: none !important;
        transition: all 0.2s ease-in-out;
    }
    
    .report-year-tabs > li > a:hover {
        background-color: #f1f5f9 !important;
        color: #ff9800 !important;
    }

    .report-year-tabs > li.active > a,
    .report-year-tabs > li.active > a:focus,
    .report-year-tabs > li.active > a:hover {
        background-color: #fff !important;
        border-left: 2px solid #e2e8f0 !important;
        border-right: 2px solid #e2e8f0 !important;
        border-top: 3px solid #ff9800 !important;
        border-bottom: 2px solid transparent !important;
        color: #ff9800 !important;
    }

    /* Scrollbars customization */
    .report-table-wrapper::-webkit-scrollbar {
        height: 10px;
        background-color: #f1f5f9;
    }
    
    .report-table-wrapper::-webkit-scrollbar-thumb {
        border-radius: 6px;
        background-color: #cbd5e1;
        border: 2px solid #f1f5f9;
    }
    
    .report-table-wrapper::-webkit-scrollbar-thumb:hover {
        background-color: #94a3b8;
    }

    .report-grid th {
        vertical-align: middle !important;
    }
    
    .report-grid td {
        vertical-align: middle !important;
    }
    
    .bg-overlap-active {
        box-shadow: inset 0 0 0 9999px rgba(76, 175, 80, 0.04);
    }
    
    .bg-payment-active {
        box-shadow: inset 0 0 0 9999px rgba(121, 85, 72, 0.04);
    }

    .report-grid tbody tr:hover td {
        background-color: #f8fafc !important;
    }
    
    .report-grid tbody tr:hover td.bg-overlap-active {
        background-color: #e2f1e4 !important;
    }
    
    .report-grid tbody tr:hover td.bg-payment-active {
        background-color: #ece5e2 !important;
    }

    /* Print styling */
    @media print {
        header, footer, .navbar, .sidebar, .header-actions, .nav-tabs, .stat-box {
            display: none !important;
        }
        .report-table-wrapper {
            overflow: visible !important;
            border: none !important;
        }
        .report-grid {
            min-width: 100% !important;
            width: 100% !important;
            font-size: 9px !important;
        }
        .report-grid th, .report-grid td {
            padding: 4px 6px !important;
            border: 1px solid #000 !important;
            color: #000 !important;
        }
        .tab-content > .tab-pane {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
            page-break-after: always;
        }
    }
</style>
