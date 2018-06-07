<div class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Data Moniter</a>
            <?= $this->Flash->render() ?>
        </div>
        <div class="card">
            <!-- start reset password form -->
            <div class="body" id="resetDiv">
                <?= $this->Form->create('Reset Password Form', ['url' => ['controller' => 'Users', 'action' => 'resetPassword'], 'id' => 'resetPasswordForm', 'novalidate' => 'novalidate']) ?>
                <div class="msg">Reset your password</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <?= $this->Form->control('email', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Enter new password', 'label' => false]) ?> 
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <?= $this->Form->control('password', ['class' => 'form-control', 'type' => 'password', 'placeholder' => 'Confirm password', 'label' => false]) ?> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit"><?= __('SUBMIT') ?></button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
            <!-- end reset password form -->
        </div>
    </div>
</div>