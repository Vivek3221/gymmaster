<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FitnessType[]|\Cake\Collection\CollectionInterface $fitnessType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fitness Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fitnessType index large-9 medium-8 columns content">
    <h3><?= __('Fitness Type') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('exercise_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('excercie_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fitnessType as $fitnessType): ?>
            <tr>
                <td><?= $this->Number->format($fitnessType->id) ?></td>
                <td><?= $fitnessType->has('exercise') ? $this->Html->link($fitnessType->exercise->name, ['controller' => 'Exercises', 'action' => 'view', $fitnessType->exercise->id]) : '' ?></td>
                <td><?= h($fitnessType->excercie_type) ?></td>
                <td><?= $this->Number->format($fitnessType->status) ?></td>
                <td><?= h($fitnessType->created) ?></td>
                <td><?= h($fitnessType->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $fitnessType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fitnessType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fitnessType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fitnessType->id)]) ?>
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
