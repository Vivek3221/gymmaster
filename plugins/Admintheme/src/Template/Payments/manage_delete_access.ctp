<section class="content">
    <div class="container-fluid">
        <style>
            .access-card { background:#fff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.05);border:1px solid #eaeaea;margin-bottom:24px; }
            .access-card-header { background:linear-gradient(135deg,#c62828,#e53935);border-radius:12px 12px 0 0;padding:20px 24px;display:flex;justify-content:space-between;align-items:center; }
            .access-card-header h2 { font-size:18px;font-weight:700;color:#fff;margin:0;display:flex;align-items:center;gap:8px; }
            .access-card-body { padding:24px; }
            .access-table th { background:#f5f5f5!important;color:#444!important;font-weight:700!important;font-size:13px;text-transform:uppercase;letter-spacing:.5px;padding:12px 16px!important;border-bottom:2px solid #eaeaea!important; }
            .access-table td { padding:12px 16px!important;vertical-align:middle!important;border-bottom:1px solid #f5f5f5!important; }
            .badge-active { background:#e8f5e9;color:#2e7d32;padding:3px 10px;border-radius:10px;font-size:11px;font-weight:700; }
            .badge-inactive { background:#ffebee;color:#c62828;padding:3px 10px;border-radius:10px;font-size:11px;font-weight:700; }
            .badge-root { background:#fff3e0;color:#e65100;padding:3px 10px;border-radius:10px;font-size:11px;font-weight:700;border:1px solid #ffcc80; }
            .btn-add-email { background:#e53935!important;border-color:#e53935!important;color:#fff!important;border-radius:6px!important;font-weight:600!important;padding:8px 18px!important; }
            .btn-add-email:hover { background:#c62828!important;box-shadow:0 4px 12px rgba(229,57,53,.3)!important; }
            .btn-remove { background:#f44336!important;border-color:#f44336!important;color:#fff!important;border-radius:5px!important;font-weight:600!important;font-size:12px!important;padding:4px 12px!important; }
            .add-email-form { background:#fff8f8;border:1px dashed #ef9a9a;border-radius:8px;padding:16px 20px;margin-bottom:20px; }
            .add-email-form label { font-weight:600;font-size:13px;color:#555; }
            .add-email-form .form-control,
            .add-email-form input[type=email] {
                border-radius: 6px !important;
                border: 1px solid #ef9a9a !important;
                padding: 8px 12px !important;
                font-size: 13px !important;
                background: #fff !important;
                box-shadow: none !important;
                outline: none !important;
            }
            .add-email-form .form-control:focus,
            .add-email-form input[type=email]:focus {
                border-color: #e53935 !important;
                box-shadow: 0 0 0 2px rgba(229,57,53,.18) !important;
                outline: none !important;
            }
            .section-label { font-weight:700;color:#c62828;font-size:13px;margin-bottom:12px;display:flex;align-items:center;gap:6px; }
            .section-label i { font-size:16px; }
            .back-btn { background:#fff!important;color:#555!important;border:1px solid rgba(255,255,255,.5)!important;border-radius:6px!important;font-weight:600!important;padding:7px 14px!important;display:inline-flex;align-items:center;gap:6px;font-size:13px!important;text-decoration:none; }
        </style>

        <?= $this->Flash->render() ?>

        <div class="row clearfix">
            <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1">

                <div class="access-card">
                    <div class="access-card-header">
                        <h2>
                            <i class="material-icons">security</i>
                            <?= __('Payment & Payout Deletion — Access Delegation') ?>
                        </h2>
                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="back-btn">
                            <i class="material-icons" style="font-size:18px;">arrow_back</i> <?= __('Back') ?>
                        </a>
                    </div>
                    <div class="access-card-body">

                        <p style="color:#666;font-size:13px;margin-bottom:16px;">
                            <i class="material-icons" style="font-size:16px;vertical-align:middle;color:#e53935;">info</i>
                            <?= __('Only the two primary protected administrators and delegated emails listed below can delete payments and trainer payouts. Root administrators cannot be removed.') ?>
                        </p>

                        <!-- Add Email Form -->
                        <div class="add-email-form">
                            <div class="section-label">
                                <i class="material-icons">person_add</i>
                                <?= __('Delegate Deletion Permission to User') ?>
                            </div>
                            <?= $this->Form->create(null, ['type' => 'post', 'url' => ['action' => 'manageDeleteAccess']]) ?>
                                <input type="hidden" name="form_action" value="add">
                                <div class="row" style="margin-bottom:0;">
                                    <div class="col-sm-8 col-xs-12" style="margin-bottom:8px;">
                                        <input type="email" name="new_email" class="form-control" placeholder="<?= __('Enter user email to grant permission') ?>" required style="width:100%;">
                                    </div>
                                    <div class="col-sm-4 col-xs-12" style="margin-bottom:8px;">
                                        <button type="submit" class="btn btn-add-email waves-effect" style="width:100%;height:38px;display:flex;align-items:center;justify-content:center;gap:6px;">
                                            <i class="material-icons" style="font-size:18px;">add</i>
                                            <?= __('Grant Permission') ?>
                                        </button>
                                    </div>
                                </div>
                            <?= $this->Form->end() ?>
                        </div>

                        <!-- Access List Table -->
                        <div class="table-responsive" style="margin-top:10px;">
                            <table class="table access-table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('Email Address') ?></th>
                                        <th><?= __('Role / Type') ?></th>
                                        <th><?= __('Status') ?></th>
                                        <th><?= __('Granted By') ?></th>
                                        <th><?= __('Date Added') ?></th>
                                        <th style="text-align:center;"><?= __('Action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $rootEmails = ['mukeshkr3221@gmail.com', 'ad1234@yopmail.com'];
                                    foreach ($accessList as $idx => $entry): 
                                        $isRoot = in_array(strtolower(trim($entry['email'])), $rootEmails);
                                    ?>
                                        <tr>
                                            <td><?= $idx + 1 ?></td>
                                            <td style="font-weight:600;color:#333;">
                                                <i class="material-icons" style="font-size:16px;vertical-align:middle;color:#888;margin-right:4px;">email</i>
                                                <?= h($entry['email']) ?>
                                            </td>
                                            <td>
                                                <?php if ($isRoot): ?>
                                                    <span class="badge-root"><?= __('Primary Root Admin') ?></span>
                                                <?php else: ?>
                                                    <span style="color:#666;font-size:12px;"><?= __('Delegated') ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($entry['is_active']): ?>
                                                    <span class="badge-active"><?= __('Active') ?></span>
                                                <?php else: ?>
                                                    <span class="badge-inactive"><?= __('Revoked') ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="font-size:12px;color:#777;"><?= h($entry['granted_by'] ?: 'system') ?></td>
                                            <td style="font-size:12px;color:#777;">
                                                <?= !empty($entry['created']) ? date('d M Y', strtotime($entry['created'])) : '—' ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php if (!$isRoot): ?>
                                                    <?php if ($entry['is_active']): ?>
                                                        <?= $this->Form->create(null, ['type' => 'post', 'url' => ['action' => 'manageDeleteAccess'], 'style' => 'display:inline;']) ?>
                                                            <input type="hidden" name="form_action" value="remove">
                                                            <input type="hidden" name="permission_id" value="<?= $entry['id'] ?>">
                                                            <button type="submit" class="btn btn-remove waves-effect" onclick="return confirm('<?= __('Are you sure you want to revoke deletion permission for this user?') ?>');">
                                                                <i class="material-icons" style="font-size:14px;vertical-align:middle;">block</i>
                                                                <?= __('Revoke') ?>
                                                            </button>
                                                        <?= $this->Form->end() ?>
                                                    <?php else: ?>
                                                        <span style="color:#aaa;font-size:12px;font-style:italic;"><?= __('Revoked') ?></span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span style="color:#999;font-size:12px;font-style:italic;">
                                                        <i class="material-icons" style="font-size:14px;vertical-align:middle;">lock</i> <?= __('Protected') ?>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
