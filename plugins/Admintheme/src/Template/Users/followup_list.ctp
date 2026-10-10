<?php
$user_type = $this->Common->getType();
?>
<section class="content" style="padding-top: 15px;">
    <div class="container-fluid" style="max-width: 100%; box-sizing: border-box;">
        
        <?= $this->Flash->render() ?>

        <style>
            /* ── Header ── */
            .fol-header {
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
            .fol-header-left {
                display: flex;
                align-items: center;
                gap: 14px;
            }
            .fol-header-icon {
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
            .fol-header h2 {
                color: #ffffff;
                font-size: 20px;
                font-weight: 700;
                margin: 0 0 4px 0;
                letter-spacing: -0.3px;
            }
            .fol-header p {
                color: #94a3b8;
                font-size: 13px;
                margin: 0;
            }
            .btn-add-remark-main {
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
                cursor: pointer;
                box-shadow: 0 4px 14px rgba(255,152,0,0.35);
                transition: all 0.2s ease;
            }
            .btn-add-remark-main:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(255,152,0,0.45);
            }

            /* ── Tabs & Metrics ── */
            .fol-tabs {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-bottom: 20px;
            }
            .fol-tab {
                background: #ffffff;
                border: 1.5px solid #e2e8f0;
                border-radius: 12px;
                padding: 10px 18px;
                display: flex;
                align-items: center;
                gap: 10px;
                text-decoration: none !important;
                color: #475569;
                font-size: 13px;
                font-weight: 600;
                transition: all 0.2s ease;
                box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            }
            .fol-tab:hover {
                border-color: #cbd5e1;
                color: #1e293b;
            }
            .fol-tab.active {
                background: #ff9800;
                border-color: #f57c00;
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(255,152,0,0.3);
            }
            .fol-tab .tab-badge {
                padding: 2px 8px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 700;
                background: #f1f5f9;
                color: #334155;
            }
            .fol-tab.active .tab-badge {
                background: #ffffff;
                color: #e65100;
            }

            /* ── Filter Card ── */
            .fol-filter-card {
                background: #ffffff;
                border: 1px solid #edf2f7;
                border-radius: 14px;
                padding: 20px 24px;
                margin-bottom: 24px;
                box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            }
            .fol-filter-grid {
                display: grid;
                grid-template-columns: 2fr 1fr 1fr 1fr 1fr auto;
                gap: 14px;
                align-items: flex-end;
            }
            @media (max-width: 1100px) {
                .fol-filter-grid {
                    grid-template-columns: 1fr 1fr 1fr;
                }
            }
            @media (max-width: 700px) {
                .fol-filter-grid {
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
            .fol-table-card {
                background: #ffffff;
                border-radius: 14px;
                border: 1px solid #edf2f7;
                box-shadow: 0 6px 24px rgba(0,0,0,0.04);
                overflow: hidden;
            }
            .fol-table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }
            .fol-table thead th {
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
            .fol-table tbody td {
                padding: 16px 18px;
                border-bottom: 1px solid #f1f5f9;
                vertical-align: middle;
                font-size: 13.5px;
                color: #1e293b;
            }
            .fol-table tbody tr:hover {
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
            .badge-status.inactive {
                background: #fee2e2;
                color: #b91c1c;
            }

            /* Remarks Box */
            .remark-content-box {
                background: #f8fafc;
                border-left: 3.5px solid #ff9800;
                border-radius: 6px;
                padding: 10px 14px;
                font-size: 13.5px;
                color: #334155;
                line-height: 1.45;
                max-width: 380px;
                word-break: break-word;
            }
            .remark-caller {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 12px;
                font-weight: 600;
                color: #64748b;
                margin-top: 6px;
            }

            /* Next Followup Pill */
            .next-followup-pill {
                display: inline-flex;
                flex-direction: column;
                gap: 2px;
            }
            .next-date-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 8px;
                font-size: 12px;
                font-weight: 700;
            }
            .next-date-badge.due-today {
                background: #fef3c7;
                color: #b45309;
                border: 1px solid #fde68a;
            }
            .next-date-badge.upcoming {
                background: #e0f2fe;
                color: #0369a1;
                border: 1px solid #bae6fd;
            }
            .next-date-badge.overdue {
                background: #fee2e2;
                color: #b91c1c;
                border: 1px solid #fca5a5;
            }
            .next-date-badge.none {
                background: #f1f5f9;
                color: #94a3b8;
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
            .btn-action-round.view {
                background: #0284c7;
            }
            .btn-action-round.view:hover {
                background: #0369a1;
            }
        </style>

        <!-- Header -->
        <div class="fol-header">
            <div class="fol-header-left">
                <div class="fol-header-icon">
                    <i class="material-icons" style="font-size: 26px;">phone_callback</i>
                </div>
                <div>
                    <h2><?= __('Follow-up Management & User Logs') ?></h2>
                    <p><?= __('Unified user-wise follow-up list, caller history, remarks, and scheduled actions') ?></p>
                </div>
            </div>
            <div>
                <button type="button" class="btn-add-remark-main" onclick="openNewRemarkModal(null, '')">
                    <i class="material-icons" style="font-size: 18px;">add_comment</i>
                    <?= __('+ New Follow-up') ?>
                </button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="fol-tabs">
            <a href="<?= $this->Url->build(['action' => 'followupList', '?' => array_merge($this->request->query, ['tab' => 'all'])]) ?>" class="fol-tab <?= ($tab === 'all') ? 'active' : '' ?>">
                <i class="material-icons" style="font-size: 18px;">format_list_bulleted</i>
                <span><?= __('All Follow-ups') ?></span>
                <span class="tab-badge"><?= $countAll ?></span>
            </a>
            <a href="<?= $this->Url->build(['action' => 'followupList', '?' => array_merge($this->request->query, ['tab' => 'today_due'])]) ?>" class="fol-tab <?= ($tab === 'today_due') ? 'active' : '' ?>">
                <i class="material-icons" style="font-size: 18px;">notifications_active</i>
                <span><?= __('Due Today') ?></span>
                <span class="tab-badge"><?= $countTodayDue ?></span>
            </a>
            <a href="<?= $this->Url->build(['action' => 'followupList', '?' => array_merge($this->request->query, ['tab' => 'today_taken'])]) ?>" class="fol-tab <?= ($tab === 'today_taken') ? 'active' : '' ?>">
                <i class="material-icons" style="font-size: 18px;">done_all</i>
                <span><?= __('Taken Today') ?></span>
                <span class="tab-badge"><?= $countTodayTaken ?></span>
            </a>
            <a href="<?= $this->Url->build(['action' => 'followupList', '?' => array_merge($this->request->query, ['tab' => 'upcoming'])]) ?>" class="fol-tab <?= ($tab === 'upcoming') ? 'active' : '' ?>">
                <i class="material-icons" style="font-size: 18px;">calendar_today</i>
                <span><?= __('Upcoming') ?></span>
                <span class="tab-badge"><?= $countUpcoming ?></span>
            </a>
            <a href="<?= $this->Url->build(['action' => 'followupList', '?' => array_merge($this->request->query, ['tab' => 'overdue'])]) ?>" class="fol-tab <?= ($tab === 'overdue') ? 'active' : '' ?>">
                <i class="material-icons" style="font-size: 18px;">error_outline</i>
                <span><?= __('Overdue') ?></span>
                <span class="tab-badge"><?= $countOverdue ?></span>
            </a>
        </div>

        <!-- Filter Card -->
        <div class="fol-filter-card">
            <?= $this->Form->create(null, ['type' => 'get', 'id' => 'folFilterForm']) ?>
            <?= $this->Form->hidden('tab', ['value' => $tab]) ?>
            <div class="fol-filter-grid" style="grid-template-columns: 1.5fr 1.2fr 1.2fr 1.2fr 1fr auto;">
                <!-- Search text -->
                <div class="filter-group">
                    <label><?= __('Search User / Mobile / Remark') ?></label>
                    <input type="text" name="search" class="form-control" placeholder="<?= __('Search by name, mobile, remark...') ?>" value="<?= h($search) ?>">
                </div>

                <!-- Single Date Quick Picker -->
                <div class="filter-group">
                    <label><?= __('Select Date') ?></label>
                    <input type="text" name="date" id="singleDatePicker" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" value="<?= h($singleDate ?? '') ?>" autocomplete="off" onchange="$('#folFilterForm').submit();">
                </div>

                <!-- Date Range: From (Optional) -->
                <div class="filter-group">
                    <label><?= __('From Date (Range)') ?></label>
                    <input type="text" name="date_from" id="dateFromInput" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" value="<?= h($dateFrom) ?>" autocomplete="off">
                </div>

                <!-- Date Range: To (Optional) -->
                <div class="filter-group">
                    <label><?= __('To Date (Range)') ?></label>
                    <input type="text" name="date_to" id="dateToInput" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" value="<?= h($dateTo) ?>" autocomplete="off">
                </div>

                <!-- Staff Filter -->
                <div class="filter-group">
                    <label><?= __('Staff / Caller') ?></label>
                    <select name="staff_id" class="form-control select2">
                        <option value=""><?= __('-- All Staff --') ?></option>
                        <?php foreach ($staffList as $sId => $sName): ?>
                            <option value="<?= $sId ?>" <?= ($staffFilter == $sId) ? 'selected' : '' ?>><?= h($sName) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Actions -->
                <div style="display: flex; gap: 8px;">
                    <button type="submit" class="btn-filter-apply waves-effect">
                        <i class="material-icons" style="font-size: 16px;">search</i>
                        <?= __('Search') ?>
                    </button>
                    <a href="<?= $this->Url->build(['action' => 'followupList', '?' => ['tab' => $tab]]) ?>" class="btn-filter-clear">
                        <?= __('Reset') ?>
                    </a>
                </div>
            </div>

            <!-- Quick Date Chips -->
            <div style="display: flex; align-items: center; gap: 8px; margin-top: 14px; padding-top: 12px; border-top: 1px solid #f1f5f9; flex-wrap: wrap;">
                <span style="font-size: 11.5px; font-weight: 700; color: #64748b; text-transform: uppercase;"><?= __('Quick Date Filters:') ?></span>
                <button type="button" class="btn btn-xs waves-effect" onclick="setQuickDate('<?= date('Y-m-d') ?>')" style="background:#e0f2fe; color:#0369a1; border-radius:15px; font-weight:600; padding:4px 12px;">
                    <?= __('Today (' . date('d M') . ')') ?>
                </button>
                <button type="button" class="btn btn-xs waves-effect" onclick="setQuickDate('<?= date('Y-m-d', strtotime('-1 day')) ?>')" style="background:#f1f5f9; color:#475569; border-radius:15px; font-weight:600; padding:4px 12px;">
                    <?= __('Yesterday') ?>
                </button>
                <button type="button" class="btn btn-xs waves-effect" onclick="setQuickRange('<?= date('Y-m-01') ?>', '<?= date('Y-m-t') ?>')" style="background:#fef3c7; color:#92400e; border-radius:15px; font-weight:600; padding:4px 12px;">
                    <?= __('This Month (' . date('M Y') . ')') ?>
                </button>
            </div>
            <?= $this->Form->end() ?>
        </div>

        <!-- Table Card -->
        <div class="fol-table-card">
            <div class="table-responsive">
                <table class="fol-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?= __('Member / Enquiry User') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Follow-up Taken Date') ?></th>
                            <th><?= __('Staff / Caller') ?></th>
                            <th><?= __('Comment / Remark Note') ?></th>
                            <th><?= __('Next Follow-up Date') ?></th>
                            <th style="text-align: center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($followups) && $followups->count() > 0): ?>
                            <?php 
                            $count = ($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage') + 1;
                            $todayStr = date('Y-m-d');
                            foreach ($followups as $row): 
                                $user = $row->user;
                                if (empty($user)) continue;
                                $firstLetter = strtoupper(substr(trim($user->name), 0, 1));
                                
                                // User Status text
                                $statusClass = 'inactive';
                                $statusText = 'Inactive';
                                if ($user->active == 1) {
                                    $statusClass = 'active';
                                    $statusText = 'Member';
                                } elseif ($user->active == 2) {
                                    $statusClass = 'enquiry';
                                    $statusText = 'Enquiry';
                                }

                                // Staff name
                                $staffName = 'Admin';
                                if (!empty($row->created_by_user) && !empty($row->created_by_user->name)) {
                                    $staffName = $row->created_by_user->name;
                                }

                                // Next Follow-up status
                                $nextDateBadgeClass = 'none';
                                $nextDateText = 'No date';
                                if (!empty($row->followup_date)) {
                                    $nextYmd = $row->followup_date->format('Y-m-d');
                                    if ($nextYmd === $todayStr) {
                                        $nextDateBadgeClass = 'due-today';
                                        $nextDateText = 'Today • ' . $row->followup_date->format('d M Y');
                                    } elseif ($nextYmd > $todayStr) {
                                        $nextDateBadgeClass = 'upcoming';
                                        $nextDateText = $row->followup_date->format('d M Y');
                                    } else {
                                        $nextDateBadgeClass = 'overdue';
                                        $nextDateText = 'Overdue • ' . $row->followup_date->format('d M Y');
                                    }
                                }
                            ?>
                            <tr>
                                <td style="color: #94a3b8; font-weight: 600;"><?= $count++ ?></td>

                                <!-- User Details -->
                                <td>
                                    <div class="user-info-box">
                                        <div class="user-avatar-sm"><?= $firstLetter ?></div>
                                        <div>
                                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'view', $user->id]) ?>" class="user-name-link" target="_blank">
                                                <?= h(ucwords($user->name)) ?>
                                                <i class="material-icons" style="font-size: 14px; color: #94a3b8;">open_in_new</i>
                                            </a>
                                            <div class="user-contact-links">
                                                <?php if (!empty($user->mobile_no)): ?>
                                                    <a href="tel:<?= h($user->mobile_no) ?>" class="contact-chip" title="Call">
                                                        <i class="material-icons" style="font-size: 13px;">call</i>
                                                        <?= h($user->mobile_no) ?>
                                                    </a>
                                                    <a href="https://wa.me/91<?= preg_replace('/[^0-9]/', '', $user->mobile_no) ?>" class="contact-chip wa-chip" target="_blank" title="WhatsApp Message">
                                                        <i class="material-icons" style="font-size: 13px;">chat</i>
                                                        WA
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (!empty($user->email)): ?>
                                                    <span class="contact-chip" title="<?= h($user->email) ?>">
                                                        <i class="material-icons" style="font-size: 13px;">email</i>
                                                        <?= h(substr($user->email, 0, 16)) ?><?= strlen($user->email) > 16 ? '...' : '' ?>
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

                                <!-- Taken Date -->
                                <td>
                                    <div style="font-weight: 600; color: #1e293b;">
                                        <?= !empty($row->created) ? $row->created->format('d M Y') : 'N/A' ?>
                                    </div>
                                    <div style="font-size: 11.5px; color: #64748b;">
                                        <?= !empty($row->created) ? $row->created->format('h:i A') : '' ?>
                                    </div>
                                </td>

                                <!-- Staff Caller -->
                                <td>
                                    <div style="display: flex; align-items: center; gap: 6px;">
                                        <i class="material-icons" style="font-size: 16px; color: #ff9800;">badge</i>
                                        <span style="font-weight: 600; color: #334155;"><?= h(ucwords($staffName)) ?></span>
                                    </div>
                                </td>

                                <!-- Remark Note -->
                                <td>
                                    <div class="remark-content-box">
                                        <?= nl2br(h($row->remark)) ?>
                                    </div>
                                </td>

                                <!-- Next Followup Date -->
                                <td>
                                    <div class="next-followup-pill">
                                        <span class="next-date-badge <?= $nextDateBadgeClass ?>">
                                            <i class="material-icons" style="font-size: 14px;">event</i>
                                            <?= $nextDateText ?>
                                        </span>
                                    </div>
                                </td>

                                <!-- Action Buttons -->
                                <td style="text-align: center;">
                                    <div style="display: inline-flex; gap: 6px;">
                                        <button type="button" class="btn-action-round remark waves-effect" title="Add Next Follow-up Remark" onclick="openNewRemarkModal(<?= $user->id ?>, '<?= addslashes(h($user->name)) ?>')">
                                            <i class="material-icons" style="font-size: 16px;">add_comment</i>
                                        </button>
                                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'view', $user->id]) ?>" class="btn-action-round view waves-effect" title="View Full Profile" target="_blank">
                                            <i class="material-icons" style="font-size: 16px;">person</i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" style="text-align: center; padding: 45px 20px; color: #94a3b8;">
                                    <i class="material-icons" style="font-size: 42px; color: #cbd5e1; display: block; margin-bottom: 8px;">speaker_notes_off</i>
                                    <span style="font-size: 15px; font-weight: 600;"><?= __('No follow-up records found matching this filter.') ?></span>
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
                    <?= __('Record New Follow-up Remark') ?>
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px;">
                <form id="saveRemarkForm">
                    <input type="hidden" name="user_id" id="modalUserId" value="">
                    
                    <div class="form-group" id="modalUserSelectGroup" style="margin-bottom: 18px;">
                        <label style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #475569;"><?= __('Target User / Member') ?> <span style="color:red">*</span></label>
                        <div id="modalStaticUserName" style="font-weight: 700; font-size: 15px; color: #1e293b; margin-top: 4px; display: none;"></div>
                    </div>

                    <div class="form-group" style="margin-bottom: 18px;">
                        <label style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #475569;"><?= __('Follow-up Comment / Notes') ?> <span style="color:red">*</span></label>
                        <textarea name="remark" id="modalRemarkText" rows="3" class="form-control" placeholder="<?= __('Enter notes (e.g. called member, discussed renewal discount, interested in 12 month plan...)') ?>" required style="border: 1.5px solid #cbd5e1; border-radius: 8px; padding: 10px 12px; font-size: 13.5px;"></textarea>
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
function openNewRemarkModal(userId, userName) {
    $('#modalRemarkMsg').hide().empty();
    $('#modalRemarkText').val('');
    $('#modalFollowupDate').val('');
    
    if (userId) {
        $('#modalUserId').val(userId);
        $('#modalStaticUserName').text(userName).show();
        $('#modalUserSelectGroup label').text('Member / Enquiry:');
    } else {
        alert('Please click "+ Follow-up" on a specific user row to add their follow-up.');
        return;
    }

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

function setQuickDate(dt) {
    $('#singleDatePicker').val(dt);
    $('#dateFromInput').val('');
    $('#dateToInput').val('');
    $('#folFilterForm').submit();
}

function setQuickRange(d1, d2) {
    $('#singleDatePicker').val('');
    $('#dateFromInput').val(d1);
    $('#dateToInput').val(d2);
    $('#folFilterForm').submit();
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

    if ($.fn.select2) {
        $('.select2').select2({
            width: '100%'
        });
    }
});
</script>
