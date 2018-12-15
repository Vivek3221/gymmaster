<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlanSubscriber $planSubscriber
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $planSubscriber->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $planSubscriber->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Plan Subscribers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Payments'), ['controller' => 'Payments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="planSubscribers form large-9 medium-8 columns content">
    <?= $this->Form->create($planSubscriber) ?>
    <fieldset>
        <legend><?= __('Edit Plan Subscriber') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('partner_id', ['options' => $partners, 'empty' => true]);
            echo $this->Form->control('plan_name');
            echo $this->Form->control('fee');
            echo $this->Form->control('currency');
            echo $this->Form->control('plan_expire_date');
            echo $this->Form->control('payment_due_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
