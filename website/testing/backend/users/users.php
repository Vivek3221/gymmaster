<?php
error_reporting(1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
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
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$user_type = $_POST['user_type'];
$status = $_POST['status'];
$password = md5($name);
$created = time();
if($_POST['post'] == "add"){
	echo $sql = "INSERT INTO users (user_type,name,email,password,mobile,status,created,modified)
	VALUES ('$user_type','$name','$email','$password','$mobile','$status','$created','$created')";
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	     header('Location: '.$path.'/backend/users/index.php');
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
}elseif($_POST['post'] == "edit"){
	$id = $_POST['edit_id'];
	 $sql = "UPDATE users SET user_type='$user_type',name='$name',email='$email',password='$password',mobile='$mobile',status='$status',modified='$created' WHERE id=$id";
	if ($conn->query($sql) === TRUE) {
	    echo "New record update  successfully";
	      header('Location: '.$path.'/backend/users/index.php');
	     exit();
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
} elseif ($_POST['post'] == "delete"){
	      $id = $_POST['id'];
	      $sql = "UPDATE users SET status='2' WHERE id=$id";
	      if ($conn->query($sql) === TRUE) {
	      	echo "1";
	     exit();
	} else {
	    echo "0";
	    exit();
	}


}  elseif ($_POST['post'] == "login"){
	echo "<pre>";
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$sql = "SELECT * FROM users WHERE email ='$email' and password='$password';";
    $result = mysqli_query($conn, $sql);
    $check_user = mysqli_num_rows($result);
    if($check_user ==1){
    	$user_detail=mysqli_fetch_all($result,MYSQLI_ASSOC);
    	$_SESSION["user_type"] = $user_detail[0]['user_type'];
    	$_SESSION["user_id"] = $user_detail[0]['id'];
       header('Location: '.$path.'/backend/users/deshbord.php');
    }else{
      header('Location: '.$path.'/backend/users/login.php');
    }
    	
}




?>