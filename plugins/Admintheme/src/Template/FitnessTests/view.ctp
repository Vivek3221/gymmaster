<?php

$bodies_lists = $this->Common->getBodies();
//$excerise_type = 'dddd';
$fitness1  = json_decode($fitnessTest[0]->exercise_type);
if(isset($fitnessTest[1]) && !empty($fitnessTest[1]))
{
$fitness2  = json_decode($fitnessTest[1]->exercise_type);
}
//pr($fitness1->$vvv); die;
?>


<section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="pull-left">
                               <?= __('View Fitness Tests') ?>
                            </h2>
                           
                        </div>
                        <div class="body">
                            
<!--                             <div class="text-right" style="margin-bottom: 15px;">
                                            <a href="<?= $this->Url->build([ 'controller' => 'FitnessTests','action' => 'edit', $fitnessTest[0]->id]);?>" class="btn btn-primary waves-effect">
                                                Edit
                                            </a>
                                           
                                            <a href="<?= $this->Url->build([ 'controller' => 'FitnessTests','action' => 'delete', $fitnessTest[0]->id]);?>" class="btn btn-primary waves-effect" style="margin-left: 15px;">
                                                Delete
                                            </a>
                                        </div>-->
                        
                            <div class="contacts view large-9 medium-8 columns content">
                            
                            <table class="vertical-table">
                                <?php if(!empty($bodies_lists)) {
                                        foreach ($bodies_lists as $bodies_list):
                                            $body_id = $bodies_list->id;
                                        ?>
                                <tr>
                                    <th scope="row"><?= $bodies_list->name ?></th>
                                    <th scope="row"><?= __('Current') ?></th>
                                    <?php if(isset($fitness2) && !empty($fitness2))
                                    {?>
                                    <th scope="row"><?= __('Previous') ?></th>
                                    <?php }?>
                                </tr>
                                <?php   $exercises = $this->Common->getExercises($bodies_list->id);    foreach ($exercises as $exercise): 
                                    
                                    $exercise_id = $exercise->id;
                                    ?>
                                 <tr>
                                    <th scope="row"><a href="?body_id=<?= $bodies_list->id ?>&exercise_id=<?= $exercise->id ?>&exercise_name=<?= $exercise->name ?>" class="waves-effect "><?= $exercise->name ?></a></th>
                                    
                                        <td><?=  $fitness1->$body_id->$exercise_id  ?></td>
                                <?php if(isset($fitness2) && !empty($fitness2))
                                    {
                                    if(isset($fitness2->$body_id->$exercise_id) && !empty($fitness2->$body_id->$exercise_id))
                                    {
                                    ?>
                                        <td><?=  $fitness2->$body_id->$exercise_id  ?></td>
                                    <?php } } ?>
                                   </tr>
                                   <?php endforeach;   ?>
                                
                                <?php endforeach;  } ?>
                                
                                 
                                
                                
                            </table>
                           
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    <div id="real_time_chart" class="dashboard-flot-chart" style="height: 370px; width: 370px"></div> 
    
</section>

 <script>
    window.onload = function () {
        
        
    Morris.Bar({
        element: 'real_time_chart',
        data: <?= json_encode($chartshow) ?>,
            xkey: 'y',
            ykeys: ['Dates'],
            labels: ['<?= $excerise_name ?>'],
            lineColors: ['rgb(233, 30, 99)'],
            lineWidth: 3
    });
    
    }
    
        </script>
    
     
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>