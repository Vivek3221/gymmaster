<?php
$user_type = $this->Common->getType();
?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header" style="display:flex; justify-content:space-between; align-items:center;">
                        <h2><?= __('View Front Desk User') ?></h2>
                        <a href="<?= $this->Url->build(['action' => 'frontDeskList']) ?>" class="btn btn-default waves-effect">
                            <i class="material-icons" style="font-size:18px; vertical-align:middle;">arrow_back</i> <?= __('Back to List') ?>
                        </a>
                    </div>
                    <div class="body">
                        <div class="contacts view large-6 medium-8 columns content">
                            <table class="vertical-table">
                                <tr>
                                    <th scope="row"><?= __('Name') ?></th>
                                    <td><?= ucfirst(h($user['name'])); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Role') ?></th>
                                    <td><?= isset($user_type[$user['user_type']]) ? $user_type[$user['user_type']] : 'Front Desk'; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Partner') ?></th>
                                    <td><?= h($this->Common->getPartnerName($user['partner_id'])); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Email') ?></th>
                                    <td><?= h($user['email']); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Contact No.') ?></th>
                                    <td><?= h($user['mobile_no']); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Emergency No.') ?></th>
                                    <td><?= h($user['emerg_no']); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Address') ?></th>
                                    <td><?= h($user['location']); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Status') ?></th>
                                    <td><?= ($user['active'] == 1) ? __('Active') : __('Inactive'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Gender') ?></th>
                                    <td><?= ($user['gender'] == 1) ? 'Male' : 'Female'; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Joined') ?></th>
                                    <td><?= !empty($user['created']) ? $user['created']->format('d-M-Y') : ''; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
