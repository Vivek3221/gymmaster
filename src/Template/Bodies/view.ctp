<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Body $body
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Body'), ['action' => 'edit', $body->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Body'), ['action' => 'delete', $body->id], ['confirm' => __('Are you sure you want to delete # {0}?', $body->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bodies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Body'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercise'), ['controller' => 'Exercise', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercise', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bodies view large-9 medium-8 columns content">
    <h3><?= h($body->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($body->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($body->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($body->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($body->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($body->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($body->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Exercise') ?></h4>
        <?php if (!empty($body->exercise)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Body Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($body->exercise as $exercise): ?>
            <tr>
                <td><?= h($exercise->id) ?></td>
                <td><?= h($exercise->body_id) ?></td>
                <td><?= h($exercise->name) ?></td>
                <td><?= h($exercise->description) ?></td>
                <td><?= h($exercise->status) ?></td>
                <td><?= h($exercise->created) ?></td>
                <td><?= h($exercise->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Exercise', 'action' => 'view', $exercise->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Exercise', 'action' => 'edit', $exercise->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Exercise', 'action' => 'delete', $exercise->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercise->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
