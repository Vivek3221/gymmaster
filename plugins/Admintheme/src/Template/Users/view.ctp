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
                                    <td><?=  $user_type[h($user['user_type'])];?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Username') ?></th>
                                    <td><?=  h($user['username']);?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Trainer') ?></th>
                                    <td><?=  h($this->Common->getSimpleName($user['trainer_userid']));?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Email') ?></th>
                                    <td><?= h($user['email']);?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Contact No.') ?></th>
                                    <td><?php echo h($user['mobile_no']);?></td>
                                </tr>

                                <tr>
                                    <th scope="row"><?= __('Status') ?></th>
                                    <?php if($user['active'] != 2) {?>
                                    
                                <td><?php echo ($user['active']) ? __('Active') : __('Inactive');?></td>
                            <?php } else {?>
                                <td>
                                    <?php echo "Enquiry";  }?>
                                </td>
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
                                <tr>
                                    <th scope="row"><?= __('Last Updated') ?></th>
                                     <?php $birthdate = ($user['modified']->format('d-M-Y')); ?>
                                    <td><?php if(!empty($user['modified'])) { echo $birthdate; } ?></td>
                                </tr>
                                   <?php if(!empty($user->payment) && (empty($usersdetail['users_type']) || ($usersdetail['users_type'] != 3 && $usersdetail['users_type'] != 5))) {    ?>
                                <tr>
                                    <th scope="row"><?= __('Payment') ?></th>
                                    <td><?= $user->payment ?></td>
                                </tr>
                                 <?php } ?>
                                  <?php if(!empty($user->b_payment) && (empty($usersdetail['users_type']) || ($usersdetail['users_type'] != 3 && $usersdetail['users_type'] != 5))) {    ?>
                                <tr>
                                    <th scope="row"><?= __('Due Payment') ?></th>
                                    <td><?= $user->b_payment ?></td>
                                </tr>
                                 <?php } ?>
                                  <?php if(isset($user->mode_ofpay) && (empty($usersdetail['users_type']) || ($usersdetail['users_type'] != 3 && $usersdetail['users_type'] != 5))) {    ?>
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
                            <?php if(!empty($user->photo)) { ?>
                               <div class="news-img">
                            <?php         
                                                $cover = '/img/' .$user->photo;
                        if (strpos($user->photo, 'http') !== false) {
                        $cover = $user->photo;
                        }
                                                ?>
                                <?= $this->Html->image($cover, ['alt' => 'related-news', 'accept' => 'image/*']); ?>
                          
                                 
                                
                             
                                
                                
                            </div>
                            <?php }?>
                        
                            <?php if(!empty($planData)) { ?>
                                <table class="vertical-table" border="1">
                                    <tr>
                                        <th>Plan Name</th>
                                        <th>Plan Fee</th>
                                        <th>Paid Amount</th>
                                        <th>Remaining Amount</th>
                                        <th>Payment Due Date</th>
                                        <th>Plan Expire Date</th>
                                    </tr>
                            <?php foreach ($planData as $planDatas) { ?>
                                    <tr>
                                        <td><?= $planDatas['name'] ?></td>
                                        <td><?= $planDatas['fee'] ?></td>
                                        <td><?= $planDatas['paid'] ?></td>
                                        <td><?= $planDatas['remaining'] ?></td>
                                        <td><?= date('d-m-Y',strtotime($planDatas['plan_expire_date'])) ?></td>
                                        <td><?= date('d-m-Y',strtotime($planDatas['payment_due_date'])) ?></td>
                                    </tr>
                            <?php } ?>
                                </table>
                            <?php } ?>

                            <?php if(!empty($userPaymentsHistory)) { ?>
                                <h3 style="margin-top:25px; font-weight: bold; font-size: 16px; color: #1e293b; border-bottom: 2px solid #6366f1; padding-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;"><?= __('Payment Transaction History') ?></h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr style="background-color: #f8fafc; color: #475569; font-size: 12px; text-transform: uppercase;">
                                                <th><?= __('Payment Date') ?></th>
                                                <th><?= __('Plan Name') ?></th>
                                                <th><?= __('Amount Received (₹)') ?></th>
                                                <th><?= __('Payment Mode') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($userPaymentsHistory as $ph) { ?>
                                            <tr>
                                                <td><?= date('d-M-Y', strtotime($ph->created)) ?></td>
                                                <td><?= !empty($ph->plan_subscriber) ? h($ph->plan_subscriber->plan_name) : 'N/A' ?></td>
                                                <td style="font-weight: 700; color: #059669;">₹<?= number_format($ph->amount, 2) ?></td>
                                                <td><?= isset($getModPayment[$ph->mode_ofpay]) ? $getModPayment[$ph->mode_ofpay] : 'Cash' ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>

                            <?php if(!empty($user->user_remarks)) { ?>
                                <h3 style="margin-top:30px; font-weight: bold; font-size: 18px; color: #333; border-bottom: 2px solid #ff9800; padding-bottom: 10px;"><?= __('Remarks & Follow-ups') ?></h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr style="background-color: #f5f5f5;">
                                                <th><?= __('Remark') ?></th>
                                                <th><?= __('Followup Date & Time') ?></th>
                                                <th><?= __('Created Date') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($user->user_remarks as $remark) { ?>
                                            <tr>
                                                <td><?= h($remark->remark) ?></td>
                                                <td><?= $remark->followup_date ? $remark->followup_date->format('d-M-Y H:i') : 'N/A' ?></td>
                                                <td><?= $remark->created ? $remark->created->format('d-M-Y H:i') : 'N/A' ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
</section>