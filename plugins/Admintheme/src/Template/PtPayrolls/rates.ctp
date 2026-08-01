<style>
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
.filter-actions .btn-danger {
    background-color: #f44336 !important;
    border-color: #f44336 !important;
    color: #fff !important;
}
.header-actions {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.header-actions .btn {
    font-weight: 600;
    font-size: 13px;
    border-radius: 6px;
    padding: 8px 18px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
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
    display: flex;
    justify-content: space-between;
    align-items: center;
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
.status-badge {
    font-weight: bold;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 6px 12px;
    border-radius: 30px;
    display: inline-block;
    text-align: center;
}
.status-badge.inactive-badge {
    background-color: #ffebee;
    color: #c62828;
}
.status-badge.active-badge {
    background-color: #e8f5e9;
    color: #2e7d32;
}
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
.action-icon-btn.edit-btn:hover {
    background: #ede7f6;
    color: #4527a0 !important;
    border-color: #d1c4e9;
}
.action-icon-btn.delete-btn:hover {
    background: #ffebee;
    color: #c62828 !important;
    border-color: #ffcdd2;
}
.select2-container .select2-selection--single {
    border: 1px solid #dcdcdc !important;
    border-radius: 6px !important;
    height: 34px !important;
    background-color: #fafafa !important;
}
</style>

<section class="content">
    <div class="container-fluid">
        <!-- Top Actions Bar -->
        <div class="header-actions">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-default waves-effect" style="border: 1px solid #ccc; background:#fff; color:#555;">
                <i class="material-icons">arrow_back</i> <?= __('Back to Dashboard') ?>
            </a>
            <?= $this->Html->link('<i class="material-icons">add</i> ' . __('Add PT Rate'), ['action' => 'addRate'], ['class' => 'btn btn-primary waves-effect', 'escape' => false]) ?>
        </div>

        <?= $this->Flash->render() ?>

        <!-- Filters Card -->
        <div class="filter-card">
            <div class="filter-card-title">
                <i class="material-icons">filter_list</i>
                <span><?= __('Filter PT Rates') ?></span>
            </div>
            <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['action' => 'rates']]) ?>
            <div class="filter-grid">
                <?php if ($isGlobal) { ?>
                    <div class="filter-group">
                        <?= $this->Form->input('partner_id', ['label' => __('Partner'), 'type' => 'select', 'class' => 'form-control select2', 'empty' => __('All Partners'), 'options' => $partners, 'value' => $partnerId]) ?>
                    </div>
                <?php } ?>
                <div class="filter-group">
                    <?= $this->Form->input('trainer_id', ['label' => __('Trainer'), 'type' => 'select', 'class' => 'form-control select2', 'empty' => __('All Trainers'), 'options' => $trainers, 'value' => $trainerId]) ?>
                </div>

                <div class="filter-actions">
                    <?= $this->Form->button('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">search</i> ' . __('Search'), ['class' => 'btn btn-primary waves-effect', 'escapeTitle' => false]) ?>
                    <?= $this->Html->link('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">clear_all</i> ' . __('Clear'), ['action' => 'rates'], ['class' => 'btn btn-danger waves-effect', 'escape' => false]) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>

        <!-- Main Rates List -->
        <div class="card modern-card">
            <div class="header">
                <h2><?= __('Trainer PT Rates Management') ?></h2>
            </div>
            <div class="body">
                <?php if ($rates->count() > 0) { ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><?= __('Trainer Name') ?></th>
                                    <th><?= __('Partner Name') ?></th>
                                    <th><?= __('Rate Per Class') ?></th>
                                    <th><?= __('Effective From') ?></th>
                                    <th><?= __('Status') ?></th>
                                    <th style="width: 120px; text-align: center;"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rates as $rate) { ?>
                                    <tr>
                                        <td><?= h($rate->trainer->name) ?></td>
                                        <td><?= h($rate->partner->name) ?></td>
                                        <td><strong>₹<?= number_format($rate->rate_per_class, 2) ?></strong></td>
                                        <td><?= $rate->effective_from ? $rate->effective_from->format('d-m-Y') : 'N/A' ?></td>
                                        <td>
                                            <?php if ($rate->status == 1) { ?>
                                                <span class="status-badge active-badge"><?= __('Active') ?></span>
                                            <?php } else { ?>
                                                <span class="status-badge inactive-badge"><?= __('Inactive') ?></span>
                                            <?php } ?>
                                        </td>
                                        <td align="center">
                                            <div class="action-btn-container">
                                                <a href="<?= $this->Url->build(['action' => 'editRate', $rate->id]) ?>" class="action-icon-btn edit-btn" title="<?= __('Edit Rate') ?>">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <?= $this->Form->postLink(
                                                    '<i class="material-icons">delete</i>',
                                                    ['action' => 'deleteRate', $rate->id],
                                                    [
                                                        'escape' => false,
                                                        'class' => 'action-icon-btn delete-btn',
                                                        'title' => __('Delete Rate'),
                                                        'confirm' => __('Are you sure you want to delete this PT rate?')
                                                    ]
                                                ) ?>
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
                    <div class="text-center" style="padding: 40px 0;">
                        <i class="material-icons" style="font-size: 48px; color: #ccc;">info_outline</i>
                        <p style="margin-top: 10px; font-size: 16px; color: #888;"><?= __('No trainer rates configured.') ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $('.select2').select2({
        width: '100%'
    });
});
</script>
