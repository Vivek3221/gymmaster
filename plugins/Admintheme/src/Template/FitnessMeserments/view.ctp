<?php
$getModPayment = $this->Common->getModPayment();
$getPayDuration = $this->Common->getPayDuration();
?>

<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 >
                            <?= __('View Boody Meserment') ?>
                        </h2>

                    </div>
                    <div class="body">
                        <div class="contacts view large-6 medium-8 columns content">
                            <table class="vertical-table">

                                <tr>
                                    <th scope="row"><?= __('Name') ?></th>
                                    <th scope="row"><?= __('Current') ?></th>
                                    <th scope="row"><?= __('Previous') ?></th>
                                </tr>
                                <tr>
                                    <th scope="row"><a href="?moredata=weight" class="waves-effect "><?= __('weight') ?></a></th>
                                    <?php if (isset($fitnessMeserment[0]['weight'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[0]['weight'])); ?></td>
                                    <?php } ?>

                                    <?php if (isset($fitnessMeserment[1]['weight'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[1]['weight'])); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th scope="row"><a href="?moredata=height" class="waves-effect "><?= __('Height') ?></a></th>
                                    <?php if (isset($fitnessMeserment[0]['height'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[0]['height'])); ?></td>
                                    <?php } ?>

                                    <?php if (isset($fitnessMeserment[1]['height'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[1]['height'])); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th scope="row"><a href="?moredata=bmi" class="waves-effect "><?= __('Bmi') ?></a></th>
                                    <?php if (isset($fitnessMeserment[0]['bmi'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[0]['bmi'])); ?></td>
                                    <?php } ?>

                                    <?php if (isset($fitnessMeserment[1]['bmi'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[1]['bmi'])); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th scope="row"><a href="?moredata=upper_arm" class="waves-effect "><?= __('Upper_arm') ?></a></th>
                                    <?php if (isset($fitnessMeserment[0]['upper_arm'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[0]['upper_arm'])); ?></td>
                                    <?php } ?>

                                    <?php if (isset($fitnessMeserment[1]['upper_arm'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[1]['upper_arm'])); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th scope="row"><a href="?moredata=neck" class="waves-effect "><?= __('Neck') ?></a></th>
                                    <?php if (isset($fitnessMeserment[0]['neck'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[0]['neck'])); ?></td>
                                    <?php } ?>

                                    <?php if (isset($fitnessMeserment[1]['neck'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[1]['neck'])); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th scope="row"><a href="?moredata=chest" class="waves-effect "><?= __('Chest') ?></a></th>
                                    <?php if (isset($fitnessMeserment[0]['chest'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[0]['chest'])); ?></td>
                                    <?php } ?>

                                    <?php if (isset($fitnessMeserment[1]['chest'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[1]['chest'])); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th scope="row"><a href="?moredata=waist" class="waves-effect "><?= __('Waist') ?></a></th>
                                    <?php if (isset($fitnessMeserment[0]['waist'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[0]['waist'])); ?></td>
                                    <?php } ?>

                                    <?php if (isset($fitnessMeserment[1]['waist'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[1]['waist'])); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th scope="row"><a href="?moredata=hips" class="waves-effect "><?= __('Hips') ?></a></th>
                                    <?php if (isset($fitnessMeserment[0]['hips'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[0]['hips'])); ?></td>
                                    <?php } ?>

                                    <?php if (isset($fitnessMeserment[1]['hips'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[1]['hips'])); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th scope="row"><a href="?moredata=thigh" class="waves-effect "><?= __('Thigh') ?></a></th>
                                    <?php if (isset($fitnessMeserment[0]['thigh'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[0]['thigh'])); ?></td>
                                    <?php } ?>

                                    <?php if (isset($fitnessMeserment[1]['thigh'])) {
                                        ?>
                                        <td><?= ucfirst(h($fitnessMeserment[1]['thigh'])); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>

                                    <th scope="row"><?= __('Date') ?></th>
                                    <?php if (isset($fitnessMeserment[0]['date'])) {
                                        ?>
                                        <td><?= date("d-m-Y", strtotime($fitnessMeserment[0]['date'])); ?></td>
                                    <?php } ?>

                                    <?php if (isset($fitnessMeserment[1]['date'])) {
                                        ?>
                                        <td><?= date("d-m-Y", strtotime($fitnessMeserment[1]['date'])); ?></td>
                                    <?php } ?>
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
 <?php
   // pr($fitnessMeserment); 
    $dataPoints = array(
    	array("x"=> 10, "y"=> 41),
    	array("x"=> 20, "y"=> 35, "indexLabel"=> "Lowest"),
    	array("x"=> 30, "y"=> 50),
    	array("x"=> 40, "y"=> 45),
    	array("x"=> 50, "y"=> 52),
    	array("x"=> 60, "y"=> 68),
    	array("x"=> 70, "y"=> 38),
    	array("x"=> 80, "y"=> 71, "indexLabel"=> "Highest"),
    	array("x"=> 90, "y"=> 52),
    	array("x"=> 100, "y"=> 60),
    	array("x"=> 110, "y"=> 36),
    	array("x"=> 120, "y"=> 49),
    	array("x"=> 130, "y"=> 41)
    );
   // pr($dataPoints); die;
    	
    ?>
 <script>
    window.onload = function () {
        
        
    Morris.Bar({
        element: 'real_time_chart',
        data: <?= json_encode($chartshow) ?>,
            xkey: 'y',
            ykeys: ['Dates'],
            labels: ['Values'],
            lineColors: ['rgb(233, 30, 99)'],
            lineWidth: 3
    });

        
        
     
//    var chart = new CanvasJS.Chart("chartContainer", {
//    	animationEnabled: true,
//    	exportEnabled: true,
//    	theme: "light1", // "light1", "light2", "dark1", "dark2"
//    	title:{
//    		text: "Simple Column Chart with Index Labels"
//    	},
//    	data: [{
//    		type: "column", //change type to bar, line, area, pie, etc
//    		//indexLabel: "{y}", //Shows y value on all Data Points
//    		indexLabelFontColor: "#5A5757",
//    		indexLabelPlacement: "outside", 
//                xValueType: "dateTime",
//		xValueFormatString: "MMM YYYY",
//    		dataPoints: <?php echo json_encode($chartshow); ?>
//    	}]
//    });
//    chart.render();
     
    }
    </script>
    
     
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>