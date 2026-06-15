<?php
   $statu = $this->Common->getstatus();
   $nofrec = $this->Common->getNoOfRec();
   $getModPayment = $this->Common->getModPayment();
   $user_type = $this->Common->getType();
   
   $fee_ranges = [
       '0' => __('0 (Nil)'),
       '1-5000' => __('1 - 5,000'),
       '5001-10000' => __('5,001 - 10,000'),
       '10001-25000' => __('10,001 - 25,000'),
       '25001-50000' => __('25,001 - 50,000'),
       '50001-100000' => __('50,001 - 100,000'),
       '100001-500000' => __('100,001 - 500,000'),
       '500001+' => __('500,001+')
   ];
   ?>
<section class="content">
   <div class="container-fluid">
        <!-- Modern Styling Block -->
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
            .filter-actions .btn-success {
                background-color: #4caf50 !important;
                border-color: #4caf50 !important;
                color: #fff !important;
            }
            .filter-actions .btn-success:hover {
                background-color: #388e3c !important;
                border-color: #388e3c !important;
                box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3) !important;
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
            #userstable {
                border-collapse: separate;
                border-spacing: 0;
                width: 100% !important;
            }
            #userstable th {
                background-color: #f5f5f5 !important;
                color: #444 !important;
                font-weight: 700 !important;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border-bottom: 2px solid #eaeaea !important;
                padding: 14px 16px !important;
            }
            #userstable td {
                padding: 14px 16px !important;
                vertical-align: middle !important;
                border-bottom: 1px solid #eaeaea !important;
                color: #555;
                font-size: 14px;
            }
            #userstable tbody tr:hover td {
                background-color: #fbfbfb;
            }

             /* Modern Cards Summary */
            .modern-info-cards {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 15px !important;
                margin-bottom: 20px !important;
            }
            .modern-stat-card {
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
                border: 1px solid #eaeaea;
                padding: 12px 16px !important;
                display: flex;
                align-items: center;
                gap: 12px !important;
                transition: all 0.3s ease;
                overflow: hidden;
            }
            .modern-stat-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            }
            .stat-icon {
                width: 40px !important;
                height: 40px !important;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px !important;
                transition: all 0.3s ease;
            }
            .stat-icon i {
                font-size: 20px !important;
            }
            .stat-details {
                flex: 1;
            }
            .stat-title {
                font-size: 11px !important;
                font-weight: 700;
                color: #888;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 2px;
            }
            .stat-value {
                font-size: 18px !important;
                font-weight: 800;
                color: #333;
            }
            
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
            .action-icon-btn.view-btn:hover {
                background: #e0f7fa;
                color: #00838f !important;
                border-color: #b2ebf2;
            }
            .action-icon-btn.edit-btn:hover {
                background: #fff8e1;
                color: #ff8f00 !important;
                border-color: #ffe082;
            }

            /* Colors for stat card variants */
            .card-total {
                border-left: 5px solid #00bcd4;
            }
            .card-total .stat-icon {
                background: #e0f7fa;
                color: #00bcd4;
            }
            .card-paid {
                border-left: 5px solid #4caf50;
            }
            .card-paid .stat-icon {
                background: #e8f5e9;
                color: #4caf50;
            }
            .card-remain {
                border-left: 5px solid #ff9800;
            }
            .card-remain .stat-icon {
                background: #fff3e0;
                color: #ff9800;
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

                <!-- Modern Stats Cards at Top -->
                <div class="modern-info-cards">
                    <div class="modern-stat-card card-total">
                        <div class="stat-icon">
                            <i class="material-icons">account_balance_wallet</i>
                        </div>
                        <div class="stat-details">
                            <div class="stat-title"><?= __('Total Fee') ?></div>
                            <div class="stat-value"><?= $this->Number->format($amount) ?></div>
                        </div>
                    </div>
                    
                    <div class="modern-stat-card card-paid">
                        <div class="stat-icon">
                            <i class="material-icons">check_circle</i>
                        </div>
                        <div class="stat-details">
                            <div class="stat-title"><?= __('Paid Fee') ?></div>
                            <div class="stat-value"><?= $this->Number->format($totalPaid) ?></div>
                        </div>
                    </div>
                    
                    <div class="modern-stat-card card-remain">
                        <div class="stat-icon">
                            <i class="material-icons">hourglass_empty</i>
                        </div>
                        <div class="stat-details">
                            <div class="stat-title"><?= __('Remaining Fee') ?></div>
                            <div class="stat-value"><?= $this->Number->format($totalRemaining) ?></div>
                        </div>
                    </div>
                </div>

                <!-- Modern Filter Card -->
                <div class="filter-card">
                    <div class="filter-card-title">
                        <i class="material-icons">filter_list</i>
                        <span><?= __('Filter & Search Subscribers') ?></span>
                    </div>
                    <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'PlanSubscribers', 'action' => 'index']]) ?>
                    <div class="filter-grid">
                        <div class="filter-group">
                            <?php echo $this->Form->input('name', ['label' => __('Search User, Plan or Fee'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('Search...'), 'value' => $name]); ?>
                        </div>
                        <?php if (isset($users_type) && ($users_type == 1)) { ?>  
                            <div class="filter-group">
                                <?= $this->Form->input('partners', ['label' => __('Partners'), 'type' => 'select', 'class' => 'form-control select2', 'empty' => __('Select Partners'), 'options' => $partners, 'value' => $partner]); ?>
                            </div>
                        <?php } ?>
                        <div class="filter-group">
                            <?= $this->Form->input('paid_fee', ['label' => __('Paid Fee Range'), 'type' => 'select', 'class' => 'form-control select2', 'empty' => __('Select Paid Range'), 'options' => $fee_ranges, 'value' => $paid_fee_filter]); ?>
                        </div>
                        <div class="filter-group">
                            <?= $this->Form->input('remain_fee', ['label' => __('Remain Fee Range'), 'type' => 'select', 'class' => 'form-control select2', 'empty' => __('Select Remain Range'), 'options' => $fee_ranges, 'value' => $remain_fee_filter]); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('due_date_from', ['label' => __('Due Date From'), 'class' => 'form-control datepicker-filter', 'type' => 'text', 'placeholder' => 'YYYY-MM-DD', 'value' => $due_date_from, 'autocomplete' => 'off']); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('due_date_to', ['label' => __('Due Date To'), 'class' => 'form-control datepicker-filter', 'type' => 'text', 'placeholder' => 'YYYY-MM-DD', 'value' => $due_date_to, 'autocomplete' => 'off']); ?>
                        </div>
                        <div class="filter-group">
                            <?= $this->Form->input('norec', ['label' => __('No. of Records'), 'type' => 'select', 'class' => 'form-control select2', 'options' => $nofrec, 'value' => $norec]); ?>
                        </div>
                        <div class="filter-actions">
                            <?= $this->Form->button('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">search</i> ' . __('Search'), ['class' => 'btn btn-primary waves-effect', 'escapeTitle' => false]) ?>
                            <?= $this->Html->link('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">clear_all</i> ' . __('Clear'), ['controller' => 'PlanSubscribers'], ['class' => 'btn btn-danger waves-effect', 'escape' => false]) ?>
                            <a href="<?= $this->Url->build(['action' => 'export'] + $this->request->query) ?>" class="btn btn-success waves-effect">
                                <i class="material-icons" style="font-size: 18px; vertical-align: middle;">file_download</i> <?= __('Export') ?>
                            </a>
                            <a href="<?= $this->Url->build(['action' => 'report'] + $this->request->query) ?>" target="_blank" class="btn btn-info waves-effect" style="background-color: #00bcd4 !important; border-color: #00bcd4 !important; color: #fff !important;">
                                <i class="material-icons" style="font-size: 18px; vertical-align: middle;">assessment</i> <?= __('View Report') ?>
                            </a>
                        </div>
                    </div>    
                    <?= $this->Form->end() ?>
                </div>

                <!-- Plan Subscribers Table -->
                <div class="card modern-card">
                    <div class="header">
                        <h2>
                            <?= __('Plan Subscribe List') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>
                            <div class="table-responsive list-page">
                                <table class="table table-bordered table-striped" id="userstable">
                                    <thead>
                                        <tr>
                                            <th><?= __('User Name') ?></th>
                                            <th><?= __('Plan Name') ?></th>
                                            <th><?= __('Total Fee') ?></th>
                                            <th><?= __('Paid Fee') ?></th>
                                            <th><?= __('Remain Fee') ?></th>
                                            <th><?= __('Plan Expire') ?></th>
                                            <th><?= __('Payment Due') ?></th>
                                            <th><?= __('Action') ?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><?= __('User Name') ?></th>
                                            <th><?= __('Plan Name') ?></th>
                                            <th><?= __('Total Fee') ?></th>
                                            <th><?= __('Paid Fee') ?></th>
                                            <th><?= __('Remain Fee') ?></th>
                                            <th><?= __('Plan Expire') ?></th>
                                            <th><?= __('Payment Due') ?></th>
                                            <th><?= __('Action') ?></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($planSubscribers as $planSubscriber): ?>
                                        <tr>
                                            <td><?= ucwords($planSubscriber->user->name) ?></td>
                                            <td><?= ucwords($planSubscriber->plan_name) ?></td>
                                            <td><?= $this->Number->format($planSubscriber->fee) ?></td>
                                            <td style="color: #2e7d32; font-weight: bold;"><?= $this->Number->format($planSubscriber->paid_fee) ?></td>
                                            <td style="color: #c62828; font-weight: bold;"><?= $this->Number->format($planSubscriber->remain_fee) ?></td>
                                            <td><?= (date("d-m-Y", strtotime($planSubscriber->plan_expire_date))) ?></td>
                                            <td><?= (date("d-m-Y", strtotime($planSubscriber->payment_due_date))) ?></td>
                                            <td>
                                                <div class="action-btn-container">
                                                    <a href="<?= $this->Url->build(['action' => 'view', $planSubscriber['id']]); ?>" class="action-icon-btn view-btn" title="View">
                                                        <i class="material-icons">visibility</i>
                                                    </a>
                                                    <a href="<?= $this->Url->build(['action' => 'edit', $planSubscriber['id']]); ?>" class="action-icon-btn edit-btn" title="Edit">
                                                        <i class="material-icons">mode_edit</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
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
   </div>
</section>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $('.datepicker-filter').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD', time: false });
    });
</script>