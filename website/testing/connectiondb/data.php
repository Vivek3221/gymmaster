<?php

session_start();
include("connect.php");



// for user register
if($_POST['r'])
{
	$r = $_POST['r'];
	//echo "register";
	//echo $r;
	
if($r == 'user_register_val')
{
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email_register = $_POST['email_register'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


   
      if(filter_var($email_register,FILTER_VALIDATE_EMAIL))
	  {
		 $check_email = "SELECT * FROM user_register WHERE user_email ='$email_register'";

	  
		$run_user = mysqli_query($conn, $check_email);

     $check_email_count = mysqli_num_rows($run_user);
	// echo "no";
	//echo $check_email;

      if($check_email_count ==1){

          //$_SESSION['student_email_get']=$student_email;

         echo "4";

             }
			 
	else if($password != $confirm_password )
	{

  echo "3";

    }

	

else {
	
    $sql = "INSERT INTO user_register (first_name, last_name, user_email,user_pass)
VALUES ('$first_name', '$last_name', '$email_register', '$confirm_password')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
	 //$_SESSION['student_email_get']=$student_email;
	// $last_id = $conn->insert_id;
	// $_SESSION['user_register_id']=$last_id;



    echo "1";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      // echo "OK";

}
	  }
	  else
	  {
		  
		  echo '2';
	  }
   

   
	
}

}


// check email id on email_check_user_reg

if($_POST['r'])
{
$r = $_POST['r'];
  
if($r == 'email_check_user_reg')
{     //echo "hello";
	$email_register = $_POST['email_register'];
	//echo $email;
	
	if(!empty($email_register))
	{
		if(filter_var($email_register, FILTER_VALIDATE_EMAIL))
		{
		
		//echo "hello";
		 $sql = "SELECT * FROM user_register WHERE user_email ='$email_register'";

	  
		$run_user = mysqli_query($conn, $sql);

     $check_email = mysqli_num_rows($run_user);
	// echo "no";
	// echo $check_email;

      if($check_email ==1){

          

         echo "Email Already Exist";

             }

else {

echo "Email is valid";

}
	}
	else
	{
		echo "Email Format is Not Valid";
	}

	}
	
}
}



// for admin_login_val

if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'admin_login_val')
{
	$user_email = $_POST['user_email'];
	$user_pass = $_POST['user_pass'];
	
	//echo "hello";
	//echo $user_email;
	//echo $admin_pwd;
	if( !empty($user_email)  && !empty($user_pass) ){

		

	  $sql = "SELECT * FROM user_register WHERE user_email ='$user_email' and user_pass='$user_pass';";

	  
		$run_user = mysqli_query($conn, $sql);

     $check_user = mysqli_num_rows($run_user);
	 //echo "no";
	// echo $check_user;

      if($check_user ==1){
		  
		  $user_register_detail=mysqli_fetch_row($run_user);

          $_SESSION['user_register_id']=$user_register_detail[0];

         echo "1";

               }
						   else {

    echo "User Email or Pass Not Match";

						   }
	
  }
	
}
}

//for admin user_update_profile_val 

if($_POST['r'])
{
$r = $_POST['r'];
   // echo "login";
		//echo $r;
if($r == 'user_update_profile_val')
{
	
	
	
	$user_id = $_POST['user_id'];
	if($user_id !='')
	{
	$first_name = $_POST['first_name'];
	
	$user_email = $_POST['user_email'];

     $user_pass_change = $_POST['user_pass_change'];


	//die;
	$sql = "update user_register set first_name='$first_name' ,user_email='$user_email' , user_pass='$user_pass_change' where user_id='$user_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	echo "New update created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	}
	else
{
	
	 echo "you don`t have permission";
}
}
}



//for admin user_register_update_by_admin_val 

if($_POST['r'])
{
$r = $_POST['r'];
   // echo "login";
		//echo $r;
if($r == 'user_register_update_by_admin_val')
{
	
	
	
	$user_id = $_POST['user_update_id'];
	if($user_id !='')
	{
	$first_name = $_POST['first_name'];
	
	$last_name = $_POST['last_name'];

     $user_pass_change = $_POST['change_password'];


	//die;
	$sql = "update user_register set first_name='$first_name' ,last_name='$last_name' , user_pass='$user_pass_change' where user_id='$user_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	echo "New update created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	}
	else
{
	
	 echo "you don`t have permission";
}
}
}


    
//for member_name_delete_val 

if($_POST['r'])
{
$r = $_POST['r'];
   // echo "login";
		//echo $r;
if($r == 'member_name_delete_val')
{
	
	
	
	$user_id = $_POST['user_id'];
	//echo $user_id;
	if($user_id !='')
	{
		//echo "hello";
		//die();
	$member_name_delete = $_POST['member_name_delete'];
	
	$sql = "DELETE FROM user_register WHERE user_id = '$member_name_delete'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	echo "Delete Member successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}

else
{
	
	 echo "you don`t have permission";
}
}
}

     
// for department_name_submit_val And Updae

if($_POST['r'])
{
	$r = $_POST['r'];
	//echo "register";
	//echo $r;
	
if($r == 'department_name_submit_val')
{
$user_id = $_POST['user_id'];
$department_name = $_POST['department_name'];
$department_type_id = $_POST['department_type_id'];

   if($department_type_id =='')
   {
	 if( !empty($user_id)  && !empty($department_name) )
   {
   // check name
  $check_name = "SELECT * FROM desbord_president WHERE Chapter_name ='$department_name' AND admin_id='$user_id'";

	  
		$run_user = mysqli_query($conn, $check_name);

     $check_name_count = mysqli_num_rows($run_user);
	
      if($check_name_count ==1){

          //$_SESSION['student_email_get']=$student_email;

         echo "Chapter Name Already Exit";
                           }

else {
	
    $sql = "INSERT INTO desbord_president (Chapter_name,admin_id) VALUES ('$department_name','$user_id')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
    echo "1";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      

}
}

else
{
	
	 echo "Enter Chapter Name";
}
	 
   }
   // for update department name
   else
   {
	if( !empty($user_id)  && !empty($department_name) )
   {
   // delete then update
   
   	$sql = "DELETE FROM desbord_president WHERE desbord_President_id = '$department_type_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	//echo "Delete Department successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
   
   
   
   
  $check_name = "SELECT * FROM desbord_president WHERE Chapter_name ='$department_name' AND admin_id='$user_id'";

	  
		$run_user = mysqli_query($conn, $check_name);

     $check_name_count = mysqli_num_rows($run_user);
	
      if($check_name_count ==1){

          //$_SESSION['student_email_get']=$student_email;

         echo "Department Name Already Exit";
                           }

else {
	
    $sql = "INSERT INTO desbord_president (Chapter_name,admin_id) VALUES ('$department_name','$user_id')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
    echo "1";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      

}
}

else
{
	
	 echo "Enter Chapter Name";
}   
	   
   }


	  }

}


    
//for department_name_delete_val 

if($_POST['r'])
{
$r = $_POST['r'];
   // echo "login";
		//echo $r;
if($r == 'department_name_delete_val')
{
	
	
	
	$user_id = $_POST['user_id'];
	//echo $user_id;
	if($user_id !='')
	{
		//echo "hello";
		//die();
	$department_name_delete = $_POST['department_name_delete'];
	
	$sql = "DELETE FROM desbord_president WHERE desbord_President_id = '$department_name_delete'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	echo "Delete Chapter successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}

else
{
	
	 echo "you don`t have permission";
}
}
}


// for department_name_submit_vice_val And Updae vice president

if($_POST['r'])
{
	$r = $_POST['r'];
	//echo "register";
	//echo $r;
	
if($r == 'department_name_submit_vice_val')
{
$user_id = $_POST['user_id'];
$department_name = $_POST['department_name'];
$department_type_id = $_POST['department_type_id'];

   if($department_type_id =='')
   {
	 if( !empty($user_id)  && !empty($department_name) )
   {
   // check name
  $check_name = "SELECT * FROM desbord_vice_president WHERE Chapter_name ='$department_name' AND admin_id='$user_id'";

	  
		$run_user = mysqli_query($conn, $check_name);

     $check_name_count = mysqli_num_rows($run_user);
	
      if($check_name_count ==1){

          //$_SESSION['student_email_get']=$student_email;

         echo "Chapter Name Already Exit";
                           }

else {
	
    $sql = "INSERT INTO desbord_vice_president (Chapter_name,admin_id) VALUES ('$department_name','$user_id')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
    echo "1";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      

}
}

else
{
	
	 echo "Enter Chapter Name";
}
	 
   }
   // for update department name
   else
   {
	if( !empty($user_id)  && !empty($department_name) )
   {
   // delete then update
   
   	$sql = "DELETE FROM desbord_vice_president WHERE desbord_vice_President_id = '$department_type_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	//echo "Delete Department successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
   
   
   
   
  $check_name = "SELECT * FROM desbord_vice_president WHERE Chapter_name ='$department_name' AND admin_id='$user_id'";

	  
		$run_user = mysqli_query($conn, $check_name);

     $check_name_count = mysqli_num_rows($run_user);
	
      if($check_name_count ==1){

          //$_SESSION['student_email_get']=$student_email;

         echo "Department Name Already Exit";
                           }

else {
	
    $sql = "INSERT INTO desbord_vice_president (Chapter_name,admin_id) VALUES ('$department_name','$user_id')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
    echo "1";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      

}
}

else
{
	
	 echo "Enter Chapter Name";
}   
	   
   }


	  }

}


    
//for department_name_delete_val 

if($_POST['r'])
{
$r = $_POST['r'];
   // echo "login";
		//echo $r;
if($r == 'department_name_delete_val_vice')
{
	
	
	
	$user_id = $_POST['user_id'];
	//echo $user_id;
	if($user_id !='')
	{
		//echo "hello";
		//die();
	$department_name_delete_vice = $_POST['department_name_delete_vice'];
	
	$sql = "DELETE FROM desbord_vice_president WHERE desbord_vice_President_id = '$department_name_delete_vice'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	echo "Delete Chapter successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}

else
{
	
	 echo "you don`t have permission";
}
}
}



// for department_name_submit_st_val And Updae vice ST

if($_POST['r'])
{
	$r = $_POST['r'];
	//echo "register";
	//echo $r;
	
if($r == 'department_name_submit_st_val')
{
$user_id = $_POST['user_id'];
$department_name = $_POST['department_name'];
$department_type_id = $_POST['department_type_id'];

   if($department_type_id =='')
   {
	 if( !empty($user_id)  && !empty($department_name) )
   {
   // check name
  $check_name = "SELECT * FROM desbord_st WHERE Chapter_name ='$department_name' AND admin_id='$user_id'";

	  
		$run_user = mysqli_query($conn, $check_name);

     $check_name_count = mysqli_num_rows($run_user);
	
      if($check_name_count ==1){

          //$_SESSION['student_email_get']=$student_email;

         echo "Chapter Name Already Exit";
                           }

else {
	
    $sql = "INSERT INTO desbord_st (Chapter_name,admin_id) VALUES ('$department_name','$user_id')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
    echo "1";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      

}
}

else
{
	
	 echo "Enter Chapter Name";
}
	 
   }
   // for update department name
   else
   {
	if( !empty($user_id)  && !empty($department_name) )
   {
   // delete then update
   
   	$sql = "DELETE FROM desbord_st WHERE desbord_st_id = '$department_type_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	//echo "Delete Department successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
   
   
   
   
  $check_name = "SELECT * FROM desbord_st WHERE Chapter_name ='$department_name' AND admin_id='$user_id'";

	  
		$run_user = mysqli_query($conn, $check_name);

     $check_name_count = mysqli_num_rows($run_user);
	
      if($check_name_count ==1){

          //$_SESSION['student_email_get']=$student_email;

         echo "Department Name Already Exit";
                           }

else {
	
    $sql = "INSERT INTO desbord_st (Chapter_name,admin_id) VALUES ('$department_name','$user_id')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
    echo "1";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      

}
}

else
{
	
	 echo "Enter Chapter Name";
}   
	   
   }


	  }

}


    
//for department_name_delete_st_val 

if($_POST['r'])
{
$r = $_POST['r'];
   // echo "login";
		//echo $r;
if($r == 'department_name_delete_st_val')
{
	
	
	
	$user_id = $_POST['user_id'];
	//echo $user_id;
	if($user_id !='')
	{
		//echo "hello";
		//die();
	$department_name_delete_st = $_POST['department_name_delete_st'];
	
	$sql = "DELETE FROM desbord_st WHERE desbord_st_id = '$department_name_delete_st'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	echo "Delete Chapter successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}

else
{
	
	 echo "you don`t have permission";
}
}
}



     
// for target_name_submit_val And Updae

if($_POST['r'])
{
	$r = $_POST['r'];
	//echo "register";
	//echo $r;
	
if($r == 'target_name_submit_val')
{
$user_id = $_POST['user_id'];
$target_name = $_POST['target_name'];
$company_target_id = $_POST['company_target_id'];

   if($company_target_id =='')
   {
	 if( !empty($user_id)  && !empty($target_name) )
   {
   // check name
  $check_name = "SELECT * FROM company_target WHERE target_name ='$target_name' AND user_id='$user_id'";

	  
		$run_user = mysqli_query($conn, $check_name);

     $check_name_count = mysqli_num_rows($run_user);
	
      if($check_name_count ==1){

          //$_SESSION['student_email_get']=$student_email;

         echo "Target Name Already Exit";
                           }

else {
	
    $sql = "INSERT INTO company_target (target_name,user_id) VALUES ('$target_name','$user_id')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
    echo "1";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      

}
}

else
{
	
	 echo "Enter Target Name";
}
	 
   }
   // for update Target name
   else
   {
	if( !empty($user_id)  && !empty($target_name) )
   {
   // delete then update
   
   	$sql = "DELETE FROM company_target WHERE company_target_id = '$company_target_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	//echo "Delete Department successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
   
   
   
   
  $check_name = "SELECT * FROM company_target WHERE target_name ='$target_name' AND user_id='$user_id'";

	  
		$run_user = mysqli_query($conn, $check_name);

     $check_name_count = mysqli_num_rows($run_user);
	
      if($check_name_count ==1){

          //$_SESSION['student_email_get']=$student_email;

         echo "Target Name Already Exit";
                           }

else {
	
    $sql = "INSERT INTO company_target (target_name,user_id) VALUES ('$target_name','$user_id')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
    echo "1";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      

}
}

else
{
	
	 echo "Enter Target Name";
}   
	   
   }


	  }

}


    
//for company_target_name_delete 

if($_POST['r'])
{
$r = $_POST['r'];
   // echo "login";
		//echo $r;
if($r == 'company_target_name_delete_val')
{
	
	
	
	$user_id = $_POST['user_id'];
	//echo $user_id;
	if($user_id !='')
	{
		//echo "hello";
		//die();
	$company_target_name_delete = $_POST['company_target_name_delete'];
	
	$sql = "DELETE FROM company_target WHERE company_target_id = '$company_target_name_delete'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	echo "Delete Target successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}

else
{
	
	 echo "you don`t have permission";
}
}
}


// for department_target_submit_val

if($_POST['r'])
{
	$r = $_POST['r'];
	//echo "register";
	//echo $r;
	
if($r == 'department_target_submit_val')
{
$user_id = $_POST['user_id'];
$department_type_id = $_POST['department_type_id'];
$department_target_name = $_POST['department_target_name']; 
$department_target_id = $_POST['department_target_id'];

     if($department_target_id =='')
	 {
		
   if( !empty($user_id)  && !empty($department_target_name) )
   {
   // check name
 $check_name = "SELECT * FROM department_target WHERE department_target_name ='$department_target_name' AND department_type_id='$department_type_id' AND user_id='$user_id'";

	  
		$run_user = mysqli_query($conn, $check_name);

     $check_name_count = mysqli_num_rows($run_user);
	
      if($check_name_count ==1){

          

         echo "Target Already Exit";
                           }

else {
	
    $sql = "INSERT INTO department_target (department_type_id,department_target_name,user_id) VALUES ('$department_type_id','$department_target_name','$user_id')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
    echo "1";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      // echo "OK";

}
}

else
{
	
	 echo "Enter Target Area";
} 
	 }
	 
	 else
	 {
		 
		   	$sql = "DELETE FROM department_target WHERE department_target_id = '$department_target_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	//echo "Delete Department successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
		 
		 
   if( !empty($user_id)  && !empty($department_target_name) )
   {
   // check name
 $check_name = "SELECT * FROM department_target WHERE department_target_name ='$department_target_name' AND department_type_id='$department_type_id' AND user_id='$user_id'";

	  
		$run_user = mysqli_query($conn, $check_name);

     $check_name_count = mysqli_num_rows($run_user);
	
      if($check_name_count ==1){

          

         echo "Target Already Exit";
                           }

else {
	
    $sql = "INSERT INTO department_target (department_type_id,department_target_name,user_id) VALUES ('$department_type_id','$department_target_name','$user_id')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
    echo "1";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      // echo "OK";

}
}

else
{
	
	 echo "Enter Target Area";
}
		 
	 }


	  }

}


//for department_target_name_delete 

if($_POST['r'])
{
$r = $_POST['r'];
   // echo "login";
		//echo $r;
if($r == 'department_target_name_delete_val')
{
	
	
	
	$user_id = $_POST['user_id'];
	//echo $user_id;
	if($user_id !='')
	{
		//echo "hello";
		//die();
	$department_target_name_delete = $_POST['department_target_name_delete'];
	
	$sql = "DELETE FROM department_target WHERE department_target_id = '$department_target_name_delete'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	echo "Delete Department Target successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}

else
{
	
	 echo "you don`t have permission";
}
}
}


   
// get Target onclick  Department

if($_POST['r'])
{
$r = $_POST['r'];
   // echo "login";
		//echo $r;
if($r == 'department_target_name_get')
{    // echo "hello";
	$department_type_id = $_POST['department_type_id'];
	$user_id = $_POST['user_id'];
	//echo $user_id;
	
	if(!empty($user_id))
	{
		//echo "hello";
		 $sql = "SELECT * FROM department_target WHERE department_type_id ='$department_type_id' AND user_id='$user_id'";

	  
		    $result = mysqli_query($conn, $sql);
           while ($row=mysqli_fetch_row($result))
             
                echo'<option value="'.$row[0].'">'.$row[3].'</option>';

   
	// echo "no";
	// echo $check_email;


	}
	
}
}


       
// for customer_target_submit_val And Updae

if($_POST['r'])
{
	$r = $_POST['r'];
	//echo "register";
	//echo $r;
	
if($r == 'customer_target_submit_val')
{
$user_id = $_POST['user_id'];
$customer_name_assign = $_POST['customer_name_assign'];

$department_type_id = $_POST['department_type_id'];
$department_target_id = $_POST['department_target_id'];
$department_strategies_name1 = $_POST['department_strategies_name'];

$count_ary = count(explode(',',$department_strategies_name1));
	  //echo $count_ary;
	  // convert  string to array 
	  $department_strategies_name = explode(',',$department_strategies_name1);
//print_r($department_strategies_name);

//echo "hel in the cell";
//echo $department_strategies_name1;
//die;


$customer_mission_Target1 = $_POST['customer_mission_Target'];
$customer_mission_Target = explode(',',$customer_mission_Target1);

$customer_mission_Actual1 = $_POST['customer_mission_Actual'];
$customer_mission_Actual = explode(',',$customer_mission_Actual1);

$green_condition1 = $_POST['green_condition'];
$green_condition = explode(',',$green_condition1);

//print_r($green_condition);
//echo "hel";
//die;

$green_val1 = $_POST['green_val'];
$green_val = explode(',',$green_val1);

$red_condition1 = $_POST['red_condition'];
$red_condition = explode(',',$red_condition1);

$red_val1 = $_POST['red_val'];
$red_val = explode(',',$red_val1);

$yellow_condition1 = $_POST['yellow_condition'];
$yellow_condition = explode(',',$yellow_condition1);

//print_r($yellow_condition);
//echo "hel";
//die;

$yellow_value1 = $_POST['yellow_value'];
$yellow_value = explode(',',$yellow_value1);

$customer_target_id = $_POST['customer_target_id'];

$company_target_id = $_POST['company_target_id'];

$target_percentage = $_POST['target_percentage'];

   if($customer_target_id =='')
   {
	 if( !empty($user_id) && !empty($department_type_id) && !empty($company_target_id) )
   {
	   
	   // check % if already enter
	   
	   $check_pertage = "SELECT * FROM target_percentage WHERE user_id='$user_id' AND department_target_id='$department_target_id' AND company_target_id='$company_target_id'";
	   
	   $run_pert = mysqli_query($conn, $check_pertage);

     $check_pert_count = mysqli_num_rows($run_pert);
	 
	  if($check_pert_count =='1'){

          $sql = "update target_percentage set target_percentage='$target_percentage' where user_id='$user_id' AND department_target_id='$department_target_id' AND company_target_id='$company_target_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	//echo "New update created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
                           }
						   
				else
				{
					
			  $sql = "INSERT INTO target_percentage (department_target_id,target_percentage,user_id,company_target_id) VALUES ('$department_target_id','$target_percentage','$user_id','$company_target_id')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
   // echo "insert";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
				}					
	   //echo $target_percentage;
	  // echo"hel";
	   //die;
   // check name
   
  $check_name = "SELECT * FROM customer_target WHERE user_id='$user_id' AND department_type_id='$department_type_id' AND department_target_id='$department_target_id' AND department_strategies_name IN('$department_strategies_name1')";

	 // echo $check_name;
	 
		$run_user = mysqli_query($conn, $check_name);

     $check_name_count = mysqli_num_rows($run_user);
	 
	 //echo $check_name_count;
	 
	// die;
	
      if($check_name_count !='0'){

          //$_SESSION['student_email_get']=$student_email;

         echo "Department Strategies Name Already Exit";
                           }

else {
	
	
		for($test = 0; $test <$count_ary; $test++)
{
    $sql = "INSERT INTO customer_target (user_id,company_target_id,customer_name_assign,department_type_id,department_target_id,department_strategies_name,customer_mission_Target,customer_mission_Actual,green_condition,green_val,red_condition,red_val,yellow_condition,yellow_value) VALUES ('$user_id','$company_target_id','$customer_name_assign','$department_type_id','$department_target_id','$department_strategies_name[$test]','$customer_mission_Target[$test]','$customer_mission_Actual[$test]','$green_condition[$test]','$green_val[$test]','$red_condition[$test]','$red_val[$test]','$yellow_condition[$test]','$yellow_value[$test]')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
   
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}    
 echo "1";
}
}

else
{
	
	 echo "Enter Required value";
}
	 
   }
   // for update department name
   else
   {
	if( !empty($user_id) && !empty($department_type_id) && !empty($company_target_id) )
   {
	   
	   
	   $sql = "DELETE FROM customer_target WHERE customer_target_id = '$customer_target_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	//echo "Delete Department successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	   
	    // check % if already enter
	   
	   $check_pertage = "SELECT * FROM target_percentage WHERE user_id='$user_id' AND department_target_id='$department_target_id' AND company_target_id='$company_target_id'";
	   
	   $run_pert = mysqli_query($conn, $check_pertage);

     $check_pert_count = mysqli_num_rows($run_pert);
	 
	  if($check_pert_count =='1'){

          $sql = "update target_percentage set target_percentage='$target_percentage' where user_id='$user_id' AND department_target_id='$department_target_id' AND company_target_id='$company_target_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	//echo "New update created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
                           }
						   
				else
				{
					
			  $sql = "INSERT INTO target_percentage (department_target_id,target_percentage,user_id,company_target_id) VALUES ('$department_target_id','$target_percentage','$user_id','$company_target_id')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
   // echo "insert";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
				}					
	   //echo $target_percentage;
	  // echo"hel";
	   //die;
	   
	   
   // check name
  $check_name = "SELECT * FROM customer_target WHERE user_id='$user_id' AND department_type_id='$department_type_id' AND department_target_id='$department_target_id' AND department_strategies_name IN('$department_strategies_name1')";

	  
		$run_user = mysqli_query($conn, $check_name);

     $check_name_count = mysqli_num_rows($run_user);
	
      if($check_name_count !='0'){

          //$_SESSION['student_email_get']=$student_email;

         echo "Department Strategies Name Already Exit";
                           }

else {
	
   	for($test = 0; $test <$count_ary; $test++)
{
    $sql = "INSERT INTO customer_target (user_id,company_target_id,customer_name_assign,department_type_id,department_target_id,department_strategies_name,customer_mission_Target,customer_mission_Actual,green_condition,green_val,red_condition,red_val,yellow_condition,yellow_value) VALUES ('$user_id','$company_target_id','$customer_name_assign','$department_type_id','$department_target_id','$department_strategies_name[$test]','$customer_mission_Target[$test]','$customer_mission_Actual[$test]','$green_condition[$test]','$green_val[$test]','$red_condition[$test]','$red_val[$test]','$yellow_condition[$test]','$yellow_value[$test]')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
   
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}      
 echo "1";
}
}

else
{
	
	 echo "Enter Required value";
}  
	   
   }


	  }

}

