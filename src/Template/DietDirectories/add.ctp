<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DietDirectory $dietDirectory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Diet Directories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dietDirectories form large-9 medium-8 columns content">
    <?= $this->Form->create($dietDirectory) ?>
    <fieldset>
        <legend><?= __('Add Diet Directory') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('name');
            echo $this->Form->control('user_type');
            echo $this->Form->control('technical1');
            echo $this->Form->control('technical2');
            echo $this->Form->control('technical3');
            echo $this->Form->control('technical4');
            echo $this->Form->control('technical5');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
