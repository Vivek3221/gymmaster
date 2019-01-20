    <?php

$status = $this->Common->getstatus();

//$exercises = $this->Common->getExercises();
$get_dietdirectories_lists = $this->Common->getDietsDirectories($users_id);
//$get_exrcisedirectorie_name = $this->Common->getDietDirectoriesname(1);

$user_name = $this->Common->getUsers();
 foreach ($diet_values as $key => $value) {
    
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
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card" style="background-color: #e5fff2">
                        <div class="header" style=" background-color: #a2d4bf;">
                            <h2>Planned</h2>
                           
                        </div>
                        <?php foreach ($diet_values as $key => $value) {
                                $excid = $key;
                                $addexc[] = $key;
                            ?>
                        <div class="body table-responsive">
                            <h5><?php $ex_name = $this->Common->getDietDirectoriesname($key) ?>
                            <?=  ucfirst($ex_name->name)  ?></h5>
                            <table class="table">
                                <thead>
                                    <?php $ex_name = $this->Common->getDietDirectoriesname($key) ?>
                                    <tr>
                                            <th><?= ucfirst($ex_name->technical1) ?></th>
                                            <th><?= ucfirst($ex_name->technical2) ?></th>
                                            <th><?= ucfirst($ex_name->technical3) ?></th>
                                            <th><?= ucfirst($ex_name->technical4) ?></th>
                                            <th><?= ucfirst($ex_name->technical5) ?></th>
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
                                              if ($j % 5 == 0){
                                                        echo '<tr>';
                                                    }
                                                echo '<td>';
                                                    foreach ($vale as $valn => $valen) {
                                                      echo $valen;  
                                                        
                                                    }
                                                 echo '</td>';   
                                                    $i++;
                                                    $j++;
                                                    if ($j % 5 == 0) {
                                                        
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
                            <h5><?php $ex_name = $this->Common->getDietDirectoriesname($key) ?>
                            <?=  ucfirst($ex_name->name)  ?></h5>
                            <table class="table">
                                <thead>
                                    <?php $ex_name = $this->Common->getDietDirectoriesname($key) ?>
                                    <tr>
                                            <th><?= ucfirst($ex_name->technical1) ?></th>
                                            <th><?= ucfirst($ex_name->technical2) ?></th>
                                            <th><?= ucfirst($ex_name->technical3) ?></th>
                                            <th><?= ucfirst($ex_name->technical4) ?></th>
                                            <th><?= ucfirst($ex_name->technical5) ?></th>
                                            <th>Comment</th>
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
                                              if ($j % 6 == 0){
                                                        echo '<tr>';
                                                    }
                                                echo '<td>';
                                                    foreach ($vale as $valn => $valen) {

                                                     if($valn == 'comment')
                                                     {
                                                     if(isset($valen) && !empty($valen))
                                                     {
                                                     echo $valen ;
                                                     }else
                                                     {
                                                     echo 'Yes';
                                                     }


                                                     }else
                                                     {
                                                      echo $valen;  
                                                      }
                                                        
                                                    }
                                                 echo '</td>';   
                                                    $i++;
                                                    $j++;
                                                    if ($j % 6 == 0) {
                                                        
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