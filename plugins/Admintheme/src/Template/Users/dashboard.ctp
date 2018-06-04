 
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
               <?php if($usersdetail['users_type'] != 3){; ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>">
                            <div class="icon">
                            <i class="material-icons">person</i>
                        </div></a>
                        <div class="content">
                            <div class="text"><?=__('Users')?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
               <?php } ?>
                <?php if($usersdetail['users_type'] == 1){; ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <a href="<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'index']); ?>">
                        <div class="icon">
                            <i class="material-icons">gavel</i>
                        </div>
                        </a>
                        <div class="content">
                            <div class="text"><?=__('Exercise Directory')?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                    <a href="<?= $this->Url->build(['controller' => 'FitnessMeserments', 'action' => 'index']); ?>">
                        <div class="icon">
                            <i class="material-icons">visibility</i>
                        </div>
                        </a>
                        <div class="content">
                            <div class="text"><?=__('Body Measurement')?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                    <a href="<?= $this->Url->build(['controller' => 'FitnessTests', 'action' => 'index']); ?>">
                        <div class="icon">
                            <i class="material-icons">view_day</i>
                        </div>
                        </a>
                        <div class="content">
                            <div class="text"><?=__('Fitness Test')?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <?php if($usersdetail['users_type'] != 3){; ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <a href="<?= $this->Url->build(['controller' => 'Sessions', 'action' => 'index']); ?>">
                        <div class="icon">
                            <i class="material-icons">work_outline</i>
                        </div>
                        </a>
                        <div class="content">
                            <div class="text"><?=__('Create Session')?></div>
                            <div class="number count-to" data-from="0" data-to="<?php// echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <?php } else {?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                    <a href="<?= $this->Url->build(['controller' => 'Sessions', 'action' => 'index']); ?>">
                        <div class="icon">
                            <i class="material-icons">work_outline</i>
                        </div>
                        </a>
                        <div class="content">
                            <div class="text"><?=__('Report Session')?></div>
                            <div class="number count-to" data-from="0" data-to="<?php// echo $users_count ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
   

            
            <!-- visits end here -->
        </div>
    </section>
<script type="text/javascript">
    

     
        
</script>