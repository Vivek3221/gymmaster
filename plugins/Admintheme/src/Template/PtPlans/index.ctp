<?php
/**
 * PT Master Plans List View - DataTables Integrated
 */
?>
<style>
.pt-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid #eef2f6;
    margin-bottom: 24px;
    padding: 20px;
}
.pt-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}
.pt-title {
    font-size: 18px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.btn-accent {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: #fff !important;
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
}
.btn-accent:hover {
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}
.btn-success-gradient {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff !important;
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.badge-rate {
    background: #e0e7ff;
    color: #4338ca;
    padding: 4px 8px;
    border-radius: 6px;
    font-weight: 700;
}
</style>

<section class="content">
    <div class="container-fluid">
        <?= $this->Flash->render() ?>

        <div class="pt-card">
            <div class="pt-header">
                <h3 class="pt-title">
                    <i class="material-icons" style="color: #6366f1;">fitness_center</i>
                    <?= __('PT Master Plans Management') ?>
                </h3>
                <div style="display: flex; gap: 10px;">
                    <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn-accent">
                        <i class="material-icons" style="font-size:18px;">add_circle</i> <?= __('Create PT Master Plan') ?>
                    </a>
                    <a href="<?= $this->Url->build(['action' => 'assign']) ?>" class="btn-success-gradient">
                        <i class="material-icons" style="font-size:18px;">person_add</i> <?= __('Assign PT Plan to Member') ?>
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable responsive" id="ptMasterPlanTable" style="width:100%;">
                    <thead>
                        <tr>
                            <th><?= __('Plan Title') ?></th>
                            <?php if ($isGlobal): ?><th><?= __('Partner') ?></th><?php endif; ?>
                            <th><?= __('Duration') ?></th>
                            <th><?= __('Total Classes') ?></th>
                            <th><?= __('Total Price (₹)') ?></th>
                            <th><?= __('Per Class Rate (Client)') ?></th>
                            <th style="text-align: right;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ptPlans) && count($ptPlans) > 0): ?>
                            <?php foreach ($ptPlans as $plan): ?>
                                <tr>
                                    <td style="font-weight: 600; color: #1e293b;"><?= h($plan->title) ?></td>
                                    <?php if ($isGlobal): ?><td><?= h($plan->partner ? $plan->partner->name : 'N/A') ?></td><?php endif; ?>
                                    <td><?= h($plan->duration_months) ?> Month(s)</td>
                                    <td><strong><?= h($plan->total_classes) ?> Classes</strong></td>
                                    <td style="font-weight: 700; color: #059669;">₹<?= number_format($plan->price, 2) ?></td>
                                    <td><span class="badge-rate">₹<?= number_format($plan->per_class_rate, 2) ?> / class</span></td>
                                    <td style="text-align: right;">
                                        <a href="<?= $this->Url->build(['action' => 'edit', $plan->id]) ?>" class="btn btn-xs btn-default" style="margin-right: 4px;">
                                            <i class="material-icons" style="font-size: 16px; color: #64748b;">edit</i>
                                        </a>
                                        <?= $this->Form->postLink(
                                            '<i class="material-icons" style="font-size: 16px; color: #ef4444;">delete</i>',
                                            ['action' => 'delete', $plan->id],
                                            ['confirm' => __('Are you sure you want to delete this PT plan?'), 'escape' => false, 'class' => 'btn btn-xs btn-default']
                                        ) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $('#ptMasterPlanTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
            lengthMenu: "_MENU_"
        }
    });
});
</script>
