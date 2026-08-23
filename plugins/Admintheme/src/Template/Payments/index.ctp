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
                        <?= $this->Form->control('mode_ofpay', ['class' => 'form-control', 'type' => 'select','empty'=>'Select Mode','label' => 'Mode Of Payment','options'=>$getModPayment, 'default'=>$mode_ofpay]) ?>
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
                        <?= $this->Form->input('norec', ['label' => __('No. of Records'), 'type' => 'select', 'class' => 'form-control', 'placeholder' => __('Select Records'), 'options' => $nofrec, 'value' => $norec]); ?>
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
               <div class="header">
                  <h2>
                     <?= __('Payment List') ?>
                  </h2>
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
                           <th><?= __('Payment Mode') ?></th>
                           <th><?= __('Date') ?></th>
                           <th><?= __('Action') ?></th>
                        </tr>
                     </thead>
                     <tfoot>
                        <tr>
                           <th><?=__('User Name')?></th>
                           <th><?= __('Plan Name') ?></th>
                           <th><?= __('Amount') ?></th>
                           <th><?= __('Payment Mode') ?></th>
                           <th><?= __('Date') ?></th>
                           <th><?= __('Action') ?></th>
                        </tr>
                     </tfoot>
                     <tbody>
                        <?php foreach ($payments as $payment): ?>
                        <tr>
                           <td><?= ucwords($payment->user->name)?></td>
                           <td><?= ucfirst($payment->plan_subscriber->plan_name)  ?></td>
                           <td><?= $this->Number->format($payment->amount) ?></td>
                           <td><?= $getModPayment[$payment->mode_ofpay] ?></td>
                           <td> <?= (date("d-m-Y", strtotime($payment->created))) ?></td>
                           <td>
                               <?php if (isset($users_type) && $users_type != 5) { ?>
                               <i class="material-icons" title="View"><?= $this->Html->link(__('visibility'), ['action' => 'view', $payment['id']],['target'=>'_blank']) ?></i>
                               <i class="material-icons" title="Edit"><?= $this->Html->link(__('mode_edit'), ['action' => 'edit', $payment['id']]) ?></i>
                               <?php } ?>
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
//          console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
        });
   });
   
</script>