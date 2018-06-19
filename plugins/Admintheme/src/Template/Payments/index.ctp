<?php
   $statu = $this->Common->getstatus();
   $nofrec = $this->Common->getNoOfRec();
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
                  <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>
                  <table class="table table-bordered table-striped table-hover dataTable responsive" id="userstable">
                     <thead>
                        <tr>
                           <th><?=__('User Name')?></th>
                           <th><?= __('Plan Name') ?></th>
                           <th><?= __('Amount') ?></th>
                           <th><?= __('Date') ?></th>
                           <th><?= __('Action') ?></th>
                        </tr>
                     </thead>
                     <tfoot>
                        <tr>
                           <th><?=__('User Name')?></th>
                           <th><?= __('Plan Name') ?></th>
                           <th><?= __('Amount') ?></th>
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
                           <td> <?= (date("d-m-Y", strtotime($payment->created))) ?></td>
                           <td><i class="material-icons"><?= $this->Html->link(__('visibility'), ['action' => 'view', $payment['id']]) ?></i>
                              <i class="material-icons"><?= $this->Html->link(__('mode_edit'), ['action' => 'edit', $payment['id']]) ?></i>
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