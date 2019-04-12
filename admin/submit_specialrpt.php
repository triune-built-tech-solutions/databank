<?php
session_start();

$user_name = $_SESSION['user_name'];

require_once("../includes/connections.php");
if($_POST){
	 $added_by = $user_name;
	if(isset($_FILES['doc'])){
      $errors= array();
      $file_name = $_FILES['doc']['name'];
//      $file_size =$_FILES['doc']['size'];
      $file_tmp =$_FILES['doc']['tmp_name'];
      $file_type=$_FILES['doc']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['doc']['name'])));
      
      $expensions= array("jpeg","jpg","png","pdf","doc","docx");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a PDF, DOC, DOCX, JPEG, PNG file.";
      }
      
     // if($file_size > 2097152){
       //  $errors[]='File size must be excately 2 MB';
      //}
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"special_rpt/".$file_name);
//         echo "Success";
		 $target_file="special_rpt/".$file_name;
      }else{
         print_r($errors);
      }
   }

	
	
$in="insert into special_rpt values(null,'$_POST[title]','$_POST[desc]','$_POST[programmestart]','$target_file','$_POST[dept]', '$added_by')";


$q=mysqli_query($GLOBALS["___mysqli_ston"], $in);
if(!$q){
	print mysqli_error($GLOBALS["___mysqli_ston"]);
	exit;	
}

//header_remove();
header("location:special_rpt.php?rpt=Special Report Added Successfully");
}

?>