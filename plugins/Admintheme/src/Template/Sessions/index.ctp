<?php
$statu    = $this->Common->getstatus();
$nofrec   = $this->Common->getNoOfRec();
$partners = $this->Common->getpartner();
?>
<section class="content">
    <div class="container-fluid">
        <!-- Modern Styling Block -->
        <style>
            /* Prevent horizontal scroll */
            section.content {
                overflow-x: hidden !important;
            }

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

            /* Status Quick Tabs */
            .status-tabs {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 14px;
                margin-bottom: 4px;
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

            .fixed-action-btn .btn-floating {
                background-color: #ff9800 !important;
                box-shadow: 0 4px 14px rgba(255, 152, 0, 0.4) !important;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .fixed-action-btn .btn-floating:hover {
                transform: scale(1.1) rotate(90deg);
                box-shadow: 0 6px 20px rgba(255, 152, 0, 0.6) !important;
            }

            /* ─── Ultra Modern Modal & Trigger Button Styling ─── */
            .btn-modern-duplicate-access {
                background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%) !important;
                color: #ffffff !important;
                font-weight: 700 !important;
                font-size: 13px !important;
                border-radius: 10px !important;
                padding: 8px 18px !important;
                border: none !important;
                box-shadow: 0 4px 14px rgba(255, 152, 0, 0.35) !important;
                display: inline-flex !important;
                align-items: center !important;
                gap: 8px !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                letter-spacing: 0.3px;
                cursor: pointer;
            }
            .btn-modern-duplicate-access:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(255, 152, 0, 0.5) !important;
                color: #ffffff !important;
            }

            .modal-modern-container .modal-dialog {
                max-width: 580px;
                width: 95%;
                margin: 45px auto;
            }
            .modal-modern-card {
                border-radius: 16px !important;
                border: none !important;
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25) !important;
                overflow: hidden !important;
                background: #ffffff !important;
            }
            .modal-modern-header {
                background: linear-gradient(135deg, #ff9800 0%, #e65100 100%) !important;
                padding: 22px 28px !important;
                border: none !important;
                position: relative;
            }
            .modal-modern-header .modal-title-box {
                display: flex;
                align-items: center;
                gap: 12px;
            }
            .modal-modern-header .header-icon-avatar {
                width: 44px;
                height: 44px;
                border-radius: 12px;
                background: rgba(255, 255, 255, 0.22);
                backdrop-filter: blur(4px);
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 22px;
                flex-shrink: 0;
            }
            .modal-modern-header .modal-title {
                color: #ffffff !important;
                font-size: 17px !important;
                font-weight: 700 !important;
                margin: 0 !important;
                letter-spacing: 0.3px;
                line-height: 1.2;
            }
            .modal-modern-header .modal-subtitle {
                color: rgba(255, 255, 255, 0.9);
                font-size: 12px;
                margin-top: 3px;
                font-weight: 400;
            }
            .modal-modern-header .close-btn-circle {
                position: absolute;
                right: 20px;
                top: 20px;
                background: rgba(255, 255, 255, 0.2);
                border: none;
                color: #ffffff;
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.2s ease;
                outline: none;
                opacity: 0.9;
            }
            .modal-modern-header .close-btn-circle:hover {
                background: rgba(255, 255, 255, 0.35);
                transform: scale(1.08);
                opacity: 1;
            }

            .modal-modern-body {
                padding: 28px !important;
            }

            .modern-form-group {
                margin-bottom: 24px;
            }
            .modern-form-group label {
                font-size: 12px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.6px;
                color: #475569;
                margin-bottom: 8px;
                display: block;
            }
            .modern-input-row {
                display: flex;
                gap: 10px;
                align-items: center;
            }
            .modern-input-wrap {
                flex: 1;
                position: relative;
            }
            .modern-input-wrap i {
                position: absolute;
                left: 14px;
                top: 50%;
                transform: translateY(-50%);
                color: #94a3b8;
                font-size: 20px;
                pointer-events: none;
                transition: color 0.2s ease;
            }
            .modern-input-wrap input.modern-input {
                width: 100% !important;
                height: 46px !important;
                border-radius: 10px !important;
                border: 1.5px solid #cbd5e1 !important;
                background-color: #f8fafc !important;
                padding-left: 44px !important;
                padding-right: 14px !important;
                font-size: 14px !important;
                color: #1e293b !important;
                box-shadow: none !important;
                transition: all 0.2s ease !important;
                outline: none !important;
            }
            .modern-input-wrap input.modern-input:focus {
                border-color: #ff9800 !important;
                background-color: #ffffff !important;
                box-shadow: 0 0 0 4px rgba(255, 152, 0, 0.15) !important;
            }
            .modern-input-wrap input.modern-input:focus + i {
                color: #ff9800;
            }

            .btn-grant-access {
                height: 46px !important;
                padding: 0 22px !important;
                border-radius: 10px !important;
                background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%) !important;
                color: #ffffff !important;
                font-weight: 700 !important;
                font-size: 13.5px !important;
                border: none !important;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                box-shadow: 0 4px 14px rgba(255, 152, 0, 0.35) !important;
                cursor: pointer;
                transition: all 0.25s ease;
                white-space: nowrap;
                flex-shrink: 0;
            }
            .btn-grant-access:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 18px rgba(255, 152, 0, 0.5) !important;
            }

            /* Permissions Section */
            .perm-section-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding-bottom: 10px;
                border-bottom: 2px solid #f1f5f9;
                margin-bottom: 16px;
            }
            .perm-section-title {
                font-size: 13px;
                font-weight: 700;
                color: #1e293b;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                display: flex;
                align-items: center;
                gap: 6px;
            }
            .perm-badge-count {
                background: #fff3e0;
                color: #e65100;
                padding: 2px 10px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 700;
                border: 1px solid #ffe0b2;
            }

            /* Modern List Table */
            .perm-table-wrap {
                border-radius: 12px;
                border: 1px solid #e2e8f0;
                overflow: hidden;
                background: #ffffff;
            }
            .perm-modern-table {
                width: 100%;
                margin: 0;
                border-collapse: collapse;
            }
            .perm-modern-table th {
                background: #f8fafc;
                padding: 12px 16px;
                font-size: 11px;
                font-weight: 700;
                text-transform: uppercase;
                color: #64748b;
                letter-spacing: 0.5px;
                border-bottom: 1px solid #e2e8f0;
            }
            .perm-modern-table td {
                padding: 14px 16px;
                font-size: 13px;
                color: #334155;
                vertical-align: middle;
                border-bottom: 1px solid #f1f5f9;
            }
            .perm-modern-table tr:last-child td {
                border-bottom: none;
            }
            .perm-modern-table tr:hover td {
                background-color: #fafbfd;
            }
            .user-email-pill {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                font-weight: 600;
                color: #0f172a;
            }
            .user-avatar-dot {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #fff3e0;
                color: #e65100;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 13px;
                font-weight: 700;
                border: 1px solid #ffe0b2;
            }

            .btn-revoke-circle {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                background: #fee2e2;
                color: #ef4444;
                border: 1px solid #fca5a5;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                transition: all 0.2s ease;
                text-decoration: none !important;
            }
            .btn-revoke-circle:hover {
                background: #ef4444;
                color: #ffffff;
                box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
                transform: scale(1.08);
            }

            .empty-perm-box {
                text-align: center;
                padding: 30px 20px;
                background: #f8fafc;
                border-radius: 12px;
                border: 1.5px dashed #cbd5e1;
            }
            .empty-perm-box i {
                font-size: 42px;
                color: #94a3b8;
                margin-bottom: 8px;
                display: block;
            }
            .empty-perm-box p {
                margin: 0;
                font-size: 13px;
                color: #64748b;
                font-weight: 500;
            }

            .modal-modern-footer {
                padding: 16px 28px !important;
                background: #f8fafc !important;
                border-top: 1px solid #e2e8f0 !important;
                display: flex;
                justify-content: flex-end;
            }
            .btn-modal-close {
                background: #ffffff !important;
                border: 1.5px solid #cbd5e1 !important;
                color: #475569 !important;
                font-weight: 600 !important;
                font-size: 13px !important;
                padding: 8px 20px !important;
                border-radius: 8px !important;
                transition: all 0.2s ease;
            }
            .btn-modal-close:hover {
                background: #f1f5f9 !important;
                color: #1e293b !important;
            }
        </style>



        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if ($user_type != 3) { ?>
                    <div class="fixed-action-btn" title="Add Session"><a href="<?= $this->Url->build(['controller' => 'Sessions', 'action' => 'add']); ?>" class="btn btn-primary waves-effect btn-floating waves-light btn-large red"><i class="material-icons">add</i></a></div>
                <?php } ?>
                <?= $this->Flash->render() ?>

                <!-- Modern Compact Filter Grid -->
                <div class="filter-card">
                    <div class="filter-card-title">
                        <i class="material-icons">filter_list</i>
                        <span><?= __('Filter Sessions') ?></span>
                    </div>
                    <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'Sessions', 'action' => 'index']]) ?>
                    <div class="filter-grid">
                        <?php if ($user_type != 3) { ?>
                            <div class="filter-group">
                                <?php echo $this->Form->input('name', ['label' => __('User Name'), 'class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select User'), 'value' => $name, 'options' => $users]); ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($user_type) && ($user_type == 1)) { ?>
                            <div class="filter-group">
                                <?= $this->Form->input('partners', ['label' => __('Partners'), 'type' => 'select', 'class' => 'form-control select2', 'empty' => __('Select Partners'), 'options' => $partners, 'value' => $partner]); ?>
                            </div>
                        <?php } ?>

                        <div class="filter-group">
                            <?php echo $this->Form->input('from_date', ['label' => __('From Date'), 'class' => 'form-control', 'id' => 'date-start', 'type' => 'text', 'placeholder' => __('From Date'), 'value' => $sdate]); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('to_date', ['label' => __('To Date'), 'class' => 'form-control', 'id' => 'date-end', 'type' => 'text', 'placeholder' => __('To Date'), 'value' => $edate]); ?>
                        </div>
                        <?php if ($user_type != 3) { ?>
                            <div class="filter-group">
                                <?php echo $this->Form->input('status', ['label' => __('Status'), 'class' => 'form-control', 'empty' => __('Select Status'), 'options' => $statu, 'value' => $status]); ?>
                            </div>
                        <?php  } ?>
                        <div class="filter-group">
                            <?= $this->Form->input('norec', ['label' => __('No. of Records'), 'type' => 'select', 'class' => 'form-control', 'placeholder' => __('select record'), 'options' => $nofrec, 'value' => $norec]); ?>
                        </div>
                        <div class="filter-group">
                            <?= $this->Form->input('stat', ['label' => __('Session Status'), 'type' => 'select', 'class' => 'form-control', 'placeholder' => __('select record'), 'options' => ['0' => 'Select Status ', '1' => 'Not Reported'], 'value' => $stat]); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('s_type', ['label' => __('Session Type'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('-- Session Type --'), 'value' => $s_type]); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('reps', ['label' => __('Reps'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('Search Reps (e.g. 12)'), 'value' => $reps]); ?>
                        </div>
                        <div class="filter-actions">
                            <?= $this->Form->button('<i class="material-icons" style="font-size:16px; vertical-align:middle;">search</i> ' . __('Search'), ['class' => 'btn btn-primary']) ?>
                            <?= $this->Html->link('<i class="material-icons" style="font-size:16px; vertical-align:middle;">clear</i> ' . __('Clear'), ['controller' => 'Sessions'], ['class' => 'btn btn-danger', 'escape' => false]) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>

                <!-- Modern Card Layout for Table -->
                <div class="card modern-card">
                    <?php
                    $isAdmin = $this->Common->isAdminUser($usersdetail['users_type'] ?? 0, $usersdetail['users_email'] ?? '');
                    ?>
                    <div class="header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
                        <h2 style="margin:0; display:flex; align-items:center; gap:8px;">
                            <i class="material-icons" style="color:#ff9800;">event_note</i> <?= __('Sessions List') ?>
                        </h2>
                        <?php if ($user_type == 2 || $isAdmin): ?>
                            <button type="button" class="btn btn-modern-duplicate-access" data-toggle="modal" data-target="#duplicateAccessModal">
                                <i class="material-icons" style="font-size:18px;">key</i> <?= __('Manage Trainer Duplicate Access') ?>
                            </button>
                        <?php endif; ?>
                    </div>
                        <!-- Quick Status Tabs -->
                        <div class="status-tabs" style="margin-top:14px;">
                            <?php
                                $baseUrl = $this->Url->build(['controller' => 'Sessions', 'action' => 'index']);
                                $queryParams = $this->request->query;
                                unset($queryParams['today_filter']);
                                function buildSessionTabUrl($baseUrl, $queryParams, $filterVal) {
                                    if ($filterVal === '') {
                                        return empty($queryParams) ? $baseUrl : $baseUrl . '?' . http_build_query($queryParams);
                                    }
                                    $params = array_merge($queryParams, ['today_filter' => $filterVal]);
                                    return $baseUrl . '?' . http_build_query($params);
                                }
                            ?>
                            <a href="<?= buildSessionTabUrl($baseUrl, $queryParams, '') ?>" 
                               class="status-tab-btn tab-all <?= ($todayFilter === '') ? 'tab-active-now' : '' ?>">
                                <i class="material-icons" style="font-size:16px;vertical-align:middle;">calendar_today</i>
                                <?= __('All Sessions') ?>
                            </a>
                            <a href="<?= buildSessionTabUrl($baseUrl, $queryParams, 'total') ?>" 
                               class="status-tab-btn tab-all <?= ($todayFilter === 'total') ? 'tab-active-now' : '' ?>">
                                <i class="material-icons" style="font-size:16px;vertical-align:middle;">people</i>
                                <?= __('Total Users (Today)') ?>
                                <span class="tab-count"><?= $totalUsersCount ?></span>
                            </a>
                            <a href="<?= buildSessionTabUrl($baseUrl, $queryParams, 'created') ?>" 
                               class="status-tab-btn tab-active-s <?= ($todayFilter === 'created') ? 'tab-active-now' : '' ?>">
                                <i class="material-icons" style="font-size:16px;vertical-align:middle;">check_circle</i>
                                <?= __('Session Created') ?>
                                <span class="tab-count"><?= $createdCount ?></span>
                            </a>
                            <a href="<?= buildSessionTabUrl($baseUrl, $queryParams, 'not_created') ?>" 
                               class="status-tab-btn tab-enquiry-s <?= ($todayFilter === 'not_created') ? 'tab-active-now' : '' ?>">
                                <i class="material-icons" style="font-size:16px;vertical-align:middle;">error_outline</i>
                                <?= __('Session Not Created') ?>
                                <span class="tab-count"><?= $notCreatedCount ?></span>
                            </a>
                            <a href="<?= buildSessionTabUrl($baseUrl, $queryParams, 'not_attended') ?>" 
                               class="status-tab-btn tab-inactive-s <?= ($todayFilter === 'not_attended') ? 'tab-active-now' : '' ?>">
                                <i class="material-icons" style="font-size:16px;vertical-align:middle;">cancel</i>
                                <?= __('Not Attended') ?>
                                <span class="tab-count"><?= $notAttendedCount ?></span>
                            </a>
                        </div>
                    </div>
                    <div class="body">
                        <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>
                            <div class="table-responsive list-page">
                                <table class="table table-bordered table-striped table-hover dataTable responsive" id="userstable">
                                    <thead>
                                        <tr>
                                            <th><?= __('User') ?></th>
                                            <th><?= __('Body Weight') ?></th>
                                            <th><?= __('Comment') ?></th>
                                            <th><?= __('Date') ?></th>
                                            <th><?= __('Type') ?></th>
                                            <?php if ($user_type != 3) { ?>
                                                <th><?= __('Status') ?></th>
                                            <?php } ?>
                                            <th><?= __('Action') ?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><?= __('User') ?></th>
                                            <th><?= __('Body Weight') ?></th>
                                            <th><?= __('Comment') ?></th>
                                            <th><?= __('Date') ?></th>
                                            <th><?= __('Type') ?></th>
                                            <?php if ($user_type != 3) { ?>
                                                <th><?= __('Status') ?></th>
                                            <?php } ?>
                                            <th><?= __('Action') ?></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($sessions as $session) {
                                            $isVirtual = isset($session->is_virtual) && $session->is_virtual;
                                        ?>
                                            <tr>
                                                <td><?= ucfirst($session->user->name) ?></td>
                                                <td>
                                                    <?php if ($isVirtual) { ?>
                                                        <span class="label label-default">N/A</span>
                                                    <?php } else { ?>
                                                        <?= ucfirst($session->body_weight) ?>
                                                    <?php } ?>
                                                </td>
                                                <td title="<?= $isVirtual ? 'No session created for today' : ucfirst($session->notes) ?>">
                                                    <?php if ($isVirtual) { ?>
                                                        <span class="text-muted">Not Created</span>
                                                    <?php } else { ?>
                                                        <?= ucfirst(substr($session->notes, 0, 20)) ?>
                                                    <?php } ?>
                                                </td>
                                                <td><?= date('d-m-Y', strtotime($session->date)) ?></td>
                                                <td>
                                                    <?php if ($isVirtual) { ?>
                                                        <span class="label label-danger">Missing</span>
                                                    <?php } else { ?>
                                                        <?= ucfirst($session->session_type) ?>
                                                    <?php } ?>
                                                </td>
                                                <?php if ($user_type != 3) { ?>
                                                    <td id='status<?= $session->id ?>'>
                                                        <?php if ($isVirtual) { ?>
                                                            <span class="label label-warning">Pending</span>
                                                        <?php } else { ?>
                                                            <?php if (isset($session->status) && $session->status == '1') { ?>
                                                                <?= $this->Form->button('Active', ['class' => 'btn btn-success waves-effect', 'id' => $session->id, 'value' => $session->status, 'onclick' => 'updateStatus(this.id,' . $session->status . ')']) ?>
                                                            <?php } else { ?>
                                                                <?= $this->Form->button('Inactive', ['class' => 'btn btn-primary waves-effect', 'id' => $session->id, 'value' => $session->status, 'onclick' => 'updateStatus(this.id,' . $session->status . ')']) ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                                <td>
                                                    <?php if ($isVirtual) { ?>
                                                        <?php if ($user_type != 3) { ?>
                                                            <a href="<?= $this->Url->build(['action' => 'add', '?' => ['user_id' => $session->user_id]]) ?>" class="btn btn-xs btn-primary waves-effect" title="Create Session">
                                                                <i class="material-icons" style="font-size: 16px; vertical-align: middle;">add</i> <?= __('Create') ?>
                                                            </a>
                                                        <?php } else { ?>
                                                            <span class="text-muted">N/A</span>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <?php if (($user_type == 3) && (empty($session->user_detail))) { ?>
                                                            <i class="material-icons" title="Report Session"><?= $this->Html->link(__('mode_edit'), ['action' => 'userEdit', $session['id']]) ?></i>
                                                        <?php } ?>

                                                        <i class="material-icons" title="View"><?= $this->Html->link(__('visibility'), ['action' => 'view', $session['id']]) ?></i>

                                                        <?php if ($user_type != 3) { ?>
                                                            <?php if (empty($session->user_detail)) { ?>
                                                                <i class="material-icons" title="Session Edit"><?= $this->Html->link(__('mode_edit'), ['action' => 'edit', $session['id']]) ?></i>
                                                            <?php } ?>
                                                        <?php } ?>

                                                        <?php if (($user_type != 3) && ($user_type != 4)) { ?>
                                                            <i class="material-icons" title="<?= __('Delete') ?>"><?= $this->Form->postLink(__('delete'), ['action' => 'delete', $session['id']], ['confirm' => __('Are you sure you want to delete Session ?', $session['id'])]) ?></i>
                                                        <?php } ?>

                                                        <?php if (!empty($canDuplicateSession)) { ?>
                                                            <i class="material-icons"><?= $this->Html->link(__('content_copy'), ['action' => 'addMore', $session['id']], ['title' => 'Add Duplicate']) ?></i>
                                                        <?php } ?>

                                                        <?php if (($user_type == 1 || $user_type == 2) && (!empty($session->user_detail))) { ?>
                                                            <i class="material-icons" title="Reported session edit"><?= $this->Html->link(__('border_color'), ['action' => 'userEdit', $session['id']]) ?></i>
                                                        <?php } ?>

                                                        <?php if (($user_type == 4) && (empty($session->user_detail))) { ?>
                                                            <i class="material-icons" title="Report session"><?= $this->Html->link(__('build'), ['action' => 'userEdit', $session['id']]) ?></i>
                                                        <?php } ?>
                                                    <?php } ?>
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
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="text-center">
                                    <div class="text-center noDataFound">
                                        <strong><?= __('Record') ?></strong> <?= __('not found') ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for Managing Trainer Duplicate Access -->
        <?php if ($user_type == 2 || $isAdmin): ?>
        <div class="modal fade modal-modern-container" id="duplicateAccessModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-modern-card">
                    <div class="modal-header modal-modern-header">
                        <button type="button" class="close-btn-circle" data-dismiss="modal" title="Close">
                            <i class="material-icons" style="font-size:18px;">close</i>
                        </button>
                        <div class="modal-title-box">
                            <div class="header-icon-avatar">
                                <i class="material-icons">security</i>
                            </div>
                            <div>
                                <h4 class="modal-title"><?= __('Trainer Duplicate Access') ?></h4>
                                <div class="modal-subtitle"><?= __('Grant session copy permission to trainers by Email ID') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body modal-modern-body">
                        <?= $this->Form->create(null, ['url' => ['controller' => 'Sessions', 'action' => 'grantDuplicateAccess']]) ?>
                            <div class="modern-form-group">
                                <label><?= __('Enter Trainer / Staff Email Address') ?></label>
                                <div class="modern-input-row">
                                    <div class="modern-input-wrap">
                                        <input type="email" name="email" class="form-control modern-input" placeholder="trainer@gymmaster.com" required autocomplete="off">
                                        <i class="material-icons">mail_outline</i>
                                    </div>
                                    <button type="submit" class="btn btn-grant-access">
                                        <i class="material-icons" style="font-size:18px;">add_circle</i> <?= __('Grant') ?>
                                    </button>
                                </div>
                            </div>
                        <?= $this->Form->end() ?>

                        <div class="perm-section-header">
                            <div class="perm-section-title">
                                <i class="material-icons" style="font-size:18px; color:#ff9800;">verified_user</i>
                                <span><?= __('Active Granted Users') ?></span>
                            </div>
                            <span class="perm-badge-count"><?= count($duplicatePermissions ?? []) ?> Allowed</span>
                        </div>

                        <?php if (!empty($duplicatePermissions)): ?>
                            <div class="perm-table-wrap">
                                <table class="perm-modern-table">
                                    <thead>
                                        <tr>
                                            <th><?= __('User Email') ?></th>
                                            <th><?= __('Granted By') ?></th>
                                            <th style="text-align:center; width:70px;"><?= __('Action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($duplicatePermissions as $perm): ?>
                                            <tr>
                                                <td>
                                                    <div class="user-email-pill">
                                                        <div class="user-avatar-dot">
                                                            <?= strtoupper(substr($perm['email'], 0, 1)) ?>
                                                        </div>
                                                        <span><?= h($perm['email']) ?></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span style="color:#64748b; font-size:12px;"><?= h($perm['granted_by']) ?></span>
                                                </td>
                                                <td style="text-align:center;">
                                                    <a href="<?= $this->Url->build(['action' => 'revokeDuplicateAccess', $perm['id']]) ?>" class="btn-revoke-circle" onclick="return confirm('<?= __('Are you sure you want to revoke duplicate session access for {0}?', h($perm['email'])) ?>');" title="Revoke Access">
                                                        <i class="material-icons" style="font-size:16px;">delete_outline</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="empty-perm-box">
                                <i class="material-icons">lock_open</i>
                                <p><?= __('No trainer email addresses currently have duplicate access.') ?></p>
                                <small style="color:#94a3b8; display:block; margin-top:4px; font-size:11px;">
                                    Enter an email ID above to delegate session copy permissions.
                                </small>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer modal-modern-footer">
                        <button type="button" class="btn btn-modal-close" data-dismiss="modal"><?= __('Close Window') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<script type="text/javascript" language="javascript">
    function updateStatus(Id, Status) {
        var urllink = '<?php echo $this->Url->build(["controller" => "Sessions", "action" => "status"]); ?>';
        var id = Id;
        var status = Status;
        urllink = urllink + '/' + id + '/' + status;
        if (confirm("<?= __('Are you sure! you want to change session status?') ?>")) {
            $.ajax({
                url: urllink,
                type: 'GET',
                success: function(data) {
                    $('#status' + id).html(data);
                },
                error: function() {}
            });
        } else {
            return false;
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#date-end').bootstrapMaterialDatePicker({
            format: 'YYYY/MM/DD',
            weekStart: 0,
            time: 'false'
        });
        $('#date-start').bootstrapMaterialDatePicker({
            format: 'YYYY/MM/DD',
            weekStart: 0,
            time: 'false'
        }).on('change', function(e, date) {
            $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
        });

        // Initialize select2 elements
        $('.select2').select2();
    });
</script>