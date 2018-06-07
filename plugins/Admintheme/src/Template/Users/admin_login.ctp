<div class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Data Moniter</a>
            <?= $this->Flash->render() ?>
        </div>
        <div class="card">
            <!-- start login form -->
            <div class="body" id="loginDiv">
                <?= $this->Form->create('Login Form', ['url' => ['controller' => 'Users', 'action' => 'login'], 'id' => 'adminloginform', 'novalidate' => 'novalidate']) ?>
                <div class="msg">Sign in to start your session</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <?= $this->Form->control('email', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Enter email id', 'label' => false]) ?> 
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <?= $this->Form->control('password', ['class' => 'form-control', 'type' => 'password', 'placeholder' => 'Password', 'label' => false]) ?> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit"><?= __('SIGN IN') ?></button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <div>Forgot Password? <a href="javascript:void()" id="showForgetForm">Click Here</a></div>
            </div>
            <!-- end login form -->
            <!-- start forgot password form -->
            <div class="body" id="forgetPasswordDiv">
                <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login'], 'id' => 'forgetPasswordForm', 'novalidate' => 'novalidate']) ?>
                <div class="msg">Enter your registered email Id.</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <?= $this->Form->control('email', ['id'=>'forget-email','class' => 'form-control', 'type' => 'text', 'placeholder' => 'Enter email id', 'label' => false]) ?> 
                    </div>
                </div>
                <div class="customerror"></div>
                <div class="row">
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" id="forgetPasswordBtn" type="button"><?= __('Send Email') ?></button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <div>Go back to <a href="javascript:void()" id="showLoginForm">Sign in</a></div>
            </div>
            <!-- end forgot password form -->
        </div>
    </div>
</div>