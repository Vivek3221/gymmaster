<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DietDirectory $dietDirectory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Diet Directory'), ['action' => 'edit', $dietDirectory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Diet Directory'), ['action' => 'delete', $dietDirectory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dietDirectory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Diet Directories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Diet Directory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dietDirectories view large-9 medium-8 columns content">
    <h3><?= h($dietDirectory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $dietDirectory->has('user') ? $this->Html->link($dietDirectory->user->name, ['controller' => 'Users', 'action' => 'view', $dietDirectory->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($dietDirectory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Technical1') ?></th>
            <td><?= h($dietDirectory->technical1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Technical2') ?></th>
            <td><?= h($dietDirectory->technical2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Technical3') ?></th>
            <td><?= h($dietDirectory->technical3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Technical4') ?></th>
            <td><?= h($dietDirectory->technical4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Technical5') ?></th>
            <td><?= h($dietDirectory->technical5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($dietDirectory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Type') ?></th>
            <td><?= $this->Number->format($dietDirectory->user_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($dietDirectory->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($dietDirectory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($dietDirectory->modified) ?></td>
        </tr>
    </table>
</div>
