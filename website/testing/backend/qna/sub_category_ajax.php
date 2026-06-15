<?php
$local = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    include($local."/mysite/connectiondb/connect.php");
}else{
     include($local."/connectiondb/connect.php");
}


       if(!empty($_POST['id'])){
	        $id = $_POST['id'];
	       $sql = "SELECT id,name FROM sub_category where category_id=$id";
	        $result = mysqli_query($conn, $sql);
	        $sub_categorys = mysqli_fetch_all($result,MYSQLI_ASSOC);
	       foreach ($sub_categorys as $key => $value) {?>
             <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
          <?php }
       }
?>