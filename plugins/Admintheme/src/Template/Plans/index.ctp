<?php
// No PHP needed here at template level for now
?>
<section class="content">
    <div class="container-fluid">

        <style>
            /* ─── Plans Module Styles ─── */
            .plans-header-card {
                background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
                border-radius: 14px;
                padding: 22px 28px;
                margin-bottom: 22px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                box-shadow: 0 6px 24px rgba(255, 152, 0, 0.28);
            }
            .plans-header-card h2 {
                color: #fff;
                font-size: 22px;
                font-weight: 700;
                margin: 0;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .plans-header-card h2 i {
                font-size: 26px;
            }
            .btn-create-plan {
                background: #fff;
                color: #f57c00;
                border: none;
                border-radius: 8px;
                padding: 10px 20px;
                font-weight: 700;
                font-size: 14px;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                cursor: pointer;
                text-decoration: none !important;
                transition: all 0.25s;
                box-shadow: 0 3px 10px rgba(0,0,0,0.12);
            }
            .btn-create-plan:hover {
                background: #fff8e1;
                color: #e65100;
                transform: translateY(-2px);
                box-shadow: 0 6px 18px rgba(0,0,0,0.15);
                text-decoration: none !important;
            }
            .plans-table-card {
                background: #fff;
                border-radius: 14px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.06);
                border: 1px solid #f0f0f0;
                overflow: hidden;
            }
            #plansTable {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }
            #plansTable thead tr {
                background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            }
            #plansTable th {
                padding: 14px 18px;
                font-size: 12px;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                color: #e65100;
                border-bottom: 2px solid #ffe0b2;
            }
            #plansTable td {
                padding: 14px 18px;
                vertical-align: middle;
                border-bottom: 1px solid #f5f5f5;
                font-size: 14px;
                color: #444;
            }
            #plansTable tbody tr:hover td {
                background: #fffdf8;
            }
            .plan-title-cell {
                font-weight: 600;
                color: #333;
            }
            .plan-duration-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                background: #e3f2fd;
                color: #1565c0;
                border-radius: 20px;
                padding: 4px 12px;
                font-size: 12px;
                font-weight: 700;
            }
            .plan-days-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                background: #e8f5e9;
                color: #2e7d32;
                border-radius: 20px;
                padding: 4px 12px;
                font-size: 12px;
                font-weight: 700;
            }
            .plan-price-cell {
                font-weight: 700;
                color: #e65100;
                font-size: 15px;
            }
            .plan-status-active {
                display: inline-block;
                background: #e8f5e9;
                color: #2e7d32;
                border-radius: 20px;
                padding: 4px 14px;
                font-size: 12px;
                font-weight: 700;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                cursor: pointer;
                border: none;
                transition: all 0.2s;
            }
            .plan-status-inactive {
                display: inline-block;
                background: #ffebee;
                color: #c62828;
                border-radius: 20px;
                padding: 4px 14px;
                font-size: 12px;
                font-weight: 700;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                cursor: pointer;
                border: none;
                transition: all 0.2s;
            }
            .plan-action-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 33px;
                height: 33px;
                border-radius: 8px;
                background: #f5f5f5;
                color: #555;
                text-decoration: none !important;
                border: 1px solid #e0e0e0;
                transition: all 0.2s;
                margin-right: 4px;
            }
            .plan-action-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            }
            .plan-action-btn.edit-btn:hover {
                background: #fff8e1;
                color: #ff8f00 !important;
                border-color: #ffe082;
            }
            .plan-action-btn.view-btn:hover {
                background: #e0f7fa;
                color: #00838f !important;
                border-color: #b2ebf2;
            }
            .plan-action-btn i {
                font-size: 17px;
            }
            .no-plans-wrap {
                text-align: center;
                padding: 60px 20px;
                color: #aaa;
            }
            .no-plans-wrap i {
                font-size: 64px;
                color: #ffe0b2;
                display: block;
                margin-bottom: 12px;
            }
            .no-plans-wrap p {
                font-size: 16px;
                font-weight: 600;
            }
        </style>

        <?= $this->Flash->render() ?>

        <!-- Header -->
        <div class="plans-header-card">
            <h2>
                <i class="material-icons">loyalty</i>
                <?= __('Plans') ?>
            </h2>
            <a href="<?= $this->Url->build(['controller' => 'Plans', 'action' => 'add']); ?>" class="btn-create-plan">
                <i class="material-icons" style="font-size:18px;">add_circle</i>
                <?= __('Create Plan') ?>
            </a>
        </div>

        <!-- Table Card -->
        <div class="plans-table-card">
            <?php if (!empty($plans)): ?>
                <div class="table-responsive">
                    <table id="plansTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= __('Plan Name') ?></th>
                                <th><?= __('Duration') ?></th>
                                <th><?= __('Days') ?></th>
                                <th><?= __('Price (INR)') ?></th>
                                <th><?= __('Status') ?></th>
                                <th><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($plans as $plan): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td class="plan-title-cell"><?= h($plan->title) ?></td>
                                <td>
                                    <span class="plan-duration-badge">
                                        <i class="material-icons" style="font-size:13px;">date_range</i>
                                        <?= $plan->duration_months ?> Month<?= $plan->duration_months > 1 ? 's' : '' ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="plan-days-badge">
                                        <i class="material-icons" style="font-size:13px;">today</i>
                                        <?= $plan->days ?> Days
                                    </span>
                                </td>
                                <td class="plan-price-cell">₹<?= number_format((float)$plan->price, 2) ?></td>
                                <td>
                                    <button class="plan-status-<?= $plan->active ? 'active' : 'inactive' ?> plan-toggle-status"
                                            data-id="<?= $plan->id ?>"
                                            data-status="<?= $plan->active ?>">
                                        <?= $plan->active ? 'Active' : 'Inactive' ?>
                                    </button>
                                </td>
                                <td>
                                    <a href="<?= $this->Url->build(['action' => 'edit', $plan->id]); ?>"
                                       class="plan-action-btn edit-btn" title="Edit">
                                        <i class="material-icons">mode_edit</i>
                                    </a>
                                    <a href="<?= $this->Url->build(['action' => 'view', $plan->id]); ?>"
                                       class="plan-action-btn view-btn" title="View">
                                        <i class="material-icons">visibility</i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginator -->
                <div class="paginator" style="padding: 16px 20px;">
                    <ul class="pagination">
                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                    </ul>
                    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} out of {{count}} total')]) ?></p>
                </div>
            <?php else: ?>
                <div class="no-plans-wrap">
                    <i class="material-icons">loyalty</i>
                    <p><?= __('No plans found. Click "Create Plan" to add your first plan.') ?></p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<script>
$(document).on('click', '.plan-toggle-status', function() {
    var btn    = $(this);
    var planId = btn.data('id');
    var url    = '<?= $this->Url->build(['controller' => 'Plans', 'action' => 'toggleStatus']) ?>/' + planId;

    $.ajax({
        url:      url,
        type:     'POST',
        dataType: 'json',
        success: function(res) {
            if (res.success) {
                if (res.active == 1) {
                    btn.removeClass('plan-status-inactive').addClass('plan-status-active').text('Active').data('status', 1);
                } else {
                    btn.removeClass('plan-status-active').addClass('plan-status-inactive').text('Inactive').data('status', 0);
                }
            }
        }
    });
});
</script>
