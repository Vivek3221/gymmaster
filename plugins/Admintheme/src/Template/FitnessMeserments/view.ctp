<?php
$getModPayment = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();
?>

<section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 >
                               <?= __('View fitnessMeserment') ?>
                            </h2>
              
                        </div>
                        <div class="body">
                            <div class="contacts view large-6 medium-8 columns content">
                            <h3><?= h($fitnessMeserment->first_name) ?></h3>
                            <table class="vertical-table">
                                <tr>
                                    <th scope="row"><?= __('weight') ?></th>
                                    <td><?= ucfirst(h($fitnessMeserment['weight']));?></td>
                                </tr><tr>
                                    <th scope="row"><?= __('height') ?></th>
                                    <td><?=  h($fitnessMeserment['height']);?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('bmi') ?></th>
                                    <td><?= h($fitnessMeserment['bmi']);?></td>
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