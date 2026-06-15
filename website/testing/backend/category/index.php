<!DOCTYPE html>



<?php

$local = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    include($local."/mysite/connectiondb/connect.php");
    include($local."/mysite/constant/constant.php");
    $path = HTTP_HOST.'/mysite/';
}else{
     include($local."/constant/constant.php");
     include($local."/connectiondb/connect.php");
     $path = HTTP_HOST.'/';
}

    $sql = "SELECT * FROM category where status !=2 order by id desc limit 10";
    $result = mysqli_query($conn, $sql);
    $categorys = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
         <link rel="shortcut icon" href="front/images/favicon.ico" />
        <title>Think</title>

        <link href="<?php echo $path; ?>admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $path; ?>admin/css/metisMenu.min.css" rel="stylesheet">
        <link href="<?php echo $path; ?>admin/css/startmin.css" rel="stylesheet">
        <link href="<?php echo $path; ?>admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">Think</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

<!--                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
                </ul>-->

                <ul class="nav navbar-right navbar-top-links">
<!--                    <li class="dropdown navbar-inverse">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i> New Task
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>-->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" >
                            <i class="fa fa-user fa-fw"></i> Logout <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
<!--                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>-->
                            <li class="divider"></li>
                            <li><a href=""><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search..">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                                </div>
                                <!-- /input-group http://localhost/mysite/backend/category/index.php -->
                            </li>
                             <li>
                                <a href="<?php echo $path; ?>backend/users/index.php" class="active"><i class="fa fa-dashboard fa-fw"></i> users</a>
                            </li>
                             <li>
                                <a href="" class=""><i class="fa fa-dashboard fa-fw"></i>Category</a>
                            </li>
                             <li>
                                <a href="<?php echo $path; ?>backend/sub_category/index.php" class=""><i class="fa fa-dashboard fa-fw"></i>Sub Category</a>
                            </li>
                           <li>
                                <a href="<?php echo $path; ?>backend/qna/index.php" class=""><i class="fa fa-dashboard fa-fw"></i> Qna</a>
                            </li> 
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="page-header">Category Views</h1>
                    </div>
                   
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                <div class="col-lg-6">
                                Category Pages
                                <p class="footer">Page rendered in <strong></strong> seconds. </p>
                                </div>
                                    <div class="col-lg-6" style="text-align: right;">
                        <a href=""><button type="button" class="btn btn-primary">Reset</button></a>                 
                      <a href="add.php"><button type="button" class="btn btn-primary">Add</button></a>
                    </div>
                                </div>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
				
                                            <?php

                                            if(isset($categorys)){
                                             foreach($categorys as $category){
                                                //print_r($category);
                                                ?>
                                            <tr class="odd gradeX" id="category<?php echo $category['id'];?>">
                                                 
                                                <td><?= $category['name']; ?></td>
                                                <td><?php echo $category['name']; ?></td>
                                                <td><?php 
                                                $status = ['1'=>'Active', '0'=>'Inactive']; 
                                                 $statusc = $category['status']; 
                                                echo $status[$statusc]; ?></td>
                                                <td><a  href="edit.php?id=<?php echo $category['id']; ?>">Edit</a> |
				<span data-toggle="tooltip" data-placement="top" title="delete" onClick="deleteCategory(<?php echo $category['id']; ?>)">Delete</span>|<a  href="view.php?id=<?php echo $category['id']; ?>">view</a> 
           </td>
                                                
                                            </tr>
                                            <?php } }?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                              
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                
            </div>
            <!-- /#page-wrapper -->

        </div>
        
          <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
           <script>
              function deleteCategory(id){
               var postParams = {
                              'id' : id,
                              'post':'delete'
                            };
                $.ajax({
                      type: "POST",
                      url: "category.php",
                      data: postParams,
                      success: function(res) {
                      if(res ==1){
                        $("#category"+id).hide(1000);
                      }
                      }
                });
        }
         
        </script>
       <script src="<?php echo $path; ?>admin/js/bootstrap.min.js"></script>
        <script src="<?php echo $path; ?>admin/js/metisMenu.min.js"></script>
        <script src="<?php echo $path; ?>admin/js/startmin.js"></script>
         <script src="<?php echo $path; ?>admin/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="<?php echo $path; ?>admin/js/dataTables/dataTables.bootstrap.min.js"></script>
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
       

    </body>
</html>
