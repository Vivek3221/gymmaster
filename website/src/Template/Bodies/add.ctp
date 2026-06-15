<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Body $body
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Bodies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exercise'), ['controller' => 'Exercise', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercise', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bodies form large-9 medium-8 columns content">
    <?= $this->Form->create($body) ?>
    <fieldset>
        <legend><?= __('Add Body') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
