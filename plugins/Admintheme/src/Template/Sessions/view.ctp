<?php

$status = $this->Common->getstatus();

//$exercises = $this->Common->getExercises();
$get_exrcisedirectorie_lists = $this->Common->getExrciseDirectories();
//$get_exrcisedirectorie_name = $this->Common->getExrciseDirectoriesname(1);

$user_name = $this->Common->getUsers();
//pr($session_values);
//pr($user_values);
//foreach ($session_values as $key => $val)
//{
//   // pr($user_values->$key);
//    foreach ($val as $key1 => $vals)
//    {
//         
//       foreach ($vals as $key2 => $las)
//       {
//           pr($las);
//           pr($user_values->$key[$key1]->$key2);
//       }
//    }
//}
//pr($user_values);
//
//
//die;
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
                            <?= __('View Session') ?>
                        </h2>
                    </div>
                    <div class="body">


                        <div class="row" id="getexercise">
                            <div class="col-sm-6" style="background-color:lavender;">
                                <div>
                                    <span class="">  <h3 class="text-center">Planned</h3></span> 
                                </div>
                                <?php foreach ($session_values as $key => $value) {
                                    ?>
                                <div>
                                    <span class=""> <?= ucfirst($this->Common->getExrciseDirectoriesname($key)) ?></span> 
                                </div>
                                <div class="body">

                                        <?php foreach ($value as $val => $vale) {
                                            
                                            foreach ($vale as $valn => $valen) {
                                            ?>
                                    <div class=""> 
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="form-label" style="margin-right : 20px;"><?= ucfirst($valn) ?></label>
                                            </div>
                                            <div class="col-sm-4">
                                                <span id="" value=""><?= $valen ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                        <?php } } ?>

                                </div><?php } ?>

                            </div>
                            <div class="col-sm-6" style="background-color:#ecd6d1;" >
                                <div>
                                    <span class=""> <h3 class="text-center">Report</h3> </span> 
                                </div>
                                <?php foreach ($user_values as $key => $value) {
                                    ?>
                                <div>
                                    <span class=""> <?= ucfirst($this->Common->getExrciseDirectoriesname($key)) ?></span> 
                                </div>  <div class="body">

                                        <?php foreach ($value as $val => $vale) {
                                            
                                            foreach ($vale as $valn => $valen) {
                                            ?>
                                    <div class="ddd"> 
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="form-label" style="margin-right : 20px;"><?= ucfirst($valn) ?></label>
                                            </div>
                                            <div class="col-sm-3">
                                                <span id="" value="" style="margin-right : 20px;"><?= $valen ?> </span>
                                            </div>
                                            <div class="col-sm-3">
                                                         <?php // pr($session_values->$key->$val->$valn); die; ?>
                                                <span id="" > @ <?= trim($valen) - trim($session_values->$key[$val]->$valn) ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                        <?php } } ?>

                                </div><?php } ?>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</section>


<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
