<?php
$status = $this->Common->getstatus();
$new_id = '';
//$exercises = $this->Common->getExercises();
$get_dietdirectories_lists = $this->Common->getDietsDirectories($users_id);
//$get_exrcisedirectorie_name = $this->Common->getDietDirectoriesname(1);

$user_name = $this->Common->getUsers();
//pr($session_values); die;
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
                            <?= __('Diet Reports') ?>
                        </h2>
                    </div>
                    <div class="body">
                        <!--                            <form id="form_validation" method="POST">-->
                        <?php //echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addUserForm', 'submitButtonId'=>'addUserSubmitBtn']);  ?>
                        <?= $this->Form->create($diets, ['id' => 'addsession', 'templates' => ['inputContainer' => '{{content}}']]) ?>
                        
                        <div class="row" id="getexercise">
                            <div class="col-sm-6" style="background-color:lavender;">
                                <div>
                            <span class="">  <h3 class="text-center">Planned</h3></span> 
                                </div>
                                <?php foreach ($diets_values as $key => $value) {
                                    ?>
                                
                                    <div class="body">
            <div>
                            <?php $ex_name = $this->Common->getDietDirectoriesname($key) ?>
                            <span class=""> <p class="text-primary"><?=  ucfirst($ex_name->name)  ?></p></span>
                                </div>   
                                        <?php 
                                        $u = 1;
                                        foreach ($value as $val => $vale) {
                                            foreach ($vale as $valn => $valen) {
                                             if($u % 7 ==0) 
                                             {
                                            ?>
                                            <div class="col-md-2 widthforthin" style=""> 
                                                <div class="form-group form-float">
                                                    <label class="form-label"><?= ucfirst($valn) ?></label>
                                                    <div class="form-line">
                                                        <?= $this->Form->control('excrcise[' . $key . '][' . $val . ']', ['class' => 'form-control', 'type' => 'text', 'value' => $valen, 'label' => false, 'readonly']) ?> 
                                                    </div>

                                                </div>
                                            </div>
                                        <?php }else
                                        { ?>
                                              <div class="col-md-2 widthforthin" style=""> 
                                                <div class="form-group form-float">
                                                    <label class="form-label"><?= ucfirst($valn) ?></label>
                                                    <div class="form-line">
                                                        <?= $this->Form->control('excrcise[' . $key . '][' . $val . ']', ['class' => 'form-control', 'type' => 'text', 'value' => $valen, 'label' => false, 'readonly']) ?> 
                                                    </div>

                                                </div>
                                            </div>

                                      <?php  }

                                              

                                         } $u++; } ?>

                                    </div><?php } ?>

                            </div>
                            <div class="col-sm-6" style="background-color:#f1e6fa;">
                                <div>
                            <span class=""> <h3 class="text-center">Report</h3> </span> 
                                </div>
                                <?php foreach ($users_diet_values as $key => $value) {
                                    ?>
                                 <div class="body">
 <div><?php $ex_name = $this->Common->getDietDirectoriesname($key) ?>
                            <span class=""> <p class="text-primary"><?=  ucfirst($ex_name->name)  ?></p></span> </div> 
                                        <?php $i =1; foreach ($value as $val => $vale) {
                                           // echo '<pre>';
                                           //// print_r($vale);
                                           // echo '</pre>';
                                             $arraycount = count($value); 
                                            foreach ($vale as $valn => $valen) {
                                                if($arraycount % 8== 0)
                                                {

                                           if($i ==8  OR $i == 16 OR $i == 24 OR $i == 32 OR $i == 40 OR $i == 48)
                                                     {  
                                                     $sum = 1;         
                                                 $nextval = $i + $sum;
                                                ?>
                                                 <div class="col-md-2 widthtwl" style=""> 
                                                
                        <div class="form-group form-float">
                            <div class="form-line">
                 <label><input type="radio" name="radio<?= $nextval ?>" class="radion" value="<?= $key.$nextval ?>" <?php if($valen == '') { echo 'checked'; } ?> style="margin-left: 29px; left: 0; opacity: 111;">Yes</label> 

                 <label><input type="radio" name="radio<?= $nextval ?>" class="radio" <?php if($valen != '') { echo 'checked'; } ?> value="<?= $key.$nextval ?>" style="margin-left: 29px; left: 0; opacity: 111;">No</label>
                       </div> </div>
                                               </div>
                                            <div class="col-md-12" > 
                                                <div <?php if($valen == '') { echo 'hidden'; } ?> class="form-group form-float" id="<?= $key.$nextval ?>">
                                                    <label class="form-label"><?= ucfirst("Comment") ?></label>
                                                    <div class="form-line">
                                                  <?= $this->Form->control('userexcrcise[' . $key . '][' . $new_id . '][comment]', ['class' => 'form-control', 'type' => 'text', 'id'=>$key.$nextval, 'value'=> $valen ,'label' => false]) ?>  
                                                  </div>
                                                   </div> 
                                               </div>   
                                                       <?php }else {?>
                                                    
                                                      <div class="col-md-2 widthtwl" style=""> 
                                                <div class="form-group form-float">
                                                    <label class="form-label"><?= ucfirst($valn) ?></label>
                                                    <div class="form-line">
                                                    <?php
                                                        
                                                      echo $this->Form->control('userexcrcise[' . $key . '][' . $new_id . '][' . $valn . ']', ['class' => 'form-control', 'type' => 'text','id'=>'d'.$key.$i,'value' => $valen, 'label' => false, 'required']) ;
                                                       
                                                          ?> 
                                                    </div>

                                                </div>
                                            </div>


                                                      <?php }             

                                                }
                                                else
                                                {
                                            ?>
                                            <div class="col-md-2 widthtwl" style=""> 
                                                <div class="form-group form-float">
                                                    <label class="form-label"><?= ucfirst($valn) ?></label>
                                                    <div class="form-line">
                                                    <?php
                                                        
                                                      echo $this->Form->control('userexcrcise[' . $key . '][' . $new_id . '][' . $valn . ']', ['class' => 'form-control', 'type' => 'text','id'=>'d'.$key.$i,'value' => $valen, 'label' => false, 'required']) ;
                                                       
                                                          ?> 
                                                    </div>

                                                </div>
                                            </div>
                                            <?php 

                                           if($i % 7 == 0)
                                                     {  
                                                     $sum = 1;         
                                                 $nextval = $i + $sum;
                                                ?>
                                                 <div class="col-md-2 widthtwl" style=""> 
                                                
                        <div class="form-group form-float">
                            <div class="form-line">
                 <label><input type="radio" name="radio<?= $nextval ?>" class="radion" value="<?= $key.$nextval ?>" style="margin-left: 29px; left: 0; opacity: 111;">Yes</label> 

                 <label><input type="radio" name="radio<?= $nextval ?>" class="radio" value="<?= $key.$nextval ?>" style="margin-left: 29px; left: 0; opacity: 111;">No</label>
                       </div> </div>
                                               </div>
                                            <div class="col-md-12" > 
                                                <div class="form-group form-float" hidden="" id="<?= $key.$nextval ?>">
                                                    <label class="form-label"><?= ucfirst("Comment") ?></label>
                                                    <div class="form-line">
                                                  <?= $this->Form->control('userexcrcise[' . $key . '][' . $new_id . '][comment]', ['class' => 'form-control', 'type' => 'text', 'id'=>'c'.$key.$nextval, 'value'=>'' ,'label' => false]) ?>  
                                                  </div>
                                                   </div> 
                                               </div>   
                                                       <?php }


                                        } } $i++; 

                                                 

                                        } ?>
                                        

                                    </div><?php } ?>

                            </div>
                        </div>

                        <?= $this->Form->button('Submit', ['class' => 'btn btn-primary waves-effect']) ?>
                        <?= $this->Form->end() ?>  

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
 
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){

    $('.radio').change(function(){
    var value = $( this ).val();
    if(value != 1)
    {
//   alert("yes");
    //alert(value);
    $("#" +value).show();
      }
});

 $('.radion').change(function(){
    var value = $( this ).val();
    if(value != 1)
    {
     //  alert("no");
    $("#c" +value).trigger("reset");
    $("#" +value).hide();
      }
});            

        });

    </script>