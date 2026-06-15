<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diet $diet
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Diet'), ['action' => 'edit', $diet->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Diet'), ['action' => 'delete', $diet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diet->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Diets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Diet'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="diets view large-9 medium-8 columns content">
    <h3><?= h($diet->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $diet->has('user') ? $this->Html->link($diet->user->name, ['controller' => 'Users', 'action' => 'view', $diet->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Partner') ?></th>
            <td><?= $diet->has('partner') ? $this->Html->link($diet->partner->id, ['controller' => 'Partners', 'action' => 'view', $diet->partner->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Notes') ?></th>
            <td><?= h($diet->notes) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($diet->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($diet->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($diet->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Date') ?></th>
            <td><?= h($diet->user_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($diet->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($diet->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Diet Details') ?></h4>
        <?= $this->Text->autoParagraph(h($diet->diet_details)); ?>
    </div>
    <div class="row">
        <h4><?= __('User Detail') ?></h4>
        <?= $this->Text->autoParagraph(h($diet->user_detail)); ?>
    </div>
</div>
