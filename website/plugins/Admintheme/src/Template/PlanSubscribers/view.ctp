<?php
$getModPayment = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();
$user_type = $this->Common->getType();
?>
<!-- start -->
<section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 >
                               <?= __('View Plan Subscriber') ?>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="contacts view large-6 medium-8 columns content">
                                <table class="vertical-table">
                                    <tr>
                                        <th scope="row"><?= __('User') ?></th>
                                        <td><?= $planSubscriber->has('user') ? $this->Html->link($planSubscriber->user->name, ['controller' => 'Users', 'action' => 'view', $planSubscriber->user->id]) : '' ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Plan Name') ?></th>
                                        <td><?= h($planSubscriber->plan_name) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Fee') ?></th>
                                        <td><?= $this->Number->format($planSubscriber->fee) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Plan Expire Date') ?></th>
                                        <td><?= h(date('d-m-Y',strtotime($planSubscriber->plan_expire_date))) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Payment Due Date') ?></th>
                                        <td><?= h(date('d-m-Y',strtotime($planSubscriber->payment_due_date))) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Created') ?></th>
                                        <td><?= h(date('d-m-Y',strtotime($planSubscriber->created))) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Modified') ?></th>
                                        <td><?= h(date('d-m-Y',strtotime($planSubscriber->modified))) ?></td>
                                    </tr>
                                </table>
                            
                            </div>
                            <?php if(!empty($planSubscriber->payments)) { ?>
                                <table class="vertical-table" border="1">
                                    <tr>
                                        <th>Payment Amount</th>
                                        <th>Mode of Payment</th>
                                        <th>Payment Date</th>
                                    </tr>
                            <?php foreach ($planSubscriber->payments as $payments) { ?>
                                    <tr>
                                        <td><?= h($payments->amount) ?></td>
                                        <td><?= h($getModPayment[$payments->mode_ofpay]) ?></td>
                                        <td><?= date('d-m-Y H:i:s',strtotime($payments->created)) ?></td>
                                    </tr>
                            <?php } ?>
                                </table>
                            <?php } ?>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
</section>
<!-- end -->
