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
                            <div class="contacts view large-9 medium-8 columns content">
                            <h3><?= h($user->first_name) ?></h3>
                            <table class="vertical-table">
                                <tr>
                                    <th scope="row"><?= __('Name') ?></th>
                                    <td><?php echo h($user['name']);?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Group(s)') ?></th>
                                    <td><?=  h($user['group_name']);?></td>
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
                                    <td><?php echo h($user['user_detail']['cellphone']);?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Location') ?></th>
                                    <td><?php echo h($user['user_detail']['location']);?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Status') ?></th>
                                    <td><?php echo ($user['active']) ? __('Active') : __('Inactive');?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Email Verified') ?></th>
                                    <td><?php echo ($user['email_verified']) ? __('Yes') : __('No');?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Ip Address') ?></th>
                                    <td><?php echo $user['ip_address'];?></td>
                                </tr>

                                <tr>
                                    <th scope="row"><?= __('Joined') ?></th>
                                     <?php $birthdate = ($user['created']->format('d-M-Y')); ?>
                                    <td><?php if(!empty($user['created'])) { echo $birthdate; } ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Created By') ?></th>
                                    <td><?php echo ($user['created_by']) ? $user['created_by'] : '';?></td>
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