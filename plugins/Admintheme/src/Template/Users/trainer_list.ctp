<?php
$statu = $this->Common->getUserStatus();
$nofrec = $this->Common->getNoOfRec();
$user_type = $this->Common->getType();

?>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <style>
            /* Modern Filter Section */
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
            .filter-actions .btn-danger:hover {
                background-color: #d32f2f !important;
                border-color: #d32f2f !important;
                box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3) !important;
            }

            /* Modern Table & Card Style */
            .card.modern-card {
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
                border: 1px solid #eaeaea;
                overflow: hidden;
                background: #fff;
            }
            .card.modern-card .header {
                background: #fafafa;
                border-bottom: 1px solid #eaeaea;
                padding: 20px 24px;
            }
            .card.modern-card .header h2 {
                font-size: 18px;
                font-weight: 700;
                color: #333;
                margin: 0;
            }
            .card.modern-card .body {
                padding: 24px;
            }
            .table-responsive.list-page {
                border: none;
                margin-top: 15px;
            }
            #userstable {
                border-collapse: separate;
                border-spacing: 0;
                width: 100% !important;
            }
            #userstable th {
                background-color: #f5f5f5 !important;
                color: #444 !important;
                font-weight: 700 !important;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border-bottom: 2px solid #eaeaea !important;
                padding: 14px 16px !important;
            }
            #userstable td {
                padding: 14px 16px !important;
                vertical-align: middle !important;
                border-bottom: 1px solid #eaeaea !important;
                color: #555;
                font-size: 14px;
            }
            #userstable tbody tr:hover td {
                background-color: #fbfbfb;
            }
            
            /* Modern Badges for Status */
            .status-badge {
                font-weight: bold !important;
                font-size: 11px !important;
                text-transform: uppercase !important;
                letter-spacing: 0.8px !important;
                padding: 6px 12px !important;
                border-radius: 30px !important;
                display: inline-block !important;
                text-align: center !important;
                border: none !important;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            .status-badge.active-badge {
                background-color: #e8f5e9 !important;
                color: #2e7d32 !important;
            }
            .status-badge.active-badge:hover {
                background-color: #c8e6c9 !important;
                transform: translateY(-1px);
            }
            .status-badge.inactive-badge {
                background-color: #ffebee !important;
                color: #c62828 !important;
            }
            .status-badge.inactive-badge:hover {
                background-color: #ffcdd2 !important;
                transform: translateY(-1px);
            }
            .status-badge.enquiry-badge {
                background-color: #fff3e0 !important;
                color: #ef6c00 !important;
                cursor: default;
            }

            /* Action Icons modern style */
            .action-btn-container {
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .action-icon-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 32px;
                height: 32px;
                border-radius: 8px;
                background: #f5f5f5;
                color: #555 !important;
                text-decoration: none !important;
                transition: all 0.2s ease;
                border: 1px solid #e0e0e0;
            }
            .action-icon-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }
            .action-icon-btn i {
                font-size: 18px !important;
            }
            .action-icon-btn.view-btn:hover {
                background: #e0f7fa;
                color: #00838f !important;
                border-color: #b2ebf2;
            }
            .action-icon-btn.edit-btn:hover {
                background: #fff8e1;
                color: #ff8f00 !important;
                border-color: #ffe082;
            }
            .action-icon-btn.delete-btn:hover {
                background: #ffebee;
                color: #c62828 !important;
                border-color: #ffcdd2;
            }
            
            /* Modern Floating Button */
            .fixed-action-btn .btn-floating {
                background-color: #ff9800 !important;
                box-shadow: 0 4px 14px rgba(255, 152, 0, 0.4) !important;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .fixed-action-btn .btn-floating:hover {
                transform: scale(1.1) rotate(90deg);
                box-shadow: 0 6px 20px rgba(255, 152, 0, 0.6) !important;
            }
            
            /* Style Select2 to match modern form controls */
            .select2-container {
                width: 100% !important;
            }
            .select2-container .select2-selection--single {
                border: 1px solid #dcdcdc !important;
                border-radius: 6px !important;
                height: 34px !important;
                background-color: #fafafa !important;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                box-shadow: none !important;
            }
            .select2-container .select2-selection--single:focus,
            .select2-container.select2-container--open .select2-selection--single {
                border-color: #ff9800 !important;
                background-color: #fff !important;
                box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
            }
            .select2-container .select2-selection--single .select2-selection__rendered {
                padding-left: 12px !important;
                padding-right: 30px !important;
                color: #555 !important;
                font-size: 13px !important;
                line-height: 32px !important;
            }
            .select2-container .select2-selection--single .select2-selection__arrow {
                height: 32px !important;
                right: 8px !important;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            /* Style Bootstrap Select dropdown toggle */
            .filter-group .bootstrap-select {
                width: 100% !important;
                height: 34px !important;
                padding: 0 !important;
                border: none !important;
            }
            .filter-group .bootstrap-select .btn.dropdown-toggle {
                border-radius: 6px !important;
                border: 1px solid #dcdcdc !important;
                padding: 6px 12px !important;
                height: 34px !important;
                font-size: 13px !important;
                background-color: #fafafa !important;
                color: #555 !important;
                box-shadow: none !important;
                display: flex;
                align-items: center;
                justify-content: space-between;
                text-transform: none !important;
            }
            
            /* General HTML select fallback */
            .filter-group select.form-control {
                border-radius: 6px !important;
                border: 1px solid #dcdcdc !important;
                padding: 6px 12px !important;
                height: 34px !important;
                font-size: 13px !important;
                box-shadow: none !important;
                transition: all 0.3s ease;
                background-color: #fafafa !important;
                color: #555 !important;
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
            }
            .filter-group select.form-control:focus {
                border-color: #ff9800 !important;
                background-color: #fff !important;
                box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
            }
            section.content {
                overflow-x: hidden !important;
            }
        </style>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="fixed-action-btn"><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'trainerAdd']); ?>" class="btn btn-primary waves-effect btn-floating waves-light btn-large red"><i class="material-icons">add</i></a></div>
                <?= $this->Flash->render() ?>

                <div class="filter-card">
                    <div class="filter-card-title">
                        <i class="material-icons">filter_list</i>
                        <span><?= __('Filter & Search Trainers') ?></span>
                    </div>
                    <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'Users', 'action' => 'trainerList']]) ?>
                    <div class="filter-grid">
                        <div class="filter-group">
                            <?php echo $this->Form->input('name', ['label' => __('Trainer Name'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('-- Trainer Name --'), 'value' => $name]); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('email', ['label' => __('Email'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('Email'), 'value' => $email]); ?>
                        </div>
                        <div class="filter-group">
                            <?= $this->Form->input('norec', ['label' => __('No. of Records'), 'type' => 'select', 'class' => 'form-control', 'placeholder' => __('select record'), 'options' => $nofrec, 'value' => $norec]); ?>
                        </div>
                        <div class="filter-group">
                            <?php echo $this->Form->input('status', ['label' => __('Status'), 'class' => 'form-control', 'empty' => __('Select Status'), 'options' => $statu, 'value' => $status]); ?>
                        </div>
                        
                        <div class="filter-actions">
                            <?= $this->Form->button('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">search</i> ' . __('Search'), ['class' => 'btn btn-primary waves-effect', 'escapeTitle' => false]) ?>
                            <?= $this->Html->link('<i class="material-icons" style="font-size: 18px; vertical-align: middle;">clear_all</i> ' . __('Clear'), ['controller' => 'Users', 'action' => 'trainerList'], ['class' => 'btn btn-danger waves-effect', 'escape' => false]) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>

                <div class="card modern-card">
                    <div class="header">
                        <h2>
                            <?= __('Trainer List') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>

                            <div class="table-responsive list-page">
                                <table class="table table-bordered table-striped" id="userstable">

                                    <thead>
                                        <tr>
                                            <th><?= __('Name') ?></th>
                                            <th><?= __('Email') ?></th>
                                            <th><?= __('Gender') ?></th>
                                            <th><?= __('Status') ?></th>
                                            <th><?= __('Action') ?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><?= __('Name') ?></th>
                                            <th><?= __('Email') ?></th>
                                            <th><?= __('Gender') ?></th>
                                            <th><?= __('Status') ?></th>
                                            <th><?= __('Action') ?></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <?php foreach ($users as $user) { ?>
                                            <tr>
                                                <td><?= ucfirst($user['name']) ?></td>
                                                <td><?= ($user['email']) ?></td>
                                                <td><?php if ($user['gender'] == 1) {
                                                        echo 'Male';
                                                     } else {
                                                        echo 'Female';
                                                     } ?></td>

                                                <?php if ($user->active  != '2') { ?>
                                                    <td id='status<?= $user->id ?>'>
                                                        <?php
                                                        if (isset($user->active)  && $user->active == '1') {
                                                        ?>
                                                            <?= $this->Form->button('Active', ['class' => 'status-badge active-badge waves-effect', 'id' => $user->id, 'value' => $user->active, 'onclick' => 'updateStatus(this.id,' . $user->active . ')']) ?>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <?= $this->Form->button('Inactive', ['class' => 'status-badge inactive-badge waves-effect', 'id' => $user->id, 'value' => $user->active, 'onclick' => 'updateStatus(this.id,' . $user->active . ')']) ?>
                                                        <?php } ?>
                                                    </td><?php } else { ?>
                                                    <td><?= $this->Form->button('Enquiry', ['class' => 'status-badge enquiry-badge non-click', 'id' => $user->id, 'value' => $user->active]) ?>
                                                    </td> <?php } ?>
                                                <td>
                                                    <div class="action-btn-container">
                                                        <a href="<?= $this->Url->build(['action' => 'trainerView', $user['id']]); ?>" class="action-icon-btn view-btn" title="View">
                                                            <i class="material-icons">visibility</i>
                                                        </a>
                                                        <a href="<?= $this->Url->build(['action' => 'trainerEdit', $user['id']]); ?>" class="action-icon-btn edit-btn" title="Edit">
                                                            <i class="material-icons">mode_edit</i>
                                                        </a>
                                                        <?php
                                                        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com', 'makeover672@gmail.com'];
                                                        if (isset($usersdetail['users_email']) && in_array($usersdetail['users_email'], $allowedEmails)):
                                                        ?>
                                                            <?= $this->Form->postLink(
                                                                '<i class="material-icons">delete_sweep</i>',
                                                                ['action' => 'softDelete', $user['id']],
                                                                [
                                                                    'escape' => false,
                                                                    'class' => 'action-icon-btn delete-btn btn-delete-confirm',
                                                                    'title' => __('Delete'),
                                                                    'data-name' => h(ucfirst($user['name']))
                                                                ]
                                                            ) ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginator">
                                <ul class="pagination">
                                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                    <?= $this->Paginator->numbers() ?>
                                    <?= $this->Paginator->next(__('next') . ' >') ?>
                                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                                </ul>
                                <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>

                            </div>
                        <?php } else { ?>
                            <div>&nbsp;</div>
                            <div class="text-center">
                                <div class="text-center noDataFound">
                                    <strong><?= __('Record') ?></strong> <?= __('not found') ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        // Intercept delete confirmation
        $('.btn-delete-confirm').each(function() {
            var onclickAction = $(this).attr('onclick');
            if (onclickAction) {
                $(this).data('onclick-action', onclickAction);
                $(this).removeAttr('onclick');
            }
        });

        $(document).on('click', '.btn-delete-confirm', function(e) {
            e.preventDefault();
            var link = $(this);
            var name = link.data('name') || 'this record';
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete " + name + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    var action = link.data('onclick-action');
                    if (action) {
                        new Function(action)();
                    }
                }
            });
        });
    });

    function updateVerified(clicked_id, verified) {
        var id = clicked_id;
        $('#' + id + '').prop('disabled', true);
        var verified = verified;
        var urls = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'verifiedUpdate']) ?>';
        var data = '&id=' + escape(id) + '&verified=' + escape(verified);

        Swal.fire({
            title: 'Are you sure?',
            text: "Are you sure to verify user?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ff9800',
            cancelButtonColor: '#888',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    data: data,
                    url: urls,
                    success: function(html) {
                        $('#verified' + id + '').html(html);
                    }
                });
            } else {
                $('#' + id + '').prop('disabled', false);
            }
        });
    }

    function updateStatus(Id, Status) {
        var urllink = '<?php echo $this->Url->build(["controller" => "Users", "action" => "status"]); ?>';
        var id = Id;
        var status = Status;
        urllink = urllink + '/' + id + '/' + status;

        Swal.fire({
            title: 'Are you sure?',
            text: "<?= __('Are you sure you want to change trainer status?') ?>",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ff9800',
            cancelButtonColor: '#888',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: urllink,
                    type: 'GET',
                    success: function(data) {
                        $('#status' + id).html(data);
                    },
                    error: function() {}
                });
            }
        });
    }
</script>