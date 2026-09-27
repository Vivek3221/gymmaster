<?php
   $statu = $this->Common->getstatus();
   $nofrec = $this->Common->getNoOfRec();
   $getModPayment = $this->Common->getModPayment();
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
                margin-top: 15px !important;
                grid-column: 1 / -1;
                justify-content: flex-end;
                align-items: center;
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
                height: 34px !important;
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
                text-decoration: none !important;
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

            .filter-group select.form-control,
            .filter-group .input.select select,
            .filter-group div.select select {
                border-radius: 6px !important;
                border: 1px solid #dcdcdc !important;
                padding: 6px 12px !important;
                height: 34px !important;
                font-size: 13px !important;
                box-shadow: none !important;
                transition: all 0.3s ease;
                background-color: #fafafa !important;
                color: #555 !important;
                appearance: none !important;
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                background-image: url("data:image/svg+xml;utf8,<svg fill='%23888888' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>") !important;
                background-repeat: no-repeat !important;
                background-position: right 10px center !important;
                background-size: 16px !important;
                padding-right: 30px !important;
                width: 100% !important;
            }
            .filter-group select.form-control:focus,
            .filter-group .input.select select:focus,
            .filter-group div.select select:focus {
                border-color: #ff9800 !important;
                background-color: #fff !important;
                box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
            }

             /* Action Circle Buttons */
             .action-btn-circle {
                 display: inline-flex !important;
                 align-items: center !important;
                 justify-content: center !important;
                 width: 32px !important;
                 height: 32px !important;
                 border-radius: 50% !important;
                 background: #f8fafc !important;
                 border: 1px solid #e2e8f0 !important;
                 transition: all 0.2s ease !important;
                 text-decoration: none !important;
                 cursor: pointer;
             }
             .action-btn-circle:hover {
                 transform: translateY(-2px);
                 box-shadow: 0 3px 8px rgba(0,0,0,0.12);
             }
             .action-btn-circle.view-btn:hover { background: #e1f5fe !important; border-color: #81d4fa !important; }
             .action-btn-circle.edit-btn:hover { background: #fff3e0 !important; border-color: #ffb74d !important; }
             .action-btn-circle.delete-btn:hover { background: #ffebee !important; border-color: #ef9a9a !important; }
      </style>

      <div class="row clearfix">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render() ?>

            <!-- Modern Filter Section -->
            <div class="filter-card">
                <div class="filter-card-title">
                    <i class="material-icons">filter_list</i>
                    <span><?= __('Filter & Search Payments') ?></span>
                </div>
                <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'Payments', 'action' => 'index']]) ?>
                <div class="filter-grid">
                    <div class="filter-group">
                        <?php echo $this->Form->input('name', ['label' => __('Search'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('User, Plan or Amount'), 'value' => $name]); ?>
                    </div>
                    <div class="filter-group">
                        <?= $this->Form->control('mode_ofpay', ['class' => 'form-control select2', 'type' => 'select','empty'=>'Select Mode','label' => 'Mode Of Payment','options'=>$getModPayment, 'default'=>$mode_ofpay]) ?>
                    </div> 
                    <?php if (isset($users_type) && ($users_type == 1)) { ?>  
                        <div class="filter-group">
                            <?= $this->Form->input('partners', ['label' => __('Partners'), 'type' => 'select', 'class' => 'form-control select2', 'empty' => __('Select Partners'), 'options' => $partners,'value'=>$partner]); ?>
                        </div>
                    <?php } ?>
                    <div class="filter-group">
                        <label><?= __('Select Date Range') ?></label>
                        <?= $this->Form->input('created', ['type' => 'text', 'class' => 'form-control date-range-picker', 'placeholder' => __('Select Date Range'), 'label'=>false, 'readonly'=>'readonly']); ?>
                    </div>
                    <div class="filter-group">
                        <?= $this->Form->input('norec', ['label' => __('No. of Records'), 'type' => 'select', 'class' => 'form-control select2', 'placeholder' => __('Select Records'), 'options' => $nofrec, 'value' => $norec]); ?>
                    </div>
                </div>    
                <div class="filter-actions">
                    <div style="margin-right: auto;">
                        <span class="btn btn-success" style="cursor: default; background-color: #4caf50 !important; border-color: #4caf50 !important; color: #fff !important; font-weight: 600 !important; padding: 6px 16px !important; border-radius: 6px !important; height: 34px !important; display: inline-flex; align-items: center; gap: 6px; font-size: 13px;"><i class="material-icons" style="font-size: 18px;">monetization_on</i> Total Amount: ₹<?= h($amount) ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect"><i class="material-icons">search</i> Search</button>
                    <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="btn btn-danger waves-effect"><i class="material-icons">clear</i> Clear</a>
                </div>
                <?= $this->Form->end() ?>
            </div>

            <!-- Payments List Card -->
            <div class="card modern-card">
               <div class="header" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
                  <h2 style="margin:0;">
                     <?= __('Payment List') ?>
                  </h2>
                  <?php if (!empty($isDeleteRoot)): ?>
                     <a href="<?= $this->Url->build(['action' => 'manageDeleteAccess']); ?>" class="btn btn-warning waves-effect" style="background-color:#c62828!important;border-color:#c62828!important;color:#fff!important;font-weight:600;border-radius:6px;padding:6px 14px;font-size:12px;display:inline-flex;align-items:center;gap:6px;">
                        <i class="material-icons" style="font-size:16px;">security</i> <?= __('Manage Delete Permissions') ?>
                     </a>
                  <?php endif; ?>
               </div>
               <div class="body">
                  <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>
                    <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable responsive" id="userstable">
                     <thead>
                        <tr>
                           <th><?=__('User Name')?></th>
                           <th><?= __('Plan Name') ?></th>
                           <th><?= __('Amount') ?></th>
                           <th><?= __('Discount') ?></th>
                           <th><?= __('Payment Mode') ?></th>
                           <th><?= __('Payment Date') ?></th>
                           <th><?= __('Action') ?></th>
                        </tr>
                     </thead>
                     <tfoot>
                        <tr>
                           <th><?=__('User Name')?></th>
                           <th><?= __('Plan Name') ?></th>
                           <th><?= __('Amount') ?></th>
                           <th><?= __('Discount') ?></th>
                           <th><?= __('Payment Mode') ?></th>
                           <th><?= __('Payment Date') ?></th>
                           <th><?= __('Action') ?></th>
                        </tr>
                     </tfoot>
                     <tbody>
                        <?php foreach ($payments as $payment): ?>
                        <tr>
                           <td><?= ucwords($payment->user->name)?></td>
                           <td><?= ucfirst($payment->plan_subscriber->plan_name)  ?></td>
                           <td style="font-weight:700;">₹<?= $this->Number->format($payment->amount) ?></td>
                           <td>
                              <?php if (!empty($payment->discount_percent) && $payment->discount_percent > 0): ?>
                                 <span class="badge" style="background-color:#e8f5e9;color:#2e7d32;font-size:11px;font-weight:700;padding:4px 8px;border-radius:4px;border:1px solid #c8e6c9;" title="<?= h($payment->discount_reason) ?>">
                                    <?= $payment->discount_percent ?>% (-₹<?= $this->Number->format($payment->discount_amount) ?>)
                                 </span>
                              <?php else: ?>
                                 <span style="color:#aaa;">—</span>
                              <?php endif; ?>
                           </td>
                           <td><?= h($getModPayment[$payment->mode_ofpay ?? '0'] ?? 'By Cash') ?></td>
                           <td>
                               <?php
                               if (!empty($payment->payment_date)) {
                                   if ($payment->payment_date instanceof \Cake\I18n\FrozenDate || $payment->payment_date instanceof \Cake\I18n\FrozenTime) {
                                       echo $payment->payment_date->format('d-m-Y');
                                   } else {
                                       echo date('d-m-Y', strtotime($payment->payment_date));
                                   }
                               } else {
                                   echo !empty($payment->created) ? (
                                       $payment->created instanceof \Cake\I18n\FrozenDate || $payment->created instanceof \Cake\I18n\FrozenTime
                                           ? $payment->created->format('d-m-Y')
                                           : date('d-m-Y', strtotime($payment->created))
                                   ) : 'N/A';
                               }
                               ?>
                           </td>
                           <td style="text-align:center; vertical-align:middle;">
                                <div style="display:inline-flex; align-items:center; justify-content:center; gap:8px;">
                                    <?php if (isset($users_type) && $users_type != 5) { ?>
                                        <a href="<?= $this->Url->build(['action' => 'view', $payment['id']]) ?>" target="_blank" class="action-btn-circle view-btn" title="<?= __('View') ?>">
                                            <i class="material-icons" style="font-size:18px;color:#0288d1;">visibility</i>
                                        </a>
                                        <a href="<?= $this->Url->build(['action' => 'edit', $payment['id']]) ?>" class="action-btn-circle edit-btn" title="<?= __('Edit') ?>">
                                            <i class="material-icons" style="font-size:18px;color:#ff9800;">edit</i>
                                        </a>
                                    <?php } ?>
                                    <?php if (!empty($canDeletePayment)): ?>
                                        <a href="javascript:void(0);" onclick="openPaymentDeleteModal(<?= $payment->id ?>, '<?= h(addslashes($payment->user->name)) ?>', '<?= $this->Number->format($payment->amount) ?>')" class="action-btn-circle delete-btn" title="<?= __('Delete Payment') ?>">
                                            <i class="material-icons" style="font-size:18px;color:#e53935;">delete</i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
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
<script>
   $(document).ready(function () {
        $('#date-end').bootstrapMaterialDatePicker({ format : 'YYYY/MM/DD HH:mm', weekStart : 0 , time: 'false'});
        $('#date-start').bootstrapMaterialDatePicker({format : 'YYYY/MM/DD HH:mm', weekStart : 0 , time: 'false'}).on('change', function(e, date)
        {
        $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
        });
        
         $('.date-range-picker').daterangepicker({
            "showDropdowns": true,
            "ranges": {
                      'Today': [moment(), moment()],
                      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                      'This Month': [moment().startOf('month'), moment().endOf('month')],
                      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
            "locale": {
                "direction": "ltr",
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Apply",
                "cancelLabel": "Cancel",
                "fromLabel": "From",
                "toLabel": "To",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "Su",
                    "Mo",
                    "Tu",
                    "We",
                    "Th",
                    "Fr",
                    "Sa"
                ],
                "monthNames": [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December"
                ],
                "firstDay": 1
            },
            "startDate": "<?= $startDate ?>",
            "endDate": "<?= $endDate ?>"
        }, function(start, end, label) {
        });

        if ($.fn.select2) {
            $('.select2').select2({ width: '100%' });
        }
   });

   function openPaymentDeleteModal(paymentId, userName, amount) {
       $('#del_payment_id').val(paymentId);
       $('#del_user_name').text(userName);
       $('#del_amount').text('₹' + amount);
       $('#del_reason').val('');
       var baseUrl = '<?= $this->Url->build(['controller' => 'Payments', 'action' => 'delete']) ?>';
       $('#deletePaymentForm').attr('action', baseUrl + '/' + paymentId);
       $('#paymentDeleteModal').modal('show');
   }
</script>

<!-- Payment Delete Confirmation Modal -->
<div class="modal fade" id="paymentDeleteModal" tabindex="-1" role="dialog" aria-labelledby="paymentDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top:100px;">
        <div class="modal-content" style="border-radius:10px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.2);">
            <form id="deletePaymentForm" method="post" action="<?= $this->Url->build(['controller' => 'Payments', 'action' => 'delete']) ?>">
                <?php
                $delCsrf = $this->request->getParam('_csrfToken');
                if (empty($delCsrf) && method_exists($this->request, 'cookie')) {
                    $delCsrf = $this->request->cookie('_csrfToken');
                }
                if (empty($delCsrf) && isset($_COOKIE['csrfToken'])) {
                    $delCsrf = $_COOKIE['csrfToken'];
                }
                ?>
                <input type="hidden" name="_csrfToken" value="<?= h($delCsrf) ?>">
                <div class="modal-header" style="background:#c62828;color:#fff;padding:16px 20px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff;opacity:.8;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="paymentDeleteModalLabel" style="font-weight:700;display:flex;align-items:center;gap:8px;margin:0;">
                        <i class="material-icons" style="font-size:22px;">warning</i>
                        <?= __('Confirm Payment Deletion') ?>
                    </h4>
                </div>
                <div class="modal-body" style="padding:24px 20px;">
                    <p style="font-size:14px;color:#333;margin-bottom:12px;">
                        <?= __('Are you sure you want to delete this payment record for') ?> <strong id="del_user_name"></strong> (Amount: <strong id="del_amount"></strong>)?
                    </p>
                    <div class="alert alert-warning" style="font-size:12px;padding:10px 14px;border-radius:6px;background:#fff8e1;border:1px solid #ffe082;color:#b78103;">
                        <i class="material-icons" style="font-size:16px;vertical-align:middle;">info</i>
                        <?= __('This action is restricted to privileged administrators and requires an audit reason. The record will be safely soft-deleted.') ?>
                    </div>
                    <div class="form-group" style="margin-top:16px;margin-bottom:0;">
                        <label for="del_reason" style="font-weight:700;color:#c62828;font-size:13px;">
                            <?= __('Reason for Deletion') ?> <span style="color:red;">*</span>:
                        </label>
                        <textarea name="deletion_reason" id="del_reason" class="form-control" rows="3" required placeholder="<?= __('Enter mandatory deletion reason (e.g. accidental entry, duplicate payment, refund, etc.)') ?>" style="border:1px solid #ef9a9a;border-radius:6px;padding:10px;resize:vertical;"></textarea>
                    </div>
                    <input type="hidden" id="del_payment_id" name="payment_id">
                </div>
                <div class="modal-footer" style="background:#fafafa;padding:12px 20px;display:flex;justify-content:flex-end;gap:10px;">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="font-weight:600;border-radius:6px;padding:6px 14px;">
                        <?= __('Cancel') ?>
                    </button>
                    <button type="submit" class="btn btn-danger waves-effect" style="background-color:#c62828!important;border-color:#c62828!important;font-weight:600;border-radius:6px;padding:6px 16px;">
                        <i class="material-icons" style="font-size:16px;vertical-align:middle;">delete_forever</i>
                        <?= __('Delete Payment') ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>