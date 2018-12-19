<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FitnessTest $fitnessTest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fitness Test'), ['action' => 'edit', $fitnessTest->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fitness Test'), ['action' => 'delete', $fitnessTest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fitnessTest->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fitness Tests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fitness Test'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fitnessTests view large-9 medium-8 columns content">
    <h3><?= h($fitnessTest->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $fitnessTest->has('user') ? $this->Html->link($fitnessTest->user->name, ['controller' => 'Users', 'action' => 'view', $fitnessTest->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Exercise') ?></th>
            <td><?= $fitnessTest->has('exercise') ? $this->Html->link($fitnessTest->exercise->name, ['controller' => 'Exercises', 'action' => 'view', $fitnessTest->exercise->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($fitnessTest->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($fitnessTest->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($fitnessTest->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($fitnessTest->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Exercise Type') ?></h4>
        <?= $this->Text->autoParagraph(h($fitnessTest->exercise_type)); ?>
    </div>
</div>
