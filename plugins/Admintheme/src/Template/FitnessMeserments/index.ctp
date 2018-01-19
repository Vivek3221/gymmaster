
<?php
$statu = $this->Common->getstatus();
$nofrec = $this->Common->getNoOfRec();
?>
<section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="fixed-action-btn"><a href="<?= $this->Url->build(['controller' => 'FitnessMeserments', 'action' => 'add']); ?>" class="btn btn-primary waves-effect btn-floating waves-light btn-large red"><i class="material-icons">add</i></a></div>
                        <?= $this->Flash->render() ?>
                    <div class="card">
                        <div class="header">
                            <h2 >
                               <?= __('Body Meserments') ?>
                            </h2>
                        </div>
                        <div class="body">
                              <div class="box-body">
                        <?= $this->Form->create(NULL, ['type' => 'get', 'url' => ['controller' => 'Users', 'action' => 'index']]) ?>
                        <div class="col-md-3">
                            <?php echo $this->Form->input('name', ['label' => __('Name'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('Name'), 'value' => $name]); ?>
                        </div>
                      <div class="col-md-2">
                            <?php echo $this->Form->input('email', ['label' => __('Email'), 'class' => 'form-control', 'type' => 'text', 'placeholder' => __('Email'), 'value' => $email]); ?>
                        </div>            
                                  
                                  <div class="col-md-2">
                            <?php echo $this->Form->input('status', ['label' => __('Status'), 'class' => 'form-control', 'empty' => __('Select Status'), 'options' => $statu, 'value' => $status]); ?>
                        </div>
                        <div class="col-md-3 marginTop25">
                            <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>
                            <?= $this->Html->link(__('Clear'), ['controller' => 'FitnessMeserments'], ['class' => 'btn btn-danger']) ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div> 
                            <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>
                            <table class="table table-bordered table-striped table-hover dataTable responsive" id="userstable">
                                <thead>
                                    <tr>
                                        <th><?= __('Weight') ?></th>
                                        <th><?= __('Height') ?></th>
                                        <th><?= __('BMI') ?></th>
                                        <th><?= __('Date') ?></th>
                                        <th><?= __('Action') ?></th>
                                       
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th><?= __('Weight') ?></th>
                                        <th><?= __('Height') ?></th>
                                        <th><?= __('BMI') ?></th>
                                        <th><?= __('Date') ?></th>
                                        <th><?= __('Action') ?></th>
                                      
                                    </tr>
                                </tfoot>
                                <tbody>
                                   
                                    <?php foreach ($fitnessMeserments as $fitnessMeserment) { ?>
                                    <tr>
                                        <td><?= $fitnessMeserment['weight'] ?></td>
                                        <td><?= ($fitnessMeserment['height']) ?></td>
                                        <td><?= ($fitnessMeserment['bmi']) ?></td>
                                        <td><?= (date("d-m-Y", strtotime($fitnessMeserment['date']))) ?></td>
                                        <td><i class="material-icons"><?= $this->Html->link(__('visibility'), ['action' => 'view', $fitnessMeserment['id']]) ?></i>
                                       <i class="material-icons"><?= $this->Html->link(__('mode_edit'), ['action' => 'edit', $fitnessMeserment['id']]) ?></i>
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
                    <?php } ?>             </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    </section>

<script type="text/javascript" language="javascript">
    
    function updateVerified(clicked_id,verified)
        {
           
            
            var id = clicked_id;
            $('#'+id+'').prop('disabled', true);  
            var verified = verified;
                
           var urls = '<?= $this->Url->build(['controller' =>'Users', 'action' =>'verifiedUpdate'])?>';
   
           var data = '&id=' + escape(id)+ '&verified=' + escape(verified);
           
//           alert(data);
     
         if(confirm("Are you sure to verify user ?"))
         {
            $.ajax({
                 
        type: "POST",
        
        cache:false,
       
        data: data,
        
        url: urls,
        
        success: function(html)
			{
                           // alert(html);
        
                     $('#verified'+id+'').html(html); // here we pass danamic id and fill color
             
			} 
    });
    return false;  
         }
         else
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
        if (confirm("<?= __('Are you sure! you want to change user status?') ?>")) {
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