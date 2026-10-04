<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
$getModPayment = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();
?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">

        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $this->Flash->render() ?>
                <div class="card">
                    <div class="header">
                        <h2>
                            <?= __('Update Exercise Plan for User') ?>
                        </h2>

                    </div>
                    <div class="body">
                        <div  id="hidePayment"class="form-btn text-center">
                            <button  class="btn btn-primary waves-effect" onclick="makePayment()">Update Plan</button>
                            <a href="<?= $this->Url->build(['controller' => 'PlanSubscribers', 'action' => 'index']) ?>" class="">Update Later</a>
                        </div>
                        <div class="" id="makepayment" hidden="">
                        <?= $this->Form->create($planSubscriber, ['id' => 'payment','templates' => ['inputContainer' => '{{content}}']]) ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('user_id', ['class' => 'form-control', 'type' => 'select','required', 'label' => 'Select User']) ?>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('plan_name', ['class' => 'form-control', 'type' => 'text','required', 'label' => false]) ?>
                                <label class="form-label">Plan Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?= $this->Form->control('fee', ['class' => 'form-control', 'type' => 'number','required', 'label' => false]) ?>
                                <label class="form-label">Plan Total Fee</label>
                            </div>
                        </div>
                        <?php
                        $isAdmin = $this->Common->isAdminUser($usersdetail['users_type'] ?? 0, $usersdetail['users_email'] ?? '');
                        ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label" style="top: -15px; font-size: 12px; color: #888;">Plan Expire Date</label>
                                <?= $this->Form->control('plan_expire_date', [
                                    'class' => 'form-control ' . ($isAdmin ? 'flatpickr-date' : ''), 
                                    'type' => 'text',
                                    'label' => FALSE,
                                    'readonly' => !$isAdmin,
                                    'required', 
                                    'value' => date('Y-m-d', strtotime($planSubscriber['plan_expire_date']))
                                ]) ?>          
                                <?php if (!$isAdmin): ?>
                                    <small class="text-danger" style="display:block;margin-top:4px;">* Only Super Admin can edit expire date.</small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label" style="top: -15px; font-size: 12px; color: #888;">Payment Due Date</label>
                                <?= $this->Form->control('payment_due_date', [
                                    'class' => 'form-control ' . ($isAdmin ? 'flatpickr-date' : ''), 
                                    'type' => 'text', 
                                    'label' => FALSE, 
                                    'readonly' => !$isAdmin,
                                    'value' => date('Y-m-d', strtotime($planSubscriber['payment_due_date'])) 
                                ]) ?>          
                                <?php if (!$isAdmin): ?>
                                    <small class="text-danger" style="display:block;margin-top:4px;">* Only Super Admin can edit due date.</small>
                                <?php endif; ?>
                            </div>
                        </div> 
                        <div class="form-btn text-center">
                            <?= $this->Form->button('Update Plan', ['class' => 'btn btn-primary waves-effect']) ?>
                           <a href="<?= $this->Url->build(['controller' => 'PlanSubscribers', 'action' => 'index']) ?>" class="">Update Later</a>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script type="text/javascript">
   function makePayment()
    {
            $('#makepayment').show();
            $('#hidePayment').hide();
    }

    $(document).ready(function () {
        if (typeof flatpickr !== 'undefined') {
            flatpickr('.flatpickr-date', {
                dateFormat: 'Y-m-d',
                allowInput: true,
                monthSelectorType: 'dropdown'
            });
        }
    });

</script>
