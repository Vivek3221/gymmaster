
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

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="" />
        <title>Think</title>

        <link href="<?php echo $path; ?>admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $path; ?>admin/css/metisMenu.min.css" rel="stylesheet">
        <link href="<?php echo $path; ?>admin/css/startmin.css" rel="stylesheet">
        <link href="<?php echo $path; ?>admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="<?php echo $path; ?>admin/js/ckeditor/ckeditor.js"></script>
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
          <ul class="nav navbar-right navbar-top-links">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
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
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                             <li>
                                <a href="<?php echo $path; ?>backend/users/index.php" class="active"><i class="fa fa-dashboard fa-fw"></i> users</a>
                            </li>
                             <li>
                                <a href="<?php echo $path; ?>backend/category" class=""><i class="fa fa-dashboard fa-fw"></i>Category</a>
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
                    <div class="col-lg-12">
                        <h1 class="page-header">Category Add</h1>
                        <p class="footer">Page rendered in <strong></strong> seconds. </p>
                 
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Basic Form Elements
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                    <div class="col-lg-6">
                                       <form name="addCategoryForm" id="addCategoryForm" method="post" class="form-horizontal" enctype="multipart/form-data" action="category.php" >
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input id="login-username" type="text" class="form-control" name="name" value="" placeholder="Project Type" required="true">                                        
                                   
                                                <p class="help-block">Example block-level help text here.</p>
                                            </div>
                                            </div>
                                       
                                      <div class="col-lg-6">
                                        <div class="form-group">
                                                <label>Title</label>
                                                <input type="text"  name="title" id="title" class="form-control" required="true">
                                            </div>
                                            </div>
                                            </div>
                                      <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" name="descriptions" id="descriptions" required="true" ></textarea>
                                            </div>
                                            </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                               <label>Banner Image</label>
                                                <input type="file"  name="userfile" id="userfile" onchange="ImageFilesize();">
                                            </div>
                                            </div>
                                            </div>
                                    
                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                                <label>Content</label>
                                                <textarea class="form-control" name="content" id="content"  ></textarea>
                                            </div>
                                         </div>
                                         <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="form-group">
   
 <select name="status" id="status" class="select" style="width: 180px;padding:5px"> <option value="">Select status</option>
                 <option value="1">Active</option>
                <option value="0">Inactive</option>
                    
                                                
          </select>
                                               </div>
                                            </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                              <label>Meta Title</label>
                                                <input type="text"  name="meta_title" id="meta_title" class="form-control" >
                                            </div>
                                            </div>
                                            </div>
                                          
                                         <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Meta Keyword</label>
                                                <input type="text"  name="meta_keyword" id="meta_keyword" class="form-control" >
                                            </div>
                                            </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                              <label>Meta Description</label>
                                                <input type="text"  name="meta_descriptions" id="meta_descriptions" class="form-control" >
                                            </div>
                                            </div>
                                            </div>
                                          
                                           
                                    
                                    <div class="col-lg-6">
                                         <input type="text"  name="post" id="post" class="form-control" value="add" style="display: none;">
                                            <button type="submit" class="btn btn-default">Submit Button</button>
                                            <button type="reset" class="btn btn-default">Reset Button</button>
                                        </form>
                                    </div>
                                    </div>
                                    
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
         <script>
                // Replace the <textarea id="descriptions"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'content' );
            </script>

        <!-- jQuery -->
   <script src="<?php echo $path; ?>admin/js/jquery.min.js"></script>
       <script>
        function saveCategory(flag){
           var datastring=$('form').serialize();
            alert(datastring);
        }
  function ImageFilesize() {
   
   var Extension = '';
   if (window.ActiveXObject) {
       var fso = new ActiveXObject("Scripting.FileSystemObject");
       var filepath = document.getElementById('userfile').value;
       var thefile = fso.getFile(filepath);
       var sizeinbytes = thefile.size;
   } else {
       var filepath = document.getElementById('userfile').value;
       var Extension = filepath.substring(filepath.lastIndexOf('.') + 1).toLowerCase();
       var sizeinbytes = document.getElementById('userfile').files[0].size;
   }
   var size = sizeinbytes / 1024 / 1024;
   if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
       if (size <= 2) {
       } else {
           alert('Allowed maximum imagel sizes is 2MB.');
           document.getElementById('userfile').value = '';
       }
   } else {
       alert('Allowed only .gif,.png,.bmp,.jpg,.jpeg image files.');
       document.getElementById('userfile').value = '';
   }
   
   } 

</script>

       
       
      <script src="<?php echo $path; ?>admin/js/jquery.min.js"></script>
       <script src="<?php echo $path; ?>admin/js/bootstrap.min.js"></script>
        <script src="<?php echo $path; ?>admin/js/metisMenu.min.js"></script>

    </body>
</html>
