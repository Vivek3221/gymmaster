<?php
   $statu = $this->Common->getstatus();
   $nofrec = $this->Common->getNoOfRec();
   $getModPayment = $this->Common->getModPayment();
   ?>
<section class="content">
   <div class="container-fluid">
      <!-- Basic Examples -->
      <div class="row clearfix">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="fixed-action-btn"><a href="<?= $this->Url->build(['controller' => 'Payments', 'action' => 'add']); ?>" class="btn btn-primary waves-effect btn-floating waves-light btn-large red"><i class="material-icons">add</i></a></div>
            <?= $this->Flash->render() ?>
            <div class="card">
               <div class="header">
                  <h2 >
                     <?= __('Payment List') ?>
                  </h2>
               </div>
               <div class="body">
                   <!--
                    <div class="box-body">
                        <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'Payments', 'action' => 'index']]) ?>
                            <div class="col-md-3">
                                <?php echo $this->Form->input('name', ['label' => __('Search by user,plan or amount'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('-- User Name --'), 'value' => $name]); ?>
                            </div>
                            <div class="col-md-2">
                                <?= $this->Form->control('mode_ofpay', ['class' => 'form-control', 'type' => 'select','empty'=>'Select Mode Of Payment','label' => 'Mode Of Payment','options'=>$getModPayment]) ?>
                            </div>            
                            <div class="col-md-2">
                                <?php echo $this->Form->input('date', ['label' => __('Email'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('Email'), 'value' => $email]); ?>
                            </div>            
                            <div class="col-md-2">
                                <?= $this->Form->input('norec', ['label' => __('No. of Records'), 'type' => 'select', 'class' => 'form-control', 'placeholder' => __('select record'), 'options' => $nofrec, 'value' => $norec]); ?>
                            </div>
                            <div class="col-md-3 marginTop25">
                                <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>
                                <?= $this->Html->link(__('Clear'), ['controller' => 'Payments'], ['class' => 'btn btn-danger']) ?>
                            </div>
                        <?= $this->Form->end() ?>
                    </div> 
                   -->
                  <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>
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
                           <td><?= ($payment->user->name)?></td>
                           <td><?= ucfirst($payment->plan_subscriber->plan_name)  ?></td>
                           <td><?= $this->Number->format($payment->amount) ?></td>
                           <td><?= $getModPayment[$payment->mode_ofpay] ?></td>
                           <td> <?= (date("d-m-Y", strtotime($payment->created))) ?></td>
                           <td><i class="material-icons" title="Edit"><?= $this->Html->link(__('mode_edit'), ['action' => 'edit', $payment['id']]) ?></i>
                           </td>
                        </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
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
   });
   
</script>