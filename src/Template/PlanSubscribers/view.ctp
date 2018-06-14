<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlanSubscriber $planSubscriber
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Plan Subscriber'), ['action' => 'edit', $planSubscriber->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Plan Subscriber'), ['action' => 'delete', $planSubscriber->id], ['confirm' => __('Are you sure you want to delete # {0}?', $planSubscriber->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Plan Subscribers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan Subscriber'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Payments'), ['controller' => 'Payments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="planSubscribers view large-9 medium-8 columns content">
    <h3><?= h($planSubscriber->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $planSubscriber->has('user') ? $this->Html->link($planSubscriber->user->name, ['controller' => 'Users', 'action' => 'view', $planSubscriber->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Partner') ?></th>
            <td><?= $planSubscriber->has('partner') ? $this->Html->link($planSubscriber->partner->id, ['controller' => 'Partners', 'action' => 'view', $planSubscriber->partner->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Plan Name') ?></th>
            <td><?= h($planSubscriber->plan_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($planSubscriber->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($planSubscriber->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fee') ?></th>
            <td><?= $this->Number->format($planSubscriber->fee) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Plan Expire Date') ?></th>
            <td><?= h($planSubscriber->plan_expire_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Due Date') ?></th>
            <td><?= h($planSubscriber->payment_due_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($planSubscriber->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($planSubscriber->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Payments') ?></h4>
        <?php if (!empty($planSubscriber->payments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Partner Id') ?></th>
                <th scope="col"><?= __('Plan Subscriber Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Currency') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($planSubscriber->payments as $payments): ?>
            <tr>
                <td><?= h($payments->id) ?></td>
                <td><?= h($payments->user_id) ?></td>
                <td><?= h($payments->partner_id) ?></td>
                <td><?= h($payments->plan_subscriber_id) ?></td>
                <td><?= h($payments->amount) ?></td>
                <td><?= h($payments->currency) ?></td>
                <td><?= h($payments->created) ?></td>
                <td><?= h($payments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Payments', 'action' => 'view', $payments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Payments', 'action' => 'edit', $payments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Payments', 'action' => 'delete', $payments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
