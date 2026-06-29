<?php
$years      = array_keys($reportData);
$currentYear = date('Y');
$activeYear  = in_array($currentYear, $years) ? $currentYear : (!empty($years) ? end($years) : null);
?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card modern-card" style="border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.05);border:1px solid #eaeaea;overflow:hidden;background:#fff;">
                    <div class="header" style="background:#fafafa;border-bottom:1px solid #eaeaea;padding:20px 24px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:15px;">
                        <div>
                            <h2 style="margin:0;font-size:20px;font-weight:700;color:#333;display:flex;align-items:center;gap:8px;">
                                <i class="material-icons" style="color:#ff9800;font-size:28px;vertical-align:middle;">assessment</i>
                                <span><?= __('Manual Collection — Payment Report') ?></span>
                                <span style="background:#fff3e0;color:#e65100;padding:2px 10px;border-radius:10px;font-size:12px;font-weight:700;">Manual</span>
                            </h2>
                            <p style="margin:5px 0 0 0;font-size:13px;color:#777;"><?= __('Year-wise breakdown of manual collection subscriber payments.') ?></p>
                        </div>
                        <div>
                            <a href="javascript:window.print()" class="btn btn-primary waves-effect" style="background-color:#607d8b!important;color:#fff!important;font-weight:600!important;border-radius:6px!important;padding:6px 14px!important;font-size:13px!important;display:inline-flex;align-items:center;gap:6px;">
                                <i class="material-icons" style="font-size:18px;">print</i> <?= __('Print') ?>
                            </a>
                            <a href="javascript:window.close()" class="btn btn-default waves-effect" style="font-weight:600!important;border-radius:6px!important;padding:6px 14px!important;font-size:13px!important;display:inline-flex;align-items:center;gap:6px;margin-left:8px;">
                                <i class="material-icons" style="font-size:18px;">close</i> <?= __('Close') ?>
                            </a>
                            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default waves-effect" style="font-weight:600!important;border-radius:6px!important;padding:6px 14px!important;font-size:13px!important;display:inline-flex;align-items:center;gap:6px;margin-left:8px;">
                                <i class="material-icons" style="font-size:18px;">arrow_back</i> <?= __('Back') ?>
                            </a>
                        </div>
                    </div>
                    <div class="body" style="padding:24px;">
                        <?php if (empty($reportData)): ?>
                            <div class="alert alert-info text-center" style="margin:20px 0;border-radius:8px;padding:30px;">
                                <i class="material-icons" style="font-size:48px;display:block;margin-bottom:10px;color:#9c27b0;">info</i>
                                <span style="font-size:16px;font-weight:600;color:#555;"><?= __('No report data available.') ?></span>
                            </div>
                        <?php else: ?>
                            <!-- Year Tabs -->
                            <ul class="nav nav-tabs report-year-tabs" role="tablist" style="margin-bottom:24px;border-bottom:2px solid #eaeaea;display:flex;gap:4px;padding-left:0;list-style:none;">
                                <?php foreach (array_keys($reportData) as $year): ?>
                                    <li role="presentation" class="<?= $year == $activeYear ? 'active' : '' ?>">
                                        <a href="#report-year-<?= $year ?>" data-toggle="tab" aria-expanded="<?= $year == $activeYear ? 'true' : 'false' ?>" style="font-weight:700;font-size:14px;padding:12px 24px;border-radius:6px 6px 0 0;display:block;text-decoration:none;border:1px solid transparent;transition:all .3s ease;">
                                            <?= $year ?> <?= __('Report') ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <!-- Tab Panes -->
                            <div class="tab-content">
                                <?php foreach ($reportData as $year => $data):
                                    $months            = $data['months'];
                                    $paymentDates      = $data['paymentDates'];
                                    $dataRows          = $data['dataRows'];
                                    $monthActiveCounts = $data['monthActiveCounts'];
                                    $monthTotals       = $data['monthTotals'];
                                ?>
                                    <div role="tabpanel" class="tab-pane fade <?= $year == $activeYear ? 'active in' : '' ?>" id="report-year-<?= $year ?>">

                                        <!-- Year stats -->
                                        <div class="row" style="margin-bottom:24px;display:flex;flex-wrap:wrap;gap:15px;">
                                            <div style="flex:1;min-width:220px;">
                                                <div style="background:#fff3e0;border-left:5px solid #ff9800;padding:16px;border-radius:8px;">
                                                    <div style="font-size:11px;text-transform:uppercase;font-weight:700;color:#e65100;letter-spacing:.5px;margin-bottom:4px;"><?= __('Total Subscribers') ?></div>
                                                    <div style="font-size:26px;font-weight:800;color:#bf360c;"><?= count($dataRows) ?></div>
                                                </div>
                                            </div>
                                            <div style="flex:1;min-width:220px;">
                                                <div style="background:#e8f5e9;border-left:5px solid #4caf50;padding:16px;border-radius:8px;">
                                                    <div style="font-size:11px;text-transform:uppercase;font-weight:700;color:#2e7d32;letter-spacing:.5px;margin-bottom:4px;"><?= __('Total Fee') ?></div>
                                                    <div style="font-size:26px;font-weight:800;color:#1b5e20;"><?= $this->Number->format(array_sum(array_column($dataRows, 'total_amount'))) ?></div>
                                                </div>
                                            </div>
                                            <div style="flex:1;min-width:220px;">
                                                <div style="background:#fff3e0;border-left:5px solid #ff9800;padding:16px;border-radius:8px;">
                                                    <div style="font-size:11px;text-transform:uppercase;font-weight:700;color:#e65100;letter-spacing:.5px;margin-bottom:4px;"><?= __('Total Paid') ?></div>
                                                    <div style="font-size:26px;font-weight:800;color:#e65100;"><?= $this->Number->format(array_sum(array_column($dataRows, 'paid_amount'))) ?></div>
                                                </div>
                                            </div>
                                            <div style="flex:1;min-width:220px;">
                                                <div style="background:#ffebee;border-left:5px solid #f44336;padding:16px;border-radius:8px;">
                                                    <div style="font-size:11px;text-transform:uppercase;font-weight:700;color:#c62828;letter-spacing:.5px;margin-bottom:4px;"><?= __('Total Due') ?></div>
                                                    <div style="font-size:26px;font-weight:800;color:#b71c1c;"><?= $this->Number->format(array_sum(array_column($dataRows, 'due_amount'))) ?></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="report-table-wrapper" style="width:100%;overflow-x:auto;border:1px solid #e2e8f0;border-radius:8px;background:#fff;">
                                            <table class="table table-bordered report-grid" style="margin-bottom:0;min-width:1600px;border-collapse:collapse;width:100%;">
                                                <thead>
                                                    <!-- Row 1: Active Members -->
                                                    <tr style="background-color:#f8fafc;">
                                                        <td colspan="11" style="font-weight:700;background:#f1f5f9;text-transform:uppercase;color:#475569;font-size:12px;vertical-align:middle;border:1px solid #cbd5e1;padding:12px;">
                                                            <strong><?= __('Active Members') ?></strong>
                                                        </td>
                                                        <?php foreach ($months as $m): ?>
                                                            <td class="text-center" style="background-color:#fff3e0;color:#e65100;font-weight:800;border:1px solid #cbd5e1;padding:12px;text-align:center;">
                                                                <?= $monthActiveCounts[$m] ?>
                                                            </td>
                                                        <?php endforeach; ?>
                                                        <?php if (!empty($paymentDates)): ?>
                                                            <td colspan="<?= count($paymentDates) ?>" style="background-color:#f8fafc;border:1px solid #cbd5e1;"></td>
                                                        <?php endif; ?>
                                                    </tr>

                                                    <!-- Row 2: Amount/Month -->
                                                    <tr style="background-color:#f8fafc;">
                                                        <td colspan="11" style="font-weight:700;background:#f1f5f9;text-transform:uppercase;color:#475569;font-size:12px;border:1px solid #cbd5e1;padding:12px;">
                                                            <strong><?= __('Amount / Month') ?></strong>
                                                        </td>
                                                        <?php foreach ($months as $m): ?>
                                                            <td class="text-center" style="background-color:#e8f5e9;color:#2e7d32;font-weight:800;border:1px solid #cbd5e1;padding:12px;text-align:center;">
                                                                <?= $this->Number->format(round($monthTotals[$m], 2)) ?>
                                                            </td>
                                                        <?php endforeach; ?>
                                                        <?php if (!empty($paymentDates)): ?>
                                                            <td colspan="<?= count($paymentDates) ?>" style="background-color:#f8fafc;border:1px solid #cbd5e1;"></td>
                                                        <?php endif; ?>
                                                    </tr>

                                                    <!-- Row 3: Headers -->
                                                    <tr style="background-color:#6a1b9a;color:#fff;">
                                                        <?php
                                                        $hdStyle = 'background-color:#ff9800!important;color:#fff!important;font-weight:700;padding:12px;border:1px solid #e68a00;font-size:11px;text-transform:uppercase;letter-spacing:.5px;';
                                                        $headers = [__('Name'),__('Date of Joining'),__('Membership'),__('Total Amount'),__('Paid Amount'),__('Due Amount'),__('End Date'),__('Pending Days'),__('Pending Amount'),__('Days'),__('Daily Amt')];
                                                        foreach ($headers as $h): ?>
                                                            <th style="<?= $hdStyle ?>"><?= $h ?></th>
                                                        <?php endforeach; ?>
                                                        <?php foreach ($months as $m): ?>
                                                            <th style="background-color:#e65100!important;color:#fff!important;font-weight:700;padding:12px;border:1px solid #bf360c;font-size:11px;text-transform:uppercase;text-align:center;min-width:95px;">
                                                                <?= date('d-m-Y', strtotime($m)) ?>
                                                            </th>
                                                        <?php endforeach; ?>
                                                        <?php foreach ($paymentDates as $d): ?>
                                                            <th style="background-color:#795548!important;color:#fff!important;font-weight:700;padding:12px;border:1px solid #5d4037;font-size:11px;text-transform:uppercase;text-align:center;min-width:105px;">
                                                                <?= __('Paid ') . $d ?>
                                                            </th>
                                                        <?php endforeach; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($dataRows as $r): ?>
                                                        <tr style="transition:background-color .2s ease;">
                                                            <td style="font-weight:600;padding:10px 12px;border:1px solid #e2e8f0;color:#1e293b;"><?= h($r['name']) ?></td>
                                                            <td style="padding:10px 12px;border:1px solid #e2e8f0;"><?= h($r['joining_date']) ?></td>
                                                            <td style="padding:10px 12px;border:1px solid #e2e8f0;text-align:center;"><?= h($r['membership']) ?></td>
                                                            <td style="padding:10px 12px;border:1px solid #e2e8f0;text-align:right;font-weight:700;"><?= $this->Number->format($r['total_amount']) ?></td>
                                                            <td style="padding:10px 12px;border:1px solid #e2e8f0;text-align:right;font-weight:700;color:#16a34a;"><?= $this->Number->format($r['paid_amount']) ?></td>
                                                            <td style="padding:10px 12px;border:1px solid #e2e8f0;text-align:right;font-weight:700;color:#dc2626;"><?= $this->Number->format($r['due_amount']) ?></td>
                                                            <td style="padding:10px 12px;border:1px solid #e2e8f0;"><?= h($r['end_date']) ?></td>
                                                            <td style="padding:10px 12px;border:1px solid #e2e8f0;text-align:center;"><?= h($r['pending_days']) ?></td>
                                                            <td style="padding:10px 12px;border:1px solid #e2e8f0;text-align:right;"><?= $this->Number->format($r['pending_amount']) ?></td>
                                                            <td style="padding:10px 12px;border:1px solid #e2e8f0;text-align:center;"><?= h($r['days']) ?></td>
                                                            <td style="padding:10px 12px;border:1px solid #e2e8f0;text-align:right;"><?= $this->Number->format($r['daily_amt']) ?></td>
                                                            <?php foreach ($months as $m):
                                                                $val = $r['months'][$m];
                                                            ?>
                                                                <td style="padding:10px 12px;border:1px solid #e2e8f0;text-align:center;<?= $val > 0 ? 'background-color:#fff3e0;color:#bf360c;font-weight:700;' : 'color:#cbd5e1;' ?>">
                                                                    <?= $val > 0 ? $this->Number->format($val) : '-' ?>
                                                                </td>
                                                            <?php endforeach; ?>
                                                            <?php foreach ($paymentDates as $d):
                                                                $val = $r['payments'][$d];
                                                            ?>
                                                                <td style="padding:10px 12px;border:1px solid #e2e8f0;text-align:center;<?= $val > 0 ? 'background-color:#efebe9;color:#4e342e;font-weight:700;' : 'color:#cbd5e1;' ?>">
                                                                    <?= $val > 0 ? $this->Number->format($val) : '-' ?>
                                                                </td>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .report-grid th,.report-grid td { white-space:nowrap!important;vertical-align:middle!important; }
    .report-year-tabs { border-bottom:2px solid #e2e8f0!important;margin-bottom:24px!important;display:flex;flex-wrap:wrap;padding-left:0;list-style:none; }
    .report-year-tabs>li { margin-bottom:-2px; }
    .report-year-tabs>li>a { color:#64748b!important;background-color:#f8fafc;border:1px solid #e2e8f0;margin-right:4px;font-weight:700!important;padding:10px 18px!important;font-size:13px!important;display:block;border-radius:6px 6px 0 0!important;text-decoration:none!important;transition:all .2s ease-in-out; }
    .report-year-tabs>li>a:hover { background-color:#f1f5f9!important;color:#ff9800!important; }
    .report-year-tabs>li.active>a,.report-year-tabs>li.active>a:focus,.report-year-tabs>li.active>a:hover { background-color:#fff!important;border-top:3px solid #ff9800!important;border-bottom:2px solid transparent!important;color:#ff9800!important; }
    .report-table-wrapper::-webkit-scrollbar { height:10px;background:#f1f5f9; }
    .report-table-wrapper::-webkit-scrollbar-thumb { border-radius:6px;background:#cbd5e1;border:2px solid #f1f5f9; }
    .report-grid tbody tr:hover td { background-color:#fffbf5!important; }
    @media print {
        header,footer,.navbar,.sidebar,.header-actions,.nav-tabs { display:none!important; }
        .report-table-wrapper { overflow:visible!important;border:none!important; }
        .report-grid { min-width:100%!important;font-size:9px!important; }
        .report-grid th,.report-grid td { padding:4px 6px!important;border:1px solid #000!important;color:#000!important; }
        .tab-content>.tab-pane { display:block!important;opacity:1!important;visibility:visible!important;page-break-after:always; }
    }
</style>
