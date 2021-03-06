<?php
$statu    = $this->Common->getstatus();
$nofrec   = $this->Common->getNoOfRec();
$partners = $this->Common->getpartner();
?>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if($user_type != 3) {?>
                <div class="fixed-action-btn" title="Add Session"><a href="<?= $this->Url->build(['controller' => 'Sessions', 'action' => 'add']); ?>" class="btn btn-primary waves-effect btn-floating waves-light btn-large red"><i class="material-icons">add</i></a></div>
                <?php } ?>
               <?= $this->Flash->render() ?>
                <div class="card">
                    <div class="header">
                        <h2 >
                            <?= __('Sessions List') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="box-body">
                            <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'Sessions', 'action' => 'index']]) ?>
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
                            <div class="col-md-2">
                                <?= $this->Form->input('stat', ['label' => __('Session Status'), 'type' => 'select', 'class' => 'form-control', 'placeholder' => __('select record'), 'options' => ['0'=>'..Select..', '1'=>'Not Reported'], 'value' => $stat]); ?>
                            </div>
                            <div class="col-md-2">
                                    <?php echo $this->Form->input('s_type', ['label' => __('Session Type'),'class' => 'form-control', 'type' => 'text', 'placeholder' => __('-- Session Type --'), 'value' => $s_type]); ?>
                            </div>
                            <div class="col-md-3 marginTop25">
                                <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>
                                <?= $this->Html->link(__('Clear'), ['controller' => 'Sessions'], ['class' => 'btn btn-danger']) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                        <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>
                             <div class="table-responsive list-page">
                            <table class="table table-bordered table-striped table-hover dataTable responsive" id="userstable">
                                <thead>
                                    <tr>
                                        <th><?= __('User') ?></th>
                                        <th><?= __('Body Weight') ?></th>
                                        <th><?= __('Comment') ?></th>
                                        <th><?= __('Date') ?></th>
                                        <th><?= __('Type') ?></th>
                                       <?php if($user_type != 3) {?>
                                        <th><?= __('Status') ?></th>
                                       <?php } ?>
                                        <th><?= __('Action') ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th><?= __('User') ?></th>
                                        <th><?= __('Body Weight') ?></th>
                                        <th><?= __('Comment') ?></th>
                                        <th><?= __('Date') ?></th>
                                        <th><?= __('Type') ?></th>
                                       <?php if($user_type != 3) {?>
                                        <th><?= __('Status') ?></th>
                                       <?php } ?>
                                        <th><?= __('Action') ?></th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                    <?php foreach ($sessions as $session) { ?>
                                        <tr>

                                            <td><?= ucfirst($session->user->name) ?></td>
                                            <td><?= ucfirst($session->body_weight) ?></td>
                                            <td title="<?= ucfirst($session->notes) ?>"><?= ucfirst(substr($session->notes , 0,20)) ?></td>
                                            <td> <?= date('d-m-Y', strtotime($session->date))?></td>
                                            <td><?= ucfirst($session->session_type) ?></td>
                                        <?php if($user_type != 3) {?>
                                            <td id='status<?= $session->id ?>'> <?php
                                                if (isset($session->status) && $session->status == '1') {
                                                    ?>

                                                    <?= $this->Form->button('Active', ['class' => 'btn btn-success waves-effect', 'id' => $session->id, 'value' => $session->status, 'onclick' => 'updateStatus(this.id,' . $session->status . ')']) ?>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <?= $this->Form->button('Inactive', ['class' => 'btn btn-primary waves-effect', 'id' => $session->id, 'value' => $session->status, 'onclick' => 'updateStatus(this.id,' . $session->status . ')']) ?>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        <?php } ?>
                                            <td>
                                            <?php if(($user_type == 3) && (empty($session->user_detail))) { ?>
                                                     <i class="material-icons" title="Report Session"><?= $this->Html->link(__('mode_edit'), ['action' => 'userEdit', $session['id']]) ?></i>
                                             <?php   } ?>
                                             
                                                <i class="material-icons" title="View"><?= $this->Html->link(__('visibility'), ['action' => 'view', $session['id']]) ?></i>
                                               <?php if($user_type != 3){?>
                                                <?php if(empty($session->user_detail)){?>
                                                <i class="material-icons" title="Session Edit"><?= $this->Html->link(__('mode_edit'), ['action' => 'edit', $session['id']]) ?></i>
                                            <?php } } ?>
                                            <?php if(($user_type != 3) && ($user_type != 4)){?>
                                               <i class="material-icons" title="<?= __('Delete') ?>"><?= $this->Form->postLink(__('delete'), ['action' => 'delete', $session['id']], ['confirm' => __('Are you sure you want to delete Session ?', $session['id'])]) ?></i>
                                                <?php } ?>
                                               <?php if($user_type != 3){?>
                                                <i class="material-icons"><?= $this->Html->link(__('content_copy'), ['action' => 'addMore', $session['id']],['title'=> 'Add Duplicate'] ) ?></i>
                                               <?php } ?>
                                               <?php if(($user_type == 1 || $user_type == 2) && (!empty($session->user_detail))) {?>
                                               <i class="material-icons" title="Reported session edit"><?= $this->Html->link(__('border_color'), ['action' => 'userEdit', $session['id']]) ?></i>
                                             <?php } ?>
                                             <?php if(($user_type == 4)  && (empty($session->user_detail))){?>  
                                                   <i class="material-icons" title="Report session"><?= $this->Html->link(__('build'), ['action' => 'userEdit', $session['id']]) ?></i> 
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
        var urllink = '<?php echo $this->Url->build(["controller" => "Sessions", "action" => "status"]); ?>';
        var id = Id;
        var status = Status;
        urllink = urllink + '/' + id + '/' + status;
        //alert(urllink);
        // alert(urllink);
        if (confirm("<?= __('Are you sure! you want to change session status?') ?>")) {
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
