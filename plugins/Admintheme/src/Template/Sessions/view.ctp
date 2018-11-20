    <?php

$status = $this->Common->getstatus();

//$exercises = $this->Common->getExercises();
$get_exrcisedirectorie_lists = $this->Common->getExrciseDirectories($users_id);
//$get_exrcisedirectorie_name = $this->Common->getExrciseDirectoriesname(1);

$user_name = $this->Common->getUsers();
 foreach ($session_values as $key => $value) {
    
     //pr($value);
    
}
//die;
?>


<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Session View</h2>
            </div>
                
                <div class="row">
                <?php if(!empty($session->body_weight)) {    ?>
                <div class="col-sm-3">
                    <th scope="row"><?= __('Body Weight :-') ?></th>
                    <td><?= h($session->body_weight) ?>  KG</td>
                </div><?php } ?>
                 <?php if(!empty($session->hydration)) {    ?>
                <div class="col-sm-3">
                    <th scope="row"><?= __('Hydration :-') ?></th>
                    <td><?= h($session->hydration) ?>  Liters</td>
                 </div><?php } ?>
                <?php if(!empty($session->sleep)) {    ?>
                <div class="col-sm-3">
                    <th scope="row"><?= __('Sleep :-') ?></th>
                    <td><?= h($session->sleep) ?>  Hours</td>
                </div><?php  } ?>
                <?php if(!empty($session->user_date)) {    ?>
                <div class="col-sm-3">
                    <th scope="row"><?= __('Report Date :-') ?></th>
                    <td><?= date('d M Y',strtotime($session->user_date)) ?> </td>
                </div><?php } ?>
                </div>
                <div class="row">
                <?php if(!empty($session->notes)) {    ?>
                <div class="col-sm-9">
                    <th scope="row"><?= __('Users Comments :-') ?></th>
                    <td><?= h($session->notes) ?> </td>
                </div><?php } ?>
                </div>
            <div class="row">
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card" style="background-color: #e5fff2">
                        <div class="header" style=" background-color: #a2d4bf;">
                            <h2>Planned</h2>
                           
                        </div>
                        <?php foreach ($session_values as $key => $value) {
                                $excid = $key;
                                $addexc[] = $key;
                            ?>
                        <div class="body table-responsive">
                            <h5><?php $ex_name = $this->Common->getExrciseDirectoriesname($key) ?>
                            <?=  ucfirst($ex_name->name)  ?></h5>
                            <table class="table">
                                <thead>
                                    <?php $ex_name = $this->Common->getExrciseDirectoriesname($key) ?>
                                    <tr>
                                            <th><?= ucfirst($ex_name->tecnical1) ?></th>
                                            <th><?= ucfirst($ex_name->tecnical2) ?></th>
                                            <th><?= ucfirst($ex_name->tecnical3) ?></th>
                                            <th><?= ucfirst($ex_name->tecnical4) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                                $count = count($value);
                                                $i = 10;
                                                $j = 0;

                                                ?>
                                    <?php
                                                foreach ($value as $val => $vale) {
                                              if ($j % 4 == 0){
                                                        echo '<tr>';
                                                    }
                                                echo '<td>';
                                                    foreach ($vale as $valn => $valen) {
                                                      echo $valen;  
                                                        
                                                    }
                                                 echo '</td>';   
                                                    $i++;
                                                    $j++;
                                                    if ($j % 4 == 0) {
                                                        
                                                        echo '</tr>';
                                                    }
                                                }
                                                ?>  
                                   
                                </tbody>
                            </table>
                        </div>
                        <?php } ?>
                    </div>
                 </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card" style="background-color: #bcdce0">
                        <div class="header" style="background-color: #96bbbf;">
                            <h2>Report</h2>
                            
                        </div>
                         <?php if(isset($user_values) && $user_values != '') {?>
                       <?php foreach ($user_values as $key => $value) {
                                $excid = $key;
                                $addexc[] = $key;
                            ?>
                        <div class="body table-responsive">
                            <h5><?php $ex_name = $this->Common->getExrciseDirectoriesname($key) ?>
                            <?=  ucfirst($ex_name->name)  ?></h5>
                            <table class="table">
                                <thead>
                                    <?php $ex_name = $this->Common->getExrciseDirectoriesname($key) ?>
                                    <tr>
                                            <th><?= ucfirst($ex_name->tecnical1) ?></th>
                                            <th><?= ucfirst($ex_name->tecnical2) ?></th>
                                            <th><?= ucfirst($ex_name->tecnical3) ?></th>
                                            <th><?= ucfirst($ex_name->tecnical4) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                                $count = count($value);
                                                $i = 10;
                                                $j = 0;

                                                ?>
                                    <?php
                                                foreach ($value as $val => $vale) {
                                              if ($j % 4 == 0){
                                                        echo '<tr>';
                                                    }
                                                echo '<td>';
                                                    foreach ($vale as $valn => $valen) {
                                                      echo $valen;  
                                                        
                                                    }
                                                 echo '</td>';   
                                                    $i++;
                                                    $j++;
                                                    if ($j % 4 == 0) {
                                                        
                                                        echo '</tr>';
                                                    }
                                                }
                                                ?>  
                                   
                                </tbody>
                            </table>
                        </div>
                        <?php } ?>
                         <?php } ?>
                    </div>
                </div>
            </div>
            </div>
        </section>