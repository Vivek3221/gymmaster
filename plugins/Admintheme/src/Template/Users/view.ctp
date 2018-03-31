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
                               <?= __('View User') ?>
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
                                    <th scope="row"><?= __('Uesr Type') ?></th>
                                    <td><?=  h($user['user_type'])? __('Admin') : __('User');?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Username') ?></th>
                                    <td><?=  h($user['username']);?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Email') ?></th>
                                    <td><?= h($user['email']);?></td>
                                </tr>
<!--                                <tr>
                                    
                                    <th scope="row"><?= __('Birthday') ?></th>
                                    <td><?php if(!empty($user['bday'])) { echo date('d M Y',strtotime($user['bday'])); } ?></td>
                                </tr>-->
                                <tr>
                                    <th scope="row"><?= __('Contact No.') ?></th>
                                    <td><?php echo h($user['mobile_no']);?></td>
                                </tr>

                                <tr>
                                    <th scope="row"><?= __('Status') ?></th>
                                    <td><?php echo ($user['active']) ? __('Active') : __('Inactive');?></td>
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
                                    <th scope="row"><?= __('Joined') ?></th>
                                     <?php $birthdate = ($user['created']->format('d-M-Y')); ?>
                                    <td><?php if(!empty($user['created'])) { echo $birthdate; } ?></td>
                                </tr>
                                  <?php if(!empty($user->payment)) {    ?>
                                <tr>
                                    <th scope="row"><?= __('Payment') ?></th>
                                    <td><?= $user->payment ?></td>
                                </tr>
                                 <?php } ?>
                                  <?php if(isset($user->b_payment)) {    ?>
                                <tr>
                                    <th scope="row"><?= __('Due Payment') ?></th>
                                    <td><?= $user->b_payment ?></td>
                                </tr>
                                 <?php } ?>
                                  <?php if(isset($user->mode_ofpay)) {    ?>
                                <tr>
                                    <th scope="row"><?= __('Mode ofpay') ?></th>
                                    <td><?= $getModPayment[$user->mode_ofpay] ?></td>
                                </tr>
                                 <?php } ?>
                                  <?php if(!empty($user->course_duration)) {    ?>
                                <tr>
                                    <th scope="row"><?= __('Course duration') ?></th>
                                    <td><?= $getPayDuration[$user->course_duration] ?></td>
                                </tr>
                                 <?php } ?>

                            </table>
                            
                        </div>
                               <div class="news-img">
                                 <?php if(!empty($user->photo)) {    
                                                $cover = '/img/' .$user->photo;
                        if (strpos($user->photo, 'http') !== false) {
                        $cover = $user->photo;
                        }
                                                ?>
                                <?= $this->Html->image($cover, ['alt' => 'related-news', 'accept' => 'image/*']); ?>
                          
                                 <?php }?>
                                
                             
                                
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
</section>