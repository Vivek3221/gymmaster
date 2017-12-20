<?php
/* Cakephp 3.x User Management Premium Version (a product of Ektanjali Softwares Pvt Ltd)
Website- http://ektanjali.com
Plugin Demo- http://cakephp3-user-management.ektanjali.com/
Author- Chetan Varshney (The Director of Ektanjali Softwares Pvt Ltd)
Plugin Copyright No- 11498/2012-CO/L

UMPremium is a copyrighted work of authorship. Chetan Varshney retains ownership of the product and any copies of it, regardless of the form in which the copies may exist. This license is not a sale of the original product or any copies.

By installing and using UMPremium on your server, you agree to the following terms and conditions. Such agreement is either on your own behalf or on behalf of any corporate entity which employs you or which you represent ('Corporate Licensee'). In this Agreement, 'you' includes both the reader and any Corporate Licensee and Chetan Varshney.

The Product is licensed only to you. You may not rent, lease, sublicense, sell, assign, pledge, transfer or otherwise dispose of the Product in any form, on a temporary or permanent basis, without the prior written consent of Chetan Varshney.

The Product source code may be altered (at your risk)

All Product copyright notices within the scripts must remain unchanged (and visible).

If any of the terms of this Agreement are violated, Chetan Varshney reserves the right to action against you.

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Product.

THE PRODUCT IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE PRODUCT OR THE USE OR OTHER DEALINGS IN THE PRODUCT. */
?>
<?php
$statu = $this->Common->getstatus();
$nofrec = $this->Common->getNoOfRec();

?>


<section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="fixed-action-btn"><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'addUser']); ?>" class="btn btn-primary waves-effect btn-floating waves-light btn-large red"><i class="material-icons">add</i></a></div>
                        <?= $this->Flash->render() ?>
                    <div class="card">
                        <div class="header">
                            <h2 >
                               <?= __('Users') ?>
                            </h2>
                            <?= $this->Common->getBreadcrumbAdmin(__('Users')); ?>
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
                            <?= $this->Form->input('norec', ['label' => __('No. of Records'), 'type' => 'select', 'class' => 'form-control', 'placeholder' => __('select record'),'options' => $nofrec, 'value'=>$norec]); ?>
                        </div>
                                  <div class="col-md-2">
                            <?php echo $this->Form->input('status', ['label' => __('Status'), 'class' => 'form-control', 'empty' => __('Select Status'), 'options' => $statu, 'value' => $status]); ?>
                        </div>
                        <div class="col-md-3 marginTop25">
                            <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>
                            <?= $this->Html->link(__('Clear'), ['controller' => 'Users'], ['class' => 'btn btn-danger']) ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div> 
                            <?php if ($this->Paginator->counter(['format' => __('{{count}}')]) != 0) { ?>
                            <table class="table table-bordered table-striped table-hover dataTable responsive" id="userstable">
                                <thead>
                                    <tr>
                                        <th><?= __('User Id') ?></th>
                                        <th><?= __('Name') ?></th>
                                        <th><?= __('Username') ?></th>
                                        <th><?= __('Email') ?></th>
                                        <th><?= __('Groups(s)') ?></th>
                                         <th><?= __('Verified') ?></th>
                                        <th><?= __('Status') ?></th>
                                        <th><?= __('Action') ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th><?= __('User Id') ?></th>
                                        <th><?= __('Name') ?></th>
                                        <th><?= __('Username') ?></th>
                                        <th><?= __('Email') ?></th>
                                        <th><?= __('Groups(s)') ?></th>
                                        <th><?= __('Verified') ?></th>
                                        <th><?= __('Status') ?></th>
                                        <th><?= __('Action') ?></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                   
                                    <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <td><?= $user['id'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['username'] ?></td>
                                        <td><?= $this->common->turnCatefun($user['email'],12)
                                            
                                             ?></td>
                                        <td><?= $user['user_group_name'] ?></td>
                                        <td id='verified<?= $user->id ?>'>
                                            <?php
                                           
                                            if(isset($user->verified)  && $user->verified == '1'){
                                            ?>

  <?= $this->Form->button('Approved',['class'=>'btn btn-success waves-effect','id'=>$user->id,'value'=>$user->verified,'onclick'=>'updateVerified(this.id,'.$user->verified.')' ]) ?>
                                            <?php
                                            } elseif(isset($user['verified'])  && $user['verified'] == '0'){
                                                ?>
   <?= $this->Form->button('UnApproved',['class'=>'btn btn-primary waves-effect','id'=>$user->id,'value'=>$user->verified,'onclick'=>'updateVerified(this.id,'.$user->verified.')' ]) ?>
                                                <?php
                                            }
                                             else  {
                                                     echo '';
                                            }
                                            ?>
                                          
                                          
                                          
                                            </td>
                                        
                                        
                                        
                                        <td id='status<?= $user->id ?>'>
                                            <?php
                                            if(isset($user->active)  && $user->active == '1'){
                                            ?>

  <?= $this->Form->button('Active',['class'=>'btn btn-success waves-effect','id'=>$user->id,'value'=>$user->active,'onclick'=>'updateStatus(this.id,'.$user->active.')' ]) ?>
                                            <?php
                                            } else {
                                                ?>
   <?= $this->Form->button('Inactive',['class'=>'btn btn-primary waves-effect','id'=>$user->id,'value'=>$user->active,'onclick'=>'updateStatus(this.id,'.$user->active.')' ]) ?>
                                                <?php
                                            }
                                            ?>
                                            </td>
                                        
                                        <td><i class="material-icons"><?= $this->Html->link(__('visibility'), ['action' => 'viewUser', $user['id']]) ?></i>
                                       <i class="material-icons"><?= $this->Html->link(__('mode_edit'), ['action' => 'editUser', $user['id']]) ?></i></td>
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