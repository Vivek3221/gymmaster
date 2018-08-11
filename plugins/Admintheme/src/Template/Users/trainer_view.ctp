<?php
$getModPayment = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();
$user_type = $this->Common->getType();
?>

<section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 >
                               <?= __('Trainer Information') ?>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="contacts view large-6 medium-8 columns content">
                            <table class="vertical-table">
                                <tr>
                                    <th scope="row"><?= __('Name') ?></th>
                                    <td><?= ucfirst(h($user['name']));?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Email') ?></th>
                                    <td><?= h($user['email']);?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Address') ?></th>
                                    <td><?= h($user['location']);?></td>
                                </tr>

                                <tr>
                                    <th scope="row"><?= __('Mobile No.') ?></th>
                                    <td><?php echo h($user['mobile_no']);?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Emergency No.') ?></th>
                                    <td><?php echo h($user['emerg_no']);?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Gender') ?></th>
                                    <td><?php
                                        if ($user['gender'] == 1)
                                            echo 'Male';
                                        else {
                                            echo 'Female';
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Birthday') ?></th>
                                    <td><?php if(!empty($user['dob'])) { echo date('d M Y',strtotime($user['dob'])); } ?></td>
                                </tr>                                
                                <tr>
                                    
                                    <th scope="row"><?= __('Status') ?></th>
                                    <?php if($user['active'] != 2) {?>
                                    
                                <td><?php echo ($user['active']) ? __('Active') : __('Inactive');?></td>
                            <?php }?>
                                </tr>

                                <tr>
                                    <th scope="row"><?= __('Joined') ?></th>
                                     <?php $birthdate = ($user['created']->format('d-M-Y')); ?>
                                    <td><?php if(!empty($user['created'])) { echo $birthdate; } ?></td>
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