<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FitnessType $fitnessType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fitness Type'), ['action' => 'edit', $fitnessType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fitness Type'), ['action' => 'delete', $fitnessType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fitnessType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fitness Type'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fitness Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fitnessType view large-9 medium-8 columns content">
    <h3><?= h($fitnessType->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Exercise') ?></th>
            <td><?= $fitnessType->has('exercise') ? $this->Html->link($fitnessType->exercise->name, ['controller' => 'Exercises', 'action' => 'view', $fitnessType->exercise->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Excercie Type') ?></th>
            <td><?= h($fitnessType->excercie_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($fitnessType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($fitnessType->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($fitnessType->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($fitnessType->modified) ?></td>
        </tr>
    </table>
</div>
