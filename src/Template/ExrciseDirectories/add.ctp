<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExrciseDirectory $exrciseDirectory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Exrcise Directories'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="exrciseDirectories form large-9 medium-8 columns content">
    <?= $this->Form->create($exrciseDirectory) ?>
    <fieldset>
        <legend><?= __('Add Exrcise Directory') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('tecnical1');
            echo $this->Form->control('tecnical2');
            echo $this->Form->control('tecnical3');
            echo $this->Form->control('tecnical4');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
