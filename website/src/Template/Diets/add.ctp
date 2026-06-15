<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diet $diet
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Diets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="diets form large-9 medium-8 columns content">
    <?= $this->Form->create($diet) ?>
    <fieldset>
        <legend><?= __('Add Diet') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('partner_id', ['options' => $partners, 'empty' => true]);
            echo $this->Form->control('date');
            echo $this->Form->control('diet_details');
            echo $this->Form->control('user_detail');
            echo $this->Form->control('notes');
            echo $this->Form->control('user_date', ['empty' => true]);
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
