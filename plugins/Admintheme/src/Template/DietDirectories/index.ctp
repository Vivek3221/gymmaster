<?php
   $statu = $this->Common->getstatus();
   $nofrec = $this->Common->getNoOfRec();
   $getpartner = $this->Common->getpartner();
   $getAdmin = $this->Common->getAdmin();
   ?>
<?php
   $statu = $this->Common->getstatus();
   $nofrec = $this->Common->getNoOfRec();
   $getpartner = $this->Common->getpartner();
   $getAdmin = $this->Common->getAdmin();
   ?>
<section class="content">
   <div class="container-fluid">
      <!-- Basic Examples -->
      <div class="row clearfix">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="fixed-action-btn"><a href="<?= $this->Url->build(['controller' => 'DietDirectories', 'action' => 'add']); ?>" class="btn btn-primary waves-effect btn-floating waves-light btn-large red"><i class="material-icons">add</i></a></div>
            <?= $this->Flash->render() ?>
            <div class="card">
               <div class="header">
                  <h2 >
                     <?= __('Diet Directory List') ?>
                  </h2>
               </div>
               <div class="body">
                  <div class="box-body">
                     <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'DietDirectories', 'action' => 'index']]) ?>
                     <div class="col-md-2">
                        <?php echo $this->Form->input('name', ['label' => __('Diet Name'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('-- Diet Name --'), 'value' => $name]); ?>
                     </div>
                     <div class="col-md-2">
                        <?php echo $this->Form->input('status', ['label' => __('Status'), 'class' => 'form-control', 'empty' => __('Select Status'), 'options' => $statu, 'value' => $status]); ?>
                     </div>
                     <?php if($user_type == 1)
                        { ?>
                     <div class="col-md-2">
                        <?php echo $this->Form->input('partner', ['label' => __('Partner'), 'class' => 'form-control select2', 'empty' => __('Select Partner'), 'options' => $getpartner, 'value' => $partner]); ?>
                     </div>
                     <!--                            <div class="col-md-2">
                        <?php echo $this->Form->input('admin', ['label' => __('Admin'), 'class' => 'form-control', 'empty' => __('Select Admin'), 'options' => $getAdmin, 'value' => $Admin]); ?>
                        </div>-->
                     <?php } ?>
                     <?php if($user_type == 2)
                        { ?>
                     <div class="col-md-2">
                        <?php echo $this->Form->input('admin', ['label' => __('Admin'), 'class' => 'form-control', 'empty' => __('Select Admin'), 'options' => $getAdmin, 'value' => $Admin]); ?>
                     </div>
                     <?php } ?>
                     <div class="col-md-2">
                        <?= $this->Form->input('norec', ['label' => __('No. of Records'), 'type' => 'select', 'class' => 'form-control', 'placeholder' => __('select record'), 'options' => $nofrec, 'value' => $norec]); ?>
                     </div>
                     <div class="col-md-3 marginTop25">
                        <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>
                        <?= $this->Html->link(__('Clear'), ['controller' => 'DietDirectories'], ['class' => 'btn btn-danger']) ?>
                     </div>
                     <?= $this->Form->end() ?>
                  </div>
                  <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>
                  <table class="table table-bordered table-striped table-hover dataTable responsive" id="userstable">
                     <thead>
                        <tr>
                           <th><?= __('Diet Name') ?></th>
                           <th><?= __('Status') ?></th>
                           <th><?= __('Action') ?></th>
                        </tr>
                     </thead>
                     <tfoot>
                        <tr>
                           <th><?= __('Diet Name') ?></th>
                           <th><?= __('Status') ?></th>
                           <th><?= __('Action') ?></th>
                        </tr>
                     </tfoot>
                     <tbody>
                        <?php foreach ($dietDirectories as $dietDirectory) { ?>
                        <tr>
                           <td><?= ucwords($dietDirectory['name']) ?></td>
                           <td id='status<?= $dietDirectory->id ?>'> 
                    <?php if (isset($dietDirectory->status) && $dietDirectory->status == '1') { ?>
                    
                     <?= $this->Form->button('Active', ['class' => 'btn btn-success waves-effect', 'id' => $dietDirectory->id, 'value' => $dietDirectory->status, 'onclick' => 'updateStatus(this.id,' . $dietDirectory->status . ')']) ?>
                    <?php } else { ?>
                              <?= $this->Form->button('Inactive', ['class' => 'btn btn-primary waves-effect', 'id' => $dietDirectory->id, 'value' => $dietDirectory->status, 'onclick' => 'updateStatus(this.id,' . $dietDirectory->status . ')']) ?>
                       
                        <?php } ?>
                           </td>
                           <td>
                              <i class="material-icons" title="View"><?= $this->Html->link(__('visibility'), ['action' => 'view', $dietDirectory['id']]) ?></i>
                              <i class="material-icons" title="Edit"><?= $this->Html->link(__('mode_edit'), ['action' => 'edit', $dietDirectory['id']]) ?></i>
                           </td>
                        </tr>
                        <?php } ?> 
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
<script type="text/javascript" language="javascript">
   function updateStatus(Id, Status) {
       var urllink = '<?php echo $this->Url->build(["controller" => "DietDirectories", "action" => "status"]); ?>';
       var id = Id;
       var status = Status;
       urllink = urllink + '/' + id + '/' + status;
     //  alert(urllink);
       // alert(urllink);
       if (confirm("<?= __('Are you sure! you want to change status?') ?>")) {
           $.ajax({
               url: urllink,
               type: 'GET',
               success: function (data) {
   
                   $('#status' + id).html(data);
               },
               error: function () {
               }
           });
       } else {
           return false;
       }
   }
</script>