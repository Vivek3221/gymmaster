<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExrciseDirectory $exrciseDirectory
 */
?>
<section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="pull-left">
                               <?= __('View Exrcise Directory') ?>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="contacts view large-9 medium-8 columns content">
                            <h3><?= h($exrciseDirectory->name) ?></h3>
                            <table class="vertical-table">
                                <tr>
                                    <th scope="row"><?= __('Number of repetetion') ?></th>
                                    <td><?= h($exrciseDirectory->tecnical1) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Time') ?></th>
                                    <td><?= h($exrciseDirectory->tecnical2) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Rest') ?></th>
                                    <td><?= h($exrciseDirectory->tecnical3) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Tempo') ?></th>
                                    <td><?= h($exrciseDirectory->tecnical4) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Status') ?></th>
                                    <td><?= h($exrciseDirectory->status)? 'Active' : 'Inactive' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Created Date') ?></th>
                                    <td><?= $exrciseDirectory->created ?></td>
                                </tr>
                                
                            </table>
                           
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
</section>

