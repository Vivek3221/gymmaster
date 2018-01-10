<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FitnessMeserment[]|\Cake\Collection\CollectionInterface $fitnessMeserments
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fitness Meserment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fitnessMeserments index large-9 medium-8 columns content">
    <h3><?= __('Fitness Meserments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('weight') ?></th>
                <th scope="col"><?= $this->Paginator->sort('height') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bmi') ?></th>
                <th scope="col"><?= $this->Paginator->sort('neck') ?></th>
                <th scope="col"><?= $this->Paginator->sort('upper_arm') ?></th>
                <th scope="col"><?= $this->Paginator->sort('chest') ?></th>
                <th scope="col"><?= $this->Paginator->sort('waist') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lower_abdomen') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hips') ?></th>
                <th scope="col"><?= $this->Paginator->sort('thigh') ?></th>
                <th scope="col"><?= $this->Paginator->sort('calf') ?></th>
                <th scope="col"><?= $this->Paginator->sort('whr') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tricep') ?></th>
                <th scope="col"><?= $this->Paginator->sort('abdomen') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ad_hold') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fitnessMeserments as $fitnessMeserment): ?>
            <tr>
                <td><?= $this->Number->format($fitnessMeserment->id) ?></td>
                <td><?= $fitnessMeserment->has('user') ? $this->Html->link($fitnessMeserment->user->name, ['controller' => 'Users', 'action' => 'view', $fitnessMeserment->user->id]) : '' ?></td>
                <td><?= h($fitnessMeserment->date) ?></td>
                <td><?= h($fitnessMeserment->weight) ?></td>
                <td><?= h($fitnessMeserment->height) ?></td>
                <td><?= h($fitnessMeserment->bmi) ?></td>
                <td><?= h($fitnessMeserment->neck) ?></td>
                <td><?= h($fitnessMeserment->upper_arm) ?></td>
                <td><?= h($fitnessMeserment->chest) ?></td>
                <td><?= h($fitnessMeserment->waist) ?></td>
                <td><?= h($fitnessMeserment->lower_abdomen) ?></td>
                <td><?= h($fitnessMeserment->hips) ?></td>
                <td><?= h($fitnessMeserment->thigh) ?></td>
                <td><?= h($fitnessMeserment->calf) ?></td>
                <td><?= h($fitnessMeserment->whr) ?></td>
                <td><?= h($fitnessMeserment->fat) ?></td>
                <td><?= h($fitnessMeserment->tricep) ?></td>
                <td><?= h($fitnessMeserment->abdomen) ?></td>
                <td><?= h($fitnessMeserment->ad_hold) ?></td>
                <td><?= h($fitnessMeserment->created) ?></td>
                <td><?= h($fitnessMeserment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $fitnessMeserment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fitnessMeserment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fitnessMeserment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fitnessMeserment->id)]) ?>
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
