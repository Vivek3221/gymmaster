<?php
$user_type_labels = $this->Common->getType();
$nofrec = $this->Common->getNoOfRec();
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
    /* Expired Users Page Styling */
    .expired-page-container {
        padding-bottom: 40px;
    }
    
    /* Stats Cards Grid */
    .stats-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }
    .stat-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 22px 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
    }
    .stat-card-info h4 {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin: 0 0 6px 0;
    }
    .stat-card-info .stat-number {
        font-size: 28px;
        font-weight: 800;
        margin: 0;
        line-height: 1;
    }
    .stat-card-icon {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
    }
    .stat-card-expired {
        border-left: 5px solid #ef4444;
    }
    .stat-card-expired .stat-number { color: #dc2626; }
    .stat-card-expired .stat-card-icon { background: #fee2e2; color: #dc2626; }

    .stat-card-expiring {
        border-left: 5px solid #f59e0b;
    }
    .stat-card-expiring .stat-number { color: #d97706; }
    .stat-card-expiring .stat-card-icon { background: #fef3c7; color: #d97706; }

    .stat-card-total {
        border-left: 5px solid #6366f1;
    }
    .stat-card-total .stat-number { color: #4f46e5; }
    .stat-card-total .stat-card-icon { background: #e0e7ff; color: #4f46e5; }

    /* Filter Card */
    .filter-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 22px 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #f1f5f9;
        margin-bottom: 25px;
    }
    .filter-card-header {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .filter-card-header i {
        color: #f59e0b;
    }
    .filter-form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
        gap: 16px;
        align-items: end;
    }
    .filter-field {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .filter-field label {
        font-size: 12.5px;
        font-weight: 600;
        color: #475569;
        margin: 0;
    }
    .filter-field .form-control {
        border-radius: 8px !important;
        border: 1.5px solid #cbd5e1 !important;
        padding: 9px 12px !important;
        height: 42px !important;
        font-size: 13.5px !important;
        background-color: #fafafa !important;
        color: #1e293b !important;
        box-shadow: none !important;
        transition: all 0.2s ease;
    }
    .filter-field .form-control:focus {
        border-color: #f59e0b !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15) !important;
    }
    .filter-buttons {
        display: flex;
        gap: 10px;
        grid-column: span 2;
        margin-top: 4px;
    }
    @media (max-width: 768px) {
        .filter-buttons { grid-column: span 1; }
    }
    .btn-search {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
        color: #ffffff !important;
        border-radius: 8px !important;
        padding: 10px 22px !important;
        font-weight: 600 !important;
        font-size: 13.5px !important;
        border: none !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3) !important;
    }
    .btn-search:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(245, 158, 11, 0.4) !important;
    }
    .btn-reset {
        background: #f1f5f9 !important;
        color: #475569 !important;
        border-radius: 8px !important;
        padding: 10px 18px !important;
        font-weight: 600 !important;
        font-size: 13.5px !important;
        border: 1px solid #cbd5e1 !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none !important;
    }
    .btn-reset:hover {
        background: #e2e8f0 !important;
        color: #1e293b !important;
    }

    /* Main Table Card */
    .table-card {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #f1f5f9;
        overflow: hidden;
    }
    .table-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .table-card-header h3 {
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Custom Table Styling */
    .custom-expired-table {
        width: 100%;
        border-collapse: collapse;
    }
    .custom-expired-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 18px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }
    .custom-expired-table td {
        padding: 16px 18px;
        font-size: 13.5px;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    .custom-expired-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Badges */
    .badge-expired {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .badge-expiring-soon {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* Action Buttons */
    .btn-act {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff !important;
        font-size: 16px;
        transition: transform 0.15s ease;
        margin-right: 4px;
        text-decoration: none !important;
    }
    .btn-act:hover {
        transform: scale(1.08);
    }
    .btn-act-view { background-color: #0ea5e9; }
    .btn-act-edit { background-color: #6366f1; }
    .btn-act-pay { background-color: #10b981; }

    /* Custom Pagination */
    .pagination-bar {
        padding: 18px 24px;
        background: #ffffff;
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .pagination-info {
        font-size: 13px;
        color: #64748b;
    }
    .pagination-links {
        display: flex;
        gap: 6px;
    }
    .page-link-btn {
        padding: 6px 14px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #334155;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .page-link-btn:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
    }
    .page-link-btn.active {
        background: #f59e0b;
        color: #ffffff;
        border-color: #f59e0b;
        font-weight: 600;
    }
</style>

<section class="content expired-page-container">
    <div class="container-fluid">
        <?= $this->Flash->render() ?>

        <!-- Stats Cards Grid -->
        <div class="stats-cards-grid">
            <div class="stat-card stat-card-expired">
                <div class="stat-card-info">
                    <h4><?= __('Total Expired') ?></h4>
                    <div class="stat-number"><?= number_format($totalExpiredCount) ?></div>
                </div>
                <div class="stat-card-icon">
                    <i class="material-icons">event_busy</i>
                </div>
            </div>

            <div class="stat-card stat-card-expiring">
                <div class="stat-card-info">
                    <h4><?= __('Expiring Soon / In Range') ?></h4>
                    <div class="stat-number"><?= number_format($totalExpiringSoonCount) ?></div>
                </div>
                <div class="stat-card-icon">
                    <i class="material-icons">hourglass_bottom</i>
                </div>
            </div>

            <div class="stat-card stat-card-total">
                <div class="stat-card-info">
                    <h4><?= __('Filtered Members') ?></h4>
                    <div class="stat-number"><?= number_format($totalRecords) ?></div>
                </div>
                <div class="stat-card-icon">
                    <i class="material-icons">group</i>
                </div>
            </div>
        </div>

        <!-- Filter & Search Card -->
        <div class="filter-card">
            <div class="filter-card-header">
                <i class="material-icons">filter_alt</i>
                <span><?= __('Filter & Search Expired Members') ?></span>
            </div>
            
            <form method="get" action="<?= $this->Url->build(['controller' => 'Users', 'action' => 'expiredUsers']) ?>">
                <div class="filter-form-grid">
                    <div class="filter-field">
                        <label><?= __('User Name') ?></label>
                        <input type="text" name="name" class="form-control" value="<?= h($name) ?>" placeholder="<?= __('Enter Name') ?>">
                    </div>

                    <div class="filter-field">
                        <label><?= __('Email') ?></label>
                        <input type="text" name="email" class="form-control" value="<?= h($email) ?>" placeholder="<?= __('Enter Email') ?>">
                    </div>

                    <div class="filter-field">
                        <label><?= __('Mobile No') ?></label>
                        <input type="text" name="mobile" class="form-control" value="<?= h($mobile) ?>" placeholder="<?= __('Enter Mobile') ?>">
                    </div>

                    <div class="filter-field">
                        <label><?= __('Expiry Status Filter') ?></label>
                        <select name="filter_type" class="form-control">
                            <option value="all" <?= ($filter_type === 'all') ? 'selected' : '' ?>><?= __('All (Expired & Expiring Soon)') ?></option>
                            <option value="expired" <?= ($filter_type === 'expired') ? 'selected' : '' ?>><?= __('Already Expired') ?></option>
                            <option value="expiring_soon" <?= ($filter_type === 'expiring_soon') ? 'selected' : '' ?>><?= __('Expiring Soon (Upcoming)') ?></option>
                        </select>
                    </div>

                    <div class="filter-field">
                        <label><?= __('Expiry Start Date') ?></label>
                        <input type="text" id="startDate" name="start_date" class="form-control flatpickr-input" value="<?= h($start_date) ?>" placeholder="YYYY-MM-DD" autocomplete="off">
                    </div>

                    <div class="filter-field">
                        <label><?= __('Expiry End Date') ?></label>
                        <input type="text" id="endDate" name="end_date" class="form-control flatpickr-input" value="<?= h($end_date) ?>" placeholder="YYYY-MM-DD" autocomplete="off">
                    </div>

                    <?php if (isset($users_type) && ($users_type == 1 || $users_type == 2)) { ?>
                        <div class="filter-field">
                            <label><?= __('Front Desk') ?></label>
                            <select name="front_desk_id" class="form-control">
                                <option value=""><?= __('All Front Desk') ?></option>
                                <?php foreach ($frontDeskUsers as $fdId => $fdName) { ?>
                                    <option value="<?= $fdId ?>" <?= ($front_desk_id == $fdId) ? 'selected' : '' ?>><?= h($fdName) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>

                    <div class="filter-field">
                        <label><?= __('Records Per Page') ?></label>
                        <select name="norec" class="form-control">
                            <?php foreach ($nofrec as $k => $v) { ?>
                                <option value="<?= $k ?>" <?= ($norec == $k) ? 'selected' : '' ?>><?= $v ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="filter-buttons">
                        <button type="submit" class="btn-search">
                            <i class="material-icons" style="font-size:16px;">search</i>
                            <?= __('Search & Filter') ?>
                        </button>
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'expiredUsers']) ?>" class="btn-reset">
                            <i class="material-icons" style="font-size:16px;">restart_alt</i>
                            <?= __('Clear') ?>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Data Table Card -->
        <div class="table-card">
            <div class="table-card-header">
                <h3>
                    <i class="material-icons" style="color:#ef4444;">timer_off</i>
                    <?= __('Expired / Expiring Members List') ?>
                </h3>
                <div>
                    <span style="font-size:13px;color:#64748b;font-weight:500;">
                        <?= __('Showing ') . count($pagedUsers) . __(' of ') . $totalRecords . __(' members') ?>
                    </span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="custom-expired-table">
                    <thead>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Mobile No') ?></th>
                            <th><?= __('Added By') ?></th>
                            <th><?= __('Plan Name') ?></th>
                            <th><?= __('Expiry Date') ?></th>
                            <th><?= __('Expiry Status') ?></th>
                            <th style="text-align:center;"><?= __('Action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pagedUsers)) { ?>
                            <?php foreach ($pagedUsers as $user) { ?>
                                <?php
                                    $expDate = !empty($user->latest_plan->plan_expire_date) ? $user->latest_plan->plan_expire_date : null;
                                    $expDateStr = $expDate ? $expDate->format('d M Y') : 'N/A';
                                    $todayTs = strtotime(date('Y-m-d'));
                                    $expTs = $expDate ? strtotime($expDate->format('Y-m-d')) : 0;
                                    $diffDays = round(($expTs - $todayTs) / 86400);
                                ?>
                                <tr>
                                    <td>
                                        <div style="font-weight: 600; color: #0f172a;"><?= ucfirst(h($user->name)) ?></div>
                                    </td>
                                    <td><?= h($user->email) ?></td>
                                    <td><?= h($user->mobile_no) ?></td>
                                    <td>
                                        <?php
                                        if (!empty($user->added_by_user)) {
                                            echo h($user->added_by_user->name);
                                        } elseif (!empty($user->added_by)) {
                                            echo h($this->Common->getSimpleName($user->added_by));
                                        } else {
                                            echo '<span style="color:#94a3b8;font-size:12px;font-style:italic;">Admin/Partner</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <span style="font-weight: 600; color: #4f46e5;">
                                            <?= h($user->latest_plan->plan_name ?? 'N/A') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <strong style="color:#1e293b;"><?= $expDateStr ?></strong>
                                    </td>
                                    <td>
                                        <?php if ($user->is_expired) { ?>
                                            <span class="badge-expired">
                                                <i class="material-icons" style="font-size:14px;">error_outline</i>
                                                <?= __('Expired ') . abs($diffDays) . __(' days ago') ?>
                                            </span>
                                        <?php } else { ?>
                                            <span class="badge-expiring-soon">
                                                <i class="material-icons" style="font-size:14px;">access_time</i>
                                                <?= __('Expiring in ') . $diffDays . __(' days') ?>
                                            </span>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align:center; white-space:nowrap;">
                                        <a href="<?= $this->Url->build(['action' => 'view', $user->id]) ?>" class="btn-act btn-act-view" title="<?= __('View User') ?>">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="<?= $this->Url->build(['action' => 'edit', $user->id]) ?>" class="btn-act btn-act-edit" title="<?= __('Edit User') ?>">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="<?= $this->Url->build(['action' => 'payment', $user->id]) ?>" class="btn-act btn-act-pay" title="<?= __('Renew / Pay') ?>">
                                            <i class="material-icons">payment</i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="8" style="text-align:center; padding: 40px; color: #94a3b8;">
                                    <i class="material-icons" style="font-size: 48px; color: #cbd5e1; display: block; margin-bottom: 8px;">search_off</i>
                                    <strong><?= __('No expired or expiring members found matching your search criteria.') ?></strong>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            <?php if ($totalPages > 1) { ?>
                <div class="pagination-bar">
                    <div class="pagination-info">
                        <?= __('Page ') . $page . __(' of ') . $totalPages ?>
                    </div>
                    <div class="pagination-links">
                        <?php
                            $queryParams = $this->request->query;
                            for ($p = 1; $p <= $totalPages; $p++) {
                                $linkParams = array_merge($queryParams, ['page' => $p]);
                                $linkUrl = $this->Url->build(['action' => 'expiredUsers', '?' => $linkParams]);
                                $activeClass = ($p == $page) ? 'active' : '';
                                echo '<a href="' . $linkUrl . '" class="page-link-btn ' . $activeClass . '">' . $p . '</a>';
                            }
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    if (typeof flatpickr !== 'undefined') {
        flatpickr("#startDate, #endDate", {
            dateFormat: "Y-m-d",
            allowInput: true
        });
    }
});
</script>
