<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DietDirectory $dietDirectory
 */
?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\dietDirectory $dietDirectory
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
                               <?= __('View Diet Directory') ?>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="contacts view large-9 medium-8 columns content">
                            <h3><?= h($dietDirectory->name) ?></h3>
                            <table class="vertical-table">
                                <tr>
                                    <th scope="row"><?= __('Point 1') ?></th>
                                    <td><?= h($dietDirectory->technical1) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Point 2') ?></th>
                                    <td><?= h($dietDirectory->technical2) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Point 3') ?></th>
                                    <td><?= h($dietDirectory->technical3) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Point 4') ?></th>
                                    <td><?= h($dietDirectory->technical4) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Point 5') ?></th>
                                    <td><?= h($dietDirectory->technical5) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Point 6') ?></th>
                                    <td><?= h($dietDirectory->technical6) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Point 7') ?></th>
                                    <td><?= h($dietDirectory->technical7) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Status') ?></th>
                                    <td><?= h($dietDirectory->status)? 'Active' : 'Inactive' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Created Date') ?></th>
                                    <td><?= $dietDirectory->created ?></td>
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

