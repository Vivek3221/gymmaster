
<?php
$statu = $this->Common->getstatus();
$nofrec = $this->Common->getNoOfRec();
$user_name = $this->Common->getUsers();
?>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="fixed-action-btn"><a href="<?= $this->Url->build(['controller' => 'FitnessTests', 'action' => 'add']); ?>" class="btn btn-primary waves-effect btn-floating waves-light btn-large red"><i class="material-icons">add</i></a></div>
                <?= $this->Flash->render() ?>
                <div class="card">
                    <div class="header">
                        <h2 >
                            <?= __('FitnessTests') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="box-body">
                            <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'FitnessTests', 'action' => 'index']]) ?>
                              <?php if($users_type != 3){?> 
                             <div class="col-md-3">
                                <?php echo $this->Form->input('user_id', ['label' => __('User Name'), 'class' => 'form-control select2', 'type' => 'select', 'empty' => __('User Name'), 'value' => $user_id,'options'=>$user_name]); ?>
                            </div>
                        <?php } ?>
                            <div class="col-md-3">
                                <?php echo $this->Form->input('from_date', ['label' => __('From Date'), 'class' => 'form-control', 'id' => 'date-start', 'type' => 'text', 'placeholder' => __('From Date'), 'value' => $sdate]); ?>
                            </div>  
                            <div class="col-md-3">
                                <?php echo $this->Form->input('to_date', ['label' => __('To Date'), 'class' => 'form-control', 'id' => 'date-end', 'type' => 'text', 'placeholder' => __('To Date'), 'value' => $edate]); ?>
                            </div>  

                            <div class="col-md-3 marginTop25">
                                <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>
                                <?= $this->Html->link(__('Clear'), ['controller' => 'FitnessTests'], ['class' => 'btn btn-danger']) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div> 
                        <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>
                             <div class="table-responsive list-page">
                            <table class="table table-bordered table-striped table-hover dataTable responsive" id="userstable">
                                <thead>
                                    <tr>
                                        <th><?= __('Name') ?></th>
                                        <th><?= __('Date') ?></th>
                                        <th><?= __('Action') ?></th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th><?= __('Name') ?></th>
                                        <th><?= __('Date') ?></th>
                                        <th><?= __('Action') ?></th>

                                    </tr>
                                </tfoot>
                                <tbody>

                                    <?php foreach ($fitnessTests as $fitnessTest) { ?>
                                        <tr>
                                            <td><?= $fitnessTest->user->name ?></td>
                                            <td><?= (date("d-m-Y", strtotime($fitnessTest['created']))) ?></td>
                                            <td><i class="material-icons" title="View"><?= $this->Html->link(__('visibility'), ['action' => 'view', $fitnessTest['id']]) ?></i>
                                          <?php if($usersdetail['users_type'] != 3 && $usersdetail['users_type'] != 4){; ?>
                                                    <i class="material-icons" title="Edit"><?= $this->Html->link(__('mode_edit'), ['action' => 'edit', $fitnessTest['id']]) ?></i>
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
                            <div class="text-center">
                                <div class="text-center noDataFound">
                                    <strong><?= __('Record') ?></strong> <?= __('not found') ?>
                                </div>
                            </div>
                        <?php } ?>             </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>


<script>
    $(document).ready(function () {
        $('#date-end').bootstrapMaterialDatePicker({format: 'YYYY/MM/DD HH:mm', weekStart: 0, time: 'false'});
        $('#date-start').bootstrapMaterialDatePicker({format: 'YYYY/MM/DD HH:mm', weekStart: 0, time: 'false'}).on('change', function (e, date)
        {
            $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
        });
    });

</script>