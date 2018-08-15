 
<style>
    .news-count-margin{margin-bottom: 0px!important;}
    .news-count-size{margin: 0px;}
</style>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><?=__('DASHBOARD')?></h2>
            </div>
            <!-- Widgets -->
           

            <div class="row clearfix">
               <?php if(($usersdetail['users_type'] != 3) && ($usersdetail['users_type'] != 4)){; ?>
                 <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                         <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="text"><?=__('Users')?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div></a>
               <?php } ?>
                <?php if(($usersdetail['users_type'] != 3) && ($usersdetail['users_type'] != 4)){; ?>
                <a href="<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'index']); ?>">
                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                         <div class="icon">
                            <i class="material-icons">gavel</i>
                        </div>
                        
                        <div class="content">
                            <div class="text"><?=__('Exercise Directory')?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                    </a>
                <?php } ?>
                <a href="<?= $this->Url->build(['controller' => 'FitnessMeserments', 'action' => 'index']); ?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                    
                        <div class="icon">
                            <i class="material-icons">visibility</i>
                        </div>
                        
                        <div class="content">
                            <div class="text"><?=__('Body Measurement')?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                    </a>
                <a href="<?= $this->Url->build(['controller' => 'FitnessTests', 'action' => 'index']); ?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                    
                        <div class="icon">
                            <i class="material-icons">view_day</i>
                        </div>
                    
                        <div class="content">
                            <div class="text"><?=__('Fitness Test')?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                        </a>
            </div>
            <div class="row clearfix">
                <?php if($usersdetail['users_type'] != 3){; ?>
                    <a href="<?= $this->Url->build(['controller' => 'Sessions', 'action' => 'index']); ?>">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">

                    <div class="icon">
                        <i class="material-icons">work_outline</i>
                    </div>

                    <div class="content">
                        <div class="text"><?=__('Create Session')?></div>
                        <div class="number count-to" data-from="0" data-to="<?php// echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                    </div>
                    </div>
                    </a>
                    <?php }?>
                <?php if(($usersdetail['users_type'] == 3) || ($usersdetail['users_type'] == 4)) {?>
                 <a href="<?= $this->Url->build(['controller' => 'Sessions', 'action' => 'index']); ?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                   
                        <div class="icon">
                            <i class="material-icons">work_outline</i>
                        </div>
                       
                        <div class="content">
                            <div class="text"><?=__('Report Session')?></div>
                            <div class="number count-to" data-from="0" data-to="<?php// echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                      </a>
                <?php } ?>
                <?php if($usersdetail['users_type'] == 2){;?>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'trainerList']); ?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                   
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                       
                        <div class="content">
                            <div class="text"><?=__('Trainers')?></div>
                            <div class="number count-to" data-from="0" data-to="<?php// echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                      </a>
                  <?php } ?>

            </div>
   

            
            <!-- visits end here -->
        </div>
    </section>
<script type="text/javascript">
    

     
        
</script>