//for Customer_mission_name_delete_val 

if($_POST['r'])
{
$r = $_POST['r'];
   // echo "login";
		//echo $r;
if($r == 'Customer_mission_name_delete_val')
{
	
	
	
	$user_id = $_POST['user_id'];
	//echo $user_id;
	if($user_id !='')
	{
		//echo "hello";
		//die();
	$Customer_mission_name_delete = $_POST['Customer_mission_name_delete'];
	
	$sql = "DELETE FROM customer_target WHERE customer_target_id = '$Customer_mission_name_delete'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		// $last_id = $conn->insert_id;
		 //echo  $last_id;
	echo "Delete  Target successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}

else
{
	
	 echo "you don`t have permission";
}
}
}



//for getval_val 

if($_POST['r'])
{
$r = $_POST['r'];
   // echo "login";
		//echo $r;
if($r == 'getval_val')
{
	
	
	
	$user_id = $_POST['user_id'];
	//echo $user_id;
	if($user_id !='')
	{
		//echo "hello";
		//die();
		// here get value of string as asddfdf, dfbdgbbj hdfdjbg, jbdfndv , fjdg f
	$values = $_POST['values'];
	// count array
	  $count_ary = count(explode(',',$values));
	 // echo $count_ary;
	  // convert  string to array 
	  $name = explode(',',$values);
	//print_r($name);
      //  print "<br>";
	//print_r($values);
	//echo'<br>';
	//print_r (explode(" ",$values));
	//echo $values;
	//echo "hel";
	//die;
	
	for($test = 0; $test <$count_ary; $test++)
{
 $sql = "INSERT INTO demo (user_id,name) VALUES ('$user_id','$name[$test]')";

// echo $sql;
if ($conn->query($sql) === TRUE) {
	
    echo "1";
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}	
	
}

else
{
	
	 echo "you don`t have permission";
}
}
}


// President_update_val update name
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'President_update_val')
{
	$President_id = $_POST['President_id'];
	$President_name = $_POST['President_name'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_President set President_name='$President_name'where admin_id='$user_id' AND desbord_President_id='$President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">President</p></th>
                <th><p style="color:#d6d6d6;">Weekly Call Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Monthly Fun in Fundamental</p></th>
                <th><p style="color:#d6d6d6;">Monthly LT Meeting</p></th>
				<th><p style="color:#d6d6d6;">Focus Visitors Days</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Social in the Chapter</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_President_sql = "SELECT * FROM desbord_President";
	//echo $sql;
	$desbord_President_result = mysqli_query($conn, $desbord_President_sql);
	$x=1;
	while ($desbord_President_detail=mysqli_fetch_row($desbord_President_result))
          
		  {
			  
			  if($desbord_President_detail[4] == 15)
			  {
				  $Weekly_Call_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[4] == 10)
			  {
				$Weekly_Call_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Weekly_Call_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[5] == 15)
			  {
				  $per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[5] == 10)
			  {
				$per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[6] == 15)
			  {
				  $Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[6] == 10)
			  {
				$Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[7] == 5)
			  {
				  $Monthly_Fundamental_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_Fundamental_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[8] == 5)
			  {
				  $Monthly_LT_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_LT_color = 'style="background-color:red;"';  
			  }
			  
			     if($desbord_President_detail[9] == 5)
			  {
				  $Focus_Visitors_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Focus_Visitors_color = 'style="background-color:red;"';  
			  }
	        
			  if($desbord_President_detail[10] == 10)
			  {
				  $Social_Chapter_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Social_Chapter_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[11] == 20)
			  {
				  $Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[11] == 15)
			  {
				$Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  $total_score = $desbord_President_detail[4] + $desbord_President_detail[5]+ $desbord_President_detail[6]+ $desbord_President_detail[7]+ $desbord_President_detail[8]+ $desbord_President_detail[9]+ $desbord_President_detail[10]+ $desbord_President_detail[11]+ $desbord_President_detail[14];
					
			  if($total_score >= 70)
			  {
				  $total_score_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_President_detail[13] >=70)
				  {
					 $Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_President_detail[13] >=50 && $desbord_President_detail[13] <=70)
				   {
               $Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_President_detail[13] >=30 && $desbord_President_detail[13] <=50)
				   {
               $Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color =  'style="background-color:black;"';
				  }  
				  
				  
				  if($desbord_President_detail[14] == 10)
			  {
				  $LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
	        
			echo '
                <tr id="valid" value="">
				
				 <td><input  type="text" class="form-control" value="'.$desbord_President_detail[2].'"/></td>
				  
                  <td> <input 
				    
				  
				  type="text" onchange="President_update('.$desbord_President_detail[0].')" id="President'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[3].'"/></td>
                    
                    <td> <input '.$Weekly_Call_color.' type="text" onchange="Weekly_Call_update('.$desbord_President_detail[0].')" id="Weekly_Call'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[4].'"/></td>
					
                   <td> <input '.$per_of_grey_color.' type="text" onchange="per_of_grey_update('.$desbord_President_detail[0].')" id="per_of_grey'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[5].'"/></td>
				   
					<td> <input '.$Monthly_one_two_color.' type="text" onchange="Monthly_one_two_update('.$desbord_President_detail[0].')" id="Monthly_one_two'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[6].'"/></td>
					
					<td> <input '.$Monthly_Fundamental_color.' type="text" onchange="Monthly_Fundamental_update('.$desbord_President_detail[0].')" id="Monthly_Fundamental'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[7].'"/></td>
					
					<td> <input '.$Monthly_LT_color.' type="text" onchange="Monthly_LT_update('.$desbord_President_detail[0].')" id="Monthly_LT'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[8].'"/></td>
					
                    <td> <input '.$Focus_Visitors_color.' type="text" onchange="Focus_Visitors_update('.$desbord_President_detail[0].')" id="Focus_Visitors'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[9].'"/></td>
					
					<td> <input '.$LTRT_Attendance_color.' type="text" onchange="LTRT_Attendance_update('.$desbord_President_detail[0].')" id="LTRT_Attendance'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[14].'"/></td>
					
					<td> <input '.$Social_Chapter_color.' type="text" onchange="Social_Chapter_update('.$desbord_President_detail[0].')" id="Social_Chapter'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[10].'"/></td>
					
					<td> <input '.$Chapter_Retention_color.' type="text" onchange="Chapter_Retention_update('.$desbord_President_detail[0].')" id="Chapter_Retention'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[11].'"/></td>
					
				<td> <input '.$total_score_color.' type="text" onchange="Total_Score_update1('.$desbord_President_detail[0].')" id="Total_Score'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score.'"/></td>
				
                    <td> <input '.$Individual_Ranking_color.' type="text" onchange="Individual_Ranking_update('.$desbord_President_detail[0].')" id="Individual_Ranking'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[13].'"/></td>
				
                </tr> ';
				
				 } 
				
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}



// Weekly_Call_update_val update val
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'Weekly_Call_update_val')
{
	$desbord_President_id = $_POST['desbord_President_id'];
	$Weekly_Call_val = $_POST['Weekly_Call_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_President set Weekly_Call='$Weekly_Call_val'where admin_id='$user_id' AND desbord_President_id='$desbord_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">President</p></th>
                <th><p style="color:#d6d6d6;">Weekly Call Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Monthly Fun in Fundamental</p></th>
                <th><p style="color:#d6d6d6;">Monthly LT Meeting</p></th>
				<th><p style="color:#d6d6d6;">Focus Visitors Days</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Social in the Chapter</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
     $desbord_President_sql = "SELECT * FROM desbord_President";
	//echo $sql;
	$desbord_President_result = mysqli_query($conn, $desbord_President_sql);
	$x=1;
	while ($desbord_President_detail=mysqli_fetch_row($desbord_President_result))
          
		  {
			  
			  if($desbord_President_detail[4] == 15)
			  {
				  $Weekly_Call_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[4] == 10)
			  {
				$Weekly_Call_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Weekly_Call_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[5] == 15)
			  {
				  $per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[5] == 10)
			  {
				$per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[6] == 15)
			  {
				  $Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[6] == 10)
			  {
				$Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[7] == 5)
			  {
				  $Monthly_Fundamental_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_Fundamental_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[8] == 5)
			  {
				  $Monthly_LT_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_LT_color = 'style="background-color:red;"';  
			  }
			  
			     if($desbord_President_detail[9] == 5)
			  {
				  $Focus_Visitors_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Focus_Visitors_color = 'style="background-color:red;"';  
			  }
	        
			  if($desbord_President_detail[10] == 10)
			  {
				  $Social_Chapter_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Social_Chapter_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[11] == 20)
			  {
				  $Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[11] == 15)
			  {
				$Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  $total_score = $desbord_President_detail[4] + $desbord_President_detail[5]+ $desbord_President_detail[6]+ $desbord_President_detail[7]+ $desbord_President_detail[8]+ $desbord_President_detail[9]+ $desbord_President_detail[10]+ $desbord_President_detail[11]+ $desbord_President_detail[14];
					
			  if($total_score >= 70)
			  {
				  $total_score_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_President_detail[13] >=70)
				  {
					 $Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_President_detail[13] >=50 && $desbord_President_detail[13] <=70)
				   {
               $Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_President_detail[13] >=30 && $desbord_President_detail[13] <=50)
				   {
               $Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color =  'style="background-color:black;"';
				  }  
				  
				  
				  if($desbord_President_detail[14] == 10)
			  {
				  $LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
	        
			echo '
                <tr id="valid" value="">
				
				 <td><input  type="text" class="form-control" value="'.$desbord_President_detail[2].'"/></td>
				  
                  <td> <input 
				    
				  
				  type="text" onchange="President_update('.$desbord_President_detail[0].')" id="President'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[3].'"/></td>
                    
                    <td> <input '.$Weekly_Call_color.' type="text" onchange="Weekly_Call_update('.$desbord_President_detail[0].')" id="Weekly_Call'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[4].'"/></td>
					
                   <td> <input '.$per_of_grey_color.' type="text" onchange="per_of_grey_update('.$desbord_President_detail[0].')" id="per_of_grey'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[5].'"/></td>
				   
					<td> <input '.$Monthly_one_two_color.' type="text" onchange="Monthly_one_two_update('.$desbord_President_detail[0].')" id="Monthly_one_two'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[6].'"/></td>
					
					<td> <input '.$Monthly_Fundamental_color.' type="text" onchange="Monthly_Fundamental_update('.$desbord_President_detail[0].')" id="Monthly_Fundamental'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[7].'"/></td>
					
					<td> <input '.$Monthly_LT_color.' type="text" onchange="Monthly_LT_update('.$desbord_President_detail[0].')" id="Monthly_LT'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[8].'"/></td>
					
                    <td> <input '.$Focus_Visitors_color.' type="text" onchange="Focus_Visitors_update('.$desbord_President_detail[0].')" id="Focus_Visitors'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[9].'"/></td>
					
					<td> <input '.$LTRT_Attendance_color.' type="text" onchange="LTRT_Attendance_update('.$desbord_President_detail[0].')" id="LTRT_Attendance'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[14].'"/></td>
					
					<td> <input '.$Social_Chapter_color.' type="text" onchange="Social_Chapter_update('.$desbord_President_detail[0].')" id="Social_Chapter'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[10].'"/></td>
					
					<td> <input '.$Chapter_Retention_color.' type="text" onchange="Chapter_Retention_update('.$desbord_President_detail[0].')" id="Chapter_Retention'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[11].'"/></td>
					
				<td> <input '.$total_score_color.' type="text" onchange="Total_Score_update1('.$desbord_President_detail[0].')" id="Total_Score'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score.'"/></td>
				
                    <td> <input '.$Individual_Ranking_color.' type="text" onchange="Individual_Ranking_update('.$desbord_President_detail[0].')" id="Individual_Ranking'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[13].'"/></td>
				
                </tr> ';
				
				 } 
				
				 
				 
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}


// per_of_grey_update_val update val
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'per_of_grey_update_val')
{
	$desbord_President_id = $_POST['desbord_President_id'];
	$per_of_grey_val = $_POST['per_of_grey_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_President set per_of_Grey='$per_of_grey_val'where admin_id='$user_id' AND desbord_President_id='$desbord_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">President</p></th>
                <th><p style="color:#d6d6d6;">Weekly Call Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Monthly Fun in Fundamental</p></th>
                <th><p style="color:#d6d6d6;">Monthly LT Meeting</p></th>
				<th><p style="color:#d6d6d6;">Focus Visitors Days</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Social in the Chapter</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
     $desbord_President_sql = "SELECT * FROM desbord_President";
	//echo $sql;
	$desbord_President_result = mysqli_query($conn, $desbord_President_sql);
	$x=1;
while ($desbord_President_detail=mysqli_fetch_row($desbord_President_result))
          
		  {
			  
			  if($desbord_President_detail[4] == 15)
			  {
				  $Weekly_Call_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[4] == 10)
			  {
				$Weekly_Call_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Weekly_Call_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[5] == 15)
			  {
				  $per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[5] == 10)
			  {
				$per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[6] == 15)
			  {
				  $Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[6] == 10)
			  {
				$Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[7] == 5)
			  {
				  $Monthly_Fundamental_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_Fundamental_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[8] == 5)
			  {
				  $Monthly_LT_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_LT_color = 'style="background-color:red;"';  
			  }
			  
			     if($desbord_President_detail[9] == 5)
			  {
				  $Focus_Visitors_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Focus_Visitors_color = 'style="background-color:red;"';  
			  }
	        
			  if($desbord_President_detail[10] == 10)
			  {
				  $Social_Chapter_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Social_Chapter_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[11] == 20)
			  {
				  $Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[11] == 15)
			  {
				$Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  $total_score = $desbord_President_detail[4] + $desbord_President_detail[5]+ $desbord_President_detail[6]+ $desbord_President_detail[7]+ $desbord_President_detail[8]+ $desbord_President_detail[9]+ $desbord_President_detail[10]+ $desbord_President_detail[11]+ $desbord_President_detail[14];
					
			  if($total_score >= 70)
			  {
				  $total_score_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_President_detail[13] >=70)
				  {
					 $Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_President_detail[13] >=50 && $desbord_President_detail[13] <=70)
				   {
               $Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_President_detail[13] >=30 && $desbord_President_detail[13] <=50)
				   {
               $Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color =  'style="background-color:black;"';
				  }  
				  
				  
				  if($desbord_President_detail[14] == 10)
			  {
				  $LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
	        
			echo '
                <tr id="valid" value="">
				
				 <td><input  type="text" class="form-control" value="'.$desbord_President_detail[2].'"/></td>
				  
                  <td> <input 
				    
				  
				  type="text" onchange="President_update('.$desbord_President_detail[0].')" id="President'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[3].'"/></td>
                    
                    <td> <input '.$Weekly_Call_color.' type="text" onchange="Weekly_Call_update('.$desbord_President_detail[0].')" id="Weekly_Call'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[4].'"/></td>
					
                   <td> <input '.$per_of_grey_color.' type="text" onchange="per_of_grey_update('.$desbord_President_detail[0].')" id="per_of_grey'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[5].'"/></td>
				   
					<td> <input '.$Monthly_one_two_color.' type="text" onchange="Monthly_one_two_update('.$desbord_President_detail[0].')" id="Monthly_one_two'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[6].'"/></td>
					
					<td> <input '.$Monthly_Fundamental_color.' type="text" onchange="Monthly_Fundamental_update('.$desbord_President_detail[0].')" id="Monthly_Fundamental'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[7].'"/></td>
					
					<td> <input '.$Monthly_LT_color.' type="text" onchange="Monthly_LT_update('.$desbord_President_detail[0].')" id="Monthly_LT'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[8].'"/></td>
					
                    <td> <input '.$Focus_Visitors_color.' type="text" onchange="Focus_Visitors_update('.$desbord_President_detail[0].')" id="Focus_Visitors'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[9].'"/></td>
					
					<td> <input '.$LTRT_Attendance_color.' type="text" onchange="LTRT_Attendance_update('.$desbord_President_detail[0].')" id="LTRT_Attendance'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[14].'"/></td>
					
					<td> <input '.$Social_Chapter_color.' type="text" onchange="Social_Chapter_update('.$desbord_President_detail[0].')" id="Social_Chapter'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[10].'"/></td>
					
					<td> <input '.$Chapter_Retention_color.' type="text" onchange="Chapter_Retention_update('.$desbord_President_detail[0].')" id="Chapter_Retention'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[11].'"/></td>
					
				<td> <input '.$total_score_color.' type="text" onchange="Total_Score_update1('.$desbord_President_detail[0].')" id="Total_Score'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score.'"/></td>
				
                    <td> <input '.$Individual_Ranking_color.' type="text" onchange="Individual_Ranking_update('.$desbord_President_detail[0].')" id="Individual_Ranking'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[13].'"/></td>
				
                </tr> ';
				
				 } 
				
				 
				 
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}


// Monthly_one_two_update_val update val
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'Monthly_one_two_update_val')
{
	$desbord_President_id = $_POST['desbord_President_id'];
	$Monthly_one_two_val = $_POST['Monthly_one_two_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_President set Monthly_one_two='$Monthly_one_two_val'where admin_id='$user_id' AND desbord_President_id='$desbord_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                 <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">President</p></th>
                <th><p style="color:#d6d6d6;">Weekly Call Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Monthly Fun in Fundamental</p></th>
                <th><p style="color:#d6d6d6;">Monthly LT Meeting</p></th>
				<th><p style="color:#d6d6d6;">Focus Visitors Days</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Social in the Chapter</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
     $desbord_President_sql = "SELECT * FROM desbord_President";
	//echo $sql;
	$desbord_President_result = mysqli_query($conn, $desbord_President_sql);
	$x=1;
	while ($desbord_President_detail=mysqli_fetch_row($desbord_President_result))
          
		  {
			  
			  if($desbord_President_detail[4] == 15)
			  {
				  $Weekly_Call_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[4] == 10)
			  {
				$Weekly_Call_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Weekly_Call_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[5] == 15)
			  {
				  $per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[5] == 10)
			  {
				$per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[6] == 15)
			  {
				  $Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[6] == 10)
			  {
				$Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[7] == 5)
			  {
				  $Monthly_Fundamental_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_Fundamental_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[8] == 5)
			  {
				  $Monthly_LT_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_LT_color = 'style="background-color:red;"';  
			  }
			  
			     if($desbord_President_detail[9] == 5)
			  {
				  $Focus_Visitors_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Focus_Visitors_color = 'style="background-color:red;"';  
			  }
	        
			  if($desbord_President_detail[10] == 10)
			  {
				  $Social_Chapter_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Social_Chapter_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[11] == 20)
			  {
				  $Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[11] == 15)
			  {
				$Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  $total_score = $desbord_President_detail[4] + $desbord_President_detail[5]+ $desbord_President_detail[6]+ $desbord_President_detail[7]+ $desbord_President_detail[8]+ $desbord_President_detail[9]+ $desbord_President_detail[10]+ $desbord_President_detail[11]+ $desbord_President_detail[14];
					
			  if($total_score >= 70)
			  {
				  $total_score_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_President_detail[13] >=70)
				  {
					 $Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_President_detail[13] >=50 && $desbord_President_detail[13] <=70)
				   {
               $Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_President_detail[13] >=30 && $desbord_President_detail[13] <=50)
				   {
               $Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color =  'style="background-color:black;"';
				  }  
				  
				  
				  if($desbord_President_detail[14] == 10)
			  {
				  $LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
	        
			echo '
                <tr id="valid" value="">
				
				 <td><input  type="text" class="form-control" value="'.$desbord_President_detail[2].'"/></td>
				  
                  <td> <input 
				    
				  
				  type="text" onchange="President_update('.$desbord_President_detail[0].')" id="President'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[3].'"/></td>
                    
                    <td> <input '.$Weekly_Call_color.' type="text" onchange="Weekly_Call_update('.$desbord_President_detail[0].')" id="Weekly_Call'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[4].'"/></td>
					
                   <td> <input '.$per_of_grey_color.' type="text" onchange="per_of_grey_update('.$desbord_President_detail[0].')" id="per_of_grey'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[5].'"/></td>
				   
					<td> <input '.$Monthly_one_two_color.' type="text" onchange="Monthly_one_two_update('.$desbord_President_detail[0].')" id="Monthly_one_two'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[6].'"/></td>
					
					<td> <input '.$Monthly_Fundamental_color.' type="text" onchange="Monthly_Fundamental_update('.$desbord_President_detail[0].')" id="Monthly_Fundamental'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[7].'"/></td>
					
					<td> <input '.$Monthly_LT_color.' type="text" onchange="Monthly_LT_update('.$desbord_President_detail[0].')" id="Monthly_LT'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[8].'"/></td>
					
                    <td> <input '.$Focus_Visitors_color.' type="text" onchange="Focus_Visitors_update('.$desbord_President_detail[0].')" id="Focus_Visitors'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[9].'"/></td>
					
					<td> <input '.$LTRT_Attendance_color.' type="text" onchange="LTRT_Attendance_update('.$desbord_President_detail[0].')" id="LTRT_Attendance'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[14].'"/></td>
					
					<td> <input '.$Social_Chapter_color.' type="text" onchange="Social_Chapter_update('.$desbord_President_detail[0].')" id="Social_Chapter'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[10].'"/></td>
					
					<td> <input '.$Chapter_Retention_color.' type="text" onchange="Chapter_Retention_update('.$desbord_President_detail[0].')" id="Chapter_Retention'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[11].'"/></td>
					
				<td> <input '.$total_score_color.' type="text" onchange="Total_Score_update1('.$desbord_President_detail[0].')" id="Total_Score'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score.'"/></td>
				
                    <td> <input '.$Individual_Ranking_color.' type="text" onchange="Individual_Ranking_update('.$desbord_President_detail[0].')" id="Individual_Ranking'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[13].'"/></td>
				
                </tr> ';
				
				 } 
				
				 
				
				 
				 
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

// Monthly_Fundamental_update_val
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'Monthly_Fundamental_update_val')
{
	$desbord_President_id = $_POST['desbord_President_id'];
	$Monthly_Fundamental_val = $_POST['Monthly_Fundamental_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_President set Monthly_Fundamental='$Monthly_Fundamental_val'where admin_id='$user_id' AND desbord_President_id='$desbord_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">President</p></th>
                <th><p style="color:#d6d6d6;">Weekly Call Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Monthly Fun in Fundamental</p></th>
                <th><p style="color:#d6d6d6;">Monthly LT Meeting</p></th>
				<th><p style="color:#d6d6d6;">Focus Visitors Days</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Social in the Chapter</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
     $desbord_President_sql = "SELECT * FROM desbord_President";
	//echo $sql;
	$desbord_President_result = mysqli_query($conn, $desbord_President_sql);
	$x=1;
		while ($desbord_President_detail=mysqli_fetch_row($desbord_President_result))
          
		  {
			  
			  if($desbord_President_detail[4] == 15)
			  {
				  $Weekly_Call_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[4] == 10)
			  {
				$Weekly_Call_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Weekly_Call_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[5] == 15)
			  {
				  $per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[5] == 10)
			  {
				$per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[6] == 15)
			  {
				  $Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[6] == 10)
			  {
				$Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[7] == 5)
			  {
				  $Monthly_Fundamental_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_Fundamental_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[8] == 5)
			  {
				  $Monthly_LT_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_LT_color = 'style="background-color:red;"';  
			  }
			  
			     if($desbord_President_detail[9] == 5)
			  {
				  $Focus_Visitors_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Focus_Visitors_color = 'style="background-color:red;"';  
			  }
	        
			  if($desbord_President_detail[10] == 10)
			  {
				  $Social_Chapter_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Social_Chapter_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[11] == 20)
			  {
				  $Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[11] == 15)
			  {
				$Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  $total_score = $desbord_President_detail[4] + $desbord_President_detail[5]+ $desbord_President_detail[6]+ $desbord_President_detail[7]+ $desbord_President_detail[8]+ $desbord_President_detail[9]+ $desbord_President_detail[10]+ $desbord_President_detail[11]+ $desbord_President_detail[14];
					
			  if($total_score >= 70)
			  {
				  $total_score_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_President_detail[13] >=70)
				  {
					 $Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_President_detail[13] >=50 && $desbord_President_detail[13] <=70)
				   {
               $Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_President_detail[13] >=30 && $desbord_President_detail[13] <=50)
				   {
               $Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color =  'style="background-color:black;"';
				  }  
				  
				  
				  if($desbord_President_detail[14] == 10)
			  {
				  $LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
	        
			echo '
                <tr id="valid" value="">
				
				 <td><input  type="text" class="form-control" value="'.$desbord_President_detail[2].'"/></td>
				  
                  <td> <input 
				    
				  
				  type="text" onchange="President_update('.$desbord_President_detail[0].')" id="President'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[3].'"/></td>
                    
                    <td> <input '.$Weekly_Call_color.' type="text" onchange="Weekly_Call_update('.$desbord_President_detail[0].')" id="Weekly_Call'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[4].'"/></td>
					
                   <td> <input '.$per_of_grey_color.' type="text" onchange="per_of_grey_update('.$desbord_President_detail[0].')" id="per_of_grey'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[5].'"/></td>
				   
					<td> <input '.$Monthly_one_two_color.' type="text" onchange="Monthly_one_two_update('.$desbord_President_detail[0].')" id="Monthly_one_two'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[6].'"/></td>
					
					<td> <input '.$Monthly_Fundamental_color.' type="text" onchange="Monthly_Fundamental_update('.$desbord_President_detail[0].')" id="Monthly_Fundamental'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[7].'"/></td>
					
					<td> <input '.$Monthly_LT_color.' type="text" onchange="Monthly_LT_update('.$desbord_President_detail[0].')" id="Monthly_LT'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[8].'"/></td>
					
                    <td> <input '.$Focus_Visitors_color.' type="text" onchange="Focus_Visitors_update('.$desbord_President_detail[0].')" id="Focus_Visitors'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[9].'"/></td>
					
					<td> <input '.$LTRT_Attendance_color.' type="text" onchange="LTRT_Attendance_update('.$desbord_President_detail[0].')" id="LTRT_Attendance'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[14].'"/></td>
					
					<td> <input '.$Social_Chapter_color.' type="text" onchange="Social_Chapter_update('.$desbord_President_detail[0].')" id="Social_Chapter'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[10].'"/></td>
					
					<td> <input '.$Chapter_Retention_color.' type="text" onchange="Chapter_Retention_update('.$desbord_President_detail[0].')" id="Chapter_Retention'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[11].'"/></td>
					
				<td> <input '.$total_score_color.' type="text" onchange="Total_Score_update1('.$desbord_President_detail[0].')" id="Total_Score'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score.'"/></td>
				
                    <td> <input '.$Individual_Ranking_color.' type="text" onchange="Individual_Ranking_update('.$desbord_President_detail[0].')" id="Individual_Ranking'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[13].'"/></td>
				
                </tr> ';
				
				 } 
				
				 
				
				 
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}


// Monthly_LT_update_val
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'Monthly_LT_update_val')
{
	$desbord_President_id = $_POST['desbord_President_id'];
	$Monthly_LT_val = $_POST['Monthly_LT_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_President set Monthly_LT='$Monthly_LT_val'where admin_id='$user_id' AND desbord_President_id='$desbord_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                 <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">President</p></th>
                <th><p style="color:#d6d6d6;">Weekly Call Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Monthly Fun in Fundamental</p></th>
                <th><p style="color:#d6d6d6;">Monthly LT Meeting</p></th>
				<th><p style="color:#d6d6d6;">Focus Visitors Days</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Social in the Chapter</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
     $desbord_President_sql = "SELECT * FROM desbord_President";
	//echo $sql;
	$desbord_President_result = mysqli_query($conn, $desbord_President_sql);
	$x=1;
	while ($desbord_President_detail=mysqli_fetch_row($desbord_President_result))
          
		  {
			  
			  if($desbord_President_detail[4] == 15)
			  {
				  $Weekly_Call_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[4] == 10)
			  {
				$Weekly_Call_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Weekly_Call_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[5] == 15)
			  {
				  $per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[5] == 10)
			  {
				$per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[6] == 15)
			  {
				  $Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[6] == 10)
			  {
				$Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[7] == 5)
			  {
				  $Monthly_Fundamental_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_Fundamental_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[8] == 5)
			  {
				  $Monthly_LT_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_LT_color = 'style="background-color:red;"';  
			  }
			  
			     if($desbord_President_detail[9] == 5)
			  {
				  $Focus_Visitors_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Focus_Visitors_color = 'style="background-color:red;"';  
			  }
	        
			  if($desbord_President_detail[10] == 10)
			  {
				  $Social_Chapter_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Social_Chapter_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[11] == 20)
			  {
				  $Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[11] == 15)
			  {
				$Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  $total_score = $desbord_President_detail[4] + $desbord_President_detail[5]+ $desbord_President_detail[6]+ $desbord_President_detail[7]+ $desbord_President_detail[8]+ $desbord_President_detail[9]+ $desbord_President_detail[10]+ $desbord_President_detail[11]+ $desbord_President_detail[14];
					
			  if($total_score >= 70)
			  {
				  $total_score_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_President_detail[13] >=70)
				  {
					 $Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_President_detail[13] >=50 && $desbord_President_detail[13] <=70)
				   {
               $Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_President_detail[13] >=30 && $desbord_President_detail[13] <=50)
				   {
               $Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color =  'style="background-color:black;"';
				  }  
				  
				  
				  if($desbord_President_detail[14] == 10)
			  {
				  $LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
	        
			echo '
                <tr id="valid" value="">
				
				 <td><input  type="text" class="form-control" value="'.$desbord_President_detail[2].'"/></td>
				  
                  <td> <input 
				    
				  
				  type="text" onchange="President_update('.$desbord_President_detail[0].')" id="President'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[3].'"/></td>
                    
                    <td> <input '.$Weekly_Call_color.' type="text" onchange="Weekly_Call_update('.$desbord_President_detail[0].')" id="Weekly_Call'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[4].'"/></td>
					
                   <td> <input '.$per_of_grey_color.' type="text" onchange="per_of_grey_update('.$desbord_President_detail[0].')" id="per_of_grey'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[5].'"/></td>
				   
					<td> <input '.$Monthly_one_two_color.' type="text" onchange="Monthly_one_two_update('.$desbord_President_detail[0].')" id="Monthly_one_two'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[6].'"/></td>
					
					<td> <input '.$Monthly_Fundamental_color.' type="text" onchange="Monthly_Fundamental_update('.$desbord_President_detail[0].')" id="Monthly_Fundamental'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[7].'"/></td>
					
					<td> <input '.$Monthly_LT_color.' type="text" onchange="Monthly_LT_update('.$desbord_President_detail[0].')" id="Monthly_LT'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[8].'"/></td>
					
                    <td> <input '.$Focus_Visitors_color.' type="text" onchange="Focus_Visitors_update('.$desbord_President_detail[0].')" id="Focus_Visitors'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[9].'"/></td>
					
					<td> <input '.$LTRT_Attendance_color.' type="text" onchange="LTRT_Attendance_update('.$desbord_President_detail[0].')" id="LTRT_Attendance'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[14].'"/></td>
					
					<td> <input '.$Social_Chapter_color.' type="text" onchange="Social_Chapter_update('.$desbord_President_detail[0].')" id="Social_Chapter'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[10].'"/></td>
					
					<td> <input '.$Chapter_Retention_color.' type="text" onchange="Chapter_Retention_update('.$desbord_President_detail[0].')" id="Chapter_Retention'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[11].'"/></td>
					
				<td> <input '.$total_score_color.' type="text" onchange="Total_Score_update1('.$desbord_President_detail[0].')" id="Total_Score'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score.'"/></td>
				
                    <td> <input '.$Individual_Ranking_color.' type="text" onchange="Individual_Ranking_update('.$desbord_President_detail[0].')" id="Individual_Ranking'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[13].'"/></td>
				
                </tr> ';
				
				 } 
				
				 
				
				 
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

//Focus_Visitors_update_val
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'Focus_Visitors_update_val')
{
	$desbord_President_id = $_POST['desbord_President_id'];
	$Focus_Visitors_val = $_POST['Focus_Visitors_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_President set Focus_Visitors='$Focus_Visitors_val'where admin_id='$user_id' AND desbord_President_id='$desbord_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                 <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">President</p></th>
                <th><p style="color:#d6d6d6;">Weekly Call Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Monthly Fun in Fundamental</p></th>
                <th><p style="color:#d6d6d6;">Monthly LT Meeting</p></th>
				<th><p style="color:#d6d6d6;">Focus Visitors Days</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Social in the Chapter</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
     $desbord_President_sql = "SELECT * FROM desbord_President";
	//echo $sql;
	$desbord_President_result = mysqli_query($conn, $desbord_President_sql);
	$x=1;
	while ($desbord_President_detail=mysqli_fetch_row($desbord_President_result))
          
		  {
			  
			  if($desbord_President_detail[4] == 15)
			  {
				  $Weekly_Call_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[4] == 10)
			  {
				$Weekly_Call_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Weekly_Call_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[5] == 15)
			  {
				  $per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[5] == 10)
			  {
				$per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[6] == 15)
			  {
				  $Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[6] == 10)
			  {
				$Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[7] == 5)
			  {
				  $Monthly_Fundamental_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_Fundamental_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[8] == 5)
			  {
				  $Monthly_LT_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_LT_color = 'style="background-color:red;"';  
			  }
			  
			     if($desbord_President_detail[9] == 5)
			  {
				  $Focus_Visitors_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Focus_Visitors_color = 'style="background-color:red;"';  
			  }
	        
			  if($desbord_President_detail[10] == 10)
			  {
				  $Social_Chapter_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Social_Chapter_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[11] == 20)
			  {
				  $Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[11] == 15)
			  {
				$Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  $total_score = $desbord_President_detail[4] + $desbord_President_detail[5]+ $desbord_President_detail[6]+ $desbord_President_detail[7]+ $desbord_President_detail[8]+ $desbord_President_detail[9]+ $desbord_President_detail[10]+ $desbord_President_detail[11]+ $desbord_President_detail[14];
					
			  if($total_score >= 70)
			  {
				  $total_score_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_President_detail[13] >=70)
				  {
					 $Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_President_detail[13] >=50 && $desbord_President_detail[13] <=70)
				   {
               $Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_President_detail[13] >=30 && $desbord_President_detail[13] <=50)
				   {
               $Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color =  'style="background-color:black;"';
				  }  
				  
				  
				  if($desbord_President_detail[14] == 10)
			  {
				  $LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
	        
			echo '
                <tr id="valid" value="">
				
				 <td><input  type="text" class="form-control" value="'.$desbord_President_detail[2].'"/></td>
				  
                  <td> <input 
				    
				  
				  type="text" onchange="President_update('.$desbord_President_detail[0].')" id="President'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[3].'"/></td>
                    
                    <td> <input '.$Weekly_Call_color.' type="text" onchange="Weekly_Call_update('.$desbord_President_detail[0].')" id="Weekly_Call'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[4].'"/></td>
					
                   <td> <input '.$per_of_grey_color.' type="text" onchange="per_of_grey_update('.$desbord_President_detail[0].')" id="per_of_grey'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[5].'"/></td>
				   
					<td> <input '.$Monthly_one_two_color.' type="text" onchange="Monthly_one_two_update('.$desbord_President_detail[0].')" id="Monthly_one_two'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[6].'"/></td>
					
					<td> <input '.$Monthly_Fundamental_color.' type="text" onchange="Monthly_Fundamental_update('.$desbord_President_detail[0].')" id="Monthly_Fundamental'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[7].'"/></td>
					
					<td> <input '.$Monthly_LT_color.' type="text" onchange="Monthly_LT_update('.$desbord_President_detail[0].')" id="Monthly_LT'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[8].'"/></td>
					
                    <td> <input '.$Focus_Visitors_color.' type="text" onchange="Focus_Visitors_update('.$desbord_President_detail[0].')" id="Focus_Visitors'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[9].'"/></td>
					
					<td> <input '.$LTRT_Attendance_color.' type="text" onchange="LTRT_Attendance_update('.$desbord_President_detail[0].')" id="LTRT_Attendance'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[14].'"/></td>
					
					<td> <input '.$Social_Chapter_color.' type="text" onchange="Social_Chapter_update('.$desbord_President_detail[0].')" id="Social_Chapter'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[10].'"/></td>
					
					<td> <input '.$Chapter_Retention_color.' type="text" onchange="Chapter_Retention_update('.$desbord_President_detail[0].')" id="Chapter_Retention'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[11].'"/></td>
					
				<td> <input '.$total_score_color.' type="text" onchange="Total_Score_update1('.$desbord_President_detail[0].')" id="Total_Score'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score.'"/></td>
				
                    <td> <input '.$Individual_Ranking_color.' type="text" onchange="Individual_Ranking_update('.$desbord_President_detail[0].')" id="Individual_Ranking'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[13].'"/></td>
				
                </tr> ';
				
				 } 
				
				 
				 
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

//Social_Chapter_update_val

if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'Social_Chapter_update_val')
{
	$desbord_President_id = $_POST['desbord_President_id'];
	$Social_Chapter_val = $_POST['Social_Chapter_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_President set Social_Chapter='$Social_Chapter_val'where admin_id='$user_id' AND desbord_President_id='$desbord_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                 <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">President</p></th>
                <th><p style="color:#d6d6d6;">Weekly Call Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Monthly Fun in Fundamental</p></th>
                <th><p style="color:#d6d6d6;">Monthly LT Meeting</p></th>
				<th><p style="color:#d6d6d6;">Focus Visitors Days</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Social in the Chapter</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
     $desbord_President_sql = "SELECT * FROM desbord_President";
	//echo $sql;
	$desbord_President_result = mysqli_query($conn, $desbord_President_sql);
	$x=1;
	while ($desbord_President_detail=mysqli_fetch_row($desbord_President_result))
          
		  {
			  
			  if($desbord_President_detail[4] == 15)
			  {
				  $Weekly_Call_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[4] == 10)
			  {
				$Weekly_Call_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Weekly_Call_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[5] == 15)
			  {
				  $per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[5] == 10)
			  {
				$per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[6] == 15)
			  {
				  $Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[6] == 10)
			  {
				$Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[7] == 5)
			  {
				  $Monthly_Fundamental_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_Fundamental_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[8] == 5)
			  {
				  $Monthly_LT_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_LT_color = 'style="background-color:red;"';  
			  }
			  
			     if($desbord_President_detail[9] == 5)
			  {
				  $Focus_Visitors_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Focus_Visitors_color = 'style="background-color:red;"';  
			  }
	        
			  if($desbord_President_detail[10] == 10)
			  {
				  $Social_Chapter_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Social_Chapter_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[11] == 20)
			  {
				  $Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[11] == 15)
			  {
				$Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  $total_score = $desbord_President_detail[4] + $desbord_President_detail[5]+ $desbord_President_detail[6]+ $desbord_President_detail[7]+ $desbord_President_detail[8]+ $desbord_President_detail[9]+ $desbord_President_detail[10]+ $desbord_President_detail[11]+ $desbord_President_detail[14];
					
			  if($total_score >= 70)
			  {
				  $total_score_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_President_detail[13] >=70)
				  {
					 $Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_President_detail[13] >=50 && $desbord_President_detail[13] <=70)
				   {
               $Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_President_detail[13] >=30 && $desbord_President_detail[13] <=50)
				   {
               $Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color =  'style="background-color:black;"';
				  }  
				  
				  
				  if($desbord_President_detail[14] == 10)
			  {
				  $LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
	        
			echo '
                <tr id="valid" value="">
				
				 <td><input  type="text" class="form-control" value="'.$desbord_President_detail[2].'"/></td>
				  
                  <td> <input 
				    
				  
				  type="text" onchange="President_update('.$desbord_President_detail[0].')" id="President'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[3].'"/></td>
                    
                    <td> <input '.$Weekly_Call_color.' type="text" onchange="Weekly_Call_update('.$desbord_President_detail[0].')" id="Weekly_Call'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[4].'"/></td>
					
                   <td> <input '.$per_of_grey_color.' type="text" onchange="per_of_grey_update('.$desbord_President_detail[0].')" id="per_of_grey'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[5].'"/></td>
				   
					<td> <input '.$Monthly_one_two_color.' type="text" onchange="Monthly_one_two_update('.$desbord_President_detail[0].')" id="Monthly_one_two'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[6].'"/></td>
					
					<td> <input '.$Monthly_Fundamental_color.' type="text" onchange="Monthly_Fundamental_update('.$desbord_President_detail[0].')" id="Monthly_Fundamental'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[7].'"/></td>
					
					<td> <input '.$Monthly_LT_color.' type="text" onchange="Monthly_LT_update('.$desbord_President_detail[0].')" id="Monthly_LT'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[8].'"/></td>
					
                    <td> <input '.$Focus_Visitors_color.' type="text" onchange="Focus_Visitors_update('.$desbord_President_detail[0].')" id="Focus_Visitors'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[9].'"/></td>
					
					<td> <input '.$LTRT_Attendance_color.' type="text" onchange="LTRT_Attendance_update('.$desbord_President_detail[0].')" id="LTRT_Attendance'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[14].'"/></td>
					
					<td> <input '.$Social_Chapter_color.' type="text" onchange="Social_Chapter_update('.$desbord_President_detail[0].')" id="Social_Chapter'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[10].'"/></td>
					
					<td> <input '.$Chapter_Retention_color.' type="text" onchange="Chapter_Retention_update('.$desbord_President_detail[0].')" id="Chapter_Retention'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[11].'"/></td>
					
				<td> <input '.$total_score_color.' type="text" onchange="Total_Score_update1('.$desbord_President_detail[0].')" id="Total_Score'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score.'"/></td>
				
                    <td> <input '.$Individual_Ranking_color.' type="text" onchange="Individual_Ranking_update('.$desbord_President_detail[0].')" id="Individual_Ranking'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[13].'"/></td>
				
                </tr> ';
				
				 } 
				
				 
				
				 
				 
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

//Chapter_Retention_update_val
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'Chapter_Retention_update_val')
{
	$desbord_President_id = $_POST['desbord_President_id'];
	$Chapter_Retention_val = $_POST['Chapter_Retention_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_President set Chapter_Retention='$Chapter_Retention_val'where admin_id='$user_id' AND desbord_President_id='$desbord_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">President</p></th>
                <th><p style="color:#d6d6d6;">Weekly Call Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Monthly Fun in Fundamental</p></th>
                <th><p style="color:#d6d6d6;">Monthly LT Meeting</p></th>
				<th><p style="color:#d6d6d6;">Focus Visitors Days</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Social in the Chapter</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
     $desbord_President_sql = "SELECT * FROM desbord_President";
	//echo $sql;
	$desbord_President_result = mysqli_query($conn, $desbord_President_sql);
	$x=1;
	while ($desbord_President_detail=mysqli_fetch_row($desbord_President_result))
          
		  {
			  
			  if($desbord_President_detail[4] == 15)
			  {
				  $Weekly_Call_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[4] == 10)
			  {
				$Weekly_Call_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Weekly_Call_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[5] == 15)
			  {
				  $per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[5] == 10)
			  {
				$per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[6] == 15)
			  {
				  $Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[6] == 10)
			  {
				$Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[7] == 5)
			  {
				  $Monthly_Fundamental_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_Fundamental_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[8] == 5)
			  {
				  $Monthly_LT_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_LT_color = 'style="background-color:red;"';  
			  }
			  
			     if($desbord_President_detail[9] == 5)
			  {
				  $Focus_Visitors_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Focus_Visitors_color = 'style="background-color:red;"';  
			  }
	        
			  if($desbord_President_detail[10] == 10)
			  {
				  $Social_Chapter_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Social_Chapter_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[11] == 20)
			  {
				  $Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[11] == 15)
			  {
				$Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  $total_score = $desbord_President_detail[4] + $desbord_President_detail[5]+ $desbord_President_detail[6]+ $desbord_President_detail[7]+ $desbord_President_detail[8]+ $desbord_President_detail[9]+ $desbord_President_detail[10]+ $desbord_President_detail[11]+ $desbord_President_detail[14];
					
			  if($total_score >= 70)
			  {
				  $total_score_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_President_detail[13] >=70)
				  {
					 $Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_President_detail[13] >=50 && $desbord_President_detail[13] <=70)
				   {
               $Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_President_detail[13] >=30 && $desbord_President_detail[13] <=50)
				   {
               $Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color =  'style="background-color:black;"';
				  }  
				  
				  
				  if($desbord_President_detail[14] == 10)
			  {
				  $LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
	        
			echo '
                <tr id="valid" value="">
				
				 <td><input  type="text" class="form-control" value="'.$desbord_President_detail[2].'"/></td>
				  
                  <td> <input 
				    
				  
				  type="text" onchange="President_update('.$desbord_President_detail[0].')" id="President'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[3].'"/></td>
                    
                    <td> <input '.$Weekly_Call_color.' type="text" onchange="Weekly_Call_update('.$desbord_President_detail[0].')" id="Weekly_Call'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[4].'"/></td>
					
                   <td> <input '.$per_of_grey_color.' type="text" onchange="per_of_grey_update('.$desbord_President_detail[0].')" id="per_of_grey'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[5].'"/></td>
				   
					<td> <input '.$Monthly_one_two_color.' type="text" onchange="Monthly_one_two_update('.$desbord_President_detail[0].')" id="Monthly_one_two'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[6].'"/></td>
					
					<td> <input '.$Monthly_Fundamental_color.' type="text" onchange="Monthly_Fundamental_update('.$desbord_President_detail[0].')" id="Monthly_Fundamental'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[7].'"/></td>
					
					<td> <input '.$Monthly_LT_color.' type="text" onchange="Monthly_LT_update('.$desbord_President_detail[0].')" id="Monthly_LT'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[8].'"/></td>
					
                    <td> <input '.$Focus_Visitors_color.' type="text" onchange="Focus_Visitors_update('.$desbord_President_detail[0].')" id="Focus_Visitors'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[9].'"/></td>
					
					<td> <input '.$LTRT_Attendance_color.' type="text" onchange="LTRT_Attendance_update('.$desbord_President_detail[0].')" id="LTRT_Attendance'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[14].'"/></td>
					
					<td> <input '.$Social_Chapter_color.' type="text" onchange="Social_Chapter_update('.$desbord_President_detail[0].')" id="Social_Chapter'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[10].'"/></td>
					
					<td> <input '.$Chapter_Retention_color.' type="text" onchange="Chapter_Retention_update('.$desbord_President_detail[0].')" id="Chapter_Retention'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[11].'"/></td>
					
				<td> <input '.$total_score_color.' type="text" onchange="Total_Score_update1('.$desbord_President_detail[0].')" id="Total_Score'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score.'"/></td>
				
                    <td> <input '.$Individual_Ranking_color.' type="text" onchange="Individual_Ranking_update('.$desbord_President_detail[0].')" id="Individual_Ranking'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[13].'"/></td>
				
                </tr> ';
				
				 } 
				
				 
				
				 
				 
				
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}
//LTRT_Attendance_update_val

if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'LTRT_Attendance_update_val')
{
	$desbord_President_id = $_POST['desbord_President_id'];
	$LTRT_Attendance_val = $_POST['LTRT_Attendance_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_President set LTRT_Attendance='$LTRT_Attendance_val'where admin_id='$user_id' AND desbord_President_id='$desbord_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                 <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">President</p></th>
                <th><p style="color:#d6d6d6;">Weekly Call Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Monthly Fun in Fundamental</p></th>
                <th><p style="color:#d6d6d6;">Monthly LT Meeting</p></th>
				<th><p style="color:#d6d6d6;">Focus Visitors Days</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Social in the Chapter</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
     $desbord_President_sql = "SELECT * FROM desbord_President";
	//echo $sql;
	$desbord_President_result = mysqli_query($conn, $desbord_President_sql);
	$x=1;
	while ($desbord_President_detail=mysqli_fetch_row($desbord_President_result))
          
		  {
			  
			  if($desbord_President_detail[4] == 15)
			  {
				  $Weekly_Call_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[4] == 10)
			  {
				$Weekly_Call_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Weekly_Call_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[5] == 15)
			  {
				  $per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[5] == 10)
			  {
				$per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[6] == 15)
			  {
				  $Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[6] == 10)
			  {
				$Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[7] == 5)
			  {
				  $Monthly_Fundamental_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_Fundamental_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[8] == 5)
			  {
				  $Monthly_LT_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_LT_color = 'style="background-color:red;"';  
			  }
			  
			     if($desbord_President_detail[9] == 5)
			  {
				  $Focus_Visitors_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Focus_Visitors_color = 'style="background-color:red;"';  
			  }
	        
			  if($desbord_President_detail[10] == 10)
			  {
				  $Social_Chapter_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Social_Chapter_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[11] == 20)
			  {
				  $Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[11] == 15)
			  {
				$Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  $total_score = $desbord_President_detail[4] + $desbord_President_detail[5]+ $desbord_President_detail[6]+ $desbord_President_detail[7]+ $desbord_President_detail[8]+ $desbord_President_detail[9]+ $desbord_President_detail[10]+ $desbord_President_detail[11]+ $desbord_President_detail[14];
					
			  if($total_score >= 70)
			  {
				  $total_score_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_President_detail[13] >=70)
				  {
					 $Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_President_detail[13] >=50 && $desbord_President_detail[13] <=70)
				   {
               $Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_President_detail[13] >=30 && $desbord_President_detail[13] <=50)
				   {
               $Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color =  'style="background-color:black;"';
				  }  
				  
				  
				  if($desbord_President_detail[14] == 10)
			  {
				  $LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
	        
			echo '
                <tr id="valid" value="">
				
				 <td><input  type="text" class="form-control" value="'.$desbord_President_detail[2].'"/></td>
				  
                  <td> <input 
				    
				  
				  type="text" onchange="President_update('.$desbord_President_detail[0].')" id="President'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[3].'"/></td>
                    
                    <td> <input '.$Weekly_Call_color.' type="text" onchange="Weekly_Call_update('.$desbord_President_detail[0].')" id="Weekly_Call'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[4].'"/></td>
					
                   <td> <input '.$per_of_grey_color.' type="text" onchange="per_of_grey_update('.$desbord_President_detail[0].')" id="per_of_grey'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[5].'"/></td>
				   
					<td> <input '.$Monthly_one_two_color.' type="text" onchange="Monthly_one_two_update('.$desbord_President_detail[0].')" id="Monthly_one_two'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[6].'"/></td>
					
					<td> <input '.$Monthly_Fundamental_color.' type="text" onchange="Monthly_Fundamental_update('.$desbord_President_detail[0].')" id="Monthly_Fundamental'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[7].'"/></td>
					
					<td> <input '.$Monthly_LT_color.' type="text" onchange="Monthly_LT_update('.$desbord_President_detail[0].')" id="Monthly_LT'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[8].'"/></td>
					
                    <td> <input '.$Focus_Visitors_color.' type="text" onchange="Focus_Visitors_update('.$desbord_President_detail[0].')" id="Focus_Visitors'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[9].'"/></td>
					
					<td> <input '.$LTRT_Attendance_color.' type="text" onchange="LTRT_Attendance_update('.$desbord_President_detail[0].')" id="LTRT_Attendance'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[14].'"/></td>
					
					<td> <input '.$Social_Chapter_color.' type="text" onchange="Social_Chapter_update('.$desbord_President_detail[0].')" id="Social_Chapter'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[10].'"/></td>
					
					<td> <input '.$Chapter_Retention_color.' type="text" onchange="Chapter_Retention_update('.$desbord_President_detail[0].')" id="Chapter_Retention'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[11].'"/></td>
					
				<td> <input '.$total_score_color.' type="text" onchange="Total_Score_update1('.$desbord_President_detail[0].')" id="Total_Score'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score.'"/></td>
				
                    <td> <input '.$Individual_Ranking_color.' type="text" onchange="Individual_Ranking_update('.$desbord_President_detail[0].')" id="Individual_Ranking'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[13].'"/></td>
				
                </tr> ';
				
				 } 
				
				 
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}
//Individual_Ranking_update_val

   if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'Individual_Ranking_update_val')
{
	$desbord_President_id = $_POST['desbord_President_id'];
	$Individual_Ranking_val = $_POST['Individual_Ranking_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_President set Individual_Ranking='$Individual_Ranking_val'where admin_id='$user_id' AND desbord_President_id='$desbord_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                 <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">President</p></th>
                <th><p style="color:#d6d6d6;">Weekly Call Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Monthly Fun in Fundamental</p></th>
                <th><p style="color:#d6d6d6;">Monthly LT Meeting</p></th>
				<th><p style="color:#d6d6d6;">Focus Visitors Days</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Social in the Chapter</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
     $desbord_President_sql = "SELECT * FROM desbord_President";
	//echo $sql;
	$desbord_President_result = mysqli_query($conn, $desbord_President_sql);
	$x=1;
	while ($desbord_President_detail=mysqli_fetch_row($desbord_President_result))
          
		  {
			  
			  if($desbord_President_detail[4] == 15)
			  {
				  $Weekly_Call_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[4] == 10)
			  {
				$Weekly_Call_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Weekly_Call_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[5] == 15)
			  {
				  $per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[5] == 10)
			  {
				$per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[6] == 15)
			  {
				  $Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[6] == 10)
			  {
				$Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[7] == 5)
			  {
				  $Monthly_Fundamental_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_Fundamental_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_President_detail[8] == 5)
			  {
				  $Monthly_LT_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Monthly_LT_color = 'style="background-color:red;"';  
			  }
			  
			     if($desbord_President_detail[9] == 5)
			  {
				  $Focus_Visitors_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Focus_Visitors_color = 'style="background-color:red;"';  
			  }
	        
			  if($desbord_President_detail[10] == 10)
			  {
				  $Social_Chapter_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $Social_Chapter_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_President_detail[11] == 20)
			  {
				  $Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_President_detail[11] == 15)
			  {
				$Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  $total_score = $desbord_President_detail[4] + $desbord_President_detail[5]+ $desbord_President_detail[6]+ $desbord_President_detail[7]+ $desbord_President_detail[8]+ $desbord_President_detail[9]+ $desbord_President_detail[10]+ $desbord_President_detail[11]+ $desbord_President_detail[14];
					
			  if($total_score >= 70)
			  {
				  $total_score_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_President_detail[13] >=70)
				  {
					 $Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_President_detail[13] >=50 && $desbord_President_detail[13] <=70)
				   {
               $Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_President_detail[13] >=30 && $desbord_President_detail[13] <=50)
				   {
               $Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color =  'style="background-color:black;"';
				  }  
				  
				  
				  if($desbord_President_detail[14] == 10)
			  {
				  $LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
	        
			echo '
                <tr id="valid" value="">
				
				 <td><input  type="text" class="form-control" value="'.$desbord_President_detail[2].'"/></td>
				  
                  <td> <input 
				    
				  
				  type="text" onchange="President_update('.$desbord_President_detail[0].')" id="President'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[3].'"/></td>
                    
                    <td> <input '.$Weekly_Call_color.' type="text" onchange="Weekly_Call_update('.$desbord_President_detail[0].')" id="Weekly_Call'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[4].'"/></td>
					
                   <td> <input '.$per_of_grey_color.' type="text" onchange="per_of_grey_update('.$desbord_President_detail[0].')" id="per_of_grey'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[5].'"/></td>
				   
					<td> <input '.$Monthly_one_two_color.' type="text" onchange="Monthly_one_two_update('.$desbord_President_detail[0].')" id="Monthly_one_two'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[6].'"/></td>
					
					<td> <input '.$Monthly_Fundamental_color.' type="text" onchange="Monthly_Fundamental_update('.$desbord_President_detail[0].')" id="Monthly_Fundamental'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[7].'"/></td>
					
					<td> <input '.$Monthly_LT_color.' type="text" onchange="Monthly_LT_update('.$desbord_President_detail[0].')" id="Monthly_LT'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[8].'"/></td>
					
                    <td> <input '.$Focus_Visitors_color.' type="text" onchange="Focus_Visitors_update('.$desbord_President_detail[0].')" id="Focus_Visitors'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[9].'"/></td>
					
					<td> <input '.$LTRT_Attendance_color.' type="text" onchange="LTRT_Attendance_update('.$desbord_President_detail[0].')" id="LTRT_Attendance'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[14].'"/></td>
					
					<td> <input '.$Social_Chapter_color.' type="text" onchange="Social_Chapter_update('.$desbord_President_detail[0].')" id="Social_Chapter'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[10].'"/></td>
					
					<td> <input '.$Chapter_Retention_color.' type="text" onchange="Chapter_Retention_update('.$desbord_President_detail[0].')" id="Chapter_Retention'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[11].'"/></td>
					
				<td> <input '.$total_score_color.' type="text" onchange="Total_Score_update1('.$desbord_President_detail[0].')" id="Total_Score'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score.'"/></td>
				
                    <td> <input '.$Individual_Ranking_color.' type="text" onchange="Individual_Ranking_update('.$desbord_President_detail[0].')" id="Individual_Ranking'.$desbord_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_President_detail[13].'"/></td>
				
                </tr> ';
				
				 } 
				
				 
				 
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

// code for vice_presedent update




// vice_President_update_val update name

if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'vice_President_update_val')
{
	$vice_President_id = $_POST['vice_President_id'];
	$vice_President_name = $_POST['vice_President_name'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_vice_president set vice_President_name='$vice_President_name'where admin_id='$user_id' AND desbord_vice_President_id='$vice_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">Vice President</p></th>
                <th><p style="color:#d6d6d6;">Monthly VP Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Net Memebrship Addition</p></th>
                <th><p style="color:#d6d6d6;">Control Letters Sent</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking
</p></th>
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_vice_President_sql = "SELECT * FROM desbord_vice_president";
	//echo $sql;
	$desbord_vice_President_result = mysqli_query($conn, $desbord_vice_President_sql);
	$x=1;
	while ($desbord_vice_President_detail=mysqli_fetch_row($desbord_vice_President_result))
          
		  {
	 
	           if($desbord_vice_President_detail[4] == 15)
			  {
				  $vice_Monthly_VP_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[4] == 10)
			  {
				$vice_Monthly_VP_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_VP_color = 'style="background-color:red;"';  
			  }
			  
			  
			  
			    if($desbord_vice_President_detail[5] == 15)
			  {
				  $vice_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[5] == 10)
			  {
				$vice_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[6] == 15)
			  {
				  $vice_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[6] == 10)
			  {
				$vice_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
                 
				 
	           if($desbord_vice_President_detail[7] == 10)
			  {
				  $vice_Net_Memebrship_Addition_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[7] == 5)
			  {
				$vice_Net_Memebrship_Addition_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Net_Memebrship_Addition_color = 'style="background-color:red;"';  
			  }
	           
			   
			     if($desbord_vice_President_detail[8] == 15)
			  {
				  $vice_Control_Letters_Sent_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[8] == 10)
			  {
				$vice_Control_Letters_Sent_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Control_Letters_Sent_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_vice_President_detail[9] == 10)
			  {
				  $vice_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $vice_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[10] == 20)
			  {
				  $vice_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[10] == 15)
			  {
				$vice_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			   $total_score_vice = $desbord_vice_President_detail[4] + $desbord_vice_President_detail[5]+ $desbord_vice_President_detail[6]+ $desbord_vice_President_detail[7]+ $desbord_vice_President_detail[8]+ $desbord_vice_President_detail[9]+ $desbord_vice_President_detail[10];
					
			  if($total_score_vice >= 70)
			  {
				  $total_score_vice_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			    if($desbord_vice_President_detail[12] >=70)
				  {
					 $Individual_Ranking_color_vice = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_vice_President_detail[12] >=50 && $desbord_vice_President_detail[12] <=70)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_vice_President_detail[12] >=30 && $desbord_vice_President_detail[12] <=50)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color_vice =  'style="background-color:black;"';
				  }
			  
			  
			  
	 
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_vice_President_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="vice_President_update('.$desbord_vice_President_detail[0].')" id="vice_President'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[3].'"/></td>
                    
                    <td> <input '.$vice_Monthly_VP_color.' type="text" onchange="vice_Monthly_VP_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_VP'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[4].'"/></td>
					
                   <td> <input '.$vice_per_of_grey_color.' type="text" onchange="vice_per_of_grey_update('.$desbord_vice_President_detail[0].')" id="vice_per_of_grey'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[5].'"/></td>
				   
					<td> <input  '.$vice_Monthly_one_two_color.' type="text" onchange="vice_Monthly_one_two_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_one_two'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[6].'"/></td>
					
					<td> <input '.$vice_Net_Memebrship_Addition_color.' type="text" onchange="vice_Net_Memebrship_Addition_update('.$desbord_vice_President_detail[0].')" id="vice_Net_Memebrship_Addition'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[7].'"/></td>
					
					<td> <input '.$vice_Control_Letters_Sent_color.' type="text" onchange="vice_Control_Letters_Sent_update('.$desbord_vice_President_detail[0].')" id="vice_Control_Letters_Sent'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[8].'"/></td>
					
                    <td> <input '.$vice_LTRT_Attendance_color.' type="text" onchange="vice_LTRT_Attendance_update('.$desbord_vice_President_detail[0].')" id="vice_LTRT_Attendance'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[9].'"/></td>
					
					<td> <input  '.$vice_Chapter_Retention_color.' type="text" onchange="vice_Chapter_Retention_update('.$desbord_vice_President_detail[0].')" id="vice_Chapter_Retention'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[10].'"/></td>
					
					<td> <input '.$total_score_vice_color.' type="text" onchange="vice_Total_Score_update1('.$desbord_vice_President_detail[0].')" id="vice_Total_Score'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_vice.'"/></td>
					
					<td> <input '.$Individual_Ranking_color_vice.'type="text" onchange="vice_Individual_Ranking_update('.$desbord_vice_President_detail[0].')" id="vice_Individual_Ranking'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[12].'"/></td>
				
				
                </tr> ';
				
				 } 
				
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}




// vice_Monthly_VP_update_val update 
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'vice_Monthly_VP_update_val')
{
	$vice_President_id = $_POST['desbord_vice_President_id'];
	$vice_Monthly_VP_val = $_POST['vice_Monthly_VP_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_vice_president set Monthly_VP='$vice_Monthly_VP_val'where admin_id='$user_id' AND desbord_vice_President_id='$vice_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">Vice President</p></th>
                <th><p style="color:#d6d6d6;">Monthly VP Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Net Memebrship Addition</p></th>
                <th><p style="color:#d6d6d6;">Control Letters Sent</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking
</p></th>
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_vice_President_sql = "SELECT * FROM desbord_vice_president";
	//echo $sql;
	$desbord_vice_President_result = mysqli_query($conn, $desbord_vice_President_sql);
	$x=1;
	while ($desbord_vice_President_detail=mysqli_fetch_row($desbord_vice_President_result))
          
		  {
	 
	           if($desbord_vice_President_detail[4] == 15)
			  {
				  $vice_Monthly_VP_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[4] == 10)
			  {
				$vice_Monthly_VP_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_VP_color = 'style="background-color:red;"';  
			  }
			  
			  
			  
			    if($desbord_vice_President_detail[5] == 15)
			  {
				  $vice_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[5] == 10)
			  {
				$vice_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[6] == 15)
			  {
				  $vice_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[6] == 10)
			  {
				$vice_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
                 
				 
	           if($desbord_vice_President_detail[7] == 10)
			  {
				  $vice_Net_Memebrship_Addition_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[7] == 5)
			  {
				$vice_Net_Memebrship_Addition_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Net_Memebrship_Addition_color = 'style="background-color:red;"';  
			  }
	           
			   
			     if($desbord_vice_President_detail[8] == 15)
			  {
				  $vice_Control_Letters_Sent_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[8] == 10)
			  {
				$vice_Control_Letters_Sent_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Control_Letters_Sent_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_vice_President_detail[9] == 10)
			  {
				  $vice_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $vice_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[10] == 20)
			  {
				  $vice_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[10] == 15)
			  {
				$vice_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			   $total_score_vice = $desbord_vice_President_detail[4] + $desbord_vice_President_detail[5]+ $desbord_vice_President_detail[6]+ $desbord_vice_President_detail[7]+ $desbord_vice_President_detail[8]+ $desbord_vice_President_detail[9]+ $desbord_vice_President_detail[10];
					
			  if($total_score_vice >= 70)
			  {
				  $total_score_vice_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[12] >=70)
				  {
					 $Individual_Ranking_color_vice = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_vice_President_detail[12] >=50 && $desbord_vice_President_detail[12] <=70)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_vice_President_detail[12] >=30 && $desbord_vice_President_detail[12] <=50)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color_vice =  'style="background-color:black;"';
				  }
			  
			  
			  
	 
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_vice_President_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="vice_President_update('.$desbord_vice_President_detail[0].')" id="vice_President'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[3].'"/></td>
                    
                    <td> <input '.$vice_Monthly_VP_color.' type="text" onchange="vice_Monthly_VP_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_VP'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[4].'"/></td>
					
                   <td> <input '.$vice_per_of_grey_color.' type="text" onchange="vice_per_of_grey_update('.$desbord_vice_President_detail[0].')" id="vice_per_of_grey'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[5].'"/></td>
				   
					<td> <input  '.$vice_Monthly_one_two_color.' type="text" onchange="vice_Monthly_one_two_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_one_two'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[6].'"/></td>
					
					<td> <input '.$vice_Net_Memebrship_Addition_color.' type="text" onchange="vice_Net_Memebrship_Addition_update('.$desbord_vice_President_detail[0].')" id="vice_Net_Memebrship_Addition'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[7].'"/></td>
					
					<td> <input '.$vice_Control_Letters_Sent_color.' type="text" onchange="vice_Control_Letters_Sent_update('.$desbord_vice_President_detail[0].')" id="vice_Control_Letters_Sent'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[8].'"/></td>
					
                    <td> <input '.$vice_LTRT_Attendance_color.' type="text" onchange="vice_LTRT_Attendance_update('.$desbord_vice_President_detail[0].')" id="vice_LTRT_Attendance'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[9].'"/></td>
					
					<td> <input  '.$vice_Chapter_Retention_color.' type="text" onchange="vice_Chapter_Retention_update('.$desbord_vice_President_detail[0].')" id="vice_Chapter_Retention'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[10].'"/></td>
					
					<td> <input '.$total_score_vice_color.' type="text" onchange="vice_Total_Score_update1('.$desbord_vice_President_detail[0].')" id="vice_Total_Score'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_vice.'"/></td>
					
					<td> <input '.$Individual_Ranking_color_vice.'type="text" onchange="vice_Individual_Ranking_update('.$desbord_vice_President_detail[0].')" id="vice_Individual_Ranking'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[12].'"/></td>
				
				
                </tr> ';
				
				 } 
				
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}


   
// vice_per_of_grey_update_val update 
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'vice_per_of_grey_update_val')
{
	$vice_President_id = $_POST['desbord_vice_President_id'];
	$vice_per_of_grey_val = $_POST['vice_per_of_grey_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_vice_president set per_of_Grey_chapter='$vice_per_of_grey_val'where admin_id='$user_id' AND desbord_vice_President_id='$vice_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">Vice President</p></th>
                <th><p style="color:#d6d6d6;">Monthly VP Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Net Memebrship Addition</p></th>
                <th><p style="color:#d6d6d6;">Control Letters Sent</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking
</p></th>
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_vice_President_sql = "SELECT * FROM desbord_vice_president";
	//echo $sql;
	$desbord_vice_President_result = mysqli_query($conn, $desbord_vice_President_sql);
	$x=1;
	while ($desbord_vice_President_detail=mysqli_fetch_row($desbord_vice_President_result))
          
		  {
	 
	           if($desbord_vice_President_detail[4] == 15)
			  {
				  $vice_Monthly_VP_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[4] == 10)
			  {
				$vice_Monthly_VP_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_VP_color = 'style="background-color:red;"';  
			  }
			  
			  
			  
			    if($desbord_vice_President_detail[5] == 15)
			  {
				  $vice_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[5] == 10)
			  {
				$vice_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[6] == 15)
			  {
				  $vice_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[6] == 10)
			  {
				$vice_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
                 
				 
	           if($desbord_vice_President_detail[7] == 10)
			  {
				  $vice_Net_Memebrship_Addition_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[7] == 5)
			  {
				$vice_Net_Memebrship_Addition_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Net_Memebrship_Addition_color = 'style="background-color:red;"';  
			  }
	           
			   
			     if($desbord_vice_President_detail[8] == 15)
			  {
				  $vice_Control_Letters_Sent_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[8] == 10)
			  {
				$vice_Control_Letters_Sent_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Control_Letters_Sent_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_vice_President_detail[9] == 10)
			  {
				  $vice_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $vice_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[10] == 20)
			  {
				  $vice_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[10] == 15)
			  {
				$vice_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			   $total_score_vice = $desbord_vice_President_detail[4] + $desbord_vice_President_detail[5]+ $desbord_vice_President_detail[6]+ $desbord_vice_President_detail[7]+ $desbord_vice_President_detail[8]+ $desbord_vice_President_detail[9]+ $desbord_vice_President_detail[10];
					
			  if($total_score_vice >= 70)
			  {
				  $total_score_vice_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[12] >=70)
				  {
					 $Individual_Ranking_color_vice = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_vice_President_detail[12] >=50 && $desbord_vice_President_detail[12] <=70)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_vice_President_detail[12] >=30 && $desbord_vice_President_detail[12] <=50)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color_vice =  'style="background-color:black;"';
				  }
			  
			  
			  
	 
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_vice_President_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="vice_President_update('.$desbord_vice_President_detail[0].')" id="vice_President'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[3].'"/></td>
                    
                    <td> <input '.$vice_Monthly_VP_color.' type="text" onchange="vice_Monthly_VP_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_VP'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[4].'"/></td>
					
                   <td> <input '.$vice_per_of_grey_color.' type="text" onchange="vice_per_of_grey_update('.$desbord_vice_President_detail[0].')" id="vice_per_of_grey'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[5].'"/></td>
				   
					<td> <input  '.$vice_Monthly_one_two_color.' type="text" onchange="vice_Monthly_one_two_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_one_two'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[6].'"/></td>
					
					<td> <input '.$vice_Net_Memebrship_Addition_color.' type="text" onchange="vice_Net_Memebrship_Addition_update('.$desbord_vice_President_detail[0].')" id="vice_Net_Memebrship_Addition'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[7].'"/></td>
					
					<td> <input '.$vice_Control_Letters_Sent_color.' type="text" onchange="vice_Control_Letters_Sent_update('.$desbord_vice_President_detail[0].')" id="vice_Control_Letters_Sent'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[8].'"/></td>
					
                    <td> <input '.$vice_LTRT_Attendance_color.' type="text" onchange="vice_LTRT_Attendance_update('.$desbord_vice_President_detail[0].')" id="vice_LTRT_Attendance'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[9].'"/></td>
					
					<td> <input  '.$vice_Chapter_Retention_color.' type="text" onchange="vice_Chapter_Retention_update('.$desbord_vice_President_detail[0].')" id="vice_Chapter_Retention'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[10].'"/></td>
					
					<td> <input '.$total_score_vice_color.' type="text" onchange="vice_Total_Score_update1('.$desbord_vice_President_detail[0].')" id="vice_Total_Score'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_vice.'"/></td>
					
					<td> <input '.$Individual_Ranking_color_vice.'type="text" onchange="vice_Individual_Ranking_update('.$desbord_vice_President_detail[0].')" id="vice_Individual_Ranking'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[12].'"/></td>
				
				
                </tr> ';
				
				 } 
				
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}


   
// vice_Monthly_one_two_update_val update 
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'vice_Monthly_one_two_update_val')
{
	$vice_President_id = $_POST['desbord_vice_President_id'];
	$vice_Monthly_one_two_val = $_POST['vice_Monthly_one_two_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_vice_president set Monthly_one_two='$vice_Monthly_one_two_val' where admin_id='$user_id' AND desbord_vice_President_id='$vice_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
               <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">Vice President</p></th>
                <th><p style="color:#d6d6d6;">Monthly VP Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Net Memebrship Addition</p></th>
                <th><p style="color:#d6d6d6;">Control Letters Sent</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking
</p></th>
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_vice_President_sql = "SELECT * FROM desbord_vice_president";
	//echo $sql;
	$desbord_vice_President_result = mysqli_query($conn, $desbord_vice_President_sql);
	$x=1;
	while ($desbord_vice_President_detail=mysqli_fetch_row($desbord_vice_President_result))
          
		  {
	 
	           if($desbord_vice_President_detail[4] == 15)
			  {
				  $vice_Monthly_VP_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[4] == 10)
			  {
				$vice_Monthly_VP_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_VP_color = 'style="background-color:red;"';  
			  }
			  
			  
			  
			    if($desbord_vice_President_detail[5] == 15)
			  {
				  $vice_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[5] == 10)
			  {
				$vice_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[6] == 15)
			  {
				  $vice_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[6] == 10)
			  {
				$vice_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
                 
				 
	           if($desbord_vice_President_detail[7] == 10)
			  {
				  $vice_Net_Memebrship_Addition_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[7] == 5)
			  {
				$vice_Net_Memebrship_Addition_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Net_Memebrship_Addition_color = 'style="background-color:red;"';  
			  }
	           
			   
			     if($desbord_vice_President_detail[8] == 15)
			  {
				  $vice_Control_Letters_Sent_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[8] == 10)
			  {
				$vice_Control_Letters_Sent_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Control_Letters_Sent_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_vice_President_detail[9] == 10)
			  {
				  $vice_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $vice_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[10] == 20)
			  {
				  $vice_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[10] == 15)
			  {
				$vice_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			   $total_score_vice = $desbord_vice_President_detail[4] + $desbord_vice_President_detail[5]+ $desbord_vice_President_detail[6]+ $desbord_vice_President_detail[7]+ $desbord_vice_President_detail[8]+ $desbord_vice_President_detail[9]+ $desbord_vice_President_detail[10];
					
			  if($total_score_vice >= 70)
			  {
				  $total_score_vice_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			    if($desbord_vice_President_detail[12] >=70)
				  {
					 $Individual_Ranking_color_vice = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_vice_President_detail[12] >=50 && $desbord_vice_President_detail[12] <=70)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_vice_President_detail[12] >=30 && $desbord_vice_President_detail[12] <=50)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color_vice =  'style="background-color:black;"';
				  }
			  
			  
			  
	 
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_vice_President_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="vice_President_update('.$desbord_vice_President_detail[0].')" id="vice_President'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[3].'"/></td>
                    
                    <td> <input '.$vice_Monthly_VP_color.' type="text" onchange="vice_Monthly_VP_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_VP'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[4].'"/></td>
					
                   <td> <input '.$vice_per_of_grey_color.' type="text" onchange="vice_per_of_grey_update('.$desbord_vice_President_detail[0].')" id="vice_per_of_grey'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[5].'"/></td>
				   
					<td> <input  '.$vice_Monthly_one_two_color.' type="text" onchange="vice_Monthly_one_two_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_one_two'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[6].'"/></td>
					
					<td> <input '.$vice_Net_Memebrship_Addition_color.' type="text" onchange="vice_Net_Memebrship_Addition_update('.$desbord_vice_President_detail[0].')" id="vice_Net_Memebrship_Addition'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[7].'"/></td>
					
					<td> <input '.$vice_Control_Letters_Sent_color.' type="text" onchange="vice_Control_Letters_Sent_update('.$desbord_vice_President_detail[0].')" id="vice_Control_Letters_Sent'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[8].'"/></td>
					
                    <td> <input '.$vice_LTRT_Attendance_color.' type="text" onchange="vice_LTRT_Attendance_update('.$desbord_vice_President_detail[0].')" id="vice_LTRT_Attendance'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[9].'"/></td>
					
					<td> <input  '.$vice_Chapter_Retention_color.' type="text" onchange="vice_Chapter_Retention_update('.$desbord_vice_President_detail[0].')" id="vice_Chapter_Retention'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[10].'"/></td>
					
					<td> <input '.$total_score_vice_color.' type="text" onchange="vice_Total_Score_update1('.$desbord_vice_President_detail[0].')" id="vice_Total_Score'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_vice.'"/></td>
					
					<td> <input '.$Individual_Ranking_color_vice.'type="text" onchange="vice_Individual_Ranking_update('.$desbord_vice_President_detail[0].')" id="vice_Individual_Ranking'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[12].'"/></td>
				
				
                </tr> ';
				
				 } 
				
				 
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

//vice_Net_Memebrship_Addition_update_val

if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'vice_Net_Memebrship_Addition_update_val')
{
	$vice_President_id = $_POST['desbord_vice_President_id'];
	$vice_Net_Memebrship_Addition_val = $_POST['vice_Net_Memebrship_Addition_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_vice_president set Net_Memebrship_Addition='$vice_Net_Memebrship_Addition_val' where admin_id='$user_id' AND desbord_vice_President_id='$vice_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
               <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">Vice President</p></th>
                <th><p style="color:#d6d6d6;">Monthly VP Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Net Memebrship Addition</p></th>
                <th><p style="color:#d6d6d6;">Control Letters Sent</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking
</p></th>
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_vice_President_sql = "SELECT * FROM desbord_vice_president";
	//echo $sql;
	$desbord_vice_President_result = mysqli_query($conn, $desbord_vice_President_sql);
	$x=1;
	while ($desbord_vice_President_detail=mysqli_fetch_row($desbord_vice_President_result))
          
		  {
	 
	           if($desbord_vice_President_detail[4] == 15)
			  {
				  $vice_Monthly_VP_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[4] == 10)
			  {
				$vice_Monthly_VP_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_VP_color = 'style="background-color:red;"';  
			  }
			  
			  
			  
			    if($desbord_vice_President_detail[5] == 15)
			  {
				  $vice_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[5] == 10)
			  {
				$vice_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[6] == 15)
			  {
				  $vice_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[6] == 10)
			  {
				$vice_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
                 
				 
	           if($desbord_vice_President_detail[7] == 10)
			  {
				  $vice_Net_Memebrship_Addition_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[7] == 5)
			  {
				$vice_Net_Memebrship_Addition_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Net_Memebrship_Addition_color = 'style="background-color:red;"';  
			  }
	           
			   
			     if($desbord_vice_President_detail[8] == 15)
			  {
				  $vice_Control_Letters_Sent_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[8] == 10)
			  {
				$vice_Control_Letters_Sent_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Control_Letters_Sent_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_vice_President_detail[9] == 10)
			  {
				  $vice_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $vice_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[10] == 20)
			  {
				  $vice_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[10] == 15)
			  {
				$vice_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			   $total_score_vice = $desbord_vice_President_detail[4] + $desbord_vice_President_detail[5]+ $desbord_vice_President_detail[6]+ $desbord_vice_President_detail[7]+ $desbord_vice_President_detail[8]+ $desbord_vice_President_detail[9]+ $desbord_vice_President_detail[10];
					
			  if($total_score_vice >= 70)
			  {
				  $total_score_vice_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[12] >=70)
				  {
					 $Individual_Ranking_color_vice = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_vice_President_detail[12] >=50 && $desbord_vice_President_detail[12] <=70)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_vice_President_detail[12] >=30 && $desbord_vice_President_detail[12] <=50)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color_vice =  'style="background-color:black;"';
				  }
			  
			  
	 
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_vice_President_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="vice_President_update('.$desbord_vice_President_detail[0].')" id="vice_President'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[3].'"/></td>
                    
                    <td> <input '.$vice_Monthly_VP_color.' type="text" onchange="vice_Monthly_VP_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_VP'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[4].'"/></td>
					
                   <td> <input '.$vice_per_of_grey_color.' type="text" onchange="vice_per_of_grey_update('.$desbord_vice_President_detail[0].')" id="vice_per_of_grey'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[5].'"/></td>
				   
					<td> <input  '.$vice_Monthly_one_two_color.' type="text" onchange="vice_Monthly_one_two_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_one_two'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[6].'"/></td>
					
					<td> <input '.$vice_Net_Memebrship_Addition_color.' type="text" onchange="vice_Net_Memebrship_Addition_update('.$desbord_vice_President_detail[0].')" id="vice_Net_Memebrship_Addition'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[7].'"/></td>
					
					<td> <input '.$vice_Control_Letters_Sent_color.' type="text" onchange="vice_Control_Letters_Sent_update('.$desbord_vice_President_detail[0].')" id="vice_Control_Letters_Sent'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[8].'"/></td>
					
                    <td> <input '.$vice_LTRT_Attendance_color.' type="text" onchange="vice_LTRT_Attendance_update('.$desbord_vice_President_detail[0].')" id="vice_LTRT_Attendance'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[9].'"/></td>
					
					<td> <input  '.$vice_Chapter_Retention_color.' type="text" onchange="vice_Chapter_Retention_update('.$desbord_vice_President_detail[0].')" id="vice_Chapter_Retention'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[10].'"/></td>
					
					<td> <input '.$total_score_vice_color.' type="text" onchange="vice_Total_Score_update1('.$desbord_vice_President_detail[0].')" id="vice_Total_Score'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_vice.'"/></td>
					
					<td> <input '.$Individual_Ranking_color_vice.'type="text" onchange="vice_Individual_Ranking_update('.$desbord_vice_President_detail[0].')" id="vice_Individual_Ranking'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[12].'"/></td>
				
				
                </tr> ';
				
				 } 
				
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

//vice_Control_Letters_Sent_update_val
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'vice_Control_Letters_Sent_update_val')
{
	$vice_President_id = $_POST['desbord_vice_President_id'];
	$vice_Control_Letters_Sent_val = $_POST['vice_Control_Letters_Sent_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_vice_president set Control_Letters_Sent='$vice_Control_Letters_Sent_val' where admin_id='$user_id' AND desbord_vice_President_id='$vice_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">Vice President</p></th>
                <th><p style="color:#d6d6d6;">Monthly VP Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Net Memebrship Addition</p></th>
                <th><p style="color:#d6d6d6;">Control Letters Sent</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking
</p></th>
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_vice_President_sql = "SELECT * FROM desbord_vice_president";
	//echo $sql;
	$desbord_vice_President_result = mysqli_query($conn, $desbord_vice_President_sql);
	$x=1;
	while ($desbord_vice_President_detail=mysqli_fetch_row($desbord_vice_President_result))
          
		  {
	 
	           if($desbord_vice_President_detail[4] == 15)
			  {
				  $vice_Monthly_VP_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[4] == 10)
			  {
				$vice_Monthly_VP_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_VP_color = 'style="background-color:red;"';  
			  }
			  
			  
			  
			    if($desbord_vice_President_detail[5] == 15)
			  {
				  $vice_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[5] == 10)
			  {
				$vice_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[6] == 15)
			  {
				  $vice_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[6] == 10)
			  {
				$vice_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
                 
				 
	           if($desbord_vice_President_detail[7] == 10)
			  {
				  $vice_Net_Memebrship_Addition_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[7] == 5)
			  {
				$vice_Net_Memebrship_Addition_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Net_Memebrship_Addition_color = 'style="background-color:red;"';  
			  }
	           
			   
			     if($desbord_vice_President_detail[8] == 15)
			  {
				  $vice_Control_Letters_Sent_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[8] == 10)
			  {
				$vice_Control_Letters_Sent_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Control_Letters_Sent_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_vice_President_detail[9] == 10)
			  {
				  $vice_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $vice_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[10] == 20)
			  {
				  $vice_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[10] == 15)
			  {
				$vice_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			   $total_score_vice = $desbord_vice_President_detail[4] + $desbord_vice_President_detail[5]+ $desbord_vice_President_detail[6]+ $desbord_vice_President_detail[7]+ $desbord_vice_President_detail[8]+ $desbord_vice_President_detail[9]+ $desbord_vice_President_detail[10];
					
			  if($total_score_vice >= 70)
			  {
				  $total_score_vice_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[12] >=70)
				  {
					 $Individual_Ranking_color_vice = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_vice_President_detail[12] >=50 && $desbord_vice_President_detail[12] <=70)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_vice_President_detail[12] >=30 && $desbord_vice_President_detail[12] <=50)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color_vice =  'style="background-color:black;"';
				  }
			  
			  
			  
	 
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_vice_President_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="vice_President_update('.$desbord_vice_President_detail[0].')" id="vice_President'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[3].'"/></td>
                    
                    <td> <input '.$vice_Monthly_VP_color.' type="text" onchange="vice_Monthly_VP_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_VP'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[4].'"/></td>
					
                   <td> <input '.$vice_per_of_grey_color.' type="text" onchange="vice_per_of_grey_update('.$desbord_vice_President_detail[0].')" id="vice_per_of_grey'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[5].'"/></td>
				   
					<td> <input  '.$vice_Monthly_one_two_color.' type="text" onchange="vice_Monthly_one_two_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_one_two'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[6].'"/></td>
					
					<td> <input '.$vice_Net_Memebrship_Addition_color.' type="text" onchange="vice_Net_Memebrship_Addition_update('.$desbord_vice_President_detail[0].')" id="vice_Net_Memebrship_Addition'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[7].'"/></td>
					
					<td> <input '.$vice_Control_Letters_Sent_color.' type="text" onchange="vice_Control_Letters_Sent_update('.$desbord_vice_President_detail[0].')" id="vice_Control_Letters_Sent'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[8].'"/></td>
					
                    <td> <input '.$vice_LTRT_Attendance_color.' type="text" onchange="vice_LTRT_Attendance_update('.$desbord_vice_President_detail[0].')" id="vice_LTRT_Attendance'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[9].'"/></td>
					
					<td> <input  '.$vice_Chapter_Retention_color.' type="text" onchange="vice_Chapter_Retention_update('.$desbord_vice_President_detail[0].')" id="vice_Chapter_Retention'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[10].'"/></td>
					
					<td> <input '.$total_score_vice_color.' type="text" onchange="vice_Total_Score_update1('.$desbord_vice_President_detail[0].')" id="vice_Total_Score'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_vice.'"/></td>
					
					<td> <input '.$Individual_Ranking_color_vice.'type="text" onchange="vice_Individual_Ranking_update('.$desbord_vice_President_detail[0].')" id="vice_Individual_Ranking'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[12].'"/></td>
				
				
                </tr> ';
				
				 } 
				
				 
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}


//vice_LTRT_Attendance_update_val
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'vice_LTRT_Attendance_update_val')
{
	$vice_President_id = $_POST['desbord_vice_President_id'];
	$vice_LTRT_Attendance_val = $_POST['vice_LTRT_Attendance_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_vice_president set LTRT_Attendance='$vice_LTRT_Attendance_val' where admin_id='$user_id' AND desbord_vice_President_id='$vice_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">Vice President</p></th>
                <th><p style="color:#d6d6d6;">Monthly VP Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Net Memebrship Addition</p></th>
                <th><p style="color:#d6d6d6;">Control Letters Sent</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking
</p></th>
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_vice_President_sql = "SELECT * FROM desbord_vice_president";
	//echo $sql;
	$desbord_vice_President_result = mysqli_query($conn, $desbord_vice_President_sql);
	$x=1;
	while ($desbord_vice_President_detail=mysqli_fetch_row($desbord_vice_President_result))
          
		  {
	 
	           if($desbord_vice_President_detail[4] == 15)
			  {
				  $vice_Monthly_VP_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[4] == 10)
			  {
				$vice_Monthly_VP_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_VP_color = 'style="background-color:red;"';  
			  }
			  
			  
			  
			    if($desbord_vice_President_detail[5] == 15)
			  {
				  $vice_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[5] == 10)
			  {
				$vice_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[6] == 15)
			  {
				  $vice_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[6] == 10)
			  {
				$vice_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
                 
				 
	           if($desbord_vice_President_detail[7] == 10)
			  {
				  $vice_Net_Memebrship_Addition_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[7] == 5)
			  {
				$vice_Net_Memebrship_Addition_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Net_Memebrship_Addition_color = 'style="background-color:red;"';  
			  }
	           
			   
			     if($desbord_vice_President_detail[8] == 15)
			  {
				  $vice_Control_Letters_Sent_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[8] == 10)
			  {
				$vice_Control_Letters_Sent_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Control_Letters_Sent_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_vice_President_detail[9] == 10)
			  {
				  $vice_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $vice_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[10] == 20)
			  {
				  $vice_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[10] == 15)
			  {
				$vice_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			   $total_score_vice = $desbord_vice_President_detail[4] + $desbord_vice_President_detail[5]+ $desbord_vice_President_detail[6]+ $desbord_vice_President_detail[7]+ $desbord_vice_President_detail[8]+ $desbord_vice_President_detail[9]+ $desbord_vice_President_detail[10];
					
			  if($total_score_vice >= 70)
			  {
				  $total_score_vice_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[12] >=70)
				  {
					 $Individual_Ranking_color_vice = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_vice_President_detail[12] >=50 && $desbord_vice_President_detail[12] <=70)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_vice_President_detail[12] >=30 && $desbord_vice_President_detail[12] <=50)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color_vice =  'style="background-color:black;"';
				  }
			  
			  
			  
	 
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_vice_President_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="vice_President_update('.$desbord_vice_President_detail[0].')" id="vice_President'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[3].'"/></td>
                    
                    <td> <input '.$vice_Monthly_VP_color.' type="text" onchange="vice_Monthly_VP_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_VP'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[4].'"/></td>
					
                   <td> <input '.$vice_per_of_grey_color.' type="text" onchange="vice_per_of_grey_update('.$desbord_vice_President_detail[0].')" id="vice_per_of_grey'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[5].'"/></td>
				   
					<td> <input  '.$vice_Monthly_one_two_color.' type="text" onchange="vice_Monthly_one_two_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_one_two'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[6].'"/></td>
					
					<td> <input '.$vice_Net_Memebrship_Addition_color.' type="text" onchange="vice_Net_Memebrship_Addition_update('.$desbord_vice_President_detail[0].')" id="vice_Net_Memebrship_Addition'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[7].'"/></td>
					
					<td> <input '.$vice_Control_Letters_Sent_color.' type="text" onchange="vice_Control_Letters_Sent_update('.$desbord_vice_President_detail[0].')" id="vice_Control_Letters_Sent'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[8].'"/></td>
					
                    <td> <input '.$vice_LTRT_Attendance_color.' type="text" onchange="vice_LTRT_Attendance_update('.$desbord_vice_President_detail[0].')" id="vice_LTRT_Attendance'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[9].'"/></td>
					
					<td> <input  '.$vice_Chapter_Retention_color.' type="text" onchange="vice_Chapter_Retention_update('.$desbord_vice_President_detail[0].')" id="vice_Chapter_Retention'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[10].'"/></td>
					
					<td> <input '.$total_score_vice_color.' type="text" onchange="vice_Total_Score_update1('.$desbord_vice_President_detail[0].')" id="vice_Total_Score'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_vice.'"/></td>
					
					<td> <input '.$Individual_Ranking_color_vice.'type="text" onchange="vice_Individual_Ranking_update('.$desbord_vice_President_detail[0].')" id="vice_Individual_Ranking'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[12].'"/></td>
				
				
                </tr> ';
				
				 } 
				
				 
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

//vice_Chapter_Retention_update_val

if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'vice_Chapter_Retention_update_val')
{
	$vice_President_id = $_POST['desbord_vice_President_id'];
	$vice_Chapter_Retention_val = $_POST['vice_Chapter_Retention_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_vice_president set Chapter_Retention='$vice_Chapter_Retention_val' where admin_id='$user_id' AND desbord_vice_President_id='$vice_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">Vice President</p></th>
                <th><p style="color:#d6d6d6;">Monthly VP Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Net Memebrship Addition</p></th>
                <th><p style="color:#d6d6d6;">Control Letters Sent</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking
</p></th>
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_vice_President_sql = "SELECT * FROM desbord_vice_president";
	//echo $sql;
	$desbord_vice_President_result = mysqli_query($conn, $desbord_vice_President_sql);
	$x=1;
while ($desbord_vice_President_detail=mysqli_fetch_row($desbord_vice_President_result))
          
		  {
	 
	           if($desbord_vice_President_detail[4] == 15)
			  {
				  $vice_Monthly_VP_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[4] == 10)
			  {
				$vice_Monthly_VP_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_VP_color = 'style="background-color:red;"';  
			  }
			  
			  
			  
			    if($desbord_vice_President_detail[5] == 15)
			  {
				  $vice_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[5] == 10)
			  {
				$vice_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[6] == 15)
			  {
				  $vice_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[6] == 10)
			  {
				$vice_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
                 
				 
	           if($desbord_vice_President_detail[7] == 10)
			  {
				  $vice_Net_Memebrship_Addition_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[7] == 5)
			  {
				$vice_Net_Memebrship_Addition_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Net_Memebrship_Addition_color = 'style="background-color:red;"';  
			  }
	           
			   
			     if($desbord_vice_President_detail[8] == 15)
			  {
				  $vice_Control_Letters_Sent_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[8] == 10)
			  {
				$vice_Control_Letters_Sent_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Control_Letters_Sent_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_vice_President_detail[9] == 10)
			  {
				  $vice_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $vice_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[10] == 20)
			  {
				  $vice_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[10] == 15)
			  {
				$vice_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			   $total_score_vice = $desbord_vice_President_detail[4] + $desbord_vice_President_detail[5]+ $desbord_vice_President_detail[6]+ $desbord_vice_President_detail[7]+ $desbord_vice_President_detail[8]+ $desbord_vice_President_detail[9]+ $desbord_vice_President_detail[10];
					
			  if($total_score_vice >= 70)
			  {
				  $total_score_vice_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			    if($desbord_vice_President_detail[12] >=70)
				  {
					 $Individual_Ranking_color_vice = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_vice_President_detail[12] >=50 && $desbord_vice_President_detail[12] <=70)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_vice_President_detail[12] >=30 && $desbord_vice_President_detail[12] <=50)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color_vice =  'style="background-color:black;"';
				  }
			  
			  
			  
	 
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_vice_President_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="vice_President_update('.$desbord_vice_President_detail[0].')" id="vice_President'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[3].'"/></td>
                    
                    <td> <input '.$vice_Monthly_VP_color.' type="text" onchange="vice_Monthly_VP_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_VP'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[4].'"/></td>
					
                   <td> <input '.$vice_per_of_grey_color.' type="text" onchange="vice_per_of_grey_update('.$desbord_vice_President_detail[0].')" id="vice_per_of_grey'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[5].'"/></td>
				   
					<td> <input  '.$vice_Monthly_one_two_color.' type="text" onchange="vice_Monthly_one_two_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_one_two'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[6].'"/></td>
					
					<td> <input '.$vice_Net_Memebrship_Addition_color.' type="text" onchange="vice_Net_Memebrship_Addition_update('.$desbord_vice_President_detail[0].')" id="vice_Net_Memebrship_Addition'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[7].'"/></td>
					
					<td> <input '.$vice_Control_Letters_Sent_color.' type="text" onchange="vice_Control_Letters_Sent_update('.$desbord_vice_President_detail[0].')" id="vice_Control_Letters_Sent'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[8].'"/></td>
					
                    <td> <input '.$vice_LTRT_Attendance_color.' type="text" onchange="vice_LTRT_Attendance_update('.$desbord_vice_President_detail[0].')" id="vice_LTRT_Attendance'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[9].'"/></td>
					
					<td> <input  '.$vice_Chapter_Retention_color.' type="text" onchange="vice_Chapter_Retention_update('.$desbord_vice_President_detail[0].')" id="vice_Chapter_Retention'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[10].'"/></td>
					
					<td> <input '.$total_score_vice_color.' type="text" onchange="vice_Total_Score_update1('.$desbord_vice_President_detail[0].')" id="vice_Total_Score'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_vice.'"/></td>
					
					<td> <input '.$Individual_Ranking_color_vice.'type="text" onchange="vice_Individual_Ranking_update('.$desbord_vice_President_detail[0].')" id="vice_Individual_Ranking'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[12].'"/></td>
				
				
                </tr> ';
				
				 } 
				
				 
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

//vice_Total_Score_update_val


if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'vice_Total_Score_update_val')
{
	$vice_President_id = $_POST['desbord_vice_President_id'];
	$vice_Total_Score_val = $_POST['vice_Total_Score_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_vice_president set Total_Score ='$vice_Total_Score_val' where admin_id='$user_id' AND desbord_vice_President_id='$vice_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">Vice President</p></th>
                <th><p style="color:#d6d6d6;">Monthly VP Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Net Memebrship Addition</p></th>
                <th><p style="color:#d6d6d6;">Control Letters Sent</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking
</p></th>
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_vice_President_sql = "SELECT * FROM desbord_vice_president";
	//echo $sql;
	$desbord_vice_President_result = mysqli_query($conn, $desbord_vice_President_sql);
	$x=1;
	while ($desbord_vice_President_detail=mysqli_fetch_row($desbord_vice_President_result))
          
		  {
	 
	           if($desbord_vice_President_detail[4] == 15)
			  {
				  $vice_Monthly_VP_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[4] == 10)
			  {
				$vice_Monthly_VP_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_VP_color = 'style="background-color:red;"';  
			  }
			  
			  
			  
			    if($desbord_vice_President_detail[5] == 15)
			  {
				  $vice_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[5] == 10)
			  {
				$vice_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[6] == 15)
			  {
				  $vice_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[6] == 10)
			  {
				$vice_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
                 
				 
	           if($desbord_vice_President_detail[7] == 10)
			  {
				  $vice_Net_Memebrship_Addition_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[7] == 5)
			  {
				$vice_Net_Memebrship_Addition_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Net_Memebrship_Addition_color = 'style="background-color:red;"';  
			  }
	           
			   
			     if($desbord_vice_President_detail[8] == 15)
			  {
				  $vice_Control_Letters_Sent_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[8] == 10)
			  {
				$vice_Control_Letters_Sent_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Control_Letters_Sent_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_vice_President_detail[9] == 10)
			  {
				  $vice_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $vice_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[10] == 20)
			  {
				  $vice_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[10] == 15)
			  {
				$vice_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			   $total_score_vice = $desbord_vice_President_detail[4] + $desbord_vice_President_detail[5]+ $desbord_vice_President_detail[6]+ $desbord_vice_President_detail[7]+ $desbord_vice_President_detail[8]+ $desbord_vice_President_detail[9]+ $desbord_vice_President_detail[10];
					
			  if($total_score_vice >= 70)
			  {
				  $total_score_vice_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[12] >=70)
				  {
					 $Individual_Ranking_color_vice = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_vice_President_detail[12] >=50 && $desbord_vice_President_detail[12] <=70)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_vice_President_detail[12] >=30 && $desbord_vice_President_detail[12] <=50)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color_vice =  'style="background-color:black;"';
				  }
			  
			  
			  
	 
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_vice_President_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="vice_President_update('.$desbord_vice_President_detail[0].')" id="vice_President'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[3].'"/></td>
                    
                    <td> <input '.$vice_Monthly_VP_color.' type="text" onchange="vice_Monthly_VP_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_VP'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[4].'"/></td>
					
                   <td> <input '.$vice_per_of_grey_color.' type="text" onchange="vice_per_of_grey_update('.$desbord_vice_President_detail[0].')" id="vice_per_of_grey'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[5].'"/></td>
				   
					<td> <input  '.$vice_Monthly_one_two_color.' type="text" onchange="vice_Monthly_one_two_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_one_two'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[6].'"/></td>
					
					<td> <input '.$vice_Net_Memebrship_Addition_color.' type="text" onchange="vice_Net_Memebrship_Addition_update('.$desbord_vice_President_detail[0].')" id="vice_Net_Memebrship_Addition'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[7].'"/></td>
					
					<td> <input '.$vice_Control_Letters_Sent_color.' type="text" onchange="vice_Control_Letters_Sent_update('.$desbord_vice_President_detail[0].')" id="vice_Control_Letters_Sent'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[8].'"/></td>
					
                    <td> <input '.$vice_LTRT_Attendance_color.' type="text" onchange="vice_LTRT_Attendance_update('.$desbord_vice_President_detail[0].')" id="vice_LTRT_Attendance'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[9].'"/></td>
					
					<td> <input  '.$vice_Chapter_Retention_color.' type="text" onchange="vice_Chapter_Retention_update('.$desbord_vice_President_detail[0].')" id="vice_Chapter_Retention'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[10].'"/></td>
					
					<td> <input '.$total_score_vice_color.' type="text" onchange="vice_Total_Score_update1('.$desbord_vice_President_detail[0].')" id="vice_Total_Score'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_vice.'"/></td>
					
					<td> <input '.$Individual_Ranking_color_vice.'type="text" onchange="vice_Individual_Ranking_update('.$desbord_vice_President_detail[0].')" id="vice_Individual_Ranking'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[12].'"/></td>
				
				
                </tr> ';
				
				 } 
				
				 
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

//vice_Individual_Ranking_update_val

     
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'vice_Individual_Ranking_update_val')
{
	$vice_President_id = $_POST['desbord_vice_President_id'];
	$vice_Individual_Ranking_val = $_POST['vice_Individual_Ranking_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_vice_president set Individual_Ranking ='$vice_Individual_Ranking_val' where admin_id='$user_id' AND desbord_vice_President_id='$vice_President_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
               <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">Vice President</p></th>
                <th><p style="color:#d6d6d6;">Monthly VP Report Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Net Memebrship Addition</p></th>
                <th><p style="color:#d6d6d6;">Control Letters Sent</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking
</p></th>
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_vice_President_sql = "SELECT * FROM desbord_vice_president";
	//echo $sql;
	$desbord_vice_President_result = mysqli_query($conn, $desbord_vice_President_sql);
	$x=1;
while ($desbord_vice_President_detail=mysqli_fetch_row($desbord_vice_President_result))
          
		  {
	 
	           if($desbord_vice_President_detail[4] == 15)
			  {
				  $vice_Monthly_VP_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[4] == 10)
			  {
				$vice_Monthly_VP_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_VP_color = 'style="background-color:red;"';  
			  }
			  
			  
			  
			    if($desbord_vice_President_detail[5] == 15)
			  {
				  $vice_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[5] == 10)
			  {
				$vice_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[6] == 15)
			  {
				  $vice_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[6] == 10)
			  {
				$vice_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
                 
				 
	           if($desbord_vice_President_detail[7] == 10)
			  {
				  $vice_Net_Memebrship_Addition_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[7] == 5)
			  {
				$vice_Net_Memebrship_Addition_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Net_Memebrship_Addition_color = 'style="background-color:red;"';  
			  }
	           
			   
			     if($desbord_vice_President_detail[8] == 15)
			  {
				  $vice_Control_Letters_Sent_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[8] == 10)
			  {
				$vice_Control_Letters_Sent_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Control_Letters_Sent_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_vice_President_detail[9] == 10)
			  {
				  $vice_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $vice_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[10] == 20)
			  {
				  $vice_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_vice_President_detail[10] == 15)
			  {
				$vice_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $vice_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			   $total_score_vice = $desbord_vice_President_detail[4] + $desbord_vice_President_detail[5]+ $desbord_vice_President_detail[6]+ $desbord_vice_President_detail[7]+ $desbord_vice_President_detail[8]+ $desbord_vice_President_detail[9]+ $desbord_vice_President_detail[10];
					
			  if($total_score_vice >= 70)
			  {
				  $total_score_vice_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_color = 'style="background-color:red;"';  
			  }
			  
			   if($desbord_vice_President_detail[12] >=70)
				  {
					 $Individual_Ranking_color_vice = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_vice_President_detail[12] >=50 && $desbord_vice_President_detail[12] <=70)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_vice_President_detail[12] >=30 && $desbord_vice_President_detail[12] <=50)
				   {
               $Individual_Ranking_color_vice = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $Individual_Ranking_color_vice =  'style="background-color:black;"';
				  }
			  
			  
	 
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_vice_President_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="vice_President_update('.$desbord_vice_President_detail[0].')" id="vice_President'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[3].'"/></td>
                    
                    <td> <input '.$vice_Monthly_VP_color.' type="text" onchange="vice_Monthly_VP_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_VP'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[4].'"/></td>
					
                   <td> <input '.$vice_per_of_grey_color.' type="text" onchange="vice_per_of_grey_update('.$desbord_vice_President_detail[0].')" id="vice_per_of_grey'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[5].'"/></td>
				   
					<td> <input  '.$vice_Monthly_one_two_color.' type="text" onchange="vice_Monthly_one_two_update('.$desbord_vice_President_detail[0].')" id="vice_Monthly_one_two'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[6].'"/></td>
					
					<td> <input '.$vice_Net_Memebrship_Addition_color.' type="text" onchange="vice_Net_Memebrship_Addition_update('.$desbord_vice_President_detail[0].')" id="vice_Net_Memebrship_Addition'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[7].'"/></td>
					
					<td> <input '.$vice_Control_Letters_Sent_color.' type="text" onchange="vice_Control_Letters_Sent_update('.$desbord_vice_President_detail[0].')" id="vice_Control_Letters_Sent'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[8].'"/></td>
					
                    <td> <input '.$vice_LTRT_Attendance_color.' type="text" onchange="vice_LTRT_Attendance_update('.$desbord_vice_President_detail[0].')" id="vice_LTRT_Attendance'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[9].'"/></td>
					
					<td> <input  '.$vice_Chapter_Retention_color.' type="text" onchange="vice_Chapter_Retention_update('.$desbord_vice_President_detail[0].')" id="vice_Chapter_Retention'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[10].'"/></td>
					
					<td> <input '.$total_score_vice_color.' type="text" onchange="vice_Total_Score_update1('.$desbord_vice_President_detail[0].')" id="vice_Total_Score'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_vice.'"/></td>
					
					<td> <input '.$Individual_Ranking_color_vice.'type="text" onchange="vice_Individual_Ranking_update('.$desbord_vice_President_detail[0].')" id="vice_Individual_Ranking'.$desbord_vice_President_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_vice_President_detail[12].'"/></td>
				
				
                </tr> ';
				
				 } 
				
				 
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

// st_update_val  all
//st_update_val name

if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'st_update_val')
{
	$desbord_st_id = $_POST['desbord_st_id'];
	$st_name = $_POST['st_name'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_st set st_name ='$st_name' where admin_id='$user_id' AND desbord_st_id='$desbord_st_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">ST</p></th>
                <th><p style="color:#d6d6d6;">Weekly Fundsheet Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Visitors entry done within a week</p></th>
                <th><p style="color:#d6d6d6;">Renewal Cheques to be collected 3 months in advance</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_st_sql = "SELECT * FROM desbord_st";
	//echo $sql;
	$desbord_st_result = mysqli_query($conn, $desbord_st_sql);
	$x=1;
	while ($desbord_st_detail=mysqli_fetch_row($desbord_st_result))
          
		  {
			  
			  if($desbord_st_detail[4] == 15)
			  {
				  $st_Weekly_Fundsheet_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[4] == 10)
			  {
				$st_Weekly_Fundsheet_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Weekly_Fundsheet_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[5] == 15)
			  {
				  $st_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[5] == 10)
			  {
				$st_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[6] == 15)
			  {
				  $st_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[6] == 10)
			  {
				$st_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_st_detail[7] == 5)
			  {
				  $st_Visitors_entry_done_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_Visitors_entry_done_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[8] == 20)
			  {
				  $st_Renewal_Cheques_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[8] == 15)
			  {
				$st_Renewal_Cheques_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Renewal_Cheques_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[9] == 10)
			  {
				  $st_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[10] == 20)
			  {
				  $st_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[10] == 15)
			  {
				$st_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  			  
 $total_score_st = $desbord_st_detail[4] + $desbord_st_detail[5]+ $desbord_st_detail[6]+ $desbord_st_detail[7]+ $desbord_st_detail[8]+ $desbord_st_detail[9]+ $desbord_st_detail[10];
					
			  if($total_score_st >= 70)
			  {
				  $total_score_st_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_st_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[12] >=70)
				  {
					 $st_Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_st_detail[12] >=50 && $desbord_st_detail[12] <=70)
				   {
               $st_Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_st_detail[12] >=30 && $desbord_st_detail[12] <=50)
				   {
               $st_Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $st_Individual_Ranking_color =  'style="background-color:black;"';
				  }
			    
			    
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_st_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="st_update('.$desbord_st_detail[0].')" id="st'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[3].'"/></td>
                    
                    <td> <input '.$st_Weekly_Fundsheet_color.' type="text" onchange="st_Weekly_Fundsheet_update('.$desbord_st_detail[0].')" id="st_Weekly_Fundsheet'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[4].'"/></td>
					
                   <td> <input '.$st_per_of_grey_color.' type="text" onchange="st_per_of_grey_update('.$desbord_st_detail[0].')" id="st_per_of_grey'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[5].'"/></td>
				   
					<td> <input '.$st_Monthly_one_two_color.' type="text" onchange="st_Monthly_one_two_update('.$desbord_st_detail[0].')" id="st_Monthly_one_two'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[6].'"/></td>
					
					<td> <input '.$st_Visitors_entry_done_color.' type="text" onchange="st_Visitors_entry_done_update('.$desbord_st_detail[0].')" id="st_Visitors_entry_done'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[7].'"/></td>
					
					<td> <input '.$st_Renewal_Cheques_color.'type="text" onchange="st_Renewal_Cheques_update('.$desbord_st_detail[0].')" id="st_Renewal_Cheques'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[8].'"/></td>
					
                    <td> <input '.$st_LTRT_Attendance_color.'type="text" onchange="st_LTRT_Attendance_update('.$desbord_st_detail[0].')" id="st_LTRT_Attendance'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[9].'"/></td>
					
					<td> <input '.$st_Chapter_Retention_color.' type="text" onchange="st_Chapter_Retention_update('.$desbord_st_detail[0].')" id="st_Chapter_Retention'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[10].'"/></td>
					
					<td> <input '.$total_score_st_color.' type="text" onchange="st_Total_Score_update1('.$desbord_st_detail[0].')" id="st_Total_Score'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_st.'"/></td>
					
					<td> <input '.$st_Individual_Ranking_color.'type="text" onchange="st_Individual_Ranking_update('.$desbord_st_detail[0].')" id="st_Individual_Ranking'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[12].'"/></td>
					
				

				
				
                </tr> ';
				
				 } 
				
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

//st_Weekly_Fundsheet_update_val

if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'st_Weekly_Fundsheet_update_val')
{
	$desbord_st_id = $_POST['desbord_st_id'];
	$st_Weekly_Fundsheet_val = $_POST['st_Weekly_Fundsheet_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_st set Weekly_Fundsheet ='$st_Weekly_Fundsheet_val' where admin_id='$user_id' AND desbord_st_id='$desbord_st_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">ST</p></th>
                <th><p style="color:#d6d6d6;">Weekly Fundsheet Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Visitors entry done within a week</p></th>
                <th><p style="color:#d6d6d6;">Renewal Cheques to be collected 3 months in advance</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_st_sql = "SELECT * FROM desbord_st";
	//echo $sql;
	$desbord_st_result = mysqli_query($conn, $desbord_st_sql);
	$x=1;
	while ($desbord_st_detail=mysqli_fetch_row($desbord_st_result))
          
		  {
			  
			  if($desbord_st_detail[4] == 15)
			  {
				  $st_Weekly_Fundsheet_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[4] == 10)
			  {
				$st_Weekly_Fundsheet_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Weekly_Fundsheet_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[5] == 15)
			  {
				  $st_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[5] == 10)
			  {
				$st_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[6] == 15)
			  {
				  $st_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[6] == 10)
			  {
				$st_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_st_detail[7] == 5)
			  {
				  $st_Visitors_entry_done_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_Visitors_entry_done_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[8] == 20)
			  {
				  $st_Renewal_Cheques_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[8] == 15)
			  {
				$st_Renewal_Cheques_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Renewal_Cheques_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[9] == 10)
			  {
				  $st_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[10] == 20)
			  {
				  $st_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[10] == 15)
			  {
				$st_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  			  
 $total_score_st = $desbord_st_detail[4] + $desbord_st_detail[5]+ $desbord_st_detail[6]+ $desbord_st_detail[7]+ $desbord_st_detail[8]+ $desbord_st_detail[9]+ $desbord_st_detail[10];
					
			  if($total_score_st >= 70)
			  {
				  $total_score_st_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_st_color = 'style="background-color:red;"';  
			  }
			  
			  
			 if($desbord_st_detail[12] >=70)
				  {
					 $st_Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_st_detail[12] >=50 && $desbord_st_detail[12] <=70)
				   {
               $st_Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_st_detail[12] >=30 && $desbord_st_detail[12] <=50)
				   {
               $st_Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $st_Individual_Ranking_color =  'style="background-color:black;"';
				  }
			    
			    
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_st_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="st_update('.$desbord_st_detail[0].')" id="st'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[3].'"/></td>
                    
                    <td> <input '.$st_Weekly_Fundsheet_color.' type="text" onchange="st_Weekly_Fundsheet_update('.$desbord_st_detail[0].')" id="st_Weekly_Fundsheet'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[4].'"/></td>
					
                   <td> <input '.$st_per_of_grey_color.' type="text" onchange="st_per_of_grey_update('.$desbord_st_detail[0].')" id="st_per_of_grey'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[5].'"/></td>
				   
					<td> <input '.$st_Monthly_one_two_color.' type="text" onchange="st_Monthly_one_two_update('.$desbord_st_detail[0].')" id="st_Monthly_one_two'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[6].'"/></td>
					
					<td> <input '.$st_Visitors_entry_done_color.' type="text" onchange="st_Visitors_entry_done_update('.$desbord_st_detail[0].')" id="st_Visitors_entry_done'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[7].'"/></td>
					
					<td> <input '.$st_Renewal_Cheques_color.'type="text" onchange="st_Renewal_Cheques_update('.$desbord_st_detail[0].')" id="st_Renewal_Cheques'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[8].'"/></td>
					
                    <td> <input '.$st_LTRT_Attendance_color.'type="text" onchange="st_LTRT_Attendance_update('.$desbord_st_detail[0].')" id="st_LTRT_Attendance'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[9].'"/></td>
					
					<td> <input '.$st_Chapter_Retention_color.' type="text" onchange="st_Chapter_Retention_update('.$desbord_st_detail[0].')" id="st_Chapter_Retention'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[10].'"/></td>
					
					<td> <input '.$total_score_st_color.' type="text" onchange="st_Total_Score_update1('.$desbord_st_detail[0].')" id="st_Total_Score'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_st.'"/></td>
					
					<td> <input '.$st_Individual_Ranking_color.'type="text" onchange="st_Individual_Ranking_update('.$desbord_st_detail[0].')" id="st_Individual_Ranking'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[12].'"/></td>
					
				

				
				
                </tr> ';
				
				 } 
				
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	         

}
}

//st_per_of_grey_update_val

if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'st_per_of_grey_update_val')
{
	$desbord_st_id = $_POST['desbord_st_id'];
	$st_per_of_grey_val = $_POST['st_per_of_grey_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_st set per_of_grey ='$st_per_of_grey_val' where admin_id='$user_id' AND desbord_st_id='$desbord_st_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">ST</p></th>
                <th><p style="color:#d6d6d6;">Weekly Fundsheet Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Visitors entry done within a week</p></th>
                <th><p style="color:#d6d6d6;">Renewal Cheques to be collected 3 months in advance</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_st_sql = "SELECT * FROM desbord_st";
	//echo $sql;
	$desbord_st_result = mysqli_query($conn, $desbord_st_sql);
	$x=1;
while ($desbord_st_detail=mysqli_fetch_row($desbord_st_result))
          
		  {
			  
			  if($desbord_st_detail[4] == 15)
			  {
				  $st_Weekly_Fundsheet_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[4] == 10)
			  {
				$st_Weekly_Fundsheet_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Weekly_Fundsheet_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[5] == 15)
			  {
				  $st_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[5] == 10)
			  {
				$st_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[6] == 15)
			  {
				  $st_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[6] == 10)
			  {
				$st_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_st_detail[7] == 5)
			  {
				  $st_Visitors_entry_done_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_Visitors_entry_done_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[8] == 20)
			  {
				  $st_Renewal_Cheques_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[8] == 15)
			  {
				$st_Renewal_Cheques_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Renewal_Cheques_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[9] == 10)
			  {
				  $st_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[10] == 20)
			  {
				  $st_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[10] == 15)
			  {
				$st_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  			  
 $total_score_st = $desbord_st_detail[4] + $desbord_st_detail[5]+ $desbord_st_detail[6]+ $desbord_st_detail[7]+ $desbord_st_detail[8]+ $desbord_st_detail[9]+ $desbord_st_detail[10];
					
			  if($total_score_st >= 70)
			  {
				  $total_score_st_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_st_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[12] >=70)
				  {
					 $st_Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_st_detail[12] >=50 && $desbord_st_detail[12] <=70)
				   {
               $st_Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_st_detail[12] >=30 && $desbord_st_detail[12] <=50)
				   {
               $st_Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $st_Individual_Ranking_color =  'style="background-color:black;"';
				  }
			    
			    
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_st_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="st_update('.$desbord_st_detail[0].')" id="st'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[3].'"/></td>
                    
                    <td> <input '.$st_Weekly_Fundsheet_color.' type="text" onchange="st_Weekly_Fundsheet_update('.$desbord_st_detail[0].')" id="st_Weekly_Fundsheet'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[4].'"/></td>
					
                   <td> <input '.$st_per_of_grey_color.' type="text" onchange="st_per_of_grey_update('.$desbord_st_detail[0].')" id="st_per_of_grey'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[5].'"/></td>
				   
					<td> <input '.$st_Monthly_one_two_color.' type="text" onchange="st_Monthly_one_two_update('.$desbord_st_detail[0].')" id="st_Monthly_one_two'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[6].'"/></td>
					
					<td> <input '.$st_Visitors_entry_done_color.' type="text" onchange="st_Visitors_entry_done_update('.$desbord_st_detail[0].')" id="st_Visitors_entry_done'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[7].'"/></td>
					
					<td> <input '.$st_Renewal_Cheques_color.'type="text" onchange="st_Renewal_Cheques_update('.$desbord_st_detail[0].')" id="st_Renewal_Cheques'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[8].'"/></td>
					
                    <td> <input '.$st_LTRT_Attendance_color.'type="text" onchange="st_LTRT_Attendance_update('.$desbord_st_detail[0].')" id="st_LTRT_Attendance'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[9].'"/></td>
					
					<td> <input '.$st_Chapter_Retention_color.' type="text" onchange="st_Chapter_Retention_update('.$desbord_st_detail[0].')" id="st_Chapter_Retention'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[10].'"/></td>
					
					<td> <input '.$total_score_st_color.' type="text" onchange="st_Total_Score_update1('.$desbord_st_detail[0].')" id="st_Total_Score'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_st.'"/></td>
					
					<td> <input '.$st_Individual_Ranking_color.'type="text" onchange="st_Individual_Ranking_update('.$desbord_st_detail[0].')" id="st_Individual_Ranking'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[12].'"/></td>
					
				

				
				
                </tr> ';
				
				 } 
				
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}
}

    //st_Monthly_one_two_update_val

   
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'st_Monthly_one_two_update_val')
{
	$desbord_st_id = $_POST['desbord_st_id'];
	$st_Monthly_one_two_val = $_POST['st_Monthly_one_two_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_st set Monthly_one_two ='$st_Monthly_one_two_val' where admin_id='$user_id' AND desbord_st_id='$desbord_st_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">ST</p></th>
                <th><p style="color:#d6d6d6;">Weekly Fundsheet Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Visitors entry done within a week</p></th>
                <th><p style="color:#d6d6d6;">Renewal Cheques to be collected 3 months in advance</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_st_sql = "SELECT * FROM desbord_st";
	//echo $sql;
	$desbord_st_result = mysqli_query($conn, $desbord_st_sql);
	$x=1;
while ($desbord_st_detail=mysqli_fetch_row($desbord_st_result))
          
		  {
			  
			  if($desbord_st_detail[4] == 15)
			  {
				  $st_Weekly_Fundsheet_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[4] == 10)
			  {
				$st_Weekly_Fundsheet_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Weekly_Fundsheet_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[5] == 15)
			  {
				  $st_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[5] == 10)
			  {
				$st_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[6] == 15)
			  {
				  $st_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[6] == 10)
			  {
				$st_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_st_detail[7] == 5)
			  {
				  $st_Visitors_entry_done_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_Visitors_entry_done_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[8] == 20)
			  {
				  $st_Renewal_Cheques_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[8] == 15)
			  {
				$st_Renewal_Cheques_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Renewal_Cheques_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[9] == 10)
			  {
				  $st_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[10] == 20)
			  {
				  $st_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[10] == 15)
			  {
				$st_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  			  
 $total_score_st = $desbord_st_detail[4] + $desbord_st_detail[5]+ $desbord_st_detail[6]+ $desbord_st_detail[7]+ $desbord_st_detail[8]+ $desbord_st_detail[9]+ $desbord_st_detail[10];
					
			  if($total_score_st >= 70)
			  {
				  $total_score_st_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_st_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[12] >=70)
				  {
					 $st_Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_st_detail[12] >=50 && $desbord_st_detail[12] <=70)
				   {
               $st_Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_st_detail[12] >=30 && $desbord_st_detail[12] <=50)
				   {
               $st_Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $st_Individual_Ranking_color =  'style="background-color:black;"';
				  }
			    
			    
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_st_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="st_update('.$desbord_st_detail[0].')" id="st'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[3].'"/></td>
                    
                    <td> <input '.$st_Weekly_Fundsheet_color.' type="text" onchange="st_Weekly_Fundsheet_update('.$desbord_st_detail[0].')" id="st_Weekly_Fundsheet'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[4].'"/></td>
					
                   <td> <input '.$st_per_of_grey_color.' type="text" onchange="st_per_of_grey_update('.$desbord_st_detail[0].')" id="st_per_of_grey'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[5].'"/></td>
				   
					<td> <input '.$st_Monthly_one_two_color.' type="text" onchange="st_Monthly_one_two_update('.$desbord_st_detail[0].')" id="st_Monthly_one_two'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[6].'"/></td>
					
					<td> <input '.$st_Visitors_entry_done_color.' type="text" onchange="st_Visitors_entry_done_update('.$desbord_st_detail[0].')" id="st_Visitors_entry_done'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[7].'"/></td>
					
					<td> <input '.$st_Renewal_Cheques_color.'type="text" onchange="st_Renewal_Cheques_update('.$desbord_st_detail[0].')" id="st_Renewal_Cheques'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[8].'"/></td>
					
                    <td> <input '.$st_LTRT_Attendance_color.'type="text" onchange="st_LTRT_Attendance_update('.$desbord_st_detail[0].')" id="st_LTRT_Attendance'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[9].'"/></td>
					
					<td> <input '.$st_Chapter_Retention_color.' type="text" onchange="st_Chapter_Retention_update('.$desbord_st_detail[0].')" id="st_Chapter_Retention'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[10].'"/></td>
					
					<td> <input '.$total_score_st_color.' type="text" onchange="st_Total_Score_update1('.$desbord_st_detail[0].')" id="st_Total_Score'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_st.'"/></td>
					
					<td> <input '.$st_Individual_Ranking_color.'type="text" onchange="st_Individual_Ranking_update('.$desbord_st_detail[0].')" id="st_Individual_Ranking'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[12].'"/></td>
					
				

				
				
                </tr> ';
				
				 } 
				
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}
}

//st_Visitors_entry_done_update_val

   
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'st_Visitors_entry_done_update_val')
{
	$desbord_st_id = $_POST['desbord_st_id'];
	$st_Visitors_entry_done_val = $_POST['st_Visitors_entry_done_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_st set Visitors_entry_done ='$st_Visitors_entry_done_val' where admin_id='$user_id' AND desbord_st_id='$desbord_st_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">ST</p></th>
                <th><p style="color:#d6d6d6;">Weekly Fundsheet Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Visitors entry done within a week</p></th>
                <th><p style="color:#d6d6d6;">Renewal Cheques to be collected 3 months in advance</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_st_sql = "SELECT * FROM desbord_st";
	//echo $sql;
	$desbord_st_result = mysqli_query($conn, $desbord_st_sql);
	$x=1;
while ($desbord_st_detail=mysqli_fetch_row($desbord_st_result))
          
		  {
			  
			  if($desbord_st_detail[4] == 15)
			  {
				  $st_Weekly_Fundsheet_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[4] == 10)
			  {
				$st_Weekly_Fundsheet_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Weekly_Fundsheet_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[5] == 15)
			  {
				  $st_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[5] == 10)
			  {
				$st_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[6] == 15)
			  {
				  $st_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[6] == 10)
			  {
				$st_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_st_detail[7] == 5)
			  {
				  $st_Visitors_entry_done_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_Visitors_entry_done_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[8] == 20)
			  {
				  $st_Renewal_Cheques_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[8] == 15)
			  {
				$st_Renewal_Cheques_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Renewal_Cheques_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[9] == 10)
			  {
				  $st_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[10] == 20)
			  {
				  $st_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[10] == 15)
			  {
				$st_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  			  
 $total_score_st = $desbord_st_detail[4] + $desbord_st_detail[5]+ $desbord_st_detail[6]+ $desbord_st_detail[7]+ $desbord_st_detail[8]+ $desbord_st_detail[9]+ $desbord_st_detail[10];
					
			  if($total_score_st >= 70)
			  {
				  $total_score_st_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_st_color = 'style="background-color:red;"';  
			  }
			  
			  
			 if($desbord_st_detail[12] >=70)
				  {
					 $st_Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_st_detail[12] >=50 && $desbord_st_detail[12] <=70)
				   {
               $st_Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_st_detail[12] >=30 && $desbord_st_detail[12] <=50)
				   {
               $st_Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $st_Individual_Ranking_color =  'style="background-color:black;"';
				  }
			    
			    
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_st_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="st_update('.$desbord_st_detail[0].')" id="st'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[3].'"/></td>
                    
                    <td> <input '.$st_Weekly_Fundsheet_color.' type="text" onchange="st_Weekly_Fundsheet_update('.$desbord_st_detail[0].')" id="st_Weekly_Fundsheet'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[4].'"/></td>
					
                   <td> <input '.$st_per_of_grey_color.' type="text" onchange="st_per_of_grey_update('.$desbord_st_detail[0].')" id="st_per_of_grey'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[5].'"/></td>
				   
					<td> <input '.$st_Monthly_one_two_color.' type="text" onchange="st_Monthly_one_two_update('.$desbord_st_detail[0].')" id="st_Monthly_one_two'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[6].'"/></td>
					
					<td> <input '.$st_Visitors_entry_done_color.' type="text" onchange="st_Visitors_entry_done_update('.$desbord_st_detail[0].')" id="st_Visitors_entry_done'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[7].'"/></td>
					
					<td> <input '.$st_Renewal_Cheques_color.'type="text" onchange="st_Renewal_Cheques_update('.$desbord_st_detail[0].')" id="st_Renewal_Cheques'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[8].'"/></td>
					
                    <td> <input '.$st_LTRT_Attendance_color.'type="text" onchange="st_LTRT_Attendance_update('.$desbord_st_detail[0].')" id="st_LTRT_Attendance'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[9].'"/></td>
					
					<td> <input '.$st_Chapter_Retention_color.' type="text" onchange="st_Chapter_Retention_update('.$desbord_st_detail[0].')" id="st_Chapter_Retention'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[10].'"/></td>
					
					<td> <input '.$total_score_st_color.' type="text" onchange="st_Total_Score_update1('.$desbord_st_detail[0].')" id="st_Total_Score'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_st.'"/></td>
					
					<td> <input '.$st_Individual_Ranking_color.'type="text" onchange="st_Individual_Ranking_update('.$desbord_st_detail[0].')" id="st_Individual_Ranking'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[12].'"/></td>
					
				

				
				
                </tr> ';
				
				 } 
				
				 
				
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}
}

//st_Renewal_Cheques_update_val

   
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'st_Renewal_Cheques_update_val')
{
	$desbord_st_id = $_POST['desbord_st_id'];
	$st_Renewal_Cheques_val = $_POST['st_Renewal_Cheques_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_st set Renewal_Cheques ='$st_Renewal_Cheques_val' where admin_id='$user_id' AND desbord_st_id='$desbord_st_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">ST</p></th>
                <th><p style="color:#d6d6d6;">Weekly Fundsheet Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Visitors entry done within a week</p></th>
                <th><p style="color:#d6d6d6;">Renewal Cheques to be collected 3 months in advance</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
				
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_st_sql = "SELECT * FROM desbord_st";
	//echo $sql;
	$desbord_st_result = mysqli_query($conn, $desbord_st_sql);
	$x=1;
while ($desbord_st_detail=mysqli_fetch_row($desbord_st_result))
          
		  {
			  
			  if($desbord_st_detail[4] == 15)
			  {
				  $st_Weekly_Fundsheet_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[4] == 10)
			  {
				$st_Weekly_Fundsheet_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Weekly_Fundsheet_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[5] == 15)
			  {
				  $st_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[5] == 10)
			  {
				$st_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[6] == 15)
			  {
				  $st_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[6] == 10)
			  {
				$st_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_st_detail[7] == 5)
			  {
				  $st_Visitors_entry_done_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_Visitors_entry_done_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[8] == 20)
			  {
				  $st_Renewal_Cheques_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[8] == 15)
			  {
				$st_Renewal_Cheques_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Renewal_Cheques_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[9] == 10)
			  {
				  $st_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[10] == 20)
			  {
				  $st_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[10] == 15)
			  {
				$st_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  			  
 $total_score_st = $desbord_st_detail[4] + $desbord_st_detail[5]+ $desbord_st_detail[6]+ $desbord_st_detail[7]+ $desbord_st_detail[8]+ $desbord_st_detail[9]+ $desbord_st_detail[10];
					
			  if($total_score_st >= 70)
			  {
				  $total_score_st_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_st_color = 'style="background-color:red;"';  
			  }
			  
			  
			 if($desbord_st_detail[12] >=70)
				  {
					 $st_Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_st_detail[12] >=50 && $desbord_st_detail[12] <=70)
				   {
               $st_Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_st_detail[12] >=30 && $desbord_st_detail[12] <=50)
				   {
               $st_Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $st_Individual_Ranking_color =  'style="background-color:black;"';
				  }
			    
			    
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_st_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="st_update('.$desbord_st_detail[0].')" id="st'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[3].'"/></td>
                    
                    <td> <input '.$st_Weekly_Fundsheet_color.' type="text" onchange="st_Weekly_Fundsheet_update('.$desbord_st_detail[0].')" id="st_Weekly_Fundsheet'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[4].'"/></td>
					
                   <td> <input '.$st_per_of_grey_color.' type="text" onchange="st_per_of_grey_update('.$desbord_st_detail[0].')" id="st_per_of_grey'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[5].'"/></td>
				   
					<td> <input '.$st_Monthly_one_two_color.' type="text" onchange="st_Monthly_one_two_update('.$desbord_st_detail[0].')" id="st_Monthly_one_two'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[6].'"/></td>
					
					<td> <input '.$st_Visitors_entry_done_color.' type="text" onchange="st_Visitors_entry_done_update('.$desbord_st_detail[0].')" id="st_Visitors_entry_done'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[7].'"/></td>
					
					<td> <input '.$st_Renewal_Cheques_color.'type="text" onchange="st_Renewal_Cheques_update('.$desbord_st_detail[0].')" id="st_Renewal_Cheques'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[8].'"/></td>
					
                    <td> <input '.$st_LTRT_Attendance_color.'type="text" onchange="st_LTRT_Attendance_update('.$desbord_st_detail[0].')" id="st_LTRT_Attendance'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[9].'"/></td>
					
					<td> <input '.$st_Chapter_Retention_color.' type="text" onchange="st_Chapter_Retention_update('.$desbord_st_detail[0].')" id="st_Chapter_Retention'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[10].'"/></td>
					
					<td> <input '.$total_score_st_color.' type="text" onchange="st_Total_Score_update1('.$desbord_st_detail[0].')" id="st_Total_Score'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_st.'"/></td>
					
					<td> <input '.$st_Individual_Ranking_color.'type="text" onchange="st_Individual_Ranking_update('.$desbord_st_detail[0].')" id="st_Individual_Ranking'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[12].'"/></td>
					
				

				
				
                </tr> ';
				
				 } 
				
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}
}

//st_LTRT_Attendance_update_val


if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'st_LTRT_Attendance_update_val')
{
	$desbord_st_id = $_POST['desbord_st_id'];
	$st_LTRT_Attendance_val = $_POST['st_LTRT_Attendance_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_st set LTRT_Attendance ='$st_LTRT_Attendance_val' where admin_id='$user_id' AND desbord_st_id='$desbord_st_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">ST</p></th>
                <th><p style="color:#d6d6d6;">Weekly Fundsheet Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Visitors entry done within a week</p></th>
                <th><p style="color:#d6d6d6;">Renewal Cheques to be collected 3 months in advance</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_st_sql = "SELECT * FROM desbord_st";
	//echo $sql;
	$desbord_st_result = mysqli_query($conn, $desbord_st_sql);
	$x=1;
while ($desbord_st_detail=mysqli_fetch_row($desbord_st_result))
          
		  {
			  
			  if($desbord_st_detail[4] == 15)
			  {
				  $st_Weekly_Fundsheet_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[4] == 10)
			  {
				$st_Weekly_Fundsheet_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Weekly_Fundsheet_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[5] == 15)
			  {
				  $st_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[5] == 10)
			  {
				$st_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[6] == 15)
			  {
				  $st_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[6] == 10)
			  {
				$st_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_st_detail[7] == 5)
			  {
				  $st_Visitors_entry_done_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_Visitors_entry_done_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[8] == 20)
			  {
				  $st_Renewal_Cheques_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[8] == 15)
			  {
				$st_Renewal_Cheques_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Renewal_Cheques_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[9] == 10)
			  {
				  $st_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[10] == 20)
			  {
				  $st_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[10] == 15)
			  {
				$st_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  			  
 $total_score_st = $desbord_st_detail[4] + $desbord_st_detail[5]+ $desbord_st_detail[6]+ $desbord_st_detail[7]+ $desbord_st_detail[8]+ $desbord_st_detail[9]+ $desbord_st_detail[10];
					
			  if($total_score_st >= 70)
			  {
				  $total_score_st_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_st_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[12] >=70)
				  {
					 $st_Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_st_detail[12] >=50 && $desbord_st_detail[12] <=70)
				   {
               $st_Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_st_detail[12] >=30 && $desbord_st_detail[12] <=50)
				   {
               $st_Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $st_Individual_Ranking_color =  'style="background-color:black;"';
				  }
			    
			    
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_st_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="st_update('.$desbord_st_detail[0].')" id="st'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[3].'"/></td>
                    
                    <td> <input '.$st_Weekly_Fundsheet_color.' type="text" onchange="st_Weekly_Fundsheet_update('.$desbord_st_detail[0].')" id="st_Weekly_Fundsheet'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[4].'"/></td>
					
                   <td> <input '.$st_per_of_grey_color.' type="text" onchange="st_per_of_grey_update('.$desbord_st_detail[0].')" id="st_per_of_grey'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[5].'"/></td>
				   
					<td> <input '.$st_Monthly_one_two_color.' type="text" onchange="st_Monthly_one_two_update('.$desbord_st_detail[0].')" id="st_Monthly_one_two'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[6].'"/></td>
					
					<td> <input '.$st_Visitors_entry_done_color.' type="text" onchange="st_Visitors_entry_done_update('.$desbord_st_detail[0].')" id="st_Visitors_entry_done'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[7].'"/></td>
					
					<td> <input '.$st_Renewal_Cheques_color.'type="text" onchange="st_Renewal_Cheques_update('.$desbord_st_detail[0].')" id="st_Renewal_Cheques'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[8].'"/></td>
					
                    <td> <input '.$st_LTRT_Attendance_color.'type="text" onchange="st_LTRT_Attendance_update('.$desbord_st_detail[0].')" id="st_LTRT_Attendance'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[9].'"/></td>
					
					<td> <input '.$st_Chapter_Retention_color.' type="text" onchange="st_Chapter_Retention_update('.$desbord_st_detail[0].')" id="st_Chapter_Retention'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[10].'"/></td>
					
					<td> <input '.$total_score_st_color.' type="text" onchange="st_Total_Score_update1('.$desbord_st_detail[0].')" id="st_Total_Score'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_st.'"/></td>
					
					<td> <input '.$st_Individual_Ranking_color.'type="text" onchange="st_Individual_Ranking_update('.$desbord_st_detail[0].')" id="st_Individual_Ranking'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[12].'"/></td>
					
				

				
				
                </tr> ';
				
				 } 
				
				 
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}
}

//st_Chapter_Retention_update_val
 
 
  
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'st_Chapter_Retention_update_val')
{
	$desbord_st_id = $_POST['desbord_st_id'];
	$st_Chapter_Retention_val = $_POST['st_Chapter_Retention_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_st set Chapter_Retention ='$st_Chapter_Retention_val' where admin_id='$user_id' AND desbord_st_id='$desbord_st_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">ST</p></th>
                <th><p style="color:#d6d6d6;">Weekly Fundsheet Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Visitors entry done within a week</p></th>
                <th><p style="color:#d6d6d6;">Renewal Cheques to be collected 3 months in advance</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_st_sql = "SELECT * FROM desbord_st";
	//echo $sql;
	$desbord_st_result = mysqli_query($conn, $desbord_st_sql);
	$x=1;
while ($desbord_st_detail=mysqli_fetch_row($desbord_st_result))
          
		  {
			  
			  if($desbord_st_detail[4] == 15)
			  {
				  $st_Weekly_Fundsheet_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[4] == 10)
			  {
				$st_Weekly_Fundsheet_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Weekly_Fundsheet_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[5] == 15)
			  {
				  $st_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[5] == 10)
			  {
				$st_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[6] == 15)
			  {
				  $st_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[6] == 10)
			  {
				$st_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_st_detail[7] == 5)
			  {
				  $st_Visitors_entry_done_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_Visitors_entry_done_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[8] == 20)
			  {
				  $st_Renewal_Cheques_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[8] == 15)
			  {
				$st_Renewal_Cheques_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Renewal_Cheques_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[9] == 10)
			  {
				  $st_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[10] == 20)
			  {
				  $st_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[10] == 15)
			  {
				$st_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  			  
 $total_score_st = $desbord_st_detail[4] + $desbord_st_detail[5]+ $desbord_st_detail[6]+ $desbord_st_detail[7]+ $desbord_st_detail[8]+ $desbord_st_detail[9]+ $desbord_st_detail[10];
					
			  if($total_score_st >= 70)
			  {
				  $total_score_st_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_st_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[12] >=70)
				  {
					 $st_Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_st_detail[12] >=50 && $desbord_st_detail[12] <=70)
				   {
               $st_Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_st_detail[12] >=30 && $desbord_st_detail[12] <=50)
				   {
               $st_Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $st_Individual_Ranking_color =  'style="background-color:black;"';
				  }
			    
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_st_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="st_update('.$desbord_st_detail[0].')" id="st'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[3].'"/></td>
                    
                    <td> <input '.$st_Weekly_Fundsheet_color.' type="text" onchange="st_Weekly_Fundsheet_update('.$desbord_st_detail[0].')" id="st_Weekly_Fundsheet'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[4].'"/></td>
					
                   <td> <input '.$st_per_of_grey_color.' type="text" onchange="st_per_of_grey_update('.$desbord_st_detail[0].')" id="st_per_of_grey'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[5].'"/></td>
				   
					<td> <input '.$st_Monthly_one_two_color.' type="text" onchange="st_Monthly_one_two_update('.$desbord_st_detail[0].')" id="st_Monthly_one_two'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[6].'"/></td>
					
					<td> <input '.$st_Visitors_entry_done_color.' type="text" onchange="st_Visitors_entry_done_update('.$desbord_st_detail[0].')" id="st_Visitors_entry_done'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[7].'"/></td>
					
					<td> <input '.$st_Renewal_Cheques_color.'type="text" onchange="st_Renewal_Cheques_update('.$desbord_st_detail[0].')" id="st_Renewal_Cheques'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[8].'"/></td>
					
                    <td> <input '.$st_LTRT_Attendance_color.'type="text" onchange="st_LTRT_Attendance_update('.$desbord_st_detail[0].')" id="st_LTRT_Attendance'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[9].'"/></td>
					
					<td> <input '.$st_Chapter_Retention_color.' type="text" onchange="st_Chapter_Retention_update('.$desbord_st_detail[0].')" id="st_Chapter_Retention'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[10].'"/></td>
					
					<td> <input '.$total_score_st_color.' type="text" onchange="st_Total_Score_update1('.$desbord_st_detail[0].')" id="st_Total_Score'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_st.'"/></td>
					
					<td> <input '.$st_Individual_Ranking_color.'type="text" onchange="st_Individual_Ranking_update('.$desbord_st_detail[0].')" id="st_Individual_Ranking'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[12].'"/></td>
					
				

				
				
                </tr> ';
				
				 } 
				
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}
}

//st_Total_Score_update_val

   
  
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'st_Total_Score_update_val')
{
	$desbord_st_id = $_POST['desbord_st_id'];
	$st_Total_Score_val = $_POST['st_Total_Score_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_st set Total_Score ='$st_Total_Score_val' where admin_id='$user_id' AND desbord_st_id='$desbord_st_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">ST</p></th>
                <th><p style="color:#d6d6d6;">Weekly Fundsheet Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Visitors entry done within a week</p></th>
                <th><p style="color:#d6d6d6;">Renewal Cheques to be collected 3 months in advance</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_st_sql = "SELECT * FROM desbord_st where admin_id='$user_id'";
	//echo $sql;
	$desbord_st_result = mysqli_query($conn, $desbord_st_sql);
	$x=1;
while ($desbord_st_detail=mysqli_fetch_row($desbord_st_result))
          
		  {
			  
			  if($desbord_st_detail[4] == 15)
			  {
				  $st_Weekly_Fundsheet_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[4] == 10)
			  {
				$st_Weekly_Fundsheet_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Weekly_Fundsheet_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[5] == 15)
			  {
				  $st_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[5] == 10)
			  {
				$st_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[6] == 15)
			  {
				  $st_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[6] == 10)
			  {
				$st_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_st_detail[7] == 5)
			  {
				  $st_Visitors_entry_done_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_Visitors_entry_done_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[8] == 20)
			  {
				  $st_Renewal_Cheques_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[8] == 15)
			  {
				$st_Renewal_Cheques_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Renewal_Cheques_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[9] == 10)
			  {
				  $st_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[10] == 20)
			  {
				  $st_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[10] == 15)
			  {
				$st_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  			  
 $total_score_st = $desbord_st_detail[4] + $desbord_st_detail[5]+ $desbord_st_detail[6]+ $desbord_st_detail[7]+ $desbord_st_detail[8]+ $desbord_st_detail[9]+ $desbord_st_detail[10];
					
			  if($total_score_st >= 70)
			  {
				  $total_score_st_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_st_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[12] >=70)
				  {
					 $st_Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_st_detail[12] >=50 && $desbord_st_detail[12] <=70)
				   {
               $st_Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_st_detail[12] >=30 && $desbord_st_detail[12] <=50)
				   {
               $st_Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $st_Individual_Ranking_color =  'style="background-color:black;"';
				  }
			    
			    
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_st_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="st_update('.$desbord_st_detail[0].')" id="st'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[3].'"/></td>
                    
                    <td> <input '.$st_Weekly_Fundsheet_color.' type="text" onchange="st_Weekly_Fundsheet_update('.$desbord_st_detail[0].')" id="st_Weekly_Fundsheet'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[4].'"/></td>
					
                   <td> <input '.$st_per_of_grey_color.' type="text" onchange="st_per_of_grey_update('.$desbord_st_detail[0].')" id="st_per_of_grey'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[5].'"/></td>
				   
					<td> <input '.$st_Monthly_one_two_color.' type="text" onchange="st_Monthly_one_two_update('.$desbord_st_detail[0].')" id="st_Monthly_one_two'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[6].'"/></td>
					
					<td> <input '.$st_Visitors_entry_done_color.' type="text" onchange="st_Visitors_entry_done_update('.$desbord_st_detail[0].')" id="st_Visitors_entry_done'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[7].'"/></td>
					
					<td> <input '.$st_Renewal_Cheques_color.'type="text" onchange="st_Renewal_Cheques_update('.$desbord_st_detail[0].')" id="st_Renewal_Cheques'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[8].'"/></td>
					
                    <td> <input '.$st_LTRT_Attendance_color.'type="text" onchange="st_LTRT_Attendance_update('.$desbord_st_detail[0].')" id="st_LTRT_Attendance'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[9].'"/></td>
					
					<td> <input '.$st_Chapter_Retention_color.' type="text" onchange="st_Chapter_Retention_update('.$desbord_st_detail[0].')" id="st_Chapter_Retention'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[10].'"/></td>
					
					<td> <input '.$total_score_st_color.' type="text" onchange="st_Total_Score_update1('.$desbord_st_detail[0].')" id="st_Total_Score'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_st.'"/></td>
					
					<td> <input '.$st_Individual_Ranking_color.'type="text" onchange="st_Individual_Ranking_update('.$desbord_st_detail[0].')" id="st_Individual_Ranking'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[12].'"/></td>
					
				

				
				
                </tr> ';
				
				 } 
				
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}
}

//st_Individual_Ranking_update_val
  
     
  
if($_POST['r'])
{
$r = $_POST['r'];
    //echo "login";
		//echo $r;
if($r == 'st_Individual_Ranking_update_val')
{
	$desbord_st_id = $_POST['desbord_st_id'];
	$st_Individual_Ranking_val = $_POST['st_Individual_Ranking_val'];
	$user_id = $_POST['user_id'];
	
	
  $sql = "update desbord_st set Individual_Ranking ='$st_Individual_Ranking_val' where admin_id='$user_id' AND desbord_st_id='$desbord_st_id'";
	//echo $sql;
	if($conn->query($sql)== TRUE)
	{
		echo '<form class="form-horizontal">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead style="background-color:black;">
			
                <th><p style="color:#d6d6d6;">Chapter</p></th>
                <th><p style="color:#d6d6d6;">ST</p></th>
                <th><p style="color:#d6d6d6;">Weekly Fundsheet Submission</p></th>
				<th><p style="color:#d6d6d6;">% of Grey Members in the Chapter</p></th>
                <th><p style="color:#d6d6d6;">Monthly 1-2-1s SELF</p></th>	
				<th><p style="color:#d6d6d6;">Visitors entry done within a week</p></th>
                <th><p style="color:#d6d6d6;">Renewal Cheques to be collected 3 months in advance</p></th>
				<th><p style="color:#d6d6d6;">LTRT Attendance</p></th>
				<th><p style="color:#d6d6d6;">Chapter Retention</p></th>
                <th><p style="color:#d6d6d6;">Total Score</p></th>
				<th><p style="color:#d6d6d6;">Members Traffic Lights Individual Ranking</p></th>
               
            </thead>
			  
            <tbody id="viewdataview">';
			
	      
			  
      $desbord_st_sql = "SELECT * FROM desbord_st where admin_id='$user_id'";
	//echo $sql;
	$desbord_st_result = mysqli_query($conn, $desbord_st_sql);
	$x=1;
	while ($desbord_st_detail=mysqli_fetch_row($desbord_st_result))
          
		  {
			  
			  if($desbord_st_detail[4] == 15)
			  {
				  $st_Weekly_Fundsheet_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[4] == 10)
			  {
				$st_Weekly_Fundsheet_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Weekly_Fundsheet_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[5] == 15)
			  {
				  $st_per_of_grey_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[5] == 10)
			  {
				$st_per_of_grey_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_per_of_grey_color = 'style="background-color:red;"';  
			  }
			  
			  if($desbord_st_detail[6] == 15)
			  {
				  $st_Monthly_one_two_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[6] == 10)
			  {
				$st_Monthly_one_two_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Monthly_one_two_color = 'style="background-color:red;"';  
			  }
			  
			  
			   if($desbord_st_detail[7] == 5)
			  {
				  $st_Visitors_entry_done_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_Visitors_entry_done_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[8] == 20)
			  {
				  $st_Renewal_Cheques_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[8] == 15)
			  {
				$st_Renewal_Cheques_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Renewal_Cheques_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[9] == 10)
			  {
				  $st_LTRT_Attendance_color = 'style="background-color:green;"';
			  }
			
			  else
			  {
				 $st_LTRT_Attendance_color = 'style="background-color:red;"';  
			  }
			  
			  
			  if($desbord_st_detail[10] == 20)
			  {
				  $st_Chapter_Retention_color = 'style="background-color:green;"';
			  }
			  else if($desbord_st_detail[10] == 15)
			  {
				$st_Chapter_Retention_color = 'style="background-color:yellow;"';  
			  }
			  else
			  {
				 $st_Chapter_Retention_color = 'style="background-color:red;"';  
			  }
			  
			  			  
 $total_score_st = $desbord_st_detail[4] + $desbord_st_detail[5]+ $desbord_st_detail[6]+ $desbord_st_detail[7]+ $desbord_st_detail[8]+ $desbord_st_detail[9]+ $desbord_st_detail[10];
					
			  if($total_score_st >= 70)
			  {
				  $total_score_st_color = 'style="background-color:green;"';
			  }
			 
			  else
			  {
				 $total_score_st_color = 'style="background-color:red;"';  
			  }
			  
			  
			 if($desbord_st_detail[12] >=70)
				  {
					 $st_Individual_Ranking_color = 'style="background-color:green;"';
				  }
				  
				  elseif($desbord_st_detail[12] >=50 && $desbord_st_detail[12] <=70)
				   {
               $st_Individual_Ranking_color = 'style="background-color:yellow;"';
				   }
				   
				    elseif($desbord_st_detail[12] >=30 && $desbord_st_detail[12] <=50)
				   {
               $st_Individual_Ranking_color = 'style="background-color:red;"';
				   }
				 
				  else
				  {
					 $st_Individual_Ranking_color =  'style="background-color:black;"';
				  }
			    
	 
	        
			echo '
                <tr id="valid" value="">
				
				<td><input  type="text" class="form-control" value="'.$desbord_st_detail[2].'"/></td>
				  
                  <td> <input type="text" onchange="st_update('.$desbord_st_detail[0].')" id="st'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[3].'"/></td>
                    
                    <td> <input '.$st_Weekly_Fundsheet_color.' type="text" onchange="st_Weekly_Fundsheet_update('.$desbord_st_detail[0].')" id="st_Weekly_Fundsheet'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[4].'"/></td>
					
                   <td> <input '.$st_per_of_grey_color.' type="text" onchange="st_per_of_grey_update('.$desbord_st_detail[0].')" id="st_per_of_grey'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[5].'"/></td>
				   
					<td> <input '.$st_Monthly_one_two_color.' type="text" onchange="st_Monthly_one_two_update('.$desbord_st_detail[0].')" id="st_Monthly_one_two'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[6].'"/></td>
					
					<td> <input '.$st_Visitors_entry_done_color.' type="text" onchange="st_Visitors_entry_done_update('.$desbord_st_detail[0].')" id="st_Visitors_entry_done'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[7].'"/></td>
					
					<td> <input '.$st_Renewal_Cheques_color.'type="text" onchange="st_Renewal_Cheques_update('.$desbord_st_detail[0].')" id="st_Renewal_Cheques'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[8].'"/></td>
					
                    <td> <input '.$st_LTRT_Attendance_color.'type="text" onchange="st_LTRT_Attendance_update('.$desbord_st_detail[0].')" id="st_LTRT_Attendance'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[9].'"/></td>
					
					<td> <input '.$st_Chapter_Retention_color.' type="text" onchange="st_Chapter_Retention_update('.$desbord_st_detail[0].')" id="st_Chapter_Retention'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[10].'"/></td>
					
					<td> <input '.$total_score_st_color.' type="text" onchange="st_Total_Score_update1('.$desbord_st_detail[0].')" id="st_Total_Score'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$total_score_st.'"/></td>
					
					<td> <input '.$st_Individual_Ranking_color.'type="text" onchange="st_Individual_Ranking_update('.$desbord_st_detail[0].')" id="st_Individual_Ranking'.$desbord_st_detail[0].'" class="form-control" name="myInput[]" value="'.$desbord_st_detail[12].'"/></td>
					
				

				
				
                </tr> ';
				
				 } 
				
				 
				 
				
			
         echo '   </tbody>
			
        </table>
    </div>
	
</form>';
		 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
}
}

  
?>