<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FitnessType $fitnessType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $fitnessType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $fitnessType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Fitness Type'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fitnessType form large-9 medium-8 columns content">
    <?= $this->Form->create($fitnessType) ?>
    <fieldset>
        <legend><?= __('Edit Fitness Type') ?></legend>
        <?php
            echo $this->Form->control('exercise_id', ['options' => $exercises]);
            echo $this->Form->control('excercie_type');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
