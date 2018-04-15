<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExrciseDirectory $exrciseDirectory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Exrcise Directory'), ['action' => 'edit', $exrciseDirectory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Exrcise Directory'), ['action' => 'delete', $exrciseDirectory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exrciseDirectory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Exrcise Directories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exrcise Directory'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="exrciseDirectories view large-9 medium-8 columns content">
    <h3><?= h($exrciseDirectory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tecnical1') ?></th>
            <td><?= h($exrciseDirectory->tecnical1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tecnical2') ?></th>
            <td><?= h($exrciseDirectory->tecnical2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tecnical3') ?></th>
            <td><?= h($exrciseDirectory->tecnical3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tecnical4') ?></th>
            <td><?= h($exrciseDirectory->tecnical4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($exrciseDirectory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($exrciseDirectory->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($exrciseDirectory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($exrciseDirectory->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Name') ?></h4>
        <?= $this->Text->autoParagraph(h($exrciseDirectory->name)); ?>
    </div>
</div>
