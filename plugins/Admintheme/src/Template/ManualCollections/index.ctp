<?php
$statu = $this->Common->getUserStatus();
$nofrec = $this->Common->getNoOfRec();
$user_type_options = $this->Common->getType();
?>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <style>
            /* Modern Filter Section */
            .filter-card {
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
                padding: 14px 20px !important;
                margin-bottom: 20px !important;
                border: 1px solid #eaeaea;
            }
            .filter-card-title {
                font-size: 15px !important;
                font-weight: 600;
                color: #333;
                margin-bottom: 12px !important;
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .filter-card-title i {
                color: #ff9800;
                vertical-align: middle;
            }
            .filter-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 12px 16px !important;
            }
            @media (max-width: 768px) {
                .filter-grid {
                    grid-template-columns: 1fr;
                }
            }
            .filter-group {
                margin-bottom: 0 !important;
            }
            .filter-group label {
                font-weight: 600;
                font-size: 12px !important;
                color: #555;
                margin-bottom: 5px !important;
                display: block;
            }
            .filter-group .form-control {
                border-radius: 6px !important;
                border: 1px solid #dcdcdc !important;
                padding: 6px 12px !important;
                height: 34px !important;
                font-size: 13px !important;
                box-shadow: none !important;
                transition: all 0.3s ease;
                background-color: #fafafa;
            }
            .filter-group .form-control:focus {
                border-color: #ff9800 !important;
                background-color: #fff;
                box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
            }
            .filter-actions {
                display: flex;
                gap: 8px;
                margin-top: 5px !important;
                grid-column: 1 / -1;
                justify-content: flex-end;
            }
            .filter-actions .btn {
                border-radius: 6px !important;
                padding: 6px 16px !important;
                font-weight: 600 !important;
                font-size: 13px !important;
                letter-spacing: 0.5px;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                height: auto !important;
            }
            .filter-actions .btn-primary {
                background-color: #ff9800 !important;
                border-color: #ff9800 !important;
                color: #fff !important;
            }
            .filter-actions .btn-primary:hover {
                background-color: #e68a00 !important;
                border-color: #e68a00 !important;
                box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3) !important;
            }
            .filter-actions .btn-danger {
                background-color: #f44336 !important;
                border-color: #f44336 !important;
                color: #fff !important;
            }
            .filter-actions .btn-danger:hover {
                background-color: #d32f2f !important;
                border-color: #d32f2f !important;
                box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3) !important;
            }

            /* Modern Table & Card Style */
            .card.modern-card {
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
                border: 1px solid #eaeaea;
                overflow: hidden;
                background: #fff;
            }
            .card.modern-card .header {
                background: #fafafa;
                border-bottom: 1px solid #eaeaea;
                padding: 20px 24px;
            }
            .card.modern-card .header h2 {
                font-size: 18px;
                font-weight: 700;
                color: #333;
                margin: 0;
            }
            .card.modern-card .body {
                padding: 24px;
            }
            .table-responsive.list-page {
                border: none;
                margin-top: 15px;
            }
            #mcUserTable {
                border-collapse: separate;
                border-spacing: 0;
                width: 100% !important;
            }
            #mcUserTable th {
                background-color: #f5f5f5 !important;
                color: #444 !important;
                font-weight: 700 !important;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border-bottom: 2px solid #eaeaea !important;
                padding: 14px 16px !important;
            }
            #mcUserTable td {
                padding: 14px 16px !important;
                vertical-align: middle !important;
                border-bottom: 1px solid #eaeaea !important;
                color: #555;
                font-size: 14px;
            }
            #mcUserTable tbody tr:hover td {
                background-color: #fbfbfb;
            }
            
            /* Modern Badges for Status */
            .status-badge {
                font-weight: bold !important;
                font-size: 11px !important;
                text-transform: uppercase !important;
                letter-spacing: 0.8px !important;
                padding: 6px 12px !important;
                border-radius: 30px !important;
                display: inline-block !important;
                border: none !important;
                text-align: center !important;
            }
            .status-badge.active-badge {
                background-color: #e8f5e9 !important;
                color: #2e7d32 !important;
            }
            .status-badge.inactive-badge {
                background-color: #ffebee !important;
                color: #c62828 !important;
            }
            .status-badge.enquiry-badge {
                background-color: #fff3e0 !important;
                color: #ef6c00 !important;
            }

            /* Status Quick Tabs */
            .status-tabs {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-bottom: 18px;
                align-items: center;
            }
            .status-tab-btn {
                display: inline-flex;
                align-items: center;
                gap: 7px;
                padding: 8px 18px;
                border-radius: 30px;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none !important;
                border: 2px solid transparent;
                transition: all 0.25s ease;
                cursor: pointer;
                background: #f5f5f5;
                color: #555;
            }
            .status-tab-btn:hover {
                box-shadow: 0 3px 10px rgba(0,0,0,0.12);
                transform: translateY(-1px);
                text-decoration: none !important;
            }
            .status-tab-btn .tab-count {
                background: rgba(0,0,0,0.1);
                border-radius: 30px;
                padding: 1px 8px;
                font-size: 12px;
                font-weight: 700;
            }
            .status-tab-btn.tab-all       { background:#eef2ff; color:#3730a3; border-color:#c7d2fe; }
            .status-tab-btn.tab-all:hover { background:#e0e7ff; }
            .status-tab-btn.tab-all.tab-active-now { background:#3730a3; color:#fff; border-color:#3730a3; }
            .status-tab-btn.tab-active-s       { background:#e8f5e9; color:#2e7d32; border-color:#c8e6c9; }
            .status-tab-btn.tab-active-s:hover { background:#c8e6c9; }
            .status-tab-btn.tab-active-s.tab-active-now { background:#2e7d32; color:#fff; border-color:#2e7d32; }
            .status-tab-btn.tab-inactive-s       { background:#ffebee; color:#c62828; border-color:#ffcdd2; }
            .status-tab-btn.tab-inactive-s:hover { background:#ffcdd2; }
            .status-tab-btn.tab-inactive-s.tab-active-now { background:#c62828; color:#fff; border-color:#c62828; }
            .status-tab-btn.tab-enquiry-s       { background:#fff3e0; color:#ef6c00; border-color:#ffe0b2; }
            .status-tab-btn.tab-enquiry-s:hover { background:#ffe0b2; }
            .status-tab-btn.tab-enquiry-s.tab-active-now { background:#ef6c00; color:#fff; border-color:#ef6c00; }

            /* Action Icons modern style */
            .action-btn-container {
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .action-icon-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 32px;
                height: 32px;
                border-radius: 8px;
                background: #f5f5f5;
                color: #555 !important;
                text-decoration: none !important;
                transition: all 0.2s ease;
                border: 1px solid #e0e0e0;
            }
            .action-icon-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }
            .action-icon-btn i {
                font-size: 18px !important;
            }
            .action-icon-btn.cart-btn:hover {
                background: #e8f5e9;
                color: #2e7d32 !important;
                border-color: #c8e6c9;
            }
            .action-icon-btn.work-btn:hover {
                background: #ede7f6;
                color: #4527a0 !important;
                border-color: #d1c4e9;
            }
            
            /* Style Select2 to match modern form controls */
            .select2-container {
                width: 100% !important;
            }
            .select2-container .select2-selection--single {
                border: 1px solid #dcdcdc !important;
                border-radius: 6px !important;
                height: 34px !important;
                background-color: #fafafa !important;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                box-shadow: none !important;
            }
            .select2-container .select2-selection--single:focus,
            .select2-container.select2-container--open .select2-selection--single {
                border-color: #ff9800 !important;
                background-color: #fff !important;
                box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
            }
            .select2-container .select2-selection--single .select2-selection__rendered {
                padding-left: 12px !important;
                padding-right: 30px !important;
                color: #555 !important;
                font-size: 13px !important;
                line-height: 32px !important;
            }
            .select2-container .select2-selection--single .select2-selection__arrow {
                height: 32px !important;
                right: 8px !important;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .select2-container .select2-selection--single .select2-selection__arrow b {
                border-color: #888 transparent transparent transparent !important;
                border-width: 5px 4px 0 4px !important;
            }
            .select2-container.select2-container--open .select2-selection--single .select2-selection__arrow b {
                border-color: transparent transparent #888 transparent !important;
                border-width: 0 4px 5px 4px !important;
            }
            
            /* Style Bootstrap Select dropdown toggle */
            .filter-group .bootstrap-select {
                width: 100% !important;
                height: 34px !important;
                padding: 0 !important;
                border: none !important;
            }
            .filter-group .bootstrap-select .btn.dropdown-toggle {
                border-radius: 6px !important;
                border: 1px solid #dcdcdc !important;
                padding: 6px 12px !important;
                height: 34px !important;
                font-size: 13px !important;
                background-color: #fafafa !important;
                color: #555 !important;
                box-shadow: none !important;
                display: flex;
                align-items: center;
                justify-content: space-between;
                text-transform: none !important;
            }
            .filter-group .bootstrap-select .btn.dropdown-toggle:focus {
                border-color: #ff9800 !important;
                background-color: #fff !important;
                box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
            }
            .filter-group .bootstrap-select .bs-caret {
                display: inline-block;
                margin-left: 5px;
            }
            
            /* General HTML select fallback */
            .filter-group select.form-control {
                border-radius: 6px !important;
                border: 1px solid #dcdcdc !important;
                padding: 6px 12px !important;
                height: 34px !important;
                font-size: 13px !important;
                box-shadow: none !important;
                transition: all 0.3s ease;
                background-color: #fafafa !important;
                color: #555 !important;
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
            }
            .filter-group select.form-control:focus {
                border-color: #ff9800 !important;
                background-color: #fff !important;
                box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
            }
            section.content {
                overflow-x: hidden !important;
            }
        </style>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $this->Flash->render() ?>

                <div class="filter-card">
                    <div class="filter-card-title">
                        <i class="material-icons">filter_list</i>
                        <span><?= __('Filter & Search Users') ?></span>
                    </div>
                    <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'ManualCollections', 'action' => 'index']]) ?>
                    <div class="filter-grid">
                        <div class="filter-group">
                            <?php echo $this->Form->input('name', ['label' => __('User Name'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('-- User Name --'), 'value' => $name]); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('email', ['label' => __('Email'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('Email'), 'value' => $email]); ?>
                        </div>

                        <?php if (isset($users_type) && ($users_type == 1)) { ?>
                            <div class="filter-group">
                                <?= $this->Form->input('user_type', ['label' => __('User type'), 'type' => 'select', 'class' => 'form-control', 'empty' => __('Select User type'), 'options' => $user_type_options, 'value' => $user_type]); ?>
                            </div>
                            <div class="filter-group">
                                <?= $this->Form->input('partners', ['label' => __('Partners'), 'type' => 'select', 'class' => 'form-control select2', 'empty' => __('Select Partners'), 'options' => $partners, 'value' => $partner]); ?>
                            </div>
                        <?php } elseif (isset($users_type) && ($users_type == 2)) { ?>
                            <div class="filter-group">
                                <?= $this->Form->input('trainers', ['label' => __('Trainers'), 'type' => 'select', 'class' => 'form-control select2', 'empty' => __('Select Trainers'), 'options' => $trainers, 'value' => $trainer]); ?>
                            </div>
                        <?php } ?>

                        <div class="filter-group">
                            <?= $this->Form->input('date_type', ['label' => __('Date Type'), 'type' => 'select', 'class' => 'form-control', 'options' => ['reg' => __('Reg. Date'), 'followup' => __('Follow Up Date')], 'value' => $date_type]); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('start_date', ['label' => __('Start Date'), 'class' => 'form-control datepicker-filter', 'type' => 'text', 'placeholder' => 'YYYY-MM-DD', 'value' => $start_date, 'autocomplete' => 'off']); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('end_date', ['label' => __('End Date'), 'class' => 'form-control datepicker-filter', 'type' => 'text', 'placeholder' => 'YYYY-MM-DD', 'value' => $end_date, 'autocomplete' => 'off']); ?>
                        </div>
                        <div class="filter-group">
                            <?= $this->Form->input('norec', ['label' => __('No. of Records'), 'type' => 'select', 'class' => 'form-control', 'placeholder' => __('select record'), 'options' => $nofrec, 'value' => $norec]); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('status', ['label' => __('Status'), 'class' => 'form-control', 'empty' => __('Select Status'), 'options' => $statu, 'value' => $status]); ?>
                        </div>
                        
                        <div class="filter-actions">
                            <?= $this->Form->button('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">search</i> ' . __('Search'), ['class' => 'btn btn-primary waves-effect', 'escapeTitle' => false]) ?>
                            <?= $this->Html->link('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">clear_all</i> ' . __('Clear'), ['controller' => 'ManualCollections'], ['class' => 'btn btn-danger waves-effect', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">assessment</i> ' . __('Report'), ['action' => 'report'], ['class' => 'btn btn-info waves-effect', 'escape' => false]) ?>
                            <?php 
                            $currentUserEmail = strtolower(trim($usersdetail['users_email'] ?? ''));
                            if (in_array($currentUserEmail, ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'])): 
                            ?>
                                <?= $this->Html->link('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">vpn_key</i> ' . __('Manage Access'), ['action' => 'manageAccess'], ['class' => 'btn btn-secondary waves-effect', 'escape' => false]) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>

                <div class="card modern-card">
                    <div class="header">
                        <h2>
                            <?= __('Manual Collections — Users') ?>
                        </h2>
                        <!-- Quick Status Tabs -->
                        <div class="status-tabs" style="margin-top:14px;">
                            <?php
                                $baseUrl = $this->Url->build(['controller' => 'ManualCollections', 'action' => 'index']);
                                $tabParams = ['name' => $name, 'email' => $email, 'norec' => $norec, 'date_type' => $date_type, 'start_date' => $start_date, 'end_date' => $end_date];
                                function buildTabUrl($baseUrl, $tabParams, $statusVal) {
                                    $params = array_merge($tabParams, ['status' => $statusVal]);
                                    return $baseUrl . '?' . http_build_query($params);
                                }
                            ?>
                            <a href="<?= buildTabUrl($baseUrl, $tabParams, '') ?>" 
                               class="status-tab-btn tab-all <?= ($status === '') ? 'tab-active-now' : '' ?>">
                                <i class="material-icons" style="font-size:16px;vertical-align:middle;">people</i>
                                <?= __('All') ?>
                                <span class="tab-count"><?= $tabCountAll ?></span>
                            </a>
                            <a href="<?= buildTabUrl($baseUrl, $tabParams, '1') ?>" 
                               class="status-tab-btn tab-active-s <?= ($status === '1') ? 'tab-active-now' : '' ?>">
                                <i class="material-icons" style="font-size:16px;vertical-align:middle;">check_circle</i>
                                <?= __('Active') ?>
                                <span class="tab-count"><?= $tabCountActive ?></span>
                            </a>
                            <a href="<?= buildTabUrl($baseUrl, $tabParams, '0') ?>" 
                               class="status-tab-btn tab-inactive-s <?= ($status === '0') ? 'tab-active-now' : '' ?>">
                                <i class="material-icons" style="font-size:16px;vertical-align:middle;">cancel</i>
                                <?= __('Inactive') ?>
                                <span class="tab-count"><?= $tabCountInactive ?></span>
                            </a>
                            <a href="<?= buildTabUrl($baseUrl, $tabParams, '2') ?>" 
                               class="status-tab-btn tab-enquiry-s <?= ($status === '2') ? 'tab-active-now' : '' ?>">
                                <i class="material-icons" style="font-size:16px;vertical-align:middle;">help_outline</i>
                                <?= __('Enquiry') ?>
                                <span class="tab-count"><?= $tabCountEnquiry ?></span>
                            </a>
                        </div>
                    </div>
                    <div class="body">
                        <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>

                            <div class="table-responsive list-page">
                                <table class="table table-bordered table-striped" id="mcUserTable">

                                    <thead>
                                        <tr>
                                            <th><?= __('Name') ?></th>
                                            <th><?= __('Email') ?></th>
                                            <th><?= __('Mobile') ?></th>
                                            <th><?= __('Gender') ?></th>
                                            <th><?= __('Status') ?></th>
                                            <th><?= __('Action') ?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><?= __('Name') ?></th>
                                            <th><?= __('Email') ?></th>
                                            <th><?= __('Mobile') ?></th>
                                            <th><?= __('Gender') ?></th>
                                            <th><?= __('Status') ?></th>
                                            <th><?= __('Action') ?></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <?php foreach ($users as $user) { ?>
                                            <tr>
                                                <td><?= ucfirst($user['name']) ?></td>
                                                <td><?= ($user['email']) ?></td>
                                                <td><?= h($user['mobile_no'] ?? '-') ?></td>
                                                <td><?php if ($user['gender'] == 1) {
                                                        echo 'Male';
                                                     } else {
                                                        echo 'Female';
                                                     } ?></td>
                                                <td id='status<?= $user->id ?>'>
                                                    <?php if ($user->active == 1) { ?>
                                                        <span class="status-badge active-badge">Active</span>
                                                    <?php } elseif ($user->active == 2) { ?>
                                                        <span class="status-badge enquiry-badge">Enquiry</span>
                                                    <?php } else { ?>
                                                        <span class="status-badge inactive-badge">Inactive</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="action-btn-container">
                                                        <a href="<?= $this->Url->build(['action' => 'add', $user['id']]); ?>" class="action-icon-btn cart-btn" title="Add Plan">
                                                            <i class="material-icons">shopping_cart</i>
                                                        </a>
                                                        <a href="<?= $this->Url->build(['action' => 'addPayment', $user['id']]); ?>" class="action-icon-btn work-btn" title="Add Payment">
                                                            <i class="material-icons">work</i>
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
                                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                    <?= $this->Paginator->numbers() ?>
                                    <?= $this->Paginator->next(__('next') . ' >') ?>
                                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                                </ul>
                                <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>

                            </div>
                        <?php } else { ?>
                            <div>&nbsp;</div>
                            <div class="text-center">
                                <div class="text-center noDataFound">
                                    <strong><?= __('Record') ?></strong> <?= __('not found') ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>

<script type="text/javascript language="javascript">
    $(document).ready(function() {
        $('.select2').select2();
        $('.datepicker-filter').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD', time: false });
    });
</script>
