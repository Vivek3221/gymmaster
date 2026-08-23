<?php
$statu = $this->Common->getUserStatus();
$nofrec = $this->Common->getNoOfRec();
$user_type = $this->Common->getType();
?>
<section class="content">
    <div class="container-fluid">
        <style>
            .filter-card {
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
                padding: 14px 20px !important;
                margin-bottom: 20px !important;
                border: 1px solid #eaeaea;
            }
            .filter-card-title {
                font-size: 15px !important;
                font-weight: 600;
                color: #333;
                margin-bottom: 12px !important;
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .filter-card-title i {
                color: #ff9800;
                vertical-align: middle;
            }
            .filter-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 12px 16px !important;
            }
            @media (max-width: 768px) {
                .filter-grid {
                    grid-template-columns: 1fr;
                }
            }
            .filter-group {
                margin-bottom: 0 !important;
            }
            .filter-group label {
                font-weight: 600;
                font-size: 12px !important;
                color: #555;
                margin-bottom: 5px !important;
                display: block;
            }
            .filter-group .form-control {
                border-radius: 6px !important;
                border: 1px solid #dcdcdc !important;
                padding: 6px 12px !important;
                height: 34px !important;
                font-size: 13px !important;
                box-shadow: none !important;
                transition: all 0.3s ease;
                background-color: #fafafa;
            }
            .filter-group .form-control:focus {
                border-color: #ff9800 !important;
                background-color: #fff;
                box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
            }
            .filter-actions {
                display: flex;
                gap: 8px;
                margin-top: 5px !important;
                grid-column: 1 / -1;
                justify-content: flex-end;
            }
            .filter-actions .btn {
                border-radius: 6px !important;
                padding: 6px 16px !important;
                font-weight: 600 !important;
                font-size: 13px !important;
                letter-spacing: 0.5px;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                height: auto !important;
            }
            .filter-actions .btn-primary {
                background-color: #ff9800 !important;
                border-color: #ff9800 !important;
                color: #fff !important;
            }
            .filter-actions .btn-primary:hover {
                background-color: #e68a00 !important;
                border-color: #e68a00 !important;
                box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3) !important;
            }
            .filter-actions .btn-danger {
                background-color: #f44336 !important;
                border-color: #f44336 !important;
                color: #fff !important;
            }
            .action-btn-container {
                display: flex;
                align-items: center;
                gap: 6px;
            }
            .action-icon-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 32px;
                height: 32px;
                border-radius: 6px;
                color: #fff !important;
                text-decoration: none !important;
                transition: all 0.2s ease;
            }
            .action-icon-btn i {
                font-size: 18px;
            }
            .view-btn { background-color: #2196F3; }
            .edit-btn { background-color: #FF9800; }
            .delete-btn { background-color: #F44336; border: none; }
        </style>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $this->Flash->render() ?>

                <div class="filter-card">
                    <div class="filter-card-title">
                        <i class="material-icons">filter_list</i>
                        <span><?= __('Filter & Search Front Desk Users') ?></span>
                    </div>
                    <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'Users', 'action' => 'frontDeskList']]) ?>
                    <div class="filter-grid">
                        <div class="filter-group">
                            <?php echo $this->Form->input('name', ['label' => __('Name'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('Name'), 'value' => $name]); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('email', ['label' => __('Email'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('Email'), 'value' => $email]); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('mobile', ['label' => __('Mobile No'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('Mobile No'), 'value' => $mobile]); ?>
                        </div>

                        <?php if (isset($users_type) && ($users_type == 1)) { ?>
                            <div class="filter-group">
                                <?= $this->Form->input('partners', ['label' => __('Partner'), 'type' => 'select', 'class' => 'form-control select2', 'empty' => __('Select Partner'), 'options' => $partners, 'value' => $partner]); ?>
                            </div>
                        <?php } ?>

                        <div class="filter-group">
                            <?= $this->Form->input('status', ['label' => __('Status'), 'type' => 'select', 'class' => 'form-control', 'empty' => __('Select Status'), 'options' => $statu, 'value' => $status]); ?>
                        </div>

                        <div class="filter-actions">
                            <button type="submit" class="btn btn-primary waves-effect">
                                <i class="material-icons">search</i> <?= __('Search') ?>
                            </button>
                            <a href="<?= $this->Url->build(['action' => 'frontDeskList']) ?>" class="btn btn-danger waves-effect">
                                <i class="material-icons">refresh</i> <?= __('Reset') ?>
                            </a>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>

                <div class="card">
                    <div class="header" style="display:flex; justify-content:space-between; align-items:center;">
                        <h2><?= __('Front Desk Users') ?></h2>
                        <a href="<?= $this->Url->build(['action' => 'frontDeskAdd']) ?>" class="btn btn-warning waves-effect" style="background:#ff9800; color:#fff; font-weight:bold; border-radius:6px;">
                            <i class="material-icons" style="font-size:18px; vertical-align:middle;">add</i> <?= __('Add Front Desk User') ?>
                        </a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="frontdesktable">
                                <thead>
                                    <tr>
                                        <th><?= __('Name') ?></th>
                                        <th><?= __('Email') ?></th>
                                        <th><?= __('Mobile No') ?></th>
                                        <?php if (isset($users_type) && ($users_type == 1)) { ?>
                                            <th><?= __('Partner') ?></th>
                                        <?php } ?>
                                        <th><?= __('Gender') ?></th>
                                        <th><?= __('Status') ?></th>
                                        <th><?= __('Action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                        <tr>
                                            <td><?= ucfirst(h($user['name'])) ?></td>
                                            <td><?= h($user['email']) ?></td>
                                            <td><?= h($user['mobile_no']) ?></td>
                                            <?php if (isset($users_type) && ($users_type == 1)) { ?>
                                                <td><?= h($this->Common->getPartnerName($user['partner_id'])) ?></td>
                                            <?php } ?>
                                            <td><?= ($user['gender'] == 1) ? 'Male' : 'Female' ?></td>
                                            <td>
                                                <span class="label <?= ($user['active'] == 1) ? 'label-success' : 'label-danger' ?>">
                                                    <?= ($user['active'] == 1) ? __('Active') : __('Inactive') ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-btn-container">
                                                    <a href="<?= $this->Url->build(['action' => 'frontDeskView', $user['id']]); ?>" class="action-icon-btn view-btn" title="View">
                                                        <i class="material-icons">visibility</i>
                                                    </a>
                                                    <a href="<?= $this->Url->build(['action' => 'frontDeskEdit', $user['id']]); ?>" class="action-icon-btn edit-btn" title="Edit">
                                                        <i class="material-icons">mode_edit</i>
                                                    </a>
                                                    <?= $this->Form->postLink(
                                                        '<i class="material-icons">delete_sweep</i>',
                                                        ['action' => 'softDelete', $user['id']],
                                                        [
                                                            'escape' => false,
                                                            'class' => 'action-icon-btn delete-btn',
                                                            'title' => __('Delete'),
                                                            'confirm' => __('Are you sure you want to delete {0}?', $user['name'])
                                                        ]
                                                    ) ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
