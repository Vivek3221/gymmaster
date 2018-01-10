<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FitnessMeserment $fitnessMeserment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fitness Meserment'), ['action' => 'edit', $fitnessMeserment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fitness Meserment'), ['action' => 'delete', $fitnessMeserment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fitnessMeserment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fitness Meserments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fitness Meserment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fitnessMeserments view large-9 medium-8 columns content">
    <h3><?= h($fitnessMeserment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $fitnessMeserment->has('user') ? $this->Html->link($fitnessMeserment->user->name, ['controller' => 'Users', 'action' => 'view', $fitnessMeserment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weight') ?></th>
            <td><?= h($fitnessMeserment->weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Height') ?></th>
            <td><?= h($fitnessMeserment->height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bmi') ?></th>
            <td><?= h($fitnessMeserment->bmi) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Neck') ?></th>
            <td><?= h($fitnessMeserment->neck) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Upper Arm') ?></th>
            <td><?= h($fitnessMeserment->upper_arm) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Chest') ?></th>
            <td><?= h($fitnessMeserment->chest) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Waist') ?></th>
            <td><?= h($fitnessMeserment->waist) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lower Abdomen') ?></th>
            <td><?= h($fitnessMeserment->lower_abdomen) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hips') ?></th>
            <td><?= h($fitnessMeserment->hips) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Thigh') ?></th>
            <td><?= h($fitnessMeserment->thigh) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Calf') ?></th>
            <td><?= h($fitnessMeserment->calf) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Whr') ?></th>
            <td><?= h($fitnessMeserment->whr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fat') ?></th>
            <td><?= h($fitnessMeserment->fat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tricep') ?></th>
            <td><?= h($fitnessMeserment->tricep) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Abdomen') ?></th>
            <td><?= h($fitnessMeserment->abdomen) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ad Hold') ?></th>
            <td><?= h($fitnessMeserment->ad_hold) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($fitnessMeserment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($fitnessMeserment->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($fitnessMeserment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($fitnessMeserment->modified) ?></td>
        </tr>
    </table>
</div>
