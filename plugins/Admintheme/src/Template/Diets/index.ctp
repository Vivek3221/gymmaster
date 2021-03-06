

<?php
$statu = $this->Common->getstatus();
$nofrec = $this->Common->getNoOfRec();
$partners = $this->Common->getpartner();
?>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if($user_type != 3) {?>
                <div class="fixed-action-btn" title="Add diet"><a href="<?= $this->Url->build(['controller' => 'diets', 'action' => 'add']); ?>" class="btn btn-primary waves-effect btn-floating waves-light btn-large red"><i class="material-icons">add</i></a></div>
                <?php } ?>
               <?= $this->Flash->render() ?>
                <div class="card">
                    <div class="header">
                        <h2 >
                            <?= __('Diets List') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="box-body">
                            <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'diets', 'action' => 'index']]) ?>
                            <?php if($user_type != 3){?>
                            <div class="col-md-3">
                                <?php echo $this->Form->input('name', ['label' => __('User Name'), 'class' => 'form-control select2', 'type' => 'select', 'empty' => __('User Name'), 'value' => $name,'options'=> $users]); ?>
                            </div>
                            <?php } ?>
                             <?php if (isset($user_type) && ($user_type == 1)) {
                                    ?> 
                            <div class="col-md-2">
                                        <?= $this->Form->input('partners', ['label' => __('Partners'), 'type' => 'select', 'class' => 'form-control select2', 'empty' => __('Select Partners'), 'options' => $partners,'value'=>$partner]); ?>
                            </div>

                                 <?php } ?>
                            
                            <div class="col-md-2">
                                <?php echo $this->Form->input('from_date', ['label' => __('From Date'), 'class' => 'form-control', 'id' => 'date-start', 'type' => 'text', 'placeholder' => __('From Date'), 'value' => $sdate]); ?>
                            </div>
                            <div class="col-md-2">
                                <?php echo $this->Form->input('to_date', ['label' => __('To Date'), 'class' => 'form-control', 'id' => 'date-end', 'type' => 'text', 'placeholder' => __('To Date'), 'value' => $edate]); ?>
                            </div>
                            <?php if($user_type != 3){?>
                            <div class="col-md-2">
                                <?php echo $this->Form->input('status', ['label' => __('Status'), 'class' => 'form-control', 'empty' => __('Select Status'), 'options' => $statu, 'value' => $status]); ?>
                            </div>
                            <?php  } ?>
                            <div class="col-md-2">
                                <?= $this->Form->input('norec', ['label' => __('No. of Records'), 'type' => 'select', 'class' => 'form-control', 'placeholder' => __('select record'), 'options' => $nofrec, 'value' => $norec]); ?>
                            </div>
                            <div class="col-md-3 marginTop25">
                                <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>
                                <?= $this->Html->link(__('Clear'), ['controller' => 'diets'], ['class' => 'btn btn-danger']) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                        <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>
                             <div class="table-responsive list-page">
                            <table class="table table-bordered table-striped table-hover dataTable responsive" id="userstable">
                                <thead>
                                    <tr>
                                        <th><?= __('User') ?></th>
                                        <!-- <th><?= __('Body Weight') ?></th> -->
                                        <!-- <th><?= __('Comment') ?></th> -->
                                        <th><?= __('Date') ?></th>
                                        <!-- <th><?= __('Type') ?></th> -->
                                       <?php if($user_type != 3) {?>
                                        <th><?= __('Status') ?></th>
                                       <?php } ?>
                                        <th><?= __('Action') ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th><?= __('User') ?></th>
                                        <!-- <th><?= __('Body Weight') ?></th> -->
                                        <!-- <th><?= __('Comment') ?></th> -->
                                        <th><?= __('Date') ?></th>
                                        <!-- <th><?= __('Type') ?></th> -->
                                       <?php if($user_type != 3) {?>
                                        <th><?= __('Status') ?></th>
                                       <?php } ?>
                                        <th><?= __('Action') ?></th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                    <?php foreach ($diets as $diet) { ?>
                                        <tr>

                                            <td><?= ucfirst($diet->user->name) ?></td>
                                            <!-- <td><?= ucfirst($diet->body_weight) ?></td> -->
                                            <!-- <td title="<?= ucfirst($diet->notes) ?>"><?= ucfirst(substr($diet->notes , 0,20)) ?></td> -->
                                            <td> <?= date('d-m-Y', strtotime($diet->date))?></td>
                                            <!-- <td><?= ucfirst($diet->diet_type) ?></td> -->
                                        <?php if($user_type != 3) {?>
                                            <td id='status<?= $diet->id ?>'> <?php
                                                if (isset($diet->status) && $diet->status == '1') {
                                                    ?>

                                                    <?= $this->Form->button('Active', ['class' => 'btn btn-success waves-effect', 'id' => $diet->id, 'value' => $diet->status, 'onclick' => 'updateStatus(this.id,' . $diet->status . ')']) ?>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <?= $this->Form->button('Inactive', ['class' => 'btn btn-primary waves-effect', 'id' => $diet->id, 'value' => $diet->status, 'onclick' => 'updateStatus(this.id,' . $diet->status . ')']) ?>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        <?php } ?>
                                            <td>
                                                <?php if(($user_type == 3)) { ?>
                                                     <i class="material-icons" title="Report diet"><?= $this->Html->link(__('mode_edit'), ['action' => 'userEdit', $diet['id']]) ?></i>
                                             <?php   } ?>
                                             
                                                   

                                                <i class="material-icons" title="View"><?= $this->Html->link(__('visibility'), ['action' => 'view', $diet['id']]) ?></i>
                                               <?php if($user_type != 3){?>
                                                <?php if(empty($diet->user_detail)){?>
                                                <i class="material-icons" title="diet Edit"><?= $this->Html->link(__('mode_edit'), ['action' => 'edit', $diet['id']]) ?></i>
                                            <?php } } ?>
                                            <?php if(($user_type != 3) && ($user_type != 4)){?>
                                               <i class="material-icons" title="<?= __('Delete') ?>"><?= $this->Form->postLink(__('delete'), ['action' => 'delete', $diet['id']], ['confirm' => __('Are you sure you want to delete diet ?', $diet['id'])]) ?></i>
                                                <?php } ?>
                                               <?php if($user_type != 3){?>
                                                <i class="material-icons"><?= $this->Html->link(__('content_copy'), ['action' => 'addMore', $diet['id']],['title'=> 'Add Duplicate'] ) ?></i>
                                               <?php } ?>
                                               <?php if(($user_type == 1) && (!empty($diet->user_detail))) {?>
                                               <i class="material-icons" title="Reported diet edit"><?= $this->Html->link(__('border_color'), ['action' => 'userEdit', $diet['id']]) ?></i>
                                             <?php } ?>
                                             <?php if($user_type == 4){?>  
                                                   <i class="material-icons" title="Report diet"><?= $this->Html->link(__('build'), ['action' => 'userEdit', $diet['id']]) ?></i> 
                                                 <?php } ?>
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
                            <div class="clearfix"></div>
                             <div class="row">
                            <div class="text-center">
                                <div class="text-center noDataFound">
                                    <strong><?= __('Record') ?></strong> <?= __('not found') ?>
                                </div>
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
        var urllink = '<?php echo $this->Url->build(["controller" => "diets", "action" => "status"]); ?>';
        var id = Id;
        var status = Status;
        urllink = urllink + '/' + id + '/' + status;
        //alert(urllink);
        // alert(urllink);
        if (confirm("<?= __('Are you sure! you want to change diet status?') ?>")) {
            $.ajax({
                url: urllink,
                type: 'GET',
                success: function (data) {
                  //  alert(data);

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
<script>
       $(document).ready(function () {
            $('#date-end').bootstrapMaterialDatePicker({ format : 'YYYY/MM/DD', weekStart : 0 , time: 'false'});
            $('#date-start').bootstrapMaterialDatePicker({format : 'YYYY/MM/DD', weekStart : 0, time: 'false' }).on('change', function(e, date)
            {
            $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
            });
       });

</script>
