<?php
   $statu = $this->Common->getstatus();
   $nofrec = $this->Common->getNoOfRec();
   $getModPayment = $this->Common->getModPayment();
   $user_type = $this->Common->getType();
   ?>
<section class="content">
   <div class="container-fluid">
      <!-- Basic Examples -->
      <div class="row clearfix">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render() ?>
            <div class="card">
               <div class="header">
                  <h2 >
                     <?= __('Payment List') ?>
                  </h2>
               </div>
               <div class="body">
                    <div class="box-body">
                        <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'Payments', 'action' => 'index']]) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <?php echo $this->Form->input('name', ['label' => __('Search by User, Plan or Amount'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('Search by User, Plan or Amount'), 'value' => $name]); ?>
                            </div>
                            <div class="col-md-3">
                                <?= $this->Form->control('mode_ofpay', ['class' => 'form-control', 'type' => 'select','empty'=>'Select Mode Of Payment','label' => 'Mode Of Payment','options'=>$getModPayment, 'default'=>$mode_ofpay]) ?>
                            </div> 
                            <?php if (isset($users_type) && ($users_type == 1)) { ?>  
                                <div class="col-md-3">
                                    <?= $this->Form->input('partners', ['label' => __('Partners'), 'type' => 'select', 'class' => 'form-control select2', 'empty' => __('Select Partners'), 'options' => $partners,'value'=>$partner]); ?>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <?= $this->Form->input('norec', ['label' => __('No. of Records'), 'type' => 'select', 'class' => 'form-control', 'placeholder' => __('select record'), 'options' => $nofrec, 'value' => $norec]); ?>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-md-3">
                                <?= $this->Form->input('created', ['label' => __('Select Date'), 'type' => 'text', 'class' => 'form-control date-range-picker', 'placeholder' => __('Select Date'), 'label'=>false, 'readonly'=>'readonly']); ?>
                            </div>
                            <div class="col-md-3">
                                <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>
                                <?= $this->Html->link(__('Clear'), ['controller' => 'Payments'], ['class' => 'btn btn-danger']) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Form->button(__('Total Amount: '.$amount), ['class' => 'btn btn-Success','type'=>'button']) ?>
                            </div>
                        </div>    
                        <?= $this->Form->end() ?>
                    </div> 
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
                               <i class="material-icons" title="View"><?= $this->Html->link(__('visibility'), ['action' => 'view', $payment['id']],['target'=>'_blank']) ?></i>
                               <i class="material-icons" title="Edit"><?= $this->Html->link(__('mode_edit'), ['action' => 'edit', $payment['id']]) ?></i>
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