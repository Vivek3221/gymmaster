<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlanSubscriber[]|\Cake\Collection\CollectionInterface $planSubscribers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Plan Subscriber'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Payments'), ['controller' => 'Payments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="planSubscribers index large-9 medium-8 columns content">
    <h3><?= __('Plan Subscribers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('partner_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('plan_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fee') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('plan_expire_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_due_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($planSubscribers as $planSubscriber): ?>
            <tr>
                <td><?= $this->Number->format($planSubscriber->id) ?></td>
                <td><?= $planSubscriber->has('user') ? $this->Html->link($planSubscriber->user->name, ['controller' => 'Users', 'action' => 'view', $planSubscriber->user->id]) : '' ?></td>
                <td><?= $planSubscriber->has('partner') ? $this->Html->link($planSubscriber->partner->id, ['controller' => 'Partners', 'action' => 'view', $planSubscriber->partner->id]) : '' ?></td>
                <td><?= h($planSubscriber->plan_name) ?></td>
                <td><?= $this->Number->format($planSubscriber->fee) ?></td>
                <td><?= h($planSubscriber->currency) ?></td>
                <td><?= h($planSubscriber->plan_expire_date) ?></td>
                <td><?= h($planSubscriber->payment_due_date) ?></td>
                <td><?= h($planSubscriber->created) ?></td>
                <td><?= h($planSubscriber->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $planSubscriber->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $planSubscriber->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $planSubscriber->id], ['confirm' => __('Are you sure you want to delete # {0}?', $planSubscriber->id)]) ?>
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
