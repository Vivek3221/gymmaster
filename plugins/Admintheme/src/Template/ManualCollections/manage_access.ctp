<section class="content">
    <div class="container-fluid">
        <style>
            .access-card { background:#fff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.05);border:1px solid #eaeaea;margin-bottom:24px; }
            .access-card-header { background:linear-gradient(135deg,#e68a00,#ff9800);border-radius:12px 12px 0 0;padding:20px 24px;display:flex;justify-content:space-between;align-items:center; }
            .access-card-header h2 { font-size:18px;font-weight:700;color:#fff;margin:0;display:flex;align-items:center;gap:8px; }
            .access-card-body { padding:24px; }
            .access-table th { background:#f5f5f5!important;color:#444!important;font-weight:700!important;font-size:13px;text-transform:uppercase;letter-spacing:.5px;padding:12px 16px!important;border-bottom:2px solid #eaeaea!important; }
            .access-table td { padding:12px 16px!important;vertical-align:middle!important;border-bottom:1px solid #f5f5f5!important; }
            .badge-active { background:#e8f5e9;color:#2e7d32;padding:3px 10px;border-radius:10px;font-size:11px;font-weight:700; }
            .badge-inactive { background:#ffebee;color:#c62828;padding:3px 10px;border-radius:10px;font-size:11px;font-weight:700; }
            .btn-add-email { background:#ff9800!important;border-color:#ff9800!important;color:#fff!important;border-radius:6px!important;font-weight:600!important;padding:8px 18px!important; }
            .btn-add-email:hover { background:#e68a00!important;box-shadow:0 4px 12px rgba(255,152,0,.3)!important; }
            .btn-remove { background:#f44336!important;border-color:#f44336!important;color:#fff!important;border-radius:5px!important;font-weight:600!important;font-size:12px!important;padding:4px 12px!important; }
            .add-email-form { background:#fffbf5;border:1px dashed #ffcc80;border-radius:8px;padding:16px 20px;margin-bottom:20px; }
            .add-email-form label { font-weight:600;font-size:13px;color:#555; }
            .add-email-form .form-control,
            .add-email-form input[type=email] {
                border-radius: 6px !important;
                border: 1px solid #ffcc80 !important;
                padding: 8px 12px !important;
                font-size: 13px !important;
                background: #fff !important;
                box-shadow: none !important;
                outline: none !important;
            }
            .add-email-form .form-control:focus,
            .add-email-form input[type=email]:focus {
                border-color: #ff9800 !important;
                box-shadow: 0 0 0 2px rgba(255,152,0,.18) !important;
                outline: none !important;
            }
            .section-label { font-weight:700;color:#e65100;font-size:13px;margin-bottom:12px;display:flex;align-items:center;gap:6px; }
            .section-label i { font-size:16px; }
            .back-btn { background:#fff!important;color:#555!important;border:1px solid rgba(255,255,255,.5)!important;border-radius:6px!important;font-weight:600!important;padding:7px 14px!important;display:inline-flex;align-items:center;gap:6px;font-size:13px!important;text-decoration:none; }
        </style>

        <?= $this->Flash->render() ?>

        <div class="row clearfix">
            <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1">

                <div class="access-card">
                    <div class="access-card-header">
                        <h2>
                            <i class="material-icons">vpn_key</i>
                            <?= __('Manual Collection — Access Management') ?>
                        </h2>
                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="back-btn">
                            <i class="material-icons" style="font-size:18px;">arrow_back</i> <?= __('Back') ?>
                        </a>
                    </div>
                    <div class="access-card-body">

                        <p style="color:#666;font-size:13px;margin-bottom:16px;">
                            <i class="material-icons" style="font-size:16px;vertical-align:middle;color:#ff9800;">info</i>
                            <?= __('Only the emails listed below (with Active status) can access the Manual Collection module.') ?>
                        </p>

                        <!-- Add Email Form -->
                        <div class="add-email-form">
                            <p class="section-label">
                                <i class="material-icons">person_add</i>
                                <?= __('Grant Access to New Email') ?>
                            </p>
                            <?= $this->Form->create(null, ['url' => ['action' => 'manageAccess'], 'type' => 'post', 'templates' => ['inputContainer' => '{{content}}']]) ?>
                            <input type="hidden" name="form_action" value="add">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group" style="margin-bottom:10px;">
                                        <label><?= __('Email Address') ?></label>
                                        <input type="email" name="new_email" class="form-control" placeholder="user@example.com" required>
                                    </div>
                                </div>
                                <div class="col-md-4" style="display:flex;align-items:flex-end;">
                                    <button type="submit" class="btn btn-add-email waves-effect">
                                        <i class="material-icons" style="font-size:18px;vertical-align:middle;">add</i>
                                        <?= __('Grant Access') ?>
                                    </button>
                                </div>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>

                        <!-- Access List Table -->
                        <div class="table-responsive">
                            <table class="table access-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('Email') ?></th>
                                        <th><?= __('Added By') ?></th>
                                        <th><?= __('Status') ?></th>
                                        <th><?= __('Created') ?></th>
                                        <th><?= __('Action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($accessList)): ?>
                                        <tr>
                                            <td colspan="6" class="text-center" style="padding:30px;color:#888;">
                                                <i class="material-icons" style="font-size:40px;display:block;margin-bottom:8px;color:#ffcc80;">people_outline</i>
                                                <?= __('No access entries yet.') ?>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($accessList as $i => $row): ?>
                                        <tr style="<?= $row['is_active'] ? '' : 'opacity:.55;' ?>">
                                            <td><?= $i + 1 ?></td>
                                            <td style="font-weight:600;"><?= h($row['email']) ?></td>
                                            <td><?= h($row['added_by'] ?? '—') ?></td>
                                            <td>
                                                <?php if ($row['is_active']): ?>
                                                    <span class="badge-active"><i class="material-icons" style="font-size:12px;vertical-align:middle;">check_circle</i> Active</span>
                                                <?php else: ?>
                                                    <span class="badge-inactive"><i class="material-icons" style="font-size:12px;vertical-align:middle;">block</i> Revoked</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= h($row['created']) ?></td>
                                            <td>
                                                <?php if ($row['is_active']): ?>
                                                    <?= $this->Form->create(null, ['url' => ['action' => 'manageAccess'], 'type' => 'post', 'style' => 'display:inline;', 'templates' => ['inputContainer' => '{{content}}']]) ?>
                                                    <input type="hidden" name="form_action" value="remove">
                                                    <input type="hidden" name="email_id" value="<?= (int)$row['id'] ?>">
                                                    <button type="submit" class="btn btn-remove" onclick="return confirm('Revoke access for <?= h($row['email']) ?>?')">
                                                        <i class="material-icons" style="font-size:14px;vertical-align:middle;">block</i>
                                                        <?= __('Revoke') ?>
                                                    </button>
                                                    <?= $this->Form->end() ?>
                                                <?php else: ?>
                                                    <span style="color:#999;font-size:12px;"><?= __('Revoked') ?></span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
