<?php
error_reporting(1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
//echo "<pre>";
//print_r($_FILES);
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
$fileToUpload = "defalut.png";
if(!empty($_POST['imageedit'])){
	$fileToUpload = $_POST['imageedit']; 
}
if(!empty($_FILES['userfile']['name'])){
  $fileToUpload = rand(10,1000).$_FILES['userfile']['name'];
  $file_tmp =$_FILES['userfile']['tmp_name'];
  $pathimage =$local."/mysite/admin/upload/";
  move_uploaded_file($file_tmp, $pathimage.$fileToUpload);	
}

//echo $fileToUpload; 

$name = $_POST['name'];
$title = $_POST['title'];
$descriptions = $_POST['descriptions'];
$content = $_POST['content'];
$status = $_POST['status'];
$meta_title = $_POST['meta_title'];
$meta_keyword = $_POST['meta_keyword'];
$meta_descriptions = $_POST['meta_descriptions'];
$created = time();
if($_POST['post'] == "add"){
	$sql = "INSERT INTO category (name,slug,descriptions,images,title,content,meta_title,meta_descriptions,meta_keyword,status,created,modified)
	VALUES ('$name','$name','$descriptions','$fileToUpload','$title','$content','$meta_title','$meta_descriptions','$meta_keyword','$status','$created','$created')";
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	    header('Location: '.$path.'/backend/category/index.php');
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
}elseif($_POST['post'] == "edit"){
	$id = $_POST['edit_id'];
	 $sql = "UPDATE category SET name='$name',slug='$name',descriptions='$descriptions',images='$fileToUpload',title='$title',content='$content',meta_title='$meta_title',meta_descriptions='$meta_descriptions',meta_keyword='$meta_keyword',status='$status',modified='$created' WHERE id=$id";
	if ($conn->query($sql) === TRUE) {
	    echo "New record update  successfully";
	     header('Location: '.$path.'/backend/category/index.php');
	     exit();
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
} elseif ($_POST['post'] == "delete"){
	      $id = $_POST['id'];
	      $sql = "UPDATE category SET status='2' WHERE id=$id";
	      if ($conn->query($sql) === TRUE) {
	      	echo "1";
	     exit();
	} else {
	    echo "0";
	    exit();
	}


} 




?>