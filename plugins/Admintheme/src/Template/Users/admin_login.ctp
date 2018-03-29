<?php
//$lan = $cookie_value['lan'];

?>
<div class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Data Moniter</a>
           <?= $this->Flash->render() ?>
        </div>
        <div class="card">
            <div class="body">
                 <?= $this->Form->create('Login Form', ['url' => ['controller' => 'Users', 'action' => 'login'], 'id' => 'adminloginform', 'novalidate' => 'novalidate']) ?>
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <?= $this->Form->control('email', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Enter email id','label' => false]) ?> 
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <?= $this->Form->control('password', ['class' => 'form-control', 'type' => 'password', 'placeholder' => 'Password','label' => false]) ?> 
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit"><?=__('SIGN IN')?></button>
                        </div>
                    </div>
                    
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>