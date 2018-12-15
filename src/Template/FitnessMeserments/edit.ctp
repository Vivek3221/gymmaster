<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FitnessMeserment $fitnessMeserment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $fitnessMeserment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $fitnessMeserment->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Fitness Meserments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fitnessMeserments form large-9 medium-8 columns content">
    <?= $this->Form->create($fitnessMeserment) ?>
    <fieldset>
        <legend><?= __('Edit Fitness Meserment') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('date');
            echo $this->Form->control('weight');
            echo $this->Form->control('height');
            echo $this->Form->control('bmi');
            echo $this->Form->control('neck');
            echo $this->Form->control('upper_arm');
            echo $this->Form->control('chest');
            echo $this->Form->control('waist');
            echo $this->Form->control('lower_abdomen');
            echo $this->Form->control('hips');
            echo $this->Form->control('thigh');
            echo $this->Form->control('calf');
            echo $this->Form->control('whr');
            echo $this->Form->control('fat');
            echo $this->Form->control('tricep');
            echo $this->Form->control('abdomen');
            echo $this->Form->control('ad_hold');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
