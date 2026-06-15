<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diet[]|\Cake\Collection\CollectionInterface $diets
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Diet'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="diets index large-9 medium-8 columns content">
    <h3><?= __('Diets') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('partner_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('notes') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($diets as $diet): ?>
            <tr>
                <td><?= $this->Number->format($diet->id) ?></td>
                <td><?= $diet->has('user') ? $this->Html->link($diet->user->name, ['controller' => 'Users', 'action' => 'view', $diet->user->id]) : '' ?></td>
                <td><?= $diet->has('partner') ? $this->Html->link($diet->partner->id, ['controller' => 'Partners', 'action' => 'view', $diet->partner->id]) : '' ?></td>
                <td><?= h($diet->date) ?></td>
                <td><?= h($diet->notes) ?></td>
                <td><?= h($diet->user_date) ?></td>
                <td><?= $this->Number->format($diet->status) ?></td>
                <td><?= h($diet->created) ?></td>
                <td><?= h($diet->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $diet->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $diet->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $diet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diet->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
</div>
