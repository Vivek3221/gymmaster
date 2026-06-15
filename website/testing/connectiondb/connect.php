<?php
//$servername = "mysql1109.ixwebhosting.com";
//$username = "AAAlwfi_find";
//$password = "Waseem1234";
//$dbname = "AAAlwfi_find";

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
//if ($conn->connect_error) {
 //   die("Connection failed: " . $conn->connect_error);
	
//} 
//echo "here"; u209316653_  u209316653_
if($_SERVER['HTTP_HOST'] == "localhost"){
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "learnfor";
}else{
	$servername = "localhost";
    $username = "u209316653_root";
    $password = "bhup@123";
	$dbname = "u209316653_learnfor";
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	
} 




?> 
