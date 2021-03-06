
<?php
$statu = $this->Common->getUserStatus();
$nofrec = $this->Common->getNoOfRec();
$user_type = $this->Common->getType();

?>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="fixed-action-btn"><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'trainerAdd']); ?>" class="btn btn-primary waves-effect btn-floating waves-light btn-large red"><i class="material-icons">add</i></a></div>
                        <?= $this->Flash->render() ?>
                <div class="card">
                    <div class="header">
                        <h2 >
                               <?= __('Trainer List') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="box-body">
                                <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'Users', 'action' => 'trainerList']]) ?>
                            <div class="col-md-3">
                                    <?php echo $this->Form->input('name', ['label' => __('Trainer Name'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('-- Trainer Name --'), 'value' => $name]); ?>
                            </div>
                            <div class="col-md-2">
                                    <?php echo $this->Form->input('email', ['label' => __('Email'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('Email'), 'value' => $email]); ?>
                            </div>            
                                
                            <div class="col-md-2">
                                    <?= $this->Form->input('norec', ['label' => __('No. of Records'), 'type' => 'select', 'class' => 'form-control', 'placeholder' => __('select record'), 'options' => $nofrec, 'value' => $norec]); ?>
                            </div>
                            <div class="col-md-2">
                                    <?php echo $this->Form->input('status', ['label' => __('Status'), 'class' => 'form-control', 'empty' => __('Select Status'), 'options' => $statu, 'value' => $status]); ?>
                            </div>
                            <div class="col-md-3 marginTop25">
                                    <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>
                                    <?= $this->Html->link(__('Clear'), ['controller' => 'Users','action'=>'trainerList'], ['class' => 'btn btn-danger']) ?>
                            </div>
                                <?= $this->Form->end() ?>
                        </div> 
                            <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>
                                
                        <!-- <table class="table table-bordered table-striped table-hover dataTable responsive" id="userstable"> -->
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
                                    <td><?= ($user['email'])?></td>
                                    <td><?php if($user['gender'] == 1){
                                            echo 'Male';
                                        } else {
                                            echo 'Female';
                                        }?></td>

                                        <?php if ($user->active  != '2'){ ?>
                                    <td id='status<?= $user->id ?>'>
                                            <?php
                                            if(isset($user->active)  && $user->active == '1'){
                                            ?>
  <?= $this->Form->button('Active',['class'=>'btn btn-success waves-effect','id'=>$user->id,'value'=>$user->active,'onclick'=>'updateStatus(this.id,'.$user->active.')' ]) ?>
                                            <?php
                                            } else {
                                                ?>
   <?= $this->Form->button('Inactive',['class'=>'btn btn-primary waves-effect','id'=>$user->id,'value'=>$user->active,'onclick'=>'updateStatus(this.id,'.$user->active.')' ]) ?>
                                        <?php }?>
                                    </td><?php } else { ?>
                                    <td><?= $this->Form->button('Enquiry',['class'=>'btn btn-danger waves-effect non-click','id'=>$user->id,'value'=>$user->active ]) ?>
                                    </td>  <?php } ?>
                                    <td><i class="material-icons" title="View"><?= $this->Html->link(__('visibility'), ['action' => 'trainerView', $user['id']]) ?></i>
                                        <i class="material-icons" title="Edit"><?= $this->Html->link(__('mode_edit'), ['action' => 'trainerEdit', $user['id']]) ?></i>
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

<script type="text/javascript" language="javascript">

    function updateVerified(clicked_id, verified)
    {


        var id = clicked_id;
        $('#' + id + '').prop('disabled', true);
        var verified = verified;

        var urls = '<?= $this->Url->build(['controller' =>'Users', 'action' =>'verifiedUpdate'])?>';

        var data = '&id=' + escape(id) + '&verified=' + escape(verified);

//           alert(data);

        if (confirm("Are you sure to verify user ?"))
        {
            $.ajax({

                type: "POST",

                cache: false,

                data: data,

                url: urls,

                success: function (html)
                {
                    // alert(html);

                    $('#verified' + id + '').html(html); // here we pass danamic id and fill color

                }
            });
            return false;
        } else
        {
            return false;
        }

    }
    function updateStatus(Id, Status) {
        var urllink = '<?php echo $this->Url->build(["controller" => "Users", "action" => "status"]); ?>';
        var id = Id;
        var status = Status;
        urllink = urllink + '/' + id + '/' + status;
        //alert(urllink);
        // alert(urllink);
        if (confirm("<?= __('Are you sure! you want to change trainer status?') ?>")) {
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