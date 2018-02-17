<?php
//pr($fitnessTest[0]->exercise_id); die;
$exercises = $this->Common->getExercises();
//pr($exercises);
$exercise_id = explode(',', $fitnessTest[0]->exercise_id);
$exercise_id1 = $exercise_id[0];
$exercise_id2 = $exercise_id[1];
$exercises[$exercise_id1]; 
$currentValue = json_decode($fitnessTest[0]->exercise_type); 
if(isset($fitnessTest[1]->exercise_type))
{
$preValue = json_decode($fitnessTest[1]->exercise_type); 
}
//pr($currentValue);die;
?>


<section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="pull-left">
                               <?= __('FitnessTests Type') ?>
                            </h2>
                           
                        </div>
                        <div class="body">
                            
                             <div class="text-right" style="margin-bottom: 15px;">
                                            <a href="<?= $this->Url->build([ 'controller' => 'FitnessTests','action' => 'edit', $fitnessTest[0]->id]);?>" class="btn btn-primary waves-effect">
                                                Edit
                                            </a>
                                           
                                            <a href="<?= $this->Url->build([ 'controller' => 'FitnessTests','action' => 'delete', $fitnessTest[0]->id]);?>" class="btn btn-primary waves-effect" style="margin-left: 15px;">
                                                Delete
                                            </a>
                                        </div>
                        
                            <div class="contacts view large-9 medium-8 columns content">
                            
                            <table class="vertical-table">
                                <tr>
                                    <th scope="row"><?= $exercises[0]->name ?></th>
                                    <th scope="row"><?= __('Current') ?></th>
                                    <th scope="row"><?= __('Previous') ?></th>
                                </tr>
                                 <tr>
                                    <th scope="row"><a href="?excerise_type=exercise_left&exercise_id=<?= $exercise_id1 ?>" class="waves-effect "><?= __('Left') ?></a></th>
                                    
                                        <td><?= $currentValue->exercise_left->$exercise_id1 ?></td>
                                    <?php if(isset($fitnessTest[1]->exercise_type))
                                    {?>

                                        <td><?= $preValue->exercise_left->$exercise_id1 ?></td>
                                    <?php } ?>
                                   </tr>
                                 <tr>
                                    <th scope="row"><a href="?excerise_type=exercise_right&exercise_id=<?= $exercise_id1 ?>" class="waves-effect "><?= __('Right') ?></a></th>
                                    
                                        <td><?= $currentValue->exercise_right->$exercise_id1 ?></td>
                                    <?php if(isset($fitnessTest[1]->exercise_type))
                                    {?>
                                        <td><?= $preValue->exercise_right->$exercise_id1 ?></td>
                                    <?php } ?>
                                   </tr> 
                                   <tr>
                                    <th scope="row"><?= $exercises[1]->name ?></th>
                                    <th scope="row"><?= __('Current') ?></th>
                                    <th scope="row"><?= __('Previous') ?></th>
                                </tr>
                                 <tr>
                                    <th scope="row"><a href="?excerise_type=exercise_left&exercise_id=<?= $exercise_id2 ?>" class="waves-effect "><?= __('Left') ?></a></th>
                                    
                                        <td><?= $currentValue->exercise_left->$exercise_id2 ?></td>
                                    <?php if(isset($fitnessTest[1]->exercise_type))
                                    {?>
                                        <td><?= $preValue->exercise_left->$exercise_id2 ?></td>
                                    <?php } ?>
                                   </tr>
                                 <tr>
                                    <th scope="row"><a href="?excerise_type=exercise_right&exercise_id=<?= $exercise_id2 ?>" class="waves-effect "><?= __('Right') ?></a></th>
                                    
                                        <td><?= $currentValue->exercise_right->$exercise_id2 ?></td>
                                    <?php if(isset($fitnessTest[1]->exercise_type))
                                    {?>
                                        <td><?= $preValue->exercise_right->$exercise_id2 ?></td>
                                    <?php }?>
                                   </tr>  
                                
                                
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
            labels: ['<?= $excerise_type ?>'],
            lineColors: ['rgb(233, 30, 99)'],
            lineWidth: 3
    });
    
    }
    
        </script>
    
     
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>