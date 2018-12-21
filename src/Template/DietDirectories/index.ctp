<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DietDirectory[]|\Cake\Collection\CollectionInterface $dietDirectories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Diet Directory'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dietDirectories index large-9 medium-8 columns content">
    <h3><?= __('Diet Directories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('technical1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('technical2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('technical3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('technical4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('technical5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dietDirectories as $dietDirectory): ?>
            <tr>
                <td><?= $this->Number->format($dietDirectory->id) ?></td>
                <td><?= $dietDirectory->has('user') ? $this->Html->link($dietDirectory->user->name, ['controller' => 'Users', 'action' => 'view', $dietDirectory->user->id]) : '' ?></td>
                <td><?= h($dietDirectory->name) ?></td>
                <td><?= $this->Number->format($dietDirectory->user_type) ?></td>
                <td><?= h($dietDirectory->technical1) ?></td>
                <td><?= h($dietDirectory->technical2) ?></td>
                <td><?= h($dietDirectory->technical3) ?></td>
                <td><?= h($dietDirectory->technical4) ?></td>
                <td><?= h($dietDirectory->technical5) ?></td>
                <td><?= $this->Number->format($dietDirectory->status) ?></td>
                <td><?= h($dietDirectory->created) ?></td>
                <td><?= h($dietDirectory->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $dietDirectory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dietDirectory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dietDirectory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dietDirectory->id)]) ?>
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
