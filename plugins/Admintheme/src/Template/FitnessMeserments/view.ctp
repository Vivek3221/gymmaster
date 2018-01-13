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
                            <h3><?= __('Demo')?></h3>
                            <table class="vertical-table">
                                
                                </tr><tr>
                                    <th scope="row"><?= __('Name') ?></th>
                                    <th scope="row"><?= __('Current') ?></th>
                                  
                                    <th scope="row"><?= __('Previous') ?></th>
                                    
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('weight') ?></th>
                                     <?php if(isset($fitnessMeserment[0]['weight']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[0]['weight']));?></td>
                                    <?php }?>
                                   
                                    <?php if(isset($fitnessMeserment[1]['weight']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[1]['weight']));?></td>
                                    <?php }?>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Height') ?></th>
                                     <?php if(isset($fitnessMeserment[0]['height']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[0]['height']));?></td>
                                    <?php }?>
                                   
                                    <?php if(isset($fitnessMeserment[1]['height']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[1]['height']));?></td>
                                    <?php }?>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Bmi') ?></th>
                                     <?php if(isset($fitnessMeserment[0]['bmi']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[0]['bmi']));?></td>
                                    <?php }?>
                                   
                                    <?php if(isset($fitnessMeserment[1]['bmi']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[1]['bmi']));?></td>
                                    <?php }?>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Upper_arm') ?></th>
                                     <?php if(isset($fitnessMeserment[0]['upper_arm']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[0]['upper_arm']));?></td>
                                    <?php }?>
                                   
                                    <?php if(isset($fitnessMeserment[1]['upper_arm']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[1]['upper_arm']));?></td>
                                    <?php }?>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Neck') ?></th>
                                     <?php if(isset($fitnessMeserment[0]['neck']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[0]['neck']));?></td>
                                    <?php }?>
                                   
                                    <?php if(isset($fitnessMeserment[1]['neck']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[1]['neck']));?></td>
                                    <?php }?>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Chest') ?></th>
                                     <?php if(isset($fitnessMeserment[0]['chest']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[0]['chest']));?></td>
                                    <?php }?>
                                   
                                    <?php if(isset($fitnessMeserment[1]['chest']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[1]['chest']));?></td>
                                    <?php }?>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Waist') ?></th>
                                     <?php if(isset($fitnessMeserment[0]['waist']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[0]['waist']));?></td>
                                    <?php }?>
                                   
                                    <?php if(isset($fitnessMeserment[1]['waist']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[1]['waist']));?></td>
                                    <?php }?>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Hips') ?></th>
                                     <?php if(isset($fitnessMeserment[0]['hips']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[0]['hips']));?></td>
                                    <?php }?>
                                   
                                    <?php if(isset($fitnessMeserment[1]['hips']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[1]['hips']));?></td>
                                    <?php }?>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Thigh') ?></th>
                                     <?php if(isset($fitnessMeserment[0]['thigh']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[0]['thigh']));?></td>
                                    <?php }?>
                                   
                                    <?php if(isset($fitnessMeserment[1]['thigh']))
                                    {?>
                                    <td><?= ucfirst(h($fitnessMeserment[1]['thigh']));?></td>
                                    <?php }?>
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