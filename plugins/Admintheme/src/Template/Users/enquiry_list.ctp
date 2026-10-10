<?php
$user_type = $this->Common->getType();
?>
<section class="content" style="padding-top: 15px;">
    <div class="container-fluid" style="max-width: 100%; box-sizing: border-box;">
        
        <?= $this->Flash->render() ?>

        <style>
            /* ── Header ── */
            .enq-header {
                background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
                border-radius: 14px;
                padding: 22px 28px;
                margin-bottom: 22px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 15px;
                border-bottom: 3px solid #ff9800;
                box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            }
            .enq-header-left {
                display: flex;
                align-items: center;
                gap: 14px;
            }
            .enq-header-icon {
                width: 48px;
                height: 48px;
                background: rgba(255, 152, 0, 0.18);
                border: 1.5px solid rgba(255, 152, 0, 0.4);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #ff9800;
            }
            .enq-header h2 {
                color: #ffffff;
                font-size: 20px;
                font-weight: 700;
                margin: 0 0 4px 0;
                letter-spacing: -0.3px;
            }
            .enq-header p {
                color: #94a3b8;
                font-size: 13px;
                margin: 0;
            }
            .btn-add-enq-main {
                background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
                color: #fff !important;
                border: none;
                border-radius: 10px;
                padding: 10px 22px;
                font-size: 13.5px;
                font-weight: 700;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                text-decoration: none !important;
                box-shadow: 0 4px 14px rgba(255,152,0,0.35);
                transition: all 0.2s ease;
            }
            .btn-add-enq-main:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(255,152,0,0.45);
            }

            /* ── Stats Grid ── */
            .enq-stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
                gap: 16px;
                margin-bottom: 22px;
            }
            .enq-stat-card {
                background: #ffffff;
                border-radius: 14px;
                padding: 18px 20px;
                border: 1.5px solid #edf2f7;
                box-shadow: 0 4px 16px rgba(0,0,0,0.03);
                display: flex;
                align-items: center;
                gap: 14px;
            }
            .enq-stat-icon {
                width: 44px;
                height: 44px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }
            .enq-stat-icon.orange {
                background: #fff7ed;
                color: #ea580c;
            }
            .enq-stat-icon.blue {
                background: #f0f9ff;
                color: #0284c7;
            }
            .enq-stat-icon.green {
                background: #f0fdf4;
                color: #16a34a;
            }
            .enq-stat-val {
                font-size: 22px;
                font-weight: 800;
                color: #1e293b;
                line-height: 1.2;
            }
            .enq-stat-label {
                font-size: 11.5px;
                font-weight: 600;
                color: #64748b;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            /* ── Filter Card ── */
            .enq-filter-card {
                background: #ffffff;
                border: 1px solid #edf2f7;
                border-radius: 14px;
                padding: 22px 24px;
                margin-bottom: 24px;
                box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            }
            .enq-filter-grid {
                display: grid;
                grid-template-columns: 1.5fr 1.2fr 1.2fr 1.2fr 1fr auto;
                gap: 14px;
                align-items: flex-end;
            }
            @media (max-width: 1100px) {
                .enq-filter-grid {
                    grid-template-columns: 1fr 1fr 1fr;
                }
            }
            @media (max-width: 700px) {
                .enq-filter-grid {
                    grid-template-columns: 1fr;
                }
            }
            .filter-group {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }
            .filter-group label {
                font-size: 12px;
                font-weight: 700;
                color: #475569;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin: 0;
            }
            .filter-group .form-control {
                height: 42px !important;
                border: 1.5px solid #cbd5e1 !important;
                border-radius: 8px !important;
                padding: 8px 12px !important;
                font-size: 13.5px !important;
                background: #f8fafc !important;
                box-shadow: none !important;
            }
            .filter-group .form-control:focus {
                border-color: #ff9800 !important;
                background: #ffffff !important;
            }
            .btn-filter-apply {
                background: #1e293b;
                color: #fff !important;
                border: none;
                border-radius: 8px;
                height: 42px;
                padding: 0 18px;
                font-size: 13.5px;
                font-weight: 700;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                cursor: pointer;
                transition: all 0.2s;
            }
            .btn-filter-apply:hover {
                background: #334155;
            }
            .btn-filter-clear {
                background: #f1f5f9;
                color: #64748b !important;
                border: 1.5px solid #cbd5e1;
                border-radius: 8px;
                height: 42px;
                padding: 0 14px;
                font-size: 13.5px;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                gap: 4px;
                text-decoration: none !important;
                transition: all 0.2s;
            }
            .btn-filter-clear:hover {
                background: #e2e8f0;
                color: #1e293b;
            }

            /* ── Table Card ── */
            .enq-table-card {
                background: #ffffff;
                border-radius: 14px;
                border: 1px solid #edf2f7;
                box-shadow: 0 6px 24px rgba(0,0,0,0.04);
                overflow: hidden;
            }
            .enq-table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }
            .enq-table thead th {
                background: #f8fafc;
                color: #475569;
                font-size: 12px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.6px;
                padding: 14px 18px;
                border-bottom: 1.5px solid #e2e8f0;
                white-space: nowrap;
            }
            .enq-table tbody td {
                padding: 16px 18px;
                border-bottom: 1px solid #f1f5f9;
                vertical-align: middle;
                font-size: 13.5px;
                color: #1e293b;
            }
            .enq-table tbody tr:hover {
                background: #fbfcfe;
            }

            /* User Info Box */
            .user-info-box {
                display: flex;
                align-items: center;
                gap: 12px;
            }
            .user-avatar-sm {
                width: 38px;
                height: 38px;
                border-radius: 50%;
                background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: 14px;
                flex-shrink: 0;
            }
            .user-name-link {
                color: #1e293b;
                font-weight: 700;
                font-size: 14px;
                text-decoration: none !important;
                display: flex;
                align-items: center;
                gap: 6px;
            }
            .user-name-link:hover {
                color: #ff9800;
            }
            .user-contact-links {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-top: 4px;
            }
            .contact-chip {
                display: inline-flex;
                align-items: center;
                gap: 3px;
                font-size: 12px;
                color: #64748b;
                text-decoration: none !important;
            }
            .contact-chip:hover {
                color: #0284c7;
            }
            .wa-chip {
                color: #16a34a !important;
                font-weight: 600;
            }
            .wa-chip:hover {
                color: #15803d !important;
            }

            /* Badges */
            .badge-status {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 20px;
                font-size: 11.5px;
                font-weight: 700;
            }
            .badge-status.active {
                background: #dcfce7;
                color: #15803d;
            }
            .badge-status.enquiry {
                background: #fff7ed;
                color: #c2410c;
            }

            /* Remarks Box */
            .remark-content-box {
                background: #f8fafc;
                border-left: 3.5px solid #ff9800;
                border-radius: 6px;
                padding: 8px 12px;
                font-size: 13px;
                color: #334155;
                line-height: 1.4;
                max-width: 320px;
                word-break: break-word;
            }

            /* Action Buttons */
            .btn-action-round {
                width: 34px;
                height: 34px;
                border-radius: 8px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                border: none;
                cursor: pointer;
                transition: all 0.2s ease;
            }
            .btn-action-round.remark {
                background: #ff9800;
            }
            .btn-action-round.remark:hover {
                background: #f57c00;
            }
            .btn-action-round.pay {
                background: #16a34a;
            }
            .btn-action-round.pay:hover {
                background: #15803d;
            }
            .btn-action-round.view {
                background: #0284c7;
            }
            .btn-action-round.view:hover {
                background: #0369a1;
            }
        </style>

        <!-- Header -->
        <div class="enq-header">
            <div class="enq-header-left">
                <div class="enq-header-icon">
                    <i class="material-icons" style="font-size: 26px;">person_search</i>
                </div>
                <div>
                    <h2><?= __('Enquiry Search & Management') ?></h2>
                    <p><?= __('Search and filter enquiries across any month or custom date range in one click') ?></p>
                </div>
            </div>
            <div>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>" class="btn-add-enq-main">
                    <i class="material-icons" style="font-size: 18px;">person_add</i>
                    <?= __('+ New Enquiry') ?>
                </a>
            </div>
        </div>

        <!-- Metrics Cards -->
        <div class="enq-stats-grid">
            <div class="enq-stat-card">
                <div class="enq-stat-icon orange">
                    <i class="material-icons" style="font-size: 24px;">contact_mail</i>
                </div>
                <div>
                    <div class="enq-stat-val"><?= $filteredCount ?></div>
                    <div class="enq-stat-label"><?= __('Filtered Enquiries') ?></div>
                </div>
            </div>

            <div class="enq-stat-card">
                <div class="enq-stat-icon blue">
                    <i class="material-icons" style="font-size: 24px;">group</i>
                </div>
                <div>
                    <div class="enq-stat-val"><?= $totalEnquiriesAllTime ?></div>
                    <div class="enq-stat-label"><?= __('Total Active Enquiries') ?></div>
                </div>
            </div>

            <div class="enq-stat-card">
                <div class="enq-stat-icon green">
                    <i class="material-icons" style="font-size: 24px;">verified</i>
                </div>
                <div>
                    <div class="enq-stat-val"><?= $totalConvertedAllTime ?></div>
                    <div class="enq-stat-label"><?= __('Converted Members') ?></div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="enq-filter-card">
            <?= $this->Form->create(null, ['type' => 'get', 'id' => 'enqFilterForm']) ?>
            <div class="enq-filter-grid">
                <!-- Search text -->
                <div class="filter-group">
                    <label><?= __('Search Name / Mobile') ?></label>
                    <input type="text" name="search" class="form-control" placeholder="<?= __('Search by name or mobile...') ?>" value="<?= h($search) ?>">
                </div>

                <!-- Month Quick Preset Selector -->
                <div class="filter-group">
                    <label><?= __('Select Month') ?></label>
                    <select name="month" id="monthPresetSelect" class="form-control" onchange="handleMonthChange(this.value)">
                        <option value=""><?= __('-- Select Month / Custom --') ?></option>
                        <option value="current" <?= ($monthSelect === 'current') ? 'selected' : '' ?>><?= __('Current Month (' . date('M Y') . ')') ?></option>
                        <option value="last" <?= ($monthSelect === 'last') ? 'selected' : '' ?>><?= __('Last Month (' . date('M Y', strtotime('first day of last month')) . ')') ?></option>
                        <?php 
                        // Past 12 months options
                        for ($i = 0; $i <= 12; $i++):
                            $mVal = date('Y-m', strtotime("-$i months"));
                            $mLabel = date('F Y', strtotime("-$i months"));
                        ?>
                            <option value="<?= $mVal ?>" <?= ($monthSelect === $mVal) ? 'selected' : '' ?>><?= $mLabel ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <!-- Date Range: From -->
                <div class="filter-group">
                    <label><?= __('From Date') ?></label>
                    <input type="text" name="date_from" id="filterDateFrom" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" value="<?= h($dateFrom) ?>" autocomplete="off">
                </div>

                <!-- Date Range: To -->
                <div class="filter-group">
                    <label><?= __('To Date') ?></label>
                    <input type="text" name="date_to" id="filterDateTo" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" value="<?= h($dateTo) ?>" autocomplete="off">
                </div>

                <!-- Status Filter -->
                <div class="filter-group">
                    <label><?= __('Status') ?></label>
                    <select name="status" class="form-control">
                        <option value="2" <?= ($status === '2') ? 'selected' : '' ?>><?= __('Enquiries Only') ?></option>
                        <option value="1" <?= ($status === '1') ? 'selected' : '' ?>><?= __('Converted Members') ?></option>
                        <option value="all" <?= ($status === 'all') ? 'selected' : '' ?>><?= __('All Records') ?></option>
                    </select>
                </div>

                <!-- Actions -->
                <div style="display: flex; gap: 8px;">
                    <button type="submit" class="btn-filter-apply waves-effect">
                        <i class="material-icons" style="font-size: 16px;">search</i>
                        <?= __('Search') ?>
                    </button>
                    <a href="<?= $this->Url->build(['action' => 'enquiryList']) ?>" class="btn-filter-clear">
                        <?= __('Reset') ?>
                    </a>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>

        <!-- Table Card -->
        <div class="enq-table-card">
            <div class="table-responsive">
                <table class="enq-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?= __('Enquiry Customer') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Enquiry Date') ?></th>
                            <th><?= __('Latest Follow-up Remark') ?></th>
                            <th><?= __('Next Follow-up') ?></th>
                            <th style="text-align: center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($enquiries) && $enquiries->count() > 0): ?>
                            <?php 
                            $count = ($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage') + 1;
                            $todayStr = date('Y-m-d');
                            foreach ($enquiries as $row): 
                                $firstLetter = strtoupper(substr(trim($row->name), 0, 1));
                                
                                $statusClass = ($row->active == 1) ? 'active' : 'enquiry';
                                $statusText = ($row->active == 1) ? 'Member' : 'Enquiry';

                                // Get latest remark if any
                                $latestRemark = !empty($row->user_remarks) ? $row->user_remarks[0] : null;
                            ?>
                            <tr>
                                <td style="color: #94a3b8; font-weight: 600;"><?= $count++ ?></td>

                                <!-- User Details -->
                                <td>
                                    <div class="user-info-box">
                                        <div class="user-avatar-sm"><?= $firstLetter ?></div>
                                        <div>
                                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'view', $row->id]) ?>" class="user-name-link" target="_blank">
                                                <?= h(ucwords($row->name)) ?>
                                                <i class="material-icons" style="font-size: 14px; color: #94a3b8;">open_in_new</i>
                                            </a>
                                            <div class="user-contact-links">
                                                <?php if (!empty($row->mobile_no)): ?>
                                                    <a href="tel:<?= h($row->mobile_no) ?>" class="contact-chip" title="Call">
                                                        <i class="material-icons" style="font-size: 13px;">call</i>
                                                        <?= h($row->mobile_no) ?>
                                                    </a>
                                                    <a href="https://wa.me/91<?= preg_replace('/[^0-9]/', '', $row->mobile_no) ?>" class="contact-chip wa-chip" target="_blank" title="WhatsApp">
                                                        <i class="material-icons" style="font-size: 13px;">chat</i>
                                                        WA
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (!empty($row->email)): ?>
                                                    <span class="contact-chip" title="<?= h($row->email) ?>">
                                                        <i class="material-icons" style="font-size: 13px;">email</i>
                                                        <?= h(substr($row->email, 0, 16)) ?><?= strlen($row->email) > 16 ? '...' : '' ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Status Badge -->
                                <td>
                                    <span class="badge-status <?= $statusClass ?>">
                                        <?= $statusText ?>
                                    </span>
                                </td>

                                <!-- Enquiry Date -->
                                <td>
                                    <div style="font-weight: 600; color: #1e293b;">
                                        <?= !empty($row->created) ? $row->created->format('d M Y') : 'N/A' ?>
                                    </div>
                                    <div style="font-size: 11.5px; color: #64748b;">
                                        <?= !empty($row->created) ? $row->created->format('h:i A') : '' ?>
                                    </div>
                                </td>

                                <!-- Latest Follow-up Remark -->
                                <td>
                                    <?php if (!empty($latestRemark) && !empty($latestRemark->remark)): ?>
                                        <div class="remark-content-box">
                                            <?= nl2br(h($latestRemark->remark)) ?>
                                        </div>
                                        <div style="font-size: 11px; color: #64748b; margin-top: 4px;">
                                            Taken: <?= $latestRemark->created ? $latestRemark->created->format('d M Y') : '' ?>
                                        </div>
                                    <?php else: ?>
                                        <span style="color: #94a3b8; font-size: 12.5px; font-style: italic;">No follow-up yet</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Next Follow-up -->
                                <td>
                                    <?php if (!empty($latestRemark) && !empty($latestRemark->followup_date)): ?>
                                        <?php 
                                        $fDateYmd = $latestRemark->followup_date->format('Y-m-d');
                                        $isDueToday = ($fDateYmd === $todayStr);
                                        $isOverdue = ($fDateYmd < $todayStr);
                                        ?>
                                        <span style="display: inline-block; padding: 4px 10px; border-radius: 8px; font-size: 12px; font-weight: 700; background: <?= $isDueToday ? '#fef3c7' : ($isOverdue ? '#fee2e2' : '#e0f2fe') ?>; color: <?= $isDueToday ? '#b45309' : ($isOverdue ? '#b91c1c' : '#0369a1') ?>;">
                                            <?= $latestRemark->followup_date->format('d M Y') ?>
                                        </span>
                                    <?php else: ?>
                                        <span style="color: #94a3b8; font-size: 12px;">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Actions -->
                                <td style="text-align: center;">
                                    <div style="display: inline-flex; gap: 6px;">
                                        <button type="button" class="btn-action-round remark waves-effect" title="Add Follow-up Remark" onclick="openNewRemarkModal(<?= $row->id ?>, '<?= addslashes(h($row->name)) ?>')">
                                            <i class="material-icons" style="font-size: 16px;">add_comment</i>
                                        </button>
                                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'payment', $row->id]) ?>" class="btn-action-round pay waves-effect" title="Take Payment / Convert to Member">
                                            <i class="material-icons" style="font-size: 16px;">credit_card</i>
                                        </a>
                                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'view', $row->id]) ?>" class="btn-action-round view waves-effect" title="View Profile" target="_blank">
                                            <i class="material-icons" style="font-size: 16px;">person</i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 45px 20px; color: #94a3b8;">
                                    <i class="material-icons" style="font-size: 42px; color: #cbd5e1; display: block; margin-bottom: 8px;">search_off</i>
                                    <span style="font-size: 15px; font-weight: 600;"><?= __('No enquiries found for the selected date range or month.') ?></span>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if ($this->Paginator->total() > 1): ?>
                <div style="padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #f1f5f9; flex-wrap: wrap; gap: 10px;">
                    <div style="font-size: 13px; color: #64748b;">
                        <?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total')]) ?>
                    </div>
                    <ul class="pagination" style="margin: 0;">
                        <?= $this->Paginator->prev(__('« Previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('Next »')) ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<!-- Add Remark Modal -->
<div class="modal fade" id="addRemarkModal" tabindex="-1" role="dialog" style="z-index: 99999;">
    <div class="modal-dialog" role="document" style="max-width: 520px;">
        <div class="modal-content" style="border-radius: 14px; border: none; overflow: hidden; box-shadow: 0 10px 35px rgba(0,0,0,0.15);">
            <div class="modal-header" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); padding: 18px 24px; border-bottom: 3px solid #ff9800;">
                <h4 class="modal-title" style="color: #fff; font-size: 16px; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <i class="material-icons" style="color: #ff9800;">add_comment</i>
                    <?= __('Add Follow-up Remark for Enquiry') ?>
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px;">
                <form id="saveRemarkForm">
                    <input type="hidden" name="user_id" id="modalUserId" value="">
                    
                    <div class="form-group" style="margin-bottom: 18px;">
                        <label style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #475569;"><?= __('Customer Name') ?>:</label>
                        <div id="modalStaticUserName" style="font-weight: 700; font-size: 15px; color: #1e293b; margin-top: 4px;"></div>
                    </div>

                    <div class="form-group" style="margin-bottom: 18px;">
                        <label style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #475569;"><?= __('Follow-up Comment / Notes') ?> <span style="color:red">*</span></label>
                        <textarea name="remark" id="modalRemarkText" rows="3" class="form-control" placeholder="<?= __('Enter notes (e.g. called customer, interested in joining next week, offered 10% discount...)') ?>" required style="border: 1.5px solid #cbd5e1; border-radius: 8px; padding: 10px 12px; font-size: 13.5px;"></textarea>
                    </div>

                    <div class="form-group" style="margin-bottom: 10px;">
                        <label style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #475569;"><?= __('Next Follow-up Date (Optional)') ?></label>
                        <input type="text" name="followup_date" id="modalFollowupDate" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" autocomplete="off" style="border: 1.5px solid #cbd5e1; border-radius: 8px; height: 42px; padding: 8px 12px; font-size: 13.5px;">
                    </div>
                </form>
                <div id="modalRemarkMsg" style="display: none; margin-top: 10px;"></div>
            </div>
            <div class="modal-footer" style="padding: 14px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="border-radius: 8px;"><?= __('Cancel') ?></button>
                <button type="button" class="btn btn-warning waves-effect" id="btnSubmitRemark" onclick="submitModalRemark()" style="background: #ff9800 !important; color: #fff !important; font-weight: 700; border-radius: 8px; padding: 8px 20px;">
                    <i class="material-icons" style="font-size: 16px; vertical-align: middle;">save</i>
                    <?= __('Save Follow-up') ?>
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function handleMonthChange(val) {
    if (!val) return;
    var dFrom = '', dTo = '';
    var now = new Date();
    
    if (val === 'current') {
        var y = now.getFullYear();
        var m = String(now.getMonth() + 1).padStart(2, '0');
        var lastDay = new Date(y, now.getMonth() + 1, 0).getDate();
        dFrom = y + '-' + m + '-01';
        dTo = y + '-' + m + '-' + String(lastDay).padStart(2, '0');
    } else if (val === 'last') {
        var prev = new Date(now.getFullYear(), now.getMonth() - 1, 1);
        var y = prev.getFullYear();
        var m = String(prev.getMonth() + 1).padStart(2, '0');
        var lastDay = new Date(y, prev.getMonth() + 1, 0).getDate();
        dFrom = y + '-' + m + '-01';
        dTo = y + '-' + m + '-' + String(lastDay).padStart(2, '0');
    } else if (val.indexOf('-') > -1) {
        var parts = val.split('-');
        var y = parseInt(parts[0], 10);
        var m = parseInt(parts[1], 10);
        var lastDay = new Date(y, m, 0).getDate();
        dFrom = val + '-01';
        dTo = val + '-' + String(lastDay).padStart(2, '0');
    }

    if (dFrom && dTo) {
        $('#filterDateFrom').val(dFrom);
        $('#filterDateTo').val(dTo);
        if (typeof flatpickr !== 'undefined') {
            if ($('#filterDateFrom')[0]._flatpickr) $('#filterDateFrom')[0]._flatpickr.setDate(dFrom);
            if ($('#filterDateTo')[0]._flatpickr) $('#filterDateTo')[0]._flatpickr.setDate(dTo);
        }
    }
}

function openNewRemarkModal(userId, userName) {
    $('#modalRemarkMsg').hide().empty();
    $('#modalRemarkText').val('');
    $('#modalFollowupDate').val('');
    $('#modalUserId').val(userId);
    $('#modalStaticUserName').text(userName);
    $('#addRemarkModal').modal('show');
}

function submitModalRemark() {
    var userId = $('#modalUserId').val();
    var remark = $('#modalRemarkText').val().trim();
    var fDate = $('#modalFollowupDate').val().trim();

    if (!userId) {
        alert('Please select a user.');
        return;
    }
    if (!remark) {
        alert('Please enter follow-up comment notes.');
        $('#modalRemarkText').focus();
        return;
    }

    var $btn = $('#btnSubmitRemark');
    $btn.prop('disabled', true).text('Saving...');

    $.ajax({
        url: '<?= $this->Url->build(['controller' => 'Users', 'action' => 'saveRemark']) ?>',
        type: 'POST',
        dataType: 'json',
        data: {
            user_id: userId,
            remark: remark,
            followup_date: fDate
        },
        success: function(res) {
            $btn.prop('disabled', false).html('<i class="material-icons" style="font-size: 16px; vertical-align: middle;">save</i> Save Follow-up');
            if (res.status === 'success') {
                $('#modalRemarkMsg').html('<div class="alert alert-success" style="padding: 8px 12px; border-radius: 6px;">Follow-up saved successfully!</div>').show();
                setTimeout(function() {
                    $('#addRemarkModal').modal('hide');
                    window.location.reload();
                }, 800);
            } else {
                $('#modalRemarkMsg').html('<div class="alert alert-danger" style="padding: 8px 12px; border-radius: 6px;">' + (res.message || 'Error saving remark.') + '</div>').show();
            }
        },
        error: function() {
            $btn.prop('disabled', false).html('<i class="material-icons" style="font-size: 16px; vertical-align: middle;">save</i> Save Follow-up');
            $('#modalRemarkMsg').html('<div class="alert alert-danger" style="padding: 8px 12px; border-radius: 6px;">Network or server error.</div>').show();
        }
    });
}

$(document).ready(function() {
    if (typeof flatpickr !== 'undefined') {
        flatpickr('.flatpickr-date', {
            dateFormat: 'Y-m-d',
            allowInput: true,
            monthSelectorType: 'dropdown',
            static: false
        });
    }
});
</script>
